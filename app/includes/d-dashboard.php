<?php

use MongoDB\Client as mongo;
$con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;

if(isset($_POST['next_p_details'])) {
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
                                            <img src="http://127.0.0.1/s/s/public/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
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
// else if(isset($_POST['pre_p_details'])) {
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
                                            <img src="http://127.0.0.1/s/s/public/image/doc-img/doc-img/default-doc.jpg" class="my-auto" height="40" alt="" srcset="">
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
// }
