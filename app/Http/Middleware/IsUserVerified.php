<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class IsUserVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('web')->user()->status == 0 ||Auth::guard('web')->user()->status == null||Auth::guard('web')->user()->status == '0'){
            Auth::guard('web')->logout();
            Alert::error('Email Is Not Verified','You need to confirm your account, We have sent an activation link to your email, please check your email!');
            return redirect()->route('user.login');
        }
        return $next($request);
    }
}
