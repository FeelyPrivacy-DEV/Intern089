<?php

error_reporting(0);
session_start();
require './vendor/autoload.php';
$con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
$db = $con->php_mongo;
$auth_msg = ''; 

if($_GET['auth'] == 'failed') {
    $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Wrong Credentials !</strong> Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
}
else if($_GET['login'] == 'now') {
    $auth_msg = '<div class="alert alert-success alert-dismissible fade show " role="alert">
                    <strong>Your account created successfully !</strong> Login Now !
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
}
else if($_GET['c'] == 'e') {
    $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Pleace verify captcha f**king bi**h !</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
}

?>


<!doctype html>
<html lang="en">

<head>
    <?php include './assest/top_links.php'; ?>
    <title>Scheduld yourself !</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class='navbar-brand text-light mx-4' href='https://test.feelyprivacy.com/s/'>
                <img src="https://test.feelyprivacy.com/s/public/image/logo.png" height="60" alt="" srcset="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://test.feelyprivacy.com/s/index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://test.feelyprivacy.com/s/index">Doctor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://test.feelyprivacy.com/s/p">Patient</a>
                    </li>
                </ul>
                <a href="https://test.feelyprivacy.com/s/index" class='btn btn-outline-primary text-primary px-3 py-2 mx-5'>LOGIN
                    /
                    SIGNUP</a>
            </div>
        </div>
    </nav>

    <?php echo $auth_msg; ?>


    <div class="container formcont my-5">
        <div class="reg_cont d-flex justify-content-center">
            <div class="img my-auto mx-4">
                <img src="https://test.feelyprivacy.com/s/public/image/login-banner.png" class="bnar" height="300" alt="" srcset="">
            </div>
            <div class="forms mx-4">
                <div class="reg" id="patreg">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Patient Register</h5>
                        <a href="https://test.feelyprivacy.com/s/index">Not a Patient ?</a>
                    </div>
                    <form class="container needs-validation" action="https://test.feelyprivacy.com/s/controller/php/signup.php"
                        method="POST">
                        <div class="d-flex justify-content-between">
                            <div class="mb-3 mx-1">
                                <!-- <label for="email" class="form-label">First Name</label> -->
                                <input type="text" class="form-control py-2" name="fname" id="fname"
                                    placeholder="First Name" required>
                                
                            </div>
                            <div class="mb-3 mx-1">
                                <!-- <label for="email" class="form-label">Last Name</label> -->
                                <input type="text" class="form-control py-2" name="sname" id="sname"
                                    placeholder="Last Name" required>
                                
                            </div>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="number" class="form-label">Patient ID</label> -->
                            <input type="text" name="empid" class="form-control py-2" id="empsid"
                                aria-describedby="empid" placeholder="Create Username " required>
                            
                        </div>
                        <div class="mb-3">
                            <!-- <label for="email" class="form-label">Email Address</label> -->
                            <input type="email" name="email" class="form-control py-2" id="empsemail"
                                placeholder="Enter Email Address" required aria-describedby="email">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" name="pass" class="form-control py-2" id="empspass"
                                placeholder="Create Password" required aria-describedby="password">
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="h-captcha" data-sitekey="8840d1d7-bfeb-4979-b86b-5223d5ad79f9" required></div>
                        </div>
                        <button class="btn m-0 fw-bold p-0 text-primary al-p" type="button">Login ?</button>
                        <div class="d-grid gap-2 my-3">
                            <button type="submit" name="employee_signup" class="btn btn-primary py-2">Create
                                Account password less</button>
                        </div>
                    </form>
                </div>
                <div class="log" id="patlog">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Patient Login</h5>
                        <a href="https://test.feelyprivacy.com/s/index">Not a Patient ?</a>
                    </div>
                    <form class=" container e_log_form" action="https://test.feelyprivacy.com/s/controller/php/login.php"
                        method="POST">
                        <div class="mb-3">
                            <!-- <label for="number" class="form-label">Patient ID</label> -->
                            <input type="number" name="empid" class="form-control py-3" id="log_empid" required
                                placeholder="Username" aria-describedby="empid">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" name="pass" class="form-control py-3" id="log_pass" required
                                placeholder="Password" aria-describedby="password">
                        </div>
                        <button class="btn m-0 p-0 fw-bold text-primary al-p" type="button">Create Account ?</button>
                        <div class="d-grid gap-2 my-5">
                            <button type="submit" class="btn btn-primary py-2" name="employee_login">Log Inpassword less</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <?php include './assest/bottom_links.php'; ?>
    <script src='https://test.feelyprivacy.com/s/controller/js/index.js?ver=1.3'></script>

</body>

</html>