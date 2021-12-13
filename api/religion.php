<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$getReligionQry = $DatabaseCo->dbLink->query("SELECT * FROM `religion` WHERE status='APPROVED'");
if(mysqli_num_rows($getReligionQry) > 0){
	$count=0;
	while($contact_res = mysqli_fetch_object($getReligionQry)){
		$count++;
		$response['responseData'][$count] = array('religion_id' => $contact_res->religion_id,'religion_name' => $contact_res->religion_name,'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	echo json_encode($response);
	exit;
}
?>
