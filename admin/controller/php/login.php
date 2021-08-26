
<?php

require '../../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com:27017' );
$db = $con->php_mongo; 


if(isset($_POST['a_login'])) {
    $collection = $db->admin;

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $record = $collection->findOne( [ 'email' =>$email ]);  

    if($record) {
        if(password_verify( $pass, $record['password'])) {
            session_start();
            $_SESSION['aid'] = $record['_id'];
            $_SESSION['a_unid'] = $record['a_unid'];
            $_SESSION['fname'] = $record['fname'];
            header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/view/index');
            exit();
        }
        else {
            header('location: ../../?auth=failed');
        }
    }
    else {
        header('location: ../../?auth=failed');
    }


}

?>