<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$religion_id =$_POST['religion'];
$each=explode(',',$religion_id);

$count="0";
if($religion_id==""){
	$religion_id_err="Enter religion";
	$count++;
}else{
	$religion_id_err="";
}

if($count=="0"){
   		foreach ($each as $rel){
			$a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel' AND status='APPROVED'"));
			$getCasteQry=$DatabaseCo->dbLink->query("SELECT * FROM caste WHERE religion_id ='$rel' AND status='APPROVED' ORDER BY caste_name ASC");
			if(mysqli_num_rows($getCasteQry) > 0){
				while($contact_res = mysqli_fetch_object($getCasteQry)){
				$count++;
					$response['responseData'][$count] = array('religion_id' => $contact_res->religion_id,'caste_id' => $contact_res->caste_id,'caste_name' => $contact_res->caste_name,'status'=>"1");
				}
				
			}
			
		}
		echo json_encode($response);
		exit;		
		

}else{
	$response['status'] = "0";
	$response['message'] = "Please Set Religion Id";
	echo json_encode($response);

}

?>
