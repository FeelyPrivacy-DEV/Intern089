<?php
    session_start();
    use Illuminate\Http\Request;
    error_reporting(0);
    // require '../../vendor/autoload.php';
    $req = new Request();
    if($_SESSION['email'] == '') {
         header('Loacation: /');
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
    <link rel="stylesheet" href="/css/d-dashboard.css?ver=1.8">
    <title>Feely | Doc Dashboard</title>
</head>

<body>

    <div class="loading">
        <div class="spinner-border text-center" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

 
        <!-- sidebar -->
    <div class="wrapper ">
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img src="/image/brainLogo.png" alt="J">
                    </span>

                    <div class="text logo-text">
                        <span class="name">Jeev60</span> 
                    </div>
                </div>

                <!-- <i class='bx bx-chevron-right toggle'></i> -->
                <button class=" toggle" id="toggleSidebar"></button>
            </header>

            <div class="menu-bar">
                <div class="menu">  
                    <ul class="menu-links">
                        <li class="nav-links">
                            <a href="/d">
                                <i class='bx bx-home-alt icon' ></i>
                                <span class="text nav-text">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-links">
                            <a href="/d/appointments">
                                <i class='bx bx-bar-chart-alt-2 icon' ></i>
                                <span class="text nav-text">Appointments</span>
                            </a>
                        </li>

                        <li class="nav-links">
                            <a href="/d/schedule-timings">
                                <i class='bx bx-bell icon'></i>
                                <span class="text nav-text">Schedule Timimg</span>
                            </a>
                        </li>

                        <li class="nav-links">
                            <a href="/d/invoice">
                                <i class='bx bx-pie-chart-alt icon' ></i>
                                <span class="text nav-text">Invoice</span>
                            </a>
                        </li>

                        <li class="nav-links">
                            <a href="/d/profile-settings">
                                <i class='bx bx-heart icon' ></i>
                                <span class="text nav-text">Profile Setting</span>
                            </a>
                        </li>

                        <li class="nav-links">
                            <a href="/d/forgot-password">
                                <i class='bx bx-wallet icon' ></i>
                                <span class="text nav-text">Change Password</span>
                            </a>
                        </li> 
 
                    </ul>
                </div>

                <div class="bottom-content">
                    
                </div>
            </div> 
        </nav>
        

        <!-- data content -->
        <div class="col-md-9 d-dash-content pl-5">
            <!-- navbar -->
            @include('assest/navbar')

            <!-- breadcrumb -->
            <nav class='breadc navbar-expand-lg '>
                <div class='container-fluid'>
                    <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                        <p class=" my-auto py-1">Home > Dashboard</p> 
                    </div>
                </div>
            </nav>
 
            <div class="row  short-data mt-2">
                <div class="col card1 my-3 ">
                    <div class="d-flex justify-content-center">
                        <img src="/image/doc-img/icon-01.png" class="p-4" alt="" srcset="">
                        <div class="px-3 my-auto d-flex flex-column justify-content-startr">
                            <?php
                                $collection = $db->manager;
                                $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
                                $c = count($record['p_unid']);
                            ?>
                            <span class="text-nowrap">Total Patient</span>
                            <h3 class="text-nowrap"><?php echo $c; ?></h3>
                            <p class="m-0">Till Today</p>
                        </div>
                    </div>
                </div>
                <div class="col card2 m-3   ">
                    <div class="d-flex justify-content-center">
                        <img src="/image/doc-img/icon-02.png" class="p-4" alt="" srcset="">
                        <div class="px-3 my-auto d-flex flex-column justify-content-start">
                            <?php
                            $cnt = 0;
                            $collection = $db->manager;
                            $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
                            $datetime = iterator_to_array( $record['datetime'] );

                            foreach($record['p_unid'] as $punid_key) {
                                $e_collection = $db->employee;
                                $e_record = $e_collection->find(['p_unid' => $punid_key]);
                                $pat_detail = iterator_to_array($e_record);
                                foreach($pat_detail as $perticular_pat) {
                                    foreach($perticular_pat['datetime'] as $single=>$singleVal) {
                                        if($single == $_SESSION['d_unid']) {
                                            foreach($singleVal as $date=>$val) {
                                                if($date == date('Y-m-d')) {
                                                    $cnt++;
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            ?>
                            <h6 class="text-nowrap">Today's Patient</h6>
                            <h3 class="text-nowrap"><?php echo $cnt;?></h3>
                            <p class="m-0 text-nowrap"><?php echo date('d, M Y  ') ?></p>
                        </div>
                    </div>
                </div>
                <div class="col card3 my-3  ">
                    <div class="d-flex justify-content-center">
                        <img src="/image/doc-img/icon-03.png" class="p-4" alt="" srcset="">
                        <div class="px-3 my-auto d-flex flex-column justify-content-start">
                            <?php
                                $cnt = 0;
                                $collection = $db->manager;
                                $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
                                $datetime = iterator_to_array( $record['datetime'] );

                                foreach($record['p_unid'] as $punid_key) {
                                    $e_collection = $db->employee;
                                    $e_record = $e_collection->find(['p_unid' => $punid_key]);
                                    $pat_detail = iterator_to_array($e_record);
                                    foreach($pat_detail as $perticular_pat) {
                                        foreach($perticular_pat['datetime'] as $single=>$singleVal) {
                                            if($single == $_SESSION['d_unid']) {
                                                foreach($singleVal as $date=>$val) {
                                                    foreach($val as $k=>$v) {
                                                        $cnt++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                            ?>
                            <h6 class="text-nowrap"> Appoinments</h6>
                            <h3 class="text-nowrap"><?php echo $cnt; ?></h3>
                            <p class="m-0 text-nowrap"><?php echo date('d, M Y  ') ?></p>
                        </div>
                    </div>
                </div>
                <!-- <div class="col card4 m-3  ">
                    <div class="d-flex ">
                        <img src="/image/doc-img/icon-03.png" class="p-4" alt="" srcset="">
                        <div class="px-3 my-auto d-flex flex-column justify-content-start">
                            <?php
                                $cnt = 0;
                                $collection = $db->manager;
                                $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
                                $datetime = iterator_to_array( $record['datetime'] );

                                foreach($record['p_unid'] as $punid_key) {
                                    $e_collection = $db->employee;
                                    $e_record = $e_collection->find(['p_unid' => $punid_key]);
                                    $pat_detail = iterator_to_array($e_record);
                                    foreach($pat_detail as $perticular_pat) {
                                        foreach($perticular_pat['datetime'] as $single=>$singleVal) {
                                            if($single == $_SESSION['d_unid']) {
                                                foreach($singleVal as $date=>$val) {
                                                    foreach($val as $k=>$v) {
                                                        $cnt++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                            ?>
                            <h6 class="text-nowrap"> Appoinments</h6>
                            <h3 class="text-nowrap"><?php echo $cnt; ?></h3>
                            <p class="m-0 text-nowrap"><?php echo date('d, M Y  ') ?></p>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="patDetailsTable px-3">
                <div class="my-4">
                    <h5 class="mb-4">Patient Appoinments</h5>
                </div>
                <div class="my-4">
                    <nav class="nav">
                        <button class="btn text-dark px-4 active " id="upcoming">Upcoming</button>
                        <button class="btn text-dark px-4 " id="today">Today</button>
                        <input type="text" id="todayCsrfToken" hidden value="<?php echo csrf_token(); ?>">
                    </nav>
                </div>
                <!-- table -->
                <div class="my-4">
                    <div class="tableCont">
                        <table class="table table-responsive table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">App date</th>
                                    <th scope="col">Purpose</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Paid Amount</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="p_details">
                                <?php
                                        $c = 1;
                                        $collection = $db->manager;
                                        $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
                                        $datetime = iterator_to_array( $record['datetime'] );

                                        foreach($record['p_unid'] as $punid_key) {
                                            $e_collection = $db->employee;
                                            $e_record = $e_collection->find(['p_unid' => $punid_key]);
                                            $pat_detail = iterator_to_array($e_record);
                                            foreach($pat_detail as $perticular_pat) {
                                                foreach($perticular_pat['datetime'] as $single=>$singleVal) {
                                                    if($single == $_SESSION['d_unid']) {
                                                        foreach($singleVal as $date=>$val) {
                                                            if($date >= date('Y-m-d')) {
                                                                foreach($val as $k=>$v) {
                                                                    // print_r($v);

                                                                    echo'<tr class="py-5 patientDetailRow">
                                                                            <td class="d-flex pat">
                                                                                <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">';
                                                                            ?>
                                                                                <a href="{{route('patient-profile', ['id'=> $perticular_pat['p_unid']])}}" class="btn px-2 my-auto text-nowrap text-left" id="pat_profile">
                                                                            <?php
                                                                            echo ''.$perticular_pat['fname'].' '.$perticular_pat['sname'].'
                                                                                    <p class="text-muted  text-left my-auto">#PT00'.$c.'</p>
                                                                                </a>
                                                                            </td>';
                                                                    echo '<td class="">
                                                                                <p class="m-0 text-nowrap">'.date('d M Y', strtotime($date)).'</p>';
                                                                            if($v['book_t'][0] <= 12) {
                                                                                echo '<p class="m-0 text-secondary timingText">'.date('h:i', strtotime($v['book_t'][0])).' AM</p>';
                                                                            }
                                                                            else {
                                                                                echo '<p class="m-0 text-secondary timingText">'.date('h:i', strtotime($v['book_t'][0])).' PM</p>';
                                                                            }
                                                                    echo '</td>
                                                                            <td class="text-nowrap">General </td>
                                                                            <td class="text-nowrap">New</td>
                                                                            <td class="text-center">$'.$v['amt'].'</td>
                                                                            <td class="my-auto">
                                                                                <div class="d-flex action">';
                                                                                if($v['status'] == 'confirmed') {
                                                                                    echo '<button type="button" class="btn btn1 btn-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                                    <button class="btn btn2 btn-sm mx-1 text-nowrap" disabled onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'">Accepted</button>
                                                                                    <button class="btn btn3 btn-sm  text-nowrap" onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="edit'.$c.'"><i class="bi bi-x"></i> Edit </button>
                                                                                    <button class="btn btn3 btn-sm  text-nowrap" onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i>Reject</button>';
                                                                                }
                                                                                else if($v['status'] == 'cancelled') {
                                                                                    echo '<button type="button" class="btn btn1 btn-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                                    <button class="btn btn2 btn-sm mx-1 text-nowrap" onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                                                    <button class="btn btn3 btn-sm  text-nowrap" disabled onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"> Cancelled</button>';
                                                                                }
                                                                                else {
                                                                                    echo '<button type="button" class="btn btn1 btn-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                                                    <button class="btn btn2 btn-sm mx-1 text-nowrap" onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                                                    <button class="btn btn3 btn-sm  text-nowrap" onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                                                }

                                                                            echo '</div>
                                                                            </td>';
                                                                        echo '</tr>';
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
                                                                                                        <h5 class=""><a href="#">'.$perticular_pat['fname'].' '.$perticular_pat['sname'].'</a></h5>';
                                                                                                        if($v['book_t'][0] <= 12) {
                                                                                                            echo '<p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('d M Y', strtotime($date)).', '.date('h:i', strtotime($v['book_t'][0])).' AM</p>';
                                                                                                        }
                                                                                                        else {
                                                                                                            echo '<p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('d M Y', strtotime($date)).', '.date('h:i', strtotime($v['book_t'][0])).' PM</p>';
                                                                                                        }
                                                                                                        echo '<p class="m-0 "><i class="bi bi-geo-alt-fill"></i> Newyork, United States</p>
                                                                                                        <p class="m-0 "><i class="bi bi-chat-left-text-fill"></i> '.$perticular_pat['email'].'</p>
                                                                                                        <p class="m-0 "><i class="bi bi-telephone-fill"></i> +1 923 782 4575</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="my-3 ">
                                                                                                <h6>Send video call Link to Patient</h6>
                                                                                                <div class="d-flex justify-content-between">
                                                                                                    <input type="text" class="form-control me-2" id="video_call_link'.$c.'" placeholder="Paste link here" required value="'.$v['video_link'].'">
                                                                                                    <button class="btn btn-sm btn-primary" onclick="link_send(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')">Send</button>
                                                                                                </div>
                                                                                            </div>
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
                                            }
                                        }


                                    ?>

                            </tbody>
                        </table>
                        <?php
                            if($c == 1) {
                                echo '<h3 class="text-center text-secondary my-5">Nothing Here !!</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>  

    </div>





    @include('assest/bottom_links')
    <script src="{{ URL::asset('/js/d-dashboard.js?ver=1.5')}}"></script>
    <!-- <script src='http://127.0.0.1/s/s/controller/js/d-temp.js?ver=1.1'></script> -->

</body>

</html>
