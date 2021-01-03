<?php

namespace App\Http\Middleware;

use Closure,Auth;
use Illuminate\Http\Request;

class VerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->email_verified_at == null){
            return redirect('/login')->with('error','Verify your account first');
        }
        return $next($request);
    }
}
