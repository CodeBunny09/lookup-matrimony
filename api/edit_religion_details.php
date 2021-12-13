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
	$religion_id = $_POST['religion_id'];
	$caste_id = $_POST['caste_id'];
	$sub_caste_id=$_POST['sub_caste_id'];
	
	$UPDATE_BASIC_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	  religion='$religion_id',
	  caste='$caste_id',
	  subcaste='$sub_caste_id'
	  
	  where matri_id='$matri_id'");
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Religion Details Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>