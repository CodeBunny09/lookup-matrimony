<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$getSubCasteQry = $DatabaseCo->dbLink->query("SELECT * FROM sub_caste WHERE status='APPROVED'");
if(mysqli_num_rows($getSubCasteQry) > 0){
	$count=0;
	while($contact_res = mysqli_fetch_object($getSubCasteQry)){
		$count++;
		$response['responseData'][$count] = array('sub_caste_id' => $contact_res->sub_caste_id,'sub_caste_name' => $contact_res->sub_caste_name,'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	echo json_encode($response);
	exit;
}



?>
