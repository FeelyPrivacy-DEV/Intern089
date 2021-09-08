<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminCheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $req, Closure $next)
    {
        if($req->session()->has('aemail')=='') {
            return redirect('/a-login');
        }
        return $next($req);
    }
}
