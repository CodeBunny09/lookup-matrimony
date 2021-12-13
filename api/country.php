<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$getCountryQry = $DatabaseCo->dbLink->query("SELECT * FROM `country` WHERE status='APPROVED'");
$count="";
if(mysqli_num_rows($getCountryQry) > 0){
	$count=0;
	while($contact_res = mysqli_fetch_object($getCountryQry)){
		$count++;
		$response['responseData'][$count] = array('cid' =>$count,'country_id' => $contact_res->country_id,'country_name' => $contact_res->country_name,'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = 0;
	echo json_encode($response);
	exit;
}
?>
