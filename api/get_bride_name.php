<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$bride_id=$_POST['brideid'];
$count="0";

if($count=="0"){
	$getBrideQry = $DatabaseCo->dbLink->query("SELECT matri_id,firstname,lastname,username FROM register WHERE gender='Female' ORDER BY matri_id DESC");
if(mysqli_num_rows($getBrideQry) > 0){
	$count=0;
    while($contact_res = mysqli_fetch_object($getBrideQry)){
		$count++;
		$response['responseData'][$count] = array('bride_id' => $contact_res->matri_id,'bride_name' => $contact_res->username,'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	$response['message'] = "No Bride Data Found";
	echo json_encode($response);
}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Bride Id";
	echo json_encode($response);

}

?>
