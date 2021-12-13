<?php
	include_once '../databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
	$SQL_STATEMENT_EMAIL = $DatabaseCo->dbLink->query("SELECT * FROM email_setting WHERE email_config_id='1'");
	$row=mysqli_fetch_object($SQL_STATEMENT_EMAIL);
	$host=$row->host;
	$email_from=$row->email;
	$password=$row->email_password;
	$port=$row->port;
	$email_name=$row->email_name;

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'phpmailer/vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	
	$mail = new PHPMailer(true);
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//$mail->SMTPDebug = 2;
	//$mail->IsMail();
	$mail->SMTPDebug = false;
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;
	$mail->Host       = $host;
	$mail->Username   = $email_from;                     
    $mail->Password   = $password;  
    $mail->Port       = $port;
	$mail->setFrom($email_from,$email_name);
    $mail->addReplyTo($email_from,$email_name);                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    
	$mail->isHTML(true);

	//$mail->Host       = 'sg2plcpnl0029.prod.sin2.secureserver.net';
	//$mail->Username   = 'info@matrimonialphpscript.com';                     
    //$mail->Password   = 'aaparmar_2908@';
	//$mail->Port       = 587;
	//$mail->setFrom('info@matrimonialphpscript.com','Inlogix Infoway');
    //$mail->addReplyTo('info@matrimonialphpscript.com', 'Inlogix Infoway');
?>