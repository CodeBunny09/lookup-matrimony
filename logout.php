<?php
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
include_once './class/Config.class.php';
$configObj = new Config();
$DatabaseCo = new DatabaseConn();

$is_logout = isset($_GET['action']) ? $_GET['action'] : "";
$sql = "UPDATE register set logged_in='0',last_login = '" . $_SESSION['login_time'] . "' WHERE matri_id='" . $_SESSION['user_id'] . "'";
$DatabaseCo->dbLink->query($sql);
session_unset();
$statusObj = new Status();
$statusObj->setActionSuccess(true);
$STATUS_MESSAGE = "You are successfully logout.";
$username = "";
$password = "";
echo "<script language='javascript'>window.location='login.php';</script>";
?>

