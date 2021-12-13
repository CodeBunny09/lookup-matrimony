<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count="";
$sender_id=$_POST['matri_id'];
if($sender_id=""){
	$sender_id="Enter sender id";
	$count++;
}else{
	$sender_id="";
}
if($count==0){
	$sender_id=$_POST['matri_id'];
	$GET_INTEREST_SENT=$DatabaseCo->dbLink->query("SELECT * FROM register a LEFT JOIN expressinterest b ON a.matri_id = b.ei_receiver WHERE b.ei_sender='$sender_id' AND b.trash_sender!='Yes' ORDER BY b.ei_id DESC");
	if (mysqli_num_rows($GET_INTEREST_SENT) > 0) {
		$count="";
		while ($contact_res = mysqli_fetch_object($GET_INTEREST_SENT)) {
		$matri_id=$contact_res->matri_id;
		// Get blocked user or blocked by us member details
		$GET_BLOCK_QUERY = $DatabaseCo->dbLink->query("SELECT * from block_profile WHERE block_by='$matri_id' OR block_to='$matri_id'");
		$BLOCK_USER = mysqli_fetch_object($GET_BLOCK_QUERY);
		$block_id=$BLOCK_USER->block_id;
		if($block_id==""){
			$block="0";
		}else{
			$block="1";
		}
		// Get user image
		if(isset($contact_res)){
				if($contact_res->photo1_approve == 'UNAPPROVED' && $contact_res->photo1 !='' ){
					if($contact_res->gender=="Female"){
						$photo=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
					}else{
						$photo=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
					}
				}else {
					if(($contact_res->photo1!="" && $contact_res->photo1_approve=='APPROVED') && (($contact_res->photo_view_status=='1') || ($contact_res->photo_view_status=='2' && $contact_res->status=='Paid')) && (($contact_res->photo_protect=='No') || ($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd==''))){
						$photo=$site_data->web_name."/my_photos/".$contact_res->photo1;
					}elseif($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd!=''){
						if($contact_res->gender=='Male'){
							$photo=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
						}else{
							$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
						}
					}elseif($contact_res->gender=='Male'){
						$photo=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
					}else{
						$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}
			}
		$status = $contact_res->status;
		if($status=="Paid"){
			$st="1";
		}else{
			$st="0";
		}
			if($site_data->username_setting == 'full_username'){
				$name=$contact_res->username;
			}elseif($site_data->username_setting == 'first_surname'){
				$name=$contact_res->firstname." ".substr($contact_res->lastname, 0, 1);
			}else{
				$name='';
			}
		$count++;
		$response['responseData'][$count] = array('tokan' => $contact_res->tokan,'user_id' => $contact_res->index_id,'ei_id' => $contact_res->ei_id,'matri_id' => $contact_res->matri_id,'gender' => $contact_res->gender,'username' => "$name",'matri_id' => $contact_res->matri_id,'user_profile_picture' =>"$photo",'receiver_response'=>$contact_res->receiver_response,'ei_sent_date'=>$contact_res->ei_sent_date,'member_status'=>"$st",'is_blocked' => "$block",'status'=>"1");
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
}else{
$response['status'] = "0";
$response['message'] = "Please Enter Matri Id";
echo json_encode($response);
}
?>