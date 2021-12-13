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
	$about_me = $_POST['something_about_me'];
	$profile_text_date= date('H:i:s Y-m-d ');
	$UPDATE_ABOUT_SQL=$DatabaseCo->dbLink->query("UPDATE register SET profile_text='$about_me',profile_text_approve='Pending',profile_text_date='$profile_text_date'
	WHERE matri_id='$matri_id'");
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "About Me Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}
?>