<?php
session_start();
$email_member = $_SESSION['email_member'];
$company_name = $_SESSION['company_name'];

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '';                 // SMTP username
$mail->Password = '';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('system@trees4trees.org', 'T4T Information System');
if ($_SESSION['level']=='part') {
	//$mail->addAddress('info@trees4trees.org', 'INFO T4T');   // INFO T4T
	//$mail->addAddress('riojericowidyatama@gmail.com');
	 $mail->addAddress('rio.jerico@trees4trees.org');
	//$mail->addAddress('arydwimarta@trees4trees.org');
}elseif ($_SESSION['level']=='admoff') {
	//$mail->addAddress(''.$email_member.'', ''.$company_name.'');   // MEMBER MAIL
	//$mail->addAddress('riojericowidyatama@gmail.com');
	$mail->addAddress('rio.jerico@trees4trees.org');
	//$mail->addAddress('arydwimarta@trees4trees.org');
}elseif ($_SESSION['level']=='fin') {
	//$mail->addAddress(''.$email_member.'', ''.$company_name.'');   // MEMBER MAIL
	//$mail->addAddress('riojericowidyatama@gmail.com');
	$mail->addAddress('rio.jerico@trees4trees.org');
	//$mail->addAddress('arydwimarta@trees4trees.org');
}elseif ($_SESSION['level']=='mkt') {
	//$mail->addAddress('info@trees4trees.org', 'INFO T4T');   // INFO T4T
	//$mail->addAddress('riojericowidyatama@gmail.com');
	$mail->addAddress('rio.jerico@trees4trees.org');
	//$mail->addAddress('arydwimarta@trees4trees.org');
}


$mail->addReplyTo('info@trees4trees.org', 'Information');

// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

 ?>
