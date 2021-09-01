<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as mongo;




class dAuth extends Controller {

    public function newDoc(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;

        $fname = $req->input('fname');
        $email = $req->input('email');

        // print_r($req->input('h-captcha-response'));

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
        // print_r($responseData);
        // if ( $responseData->success) {
            $pass = $req->input('pass');
            $datetime = ( Object )[];
            $hash = password_hash( $pass, PASSWORD_DEFAULT );
            $d_unid = strval( rand() );
            $p_unid = [];
            $gen_info = [];

            $collection->insertOne( [
                'd_unid' => $d_unid,
                'p_unid' => $p_unid,
                'password' =>$hash,
                'fname' =>$fname,
                'sname' =>$req->input('sname'),
                'email' =>$req->input('email'),
                'gen_info' => [
                    'phone_no' => '',
                    'gender' => '',
                    'DOB' => '',
                    'biography' => '',
                    'member_since' => date( 'Y-m-d' ),
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

            $collection = $db->admin;
            $collection->updateOne(
                ['a_unid' => '39992729'],
                ['$push' =>['pendingDoc_ids' => $d_unid]]
            );
            include(app_path().'/email/doc_reg_email.php');
            // include './email/doc_reg_email.php';
            if($send == true) {
                // header( 'location: /' );
                return redirect('/?login=wait');
            }
            else {
                header( 'location: /?email=err' );
            }

            // echo 'Account created success';
        // }
        // else {
        //     header( 'location: /?c=e' );
        // }


    }

    public function logDoc(Request $req) {
        // print_r($req->input('email'));

        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->manager;

        $email = $req->input('email');
        $pass = $req->input('pass');

        $record = $collection->findOne( [ 'email' =>$email ]);

        if($record) {
            if(password_verify( $pass, $record['password'])) {
                if($record['approved'] == true) {
                    if($record['login_able'] == true) {
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['docid'] = $record['_id'];
                        $_SESSION['email'] = $record['email'];
                        $_SESSION['d_unid'] = $record['d_unid'];
                        $_SESSION['fname'] = $record['fname'];
                        $_SESSION['sname'] = $record['sname'];
                        // header('location: http://127.0.0.1/s/s/view/d/index');
                        return redirect('/d');
                        exit();
                    }
                    else {
                        // header('location: http://127.0.0.1/s/s/index?login=disable');
                        return redirect('/?login=disable');
                    }
                }
                else {
                    // header('location: http://127.0.0.1/s/s/index?auth=disable');
                    return redirect('/?auth=disable');
                }
            }
            else {
                // header('location: http://127.0.0.1/s/s/index?auth=failed');
                return redirect('/?auth=failed');
            }
        }
        else {
            // header('location: http://127.0.0.1/s/s/index?auth=failed');
            return redirect('/?auth=failed');
        }

    }

}



