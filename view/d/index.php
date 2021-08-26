<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['docid'] == '') {
        header('location: http://test.feelyprivacy.com/s/index');
    }
    $con = new MongoDB\Client( 'mongodb://test.feelyprivacy.com:27017' );
    $db = $con->php_mongo;
    $collection = $db->manager;
    $msg = '';

    $record = $collection->findOne( [ '_id' =>$_SESSION['docid']] );
    $datetime = iterator_to_array( $record['datetime'] );

    $time_arr = [];

    foreach($datetime as $date_key=>$val) {
        foreach($val as $index=>$v) {
            $time_arr[$date_key][] = $v;
        }    
    }
    $k = count( $time_arr );

?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://test.feelyprivacy.com/s/public/stylesheet/d-dashboard.css?ver=1.7">
    <title>Feely | Doc Dashboard</title>
</head>

<body>
    <?php include_once '../../assest/navbar.php'; ?>

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
    <div class="row m-5">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 ">
            <div class="">
                <div class="d-flex justify-content-center mb-4">
                <?php
                        if($record['profile_image'] != '') {
                            echo '<img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/'.$record['profile_image'].'" class="rounded" height="160" alt="User Image">';
                        }
                        else {
                            echo '<img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg" height="160" alt="User Image">';
                        }
                    ?>
                </div>
                <h4 class="text-center"><a href="#">Dr. <?php echo $record['fname'].' '.$record['sname']; ?></a></h4>
                <small class="text-center mx-auto">BDS, MDS - Oral & Maxillofacial Surgery</small>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-outline-primary sidebtn fw-bold px-4 my-3"><i class="bi bi-list"></i></button>
            </div>
            <div class="side-nav my-4">
                <ul class="px-0">
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/d/index"  class="s-active"><i
                                class="bi bi-speedometer"></i>Dashboard</a></li>
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/d/appointments"><i
                                class="bi bi-calendar-check-fill"></i>Appointments</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-person-lines-fill"></i>My Patients</a></li>
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/d/schedule-timings"><i
                                class="bi bi-hourglass-split"></i>Schedule Timimg</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-receipt-cutoff"></i>Invoice</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-star-fill"></i>Review</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/d/profile-settings"><i
                                class="bi bi-gear-fill"></i>Profile Setting</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-share-fill"></i>Social Media</a></li> -->
                    <li class="px-4"><a href="#"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>   
            </div>
        </div>
        <!-- body content -->
        <div class="col-md-9 d-dash-content pl-5">
            <div class="row d-flex justify-content-between short-data">
                <div class="col-md-3 m-4">
                    <div class="d-flex">
                        <img src="http://test.feelyprivacy.com/s/public/image/doc-img/icon-01.png" class="p-4" alt="" srcset="">
                        <div class="px-3 my-auto d-flex flex-column justify-content-startr">
                            <?php
                                $collection = $db->manager;
                                $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
                                $c = count($record['p_unid']);
                            ?>
                            <h6 class="text-nowrap">Total Patient</h6>
                            <h3 class="text-nowrap"><?php echo $c; ?></h3>
                            <p class="m-0">Till Today</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 m-4 ">
                    <div class="d-flex">
                        <img src="http://test.feelyprivacy.com/s/public/image/doc-img/icon-02.png" class="p-4" alt="" srcset="">
                        <div class="px-3 my-auto d-flex flex-column justify-content-start">
                            <h6 class="text-nowrap">Today's Patient</h6>
                            <h3 class="text-nowrap">1500</h3>
                            <p class="m-0 text-nowrap"><?php echo date('d, M Y  ') ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 m-4 ">
                    <div class="d-flex ">
                        <img src="http://test.feelyprivacy.com/s/public/image/doc-img/icon-03.png" class="p-4" alt="" srcset="">
                        <div class="px-3 my-auto d-flex flex-column justify-content-start">
                            <h6 class="text-nowrap">Appoinments</h6>
                            <h3 class="text-nowrap">1500</h3>
                            <p class="m-0 text-nowrap"><?php echo date('d, M Y  ') ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4">
                <h5 class="mb-4">Patient Appoinment</h5>
            </div>
            <div class="my-4">
                <nav class="nav">
                    <button class="btn text-dark px-4 active " id="upcoming">Upcoming</button>
                    <button class="btn text-dark px-4 " id="today">Today</button>
                </nav>
            </div>
            <!-- table -->
            <div class="my-4">
                <div class="tableCont">
                    <table class="table  table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Patient Name</th>
                                <th scope="col">App date</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Type</th>
                                <th scope="col">Paid Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="p_details">
                            <?php
                                    $c = 1;
                                    $collection = $db->manager;
                                    $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
                                    $datetime = iterator_to_array( $record['datetime'] );

                                    foreach($record['p_unid'] as $punid_key) {
                                        $e_collection = $db->employee;
                                        $e_record = $e_collection->find(['p_unid' => $punid_key]);
                                        $pat_detail = iterator_to_array($e_record);
                                        foreach($pat_detail as $perticular_pat) {
                                            foreach($perticular_pat['datetime'] as $single=>$singleVal) {
                                                if($single == $_SESSION['d_unid']) {
                                                    foreach($singleVal as $date=>$val) {
                                                        if($date >= date('Y-m-d')) {
                                                            foreach($val as $k=>$v) {
                                                                // print_r($v);
                                                                
                                                                echo'<tr class="py-5">
                                                                        <td class="d-flex pat">
                                                                            <img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
                                                                            <form action="http://test.feelyprivacy.com/s/view/d/patient-profile" method="POST">
                                                                            <button class="btn px-2 my-auto text-nowrap text-left" id="pat_profile">
                                                                                '.$perticular_pat['fname'].' '.$perticular_pat['sname'].'
                                                                                <p class="text-muted  text-left my-auto">#PT00'.$c.'</p>
                                                                            </button>
                                                                            <input type="text" hidden name="pat_profile_id" value="'.$punid_key.'" id="pat_profile_id">
                                                                            </form>
                                                                        </td>';
                                                                echo '<td class="">
                                                                            <p class="m-0 text-nowrap">'.$date.'</p>';
                                                                        if($v['book_t'][0] <= 12) {
                                                                            echo '<p class="m-0 text-primary">'.date('h:i', strtotime($v['book_t'][0])).' AM</p>';    
                                                                        }        
                                                                        else {
                                                                            echo '<p class="m-0 text-primary">'.date('h:i', strtotime($v['book_t'][0])).' PM</p>';    
                                                                        }
                                                                echo '</td>
                                                                        <td class="text-nowrap">General </td>
                                                                        <td class="text-nowrap">New</td>
                                                                        <td class="text-center">$'.$v['amt'].'</td>
                                                                        <td class="">
                                                                            <div class="d-flex action">';
                                                                            if($v['status'] == 'confirmed') {
                                                                                echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                                <button class="btn btn2 btn-sm mx-1" disabled onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'">Accepted</button>
                                                                                <button class="btn btn3 btn-sm " onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                                            }
                                                                            else if($v['status'] == 'cancelled') {
                                                                                echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                                <button class="btn btn2 btn-sm mx-1" onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                                                <button class="btn btn3 btn-sm " disabled onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"> Cancelled</button>';
                                                                            }
                                                                            else {
                                                                                echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                                <button class="btn btn2 btn-sm mx-1" onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                                                <button class="btn btn3 btn-sm " onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                                            }
                                                                            
                                                                        echo '</div>
                                                                        </td>';
                                                                    echo '</tr>'; 
                                                                    // information modal 
                                                                    echo '<div class="modal fade" id="info'.$c.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered ">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                    <h5 class="modal-title">Modal title</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body p-5">
                                                                                        <div class="p-3 d-flex justify-content-between my-2 ">
                                                                                            <div class="d-flex pet-info">
                                                                                                <div class="pat-img">
                                                                                                    <img src="http://test.feelyprivacy.com/s/public/image/pat-img/default_user.png" height="110" width="110"
                                                                                                        alt="" srcset="">
                                                                                                </div>
                                                                                                <div class="pat-det mx-4">
                                                                                                    <h5 class=""><a href="#">'.$perticular_pat['fname'].' '.$perticular_pat['sname'].'</a></h5>
                                                                                                    <p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('Y M d', strtotime($key)).', '.$v['book_t'][0].' AM</p>
                                                                                                    <p class="m-0 "><i class="bi bi-geo-alt-fill"></i> Newyork, United States</p>
                                                                                                    <p class="m-0 "><i class="bi bi-chat-left-text-fill"></i> '.$perticular_pat['email'].'</p>
                                                                                                    <p class="m-0 "><i class="bi bi-telephone-fill"></i> +1 923 782 4575</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>';
                                                                $c++;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }    
                                ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>









    <?php include '../../assest/bottom_links.php'; ?>
    <script src='http://test.feelyprivacy.com/s/controller/js/d-dashboard.js?ver=1.4'></script>
    <!-- <script src='http://test.feelyprivacy.com/s/controller/js/d-temp.js?ver=1.1'></script> -->

</body>

</html>