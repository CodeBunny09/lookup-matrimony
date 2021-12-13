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
	$marital_status = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_marital_status']);
	$age_from =mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_age_from']);
    $age_to =mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_age_to']);
	$height_from = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_height_from']);
	$height_to = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_height_to']);
	$diet =  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_diet']);
    $smoking =  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_smoking']);
    $drinking =  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_drinking']);
	$physical_status = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_physical_status']);
	
	$UPDATE_PART_BASIC_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	 part_frm_age='$age_from',
	 part_to_age='$age_to',
	 part_height='$height_from',
	 part_height_to='$height_to',
	 looking_for='$marital_status',
	 part_physical='$physical_status',
	 part_diet='$diet',
	 part_smoke='$smoking',
	 part_drink='$drinking'
	  where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Partner Basic Preference Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>