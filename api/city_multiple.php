<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$state_id =$_POST['state_id'];
$each=explode(',',$state_id);

$count="0";
if($state_id==""){
	$state_id_err="Enter State";
	$count++;
}else{
	$state_id_err="";
}

if($count=="0"){
   		foreach ($each as $rel){
			$a=mysqli_fetch_array($DatabaseCo->dbLink->query("select country_name,country_id from country where country_id='$rel' AND status='APPROVED'"));
			$getCityQry=$DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE state_id='".$rel."' and status='APPROVED' ORDER BY city_name ASC");
			if(mysqli_num_rows($getCityQry) > 0){
				while($contact_res = mysqli_fetch_object($getCityQry)){
				$count++;
					$response['responseData'][$count] = array('state_id' => $contact_res->state_id,'city_id' => $contact_res->city_id,'city_name' => $contact_res->city_name,'status'=>"1");
				}
			}
		}
		echo json_encode($response);
		exit;		
			
}else{
	$response['status'] = "0";
	$response['message'] = "Please Set State Id";
	echo json_encode($response);

}

?>
