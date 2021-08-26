<?php

session_start();
require '../../vendor/autoload.php';
    $con = new MongoDB\Client( 'mongodb://143.244.139.242:27017' );
    $db = $con->php_mongo;


    if(isset($_POST['d_sel'])){
        $ass = $_POST['doc_id'];
        echo $ass;

        // $flag2 = false;
        // $collection = $db->manager;
        // $record = $collection->findOne( ["unid" => "6118"] );
        // $datetime = iterator_to_array( $record['datetime'] );

        // $date_arr = [];
        // $time_arr = [];

        // foreach($datetime as $date_key=>$val) {
        //     $date_arr[] = $date_key;
        //     foreach($val as $index=>$v) {
        //         $time_arr[$date_key][] = $v;
        //     }    
        // }

        // $k = count( $date_arr );

        // $collection = $db->employee;
        // $record = $collection->findOne( ['email' =>'1@gmail.com'] );
        // $datetime = iterator_to_array( $record['datetime'] );

        // for($i = 0; $i < 7; $i++) {
        //     $date = strtotime("+$i day", strtotime("previous monday"));
        //     $premon = date("Y-m-d", $date);
        //     $a = strval($premon);
        //     echo '<div class="time-slots">
        //             <div class="mx-auto">
        //                 <h5 class="text-dark px-4">'.date("D", $date).'</h5>
        //                 <p class="text-muted text-nowrap">'.date("d M Y", $date).'</p>
        //             </div>';

        //     $w = count($time_arr[$premon]); 
        //     if($w == 0) {
        //         echo '<button type="button" class="btn btn-sm px-5 m-1 text-nowrap" disabled>- - -</button>';
        //     }
        //     else {
        //         $x = 1;
        //         foreach($time_arr as $index=>$value) {
        //             if($index == $premon) {
        //                 echo '<div class="d-flex flex-column time-btn">';
        //                 foreach ( $value as $key=>$val ) {

        //                     foreach($datetime as $date_key=>$val2) {
        //                         if($date_key == $premon) {
        //                             foreach($val2 as $index=>$v) {
        //                                 $flag2 = false;
        //                                 if($v[0] == $val[0] && $v[1] == $val[1]){
        //                                     $flag2 = true;
        //                                     if($val[0] <= 12 && $val[1]) {
        //                                         echo '<button type="button" disabled
        //                                         class="btn btn-sm btn-primary text-light text-nowrap px-2 m-1 ">'.date('h:i', strtotime($val[0])).'AM - '.date('h:i', strtotime($val[1])).'
        //                                         AM<i class="bi bi-check2"></i></button>';
        //                                     }
        //                                     else {
        //                                         echo '<button type="button" disabled
        //                                         class="btn btn-sm btn-primary text-light text-nowrap px-2 m-1 ">'.date('h:i', strtotime($val[0])).'PM - '.date('h:i', strtotime($val[1])).'
        //                                         PM<i class="bi bi-check2"></i></button>';
        //                                     }
        //                                     goto ZSA;
        //                                 }
        //                             }    
        //                         }
        //                     }

        //                     ZSA: if($flag2 == false) {
        //                             if($val[0] <= 12 && $val[1]) {
        //                                 echo '<button type="button"
        //                                         onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\')"
        //                                         class="btn btn-sm  text-nowrap px-4 m-1"
        //                                         id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' AM - '.date('h:i', strtotime($val[1])).'
        //                                         AM</button>';
        //                                     $x++;
        //                             }
        //                             else {
        //                                 echo '<button type="button"
        //                                         onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\')"
        //                                         class="btn btn-sm  text-nowrap px-4 m-1"
        //                                         id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' PM - '.date('h:i', strtotime($val[1])).'
        //                                         PM</button>';
        //                                     $x++;
        //                             }
        //                         }
        //                 }
        //                 echo '</div>';            
        //             }
        //         }
        //     }
        //     echo '</div>';
        // }

    }

?>