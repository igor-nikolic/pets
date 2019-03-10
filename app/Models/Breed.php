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
    public function getAll(){
        return DB::table('breed')->get();
    }
}