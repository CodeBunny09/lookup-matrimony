<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$pmatri_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mid']);
$p_plan=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan']);
$plan_duration=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['duration']);
$p_no_contacts=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_contacts']);
$p_msg=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_msg']);
$profile=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_profile']);
$p_amount=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['amount']);
$pactive_dt=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['expdate']);
$date = strtotime(date("Y-m-d", strtotime($pactive_dt)) . + $plan_duration." day");
$exp_date=date('Y-m-d', $date);	
$DatabaseCo->dbLink->query("update payments set p_plan='$p_plan',plan_duration='$plan_duration',p_amount='$p_amount',p_no_contacts='$p_no_contacts',profile='$profile',p_msg='$p_msg',exp_date='$exp_date' where pmatri_id='$pmatri_id'");
?>
<?php 
$result = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$pmatri_id' ");
while($row = mysqli_fetch_array($result))
{
$name  = mysqli_real_escape_string($DatabaseCo->dbLink,$row['username']); 
$to  = mysqli_real_escape_string($DatabaseCo->dbLink,$row['email']);
$matriid  = mysqli_real_escape_string($DatabaseCo->dbLink,$row['matri_id']);
$email  = mysqli_real_escape_string($DatabaseCo->dbLink,$row['email']);
$pass = mysqli_real_escape_string($DatabaseCo->dbLink,$row['password']);
$website = mysqli_real_escape_string($DatabaseCo->dbLink,$row['web_name']);
$webfriendlyname = mysqli_real_escape_string($DatabaseCo->dbLink, $row['web_frienly_name']);
$webtomail = mysqli_real_escape_string($DatabaseCo->dbLink, $row['to_email']);
$webfrommail =mysqli_real_escape_string($DatabaseCo->dbLink, $row['from_email']);
$from = mysqli_real_escape_string($DatabaseCo->dbLink, $row['from_email']);  // website config From Email
$subject = "Your Paid Membership on $website has been Changed";
$message = "
<html>
<head>
<title>Your Paid Membership on $website has been Changed</title>
</head>
<body>
<table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
<tbody>
<tr>
<td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
<table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
<tbody>
<tr style='background:#f9f9f9'>
<td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style='float:left;width:710px;min-height:auto'>
<h6 style='text-align:justify;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello, $name</h6>
<p style='text-align:justify;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
Congratulations! Your Paid Membership on $webfriendlyname has been Changed. You are now ready to search and contact millions of validated profiles.</p>
<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Log on to <a href=".$website.">$webfriendlyname</a> now using the follwing information to find your dream partner.</p>
<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
<b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
Login ID : $matriid (or) $email		
</b></p>
<p style='text-align:justify;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>And while you are on the site we strongly encourage you to use as many features. This way you will understand how easy it is to use our site and more importantly find your life partner. Some of the key features that you could straight away start using are:<br /><br />
<b>Upload Photo</b>: 90% of members look for profiles with photos. Don't miss out on this chance. Add your photo now and increase your responses by 10 times.<br /><br />
<b>Assured Contact</b>: Get your phone number validated for FREE and get a direct connection to your life partner.<br /><br />
<b>Add video</b>: Add video clipping to your profile for FREE and increase your responses.<br /><br />
Everybody here at The Greentech, wish you all the very best in your search for a life partner. Should you require any further assistance, do not hesitate to call our office OR visit our 24/7 live support.<br /><br />
Good luck in your search for a life partner.<br /><br /> </p>
<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Customer Support Manager. <br />
Team $webfriendlyname</p>
</td>
</tr>
</tbody></table>
</body>
</html>
";
$headers  = "From: $from\r\n"; 
$headers .= "Content-type: text/html\r\n"; 
mail($to, $subject, $message, $headers);
}
echo "<script>window.location='edit_plan?member_status=Paid&success=edit_plan';</script>";
?>