<?php

require '../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com:27017' );
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
                    header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/view/d/index');
                    exit();
                }
                else {
                    header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/d?login=disable');
                }
            }
            else {
                header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/d?auth=disable');
            }
        }
        else {
            header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/d?auth=failed');
        }
    }
    else {
        header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/d?auth=failed');
    }
 
}
else if(isset($_POST['employee_login'])) {
    $collection = $db->employee;

    $empid = $_POST['empid'];
    $pass = $_POST['pass'];

    $record = $collection->findOne( [ 'empid' =>$empid ]);  

    if($record) {
        if(password_verify( $pass, $record['password'])) {
            session_start();
            $_SESSION['eid'] = $record['_id'];
            $_SESSION['email'] = $record['email'];
            $_SESSION['fname'] = $record['fname'];
            $_SESSION['sname'] = $record['sname'];
            $_SESSION['p_unid'] = $record['p_unid'];
            header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/view/p/index');
            exit();
        }
        else {
            header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/p?auth=failed');
        }
    }
    else {
        header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/p?auth=failed');
    }


}






?>