<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);

$from_id=$_POST['from_id'];
if($from_id==""){
	$from_id="Enter sender_id";
	$count++;
}else{
	$from_id="";
}
$to_id=$_POST['to_id'];
if($to_id==""){
	$to_id="Enter old_password";
	$count++;
}else{
	$to_id="";
}
$subject=$_POST['subject'];
if($subject==""){
	$subject="Enter old_password";
	$count++;
}else{
	$subject="";
}
$message=$_POST['message'];
if($message==""){
	$message="Enter message";
	$count++;
}else{
	$message="";
}
if($count==0){
	$message=$_POST['message'];
	$subject=$_POST['subject'];
	$from_id=$_POST['from_id'];
	$to_id = $_POST['to_id'];

	$sql = "select * from register where matri_id='$from_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$new_matri_id=$contact_res->index_id;

	$sql1 = "select * from register where matri_id='$to_id'"; 
	$data1 = $DatabaseCo->dbLink->query($sql1);
	$contact_res1 =  mysqli_fetch_object($data1);
	$new_matri_id1=$contact_res1->index_id;
	if($new_matri_id>0  && $new_matri_id1>0 && $from_id!=$to_id){
			$subject = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['subject']);
			$message = mysqli_real_escape_string($DatabaseCo->dbLink, htmlspecialchars($_POST['message'], ENT_QUOTES));
			$status = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['msg_status']);
			$DatabaseCo->dbLink->query("insert into messages(mes_id,to_id,from_id,subject,message,msg_status,msg_important_status,sent_date,trash_receiver,trash_sender) values('','$to_id','$from_id','$subject','$message','$status','No','".date('Y-m-d H:m:s')."','No','No')");
			$select = "select * from payment_view where pmatri_id='$from_id'";
			$exe = $DatabaseCo->dbLink->query($select) or die(mysqli_error($DatabaseCo->dbLink));
			$fetch = mysqli_fetch_array($exe);
			$used_msg = $fetch['r_msg']+1;
			$DatabaseCo->dbLink->query("UPDATE payment_view SET r_msg='$used_msg' WHERE pmatri_id='$from_id'");
			$response['status'] = "1";
			$response['message'] = "Message Successfully Sent";
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