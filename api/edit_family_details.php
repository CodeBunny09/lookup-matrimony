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
	$family_status  = $_POST['family_status'];
	$family_type  = $_POST['family_type'];
	$family_values  = $_POST['family_values'];
	$father_occupation  = $_POST['father_occupation'];
	$mother_occupation  = $_POST['mother_occupation'];
	$no_of_brothers  = $_POST['no_of_brothers'];
    $no_marri_brother  = $_POST['no_marri_brother'];
	$no_of_sisters  = $_POST['no_of_sisters'];
    $no_marri_sister  = $_POST['no_marri_sister'];
	
	$UPDATE_EDU_OCC_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	  family_status='$family_status',
	  family_type='$family_type',
	  family_value='$family_values',
	  father_occupation='$father_occupation',
	  mother_occupation='$mother_occupation',
	  no_of_brothers='$no_of_brothers',
	  no_marri_brother='$no_marri_brother',
	  no_of_sisters='$no_of_sisters ',
	  no_marri_sister='$no_marri_sister'
	  where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Family Details Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>