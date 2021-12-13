<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);

$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}
$login_matri_id=$_POST['login_matri_id'];
if($login_matri_id==""){
	$login_matri_id="Enter login_matri_id";
	$count++;
}
$password=$_POST['password'];
if($password==""){
	$password="Enter password";
	$count++;
}
if($count==0){
	$matri_id = $_POST['matri_id'];
	$login_matri_id = $_POST['login_matri_id'];
	$password = $_POST['password'];
	$que = $DatabaseCo->dbLink->query("select photo_pswd,photo1 from register where matri_id='$matri_id'");
	$data = mysqli_fetch_object($que);
	if($password = $data->photo_pswd){
		$response['responseData'][1] = array('photo1' => $site_data->web_name."/my_photos/".$data->photo1);
		$response['status'] = "1";
		$response['message'] = "Success";
		echo json_encode($response);
	}else{
		$response['status'] = "0";
		$response['message'] = "Password Not Match.";
		echo json_encode($response);
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
}