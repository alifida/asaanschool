<?php
# Include the Autoloader (see "Libraries" for install instructions)
/* require 'vendor/autoload.php';
use Mailgun\Mailgun;

# First, instantiate the SDK with your API credentials
$mg = Mailgun::create('f5e5ebdb47202dfba3d332ee311ce5a5-dc5f81da-dddf6c41');

# Now, compose and send your message.
# $mg->messages()->send($domain, $params);
$mg->messages()->send('gmail.com', [
		'from'    => 'asaanschool@gmail.com',
		'to'      => 'alifida.86@gmail.com',
		'subject' => 'Hello Mail gun local',
		'text'    => 'Testing some Mailgun awesomness !'
]); */


 
		 



// Using Awesome https://github.com/PHPMailer/PHPMailer
//erhemidaesvdupfz
//require 'PHPMailerAutoload.php';
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'asaanschool@gmail.com';   // SMTP username
$mail->Password = 'window98';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted
$mail->Port = 587;
$mail->From = 'asaanschool@gmail.com';
$mail->FromName = 'Asaanschool';
$mail->addAddress('alifida.86@gmail.com');                 // Add a recipient

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

$mail->Subject = 'Hello';
$mail->Body    = 'Message from localhost asaanschool.com ';

if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	echo 'Message has been sent';
}
