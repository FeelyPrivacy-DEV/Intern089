<?php

    error_reporting(0);
    // session_start();
    require './vendor/autoload.php';
    // if($_SESSION['docid'] == '') {
    //     header('location: http://143.110.176.130/s/index');
    // }
    $con = new MongoDB\Client( 'mongodb://test.com:27017' );
    $db = $con->php_mongo;
    $collection = $db->manager;

?>

<!doctype html>
<html lang='en'>

<head>
    <?php include './assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://143.110.176.130/s/public/stylesheet/index.css?ver=1.3">
    <title>Feely | Doc Dashboard</title>
</head>

<body>
    <?php include './assest/navbar.php'; ?>


    <!-- search section -->
    <section class="section section-search">
        <div class="container-fluid">
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1>Search Doctor, Make an Appointment</h1>
                    <p>Discover the best doctors, clinic &amp; hospital the city nearest to you.</p>
                </div>

                <!-- Search -->
                <div class="search-box">
                    <form action="http://143.110.176.130/s/controller/php/index.php" method="GET">
                        <div class="form-group search-location">
                            <input type="text" class="form-control" placeholder="Search Location">
                            <span class="form-text">Based on your Location</span>
                        </div>
                        <div class="form-group search-info d-flex flex-column">
                            <div class="">
                                <!-- <form class="m-0 p-0" action="http://143.110.176.130/s/controller/php/index.php" method="POST"> -->
                                    <input type="text" class="form-control search_doc" id="search_doc" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">
                                    <span class="form-text">Ex : Dental or Sugar Check up etc</span>
                                <!-- </form> -->
                            </div>
                            <div class="">
                                <div class="searches border" id="searches">
                                </div>
                            </div>
                        </div>
                        <!-- <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i>
                            <span>Search</span><i class="bi bi-search"></i></button> -->
                    </form>
                </div>
                <!-- /Search -->

            </div>
        </div> 
    </section>











    <?php include './assest/bottom_links.php'; ?>
    <script src='http://143.110.176.130/s/controller/js/index.js?ver=1.6'></script>

</body>

</html>