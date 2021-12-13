<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count=0;
if($count==0){
	$sel_own_data = $DatabaseCo->dbLink->query("SELECT * FROM field_settings WHERE id='1'");
	if (mysqli_num_rows($sel_own_data) > 0) {
		$count=0;
		while ($contact_res = mysqli_fetch_object($sel_own_data)) {
		$count++;
		$response['responseData'][$count] = array('id' => $contact_res->id,'sub_caste' => $contact_res->sub_caste,'will_to_marry' => $contact_res->will_to_marry,'weight' => $contact_res->weight,'body_type' => $contact_res->body_type,'complexion' => $contact_res->complexion,'physical_status' => $contact_res->physical_status,'additional_degree' => $contact_res->additional_degree,'annual_income' => $contact_res->annual_income,'diet' => $contact_res->diet,'smoke' => $contact_res->smoke,'drink' => $contact_res->drink,'dosh' => $contact_res->dosh,'star' => $contact_res->star,'rasi' => $contact_res->rasi,'birthtime' => $contact_res->birthtime,'birthplace' => $contact_res->birthplace,'family_profile' => $contact_res->family_profile,'family_status' => $contact_res->family_status,'family_type' => $contact_res->family_type,'family_value' => $contact_res->family_value,'father_occupation' => $contact_res->father_occupation,'mother_occupation' => $contact_res->mother_occupation,'no_of_brother' => $contact_res->no_of_brother,'no_of_married_brother' => $contact_res->no_of_married_brother,'no_of_sister' => $contact_res->no_of_sister,'no_of_married_sister' => $contact_res->no_of_married_sister,'profile_text' => $contact_res->profile_text,'part_physical_status' => $contact_res->part_physical_status,'part_diet' => $contact_res->part_diet,'part_drink' => $contact_res->part_drink,'part_smoke' => $contact_res->part_smoke,'part_dosh' => $contact_res->part_dosh,'part_rasi' => $contact_res->part_rasi,'part_star' => $contact_res->part_star,'part_city' => $contact_res->part_city,'part_annual_income' => $contact_res->part_annual_income,'part_expect' => $contact_res->	part_expect,'status'=>"1",'tokan'=>"$contact_res->tokan");
	}
	$response['status'] = "1";
	$response['message'] = "Success";
	echo json_encode($response);
	exit;
}else{
	$response['status'] = "0";
	$response['message'] = "No Data Found";
	echo json_encode($response);
}}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
}
?>
