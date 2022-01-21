<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use MongoDB\Client as mongo;

use Illuminate\Support\Facades\Validator;
 

session_start();


class docHandler extends Controller {


    // accepting appoinment
    function acceptAppoinment(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;

        $pid = strval($req->input('pid'));
        $date = strval($req->input('date'));
        $date_ind = strval($req->input('date_ind'));

        $e_collection = $db->employee;
        $erecord = $e_collection->findOne(['p_unid' => $pid]);
        $record = $e_collection->updateOne(
            ['p_unid' => $pid],
            ['$set' =>['datetime.'.$_SESSION['d_unid'].'.'.$date.'.'.$date_ind.'.status' => 'confirmed']]
        );
        include(app_path().'/email/accept_app_email.php');
        // include './email/accept_app_email.php';
        if($send == true) {
            echo 'email sent';
        }
        else {
            echo 'email not send';
        }
    }

    // cancelling appoinment
    function cancelAppoinment(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;

        $pid = strval($req->input('pid'));
        $date = strval($req->input('date'));
        $date_ind = strval($req->input('date_ind'));

        $e_collection = $db->employee;
        $erecord = $e_collection->findOne(['p_unid' => $pid]);
        $record = $e_collection->updateOne(
            ['p_unid' => $pid],
            ['$set' =>['datetime.'.$_SESSION['d_unid'].'.'.$date.'.'.$date_ind.'.status' => 'cancelled']]
        );
        include(app_path().'/email/cancel_app_email.php');
        // include './email/cancel_app_email.php';
        if($send == true) {
            echo 'email sent';
        }
        else {
            echo 'email not send';
        }

    }

    // sending video call link to patient
    function videoCallLinkSend(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;

        $pid = strval($req->input('pid'));
        $date = strval($req->input('date'));
        $date_ind = strval($req->input('date_ind'));
        $link = strval($req->input('link'));

        $e_collection = $db->employee;
        $erecord = $e_collection->findOne(['p_unid' => $pid]);
        $record = $e_collection->updateOne(
            ['p_unid' => $pid],
            ['$set' =>['datetime.'.$_SESSION['d_unid'].'.'.$date.'.'.$date_ind.'.video_link' => $link]]
        );
        include(app_path().'/email/video_link_send.php');
        // include './email/cancel_app_email.php';
        if($send == true) {
            echo 'email sent';
        }
        else {
            echo 'email not send';
        }

    }

    //  booking slots displaying to doctor
    function showSlots(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;

        $day = $req->input('day');

        $record = $collection->findOne(['_id' => $_SESSION['docid']]);
        $datetime = iterator_to_array($record['datetime']);

        foreach ($datetime as $index => $value) {
            if ($index == $day) {
                foreach ($value as $key => $val) {
                    if ($val[0] <= 12 && $val[1]) {
                        echo '<div class="btn-group mx-2 my-2" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger px-2">' . date('h:i', strtotime($val[0])) . ' AM - ' . date('h:i', strtotime($val[1])) . ' AM</button>';

                        echo '</div>';
                    } else {
                        echo '<div class="btn-group mx-2 my-2" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger px-2">' . date('h:i', strtotime($val[0])) . ' PM - ' . date('h:i', strtotime($val[1])) . ' PM</button>';

                        echo '</div>';
                    }
                }
                break;
            }
        }
    }

    // creating  Timings slots
    function scheduleTimings(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;
        $s_time = $req->input('s_time');
        $e_time = $req->input('e_time');
        $slotDate = $req->input('slotDate');

        foreach($s_time as $index=>$sval) {
            $collection->updateOne(
                ['_id' => $_SESSION['docid']],
                ['$push' =>['datetime.'.$slotDate => [$sval, $e_time[$index]]]]
            );
        }

        return redirect('/d/schedule-timings');
    }

    // filtering only today's appoinment
    function todaysAppoinment(Request $req) {
        // print_r($req->input());

        $con = new mongo;
        $db = $con->php_mongo;

        $c = 1;
        $collection = $db->manager;
        $record = $collection->findOne(['_id'=> $_SESSION['docid']]);
        // print_r($record);
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
                                foreach($val as $k=>$v) {
                                    print_r($v);

                                    echo'<tr class="py-5">
                                            <td class="d-flex pat">
                                                <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
                                                <a href="" class="px-2 my-auto text-nowrap">
                                                    '.$perticular_pat['fname'].' '.$perticular_pat['sname'].'
                                                    <p class="text-muted my-auto">#PT00'.$c.'</p>
                                                </a>
                                            </td>';
                                    echo '<td class="">
                                                <p class="m-0 text-nowrap">'.$date.'</p>';
                                            if($v['book_t'][0] <= 12) {
                                                echo '<p class="m-0 text-primary">'.date('h:i', strtotime($v['book_t'][0])).' AM</p>';
                                            }
                                            else {
                                                echo '<p class="m-0 text-primary">'.date('h:i', strtotime($v['book_t'][0])).' PM</p>';
                                            }
                                    echo '</td>
                                            <td class="text-nowrap">General </td>
                                            <td class="text-nowrap">New</td>
                                            <td class="text-center">$'.$v['amt'].'</td>
                                            <td class="">
                                                <div class="d-flex action">';
                                                if($v['status'] == 'confirmed') {
                                                    echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                    <button class="btn btn2 btn-sm mx-1" disabled onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'">Accepted</button>
                                                    <button class="btn btn3 btn-sm " onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                }
                                                else if($v['status'] == 'cancelled') {
                                                    echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                    <button class="btn btn2 btn-sm mx-1" onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                    <button class="btn btn3 btn-sm " disabled onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"> Cancelled</button>';
                                                }
                                                else {
                                                    echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                    <button class="btn btn2 btn-sm mx-1" onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                    <button class="btn btn3 btn-sm " onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                }

                                            echo '</div>
                                            </td>';
                                        echo '</tr>';
                                        // information modal
                                        echo '<div class="modal fade" id="info'.$c.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-5">
                                                            <div class="p-3 d-flex justify-content-between my-2 ">
                                                                <div class="d-flex pet-info">
                                                                    <div class="pat-img">
                                                                        <img src="http://127.0.0.1/s/s/public/image/pat-img/default_user.png" height="110" width="110"
                                                                            alt="" srcset="">
                                                                    </div>
                                                                    <div class="pat-det mx-4">
                                                                        <h5 class=""><a href="#">'.$perticular_pat['fname'].' '.$perticular_pat['sname'].'</a></h5>
                                                                        <p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('Y M d', strtotime($date)).', '.$v['book_t'][0].' AM</p>
                                                                        <p class="m-0 "><i class="bi bi-geo-alt-fill"></i> Newyork, United States</p>
                                                                        <p class="m-0 "><i class="bi bi-chat-left-text-fill"></i> '.$perticular_pat['email'].'</p>
                                                                        <p class="m-0 "><i class="bi bi-telephone-fill"></i> +1 923 782 4575</p>
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
        }

    }

    // displaying all appoinment
    function upcomingAppoinments() {
        $con = new mongo;
        $db = $con->php_mongo;

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

                                    echo'<tr class="py-5">
                                            <td class="d-flex pat">
                                                <img src="/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
                                                <a href="" class="px-2 my-auto text-nowrap">
                                                    '.$perticular_pat['fname'].' '.$perticular_pat['sname'].'
                                                    <p class="text-muted my-auto">#PT00'.$c.'</p>
                                                </a>
                                            </td>';
                                    echo '<td class="">
                                                <p class="m-0 text-nowrap">'.$date.'</p>';
                                            if($v['book_t'][0] <= 12) {
                                                echo '<p class="m-0 text-primary">'.date('h:i', strtotime($v['book_t'][0])).' AM</p>';
                                            }
                                            else {
                                                echo '<p class="m-0 text-primary">'.date('h:i', strtotime($v['book_t'][0])).' PM</p>';
                                            }
                                    echo '</td>
                                            <td class="text-nowrap">General </td>
                                            <td class="text-nowrap">New</td>
                                            <td class="text-center">$'.$v['amt'].'</td>
                                            <td class="">
                                                <div class="d-flex action">';
                                                if($v['status'] == 'confirmed') {
                                                    echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                    <button class="btn btn2 btn-sm mx-1" disabled onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'">Accepted</button>
                                                    <button class="btn btn3 btn-sm " onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                }
                                                else if($v['status'] == 'cancelled') {
                                                    echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                    <button class="btn btn2 btn-sm mx-1" onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                    <button class="btn btn3 btn-sm " disabled onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"> Cancelled</button>';
                                                }
                                                else {
                                                    echo '<button type="button" class="btn btn1 btn-sm" data-bs-toggle="modal" data-bs-target="#info'.$c.'"><i class="bi bi-eye-fill"></i> View</button>
                                                    <button class="btn btn2 btn-sm mx-1" onclick="accept(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="acc'.$c.'"><i class="bi bi-check2"></i> Accept</button>
                                                    <button class="btn btn3 btn-sm " onclick="cancel(\''.$punid_key.'\', \''.$date.'\', \''.$k.'\', '.$c.')" id="can'.$c.'"><i class="bi bi-x"></i> Cancel</button>';
                                                }

                                            echo '</div>
                                            </td>';
                                        echo '</tr>';
                                        // information modal
                                        echo '<div class="modal fade" id="info'.$c.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-5">
                                                            <div class="p-3 d-flex justify-content-between my-2 ">
                                                                <div class="d-flex pet-info">
                                                                    <div class="pat-img">
                                                                        <img src="http://127.0.0.1/s/s/public/image/pat-img/default_user.png" height="110" width="110"
                                                                            alt="" srcset="">
                                                                    </div>
                                                                    <div class="pat-det mx-4">
                                                                        <h5 class=""><a href="#">'.$perticular_pat['fname'].' '.$perticular_pat['sname'].'</a></h5>
                                                                        <p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('Y M d', strtotime($date)).', '.$v['book_t'][0].' AM</p>
                                                                        <p class="m-0 "><i class="bi bi-geo-alt-fill"></i> Newyork, United States</p>
                                                                        <p class="m-0 "><i class="bi bi-chat-left-text-fill"></i> '.$perticular_pat['email'].'</p>
                                                                        <p class="m-0 "><i class="bi bi-telephone-fill"></i> +1 923 782 4575</p>
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
        }

    }

    // profile image update
    function updateProfileImg(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo; 
        $collection = $db->manager;

        $validation = Validator::make($req->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,gif|max:10000'
        ]);
         
        if(!$validation->fails()) {
            $image = $req->file('profile_image');
            $new_name = rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image/doc-img/doc-img/'), $new_name);
            $collection->updateOne(
                ['_id' => $_SESSION['docid']],
                ['$set' =>['profile_image' => $new_name]]
            );
            return response()->json([
                'message' => 'Image Upload Successfully',
                'uploaded_image_src' => '/image/doc-img/doc-img/'.$new_name ,
                'class_name' => 'alert-success',

            ]);
        } 
        else {
            return response()->json([
                'message' => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name' => 'alert-danger'
            ]);
        }

        
    }

    function updateAboutMeInfo(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo; 
        $collection = $db->manager;

        $r = $collection->updateMany(
            ['_id' => $_SESSION['docid']],
            ['$set' => [
                'fname' => $req['fname'], 'sname' => $req['sname'],
                'gen_info.phone_no' => $req['phone_no'],
                'gen_info.gender' => $req['gender'],
                'gen_info.DOB' => $req['DOB'],
                'gen_info.biography' => $req['bio'], 
                'contact_detail.addressLine' => $req['addressLine1'],
                'contact_detail.city' => $req['city'],
                'contact_detail.state' => $req['state'],
                'contact_detail.state' => $req['state'],
                'contact_detail.country' => $req['country'],
                'contact_detail.postal_code' => $req['postal_code'], 
                ]
            ]
        );

        return  json_encode($r);
 
    }

    function updateClinic(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo; 
        $collection = $db->manager;


        $collection->updateMany(
            ['_id' => $_SESSION['docid']],  
            ['$set' => [ 
                'clinic_info.clinic_name' => $req['clinic_name'],
                'clinic_info.clinic_addrs' => $req['clinic_addrs'], 
                'custom_price' => $req['custom_price'],
                ]
            ]
        );

        foreach($req['services'] as $val) { 
            $collection->updateMany(
                ['_id' => $_SESSION['docid']],  
                ['$set' => [ 
                    'servicesAndSpec.services' => $req['services'], 
                    ]
                ]
            );
        }
        foreach($req['spec'] as $val) { 
            $collection->updateMany(
                ['_id' => $_SESSION['docid']],  
                ['$set' => [ 
                    'servicesAndSpec.spec' => $req['spec'], 
                    ]
                ]
            );
        }


    }

    function updateOtherDetails(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo; 
        $collection = $db->manager;

        for($i = 0; $i < count($req['edu_degree']); $i++) {
            $collection->updateMany(
                ['_id' => $_SESSION['docid']],  
                ['$addToSet' => [
                    // 'education' => array($val, $req['edu_college'][0], $req['edu_year'])   
                    'education.degree' => $req['edu_degree'][$i], 
                    'education.college' => $req['edu_college'][$i],
                    'education.comp_year' => $req['edu_year'][$i],
                    ]
                ]
            );
        }

        for($i = 0; $i < count($req['edu_degree']); $i++) {
            $collection->updateMany(
                ['_id' => $_SESSION['docid']],  
                ['$addToSet' => [
                    // 'education' => array($val, $req['edu_college'][0], $req['edu_year'])   
                    'education.degree' => $req['edu_degree'][$i], 
                    'education.college' => $req['edu_college'][$i],
                    'education.comp_year' => $req['edu_year'][$i],
                    ]
                ]
            );
        }   

        // foreach($req['edu_degree'] as $val) { 
        //     $collection->updateMany(
        //         ['_id' => $_SESSION['docid']],  
        //         ['$set' => [
        //             'education' => array($val, $req['edu_college'][0], $req['edu_year'])   
        //             'education.degree' => $req['edu_degree'], 
        //             'education.college' => $req['edu_college'],
        //             'education.year_of_comp' => $req['edu_year'], 
        //             ]
        //         ]
        //     );
        // }

        // return count($req['edu_degree']);
    }








    // Update Doctor Profile Settings
    function UpdateDoctorProfileSettings(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;

        $collection = $db->manager;

        // $fileName = $req->file('profile_image')->store('/image/doc-img/doc-img/');

        // $fileSize = $$file->file('profile_image')['size'];
        // $fileType = $$file->file('profile_image')['type'];
        // $fileTmpName = $$file->file('profile_image')['tmp_name'];
        // $fileExt = explode('.', $fileName);
        // $fileActualExt = strtolower(end($fileExt));
        // $fileAllowed = array('jpg', 'jpeg', 'png');
        // $fileNewName = uniqid('', true) . "." . $fileActualExt;

        // if(in_array($fileActualExt, $fileAllowed)) {
        //     $target = "/image/doc-img/doc-img/".$fileNewName;
        //     if($fileSize < 100000000) {
        //         if(in_array($fileActualExt, $fileAllowed)) {
        //             if(move_uploaded_file($fileTmpName, $target)) {
        //                 $collection->updateOne(
        //                     ['_id' => $_SESSION['docid']],
        //                     ['$set' =>['profile_image' => $fileNewName]]
        //                 );
        //             }
        //             else {
        //                 // echo $userImgFileMoveErr;
        //             }
        //         }
        //         else {
        //             // $targetVideo = "";
        //             // echo $userImgTypeErr;
        //         }
        //     }
        //     else {
        //         // echo $userImgSizeErr;
        //     }
        // }

        // $collection->updateMany(
        //     ['_id' => $_SESSION['docid']],
        //     ['$set' => ['fname' => $_POST['fname'], 'sname' => $_POST['sname'],
        //             'gen_info.phone_no' => $_POST['phone_no'],
        //             'gen_info.gender' => $_POST['gender'],
        //             'gen_info.DOB' => $_POST['DOB'],
        //             'gen_info.biography' => $_POST['biography'],
        //             'clinic_info.clinic_name' => $_POST['clinic_name'],
        //             'clinic_info.clinic_addrs' => $_POST['clinic_addrs'],
        //             'contact_detail.addressLine' => $_POST['addressLine'],
        //             'contact_detail.city' => $_POST['city'],
        //             'contact_detail.state' => $_POST['state'],
        //             'contact_detail.state' => $_POST['state'],
        //             'contact_detail.country' => $_POST['country'],
        //             'contact_detail.postal_code' => $_POST['postal_code'],
        //             'custom_price' => $_POST['custom_price'],
        //         ]
        //     ]
        // );

        // $edu_degree = $_POST['degree'];
        // $edu_college = $_POST['college'];
        // $edu_year = $_POST['year'];

        // foreach($edu_degree as $index=>$sval) {
        //     $collection->updateOne(
        //         ['_id' => $_SESSION['docid']],
        //         ['$set' =>[
        //             'education.degree' => [$sval],
        //             'education.college' => [$edu_college[$index]],
        //             'education.year_of_comp' => [$edu_year[$index]]
        //             ]
        //         ]
        //     );
        // }

        // header('location: http://127.0.0.1/s/s/view/d/profile-settings');


    }

    // doctor forgot password when doctor is login
    function page_forgot_password(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;

        $old = $req->input('old');
        $newPass = $req->input('newPass');

        $r = $collection->findOne(['d_unid' => $_SESSION['d_unid']]);
        $p = password_verify($old, $r['password']);
        if($p) {
            $hash = password_hash( $newPass, PASSWORD_DEFAULT );
            $r = $collection->updateOne(
                ['d_unid' => $_SESSION['d_unid']],
                ['$set' =>['password' => $hash]]
            );
            return 'true';
        }
        else {
            return 'false';
        }
    }

    // adding prescriptions and email sending that patient
    function prescriptionSave(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->employee;
        $prescription_id = rand(111111, 999999);
        $response = false;
        $i = 1;
        foreach($req->input('med_name') as $key => $name) {
            $r = $collection->updateOne(
                ['p_unid' => strval($req->input('pat_id'))],
                ['$push' =>
                    ['prescription.'.$_SESSION['d_unid'].'.'.date('Y-m-d').'.Prescription_'.$prescription_id =>
                        [
                            'reason'=>$req->input('reason'),
                            'med_name'=>$name,
                            'med_qty'=>$req->input('med_qty')[$key],
                            'med_day'=>$req->input('med_day')[$key]
                        ]
                    ]
                ]
            );
            $i++;
            $response = true;
        }

        if($response == true) {
            $erecord = $collection->findOne(['p_unid' => strval($req->input('pat_id'))]);
            include(app_path().'/email/add_prescription_email.php');
            if($send == true) {
                return 'true';
            }
            else {
                return 'emailError';
            }
        }
        else {
            return 'false';
        }

        // return print_r($r['writeResult']['nModified']);
    }

    // editing the existing prescrtption
    function editPrescriptionSave(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->employee;
        $prescription_id = $req->input('pre_id');
        $response = false;
        $i = 0;
        foreach($req->input('med_name') as $key => $name) {
            $r = $collection->updateOne(
                ['p_unid' => strval($req->input('pat_id'))],
                ['$set' =>
                    ['prescription.'.$_SESSION['d_unid'].'.'.date('Y-m-d').'.'.$prescription_id.'.'.$i =>
                        [
                            'med_name'=>$name,
                            'med_qty'=>$req->input('med_qty')[$key],
                            'med_day'=>$req->input('med_day')[$key]
                        ]
                        ]
                ]
            );
            $i++;
            $response = true;
        }

        if($response == true) {
            $erecord = $collection->findOne(['p_unid' => strval($req->input('pat_id'))]);
            include(app_path().'/email/edited_prescription_email.php');
            if($send == true) {
                return 'true';
            }
            else {
                return 'emailError';
            }
        }
        else {
            return 'false';
        }

    }




}
