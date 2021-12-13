<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$matri_id = $_POST['matri_id'];
$count=""; 
if ($matri_id == ""){
	$matri_id = "Please Enter Matri id";
	$count++;
}else{
	$matri_id = "";
}
if ($count == 0){
	$matri_id = $_POST['matri_id'];
	$_GET_VIEW_PROFILE = $DatabaseCo->dbLink->query("SELECT * FROM register_view  WHERE matri_id='$matri_id'");
	if (mysqli_num_rows($_GET_VIEW_PROFILE) > 0){
		$count = 0;
		while ($contact_res = mysqli_fetch_object($_GET_VIEW_PROFILE)){
			$religion_name = $contact_res->religion_name;
			$caste_name = $contact_res->caste_name;
			$subcaste = $contact_res->subcaste;
			$occupation_name = $contact_res->ocp_name;
			$country_name = $contact_res->country_name;
			$state_name = $contact_res->state_name;
			$city_name = $contact_res->city_name;
			
			$GET_BIRTHDATE = $contact_res->birthdate;
			$birthdate = date('d-m-Y', strtotime($GET_BIRTHDATE));
			
			/*-- Get Mothertongue Name --*/
			$m_tongue = $contact_res->m_tongue;
			$SQL_STATEMENT_MTONGUE = $DatabaseCo->dbLink->query("SELECT mtongue_name FROM mothertongue WHERE mtongue_id='$m_tongue'");
			$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_MTONGUE);
			$mtongue_name = $DatabaseCo->Row->mtongue_name;
			
			/*-- Get Subcaste Name --*/
			$SQL_STATEMENT_SUB = $DatabaseCo->dbLink->query("SELECT sub_caste_name FROM sub_caste WHERE sub_caste_id='$subcaste'");
			$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_SUB);
			$subcaste_name = $DatabaseCo->Row->sub_caste_name;
			
			/*-- Will to marry other caste --*/
			$will_to_mary_caste = $contact_res->will_to_mary_caste;
			if ($will_to_mary_caste == "1"){
				$marry = 'Yes';
			}else{
				$marry = 'No';
			}
			
			/*-- Get Education Details --*/
			/*
			$edu_detail=explode(",",$DatabaseCo->dbRow->edu_detail);
			$SQL_STATEMENT_EDU =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED'  ");
            while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_EDU)){
				if($get_edu[0]==$DatabaseCo->Row->edu_id){
					$edu_name=$DatabaseCo->Row->edu_name;
				}
				if($get_edu[1]==$DatabaseCo->Row->edu_id){
					$add_name=$DatabaseCo->Row->edu_name;
				}
			}*/
			
			
			
			$edu_detail = $contact_res->edu_detail;
			$SQL_STATEMENT_EDU = $DatabaseCo->dbLink->query("SELECT * FROM `education_detail` WHERE edu_id  in ($edu_detail)");
			while ($get_edu = mysqli_fetch_object($SQL_STATEMENT_EDU)){
				$get_edu_name[] = $get_edu->edu_name;
			}
			$edu_imp = implode(",", $get_edu_name);
			$edu_exp = explode(",", $edu_imp);
			
			$highest_education = $edu_exp[0];
		    $additional_education  = $edu_exp[1];
			
			$ed1 = explode(",", $edu_detail);
			$edu_id = $ed1[0];
			$add_id = $ed1[1];
			
			/*-- Height --*/
			$ao3 = $contact_res->height;
			$ft = (int) ($ao3 / 12);
			$inch = $ao3 % 12;
			$height=$ft . "ft" . " " . $inch . "in";
			
			/*-- Get Partner Education Details --*/
			$part_edu = $contact_res->part_edu;
			$SQL_STATEMENT_PART_EDU = $DatabaseCo->dbLink->query("SELECT * FROM `education_detail` WHERE  edu_id  in ($part_edu)");
			while ($part_edu_name = mysqli_fetch_object($SQL_STATEMENT_PART_EDU)){
				$part_edu_name_arr[] = $part_edu_name->edu_name;
			}
			$part_education_name = implode(",", $part_edu_name_arr);
			
			/*-- Get Partner Occupation Details --*/
			$part_occ = $contact_res->part_occu;
			$SQL_STATEMENT_PART_OCP= $DatabaseCo->dbLink->query("SELECT * FROM `occupation` WHERE  ocp_id in ($part_occ)");
			while ($part_occ_name = mysqli_fetch_object($SQL_STATEMENT_PART_OCP)){
				$part_occ_name_arr[] = $part_occ_name->ocp_name;
			}
			$part_occupation_name = implode(",", $part_occ_name_arr);
			
			/*-- Get Age From And To --*/
			$part_age_from=$contact_res->part_frm_age;
			$part_age_to=$contact_res->part_to_age;
			
			/*-- Get Height From And To --*/
			$ao4 = $contact_res->part_height;
			$ft4 = (int) ($ao4 / 12);
			$inch4 = $ao4 % 12;
			$part_height_from=$ft4 . "ft" . " " . $inch4 . "in";
			$ao5 = $contact_res->part_height_to;
			$ft5 = (int) ($ao5 / 12);
			$inch5 = $ao5 % 12;
			$part_height_to=$ft5 . "ft" . " " . $inch5 . "in";
			
			/*-- Get Partner Religion --*/
			$part_rel = $contact_res->part_religion;
			$SQL_STATEMENT_PART_RELIGION = $DatabaseCo->dbLink->query("SELECT * FROM `religion` WHERE  religion_id in ($part_rel)");
			while ($get_part_religion = mysqli_fetch_object($SQL_STATEMENT_PART_RELIGION)){
				$part_religion_arr[] = $get_part_religion->religion_name;
			}
			$part_religion_name = implode(",", $part_religion_arr);
			
			/*-- Get Partner Caste --*/
			$part_ca = $contact_res->part_caste;
			$SQL_STATEMENT_PART_CASTE = $DatabaseCo->dbLink->query("SELECT * FROM `caste` WHERE  caste_id in ($part_ca)");
			while ($get_part_caste = mysqli_fetch_object($SQL_STATEMENT_PART_CASTE)){
				$part_caste_arr[] = $get_part_caste->caste_name;
			}
			$part_caste_name = implode(",", $part_caste_arr);
			
			
			/*-- Get Partner Mother Tongue --*/
			$part_mtongue = $contact_res->part_mtongue;
			$SQL_STATEMENT_PART_MTONGUE = $DatabaseCo->dbLink->query("SELECT * FROM `mothertongue` WHERE  mtongue_id in ($part_mtongue)");
			while ($get_part_mtongue = mysqli_fetch_object($SQL_STATEMENT_PART_MTONGUE)){
				$part_mtongue_arr[] = $get_part_mtongue->mtongue_name;
			}
			$part_mtongue_name = implode(",", $part_mtongue_arr);
			
			
			/*-- Get Partner Country --*/
			$part_country = $contact_res->part_country_living;
			$SQL_STATEMENT_PART_COUNTRY = $DatabaseCo->dbLink->query("SELECT * FROM `country` WHERE country_id in ($part_country)");
			while ($get_part_country = mysqli_fetch_object($SQL_STATEMENT_PART_COUNTRY)){
				$part_country_arr[] = $get_part_country->country_name;
			}
			$part_country_name = implode(",", $part_country_arr);
			
			/*-- Get Partner State--*/
			$part_state = $contact_res->part_state;
			$SQL_STATEMENT_PART_STATE = $DatabaseCo->dbLink->query("SELECT * FROM `state` WHERE  state_id in ($part_state)");
			while ($get_part_state = mysqli_fetch_object($SQL_STATEMENT_PART_STATE)){
				$part_state_arr[] = $get_part_state->state_name;
			}
			$part_state_name = implode(",", $part_state_arr);
			
			/*-- Get Partner City --*/
			$part_city = $contact_res->part_city;
			$SQL_STATEMENT_PART_CITY = $DatabaseCo->dbLink->query("SELECT * FROM `city` WHERE  city_id in ($part_city)");
			while ($get_part_city = mysqli_fetch_object($SQL_STATEMENT_PART_CITY)){
				$part_city_arr[] = $get_part_city->city_name;
			}
			$part_city_name = implode(",", $part_city_arr);
			
			/*-- Count Age --*/
			$age=floor((time() - strtotime($contact_res->birthdate)) / 31556926) .' Yrs';
			
			/*-- Count Photo --*/
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
			
			if(isset($contact_res->status_children) != ''){
				$children_living_status=$contact_res->status_children;
			}else{
				$children_living_status='Not Available';
			}
			if(isset($contact_res->tot_children) != ''){
				$no_of_children=$contact_res->tot_children;
			}else{
				$no_of_children='Not Available';
			}
		
			
			if(isset($contact_res)){
				if($contact_res->photo1 !=''){
					$photo1=$site_data->web_name."/my_photos/".$contact_res->photo1;
				}else{
					if($contact_res->gender=="Female"){
						$photo1=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
					}else{
						$photo1=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
					}
				}
			}
			
			$will_to_mary_caste = $contact_res->will_to_mary_caste;
			if ($will_to_mary_caste == "1"){
				$will_to_marry = 'Yes';
			}else{
				$will_to_marry = 'No';
			}
			
			$sub_caste = $contact_res->subcaste;
			if ($sub_caste == ""){
				$sub_caste_id = 'Not Available';
			}else{
				$sub_caste_id = $contact_res->subcaste;
			}
			
			$no_of_marrie_brothers = $contact_res->no_marri_brother;
			if ($no_of_marrie_brothers == ""){
				$no_of_marrie_brothers = 'Not Available';
			}else{
				$no_of_marrie_brothers = $contact_res->no_marri_brother;
			}
			
			$no_of_marrie_sisters=$contact_res->no_marri_sister;
			if ($no_of_marrie_sisters == ""){
				$no_of_marrie_sisters = 'Not Available';
			}else{
				$no_of_marrie_sisters= $contact_res->no_marri_sister;
			}
			
			$no_of_brothers = $contact_res->no_of_brothers;
			if ($no_of_brothers == ""){
				$no_of_brothers = 'No Brother';
			}else{
				$no_of_brothers = $contact_res->no_of_brothers;
			}
			
			$no_of_sisters = $contact_res->no_of_sisters;
			if ($no_of_sisters == ""){
				$no_of_sisters = 'No Sister';
			}else{
				$no_of_sisters = $contact_res->no_of_sisters;
			}
			
			$manglik = $contact_res->manglik;
			if ($manglik == ""){
				$manglik = 'Not Available';
			}else{
				$manglik = $contact_res->manglik;
			}
			
			$part_dosh=$contact_res->part_dosh;
			if ($part_dosh == ""){
				$part_dosh = 'Not Available';
			}else{
				$part_dosh = $contact_res->part_dosh;
			}
			
			$part_manglik=$contact_res->part_manglik;
			if ($part_manglik == ""){
				$part_manglik = 'Not Available';
			}else{
				$part_manglik = $contact_res->part_manglik;
			}
			
			$count++;
			$response['responseData'][$count] = array(
				'user_id' => $contact_res->index_id,
				'matri_id' => $contact_res->matri_id,
				'username' => $contact_res->username,
				'firstname' => $contact_res->firstname,
				'lastname' => $contact_res->lastname,
				'email' => $contact_res->email,
				'mobile' => $contact_res->mobile,
				'gender' => $contact_res->gender,
				'birthdate' => "$birthdate",
				'm_status' => $contact_res->m_status,
				'tot_children' =>$no_of_children,
				'status_children' =>$children_living_status,
				'm_tongue' => "$mtongue_name",
				'profileby' => $contact_res->profileby,
				'profile_text' => $contact_res->profile_text,
				//'religion' => "$religion_name",
				//'caste' => "$caste_name",
				'religion_name' => "$religion_name",
				'caste_name' => "$caste_name",
				'subcaste' => "$subcaste_name",
				'will_to_mary_caste' => "$will_to_marry",
				'edu_detail' => "$highest_education",
				'addition_detail' => "$additional_education",
				'emp_in' => $contact_res->emp_in,
				'occupation' => "$occupation_name",
				'income' => $contact_res->income,
				'family_type' => $contact_res->family_type,
				'family_status' => $contact_res->family_status,
				'family_value' => $contact_res->family_value,
				'father_occupation' => $contact_res->father_occupation,
				'mother_occupation' => $contact_res->mother_occupation,
				'no_of_brothers' => "$no_of_brothers",
				'no_of_sisters' => "$no_of_sisters",
				'no_marri_brother' => "$no_of_marrie_brothers" ,
				'no_marri_sister' => "$no_of_marrie_sisters" ,
				'state_name' => "$state_name",
				'country_name' => "$country_name",
				'city_name' => "$city_name",
				'diet' => $contact_res->diet,
				'smoke' => $contact_res->smoke,
				'drink' => $contact_res->drink,
				'height' => "$height",
				'weight' => $contact_res->weight,
				'bodytype' => $contact_res->bodytype,
				'complexion' => $contact_res->complexion,
				'physicalStatus' => $contact_res->physicalStatus,
				'dosh' => $contact_res->dosh,
				'manglik' => "$manglik",
				'star' => $contact_res->star,
				'moonsign' => $contact_res->moonsign,
				'birthtime' => $contact_res->birthtime,
				'birthplace' => $contact_res->birthplace,
				'part_m_status' => $contact_res->looking_for,
				'part_age' => $part_age_from ." Year "." To ". $part_age_to ." Year", //Change of key name
				'part_height' => $part_height_from ." To ". $part_height_to , //Change of key name
				'part_smoke' => $contact_res->part_smoke,
				'part_diet' => $contact_res->part_diet,
				'part_drink' => $contact_res->part_drink,
				'part_physical' => $contact_res->part_physical,
				'part_edu_name' => "$part_education_name",
				'part_ocp_name' => "$part_occupation_name",
				'part_income' => $contact_res->part_income,
				'part_emp_in' => $contact_res->part_emp_in,
				'part_religion' => "$part_religion_name",
				'part_caste' => "$part_caste_name",
				'part_dosh' => "$part_dosh",
				'part_manglik' => "$part_manglik",
				'part_star' => $contact_res->part_star,
				'part_country_name' => "$part_country_name",
				'part_state_name' => "$part_state_name",
				'part_city_name' => "$part_city_name",
				'part_mtongue' => "$part_mtongue_name",
				'part_expect' => $contact_res->part_expect,
				'age' => "$age",
				'photo_count'=> "$photo_count",
				'country_id' => $contact_res->country_id,
				'state_id' => $contact_res->state_id,
				'city' => $contact_res->city,
				'religion' => "$religion_name",
				'caste' => "$caste_name",
				'part_edu' => "$part_education_name",
				'part_country_living' => "$part_country_name",
				'part_state' => "$part_state_name",
				'part_city' => "$part_city_name",
				'photo1' => "$photo1",
				'edu_detail_id' => "$edu_id",
				'addition_dgree_id' => "$add_id",
				'occupation_id' => $contact_res->occupation,
				'm_tongue_id' => $contact_res->m_tongue,
				'religion_id' => $contact_res->religion,
				'caste_id' => $contact_res->caste,
				'subcaste_id' => "$sub_caste_id",
				'part_frm_age' => "$part_age_from",
				'part_to_age' => "$part_age_to",
				'part_frm_height' => "$part_height_from",
				'part_to_height' => "$part_height_to",
				'part_frm_height_id' => $contact_res->part_height,
				'part_to_height_id' => $contact_res->part_height_to,
				'part_edu_id' => $contact_res->part_edu,
				'part_occu_id' => $contact_res->part_occu,
				'part_religion_id' => $contact_res->part_religion,
				'part_caste_id' => $contact_res->part_caste,
				'part_mtongue_id' => $contact_res->part_mtongue,
				'part_country_id' => $contact_res->part_country_living,
				'part_state_id' => $contact_res->part_state,
				'part_city_id' => $contact_res->part_city,
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