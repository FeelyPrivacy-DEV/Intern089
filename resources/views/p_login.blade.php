<?php

error_reporting(0);
session_start();
// require './vendor/autoload.php';
use MongoDB\Client as mongo;
$con = new mongo;
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
    @include('assest/top_links')
    <title>Scheduld yourself !</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class='navbar-brand text-light mx-4' href='/'>
                <img src="{{URL::to('/')}}/image/logo.png" height="60" alt="" srcset="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Doctor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/p-login">Patient</a>
                    </li>
                </ul>
                <a href="/" class='btn btn-outline-primary text-primary px-3 py-2 mx-5'>LOGIN
                    /
                    SIGNUP</a>
            </div>
        </div>
    </nav>

    <?php echo $auth_msg; ?>


    <div class="container formcont my-2">
        <div class="reg_cont d-flex justify-content-center">
            <div class="img mx-4">
                <img src="{{URL::to('/')}}/image/login-banner.png" class="bnar" height="300" alt="" srcset="">
            </div>
            <div class="forms mx-4">
                <div class="reg" id="patreg">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Patient Register</h5>
                        <!-- <a href="http://127.0.0.1/s/s/index">Not a Patient ?</a> -->
                    </div>
                    <form class="container needs-validation" action="/pNew"
                        method="POST">
                        @csrf
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
                        <!-- <div class="mb-3">
                            <label for="number" class="form-label">Patient ID</label>
                            <input type="text" name="empid" class="form-control py-2" id="empsid"
                                aria-describedby="empid" placeholder="Create Username " required>

                        </div> -->
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
                        <button class="btn m-0 fw-bold p-0 text-primary" id="p_log" type="button">Login </button>
                        <div class="d-grid gap-2 my-1">
                            <button type="submit" name="employee_signup" class="btn btn-primary py-2">Create
                                Account </button>
                        </div>
                    </form>
                </div>
                <div class="log" id="patlog">
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Patient Login</h5>
                        <!-- <a href="http://127.0.0.1/s/s/index">Not a Patient ?</a> -->
                    </div>
                    <form class=" container e_log_form" action="/pLogin"
                        method="POST">
                        @csrf
                        <div class="mb-3">
                            <!-- <label for="number" class="form-label">Patient ID</label> -->
                            <input type="email" name="email" class="form-control py-3" id="log_empid" required
                                placeholder="Email Address" aria-describedby="empid">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="password" class="form-label">Password</label> -->
                            <input type="password" name="pass" class="form-control py-3" id="log_pass" required
                                placeholder="Password" aria-describedby="password">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn m-0 p-0 fw-bold text-primary" id="p_ca" type="button">Create Account</button>
                            <button class="btn m-0 p-0 fw-bold text-primary" id="p_for" type="button">Forgot Password</button>
                        </div>
                        <div class="d-grid gap-2 my-5">
                            <button type="submit" class="btn btn-primary py-2" name="employee_login">Log In</button>
                        </div>
                    </form>
                </div>
                <div class="forgot" id="patforgot">
                <h6 class="text-center text-nowrap" id="for_warn_pat"></h6>
                    <div class="d-flex justify-content-between px-3 pb-2">
                        <h5>Patient Forgot Password</h5>
                        <!-- <a href="http://127.0.0.1/s/s/index">Not a Patient ?</a> -->
                    </div>
                    <div class=" container e_log_form">
                        <div class="mb-3">
                            <!-- <label for="number" class="form-label">Patient ID</label> -->
                            <input type="email" name="email" class="form-control py-3" id="p_for_email" required
                                placeholder="Enter Email Address" aria-describedby="email">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn m-0 p-0 fw-bold text-primary" id="p_ca" type="button">Create Account </button>
                            <button class="btn m-0 fw-bold p-0 text-primary " id="p_log" type="button">Login </button>
                        </div>
                        <div class="d-grid gap-2 my-5">
                            <button type="submit" class="btn btn-primary py-2" id="pat_forgot">Send Email</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @include('assest/bottom_links')
    <script src="{{ URL::asset('/js/index.js?ver=3.0') }}"></script>

</body>

</html>