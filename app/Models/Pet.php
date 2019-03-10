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
}