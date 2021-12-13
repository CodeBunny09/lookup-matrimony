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
		while ($res = mysqli_fetch_object($sel_own_data)) {
		$sender_id=$res->sender_id;
		$get_data = $DatabaseCo->dbLink->query("select index_id,matri_id,photo1,photo1_approve,photo_view_status,photo_protect,photo_pswd,gender from register_view where matri_id!='$sender_id' and gender!='$gender' and status!='Inactive' and status!='Suspendade' order by reg_date desc");
		$sender_data = mysqli_fetch_object($get_data);	
			
		if ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Pending') {
                      $notification= "Express Interest received from " . $res->sender_id . ".";
					  $msg_type='exp_interest';
       } elseif ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Accept') {
               		 $notification= "Express Interest accepted from " . $res->sender_id . ".";
					$msg_type='exp_interest';
       }
      if ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Reject') {
                   $notification= "Express Interest rejected from " . $res->sender_id . ".";
		  			$msg_type='exp_interest';
       }
       if ($res->reminder_mes_type == 'msg' && $res->reminder_msg == 'Send') {
               $notification= "Message received from " . $res->sender_id . ".";
		   		$msg_type='msg';
       }
       if ($res->reminder_mes_type == 'photo_req' && $res->reminder_msg == 'Sent') {
             $notification= "Photo request received from " . $res->sender_id . ".";
		   $msg_type='photo_req';
       }
       if ($res->reminder_mes_type == 'chk_contact' && $res->reminder_msg == 'check') {
             $notification= "Contact Details check from " . $res->sender_id . ".";
		   	$msg_type='chk_contact';
        }
       if ($res->reminder_mes_type == 'photo_pass_req' && $res->reminder_msg == 'Sent') {
             $notification= "Photo password request received from " . $res->sender_id . ".";
		   $msg_type='photo_pass_req';
        }
			
			if(isset($sender_data )){
				if($sender_data ->photo1_approve == 'UNAPPROVED' && $sender_data ->photo1 !='' ){
					if($sender_data ->gender=="Female"){
						$photo=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
					}else{
						$photo=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
					}
				}else {
					if(($sender_data ->photo1!="" && $sender_data ->photo1_approve=='APPROVED') && (($sender_data ->photo_view_status=='1') || ($sender_data ->photo_view_status=='2' && $sender_data ->status=='Paid')) && (($sender_data ->photo_protect=='No') || ($sender_data ->photo_protect=="Yes" && $sender_data ->photo_pswd==''))){
						$photo=$site_data->web_name."/my_photos/".$sender_data ->photo1;
					}elseif($sender_data ->photo_protect=="Yes" && $sender_data ->photo_pswd!=''){
						if($sender_data ->gender=='Male'){
							$photo=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
						}else{
							$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
						}
					}elseif($sender_data ->gender=='Male'){
						$photo=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
					}else{
						$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}
			}

	$count++;
	$response['responseData'][$count] = array('user_id' => $sender_id,'matri_id' =>$sender_id,'notification' => "$notification",'user_profile_picture' =>"$photo",'status'=>"1",'notification_type'=>"$msg_type");
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
