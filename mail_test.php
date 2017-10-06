<?php

require("PHPMailer-master/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP(); // send via SMTP
$mail->Host = "p3plcpnl0069.prod.phx3.secureserver.net"; // SMTP servers
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->Username = "non-reply@julietalo.com"; // SMTP username
$mail->Password = "MIustakia7"; // SMTP password

$mail->From = "non-reply@julietalo.com";
$mail->FromName = "Name";
$mail->AddAddress("karinag_07@hotmail.com","Name");
$mail->AddReplyTo("non-reply@julietalo.com","Your Name");

$mail->WordWrap = 50; // set word wrap

$mail->IsHTML(true); // send as HTML

$mail->Subject = "Here is the subject";
$mail->Body = "This is the HTML body";
$mail->AltBody = "This is the text-only body";



if(!$mail->Send())
{
echo "Message was not sent";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

echo "Message has been sent";
	
//from non-reply@julietalo.com
// server host p3plcpnl0069.prod.phx3.secureserver.net

//relay-hosting.secureserver.net

?>


