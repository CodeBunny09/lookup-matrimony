<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count=""; 
$matri_id = $_POST['matri_id'];
$count=""; 
if($_POST['matri_id']==""){
	$matri_id = $_POST['matri_id'];
	$count++;
}
if($_POST['index']==""){
	$index = $_POST['index'];
	$count++;
}

if($count==0){
	$matri_id = $_POST['matri_id'];
	$qu=$DatabaseCo->dbLink->query("select * from register where matri_id='$matri_id'");
	$no=mysqli_num_rows($qu);
	if($no==0){
		$response['message'] = "User Record Not Found";
		$response['status'] = "0";
		echo json_encode($response);
	}else{
		global $path;
		$target_dir = $_SERVER['DOCUMENT_ROOT'].$path."/my_photos/";
		$target_file_name = $target_dir.basename($_FILES["image_path"]["name"]);
		$response = array();
		$matri_id = $_POST['matri_id'];
		$index=$_POST['index'];
		if($index=="1"){
			if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file_name)){
				$target_file_name2 = basename($_FILES["image_path"]["name"]);
				$target_file_name=$target_file_name2;
				$DatabaseCo->dbLink->query("UPDATE register SET photo1='$target_file_name',photo1_approve='UNAPPROVED',photo_view_status='1',photo_protect='No' where matri_id='$matri_id'");
				$response['status'] = "1";
				$response['image'] = "$target_file_name";
				$response['message'] = "Photo Successfully Update";
				echo json_encode($response);
			}else{
				$response['status'] = "0";
				$response['message'] = "Photo Not Update";
				echo json_encode($response);
			}
		}else if($index=="2"){
			if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file_name)) {
				$target_file_name2 = basename($_FILES["image_path"]["name"]);
				$target_file_name=$target_file_name2;
				$DatabaseCo->dbLink->query("UPDATE register SET  photo2='$target_file_name',photo2_approve='UNAPPROVED' where matri_id='$matri_id'");
				$response['status'] = "1";
				$response['image'] = "$target_file_name";
				$response['message'] = "Photo Successfully Update";
				echo json_encode($response);
			}else{
				$response['status'] = "0";
				$response['message'] = "Photo Not Update";
				echo json_encode($response);
			}
		}
		else if($index=="3"){
			if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file_name)) {
				$target_file_name2 = basename($_FILES["image_path"]["name"]);
				$target_file_name=$target_file_name2;
				$DatabaseCo->dbLink->query("UPDATE register SET  photo3='$target_file_name',photo3_approve='UNAPPROVED' where matri_id='$matri_id'");
				$response['status'] = "1";
				$response['image'] = "$target_file_name";
				$response['message'] = "Photo Successfully Update";
				echo json_encode($response);
			}else{
				$response['status'] = "0";
				$response['message'] = "Photo Not Update";
				echo json_encode($response);
			}
		}else if($index=="4"){
			if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file_name)) {
				$target_file_name2 = basename($_FILES["image_path"]["name"]);
				$target_file_name=$target_file_name2;
				$DatabaseCo->dbLink->query("UPDATE register SET  photo4='$target_file_name',photo4_approve='UNAPPROVED' where matri_id='$matri_id'");
				$response['status'] = "1";
				$response['image'] = "$target_file_name";
				$response['message'] = "Photo Successfully Update";
				echo json_encode($response);
			}else{
				$response['status'] = "0";
				$response['message'] = "Photo Not Update";
				echo json_encode($response);
			}
		}else if($index=="5"){
			if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file_name)) {
				$target_file_name2 = basename($_FILES["image_path"]["name"]);
				$target_file_name=$target_file_name2;
				$DatabaseCo->dbLink->query("UPDATE register SET  photo5='$target_file_name',photo5_approve='UNAPPROVED' where matri_id='$matri_id'");
				$response['status'] = "1";
				$response['image'] = "$target_file_name";
				$response['message'] = "Photo Successfully Update";
				echo json_encode($response);
			}else{
				$response['status'] = "0";
				$response['message'] = "Photo Not Update";
				echo json_encode($response);
			}
		}else if($index=="6"){
			if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file_name)) {
				$target_file_name2 = basename($_FILES["image_path"]["name"]);
				$target_file_name=$target_file_name2;
				$DatabaseCo->dbLink->query("UPDATE register SET  photo6='$target_file_name',photo6_approve='UNAPPROVED' where matri_id='$matri_id'");
				$response['status'] = "1";
				$response['image'] = "$target_file_name";
				$response['message'] = "Photo Successfully Update";
				echo json_encode($response);
			}else{
				$response['status'] = "0";
				$response['message'] = "Photo Not Update";
				echo json_encode($response);
			}
		}else{
			$response['message'] ="No More Photo Update" ;
			$response['status'] = "0";
			echo json_encode($response);
		}
	}
	}else{
		$response['message'] = "Enter All Fields";
		$response['status'] = "0";
		echo json_encode($response);
		exit;
}
?>
