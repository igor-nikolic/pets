<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 3/8/19
 * Time: 12:47 AM
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
class Breed
{
    public $id;
    public $name;

    public function getAll(){
        return DB::table('breed')->get();
    }
    public function getPaginateAll(){
        return DB::table('breed')
            ->paginate(10);
    }

    public function search($query){
        return DB::table('breed')
            ->where('name','like','%'.$query.'%')
            ->paginate(10);
    }

    public function getById(){
        return DB::table('breed')
            ->where('id','=',$this->id)
            ->first();
    }

    public function updateBreedName(){
        return DB::table('breed')
            ->where('id','=',$this->id)
            ->update(['name'=>$this->name]);
    }
    public function destroyById(){
        return DB::table('breed')
            ->where('id','=',$this->id)
            ->delete();
    }

    public function store(){
        return DB::table('breed')
            ->insertGetId(['name'=>$this->name]);
    }
}