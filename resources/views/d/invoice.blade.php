<?php
session_start();

use Illuminate\Http\Request;

error_reporting(0);
// require '../../vendor/autoload.php';
$req = new Request();
if ($_SESSION['email'] == '') {
    header('Loacation: /');
}

$con = new MongoDB\Client('mongodb://127.0.0.1:27017');
$db = $con->php_mongo;
$collection = $db->manager;
$msg = '';

$record = $collection->findOne(['_id' => $_SESSION['docid']]);
$datetime = iterator_to_array($record['datetime']);

$time_arr = [];

foreach ($datetime as $date_key => $val) {
    foreach ($val as $index => $v) {
        $time_arr[$date_key][] = $v;
    }
}
$k = count($time_arr);

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
        <!-- sidebar -->
        @include('assest/doctor-sidebar')


        <!-- data content -->
        <div class=" d-dash-content pl-5">
            <!-- navbar -->
            @include('assest/doctor-navbar')

            <!-- breadcrumb -->
            <nav class='breadc navbar-expand-lg'>
                <div class='container-fluid'>
                    <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                        <p class=" my-auto py-1">Home / Invoice</p>
                    </div>
                </div>
            </nav>



            <!-- body content -->
            <div class=" invoiceTables">

                <!-- table -->
                <div class="my-4">
                    <h5>Patients Invoice</h5>
                    <div class="invoice-table">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">Invoice no</th>
                                    <th scope="col" class="text-nowrap">Patient Name</th>
                                    <th scope="col" class="text-nowrap">App date</th>
                                    <th scope="col">Amount</th>
                                    <th >Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = 1;
                                $collection = $db->manager;
                                $record = $collection->findOne(['_id' => $_SESSION['docid']]);
                                $datetime = iterator_to_array($record['datetime']);

                                foreach ($record['p_unid'] as $punid_key) {
                                    $e_collection = $db->employee;
                                    $e_record = $e_collection->find(['p_unid' => $punid_key]);
                                    $pat_detail = iterator_to_array($e_record);
                                    foreach ($pat_detail as $perticular_pat) {
                                        foreach ($perticular_pat['datetime'] as $single => $singleVal) {
                                            if ($single == $_SESSION['d_unid']) {
                                                foreach ($singleVal as $date => $val) {
                                                    foreach ($val as $k => $v) {
                                                        // print_r($v);

                                                        echo '<tr class="py-5">
                                                                    <td class="">#IN00' . $c . '</td>
                                                                    <td class="d-flex pat">
                                                                        <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">';
                                ?>
                                                        <a href="{{route('patient-profile', ['id'=> $perticular_pat['p_unid']])}}" class="btn px-2 my-auto text-nowrap text-left" id="pat_profile">
                                    <?php
                                                        echo '' . $perticular_pat['fname'] . ' ' . $perticular_pat['sname'] . '
                                                                            <p class="text-muted  text-left my-auto">#PT00' . $c . '</p>
                                                                        </a>
                                                                    </td>';
                                                        echo '<td class="">
                                                                        <p class="m-0 text-nowrap">' . $date . '</p>';
                                                        if ($v['book_t'][0] <= 12) {
                                                            echo '<p class="m-0 text-primary">' . date('h:i', strtotime($v['book_t'][0])) . ' AM</p>';
                                                        } else {
                                                            echo '<p class="m-0 text-primary">' . date('h:i', strtotime($v['book_t'][0])) . ' PM</p>';
                                                        }
                                                        echo '</td>
                                                                    <td></td>
                                                                    <td class="">
                                                                        <div class="d-flex action">';
                                                        echo '<button type="button" class="btn btn1 btn-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#info' . $c . '"><i class="bi bi-eye-fill"></i> Invoice</button>';

                                                        echo '</div>
                                                                    </td>';
                                                        echo '</tr>';
                                                        // information modal
                                                        echo '<div class="modal fade" id="info' . $c . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                <h5 class="modal-title">Invoice</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="container">
                                                                                        <div class="d-flex justify-content-between my-3 ">
                                                                                            <img src="/image/logo.png" height="50" alt="">
                                                                                            <div class="d-flex flex-column text-end">
                                                                                                <p class="m-0 p-0"><strong>Order: </strong>#IN00' . $c . '</p>
                                                                                                <p class="m-0 p-0"><strong>Issued: ' . $date . '</strong></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-between my-4 ">
                                                                                            <div class="d-flex flex-column">
                                                                                                <p class="m-0 p-0 text-nowrap"><strong>Invoice From </strong></p>
                                                                                                <p class="m-0 p-0 text-nowrap text-muted">Dr. ' . $_SESSION['fname'] . '</p>
                                                                                                <p class="m-0 p-0 text-nowrap text-muted">806 Twin Willow Lane, Old Forge,</p>
                                                                                                <p class="m-0 p-0 text-nowrap text-muted">Newyork, USA</p>
                                                                                            </div>
                                                                                            <div class="d-flex flex-column text-end">
                                                                                                <p class="m-0 p-0 text-nowrap"><strong>Invoice To </strong></p>
                                                                                                <p class="m-0 p-0 text-nowrap text-muted">' . $perticular_pat['fname'] . '</p>
                                                                                                <p class="m-0 p-0 text-nowrap text-muted">299 Star Trek Drive, Panama City,</p>
                                                                                                <p class="m-0 p-0 text-nowrap text-muted">Florida, 32405, USA</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-between my-4 ">
                                                                                            <div class="d-flex flex-column">
                                                                                                <p class="m-0 p-0 text-nowrap"><strong>Payment Method </strong></p>
                                                                                                <p class="m-0 p-0 text-nowrap text-muted">Free</p>
                                                                                            </div>
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


                                    ?>

                            </tbody>
                        </table>
                        <?php
                        if ($c == 1) {
                            echo '<h3 class="text-center text-primary my-5">Nothing Here !!</h3>';
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