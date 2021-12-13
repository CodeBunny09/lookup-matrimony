<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_data = mysqli_fetch_object($DatabaseCo->dbLink->query("select * from site_config"));
	$selqry = "SELECT matri_id,index_id,username,firstname,lastname,reg_date,gender,tokan,online_time,photo1,photo1_approve,photo_view_status,photo_pswd,photo_protect FROM register WHERE online_time!='' ";
	$qryres = $DatabaseCo->dbLink->query($selqry);
	$count=0;
	$c=0;
if (mysqli_num_rows($qryres) > 0) {
		while($contact_res = mysqli_fetch_object($qryres)){
			$count++;
			$matri_id=$contact_res->matri_id;
			$user_id=$contact_res->index_id;
			$username=$contact_res->username;
			$firstname=$contact_res->firstname;
			$reg_date=$contact_res->reg_date;
			$gender=$contact_res->gender;
			$tokan=$contact_res->tokan;
			
			
			
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
			
			$timestamp=$contact_res->online_time;	
		    $date = new DateTime($timestamp); 
			
    	    $reg_date= date('Y-m-d H:i:s');
			$date2 = new DateTime($reg_date); 
			$diff = $date2->getTimestamp() - $date->getTimestamp();
	 		if($diff <= 30){
				$response['responseData'][$count] = array('user_id' => $contact_res->index_id,'gender' => $contact_res->gender,'username' => $contact_res->username,'matri_id' => $contact_res->matri_id,'status'=>"1",'online_time'=>$contact_res->online_time,'profile_path'=>"$photo",'tokan'=>"$tokan");
				$c++;
				
			}
		
		}
	if($c > 0){
		$response['status'] = "1";
		$response['message'] = "Successfully";
		echo json_encode($response);
		exit;
}else{
	$response['status'] = "0";
		$response['message'] = "No user online ";
		echo json_encode($response);
	exit;
}}else{
	$response['status'] = "0";
		$response['message'] = "No user online ";
		echo json_encode($response);
	exit;
}




		
		
		
?>
