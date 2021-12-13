<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$selqry = "SELECT ocp_id,ocp_name FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC";
$qryres = $DatabaseCo->dbLink->query($selqry);
if(mysqli_num_rows($qryres) > 0){
	$count=0;
	while($contact_res = mysqli_fetch_array($qryres)){
		$count++;
		$response['responseData'][$count] = array('ocp_id' => $contact_res['ocp_id'],'ocp_name' => $contact_res['ocp_name'],'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	$response['message'] = "No Record Found";
	echo json_encode($response);
	exit;
}
?>