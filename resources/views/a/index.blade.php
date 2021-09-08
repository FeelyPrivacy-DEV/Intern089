<?php

    error_reporting(0);
    session_start();
    // require './vendor/autoload.php';
    use MongoDB\Client as mongo;
    $con = new mongo;

    if($alert) {
        $auth_msg = '<div class="alert alert-danger alert-dismissible fade show " role="alert">
                        <strong>Wrong Credentials !</strong> Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
    // else if($alert) {
    //     $auth_msg = '<div class="alert alert-success alert-dismissible fade show " role="alert">
    //                     <strong>Your account created successfully !</strong> Login Now !
    //                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //                 </div>';
    // }




?>

<!doctype html>
<html lang="en">

<head>
    @include('/assest/top_links')
    <link rel="stylesheet" href="/css/admin/login.css?ver=1.3">
    <title>Admin </title>
</head>

<body>
    <?php echo $auth_msg; ?>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="" src="/image/logo.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>

                            <!-- Form -->
                            <div class="container">
                                <div class="text-center my-4" id="admin_login_warn"></div>
                                <!-- @csrf -->
                                <div class="form-group my-3">
                                    <input class="form-control p-3" type="email" name="email" id="admin_login_email"
                                        placeholder="Email Address">
                                </div>
                                <div class="form-group my-2">
                                    <input class="form-control p-3" type="password" name="pass" id="admin_login_pass" placeholder="Password">
                                </div>
                                <div class="form-group d-grid gap-2 my-4">
                                    <button class="btn btn-primary btn-block py-2" id="admin_login_btn" name="a_login" type="submit">Login as
                                        Admin</button>
                                </div>
                            </div>
                            <!-- /Form -->

                            <!-- <div class="text-center forgotpass"><a href="forgot-password.html">Forgot Password?</a></div> -->

                            <div class="login-or text-center">
                                <span class="span-or text-center">or</span>
                            </div>
                            <div class="text-center dont-have" >Don’t have an account? <a href="/a-register">Register</a>
                            </div>

                            <?php
                            // $collection = $db->admin;
                            // $r = $collection->find();

                            // print_r($r);

                            // if($r['username'] == 'admin') {

                            //     echo '<div class="login-or text-center">
                            //             <span class="span-or text-center">or</span>
                            //         </div>
                            //         <div class="text-center dont-have" >Don’t have an account? <a href="https://test.feelyprivacy.com/s/admin/register">Register</a>
                            //         </div>
                            //     ';

                            // }

                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>







    @include('/assest/bottom_links')
    <script src="{{ URL::asset('/js/index.js?ver=1.4') }}"></script>
</body>

</html>
