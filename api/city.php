<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
if($_POST['state_id']){
	$state_id=$_POST['state_id'];
	$selqry = "SELECT * FROM city_view WHERE state_id='".$state_id."' and status='APPROVED' ORDER BY city_name ASC";
	//$selqry = "SELECT * FROM `country` c1 , state c2 , city c3 where c1.country_code=c2.country_code and c1.country_id='".$_POST['country_id']."' and c3.state_code=c2.state_code and c2.state_id='".$_POST['state_id']."'";
	$qryres =  $DatabaseCo->dbLink->query($selqry);
if(mysqli_num_rows($qryres) > 0){
	$count=0;
	while($contact_res = mysqli_fetch_array($qryres)){	
		$count++;
		$response['responseData'][$count] = array('city_id' => $contact_res['city_id'],'city_name' => $contact_res['city_name'],'status'=>"1");
	}
	echo json_encode($response);
}else{
	$response['status'] = "0";
        $response['message'] = "No City Found";
	echo json_encode($response);
	
}
}else{
	$response['status'] = "0";
        $response['message'] = "Select State";
	echo json_encode($response);
	exit;
}
?>