<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;

class aAuth extends Controller
{

    // admin login 
    function logAdmin(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->admin;
        $email = $req->input('admin_login_email');
        $pass = $req->input('admin_login_pass');
        $record = $collection->findOne( [ 'email' =>$email ]);
        if($record) {
            if(password_verify( $pass, $record['password'])) {
                session_start();
                $req->session()->put('aemail', $record['email']);
                // $req->session()->put('a_unid', $record['a_unid']);
                $_SESSION['aid'] = $record['_id'];
                // $_SESSION['a_unid'] = $record['a_unid'];
                $_SESSION['fullname'] = $record['fullname'];
                return 'true';
                die();
            }
            else {
                return 'pfalse';
                die();
            }
        }
        else {
            return 'efalse';
            die();
        }
    }

    function newAdmin(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->admin;

        $fullname = $req->input('admin_register_fname');
        $email = $req->input('admin_register_email'); 
        $pass = $req->input('admin_register_pass'); 
        $record = $collection->findOne( [ 'email' =>$email ]);
        if(!$record) {
           
            $collection->insertOne([
                'username' => 'admin',
                'fullname' => $fullname,
                'email' => $email,
                'password' => password_hash( $pass, PASSWORD_DEFAULT ),
                'pendingDoc_ids' => array(),
                'pat_ids' => array(),
                'doc_ids' => array(),

            ]);
            return 'true';
        }
        else {
            return 'emailExist';
            die();
        }
    }
}
