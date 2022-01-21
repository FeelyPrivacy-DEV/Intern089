<?php

error_reporting(0);
session_start();
// require '../../vendor/autoload.php';
if ($_SESSION['docid'] == '') {
    header('location:  /');
}
$con = new MongoDB\Client('mongodb://127.0.0.1:27017');
$db = $con->php_mongo;
$collection = $db->manager;
$record = $collection->findOne(['_id' => $_SESSION['docid']]);

if ($_GET['profile'] == 'updated') {
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
    @include('assest/top_links')
    <link rel="stylesheet" href="/css/d-profile-settings.css?ver=1.2">
    <title>Feely | Doc Profile Settings</title>
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
                    if ($record['profile_image'] != '') {
                        echo '<img src="/image/doc-img/doc-img/' . $record['profile_image'] . '" class="rounded profile-img-setting" height="70" alt="User Image">';
                    } else {
                        echo '<img src="/image/doc-img/doc-img/default-doc.jpg" height="70" alt="User Image">';
                    }
                    ?>
                </div>
                <h4 class="text-center"><a href="#">Dr. <?php echo $record['fname'] . ' ' . $record['sname'] ?></a></h4>
                <small class="text-center">BDS, MDS - Oral & Maxillofacial Surgery</small>
            </div>
            <div class="">
                <button class="btn btn-sm btn-outline-primary sidebtn fw-bold px-4 my-3"><i class="bi bi-list"></i></button>
            </div>
            <div class="side-nav my-4">
                <ul class="px-0">
                    <li class="px-4"><a href="/d"><i class="bi bi-speedometer"></i>Dashboard</a></li>
                    <li class="px-4"><a href="/d/appointments"><i class="bi bi-calendar-check-fill"></i>Appointments</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-person-lines-fill"></i>My Patients</a></li>
                    <li class="px-4"><a href="/d/schedule-timings"><i class="bi bi-hourglass-split"></i>Schedule Timimg</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-receipt-cutoff"></i>Invoice</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-star-fill"></i>Review</a></li> -->
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-chat-left-dots-fill"></i>Message</a></li> -->
                    <li class="px-4"><a href="/d/profile-settings" class="s-active"><i class="bi bi-gear-fill"></i>Profile Setting</a></li>
                    <!-- <li class="px-4"><a href="#"><i class="bi bi-share-fill"></i>Social Media</a></li> -->
                    <li class="px-4"><a href="/d/forgot-password"><i class="bi bi-lock-fill"></i>Change Password</a></li>
                    <li class="px-4"><a href="#"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- body content -->
        <div class="col-md-9 content">
            <!-- <form action="/UpdateDoctorProfileSettings" method="POST" enctype="multipart/form-data">
                        @csrf -->
            <div class="">
                <div class="about-me">
                    <h4 class="card-title my-4">About Me</h4>
                </div>
                <!-- <div class="col-md-12"> -->
                <div class="form-group">
                    <form id="profile-form" method="POST" enctype="multipart/form-data">

                        <div class="change-avatar">
                            <div class="profile-img">
                                <?php
                                if ($record['profile_image'] != '') {
                                    echo '<img src="/image/doc-img/doc-img/' . $record['profile_image'] . '" class="profile-img-setting" height="70" alt="User Image">';
                                } else {
                                    echo '<img src="/image/doc-img/doc-img/default-doc.jpg"  height="70" alt="User Image">';
                                }
                                ?>
                            </div>
                            <div class="upload-img">
                                <div class="change-photo-btn">
                                    <span><i class="bi bi-cloud-arrow-up mx-2"></i>Select</span>
                                    <input type="file" name="profile_image" class="upload" id="select_file">

                                </div>
                                <!-- <small class="form-text text-nowrap text-muted">Allowed JPG, JPEG or PNG. Max size of 2MB</small> -->
                            </div>
                        </div>
                        <div class="my-3">
                            <input type="submit" class="btn btn-primary btn-sm px-4 py-2 update-btns update-img-btn" value="Upload" />
                        </div>
                    </form>
                </div>

                <!-- </div>
        </div> -->
                <form method="POST" id="aboutMeForm">
                    @csrf
                    <div class="edit-content">
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
                                    <label class="my-2">Email <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control p-2 " disabled value="<?php echo $record['email'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="my-2">Date of Birth </label>
                                    <?php
                                    if ($record['gen_info']['DOB'] == '') {
                                        echo '<input type="date" name="DOB" class="form-control p-2 " >';
                                    } else {
                                        echo '<input type="date" name="DOB" class="form-control p-2 " disabled value="' . $record['gen_info']['DOB'] . '">';
                                    }
                                    ?>
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
                                    if ($record['gen_info']['gender'] == '') {
                                        echo '<select class="form-select" name="gender" aria-label="Default select example">
                                                <option selected>' . $record['gen_info']['gender'] . '</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>';
                                    } else {
                                        echo '<select class="form-select" name="gender" aria-label="Default select example">
                                                <option selected>' . $record['gen_info']['gender'] . '</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact details -->
                    <div class="contact-details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="my-2">Adress Line 1</label>
                                    <input type="text" name="addressLine1" class="form-control p-2 " value="<?php echo $record['contact_detail']['addressLine']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="my-2">City</label>
                                    <input type="text" name="city" class="form-control p-2 " value="<?php echo $record['contact_detail']['city']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="my-2">State / Province</label>
                                    <input type="text" name="state" class="form-control p-2 " value="<?php echo $record['contact_detail']['state']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="my-2">Country</label>
                                    <input type="text" name="country" class="form-control p-2 " value="<?php echo $record['contact_detail']['country']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="my-2">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control p-2 " value="<?php echo $record['contact_detail']['postal_code']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="my-2">Biography </label>
                                    <input class="form-control p-2" name="bio" rows="3" value="<?php echo $record['gen_info']['biography']; ?>"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <input type="submit" class="btn btn-primary btn-sm px-4 py-2 update-btns" id="updateAboutMeBtn" value="Update My Info" />
                    </div>
                </form>
            </div>

            <hr>

            <div class="clinki-info">
                <form id="clinicForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <div class="mt-5 mb-3">
                            <h4 class="card-title">My Clinic</h4>
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
                                <label class="my-2">Clinic Images </label>
                                <input type="file" name="clinicImages[]" class="form-control p-2" id="clinicImgs" multiple />
                            </div>
                        </div>
                    </div>
                    <!-- select price -->
                    <div class="pricing">
                        <div class="">
                            <h6 class="card-title">Pricing</h6>
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
                                <label class="form-check-label" for="">
                                    Custom Price (Per Hour)
                                </label>
                            </div>
                            <div class="form-group" id="custom_price_input">
                                <input type="text" name="custom_price" class="form-control p-2 " placeholder="Enter Price" value="<?php echo $record['custom_price']; ?>">
                            </div>
                        </div>
                    </div>
                    <!--services and specilization -->
                    <div class=" mt-3">
                        <h6 class="card-title">Services and Specilization</h6>
                    </div>
                    <div class="bootstrap-tagsinput">
                        <div class="my-2">
                            <label class="my-2">Services</label>
                            <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Enter Services" name="services[]" value="<?php echo $record['servicesAndSpec']['services'][0]; ?>" id="services" style="background-color: rgb(34, 36, 37) !important; --placeholder-color:rgba(232, 229, 227, 0.6) !important; color: rgb(209, 203, 199) !important; border-color: rgb(132, 114, 108) !important; display: none;">
                            <small>Note : Type & Press enter to add new services</small>
                        </div>
                        <div class="my-2">
                            <label class="my-2">Specialization</label>
                            <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Enter specialization" name="spec[]" value="<?php echo $record['servicesAndSpec']['spec'][0]; ?>" id="spec">
                            <small>Note : Type & Press enter to add new specialization</small>
                        </div>
                    </div>

                    <div class="my-3">
                        <input type="submit" id="clinicUpdateBtn" class="btn btn-primary btn-sm px-4 py-2 update-btns" value="Update Clinic" />
                    </div>
                </form>
            </div>

            <hr>

            <div class="">
                <form method="POST" id="otherDetails">
                    @csrf
                    <div class="mt-5 mb-4">
                        <h4 class="card-title">Other Details</h4>
                    </div>
                    <!-- degree college -->
                    <div class="">
                        <h6 class="card-title">Education</h6>
                    </div>
                    <div id="add-more-edu">
                        <div class="row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="my-2">Degree</label>
                                    <input type="text" name="edu_degree[]" class="form-control p-2 " value="<?php echo $record['education']['degree'][0]; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="my-2">College / Institute</label>
                                    <input type="text" name="edu_college[]" class="form-control p-2 " value="<?php echo $record['education']['college'][0]; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="my-2">Year of Completion</label>
                                    <input type="text" name="edu_year[]" class="form-control p-2 " value="<?php echo $record['education']['comp_year'][0]; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start ">
                        <button type="button" class="btn text-primary" id="add-more-edu-btn"><i class="bi bi-plus-circle-fill px-2"></i>Add More</button>
                    </div>

                    <!-- Experience -->
                    <div class="">
                        <h6 class="card-title">Experience</h6>
                    </div>
                    <div class="" id="add-more-exp">
                        <div class="row border">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="my-2">Hospital Name</label>
                                    <input type="text" name="experi_hospital_name[]" class="form-control p-2 ">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="my-2">From</label>
                                    <input type="date" name="experi_hos_from[]" class="form-control p-2 ">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="my-2">To</label>
                                    <input type="date" name="experi_hos_to[]" class="form-control p-2 ">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="my-2">Designation</label>
                                    <input type="text" name="experi_designation[]" class="form-control p-2 ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <button type="button" class="btn text-primary" id="add-more-exp-btn"><i class="bi bi-plus-circle-fill px-2"></i>Add More</button>
                    </div>

                    <!-- Awards -->
                    <div class="">
                        <h6 class="card-title">Awards</h6>
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
                    <div class="">
                        <h6 class="card-title">Memberships</h6>
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
                    <div class="">
                        <h6 class="card-title">Registrations</h6>
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

                    <div class="my-3">
                        <input type="submit" id="otherDetailsBtn" class="btn btn-primary btn-sm px-4 py-2 update-btns" value="Update Other Details">
                    </div>
                </form>
            </div>

            <hr>

            <!-- <div class="save-chng my-4">
                    <button type="button" name="update_profile" class="btn btn-primary px-5 py-3 ">Update Profile Details</button>
                </div> -->
            <!-- </form> -->
        </div>
    </div>








    @include('assest/bottom_links')
    <script src="{{ URL::asset('/js/d-profile-settings.js?ver=1.3') }}"></script>

</body>

</html>