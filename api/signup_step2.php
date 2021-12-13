<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";
if($_POST['user_id']==""){
	$user_id = $_POST['user_id'];
	$count++;
}
$user_id = $_POST['user_id'];
$password = md5($_POST['password']);
$maritat_status = $_POST['maritat_status'];
$no_of_children = $_POST['no_of_children'];
$marry_into_other_cast = $_POST['marry_into_other_cast'];
$state_id = $_POST['state_id'];
$city_id = $_POST['city_id'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$body_type = $_POST['body_type'];
$physical_status = $_POST['physical_status'];
$education_id = $_POST['education_id'];
$additional_dgree_id  = $_POST['additional_dgree_id'];
$occupation_id  = $_POST['occupation_id'];
$employed_in  = $_POST['employed_in'];
$annual_income  = $_POST['annual_income'];
$diet  = $_POST['diet'];
$smoking  = $_POST['smoking'];
$drinking  = $_POST['drinking'];
$dosh  = $_POST['dosh'];
$sub_caste  = $_POST['sub_caste_id'];
$dosh_type  = $_POST['manglik'];
$star  = $_POST['star'];
$raasi  = $_POST['raasi'];
$birth_time  = $_POST['birth_time'];
$birth_place  = $_POST['birth_place'];
$family_status  = $_POST['family_status'];
$family_type  = $_POST['family_type'];
$family_values  = $_POST['family_values'];
$father_occupation  = $_POST['father_occupation'];
$mother_occupation  = $_POST['mother_occupation'];
$no_of_brothers  = $_POST['no_of_brothers'];
$no_marri_brother  = $_POST['no_marri_brother'];
$no_of_sisters  = $_POST['no_of_sisters'];
$no_marri_sister  = $_POST['no_marri_sister'];
$something_about_me  = $_POST['something_about_me'];
$profile_text_date= date('H:i:s Y-m-d ');
$tm = mktime(date('h') + 5, date('i') + 30, date('s'));
$reg_date = date('Y-m-d h:i:s', $tm);
if($count==0){
	$se="select index_id from register where index_id='$user_id'";
	$qu=$DatabaseCo->dbLink->query($se);
	$no=mysqli_num_rows($qu);
	if($no==0){
	    $response['message'] = "User Not Exist";
		$response['status'] = "0";
		echo json_encode($response);
	}else{
		if($marry_into_other_cast=="Yes"){
			$marry=1;
		}else{
			$marry=0;
		}
		$insert_qry = "update register set
		m_status='$maritat_status',
		password='$password',
		tot_children='$no_of_children',
		will_to_mary_caste='$marry',
		state_id='$state_id',
		city='$city_id',
		height='$height',
		weight='$weight',
		bodytype='$body_type',
		physicalStatus='$physical_status',
		edu_detail='".$education_id.','.$additional_dgree_id."',
		occupation='$occupation_id',
		emp_in='$employed_in',
		income='$annual_income',
		diet='$diet',
		smoke='$smoking',
		drink='$drinking',
		dosh='$dosh',
		manglik='$dosh_type',
		subcaste='$sub_caste',
		star='$star',
		moonsign='$raasi',
		birthtime='$birth_time',
		birthplace='$birth_place',
		family_status='$family_status',
		family_type='$family_type',
		family_value='$family_values',
		father_occupation='$father_occupation',
		mother_occupation='$mother_occupation',
		no_of_brothers='$no_of_brothers',
		no_marri_brother='$no_marri_brother',
		no_of_sisters='$no_of_sisters',
		no_marri_sister='$no_marri_sister',
		profile_text='$something_about_me',
		profile_text_approve='Pending',
		profile_text_date='$profile_text_date',
		status='Inactive',
		reg_date=''
		where index_id='".$_POST['user_id']."'";
		$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);
		if(mysqli_affected_rows($DatabaseCo->dbLink) == 1){
			$response['user_id'] = "$user_id";
			$response['message'] ="Second Step Registration Successful" ;
			$response['status'] = "1";
			echo json_encode($response);
			exit;
		}else{
			$response['message'] = "Registration Unsuccessful";
			$response['status'] = "0";
			echo json_encode($response);
			exit;
		}
	}
}else{
	$response['message'] = "Enter User Id";
	$response['status'] = "0";
	echo json_encode($response);
	exit;
}

?>