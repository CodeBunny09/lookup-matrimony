<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";
$ei_id=$_POST['ei_id'];
if($ei_id==""){
	$ei_id="Enter Interest Id";
	$count++;
}else{
	$ei_id="";
}
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter Matri Id";
	$count++;
}else{
	$matri_id="";
}

if($count==0){
	$ei_id=$_POST['ei_id'];
	$sql = $DatabaseCo->dbLink->query("SELECT * FROM expressinterest where ei_id='$ei_id'"); 
	$contact_res =  mysqli_fetch_object($sql);
	$ei_id1=$contact_res->ei_id;
	if($ei_id1 > 0){
		$ei_id=$_POST['ei_id'];
		$matri_id=$_POST['matri_id'];
		$DatabaseCo->dbLink->query("update expressinterest set trash_sender='Yes' where ei_id='$ei_id1'");
		/*if($contact_res->ei_receiver==$matri_id){
			$DatabaseCo->dbLink->query("update expressinterest set trash_sender='Yes' where ei_id='$ei_id1'");
		}else{
		if($contact_res->ei_sender==$matri_id){
			$DatabaseCo->dbLink->query("update expressinterest set trash_receiver='Yes' where ei_id='$ei_id1'");
		}*/
		
		$response['status'] = "1";
		$response['message'] = "Interest Deleted Successfully";
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