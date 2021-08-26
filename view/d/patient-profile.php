<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['docid'] == '') {
        header('location: http://pavan.co/s/s/index');
    }
    $con = new MongoDB\Client( 'mongodb://pavan.co:27017' );
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
    <link rel="stylesheet" href="http://pavan.co/s/s/public/stylesheet/d-patient-profile.css?ver=1.1">
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
    <div class="m-5 row">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 ">
            <div class="">
                <div class="d-flex justify-content-center mb-4">
                    <?php
                        $collection = $db->employee;
                        $record = $collection->findOne(['p_unid'=> $_POST['pat_profile_id']]);
                        $datetime = iterator_to_array( $record['datetime'] );
                        if($record['profile_image'] != '') {
                            echo '<img src="http://pavan.co/s/s/public/image/doc-img/doc-img/'.$record['profile_image'].'" class="rounded" height="160" alt="User Image">';
                        }
                        else {
                            echo '<img src="http://pavan.co/s/s/public/image/doc-img/doc-img/default-doc.jpg" height="160" alt="User Image">';
                        }
                    ?>
                </div>
                <h4 class="text-center"><a ><?php echo $record['fname'].' '.$record['sname']; ?></a></h4>
                <p class="text-center"><?php echo $record['address']['addr'] ?></p>
                <div class="d-flex justify-content-between px-4">
                    <h6>Phone</h6>
                    <p><?php echo $record['gen_info']['phone_no'] ?></p>
                </div>
                <div class="d-flex justify-content-between px-4 py-1">
                    <h6>Age</h6>
                    <p><?php echo $record['gen_info']['age'] ?></p>
                </div>
                <div class="d-flex justify-content-between px-4">
                    <h6>Blood Group</h6>
                    <p><?php echo $record['gen_info']['Blood_gr'] ?></p>
                </div>
            </div>
            <div class="side-nav my-4">

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
                                <th scope="col">Booking Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Follow Up</th>
                                <th scope="col">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $c = 1;
                                $d_collection = $db->manager;

                                foreach($datetime as $did=>$dval) {
                                    $d = strval($did);
                                    foreach($datetime as $doc_key=>$date) {
                                        if($doc_key == $d) {
                                            foreach($date as $key=>$val) {
                                                foreach($val as $k=>$v) {

                                                    $d_record = $d_collection->findOne( ["d_unid" => $_SESSION['d_unid']] );
                                                    $doc_detail = iterator_to_array($d_record);
                                                    echo'<tr class="py-5">
                                                            <td class="d-flex pat">';
                                                                    if($doc_detail['profile_image'] != '') {
                                                                        echo '<img src="http://pavan.co/s/s/public/image/doc-img/doc-img/'.$doc_detail['profile_image'].'" class="my-auto" height="40" alt="User Image">';
                                                                    }
                                                                    else {
                                                                        echo '<img src="http://pavan.co/s/s/public/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="User Image">';
                                                                    }
                                                            echo '<div>
                                                                    <p  class="text-nowrap px-2 my-auto ">'.$doc_detail['fname'].' '.$doc_detail['sname'].'</p>
                                                                    <p class="text-muted px-2 my-auto">Dental</p>
                                                                </div>
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
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title">Modal title</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>'.$doc_detail['fname'].'</p>
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
                                    }
                                }    
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Prescriptions -->
                <div class="row Prescriptions table-responsive">
                    <table class="table  col-md-12" id="">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created by</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="py-5">
                                <td class="text-nowrap">14 Nov 2019 </td>
                                <td class="text-f">Prescription 1</td>
                                <td class="d-flex pat">
                                    <img src="http://pavan.co/s/s/public/image/doc-img/doc-img/default-doc.jpg"
                                        class="my-auto" height="40" alt="" srcset="">
                                    <a href="" class="px-2 my-auto text-nowrap">
                                        Dr. Ruby Perrin
                                        <p class="text-muted my-auto">Dental</p>
                                    </a>
                                </td>
                                <td class="">
                                    <div class="d-flex action">
                                        <button class="btn btn2 btn-sm mx-1"><i class="bi bi-printer"></i>
                                            Print</button>
                                        <button class="btn btn1 btn-sm "><i class="bi bi-eye-fill"></i>
                                            View</button>
                                    </div>
                                </td>
                            </tr>
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
                                    <img src="http://pavan.co/s/s/public/image/doc-img/doc-img/default-doc.jpg"
                                        class="my-auto" height="40" alt="" srcset="">
                                    <a href="" class="px-2 my-auto text-nowrap">
                                        Dr. Ruby Perrin
                                        <p class="text-muted my-auto">Dental</p>
                                    </a>
                                </td>
                                <td class="">
                                    <div class="d-flex action">
                                        <button class="btn btn2 btn-sm mx-1"><i class="bi bi-printer"></i>
                                            Print</button>
                                        <button class="btn btn1 btn-sm "><i class="bi bi-eye-fill"></i>
                                            View</button>
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
                                    <img src="http://pavan.co/s/s/public/image/doc-img/doc-img/default-doc.jpg"
                                        class="my-auto" height="40" alt="" srcset="">
                                    <a href="" class="px-2 my-auto text-nowrap">
                                        Dr. Ruby Perrin
                                        <p class="text-muted my-auto">Dental</p>
                                    </a>
                                </td>
                                <td class="text-center">$222</td>
                                <td class="text-nowrap">14 Nov 2019 </td>
                                <td class="">
                                    <div class="d-flex action">
                                        <button class="btn btn2 btn-sm mx-1"><i class="bi bi-printer"></i>
                                            Print</button>
                                        <button class="btn btn1 btn-sm "><i class="bi bi-eye-fill"></i>
                                            View</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>










    <?php include '../../assest/bottom_links.php'; ?>
    <script src='http://pavan.co/s/s/controller/js/d-patient-profile.js?ver=1.2'></script>

</body>

</html>