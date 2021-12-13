<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$site_que = $DatabaseCo
->dbLink
->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$matri_id = $_POST['matri_id'];
if ($matri_id == ""){
	$matri_id = "Enter matri_id";
	$count++;
}else{
	$matri_id = "";
}
if ($count == 0){
$matri_id = $_POST['matri_id'];

$sel_plan = $DatabaseCo->dbLink->query("SELECT * FROM register_view  WHERE matri_id='$matri_id'");
if (mysqli_num_rows($sel_plan) > 0){
	$count = 0;
	while ($contact_res = mysqli_fetch_object($sel_plan)){
		$re = $contact_res->religion_name;
		$ca = $contact_res->caste_name;
		$subcaste = $contact_res->subcaste;
		$SQL_STATEMENT_sub = $DatabaseCo->dbLink->query("SELECT sub_caste_name FROM sub_caste WHERE sub_caste_id='$subcaste'");
		$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_sub);
		$as = $DatabaseCo->Row->sub_caste_name;
		$gothra = $contact_res->gothra;
		$SQL_STATEMENT_sub = $DatabaseCo->dbLink->query("SELECT gothra_name	 FROM gothra WHERE gothra_id='$gothra'");
		$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_sub);
		$go = $DatabaseCo->Row->gothra_name;
		$edu_detail = $contact_res->edu_detail;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `education_detail` WHERE  edu_id  in ($edu_detail)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$edu_name3[] = $contact_res1->edu_name;
		}
		$edu5 = implode(",", $edu_name3);
		$ed = explode(",", $edu5);
		$edu_fname = $ed[0];
		$add_fname = $ed[1];
		$ed1 = explode(",", $edu_detail);
		$edu_id = $ed1[0];
		$add_id = $ed1[1];
		$ocp = $contact_res->ocp_name;
		$m_tongue = $contact_res->m_tongue;
		$SQL_STATEMENT_sub = $DatabaseCo->dbLink->query("SELECT mtongue_name FROM mothertongue WHERE mtongue_id='$m_tongue'");
		$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_sub);
		$mtong = $DatabaseCo->Row->mtongue_name;
		$country_name8 = $contact_res->country_name;
		$state8 = $contact_res->state_name;
		$city8 = $contact_res->city_name;
		$part_occu1 = $contact_res->part_occu;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `occupation` WHERE  ocp_id in ($part_occu1)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$part_occu3[] = $contact_res1->ocp_name;
		}
		$occu_name = implode(",", $part_occu3);
		$part_religion1 = $contact_res->part_religion;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `religion` WHERE  religion_id in ($part_religion1)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$religion_name3[] = $contact_res1->religion_name;
		}
		$religion_name = implode(",", $religion_name3);
		$part_country_living1 = $contact_res->part_country_living;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `country` WHERE  country_id in ($part_country_living1)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$country_name33[] = $contact_res1->country_name;
		}
		$country_name9 = implode(",", $country_name33);
		$part_state1 = $contact_res->part_state;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `state` WHERE  state_id in ($part_state1)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$state_name33[] = $contact_res1->state_name;
		}
		$state_name9 = implode(",", $state_name33);
		$part_city1 = $contact_res->part_city;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `city` WHERE  city_id in ($part_city1)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$city_name33[] = $contact_res1->city_name;
		}
		$city_name9 = implode(",", $city_name33);

		$part_mtongue1 = $contact_res->part_mtongue;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `mothertongue` WHERE  mtongue_id in ($part_mtongue1)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$mtongue_name3[] = $contact_res1->mtongue_name;
		}
		$mtongue_name = implode(",", $mtongue_name3);

		$part_caste1 = $contact_res->part_caste;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `caste` WHERE  caste_id in ($part_caste1)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$caste_name35[] = $contact_res1->caste_name;
		}
		$caste_name5 = implode(",", $caste_name35);
		$part_edu1 = $contact_res->part_edu;
		$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `education_detail` WHERE  edu_id  in ($part_edu1)");
		while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
			$edu_name33[] = $contact_res1->edu_name;
		}
		$edu_name = implode(",", $edu_name33);

		$birth = $contact_res->birthdate;
		$birthdate = date('d-m-Y', strtotime($birth));
		if ($as == null){
			$sub = "";
		}else{
			$sub = $as;
		}
		$as1 = $contact_res->horoscope;
		if ($as1 == null){
			$ho = "";
		}else{
			$ho = $as1;
		}
		$ed = $contact_res->edu_name;
		if ($ed == null){
			$edu = "";
		}else{
			$edu = $ed;
		}
		$will_to_mary_caste = $contact_res->will_to_mary_caste;
		if ($will_to_mary_caste == "1"){
			$marry = 'Yes';
		}else{
			$marry = 'No';
		}
		
		
		if(isset($contact_res)){
			if($contact_res->photo1 !=''){
				$photo=$site_data->web_name."/my_photos/".$contact_res->photo1;
			}else{
				if($contact_res->gender=="Female"){
					$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
				}else{
					$photo=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
				}
			}
		}
		
		$photo_count=0;
		if($contact_res->photo1 !=''){
			$photo_count++;
		}
		if($contact_res->photo2 !=''){
			$photo_count++;
		}
		if($contact_res->photo3 !=''){
			$photo_count++;
		}
		if($contact_res->photo4 !=''){
			$photo_count++;
		}
		if($contact_res->photo5 !=''){
			$photo_count++;
		}
		if($contact_res->photo6 !=''){
			$photo_count++;
		}
		
		$age=floor((time() - strtotime($contact_res->birthdate)) / 31556926) .' Yrs';	
		$all = "$age" . "Yrs," . "$height" . "," . "$add_fname" . "," . "$re" . "," . "$ca" . "," . "$city8" . "," . "$country_name8";
		$status = $contact_res->status;
		if ($status == "Paid"){
			$st = "1";
		}else{
			$st = "0";
		}
		$ao3 = $contact_res->height;
		$ft3 = (int) ($ao3 / 12);
		$inch3 = $ao3 % 12;
		$height=$ft3 . "ft" . " " . $inch3 . "in";
		$ao4 = $contact_res->part_height;
		$ft4 = (int) ($ao4 / 12);
		$inch4 = $ao4 % 12;
		$pheightto=$ft4 . "ft" . " " . $inch4 . "in";
		$ao5 = $contact_res->part_height_to;
		$ft5 = (int) ($ao5 / 12);
		$inch5 = $ao5 % 12;
		$pheightfrom=$ft5 . "ft" . " " . $inch5 . "in";
		$pageFrom=$contact_res->part_frm_age;
		$pageTo=$contact_res->part_to_age;	
		if(!isset($contact_res->status_children) == ''){
			$children_living_status='Not Available';
		}
		if(!isset($contact_res->tot_children) == ''){
			$no_of_children='Not Available';
		}
		
		$count++;
		$response['responseData'][$count] = array(
		'age' => "$age",
		'photo_count'=> "$photo_count",
		'user_id' => $contact_res->index_id,
		'matri_id' => $contact_res->matri_id,
		'email' => $contact_res->email,
		'm_status' => $contact_res->m_status,
		'profileby' => $contact_res->profileby,
		'username' => $contact_res->username,
		'firstname' => $contact_res->firstname,
		'lastname' => $contact_res->lastname,
		'gender' => $contact_res->gender,
		'birthdate' => "$birthdate",
		'birthtime' => $contact_res->birthtime,
		'birthplace' => $contact_res->birthplace,
		'tot_children' =>$no_of_children,
		'status_children' => $children_living_status,
		'edu_detail' => "$add_fname",
		'addition_detail' => "$edu_fname",
		'income' => $contact_res->income,
		'occupation' => "$ocp",
		'occupation_id' => $contact_res->occupation,
		'edu_detail_id' => "$edu_id",
		'addition_dgree_id' => "$add_id",
		'emp_in' => $contact_res->emp_in,
		'work_details' => $contact_res->work_details,
		'religion' => "$re",
		'religion_id' => $contact_res->religion,
		'caste_id' => $contact_res->caste,
		'subcaste_id' => $contact_res->sub_caste,
		'm_tongue_id' => $contact_res->m_tongue,
		'caste' => "$ca",
		'subcaste' => "$sub",
		'gothra' => "$go",
		'star' => $contact_res->star,
		'moonsign' => $contact_res->moonsign,
		'horoscope' => "$ho",
		'manglik' => $contact_res->manglik,
		'm_tongue' => "$mtong",
		'will_to_mary_caste' => "$marry",
		'height' => "$height",
		'weight' => $contact_res->weight,
		'b_group' => $contact_res->b_group,
		'complexion' => $contact_res->complexion,
		'status_children' => $contact_res->status_children,
		'physicalStatus' => $contact_res->physicalStatus,
		'bodytype' => $contact_res->bodytype,
		'diet' => $contact_res->diet,
		'smoke' => $contact_res->smoke,
		'drink' => $contact_res->drink,
		'dosh' => $contact_res->dosh,
		'address' => $contact_res->address,
		'country_id' => $contact_res->country_id,
		'country_code' => $contact_res->mobile_code,
		'state_id' => $contact_res->state_id,
		'city' => $contact_res->city,
		'native_place' => $contact_res->native_place,
		'phone' => $contact_res->phone,
		'mobile' => $contact_res->mobile,
		'residence' => $contact_res->residence,
		'father_name' => $contact_res->father_name,
		'mother_name' => $contact_res->mother_name,
		'father_occupation' => $contact_res->father_occupation,
		'mother_occupation' => $contact_res->mother_occupation,
		'profile_text' => $contact_res->profile_text,
		'part_frm_age' => $pageFrom ." Year ". " To " .$pageTo ." Year",
		'part_to_age' => $pageFrom ." Year ". " To " .$pageTo ." Year",
		'part_have_child' => $contact_res->part_have_child,
		'part_income' => $contact_res->part_income,
		'part_expect' => $contact_res->part_expect,
		'part_height' => $contact_res->part_height,
		'part_height_to' => $pheightto." To ".  $pheightfrom,
		'part_complexation' => $contact_res->part_complexation,
		'part_mtongue' => "$mtongue_name",
		'part_mtongue_id' => $contact_res->part_mtongue,
		'part_religion' => "$religion_name",
		'part_religion_id' => $contact_res->part_religion,
		'part_caste' => "$caste_name5",
		'part_caste_id' => $contact_res->part_caste,
		'part_subcaste' => $contact_res->part_subcaste,
		'part_subcaste_name' => $contact_res->sub_caste_name,
		'part_caste_name' => "$caste_name5",
		'part_religion_name' => "$religion_name",
		'part_edu_name' => "$edu_name",
		'part_ocp_name' => "$occu_name",
		'part_m_status' => $contact_res->looking_for,
		'sub_caste' => $contact_res->sub_caste,
		'part_star' => $contact_res->part_star,
		'part_rasi' => $contact_res->part_rasi,
		'part_manglik' => $contact_res->part_manglik,
		'part_edu' => "$edu_name",
		'part_edu_id' => $contact_res->part_edu,
		'part_occu' => "$occu_name",
		'part_occu_id' => $contact_res->part_occu,
		'part_state' => "$state_name9",
		'part_state_id' => $contact_res->part_state,
		'part_city' => "$city_name9",
		'part_city_id' => $contact_res->part_city,
		'part_city_name' => "$city_name9",
		'part_state_name' => "$state_name9",
		'part_country_name' => "$country_name9",
		'part_country_living' => "$country_name9",
		'part_country_id' => $contact_res->part_country_living,
		'part_resi_status' => $contact_res->part_resi_status,
		'part_smoke' => $contact_res->part_smoke,
		'part_diet' => $contact_res->part_diet,
		'part_drink' => $contact_res->part_drink,
		'part_dosh' => $contact_res->part_dosh,
		'part_manglik' => $contact_res->part_manglik,
		'part_physical' => $contact_res->part_physical,
		'part_emp_in' => $contact_res->part_emp_in,
		'hor_photo' => "$ho",
		'state_name' => "$state8",
		'country_name' => "$country_name8",
		'gothra_name' => "$go",
		'sub_caste_name' => "$sub",
		'religion_name' => "$re",
		'caste_name' => "$ca",
		'city_name' => "$city8",
		'ocp_name' => "$ocp",
		'family_details' => $contact_res->family_details,
		'family_value' => $contact_res->family_value,
		'family_type' => $contact_res->family_type,
		'family_status' => $contact_res->family_status,
		'family_origin' => $contact_res->family_origin,
		'no_of_brothers' => $contact_res->no_of_brothers,
		'no_of_sisters' => $contact_res->no_of_sisters,
		'no_marri_brother' => $contact_res->no_marri_brother,
		'no_marri_sister' => $contact_res->no_marri_sister,
		'photo1' => "$photo",
		'member_status' => "$st",
		'member_status' => "$st",
		'status' => "1"
		);
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
