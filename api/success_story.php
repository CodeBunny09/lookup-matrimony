<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count=0;
$sel_own_data=$DatabaseCo->dbLink->query("select * from success_story");
if (mysqli_num_rows($sel_own_data) > 0) {
	while ($contact_res = mysqli_fetch_object($sel_own_data)) {
	    $count++;
		$response['responseData'][$count] = array('story_id' => $contact_res->story_id,'weddingphoto' => ($contact_res->weddingphoto!='')?$site_data->web_name.'/SuccessStory/'.$contact_res->weddingphoto:'','weddingphoto_type' => $contact_res->weddingphoto_type,'bridename' => $contact_res->bridename,'brideid' => $contact_res->brideid,'groomname' => $contact_res->groomname,'groomid' => $contact_res->groomid,'marriagedate' => $contact_res->marriagedate,'engagement_date' => $contact_res->engagement_date,'address' => $contact_res->address,'country' => $contact_res->country,'successmessage' => $contact_res->successmessage,'full_name'=>'$name','status'=>"1");
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

?>