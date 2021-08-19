
<?php

require '../../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://localhost:27017' );
$db = $con->php_mongo; 


if(isset($_POST['ad_signup'])) {
    $collection = $db->admin;

    $pass = $_POST['pass'];
    $hash = password_hash( $pass, PASSWORD_DEFAULT );
    $a_unid = strval(rand());

    $collection->insertOne( [
        'a_unid' => $a_unid,
        'fname' =>$_POST['fname'], 
        'username' =>$_POST['uname'], 
        'email' =>$_POST['email'], 
        'password' =>$hash, 
        'profile_image' => ''
    ] );
    
    header('location: http://localhost/s/s/admin/index?login=now');
    // echo 'Account created success';

}



?>