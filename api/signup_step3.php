<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count=""; 
if($_POST['user_id']==""){
	$user_id = $_POST['user_id'];
	$count++;
}
	$user_id = $_POST['user_id'];
	$age_male = $_POST['age_male'];
	$age_female = $_POST['age_female'];
	$height_male = $_POST['height_male'];
	$height_female = $_POST['height_female'];
	$marital_status=$_POST['maritat_status'];
	//$marital_status=implode(",",$_POST['maritat_status']);
	
	$physical_status = $_POST['physical_status'];
	if(isset($_POST['diet'])){
		$diet=$_POST['diet'];
	}else{
		$diet="";
	}
	if(isset($_POST['smoking'])){
		$smoking=$_POST['smoking'];
	}else{
		$smoking="";
	}
	if(isset($_POST['drinking'])){
		$drinking = $_POST['drinking'];
	}else{
		$drinking = "";
	}
	$religion_id=$_POST['religion_id'];
	$cast_id=$_POST['cast_id'];
	$manglik=$_POST['manglik'];
    $dosh=$_POST['dosh'];
	$star=$_POST['star'];
	$mother_tongue_id=$_POST['mother_tongue_id'];
	$country_id=$_POST['country_id'];
	$partner_preference =$_POST['partner_preference'];
	if(isset($_POST['state_id'])){
		$state_id=$_POST['state_id'];
	}else{
		$state_id = "";
	}
	if(isset($_POST['city_id'])){
		$city_id=$_POST['city_id'];
	}else{
		$city_id = "";
	}
	$education_id=$_POST['education_id'];
	$occupation_id=$_POST['occupation_id'];
	if(isset($_POST['annual_income'])){
		$annual_income=$_POST['annual_income'];
	}else{
		$annual_income = "";
	}
	$p_expt=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['partner_preference']);
	$part_expect_date= date('H:i:s Y-m-d');	
	if($count==0){
		$result = $DatabaseCo->dbLink->query("SELECT * FROM register where index_id ='$user_id'");
		$no=mysqli_num_rows($result);
		if($no==0){
	        $response['message'] = "User Not Exist";
			$response['status'] = "0";
			echo json_encode($response);
	
		}else{
			$user_id = $_POST['user_id'];
			$insert_qry = $DatabaseCo->dbLink->query("UPDATE register SET 
			looking_for='$marital_status',
			part_frm_age='$age_male',
			part_to_age='$age_female',
			part_height='$height_male',
			part_height_to='$height_female',
			part_physical='$physical_status',
			part_diet='$diet',
			part_smoke='$smoking',
			part_drink='$drinking',
			part_star='$star',
			part_religion='$religion_id',
			part_caste='$cast_id',
			part_manglik='$manglik',
			part_dosh='$dosh',
			part_mtongue='$mother_tongue_id',
			part_country_living='$country_id',
			part_state='$state_id',
			part_city='$city_id',
			part_edu='$education_id',
			part_occu='$occupation_id',
			part_income='$annual_income',
			part_expect='$partner_preference',
			part_expect_approve='Pending',
			part_expect_date='$part_expect_date'
			where index_id='$user_id'");
			
			
			
			$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where index_id ='$user_id'");
			$rowcc = mysqli_fetch_array($result3);
			$name = $rowcc['firstname'];
			$matriid = $rowcc['matri_id'];
			$cpass = $rowcc['cpassword'];
			$website = $rowcc['web_name'];
			$cpass = $rowcc['cpassword'];
			$webfriendlyname = $rowcc['web_frienly_name'];
			$from = $rowcc['from_email'];
			$to = $rowcc['email'];
			$email=$rowcc['email'];
			$result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Registration'");
			$rowcs5 = mysqli_fetch_array($result45);
			$subject = $rowcs5['EMAIL_SUBJECT'];	
			$message = $rowcs5['EMAIL_CONTENT'];
			$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
			$trans = array("your site name" =>$webfriendlyname,"name"=>$name,"matriid"=>$matriid,"email_id"=>$to,"cpass"=>$cpass,"site domain name"=>$website,"my_email"=>$email);
			$email_template = strtr($email_template, $trans);
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
			$headers .= 'From:'.$from."\r\n";
			mail($to,$subject,$email_template,$headers);
			if($insert_qry){
				$response['user_id'] = "$user_id";
				$response['message'] ="Registration Details Successfully Updated" ;
				$response['status'] = "1";
				echo json_encode($response);
				exit;
			}else{
				$response['message'] = "Registration Details Not Updated";
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