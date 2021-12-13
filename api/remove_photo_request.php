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
		$DatabaseCo->dbLink->query("delete from photoprotect_request where ph_reqid='$ph_reqid'");
		$response['status'] = "1";
		$response['message'] = "Photo Req Deleted Successfully";
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