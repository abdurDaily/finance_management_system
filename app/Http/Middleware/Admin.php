<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->status == 1){
                return $next($request);
            }
            else{
                Auth::logout();
                return redirect()->route('login')->with('error', 'It was successfully registered. now please wait until an admin approves!');;
            }
        }
        else{
            return redirect()->route('login');
        }
    }
}
