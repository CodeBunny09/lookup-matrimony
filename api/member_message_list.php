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
	$sel_own_data = $DatabaseCo->dbLink->query("SELECT index_id,gender,username,matri_id,tokan,status,firstname,lastname FROM register_view WHERE matri_id!='$matri_id' AND gender!='$gender' AND status!='Inactive' AND status!='Suspendade'");
	if (mysqli_num_rows($sel_own_data) > 0) {
		$count=0;
		while ($contact_res = mysqli_fetch_object($sel_own_data)) {
			$matri_id = $contact_res->matri_id;
			$login_id=$_POST['matri_id'];
			
			// Check Blocked or not
			$GET_BLOCK_LIST = $DatabaseCo->dbLink->query("SELECT * FROM block_profile WHERE block_by='$login_id' AND block_to='$matri_id'"); 
			if(mysqli_num_rows($GET_BLOCK_LIST) > 0){
				$getblockdata =  mysqli_fetch_object($GET_BLOCK_LIST);
				$block_id=$getblockdata->block_id;
				if($block_id==""){
					$block="0";
				}else{
					$block="1";
				}
			}else{
				$block="0";
			}
			
			// Check Shortlisted or not
			$GET_SHORT_LIST = $DatabaseCo->dbLink->query("SELECT * FROM shortlist WHERE from_id='$login_id' AND to_id='$matri_id'");
			if(mysqli_num_rows($GET_SHORT_LIST) > 0){
				$getshortdata =  mysqli_fetch_object($GET_SHORT_LIST);
				$sh_id=$getshortdata->sh_id;
				if($sh_id==""){
					$sh="0";
				}else{
					$sh="1";
				}
			}else{
				$sh="0";
			}
			
			if($site_data->username_setting == 'full_username'){
				$name=$contact_res->username;
			}elseif($site_data->username_setting == 'first_surname'){
				$name=$contact_res->firstname." ".substr($contact_res->lastname, 0, 1);
			}else{
				$name='';
			}
		$count++;
		$response['responseData'][$count] = array('user_id' => $contact_res->index_id,'matri_id' => $contact_res->matri_id,'username' => "$name",'gender' => $contact_res->gender,'status'=>"1",'tokan'=>"$contact_res->tokan");
}
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
