<?php

    error_reporting(0);
    session_start();


?>



<!doctype html>
<html lang="en">

<head>
    <?php include '../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://localhost/s/s/admin/public/stylesheet/login.css?ver=1.1">
    <title>Admin </title>
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="http://localhost/s/s/admin/public/image/logo.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Register</h1>

                            <!-- Form -->
                            <form action="http://localhost/s/s/admin/controller/php/signup.php" method="POST">
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control py-3" type="text" name="fname" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control py-3" type="text" name="uname" placeholder="Username">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <input class="form-control py-3" type="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group my-2">
                                    <input class="form-control py-3" type="password" name="pass" placeholder="Password">
                                </div>
                                <div class="form-group d-grid gap-2 my-4">
                                    <button class="btn btn-primary btn-block py-2" name="ad_signup" type="submit">Register for Admin</button>
                                </div>
                            </form>
                            <!-- /Form -->

                            <div class="text-center forgotpass"><a href="forgot-password.html">Forgot
                                    Password?</a></div>
                            <div class="login-or text-center">
                                <span class="span-or text-center">or</span>
                            </div>

                            <!-- Social Login -->
                            <div class="social-login">
                                <span style="color: rgb(209, 203, 199) !important;">Login with</span>
                                <div class="form-group d-grid gap-2 my-4">
                                    <button class="btn btn-primary btn-block disabled" type="submit"><i class="bi bi-facebook mx-2"></i> Facebook</button>
                                </div>
                            </div>
                            <!-- /Social Login -->

                            <div class="text-center dont-have" >Already have an account? <a href="http://localhost/s/s/admin/index">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <?php include '../assest/bottom_links.php'; ?>
</body>

</html>