<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;

session_start();

class aHandler extends Controller
{
    function approveDoctor(Request $req) {
        // return $req->input();
        $con = new mongo;
        $db = $con->php_mongo;

        $id = $req->input('id');

        $collection = $db->admin;
        $collection->updateOne(
            ['a_unid' => strval($_SESSION['a_unid'])],
            ['$pull' => ['pendingDoc_ids' => strval($id) ]]
        );
        $collection->updateOne(
            ['a_unid' => strval($_SESSION['a_unid'])],
            ['$push' => ['doc_ids' => strval($id) ]]
        );


        $collection = $db->manager;
        $collection->updateOne(
            ['d_unid' => strval($id)],
            ['$set' =>['approved' => true, 'login_able' => true]]
        );
        $r = $collection->findOne(['d_unid' => strval($id)]);
        $fname = $r['fname'];
        $email = $r['email'];
        include(app_path().'/email/doc_approval_email.php');
        // include '../../../controller/php/email/doc_approval_email.php';
        if($send == true) {
            echo 'true';
        }
        else {
            echo 'false';
        }

    }

    function loginEnable(Request $req) {
        // return $req->input();
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;

        $id = $req->input('id');

        $collection->updateOne(
            ['d_unid' => strval($id)],
            ['$set' =>['login_able' => true]]
        );

    }

    function loginDisable(Request $req) {
        // return $req->input();
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;

        $id = $req->input('id');

        $collection->updateOne(
            ['d_unid' => strval($id)],
            ['$set' =>['login_able' => false]]
        );

    }
}
