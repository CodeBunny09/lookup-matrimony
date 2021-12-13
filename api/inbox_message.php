<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$site_que = $DatabaseCo->dbLink->query("SELECT * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count="";
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$get_msg=$DatabaseCo->dbLink->query("SELECT * from messages WHERE to_id='$matri_id' order by messages.mes_id desc");
	if (mysqli_num_rows($get_msg) > 0) {
		$count=0;
		while ($contact_res = mysqli_fetch_object($get_msg)) {
			$member_id=$contact_res->from_id;
			$get_det=$DatabaseCo->dbLink->query("SELECT * from register WHERE matri_id='$member_id'");
			$user_det = mysqli_fetch_object($get_det);
			$favourite=$contact_res->msg_important_status;
			if($favourite=="No"){
				$favourite=0;
			}else{
				$favourite=1;
			}
			
			if(isset($user_det)){
				if($user_det->photo1_approve == 'UNAPPROVED' && $user_det->photo1 !='' ){
					if($user_det->gender=="Female"){
						$photo=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
					}else{
						$photo=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
					}
				}else {
					if(($user_det->photo1!="" && $user_det->photo1_approve=='APPROVED') && (($user_det->photo_view_status=='1') || ($user_det->photo_view_status=='2' && $user_det->status=='Paid')) && (($user_det->photo_protect=='No') || ($user_det->photo_protect=="Yes" && $user_det->photo_pswd==''))){
						$photo=$site_data->web_name."/my_photos/".$user_det->photo1;
					}elseif($user_det->photo_protect=="Yes" && $user_det->photo_pswd!=''){
						if($user_det->gender=='Male'){
							$photo=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
						}else{
							$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
						}
					}elseif($user_det->gender=='Male'){
						$photo=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
					}else{
						$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}
			}
			$status = $user_det->status;
			if($status=="Paid"){
				$st="1";
			}else{
				$st="0";
			}
			if($site_data->username_setting == 'full_username'){
				$name=$user_det->username;
			}elseif($site_data->username_setting == 'first_surname'){
				$name=$user_det->firstname." ".substr($user_det->lastname, 0, 1);
			}else{
				$name='';
			}
			$count++;
			$response['responseData'][$count] = array('mes_id' => $contact_res->mes_id,'msg_important_status' =>"$favourite",'from_id' => $contact_res->from_id,'to_id' => $contact_res->to_id,'subject' => $contact_res->subject,'message' => $contact_res->message,'sent_date' => $contact_res->sent_date,'username' => "$name",'user_profile_picture' => "$photo",'msg_status' => $contact_res->msg_status,'member_status'=>"$st",'is_favourite'=>"$favourite",'status'=>"1");
	}
	$response['status'] = "1";
	$response['message'] = "Success";
	echo json_encode($response);
	exit;
}
else
{
	$response['status'] = "0";
	$response['message'] = "No Data Found";
	echo json_encode($response);
	
}
}
else
{
	$response['status'] = "0";
	$response['message'] = "Please Enter User Id";
	echo json_encode($response);
	
}

?>