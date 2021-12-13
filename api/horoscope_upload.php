<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
include_once 'photo_upload_path.php';


$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter Matri id";
	$count++;
}else{
	$matri_id="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$qu=$DatabaseCo->dbLink->query("select matri_id from register where matri_id='$matri_id'");
	$no=mysqli_num_rows($qu);
	if($no==0){
	    $response['message'] = "User Not Exit";
		$response['status'] = "0";
		echo json_encode($response);
	}else{
		global $path;
		$target_dir = $_SERVER['DOCUMENT_ROOT'].$path."/horoscope-list/";
		$target_file_name = $target_dir.basename($_FILES["image_path"]["name"]);
		$response = array();
	   if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file_name)) {
			$target_file_name2 = basename($_FILES["image_path"]["name"]);
			$target_file_name=$target_file_name2;
			$DatabaseCo->dbLink->query("UPDATE register SET hor_photo='$target_file_name' where matri_id='$matri_id'");
			$response['status'] = "1";
			$response['user_id'] = "$matri_id";
			$response['message'] = "Horoscope Uploaded Successfully";
			echo json_encode($response);
   		}else{
			$response['status'] = "0";
			$response['message'] = "Horoscope not uploaded";
			echo json_encode($response);
   		}
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri id";
	echo json_encode($response);
	
}

?>