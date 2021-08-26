
<?php

use MongoDB\Exception\Exception;

require '../../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongod://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com:27017' );
$db = $con->php_mongo; 

try {

    if(isset($_POST['ad_signup'])) {
        $collection = $db->admin;

        $pass = $_POST['pass'];
        $hash = password_hash( $pass, PASSWORD_DEFAULT );
        $a_unid = strval(rand());
        $pendingDoc_ids = [];
        $doc_ids = [];
        $pat_ids = [];

        $collection->insertOne( [
            'a_unid' => $a_unid,
            'fname' => $_POST['fname'], 
            'username' => $_POST['uname'], 
            'email' => $_POST['email'], 
            'password' => $hash, 
            'profile_image' => '',
            'pendingDoc_ids' => $pendingDoc_ids,
            'pat_ids' => $pat_ids,
            'doc_ids' => $doc_ids,
        ] );
        
        header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/index?login=now');
        // echo 'Account created success';

    }
} catch(Exception $e) {
    print_r($e);
}



?>