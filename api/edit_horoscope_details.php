<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$count="";

$matri_id=$_POST['matri_id'];
if($matri_id==""){
	$matri_id="Enter matri_id";
	$count++;
}else{
	$matri_id="";
}
if($count==0){
	$matri_id=$_POST['matri_id'];
	$dosh  = $_POST['dosh'];
    $manglik  = $_POST['manglik'];
	$star  = $_POST['star'];
	$raasi  = $_POST['raasi'];
	$birth_time  = $_POST['birth_time'];
	$birth_place  = $_POST['birth_place'];
	$UPDATE_HABBIT_SQL=$DatabaseCo->dbLink->query("UPDATE register SET  
	 dosh='$dosh',
	 manglik='$manglik',
	 star='$star',
	 birthtime='$birth_time',
	 birthplace='$birth_place',
	 moonsign='$raasi'
	 where matri_id='$matri_id'");
	
	  $response['status'] = "1";
	  $response['matri_id'] = "$matri_id";
	  $response['message'] = "Horoscope Details Updated Successfully";
	  echo json_encode($response);
	  exit;
}else{
	$response['status'] = "0";
	$response['message'] = "Please Enter Matri Id";
	echo json_encode($response);
	
}

?>