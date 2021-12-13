<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$user_id=$_POST['user_id'];
if($user_id==""){
	$user_id="Enter user_id";
	$count++;
}else{
	$user_id="";
}
if($count==0){
	$user_id=$_POST['user_id'];
	$qu=$DatabaseCo->dbLink->query("select index_id from register where index_id='$user_id'");
	$no=mysqli_num_rows($qu);
	if($no==0){
	    $response['message'] = "User Not Exist";
		$response['status'] = "0";
		echo json_encode($response);
	}else{
		global $path;
    	$image=$_FILES["image_path"]["name"];   
	 	$target_dir = $_SERVER['DOCUMENT_ROOT'].$path."/my_photos/";
	 	$target_dir1 = $_SERVER['DOCUMENT_ROOT'].$path."/my_photos_big/";
		$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
	 	$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
		$target_file_name = $target_dir.basename($img_name);
		$target_file_name1 = $target_dir1.basename($img_name);
		$response = array();
   		if (move_uploaded_file($_FILES["image_path"]["tmp_name"],$target_file_name)) {
    		$DatabaseCo->dbLink->query("UPDATE register SET photo1 ='$img_name',photo_view_status='1',photo_protect='No' where index_id='$user_id'");
			$response['status'] = "1";
			$response['user_id'] = "$user_id";
			$response['message'] = "User Successfully Update";
			echo json_encode($response);
   		}else{
        	$response['status'] = "0";
			$response['message'] = "User Not Update";
			echo json_encode($response);
   		}
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter User Id";
	echo json_encode($response);
	
}

?>