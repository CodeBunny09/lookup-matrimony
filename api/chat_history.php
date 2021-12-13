<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$count=0;
$from_id=$_POST['from_id'];
if($from_id==""){
	$from_id="Enter From Id";
	$count++;
}else{
	$from_id="";
}
$to_id=$_POST['to_id'];
if($to_id==""){
	$to_id="Enter To Id";
	$count++;
}else{
	$to_id="";
}

if($count==0){
            //$from_id=$contact_res->user_from;
           /* $from_matri_id = $_POST['from_id'];
            $get_from_id=$DatabaseCo->dbLink->query("SELECT matri_id from register where index_id='".$from_matri_id."'");
            $from_id_row=mysqli_fetch_object($get_from_id);
            $from_id=$from_id_row->matri_id;*/

            
            //$to_id=$contact_res->to_user;
           /* $to_matri_id = $_POST['to_id'];
            $get_to_id=$DatabaseCo->dbLink->query("SELECT matri_id from register where index_id='".$to_matri_id."'");
            $to_id_row=mysqli_fetch_object($get_to_id);
            $to_id=$from_id_row->matri_id;*/

            $from_matri_id = $_POST['from_id'];
            $get_from_id=$DatabaseCo->dbLink->query("SELECT index_id from register where matri_id='".$from_matri_id."'");
            $from_id_row=mysqli_fetch_object($get_from_id);
        	$from_id=$from_id_row->index_id;
        	
        	$to_matri_id = $_POST['from_id'];
            $get_to_id=$DatabaseCo->dbLink->query("SELECT index_id from register where matri_id='".$to_matri_id."'");
            $to_id_row=mysqli_fetch_object($get_to_id);
        	$to_id=$from_id_row->index_id;
	
	        $get_chat_data = $DatabaseCo->dbLink->query("SELECT * FROM chat WHERE (user_from='$from_id' OR user_to='$from_id') AND (user_from='$to_id' OR user_to='$to_id') order by id ASC");

	
	if (mysqli_num_rows($get_chat_data) > 0) {
		$count=0;
		while ($contact_res = mysqli_fetch_object($get_chat_data)) {
	        $id=$contact_res->id;
			$sent=$contact_res->sent;
			$message=$contact_res->message;
            
            
            //$from_id=$contact_res->user_from;
            $from_matri_id = $contact_res->user_from;
            $get_from_id=$DatabaseCo->dbLink->query("SELECT matri_id from register where index_id='".$from_matri_id."'");
            $from_id_row=mysqli_fetch_object($get_from_id);
            $from_id=$from_id_row->matri_id;

            
            //$to_id=$contact_res->to_user;
            $to_matri_id = $contact_res->user_to;
            $get_to_id=$DatabaseCo->dbLink->query("SELECT matri_id from register where index_id='".$to_matri_id."'");
            $to_id_row=mysqli_fetch_object($get_to_id);
            $to_id=$from_id_row->matri_id;
            
            
			

			

			$SQL_STATEMENT_DATA =$DatabaseCo->dbLink->query("SELECT photo1,photo1_approve,status,photo_view_status,photo_protect,photo_pswd,photo_pswd,gender FROM register WHERE matri_id ='$to_id'");

			$GET_DATA=mysqli_fetch_object($SQL_STATEMENT_DATA);

			

			if(isset($GET_DATA)){

				if($GET_DATA->photo1_approve == 'UNAPPROVED' && $GET_DATA->photo1 !='' ){

					if($GET_DATA->gender=="Female"){

						$photo=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";

					}else{

						$photo=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";

					}

				}else {

					if(($GET_DATA->photo1!="" && $GET_DATA->photo1_approve=='APPROVED') && (($GET_DATA->photo_view_status=='1') || ($GET_DATA->photo_view_status=='2' && $GET_DATA->status=='Paid')) && (($GET_DATA->photo_protect=='No') || ($GET_DATA->photo_protect=="Yes" && $GET_DATA->photo_pswd==''))){

						$photo=$site_data->web_name."/my_photos/".$GET_DATA->photo1;

					}elseif($GET_DATA->photo_protect=="Yes" && $GET_DATA->photo_pswd!=''){

						if($GET_DATA->gender=='Male'){

							$photo=$site_data->web_name."/img/app_img/male-photo-protected.jpg";

						}else{

							$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";

						}

					}elseif($GET_DATA->gender=='Male'){

						$photo=$site_data->web_name."/img/app_img/male-upload-photo.jpg";

					}else{

						$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";

					}

				}

			}

			

			$count++;

			$response['responseData'][$count] = array('from_id'=>"$from_id",'to_id'=>"$to_id",'id'=>"$id",'sent'=>"$sent",'message'=>"$message",'user_profile_picture' =>"$photo");

		}

		$response['status'] = "1";

		$response['message'] = "Success";

		echo json_encode($response);

		exit;

	}else{

		$response['status'] = "0";

		$response['message'] = "No Data Found";

		echo json_encode($response);

	}

}else{

	$response['status'] = "0";

	$response['message'] = "Please Enter All Fields";

	echo json_encode($response);

}

?>

