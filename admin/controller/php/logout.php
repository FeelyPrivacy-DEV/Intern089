<?php

    if(isset($_POST['logout'])) {
        
        session_start();
        unset($_SESSION['fname']);
        unset($_SESSION['a_unid']);
        unset($_SESSION['aid']);
        session_unset();
        session_destroy(); 
        header("location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/index");
        exit();

    }


?>