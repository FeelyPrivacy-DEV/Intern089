<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['docid'] == '') {
        header('location: ../index.php');
    }
    $con = new MongoDB\Client( 'mongodb://localhost:27017' );
    $db = $con->php_mongo;
    $collection = $db->manager;
    $msg = '';

    if($_GET['time'] == 'equal') {
        $msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>The selected time meeting has been already scheduled!</strong> Please pick up another time scheduled.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else if($_GET['time'] == 'add' || $_GET['time'] == 'add') {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Your meeting scheduled has been saved !</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } 
    else if($_GET['slot'] == 'submit') {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Your slots has been saved !</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } 


    $record = $collection->findOne( [ '_id' =>$_SESSION['docid']] );
    $datetime = iterator_to_array( $record['datetime'] );

    $date_arr = [];
    $time_arr = [];

    foreach($datetime as $date_key=>$val) {
        $date_arr[] = $date_key;
        foreach($val as $index=>$v) {
            $time_arr[$date_key][] = $v;
        }    
    }
    $k = count( $date_arr );

?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <title>Manager | Dashboard</title>
</head>

<body>

<?php include_once '../../assest/navbar.php'; ?>

<!-- breadcrumb -->
<nav class='breadc navbar-expand-lg>
    <div class='container-fluid'>
        <div class="breadcrumb d-flex flex-column mx-4 my-auto">
            <p class=" my-auto py-1">Home / Dashboard</p>
            <h5 class="my-auto py-1">Dashboard</h5>
        </div>
    </div>
</nav>

    <?php echo $msg; ?>


    <div class="m-5 row">
        <div class="col-md-3 side-profile p-2 ">
            <div class="">
                <div class="d-flex justify-content-center mb-4">
                    <?php
                        if($record['profile_image'] != '') {
                            echo '<img src="http://localhost/s/s/public/image/doc-img/doc-img/'.$record['profile_image'].'" class="rounded" height="160" alt="User Image">';
                        }
                        else {
                            echo '<img src="http://localhost/s/s/public/image/doc-img/doc-img/default-doc.jpg" height="160" alt="User Image">';
                        }
                    ?>
                </div>
                <h4 class="text-center"><a href="#">Dr. <?php echo $record['fname'].' '.$record['sname']; ?></a></h4>
                <small class="text-center">BDS, MDS - Oral & Maxillofacial Surgery</small>
            </div>
            <div class="side-nav my-4">
            <ul class="px-0">
                    <li class=""><a href="http://localhost/s/s/view/d/index"><i class="bi bi-speedometer"></i>Dashboard</a></li>
                    <li class=""><a href="http://localhost/s/s/view/d/appointments"><i class="bi bi-calendar-check-fill"></i>Appointments</a></li>
                    <li class=""><a href="#"><i class="bi bi-person-lines-fill"></i>My Patients</a></li>
                    <li class=""><a href="http://localhost/s/s/view/d/schedule-timings" class="s-active"><i class="bi bi-hourglass-split"></i>Schedule Timimg</a></li>
                    <li class=""><a href="#"><i class="bi bi-receipt-cutoff"></i>Invoice</a></li>
                    <li class=""><a href="#"><i class="bi bi-star-fill"></i>Review</a></li>
                    <li class=""><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li>
                    <li class=""><a href="http://localhost/s/s/view/d/profile-settings"><i class="bi bi-gear-fill"></i>Profile Setting</a></li>
                    <li class=""><a href="#"><i class="bi bi-share-fill"></i>Social Media</a></li>
                    <li class=""><a href="#"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class=""><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9 scheduleds pl-5 ">
            <div class="">
                <h5>Schedule Timings</h5>
                <div class="my-3">
                    <label class="form-label ">Timing Slot Duration</label>
                    <select class="form-select py-2" aria-label="Default select example" id="time-dur-select">
                        <option selected value="0">-</option>
                        <option value="16">16 mins</option>
                        <option value="30">30 mins</option>
                        <option value="45">45 mins</option>
                        <option value="60">1 hrs</option>
                    </select>
                </div>
                <div class="days-row d-flex justify-content-between mt-5" id="days-row">
                    <?php 
                        for($i = 0; $i < 7; $i++) {
                            $date = strtotime("+$i day", strtotime("this week"));
                            $premon = date("Y-m-d", $date);
                            $a = strval($premon);
                        ?>
                            <button type="button" id="<?php echo $premon; ?>" onclick="display('<?php echo $a; ?>')" class="btn text-muted px-4 mx-1"><?php echo date("l", $date); ?></button>
                        <?php
                        }
                    ?>

                </div>
                <div class="slots-view my-5">
                    <div class="d-flex justify-content-between">
                        <h5>Time Slots</h5>
                        <button class='btn text-primary' type='button' data-bs-toggle='modal' data-bs-target='#edit_slots'>
                            <h5><i class="bi bi-pencil-square px-2"></i>Edit</h5>
                        </button>
                    </div>
                    <div class="slots-btn" id="slots-div">
                        <?php
                            $w = count($time_arr); 
                            if($w == 0) {
                                echo '<h5 class="text-danger text-center">No slots found</h5>';
                            }
                            else {
                                foreach ( $time_arr as $index=>$value ) {
                                    if($index == date('Y-m-d')) {
                                        foreach ( $value as $key=>$val ) {
                                            if($val[0] <= 12 && $val[1]) {
                                                echo '<div class="btn-group mx-2 my-1" role="group" aria-label="Basic mixed styles example">
                                                        <button type="button" class="btn btn-danger px-2">'.date('h:i', strtotime($val[0])).' AM - '.date('h:i', strtotime($val[1])).' AM</button>';
                                                        ?>
                                                        <button type="button" class="btn btn-danger" onclick="slotdelete('<?php echo $index; ?>', <?php echo $key; ?>)"><i class="bi bi-x"></i></button>
                                                <?php    
                                                        echo '</div>';
                                            }
                                            else {
                                                echo '<div class="btn-group mx-2 my-1" role="group" aria-label="Basic mixed styles example">
                                                        <button type="button" class="btn btn-danger px-2">'.date('h:i', strtotime($val[0])).' PM - '.date('h:i', strtotime($val[1])).' PM</button>';
                                                        ?>
                                                        <button type="button" class="btn btn-danger" onclick="slotdelete('<?php echo $index; ?>', <?php echo $key; ?>)"><i class="bi bi-x"></i></button>
                                                <?php    
                                                        echo '</div>';
                                            }
                                        }
                                        break;
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- add normal meeting -->
    <div class="modal fade" id="slot_delete" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
                </div>
                <div class='modal-body'>
                    <div class="my-3">
                        <h4 class="text-center text-danger">Are you sure </h4>
                    </div>
                    <div class="d-grid gap-2 my-4">
                        <button class="btn btn-danger">Yess, Sure</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='modal fade edit_slots' id='edit_slots' tabindex='-1' data-bs-backdrop='static'
        aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Edit / Add Time Slots</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'><i class="bi bi-x"></i></button>
                </div>
                <div class='modal-body'>
                    <form action="http://localhost/s/s/controller/php/add_m.php" method="POST">
                        <input type="text"  name="slotDate" hidden id="dt" value="<?php echo date('Y-m-d'); ?>">
                        <div class="editing" id="editing">
                            <div class="d-flex justify-content-start">
                                <div class='my-3 mx-2'>
                                    <label for='' class='form-label'>Start Time</label>
                                    <input type='time' name='s_time[]' class='form-control' id='s_date' value='".$val[0] ."'>
                                </div>
                                <div class='my-3 mx-2'>
                                    <label for='' class='form-label'>End Time</label>
                                    <input type='time' name='e_time[]' class='form-control' id='e_time' value='".$val[1]."'>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn text-primary" id="addMoreSlots"><i class="bi bi-plus-circle-fill px-2"></i>Add More</button>
                    </div>
                    <div class='modal-footer d-flex justify-content-center  '>
                        <button type='submit' class=' btn btn-primary text-light p-3 px-5 ' name='add_m_meeting'>Save
                            Changes</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>


    <?php include '../../assest/bottom_links.php'; ?>
    <script src='http://localhost/s/s/controller/js/d-schedule-timings.js?ver=2.0'></script>
    
</body>

</html>