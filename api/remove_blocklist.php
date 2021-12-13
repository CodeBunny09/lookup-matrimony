<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";
$from_id=$_POST['matri_id'];
if($from_id==""){
	$from_id="Enter Matri Id";
	$count++;
}else{
	$from_id="";
}
$to_id=$_POST['block_matri_id'];
if($to_id==""){
	$to_id="Enter Block Matri Id";
	$count++;
}else{
	$to_id="";
}
if($count==0){
	$from_id=$_POST['matri_id'];
	$to_id = $_POST['block_matri_id'];
	$sql = "select * from block_profile where block_by='$from_id' and block_to='$to_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res=mysqli_fetch_object($data);
	$block_id=$contact_res->block_id;
	$count_row=mysqli_num_rows($data);
	if($block_id > 0){
		$DatabaseCo->dbLink->query("delete from block_profile where block_id='$block_id'");
		$response['status'] = "1";
		$response['message'] = "Successfully";
		echo json_encode($response);
		exit;
	}else{
		$response['status'] = "0";
		$response['message'] = "No Record Found Remove";
		echo json_encode($response);

	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Field";
	echo json_encode($response);
}

?>