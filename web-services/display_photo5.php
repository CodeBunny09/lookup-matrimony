<?php 
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mid=$_SESSION['user_id'];
$Row = mysqli_fetch_object($DatabaseCo->dbLink->query("select photo5,gender from register where matri_id='".$mid."'"));
?>	

