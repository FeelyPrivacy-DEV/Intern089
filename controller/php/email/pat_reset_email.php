<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '../../vendor/autoload.php';

$sender = 'hello@feelyprivacy.com';
$senderName = 'FeelyPrivacy';
$recipient = $record['email'];
$usernameSmtp = 'AKIASX2DB3OIBTJVZIWW';
$passwordSmtp = 'BA5t01w1QYc6CFvm3kK3HD3mlYrHeL6dqvTszZYOdiFV';

// $configurationSet = 'ConfigSet';

$host = 'email-smtp.ap-south-1.amazonaws.com';
$port = 587;

$subject = '
    Reset Done
';
$bodyText =  '
    Reset done
';

$bodyHtml = '
<img src="https://test.feelyprivacy.com/s/public/image/logo.png" style="margin: 0px auto !important;" height="100" >
    <h5>
    Hi, '.$record['fname'].'
        patient reseted password 

    </h5>
';


$mail = new PHPMailer(true);

try {
    // $mail->SMTPDebug = 2;
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
    // echo "Email sent!" , PHP_EOL;
} catch (Exception $e) {
    $send = false;
    // echo "An error occurred. {$e->errorMessage()}", PHP_EOL; 
} catch (Exception $e) {
    $send = false;
    // echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; 
}

?>