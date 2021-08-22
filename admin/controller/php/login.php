
<?php

require '../../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://143.244.139.242:27017' );
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
            header('location: http://143.244.139.242/s/admin/view/index');
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