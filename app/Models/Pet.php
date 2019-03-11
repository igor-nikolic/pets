<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 3/8/19
 * Time: 12:44 AM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Pet
{
    public $id;
    public $name;
    public $gender;
    public $birthday;
    public $father_id;
    public $mother_id;
    public $user_id;
    public $breed_id;
    public $photos;
 public function getAll(){
     return DB::table('pet')->get();
 }

 public function store(){
    return DB::table('pet')->insertGetId([
        'name'=>$this->name,
        'gender'=>$this->gender,
        'birthday'=>$this->birthday,
        'father_id'=>$this->father_id,
        'mother_id'=>$this->mother_id,
        'user_id'=>$this->user_id,
        'breed_id'=>$this->breed_id
        ]);
 }

 public function getById(){
     return DB::table('pet')
         ->join('breed','pet.breed_id','=','breed.id')
         ->where('pet.id','=',$this->id)
         ->select('*','pet.name AS pet_name','breed.name AS breed_name','pet.id AS pet_id')
         ->first();
 }

 public function getMother(){
     return DB::table('pet')
         ->where('id','=',$this->mother_id)
         ->first();
 }

 public function getFather(){
     return DB::table('pet')
         ->where('id','=',$this->father_id)
         ->first();
 }

 public function destroyById(){
     return DB::table('pet')
         ->where('id','=',$this->id)
         ->delete();
 }

 public function updateWithoutPhotos(){
     return DB::table('pet')
         ->where('id','=',$this->id)
         ->update([
             'name'=>$this->name,
             'gender'=>$this->gender,
             'birthday'=>$this->birthday,
             'father_id'=>$this->father_id,
             'mother_id'=>$this->mother_id,
             'breed_id'=>$this->breed_id
         ]);
 }
public function getPaginateAll(){
    return DB::table('pet AS child')
        ->leftJoin('pet AS father','child.father_id','=','father.id')
        ->leftJoin('pet as mother','child.mother_id','=','mother.id')
        ->join('breed','child.breed_id','=','breed.id')
        ->join('user','child.user_id','=','user.id')
        ->select(
            'child.id AS pet_id',
            'child.name AS pet_name',
            'child.birthday AS pet_birthday',
            'child.gender AS pet_gender',
            'child.father_id AS pet_fatherID',
            'child.mother_id AS pet_motherID',
            'child.user_id AS pet_userID',
            'child.breed_id AS pet_breedID',
            'father.id AS father_id',
            'father.name AS father_name',
            'mother.id AS mother_id',
            'mother.name AS mother_name',
            'breed.name AS pet_breed',
            'user.first_name AS pet_owner_first_name',
            'user.last_name AS pet_owner_last_name',
            'user.email AS pet_owner_email'
        )
        ->paginate(10);
}

 public function searchPetByName($query){


     return DB::table('pet AS child')
         ->leftJoin('pet AS father','child.father_id','=','father.id')
         ->leftJoin('pet as mother','child.mother_id','=','mother.id')
         ->join('breed','child.breed_id','=','breed.id')
         ->join('user','child.user_id','=','user.id')
         ->select(
             'child.id AS pet_id',
             'child.name AS pet_name',
             'child.birthday AS pet_birthday',
             'child.gender AS pet_gender',
             'child.father_id AS pet_fatherID',
             'child.mother_id AS pet_motherID',
             'child.user_id AS pet_userID',
             'child.breed_id AS pet_breedID',
             'father.id AS father_id',
             'father.name AS father_name',
             'mother.id AS mother_id',
             'mother.name AS mother_name',
             'breed.name AS pet_breed',
             'user.first_name AS pet_owner_first_name',
             'user.last_name AS pet_owner_last_name',
             'user.email AS pet_owner_email'
         )
         ->where('child.name','like','%'.$query.'%')
         ->paginate(10);
 }
}