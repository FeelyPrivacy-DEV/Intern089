<?php

    // error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['eid'] == '') {
        header('location: https://test.feelyprivacy.com/s/index');
    }

?>
<!doctype html>
<html lang="en">

<head>
    <?php include '../../assest/top_links.php'; ?>
    <title>Manager | Dashboard</title>
</head>

<body>
<?php include_once '../../assest/navbar.php'; ?>

<!-- breadcrumb -->
<nav class='breadc navbar-expand-lg'>
    <div class='container-fluid'>
        <div class="breadcrumb d-flex flex-column mx-4 my-auto">
            <p class=" my-auto py-1">Home / Success</p>
            <h5 class="my-auto py-1">Success</h5>
        </div>
    </div>
</nav>


    <!-- success card -->
    <div class="container border my-5">
        <div class="success-cont">
            <i class="bi bi-check-circle-fill text-success d-flex justify-content-center my-4"></i>
            <h3 class="text-center">Appointment booked Successfully!</h3>
            <p class="text-center">Appointment booked with <strong>Dr. Darren Elder</strong><br> on <strong><p id="success_date"></p> <p id="success-slots"></p></strong></p>
            <div class="d-flex justify-content-center mt-5">
                <a href="#" class="btn btn-success  ">View Invoice</a>
            </div>
        </div>
    </div>

    <?php include '../../assest/bottom_links.php'; ?>
    <!-- <script src='https://test.feelyprivacy.com/s/controller/js/employee.js'></script> -->
    <script src='https://test.feelyprivacy.com/s/controller/js/success.js'></script>
</body>

</html>