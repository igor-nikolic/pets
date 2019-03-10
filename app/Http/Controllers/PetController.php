<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Models\Breed;
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
    public function __construct()
    {
        $this->middleware('authorize')->except(['show']);
        $this->middleware('petEdit')->only(['edit']);
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
        $data = array();
        $pet = new Pet();
        $breed = new Breed();
        $data['breeds'] = $breed->getAll();
        $data['parents'] = $pet->getAll();
        return view('pages.front.create_pet',$data);
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

        $data = [];
        $pet = new Pet();
        $pet->id = $id;
        $petData = $pet->getById();
//        dd($petData);
        $data['petData'] = $petData;
        $pet->mother_id = $petData->mother_id;
        $pet->father_id = $petData->father_id;
        $data['motherData'] = $pet->getMother();
        $data['fatherData'] = $pet->getFather();
        $petPhoto = new PetPhoto();
        $petPhoto->petId = $id;
        $data['photos'] = $petPhoto->getPhotoByPetId();
        $user = new User();
        $user->id = $petData->user_id;
        $data['ownerData'] = $user->getUsersBasicInfoById();
//        dd($data);
        return view('pages.front.show_pet',$data);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
