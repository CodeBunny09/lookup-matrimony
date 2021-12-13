<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$sel_own_data=$DatabaseCo->dbLink->query("select * from cms_pages where cms_id='7'");
if (mysqli_num_rows($sel_own_data) > 0) {
	while ($contact_res = mysqli_fetch_object($sel_own_data)) {
      	$string=$contact_res->cms_content;
		//$str=strip_tags($string);
 		$aa= html_entity_decode($string, ENT_HTML5, 'UTF-8'); 
		//$a=strip_tags($aa);
		$response['responseData'] = array('cms_id' => $contact_res->cms_id,'page_name' => $contact_res->page_name,'cms_title' => $contact_res->cms_title,'cms_content' => $aa,'status'=>"1");
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