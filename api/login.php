<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$site_data = mysqli_fetch_object($DatabaseCo->dbLink->query("select * from site_config"));
$count=0;
$tokan = $_POST['tokan'];
$email = $_POST['email_id'];

if($email==""){
	$err_email="Enter Valid Email";
	$count++;
}else{
	$err_email="";
}
$password = $_POST['password'];
if($password==""){
	$err_password="Enter Valid Password";
	 $count++;
}else{
	$err_password="";
}

if($count==0){
	$pass = $_POST['password'];
	$password=md5($pass);
	$selqry = "SELECT * FROM register WHERE ( email = '$email' or matri_id ='$email' ) AND password = '$password' AND status!='Suspended' AND status!='Inactive'";
	$qryres = $DatabaseCo->dbLink->query($selqry);
	if(mysqli_num_rows($qryres) > 0){
		$updateTokan="UPDATE register set tokan='$tokan' WHERE ( email = '$email' or matri_id ='$email' )";
		$tokanQry = $DatabaseCo->dbLink->query($updateTokan);
		$count=0;
		while($contact_res = mysqli_fetch_object($qryres)){
			$matri_id=$contact_res->matri_id;
			$user_id=$contact_res->index_id;
			$username=$contact_res->username;
			$firstname=$contact_res->firstname;
			$reg_date=$contact_res->reg_date;
			$gender=$contact_res->gender;
			$mem_status=$contact_res->status;
			 
			if(isset($contact_res->photo1) !=''){
				$photo=$site_data->web_name."/my_photos/".$contact_res->photo1;
			}else{
				if($contact_res->gender=='Male'){
				 	$photo=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
				 }else{
					$photo=$site_data->web_name."/img/app_img/female-upload-photo.jpg";
				 }
			}
			$response['responseData'] = array('email' => "$email",'matri_id' =>"$matri_id" ,'user_id'=>"$user_id",'username'=>"$username",'gender'=>"$gender",'profile_path'=>"$photo",'message'=>"Login Successfully",'membership_status'=>"$mem_status",'reg_date'=>"$reg_date");
		}
    		$response['status'] = "1";
    		$response['message'] = "Login Successfully ";
    		echo json_encode($response);
    		exit;
		}else{
    		$response['status'] = "0";
    		$response['message'] = "Username/password wrong or Profile is not active";
    		echo json_encode($response);
    		exit;
		}

}else{
	$response['status'] = "0";
	$response['message'] = "Enter username or password";
	echo json_encode($response);
	exit;
}
?>
