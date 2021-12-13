<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";
if($_POST['profile_creaded_for']==""){
	 $profile_creaded_for = $_POST['profile_creaded_for'];
	 $count++;
}
if($_POST['gender']==""){
	$gender = $_POST['gender'];
	$count++;
}
if($_POST['firstname']==""){
	$firstname = $_POST['firstname'];
	$count++;
}
if($_POST['lastname']==""){
	$lastname = $_POST['lastname'];
	$count++;
}
if($_POST['birthdate']==""){
	$birthdate = $_POST['birthdate'];
	$count++;
}
if($_POST['religion_id']==""){
	$religion_id = $_POST['religion_id'];
	$count++;
}
if($_POST['cast_id']==""){
	$cast_id = $_POST['cast_id'];
	$count++;
}
if($_POST['mother_tongue_id']==""){
	$mother_tongue_id = $_POST['mother_tongue_id'];
	$count++;
}
if($_POST['country_code']==""){
	$country_code = $_POST['country_code'];
	$count++;
}
if($_POST['country_id']==""){
	$country_id = $_POST['country_id'];
	$count++;
}
if($_POST['mobile_no']==""){
	$mobile_no = $_POST['mobile_no'];
	$count++;
}
if($_POST['email_id']==""){
	$email_id = $_POST['email_id'];
	$count++;
}
if($count==0){
	$mobile_no = $_POST['mobile_no'];
	$country_code=$_POST['country_code'];
	$email_id = $_POST['email_id'];
	$religion_id = $_POST['religion_id'];
	$birthdate = $_POST['birthdate'];
	$cast_id = $_POST['cast_id'];
	$mother_tongue_id = $_POST['mother_tongue_id'];
	$country_id = $_POST['country_id'];
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$gender = $_POST['gender'];
	$profile_creaded_for = $_POST['profile_creaded_for'];
	$tm = mktime(date('h') + 5, date('i') + 30, date('s'));
	$reg_date = date('Y-m-d h:i:s', $tm);

	$select="select * from register where email='$email_id'";
	$query=$DatabaseCo->dbLink->query($select);
	$row=mysqli_fetch_array($query);
	$no=mysqli_num_rows($query);
	
if($no==0){
    $order_id = rand(1000,9999);
    $order_id = substr($order_id, rand(0, strlen($order_id) - 4), 4);
    $_SESSION['order_id'] = $order_id;

    $text = "Hello $firstname, Welcome, Your OTP is $order_id. Do not share your OTP with anyone.";
    $message = str_replace(" ", "%20", $text);
    $mno = $_POST['mobile_no'];
	$code = $_POST['country_code'];
	$url="https://control.msg91.com/api/sendhttp.php?authkey=230502AnKcsTku0Trd5d7b640a&mobiles=+91$mno&message=$message&sender=INLOGI&route=4&country=0";		
 	$ret = file($url);
    
	$s = "select prefix from register";
    $rr = $DatabaseCo->dbLink->query($s);
    $dd = mysqli_fetch_array($rr);
    $prefix1 = $dd['prefix'];
	
   
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
		$response['message'] = "Email Already Exit";
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
