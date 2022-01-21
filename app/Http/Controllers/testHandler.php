<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use MongoDB\Client as mongo; 
 
session_start();

class testHandler extends Controller {

    function emailTest(Request $req) {
 
        $html_content = '
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
                    <title>title of email</title>
                </head>
                <body>

                <div class="d-flex justify-content-center">
                    <h1 class="text-danger">'.$req['sender'].'</h1>
                    <button class="btn btn-primary">Buttojn</button>
                </div>

                </body>
            </html>
        ';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.mailazy.com/v1/mail/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>'{' .
                '"to": ["pavankumartidke@gmail.com"],' .
                '"from": "hello @feelyprivacy.com",' .
                '"subject": "You are selected as a test subject.",' .
                '"content": [
                    {
                        "type": "text/plain", "value": "heyyi"
                    },
                    {
                        "type": "text/html", "value": "" '.$html_content.'""    
                    }
                ]' .
            '}',
            CURLOPT_HTTPHEADER => array(
                "X-Api-Key: ".env('MAILAZY_API_KEY')."",
                "X-Api-Secret: ".env('MAILAZY_API_SECRET')."",
                "Content-Type: application/json"
            ),  
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response; 
    }
}
