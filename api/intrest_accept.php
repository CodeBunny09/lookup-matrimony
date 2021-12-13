<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$count="";
$ei_id=$_POST['ei_id'];
if($ei_id==""){
	$ei_id="Enter Matri Id";
	$count++;
}else{
	$ei_id="";
}
if($count==0){
	$ei_id=$_POST['ei_id'];
	$sql = "select * from expressinterest where ei_id='$ei_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$ei_id1=$contact_res->ei_id;
	if($ei_id1>0){
		$ei_id=$_POST['ei_id'];
		$DatabaseCo->dbLink->query("update expressinterest set receiver_response='Accept' where ei_id='$ei_id'");
		$response['status'] = "1";
		$response['message'] = "Interest Accepted Successfully";
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