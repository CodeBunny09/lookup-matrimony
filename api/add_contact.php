<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$full_name=$_POST['full_name'];
if($full_name=="")
{
$full_name="";
$count++;
}
else
{
$full_name="";
}
$email_id=$_POST['email_id'];
if($email_id=="")
{
$email_id="";
$count++;
}
else
{
$email_id="";
}
$contact=$_POST['contact'];
if($contact=="")
{
$contact="";
$count++;
}
else
{
$contact="";
}
$subject=$_POST['subject'];
if($subject=="")
{
$subject="";
$count++;
}
else
{
$subject="";
}
$message=$_POST['message'];
if($message=="")
{
$message="";
$count++;
}
else
{
$message="";
}

if($count==0)
{
$message=$_POST['message'];
$subject=$_POST['subject'];
$full_name=$_POST['full_name'];
$email_id = $_POST['email_id'];
$contact = $_POST['contact'];

$sql = "select * from site_config "; 
$data = $DatabaseCo->dbLink->query($sql);
$contact_res =  mysqli_fetch_object($data);
$contact_email=$contact_res->contact_email;

 $to =  $_POST['email_id'];	
$name = trim(ucwords($_POST['full_name']));
 $from = $contact_email;	  
$mobile = $_POST['contact'];
$txt_message = $_POST['message'];
$subject = $_POST['subject']; 
$message = "<html>
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
<td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style='float:left;width:710px;min-height:auto'>
<h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'></p>
<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
<b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
Name : ".$name.".<br/>
Email ID : ".$from.".<br/>
Contact No : ".$mobile.".<br/>
Subject : ".$subject.".<br/>
Message : ".$txt_message.".<br/>
</b></p>
<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'></p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>
</td>
</tr>
</tbody></table>
</body>
</html>";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";

$mail=mail($from,$subject,$message,$headers);

if($mail)
{
    $response['status'] = "1";
	$response['message'] = "Contact Send Successfully";
	echo json_encode($response);
}
else
{
    $response['status'] = "0";
	$response['message'] = "Contact Send Fail";
	echo json_encode($response);
}

}
else
{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Field";
	echo json_encode($response);
	
}

?>