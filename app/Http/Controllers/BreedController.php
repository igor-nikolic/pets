<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBreed;
use App\Models\Breed;
use DemeterChain\B;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $breed = new Breed();
        $data['breeds'] = $breed->getPaginateAll();
        return view('pages.admin.breed.breeds',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.admin.breed.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBreed $request)
    {
        //
        $breed = new Breed();
        $breed->name = ucfirst(trim($request->input('breed_name')));
        $breedId = $breed->store();
        if($breedId) return json_encode(['success'=>true,'message'=>'You have successfully added a breed!',"breed_id"=>$breedId]);
        else return json_encode(['success'=>false,'message'=>'Failed addding a breed']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/admin/breeds/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=array();
        $breed = new Breed();
        $breed->id = $id;
        $breedData = $breed->getById();
        $data['breedData'] = $breedData;
        if(!$breedData) return redirect()->back();
//        dd($data);
        return view('pages.admin.breed.edit',$data);
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
        $breed = new Breed();
        $breed->id = $id;
        $breed->name = ucfirst(trim($request->input('breed_name')));
        $res = $breed->updateBreedName();
        if($res == -1){
            return json_encode(['success'=>false,'message'=>'Breed not updated!']);
        }elseif($res == 0){
            return json_encode(['success'=>true,'message'=>'You didn\'t change anything!']);
        }else{
            return json_encode(['success'=>true,'message'=>'Breed updated!']);
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
        //
        $breed = new Breed();
        $breed->id = $id;
        if($breed->destroyById()){
            $data['success'] = true;
            $data['message'] = 'You have successfully deleted a breed!';
            return json_encode($data);
        }
        $data['success'] = false;
        $data['message'] = 'Error deleting this breed!';
        return json_encode($data);
    }

    public function search(Request $request){
        if($request->ajax())
        {
            $query = $request->get('q');
            $query = str_replace(" ", "%", $query);
            $breed = new Breed();
            $data = $breed->search($query);
            return view('partials.admin.breed_pagination', ['breeds'=>$data])->render();
        }
    }
}
