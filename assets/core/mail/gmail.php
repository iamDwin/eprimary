<?php
function send_mail($send_to,$copy,$body,$subj){
$account="godwinabeaku@gmail.com";
$password="tycles95.";
$to = $send_to;
$from="godwinabeaku@gmail.com";
$from_name="ELEARNING ACCOUNT";
$msg= $body; // HTML message
$subject= $subj;
$cc = $copy;
/*End Config*/

include("phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth= true;
$mail->Port = 465; // Or 587
$mail->Username= $account;
$mail->Password= $password;
$mail->SMTPSecure = 'ssl';
$mail->From = $from;
$mail->FromName= $from_name;
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $msg;
$mail->addAddress($to);
$mail->addCC($cc);
if(!$mail->send()){
// echo "Mailer Error: " . $mail->ErrorInfo;
	echo "";
}else{
// echo "E-Mail has been sent";
 echo "";
}

}

?>
