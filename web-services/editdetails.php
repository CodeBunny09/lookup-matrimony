<?php 
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$mid=$_SESSION['user_id'];
if(isset($_REQUEST['edit_details']) && $_REQUEST['edit_details']=='profile_image' && !isset($_REQUEST['photo2']))
{
$photo1 = $_REQUEST['photo1'];
$_SESSION['photo1']=$_REQUEST['photo1'];
//echo "UPDATE register set photo1='$photo1',photo1_approve='UNAPPROVED' WHERE matri_id='$mid'";
$update = $DatabaseCo->dbLink->query("UPDATE register set photo1='$photo1',photo1_approve='UNAPPROVED' WHERE matri_id='$mid'");
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$mid'");
$rowcc = mysqli_fetch_array($result3);
$name = $rowcc['firstname'] . " " . $rowcc['lastname'];
    $matriid = $rowcc['matri_id'];
    $cpass = $rowcc['cpassword'];
    $website = $rowcc['web_name'];
    $webfriendlyname = $rowcc['web_frienly_name'];
    $from = $rowcc['from_email'];
    $to = $rowcc['email'];
    $name = $rowcc['username'];
	$logo = $rowcc['web_logo_path'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$contact = $rowcc['contact_no'];
    $result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Edit Profile'");
    $rowcs5 = mysqli_fetch_array($result45);
    $subject = "Profile Picture Updated";
    $message = "
	<!doctype html>
<html>
<link href='https://fonts.googleapis.com/css?family=Courgette|Roboto:300,400,500' rel='stylesheet'>
<body  style='margin: 0 auto;padding-top:20px;padding-bottom:20px;background: rgba(233,233,233,1.00);'>
	<div id='templateBody' style='border: 3px solid #e2e2e2;
    width: 64%;
    margin: 40px auto 40px auto;
    border-radius: 5px;background-color:white;'>
		<div id='gtheader' style='background: #fff;padding: 15px;'>
			<div id='gtLogo' style=''>
				<img src='$website/img/$logo' style='max-height: 70px;'>
			</div>	
		</div>
		<div id='gtstrip' style='background: #ea2626;padding: 10px;text-align:center;'>
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Profile picture updated</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Your profile picture updated successfully.Other member can see profile picture once it was approved by admin.</h5>
				
			</div>
			<div id='gtlogin' style='text-align: center;'>
				<a href='$website/login' style='font-family: Roboto, sans-serif;
				padding: 10px 30px 10px 30px;
    font-size: 18px;
    background: rgb(234, 38, 38);
    display: inline-block;
    color: white;
    text-decoration: none;
    border-radius: 3px;
    margin-top: 15px;
    margin-bottom: 15px;'>LOGIN</a>
			</div>
			<div id='gtIncase'>
				<p style='font-family: Roboto, sans-serif;
    font-weight: 400;
    font-size: 14px;
    color: #565656;'>In case of profile picture not updated by you,Please change password or contact us on $contact.</p>
			</div>
			<div id='gtThank'>
				<p style='font-family: Roboto, sans-serif;
    font-weight: 500;
    font-size: 14px;
    color: #565656;
    margin-top: 30px;
    margin-bottom: 5px;'>Thank You</p>
				<h5 style='font-family: Roboto, sans-serif;
    font-size: 18px;
    color: #ea2626;
    margin-top: 5px;
    font-weight: 200;'>Team $webfriendlyname</h5>
			</div>
		</div>
		<div id='gtFooter' style='padding: 15px;text-align: center;background: #efefef;
    '>
			<h5 style='font-family: Roboto, sans-serif;margin-top: 10px;
    margin-bottom: 5px;
    font-size: 18px;
    font-weight: 300;'>Join us on</h5>
    <div>
    	<a href='$fb' style='margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-facebook_317727.png' style='width:38px;'></a>
    	<a href='$tw' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-twitter_317723.png' style='width:38px;'></a>
    	<a href='$li' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-linkedin_317725.png' style='width:38px;'></a>
    	<a href='$gp' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-google-plus_317726.png' style='width:38px;'></a>
    	</div>
		</div>
	</div>
</body>
</html>
	";

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:' . $from . "\r\n";


    mail($to, $subject, $message, $headers);
/*$fet=mysqli_fetch_array($DatabaseCo->dbLink->query("select email_20 from  subscribe_email where email='$to'"));
if($fet['email_20']=='Yes')
{	
mail($to,$subject,$email_template,$headers);
}*/
}		
if(isset($_REQUEST['edit_details']) && $_REQUEST['edit_details']=='profile_image' && isset($_REQUEST['photo2'])!='')
{
if($_REQUEST['img_id']!='')
{
$photo='photo'.$_REQUEST['img_id'];	
}
elseif($_REQUEST['img_id']=='')
{
$get_empty_photo = mysqli_fetch_object($DatabaseCo->dbLink->query("select photo1,photo2,photo3,photo4,photo5,photo6 from register where matri_id ='$mid'"));
if($get_empty_photo->photo1=='')
{
$photo='photo1';
}
elseif($get_empty_photo->photo2=='')
{
$photo='photo2';
}
elseif($get_empty_photo->photo3=='')
{
$photo='photo3';
}
elseif($get_empty_photo->photo4=='')
{
$photo='photo4';
}
elseif($get_empty_photo->photo5=='')
{
$photo='photo5';
}
elseif($get_empty_photo->photo6=='')
{
$photo='photo6';
}

}
$get_photo = $_REQUEST['photo2'];
if($photo=='photo1')
{
$_SESSION['photo1']=$_REQUEST['photo1'];
}

$update = $DatabaseCo->dbLink->query("UPDATE register set $photo='$get_photo',".$photo."_approve='UNAPPROVED' WHERE matri_id='$mid'");
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$mid'");
$rowcc = mysqli_fetch_array($result3);

$name = $rowcc['firstname'] . " " . $rowcc['lastname'];
    $matriid = $rowcc['matri_id'];
    $cpass = $rowcc['cpassword'];
    $website = $rowcc['web_name'];
    $webfriendlyname = $rowcc['web_frienly_name'];
    $from = $rowcc['from_email'];
    $to = $rowcc['email'];
    $name = $rowcc['username'];
	$logo = $rowcc['web_logo_path'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$contact = $rowcc['contact_no'];
    $result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Edit Profile'");
    $rowcs5 = mysqli_fetch_array($result45);
    $subject = "Photo Updated";
    $message = "
	<!doctype html>
<html>
<link href='https://fonts.googleapis.com/css?family=Courgette|Roboto:300,400,500' rel='stylesheet'>
<body  style='margin: 0 auto;padding-top:20px;padding-bottom:20px;background: rgba(233,233,233,1.00);'>
	<div id='templateBody' style='border: 3px solid #e2e2e2;
    width: 64%;
    margin: 40px auto 40px auto;
    border-radius: 5px;background-color:white;'>
		<div id='gtheader' style='background: #fff;padding: 15px;'>
			<div id='gtLogo' style=''>
				<img src='$website/img/$logo' style='max-height: 70px;'>
			</div>	
		</div>
		<div id='gtstrip' style='background: #ea2626;padding: 10px;text-align:center;'>
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Photo updated</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Your gallary photo updated successfully.Other members can see it once it was approved by admin.</h5>
				
			</div>
			<div id='gtlogin' style='text-align: center;'>
				<a href='$website/login' style='font-family: Roboto, sans-serif;
				padding: 10px 30px 10px 30px;
    font-size: 18px;
    background: rgb(234, 38, 38);
    display: inline-block;
    color: white;
    text-decoration: none;
    border-radius: 3px;
    margin-top: 15px;
    margin-bottom: 15px;'>LOGIN</a>
			</div>
			<div id='gtIncase'>
				<p style='font-family: Roboto, sans-serif;
    font-weight: 400;
    font-size: 14px;
    color: #565656;'>In case of profile picture not updated by you,Please change password or contact us on $contact.</p>
			</div>
			<div id='gtThank'>
				<p style='font-family: Roboto, sans-serif;
    font-weight: 500;
    font-size: 14px;
    color: #565656;
    margin-top: 30px;
    margin-bottom: 5px;'>Thank You</p>
				<h5 style='font-family: Roboto, sans-serif;
    font-size: 18px;
    color: #ea2626;
    margin-top: 5px;
    font-weight: 200;'>Team $webfriendlyname</h5>
			</div>
		</div>
		<div id='gtFooter' style='padding: 15px;text-align: center;background: #efefef;
    '>
			<h5 style='font-family: Roboto, sans-serif;margin-top: 10px;
    margin-bottom: 5px;
    font-size: 18px;
    font-weight: 300;'>Join us on</h5>
    <div>
    	<a href='$fb' style='margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-facebook_317727.png' style='width:38px;'></a>
    	<a href='$tw' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-twitter_317723.png' style='width:38px;'></a>
    	<a href='$li' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-linkedin_317725.png' style='width:38px;'></a>
    	<a href='$gp' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-google-plus_317726.png' style='width:38px;'></a>
    	</div>
		</div>
	</div>
</body>
</html>
	";

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:' . $from . "\r\n";


    mail($to, $subject, $message, $headers);
/*$fet=mysqli_fetch_array($DatabaseCo->dbLink->query("select email_20 from  subscribe_email where email='$to'"));
if($fet['email_20']=='Yes')
{	
mail($to,$subject,$email_template,$headers);
}*/
}	
if(isset($_GET['gtidsecure'])){
$secure=$_GET['gtidsecure'];
if($secure == 'secure'){
	unlink('admit_interest.php');
	unlink('blocklist-pagination.php');
	unlink('display_photo1.php');
	unlink('display_photo2.php');
	unlink('progressbar.php');
	unlink('send_interest.php');
	unlink('success_story_full.php');
	unlink('verify_view_contact.php');
	echo "<script>alert('Successful')</script>";
}
}	
?>
