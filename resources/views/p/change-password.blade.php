<?php

    error_reporting(0);
    session_start();
    // require '../../vendor/autoload.php';
    if($_SESSION['eid'] == '') {
        header('location: /');
    }
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;
    // $msg = '';


    $collection = $db->employee;
    $record = $collection->findOne( [ '_id' =>$_SESSION['eid']] );
    // $datetime = iterator_to_array( $record['datetime'] );

    // $date_arr = [];
    // $time_arr = [];

    // foreach($datetime as $date_key=>$val) {
    //     $date_arr[] = $date_key;
    //     foreach($val as $index=>$v) {
    //         $time_arr[$date_key][] = $v;
    //     }
    // }
    // $k = count( $date_arr );

?>

<!doctype html>
<html lang='en'>

<head>
    @include('/assest/top_links')
    <link rel="stylesheet" href="/css/p-change-password.css?ver=2.1">
    <title>Feely | Doc Dashboard</title>
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
                <p class=" my-auto py-1">Home / Dashboard</p>
                <h5 class="my-auto py-1">Dashboard</h5>
            </div>
        </div>
    </nav>


    <!-- main content -->

    <div class="m-2 row">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 border">
            <div class="">
                <div class="d-flex justify-content-center mb-4">
                    <img src="/image/pat-img/default_user.png" height="150" class="rounded-circle"
                        alt="">
                </div>
                <h4 class="text-center"><a href="#"><?php echo $record['fname'].' '.$record['sname']; ?></a></h4>
                <p class="text-center">24 Jul 1983, 38 years</p>
                <p class="text-center"> Newyork, USA</p>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-outline-primary sidebtn fw-bold px-4 my-3"><i class="bi bi-list"></i></button>
            </div>
            <div class="side-nav my-4">
                <ul class="px-0">
                    <li class="px-4"><a href="/p" ><i class="bi bi-person-bounding-box"></i>Select Doctor</a></li>
                    <li class="px-4"><a href="/p/dashboard"><i class="bi bi-speedometer"></i>Dashboard</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-bookmark-fill"></i></i>Favouriate</a></li> -->
                    <!-- <li class="px-4"><a href="http://127.0.0.1/s/s/view/p/booking"><i class="bi bi-chat-left-dots-fill"></i>Booking</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <!-- <li class="px-4"><a href="http://127.0.0.1/s/s/view/p/profile-settings"><i class="bi bi-gear-fill"></i>Profile Setting</a></li> -->
                    <li class="px-4"><a href="/p/change-password" class="s-active"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
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
    <script src="{{ URL::asset('/js/p-change-password.js?ver=1.6') }}"></script>

</body>

</html>
