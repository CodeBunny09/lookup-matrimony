<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";
if($_POST['user_id']==""){
	 $user_id = $_POST['user_id'];
	 $count++;
}

if($_POST['otp']==""){
	 $otp = $_POST['otp'];
	 $count++;
}
if($count==0){
$user_id=$_POST['user_id'];
$send_otp=$_POST['otp'];

$s="select * from register where index_id='$user_id'";
$q=$DatabaseCo->dbLink->query($s);
$r=mysqli_fetch_array($q);
$no=mysqli_num_rows($q);
$old_otp=$r['otp'];
if($no>0){
if($old_otp==$send_otp){
	$response['user_id'] = "$user_id";
	$response['message'] = "OTP Successfully Verified";
	$response['status'] = "1";
    echo json_encode($response);
	
}else{
	$response['status'] = "0";
	$response['message'] = "Wrong OTP";
	echo json_encode($response);
	
}
}else{
	$response['status'] = "0";
	$response['message'] = "User Id Not Available";
	echo json_encode($response);

}
}else{
	$response['status'] = "0";
	$response['message'] = "Enter User Id and OTP";
	echo json_encode($response);
	exit;
}

?>