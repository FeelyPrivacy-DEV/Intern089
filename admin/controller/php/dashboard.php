<?php

use function Psy\debug;

require '../../../vendor/autoload.php';
session_start();
$con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
$db = $con->php_mongo;
$collection = $db->manager;



if(isset($_POST['check1'])) {
    $id = $_POST['id'];
    
    $collection->updateOne(
        ['d_unid' => strval($id)],
        ['$set' =>['login_able' => false]]
    );
    
}
else if(isset($_POST['check2'])) {
    $id = $_POST['id'];
    
    $collection->updateOne(
        ['d_unid' => strval($id)],
        ['$set' =>['login_able' => true]]
    );
    
}
else if(isset($_POST['allowit'])) {
    $id = $_POST['id'];
    
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
    include '../../../controller/php/email/doc_approval_email.php';
    if($send == true) {
        // echo 'true';
    }
    else {
        // echo 'false';
    }
}
else if(isset($_POST['del'])) {

    $i = $_POST['id'];
    $d = strval('2021-08-20');

    $r = $collection->deleteOne(
        ['d_unid'=> strval($i)],
        ['datetime.'.$d =>['0' => '1']]
    );

    echo '<pre>';
    print_r($r);

}















?>