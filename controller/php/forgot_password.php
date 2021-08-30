<?php

error_reporting(0);
require '../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
$db = $con->php_mongo;

if(isset($_POST['doc_forgot'])) {
    $collection = $db->manager;

    $email = $_POST['email'];

    $record = $collection->findOne( [ 'email' =>$email ]);  

    if($record['_id'] != null) {
        include './email/doc_forgot_email.php';
        if($send == true) {
            echo 'true';
        }
        else {
            echo 'notSent';
        }
    }   
    else {
        echo 'Account not found';
    }
  
}
else if(isset($_POST['pat_forgot'])) {
    $collection = $db->employee;

    $email = $_POST['email'];

    $record = $collection->findOne( [ 'email' =>$email ]);  

    if($record['_id'] != null) {
        include './email/pat_forgot_email.php';
        if($send == true) {
            echo 'true';
        }
        else {
            echo 'notSent';
        }
    }   
    else {
        echo 'Account not found';
    }

}
else if(isset($_POST['change_pass_pat'])) { 
    $collection = $db->employee;
    $pass = $_POST['new_pass'];
    $token = $_POST['token'];

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $r = $collection->updateOne(
        ['gen_info.reset_token.token'=> $token],
        ['$set'=>['password'=> $hash]]
    );
    // print_r($r);
    $record = $collection->findOne(['gen_info.reset_token.token'=> $token]);
    include './email/pat_reset_email.php';
    if($send == true) {
        echo 'true';
    }
    else {
        echo 'notSent';
    }
 
}
else if(isset($_POST['change_pass_doc'])) { 
    $collection = $db->manager;
    $pass = $_POST['new_pass'];
    $token = $_POST['token'];

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $r = $collection->updateOne(
        ['gen_info.reset_token.token'=> $token],
        ['$set'=>['password'=> $hash]]
    );
    // print_r($r);
    $record = $collection->findOne(['gen_info.reset_token.token'=> $token]);
    include './email/doc_reset_email.php';
    if($send == true) {
        echo 'true';
    }
    else {
        echo 'notSent';
    }

}





?>