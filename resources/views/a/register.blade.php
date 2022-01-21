<?php

    // error_reporting(0);
    // session_start();


?>



<!doctype html>
<html lang="en">

<head>
    @include('/assest/top_links')
    <link rel="stylesheet" href="/css/admin/login.css?ver=1.1">
    <title>Admin </title>
</head>

<body>
<div class="loading">
        <div class="spinner-border text-center" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="/image/logo.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Register</h1>

                            <!-- Form -->
                            <div class="container">
                                <!-- @csrf -->
                                <div class="text-center my-4" id="admin_register_warn"></div>
                                <div class="form-group my-3"> 
                                    <input class="form-control py-3" type="text" name="fname" id="admin_register_fname" placeholder="Full Name">
                                </div>
                                <div class="form-group my-3">
                                    <input class="form-control py-3" type="email" name="email" id="admin_register_email" placeholder="Email Address">
                                </div>
                                <div class="form-group my-2">
                                    <input class="form-control py-3" type="password" name="pass" id="admin_register_pass" placeholder="Password">
                                </div>
                                <div class="form-group d-grid gap-2 my-4">
                                    <button class="btn btn-primary btn-block py-2" id="admin_register_btn" name="ad_signup" type="submit">Register for Admin</button>
                                </div>
                            </div>

                            <!-- /Social Login -->
                            <div class="text-center dont-have" >Already have an account? <a href="http://127.0.0.1:8000/a-login">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    @include('/assest/bottom_links')
    <script src="{{ URL::asset('/js/index.js?ver=1.4') }}"></script>
</body>

</html>
