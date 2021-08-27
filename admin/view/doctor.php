<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['aid'] == '') {
        header('location: http://test.feelyprivacy.com/s/admin/index');
    }
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;
    $collection = $db->admin;

    $record = $collection->findOne( [ '_id' =>$_SESSION['aid']] );



?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://test.feelyprivacy.com/s/admin/public/stylesheet/dashboard.css?ver=1.2">
    <title>Admin | Dashboard</title>
</head>

<body>

    <div class="main">

        <!-- sidebar -->
        <div class="Sidebar d-flex flex-column flex-shrink-0 p-3 bg-light" id="sidebar">
            <a href="http://test.feelyprivacy.com/s/admin/view/index"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <img src="http://test.feelyprivacy.com/s/admin/public/image/logo.png" height="40" class="mx-auto " alt="">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="">
                    <a href="http://test.feelyprivacy.com/s/admin/view/index" class="nav-link link-dark">
                        <i class="bi bi-speedometer bi me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="http://test.feelyprivacy.com/s/admin/view/appoinment" class="nav-link link-dark">
                        <i class="bi bi-calendar-check-fill bi me-2"></i>
                        Appointments
                    </a>
                </li>
                <li>
                    <a href="http://test.feelyprivacy.com/s/admin/view/specialities" class="nav-link link-dark">
                        <i class="bi bi-megaphone-fill bi me-2"></i>
                        Specialities
                    </a>
                </li>
                <li class="nav-item">
                    <a href="http://test.feelyprivacy.com/s/admin/view/index" class="nav-link active-sn" aria-current="page">
                        <i class="bi bi-speedometer bi me-2"></i>
                        Doctor
                    </a>
                </li>
                <li>
                    <a href="http://test.feelyprivacy.com/s/admin/view/pending_doc" class="nav-link link-dark">
                        <i class="bi bi-person-dash-fill  bi me-2"></i>
                        Pending Doc  <span class="text-end text-danger"><?php echo count($record['pendingDoc_ids']); ?></span>
                    </a>
                </li>
                <li>
                    <a href="http://test.feelyprivacy.com/s/admin/view/patient" class="nav-link link-dark">
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
                            <form action='http://test.feelyprivacy.com/s/admin/controller/php/logout.php' method='POST'>
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
                <h3 class="h3">Doctor</h3>
                <p>Dashboard / Doctor</p>
            </div>


            <!-- doc and patient list -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <h4 class="card-title">Doctors List</h4>
                    </div>
                    <table class="table table-hover table-responsive table-center mb-0" id="doc_table">
                        <thead>
                            <tr class="text-center">
                                <th>Doctor Name</th>
                                <th>Speciality</th>
                                <th>Member Since</th>
                                <th>Earned</th>
                                <th>Account Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $collection = $db->manager;
                                $record_doc = $collection->find();

                                foreach($record_doc as $key) {
                                    if($key['approved'] == true) {
                                        echo '<tr>
                                                <td>
                                                    <h2 class="table-avatar">';
                                                    if($key['profile_image'] != '') {
                                                        echo '<a href="#" class="avatar avatar-sm mr-2"><img
                                                                    class="avatar-img rounded-circle"
                                                                    src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/'.$key['profile_image'].'"
                                                                    height="40" alt="User Image"></a>
                                                            <a href="#">Dr. '.$key['fname'].' '.$key['sname'].'</a>';
                                                    }
                                                    else {
                                                        echo '<a href="#" class="avatar avatar-sm mr-2"><img
                                                                    class="avatar-img rounded-circle"
                                                                    src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg"
                                                                    height="40" alt="User Image"></a>
                                                            <a href="#">Dr. '.$key['fname'].' '.$key['sname'].'</a>';
                                                    }
                                            echo '</h2>
                                                </td>
                                                <td>Dental</td>
                                                <td>'.$key['gen_info']['member_since'].'</td>
                                                <td>$'.$key['total_earn'].'</td>';

                                                if($key['login_able'] == true) {
                                                    echo '<td>
                                                            <div class="switch_box box_1">
                                                                <input type="checkbox" class="switch_1" checked onchange="disableIt(\''.$key['d_unid'].'\')" id="check'.$key['d_unid'].'"  value="1">
                                                            </div>
                                                        </td>';
                                                }
                                                else {
                                                    echo '<td>
                                                            <div class="switch_box box_1">
                                                                <input type="checkbox" class="switch_1" onchange="disableIt(\''.$key['d_unid'].'\')" id="check'.$key['d_unid'].'" value="0">
                                                            </div>
                                                        </td>';
                                                }

                                            echo '</tr>';
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
    <script src='http://test.feelyprivacy.com/s/admin/controller/js/dashboard.js?ver=2.0'></script>

</body>

</html>