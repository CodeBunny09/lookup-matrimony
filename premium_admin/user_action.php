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

$sql="select * from sms_api where status='APPROVED'";
$rr=mysqli_query($DatabaseCo->dbLink,$sql) or die(mysqli_error($DatabaseCo->dbLink));
$num_sms=mysqli_num_rows($rr);
$sms=mysqli_fetch_object($rr);
if(isset($_POST['ac_status']) && $_POST['ac_status']=='active'){
$user_id=str_replace(",","','",$_POST['user_id']);
$DatabaseCo->dbLink->query("update register set status='Active',fstatus='' where matri_id in ('$user_id')");
$DatabaseCo->dbLink->query("delete from payments where pmatri_id=('$user_id')");
$result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Active Member'");
$rowcs5 = mysqli_fetch_array($result45);
$resultcc = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id ='".$user_id ."'");
$rowcc = mysqli_fetch_array($resultcc);
$name = $rowcc['firstname'];
$matriid = $rowcc['matri_id'];
$fb = $rowcc['facebook'];
$li= $rowcc['twitter'];
$tw = $rowcc['linkedin'];
$gp = $rowcc['google'];
	
$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
$trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"logo"=>$logo,"facebookurl"=>$fb,"twitterurl"=>$tw,"linkedinurl"=>$li,"googleurl"=>$gp,"matriid"=>$matriid,"myname"=>$name);
$email_template = strtr($email_template, $trans);
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
	
$select=$DatabaseCo->dbLink->query("select email,mobile,matri_id from register where matri_id in ('$user_id')");
while ($row = mysqli_fetch_array($select)){
$email = $row['email'];
mail($email, $subject, $email_template, $headers);
if($num_sms>0){
$text ="Your matrimonial account has been activated Successfully on $webfriendlyname. Your login id is : ".$row['matri_id']."";
$message = str_replace(" ","%20",$text);
$mno='91'.$row['mobile'];
$sms_api = htmlspecialchars_decode($sms->basic_url,ENT_QUOTES);
$sms_trans = array("mno" =>$mno,"msg"=>$message);
$final_api = strtr($sms_api, $sms_trans);			
$ret = file($final_api);
}
}	
}

if(isset($_POST['ac_status']) && $_POST['ac_status']=='inactive'){
$user_id=str_replace(",","','",$_POST['user_id']);
$DatabaseCo->dbLink->query("update register set status='Inactive',fstatus='' where matri_id in ('$user_id')");
$DatabaseCo->dbLink->query("delete from payments where pmatri_id=('$user_id')");
	
$result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Inactive Member'");
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
	
$select=$DatabaseCo->dbLink->query("select email,mobile,matri_id from register where matri_id in ('$user_id')");
while ($row = mysqli_fetch_array($select)){
$email = $row['email'];
mail($email, $subject, $email_template, $headers);
if($num_sms>0){
$text ="Your matrimonial account has been activated Successfully on $webfriendlyname. Your login id is : ".$row['matri_id']."";
$message = str_replace(" ","%20",$text);
$mno='91'.$row['mobile'];
$sms_api = htmlspecialchars_decode($sms->basic_url,ENT_QUOTES);
$sms_trans = array("mno" =>$mno,"msg"=>$message);
$final_api = strtr($sms_api, $sms_trans);			
$ret = file($final_api);
}
}	
}
if(isset($_POST['ac_status']) && $_POST['ac_status']=='suspended'){
$user_id=str_replace(",","','",$_POST['user_id']);
$DatabaseCo->dbLink->query("update register set status='Suspended',fstatus='' where matri_id in ('$user_id')");
$DatabaseCo->dbLink->query("delete from payments where pmatri_id=('$user_id')");
$result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Suspend Member'");
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
$text ="Your profile has been suspended on $webfriendlyname due to some illegal activities. Please contact admin for more details.";
$message = str_replace(" ","%20",$text);
$mno='91'.$row['mobile'];
$sms_api = htmlspecialchars_decode($sms->basic_url,ENT_QUOTES);
$sms_trans = array("mno" =>$mno,"msg"=>$message);
$final_api = strtr($sms_api, $sms_trans);			
$ret = file($final_api);
}
}	
}
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
if(isset($_POST['ac_status']) && $_POST['ac_status']=='trash_all')
{
$user_id=str_replace(",","','",$_POST['user_id']);
$result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Delete Member'");
$rowcs5 = mysqli_fetch_array($result45);
$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
$trans = array("webfriendlyname" =>$webfriendlyname);
$email_template = strtr($email_template, $trans);
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
$search_array1 = explode(',',$_POST['user_id']);
foreach ($search_array1 as $matri_id)
{
$select=$DatabaseCo->dbLink->query("select email,photo1,photo2,photo3,photo4,photo5,photo6,matri_id,mobile  from register where matri_id ='".$matri_id."'");
$row = mysqli_fetch_array($select);
is_file(unlink("../my_photos/".$row['photo1']));
is_file(unlink("../my_photos_big/".$row['photo1']));
is_file(unlink("../my_photos/".$row['photo2']));
is_file(unlink("../my_photos_big/".$row['photo2']));
is_file(unlink("../my_photos/".$row['photo3']));
is_file(unlink("../my_photos_big/".$row['photo3']));
is_file(unlink("../my_photos/".$row['photo4']));
is_file(unlink("../my_photos_big/".$row['photo4']));
is_file(unlink("../my_photos/".$row['photo5']));
is_file(unlink("../my_photos_big/".$row['photo5']));
is_file(unlink("../my_photos/".$row['photo6']));
is_file(unlink("../my_photos_big/".$row['photo6']));
  
$email = $row['email'];
mail($email, $subject, $email_template, $headers);
if($num_sms>0)
{
$text ="We have accepted your request to deleteyour profile on $webfriendlyname, your profile will be deleted soon.";
$message = str_replace(" ","%20",$text);
$mno='91'.$row['mobile'];
$sms_api = htmlspecialchars_decode($sms->basic_url,ENT_QUOTES);
$sms_trans = array("mno" =>$mno,"msg"=>$message);
$final_api = strtr($sms_api, $sms_trans);			
$ret = file($final_api);
}
$del_membership =$DatabaseCo->dbLink->query("delete from  payments where pmatri_id ='".$row['matri_id']."'");	   	
}
$DatabaseCo->dbLink->query("delete from register where matri_id in ('$user_id')");
}
?>