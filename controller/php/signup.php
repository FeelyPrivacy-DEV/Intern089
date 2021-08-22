<?php

require '../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://143.244.139.242:27017' );
$db = $con->php_mongo; 

try {
    


if(isset($_POST['manager_signup'])) {
    $collection = $db->manager;

    $data = array(
        'secret' => "0xd36232060c2727eDE97A8A9F6c61ffa636779cb2",
        'response' => $_POST['h-captcha-response']
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    // var_dump($response);
    $responseData = json_decode($response);
    if($responseData->success) {
        $pass = $_POST['pass'];
        $datetime= (Object)[];
        $hash = password_hash( $pass, PASSWORD_DEFAULT );
        $d_unid = strval(rand());
        $p_unid = [];
        $gen_info = [];
    
        $collection->insertOne( [
            'd_unid' => $d_unid,
            'p_unid' => $p_unid,
            'password' =>$hash, 
            'fname' =>$_POST['fname'], 
            'sname' =>$_POST['sname'], 
            'email' =>$_POST['email'], 
            'gen_info' => [
                'phone_no' => '', 
                'gender' => '', 
                'DOB' => '',
                'biography' => '',
                'member_since' => date('Y-m-d')
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
        ]);
    
        $collection = $db->admin;
        $collection->updateOne(
            ['a_unid' => '1123498786'], 
            ['$push' =>['pendingDoc_ids' => $d_unid]]
        );
    
        
        header('location: http://143.244.139.242/s/d?login=now');
        // echo 'Account created success';
    } 
    else {
        header('location: http://143.244.139.242/s/d?c=e');
        // print_r($responseData);
        
    }


}
else if(isset($_POST['employee_signup'])) {
    $collection = $db->employee;

    $data = array(
        'secret' => "0xd36232060c2727eDE97A8A9F6c61ffa636779cb2",
        'response' => $_POST['h-captcha-response']
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    // var_dump($response);
    $responseData = json_decode($response);
    if($responseData->success) {

        $pass = $_POST['pass'];
        $datetime = (Object)[];
        $docid = (Object)[];
        $hash = password_hash( $pass, PASSWORD_DEFAULT );
        $d_unid = [];
        $p_unid = strval(rand());

        $collection->insertOne( [
            'd_unid' => $d_unid,
            'p_unid' => $p_unid,
            'fname' =>$_POST['fname'], 
            'sname' =>$_POST['sname'], 
            'empid' =>$_POST['empid'], 
            'email' =>$_POST['email'], 
            'gen_info' => [
                'phone_no' => '', 
                'gender' => '', 
                'DOB' => '',
                'member_since' => date('Y-m-d')
            ],
            'password' =>$hash, 
            'datetime'=>$datetime
        ] );

        $collection = $db->admin;
        $collection->updateOne(
            ['a_unid' => '1123498786'], 
            ['$push' =>['pat_ids' => $p_unid]]
        );

        
        header('location: http://143.244.139.242/s/p?login=now');
    }
    else {
        header('location: http://143.244.139.242/s/p?c=e');

    }
    // echo 'Account created success';

}
// $record = $collection->find( [ 'email' =>'Peter@gmail.com'] );

// foreach ( $record as $manager ) {
//     echo $manager['email'], ': ', $manager['password'].'<br>';
// }





} catch (\Throwable $th) {
    print_r($th)   ;
}

?>