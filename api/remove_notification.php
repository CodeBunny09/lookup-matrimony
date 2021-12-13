<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";
$matri_id = $_POST['matri_id'];
$hide_notification = $_POST['hide_notification'];
$count="";
if($count == 0){
	$updateNotification="UPDATE reminder set reminder_view_status='$hide_notification' WHERE receiver_id ='$matri_id'";
	$notificationQry = $DatabaseCo->dbLink->query($updateNotification);
	$response['message'] = "Success";
    $response['status'] = "1";
	echo json_encode($response);
	exit;
}else{
	$response['message'] = "Please Enter Matri id";
    $response['status'] = "0";
	echo json_encode($response);
	exit;
}

?>
