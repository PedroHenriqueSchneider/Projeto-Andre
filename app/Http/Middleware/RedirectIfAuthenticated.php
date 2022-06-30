<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use DB;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $ultimo_login = DB::table('users')->select('email')->where('last_login_at', null);
        $user = auth()->user();
        if (Auth::guard($guard)->check()) {
            if($user->email == $ultimo_login) {
                return redirect('verify.index');
            }
            else{
                return redirect('/home');
            }
        }

        return $next($request);
    }
}
