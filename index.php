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
    else if($_GET['login'] == 'wait') {
        $auth_msg = '<div class="alert alert-success alert-dismissible fade show " role="alert">
                        <strong>Your account created </strong> and under review ! Please check email.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    if($_GET['auth'] == 'disable') {
        $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                        <strong>Your Account is not verified yet !</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    else if($_GET['login'] == 'disable') {
        $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                        <strong>Your account has been disbaled by admin !</strong> 
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
    <title>Feely | Register</title>
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

    <?php
        // require 'vendor/autoload.php';
        // use Auth0\SDK\Auth0;
        
        // $auth0 = new Auth0([
        // 'domain' => 'dev-83yti7ke.us.auth0.com',
        // 'client_id' => 'wxoAs08d4cn6d5XsJXRVtvUKUrZg96lx',
        // 'client_secret' => 'cN2pt5bJtf1qSI5-Nc7LIDtdQOETadbAxUxbjCREA8kw1mRxt6c-0gEA1yVbNct1',
        // 'redirect_uri' => 'https://test.feelyprivacy.com/s/index',
        // 'scope' => 'openid profile email',
        // ]);

        // $userInfo = $auth0->getUser();

        // if (!$userInfo) {
        //     echo 'we have no users';
        // } else {
        //     echo 'users is here :- '. $userInfo;
        // }


        // $userInfo = $auth0->getUser();
        // printf( 'Hello %s!', htmlspecialchars( $userInfo['name'] ) );
    
    ?>
    <!-- <a class="btn btn-primary" href="login.php">Log In</a> -->
    <div class="container formcont my-5">
        <div class="reg_cont d-flex justify-content-center">
            <div class="img my-auto mx-4">
                <img src="https://test.feelyprivacy.com/s/public/image/login-banner.png" class="bnar" height="300" alt="" srcset="">
            </div>
            
            <div class="forms mx-4">
                <div class="reg" id="docreg">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Doctor Register</h5>
                        <!-- <a href="https://test.feelyprivacy.com/s/p">Not a Doctor ?</a> -->
                    </div>
                    <form class="container needs-validation" action="https://test.feelyprivacy.com/s/controller/php/signup.php"
                        method="POST">
                        <div class="d-flex justify-content-between">
                            <div class="mb-3 mx-1">
                                <!-- <label for="email" class="form-label">First Name</label> -->
                                <input type="text" class="form-control py-2" name="fname" id="fname"
                                    placeholder="First Name" required>
                            </div>
                            <div class="mb-4 mx-1">
                                <!-- <label for="email" class="form-label">Last Name</label> -->
                                <input type="text" class="form-control py-2" name="sname" id="sname"
                                    placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <!-- <label for="email" class="form-label">Email Address</label> -->
                            <input type="email" class="form-control py-2" name="email" id="msemail"
                                aria-describedby="email" placeholder="Email Address" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-4">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" class="form-control py-2" name="pass" id="mspas"
                                placeholder="Create Password " required aria-describedby="password">
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="h-captcha" data-sitekey="8840d1d7-bfeb-4979-b86b-5223d5ad79f9" required></div>
                        </div>
                        
                            <button class="btn m-0 p-0 fw-bold text-primary al-r" id="d_log" type="button">Login </button>
                            
                        
                        <div class="d-grid gap-2 my-3">
                            <button type="submit" class="btn btn-primary py-2" name="manager_signup">Create
                                Account</button>
                            <!-- <button type="submit" class="btn btn-primary py-2" name="manager_signup">Create
                                Account Password less</button> -->
                        </div>
                    </form>
                </div>
                <div class="log" id="doclog">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Doctor Login</h5>
                        <!-- <a href="https://test.feelyprivacy.com/s/p">Not a Doctor ?</a> -->
                    </div>
                    <form class="container e_log_form" action="https://test.feelyprivacy.com/s/controller/php/login.php"
                        method="POST">
                        <div class="mb-4">
                            <!-- <label for="email" class="form-label">Email Address</label> -->
                            <input type="email" name="email" class="form-control py-3" id="log_empid"
                                placeholder="Email Address" required aria-describedby="empid">
                        </div>
                        <div class="mb-4">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" name="pass" class="form-control py-3" id="log_pass"
                                placeholder="Enter Password" required aria-describedby="password">
                        </div>
                        <div class="d-flex justify-content-between cf">
                            <button class="btn m-0 fw-bold p-0 text-primary" id="d_ca"  type="button">Create Account </button>
                            <button class="btn m-0 p-0 fw-bold text-primary" id="d_for" type="button">Forgot Password</button>
                        </div>
                        <div class="d-grid gap-2 my-5">
                            <button type="submit" class="btn btn-primary py-2" name="manager_login">Log in </button>
                        </div>
                    </form>
                </div>
                <div class="forgot" id="docforgot">
                    <h6 class="text-center text-nowrap" id="for_warn"></h6>
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Doctor Forgot Password</h5>
                        <!-- <a href="https://test.feelyprivacy.com/s/p">Not a Doctor ?</a> -->
                    </div>
                    <div class="container e_log_form">
                        <div class="mb-4">
                            <!-- <label for="email" class="form-label">Email Address</label> -->
                            <input type="email" name="email" class="form-control py-3" id="d_for_email"
                                placeholder="Enter Email Address" required aria-describedby="empid">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn m-0 fw-bold p-0 text-primary" id="d_ca"  type="button">Create Account </button>
                            <button class="btn m-0 p-0 fw-bold text-primary" id="d_log" type="button">Log In</button>
                        </div>
                        <div class="d-grid gap-2 my-5">
                            <button type="submit" class="btn btn-primary py-2" id="doc_forgot">Send Email </button>
                        </div>
                    </div>
                </div>
                <!-- <div class="login-container" id="docreg">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Doctor Register</h5>
                        <a href="https://test.feelyprivacy.com/s/p">Not a Doctor ?</a>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-sm-offset-4 login-box">
                        <div class="login-header mb-3">
                            <img src="https://test.feelyprivacy.com/s/public/image/logo.png" />
                        </div>
                        <div id="error-message" class="alert alert-danger">+

                        </div>
                        <div class="d-flex justify-content-center">
                            <form method="post" class="px-3">
                                <div class="d-flex justify-content-between">
                                        <div class="mb-3 mx-1">
                                            <input type="text" class="form-control py-2" name="fname" id="fname"
                                                placeholder="First Name" required>
                                        </div>
                                        <div class="mb-4 mx-1">
                                            <input type="text" class="form-control py-2" name="sname" id="sname"
                                                placeholder="Last Name" required>
                                        </div>
                                    </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control py-2" id="email"
                                        placeholder="Enter your email">
                                </div>
                                <div class="captcha-container d-flex justify-content-center">
                                    <div class="h-captcha" data-sitekey="8840d1d7-bfeb-4979-b86b-5223d5ad79f9" required>
                                    </div>
                                </div>
                                <button class="btn my-3 p-0 fw-bold text-primary al-r" type="button">Login
                                    ?</button>
                                <div class="d-grid gap-2 my-2">
                                    <button type="button" id="btn-signup"
                                        class="btn btn-primary btn-default btn-block my-2">
                                        Sign Up
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="login-container" id="doclog">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Doctor Login</h5>
                        <a href="https://test.feelyprivacy.com/s/p">Not a Doctor ?</a>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-sm-offset-4 login-box">
                        <div class="login-header mb-3">
                            <img src="https://test.feelyprivacy.com/s/public/image/logo.png" />
                        </div>
                        <div id="error-message" class="alert alert-danger">+

                        </div>
                        <div class="d-flex justify-content-center">
                            <form  method="post" class="px-3">
                                <div class="mb-3">
                                    <input type="email" class="form-control py-2" id="email"
                                        placeholder="Enter your email">
                                </div>
                                <button class="btn m-0 fw-bold p-0 text-primary al-r" type="button">Create Account ?</button>
                                <div class="d-grid gap-2 my-2">

                                    <button type="submit" id="btn-login" class="btn btn-primary btn-block my-2">
                                        Log In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    </div>



    <?php include './assest/bottom_links.php'; ?>
    <script src='https://test.feelyprivacy.com/s/controller/js/index.js?ver=1.4'></script>
    <!-- <script src="https://cdn.auth0.com/js/auth0/9.16/auth0.min.js"></script>
    <script src="https://cdn.auth0.com/js/polyfills/1.0/object-assign.min.js"></script> -->


    
    
</body>

</html>