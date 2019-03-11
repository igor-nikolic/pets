<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class PetEditMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $petId = (int) $request->route()->parameter('pet');
        $userId = $request->session()->get('user')->user_id;
        $pet = DB::table('pet')
            ->where('id','=',$petId)
            ->first();
        if(!$pet) return redirect()->back();
        if($pet->user_id !== $userId) return redirect('/pets/'.$petId);
        return $next($request);
    }
}
