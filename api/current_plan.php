<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter Matri id";
	$count++;
}else{
	$matri_id="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$sel_plan = $DatabaseCo->dbLink->query("select * from payments where pmatri_id='$matri_id'");
	if (mysqli_num_rows($sel_plan) > 0) {
		$count=0;
		while ($contact_res = mysqli_fetch_object($sel_plan)) {
			if (isset($contact_res->pactive_dt)) {
                $now = time(); // or your date as well
                $your_date = strtotime("$contact_res->pactive_dt");
                $datediff = $now - $your_date;
                $diff = $contact_res->plan_duration - floor($datediff / 86400);
					if($diff < 0){
							$diff='0';
					}else{
							$diff;
					}
               } else {
                   $diff='0';  
               }
			
			  if($contact_res->p_msg != ''){
				 $remianinig_msg=$contact_res->p_msg - $contact_res->r_msg;
			  }else{
				 $remianinig_msg='0';
			  } 
			if($contact_res->p_no_contacts != ''){
				 $remianinig_contact_view=$contact_res->p_no_contacts - $contact_res->r_cnt;
			  }else{
				 $remianinig_contact_view='0';
			  }
			if($contact_res->p_sms != ''){
				 $remianinig_sms=$contact_res->p_sms - $contact_res->r_sms;
			  }else{
				  $remianinig_sms='0';
			  } 
			if($contact_res->profile != ''){
				 $remianinig_profile_view=$contact_res->profile - $contact_res->r_profile;
			  }else{
				 $remianinig_profile_view='0';
			  } 
			$count++;
			$response['responseData'][$count] = array('pmatri_id' => $contact_res->pmatri_id,'pname' => $contact_res->pname,'pemail' => $contact_res->pemail,'paymode' => $contact_res->paymode,'pactive_dt' => $contact_res->pactive_dt,'p_plan' => $contact_res->p_plan,'plan_duration' => $contact_res->plan_duration,'profile' => $contact_res->profile,'video' => $contact_res->video,'chat' => $contact_res->chat,'p_no_contacts' => $contact_res->p_no_contacts,'p_amount' => $contact_res->p_amount,'p_msg' => $contact_res->p_msg,'p_sms' => $contact_res->p_sms,'r_profile' => $contact_res->r_profile,'r_cnt' => $contact_res->r_cnt,'r_sms' => $contact_res->r_sms,'r_msg' => $contact_res->r_msg,'exp_date' => $contact_res->exp_date,'remaining_duration'=>$diff,'remaining_msg'=>$remianinig_msg,'remaining_contact_view'=> $remianinig_contact_view,'remaining_sms'=>$remianinig_sms,'remaining_profile_view'=>$remianinig_profile_view,'status'=>"1");
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