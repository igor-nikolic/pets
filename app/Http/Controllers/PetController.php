<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Http\Requests\UpdatePet;
use App\Models\Breed;
use App\Models\Company;
use App\Models\Menu;
use App\Models\Pet;
use App\Models\PetPhoto;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $data;
    public function __construct()
    {
        $this->middleware('authorize')->except(['show']);
        $this->middleware('petEdit')->only(['edit']);
        $menu = new Menu();
        $company = new Company();
        $this->data['menu'] = $menu->getAll();
        $this->data['company'] = $company->getFirst();
    }

    public function index(Request $request)
    {
        //
//        if($request->session()->has('user') && $request->session()->get('user')->role_id==1){
//            return DB::table('pet')->get();
//        }
        echo "bravo";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pet = new Pet();
        $breed = new Breed();
        $this->data['breeds'] = $breed->getAll();
        $this->data['parents'] = $pet->getAll();
        return view('pages.front.create_pet',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        $petName = $request->input('petName');
        if($request->input('petFather') == 0) $petFather=null;
        else $petFather = $request->input('petFather');
        if($request->input('petMother') == 0) $petMother=null;
        else $petMother = $request->input('petMother');
        $files = $request->file('petPhotos');
        $pet = new Pet();
        $pet->name = trim($request->input('petName'));
        $pet->gender = $request->input('petGender')[0];
        $pet->birthday = $request->input('petBirthday');
        $pet->father_id = $petFather;
        $pet->mother_id = $petMother;
        $pet->breed_id =  $request->input('petBreed');
        $pet->user_id = $request->session()->get('user')->id;
        $petId = $pet->store();
        try{
            $photos = [];
            foreach ($files as $key=>$file) {
                $originalFileName = $file->getClientOriginalName();
                $newFileName = time()."$key"."_".$originalFileName;
                $file->move(public_path("images/pets"),$newFileName);
                $photo = new Photo();
                $photo->alt = $petName.$key;
                $photo->path = $newFileName;
                $photoId = $photo->store();
                $photos[$key]['photo_id'] = $photoId;
                $petPhoto = new PetPhoto();
                $petPhoto->photoId = $photoId;
                $petPhoto->petId = $petId;
                $petPhoto->store();
                $photos[$key]['pet_photo'] = $petPhoto;
            }
            $response = ['success'=>true,'message'=>'You have successfully added a pet','petId'=>$petId,'petGender'=>$pet->gender,'petName'=>$pet->name];
                return json_encode($response);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pet = new Pet();
        $pet->id = $id;
        $petData = $pet->getById();
        if(!$petData) return redirect()->back();
        $this->data['petData'] = $petData;
        $pet->mother_id = $petData->mother_id;
        $pet->father_id = $petData->father_id;
        $this->data['motherData'] = $pet->getMother();
        $this->data['fatherData'] = $pet->getFather();
        $petPhoto = new PetPhoto();
        $petPhoto->petId = $id;
        $this->data['photos'] = $petPhoto->getPhotoByPetId();
        $user = new User();
        $user->id = $petData->user_id;
        $this->data['ownerData'] = $user->getUsersBasicInfoById();
//        dd($data);
        return view('pages.front.show_pet',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pet = new Pet();
        $pet->id = $id;
        $petData = $pet->getById();
        if(!$petData) return redirect()->back();
        $breed = new Breed();
        $this->data['breeds'] = $breed->getAll();
        $this->data['parents'] = $pet->getAll();
        $this->data['petData'] = $petData;
//        dd($this->data);

        return view('pages.front.edit_pet',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePet $request, $id)
    {
        //
        if($request->input('petFather') == 0) $petFather=null;
        else $petFather = $request->input('petFather');
        if($request->input('petMother') == 0) $petMother=null;
        else $petMother = $request->input('petMother');
        $pet = new Pet();
        $pet->id = $request->input('petId');
        $pet->name = trim($request->input('petName'));
        $pet->gender = $request->input('petGender')[0];
        $pet->birthday = $request->input('petBirthday');
        $pet->father_id = $petFather;
        $pet->mother_id = $petMother;
        $pet->breed_id =  $request->input('petBreed');
//        $pet->user_id = $request->session()->get('user')->id;
        $result = $pet->updateWithoutPhotos();
        if($result == -1 ) {
            $response = ['success' => false, 'message' => 'Update failed'];
            return json_encode($response);
        }elseif($result == 0){
            $response = ['success'=>true,'message'=>'You didn\'t change anything!'];
            return json_encode($response);
        }else{
            $response = ['success'=>true,'message'=>'Update successful'];
            return json_encode($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pet = new Pet();
        $pet->id = $id;
        $data = [];
        if($pet->destroyById()){
            $data['success'] = true;
            $data['message'] = 'You have successfully deleted a pet!';
            return json_encode($data);
        }
        $data['success'] = false;
        $data['message'] = 'Error deleting this pet!';
        return json_encode($data);
    }
}
