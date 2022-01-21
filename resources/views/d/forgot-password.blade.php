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
    @include('/assest/navbar')

    <!-- breadcrumb -->
    <nav class='breadc navbar-expand-lg'>
        <div class='container-fluid'>
            <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                <p class=" my-auto py-1">Home / Forgot Password</p>
                <h5 class="my-auto py-1">Forgot Password</h5>
            </div>
        </div>
    </nav>


    <!-- main content -->

    <div class="m-2 row">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 border">
            <div class="">
                <div class="d-flex justify-content-center ">
                    <div class="change-avatar">
                        <div class="profile-img">
                            <?php
                            if ($record['profile_image'] != '') {
                                echo '<img src="/image/doc-img/doc-img/' . $record['profile_image'] . '"  height="90" alt="User Image">';
                            } else {
                                echo '<img src="/image/doc-img/doc-img/default-doc.jpg"  height="70" alt="User Image">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <h4 class="text-center"><a href="#"><?php echo $record['fname'] . ' ' . $record['sname']; ?></a></h4>
                <p class="text-center">24 Jul 1983, 38 years</p>
                <p class="text-center"> Newyork, USA</p>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-outline-primary sidebtn fw-bold px-4 my-3"><i class="bi bi-list"></i></button>
            </div>
            <div class="side-nav my-4">
                <ul class="px-0">
                    <li class="px-4"><a href="/d"><i class="bi bi-speedometer"></i>Dashboard</a></li>
                    <li class="px-4"><a href="/d/appointments"><i class="bi bi-calendar-check-fill"></i>Appointments</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-person-lines-fill"></i>My Patients</a></li> -->
                    <li class="px-4"><a href="/d/schedule-timings"><i class="bi bi-hourglass-split"></i>Schedule Timimg</a></li>
                    <li class="px-4"><a href="/d/invoice"><i class="bi bi-receipt-cutoff"></i>Invoice</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-star-fill"></i>Review</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <li class="px-4"><a href="/d/profile-settings"><i class="bi bi-gear-fill"></i>Profile Setting</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-share-fill"></i>Social Media</a></li> -->
                    <li class="px-4"><a href="/d/forgot-password" class="s-active"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    
                </ul>
            </div>
        </div>

        <!-- body content -->
        <div class="col-md-9 d-dash-content p-5">
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










    @include('/assest/bottom_links')
    <script src="{{ URL::asset('/js/d-change-password.js?ver=1.6') }}"></script>

</body>

</html>