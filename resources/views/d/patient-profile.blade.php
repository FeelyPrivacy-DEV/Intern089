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
    @include('assest/top_links')
    <link rel="stylesheet" href="/css/d-patient-profile.css?ver=1.2">
    <title>Feely | Doc Dashboard</title>
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
                <p class=" my-auto py-1">Home / Dashboard / Patient Profile </p>
                <h5 class="my-auto py-1">Patient Profile </h5>
            </div>
        </div>
    </nav>


    <!-- main content -->
    <div class="m-3 row">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 ">
            <div class="">
                <div class="d-flex justify-content-center mb-4">
                    <?php
                        $collection = $db->employee;
                        $record = $collection->findOne(['p_unid'=> $id]);
                        $datetime = iterator_to_array( $record['datetime'] );
                        if($record['profile_image'] != '') {
                            echo '<img src="/image/doc-img/doc-img/'.$record['profile_image'].'" class="rounded" height="160" alt="User Image">';
                        }
                        else {
                            echo '<img src="/image/doc-img/doc-img/default-doc.jpg" height="160" alt="User Image">';
                        }
                    ?>
                </div>
                <h4 class="text-center"><a><?php echo $record['fname'].' '.$record['sname']; ?></a></h4>
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
            <div id="d-dash-content">

                <p class="h5 mb-5">Patient Details</p>
                <div class="my-4">
                    <nav class="nav d-flex justify-content-around ">
                        <button class="btn text-dark px-4 pb-3 active ">Appointments</button>
                        <button class="btn text-dark px-4 pb-3 ">Prescriptions</button>
                        <button class="btn text-dark px-4 pb-3 ">Medical_Records</button>
                        <button class="btn text-dark px-4 pb-3 ">Billing</button>
                    </nav>
                    <hr class="mx-3">
                </div>
                <div class="my-2">
                    <div id="overall_warn" class="text-center"></div>
                </div>
                <div class="my-4 all-table">

                    <!-- Appointments -->
                    <div class="row Appointments table-responsive">
                        <table class="table col-md-12" id="Appointments-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">Doctor</th>
                                    <th scope="col" class="text-nowrap">App date</th>
                                    <th scope="col" class="text-nowrap">Booking Date</th>
                                    <th scope="col" class="text-nowrap">Amount</th>
                                    <th scope="col" class="text-nowrap">Follow Up</th>
                                    <th scope="col" class="text-nowrap">Status</th>
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
                                                                        echo '<img src="/image/doc-img/doc-img/'.$doc_detail['profile_image'].'" class="my-auto" height="40" alt="User Image">';
                                                                    }
                                                                    else {
                                                                        echo '<img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="User Image">';
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
                                                                    <button class="btn print btn-sm mx-1 text-nowrap"><i class="bi bi-printer"></i> Print</button>
                                                                    <button type="button" class="btn view btn-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                                        // information modal
                                                        echo '<div class="modal fade" id="info'.$c.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title">'.$doc_detail['fname'].'</h5>
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
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn prescription-btn" id="add-prescription-btn" type="button">Add
                            Prescription</button>
                    </div>
                    <div class="row Prescriptions table-responsive">
                        <table class="table  col-md-12" id="Prescriptions-table">
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
                                    $patinet_result = $collection->findOne(['p_unid' => strval($id)]);

                                    $collection = $db->manager;
                                    $doctor_result = $collection->findOne(['d_unid' => strval($_SESSION['d_unid'])]);

                                    foreach($patinet_result['prescription'] as $doctor_id => $doc_id_obj) {
                                        if($doctor_id == $_SESSION['d_unid']) {
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
                                                                <div class="d-flex justify-content-between action">
                                                                    <button class="btn print btn-sm text-nowrap mx-1"><i class="bi bi-printer mx-1"></i>Print</button>
                                                                    <button class="btn view btn-sm text-nowrap mx-1" data-bs-toggle="modal" data-bs-target="#view'.$flag.'"><i class="bi bi-eye-fill mx-1"></i>View</button>
                                                                    <button class="btn edit btn-sm text-nowrap mx-1" data-bs-toggle="modal" data-bs-target="#edit'.$flag.'"><i class="bi bi-pencil-fill mx-1"></i>Edit</button>
                                                                    <button class="btn delete btn-sm text-nowrap mx-1" onclick="delete_prescription(\''.$flag.'\', \' '.$prescription_id.' \')" id="delete-prescription'.$flag.'"><i class="bi bi-trash-fill mx-1"></i>Delete</button>
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


                                                    // Edit prescription modal
                                                    echo'<div class="modal fade" id="edit'.$flag.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                                            <div class="modal-dialog modal-lg edit-modal">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Prescription Details</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="my-2">
                                                                            <div id="edit_modal_warn'.$flag.'" class="text-center"></div>
                                                                        </div>
                                                                        <div class="edit-prescription">
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
                                                                                    <div class="d-flex justify-content-around my-2">
                                                                                        <h6 class="text-danger">Name</h6>
                                                                                        <h6 class="text-danger">Quantity</h6>
                                                                                        <h6 class="text-danger">Days</h6>
                                                                                    </div>
                                                                                ';
                                                                                    foreach($prescription_id_array as $key => $value) {
                                                                                        echo '<div class="row">
                                                                                                <div class="col-md-4 d-flex justify-content-center">
                                                                                                    <input value="'.$value['med_name'].'" id="med-name'.$flag.'" class="form-control med-name my-1" type="text" name="med-name[]" required>
                                                                                                </div>
                                                                                                <div class="col-md-4 d-flex justify-content-center">
                                                                                                    <input value="'.$value['med_qty'].'" id="med-qty'.$flag.'" class="form-control med-qty my-1" type="number" name="med-qty[]" required>
                                                                                                </div>
                                                                                                <div class="col-md-4 d-flex justify-content-center">
                                                                                                    <input value="'.$value['med_day'].'" id="med-day'.$flag.'" class="form-control med-day my-1" type="number" name="med-day[]" required>
                                                                                                </div>
                                                                                            </div>';
                                                                                    }
                                                                            echo '
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button class="btn btn-lg btn-primary px-5 save" onclick="edit_prescription(\''.$flag.'\', \' '.$prescription_id.' \')" id="edit-save'.$flag.'" type="button">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>';

                                                    $flag++;
                                                }
                                            }
                                        }
                                    }

                                ?>
                            </tbody>
                        </table>
                        <?php
                            if($flag == 1) {
                                echo '<div class="d-flex justify-content-center mx-auto" id="pres-msg">
                                        <h5 class="text-center text-primary">Nothing Here</h5>
                                    </div>';
                            }
                        ?>
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
                                        <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40"
                                            alt="" srcset="">
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
                                        <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40"
                                            alt="" srcset="">
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



            <!-- // ? Add prescription division -->
            <div class="mb-5" id="add-prescription">
                <button class="btn p-0 mb-4 back-btn" id="back-btn"><i class="bi bi-arrow-left-short my-auto"></i>
                    Back</button>
                <h5 class="mb-5">Add Prescription</h5>

                <div class="d-flex justify-content-between">
                    <div class="">
                        <div class="h5">Dr. <?php echo $_SESSION['fname'].' '.$_SESSION['sname'] ?></div>
                        <p class="my-0 text-muted">Dentist</p>
                        <p class="my-0 text-muted">Newyork, United States</p>
                    </div>
                    <div class="">
                        <h5><?php echo date('d F Y') ?></h5>
                    </div>
                </div>
                <div class="my-2">
                    <div id="pres_warn" class="text-center"></div>
                </div>
                <div class="d-flex justify-content-start mt-4">
                    <div class="d-flex pres-reason">
                        <label for="text" class="form-label text-primary text-nowrap my-auto">Give Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prescription-reason" required>
                    </div>
                    <i><small class="text-danger" id="reason_warn"></small></i>
                </div>
                <div class="d-flex justify-content-end my-2">
                    <div id="pres_warn" class="text-center"></div>
                    <button class="btn p-0 add-item" type="button" id="add-item-btn"><i class="bi bi-plus-circle-fill"></i> Add
                        Item</button>
                </div>

                <!-- prescription input -->
                <div class="prescription-input">
                    <input type="text" hidden id="patient-id" value="<?php echo $id ?>">
                    <div class="prescription-input-table">
                        <table class="table table-hover" id="Prescription-input">
                            <thead>
                                <tr>
                                    <th scope="col">Med Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Days</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input class="form-control med-name" type="text" name="med-name[]" required>
                                    </td>
                                    <td>
                                        <input class="form-control med-qty" type="number" name="med-qty[]" required>
                                    </td>
                                    <td>
                                        <input class="form-control med-day" type="number" name="med-day[]" required>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around my-auto">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="morning-check">
                                                <label class="form-check-label" for="flexCheckDefault">Morning</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="2" id="noon-check">
                                                <label class="form-check-label" for="flexCheckDefault">Noon</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="3" id="">
                                                <label class="form-check-label" for="flexCheckDefault">Night</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- doctor signature -->
                    <div class="d-flex justify-content-end my-5 doc-sign">
                        <div class="">
                            <p class="m-0">( Dr. Darren Elder )</p>
                            <p class="text-muted m-0 text-center">Signature</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start my-5">
                        <button class="btn btn-lg btn-primary px-5 save" id="save" type="button">Save</button>
                        <button class="btn btn-lg btn-secondary mx-3 px-5" type="reset">Clear</button>
                    </div>
                </div>

            </div>
        </div>
    </div>









    @include('/assest/bottom_links')
    <script src="{{ URL::asset('/js/d-patient-profile.js?ver=1.3') }}"></script>

</body>

</html>
