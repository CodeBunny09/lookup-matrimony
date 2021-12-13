<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
if(isset($_POST['ss_id']))
{
	$DatabaseCo->dbLink->query("delete from save_search where ss_id='".$_POST['ss_id']."'");
}
?>