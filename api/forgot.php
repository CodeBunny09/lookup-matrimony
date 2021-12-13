<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$SQL_STATEMENT_EMAIL = $DatabaseCo->dbLink->query("SELECT * FROM email_setting WHERE email_config_id='1'");
$row=mysqli_fetch_object($SQL_STATEMENT_EMAIL);
$host=$row->host;
$email=$row->email;
$password=$row->email_password;
$port=$row->port;
$email_name=$row->email_name;
// PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/vendor/autoload.php';
$mail = new PHPMailer(true);
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
$mail->isSMTP();
$mail->SMTPAuth   = true;
$mail->Host       = $host;
$mail->Username   = $email;                     
$mail->Password   = $password;  
$mail->Port       = $port;
$mail->setFrom($email,$email_name);
$mail->addReplyTo($email,$email_name);                                 
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
$mail->isHTML(true); 
$count="";
$email = $_POST['email_id'];
if($email==""){
	$err="";
	$count++;
}


if($count==0){
/////////////value fatch
	$email=$_POST['email_id'];
	$selqry = "select * from register where (email='".$email."' or matri_id='".$email."') AND status!='Suspended' ";
	$qryres = $DatabaseCo->dbLink->query($selqry);
	$no=mysqli_num_rows($qryres);
	$ro=mysqli_fetch_array($qryres);
	
	if(mysqli_num_rows($qryres) > 0){
		$username=$ro['username'];
		$matri_id=$ro['matri_id'];
		$s="select * from site_config";
		$q = $DatabaseCo->dbLink->query($s);
		$r=mysqli_fetch_array($q);
		$from=$r['from_email'];
		$webfriendlyname=$r['web_frienly_name'];
		$web=$r['web_name'];
		function RandomPassword() {
			$chars = "abcdefghijkmnopqrstuvwxyz023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;
			while ($i <= 7) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}
			return $pass;
		}
		$pswd = RandomPassword();
		$upasswd = md5($pswd);
		$sql = "update register set password='".$upasswd."' where email='".$email."'";
		$query=$DatabaseCo->dbLink->query($sql);
		$to = "$email";
		$subject = "Your new password";
			$message = "
			<html>
			<head>
			<title><h1>Your new password1</h1></title>
			</head>
			<body>
			<table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
			<tbody>
			<tr>
			<td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
			<table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
			<tbody>
			<tr style='background:#f9f9f9'>
			<td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
			<span tabindex='0' class='aBn' data-term='goog_849968294'>
			<span class='aQJ'></span></span></td>
			<td style='float:left;margin-top:30px;color:#048c2e;font-size:26px;padding-left:15px'>$webfriendlyname</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			<tr>
			<td style='float:left;width:710px;min-height:auto'>
			<h6 style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px'>Hello, $username</h6><p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Message : Your forgot password request has been received in our system.Given below is your profile login details,</p>
			<p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'><b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>Matri ID : $matri_id (or) <a style='text-decoration:none;color:#096b53;outline:none'>$email</a><br>New Password : $pswd </b></p>
			<p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thanks & Regards ,<br>Team At $webfriendlyname</p>
			</td>
			</tr>
			</tbody></table>
			</body>
			</html>
			";
			$mail->Subject = $subject;
			$mail->addAddress($to);
			$mail->Body= $message;
			//$mail->send();
			if($mail->send()){
				$response['status'] = "1";
				$response['message'] = "Forgot Success Mail Send";
				echo json_encode($response);
				exit;
			}else{
				$response['status'] = "0";
				$response['message'] = "Forgot Fail";
				echo json_encode($response);
				exit;
			}		
	
}
else
{
	$response['status'] = "0";
	$response['message'] = "Forgot Fail";
	echo json_encode($response);
}
}
else
{
	$response['status'] = "0";
	$response['message'] = "Enter Email-Id";
	echo json_encode($response);
}
?>