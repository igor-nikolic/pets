<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 3/9/19
 * Time: 3:42 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class PetPhoto
{
    public $petId;
    public $photoId;

    public function store(){
        return DB::table('pet_photo')->insertGetId([
            'pet_id'=>$this->petId,
            'photo_id'=>$this->photoId
        ]);
    }

    public function getPhotoByPetId(){
        return DB::table('pet_photo')
            ->join('photo','pet_photo.photo_id','=','photo.id')
            ->where('pet_photo.pet_id','=',$this->petId)
            ->get();
    }
}