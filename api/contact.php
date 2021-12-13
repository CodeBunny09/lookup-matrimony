<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}
$login_matri_id=$_POST['login_matri_id'];
if($login_matri_id==""){
	$login_matri_id="Enter login_matri_id";
	$count++;
}
if($count==0){
	$mid = isset($_POST['login_matri_id']) ? $_POST['login_matri_id']:'';
	$from_id = isset($_POST['matri_id']) ? $_POST['matri_id']:0;
	$checker=mysqli_num_rows($DatabaseCo->dbLink->query("select * from contact_checker where my_id='$mid' and viewed_id='$from_id'"));
	if($checker==0){
		$sel=$DatabaseCo->dbLink->query("SELECT * FROM payments where pmatri_id='$mid'"); 
		$fetch123=mysqli_fetch_array($sel);
		$tot_cnt=$fetch123['p_no_contacts'];
		$use_cnt=$fetch123['r_cnt'];
		$use_cnt=$use_cnt+1;
		if($tot_cnt>=$use_cnt){
			$update="UPDATE payments SET r_cnt='$use_cnt' WHERE pmatri_id='$mid' ";
			$d=$DatabaseCo->dbLink->query($update);
			$whocheck=$DatabaseCo->dbLink->query("SELECT * FROM contact_view where my_id='$mid' and viewed_mem_id='$from_id'");
			if($whocheck->num_rows==0){
				$insert=mysqli_query($DatabaseCo->dbLink,"INSERT INTO contact_view(my_id,viewed_mem_id,viewed_date) VALUES('$mid','$from_id',now())");
			} else {
				$update=$DatabaseCo->dbLink->query("UPDATE contact_view SET my_id='$mid',viewed_mem_id='$from_id',viewed_date=now() WHERE my_id='$mid' AND viewed_mem_id='$from_id'");
				    
			}
		}
		$ins=$DatabaseCo->dbLink->query("INSERT INTO contact_checker (my_id,viewed_id,date) VALUES ('$mid','$from_id','".date('Y-m-d H:m:s')."')");
	}
	$response['status'] = "1";
	$response['message'] = "Success";
	echo json_encode($response);
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter All Fields";
	echo json_encode($response);
}