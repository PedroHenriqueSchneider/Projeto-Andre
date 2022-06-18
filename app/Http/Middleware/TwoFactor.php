<?php

namespace App\Http\Middleware;

use Closure;

class TwoFactor
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
        $user = auth()->user();

        if(auth()->check() && $user->two_factor_code)
        {
            if($user->two_factor_expires_at<now()) //expired
            {
                $user->resetTwoFactorCode();
                auth()->logout();

                return redirect()->route('login')
                ->withMessage('O código multifator expirou. Por favor, faça login novamente.');
            }

            if(!$request->is('verify*')) //prevent enless loop, otherwise send to verify
            {
                return redirect()->route('verify.index');
            }
        }

        return $next($request);
    }
}
