<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class loginPage
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

        if($req->session()->has('email')=='') {
            return redirect('/');
        }

        if($req->session()->has('email') != '') {

            return url()->previous();
        }

        return $next($req);
    }
}
