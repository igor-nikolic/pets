<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 3/14/19
 * Time: 1:51 AM
 */

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Poll
{
    public $ipAddress;
    public $vote;

    public function checkIfVoted(){
        return DB::table('poll')
            ->where('ip_address','=',$this->ipAddress)
            ->first();
    }
    public function vote(){
        return DB::table('poll')
            ->insertGetId([
                'ip_address'=>$this->ipAddress,
                'vote'=>$this->vote
            ]);
    }

    public function count($counter){
        return DB::table('poll')
            ->where('vote','=',$counter)
            ->count();
    }
    public function countAll(){
        return DB::table('poll')
            ->count();
    }
}