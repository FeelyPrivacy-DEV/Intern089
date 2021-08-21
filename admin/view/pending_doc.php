<?php

    error_reporting(0); 
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['aid'] == '') {
        header('location: http://128.199.27.158/s/admin/index');
    }
    $con = new MongoDB\Client( 'mongodb://test.com:27017' );
    $db = $con->php_mongo;
    $collection = $db->admin;

    $record = $collection->findOne( [ '_id' =>$_SESSION['aid']] );



?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://128.199.27.158/s/admin/public/stylesheet/dashboard.css?ver=2.5">
    <title>Admin | Dashboard</title>
</head>

<body>

    <div class="main">

        <!-- sidebar -->
        <div class="Sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" id="sidebar">
            <a href="http://128.199.27.158/s/admin/view/index"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="http://128.199.27.158/s/admin/public/image/logo.png" height="40" class="mx-auto " alt="">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="">
                    <a href="http://128.199.27.158/s/admin/view/index" class="nav-link link-dark">
                        <i class="bi bi-speedometer bi me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="http://128.199.27.158/s/admin/view/appoinment" class="nav-link link-dark">
                        <i class="bi bi-calendar-check-fill bi me-2"></i>
                        Appointments
                    </a>
                </li>
                <li>
                    <a href="http://128.199.27.158/s/admin/view/specialities" class="nav-link link-dark">
                        <i class="bi bi-megaphone-fill bi me-2"></i>
                        Specialities
                    </a>
                </li>
                <li>
                    <a href="http://128.199.27.158/s/admin/view/doctor" class="nav-link link-dark">
                        <i class="bi bi-speedometer bi me-2"></i>
                        Doctor
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://128.199.27.158/s/admin/view/pending_doc" class="nav-link text-nowrap active-sn"
                        aria-current="page">
                        <i class="bi bi-person-dash-fill  bi me-2"></i>
                        Pending Doc  <span class="text-end text-danger"><?php echo count($record['pendingDoc_ids']); ?></span>
                    </a>
                </li>
                <li>
                    <a href="http://128.199.27.158/s/admin/view/patient" class="nav-link link-dark">
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
                            <form action='http://128.199.27.158/s/admin/controller/php/logout.php' method='POST'>
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
            <div class="col-md-12">
                <table class="table table-hover table-responsive mb-0" id="doc_table">
                    <thead>
                        <tr class="text-center">
                            <th>Doctor Name</th>
                            <th>Member Since</th>
                            <th>Contact Email</th>
                            <th>Approval Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $collection = $db->manager;
                            $record_doc = $collection->find();

                            foreach($record_doc as $each) {
                                if($each['approved'] == false) {
                                    echo '<tr class="py-3" id="trid'.$each['d_unid'].'">';
                                    echo '<td>Dr. '.$each['fname'].' '.$each['sname'].'</td>
                                            <td>'.$each['gen_info']['member_since'].'</td>
                                            <td>'.$each['email'].'</td>';
                                        
                                                echo '<td>
                                                        <div class="switch_box box_1">
                                                            <input type="checkbox" class="switch_1"  onchange="AllowIt(\''.$each['d_unid'].'\')" id="checkAllow'.$each['d_unid'].'"  value="0">
                                                        </div>
                                                    </td>';
                                            
                                            
                                    echo '</tr>';
                                }
                            }        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    <?php include '../../assest/bottom_links.php'; ?>
    <script src='http://128.199.27.158/s/admin/controller/js/dashboard.js?ver=1.7  '></script>

</body>

</html>