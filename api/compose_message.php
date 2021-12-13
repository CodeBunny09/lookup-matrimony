<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
if (isset($_POST['matri_id'])) {
    $mid = $_POST['matri_id'];
    $select = "select * from payment_view where pmatri_id='$mid'";
    $exe = $DatabaseCo->dbLink->query($select) or die(mysqli_error($DatabaseCo->dbLink));
    $fetch = mysqli_fetch_array($exe);
    $total_msg = $fetch['p_msg'];
    $used_msg = $fetch['r_msg'];
    $exp_date = $fetch['exp_date'];
    $today = date('Y-m-d');
    if ($total_msg - $used_msg > 0 && $exp_date > $today) {
    	$response['status'] = "1";
        $response['message'] = "Successfully";
        echo json_encode($response);
    }else{
    	$response['status'] = "0";
	    $response['message'] = "Please Renew Your Membership Plan";
	    echo json_encode($response);
    }
}else{
	$response['status'] = "0";
    $response['message'] = "No Data Found";
    echo json_encode($response);
}
?>