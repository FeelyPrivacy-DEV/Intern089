<?php

    error_reporting(0);
    session_start();
    // require '../../vendor/autoload.php';

    // if the session is not set and patient is not logged in then it will redirected to home page
    if($_SESSION['eid'] == '') {
        header('location: http://127.0.0.1/s/s/');
    }

    // connecting to database
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;


?>




<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('assest/top_links')
    <link rel="stylesheet" href="/css/p-booking.css?ver=1.8">
    <title>Patient | Booking</title>
</head>

<body>

<div class="loading">
        <div class="spinner-border text-center" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    @include('assest/navbar')

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
    <div class="d-flex justify-content-start ms-4">
        <a href="/p" class="btn text-primary"><i class="bi bi-arrow-left-short me-2"></i>Back</a>
    </div>
    <div class="m-5 row ">
        <!-- sidebar -->

        <!-- body content -->
        <?php
            $d = date( 'Y-m-d' );
            $ass = $id;
            $collection = $db->manager;
            $record = $collection->findOne( ["d_unid" => $ass] );
        ?>

        <div class="col-md-12 d-book-content my-4">
            <div class="doc-head mx-5">
                <div class="left d-flex mb-4"> 
                    <?php
                        if ($record['profile_image'] != '') {
                            echo '<img src="/image/doc-img/doc-img/' . $record['profile_image'] . '" class="rounded"  height="90" alt="User Image">';
                        } else {
                            echo '<img src="/image/doc-img/doc-img/default-doc.jpg"  height="90" alt="User Image">';
                        }
                    ?>
                    <div class="mx-3">
                        <h5>Dr. <?php echo $record['fname'].' '.$record['sname'] ?></h5>
                        <div class="d-flex my-1">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <p class="my-0 mx-1">(35)</p>
                        </div>
                        <p class=""><i class="bi bi-geo-alt-fill"></i>
                            <?php echo $record['contact_detail']['city'].' '.$record['contact_detail']['state'] ?>
                            <a href="#"></a>
                        </p>
                    </div>
                </div>
                <!-- select doctor -->
                <!-- day and date strip -->
                <div class="dd-strip d-flex justify-content-start">
                    <div class="" id="today-date">
                        <h5 class="mb-1 text-info"><?php echo date('d F Y'); ?></h5>
                        <p class="text-muted"><?php echo date('l'); ?></p>
                    </div>
                </div>

            </div>

            <p id="warn"></p>

            <div class="row">
                <div class='container slider-main my-5' id="seven-days-slot">
                    <?php echo $msg; ?>
                    <!-- <button type="button" class="btn slider-btn" id=""><i class='bi bi-chevron-left text-primary text-center my-auto rounder-circle'></i></button> -->
                    <!-- <div class="slider my-5 " id="seven-days-slot"> -->
                    <div class="d-flex justify-content-around select_active" id="select_active">
                        <?php
                                $flag2 = false;

                                $collection = $db->check;
                                $crecord = $collection->findOne( ['fname' => 'check_datetime'], );
    
                                for($i = 0; $i < 7; $i++) {
                                    $date = strtotime("+$i day", strtotime("this week"));
                                    $premon = date("Y-m-d", $date);
                                    $a = strval($premon);
                                    echo '<div class="time-slots">
                                            <div class="mx-auto">
                                                <h5 class="text-dark px-4">'.date("D", $date).'</h5>
                                                <p class="text-muted text-nowrap">'.date("d M Y", $date).'</p>
                                            </div>';

                                    // $w = count($time_arr[$premon]);
                                    if($record['datetime'][$premon] == 0) {
                                        echo '<button type="button" class="btn btn-sm px-5 m-1 text-nowrap" disabled>---</button>';
                                    }
                                    else {
                                        try{
                                        $x = 1;
                                        foreach($record['datetime'] as $index=>$value) {
                                            if($index == $premon) {
                                                echo '<div class="d-flex flex-column time-btn">';
                                                foreach ( $value as $key=>$val ) {

                                                    foreach($crecord['datetime'] as $did=>$dval) {
                                                        if($did == $ass) {
                                                            foreach($dval as $date_key=>$val2) {
                                                                if($date_key <= $premon) {
                                                                    foreach($val2 as $index=>$v) {
                                                                        $flag2 = false;
                                                                        if($v[0] == $val[0] && $v[1] == $val[1]){
                                                                            $flag2 = true;
                                                                            if($val[0] <= 12 && $val[1]) {
                                                                                echo '<button type="button" disabled
                                                                                class="btn btn-sm btn-primary text-light text-nowrap px-2 m-1 ">'.date('h:i', strtotime($val[0])).'AM - '.date('h:i', strtotime($val[1])).'
                                                                                AM<i class="bi bi-check2"></i></button>';
                                                                            }
                                                                            else {
                                                                                echo '<button type="button" disabled
                                                                                class="btn btn-sm btn-primary text-light text-nowrap px-2 m-1 ">'.date('h:i', strtotime($val[0])).'PM - '.date('h:i', strtotime($val[1])).'
                                                                                PM<i class="bi bi-check2"></i></button>';
                                                                            }
                                                                            goto ZSA;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    ZSA: if($flag2 == false) {
                                                            if($val[0] <= 12 && $val[1]) {
                                                                if(date("d M Y", $date) < date('d M Y')) {
                                                                    echo '<button type="button"
                                                                            onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\', \''.$ass .'\')"
                                                                            class="btn btn-sm text-nowrap px-4 m-1 btn-a" disabled
                                                                            id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' AM - '.date('h:i', strtotime($val[1])).'
                                                                            AM</button>';
                                                                        $x++;
                                                                }
                                                                else {
                                                                    echo '<button type="button"
                                                                            onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\', \''.$ass .'\')"
                                                                            class="btn btn-sm  text-nowrap px-4 m-1 btn-a"
                                                                            id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' AM - '.date('h:i', strtotime($val[1])).'
                                                                            AM</button>';
                                                                        $x++;
                                                                }
                                                            }
                                                            else {
                                                                if(date("d M Y", $date) < date('d M Y')) {
                                                                    echo '<button type="button"
                                                                            onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\', \''.$ass .'\')"
                                                                            class="btn btn-sm text-nowrap px-4 m-1 btn-a" disabled
                                                                            id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' PM - '.date('h:i', strtotime($val[1])).'
                                                                            PM</button>';
                                                                        $x++;

                                                                }
                                                                else {
                                                                    echo '<button type="button"
                                                                            onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\', \''.$ass .'\')"
                                                                            class="btn btn-sm  text-nowrap px-4 m-1 btn-a"
                                                                            id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' PM - '.date('h:i', strtotime($val[1])).'
                                                                            PM</button>';
                                                                        $x++;
                                                                }
                                                            }
                                                        }
                                                }
                                                echo '</div>';
                                            }
                                        }
                                        } catch(Exception $e) {
                                            echo $e;
                                        }
                                    }
                                    echo '</div>';
                                }
                            ?>
                    </div>

                    <!-- </div> -->
                </div>

                <!-- procced to pay -->
                <div class="container protopay d-flex justify-content-end">
                    <!-- rzp_test_LgM8FDF7mkv5gD -->
                    <!-- <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="rzp_test_LgM8FDF7mkv5gD" async> </script> </form> -->
                    <button class="btn btn-primary px-5 py-3 mx-3" onclick="proccedtopay()" id="proccedtopay">Proceed to Pay<i class="bi bi-arrow-right my-auto mx-3 "></i></button>
                </div>
            </div>
        </div>





        @include('/assest/bottom_links')
        <script src="{{ URL::asset('/js/p-booking.js?ver=3.6') }}"></script>
        <!-- <script src="http://127.0.0.1/s/s/controller/js/success.js?ver=2.0"></script> -->

        <script>

        </script>
</body>

</html>
