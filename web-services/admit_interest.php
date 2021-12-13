<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$DatabaseCo = new DatabaseConn();
$ExmatriId = isset($_REQUEST['ExmatriId'])?$_REQUEST['ExmatriId']:$_REQUEST['ExmatriId'];
$Msg =htmlspecialchars($_REQUEST['exp_interest'], ENT_QUOTES);
$mid = $_SESSION['user_id'];
		$sql = "INSERT INTO expressinterest (ei_sender,ei_receiver,receiver_response,ei_message,ei_sent_date,status) VALUES ('$mid','$ExmatriId','Pending','$Msg',now(),'APPROVED')";
		$DatabaseCo->dbLink->query($sql);
	 	$DatabaseCo->dbLink->query("INSERT INTO reminder (sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('$mid','$ExmatriId','exp_interest','Pending','Yes','Yes',NOW())");
		$sql_noti = "INSERT INTO notification (sender_id,receiver_id,notification,notification_type,seen,date) VALUES ('$mid','$ExmatriId','Express Interest Received','Express Interest','No',now())";
		$DatabaseCo->dbLink->query($sql_noti);

	 	$DatabaseCo->dbLink->query("INSERT INTO reminder (sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('$mid','$ExmatriId','exp_interest','Pending','Yes','Yes',NOW())");
      	
		$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$ExmatriId'");
		$rowcc = mysqli_fetch_array($result3);

		$result4 = $DatabaseCo->dbLink->query("SELECT * FROM register where matri_id = '$mid'");
		$rowcc1 = mysqli_fetch_array($result4);

                         
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
		
		$name = $rowcc1['firstname']." ".$rowcc1['lastname'];

        $religion_id = $rowcc1['religion'];
		$SQL_STATEMENT_religion =$DatabaseCo->dbLink->query("SELECT religion_name FROM religion WHERE religion_id='$religion_id'");
		$rrow = mysqli_fetch_array($SQL_STATEMENT_religion);	
		$religion=$rrow['religion_name'];
        $mstatus = $rowcc1['m_status']; 
		$matriid = $rowcc1['matri_id'];
		$gender = $rowcc1['gender'];
		$photo = $rowcc1['photo1'];
		$photo_status = $rowcc1['photo1_approve'];
		if(isset($photo) !='' && ($photo_status) =='APPROVED' ){
			 $photo='my_photos/'.$rowcc1['photo1'];
		}else{
		
			$photo='img/photo-default.png';
		}
        $subject = "A new express interest received";	
                $message = "
				<!doctype html>
<html>
<link href='https://fonts.googleapis.com/css?family=Courgette|Roboto:300,400,500' rel='stylesheet'>
<body  style='margin: 0 auto;background: rgba(233,233,233,1.00);'>
	<div id='templateBody' style='border: 3px solid #e2e2e2;
    width: 75%;
    margin: 40px auto 40px auto;
    border-radius: 5px;background-color:white;'>
		<div id='gtheader' style='background: #fff;padding: 15px;'>
			<div id='gtLogo' style=''>
				<img src='$website/img/$logo' style='max-height: 70px;'>
			</div>	
		</div>
		<div id='gtstrip' style='background: #ea2626;padding: 10px;text-align:center;'>
				<h5 style='font-size: 40px;font-weight: 200; font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Express interest received</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='display: table;width: 100%;'>
				<div style='display:table-cell;vertical-align: top;width: 30%;'>
					<img src='$website/$photo' style='width: 120px;height: 150px;border-radius: 5px;padding: 5px;border: 1px solid #e2e2e2;'>
				</div>
				<div style='display:table-cell;margin-top: 0px;vertical-align: top;width:70%;'>
					<h5 style='margin-top:10px;margin-bottom: 10px;font-family: Roboto, sans-serif;font-weight: 400;font-size: 14px;'>Matri Id:$matriid
					</h5>
					<h5 style='margin-top:10px;margin-bottom: 10px;font-family: Roboto, sans-serif;font-weight: 400;font-size: 14px;'>Name:$name</h5>
					<h5 style='margin-top:10px;margin-bottom: 10px;font-family: Roboto, sans-serif;font-weight: 400;font-size: 14px;'>Marital Status : $mstatus</h5>
					<h5 style='margin-top:10px;margin-bottom: 10px;font-family: Roboto, sans-serif;font-weight: 400;font-size: 14px;'>Gender : $gender</h5>
					<h5 style='margin-top:10px;margin-bottom: 10px;font-family: Roboto, sans-serif;font-weight: 400;font-size: 14px;'>Religion:$religion</h5>
				</div>
			</div>
			<div id='gtlogin' style='text-align: center;'>
				<a href='$website/member-profile?view_id=$matriid' style='font-family: Roboto, sans-serif;
				padding: 10px 30px 10px 30px;
    font-size: 18px;
    background: rgb(234, 38, 38);
    display: inline-block;
    color: white;
    text-decoration: none;
    border-radius: 3px;
    margin-top: 15px;
    margin-bottom: 15px;'>View Profile</a>
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
    font-weight: 500;'>Team $webfriendlyname</h5>
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
				
                $email_template = htmlspecialchars_decode($message,ENT_QUOTES);
                $trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website,"Dear"=>$name);
                $email_template = strtr($email_template, $trans);
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
				$headers .= 'From:'.$from."\r\n";
mail($to,$subject,$email_template,$headers);
echo "You have successfully expressed the interest.";
?>

