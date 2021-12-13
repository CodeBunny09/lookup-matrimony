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
	$mid = $matri_id;
	$SQL_STATEMENT_ONE = "select * from register_view where matri_id='$mid'";
	$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_ONE );
	
if (mysqli_num_rows($DatabaseCo->dbResult) > 0) {
    $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
	
	$edu=$DatabaseCo->dbRow->edu_detail;
	$edu_array=explode(',',$edu);
	$edu_main=$edu_array[0];
	$country=$DatabaseCo->dbRow->country_id;
	$rel=$DatabaseCo->dbRow->religion;
	$gen=$DatabaseCo->dbRow->gender;
	$caste=$DatabaseCo->dbRow->caste;
	$m_status=$DatabaseCo->dbRow->m_status;
	
	
	
    $rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id FROM register_view WHERE gender!='$gen' AND (find_in_set($edu_main, part_edu) > 0) AND country_id='$country' and religion='$rel' and caste='$caste' and m_status='$m_status'"));
	
    $sql = $DatabaseCo->dbLink->query("SELECT * FROM register_view WHERE gender!='$gen' AND (find_in_set($edu_main, part_edu) > 0)  and country_id='$country' and religion='$rel' and caste='$caste' and m_status='$m_status' order by fstatus desc");
	

    $count = 0;
    if ($rows > 0) {
        while ($contact_res = mysqli_fetch_object($sql)) {
            $sql_exp = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM expressinterest,register_view WHERE ei_receiver='" . $contact_res->matri_id . "' and ei_sender='" . $mid . "' and trash_sender='No'"));
            $count++;
			$matri_id12=$contact_res->matri_id;
		 	$sql123 = "select * from expressinterest where ei_sender='$matri_id' and ei_receiver='$matri_id12'"; 
			$data123 = $DatabaseCo->dbLink->query($sql123);
			$contact_res123 =  mysqli_fetch_object($data123);
			$mes_id=$contact_res123->ei_id;

			if($mes_id==""){
				$mes="0";
			}else{
				$mes="1";
			}

			$ao3 = $contact_res->height;
			$ft3 = (int) ($ao3 / 12);
			$inch3 = $ao3 % 12;
			$height=$ft3 . "ft" . " " . $inch3 . "in";

			$age=floor((time() - strtotime($contact_res->birthdate)) / 31556926);
			
			$edu_detail = $contact_res->edu_detail;
			$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `education_detail` WHERE  edu_id  in ($edu_detail)");
            $edu_name3 = array();
			while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
				$edu_name3[] = $contact_res1->edu_name;
			}
			$edu5=implode(",",$edu_name3);
			$ed= explode(",",$edu5);
			$edu_fname=$ed[0];
			$add_fname=($ed[1] != "") ? $ed[1] : $ed[0] ;
			
			$ocp8 = $contact_res->ocp_name;
			$country_name8= $contact_res->country_name;
			$state8= $contact_res->state_name;
			$city8= $contact_res->city_name;
			$edu_detail = $contact_res->edu_detail;
            $re = $contact_res->religion_name;
			$ca = $contact_res->caste_name;

			
			$ao3 = $contact_res->height;
			$ft3 = (int) ($ao3 / 12);
			$inch3 = $ao3 % 12;
			$height=$ft3 . "ft" . " " . $inch3 . "in";

			$matri_id12 = $contact_res->matri_id;
			$tokan = $contact_res->tokan;
			
			$sql12 = "select * from shortlist where from_id='$matri_id' and to_id='$matri_id12'"; 
			$data12 = $DatabaseCo->dbLink->query($sql12);
			$contact_res12 =  mysqli_fetch_object($data12);
			$sh_id=$contact_res12->sh_id;

			if($sh_id==""){
				$sh="0";
			}else{
				$sh="1";
			}

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

			$sql123 = "select * from expressinterest where ei_sender='$matri_id' and ei_receiver='$matri_id12'"; 
			$data123 = $DatabaseCo->dbLink->query($sql123);
			$contact_res123 =  mysqli_fetch_object($data123);
			$mes_id=$contact_res123->ei_id;

			if($mes_id==""){
				$mes="0";
			}else{
				$mes="1";
			}

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
			$all="$age"."Yrs,"."$height".","."$add_fname".","."$re".","."$ca".","."$city8".","."$country_name8";

			$response['responseData'][$count] = array('user_id' => $contact_res->index_id,'matri_id' => $contact_res->matri_id,'birthdate' => $contact_res->birthdate,'ocp_name' =>"$ocp8",'height' =>"$height",'city_name' => $contact_res->city_name,'country_name' => $contact_res->country_name,'photo1_approve' => $contact_res->photo1_approve,'photo_view_status' => $contact_res->photo_view_status,'photo_protect' => $contact_res->photo_protect,'photo_pswd' => $contact_res->photo_pswd,'gender' => $contact_res->gender,'username' => "$name",'matri_id' => $contact_res->matri_id,'is_shortlisted' => "$sh",'is_blocked' => "$block",'is_favourite' => "$mes",'user_profile_picture' =>"$photo",'profile_text'=>"$all",'caste' =>"$ca",'edu_detail' =>"$add_fname",'addition_detail' =>"$edu_fname", 'state_name' =>"$state8",'country_name' =>"$country_name8",'religion_name' =>"$re",'city_name' => "$city8",'age'=>"$age",'member_status'=>"$st",'status'=>"1",'tokan'=>"$tokan");
		
        }
            $response['status'] = "1";
			$response['message'] = "Success";
		   	echo json_encode($response);
        	exit;
    	} else {
    		$response['status'] = "0";
            $response['message'] = "No Data Found";
            echo json_encode($response);
    	}
	} else {
    	$response['status'] = "0";
        $response['message'] = "No Data Found";
        echo json_encode($response);
    } } ?>

