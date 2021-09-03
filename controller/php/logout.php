<?php

    if(isset($_POST['logout'])) {
        
        session_start();
        unset($_SESSION['email']);
        unset($_SESSION['fname']);
        unset($_SESSION['sname']);
        unset($_SESSION['d_unid']);
        unset($_SESSION['p_unid']);
        unset($_SESSION['eid']);
        unset($_SESSION['docid']);
        unset($_SESSION['loggedin']);
        session_unset();
        session_destroy(); 
        header("location: https://test.feelyprivacy.com/s/");
        exit();

    }

 
?>