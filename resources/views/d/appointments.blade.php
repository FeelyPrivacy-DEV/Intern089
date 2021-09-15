<?php

    error_reporting(0);
    session_start();
    // require '../../vendor/autoload.php';
    if($_SESSION['docid'] == '') {
        header('location: /');
    }
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;
    $collection = $db->manager;
    // $msg = '';


    $record = $collection->findOne( [ '_id' =>$_SESSION['docid']] );
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
    @include('assest/top_links')
    <link rel="stylesheet" href="/css/d-appointments.css?ver=1.4">
    <title>Feely | Doc Appointments</title>
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
                <p class=" my-auto py-1">Home / Appointments</p>
                <h5 class="my-auto py-1">Appointments</h5>
            </div>
        </div>
    </nav>


    <!-- main content -->
    <div class="m-5 row ">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2">
            <div class="">
                <div class="d-flex justify-content-center mb-4">
                    <?php
                        if($record['profile_image'] != '') {
                            echo '<img src="/image/doc-img/doc-img/'.$record['profile_image'].'" class="rounded" height="160" alt="User Image">';
                        }
                        else {
                            echo '<img src="/image/doc-img/doc-img/default-doc.jpg" height="160" alt="User Image">';
                        }
                    ?>
                </div>
                <h4 class="text-center"><a href="#">Dr. <?php echo $record['fname'].' '.$record['sname']; ?></a></h4>
                <small class="text-center">BDS, MDS - Oral & Maxillofacial Surgery</small>
            </div>
            <div class="">
                <button class="btn btn-sm btn-outline-primary sidebtn fw-bold px-4 my-3"><i class="bi bi-list"></i></button>
            </div>
            <div class="side-nav my-4">
                <ul class="px-0">
                    <li class="px-4"><a href="/d"><i
                                class="bi bi-speedometer"></i>Dashboard</a></li>
                    <li class="px-4"><a href="/d/appointments" class="s-active"><i
                                class="bi bi-calendar-check-fill"></i>Appointments</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-person-lines-fill"></i>My Patients</a></li> -->
                    <li class="px-4"><a href="/d/schedule-timings"><i
                                class="bi bi-hourglass-split"></i>Schedule Timimg</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-receipt-cutoff"></i>Invoice</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-star-fill"></i>Review</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <!-- <li class="px-4"><a href="/d/profile-settings"><i
                                class="bi bi-gear-fill"></i>Profile Setting</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-share-fill"></i>Social Media</a></li> -->
                    <li class="px-4"><a href="#"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- body content -->
        <div class="col-md-9 d-appo-content pl-5 border ">

                <?php
                    $c = 1;
                    $collection = $db->manager;
                    $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
                    $datetime = iterator_to_array( $record['datetime'] );


                    foreach($record['p_unid'] as $p_unid_key) {
                        $e_collection = $db->employee;
                        $e_record = $e_collection->find(['p_unid' => $p_unid_key]);
                        $pat_detail = iterator_to_array($e_record);
                        foreach($pat_detail as $pert_doc) {
                            foreach($pert_doc['datetime'] as $single=>$singleVal) {
                                if($single == $_SESSION['d_unid']) {
                                    foreach($singleVal as $key=>$val) {
                                        foreach($val as $k=>$v) {
                                            // print_r($v);
                                            echo '<div class="p-3 d-flex justify-content-between pat_card border my-2 rounded">
                                                    <div class="d-flex pet-info">
                                                        <div class="pat-img">
                                                            <img src="/image/pat-img/default_user.png" height="110" width="110"
                                                                alt="" srcset="">
                                                        </div>
                                                        <div class="pat-det mx-4">
                                                            <h5 class=""><a href="#">'.$v['p_name'].'</a></h5>
                                                            <p class="m-0"><i class="bi bi-clock-fill"></i> '.date('Y M d', strtotime($key)).', '.$v['book_t'][0].' AM</p>
                                                            <p class="m-0"><i class="bi bi-geo-alt-fill"></i> Newyork, United States</p>
                                                            <p class="m-0"><i class="bi bi-chat-left-text-fill"></i> '.$pert_doc['email'].'</p>
                                                            <p class="m-0"><i class="bi bi-telephone-fill"></i> +1 923 782 4575</p>
                                                        </div>
                                                    </div>
                                                    <div class="pet-action my-auto">
                                                        <div class="d-flex align-items-center action">';
                                                            if($v['status'] == 'confirmed') {
                                                                echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                <button class="btn btn2 btn-sm mx-1" disabled onclick="accept(\''.$p_unid_key.'\', \''.$key.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'">Accepted</button>
                                                                <button class="btn btn3 btn-sm " onclick="cancel(\''.$p_unid_key.'\', \''.$key.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                            }
                                                            else if($v['status'] == 'cancelled') {
                                                                echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                <button class="btn btn2 btn-sm mx-1" onclick="accept(\''.$p_unid_key.'\', \''.$key.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                                <button class="btn btn3 btn-sm " disabled onclick="cancel(\''.$p_unid_key.'\', \''.$key.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"> Cancelled</button>';
                                                            }
                                                            else {
                                                                echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                <button class="btn btn2 btn-sm mx-1" onclick="accept(\''.$p_unid_key.'\', \''.$key.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                                <button class="btn btn3 btn-sm " onclick="cancel(\''.$p_unid_key.'\', \''.$key.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                            }
                                                    echo '</div>
                                                    </div>
                                                </div>';

                                            // information modal
                                            echo '<div class="modal fade" id="info'.$c.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title">Modal title</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>'.$v['p_name'].'</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                            $c++;
                                        }
                                    }
                                }
                                // exit;
                            }
                        }
                    }

                    if($c == 1) {
                        echo '<h3 class="text-center text-primary my-5">Nothing Here !!</h3>';
                    }
                ?>

            </div>
        </div>
    </div>










    @include('assest/bottom_links')
    <script src="{{ URL::asset('/js/d-appointments.js?ver=1.4') }}></script>

</body>

</html>