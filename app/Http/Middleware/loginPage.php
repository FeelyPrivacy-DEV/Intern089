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
        echo 'loginPAge';
        echo $req->session()->get('email');
        echo '<br>';
        echo $req->session()->get('d_unid');
        echo '<br>';
        echo $req->session()->get('p_unid');

        if($req->session()->has('email')=='') {
            return redirect('/');
        }

        if($req->session()->has('email')!='') {
            // return redirect('/');

            return url()->previous();
        }
        // else {
            // if($req->session()->has('d_unid') != '' || $req->session()->has('p_unid') =='') {
            //     return redirect('/d');
            // }
            // else {
            //     if($req->session()->has('d_unid')==''|| $req->session()->has('p_unid') != '') {
            //         return redirect('/p');
            //     }
            //     else {
            //         return view('index');
            //     }
            // }
        // }
        return $next($req);
    }
}
