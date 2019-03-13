<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function home(){
        $pet = new Pet();
        $user = new User();
        $data = array();
        $data['numberOfPets'] = $pet->countAll();
        $data['numberOfAllUsers'] = $user->countAll();
        $data['numberOfActivatedUsers'] = $user->countActivated();
        $data['numberOfDeletedUsers'] = $user->countDeleted();
        $data['numberOfNotActivatedUsers'] = $user->countNotActivated();

        return view('pages.admin.home',$data);
    }
}
