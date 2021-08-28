<?php

session_start(); 
require '../../vendor/autoload.php';
    $con = new MongoDB\Client( 'mongodb://127.0.0.1:27017' );
    $db = $con->php_mongo; $collection = $db->manager;


    if(isset($_POST['add_m_meeting'])) {

        $s_time = $_POST['s_time'];
        $e_time = $_POST['e_time'];
        $slotDate = $_POST['slotDate'];

        foreach($s_time as $index=>$sval) {
            $collection->updateOne(
                ['_id' => $_SESSION['docid']],
                ['$push' =>['datetime.'.$slotDate => [$sval, $e_time[$index]]]]
            );
        }

        header('location: https://test.feelyprivacy.com/s/view/d/schedule-timings?slot=submit');

    }
    else if(isset($_POST['update_profile'])) {
        $collection = $db->manager;

        $fileName = $_FILES['profile_image']['name'];
    
        $fileSize = $_FILES['profile_image']['size'];
        $fileType = $_FILES['profile_image']['type'];
        $fileTmpName = $_FILES['profile_image']['tmp_name'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $fileAllowed = array('jpg', 'jpeg', 'png');
        $fileNewName = uniqid('', true) . "." . $fileActualExt;

        if(in_array($fileActualExt, $fileAllowed)) {
            $target = "../../public/image/doc-img/doc-img/".$fileNewName;
            if($fileSize < 100000000) {
                if(in_array($fileActualExt, $fileAllowed)) {
                    if(move_uploaded_file($fileTmpName, $target)) {
                        $collection->updateOne(
                            ['_id' => $_SESSION['docid']],
                            ['$set' =>['profile_image' => $fileNewName]]
                        );
                    }
                    else {
                        // echo $userImgFileMoveErr;
                    }
                }
                else {
                    // $targetVideo = "";
                    // echo $userImgTypeErr;
                }
            }
            else {
                // echo $userImgSizeErr;
            }
        }

        $collection->updateMany(
            ['_id' => $_SESSION['docid']],
            ['$set' => ['fname' => $_POST['fname'], 'sname' => $_POST['sname'],
                    'gen_info.phone_no' => $_POST['phone_no'],
                    'gen_info.gender' => $_POST['gender'],
                    'gen_info.DOB' => $_POST['DOB'],
                    'gen_info.biography' => $_POST['biography'],
                    'clinic_info.clinic_name' => $_POST['clinic_name'],
                    'clinic_info.clinic_addrs' => $_POST['clinic_addrs'],
                    'contact_detail.addressLine' => $_POST['addressLine'],
                    'contact_detail.city' => $_POST['city'],
                    'contact_detail.state' => $_POST['state'],
                    'contact_detail.state' => $_POST['state'],
                    'contact_detail.country' => $_POST['country'],
                    'contact_detail.postal_code' => $_POST['postal_code'],
                    'custom_price' => $_POST['custom_price'],
                ]
            ]
        );

        $edu_degree = $_POST['degree'];
        $edu_college = $_POST['college'];
        $edu_year = $_POST['year'];


        foreach($edu_degree as $index=>$sval) {
            $collection->updateOne(
                ['_id' => $_SESSION['docid']],
                ['$set' =>[
                    'education.degree' => [$sval],
                    'education.college' => [$edu_college[$index]],
                    'education.year_of_comp' => [$edu_year[$index]]
                    ]
                ]
            );
        }

        header('location: https://test.feelyprivacy.com/s/view/d/profile-settings');

    }
    else if(isset($_POST['next_date'])) {
        $day = $_POST['day'];

        $record = $collection->findOne( [ '_id' =>$_SESSION['docid']] );
        $datetime = iterator_to_array( $record['datetime'] );

            foreach ( $datetime as $index=>$value ) {
                if($index == $day) {
                    foreach ( $value as $key=>$val ) {
                        if($val[0] <= 12 && $val[1]) {
                            echo '<div class="btn-group mx-2 my-1" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-danger px-2">'.date('h:i', strtotime($val[0])).' AM - '.date('h:i', strtotime($val[1])).' AM</button>';
                                    ?>
                                    <!-- <button type="button" class="btn btn-danger" onclick="slotdelete('<?php echo $index; ?>', <?php echo $key; ?>)"><i class="bi bi-x"></i></button> -->
                            <?php    
                                    echo '</div>';
                        }
                        else {
                            echo '<div class="btn-group mx-2" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-danger px-2">'.date('h:i', strtotime($val[0])).' PM - '.date('h:i', strtotime($val[1])).' PM</button>';
                                    ?>
                                    <!-- <button type="button" class="btn btn-danger" onclick="slotdelete('<?php echo $index; ?>', <?php echo $key; ?>)"><i class="bi bi-x"></i></button> -->
                            <?php    
                                    echo '</div>';
                        }
                    }
                    break;
                }
            }

    }
    else if(isset($_POST['dur_time'])) {
        $day_date = $_POST['day_date'];
        $time_dur_select = $_POST['time_dur_select'];

        $record = $collection->findOne( [ '_id' =>$_SESSION['docid']] );
        $datetime = iterator_to_array( $record['datetime'] );

            foreach ( $datetime as $index=>$value ) {
                if($index == $day_date) {
                    foreach ( $value as $key=>$val ) {
                        $sd = new DateTime($index.' '.strval($val[1]));
                        $ss = new DateTime($index.' '.strval($val[0]));
                        $tf = $sd->diff($ss);
                        if($tf->i == $time_dur_select) {
                            if($val[0] <= 12 && $val[1]) {
                                echo '<div class="btn-group mx-2 my-1" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger px-2">'.date('h:i', strtotime($val[0])).' AM - '.date('h:i', strtotime($val[1])).' AM</button>';
                                        ?>
                                        <button type="button" class="btn btn-danger" onclick="slotdelete('<?php echo $index; ?>', <?php echo $key; ?>)"><i class="bi bi-x"></i></button>
                                <?php    
                                        echo '</div>';
                            }
                            else {
                                echo '<div class="btn-group mx-2 my-1" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger px-2">'.date('h:i', strtotime($val[0])).' PM - '.date('h:i', strtotime($val[1])).' PM</button>';
                                        ?>
                                        <button type="button" class="btn btn-danger" onclick="slotdelete('<?php echo $index; ?>', <?php echo $key; ?>)"><i class="bi bi-x"></i></button>
                                <?php    
                                        echo '</div>';
                            }
                        }
                    }
                    break;
                }
            }
    }
    else if(isset($_POST['slotdelete'])) {
        $del_date = $_POST['del_date'];
        $index = $_POST['index'];

        $collection = $db->manager;
        $record = $collection->findOne( [ '_id' =>$_SESSION['docid']] );
        $datetime = iterator_to_array( $record['datetime'] );
        
        $isTimeSame = false;
        
        foreach($datetime as $date_key=>$val) {
            if($date_key == $del_date) {
                foreach($val as $ind=>$v) {
                    if($ind == $index) {
                        $r = $collection->updateOne([" _id"=> $_SESSION['docid']],
                            [array( '$pull' => 
                            array(
                                "datetime" => array(
                                    $del_date => $index )
                                )
                            )
                        ]
                        );
                        print_r($r);
                    }
                    
                }    
            }
        }
    }
    else if(isset($_POST['accept'])) {
        $pid = strval($_POST['pid']);
        $date = strval($_POST['date']);
        $date_ind = strval($_POST['date_ind']);

        $e_collection = $db->employee;
        $record = $e_collection->updateOne(
            ['p_unid' => $pid],
            ['$set' =>['datetime.'.$_SESSION['d_unid'].'.'.$date.'.'.$date_ind.'.status' => 'confirmed']]
        );
    }
    else if(isset($_POST['cancelled'])) {
        $pid = strval($_POST['pid']);
        $date = strval($_POST['date']);
        $date_ind = strval($_POST['date_ind']);

        $e_collection = $db->employee;
        $record = $e_collection->updateOne(
            ['p_unid' => $pid],
            ['$set' =>['datetime.'.$_SESSION['d_unid'].'.'.$date.'.'.$date_ind.'.status' => 'cancelled']]
        );
    }
    else if(isset($_POST['next_p_details'])) {
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
                            if($date == date('Y-m-d')) {
                                foreach($val as $k=>$v) {
                                    // print_r($v);
                                    
                                    echo'<tr class="py-5">
                                            <td class="d-flex pat">
                                                <img src="https://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
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
                                                                        <img src="https://test.feelyprivacy.com/s/public/image/pat-img/default_user.png" height="110" width="110"
                                                                            alt="" srcset="">
                                                                    </div>
                                                                    <div class="pat-det mx-4">
                                                                        <h5 class=""><a href="#">'.$perticular_pat['fname'].' '.$perticular_pat['sname'].'</a></h5>
                                                                        <p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('Y M d', strtotime($key)).', '.$v['book_t'][0].' AM</p>
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
    else if(isset($_POST['pre_p_details'])) {
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
                                    
                                    echo'<tr class="py-5">
                                            <td class="d-flex pat">
                                                <img src="https://test.feelyprivacy.com/s/public/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
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
                                                                        <img src="https://test.feelyprivacy.com/s/public/image/pat-img/default_user.png" height="110" width="110"
                                                                            alt="" srcset="">
                                                                    </div>
                                                                    <div class="pat-det mx-4">
                                                                        <h5 class=""><a href="#">'.$perticular_pat['fname'].' '.$perticular_pat['sname'].'</a></h5>
                                                                        <p class="m-0 "><i class="bi bi-clock-fill"></i> '.date('Y M d', strtotime($key)).', '.$v['book_t'][0].' AM</p>
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

    
?>