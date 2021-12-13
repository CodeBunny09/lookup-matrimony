<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);

// Set Count Variable
$count="";
// Get Member Id
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter Member Matri Id";
	$count++;
}else{
	$matri_id="";
}
// Get My Id
$login_id=$_POST['login_matri_id'];
if($login_id==""){
	$login_id="Enter Login Matri Id";
	$count++;
}else{
	$login_id="";
}
// If count is not equal to 1 then data will be shown
if($count==0){
	$matri_id=$_POST['matri_id'];
	$login_id=$_POST['login_matri_id'];
	//Set mid as login_matri_id (My Id)
	$mid = $login_id;
	//Set from_id as matri_id (Member Id)
	$from_id = $matri_id;
	
	// Get My Data
	$SQL_STATAMENT_MYDATA = $DatabaseCo->dbLink->query("SELECT * FROM register_view WHERE matri_id='".$login_id."'");
	$myData=mysqli_fetch_object($SQL_STATAMENT_MYDATA);
	// Get My Status
	$member_status = $myData->status;
	
	
	// Get Member Data
	$SQL_STATAMENT_MEMDATA = $DatabaseCo->dbLink->query("SELECT * FROM register_view WHERE matri_id='$matri_id'");
	$member_data = mysqli_fetch_object($SQL_STATAMENT_MEMDATA);
	
	// Check Contact View Security and Blocked or not
	$status_message = '';
	// If Member set contact view security = Contact only show to interest accepted members
	if($member_data->contact_view_security=='0'){  
		$SQL_STATEMENT_MEMEXP=$DatabaseCo->dbLink->query("SELECT * FROM expressinterest WHERE ei_sender='$mid' and ei_receiver='$from_id' AND receiver_response='Accept'");
		$GET_EI_COUNT=mysqli_num_rows($SQL_STATEMENT_MEMEXP);
		if($GET_EI_COUNT > 0){
			//Verify it
			$status_message = '';
		}else{
			$status_message = 'This member only shows his/her contact details if you have already sent him/her express interest, and he/she has accepted it.';
		}
	}
	// If Member blocked to Me - Check Block
	$SQL_STATEMENT_MEMBLOCK=$DatabaseCo->dbLink->query("SELECT * FROM  block_profile WHERE block_by='$from_id' AND block_to='$mid'");
	$GET_BLOCK_COUNT=mysqli_num_rows($SQL_STATEMENT_MEMBLOCK);
	if($GET_BLOCK_COUNT > 0){
		$status_message = 'This member has blocked you.You can\'t see his contact details.';
	}
	
	// Get Who checked member profile
	$SQL_STATEMENT_CONTACT_CHECK=$DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile where my_id='$login_id' AND viewed_member_id='$matri_id'");
    if($SQL_STATEMENT_CONTACT_CHECK->num_rows==0 && $member_status=="Paid"){
	     $SQL_STATEMENT_WHO_CHECK=$DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile order by who_id desc"); 
         $contactDetailViewedData=mysqli_fetch_object($SQL_STATEMENT_WHO_CHECK);
	     $contactDetailCheckId=$contactDetailViewedData->who_id;
         $increseContactDetail=$contactDetailCheckId+1;	 
    	 $insert=$DatabaseCo->dbLink->query("INSERT INTO who_viewed_my_profile (who_id,my_id,viewed_member_id,viewed_date) VALUES ('$increseContactDetail','$login_id','$matri_id',now())");
    } else {
		// Update who check member profile time of that row
    	 $SQL_STATEMENT_WHO_CHECK_UPDATE=$DatabaseCo->dbLink->query("UPDATE who_viewed_my_profile SET my_id='$login_id',viewed_member_id='$matri_id',viewed_date=now() WHERE my_id='$login_id' AND viewed_member_id='$matri_id'");    
    }
	if($SQL_STATEMENT_CONTACT_CHECK->num_rows==0){
		$used_profile=$use_profile+1;
	}
	
	// Get contact viewed details
	$CONTACT_VIEWED_NUM=mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM contact_checker WHERE my_id='$login_id' AND viewed_id='$matri_id'"));
	if($CONTACT_VIEWED_NUM!=0){
		$contact_detail_viewed = "Contact already seen.";
	}else{
		$contact_detail_viewed = "";
	}
	
	
	// Get My Membership Plan
	$SQL_STATEMENT_PAYMENTS=$DatabaseCo->dbLink->query("SELECT * FROM payments WHERE pmatri_id='$login_id'");
	$membership_data=mysqli_fetch_object($SQL_STATEMENT_PAYMENTS);
	$total_contact_view=$membership_data->p_no_contacts;
	$used_contact_view=$membership_data->r_cnt;
	$total_profile_view=$membership_data->profile;
    $used_profile_view=$membership_data->r_profile;
	if($total_contact_view-$used_contact_view <= 0){
		$status_message = 'Please get the contact view balance by upgrading your membership.';
	}
	if($total_profile_view >= $used_profile_view){
		// Update and add 1 count in membership if profile is not viewed
		$UPDATE_MEMBERSHIP=$DatabaseCo->dbLink->query("UPDATE payments SET r_profile='$used_profile_view' WHERE pmatri_id='$login_id'");
		// Get Member Details
		$GET_MEM_DETAILS = $DatabaseCo->dbLink->query("SELECT * FROM register_view  WHERE matri_id='$matri_id'");
		// If get profile count - 1 
		if (mysqli_num_rows($GET_MEM_DETAILS) > 0) {
			$count=0;
			while ($contact_res = mysqli_fetch_object($GET_MEM_DETAILS)) {
				$re=$contact_res->religion_name;
				$ca= $contact_res->caste_name;
				$ocp= $contact_res->ocp_name;
				$country_name8= $contact_res->country_name;
				$state8= $contact_res->state_name;
				$city8= $contact_res->city_name;
				
				// Get Heightest Education & Other Education
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
				
				// Get subcaste name
				$subcaste = $contact_res->subcaste;
				$SQL_STATEMENT_sub = $DatabaseCo->dbLink->query("SELECT sub_caste_name FROM sub_caste WHERE sub_caste_id='$subcaste'");
				$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_sub);
				$as= $DatabaseCo->Row->sub_caste_name;
				if($as==null){
					$subcaste="";
				}else{
					$subcaste=$as;
				}
				
				// Get Mothertongue name
				$m_tongue = $contact_res->m_tongue;
				$SQL_STATEMENT_MTONGUE = $DatabaseCo->dbLink->query("SELECT mtongue_name FROM mothertongue WHERE mtongue_id='$m_tongue'");
				$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_MTONGUE);
				$mtong= $DatabaseCo->Row->mtongue_name;
				
				// Get Birthdate
				$birth = $contact_res->birthdate;
				$birthdate= date('d-m-Y', strtotime($birth));
				
				// Get Will to marry in other caste data
				$will_to_mary_caste=$contact_res->will_to_mary_caste;
				if($will_to_mary_caste=="1"){
					$marry='Yes';
				}else{
					$marry='No';
				}
				
				// Get Age
				$age_main = floor((time() - strtotime($contact_res->birthdate)) / 31556926)." Yrs";
				
				// Get Height
				$ao3 = $contact_res->height;
				$ft3 = (int) ($ao3 / 12);
				$inch3 = $ao3 % 12;
				$height=$ft3 . "ft" . " " . $inch3 . "in";
				
				// Get Uploaded Photo Count
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
				
				// Part Height from
				$ao4 = $contact_res->part_height;
				$ft4 = (int) ($ao4 / 12);
				$inch4 = $ao4 % 12;
				$part_height_from=$ft4 . "ft" . " " . $inch4 . "in";
				
				// Part Height To
				$ao5 = $contact_res->part_height_to;
				$ft5 = (int) ($ao5 / 12);
				$inch5 = $ao5 % 12;
				$part_height_to=$ft5 . "ft" . " " . $inch5 . "in";
				
				// Part Age from & to
				$part_age_from=$contact_res->part_frm_age;
				$part_age_to=$contact_res->part_to_age;	
				
				// Part Monther Tongues Name
				$part_mtongue = $contact_res->part_mtongue;
				$GET_PART_MTONGUE = $DatabaseCo->dbLink->query("SELECT * FROM `mothertongue` WHERE mtongue_id in ($part_mtongue)");
				while ($contact_res1 = mysqli_fetch_object($GET_PART_MTONGUE)){
					$part_mothertongue[] = $contact_res1->mtongue_name;
				}
				$part_mtongue_name=implode(",",$part_mothertongue);
				
				// Part Religion Name
				$part_religion = $contact_res->part_religion;
				$GET_PART_RELIGION = $DatabaseCo->dbLink->query("SELECT * FROM `religion` WHERE  religion_id in ($part_religion)");
				while ($contact_res1 = mysqli_fetch_object($GET_PART_RELIGION)){
					$part_rel_name[] = $contact_res1->religion_name;
				}
				$part_religion_name=implode(",",$part_rel_name);
				
				// Part Caste Name
				$part_caste = $contact_res->part_caste;
				$GET_PART_CASTE = $DatabaseCo->dbLink->query("SELECT * FROM `caste` WHERE caste_id in ($part_caste)");
				while ($contact_res1 = mysqli_fetch_object($GET_PART_CASTE)){
					$part_ca_name[] = $contact_res1->caste_name;
				}
				$part_caste_name=implode(",",$part_ca_name);
				
				// Part Education Name
				$part_edu = $contact_res->part_edu;
				$GET_PART_EDU = $DatabaseCo->dbLink->query("SELECT * FROM `education_detail` WHERE  edu_id  in ($part_edu)");
				while ($contact_res1 = mysqli_fetch_object($GET_PART_EDU)){
					$part_education_name[] = $contact_res1->edu_name;
				}
				$part_edu_name=implode(",",$part_education_name);
				
				// Part Occupation Name
				$part_occ = $contact_res->part_occu;
				$GET_PART_OCC = $DatabaseCo->dbLink->query("SELECT * FROM `occupation` WHERE  ocp_id in ($part_occ)");
				while ($contact_res1 = mysqli_fetch_object($GET_PART_OCC)){
					$part_occupation_name[] = $contact_res1->ocp_name;
				}
				$part_occ_name=implode(",",$part_occupation_name);
				
				// Part Country Name
				$part_country = $contact_res->part_country_living;
				$GET_PART_COUNTRY= $DatabaseCo->dbLink->query("SELECT * FROM `country` WHERE  country_id in ($part_country)");
				while ($contact_res1 = mysqli_fetch_object($GET_PART_COUNTRY)){
					$part_ca_name[] = $contact_res1->country_name;
				}
				$part_country_name=implode(",",$part_ca_name);
				
				// Part State Name
				$part_state = $contact_res->part_state;
				$GET_PART_STATE= $DatabaseCo->dbLink->query("SELECT * FROM `state` WHERE  state_id in ($part_state)");
				while ($contact_res1 = mysqli_fetch_object($GET_PART_STATE)){
					$part_st_name[] = $contact_res1->state_name;
				}
				$part_state_name=implode(",",$part_st_name);
				
				// Part City Name
				$part_city = $contact_res->part_city;
				$GET_PART_CITY = $DatabaseCo->dbLink->query("SELECT * FROM `city` WHERE  city_id in ($part_city)");
				while ($contact_res1 = mysqli_fetch_object($GET_PART_CITY)){
					$part_ct_name[] = $contact_res1->city_name;
				}
				$part_city_name=implode(",",$part_ct_name);
				
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
							$photo=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
						}
					}
				}
				
				// Get Match Parameter Count
				$i = 0;
				$pheight = '';
				if ($contact_res->height >= $member_data->part_height && $contact_res->height <= $member_data->part_height_to){
					$i++;
					$pheight = 1;
				}

				$age = floor((time() - strtotime($contact_res->birthdate)) / 31556926);
				if ($age >= $member_data->part_frm_age && $age <= $member_data->part_to_age) {
					$i++;
					$age = 1;
				}
				$lok_var = explode(", ", $member_data->looking_for);
				if (in_array($contact_res->m_status, $lok_var)) {
					$i++;
					$lok_var = 1;
				} elseif (in_array($contact_res->m_status, array('Never Married'))) {
					$i++;
					$lok_var = 1;
				}
					$pmtongue = explode(", ", $member_data->part_mtongue);
					if (in_array($contact_res->m_tongue, $pmtongue)) {
					$i++;
					$pmtongue = 1;
				}
				$diet_var = explode(", ", $member_data->part_diet);
				if (in_array($contact_res->diet, $diet_var)) {
					$i++;
					$diet_var = 1;
				}
				$smoke_var = explode(", ", $member_data->part_smoke);
				if (in_array($contact_res->smoke, $smoke_var)) {
					$i++;
					$smoke_var == '1';
				}
				$drink_var = explode(", ", $member_data->part_drink);
				if (in_array($contact_res->drink, $drink_var)) {
					$i++;
					$drink_var == '1';
				}
				$phy_var = explode(", ", $member_data->part_physical);
				if (in_array($contact_res->physicalStatus, $phy_var)) {
					$i++;
					$phy_var = '1';
				}
				$part_edu = explode(",", $member_data->part_edu);
				$get_edu_own = explode(",", $contact_res->edu_detail);
				if (in_array($get_edu_own[0], $part_edu)) {
					$i++;
					$part_edu = '1';
				}
				$part_income = '';
				if ($contact_res->income == $member_data->part_income) {
					$i++;
					$part_income = '1';
				}
				$part_emp_in = '';
				if ($contact_res->emp_in == $member_data->part_emp_in) {
					$i++;
					$part_emp_in = '1';
				}
				$partocp = explode(",", $member_data->part_occu);
				if (in_array($contact_res->occupation, $partocp)) {
					$i++;
					$partocp = '1';
				}
				$parrel = explode(",", $member_data->part_religion);
				if (in_array($contact_res->religion, $parrel)) {
					$i++;
					$parrel = '1';
				}
				$parcaste = explode(",", $member_data->part_caste);
				if (in_array($contact_res->religion, $parcaste)) {
					$i++;
					$parcaste = '1';
				}
				$ownmanglik = explode(", ", $contact_res->manglik);
				if (in_array($member_data->part_manglik, $ownmanglik)) {
					$i++;
					$ownmanglik = '1';
				}
				$parrasi = explode(", ", $member_data->part_rasi);
				$parstar = explode(", ", $member_data->part_star);
				if (in_array($contact_res->moonsign, $parrasi) && in_array($contact_res->star, $parstar)) {
					$i++;
					$parstar = '1';
				}
				$parcnt = explode(", ", $member_data->part_country_living);
				if (in_array($contact_res->country_id, $parcnt)) {
					$i++;
					$parcnt = '1';
				}
				$parstate = explode(", ", $member_data->part_state);
				if (in_array($contact_res->state_id, $parstate)) {
					$i++;
					$parstate = '1';
				}
				$parcity = explode(", ", $member_data->part_city);
				if (in_array($contact_res->city, $parcity)) {
					$i++;
					$parcity = '1';
				}
				
				// Check Blocked or not
				$GET_BLOCK_LIST = $DatabaseCo->dbLink->query("SELECT * FROM block_profile WHERE block_by='$login_id' AND block_to='$matri_id'"); 
				if(mysqli_num_rows($GET_BLOCK_LIST) > 0){
					$getblockdata =  mysqli_fetch_object($GET_BLOCK_LIST);
					$block_id=$getblockdata->block_id;
					if($block_id==""){
						$block="1";
					}else{
						$block="0";
					}
				}else{
					$block="1";
				}
				
				// Check Shortlisted or Not
				$SHORTLIST_CHECK = $DatabaseCo->dbLink->query("SELECT * FROM shortlist where from_id='$login_id' AND to_id='$matri_id'");
				$SHORT_COUNT=mysqli_num_rows($SHORTLIST_CHECK);
				if($SHORT_COUNT > 0){
					$GET_SHORTLIST_DATA =  mysqli_fetch_object($SHORTLIST_CHECK);
					$shortlist_id=$GET_SHORTLIST_DATA->sh_id;
					if($shortlist_id==""){
						$sh="1";
					}else{
						$sh="0";
					}
				}else{
					$sh="1";
				}
				// Check Express Interest Sent or Not
				$GET_INTEREST_LIST = $DatabaseCo->dbLink->query("SELECT * FROM expressinterest WHERE ei_sender='$login_id' AND ei_receiver='$matri_id'");
				if(mysqli_num_rows($GET_INTEREST_LIST) > 0){
					$getinsertdata = mysqli_fetch_object($GET_INTEREST_LIST);
					$ei_id=$getinsertdata->ei_id;
					if($ei_id==""){
						$ei="0";
					}else{
						$ei="1";
					}
				}else{
					$ei="0";
				}
				
				
				// Get Member Status
				$status = $contact_res->status;
				if($status=="Paid"){
					$st="1";
				}else{
					$st="0";
				}
				// Get Photo Password
				$photo_pass=$contact_res->photo_pswd;
				if($photo_pass!=""){
					$photo_pass= $contact_res->photo_pswd;
				}else{
					$photo_pass="";
				}
				if($site_data->username_setting == 'full_username' || $member_status == 'Paid'){
					$name=$contact_res->username;
					$lastname=$contact_res->lastname;
					$firstname=$contact_res->firstname;
				}elseif($site_data->username_setting == 'first_surname'){
					$name=$contact_res->firstname." ".substr($contact_res->lastname, 0, 1);
					$lastname=substr($contact_res->lastname, 0, 1);
					$firstname=$contact_res->firstname;
				}else{
					$name='';
					$lastname='';
					$firstname='';
				}
			 $count++;
			 $response['responseData'][$count] = array(
			  'matri_id' => $contact_res->matri_id,
			  'email' => $contact_res->email,
			  'm_status' => $contact_res->m_status,
			  'profileby' => $contact_res->profileby,
			  'username' => "$name",
			  'firstname' => "$firstname",
			  'lastname' => "$lastname",
			  'gender' => $contact_res->gender,
			  'birthdate' => "$birthdate",
			  'birthtime' => $contact_res->birthtime,
			  'birthplace' => $contact_res->birthplace,
			  'tot_children' => $contact_res->tot_children,
			  'status_children' => $contact_res->status_children,
			  'edu_detail' => "$highest_education",
			  'addition_detail' => "$additional_education",
			  'income' => $contact_res->income,
			  'occupation' => "$ocp",
			  'photo_protect' => $contact_res->photo_protect,
			  'photo_pswd' => $contact_res->photo_pswd,
			  'emp_in' => $contact_res->emp_in,
			  'religion' => "$re",
			  'caste' => "$ca",
			  'subcaste' => "$subcaste",
			  'star' => $contact_res->star,
			  'moonsign' => $contact_res->moonsign,
			  'manglik' => $contact_res->manglik,
			  'm_tongue' => "$mtong",
			  'will_to_mary_caste' =>"$marry",
			  'height' => $height,
			  'weight' => $contact_res->weight,
			  'status_children' => $contact_res->status_children,
			  'physicalStatus' => $contact_res->physicalStatus,
			  'bodytype' => $contact_res->bodytype,
			  'diet' => $contact_res->diet,
			  'smoke' => $contact_res->smoke,
			  'drink' => $contact_res->drink,
			  'dosh' => $contact_res->dosh,
			  'country_code' => "$contact_res->mobile_code",
			  'city' => $contact_res->city,
			  'mobile' => $contact_res->mobile,
			  'father_occupation' => $contact_res->father_occupation,
			  'mother_occupation' => $contact_res->mother_occupation,
			  'profile_text' => $contact_res->profile_text,
			  'part_age' => $part_age_from ." Year ". " To " .$part_age_to ." Year",
			  'part_income' => $contact_res->part_income,
			  'part_expect' => $contact_res->part_expect,
			  'part_height' => $part_height_from." To ".  $part_height_to,
			  'part_mtongue' => "$part_mtongue_name",
			  'part_religion' => "$part_religion_name",
			  'part_caste' =>"$part_caste_name",
			  'part_caste_name' =>"$part_caste_name",
			  'part_religion_name' => "$part_religion_name",
			  'part_edu_name' => "$part_edu_name",
			  'part_ocp_name' => "$part_occ_name",
			  'part_m_status' => $contact_res->looking_for,
			  'part_star' => $contact_res->part_star,
			  'part_rasi' => $contact_res->part_rasi,
			  'part_manglik' => $contact_res->part_manglik,
			  'part_edu' => "$part_edu_name",
			  'part_occu' => "$part_occ_name",
			  'part_state' =>"$part_state_name",
			  'part_city' =>"$part_city_name",
			  'part_city_name' =>"$part_city_name",
			  'part_state_name' =>"$part_state_name",
			  'part_country_name' =>"$part_country_name",
			  'part_country_living' =>"$part_country_name",
			  'part_smoke' => $contact_res->part_smoke,
			  'part_diet' => $contact_res->part_diet,
			  'part_drink' => $contact_res->part_drink,
			  'part_physical' => $contact_res->part_physical,
			  'part_emp_in'=>$contact_res->part_emp_in,
			  'state_name' => "$state8",
			  'country_name' =>"$country_name8",
			  'sub_caste_name' => "$subcaste",
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
			  'photo1'=>"$photo",
			  'total_cnt'=>"$total_contact_view",
			  'used_cnt'=>"$used_contact_view",
			  'is_viewed'=>"$contact_detail_viewed",
			  'match_pre'=>"$i",
			  'total_pre'=>"19",
			  'member_status'=>"$st",
			  'status_contact'=>"$status_message",
			  'age'=>"$age_main",
			  'photo_count'=> "$photo_count",
			  'is_blocked' => "$block",
			  'is_favourite' => "$ei", 
			  'is_shortlisted' => "$sh",
			  'photo_pass' => "$photo_pass", 
			  'tokan' => $contact_res->tokan,
			  'about_me_status' => $contact_res->profile_text_approve,  
			  'part_expect_status' => $contact_res->part_expect_approve, 
			  'status'=>"1");	
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
	}else{
		$response['status'] = "0";
		$response['message'] = "Your View Profile balance is over, to see furthur member\'s profile, please upgrade your membership";
		echo json_encode($response);
    }
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>
