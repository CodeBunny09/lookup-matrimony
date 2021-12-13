<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";

$email = $_POST['email_id'];

if($email==""){
	$err_email="Enter Valid Email";
	$count++;
}else{
	$err_email="";
}

if($count==0){

    $order_id = rand(1000,9999);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
    $_SESSION['order_id'] = $order_id;
	
   
$insert_qry = "insert into register(otp,profileby,gender,username,firstname,lastname,birthdate,religion,caste,m_tongue,country_id,mobile_code,mobile,email,reg_date,photo_view_status,photo_protect,status)values('$order_id','$profile_creaded_for','$gender','".$firstname." ".$lastname."','$firstname','$lastname','$birthdate','$religion_id','$cast_id','$mother_tongue_id','$country_id','$country_code','$mobile_no','$email_id','$reg_date','1','No','Inactive')";
$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry) or die("Invalid query: " . mysqli_error());
$index_id=mysqli_insert_id($DatabaseCo->dbLink);

		
$matri_id=$prefix1.$index_id;
$u="update register set matri_id='$matri_id' where index_id='$index_id'";
$q=$DatabaseCo->dbLink->query($u);

        function RandomPassword() {
            $chars = "abcdefghijkmnopqrstuvwxyz023456789";
            srand((double) microtime() * 1000000);
            $i = 0;
            $pass = '';

            while ($i <= 7) {
                $num = rand() % 33;
                $tmp = substr($chars, $num, 1);
                $pass = $pass . $tmp;
                $i++;
            }
            return $pass;
        }
        $pswd = RandomPassword();
        $upd = $DatabaseCo->dbLink->query("update register set matri_id='" . $matri_id . "',prefix='" . $prefix1 . "',cpassword='$pswd' where index_id='$index_id'");


$_SESSION['otp']=$order_id;
$_SESSION['user_id']=$index_id;
if(mysqli_affected_rows($DatabaseCo->dbLink) == 1){
		$response['user_id'] = "$index_id";
		$response['message'] ="First Step Registration successful";
		$response['otp'] = $order_id;
		$response['status'] = "1";
		echo json_encode($response);
		exit;
}else{
		$response['message'] = "Registration Fail";
		$response['status'] = "0";
		echo json_encode($response);
		exit;
	}


}else{
		$response['message'] = "Please Enter All Field";
        $response['status'] = "0";
		echo json_encode($response);
		exit;
}
?>
