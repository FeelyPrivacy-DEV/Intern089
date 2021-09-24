<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sender = env('MAIL_FROM_ADDRESS');
$senderName = env('MAIL_FROM_NAME');
$usernameSmtp = env('MAIL_USERNAME');
$passwordSmtp = env('MAIL_PASSWORD');
$host = env('MAIL_HOST');
$port = env('MAIL_PORT');
$recipient = $email;
// $configurationSet = 'ConfigSet';

$subject = '
    Jeev60 doctor Approval !
';

$bodyText =  '
    doc approval test successful...
';

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
                border-top-left-radius: 150px !important;
                border-bottom-right-radius: 150px !important;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: \'Lobster\', cursive;
                text-align: center !important;
            }
            p {
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
            @media screen and (max-width: 800px) {
                .main {
                    border-radius: 17px !important;
                }
            }
        </style>
        <!--[if !mso]><!-->
        <!--<![endif]-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    </head>
    <body class="clean-body" style="display: flex;justify-content: center !important;margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #fff;color: #008b8b;width: 100%;">
        <div class="main" style="background-color: #01afaf;display: flex;justify-content: center !important; margin: 40px 5% !important;min-height: 400px !important;width: 100%;">
            <div class="welcome" style="justify-content: center !important;width: 100%;">
                <a href="https://test.feelyprivacy.com">
                    <img src="https://test.feelyprivacy.com/image/logo.jpg" alt="" height="50"
                    style="display: flex;justify-content: center;margin: 10px auto !important;" />
                </a>
                <h3 style="font-size: 2rem !important; color: #fff !important;">Congragulations '.$fname.',</h3>
                <span><p style="color: #fff !important; margin: 20px !important;">
                    '.$msg.' <br />

                    </p>
                </span>
                <div class="address" style="margin-top: 100px !important;">
                    <span><p style="color: rgb(214, 214, 214);">Beed, Maharashtra, INDIA</p></span><br>
                    <span><p style="margin: 0px !important; color: #fff !important;">+919754625871 | <span style="color: #fff !important;"> hello@feelyprivacy.com </span></p></span><br>
                </div>
            </div>
        </div>
    </body>
</html>

';

$mail = new PHPMailer(true);

try {
    // echo $mail->SMTPDebug = 2;
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
