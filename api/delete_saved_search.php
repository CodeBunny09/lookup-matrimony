<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$ss_id=$_POST['ss_id'];
if($ss_id==""){
	$ss_id="Enter Saved Search Id";
	$count++;
}else{
	$ss_id="";
}
if ($count == 0){
	$ss_id = $_POST['ss_id'];
	$DatabaseCo->dbLink->query("DELETE FROM save_search WHERE ss_id = '$ss_id'");
	$response['status'] = "1";
    $response['message'] = "Delete Successfully";
    echo json_encode($response);
}else{
    $response['status'] = "0";
    $response['message'] = "No Data Found";
    echo json_encode($response);
}
?>