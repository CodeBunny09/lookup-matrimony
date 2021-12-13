<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
if(isset($_POST['country_id'])){
	$country_id=$_POST['country_id'];
	//$selqry = "SELECT * FROM `country` c1,state c2 where c1.country_code=c2.country_code and c1.country_id='".$country_id."' ORDER BY state_name ASC";
	$selqry="SELECT * FROM state_view WHERE cnt_id='$country_id' and status='APPROVED' ORDER BY state_name ASC";
$qryres = $DatabaseCo->dbLink->query($selqry);
if(mysqli_num_rows($qryres) > 0){
	$count=0;
	while($contact_res = mysqli_fetch_array($qryres)){
		$count++;
		$response['responseData'][$count] = array('state_id' => $contact_res['state_id'],'state_name' => $contact_res['state_name'],'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
        $response['message'] = "No State Found";
	echo json_encode($response);
	exit;
}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Select Country";
	echo json_encode($response);
}
?>