<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";
if($_POST['user_id']==""){
	 $user_id = $_POST['user_id'];
	 $count++;
}
if($_POST['mobile_no']==""){
	$mobile_no = $_POST['mobile_no'];
	$count++;
}

if($count==0){ 
$mobile_no = $_POST['mobile_no'];
$user_id = $_POST['user_id'];
$select="select * from register where index_id='".$user_id."'";
$query=$DatabaseCo->dbLink->query($select);
$no=mysqli_num_rows($query);
if($no==0){
    $response['status'] = "0";
	$response['message'] = "User Id Not Found";
	echo json_encode($response);
}else{
   $update="update register set mobile='$mobile_no' where index_id='".$user_id."'";
   $query=$DatabaseCo->dbLink->query($update);
   if($query){
		$response['status'] = "1";
		$response['message'] = "Mobile No Update Successfully";
		echo json_encode($response);
    }else{
		$response['status'] = "0";
		$response['message'] = "Mobile Not Update";
		echo json_encode($response);
    }
}
}else{
    $response['status'] = "0";
	$response['message'] = "Enter Mobile No And User Id";
	echo json_encode($response);
	exit;
}


?>