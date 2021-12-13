<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$msg_id=$_POST['msg_id'];
if($msg_id==""){
	$msg_id="Enter old_password";
	$count++;
}else{
	$msg_id="";
}
if($count==0){
	$msg_id=$_POST['msg_id'];
	$sql = "select * from messages where mes_id='$msg_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$msg_id1=$contact_res->mes_id;
	if($msg_id1 > 0){
		$msg_id=$_POST['msg_id'];
		$DatabaseCo->dbLink->query("update messages set msg_important_status='No' where mes_id='$msg_id'");
		$response['status'] = "1";
		$response['message'] = "Success";
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