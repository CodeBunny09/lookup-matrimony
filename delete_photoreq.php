<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
if(isset($_POST['req_id']) && !isset($_POST['req_status']) && $_POST['req_page']=='sent')
{
$DatabaseCo->dbLink->query("delete from photoprotect_request where ph_reqid='".$_POST['req_id']."'");
}
if(isset($_POST['req_id']) && !isset($_POST['req_status']) && $_POST['req_page']=='receiver')
{
$DatabaseCo->dbLink->query("update photoprotect_request set receiver_response='Rejected' where ph_reqid='".$_POST['req_id']."'");
}
?>
