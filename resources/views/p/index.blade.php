<?php

    use Symfony\Component\Routing\Route as route;

    error_reporting(0);
    session_start();
    // require '../../vendor/autoload.php';
    if(isset($_SESSION['eid'])) {
        // redirect('/p-login');
        header('location: /p-login');
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
    @include('assest/top_links')
    <link rel="stylesheet" href="/css/p-dashboard.css?ver=1.8">
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
                <p class=" my-auto py-1">Home / Select Doctor</p>
                <h5 class="my-auto py-1">Select Doctor</h5>
            </div>
        </div>
    </nav>


    <!-- main content -->
    <div class="m-2 row">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 border">
            <div class="">
                <div class="d-flex justify-content-center mb-4">
                    <img src="/image/pat-img/default_user.png" height="150"
                        class="rounded-circle" alt="">
                </div>
                <h4 class="text-center text-nowrap"><a href="#"><?php echo $record['fname'].' '.$record['sname']; ?></a></h4>
                <p class="text-center">24 Jul 1983, 38 years</p>
                <p class="text-center"> Newyork, USA</p>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-outline-primary sidebtn fw-bold px-4 my-3"><i class="bi bi-list"></i></button>
            </div>
            <div class="side-nav my-4">
                <ul class="px-0">
                    <li class="px-4"><a href="/p" class="s-active"><i
                                class="bi bi-person-bounding-box"></i>Select Doctor</a></li>
                    <li class="px-4"><a href="/p/dashboard"><i
                                class="bi bi-speedometer"></i>Dashboard</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-bookmark-fill"></i></i>Favouriate</a></li> -->
                    <!-- <li class="px-4"><a href="http://127.0.0.1/s/s/view/p/booking"><i
                                class="bi bi-chat-left-dots-fill"></i>Booking</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <!-- <li class="px-4"><a href="http://127.0.0.1/s/s/view/p/profile-settings"><i
                                class="bi bi-gear-fill"></i>Profile Setting</a></li> -->
                    <li class="px-4"><a href="#"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- body content -->
        <div class="col-md-9 d-dash-content pl-5">
            <h4 class="container my-3">Select Doctor</h4>
            <?php
                $collection = $db->manager;
                $doc = $collection->find();

                foreach($doc as $key=>$docval) {
                    if($docval['approved'] == true) {
                        if($docval['login_able'] == true) {
                            ?>
                                <div class="container my-5">
                                    <div class="p-2 d-flex doc_block justify-content-between">
                                        <div class="left d-flex">
                                            <img src="/image/doc-img/doc-img/default-doc.jpg" class="rounded all_doc_img"
                                                height="160" alt="User Image">
                                            <div class="mx-3">
                                                <h5 class="text-nowrap">Dr. <?php echo $docval['fname'].' '.$docval['sname'] ?></h5>
                                                <p class="text-nowrap">BDS</p>
                                                <p class="mb-1 text-nowrap">Dentist</p>
                                                <div class="d-flex my-1">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <p class="my-0 mx-1">(35)</p>
                                                </div>
                                                <p class="text-nowrap"><i class="bi bi-geo-alt-fill"></i>
                                                    <?php echo $docval['contact_detail']['city'].' '.$docval['contact_detail']['state'] ?>
                                                    <a href="#"></a>
                                                </p>
                                                <div class="d-flex">
                                                    <img src="/image/doc-img/doc-img/default-doc.jpg" class="px-2"
                                                        height="40" alt="User Image">
                                                </div>
                                                <div class="d-flex my-2">
                                                    <?php
                                                        $c = 1;
                                                            foreach($docval['servicesAndSpec']['services'] as $val) {
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
                                            <p class="mb-1"><i class="bi bi-hand-thumbs-up-fill"></i> 99%</p>
                                            <p class="mb-1"><i class="bi bi-chat-fill"></i> 35 Feedback</p>
                                            <p class="mb-1"><i class="bi bi-geo-alt-fill"></i>
                                                <?php echo $docval['contact_detail']['city'].' '.$docval['contact_detail']['state'].' '.$docval['contact_detail']['country'] ?>
                                            </p>
                                            <p class="mb-1"><i class="bi bi-cash-coin"></i> ₹<?php echo $docval['custom_price'] ?> per hour</p>
                                            <div class="d-flex flex-column">
                                                <a href="{{route('doctor-profile', ['id'=> $docval['d_unid']])}}" class="btn btn-outline-primary px-5 py-2 mt-2" type="button">View Profile</a>

                                                <?php
                                                    if($_SESSION['eid'] != '') {
                                                        ?>
                                                            <a href="{{route('booking', ['id'=> $docval['d_unid']])}}" class="btn btn-primary px-5 py-2 mt-2" type="button">BOOK <br>APPOINMENT</a>
                                                        <?php
                                                    }
                                                    else {
                                                        echo '<button class="btn btn-primary px-5 py-2 mt-2" type="button">LOGIN</button>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php

                        }
                    }
                }

            ?>


        </div>
    </div>




    @include('assest/bottom_links')
    <script src="{{ URL::asset('/js/p-dashboard.js?ver=2.5') }}"></script>
</body>

</html>
