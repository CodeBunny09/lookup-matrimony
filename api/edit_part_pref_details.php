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
	$part_expect_date= date('H:i:s Y-m-d');
    $partner_preference = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['partner_preference']);
	
	$UPDATE_PART_PREF_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	part_expect='$partner_preference',part_expect_approve='Pending',part_expect_date='$part_expect_date',
    where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Partner Expectation Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>