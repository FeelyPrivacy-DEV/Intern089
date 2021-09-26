<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;



class afterLogin
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
        
        if($request->session()->has('d_unid') != '') {
            return redirect('/d');
        }
        else if($request->session()->has('p_unid') != '') {
            return redirect('/p');
        }
        else if($request->session()->has('a_unid') != '') {
            return redirect('/a/dashboard');
        }

        return $next($request);
    }
}
