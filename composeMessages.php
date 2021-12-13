<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
include_once 'auth.php';
$mid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
if (isset($_GET['user_id'])) {
	$get_user_id = mysqli_real_escape_string($DatabaseCo->dbLink, $_GET['user_id']);
	$get_arr_username_email = $DatabaseCo->dbLink->query("select username,email,matri_id from register where status!='Suspended' and status!='Inactive' and matri_id='" . $get_user_id . "'");
} else {
	$get_arr_username_email = $DatabaseCo->dbLink->query("select username,email,matri_id from register where status!='Suspended' and status!='Inactive' and matri_id!='" . $_SESSION['user_id'] . "' and gender!='" . $_SESSION['gender123'] . "'");
}
if (isset($_POST['to_email'])) {
	$select = "select * from payment_view where pmatri_id='$mid'";
	$exe = $DatabaseCo->dbLink->query($select) or die(mysqli_error($DatabaseCo->dbLink));
	$fetch = mysqli_fetch_array($exe);
	$total_sms = $fetch['p_sms'];
	$used_sms = $fetch['r_sms'];
	$total_msg = $fetch['p_msg'];
	$used_msg = $fetch['r_msg'];
	$exp_date = $fetch['exp_date'];
	$today = date('Y-m-d');
	
	if (isset($_POST['sms_status']) && $_POST['sms_status'] == 'no') {
		if ($total_msg != $used_msg && $exp_date > $today) {
			foreach ($_POST['to_email'] as $key => $val) {
				$from_id = $_SESSION['user_id'];
				$val = mysqli_real_escape_string($DatabaseCo->dbLink, $val);
				$get_to_id = mysqli_fetch_object($DatabaseCo->dbLink->query("select matri_id from register where email='" . $val . "'"));
				$to_id = $get_to_id->matri_id;
				$sel = $DatabaseCo->dbLink->query("select * from  block_profile where block_by='$to_id' and block_to='$from_id'");
				$num = mysqli_num_rows($sel);
				$sel1 = $DatabaseCo->dbLink->query("select * from  block_profile where block_to='$to_id' and block_by='$from_id'");
				$num1 = mysqli_num_rows($sel1);
				if (isset($num) && $num > 0) {
					echo "<script>alert('" . $to_id . " has blocked you. You can\'t send him messages anymore...');</script>";
				} elseif(isset($num1) && $num1 > 0){
					echo "<script>alert('" . $from_id . " been blocked by you . Please unblock to send message...');</script>";
				} else{
					$subject = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['subject']);
					$msg_content = mysqli_real_escape_string($DatabaseCo->dbLink, htmlspecialchars($_POST['msg_content'], ENT_QUOTES));
					$status = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['msg_status']);
					$DatabaseCo->dbLink->query("insert into messages(mes_id,to_id,from_id,subject,message,msg_status,msg_important_status,sent_date,trash_receiver,trash_sender) values('','$to_id','$from_id','$subject','$msg_content','$status','No',NOW(),'No','No')");
					$DatabaseCo->dbLink->query("INSERT INTO reminder (rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('','$from_id','$to_id','msg','Send','Yes','Yes',NOW())");
					$sql_noti = "INSERT INTO notification (sender_id,receiver_id,notification,notification_type,seen,date) VALUES ('$from_id','$to_id','New Message Received','Message','No',now())";
					$DatabaseCo->dbLink->query($sql_noti);
					if ($status == 'sent') {
						$sel = $DatabaseCo->dbLink->query("SELECT * FROM payments where pmatri_id='$mid'");
						$fet = mysqli_fetch_array($sel);
						$tot_sms = $fet['p_msg'];
						$use_sms = $fet['r_msg'];
						$use_sms = $use_sms + 1;
						if ($tot_sms >= $use_sms) {
							$update = "UPDATE payments SET r_msg='$use_sms' WHERE pmatri_id='$mid' ";
							$d = $DatabaseCo->dbLink->query($update);
						}
					}
					$result1 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$mid'");
$rowcc1 = mysqli_fetch_array($result1);
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$to_id'");
$rowcc = mysqli_fetch_array($result3);
$name = $rowcc1['firstname'] . " " . $rowcc['lastname'];
$matriid = $rowcc['matri_id'];
$cpass = $rowcc['cpassword'];
$website = $rowcc['web_name'];
$webfriendlyname = $rowcc['web_frienly_name'];
$from = $rowcc['from_email'];
$to = $rowcc['email'];

$name = $rowcc1['username'];
	$logo = $rowcc['web_logo_path'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$contact = $rowcc['contact_no'];
$subject = "New Message received";
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
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>New message received</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
			
			<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'> New message received from $name</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'> Name : $name</h5>
				
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>User Id: $matriid</h5>
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
    color: #565656;'>If any query please contact us on $contact.</p>
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
				}
			}
			if ($status == 'sent') {
				echo "<script>alert('Your message has been sent Successfully.');</script>";
				echo "<script>window.location='sentMessages';</script>";
			} else if ($status == 'trash') {
				echo "<script>alert('Your message has been trash Successfully.');</script>";
				echo "<script>window.location='trashMessages';</script>";
			}
		} else {
	?>
	<!--Get message balance modal-->
	<div class="modal fade-in in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="close1();">&times;
			</button>
			<h4 class="modal-title text-center" id="myModalLabel" style="color:red;">Upgrade Your Membership
			</h4>
		  </div>
		  <div class="modal-body text-center">
		  <form name="MatriForm" id="MatriForm" class="form-horizontal" action="premium_member" method="post">
			<div class="form-group">
			  <div class="col-sm-16">
				<h5>&nbsp;&nbsp;Please get the send message balance by upgrading your membership.
				</h5>
			  </div>
			</div>
			<div class="form-group">
			  <div class="col-sm-offset-5 col-sm-6 text-center">
				<button class="btn gt-btn-orange btn-block gt-cursor" formaction="membershipplans">Upgrade Now
				</button>
			  </div>
			</div>
		  </form>
		  <div class="clearfix"></div>
		  </div>
		</div>
	  </div>
	</div>
	<!--Get message balance modal End-->	
<?php } } else {
if ($total_sms - $used_sms > 0 && $exp_date > $today) {
foreach ($_POST['to_email'] as $key => $val) {
$from_id = $_SESSION['user_id'];
$val = mysqli_real_escape_string($DatabaseCo->dbLink, $val);
$get_to_id = mysqli_fetch_object($DatabaseCo->dbLink->query("select matri_id from register where email='" . $val . "'"));
$to_id = $get_to_id->matri_id;
$sel = $DatabaseCo->dbLink->query("select * from  block_profile where block_by='$to_id' and block_to='$from_id'");
$num = mysqli_num_rows($sel);
if (isset($num) && $num > 0) {
echo "<script>alert('" . $to_id . " has blocked you. You can\'t send him messages anymore...');</script>";
} else {
$subject = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['subject']);
$msg_content = mysqli_real_escape_string($DatabaseCo->dbLink, htmlspecialchars($_POST['msg_content'], ENT_QUOTES));
$status = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['msg_status']);
if (strlen($msg_content) < 160) {
$DatabaseCo->dbLink->query("insert into messages(mes_id,to_id,from_id,subject,message,msg_status,msg_important_status,sent_date,trash_receiver,trash_sender) values('','$to_id','$from_id','$subject','$msg_content','$status','No',NOW(),'No','No')");
$DatabaseCo->dbLink->query("INSERT INTO reminder (rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('','$from_id','$to_id','msg','Send','Yes','Yes',NOW())");
if ($status == 'sent') {
$sel = $DatabaseCo->dbLink->query("SELECT * FROM payments where pmatri_id='$mid'");
$fet = mysqli_fetch_array($sel);
$tot_sms = $fet['p_sms'];
$use_sms = $fet['r_sms'];
$use_sms = $use_sms + 1;
if ($tot_sms >= $use_sms) {
$update = "UPDATE payments SET r_sms='$use_sms' WHERE pmatri_id='$mid' ";
$d = $DatabaseCo->dbLink->query($update);
}
}
} else {
echo "<script>alert('Message content should be support upto 160 character.');</script>";
echo "<script>window.location='composeMessages';</script>";
}
$result1 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$mid'");
$rowcc1 = mysqli_fetch_array($result1);
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$to_id'");
$rowcc = mysqli_fetch_array($result3);
$name = $rowcc1['firstname'] . " " . $rowcc['lastname'];
$matriid = $rowcc['matri_id'];
$cpass = $rowcc['cpassword'];
$website = $rowcc['web_name'];
$webfriendlyname = $rowcc['web_frienly_name'];
$from = $rowcc['from_email'];
$to = $rowcc['email'];

$name = $rowcc1['username'];
	$logo = $rowcc['web_logo_path'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$contact = $rowcc['contact_no'];
$subject = "New Message received";
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
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>New message received</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
			
			<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'> New message received from $name</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'> Name : $name</h5>
				
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>User Id: $matriid</h5>
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
    color: #565656;'>If any query please contact us on $contact.</p>
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
}
}
if ($status == 'sent') {
echo "<script>alert('Your message has been sent Successfully.');</script>";
echo "<script>window.location='sentMessages';</script>";
} else if ($status == 'trash') {
echo "<script>alert('Your message has been trash Successfully.');</script>";
echo "<script>window.location='trashMessages';</script>";
}
} else {
?>
<div class="modal fade-in in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="close1();">&times;
        </button>
        <h4 class="modal-title" id="myModalLabel" style="color:red;">Upgrade Your Membership
        </h4>
      </div>
      <form name="MatriForm" id="MatriForm" class="form-horizontal" action="premium_member" method="post">
        <div class="form-group">
          <div class="col-sm-12">
            <h5>&nbsp;&nbsp;Please get the send sms balance by upgrading your membership.
            </h5>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-6 " style="text-align:center;">
            <button class="btn gt-btn-orange btn-block gt-cursor" formaction="membershipplans">Upgrade Now
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>	
<?php
}
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
    <title>
      <?php echo $configObj->getConfigFname(); ?>
    </title>
    <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
    <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
    <!-- WEB SITE TITLE DESCRIPTION END--> 
    <!-- WEB SITE FAVICON--> 
    <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
    <!-- WEB SITE FAVICON END--> 
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom-responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/developer.css" rel="stylesheet">
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->
    <!--GOOGLE FONTS-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
     <!--GOOGLE FONTS END-->
   
     <!---- CHOSEN CSS----->
    <link rel="stylesheet" href="css/prism.css">
    <link rel="stylesheet" href="css/chosen.css">
    <!---- CHOSEN CSS END----->
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
    <script>
      function close1()
      {
        $('#myModal1').hide();
      }
    </script>
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
      <?php include "parts/header.php"; ?>
      <?php include "parts/menu-aft-login.php"; ?>
      <div class="container gt-margin-top-20">
        <div class="row">
          <div class="col-xxl-13 col-xxl-offset-3 col-xl-13 col-xl-offset-3">
            <h2 class="gt-margin-top-0 gt-text-orange">
              <span class="gt-font-weight-300">Message
              </span> - Compose
            </h2>
            <p>Sent message to members from here.
            </p>
          </div>
          <?php include('parts/msg_left_menu.php'); ?>
          <div class="col-xxl-13 col-xl-12 gt-msg-board">
            <form id="mes_content_form" name="mes_content_form" method="post" action="">
              <div class="col-xxl-16 col-xl-16 gt-msg-top-strip gt-margin-top-10">
                <div class="form-group">
                  <label>
                    <h4>
                      To ,
                    </h4>
                  </label>
                  <select data-placeholder="Select Matri id to send message" class="chosen-select gt-form-control flat" multiple tabindex="4" name="to_email[]" data-validetta="required" id="to_email">
                    <option value="">
                    </option>
                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($get_arr_username_email)) { ?>
                    <option value="<?php echo $DatabaseCo->dbRow->email; ?>">
                      <?php echo $DatabaseCo->dbRow->matri_id; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" name="subject" class="gt-form-control flat" placeholder="Enter your message subject" data-validetta="required">
                </div>
                <div class="form-group">
                  <div id="alerts">
                  </div>
                  <div class="btn-toolbar hidden-xs hidden-sm hidden-md" data-role="editor-toolbar" data-target="#editor">
                    <div class="row">
                      <div class="col-xxl-11 col-xl-12 col-lg-16">
                        <div class="btn-group" style="margin-left:5px;">
                          <a class="btn dropdown-toggle btn-default" data-toggle="dropdown" title="Font">
                            <i class="icon-font">
                            </i>
                            <b class="caret">
                            </b>
                          </a>
                          <ul class="dropdown-menu">
                          </ul>
                        </div>
                        <div class="btn-group">
                          <a class="btn dropdown-toggle btn-default" data-toggle="dropdown" title="Font Size">
                            <i class="icon-text-height">
                            </i>&nbsp;
                            <b class="caret">
                            </b>
                          </a>
                          <ul class="dropdown-menu">
                            <li>
                              <a data-edit="fontSize 5">
                                <font size="5">Huge
                                </font>
                              </a>
                            </li>
                            <li>
                              <a data-edit="fontSize 3">
                                <font size="3">Normal
                                </font>
                              </a>
                            </li>
                            <li>
                              <a data-edit="fontSize 1">
                                <font size="1">Small
                                </font>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="btn-group">
                          <a class="btn btn-default" data-edit="bold" title="Bold (Ctrl/Cmd+B)">
                            <i class="icon-bold">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="italic" title="Italic (Ctrl/Cmd+I)">
                            <i class="icon-italic">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="strikethrough" title="Strikethrough">
                            <i class="icon-strikethrough">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="underline" title="Underline (Ctrl/Cmd+U)">
                            <i class="icon-underline">
                            </i>
                          </a>
                        </div>
                        <div class="btn-group">
                          <a class="btn btn-default" data-edit="insertunorderedlist" title="Bullet list">
                            <i class="icon-list-ul">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="insertorderedlist" title="Number list">
                            <i class="icon-list-ol">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="outdent" title="Reduce indent (Shift+Tab)">
                            <i class="icon-indent-left">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="indent" title="Indent (Tab)">
                            <i class="icon-indent-right">
                            </i>
                          </a>
                        </div>
                        <div class="btn-group">
                          <a class="btn btn-default" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)">
                            <i class="icon-align-left">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)">
                            <i class="icon-align-center">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)">
                            <i class="icon-align-right">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)">
                            <i class="icon-align-justify">
                            </i>
                          </a>
                        </div>
                      </div>
                      <div class="col-xxl-5 col-xl-4 col-lg-16">
                        <div class="btn-group">
                          <a class="btn btn-default" title="Insert picture (or just drag & drop)" id="pictureBtn">
                            <i class="icon-picture">
                            </i>
                          </a>
                          <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                          <a class="btn btn-default" data-edit="undo" title="Undo (Ctrl/Cmd+Z)">
                            <i class="icon-undo">
                            </i>
                          </a>
                          <a class="btn btn-default" data-edit="redo" title="Redo (Ctrl/Cmd+Y)">
                            <i class="icon-repeat">
                            </i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="editor" class="gt-form-control gt-margin-top-15" style="min-height:200px; width:100%;">
                    Go ahead&hellip;
                  </div>
                  <input type="hidden" id="msg_content" name="msg_content" value="" data-validetta="required"/>
                  <input type="hidden" id="msg_staus" name="msg_status" value="">
                  <input type="hidden" id="sms_staus" name="sms_status" value="">
                </div>
              </div>
            </form>
            <div class="col-xxl-16 col-xl-16 gt-msg-top-strip gt-margin-top-15">
              <div class="row">
                <div class="col-xxl-2 pull-right">
                  <a class="btn btn-default btn-block gt-cursor" title="Trash" id="trash_msg">
                    <i class="fa fa-trash">
                    </i>
                    <span class="gt-margin-left-10">Delete
                    </span>
                  </a>
                </div>
                <div class="col-xxl-2 gt-margin-bottom-5 pull-right">
                  <a class="btn gt-btn-orange btn-block gt-cursor" title="Send Message" id="send_msg">
                    <i class="fa fa-reply">
                    </i>
                    <span class="gt-margin-left-10">Send
                    </span>
                  </a>
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
    <script src="js/green.js">
    </script>
    <script src="js/jquery.validate.js">
    </script>
    <script>
      $(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
      }
                       );
    </script>
    
    <script>
      $('[data-toggle="popover"]').popover({
        trigger: 'click',
        'placement': 'top'
      }
                                          );
    </script>
    
    <script>
      (function($) {
        var $window = $(window),
            $html = $('.mobile-collapse');
        $window.width(function width() {
          if ($window.width() > 991) {
            return $html.addClass('in');
          }
          $html.removeClass('in');
        }
                     );
      }
      )(jQuery);
    </script>
    <script src="js/chosen.jquery.js" type="text/javascript">
    </script>
    <script src="js/prism.js" type="text/javascript" charset="utf-8">
    </script>
    <script type="text/javascript">
      var config = {
        '.chosen-select': {
        }
        ,
        '.chosen-select-deselect': {
          allow_single_deselect: true}
        ,
        '.chosen-select-no-single': {
          disable_search_threshold: 10}
        ,
        '.chosen-select-no-results': {
          no_results_text: 'Oops, nothing found!'}
        ,
        '.chosen-select-width': {
          width: "100%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
    </script>
    <script src="js/bootstrap-wysiwyg.js">
    </script>
    <script>
      $(function() {
        function initToolbarBootstrapBindings() {
          var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                       'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                       'Times New Roman', 'Verdana'],
              fontTarget = $('[title=Font]').siblings('.dropdown-menu');
          $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
          }
                );
          $('a[title]').tooltip({
            container: 'body'}
                               );
          $('.dropdown-menu input').click(function() {
            return false;
          }
                                         )
            .change(function() {
            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
          }
                   )
            .keydown('esc', function() {
            this.value = '';
            $(this).change();
          }
                    );
          $('[data-role=magic-overlay]').each(function() {
            var overlay = $(this), target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
          }
                                             );
          if ("onwebkitspeechchange"  in document.createElement("input")) {
            var editorOffset = $('#editor').offset();
            $('#voiceBtn').css('position', 'absolute').offset({
              top: editorOffset.top, left: editorOffset.left + $('#editor').innerWidth() - 35}
                                                             );
          }
          else {
            $('#voiceBtn').hide();
          }
        }
        ;
        function showErrorAlert(reason, detail) {
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          }
          else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }
        ;
        initToolbarBootstrapBindings();
        $('#editor').wysiwyg({
          fileUploadError: showErrorAlert}
                            );
        window.prettyPrint && prettyPrint();
      }
       );
    </script>
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  

<script type="text/javascript" src="js/validetta.js">
</script>
<script type="text/javascript">
  $(document).ready(function() {
    //var cmscontent=$("#cms_content").val();                    
    //	 $("div.Editor-editor").append(cmscontent);
    $("#editor").blur(function() {
      var cms_cont = $("#editor").html();
      $("#msg_content").val(cms_cont);
    }
                     );
    $('#send_msg').click(function() {
      $('#sms_staus').val('no');
      $('#msg_staus').val('sent');
      $('#mes_content_form').submit();
    }
                        );
    $('#send_sms').click(function() {
      $('#sms_staus').val('Yes');
      $('#msg_staus').val('sent');
      $('#mes_content_form').submit();
    }
                        );
    $('#trash_msg').click(function() {
      $('#msg_staus').val('trash');
      $('#mes_content_form').submit();
    }
                         );
  }
                   );
</script>
<script type="text/javascript">
  $(function() {
    $('#mes_content_form').validetta({
      errorClose: false,
      custom: {
        regname: {
          pattern: /^[\+][0-9]+?$|^[0-9]+?$/,
          errorMessage: 'Custom Reg Error Message !'
        }
        ,
        // you can add more
        example: {
          pattern: /^[\+][0-9]+?$|^[0-9]+?$/,
          errorMessage: 'Lan mal !'
        }
      }
      ,
      realTime: true
    }
                                    );
  }
   );
</script>
<script type="text/javascript">
  <?php if (isset($_GET['user_id']) && !isset($_GET['frwd'])) {
    ?>
      $.ajax({
      url: 'to_msg_compose',
      type: 'POST',
      data: 'msg_status=sent_msg&user_id=<?php echo mysqli_real_escape_string($DatabaseCo->dbLink, $_GET['user_id']); ?>',
      success: function(data) {
      $('#to_email').find('option').remove().end().append(data);
      $('#to_email').trigger("chosen:updated");
      var config = {
      '.chosen-select': {
    }
             ,
             '.chosen-select-deselect': {
             allow_single_deselect: true}
             ,
             '.chosen-select-no-single': {
             disable_search_threshold: 10}
             ,
             '.chosen-select-no-results': {
             no_results_text: 'Oops, nothing found!'}
             ,
             '.chosen-select-width': {
             width: "95%"}
             }
             for (var selector in config)
    {
      $(selector).chosen(config[selector]);
    }
  }
  ,
    error: function() {
      //called when there is an error
      //console.log(e.message);
    }
  }
  );
  <?php }
  elseif (isset($_GET['msg_id']) && !isset($_GET['frwd']) && !isset($_GET['inb'])) {
    ?>
      $.ajax({
      url: 'to_msg_compose',
      type: 'POST',
      data: 'msg_status=replay_msg&msg_id=' +<?php echo $_GET['msg_id'];
      ?>,
      success: function(data) {
      $('#to_email').find('option').remove().end().append(data);
      $('#to_email').trigger("chosen:updated");
      var config = {
      '.chosen-select': {
    }
             ,
             '.chosen-select-deselect': {
             allow_single_deselect: true}
             ,
             '.chosen-select-no-single': {
             disable_search_threshold: 10}
             ,
             '.chosen-select-no-results': {
             no_results_text: 'Oops, nothing found!'}
             ,
             '.chosen-select-width': {
             width: "95%"}
             }
             for (var selector in config)
    {
      $(selector).chosen(config[selector]);
    }
  }
  ,
    error: function() {
      //called when there is an error
      //console.log(e.message);
    }
  }
  );
  <?php
  }
  elseif (isset($_GET['msg_id']) && isset($_GET['frwd'])) {
    ?>
      $.ajax({
      url: 'to_msg_compose',
      type: 'POST',
      data: 'msg_status=forward_msg&msg_id=' +<?php echo $_GET['msg_id'];
      ?>,
      success: function(data) {
      $("#editor").html(data);
    }
             ,
             error: function() {
      //called when there is an error
      //console.log(e.message);
    }
  }
  );
  <?php
  }
  elseif (isset($_GET['msg_id']) && isset($_GET['inb'])) {
    ?>
      $.ajax({
      url: 'to_msg_compose',
      type: 'POST',
      data: 'msg_status=replay_msg_inbox&msg_id=' +<?php echo $_GET['msg_id'];
      ?>,
      success: function(data) {
      $('#to_email').find('option').remove().end().append(data);
      $('#to_email').trigger("chosen:updated");
    }
             ,
             error: function() {
      //called when there is an error
      //console.log(e.message);
    }
  }
  );
  <?php }
    ?>
</script>
