<?php
    use MongoDB\Operation\Find;
    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['eid'] == '') {
        header('location: http://128.199.27.158/s/index');
    }

    $con = new MongoDB\Client( 'mongodb://test.com:27017' );
    $db = $con->php_mongo;

 
    $msg = '';

    if($_GET['e'] == 'sametm') {
        $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Not available !</strong> Because this scheduled is already booked by <strong> manager.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['e'] == 'samete') {
        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Not available !</strong> Because this scheduled is already booked by other <strong> emplpoyee.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['time'] == 'equal') {
        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>You already booked this time schedueld !</strong> Please select another one.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['time'] == 'add' || $_GET['date'] == 'add') {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Your meeting scheduled has been saved !</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['time'] == 'addm' || $_GET['date'] == 'addm') {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Your meeting has been scheduled with Manager !</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }


    $d = date( 'Y-m-d' );

?>




<!doctype html>
<html lang="en">

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://128.199.27.158/s/public/stylesheet/p-booking.css?ver=1.1">
    <title>Patient | Booking</title>
</head>

<body>
    <?php include_once '../../assest/navbar.php'; ?>

    <!-- breadcrumb -->
    <nav class='breadc navbar-expand-lg'>
        <div class='container-fluid'>
            <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                <p class=" my-auto py-1">Home / Booking</p>
                <h5 class="my-auto py-1">Booking</h5>
            </div>
        </div>
    </nav>


    <!-- main content -->
    <div class="m-2 row my-5">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 ">
            <div class="">
                <?php 
                    $collection = $db->employee;
                    $record = $collection->findOne( ['_id' =>$_SESSION['eid']] );
                ?>
                <div class="d-flex justify-content-center mb-4">
                    <img src="http://128.199.27.158/s/public/image/pat-img/default_user.png" height="150"
                        class="rounded-circle" alt="">
                </div>
                <h4 class="text-center"><a href="#"><?php echo $record['fname'].' '.$record['sname']; ?></a></h4>
                <p class="text-center">24 Jul 1983, 38 years</p>
                <p class="text-center"> Newyork, USA</p>
            </div>
            <div class="side-nav my-4">
                <ul class="px-0">
                    <li class="px-4"><a href="http://128.199.27.158/s/view/p/index"><i
                                class="bi bi-speedometer"></i>Dashboard</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-bookmark-fill"></i></i>Favouriate</a></li>
                    <li class="px-4"><a href="http://128.199.27.158/s/view/p/booking"  class="s-active"><i
                                class="bi bi-chat-left-dots-fill"></i>Booking</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li>
                    <li class="px-4"><a href="http://128.199.27.158/s/view/p/profile-settings"><i
                                class="bi bi-gear-fill"></i>Profile Setting</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
            </div>
        </div>


        <!-- body content -->
        <div class="col-md-9 d-book-content my-4">
            <!-- select doctor -->
            <div class="row">
                <div class="col-md-12 mb-5">
                    <!-- <label for="email" class="form-label">Please Select Doctor From Here</label> -->
                    <select class="form-select" aria-label="Default select example " id="doc-select">
                        <option selected value="0">Please Select Doctor from here...</option>
                        <?php
                            $collection = $db->manager; $rec = $collection->find();
                            $c = 1;
                            foreach($rec as $key=>$val) {   
                                echo '<option value="'.$val['d_unid'].'">'.$val['fname'].' '.$val['sname'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <!-- day and date strip -->
            <div class="container dd-strip d-flex justify-content-between">
                <div class="" id="today-date">
                    <h4 class="mb-1"><?php echo date('d F Y'); ?></h4>
                    <p class="text-muted"><?php echo date('l'); ?></p>
                </div>
                <div class="">
                    <div class="bookingrange btn btn-white btn-sm mb-3">
                        <input type="date" name="" class="form-control" id="">
                    </div>
                </div>
            </div>

            <p id="warn"></p>

            <div class='container slider-main my-5'>
                <?php echo $msg; ?>
                <!-- <button type="button" class="btn slider-btn" id=""><i class='bi bi-chevron-left text-primary text-center my-auto rounder-circle'></i></button> -->
                <div class="slider my-5 " id="seven-days-slot">
                    <div class="pl-5 d-flex justify-content-around select_active" id="select_active">
                        
                    </div>

                </div>
            </div>

            <!-- procced to pay -->
            <div class="container protopay d-flex justify-content-end">
                <button class="btn btn-primary px-5 py-3" onclick="proccedtopay()" id="proccedtopay">Proceed to Pay <i
                        class="bi bi-arrow-right my-auto mx-3 "></i></button>
            </div>
        </div>
    </div>


    



    <?php include '../../assest/bottom_links.php'; ?>
    <script src="http://128.199.27.158/s/controller/js/p-booking.js?ver=2.4"></script>
    <script src="http://128.199.27.158/s/controller/js/success.js?ver=2.0"></script>
</body>

</html>