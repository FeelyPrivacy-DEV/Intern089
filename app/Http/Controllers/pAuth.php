<?php

namespace App\Http\Controllers;

use Exception;
use MongoDB\Client as mongo;
use Illuminate\Http\Request;


class pAuth extends Controller {

    function newPat(Request $req) {
            // return $req->input();
            $con = new mongo;
            $db = $con->php_mongo;

            $fname = $req->input('patient_registration_fname');
            $email = $req->input('patient_registration_email');
            $p_unid = strval( rand() );

            // $data = array(
            //     'secret' => '0xd36232060c2727eDE97A8A9F6c61ffa636779cb2',
            //     'response' => $req->input('h-captcha-response')
            // );
            // $verify = curl_init();
            // curl_setopt( $verify, CURLOPT_URL, 'https://hcaptcha.com/siteverify' );
            // curl_setopt( $verify, CURLOPT_POST, true );
            // curl_setopt( $verify, CURLOPT_POSTFIELDS, http_build_query( $data ) );
            // curl_setopt( $verify, CURLOPT_RETURNTRANSFER, true );
            // $response = curl_exec( $verify );
            // var_dump( $response );
            // $responseData = json_decode( $response );
            // var_dump( $responseData );
            // var_dump( $responseData->success );
            // if ( $responseData->success ) {
                $collection = $db->admin;
                $collection->updateOne(
                    ['a_unid' => '39992729'],
                    ['$push' =>['pat_ids' => $p_unid]]
                );
                include(app_path().'/email/pat_reg_email.php');
                // include './email/pat_reg_email.php';
                if($send == true) {
                    $collection = $db->employee;
                    $pass = $req->input('patient_registration_pass');
                    $datetime = ( Object )[];
                    $hash = password_hash( $pass, PASSWORD_DEFAULT );
                    $d_unid = [];

                    $r =$collection->insertOne( [
                        'd_unid' => $d_unid,
                        'p_unid' => $p_unid,
                        'fname' =>$fname,
                        'sname' =>$req->input('patient_registration_sname'),
                        'email' =>$email,
                        'gen_info' => [
                            'phone_no' => '',
                            'gender' => '',
                            'DOB' => '',
                            'member_since' => date( 'Y-m-d h:i' ),
                            'reset_token' => [
                                'token' => 'null',
                                'time' => 'null'
                            ],
                        ],
                        'password' =>$hash,
                        'datetime'=>$datetime
                    ] );

                    return 'true';
                }
                else {
                    return 'emailError';
                }
                // return $r;
            // } else {
                // return 'captchaError';
            //     // header( 'location: /p-login?c=e' );
            //     return redirect('/p-login?c=e');
            // }


    }
    public function loginPat(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->employee;

        $email = $_POST['patient_login_email'];
        $pass = $_POST['patient_login_pass'];

        $record = $collection->findOne( [ 'email' =>$email ]);

        if($record) {
            if(password_verify( $pass, $record['password'])) {
                session_start();
                $req->session()->put('email', $record['email']);
                $req->session()->put('p_unid', $record['p_unid']);
                $_SESSION['eid'] = $record['_id'];
                $_SESSION['email'] = $record['email'];
                $_SESSION['fname'] = $record['fname'];
                $_SESSION['sname'] = $record['sname'];
                $_SESSION['p_unid'] = $record['p_unid'];
                // header('location: http://127.0.0.1/s/s/view/p/index');
                return 'true';
                exit();
            }
            else {
                // header('location: http://127.0.0.1/s/s/p?auth=failed');
                return 'pfalse';
            }
        }
        else {
            // header('location: http://127.0.0.1/s/s/p?auth=failed');
            return 'efalse';
        }


    }

    function forgotPat(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->employee;
        $email = $req->input('email');
        $record = $collection->findOne( [ 'email' =>$email ]);
        if($record['_id'] != null) {
            include(app_path().'/email/pat_forgot_email.php');
            // include './email/pat_forgot_email.php';
            if($send == true) {
                echo 'true';
            }
            else {
                echo 'notSent';
            }
        }
        else {
            echo 'Account not found';
        }
    }

    function changePasswordPat(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->employee;
        $pass = $req->input('new_pass');
        $token = $req->input('token');
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $r = $collection->updateOne(
            ['gen_info.reset_token.token'=> $token],
            ['$set'=>['password'=> $hash]]
        );
        // print_r($r);
        $record = $collection->findOne(['gen_info.reset_token.token'=> $token]);
        include './email/pat_reset_email.php';
        include(app_path().'/email/pat_reset_email.php');
        if($send == true) {
            echo 'true';
        }
        else {
            echo 'notSent';
        }
    }

}
