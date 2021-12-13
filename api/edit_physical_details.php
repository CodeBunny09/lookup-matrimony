<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";

$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$height = $_POST['height'];
	$weight = $_POST['weight'];
	$body_type = $_POST['body_type'];
	$physical_status = $_POST['physical_status'];
	$UPDATE_HABBIT_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	 height='$height',
	 weight='$weight',
	 bodytype='$body_type',
	 physicalStatus='$physical_status'
	  where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Physical Details Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>