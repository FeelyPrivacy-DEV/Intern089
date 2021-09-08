<?php

namespace App\Http\Middleware;

use Closure;

// use Session;
use Illuminate\Http\Request;


class checkLogin
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

        if($req->session()->has('d_unid')=='' && $req->session()->has('p_unid')=='') {
            return redirect('/');
        }
        // else {
        //     if($req->session()->get('d_unid') != '' ) {
        //         return redirect('/d');
        //     }
        //     else {
        //         if($req->session()->get('p_unid')!='') {
        //             return redirect('/p');
        //         }
        //     }
        // }
        return $next($req);
    }
}
