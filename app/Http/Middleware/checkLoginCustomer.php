<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Support\Facades\DB;
class checkLoginCustomer
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
        if(Auth::check()){
            return $next($request);
        }
        else
        {
            return view('page.dangnhap');
        }
    }
}
