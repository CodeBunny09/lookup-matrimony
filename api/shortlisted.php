<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count="";
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
$gender=$_POST['gender'];
if($gender==""){
	$gender="Enter Gender";
	$count++;
}else{
	$gender="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$gender=$_POST['gender'];
	
	$sel_own_data = $DatabaseCo->dbLink->query("select birthdate,ocp_name,height,city_name,country_name,state_name,photo1_approve,photo1,photo_view_status,photo_protect,photo_pswd,gender,username,matri_id,religion_name,caste_name,edu_detail,tokan,status,firstname,lastname from register_view JOIN shortlist ON shortlist.to_id=register_view.matri_id WHERE from_id='$matri_id' AND gender!='$gender' ORDER BY reg_date DESC ");
	 
if (mysqli_num_rows($sel_own_data) > 0) {
	$count=0;
	while ($contact_res =  mysqli_fetch_object($sel_own_data)) {
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
			
			// Check interest sent or not
			$GET_INTEREST_LIST = $DatabaseCo->dbLink->query("SELECT * FROM expressinterest WHERE ei_sender='$login_id' AND ei_receiver='$matri_id'");
			if(mysqli_num_rows($GET_INTEREST_LIST) > 0){
				$getinsertdata = mysqli_fetch_object($GET_INTEREST_LIST);
				$ei_id=$getinsertdata->ei_id;
				if($ei_id==""){
					$mes="0";
				}else{
					$mes="1";
				}
			}else{
				$mes="0";
			}
		$ao3 = $contact_res->height;
		$ft3 = (int) ($ao3 / 12);
		$inch3 = $ao3 % 12;
		$height=$ft3 . "ft" . " " . $inch3 . "in";
		$age=floor((time() - strtotime($contact_res->birthdate)) / 31556926);
		$ocp8 = $contact_res->ocp_name;
		$country_name8= $contact_res->country_name;
		$state8= $contact_res->state_name;
		$city8= $contact_res->city_name;
		$edu_detail = $contact_res->edu_detail;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `education_detail` WHERE  edu_id  in ($edu_detail)");
		$edu_name3 = array();
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
				$edu_name3[] = $contact_res1->edu_name;
		}
		$edu5=implode(",",$edu_name3);
		$ed= explode(",",$edu5);
		$edu_fname=$ed[0];
		$add_fname=$ed[1];
		$re = $contact_res->religion_name;
		$ca = $contact_res->caste_name;
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
			$all="$age"."Yrs,"."$height".","."$add_fname".","."$re".","."$ca".","."$city8".","."$country_name8";
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
				$response['responseData'][$count] = array('matri_id' => $contact_res->matri_id,'birthdate' => $contact_res->birthdate,'ocp_name' => $contact_res->ocp_name,'height' => $contact_res->height,'city_name' => $contact_res->city_name,'country_name' => $contact_res->country_name,'photo1_approve' => $contact_res->photo1_approve,'photo_view_status' => $contact_res->photo_view_status,'photo_protect' => $contact_res->photo_protect,'photo_pswd' => $contact_res->photo_pswd,'gender' => $contact_res->gender,'username' => "$name",'matri_id' => $contact_res->matri_id,'is_shortlisted' => "1",'is_blocked' => "$block",'is_favourite' => "$mes",'user_profile_picture' =>"$photo",'profile_text'=>"$all",'caste' =>"$ca",'edu_detail' =>"$add_fname",'addition_detail' =>"$edu_fname", 'state_name' =>"$state8",'country_name' =>"$country_name8",'religion_name' =>"$re",'city_name' =>"$city8",'age'=>"$age",'member_status'=>"$st",'status'=>"1",'tokan'=>"$contact_res->tokan");
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
