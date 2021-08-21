<?php

require '../../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://test.com:27017' );
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

    $collection->updateOne(
        ['d_unid' => strval($id)],
        ['$set' =>['approved' => true, 'login_able' => true]]
    );

    $collection = $db->admin;
    $collection->updateOne(
        ['a_unid' => '1123498786'],
        ['$pull' => ['pendingDoc_ids' => $id ]]
    );
    echo $collection->updateOne(
        ['a_unid' => '1123498786'],
        ['$push' => ['doc_ids' => strval($id) ]]
    );


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