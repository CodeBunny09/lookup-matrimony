<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
include_once 'photo_upload_path.php';
$count="";

if($_POST['brideid']==""){
	 $brideid = $_POST['brideid'];
	 $count++;
}
if($_POST['bridename']==""){
	$bridename = $_POST['bridename'];
	$count++;
}
if($_POST['groomid']==""){
	$groomid = $_POST['groomid'];
	$count++;
}
if($_POST['groomname']==""){
	$groomname = $_POST['groomname'];
	$count++;
}
if($_POST['engagementdate']==""){
	$engagementdate = $_POST['engagementdate'];
	$count++;
}
if($_POST['marriagedate']==""){
	$marriagedate = $_POST['marriagedate'];
	$count++;
}
if($_POST['succstory']==""){
	$succstory = $_POST['succstory'];
	$count++;
}
if($_POST['country']==""){
	$country = $_POST['country'];
	$count++;
}

if($count==0){
	global $path;
	$brideid = $_POST['brideid'];
	$bridename = $_POST['bridename'];
	$groomid = $_POST['groomid'];
	$groomname = $_POST['groomname'];
	$engagementdate = $_POST['engagementdate'];
	$marriagedate = $_POST['marriagedate'];
	$succstory = $_POST['succstory'];
	$address = $_POST['address'];
	$country = $_POST['country'];
	
  $image=$_FILES["image_path"]["name"];   
	$target_dir = $_SERVER['DOCUMENT_ROOT'].$path."/SuccessStory/";
	$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
	$weddingphoto=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file_name = $target_dir.basename($weddingphoto);
	$response = array();
	if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file_name)) {
			$target_file_name2 = basename($_FILES["image_path"]["name"]);
			$target_file_name=$target_file_name2;
			$sql="insert into success_story(`weddingphoto`, `bridename`, `brideid`, `groomname`, `groomid`, `engagement_date`, `marriagedate`, `address`, `country`,`successmessage`, `status`,`fstatus`) values('$weddingphoto','$bridename','$brideid','$groomname','$groomid','$engagementdate','$marriagedate','$address','$country','$successmessage','UNAPPROVED','0')";
			$ins_story = $DatabaseCo->dbLink->query($sql);
			$response['status'] = "1";
			$response['message'] = "Success Story Posted Successfully";
			echo json_encode($response);
   		}else{
			$response['status'] = "0";
			$response['message'] = "Please Enter All Fields";
			echo json_encode($response);
   		}

}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
	
}

?>