<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";
if($_POST['user_id']==""){
	 $user_id = $_POST['user_id'];
	 $count++;
}
if($count==0){
	$user_id=$_POST['user_id'];
	$send_otp=$_POST['otp'];

	$s="select * from register where index_id='$user_id'";
	$q=$DatabaseCo->dbLink->query($s);
	$r=mysqli_fetch_object($q);
	$no=mysqli_num_rows($q);

    $order_id = rand(1000,9999);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
    $_SESSION['order_id'] = $order_id;
	
    $text = "Hello $user, Welcome, Your OTP is $order_id. Do not share your OTP with anyone.";
    $message = str_replace(" ", "%20", $text);
    $mno = $r->mobile;
	$code = $r->mobile_code;
    // $url="https://control.msg91.com/api/sendhttp.php?authkey=230502AnKcsTku0Trd5d7b640a&mobiles=91$mno&message=$message&sender=INLOGI&route=4&country=0";	
    $url="http://retailsms.nettyfish.com/api/mt/SendSMS?apikey=z2Zw5kazG0iEaJN8HojIPA&senderid=LOOKUP&channel=Trans&route=3&dcs=8&flashsms=0&mobnumber=$mno&msg=$text";	
	
    $ret = file($url);
    $old_otp1= $order_id;

if($no>0){
	
$insert="update register set otp='$old_otp1' where index_id='$user_id'";
$query=$DatabaseCo->dbLink->query($insert);

	$response['otp'] = "$old_otp1";
	$response['user_id'] = "$user_id";
	$response['message'] = "OTP Successfully Sent";
	$response['status'] = "1";
    echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	$response['message'] = "User Not Exit";
	echo json_encode($response);
}

}else{
	$response['status'] = "0";
	$response['message'] = "Enter User Id";
	echo json_encode($response);
	exit;
}
?>