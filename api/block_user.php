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
$block_matri_id=$_POST['block_matri_id'];
if($block_matri_id==""){
	$block_matri_id="Enter block_matri_id";
	$count++;
}else{
	$block_matri_id="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$block_matri_id = $_POST['block_matri_id'];
	$sql = "select * from register where matri_id='$block_matri_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$new_matri_id=$contact_res->index_id;
	if($new_matri_id > 0)	{
		$SQL_STATEMENT = "insert into block_profile (block_by,block_to,block_date) values ('$matri_id','$block_matri_id','".date('Y-m-d H:m:s')."')";
		$exe=$DatabaseCo->dbLink->query($SQL_STATEMENT) or die(mysqli_error($DatabaseCo->dbLink));
		$response['status'] = "1";
		$response['message'] = "User blocked successfully";
		echo json_encode($response);
		exit;
	}else{
	$response['status'] = "0";
	$response['message'] = "No Record Found block";
	echo json_encode($response);
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
}

?>