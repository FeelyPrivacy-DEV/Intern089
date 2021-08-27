<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['eid'] == '') {
        header('location: http://test.feelyprivacy.com/s/index');
    }
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo;

    $collection = $db->employee;
    $record = $collection->findOne( [ '_id' =>$_SESSION['eid']] );



?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://test.feelyprivacy.com/s/public/stylesheet/p-checkout.css?ver=1.2">
    <script src='http://test.feelyprivacy.com/s/controller/js/p-checkout.js?ver=1.7'></script>
    <title>Feely | Doc Dashboard</title>
</head>

<body>
    <?php include_once '../../assest/navbar.php'; ?>

    <!-- breadcrumb -->
    <nav class='breadc navbar-expand-lg'>
        <div class='container-fluid'>
            <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                <p class=" my-auto py-1">Home / Checkout</p>
                <h5 class="my-auto py-1">Checkout</h5>
            </div>
        </div>
    </nav>

    <!-- personal information -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-8">
                <div class="per_info my-4">
                    <h4 class="card-title">Personal Information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Firat Name</label>
                                <input type="text" name="fname" class="form-control p-2 " disabled
                                    value="<?php echo $record['fname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Last Name</label>
                                <input type="text" name="sname" class="form-control p-2 " disabled
                                    value="<?php echo $record['sname']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Email</label>
                                <input type="text" name="email" class="form-control p-2 " disabled
                                    value="<?php echo $record['email']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Phone No</label>
                                <input type="number" name="phone_no" maxlength="10" class="form-control p-2 " disabled
                                    value="<?php echo $record['gen_info']['phone_no']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pay_method my-4">
                    <h4 class="card-title">Payment</h4>

                    <div class="card-bounding row">

                        <div class="card-container col-md-6">
                            <!--- ".card-type" is a sprite used as a background image with associated classes for the major card types, providing x-y coordinates for the sprite --->
                            <label for="">Card Number</label>
                            <div class="card-type"></div>
                            <input class="form-control" placeholder="0000 0000 0000 0000" onkeyup="$cc.validate(event)" />
                            <!-- The checkmark ".card-valid" used is a custom font from icomoon.io --->
                            <!-- <div class="card-valid">&#xea10;</div> -->
                        </div>

                        <div class="card-details clearfix col-md-6">

                            <div class="expiration">
                                <label for="">Expiry Date</label>
                                <input class="form-control" onkeyup="$cc.expiry.call(this,event)" maxlength="7" placeholder="mm/yyyy" />
                            </div>
                        </div>

                        <div class="cvv my-4 col-md-6">
                                <label for="">CVV</label>
                                <input class="form-control" placeholder="XXX" />
                            </div>

                    </div>
                </div>
                <div class="my-3">
                
                </div>
            </div>
            <div class="col-md-4 my-4">
                <?php
                    $collection = $db->manager;
                    $record = $collection->findOne( [ 'd_unid' =>$_GET['id']] );


                ?>
                <div class="summary">
                    <h4 class="card-title">Booking Summary</h4>
                    <div class="d-flex justify-content-start my-3">
                        <img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg" height="70"
                            alt="User Image">
                        <div class="mx-2">
                            <h5 class="card-title">Dr. <?php echo $record['fname'].' '.$record['sname']; ?></h5>
                            <div class="d-flex">
                                <i class="bi bi-star-fill text-warning "></i>
                                <i class="bi bi-star-fill text-warning px-2"></i>
                                <i class="bi bi-star-fill text-warning "></i>
                            </div>
                            <p><i class="bi bi-geo-alt-fill text-primary"></i> Hyderabad, India</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Date</h6>
                        <p class="mb-1"><?php echo $_GET['d']; ?></p>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Time</h6>
                        <p class="mb-1"><?php echo $_GET['t']; ?></p>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Consulting Fee</h6>
                        <p class="mb-1">$ 100</p>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Booking Fee</h6>
                        <p class="mb-1">$ 50</p>
                    </div>
                    <!-- <div class="d-flex justify-content-between py-1">
                        <h6>Video Call</h6>
                        <p></p>
                    </div> -->
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <p>$ 150</p>
                    </div>
                </div>
            </div>
        </div>
    </div>















    <?php include '../../assest/bottom_links.php'; ?>
    <!-- <script src='http://test.feelyprivacy.com/s/controller/js/p-checkout.js?ver=1.6'></script> -->


</body>

</html>