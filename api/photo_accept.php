<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$ph_reqid=$_POST['ph_reqid'];
if($ph_reqid==""){
	$ph_reqid="Enter old_password";
	$count++;
}else{
	$ph_reqid="";
}

if($count==0){
	$ph_reqid=$_POST['ph_reqid'];
	$sql = "select * from photoprotect_request where ph_reqid='$ph_reqid'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$ei_id1=$contact_res->ph_reqid;
	if($ei_id1>0){
	$ph_reqid=$_POST['ph_reqid'];
	$DatabaseCo->dbLink->query("update photoprotect_request set receiver_response='Accepted' where ph_reqid='$ph_reqid'");


	$mid = $ph_reqid;
	$from_id = $_POST['frm_id'];
	$result = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id='$mid'");
	$row=mysqli_fetch_array($result);

	$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id='$from_id'");
	$rowcc = mysqli_fetch_array($result3);

	$name = $rowcc['username'];
	$matriid = $rowcc['matri_id'];
	$to = $rowcc['email'];
	$website = $rowcc['web_name'];
	$webfriendlyname = $rowcc['web_frienly_name'];


	$from = $rowcc['from_email'];
	$photo_pass=$row['photo_pswd'];

	$subject = "Your requested Photo Password of $mid for $webfriendlyname";	
	$message = "
	<html>
	<head>
	<title>Dear $name,</title>
	</head>
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
		<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
		Thank you for requesting member's Photo Password.
				</p>
			<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
			<b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
			Here is your Requested Photo Password<br>
	  MatriID :$mid<br>
	  Photo Password : $photo_pass
			</b></p>

		<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>

		</td>
	  </tr>
	</tbody></table>
	</body>
	</html>
	";

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
			$headers .= 'From:'.$from."\r\n";


	mail($to,$subject,$message,$headers);
	$response['status'] = "1";
	$response['message'] = "Photo Req Accepted Successfully";
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	$response['message'] = "No Record Found";
	echo json_encode($response);

}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Field";
	echo json_encode($response);
	
}

?>