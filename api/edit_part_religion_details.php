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
	
	$religion_id =  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['part_religion_id']);
	$cast_id = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_caste_id']);
	$have_dosh = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_dosh']);
	$mother_tongue = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['mother_tongue_id']);
	$manglik = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_manglik']);
	$star = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['part_star']);
	
	$UPDATE_PART_EDU_OCC_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	part_star='$star',
	part_religion='$religion_id',
	part_caste='$cast_id',
	part_mtongue='$mother_tongue',
	part_manglik='$manglik',
	part_dosh='$have_dosh'

	  where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Partner Religion Preference Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>