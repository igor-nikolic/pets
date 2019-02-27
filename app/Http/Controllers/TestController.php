<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function testvalidation(Request $request){
        $request->validate([
            'email'=>'required|email|unique:user,Email|max:60',
        ]);
    }

}
