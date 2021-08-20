<?php

require '../../vendor/autoload.php';

$con = new MongoDB\Client( 'mongodb://localhost:27017' );
$db = $con->php_mongo; 

if(isset($_POST['manager_signup'])) {
    $collection = $db->manager;

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
    $collection->insertOne(
        ['a_unid' => '970913346'], 
        ['$push' =>['pendingDoc_ids' => $d_unid]]
    );

    
    header('location: http://localhost/s/s/index?login=now');
    // echo 'Account created success';

}
else if(isset($_POST['employee_signup'])) {
    $collection = $db->employee;

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
    
    header('location: http://localhost/s/s/index?login=now');
    // echo 'Account created success';

}
// $record = $collection->find( [ 'email' =>'Peter@gmail.com'] );

// foreach ( $record as $manager ) {
//     echo $manager['email'], ': ', $manager['password'].'<br>';
// }

?>