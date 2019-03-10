<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 3/9/19
 * Time: 3:38 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Photo
{
    public $path;
    public $alt;
    public function store(){
        return DB::table('photo')->insertGetId([
            'path'=>$this->path,
            'alt'=>$this->alt
        ]);
    }
}