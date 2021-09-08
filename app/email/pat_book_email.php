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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <!--[if gte mso 9]>
        <xml>
        <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="x-apple-disable-message-reformatting">
        <!--[if !mso]><!-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<![endif]-->
        <title></title>
        <style type="text/css">

            .main {
                border-top-left-radius: 100px !important;
                border-bottom-right-radius: 100px !important;
            }
            h1, h2, h3, h4, h5, h6, p {
                font-family: \'Cabin\', sans-serif;
                text-align: center;
            }
            a {
                text-decoration: none !important;
            }
            .btn {
                display: flex;
                justify-content: center !important;
                margin: 30px auto !important;
            }
            .buttonA {
                align-item: center !important;
                margin: 30px auto !important;
                color: #000 !important;
                background-color: #00ffca !important;
                padding: 14px 50px !important;
                border: none;
                border-radius: 10px !important;
                font-size: 15px !important;
                font-weight: 600;
                box-shadow: 4px 4px 10px rgb(168, 168, 168) !important;
            }
            .t {
                margin: 20px 0 !important;
                justify-content: start !important;
                color: #fff !important;
            }
            @media screen and (max-width: 800px) {
                .main {
                    border-radius: 17px !important;
                }
            }
        </style>
        <!--[if !mso]><!-->
        <!--<![endif]-->
    </head>
        <body class="clean-body" style="display: flex;justify-content: center !important;margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #fff;color: #008b8b;width: 100%;">
            <div class="main" style="background-color: #01afaf;display: flex;justify-content: center !important; margin: 40px 5% !important;min-height: 400px !important;width: 100%;">
                <div class="welcome" style="justify-content: center !important;width: 100%;">
                <a href="https://test.feelyprivacy.com">
                    <img src="https://test.feelyprivacy.com/image/logo.jpg" alt="" height="50"
                    style="display: flex;justify-content: center;margin: 10px auto !important;" />
                </a>
                <h3 style="font-size: 2rem !important; color: #fff !important;">Hi '.$_SESSION['fname'].',</h3>
                <span><p style="color: #fff !important; margin: 20px !important;">
                        Your appoinment is fixed with Dr. '.$drecord['fname'].' '.$drecord['sname'].' <br />
                        Please wait for doctor confirmation about appoinment.
                    </p>
                </span>
                <h3 style="font-size: 1.2rem !important;font-weight: 500 !important; margin-top: 70px !important; color: #fff !important;">Your appoinment details</h3>
                <div class="t">
                    <p style="font-size: 1rem !important; margin: 0px 0px !important;">Dr. Name : '.$drecord['fname'].' '.$drecord['sname'].'</p><br>
                    <p style="font-size: 1rem !important; margin: 0px 0px !important;">Date : '.$date.'</p><br>
                    <p style="font-size: 1rem !important; margin: 0px 0px !important;">Time : '.date('h:i', strtotime($s_time)).' AM - '.date('h:i', strtotime($e_time)).' AM</p>
                </div>
                <div class="address" style="margin-top: 100px !important;">
                    <span><p style="color: rgb(214, 214, 214);">Beed, Maharashtra, INDIA</p></span><br>
                    <span><p style="margin: 0px !important; color: #fff !important;">+919754625871 | <span style="color: #fff !important;"> hello@feelyprivacy.com </span></p></span><br>
                </div>
            </div>
        </div>
    </body>
</html>
';

}
else {

$bodyHtml = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <!--[if gte mso 9]>
        <xml>
        <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="x-apple-disable-message-reformatting">
        <!--[if !mso]><!-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<![endif]-->
        <title></title>
        <style type="text/css">

            .main {
                border-top-left-radius: 100px !important;
                border-bottom-right-radius: 100px !important;
            }
            h1, h2, h3, h4, h5, h6, p {
                font-family: \'Cabin\', sans-serif;
                text-align: center !important;
            }
            a {
                text-decoration: none !important;
            }
            .btn {
                display: flex;
                justify-content: center !important;
                margin: 30px auto !important;
            }
            .buttonA {
                align-item: center !important;
                margin: 30px auto !important;
                color: #000 !important;
                background-color: #00ffca !important;
                padding: 14px 50px !important;
                border: none;
                border-radius: 10px !important;
                font-size: 15px !important;
                font-weight: 600;
                box-shadow: 4px 4px 10px rgb(168, 168, 168) !important;
            }
            .t {
                margin: 20px auto !important;
                justify-content: center !important;
                color: #fff !important;
            }
            @media screen and (max-width: 800px) {
                .main {
                    border-radius: 17px !important;
                }
            }
        </style>
        <!--[if !mso]><!-->
        <!--<![endif]-->
    </head>
    <body class="clean-body" style="display: flex;justify-content: center !important;margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #fff;color: #008b8b;width: 100%;">
        <div class="main" style="background-color: #01afaf;display: flex;justify-content: center !important; margin: 40px 5% !important;min-height: 400px !important;width: 100%;">
            <div class="welcome" style="justify-content: center !important;width: 100%;">
                <a href="https://test.feelyprivacy.com">
                    <img src="https://test.feelyprivacy.com/image/logo.jpg" alt="" height="50"
                    style="display: flex;justify-content: center;margin: 10px auto !important;" />
                </a>
                <h3 style="font-size: 2rem !important; color: #fff !important;">Hi '.$_SESSION['fname'].',</h3>
                <span><p style="color: #fff !important; margin: 20px !important;">
                     Your appoinment is fixed with Dr. '.$drecord['fname'].' '.$drecord['sname'].' <br />
                    Be prepaired on your schedule to meet te doctor. Gook luck !
                    </p>
                </span>
                <h3 style="font-size: 1.2rem !important;font-weight: 500 !important; margin-top: 70px !important; color: #fff !important;">Your appoinment details</h3>
                <div class="t">
                    <p style="font-size: 1rem !important; margin: 0px 0px !important;">Dr. Name : '.$drecord['fname'].' '.$drecord['sname'].'</p><br>
                    <p style="font-size: 1rem !important; margin: 0px 0px !important;">Date : '.$date.'</p><br>
                    <p style="font-size: 1rem !important; margin: 0px 0px !important;">Time : '.date('h:i', strtotime($s_time)).' PM - '.date('h:i', strtotime($e_time)).' PM</p>
                </div>
                <div class="address" style="margin-top: 100px !important;">
                    <span><p style="color: rgb(214, 214, 214);">Beed, Maharashtra, INDIA</p></span><br>
                    <span><p style="margin: 0px !important; color: #fff !important;">+919754625871 | <span style="color: #fff !important;"> hello@feelyprivacy.com </span></p></span><br>
                </div>
            </div>
        </div>
    </body>
</html>
';
}



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
