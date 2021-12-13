<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count="";
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri id";
	$count++;
}else{
	$matri_id="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$get_msg=$DatabaseCo->dbLink->query("select * from  register where matri_id='$matri_id'");
	if (mysqli_num_rows($get_msg) > 0) {
		$count=0;
		while ($contact_res = mysqli_fetch_object($get_msg)) {
			if($contact_res->photo1_approve == 'UNAPPROVED' && $contact_res->photo1 !='' ){
				if($contact_res->gender=="Female"){
					$photo1=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
				}else{
					$photo1=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
				}
			}else {
				if(($contact_res->photo1!="" && $contact_res->photo1_approve=='APPROVED') && (($contact_res->photo_view_status=='1') || ($contact_res->photo_view_status=='2' && $contact_res->status=='Paid')) && (($contact_res->photo_protect=='No') || ($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd==''))){
							$photo1=$site_data->web_name."/my_photos/".$contact_res->photo1;
				}elseif($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd!=''){
					if($contact_res->gender=='Male'){
						$photo1=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
					}else{
						$photo1=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}elseif($contact_res->gender=='Male'){
					$photo1=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
				}else{
					$photo1=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
				}
			}
			if($contact_res->photo2_approve == 'UNAPPROVED' && $contact_res->photo2 !='' ){
				if($contact_res->gender=="Female"){
					$photo2=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
				}else{
					$photo2=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
				}
			}else {
				if(($contact_res->photo2!="" && $contact_res->photo1_approve=='APPROVED') && (($contact_res->photo_view_status=='1') || ($contact_res->photo_view_status=='2' && $contact_res->status=='Paid')) && (($contact_res->photo_protect=='No') || ($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd==''))){
							$photo2=$site_data->web_name."/my_photos/".$contact_res->photo2;
				}elseif($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd!=''){
					if($contact_res->gender=='Male'){
						$photo2=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
					}else{
						$photo2=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}elseif($contact_res->gender=='Male'){
					$photo2=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
				}else{
					$photo2=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
				}
			}
			if($contact_res->photo3_approve == 'UNAPPROVED' && $contact_res->photo3 !='' ){
				if($contact_res->gender=="Female"){
					$photo3=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
				}else{
					$photo3=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
				}
			}else {
				if(($contact_res->photo3!="" && $contact_res->photo3_approve=='APPROVED') && (($contact_res->photo_view_status=='1') || ($contact_res->photo_view_status=='2' && $contact_res->status=='Paid')) && (($contact_res->photo_protect=='No') || ($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd==''))){
							$photo3=$site_data->web_name."/my_photos/".$contact_res->photo3;
				}elseif($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd!=''){
					if($contact_res->gender=='Male'){
						$photo3=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
					}else{
						$photo3=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}elseif($contact_res->gender=='Male'){
					$photo3=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
				}else{
					$photo3=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
				}
			}
			if($contact_res->photo4_approve == 'UNAPPROVED' && $contact_res->photo4 !='' ){
				if($contact_res->gender=="Female"){
					$photo4=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
				}else{
					$photo4=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
				}
			}else {
				if(($contact_res->photo4!="" && $contact_res->photo4_approve=='APPROVED') && (($contact_res->photo_view_status=='1') || ($contact_res->photo_view_status=='2' && $contact_res->status=='Paid')) && (($contact_res->photo_protect=='No') || ($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd==''))){
							$photo4=$site_data->web_name."/my_photos/".$contact_res->photo4;
				}elseif($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd!=''){
					if($contact_res->gender=='Male'){
						$photo4=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
					}else{
						$photo4=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}elseif($contact_res->gender=='Male'){
					$photo4=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
				}else{
					$photo4=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
				}
			}
			if($contact_res->photo5_approve == 'UNAPPROVED' && $contact_res->photo5 !='' ){
				if($contact_res->gender=="Female"){
					$photo5=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
				}else{
					$photo5=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
				}
			}else {
				if(($contact_res->photo5!="" && $contact_res->photo5_approve=='APPROVED') && (($contact_res->photo_view_status=='1') || ($contact_res->photo_view_status=='2' && $contact_res->status=='Paid')) && (($contact_res->photo_protect=='No') || ($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd==''))){
							$photo5=$site_data->web_name."/my_photos/".$contact_res->photo5;
				}elseif($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd!=''){
					if($contact_res->gender=='Male'){
						$photo5=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
					}else{
						$photo5=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}elseif($contact_res->gender=='Male'){
					$photo5=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
				}else{
					$photo5=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
				}
			}
			if($contact_res->photo6_approve == 'UNAPPROVED' && $contact_res->photo6 !='' ){
				if($contact_res->gender=="Female"){
					$photo6=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
				}else{
					$photo6=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
				}
			}else {
				if(($contact_res->photo6!="" && $contact_res->photo5_approve=='APPROVED') && (($contact_res->photo_view_status=='1') || ($contact_res->photo_view_status=='2' && $contact_res->status=='Paid')) && (($contact_res->photo_protect=='No') || ($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd==''))){
							$photo6=$site_data->web_name."/my_photos/".$contact_res->photo6;
				}elseif($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd!=''){
					if($contact_res->gender=='Male'){
						$photo6=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
					}else{
						$photo6=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}elseif($contact_res->gender=='Male'){
					$photo6=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
				}else{
					$photo6=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
				}
			}
			/*if($contact_res->photo1 !=''){
				$photo1=$site_data->web_name."/my_photos/".$contact_res->photo1;
			}else{
				if($contact_res->gender=="Female"){
					$photo1=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
				}else{
					$photo1=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
				}
			}*/
			
		$count++;
		$response['responseData'][$count] = array('user_id' => $contact_res->index_id,'matri_id' => $contact_res->matri_id,'photo1' =>"$photo1",'photo2' =>"$photo2",'photo3' =>"$photo3",'photo4' =>"$photo4",'photo5' =>"$photo5",'photo6' =>"$photo6", 'user_profile_picture' =>"$photo1",'username' => $contact_res->username,'status'=>"1");
		}
		$response['status'] = "1";
		$response['message'] = "Successfully";
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
