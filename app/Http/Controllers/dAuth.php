<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;




class dAuth extends Controller {

    public function newDoc(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;

        $fname = $req->input('doctor_register_fname');
        $email = $req->input('doctor_register_email');
        $d_unid = strval( rand() );
        // print_r($req->input('h-captcha-response'));

        // echo "<br>";
        // echo "<br>";

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
        // print_r( $response );
        // echo "<br>";
        // echo "<br>";

        // $responseData = json_decode( $response );
        // print_r($responseData);
        // echo "<br>";
        // echo "<br>";

        // if ( $responseData->success) {
            $collection = $db->admin;
            $collection->updateOne(
                ['username' => 'admin'],
                ['$push' =>['pendingDoc_ids' => $d_unid]]
            );
            include(app_path().'/email/doc_reg_email.php');
            // include './email/doc_reg_email.php';
            if($send == true) {
                $collection = $db->manager;
                $pass = $req->input('doctor_register_pass');
                $datetime = ( Object )[];
                $hash = password_hash( $pass, PASSWORD_DEFAULT );
                $p_unid = [];

                $collection->insertOne( [
                    'd_unid' => $d_unid,
                    'p_unid' => $p_unid,
                    'password' =>$hash,
                    'fname' =>$fname,
                    'sname' =>$req->input('doctor_register_sname'),
                    'email' =>$email,
                    'gen_info' => [
                        'phone_no' => '',
                        'gender' => '',
                        'DOB' => '',
                        'biography' => '',
                        'member_since' => date( 'Y-m-d h:i' ),
                        'reset_token' => [
                            'token' => 'null',
                            'time' => 'null'
                        ],
                    ],
                    'clinic_info' => [
                        'clinic_name' => '',
                        'clinic_addrs' => '',
                        'clinic_image' => [],
                    ],
                    'contact_detail' => [
                        'addressLine' => '',
                        'clinic_addrs' => '',
                        'city' => '',
                        'state' => '',
                        'country' => '',
                        'postal_code' => '',
                    ],
                    'servicesAndSpec' => [
                        'services' => '',
                        'spec' => '',
                    ],
                    'education' => [
                        'degree' => [],
                        'college' => [],
                        'year_of_comp' => [],
                    ],
                    'experience' => [
                        'hospital_name' => [],
                        'hos_from' => [],
                        'hos_to' => [],
                        'designation' => [],
                    ],
                    'awards' => [
                        'aw_name' => [],
                        'aw_year' => [],
                    ],
                    'memberships' => [],
                    'reg_name' => [],
                    'custom_price'=> '',
                    'profile_image'=> '',
                    'approved'=> false,
                    'login_able'=> false,
                    'total_earn'=> '',
                    'datetime'=> $datetime
                ] );
                return 'true';
            }
            else {
                return 'emailError';
            }
        // }
        // else {
            // return 'captchaError';
        // }


    }

    public function logDoc(Request $req) {
        // print_r($req->input());
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;
        $email = $req->input('doc_email');
        $pass = $req->input('doc_pass');
        $record = $collection->findOne( [ 'email' =>$email ]);

        if($record) {
            if(password_verify( $pass, $record['password'])) {
                if($record['approved'] == true) {
                    if($record['login_able'] == true) {
                        session_start();
                        $req->session()->put('d_unid', $record['d_unid']);
                        $req->session()->put('email', $record['email']);
                        $_SESSION['loggedin'] = true;
                        $_SESSION['docid'] = $record['_id'];
                        $_SESSION['email'] = $record['email'];
                        $_SESSION['d_unid'] = $record['d_unid'];
                        $_SESSION['fname'] = $record['fname'];
                        $_SESSION['sname'] = $record['sname'];
                        return 'true';
                        exit();
                    }
                    else {
                        return 'disable';
                    }
                }
                else {
                    return 'notApproved';
                }
            }
            else {
                return 'pfalse';
                exit();
            }
        }
        else {
            return 'efalse';
            exit();
        }

    }

    function forgotDoc(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;
        $email = $req->input('email');
        $record = $collection->findOne( [ 'email' =>$email ]);

        if($record['_id'] != null) {
            include(app_path().'/email/doc_forgot_email.php');
            // include './email/doc_forgot_email.php';
            if($send == true) {
                return 'true';
            }
            else {
                return 'notSent';
            }
        }
        else {
            return 'Account not found';
        }
    }

    function changePasswordDoc(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;
        $pass = $req->input('new_pass');;
        $token = $req->input('token');
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $r = $collection->updateOne(
            ['gen_info.reset_token.token'=> $token],
            ['$set'=>['password'=> $hash]]
        );
        // print_r($r);
        $record = $collection->findOne(['gen_info.reset_token.token'=> $token]);
        // include './email/doc_reset_email.php';
        include(app_path().'/email/doc_reset_email.php');
        if($send == true) {
            return 'true';
        }
        else {
            return 'notSent';
        }
    }

}



