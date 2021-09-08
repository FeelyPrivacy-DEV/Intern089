<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;




class logout extends Controller {

    public function logout(Request $req) {

        session_start();
        unset($_SESSION['email']);
        unset($_SESSION['fname']);
        unset($_SESSION['sname']);
        unset($_SESSION['d_unid']);
        unset($_SESSION['p_unid']);
        unset($_SESSION['eid']);
        unset($_SESSION['docid']);
        unset($_SESSION['loggedin']);
        $req->session()->forget('aemail');
        $req->session()->forget('email');
        $req->session()->forget('d_unid');
        $req->session()->forget('p_unid');
        $req->session()->flush();
        session_unset();
        session_destroy();
        return redirect('/');
        // header("location: http://127.0.0.1/s/s/");
        die();

    }

}
