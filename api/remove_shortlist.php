<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

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

if($count==0){
	$from_id=$_POST['from_id'];
	$to_id = $_POST['to_id'];

	$sql = "select * from shortlist where from_id='$from_id' and to_id='$to_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$sh_id=$contact_res->sh_id;
if($sh_id>0){
	$DatabaseCo->dbLink->query("delete from  shortlist where from_id='$from_id' and to_id='$to_id'");
	$response['status'] = "1";
	$response['message'] = "Successfully Removed From Shortlist";
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