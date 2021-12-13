<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter Matri Id";
	$count++;
}else{
	$matri_id="";
}
$old_pass=$_POST['old_pass'];
if($old_pass==""){
	$old_pass="Enter Current Photo Password";
	$count++;
}else{
	$old_pass="";
}
$new_pass=$_POST['new_pass'];
if($new_pass==""){
	$new_pass="Enter New Photo Password";
	$count++;
}else{
	$new_pass="";
}
if($count==0){
	$old_pass=$_POST['old_pass'];
   $new_pass=$_POST['new_pass'];
	$matri_id=$_POST['matri_id'];

	$sql = "SELECT * FROM register WHERE matri_id='$matri_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$user_id=$contact_res->index_id;

	if($user_id>0){
		$photo_pswd=$contact_res->photo_pswd;
		if($photo_pswd == ""){
			$new_pass=$_POST['new_pass'];
			$matri_id=$_POST['matri_id'];
			$DatabaseCo->dbLink->query("UPDATE register set photo_pswd='".$new_pass."',photo_protect='Yes' where matri_id='$matri_id'");
			$response['status'] = "1";
			$response['matri_id'] = "$matri_id";
			$response['message'] = "Photo Password Change Successful";
			echo json_encode($response);
			exit;
		}else{
			if($photo_pswd!=$old_pass){
				$response['status'] = "0";
				$response['message'] = "Old Photo Password Does Not Match";
				echo json_encode($response);

			}else{
				$old_pass=$_POST['old_pass'];
				$new_pass=$_POST['new_pass'];
				$matri_id=$_POST['matri_id'];
				$DatabaseCo->dbLink->query("UPDATE register set photo_pswd='".$new_pass."',photo_protect='Yes' where matri_id='$matri_id'");
				$response['status'] = "1";
				$response['matri_id'] = "$matri_id";
				$response['message'] = "Photo Password Change Successful";
				echo json_encode($response);
				exit;
			}
		}
	}else{
		$response['status'] = "0";
		$response['message'] = "No Data Found";
		echo json_encode($response);
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
}

?>