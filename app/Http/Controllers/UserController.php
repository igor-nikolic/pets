<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginUser $lu){
        $email = $lu->input('loginemail');
        $password = $lu->input('loginpassword');
        $user = new User();
        $user->email = $email;
        $user->password = $password;
        $rez = $user->login();
        return $rez;
    }

    public function register(StoreUser $su){
        $activation_string = time() ."|". $su->input('email');
        $activation_hash = base64_encode($activation_string);
        $user = new User();
        $user->firstName = ucwords(trim($su->input('first_name')));
        $user->lastName = ucwords(trim($su->input('last_name')));
        $user->email = $su->input('email');
        $user->password = $su->input('password');
        $user->created_at = date('Y-m-d H:i:s');
        $user->activation_hash = $activation_hash;
        $user_id = $user->store();
        if($user_id) {
            $su->session()->flash('message','We have sent you a confirmation link to your email');
            return redirect('/');
        }
        else {
            $su->session()->flash('message','You didn\'t register! Please try again later!');
            return redirect('/');
        }
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
