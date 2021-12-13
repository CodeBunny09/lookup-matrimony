<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$selqry = "SELECT edu_id,edu_name FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC";
$qryres = $DatabaseCo->dbLink->query($selqry);
$rows=mysqli_num_rows($qryres);
if($rows > 0){
	$count=0;
	while($contact_res = mysqli_fetch_array($qryres)){
		$count++;
		$response['responseData'][$count] = array('edu_id' => $contact_res['edu_id'],'edu_name' => $contact_res['edu_name'],'status'=>"1");
	}
	$response['status'] = "1";
    $response['message'] = "Successfully";
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	$response['message'] = "No Record Found";
	echo json_encode($response);
	exit;
}
?>