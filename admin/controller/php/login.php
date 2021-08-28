
<?php

require '../../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
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
            header('location: https://test.feelyprivacy.com/s/admin/view/index');
            exit();
        }
        else {
            header('location: https://test.feelyprivacy.com/s/admin/index?auth=failed');
        }
    }
    else {
        header('location: https://test.feelyprivacy.com/s/admin/index?auth=failed');
    }


}

?>