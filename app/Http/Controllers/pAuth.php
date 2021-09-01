<?php

namespace App\Http\Controllers;
use MongoDB\Client as mongo;
use Illuminate\Http\Request;


class pAuth extends Controller {

    public function newPat(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->employee;

        $fname = $req->input('fname');
        $email = $req->input('email');

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
        // // var_dump( $response );
        // $responseData = json_decode( $response );
        // if ( $responseData->success ) {

            $pass = $req->input('pass');
            $datetime = ( Object )[];
            $docid = ( Object )[];
            $hash = password_hash( $pass, PASSWORD_DEFAULT );
            $d_unid = [];
            $p_unid = strval( rand() );

            $collection->insertOne( [
                'd_unid' => $d_unid,
                'p_unid' => $p_unid,
                'fname' =>$fname,
                'sname' =>$req->input('sname'),
                // 'empid' =>$_POST['empid'],
                'email' =>$email,
                'gen_info' => [
                    'phone_no' => '',
                    'gender' => '',
                    'DOB' => '',
                    'member_since' => date( 'Y-m-d' ),
                    'reset_token' => [
                        'token' => 'null',
                        'time' => 'null'
                    ],
                ],
                'password' =>$hash,
                'datetime'=>$datetime
            ] );

            $collection = $db->admin;
            $collection->updateOne(
                ['a_unid' => '39992729'],
                ['$push' =>['pat_ids' => $p_unid]]
            );
            include(app_path().'/email/pat_reg_email.php');
            // include './email/pat_reg_email.php';
            if($send == true) {
                // header( 'location: /p-login?login=now' );
                return redirect('/p-login?login=now');
            }
            else {
                // header( 'location: /p-login?email=err' );
                return redirect('/p-login?email=err');
            }

        // } else {
        //     // header( 'location: /p-login?c=e' );
        //     return redirect('/p-login?c=e');
        // }

    }
    public function loginPat(Request $req) {
        $con = new mongo;
        $db = $con->php_mongo;
        $collection = $db->employee;

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $record = $collection->findOne( [ 'email' =>$email ]);

        if($record) {
            if(password_verify( $pass, $record['password'])) {
                session_start();
                $_SESSION['eid'] = $record['_id'];
                $_SESSION['email'] = $record['email'];
                $_SESSION['fname'] = $record['fname'];
                $_SESSION['sname'] = $record['sname'];
                $_SESSION['p_unid'] = $record['p_unid'];
                // header('location: http://127.0.0.1/s/s/view/p/index');
                return redirect('/p');
                exit();
            }
            else {
                // header('location: http://127.0.0.1/s/s/p?auth=failed');
                return redirect('/p-login?auth=failed');
            }
        }
        else {
            // header('location: http://127.0.0.1/s/s/p?auth=failed');
            return redirect('p-login?auth=failed');
        }


    }

}
