<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
$photo_view_status=$_POST['photo_view_status'];
if($photo_view_status==""){
	$photo_view_status="Enter photo_view_status";
	$count++;
}else{
	$photo_view_status="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$photo_view_status=$_POST['photo_view_status'];
	if($photo_view_status=="0"){
		$DatabaseCo->dbLink->query("update register set photo_view_status='$photo_view_status' where matri_id='$matri_id'");
		$response['status'] = "1";
		$response['matri_id'] = "$matri_id";
		$response['photo_view_status'] = "0";
		$response['message'] = "Successfully";
		echo json_encode($response);
		exit;
	}else if($photo_view_status=="1"){
		$DatabaseCo->dbLink->query("update register set photo_view_status='$photo_view_status' where matri_id='$matri_id'");
		$response['status'] = "1";
		$response['matri_id'] = "$matri_id";
		$response['photo_view_status'] = "1";
		$response['message'] = "Successfully";
		echo json_encode($response);
		exit;
	}else if($photo_view_status=="2"){
		$DatabaseCo->dbLink->query("update register set photo_view_status='$photo_view_status' where matri_id='$matri_id'");
		$response['status'] = "1";
		$response['matri_id'] = "$matri_id";
		$response['message'] = "Successfully";
		$response['photo_view_status'] = "2";
		echo json_encode($response);
		exit;
	}else{
		$response['status'] = "0";
		$response['message'] = "Please Select Valid Option";
		echo json_encode($response);

}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
	
}

?>