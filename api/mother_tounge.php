<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$getmTongueQry = $DatabaseCo->dbLink->query("SELECT * FROM `mothertongue` WHERE status='APPROVED'");
if(mysqli_num_rows($getmTongueQry) > 0){
	$count=0;
	while($contact_res = mysqli_fetch_object($getmTongueQry)){
		$count++;
		$response['responseData'][$count] = array('mtongue_id' => $contact_res->mtongue_id,'mtongue_name' => $contact_res->mtongue_name,'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	echo json_encode($response);
	exit;
}



?>
