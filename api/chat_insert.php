<?php

include_once 'databaseConn.php';

$DatabaseCo = new DatabaseConn();

$count="";

$from_id = $_POST['from_id'];

if($count==0){

	$from_matri_id = $_POST['from_id'];
    $get_from_id=$DatabaseCo->dbLink->query("SELECT index_id from register where matri_id='".$from_matri_id."'");
    $from_id_row=mysqli_fetch_object($get_from_id);
    $from_id=$from_id_row->index_id;
	
    $to_id=$_POST['to_id'];
	$get_to_id=$DatabaseCo->dbLink->query("SELECT index_id from register where matri_id='".$to_id."'");
	$to_id_row=mysqli_fetch_object($get_to_id);
	$to_id=$to_id_row->index_id;
	
    
    
    
	$message = $_POST['message'];

	$tm = mktime(date('h') + 5, date('i') + 30, date('s'));

	$sent = date('Y-m-d h:i:s', $tm);



     $insert_qry="INSERT INTO chat (`user_from`, `user_to`, `message`, `sent`, `recd`) VALUES ('$from_id', '$to_id', '$message', '$sent', '1')";

	

//$insert_qry = "insert into chat(id,from,to,message,sent,recd)values('','$from_id','$to_id','$message','$sent','1')";

$insert_qry1 = $DatabaseCo->dbLink->query($insert_qry);



$response['message'] = "Success";

        $response['status'] = "1";

		echo json_encode($response);

		exit;

}else{

		$response['message'] = "Please Enter All Field";

        $response['status'] = "0";

		echo json_encode($response);

		exit;

}

?>

