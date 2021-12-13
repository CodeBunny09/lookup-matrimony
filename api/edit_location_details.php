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
	$country_id = $_POST['country_id'];
	$state_id = $_POST['state_id'];
	$city_id = $_POST['city_id'];
	
	$UPDATE_EDU_OCC_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	  country_id='$country_id',
	  state_id='$state_id',
	  city='$city_id'
	  where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Location Details Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>