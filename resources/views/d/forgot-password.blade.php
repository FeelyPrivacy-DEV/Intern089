<?php

error_reporting(0);
session_start();
// require '../../vendor/autoload.php';
if ($_SESSION['eid'] == '') {
    header('location: /');
}
$con = new MongoDB\Client('mongodb://127.0.0.1:27017');
$db = $con->php_mongo;


$collection = $db->manager;
$record = $collection->findOne(['d_unid' => $_SESSION['d_unid']]);


?>

<!doctype html>
<html lang='en'>

<head>
    @include('/assest/top_links')
    <link rel="stylesheet" href="/css/p-change-password.css?ver=2.1">
    <title>Feely | Doc Forgot Password</title>
</head>

<body>
    <div class="loading">
        <div class="spinner-border text-center" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>


    <!-- sidebar -->
    <div class="wrapper ">
        <!-- sidebar -->
        @include('assest/doctor-sidebar')


        <!-- data content -->
        <div class=" d-dash-content pl-5">
            <!-- navbar -->
            @include('assest/doctor-navbar')

            <!-- breadcrumb -->
            <nav class='breadc navbar-expand-lg'>
                <div class='container-fluid'>
                    <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                        <p class=" my-auto py-1">Home / Forgot Password</p>
                    </div>
                </div>
            </nav>


            <!-- main content -->
            <div class="doctorForgotPassword my-4 ">
                <!-- body content -->
                <div class="">
                    <h5 class="text-primary">Change Password</h5>
                    <div class="my-4">
                        <div class="warn"></div>
                        <div class="form-group my-3">
                            <input type="password" id="oldPassword" class="form-control py-2" placeholder="Enter Old Password">
                        </div>
                        <div class="form-group my-3">
                            <input type="password" id="newPassword" class="form-control py-2" placeholder="New Password">
                            <small class="text-danger" id="newPassWarn"></small>
                        </div>
                        <div class="form-group my-3">
                            <input type="password" id="conformNewPassword" class="form-control py-2" placeholder="Confirm New Password">
                            <small class="text-danger" id="passWarn"></small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mt-5">
                        <button type="button" id="changepassbtn" class="btn btn-primary py-2 px-5">Change Password</button>
                    </div>
                </div>
            </div>  
        </div>






        @include('/assest/bottom_links')
        <script src="{{ URL::asset('/js/d-change-password.js?ver=1.6') }}"></script>

</body>

</html>