<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

if (!function_exists('sendEmail')) {

	function sendEmail($to, $subject="", $message, $headers) {
		 
		if($subject == ""){
			$subject = "Message from Asaanschool User.";
		}
		 
		$message = '<table width="100%"><tr><td><br/>'.$message.'<br/></td></tr></table>';
		 
		$defaultHeader= get_email_header();
		$headers = $defaultHeader . $headers;
		$message = get_email_prefix() .$message. get_email_postfix() ;
		if(get_app_message("enable_cloud_email")=="TRUE"){
			return send_email_by_sendgrid($to, $subject, $message, $headers);
		}else{
			return mail($to, $subject, $message, $headers);
		}
	}

}

if (! function_exists ( 'send_email_by_sendgrid' )) {
	function send_email_by_sendgrid($toadd, $subject="", $message, $headers) {
		 
		$sendername = get_app_message ( "sender.email.display.name" );
		$from = get_app_message ( "sender.email.address" );
		
		// If you are using Composer
		//require 'vendor/autoload.php';
		
		// If you are not using Composer (recommended)
		// require("path/to/sendgrid-php/sendgrid-php.php");
		
		$from = new SendGrid\Email(null, $from);
		 
		$to = new SendGrid\Email(null, $toadd);
		$content = new SendGrid\Content("text/html", $message);
		$mail = new SendGrid\Mail($from, $subject, $to, $content);
		
		$apiKey = getenv('SENDGRID_API_KEY');
		//$apiKey = "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";
		
		$sg = new \SendGrid($apiKey);
		
		$response = $sg->client->mail()->send()->post($mail);
		/* echo $response->statusCode();
		echo $response->headers();
		echo $response->body(); */
		
		if($response->statusCode() == 202) {
			return get_app_message ( "response.success" );
		} else {
			return get_app_message ( "response.failed" );
		}
	}
}
if (! function_exists ( 'send_email_by_mailgun' )) {
	function send_email_by_mailgun($to, $subject="", $message, $headers) {
		//sender.email.password
		$senderpass = get_app_message("sender.email.password");
		$sendername = get_app_message ( "sender.email.display.name" );
		$from = get_app_message ( "sender.email.address" );
		
		 
		//require 'vendor/autoload.php';
		
		$mail = new \PHPMailer\PHPMailer\PHPMailer();
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $from;   // SMTP username
		$mail->Password = $senderpass;                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted
		
		$mail->isHTML(TRUE); 
		
		
		$mail->From = $from;
		$mail->FromName = $sendername;
		$mail->addAddress($to);                 // Add a recipient
		
		//$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		
		$mail->Subject = $subject;
		$mail->Body    = $message;
		if(!$mail->send()) {
			return get_app_message ( "response.failed" );
		} else {
			return get_app_message ( "response.success" );
		}
	}
}
if (!function_exists('emailCampusUserCreation')) {

	function emailCampusUserCreation($campus, $user ) {
		if(empty($user) || empty($campus)){
			return ;
		}
		$to=$user["email"];
		$subject=$campus["campus_name"].", Account Created Successfully";
		$message ="Hi ".$user['display_name']."!
					<br/><br/>
					Your account has been created with the following credentials.
					<br/><br/>
					login: <strong>".$user["email"]."</strong>
					password: <strong>".$user["password"]."</strong>
					<br/><br/>
					Please click <strong><a target='_blank' href='http://".get_app_message("app.domain")."/user/login'>here</a></strong> to login.
					<br/><br/>
					<div style='background: #ffffff;box-shadow: 1px 1px 2px 5px rgba(0, 0, 0, 0.1);position: relative;padding: 15px 15px 10px 20px;'>
						<strong>It is strongly recommended to reset your password after login.</strong>
					</div>
					<br/><br/>
					Regards.
					<br/>
					<strong>
					Admin".
					$campus["campus_name"]
					."</strong>
					
					<br/><br/>
					";
					
					
		$sendername = $_SESSION["sessionUser"]["display_name"] ;	
		$from  = $_SESSION["sessionUser"]["email"] ;	
		$headers = 'To: ' . $user["display_name"] . ' <' . $user["email"] . '>' . "\r\n";
		$headers .= 'From: ' . $sendername . ' <' . $from . '>' . "\r\n";
		
		 
		$message = '<table width="100%"><tr><td><br/>'.$message.'<br/></td></tr></table>';
		 
		 
		$defaultHeader= get_email_header();
		$headers = $defaultHeader . $headers;
		$message = get_email_prefix() .$message. get_email_postfix() ;
		$result = sendEmail($to, $subject, $message, $headers);
		return $result;
			
	}

}

if (!function_exists('emailCampusUserUpdation')) {

	function emailCampusUserUpdation($campus, $user ) {
		 if(empty($user) || empty($campus)){
			return ;
		}
		$to=$user["email"];
		$subject=$campus["campus_name"].", New Rights assigend ";
		$message ="Hi ".$user['display_name']."!
					<br/><br/>
					Your account has been updated with new rights.
					
					<br/><br/>
					Please click <strong><a target='_blank' href='http://".get_app_message("app.domain")."/user/login'>here</a></strong> to verfity new rights.
					<br/><br/>
					<div style='background: #ffffff;box-shadow: 1px 1px 2px 5px rgba(0, 0, 0, 0.1);position: relative;padding: 15px 15px 10px 20px;'>
						<strong>It is strongly recommended to reset your password after login.</strong>
					</div>
					<br/><br/>
					Regards.
					<br/>
					<strong>
					Admin".
					$campus["campus_name"]
					."</strong>
					
					<br/><br/>
					";
					
		$sendername = $_SESSION["sessionUser"]["display_name"] ;	
		$from  = $_SESSION["sessionUser"]["email"] ;				
					
		$headers = 'To: ' . $user["display_name"] . ' <' . $user["email"] . '>' . "\r\n";
		$headers .= 'From: ' . $sendername . ' <' . $from . '>' . "\r\n";
		
		 
		$message = '<table width="100%"><tr><td><br/>'.$message.'<br/></td></tr></table>';
		 
		 
		$defaultHeader= get_email_header();
		$headers = $defaultHeader . $headers;
		$message = get_email_prefix() .$message. get_email_postfix() ;
		$result = sendEmail($to, $subject, $message, $headers);
		return $result;
	}
}


if (!function_exists('get_email_header')) {
	function get_email_header() {
		$header = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		return $header;
	}

}



if (!function_exists('get_email_prefix')) {
	function get_email_prefix() {
		$prefix = '
					
    			';
		 
		return $prefix;
			
	}

}
if (!function_exists('get_email_postfix')) {
	function get_email_postfix() {
		$postfix= '
    			<table width="100%">
					<tr>
						<td  align="center">
							<div style="background: #ffffff;box-shadow: 1px 1px 2px 5px rgba(0, 0, 0, 0.1);position: relative;padding: 15px 15px 10px 20px;">2015 Asaanschool Technologies. All Rights Reserved. Terms &amp; Privacy</div>
						</td>
						<td width="20%" align="right">
							<img src="http://'.get_app_message("app.domain").'/public/images/asaanschool.png" />
						</td>
					</tr>
				</table>
    			';
		return $postfix;
			
	}

}