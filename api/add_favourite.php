<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$msg_id=$_POST['msg_id'];
if($msg_id==""){
	$msg_id="Enter mes_id";
	$count++;
}else{
	$msg_id="";
}

if($count==0){
	$msg_id=$_POST['msg_id'];
	$sql = "select * from messages where mes_id='$msg_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$mes_id=$contact_res->mes_id;
	if($mes_id > 0){
		$msg_id=$_POST['msg_id'];
		$DatabaseCo->dbLink->query("UPDATE messages SET msg_important_status='Yes' WHERE mes_id='$msg_id'");
		$response['status'] = "1";
		$response['message'] = "Message Important Successful";
		echo json_encode($response);
		exit;
	 }else{
		$response['status'] = "0";
		$response['message'] = "No Data Found";
		echo json_encode($response);
		exit;
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);	
}

?>