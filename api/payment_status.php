<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$site_data = mysqli_fetch_object($DatabaseCo->dbLink->query("select * from site_config"));
$count="";
$email = $_POST['email_id'];
$plan_id = $_POST['plan_id'];

if($email==""){
	$err_email="Enter Valid Email";
	$count++;
}else{
	$err_email="";
}
if($count==0){
	if($email !=''){
		$get_gata=mysqli_fetch_object($DatabaseCo->dbLink->query("select register.matri_id,register.email,register.mobile,register.username,register.franchies_id,register.address,membership_plan.plan_name,membership_plan.plan_duration,membership_plan.profile,membership_plan.chat,membership_plan.plan_contacts,membership_plan.plan_msg,membership_plan.plan_amount,membership_plan.plan_amount_type from register,membership_plan where (register.email = '$email' or register.matri_id ='$email' ) and membership_plan.plan_id='$plan_id'"));
		$pmatri_id=$get_gata->matri_id;
		$pname=$get_gata->username;
		$pemail=$get_gata->email;
		$paddress=$get_gata->address;
		$paymode='Online Payment';
		$today1 = strtotime ('now');
		$today=date("Y-m-d",$today1);
		$pactive_dt=$today;
		$p_plan=$get_gata->plan_name;
		$plan_duration=$get_gata->plan_duration;
		$profile=$get_gata->profile;
		$chat=$get_gata->chat;
		$p_no_contacts=$get_gata->plan_contacts;
		$p_amount=$get_gata->plan_amount_type.' '.$get_gata->plan_amount;
		$p_bank_detail='';
		$p_msg=$get_gata->plan_msg;
$franchies_id=$get_gata->franchies_id;
		$date = strtotime(date("Y-m-d", strtotime($pactive_dt)) . + $plan_duration." day");
		$exp_date=date('Y-m-d', $date);
		$pay_id=$plan_id;
		$DatabaseCo->dbLink->query("delete from payments where pmatri_id='".$pmatri_id."'");
		$sql=$DatabaseCo->dbLink->query("insert into payments(pmatri_id,pname,pemail,paddress, paymode,pactive_dt,p_plan,plan_duration,profile,chat,p_no_contacts, p_amount,p_bank_detail,pay_id,p_msg,exp_date) values('$pmatri_id','$pname','$pemail','$paddress','$paymode','$pactive_dt','$p_plan','$plan_duration','$profile','$chat','$p_no_contacts','$p_amount','$p_bank_detail','$pay_id','$p_msg','$exp_date')");
		if(isset($franchies_id) != ''){	
					$get_franchise=mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT* FROM franchies WHERE id = '$franchies_id' "));
				
				$commission=$get_franchise->commission;
					$amount = $get_gata->plan_amount;
					$franchisee_commission = ($commission / 100) * $amount;
					$DatabaseCo->dbLink->query("UPDATE register SET franchisee_amount='$franchisee_commission' WHERE matri_id='$pmatri_id'");
					
				}
		$DatabaseCo->dbLink->query("update register set status='Paid' where ( email = '$email' or matri_id ='$email') ");
		
		$response['status'] = "1";
		$response['message'] = "Payment received.Please re-login.";
		echo json_encode($response);
		exit;
	}else{
		$response['status'] = "0";
		$response['message'] = "Enter email id or matri id";
		echo json_encode($response);
		exit;
	}
}else{
		$response['status'] = "0";
		$response['message'] = "Enter email id or matri id";
		echo json_encode($response);
		exit;
}
?>
