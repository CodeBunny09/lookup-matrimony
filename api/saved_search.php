<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$matri_id = $_POST['matri_id'];
if (isset($_POST['matri_id'])) {
    $matri_id = $_POST['matri_id'];
    $sqlq = $DatabaseCo->dbLink->query("select ss_id,ss_name,matri_id,fromage,toage,from_height,to_height,marital_status,religion,caste,country,state,city,education,occupation,annual_income,star,manglik,with_photo,save_date from save_search WHERE matri_id='".$matri_id."' order by ss_id  DESC");
    if (mysqli_num_rows($sqlq) > 0) {
        $count=0;
        while ($contact_res = mysqli_fetch_object($sqlq)) {
            $count++;
            $response['responseData'][$count] = array('ss_id' => $contact_res->ss_id,
			'ss_name' => $contact_res->ss_name,
			'matri_id' => $contact_res->matri_id,
			'fromage' => $contact_res->fromage,
			'toage' => $contact_res->toage,
			'from_height' => $contact_res->from_height,
			'to_height' => $contact_res->to_height,
			'marital_status' => $contact_res->marital_status,
			'religion' => $contact_res->religion,
			'caste' => $contact_res->caste,
			'country' => $contact_res->country,
			'state' => $contact_res->state,
			'city' => $contact_res->city,
			'education' => $contact_res->education,
			'occupation' => $contact_res->occupation,
			'annual_income' => $contact_res->annual_income,
			'star' => $contact_res->star,
			'manglik' => $contact_res->manglik,
			'with_photo' => $contact_res->with_photo,
			'save_date' => $contact_res->save_date);
			
        }
        $response['status'] = "1";
        $response['message'] = "Success";
        echo json_encode($response);
    }else{
        $response['status'] = "0";
        $response['message'] = "No Data Found";
        echo json_encode($response);
    }
}else{
    $response['status'] = "0";
    $response['message'] = "No Data Found";
    echo json_encode($response);
}
?>