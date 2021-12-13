<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count=0;
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
$gender=$_POST['gender'];
if($gender==""){
	$gender="Enter gender";
	$count++;
}else{
	$gender="";
}
if($count==0){
	$gender=$_POST['gender'];
	$matri_id=$_POST['matri_id'];
	$sel_own_data = $DatabaseCo->dbLink->query("select * from reminder where receiver_id='".$matri_id."' and reminder_view_status='Yes' ORDER BY rem_id DESC");
	if (mysqli_num_rows($sel_own_data) > 0) {
		$count=0;
		
		$not_count=mysqli_num_rows($sel_own_data);
		$response['responseData'] = array('matri_id' =>$matri_id,'notification_count' => "$not_count",'status'=>"1");
$response['status'] = "1";
$response['message'] = "Success";
echo json_encode($response);
exit;
}else{
$response['status'] = "0";
$response['message'] = "No Data Found";
echo json_encode($response);
}
}
else
{
$response['status'] = "0";
$response['message'] = "Please Enter All Fields";
echo json_encode($response);
}
?>
