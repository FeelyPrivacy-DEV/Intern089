<?php

    error_reporting(0);
    session_start();
    require '../../vendor/autoload.php';
    if($_SESSION['docid'] == '') {
        header('location:  http://test.feelyprivacy.com/s/index');
    }
    $con = new MongoDB\Client( 'mongodb://test.feelyprivacy.com:27017' );
    $db = $con->php_mongo; $collection = $db->manager;
    $record = $collection->findOne( [ '_id' =>$_SESSION['docid']] );

    if($_GET['profile'] == 'updated') {
        $msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Profile Updated :)</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    // $msg = '';

?>

<!doctype html>
<html lang='en'>

<head>
    <?php include '../../assest/top_links.php'; ?>
    <link rel="stylesheet" href="http://test.feelyprivacy.com/s/public/stylesheet/d-profile-settings.css?ver=1.2">
    <title>Feely | Doc Profile Settings</title>
</head>

<body>
    <?php include_once '../../assest/navbar.php'; ?>

    <!-- breadcrumb -->
    <nav class='breadc navbar-expand-lg'>
        <div class='container-fluid'>
            <div class="breadcrumb d-flex flex-column mx-4 my-auto">
                <p class=" my-auto py-1">Home / Profile Settings</p>
                <h5 class="my-auto py-1">Profile Settings</h5>
            </div>
        </div>
    </nav>


    <!-- main content -->
    <div class="m-5 row">
        <!-- sidebar -->
        <div class="col-md-3 side-profile p-2 ">
            <div class="">
                <div class="d-flex justify-content-center mb-4">
                    <?php
                        if($record['profile_image'] != '') {
                            echo '<img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/'.$record['profile_image'].'" class="rounded" height="70" alt="User Image">';
                        }
                        else {
                            echo '<img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg" height="70" alt="User Image">';
                        }
                    ?>
                </div>                
                <h4 class="text-center"><a href="#">Dr. <?php echo $record['fname'].' '.$record['sname'] ?></a></h4>
                <small class="text-center">BDS, MDS - Oral & Maxillofacial Surgery</small>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-sm btn-outline-primary sidebtn fw-bold px-4 my-3"><i class="bi bi-list"></i></button>
            </div>
            <div class="side-nav my-4">
            <ul class="px-0">
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/d/index"><i
                                class="bi bi-speedometer"></i>Dashboard</a></li>
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/d/appointments"><i
                                class="bi bi-calendar-check-fill"></i>Appointments</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-person-lines-fill"></i>My Patients</a></li>
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/d/schedule-timings"><i
                                class="bi bi-hourglass-split"></i>Schedule Timimg</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-receipt-cutoff"></i>Invoice</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-star-fill"></i>Review</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <li class="px-4"><a href="http://test.feelyprivacy.com/s/view/d/profile-settings"  class="s-active"><i
                                class="bi bi-gear-fill"></i>Profile Setting</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-share-fill"></i>Social Media</a></li> -->
                    <li class="px-4"><a href="#"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- body content -->
        <div class="col-md-9 content">
            <form action="http://test.feelyprivacy.com/s/controller/php/add_m.php" method="POST" enctype="multipart/form-data">
                <div class="">
                    <h4 class="card-title">Basic Information</h4>
                </div>
                <!-- <div class="col-md-12"> -->
                <div class="form-group">
                    <div class="change-avatar">
                        <div class="profile-img">
                            <?php
                                if($record['profile_image'] != '') {
                                    echo '<img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/'.$record['profile_image'].'" height="70" alt="User Image">';
                                }
                                else {
                                    echo '<img src="http://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg" height="70" alt="User Image">';
                                }
                            ?>
                        </div>
                        <div class="upload-img">
                            <div class="change-photo-btn">
                                <span><i class="bi bi-cloud-arrow-up mx-2"></i> Upload Photo</span>
                                <input type="file" name="profile_image" class="upload">
                            </div>
                            <small class="form-text text-nowrap text-muted">Allowed JPG, JPEG or PNG. Max size of 2MB</small>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <div class="edit-content my-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control p-2 " disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control p-2 " disabled value="<?php echo $record['email'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="fname" class="form-control p-2" value="<?php echo $record['fname'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="sname" class="form-control p-2 " value="<?php echo $record['sname'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Phone No </label>
                                <input type="text" name="phone_no" class="form-control p-2 " maxlength="10" value="<?php echo $record['gen_info']['phone_no'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Gender</label>
                                <?php
                                    if($record['gen_info']['gender'] == '') {
                                        echo '<select class="form-select" name="gender" aria-label="Default select example">
                                                <option selected>'.$record['gen_info']['gender'].'</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>';
                                    } else {
                                        echo '<select class="form-select" disabled name="gender" aria-label="Default select example">
                                                <option selected>'.$record['gen_info']['gender'].'</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>';
                                    }                                 
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Date of Birth </label>
                                <?php
                                    if($record['gen_info']['DOB'] == '') {
                                        echo '<input type="date" name="DOB" class="form-control p-2 " >';
                                    } else {
                                        echo '<input type="date" name="DOB" class="form-control p-2 " disabled value="'.$record['gen_info']['DOB'].'">';
                                    }                                 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- about me -->
                <div class="my-5 about-me">
                    <div class="">
                        <h4 class="card-title">About Me</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="my-2">Biography </label>
                                <textarea class="form-control p-2" name="biography" rows="3" value="<?php echo $record['gen_info']['biography']; ?>"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clinki-info">
                    <div class="my-5">
                        <h4 class="card-title">Clinic Info</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Clinic Name </label>
                                <input type="text" name="clinic_name" class="form-control p-2 " value="<?php echo $record['clinic_info']['clinic_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Clinic Address </label>
                                <input type="text" name="clinic_addrs" class="form-control p-2 " value="<?php echo $record['clinic_info']['clinic_addrs']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="my-2">Clinic Image </label>
                            <input type="file" name="clinic_images[]" class="form-control p-2 ">
                            <!-- <form action="#" class="dropzone dz-clickable"
                                style="background-color: rgb(34, 36, 37) !important; color: rgb(209, 203, 199) !important; border-color: rgba(140, 122, 115, 0.1) !important;"> -->
                                <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <div class="clinic-img d-flex justify-content-start my-2">
                        <div class="upload-images m-1">
                            <img src="http://test.feelyprivacy.com/s/public/image/doc-img/clinic-img/feature-01.jpg" class="m-2"
                                height="80" alt="">
                            <a href="#" class="btn btn-icon btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                        </div>
                        <div class="upload-images m-1">
                            <img src="http://test.feelyprivacy.com/s/public/image/doc-img/clinic-img/feature-02.jpg" class="m-2"
                                height="80" alt="">
                            <a href="#" class="btn btn-icon btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact details -->
                <div class="contact-details">
                    <div class="my-5">
                        <h4 class="card-title">Contact Details</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Adress Line 1</label>
                                <input type="text" name="addressLine" class="form-control p-2 " value="<?php echo $record['contact_detail']['addressLine']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Adress Line 2 </label>
                                <input type="text" class="form-control p-2 ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">City</label>
                                <input type="text" name="city" class="form-control p-2 " value="<?php echo $record['contact_detail']['city']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">State / Province</label>
                                <input type="text" name="state" class="form-control p-2 " value="<?php echo $record['contact_detail']['state']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Country</label>
                                <input type="text" name="country" class="form-control p-2 " value="<?php echo $record['contact_detail']['country']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control p-2 " value="<?php echo $record['contact_detail']['postal_code']; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- select price -->
                <div class="pricing">
                    <div class="my-5">
                        <h4 class="card-title">Pricing</h4>
                    </div>
                    <div class="d-flex justify-content-start">
                        <div class="form-check mx-2">
                            <input class="form-check-input" type="radio" name="pricing" id="" value="1">
                            <label class="form-check-label" for="">
                                Free
                            </label>
                        </div>
                        <div class="form-check mx-2">
                            <input class="form-check-input" type="radio" name="pricing" id="" value="2">
                            <label class="form-check-label" for="" >
                                Custom Price (Per Hour)
                            </label>
                        </div>
                        <div class="form-group" id="custom_price_input">
                            <input type="text" name="custom_price" class="form-control p-2 " placeholder="Enter Price" value="<?php echo $record['custom_price']; ?>">
                        </div>
                    </div>
                </div>

                <!--services and specilization -->
                <div class="my-5">
                    <h4 class="card-title">Services and Specilization</h4>
                </div>
                <div class="bootstrap-tagsinput">
                    <div class="my-2">
                        <label class="my-2">Services</label>
                        <input type="text" data-role="tagsinput" class="input-tags form-control"
                            placeholder="Enter Services" name="services[]" value="Tooth cleaning " id="services"
                            style="background-color: rgb(34, 36, 37) !important; --placeholder-color:rgba(232, 229, 227, 0.6) !important; color: rgb(209, 203, 199) !important; border-color: rgb(132, 114, 108) !important; display: none;">
                        <small>Note : Type & Press enter to add new services</small>
                    </div>
                    <div class="my-2">
                        <label class="my-2">Specialization</label>
                        <input type="text" data-role="tagsinput" class="input-tags form-control"
                            placeholder="Enter specialization" name="spec[]" value="Tooth cleaning " id="services">
                        <small>Note : Type & Press enter to add new specialization</small>
                    </div>
                </div>

                <!-- degree college -->
                <div class="my-5">
                    <h4 class="card-title">Education</h4>
                </div>
                <div id="add-more-edu">
                    <div class="row border">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="my-2">Degree</label>
                                <input type="text" name="degree[]" class="form-control p-2 " value="<?php echo $record['education']['degree'][0]; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="my-2">College / Institute</label>
                                <input type="text" name="college[]" class="form-control p-2 " value="<?php echo $record['education']['college'][0]; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="my-2">Year of Completion</label>
                                <input type="number" name="year[]" class="form-control p-2 " value="<?php echo $record['education']['year_of_comp'][0]; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start ">
                    <button type="button" class="btn text-primary" id="add-more-edu-btn"><i class="bi bi-plus-circle-fill px-2"></i>Add More</button>
                </div>

                <!-- Experience -->
                <div class="my-5">
                    <h4 class="card-title">Experience</h4>
                </div>
                <div class="" id="add-more-exp">
                    <div class="row border">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="my-2">Hospital Name</label>
                                <input type="text" name="hospital_name[]" class="form-control p-2 ">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="my-2">From</label>
                                <input type="date" name="hos_from[]" class="form-control p-2 ">
                            </div> 
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="my-2">To</label>
                                <input type="date" name="hos_to[]" class="form-control p-2 ">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="my-2">Designation</label>
                                <input type="text" name="designation[]" class="form-control p-2 ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn text-primary" id="add-more-exp-btn"><i class="bi bi-plus-circle-fill px-2"></i>Add More</button>
                </div>

                <!-- Awards -->
                <div class="my-5">
                    <h4 class="card-title">Awards</h4>
                </div>
                <div class="" id="add-more-award">
                    <div class="row border">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Award</label>
                                <input type="text" name="aw_name[]" class="form-control p-2 ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">From</label>
                                <input type="date" name="aw_year[]" class="form-control p-2 ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn text-primary" id="add-more-award-btn"><i class="bi bi-plus-circle-fill px-2"></i>Add More</button>
                </div>

                <!-- Memberships -->
                <div class="my-5">
                    <h4 class="card-title">Memberships</h4>
                </div>
                <div class="" id="add-more-memb">
                    <div class="row border">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Memberships</label>
                                <input type="text" name="memb_name[]" class="form-control p-2 ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn text-primary" id="add-more-memb-btn"><i class="bi bi-plus-circle-fill px-2"></i>Add More</button>
                </div>


                <!-- Registrations -->
                <div class="my-5">
                    <h4 class="card-title">Registrations</h4>
                </div>
                <div class="" id="add-more-reg">
                    <div class="row border">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="my-2">Registrations</label>
                                <input type="text" name="reg_name[]" class="form-control p-2 ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn text-primary" id="add-more-reg-btn"><i class="bi bi-plus-circle-fill px-2"></i>Add More</button>
                </div>



                <div class="save-chng my-4">
                    <button type="submit" name="update_profile" class="btn btn-primary px-5 py-3 ">Update Profile Details</button>
                </div>
            </form>
        </div>
    </div>
    </div>








    <?php include '../../assest/bottom_links.php'; ?>
    <script src='http://test.feelyprivacy.com/s/controller/js/d-profile-settings.js?ver=1.3'></script>

</body>

</html>