<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mid=$_SESSION['user_id'];
if(isset($_POST['exp_status']) && $_POST['exp_status']=='accept'){
	$DatabaseCo->dbLink->query("update expressinterest set receiver_response='Accept' where ei_id='".$_POST['exp_id']."' ");	
	$get_exp_id=$DatabaseCo->dbLink->query("select ei_sender,ei_receiver from expressinterest where ei_id='".$_POST['exp_id']."'");	
	$sel_exp_id=mysqli_fetch_object($get_exp_id);
	
	
	
	$sel_reminder_id = $DatabaseCo->dbLink->query("select sender_id,receiver_id from reminder where sender_id='".$sel_exp_id->ei_sender."' and receiver_id='".$sel_exp_id->ei_receiver."' and receiver_response='Accept'");	
	$get_reminder_id = mysqli_fetch_object($sel_reminder_id);
	
	 $sql_noti = "INSERT INTO notification (sender_id,receiver_id,notification,notification_type,seen,date) VALUES ('$sel_exp_id->ei_sender','$sel_exp_id->ei_receiver','Express Interest Accepted','Express Interest','No',now())";
	$DatabaseCo->dbLink->query($sql_noti);
if(mysqli_num_rows($sel_reminder_id)>0){
	$DatabaseCo->dbLink->query("update reminder set reminder_view_status='Yes',sent_date='NOW()' where sender_id='".$sel_exp_id->ei_receiver."' and receiver_id='".$sel_exp_id->ei_sender."'");
}else{
	$DatabaseCo->dbLink->query("INSERT INTO reminder (rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('','".$sel_exp_id->ei_receiver."','".$sel_exp_id->ei_sender."','exp_interest','Accept','Yes','Yes',NOW())");
}
$result1 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$sel_exp_id->ei_receiver'");
$rowcc1 = mysqli_fetch_array($result1);
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$sel_exp_id->ei_sender'");
$rowcc = mysqli_fetch_array($result3);
$to=$rowcc['email'];
$chkreg = strtotime($rowcc['reg_date']);
$chkdate = strtotime('2015-08-18 06:24:22');
$matriid = $rowcc1['matri_id'];
						
						$website = $rowcc['web_name'];
						$webfriendlyname = $rowcc['web_frienly_name'];
						$from = $rowcc['from_email'];
						$to = $rowcc['email'];
						$name = $rowcc1['username'];
		$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$logo = $rowcc['web_logo_path'];
	$contact = $rowcc['contact_no'];
	$subject = "Express Interest Accepted";	
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
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Express Interest Accepted</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
			<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Express interest accepted by $name.</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Name : $name</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;text-decoration:none;color:black;'>Email : $from </h5>
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
    color: #565656;'>If have any query,Please contact us on $contact.</p>
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
}
if(isset($_POST['exp_status']) && $_POST['exp_status']=='reject'){
$DatabaseCo->dbLink->query("update expressinterest set receiver_response='Reject' where ei_id='".$_POST['exp_id']."' ");	
$get_exp_id=$DatabaseCo->dbLink->query("select sender_id,receiver_id from reminder where ei_id='".$_POST['exp_id']."'");	
$sel_exp_id=mysqli_fetch_object($get_exp_id);
	

$sel_reminder_id = $DatabaseCo->dbLink->query("select sender_id,receiver_id from reminder where sender_id='".$sel_exp_id->ei_sender."' and receiver_id='".$sel_exp_id->ei_receiver."' and receiver_response='Reject'");	
$get_reminder_id = mysqli_fetch_object($sel_reminder_id);

//	$sql_noti1 = "INSERT INTO notification (sender_id,receiver_id,notification,notification_type,seen,date) VALUES ('".$sel_exp_id->ei_sender."','".$sel_exp_id->ei_receiver."','Express Interest Rejected','Express Interest','No',now())";
//	$DatabaseCo->dbLink->query($sql_noti1);	
	
if(mysqli_num_rows($sel_reminder_id)>0){
$DatabaseCo->dbLink->query("update reminder set reminder_view_status='Yes',sent_date='NOW()' where sender_id='".$sel_exp_id->ei_sender."' and receiver_id='".$sel_exp_id->ei_receiver."'");
}
else{
$DatabaseCo->dbLink->query("insert into reminder(rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) values('','".$sel_exp_id->ei_sender."','".$sel_exp_id->ei_receiver."','exp_interest','Reject','Yes','Yes',NOW())");
}
$result1 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$sel_exp_id->ei_receiver'");
$rowcc1 = mysqli_fetch_array($result1);
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$sel_exp_id->ei_sender'");
$rowcc = mysqli_fetch_array($result3);
$to=$rowcc['email'];
$chkreg = strtotime($rowcc['reg_date']);
$chkdate = strtotime('2015-08-18 06:24:22');
$matriid = $rowcc1['matri_id'];
						
						$website = $rowcc['web_name'];
						$webfriendlyname = $rowcc['web_frienly_name'];
						$from = $rowcc['from_email'];
						$to = $rowcc['email'];
						$name = $rowcc1['username'];
		$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$logo = $rowcc['web_logo_path'];
	$contact = $rowcc['contact_no'];
	$subject = "Express Interest Rejected";	
echo $message = "
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
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Express Interest Rejected</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
			<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Unfortunately your express interest rejected by $name.</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Name : $name</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;text-decoration:none;color:black;'>Email : $from </h5>
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
    color: #565656;'>If have any query,Please contact us on $contact.</p>
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
}

if(isset($_POST['exp_status']) && $_POST['exp_status']=='reminder')
{
$get_exp_id=$DatabaseCo->dbLink->query("select ei_sender,ei_receiver from expressinterest where ei_id='".$_POST['exp_id']."'");	
$sel_exp_id=mysqli_fetch_object($get_exp_id);
$sel_reminder_id = $DatabaseCo->dbLink->query("select sender_id,receiver_id from reminder where sender_id='".$sel_exp_id->ei_sender."' and receiver_id='".$sel_exp_id->ei_receiver."'");	
$get_reminder_id = mysqli_fetch_object($sel_reminder_id);
if(mysqli_num_rows($sel_reminder_id) > 1)
{
$DatabaseCo->dbLink->query("delete from reminder where sender_id='".$sel_exp_id->ei_sender."' and receiver_id='".$sel_exp_id->ei_receiver."' and reminder_mes_type='exp_interest'");
$DatabaseCo->dbLink->query("insert into reminder(rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) values('','".$sel_exp_id->ei_sender."','".$sel_exp_id->ei_receiver."','exp_interest','Pending','Yes','Yes',NOW())");
}	
if(mysqli_num_rows($sel_reminder_id) > 0){
if($get_reminder_id->sender_id=$sel_exp_id->ei_sender && $get_reminder_id->receiver_id=$sel_exp_id->ei_receiver){
$DatabaseCo->dbLink->query("update reminder set reminder_view_status='Yes' where sender_id='".$sel_exp_id->ei_sender."' and receiver_id='".$sel_exp_id->ei_receiver."'");
}
}
else{
$DatabaseCo->dbLink->query("insert into reminder(rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) values('','".$sel_exp_id->ei_sender."','".$sel_exp_id->ei_receiver."','exp_interest','Pending','Yes','Yes',NOW())");
}
$result1 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$sel_exp_id->ei_receiver'");
$rowcc1 = mysqli_fetch_array($result1);
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$sel_exp_id->ei_sender'");
$rowcc = mysqli_fetch_array($result3);
$to=$rowcc['email'];
$chkreg = strtotime($rowcc['reg_date']);
$chkdate = strtotime('2015-08-18 06:24:22');
$matriid = $rowcc['matri_id'];
						
						$website = $rowcc['web_name'];
						$webfriendlyname = $rowcc['web_frienly_name'];
						$from = $rowcc['from_email'];
						$to = $rowcc1['email'];
						$name = $rowcc['username'];
		$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$logo = $rowcc['web_logo_path'];
	$contact = $rowcc['contact_no'];
	$subject = "Express Interest Reminder Received";	
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
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Interest reminder received</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
			<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Express interest reminder sent you by $name.</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Name : $name</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;text-decoration:none;color:black;'>Email : $from </h5>
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
    color: #565656;'>If have any query,Please contact us on $contact.</p>
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
}
?>
