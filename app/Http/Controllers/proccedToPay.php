<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;

class proccedToPay extends Controller {

    public function proToPay(Request $req) {
        // print_r($req->input());



        $date = $req->input('date');
        $doc_id = $req->input('doc_id');
        $s_time = $req->input('s_time');
        $e_time = $req->input('e_time');
        $eid = $req->input('eid');

        $con = new mongo;
        $db = $con->php_mongo;

        $collection = $db->employee;
        // $r = $collection->findOne(['d_unid'=> $doc_id]);
        $r = $collection->updateMany(
            ['p_unid' => $_SESSION['p_unid']],
            ['$push' =>['datetime.'.$doc_id.'.'.$date=> ['d_stamp' => date('Y-m-d'), 'status' => '', 'amt' => '$120', 'p_name' => $_SESSION['fname'], 'book_t' =>[$s_time, $e_time]]]]
        );

         print_r($r);

        // $drecord = $collection = $db->manager;
        // $collection->findOne(['d_unid' => $doc_id]);
        // $collection->updateOne(
        //     ['d_unid' => $doc_id],
        //     ['$addToSet' =>['p_unid' => $_SESSION['p_unid']]]
        // );

        // $collection = $db->check;
        // $crecord = $collection->updateOne(
        //     ['c_unid' => '429570412'],
        //     ['$push' =>['datetime.'.$date => [$s_time, $e_time]]]
        // );

        // include(app_path().'/email/pat_doc_book_email.php');
        // if($send == true) {
        //     include(app_path().'/email/pat_book_email.php');
        //     if($send == true) {
        //         echo 'true';
        //     }
        //     else {
        //         echo 'false1';
        //     }
        //     // header( 'location: http://127.0.0.1/s/s/p?login=now' );
        // }
        // else {
        //     echo 'false2';
        // }


    }

}
