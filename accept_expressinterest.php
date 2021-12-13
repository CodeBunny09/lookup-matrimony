<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
echo $_POST['exp_id'];
if(isset($_POST['exp_status']) && $_POST['exp_status']=='accept_all')
{
	$DatabaseCo->dbLink->query("update expressinterest set receiver_response='Accept' where ei_id in (".$_POST['exp_id'].")");
	/*$select_interest = $DatabaseCo->dbLink->query("select expressinterest where ei_id = '".$_POST['exp_id']."'");
	$row_int=mysqli_fetch_object($select_interest);
	$mid=$row_int->ei_sender;
	$ExmatriId=$row_int->ei_receiver;
	echo $sql_noti = "INSERT INTO notification (sender_id,receiver_id,notification,notification_type,seen,date) VALUES ('$mid','$ExmatriId','Express Interest Accepted','Express Interest','No',now())";
	$DatabaseCo->dbLink->query($sql_noti);*/
}
if(isset($_POST['exp_status']) && $_POST['exp_status']=='reject_all')
{
	$DatabaseCo->dbLink->query("update expressinterest set receiver_response='Reject' where ei_id in (".$_POST['exp_id'].")");
	/*echo $sql_noti = "INSERT INTO notification (sender_id,receiver_id,notification,notification_type,seen,date) VALUES ('$mid','$ExmatriId','Express Interest Rejected','Express Interest','No',now())";
	$DatabaseCo->dbLink->query($sql_noti);*/
	
}


?>