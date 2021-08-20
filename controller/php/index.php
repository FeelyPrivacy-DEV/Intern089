<?php

session_start(); 
require '../../vendor/autoload.php';
    $con = new MongoDB\Client( 'mongodb://test.com:27017' );
    $db = $con->php_mongo; $collection = $db->manager;


    if(isset($_POST['search'])) {
        $sq = $_POST['sq'];


        $r = $collection->find(['fname' => $sq]);
        print_r($r['fname']);

    }




        
?>