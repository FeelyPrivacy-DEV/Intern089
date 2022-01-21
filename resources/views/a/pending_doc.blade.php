<?php

    // error_reporting(0);
    session_start();
    if($_SESSION['aid'] == '') {
        header('location: https://test.feelyprivacy.com/s/admin/index');
    }
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;
    $collection = $db->admin;

    $record = $collection->findOne( [ '_id' =>$_SESSION['aid']] );



?>

<!doctype html>
<html lang='en'>

<head>
    @include('/assest/top_links')
    <link rel="stylesheet" href="/css/admin/dashboard.css?ver=2.5">
    <title>Admin | Dashboard</title>
</head>

<body>
    <div class="loading">
        <div class="spinner-border text-center" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="main">

        <!-- sidebar -->
        <div class="Sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" id="sidebar">
            <a href="/a/dashboard"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="/image/logo.png" height="40" class="mx-auto " alt="">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="">
                    <a href="/a/dashboard" class="nav-link link-dark">
                        <i class="bi bi-speedometer bi me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/a/appoinment" class="nav-link link-dark">
                        <i class="bi bi-calendar-check-fill bi me-2"></i>
                        Appointments
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link link-dark">
                        <i class="bi bi-megaphone-fill bi me-2"></i>
                        Specialities
                    </a>
                </li>
                <li>
                    <a href="/a/doctor" class="nav-link link-dark">
                        <i class="bi bi-speedometer bi me-2"></i>
                        Doctor
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/a/pending-doctor" class="nav-link text-nowrap active-sn" aria-current="page">
                        <i class="bi bi-person-dash-fill  bi me-2"></i>
                        Pending Doc <span
                            class="text-end text-danger"><?php echo count($record['pendingDoc_ids']); ?></span>
                    </a>
                </li>
                <li>
                    <a href="/a/patient" class="nav-link link-dark">
                        <i class="bi bi-file-person bi me-2"></i>
                        Patients
                    </a>
                </li>
            </ul>
            <hr>
        </div>

        <!-- navbar -->
        <nav class="navbar navbar-light bg-light fixed-top d-flex justify-content-between">
            <div class="container-fluid">
                <button class="btn" id="btn-side"><i class="bi bi-grip-horizontal"></i></button>
                <div class="">
                    <input type="text" class="border rounded-pill px-4 py-2 mx-4 my-0" placeholder="Search Here">
                    <i class="bi bi-search"></i>
                </div>
                <div class="btn-group dropdown">
                    <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['fullname']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <form action='/logout' method='POST'>
                                @csrf
                                <button type='submit' name='logout'
                                    class='btn btn-sm  text-nowrap text-danger px-4 mx-1'>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <div class="my-5 body-main ">
            <div class="my-5 mx-4">
                <h3 class="h3">Pending Approval Doctor</h3>
                <p>Dashboard / Pending Approval Doctor</p>
            </div>
            <div class="pend_warn"></div>
            <div class="col-md-12">
                <table class="table table-hover table-responsive mb-0" id="doc_table">
                    <thead>
                        <tr class="text-center">
                            <th>Doctor Name</th>
                            <th>Member Since</th>
                            <th>Contact Email</th>
                            <th>Approval Status</th>
                            <th>Under Review</th>
                            <th>Reject</th>
                        </tr>
                    </thead>
                    <tbody id="pend_docs">
                        <?php
                            $collection = $db->manager;
                            $record_doc = $collection->find();
                            $c = 0;
                            foreach($record_doc as $each) {
                                if($each['approved'] == false) {
                                    echo '<tr class="py-3" id="trid'.$each['d_unid'].'">';
                                    echo '<td class="d-flex justify-content-start text-start">
                                            <button class="btn d-flex justify-content-start text-danger" type="button" data-bs-toggle="modal" data-bs-target="#name'.$c.'">
                                                Dr. '.$each['fname'].' '.$each['sname'].'
                                            </button>
                                        </td>

                                        <td>'.$each['gen_info']['member_since'].'</td>
                                        <td>'.$each['email'].'</td>';

                                    echo '<td>
                                            <div class="switch_box box_1">
                                                <input type="checkbox" class="switch_1"  onchange="AllowIt(\''.$each['d_unid'].'\')" id="checkAllow'.$each['d_unid'].'" value="0">
                                            </div>
                                        </td>';
                                        if($each['under_review'] == false) {
                                            echo '<td>
                                                    <div class="switch_box box_1">
                                                        <input type="checkbox" class="switch_2"  onchange="UnderReview(\''.$each['d_unid'].'\')" id="UnderReview'.$each['d_unid'].'">
                                                    </div>
                                                </td>';
                                        }else {
                                            echo '<td>
                                                    <div class="switch_box box_1">
                                                        <input type="checkbox" class="switch_2"  onchange="removeUnderReview(\''.$each['d_unid'].'\')" id="removeUnderReview'.$each['d_unid'].'" checked>
                                                    </div>
                                                </td>';
                                        }
                                        if($each['reject_doc'] == false) {
                                            echo '<td>
                                                <div class="switch_box box_1">
                                                        <input type="checkbox" class="switch_3"  onchange="Reject(\''.$each['d_unid'].'\')" id="checkReject'.$each['d_unid'].'" value="0">
                                                    </div>
                                                </td>';
                                        }
                                        else {
                                            echo '<td>
                                                <div class="switch_box box_1">
                                                        <input type="checkbox" class="switch_3"  onchange="removeReject(\''.$each['d_unid'].'\')" id="removeReject'.$each['d_unid'].'" checked>
                                                    </div>
                                                </td>';
                                        }
                                    echo '</tr>';


                                    echo '<div class="modal fade" id="name'.$c.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title">Doctor Info</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="p-3 d-flex flex-column ">
                                                            <h6 class=""><strong class="text-info">Mobile No :- </strong>'.$each['gen_info']['phone_no'].'</h6>
                                                            <h6 class=""><strong class="text-info">Medical Id :- </strong>'.$each['gen_info']['medical_licence_number'].'</h6>
                                                            <h6 class=""><strong class="text-info">Address :- </strong>'.$each['contact_detail']['addressLine'].'</h6>
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
                        ?>
                    </tbody>
                </table>
                <p id="warn"></p>
            </div>
        </div>
    </div>




    @include('/assest/bottom_links')
    <script src="{{ URL::asset('/js/admin/dashboard.js?ver=1.9') }}"></script>

</body>

</html>
