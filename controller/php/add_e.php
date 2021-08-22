<?php

    error_reporting(0);
session_start();
require '../../vendor/autoload.php';
    $con = new MongoDB\Client( 'mongodb://143.244.139.242:27017' );
    $db = $con->php_mongo; $collection = $db->employee;


    if(isset($_POST['prodtopay_check'])) {

        $collection = $db->employee;
        $date = $_POST['date'];
        $doc_id = $_POST['doc_id'];
        $s_time = $_POST['s_time'];
        $e_time = $_POST['e_time'];
        
        // $record = $collection->updateOne(
        //     ['_id' => $_SESSION['eid']],
        //     ['$push' =>['datetime.'.$doc_id.'.'.$date=> ['d_stamp' => date('Y-m-d'), 'status' => '', 'amt' => '$120', 'p_name' => $_SESSION['fname'], 'book_t' =>[$s_time, $e_time]]]]
        // );
        // $collection = $db->manager;
        // $record = $collection->updateOne(
        //     ['d_unid' => $doc_id], 
        //     ['$addToSet' =>['p_unid' => $_SESSION['p_unid']]]
        // );
        // $collection = $db->check;
        // $record = $collection->updateOne(
        //     ['c_unid' => '429570412'],
        //     ['$push' =>['datetime.'.$date => [$s_time, $e_time]]]
        // );

        // clear SEO
        function seourl($phrase, $maxLength = 100000000000000) {
            $result = strtolower($phrase);
    
            $result = preg_replace("~[^A-Za-z0-9-\s]~", "", $result);
            $result = trim(preg_replace("~[\s-]+~", " ", $result));
            $result = trim(substr($result, 0, $maxLength));
            $result = preg_replace("~\s~", "-", $result);
    
            return $result;
        }

        echo seourl("/view/p/checkout?date=".$date);

        header('location: http://143.244.139.242/s/view/p/checkout');

    }
    else if(isset($_POST['selected_sch'])) {
        echo $_POST['meeting_date'];
        $st = strval($_POST['meeting_time']);
    
        $collection = $db->manager;
        $record = $collection->findOne();
        $datetime = iterator_to_array( $record['datetime'] );

        $isTimeSame = false;
        
        foreach($datetime as $date_key=>$val) {
            foreach($val as $index=>$v) {
                if($v === $_POST['meeting_time']) {
                    $isTimeSame = true;
                    header('location: ../../employee/?e=sametm');
                    exit();
                }
            }    
        }

        
        if($isTimeSame == false) {
            $collection = $db->employee;
            $record = $collection->findOne( [ 'email' =>$_SESSION['email']] );
            $datetime = iterator_to_array( $record['datetime'] );

            // if($isTimeSameE == false) {
                $isTimeInsert = false;
                foreach($datetime as $date_key=>$val) {
                    if($date_key === $_POST['meeting_date']) {
                        $k = count( $datetime[$date_key] );
                        foreach($val as $index=>$v) {
                            if($v === $_POST['meeting_time']) {
                                echo 'time equal';
                                header('location: ../../employee/?time=equal');
                                exit();
                            }
                        }    
                        $r = $collection->updateOne(
                            ['email' => $_SESSION['email']],
                            ['$push' =>['datetime.'.$date_key => $_POST['meeting_time']]]
                        );
                        $isTimeInsert = true;
                        header('location: ../../employee/?time=add');
                        exit();
                    }
                }
                if($isTimeInsert) {
                    header('location: ../../employee/');
                }
                else {
                    $r = $collection->updateOne(
                        ['email' => $_SESSION['email']],
                        ['$push' =>['datetime.'.$_POST['meeting_date'] => $_POST['meeting_time']]]
                    );
                    header('location: ../../employee/?date=add');
                }
            // }
            
        }
    }
    else if(isset($_POST['d_sel'])){
        $ass = $_POST['doc_id'];
        // echo $ass;

        $flag2 = false;
        $collection = $db->manager;
        $record = $collection->findOne( ["d_unid" => $ass] );
        $datetime = iterator_to_array( $record['datetime'] );

        $date_arr = [];
        $time_arr = [];

        foreach($datetime as $date_key=>$val) {
            $date_arr[] = $date_key;
            foreach($val as $index=>$v) {
                $time_arr[$date_key][] = $v;
            }    
        }

        $k = count( $date_arr );

        $collection = $db->check;
        $record = $collection->findOne( ['c_unid' =>'429570412'] );
        $datetime = iterator_to_array( $record['datetime'] );

        for($i = 0; $i < 7; $i++) {
            $date = strtotime("+$i day", strtotime("this week"));
            $premon = date("Y-m-d", $date);
            $a = strval($premon);
            echo '<div class="time-slots">
                    <div class="mx-auto">
                        <h5 class="text-dark px-4">'.date("D", $date).'</h5>
                        <p class="text-muted text-nowrap">'.date("d M Y", $date).'</p>
                    </div>';
 
            // $w = count($time_arr[$premon]); 
            if($time_arr[$premon] == 0) {
                echo '<button type="button" class="btn btn-sm px-5 m-1 text-nowrap" disabled>---</button>';
            }
            else {
                $x = 1;
                foreach($time_arr as $index=>$value) {
                    if($index == $premon) {
                        echo '<div class="d-flex flex-column time-btn">';
                        foreach ( $value as $key=>$val ) {

                            foreach($datetime as $did=>$dval) {
                                if($did == $ass) {
                                    foreach($dval as $date_key=>$val2) {
                                        if($date_key == $premon) {
                                            foreach($val2 as $index=>$v) {
                                                $flag2 = false;
                                                if($v[0] == $val[0] && $v[1] == $val[1]){
                                                    $flag2 = true;
                                                    if($val[0] <= 12 && $val[1]) {
                                                        echo '<button type="button" disabled
                                                        class="btn btn-sm btn-primary text-light text-nowrap px-2 m-1 ">'.date('h:i', strtotime($val[0])).'AM - '.date('h:i', strtotime($val[1])).'
                                                        AM<i class="bi bi-check2"></i></button>';
                                                    }
                                                    else {
                                                        echo '<button type="button" disabled
                                                        class="btn btn-sm btn-primary text-light text-nowrap px-2 m-1 ">'.date('h:i', strtotime($val[0])).'PM - '.date('h:i', strtotime($val[1])).'
                                                        PM<i class="bi bi-check2"></i></button>';
                                                    }
                                                    goto ZSA;
                                                }
                                            }  
                                        }
                                    }
                                }
                            }

                            ZSA: if($flag2 == false) {
                                    if($val[0] <= 12 && $val[1]) {
                                        echo '<button type="button"
                                                onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\')"
                                                class="btn btn-sm  text-nowrap px-4 m-1 btn-a"
                                                id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' AM - '.date('h:i', strtotime($val[1])).'
                                                AM</button>';
                                            $x++;
                                    }
                                    else {
                                        echo '<button type="button"
                                                onclick="prodtopay(\''.$premon .'\', \''.$x .'\', \''.$val[0].'\', \''.$val[1].'\')"
                                                class="btn btn-sm  text-nowrap px-4 m-1 btn-a"
                                                id="btn'.$x.$premon.'">'.date('h:i', strtotime($val[0])).' PM - '.date('h:i', strtotime($val[1])).'
                                                PM</button>';
                                            $x++;
                                    }
                                }
                        }
                        echo '</div>';            
                    }
                }
            }
            echo '</div>';
        }

    }


?>