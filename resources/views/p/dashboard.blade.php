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
    <link rel="stylesheet" href="/css/p-dashboard.css?ver=2.1">
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
                    <li class="px-4"><a href="/p/dashboard"  class="s-active"><i class="bi bi-speedometer"></i>Dashboard</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-bookmark-fill"></i></i>Favouriate</a></li> -->
                    <!-- <li class="px-4"><a href="http://127.0.0.1/s/s/view/p/booking"><i class="bi bi-chat-left-dots-fill"></i>Booking</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <!-- <li class="px-4"><a href="http://127.0.0.1/s/s/view/p/profile-settings"><i class="bi bi-gear-fill"></i>Profile Setting</a></li> -->
                    <li class="px-4"><a href="/p/change-password"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- body content -->
        <div class="col-md-9 d-dash-content pl-5">

            <div class="my-4">
                <nav class="nav d-flex justify-content-around ">
                    <button class="btn text-dark px-4 pb-3 active ">Appointments</button>
                    <button class="btn text-dark px-4 pb-3 ">Prescriptions</button>
                    <button class="btn text-dark px-4 pb-3 ">Medical_Records</button>
                    <button class="btn text-dark px-4 pb-3 ">Billing</button>
                </nav>
            </div>
            <div class="my-4 all-table">

                <!-- Appointments -->
                <div class="row Appointments  table-responsive">
                    <table class="table col-md-12" id="">
                        <thead>
                            <tr>
                                <th scope="col">Doctor</th>
                                <th scope="col">App date</th>
                                <th scope="col" class="text-nowrap">Booking Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Follow Up</th>
                                <th scope="col">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $c = 1;
                                $collection = $db->employee;
                                $record = $collection->findOne(['_id'=> $_SESSION['eid']]);
                                $datetime = iterator_to_array( $record['datetime'] );
                                $d_collection = $db->manager;

                                foreach($datetime as $did=>$dval) {
                                    $d = strval($did);

                                    foreach($datetime as $doc_key=>$date) {
                                        if($doc_key == $d) {
                                            foreach($date as $key=>$val) {
                                                foreach($val as $k=>$v) {

                                                    $doc_detail = $d_collection->findOne( ["d_unid" => $d] );
                                                    // $doc_detail = iterator_to_array($d_record);
                                                    echo'<tr class="py-5">
                                                            <td class="d-flex pat">';
                                                                    if($doc_detail['profile_image'] != '') {
                                                                        echo '<img src="/image/doc-img/doc-img/'.$doc_detail['profile_image'].'" class="my-auto" height="40" alt="User Image">';
                                                                    }
                                                                    else {
                                                                        echo '<img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="User Image">';
                                                                    }
                                                                    ?>
                                                                        <a href="{{route('doctor-profile', ['id'=> $doc_detail['d_unid']])}}" class="btn px-2 my-auto text-nowrap text-left" id="pat_profile">
                                                                    <?php
                                                                    echo ''.$doc_detail['fname'].' '.$doc_detail['sname'].'
                                                                        <p class="text-muted  text-left my-auto">#PT00'.$c.'</p>
                                                                    </a>
                                                            </td>';
                                                    echo '<td class="">
                                                                <p class="m-0 text-nowrap">'.$key.'</p>';
                                                            if($v['book_t'][0] <= 12) {
                                                                echo '<p class="m-0 text-primary">'.date('h:i', strtotime($v['book_t'][0])).' AM</p>';
                                                            }
                                                            else {
                                                                echo '<p class="m-0 text-primary">'.date('h:i', strtotime($v['book_t'][0])).' PM</p>';
                                                            }
                                                    echo '</td>
                                                            <td class="text-nowrap">'.$v['d_stamp'].'</td>
                                                            <td class="text-center">'.$v['amt'].'</td>
                                                            <td class="text-nowrap">16 Nov 2019</td>';
                                                            if($v['status'] == 'confirmed') {
                                                                echo '<td class="text-nowrap badge-td"><span class="badge rounded-pill confirmed">Confirm</span></td>';
                                                            }
                                                            else if($v['status'] == 'cancelled') {
                                                                echo '<td class="text-nowrap badge-td"><span class="badge rounded-pill cancelled">Cancelled</span></td>';
                                                            }
                                                            else {
                                                                echo '<td class="text-nowrap badge-td"><span class="badge rounded-pill pending">Pending</span></td>';
                                                            }
                                                            echo '<td class="">
                                                                <div class="d-flex action">
                                                                    <button class="btn btn2 btn-sm mx-1"><i class="bi bi-printer"></i> Print</button>
                                                                    <button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                        // information modal
                                                        echo '<div class="modal fade" id="info'.$c.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered ">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title">Appoinment Info</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body p-5">
                                                                    <div class="modal_warn"></div>
                                                                    <div class="p-3 d-flex justify-content-between my-2 ">
                                                                        <div class="d-flex pet-info">
                                                                            <div class="pat-img">
                                                                                <img src="/image/pat-img/default_user.png" height="110" width="110"
                                                                                    alt="" srcset="">
                                                                            </div>
                                                                            <div class="pat-det mx-4">
                                                                                <h5 class=""><a> Dr. '.$doc_detail['fname'].' '.$doc_detail['sname'].'</a></h5>';
                                                                                if($v['book_t'][0] <= 12) {
                                                                                    echo '<p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('d M Y', strtotime($key)).', '.date('h:i', strtotime($v['book_t'][0])).' AM</p>';
                                                                                }
                                                                                else {
                                                                                    echo '<p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('d M Y', strtotime($key)).', '.date('h:i', strtotime($v['book_t'][0])).' PM</p>';
                                                                                }
                                                                                echo '
                                                                                <p class="m-0 text-nowrap"><i class="bi bi-chat-left-text-fill"></i> '.$doc_detail['email'].'</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="my-3 ">
                                                                        <h6>Video call Link with doctor :</h6>';
                                                                        if($v['video_link'] == '') {
                                                                            echo '<p class="text-danger">Doctor not send link yet !</p>';
                                                                        }
                                                                        else {
                                                                            echo '<a class="btn btn-danger px-3" href="'.$v['video_link'].'"><i class="bi bi-camera-video-fill me-2"></i> Join Video call</a>';
                                                                        }
                                                                echo '</div>
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
                            ?>


                        </tbody>
                    </table>
                    <?php
                        if($c == 1) {
                            echo '<h4 class="text-center text-primary my-5">Coulden\'t find anything   !!</h4>';
                        }
                    ?>
                </div>

                <!-- Prescriptions -->
                <div class="row Prescriptions table-responsive">
                    <table class="table  col-md-12" id="">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created by</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $flag = 1;
                                $collection = $db->employee;
                                $patinet_result = $collection->findOne(['p_unid' => strval($_SESSION['p_unid'])]);

                                foreach($patinet_result['prescription'] as $doctor_id => $doc_id_obj) {
                                    $collection = $db->manager;
                                    $doctor_result = $collection->findOne(['d_unid' => strval($doctor_id)]);
                                    foreach($doc_id_obj as $date => $date_obj) {
                                        foreach($date_obj as $prescription_id => $prescription_id_array) {
                                            echo '<tr class="py-5">
                                                    <td class="text-nowrap">'.date('d M Y', strtotime($date)).'</td>
                                                    <td class="text-f">'.$prescription_id.'</td>';
                                                echo'<td class="d-flex">
                                                        <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40">
                                                        <div class="d-flex flex-column m-0 px-2">
                                                            <p class="text-nowrap m-0">Dr. '.$doctor_result['fname'].' '.$doctor_result['sname'].'</p>
                                                            <p class="text-muted m-0">Dental</p>
                                                        </div>
                                                    </td>';
                                                echo'<td>
                                                        <div class="d-flex justify-content-start action">
                                                            <button class="btn btn2 btn-sm text-nowrap mx-1"><i class="bi bi-printer mx-1"></i>Print</button>
                                                            <button class="btn btn1 btn-sm text-nowrap mx-1" data-bs-toggle="modal" data-bs-target="#view'.$flag.'"><i class="bi bi-eye-fill mx-1"></i>View</button>
                                                        </div>
                                                    </td>
                                                </tr>';



                                            // View prescription modal
                                            echo'<div class="modal fade" id="view'.$flag.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Prescription Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="view-prescription border rounded m-2">
                                                                <div class="m-3">
                                                                    <div class="d-flex justify-content-center my-3">
                                                                        <img src="/image/logo.png" height="40" alt="">
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <h6>Patient Name : '.$patinet_result['fname'].' '.$patinet_result['sname'].'</h6>
                                                                        <h6>Date : '.date('d M Y', strtotime($date)).'</h6>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <h6>Phone : </h6>
                                                                        <h6>ID : '.$prescription_id.'</h6>
                                                                    </div>
                                                                    <hr class="mx-2">
                                                                    <h1 class="text-success m-1">&#8478;</h1>
                                                                    <div class="pres m-3">
                                                                        <div class="d-flex justify-content-between my-2">
                                                                            <h6 class="text-danger">Name</h6>
                                                                            <h6 class="text-danger">Quantity</h6>
                                                                            <h6 class="text-danger">Days</h6>
                                                                        </div>
                                                                    ';
                                                                        $count = 1;
                                                                        foreach($prescription_id_array as $value) {
                                                                            echo '<div class="d-flex justify-content-between">
                                                                                    <h6 class="text-primary text-nowrap"><span class="text-dark">'.$count.'.</span> '.$value['med_name'].'</h6>
                                                                                    <p class="m-0 text-center">'.$value['med_qty'].'</p>
                                                                                    <p class="m-0 text-center">'.$value['med_day'].'</p>
                                                                                </div>';
                                                                                $count++;
                                                                        }

                                                                echo '</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';

                                            $flag++;
                                        }
                                    }
                                }

                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Medical Records -->
                <div class="row Medical_Records table-responsive">
                    <table class="table  col-md-12" id="">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Attachment</th>
                                <th scope="col">Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="py-5">
                                <td class="text-nowrap"><a href="#">#MR-0009</a></td>
                                <td class="text-nowrap">14 Nov 2019 </td>
                                <td class="text-center">Dental Filling</td>
                                <td class="text-center"><a href="#">dental-test.pdf</a></td>
                                <td class="d-flex pat">
                                    <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
                                    <a href="" class="px-2 my-auto text-nowrap">
                                            Dr. Ruby Perrin
                                        <p class="text-muted my-auto">Dental</p>
                                    </a>
                                </td>
                                <td class="">
                                    <div class="d-flex action">
                                        <button class="btn btn2 btn-sm mx-1"><i class="bi bi-printer"></i> Print</button>
                                        <button class="btn btn1 btn-sm "><i class="bi bi-eye-fill"></i> View</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Medical Records -->
                <div class="row Billing table-responsive">
                    <table class="table  col-md-12" id="">
                        <thead>
                            <tr>
                                <th scope="col">Invoice No</th>
                                <th scope="col">doctor</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Paid On</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="py-5">
                                <td class="text-nowrap"><a href="#">#INV-0010</a></td>

                                <td class="d-flex pat">
                                    <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
                                    <a href="" class="px-2 my-auto text-nowrap">
                                            Dr. Ruby Perrin
                                        <p class="text-muted my-auto">Dental</p>
                                    </a>
                                </td>
                                <td class="text-center">$222</td>
                                <td class="text-nowrap">14 Nov 2019 </td>
                                <td class="">
                                    <div class="d-flex action">
                                        <button class="btn btn2 btn-sm mx-1"><i class="bi bi-printer"></i> Print</button>
                                        <button class="btn btn1 btn-sm "><i class="bi bi-eye-fill"></i> View</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>










    @include('/assest/bottom_links')
    <script src="{{ URL::asset('/js/p-dashboard.js?ver=1.6') }}"></script>

</body>

</html>
