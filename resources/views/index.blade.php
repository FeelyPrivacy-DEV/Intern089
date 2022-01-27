<?php

error_reporting(0);
session_start();
// require './vendor/autoload.php';
use MongoDB\Client as mongo;

$con = new mongo;
$db = $con->php_mongo;

?>


<!doctype html>
<html lang="en">

<head>

    @include('assest/top_links')
    <link rel="stylesheet" href="/css/index.css?ver=4.2">
    <title>Jeev60</title>

</head>

<body>

    <div class="loading">
        <div class="spinner-border text-center" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    <!-- navbar -->
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class='navbar-brand text-light mx-4' href='/'>
                <img src="{{ URL::to('/') }}/image/logo.png" height="60" alt="" srcset="">
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
    </nav> -->

    <?php echo $auth_msg; ?>

    <?php
    // require 'vendor/autoload.php';
    // use Auth0\SDK\Auth0;

    // $auth0 = new Auth0([
    // 'domain' => 'dev-83yti7ke.us.auth0.com',
    // 'client_id' => 'wxoAs08d4cn6d5XsJXRVtvUKUrZg96lx',
    // 'client_secret' => 'cN2pt5bJtf1qSI5-Nc7LIDtdQOETadbAxUxbjCREA8kw1mRxt6c-0gEA1yVbNct1',
    // 'redirect_uri' => 'http://127.0.0.1:8000/s/l/index',
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

    <div class="mainAuthContainer">
        <div class="doctorAuthContainer">
            <div class="container my-3">
                <div class="d-flex justify-content-end">
                    <button class="btn fw-bolder patientAuthBtn">I am Patient</button>
                </div>
            </div>
            <div class="container formcont my-2">
                <div class="reg_cont d-flex justify-content-center"> 
                    <div class="forms mb-2 p-5">
                        <div class="box-shadow1 ">
                            <div class="d-flex justify-content-center">
                                <a class='navbar-brand text-light mx-4' href='/'>
                                    <h1>Jee<span class="text-warning">v</span>60</h1>
                                </a>
                            </div>
                            <div class="authBtns my-1 mx-3 p-3">
                                <div class="d-flex justify-content-between">
                                    <button class="btn px-3 py-1 p-0 fw-bold  al-r" id="d_log" type="button">Sign In</button>
                                    <button class="btn px-3 py-1 fw-bold p-0  btn-secondary  " id="d_ca" type="button">Sign Up</button>
                                    <button class="btn px-3 py-1 p-0 fw-bold btn-secondary   " id="d_for" type="button">Forgot </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center role px-3 my-2">
                                <h5 class="role-doc">DOCTOR</h5>
                            </div>
                            <div class="formLoader">
                                <div class="reg" id="docreg">

                                    <div class="container needs-validation">
                                        <div class="text-center my-4" id="doctor_register_warn"></div>
                                        <!-- @csrf -->
                                        <div class="d-flex justify-content-between">
                                            <div class="mb-3 mx-1">
                                                <!-- <label for="email" class="form-label">First Name</label> -->
                                                <input type="text" class="form-control py-2" name="fname" id="doctor_register_fname" placeholder="First Name" required>
                                            </div>
                                            <div class="mb-4 mx-1">
                                                <input type="text" class="form-control py-2" name="sname" id="doctor_register_sname" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <input type="email" class="form-control py-2" name="email" id="doctor_register_email" aria-describedby="email" placeholder="Email Address" required>
                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="mb-3 mx-1">
                                                <!-- <label for="email" class="form-label">First Name</label> -->
                                                <input type="number" class="form-control py-2" maxlength="10" name="mobileNumber" id="doctor_register_mn" placeholder="mobile Number" required>
                                            </div>
                                            <div class="mb-4 mx-1">
                                                <input type="text" class="form-control py-2" name="medicalId" id="doctor_register_ml" placeholder="Medical Licence" required>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <input type="text" class="form-control py-2" name="addr" id="doctor_register_addr" placeholder="Address Line" required aria-describedby="">
                                        </div>
                                        <div class="mb-4">
                                            <input type="password" class="form-control py-2" name="pass" id="doctor_register_pass" placeholder="Create Password " required aria-describedby="password">
                                            <small class="text-danger" id="pass_warn"><i></i></small>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="h-captcha" data-sitekey="e4054920-6588-4c22-9f83-19a1585bd86a" data-size="invisible" required>
                                            </div>
                                        </div>




                                        <div class="d-grid gap-2 my-3">
                                            <button type="submit" class="btn btn-primary py-2" id="doctor_register_btn" name="manager_signup">Create
                                                Account</button>
                                            <!-- <button type="submit" class="btn btn-primary py-2" name="manager_signup">Create
                                                Account Password less</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="log" id="doclog">
                                    <div class="container e_log_form">
                                        <div class="text-center text-nowrap my-4" id="doctor_login_warn"></div>

                                        <!-- @csrf -->
                                        <div class="mb-3">
                                            <!-- <label for="email" class="form-label">Email Address</label> -->
                                            <input type="email" name="email" class="form-control py-2" id="login_doctor_email" placeholder="Email Address" required aria-describedby="empid">
                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                        </div>
                                        <div class="mb-3">
                                            <!-- <label for="password" class="form-label">Password</label> -->
                                            <input type="password" name="pass" class="form-control py-2" id="login_doctor_pass" placeholder="Enter Password" required aria-describedby="password">
                                        </div>
                                        <div class="d-grid gap-2 my-5">
                                            <button type="submit" class="btn btn-primary py-2" id="doctor_login_btn" name="manager_login">Log In </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="forgot" id="docforgot">
                                    <h6 class="text-center text-nowrap" id="for_warn"></h6>
                                    <div class="container e_log_form">
                                        <div class="mb-4">
                                            <!-- <label for="email" class="form-label">Email Address</label> -->
                                            <input type="email" name="email" class="form-control py-2" id="d_for_email" placeholder="Enter Email Address" required aria-describedby="empid">
                                        </div>
                                        <div class="d-grid gap-2 my-5">
                                            <button type="submit" class="btn btn-primary py-2" id="doc_forgot">Send Email </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- email testing with sendgrid -->
                            <!-- <div class="">
                                <button class="btn btn-primary sendgridTestBtn">Send Email</button>

                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="patientAuthContainer">
            <div class="container my-3">
                <div class="d-flex justify-content-end">
                    <button class="btn fw-bolder doctorAuthBtn">I am Doctor</button>
                </div>
            </div>
            <div class="container formcont my-2">
                <div class="reg_cont d-flex justify-content-center">
                    <div class="forms mx-4">
                        <div class="box-shadow1 ">
                            <div class="d-flex justify-content-center">
                                <a class='navbar-brand text-light mx-4' href='/'>
                                    <h1>Jee<span class="text-primary">v</span>60</h1>
                                </a>
                            </div>
                            <div class="authBtns my-1 mx-3 p-3">
                                <div class="d-flex justify-content-between"> 
                                    <button class="btn px-3 py-1 p-0 fw-bold btn-secondary   al-r" id="p_log" type="button">Sign In </button>  
                                    <button class="btn px-3 py-1 fw-bold p-0  btn-secondary " id="p_ca" type="button">Sign Up</button>
                                    <button class="btn px-3 py-1 fw-bold p-0  btn-secondary  " id="p_for" type="button">Forgot</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center role px-3 my-2">
                                <h5 class="role-pat">PATIENT</h5>
                            </div>
                            <div class="formLoader">
                                <div class="reg" id="patreg"> 
                                    <div class="container needs-validation">
                                        <!-- @csrf -->
                                        <div class="text-center my-4" id="patient_register_warn"></div>
                                        <div class="d-flex justify-content-between">
                                            <div class="mb-3 mx-1">
                                                <!-- <label for="email" class="form-label">First Name</label> -->
                                                <input type="text" class="form-control py-2" name="fname" id="patient_registration_fname" placeholder="First Name" required>
                                            </div>
                                            <div class="mb-3 mx-1">
                                                <!-- <label for="email" class="form-label">Last Name</label> -->
                                                <input type="text" class="form-control py-2" name="sname" id="patient_registration_sname" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <!-- <label for="email" class="form-label">Email Address</label> -->
                                            <input type="email" name="email" class="form-control py-2" id="patient_registration_email" placeholder="Enter Email Address" required aria-describedby="email">
                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                        </div>
                                        <div class="mb-3">
                                            <!-- <label for="password" class="form-label">Password</label> -->
                                            <input type="password" name="pass" class="form-control py-2" id="patient_registration_pass" placeholder="Create Password" required aria-describedby="password">
                                            <small class="text-danger" id="pass_warn"><i></i></small>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="h-captcha" data-sitekey="e4054920-6588-4c22-9f83-19a1585bd86a" data-size="invisible" required></div>
                                        </div>
                                        
                                        <div class="d-grid gap-2 my-1">
                                            <button name="employee_signup" id="patient_registration_btn" class="btn auth-action-btn-pat-color py-2">Create
                                                Account </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="log" id="patlog"> 
                                    <div class=" container e_log_form">
                                        <!-- @csrf -->
                                        <div class="text-center my-4" id="patient_login_warn"></div>
                                        <div class="mb-3">
                                            <!-- <label for="number" class="form-label">Patient ID</label> -->
                                            <input type="email" name="email" class="form-control py-2" id="patient_login_email" required placeholder="Email Address" aria-describedby="empid">
                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                        </div>
                                        <div class="mb-3">
                                            <!-- <label for="password" class="form-label">Password</label> -->
                                            <input type="password" name="pass" class="form-control py-2" id="patient_login_pass" required placeholder="Enter Password" aria-describedby="password">
                                        </div> 
                                        <div class="d-grid gap-2 my-5">
                                            <button type="submit" class="btn auth-action-btn-pat-color py-2" id="patient_login_btn" name="employee_login">Log In</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="forgot" id="patforgot">
                                    <h6 class="text-center text-nowrap" id="for_warn_pat"></h6> 
                                    <div class=" container e_log_form">
                                        <div class="mb-3">
                                            <!-- <label for="number" class="form-label">Patient ID</label> -->
                                            <input type="email" name="email" class="form-control py-2" id="p_for_email" required placeholder="Enter Email Address" aria-describedby="email">
                                        </div>
                                        <div class="d-flex justify-content-between"> 
                                        </div>
                                        <div class="d-grid gap-2 my-5">
                                            <button type="submit" class="btn auth-action-btn-pat-color py-2" id="pat_forgot">Send Email</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('assest/bottom_links')
    <script src="{{ URL::asset('/js/index.js?ver=1.4') }}"></script>
    <!-- <script src="https://cdn.auth0.com/js/auth0/9.16/auth0.min.js"></script>
    <script src="https://cdn.auth0.com/js/polyfills/1.0/object-assign.min.js"></script> -->




</body>

</html>