<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$sender = 'hello@feelyprivacy.com';
$senderName = 'FeelyPrivacy';
$recipient = 'pavankumargovindtidke21@gmail.com';
$usernameSmtp = 'AKIASX2DB3OIBTJVZIWW';
$passwordSmtp = 'BA5t01w1QYc6CFvm3kK3HD3mlYrHeL6dqvTszZYOdiFV';

// $configurationSet = 'ConfigSet';

$host = 'email-smtp.ap-south-1.amazonaws.com';
$port = 587;

$subject = 'Amazon SES test (SMTP interface accessed using PHP)';

$bodyText =  "Email Test\r\nThis email was sent through the
    Amazon SES SMTP interface using the PHPMailer class.";

$bodyHtml = '<h1>Email Test</h1>';


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
    echo "Email sent!" , PHP_EOL;
} catch (Exception $e) {
    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; 
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; 
}

?>
