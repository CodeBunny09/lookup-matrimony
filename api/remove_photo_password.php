<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count=""; 
$matri_id = $_POST['matri_id'];
$current_photo_password= $_POST['current_photo_password'];
$count=""; 
if($_POST['matri_id']==""){
	$matri_id = $_POST['matri_id'];
	$count++;
}
if($_POST['current_photo_password']==""){
	$current_photo_password= $_POST['index'];
	$count++;
}
if($count==0){
	$matri_id = $_POST['matri_id'];
	$se="select * from register where matri_id='$matri_id'";
	$qu=$DatabaseCo->dbLink->query($se);
	$no=mysqli_num_rows($qu);
	if($no==0){
	    $response['message'] = "No Record Found";
		$response['status'] = "0";
		echo json_encode($response);
	}else{
		$data_res = mysqli_fetch_object($qu);
		if($data_res->photo_pswd==$_POST['current_photo_password']){
			$current_photo_password= $_POST['current_photo_password'];
			$matri_id = $_POST['matri_id'];
			$insert_qry = "update register set photo_pswd='' where matri_id='$matri_id'";
			$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
			$response['message'] ="Photo Password Successfully Removed" ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else{
			$response['message'] ="Please enter corect current password" ;
			$response['status'] = "0";
			echo json_encode($response);
			exit;
		}
	}
}else{
		$response['message'] = "Enter All Fields";
		$response['status'] = "0";
		echo json_encode($response);
		exit;
}

?>