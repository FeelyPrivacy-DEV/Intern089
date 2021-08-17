<?php

    error_reporting(0);
    session_start();
    require './vendor/autoload.php';
    $con = new MongoDB\Client( 'mongodb://localhost:27017' );
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

?>


<!doctype html>
<html lang="en">

<head>
    <?php include './assest/top_links.php'; ?>
    <title>Scheduld yourself !</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary ">
        <div class="container-fluid">
        <a class='navbar-brand text-light mx-4' href='http://localhost/s/s/'>
            <img src="http://localhost/s/s/public/image/logo.png" height="60" alt="" srcset="">
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarSupportedContent">
                <!-- <button type="button" class="nav-btn-modal btn text-light mx-5" data-bs-toggle="modal"
                    data-bs-target="#signup">Employee Sign Up</button>
                <button type="button" class="nav-btn-modal btn text-light mx-5" data-bs-toggle="modal"
                    data-bs-target="#login">Employee Log In</button> -->
            </div>

        </div>
    </nav>

    <?php echo $auth_msg; ?>


    <!-- main div -->
    <div class="container main my-5">
        <div class="container my-5">
            <h1 class="text-center">Book Your Appointments With Doctor </h1>
        </div>

        <div class="container d-flex justify-content-center my-5">
            <button type="button" class="btn btn-primary text-nowrap text-light px-5 py-2 mx-5" data-bs-toggle="modal"
                data-bs-target="#manager_signup">Doctor Sign Up</button>
            <button type="button" class="btn btn-primary text-nowrap text-light px-5 py-2 mx-5" data-bs-toggle="modal"
                data-bs-target="#manager_login">Doctor Log In</button>
        </div>
        <div class="container d-flex justify-content-center my-5">
            <button type="button" class="btn btn-primary text-nowrap text-light px-5 py-2 mx-5" data-bs-toggle="modal"
                data-bs-target="#employee_signup">Patients Sign Up</button>
            <button type="button" class="btn btn-primary text-nowrap text-light px-5 py-2 mx-5" data-bs-toggle="modal"
                data-bs-target="#employee_login">Patients Log In</button>
        </div>
    </div>




    <!-- modals -->

    <!-- sign up Modal -->
    <div class="modal fade" id="employee_signup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Your Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body container">
                    <form class="container" action="http://localhost/s/s/controller/php/signup.php" method="POST">
                        <div class="d-flex justify-content-between">
                            <div class="mb-3">
                                <label for="email" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="sname" id="sname">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Patient ID</label>
                            <input type="number" name="empid" class="form-control" id="empsid" aria-describedby="empid">
                            <small class="small" id="empsid_small"></small>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="empsemail" aria-describedby="email">
                            <small class="small" id="empsemail_small"></small>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" id="empspass" aria-describedby="password">
                            <small class="small" id="empspass_small"></small>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="empsconf_pass" aria-describedby="password">
                            <small class="small" id="empsconf_pass_small"></small>
                        </div>
                        <div class="d-grid gap-2 my-3">
                            <button type="submit" name="employee_signup" class="btn btn-primary py-2">Create Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Login Modal -->
    <div class="modal fade" id="employee_login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hey, hope you doing well !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body e-log">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="http://localhost/s/s/public/image/default_user.png" height="70" alt="">
                    </div>
                    <form class=" container e_log_form" action="http://localhost/s/s/controller/php/login.php" method="POST">
                        <h6 class="text-center my-3" id="">Please Login</h6>
                        <div class="mb-3">
                            <label for="number" class="form-label">Patient ID</label>
                            <input type="number" name="empid" class="form-control" id="log_empid"
                                aria-describedby="empid">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" id="log_pass"
                                aria-describedby="password">
                        </div>
                        <div class="d-grid gap-2 my-5">
                            <button type="submit" class="btn btn-primary py-2" name="employee_login">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- manager modals -->
    <!-- sign up Modal -->
    <div class="modal fade" id="manager_signup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Your Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body container">
                    <form class="container" action="http://localhost/s/s/controller/php/signup.php" method="POST">
                        <div class="d-flex justify-content-between">
                            <div class="mb-3">
                                <label for="email" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="sname" id="sname">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" id="msemail" aria-describedby="email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="pass" id="mspass"
                                aria-describedby="password">
                        </div>
                        <div class="d-grid gap-2 my-3">
                            <button type="submit" class="btn btn-primary py-2" name="manager_signup">Create
                                Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Login Modal -->
    <div class="modal fade" id="manager_login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Wel-come back, Doc</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body e-log">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="http://localhost/s/s/public/image/default_user.png" height="70" alt="">
                    </div>
                    <form class="container e_log_form" action="http://localhost/s/s/controller/php/login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="log_empid"
                                aria-describedby="empid">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" id="log_pass"
                                aria-describedby="password">
                        </div>
                        <div class="d-grid gap-2 my-5">
                            <button type="submit" class="btn btn-primary py-2" name="manager_login">Get Innn</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php include './assest/bottom_links.php'; ?>
</body>

</html>