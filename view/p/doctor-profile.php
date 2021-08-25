<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    
    $con = new MongoDB\Client( 'mongodb://pavan.co:27017' );
    $db = $con->php_mongo;

    $collection = $db->employee;
    $precord = $collection->findOne( [ 'p_unid' =>$_SESSION['p_unid']] );
    $pdatetime = iterator_to_array( $precord['datetime'] );

    $collection = $db->manager;
    $record = $collection->findOne( [ 'd_unid' =>$_GET['id']] );
    $datetime = iterator_to_array( $record['datetime'] );
    
?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://pavan.co/s/s/public/stylesheet/p-doctor-profile.css?ver=1.1">
    <title>Feely | Doc Profile</title>
</head>

<body>
    <?php include_once '../../assest/navbar.php'; ?>

    <!-- breadcrumb -->
    <nav class='breadc navbar-expand-lg'>
        <div class='container-fluid'>
            <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                <p class=" my-auto py-1">Home / Doctor Profile</p>
                <h5 class="my-auto py-1">Doctor Profile</h5>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="p-2 d-flex justify-content-between">
            <div class="left d-flex">
                <img src="http://pavan.co/s/s/public/image/doc-img/doc-img/default-doc.jpg" class="rounded"
                    height="160" alt="User Image">
                <div class="mx-3">
                    <h5>Dr. <?php echo $record['fname'].' '.$record['sname'] ?></h5>
                    <p>BDS, MDS - Oral & Maxillofacial Surgery</p>
                    <p class="mb-1">Dentist</p>
                    <div class="d-flex my-1">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <p class="my-0 mx-1">(35)</p>
                    </div>
                    <p class=""><i class="bi bi-geo-alt-fill"></i> <?php echo $record['contact_detail']['city'].', '.$record['contact_detail']['state'] ?> - <a href="#">Get Directions</a>
                    </p>
                    <div class="d-flex">
                        <img src="http://pavan.co/s/s/public/image/doc-img/doc-img/default-doc.jpg" class="px-2"
                            height="40" alt="User Image">
                    </div>
                    <div class="d-flex my-2">
                        <?php 
                            $c = 1;
                            foreach($record['servicesAndSpec']['services'] as $val) {
                                if($c == 3) {
                                    exit;
                                }
                                else {
                                    echo '<small class="border px-3 py-1 mx-1 rounded">'.$val.'</small>';
                                    $c++;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="right">
                <p><i class="bi bi-hand-thumbs-up-fill"></i> 99%</p>
                <p><i class="bi bi-chat-fill"></i> 35 Feedback</p>
                <p><i class="bi bi-geo-alt-fill"></i> <?php echo $record['contact_detail']['city'].', '.$record['contact_detail']['state'].', '.$record['contact_detail']['country'] ?></p>
                <p><i class="bi bi-cash-coin"></i> ₹<?php echo $record['custom_price'] ?> per hour</p>
                
                <!-- <div class="d-flex fun">
                    <button class="btn btn-sm border mx-1  bookmark" type="button"><i
                            class="bi bi-bookmark"></i></button>
                    <button class="btn btn-sm border mx-1  call" type="button"><i
                            class="bi bi-telephone-fill"></i></button>
                    <button class="btn btn-sm border mx-1  video" type="button"><i
                            class="bi bi-camera-video-fill"></i></button>
                </div> -->
                

                <?php
                    if($_SESSION['eid'] != '') {
                        echo '<a href="http://pavan.co/s/s/view/p/booking?id='.$record['d_unid'].'" class="btn btn-primary px-5 py-2 mt-2" type="button">BOOK <br>APPOINMENT</a>';
                    }
                    else {
                        echo '<button class="btn btn-primary px-5 py-2 mt-2" type="button">LOGIN</button>';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="my-4">
            <nav class="nav d-flex justify-content-around ">
                <button class="btn text-dark px-4 pb-3 active ">Overview</button>
                <button class="btn text-dark px-4 pb-3 ">Location</button>
                <button class="btn text-dark px-4 pb-3 ">Review</button>
                <button class="btn text-dark px-4 pb-3 ">Business_hours</button>
            </nav>
        </div>
        <div class="my-4 all-table">
            <!-- Overview -->
            <div class="row Overview my-3">
                <div class="widget about-widget">
                    <h4 class="widget-title">About Me</h4>
                    <p>Dr. <?php echo $record['fname'] ?> is a dentist from <?php echo $record['contact_detail']['city'].', '.$record['contact_detail']['state'] ?> and holds a bachelor's degree in <?php echo $record['education']['degree'][0] ?>
                        surgery.<br>
                        Dr. <?php echo $record['fname'] ?> is into practice for the past 21 years.
                    </p>
                </div>
                
                <div class="widget education-widget">
                    <h4 class="widget-title">Work & Experience</h4>
                    <div class="experience-box">
                        <ul class="experience-list">

                            <?php
                                foreach($record['experience'] as $val) {
                                    echo '';

                                }
                            ?>
                            <li>
                                <!-- <div class="experience-content">
                                    <div class="timeline-content">
                                        <p class="name">American Dental Medical University</p>
                                        <div>BDS</div>
                                        <span class="time">1998 - 2003</span>
                                    </div>
                                </div> -->
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget education-widget">
                    <h4 class="widget-title">Awards</h4>
                    <div class="experience-box">
                        <ul class="experience-list">
                            <li>
                                <!-- <div class="experience-user">
                                    <div class="before-circle"></div>
                                </div>
                                <div class="experience-content">
                                    <div class="timeline-content">
                                        <p class="name">American Dental Medical University</p>
                                        <div>BDS</div>
                                        <span class="time">1998 - 2003</span>
                                    </div>
                                </div> -->
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget education-widget">
                    <h4 class="widget-title">Services</h4>
                    <div class="d-flex justify-content-start">
                        <!-- <p class=" px-3 py-1 mx-1 rounded"><i class="bi bi-arrow-right"></i> Teeth Whitneing</p> -->
                    </div>
                </div>
                <div class="widget education-widget">
                    <h4 class="widget-title">Specializations</h4>
                    <div class="d-flex justify-content-start">
                        <!-- <p class=" px-3 py-1 mx-1 rounded"><i class="bi bi-arrow-right"></i> Teeth Whitneing</p>                         -->
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="row Location ">

            </div>

            <!-- Review -->
            <div class="row Review ">

            </div>

            <!-- Business-hours -->
            <div class="row Business-hours ">

            </div>
        </div>
    </div>

















    <?php include '../../assest/bottom_links.php'; ?>
    <script src='http://pavan.co/s/s/controller/js/d-patient-profile.js?ver=1.2'></script>

</body>

</html>