<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['aid'] == '') {
        header('location: http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/index');
    }
    $con = new MongoDB\Client( 'mongodb://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com:27017' );
    $db = $con->php_mongo;
    $collection = $db->admin;

    $record = $collection->findOne( [ '_id' =>$_SESSION['aid']] );


?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/public/stylesheet/dashboard.css?ver=1.6">
    <title>Admin | Dashboard</title>
</head>

<body>

    <div class="main">

        <!-- sidebar -->
        <div class="Sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" id="sidebar">
            <a href="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/view/index"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/public/image/logo.png" height="40" class="mx-auto " alt="">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/view/index" class="nav-link link-dark">
                        <i class="bi bi-speedometer bi me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/view/appoinment" class="nav-link active-sn "
                        aria-current="page">
                        <i class="bi bi-calendar-check-fill bi me-2"></i>
                        Appointments
                    </a>
                </li>
                <li>
                    <a href="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/view/specialities" class="nav-link link-dark">
                        <i class="bi bi-megaphone-fill bi me-2"></i>
                        Specialities
                    </a>
                </li>
                <li>
                    <a href="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/view/doctor" class="nav-link link-dark">
                        <i class="bi bi-person-lines-fill bi me-2"></i>
                        Doctor
                    </a>
                </li>
                <li>
                    <a href="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/view/pending_doc" class="nav-link link-dark">
                        <i class="bi bi-person-dash-fill  bi me-2"></i>
                        Pending Doc  <span class="text-end text-danger"><?php echo count($record['pendingDoc_ids']); ?></span>
                    </a>
                </li>
                <li>
                    <a href="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/view/patient" class="nav-link link-dark">
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
                        <?php echo $_SESSION['fname']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li>
                            <form action='http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/controller/php/logout.php' method='POST'>
                                <button type='submit' name='logout'
                                    class='btn btn-sm  text-nowrap text-danger px-4 mx-1'>Logout</button>
                            </form>
                        </li>   
                    </ul>
                </div>
            </div>
        </nav>


        <div class="my-5 body-main">
            <div class="my-5 mx-4">
                <h3 class="h3">Appointments</h3>
                <p>Dashboard / Appointments</p>
            </div>


            <!-- Feed Activity -->
            <div class="row apps-list">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title">Appointment List</h4>
                    </div>
                    <table class="table table-hover table-responsive table-center mb-0" id="app_table">
                        <thead class="px-auto">
                            <tr class="text-center">
                                <th class="">Doctor Name</th>
                                <th class="mx-5">Speciality</th>
                                <th>Patient Name</th>
                                <th>Apointment Time</th>
                                <th>Status</th>
                                <th class="text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="px-auto">
                            <?php
                                    $collection = $db->employee;
                                    $record_pat_app = $collection->find();                        
                                    $c = 0;
                                    foreach($record_pat_app as $keyOfPat) {
                                        foreach($keyOfPat['datetime'] as $docId=>$date_obj) {
                                            foreach($date_obj as $date=>$dateValues) {
                                                foreach($dateValues as $key=>$val) { 
                                                        $collection = $db->manager;
                                                        $record_doc_app = $collection->findOne(['d_unid' => strval($docId)]);
                                                        
                                                        echo '<tr class="px-auto">
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="profile.html" class="avatar avatar-sm mr-2"><img
                                                                                class="avatar-img rounded-circle"';
                                                                                if($record_doc_app['profile_image'] != '') {
                                                                                    echo 'src="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/public/image/doc-img/doc-img/'.$record_doc_app['profile_image'].'"';
                                                                                }
                                                                                else {
                                                                                    echo 'src="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/public/image/doc-img/doc-img/default-doc.jpg"';
                                                                                }
                                                                        echo 'height="40"
                                                                                alt="User Image"></a>
                                                                        <a href="profile.html">Dr. '.$record_doc_app['fname'].' '.$record_doc_app['sname'].'</a>
                                                                    </h2>
                                                                </td>
                                                                <td class="py-auto my-auto text-center">Dental</td>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="profile.html" class="avatar avatar-sm mr-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/public/image/ad.jpg"
                                                                                height="40"
                                                                                alt="User Image"></a>
                                                                        <a href="profile.html">'.$keyOfPat['fname'].' '.$keyOfPat['sname'].'</a>
                                                                    </h2>
                                                                </td>';
                                                                if($val['book_t'][0] <= 12) { 
                                                                    echo '<td>'.$date.' <span class="text-primary d-block">'.date('h:i', strtotime($val['book_t'][0])).' AM - '.date('h:i', strtotime($val['book_t'][1])).' AM</span></td>';
                                                                }
                                                                else {
                                                                    echo '<td>'.$date.' <span class="text-primary d-block">'.date('h:i', strtotime($val['book_t'][0])).' PM - '.date('h:i', strtotime($val['book_t'][1])).' PM</span></td>';
                                                                }
                                                                echo '<td>    
                                                                        <div class="switch_box box_1">
                                                                            <input type="checkbox" class="switch_1" checked>
                                                                        </div>
                                                                    </td>
                                                                <td class="text-right">
                                                                    '.$val['amt'].'
                                                                </td>
                                                            </tr>';
                                                        $c++; 
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
    <script src='http://ec2-13-127-72-12.ap-south-1.compute.amazonaws.com/s/admin/controller/js/dashboard.js?ver=1.5'></script>

</body>

</html>