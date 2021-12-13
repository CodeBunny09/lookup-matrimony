<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count=""; 
$matri_id = $_POST['matri_id'];
$count=""; 
if($_POST['matri_id']==""){
	$matri_id = $_POST['matri_id'];
	$count++;
}
if($count==0){
	$matri_id = $_POST['matri_id'];
	$se="select * from register where matri_id='$matri_id'";
	$qu=$DatabaseCo->dbLink->query($se);
	$no=mysqli_num_rows($qu);
	if($no==0){
		$response['message'] = "User Not Exit";
		$response['status'] = "0";
		echo json_encode($response);
	}else{
		$matri_id = $_POST['matri_id'];
		$insert_qry = "update register set hor_photo='' where matri_id='$matri_id'";
		$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
		unlink($site_data->web_name."/horoscope-list/".$contact_res->hor_photo);
		if(mysqli_affected_rows($DatabaseCo->dbLink) == 1){
			$response['matri_id'] = "$matri_id";
			$response['message'] ="Horoscope Deleted Successfully " ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else{
			$response['message'] = "Horoscope Not Deleted";
			$response['status'] = "0";
			echo json_encode($response);
			exit;
		}
	}
}else{
		$response['message'] = "Enter All Fields";
		$response['status'] = "0";
		echo json_encode($response);
		exit;
}

?>