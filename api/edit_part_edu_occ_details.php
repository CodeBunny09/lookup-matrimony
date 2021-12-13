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
	$education_id = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_education_id']);
	$occupation_id = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_occupation_id']);
	$annual_income = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_annual_income']);
	$UPDATE_PART_EDU_OCC_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	part_edu='$education_id',
	part_occu='$occupation_id',
	part_income='$annual_income'
	where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Partner Education/Occupation Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>