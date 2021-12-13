<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$noti_id=$_POST["noti_id"];
$result = $DatabaseCo->dbLink->query("UPDATE notification SET seen='Yes' WHERE noti_id='$noti_id'") or die(mysqli_error());
?> 