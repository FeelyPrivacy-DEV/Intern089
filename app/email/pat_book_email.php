<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '../../vendor/autoload.php';

$sender = 'hello@feelyprivacy.com';
$senderName = 'FeelyPrivacy';
$recipient = $_SESSION['email'];
$usernameSmtp = 'AKIASX2DB3OIBTJVZIWW';
$passwordSmtp = 'BA5t01w1QYc6CFvm3kK3HD3mlYrHeL6dqvTszZYOdiFV';

// $configurationSet = 'ConfigSet';

$host = 'email-smtp.ap-south-1.amazonaws.com';
$port = 587;

$subject = '
    Appoinment Booked !
';

$bodyText =  '
    Appoinment Booked !
';

if($s_time <= 12) {
    $bodyHtml = '
        <img src="http://127.0.0.1/s/s/public/image/logo.png" style="margin: 0px auto !important;" height="100" >
        <h3>Hi, '.$_SESSION['fname'].'</h3>
        <p style="margin-left: 10px !important;">Your Appoinment is booked with Dr. '.$drecord['fname'].' '.$drecord['sname'].'</p>
        <h5 style="margin: 10px !important;">Appoinment Details :- </h5>
        <p>Date: '.$date.'</p>
        <p>Time: '.date('h:i', strtotime($s_time)).' AM - '.date('h:i', strtotime($e_time)).' AM</p>
        ';
}
else {
    $bodyHtml = '
        <img src="http://127.0.0.1/s/s/public/image/logo.png" style="margin: 0px auto !important;" height="100" >
        <h3>Hi, '.$_SESSION['fname'].'</h3>
        <p style="margin-left: 10px !important;">Your Appoinment is booked with Dr. '.$drecord['fname'].' '.$drecord['sname'].'</p>
        <h5 style="margin: 10px !important;">Appoinment Details :- </h5>
        <p>Date: '.$date.'</p>
        <p>Time: '.date('h:i', strtotime($s_time)).' PM - '.date('h:i', strtotime($e_time)).' PM</p>
    ';
}



$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';
  //  $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $bodyHtml;
    $mail->AltBody    = $bodyText;
    $mail->Send();
    $send = true;
    echo "Email sent!" , PHP_EOL;
} catch (Exception $e) {
    $send = false;
    // echo "An error occurred. {$e->errorMessage()}", PHP_EOL; 
} catch (Exception $e) {
    $send = false;
    // echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; 
}

?>