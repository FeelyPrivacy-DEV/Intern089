<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;

session_start();

class aHandler extends Controller
{
    // get pending doctor list from database
    function get_pend_doc(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;
        $record_doc = $collection->find();

        foreach($record_doc as $each) {
            if($each['approved'] == false) {
                echo '<tr class="py-3" id="trid'.$each['d_unid'].'">';
                echo '<td class="d-flex justify-content-start text-left">Dr. '.$each['fname'].' '.$each['sname'].'</td>
                        <td>'.$each['gen_info']['member_since'].'</td>
                        <td>'.$each['email'].'</td>';

                echo '<td>
                        <div class="switch_box box_1">
                            <input type="checkbox" class="switch_1"  onchange="AllowIt(\''.$each['d_unid'].'\')" id="checkAllow'.$each['d_unid'].'" value="0">
                        </div>
                    </td>';
                    if($each['under_review'] == false) {
                        echo '<td>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_2"  onchange="UnderReview(\''.$each['d_unid'].'\')" id="UnderReview'.$each['d_unid'].'">
                                </div>
                            </td>';
                    }else {
                        echo '<td>
                                <div class="switch_box box_1">
                                    <input type="checkbox" class="switch_2"  onchange="removeUnderReview(\''.$each['d_unid'].'\')" id="removeUnderReview'.$each['d_unid'].'" checked>
                                </div>
                            </td>';
                    }
                echo '<td>
                        <div class="switch_box box_1">
                            <input type="checkbox" class="switch_3"  onchange="Reject(\''.$each['d_unid'].'\')" id="checkReject'.$each['d_unid'].'" value="0">
                        </div>
                    </td>';


                echo '</tr>';
            }
        }
    }

    // adding doctor to under review
    function UnderReviewDoctor(Request $req) {
        // return $req->input();
        $con = new mongo;
        $db = $con->php_mongo;
        $msg = 'You are under review';
        $id = $req->input('id');

        $collection = $db->manager;
        $collection->updateOne(
            ['d_unid' => strval($id)],
            ['$set' =>['under_review' => true]]
        );
        $r = $collection->findOne(['d_unid' => strval($id)]);
        $fname = $r['fname'];
        $email = $r['email'];
        include(app_path().'/email/doc_under_review_email.php');
        // include '../../../controller/php/email/doc_approval_email.php';
        if($send == true) {
            echo 'true';
        }
        else {
            echo 'false';
        }

    }

    // removing doctor from under review
    function removeUnderReview(Request $req) {
        // return $req->input();
        $con = new mongo;
        $db = $con->php_mongo;

        $msg = 'Our admin has removed you from under review';
        $id = $req->input('id');

        $collection = $db->manager;
        $collection->updateOne(
            ['d_unid' => strval($id)],
            ['$set' =>['under_review' => false]]
        );
        $r = $collection->findOne(['d_unid' => strval($id)]);
        $fname = $r['fname'];
        $email = $r['email'];
        include(app_path().'/email/doc_under_review_email.php');
        // include '../../../controller/php/email/doc_approval_email.php';
        if($send == true) {
            echo 'true';
        }
        else {
            echo 'false';
        }

    }

    // adding doctor to reject list
    function RejectDoctor(Request $req) {
        // return $req->input();
        $con = new mongo;
        $db = $con->php_mongo;
        $msg = 'for some reason you are rejected !';
        $id = $req->input('id');

        $collection = $db->manager;
        $r = $collection->findOne(['d_unid' => strval($id)]);
        $fname = $r['fname'];
        $email = $r['email'];
        include(app_path().'/email/doc_approval_email.php');
        // include '../../../controller/php/email/doc_approval_email.php';
        if($send == true) {
            $collection = $db->admin;
            $collection->updateOne(
                ['a_unid' => strval($_SESSION['a_unid'])],
                ['$pull' => ['pendingDoc_ids' => strval($id) ]]
            );
            $collection->updateOne(
                ['a_unid' => strval($_SESSION['a_unid'])],
                ['$push' => ['reject_doc' => strval($id) ]]
            );

            $collection = $db->manager;
            $collection->updateOne(
                ['d_unid' => strval($id)],
                ['$set' =>['reject_doc' => true]]
            );
            echo 'true';
        }
        else {
            echo 'false';
        }



    }

    // removing doctor from reject list
    function removeRejectDoctor(Request $req) {
        // return $req->input();
        $con = new mongo;
        $db = $con->php_mongo;
        $msg = 'you are remove from reject list !';
        $id = $req->input('id');

        $collection = $db->manager;
        $r = $collection->findOne(['d_unid' => strval($id)]);
        $fname = $r['fname'];
        $email = $r['email'];
        include(app_path().'/email/doc_approval_email.php');
        // include '../../../controller/php/email/doc_approval_email.php';
        if($send == true) {
            $collection = $db->admin;
            $collection->updateOne(
                ['a_unid' => strval($_SESSION['a_unid'])],
                ['$pull' => ['reject_doc' => strval($id) ]]
            );
            $collection->updateOne(
                ['a_unid' => strval($_SESSION['a_unid'])],
                ['$push' => ['pendingDoc_ids' => strval($id) ]]
            );

            $collection = $db->manager;
            $collection->updateOne(
                ['d_unid' => strval($id)],
                ['$set' =>['reject_doc' => false]]
            );
            echo 'true';
        }
        else {
            echo 'false';
        }



    }

    // doctor approval
    function approveDoctor(Request $req) {
        // return $req->input();
        $con = new mongo;
        $db = $con->php_mongo;
        $msg = 'Welcome !, you are approved !';
        $id = $req->input('id');

        $collection = $db->admin;
        $collection->updateOne(
            ['username' => 'admin'],
            ['$pull' => ['pendingDoc_ids' => strval($id) ]]
        );
        $collection->updateOne(
            ['username' => 'admin'],
            ['$push' => ['doc_ids' => strval($id) ]]
        );


        $collection = $db->manager;
        $collection->updateOne(
            ['d_unid' => strval($id)],
            ['$set' =>['approved' => true, 'login_able' => true, 'under_review' => true]]
        );
        $r = $collection->findOne(['d_unid' => strval($id)]);
        $fname = $r['fname'];
        $email = $r['email'];
        // include(app_path().'/email/doc_approval_email.php');
        // include '../../../controller/php/email/doc_approval_email.php';
        // if($send == true) {
            echo 'true';
        // }
        // else {
        //     echo 'false';
        // }

    }

    // doctor login enablig
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

    // doctor login disabling
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
