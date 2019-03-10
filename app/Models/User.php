<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 2/26/19
 * Time: 10:29 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class User
{
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $repeat_password;
    public $activation_hash;
    public $created_at;

    public function store(){
        $passdb = password_hash($this->password,PASSWORD_BCRYPT);
        $role = 2; //role_id for regular users, 1 is for admins!
        try {
            $user_id = DB::table('user')->insertGetId(['role_id'=>$role,'first_name'=>$this->firstName,'last_name'=>$this->lastName,'email'=>$this->email,'password'=>$passdb,'created_at'=>$this->created_at,'activation_hash'=>$this->activation_hash]);
        } catch (\Exception $e) {
            Log::warning('Storing user with his data'.$this->firstName." ".$this->lastName." ".$this->email. " ".$passdb. " failed! Time: ".$this->created_at);
            return 0;
        } catch (\Throwable $e) {
            Log::warning('Storing user with his data'.$this->firstName." ".$this->lastName." ".$this->email. " ".$passdb. " failed! Time: ".$this->created_at);
            return 0;
        }
        Log::info('User with id '.$user_id.' registered at '.$this->created_at);
        return $user_id;
    }

    public function login(){
        return DB::table('user')
            ->join('role','user.role_id','=','role.id')
            ->where('user.email','=',$this->email)
            ->whereNotNull('user.activated_at')
            ->whereNull('deleted_at')
            ->first();
    }

    public function activate(){

        $created_time = date('Y-m-d H:i:s');
        try{
            return DB::table('user')
                ->where('email','=',$this->email)
                ->where('activation_hash','=',$this->activation_hash)
                ->whereNull('activated_at')
                ->update(['activated_at'=>$created_time]);
        }catch (\Illuminate\Database\QueryException $e){
            Log::warning('Activating user '.$this->email.' failed at '.$created_time);
            return var_dump($e);
        }

    }

    public function isActivated(){
        try{
            return DB::table('user')
                ->where('email','=',$this->email)
                ->whereNotNull('activated_at')
                ->first();
        }catch (\Illuminate\Database\QueryException $e){
            return var_dump($e);
        }
    }

    public function getUsersBasicInfoById(){
        return DB::table('user')
            ->where('id','=',$this->id)
            ->select('id','first_name','last_name','email')
            ->first();
    }
}