<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$sel_plan = $DatabaseCo->dbLink->query("SELECT * FROM `membership_plan` WHERE `status`='APPROVED'");
if (mysqli_num_rows($sel_plan) > 0) {
$count=0;
while ($contact_res = mysqli_fetch_object($sel_plan)) {
    $count++;
	$response['responseData'][$count] = array('plan_id' => $contact_res->plan_id,'plan_name' => $contact_res->plan_name,'plan_amount_type' => $contact_res->plan_amount_type,'plan_amount' => $contact_res->plan_amount,'plan_duration' => $contact_res->plan_duration,'plan_msg' => $contact_res->plan_msg,'plan_sms' => $contact_res->plan_sms,'plan_contacts' => $contact_res->plan_contacts,'chat' => $contact_res->chat,'profile' => $contact_res->profile,'status'=>"1");
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
?>