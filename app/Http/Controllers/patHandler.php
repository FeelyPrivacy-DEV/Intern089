<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;

session_start();

class patHandler extends Controller {

    function proToPay(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;

        // print_r($req->input());
        $date = $req->input('date');
        $doc_id = $req->input('doc_id');
        $s_time = $req->input('s_time');
        $e_time = $req->input('e_time');


        $collection = $db->manager;
        $drecord = $collection->findOne(['d_unid' => $doc_id]);
        include(app_path().'/email/pat_doc_book_email.php');
        if($send == true) {
            include(app_path().'/email/pat_book_email.php');
            if($send == true) {
                $collection = $db->employee;
                $r = $collection->updateMany(
                    ['p_unid' => $_SESSION['p_unid']],
                    ['$push' =>['datetime.'.$doc_id.'.'.$date=> ['d_stamp' => date('Y-m-d'), 'status' => '', 'video_link' => '', 'amt' => '$120', 'p_name' => $_SESSION['fname'], 'book_t' =>[$s_time, $e_time]]]]
                );

                $collection = $db->manager;
                $collection->updateOne(
                    ['d_unid' => $doc_id],
                    ['$addToSet' =>['p_unid' => $_SESSION['p_unid']]]
                );

                $collection = $db->check;
                $crecord = $collection->updateOne(
                    ['fname' => 'check_datetime'],
                    ['$push' =>['datetime.'.$doc_id.'.'.$date => [$s_time, $e_time]]]
                );

                return url('/p/checkout', ['doc_id'=>$doc_id, 'date'=>$date, 'time'=>date('h-i', strtotime($s_time))]);
            }
            else {
                $msg = 'email not send to patient';
                return  $msg;
            }
        }
        else {
            $msg = 'email not send to anyone';
            return  $msg;
        }


    }


    // change password inbuilt
    function chPasswordPat(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->employee;

        $old = $req->input('old');
        $newPass = $req->input('newPass');

        $r = $collection->findOne(['p_unid' => $_SESSION['p_unid']]);
        $p = password_verify($old, $r['password']);
        if($p) {
            $hash = password_hash( $newPass, PASSWORD_DEFAULT );
            $r = $collection->updateOne(
                ['p_unid' => $_SESSION['p_unid']],
                ['$set' =>['password' => $hash]]
            );
            return 'true';
        }
        else {
            return 'false';
        }
    }
}
