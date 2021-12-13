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
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$profileby=$_POST['profile_created_by'];
	$country_code=$_POST['country_code'];
	$mobile_no = $_POST['mobile_no'];
	$birthdate = $_POST['birthdate'];
	$marital_status = $_POST['marital_status'];
	$no_of_children = $_POST['no_of_children'];
	$children_living_status = $_POST['children_living_status'];
	$mother_tongue_id = $_POST['mother_tongue_id'];
	$UPDATE_BASIC_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	  username='".$firstname." ".$lastname."',
	  firstname='$firstname',
	  lastname='$lastname',
	  mobile='$mobile_no',
	  mobile_code='$country_code',
	  m_tongue='$mother_tongue_id',
	  profileby='$profileby',
	  m_status='$marital_status',
	  tot_children='$no_of_children',
	  status_children='$children_living_status',
	  birthdate='$birthdate'
	  where matri_id='$matri_id'");
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Basic Details Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>