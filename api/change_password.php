<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
$old_password=$_POST['old_password'];
if($old_password==""){
	$old_password="Enter Current Password";
	$count++;
}else{
	$old_password="";
}
$new_password=$_POST['new_password'];
if($new_password==""){
	$new_password="Enter New Password";
	$count++;
}else{
	$new_password="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$old= $_POST['old_password'];
	$old_password=md5($old);
	$new = $_POST['new_password'];
	$new_password=md5($new);
	$sql = "SELECT password from register where matri_id='$matri_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$bdpassword=$contact_res->password;
	if($old_password!=$bdpassword){
		$response['status'] = "0";
		$response['message'] = "Current Password Is Wrong";
		echo json_encode($response);
		exit;
	}else{
		$matri_id=$_POST['matri_id'];
		$old= $_POST['old_password'];
		$old_password=md5($old);
		$new = $_POST['new_password'];
		$new_password=md5($new);
		$sql="update register set password='$new_password' where matri_id='$matri_id' and password='$old_password'";
		$DatabaseCo->dbLink->query($sql);
		$response['status'] = "1";
		$response['matri_id'] = "$matri_id";
		$response['message'] = "Password Changed Successfully";
		echo json_encode($response);
		exit;
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Field";
	echo json_encode($response);
	
}

?>