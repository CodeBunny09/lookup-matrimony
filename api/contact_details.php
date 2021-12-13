<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count="";
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}

if($count==0){
	$matri_id=$_POST['matri_id'];
	$sel_own_data=$DatabaseCo->dbLink->query("select contact_view_security,matri_id,gender from register where matri_id='$matri_id'");
	if (mysqli_num_rows($sel_own_data) > 0) {
    	$count++;
		while ($contact_res = mysqli_fetch_object($sel_own_data)) {
			$mid=$contact_res->matri_id;
			$response['responseData'][$count] = array('contact_view_security' => $contact_res->contact_view_security ,'matri_id' => $mid,'status' => "1");
		}
		$response['status'] = "1";
		$response['message'] = "Success";
		echo json_encode($response);
		exit;
	}else{
	$response['status'] = "0";
	$response['message'] = "No Data Found";
	echo json_encode($response);
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
}