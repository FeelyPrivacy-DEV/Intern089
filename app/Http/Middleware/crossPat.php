<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class crossPat
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
        if($request->session()->has('p_unid') != '') {
            return redirect('/p');
        }

        return $next($request);
    }
}
