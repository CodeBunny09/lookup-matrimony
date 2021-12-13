<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$groom_id=$_POST['groomid'];
$count="0";

if($count=="0"){
	$getGroomQry = $DatabaseCo->dbLink->query("SELECT matri_id,firstname,lastname,username FROM register WHERE gender='Male' ORDER BY matri_id DESC");
if(mysqli_num_rows($getGroomQry) > 0){
	$count=0;
    while($contact_res = mysqli_fetch_object($getGroomQry)){
		$count++;
		$response['responseData'][$count] = array('groom_id' => $contact_res->matri_id,'groom_name' => $contact_res->username,'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	$response['message'] = "No Groom Data Found";
	echo json_encode($response);
}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Groom Id";
	echo json_encode($response);

}

?>
