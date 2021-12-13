<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

if(isset($_POST['exp_id']) && !isset($_POST['exp_status']) && $_POST['exp_page']=='sent')
{
	$DatabaseCo->dbLink->query("update expressinterest set trash_sender='Yes' where ei_id='".$_POST['exp_id']."'");

}

if(isset($_POST['exp_id']) && !isset($_POST['exp_status']) && $_POST['exp_page']=='receiver')
{
	$DatabaseCo->dbLink->query("update expressinterest set trash_receiver='Yes' where ei_id='".$_POST['exp_id']."'");

}



if(isset($_POST['exp_status']) && $_POST['exp_status']=='trash_all' && $_POST['exp_page']=='receiver')
{
	$DatabaseCo->dbLink->query("update expressinterest set trash_receiver='Yes' where ei_id in (".$_POST['exp_id'].")");
	
}

if(isset($_POST['exp_status']) && $_POST['exp_status']=='trash_all' && $_POST['exp_page']=='sent')
{
	$DatabaseCo->dbLink->query("update expressinterest set trash_sender='Yes' where ei_id in (".$_POST['exp_id'].")");
	
}


?>