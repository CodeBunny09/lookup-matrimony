<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$religion_id=$_POST['religion_id'];
$count="0";
if($religion_id==""){
	$religion_id_err="Enter religion";
	$count++;
}else{
	$religion_id_err="";
}
if($count=="0"){
	$getCasteQry = $DatabaseCo->dbLink->query("SELECT * FROM caste where religion_id ='".$religion_id."' AND status='APPROVED'");
if(mysqli_num_rows($getCasteQry) > 0){
	$count=0;
    while($contact_res = mysqli_fetch_object($getCasteQry)){
		$count++;
		$response['responseData'][$count] = array('caste_id' => $contact_res->caste_id,'caste_name' => $contact_res->caste_name,'status'=>"1");
	}
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	$response['message'] = "No Caste Data Found";
	echo json_encode($response);
}
}else{
	$response['status'] = "0";
	$response['message'] = "Please Set Religion Id";
	echo json_encode($response);

}

?>
