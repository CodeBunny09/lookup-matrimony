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

$sql = "select * from register where matri_id='$to_id'"; 
$data = $DatabaseCo->dbLink->query($sql);
$contact_res =  mysqli_fetch_object($data);
$new_to_id=$contact_res->index_id;
		if($new_to_id>0){
			$DatabaseCo->dbLink->query("insert into shortlist (from_id,to_id,add_date) VALUES ('$from_id','$to_id','".date('Y-m-d H:m:s')."')");
			$response['status'] = "1";
			$response['message'] = "Shortlisted Successfully";
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