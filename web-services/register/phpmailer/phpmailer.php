<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'phpmailer/vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	
	$mail = new PHPMailer(true);
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
	$mail->isSMTP();
	$mail->SMTPAuth   = true;
	$mail->Host       = 'sg2plcpnl0029.prod.sin2.secureserver.net';                                   
    $mail->Username   = 'info@matrimonialphpscript.com';                     
    $mail->Password   = 'aaparmar_2908@';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;
	$mail->setFrom('info@matrimonialphpscript.com','Inlogix Infoway');
    $mail->addReplyTo('info@matrimonialphpscript.com', 'Inlogix Infoway');
	$mail->isHTML(true);  
?>