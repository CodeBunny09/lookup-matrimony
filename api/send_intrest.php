<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();

$count="";
$sender_id=$_REQUEST['sender_id'];
if($sender_id==""){
	$sender_id="Enter Sender id";
	$count++;
}else{
	$sender_id="";
}
$receiver_id=$_REQUEST['receiver_id'];
if($receiver_id==""){
	$receiver_id="Enter Receiver Id";
	$count++;
}else{
	$receiver_id="";
}
	if($count==0){
		$sender_id=$_REQUEST['sender_id'];
		$receiver_id = $_REQUEST['receiver_id'];
		$paid_sel=$DatabaseCo->dbLink->query("select index_id from register where matri_id='$sender_id' and status!='Pending'");
		if(mysqli_num_rows($paid_sel) > 0){
			$sel=$DatabaseCo->dbLink->query("select * from  block_profile where block_by='$receiver_id' and block_to='$sender_id'");
			$num_block=mysqli_num_rows($sel);
			if($num_block==0){
				$int_sel=$DatabaseCo->dbLink->query("select * from  expressinterest where ei_sender='$sender_id' and ei_receiver='$receiver_id'");
			 	if(mysqli_num_rows($int_sel)==0){
					
					$s1 = "select ei_id from expressinterest order by ei_id desc";
					$rr1 = $DatabaseCo->dbLink->query($s1);
					$dd1 = mysqli_fetch_array($rr1);
					$ei_id = $dd1['ei_id']+1;
					$date= date('H:i:s Y-m-d ');
									
					$DatabaseCo->dbLink->query("INSERT INTO expressinterest (ei_id,ei_sender,ei_receiver,receiver_response,ei_message,ei_sent_date,status,trash_receiver,trash_sender) VALUES ('$ei_id','$sender_id','$receiver_id','Pending','I am interested in your profile. Please Accept if you are interested.','".$date."','Approved','No','No')");

					$response['status'] = "1";
					$response['message'] = "Interest Successfully Sent";
					echo json_encode($response);
					exit;
				}else{
					$sel_reminder_id = $DatabaseCo->dbLink->query("select sender_id,receiver_id from reminder where sender_id='".$sender_id."' and receiver_id='".$receiver_id."'");	
					if(mysqli_num_rows($sel_reminder_id)==0){
						
						$s11 = "select rem_id from reminder order by rem_id desc";
						$rr11 =$DatabaseCo->dbLink->query($s11);
						$dd11 = mysqli_fetch_array($rr11);
						$rem_id = $dd1['rem_id']+1;
						
						$DatabaseCo->dbLink->query("INSERT INTO reminder (rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('','".$sender_id."','".$receiver_id."','exp_interest','Accept','Yes','Yes','".date('Y-m-d H:m:s')."')");
						$response['status'] = "1";
						$response['message'] = "Success";
						echo json_encode($response);
					}else{
						$DatabaseCo->dbLink->query("update reminder set reminder_view_status='Yes',sent_date='".date('Y-m-d H:m:s')."' where sender_id='".$sender_id."' and receiver_id='".$receiver_id."'");
						$response['status'] = "1";
						$response['message'] = "Success";
						echo json_encode($response);
					}
				}
			}else{
				$response['status'] = "0";
				$response['message'] = "You are blocked";
				echo json_encode($response);
			}
		}else{
			$response['status'] = "0";
			$response['message'] = "Please Upgrade Your Membership Plan";
			echo json_encode($response);
		}
	}else{
		$response['status'] = "0";
		$response['message'] = "Please Enter All Field";
		echo json_encode($response);
		
	}

?>