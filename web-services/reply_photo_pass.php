<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
			
$from_id = isset($_GET['frmid'])?$_GET['frmid']:0;
$mid = $_SESSION['user_id'];

$result = $DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request where ph_reqid='$from_id'");
$row=mysqli_fetch_array($result);
$reqmatri_id=$row['ph_requester_id'];

$result1 = $DatabaseCo->dbLink->query("SELECT * FROM register where matri_id='$reqmatri_id'");
$rowcc1=mysqli_fetch_array($result1);

$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id='$mid'");
$rowcc = mysqli_fetch_array($result3);

$name = $rowcc['username'];
$matriid = $rowcc['matri_id'];
$to = $rowcc1['email'];
$website = $rowcc['web_name'];
$webfriendlyname = $rowcc['web_frienly_name'];


$from = $rowcc['from_email'];
$photo_pass=$rowcc['photo_pswd'];
$logo = $rowcc['web_logo_path'];
$fb = $rowcc['facebook'];
$li= $rowcc['twitter'];
$tw = $rowcc['linkedin'];
$gp = $rowcc['google'];
$subject = "Your requested Photo Password of $mid for $webfriendlyname";	
$message = "
<!doctype html>
<html>
<link href='https://fonts.googleapis.com/css?family=Courgette|Roboto:300,400,500' rel='stylesheet'>
<body  style='margin: 0 auto;padding-top:20px;padding-bottom:20px;background: rgba(233,233,233,1.00);'>
	<div id='templateBody' style='border: 3px solid #e2e2e2;
    width: 50%;
    margin: 40px auto 40px auto;
    border-radius: 5px;background-color:white;'>
		<div id='gtheader' style='background: #fff;padding: 15px;'>
			<div id='gtLogo' style=''>
				<a href='$website'>
					<img src='$website/img/$logo' style='max-height: 70px;'>
				</a>
			</div>	
		</div>
		<div id='gtstrip' style='background: #ea2626;padding: 10px;text-align:center;'>
				<h5 style='font-size: 30px;font-weight:300;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Photo password req accepted</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='verifyContent'>
				<p style='margin-top:10px;margin-bottom: 10px;font-family: Roboto, sans-serif;font-weight: 400;font-size: 15px;text-align: center;'>Here is your requested photo password for below matri id.</p>
			</div>
			<div id='gtUDetails' style='padding: 15px;'>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>User Id: $mid</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Photo Password : $photo_pass</h5>
        
				
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

$upd=$DatabaseCo->dbLink->query("update photoprotect_request set receiver_response='Accepted' where ph_reqid ='$from_id'");
$sql_noti = "INSERT INTO notification (sender_id,receiver_id,notification,notification_type,seen,date) VALUES ('$reqmatri_id','$mid','Photo Password Request Accepted','Photo Password','No',now())";
$DatabaseCo->dbLink->query($sql_noti);
?>

<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Photo password request of <?php echo $name;?></h4>
              </div>
               
              <div class="modal-body">                 
                      <div class="form-group"> 
            <h5>Your Photo Password has been successfully sent to requester's email id.</h5>        
                      </div>
     
              </div>
              
              
              <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.reload()">Close</button>
              </div>

            </div>
          </div>