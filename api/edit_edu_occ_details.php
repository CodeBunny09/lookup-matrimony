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
	$occupation_id  = $_POST['occupation_id'];
	$employed_in  = $_POST['employed_in'];
	$annual_income  =$_POST['annual_income'];
	$edu_detail_id=$_POST['education_id'];
	$additional_degree_id=$_POST['additional_degree_id'];
	$edu_details=$additional_degree_id.",".$edu_detail_id;
	$UPDATE_EDU_OCC_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	  edu_detail='$edu_details',
	  occupation='$occupation_id',
	  emp_in='$employed_in',
	  income='$annual_income'
	  where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Education / Occupation Details Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
}

?>