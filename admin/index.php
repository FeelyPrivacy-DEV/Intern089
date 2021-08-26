<?php 

    error_reporting(0);
    session_start();
    require '../vendor/autoload.php';
    $con = new MongoDB\Client( 'mongodb://143.244.139.242:27017' );
    $db = $con->php_mongo;

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
    <?php include '../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://143.244.139.242/s/admin/public/stylesheet/login.css?ver=1.1">
    <title>Admin </title>
</head>

<body>
    <?php echo $auth_msg; ?>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="http://143.244.139.242/s/admin/public/image/logo.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>

                            <!-- Form -->
                            <form action="http://143.244.139.242/s/admin/controller/php/login.php" method="POST">
                                <div class="form-group my-3">
                                    <input class="form-control p-3" type="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group my-2">
                                    <input class="form-control p-3" type="password" name="pass" placeholder="Password">
                                </div>
                                <div class="form-group d-grid gap-2 my-4">
                                    <button class="btn btn-primary btn-block py-2" name="a_login" type="submit">Login as Admin</button>
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

                            <div class="text-center dont-have" >Don’t have an account? <a href="http://143.244.139.242/s/admin/register">Register</a>
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