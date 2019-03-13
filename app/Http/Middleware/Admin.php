<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if(!session()->has('user')) return redirect('/');
        $user = session()->get('user');
        if($user->role_id != 1 || $user->user_role_name != "admin") abort(404);
        return $next($request);
    }
}
