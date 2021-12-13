<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}
$login_matri_id=$_POST['login_matri_id'];
if($login_matri_id==""){
	$login_matri_id="Enter login_matri_id";
	$count++;
}
$message=$_POST['message'];
if($message==""){
	$message="Enter message";
	$count++;
}
if($count==0){
	$matri_id = $_POST['matri_id'];
	$receiver = $_POST['login_matri_id'];
	$msg = $_REQUEST['message'];
	$strresponse = "Pending";
	$matri_id = $_POST['matri_id'];
	$receiver = $_POST['login_matri_id'];
	$insert = $DatabaseCo->dbLink->query("insert into photoprotect_request(ph_requester_id,ph_receiver_id,ph_msg,ph_reqdate,
	receiver_response,status) values ('$receiver','$matri_id','$msg','".date('Y-m-d H:m:s')."','$strresponse','1')");
	$DatabaseCo->dbLink->query("INSERT INTO reminder (rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('','$receiver','$matri_id','photo_pass_req','Sent','Yes','Yes',NOW())");
	$result="We found your profile to be a good match. Please send me Photo password to proceed further.";
	$response['status'] = "1";
	$response['message'] = $result;
	echo json_encode($response);
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
}