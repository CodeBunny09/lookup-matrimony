<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count="";
$matri_id = $_POST['matri_id'];
$image_path = $_POST['image_path'];
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
	$se="select * from register where matri_id='$matri_id'";
	$qu=$DatabaseCo->dbLink->query($se);
	$get_data=mysqli_fetch_object($qu);
	$no=mysqli_num_rows($qu);
	if($no==0){
	    $response['message'] = "No Record Found";
		$response['status'] = "0";
		echo json_encode($response);
	}else{
		$index = $_POST['index'];
		$matri_id = $_POST['matri_id'];
		if($index=="1"){
			$insert_qry = "update register set photo1='',photo1_approve='UNAPPROVED' where matri_id='$matri_id'";
			$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
			unlink($site_data->web_name."/my_photos/".$get_data->photo1);
			$response['matri_id'] = "$matri_id";
			$response['message'] ="Photo Deleted Successfully" ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else if($index=="2"){
			$insert_qry = "update register set photo2='' where matri_id='$matri_id'";
			$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
			unlink($site_data->web_name."/my_photos/".$get_data->photo2);
			$response['matri_id'] = "$matri_id";
			$response['message'] ="Photo Deleted Successfully" ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else if($index=="3"){
			$insert_qry = "update register set photo3='' where matri_id='$matri_id'";
			$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
			unlink($site_data->web_name."/my_photos/".$get_data->photo3);
			$response['matri_id'] = "$matri_id";
			$response['message'] ="Photo Deleted Successfully" ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else if($index=="4"){
			$insert_qry = "update register set photo4='' where matri_id='$matri_id'";
			$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
			unlink($site_data->web_name."/my_photos/".$get_data->photo4);
			$response['matri_id'] = "$matri_id";
			$response['message'] ="Photo Deleted Successfully" ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else if($index=="5"){
			$insert_qry = "update register set photo5='' where matri_id='$matri_id'";
			$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
			unlink($site_data->web_name."/my_photos/".$get_data->photo5);
			$response['matri_id'] = "$matri_id";
			$response['message'] ="Photo Deleted Successfully" ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else if($index=="6"){
			$insert_qry = "update register set photo6='' where matri_id='$matri_id'";
			$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
			unlink($site_data->web_name."/my_photos/".$get_data->photo6);
			$response['matri_id'] = "$matri_id";
			$response['message'] ="Photo Deleted Successfully" ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else{
			$response['message'] ="Photo Not Available" ;
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