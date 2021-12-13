<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count="";
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
$photo_pass=$_POST['photo_pass'];
if($photo_pass==""){
	$photo_pass="Enter photo_pass";
	$count++;
}else{
	$photo_pass="";
}
if($count==0){
	$photo_pass=$_POST['photo_pass'];
	$matri_id=$_POST['matri_id'];
	$sql = "select index_id,matri_id from register where matri_id='$matri_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$user_id=$contact_res->index_id;
	if($user_id > 0){
		$photo_pass=$_POST['photo_pass'];
		$matri_id=$_POST['matri_id'];
		$DatabaseCo->dbLink->query("update register set photo_pswd='$photo_pass',photo_protect='Yes' where matri_id='$matri_id'");
		$response['status'] = "1";
		$response['matri_id'] = "$matri_id";
		$response['message'] = "Photo Password Successfully Set";
		echo json_encode($response);
		exit;
	}else{
		$response['status'] = "0";
		$response['message'] = "No Record Found";
		echo json_encode($response);
	}
	}else{
		$response['status'] = "0";
		$response['message'] = "Please Enter All Fields";
		echo json_encode($response);	
}  

?>