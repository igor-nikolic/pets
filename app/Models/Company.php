<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 2/26/19
 * Time: 2:25 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Company
{

    public function getFirst(){
        return DB::table('company')->first();
    }

    public function getOne(){

    }
}