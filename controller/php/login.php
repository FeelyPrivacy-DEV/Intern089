<?php

require '../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
$db = $con->php_mongo;

if(isset($_POST['manager_login'])) {
    $collection = $db->manager;

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $record = $collection->findOne( [ 'email' =>$email ]);  

    if($record) {
        if(password_verify( $pass, $record['password'])) {
            if($record['approved'] == true) {
                if($record['login_able'] == true) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['docid'] = $record['_id'];
                    $_SESSION['email'] = $record['email'];
                    $_SESSION['d_unid'] = $record['d_unid'];
                    $_SESSION['fname'] = $record['fname'];
                    $_SESSION['sname'] = $record['sname'];
                    header('location: http://143.244.139.242/s/view/d/index');
                    exit();
                }
                else {
                    header('location: http://143.244.139.242/s/index?login=disable');
                }
            }
            else {
                header('location: http://143.244.139.242/s/index?auth=disable');
            }
        }
        else {
            header('location: http://143.244.139.242/s/index?auth=failed');
        }
    }
    else {
        header('location: http://143.244.139.242/s/index?auth=failed');
    }
 
}
else if(isset($_POST['employee_login'])) {
    $collection = $db->employee;

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $record = $collection->findOne( [ 'email' =>$email ]);  

    if($record) {
        if(password_verify( $pass, $record['password'])) {
            session_start();
            $_SESSION['eid'] = $record['_id'];
            $_SESSION['email'] = $record['email'];
            $_SESSION['fname'] = $record['fname'];
            $_SESSION['sname'] = $record['sname'];
            $_SESSION['p_unid'] = $record['p_unid'];
            header('location: http://143.244.139.242/s/view/p/index');
            exit();
        }
        else {
            header('location: http://143.244.139.242/s/p?auth=failed');
        }
    }
    else {
        header('location: http://143.244.139.242/s/p?auth=failed');
    }


}






?>