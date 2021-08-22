<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['eid'] == '') {
        header('location: http://143.244.139.242/s/index');
    }
    $con = new MongoDB\Client( 'mongodb://143.244.139.242:27017' );
    $db = $con->php_mongo;

    $collection = $db->employee;
    $record = $collection->findOne( [ '_id' =>$_SESSION['eid']] );

    if($_GET['id'] == '') {
        echo 'please select doc';
    }


?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://143.244.139.242/s/public/stylesheet/p-checkout.css?ver=1.2">
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
                                <input type="text" name="fname" class="form-control p-2 " disabled value="<?php echo $record['fname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Last Name</label>
                                <input type="text" name="sname" class="form-control p-2 " disabled value="<?php echo $record['sname']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Email</label>
                                <input type="text" name="email" class="form-control p-2 " disabled value="<?php echo $record['email']; ?>"> 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Phone No</label>
                                <input type="number" name="phone_no" maxlength="10" class="form-control p-2 " disabled value="<?php echo $record['gen_info']['phone_no']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pay_method my-4">
                    <h4 class="card-title">Payment</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Name on Card</label>
                                <input type="text" name="name_on_card" class="form-control p-2 ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Card Number</label>
                                <input type="number" name="card_number" maxlength="16" class="form-control p-2 ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="my-2">Expiry Month</label>
                                <input type="text" name="name_on_card" class="form-control p-2 " placeholder="MM">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="my-2">Expiry Year</label>
                                <input type="number" name="card_number" maxlength="16" class="form-control p-2 " placeholder="YY">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="my-2">CVV</label>
                                <input type="number" name="card_number" maxlength="16" class="form-control p-2 " placeholder="***">
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                I have read and accept <a href="#" class="text-primary">Terms & Conditions</a>
                            </label>
                        </div>
                        <div class="conf_pay m-3">
                            <button class="btn btn-primary px-5 py-3" type="button">Confirm and Pay</button>
                        </div>
                    </div>
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
                        <img src="http://143.244.139.242/s/public/image/doc-img/doc-img/default-doc.jpg" height="70" alt="User Image">
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
                        <p></p>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Time</h6>
                        <p></p>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Consulting Fee</h6>
                        <p></p>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>DaBooking Feete</h6>
                        <p></p>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <h6>Video Call</h6>
                        <p></p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Total</h5>
                        <p>$</p>
                    </div>
                </div>
            </div>
        </div>
    </div>














    



    <?php include '../../assest/bottom_links.php'; ?>
    <script src='http://143.244.139.242/s/controller/js/p-checkout.js?ver=2.4'></script>

</body>

</html> 