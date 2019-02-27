<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;


class Menu{

    public function getAll(){
        return DB::table('menu')->get();
    }
}