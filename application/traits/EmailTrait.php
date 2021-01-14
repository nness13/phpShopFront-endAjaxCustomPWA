<?php

namespace application\traits;


trait EmailTrait {

    function send_mail( $email, $title, $text ) {
        mail($email, $title, '<!DOCTYPE html>
		<html>
		<head>
		<meta charset="UTF-8">
		<title>'.$title.'</title>
		</head>
		<body style="margin:0">
            <div style="margin:0; padding:0; font-size: 18px; font-family: Arial, sans-serif; font-weight: bold; text-align: center; background: #FCFCFD">
                <div style="margin:0; background: #464E78; padding: 25px; color:#fff">'.$title.'</div>
                <div style="padding:30px;"><div style="background: #fff; border-radius: 10px; padding: 25px; border: 1px solid #EEEFF2">'.$text.'</div></div>
            </div>
		</body>
		</html>', "From: account@househall.tk\r\nMIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8");
    }

}