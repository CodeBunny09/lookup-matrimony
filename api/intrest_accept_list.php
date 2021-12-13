<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count="";
$receiver_id=$_POST['receiver_id'];
if($receiver_id==""){
	$receiver_id="Enter matri_id";
	$count++;
}else{
	$receiver_id="";
}
if($count==0){
$receiver_id=$_POST['receiver_id'];
$sel_own_data=$DatabaseCo->dbLink->query("select * from expressinterest c1 ,register_view c2 where c1.ei_sender='$receiver_id' and c1.receiver_response='Accept' and c1.ei_receiver=c2.matri_id");
if (mysqli_num_rows($sel_own_data) > 0) {
	$count="";
	while ($contact_res = mysqli_fetch_object($sel_own_data)) {
		$matri_id1 = $contact_res->matri_id;
		$sql1 = "select * from block_profile where block_by='$matri_id' and block_to='$matri_id1'"; 
		$data1 = $DatabaseCo->dbLink->query($sql1);
		$contact_res1 =  mysqli_fetch_object($data1);
		$block_id=$contact_res1->block_id;
		if($block_id==""){
			$block="0";
		}else{
			$block="1";
		}
		$matri_id12 = $contact_res->matri_id;
		$sql12 = "select * from shortlist where from_id='$matri_id' and to_id='$matri_id12'"; 
		$data12 = $DatabaseCo->dbLink->query($sql12);
		$contact_res12 =  mysqli_fetch_object($data12);
		$sh_id=$contact_res12->sh_id;
		if($sh_id==""){
			$sh="0";
		}else{
			$sh="1";
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
		if($site_data->username_setting == 'full_username'){
				$name=$contact_res->username;
			}elseif($site_data->username_setting == 'first_surname'){
				$name=$contact_res->firstname." ".substr($contact_res->lastname, 0, 1);
			}else{
				$name='';
			}
		$all="$age"."Yrs,"."$height".","."$add_fname".","."$re".","."$ca".","."$city8".","."$country_name8";
        $count++;
		$response['responseData'][$count] = array('tokan' => $contact_res->tokan,'user_id' => $contact_res->index_id,'matri_id' => $contact_res->matri_id,'birthdate' => $age,'ocp_name' => $ocp8,'height' => $height,'city_name' => $city8,'country_name' => $country_name8,'photo1_approve' => $contact_res->photo1_approve,'photo_view_status' => $contact_res->photo_view_status,'photo_protect' => $contact_res->photo_protect,'photo_pswd' => $contact_res->photo_pswd,'gender' => $contact_res->gender,'username' => "$name",'profile_text'=>"$all",'matri_id' => $contact_res->matri_id,'is_shortlisted' => "$sh",'is_blocked' => "$block",'is_favourite' => "is_favourite",'user_profile_picture' => $photo,'receiver_response' => $contact_res->receiver_response,'sent_date' => $contact_res->ei_sent_date,'ei_id' => $contact_res->ei_id,'status'=>"1");
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