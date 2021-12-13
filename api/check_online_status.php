<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$email = $_POST['email_id'];
$online_time = $_POST['online_time'];
	$updateOnlineTime="UPDATE register set online_time='$online_time' WHERE ( email = '$email' or matri_id ='$email' )";
	$onlineTimeQry = $DatabaseCo->dbLink->query($updateOnlineTime);
	exit;

?>
