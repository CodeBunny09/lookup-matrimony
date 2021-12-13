<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
$contact_view_security=$_POST['contact_view_security'];
if($contact_view_security==""){
	$contact_view_security="Enter Contact view Security";
	$count++;
}else{
	$contact_view_security="";
}
if($count==0){
	$contact_view_security=$_POST['contact_view_security'];
	$matri_id=$_POST['matri_id'];
	$sql = "select index_id,contact_view_security,matri_id,gender from register where matri_id='$matri_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res=mysqli_fetch_object($data);
	$new_matri_id=$contact_res->index_id;
	if($new_matri_id>0){
		$contact_view_security=$_POST['contact_view_security'];
		$matri_id=$_POST['matri_id'];
		if($contact_view_security=="0"){
			$DatabaseCo->dbLink->query("update register set contact_view_security='$contact_view_security' where matri_id='$matri_id'");
			$response['status'] = "1";
			$response['message'] = "Successfully Updated";
			echo json_encode($response);
			exit;
		}else if($contact_view_security=="1"){
			$DatabaseCo->dbLink->query("update register set contact_view_security='$contact_view_security' where matri_id='$matri_id'");
			$response['status'] = "1";
			$response['message'] = "Successfully Updated";
			echo json_encode($response);
			exit;
		}else{
			$response['status'] = "0";
			$response['message'] = "Please Select Valid Option";
			echo json_encode($response);
			exit;
		}
	}else{
		$response['status'] = "0";
		$response['message'] = "No Record Found";
		echo json_encode($response);
		exit;
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
	
}

?>