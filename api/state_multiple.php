<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$country_id =$_POST['country_id'];
$each=explode(',',$country_id);

$count="0";
if($country_id==""){
	$country_id_err="Enter Country";
	$count++;
}else{
	$country_id_err="";
}

if($count=="0"){
   		foreach ($each as $rel){
			$a=mysqli_fetch_array($DatabaseCo->dbLink->query("select country_name,country_id from country where country_id='$rel' AND status='APPROVED'"));
			$getStateQry=$DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id ='$rel'AND status='APPROVED' ORDER BY state_name ASC");
			if(mysqli_num_rows($getStateQry) > 0){
				while($contact_res = mysqli_fetch_object($getStateQry)){
				$count++;
					$response['responseData'][$count] = array('country_id' => $contact_res->cnt_id,'state_id' => $contact_res->state_id,'state_name' => $contact_res->state_name,'status'=>"1");
					
				}
				
			}
			
		}
		echo json_encode($response);
		exit;		
			
		/*$getCasteQry = $DatabaseCo->dbLink->query("SELECT * FROM caste where religion_id ='".$religion_id."'");
		if(mysqli_num_rows($getCasteQry) > 0){
		$count=0;
		while($contact_res = mysqli_fetch_object($getCasteQry)){
			$count++;
			$response['responseData'][$count] = array('caste_id' => $contact_res->caste_id,'caste_name' => $contact_res->caste_name,'status'=>"1");
		}*/
		


}else{
	$response['status'] = "0";
	$response['message'] = "Please Set Country Id";
	echo json_encode($response);

}

?>
