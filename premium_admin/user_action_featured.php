<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$website =  $configObj->getConfigName();
$webfriendlyname =  $configObj->getConfigFname();
$from = $configObj->getConfigFrom();
$logo = $configObj->getConfigLogo();
if(isset($_POST['ac_status']) && $_POST['ac_status']=='Featured')
{
$user_id=str_replace(",","','",$_POST['user_id']);
$DatabaseCo->dbLink->query("update register set fstatus='Featured' where matri_id in ('$user_id')");
$result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Featured Profile'");
$rowcs5 = mysqli_fetch_array($result45);

$resultcc = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id ='".$user_id ."'");
$rowcc = mysqli_fetch_array($resultcc);
$name = $rowcc['firstname'];
$matriid = $rowcc['matri_id'];
$fb = $rowcc['facebook'];
$li= $rowcc['twitter'];
$tw = $rowcc['linkedin'];
$gp = $rowcc['google'];
$contactno = $rowcc['contact_no'];
	
$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
$trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"logo"=>$logo,"facebookurl"=>$fb,"twitterurl"=>$tw,"linkedinurl"=>$li,"googleurl"=>$gp,"matriid"=>$matriid,"myname"=>$name,"contactno"=>$contactno);
$email_template = strtr($email_template, $trans);  
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
$select=$DatabaseCo->dbLink->query("select email,mobile from register where matri_id in ('$user_id')");
while ($row = mysqli_fetch_array($select))
{
$email = $row['email'];
mail($email, $subject, $email_template, $headers);
if($num_sms>0)
{
$text ="Your profile is selected as 'Featured Profile' now. Log on to $webfriendlyname now.";
$message = str_replace(" ","%20",$text);
$mno='91'.$row['mobile'];
$sms_api = htmlspecialchars_decode($sms->basic_url,ENT_QUOTES);
$sms_trans = array("mno" =>$mno,"msg"=>$message);
$final_api = strtr($sms_api, $sms_trans);			
$ret = file($final_api);
}
}
}
if(isset($_POST['ac_status']) && $_POST['ac_status']=='Remove_Featured')
{
$user_id=str_replace(",","','",$_POST['user_id']);
$DatabaseCo->dbLink->query("update register set fstatus='' where matri_id in ('$user_id')");
$result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Featured Profile'");
$rowcs5 = mysqli_fetch_array($result45);

$resultcc = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id ='".$user_id ."'");
$rowcc = mysqli_fetch_array($resultcc);
$name = $rowcc['firstname'];
$matriid = $rowcc['matri_id'];
$fb = $rowcc['facebook'];
$li= $rowcc['twitter'];
$tw = $rowcc['linkedin'];
$gp = $rowcc['google'];
$contactno = $rowcc['contact_no'];
	
$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
$trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"logo"=>$logo,"facebookurl"=>$fb,"twitterurl"=>$tw,"linkedinurl"=>$li,"googleurl"=>$gp,"matriid"=>$matriid,"myname"=>$name,"contactno"=>$contactno);
$email_template = strtr($email_template, $trans);  
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
$select=$DatabaseCo->dbLink->query("select email,mobile from register where matri_id in ('$user_id')");
while ($row = mysqli_fetch_array($select))
{
$email = $row['email'];
mail($email, $subject, $email_template, $headers);
if($num_sms>0)
{
$text ="Your profile is Removed as 'Featured Profile'. Log on to $webfriendlyname now.";
$message = str_replace(" ","%20",$text);
$mno='91'.$row['mobile'];
$sms_api = htmlspecialchars_decode($sms->basic_url,ENT_QUOTES);
$sms_trans = array("mno" =>$mno,"msg"=>$message);
$final_api = strtr($sms_api, $sms_trans);			
$ret = file($final_api);
}
}
}

?>