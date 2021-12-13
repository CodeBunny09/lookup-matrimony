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
	$country_id = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_country_id']);
    $state_id = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_state_id']);
    $city_id = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_city_id']);
	
	$UPDATE_PART_LOCATION_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	part_country_living='$country_id',
	part_state='$state_id',
	part_city='$city_id'
    where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Partner Location Preference Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>