<?php

include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
if (isset($_POST['matri_id'])) {
    if (isset($_POST['ss_name'])) {
        if(($_POST['matri_id'] != '') && ($_POST['ss_name'] != '')){
            if (isset($_POST['ss_name'])) {
                $ss_name = $_POST['ss_name'];
            } else {
                $ss_name = '';
            }
            if (isset($_POST['matri_id'])) {
                $matri_id = $_POST['matri_id'];
            } else {
                $matri_id = '';
            }
            if (isset($_POST['fromage'])) {
                $fromage = $_POST['fromage'];
            } else {
                $fromage = '';
            }
            if (isset($_POST['toage'])) {
                $toage = $_POST['toage'];
            } else {
                $toage = '';
            }
            if (isset($_POST['from_height'])) {
                $from_height = $_POST['from_height'];
            } else {
                $from_height = '';
            }
            if (isset($_POST['to_height'])) {
                $to_height = $_POST['to_height'];
            } else {
                $to_height = '';
            }
            if (isset($_POST['marital_status'])) {
                $marital_status = $_POST['marital_status'];
            } else {
                $marital_status = '';
            }
			if (isset($_POST['mother_tongue'])) {
                $mother_tongue = $_POST['mother_tongue'];
            } else {
                $marital_status = '';
            }
            if (isset($_POST['religion'])) {
                $religion = $_POST['religion'];
            } else {
                $religion = '';
            }
            if (isset($_POST['caste'])) {
                $caste = $_POST['caste'];
            } else {
                $caste = '';
            }
            if (isset($_POST['country'])) {
                $country = $_POST['country'];
            } else {
                $country = '';
            }
            if (isset($_POST['state'])) {
                $state = $_POST['state'];
            } else {
                $state = '';
            }
            if (isset($_POST['city'])) {
                $city = $_POST['city'];
            } else {
                $city = '';
            }
            if (isset($_POST['education'])) {
                $education = $_POST['education'];
            } else {
                $education = '';
            }
            if (isset($_POST['occupation'])) {
                $occupation = $_POST['occupation'];
            } else {
                $occupation = '';
            }
            if (isset($_POST['annual_income'])) {
                $annual_income = $_POST['annual_income'];
            } else {
                $annual_income = '';
            }
            if (isset($_POST['star'])) {
                $star = $_POST['star'];
            } else {
                $star = '';
            }
			if (isset($_POST['diet'])) {
                $diet = $_POST['diet'];
            } else {
               $diet = '';
            }
			if (isset($_POST['drink'])) {
                $drink = $_POST['drink'];
            } else {
               $drink = '';
            }
			if (isset($_POST['smoke'])) {
                $smoke = $_POST['smoke'];
            } else {
               $smoke = '';
            }
            if (isset($_POST['manglik'])) {
                $manglik = $_POST['manglik'];
            } else {
                $manglik = '';
            }
			if (isset($_POST['with_photo'])) {
                $with_photo = $_POST['with_photo'];
            } else {
                $with_photo = '';
            }
            $dt = date('Y-m-d h:m:s');


            $DatabaseCo->dbLink->query("insert into save_search(ss_id,ss_name,matri_id,fromage,toage,from_height,to_height,marital_status,mother_tongue,diet,drink,smoking,religion,caste,country,state,city,education,occupation,annual_income,star,manglik,with_photo,save_date)values('','".$ss_name."','".$matri_id."','".$fromage."','".$toage."','".$from_height."','".$to_height."','".$marital_status."','".$mother_tongue."','".$diet."','".$drink."','".$smoke."','".$religion."','".$caste."','".$country."','".$state."','".$city."','".$education."','".$occupation."','".$annual_income."','".$star."','".$manglik."','".$with_photo."','".$dt."')");

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
}else{
    $response['status'] = "0";
    $response['message'] = "No Data Found";
    echo json_encode($response);
}
?>