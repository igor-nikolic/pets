<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 3/12/19
 * Time: 7:22 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Role
{
    public function getAll(){
        return DB::table('role')
            ->get();
    }
}