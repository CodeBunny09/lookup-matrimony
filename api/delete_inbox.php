<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mes_id=$_POST['mes_id'];
if($mes_id==""){
	$mes_id="Enter mes_id";
	$count++;
}else{
	$mes_id="";
}
if($count==0){
	$mes_id=$_POST['mes_id'];
	$sql = "SELECT * from messages where mes_id='$mes_id'"; 
	$data = $DatabaseCo->dbLink->query($sql);
	$contact_res =  mysqli_fetch_object($data);
	$mes_id=$contact_res->mes_id;
	if($mes_id>0){
        $DatabaseCo->dbLink->query("delete from  messages where mes_id='$mes_id'");
        $response['status'] = "1";
		$response['message'] = "Message Successfully Deleted";
		echo json_encode($response);
		exit;
	}else{
        $response['status'] = "0";
		$response['message'] = "No Record Found";
		echo json_encode($response);
	}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Field";
	echo json_encode($response);
	
}

?>