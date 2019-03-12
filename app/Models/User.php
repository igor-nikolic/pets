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
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $repeat_password;
    public $activation_hash;
    public $created_at;
    public $role_id;
    public $activated_at;

    public function store(){
        $passdb = password_hash($this->password,PASSWORD_BCRYPT);
        try {
            $user_id = DB::table('user')->insertGetId(['role_id'=>$this->role_id,'first_name'=>$this->firstName,'last_name'=>$this->lastName,'email'=>$this->email,'password'=>$passdb,'created_at'=>$this->created_at,'activation_hash'=>$this->activation_hash]);
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
            ->select(
                'user.id AS user_id',
                'user.role_id AS role_id',
                'user.first_name AS user_first_name',
                'user.last_name AS user_last_name',
                'user.email AS user_email',
                'role.role AS user_role_name',
                'user.password AS user_password'
                )
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

    public function countAll(){
        return DB::table('user')->count();
    }

    public function getPaginateAll(){
        return DB::table('user')
            ->join('role','user.role_id','=','role.id')
            ->select(
                'user.id AS user_id',
                'user.first_name AS first_name',
                'user.last_name AS last_name',
                'user.email AS email',
                'user.created_at AS created_at',
                'user.deleted_at AS deleted_at',
                'user.updated_at AS updated_at',
                'user.activated_at AS activated_at',
                'user.role_id AS user_roleId',
                'role.role AS user_role'
            )
            ->paginate(10);
    }

    public function countActivated(){
        return DB::table('user')
            ->whereNotNull('activated_at')
            ->count();
    }
    public function countNotActivated(){
        return DB::table('user')
            ->whereNull('activated_at')
            ->count();
    }

    public function countDeleted(){
        return DB::table('user')
            ->whereNotNull('deleted_at')
            ->count();
    }

    public function search($query){

        return DB::table('user')
            ->join('role','user.role_id','=','role.id')
            ->select(
                'user.id AS user_id',
                'user.first_name AS first_name',
                'user.last_name AS last_name',
                'user.email AS email',
                'user.created_at AS created_at',
                'user.deleted_at AS deleted_at',
                'user.updated_at AS updated_at',
                'user.activated_at AS activated_at',
                'user.role_id AS user_roleId',
                'role.role AS user_role'
            )
            ->where('user.first_name','like','%'.$query.'%')
            ->orWhere('user.last_name','like','%'.$query.'%')
            ->orWhere('user.email','like','%'.$query.'%')
            ->orWhere('role.role','like','%'.$query.'%')
            ->paginate(10);
    }

    public function storeAndActivate(){
        $passdb = password_hash($this->password,PASSWORD_BCRYPT);
        try {
            $user_id = DB::table('user')->insertGetId(['role_id'=>$this->role_id,'first_name'=>$this->firstName,'last_name'=>$this->lastName,'email'=>$this->email,'password'=>$passdb,'created_at'=>$this->created_at,'activated_at'=>$this->created_at]);
        } catch (\Exception $e) {
            Log::warning('Storing user by admin with data'.$this->firstName." ".$this->lastName." ".$this->email. " ".$passdb. " failed! Time: ".$this->created_at);
            return 0;
        } catch (\Throwable $e) {
            Log::warning('Storing user by admin with data'.$this->firstName." ".$this->lastName." ".$this->email. " ".$passdb. " failed! Time: ".$this->created_at);
            return 0;
        }
        Log::info('User with id '.$user_id.' inserted by admin at '.$this->created_at);
        return $user_id;
    }

    public function getById(){
        return DB::table('user')
            ->where('id','=',$this->id)
            ->select('id','role_id','first_name','last_name','email')
            ->first();
    }
}