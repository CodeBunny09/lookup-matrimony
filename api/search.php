<?php 
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);

$matri_id=$_POST['login_matri_id'];
if(isset($_POST['religion']) != '' ){
	if (isset($_POST['religion']) && $_POST['religion'] != 'null') {
		$rel = $_POST['religion'];
		$_POST['religion'] = $rel;
	} elseif ((isset($_POST['religion']) && $_POST['religion'] == 'null')) {
		$rel = '';
		$_POST['religion'] = $rel;
	} else {
		$rel = $_POST['religion'];
	}
}

if(isset($_POST['caste']) != '' ){
	if (isset($_POST['caste']) && $_POST['caste'] != 'null') {
		$caste = $_POST['caste'];
		$_POST['caste'] = $caste;
	} elseif ((isset($_POST['caste']) && $_POST['caste'] == 'null')) {
		$caste = '';
		$_POST['caste'] = $caste;
	} else {
		$caste = $_POST['caste'];
	}
}

if(isset($_POST['occupation']) != '' ){
	if (isset($_POST['occupation']) && $_POST['occupation'] != 'null') {
		$occ = $_POST['occupation'];
		$_POST['occupation'] = $occ;
	} elseif ((isset($_POST['occupation']) && $_POST['occupation'] == 'null')) {
		$occ = '';
		$_POST['occupation'] = $occ;
	} else {
		$occ = $_POST['occupation'];
	}
}
if(isset($_POST['gender']) != '' ){
	if (isset($_POST['gender']) && $_POST['gender'] != '') {
		if ($_POST['gender'] == 'Male') {
			$gender = 'Female';
		} else {
			$gender = 'Male';
		}
	} elseif (isset($_POST['gender123']) && $_POST['gender123'] != '') {
		if ($_POST['gender123'] == 'Male') {
			$gender = 'Female';
		} else {
			$gender = 'Male';
		}
	} else {
		$gender = $_POST['gender'];
	}
}

// Get Age From

	if (isset($_POST['t3']) && $_POST['t3'] != 'null') {
		$t3 = $_POST['t3'];
		$_POST['fromage'] = $t3;
	} elseif ((isset($_POST['t3']) && $_POST['t3'] == 'null')) {
		$t3 = '';
		$_POST['fromage'] = $t3;
	} else {
		$t3 = $_POST['fromage'];
	}


// Get Age To

	if (isset($_POST['t4']) && $_POST['t4'] != 'null') {
		$t4 = $_POST['t4'];
		$_POST['toage'] = $t4;
	} elseif ((isset($_POST['t4']) && $_POST['t4'] == 'null')) {
		$t4 = '';
		$_POST['toage'] = $t4;
	} else {
		$t4 = $_POST['toage'];
	}


// Get Country
if(isset($_POST['country']) != '' ){
	if (isset($_POST['country']) && $_POST['country'] != 'null') {
		$con = $_POST['country'];
		$_POST['country'] = $con;
	} elseif ((isset($_POST['country']) && $_POST['country'] == 'null')) {
		$con = '';
		$_POST['country'] = $con;
	} else {
		$con = $_POST['country'];
	}
}

// Get State
if(isset($_POST['state']) != '' ){
	if (isset($_POST['state']) && $_POST['state'] != 'null') {
		$state = $_POST['state'];
		$_POST['state'] = $state;
	} elseif ((isset($_POST['state']) && $_POST['state'] == 'null')) {
		$state = '';
		$_POST['state'] = $state;
	} else {
		$state = $_POST['state'];
	}
}

// Get City
if(isset($_POST['city']) != '' ){
	if (isset($_POST['city']) && $_POST['city'] != 'null') {
		$city = $_POST['city'];
		$_POST['city'] = $city;
	} elseif ((isset($_POST['city']) && $_POST['city'] == 'null')) {
		$city = '';
		$_POST['city'] = $city;
	} else {
		$city = $_POST['city'];
	}
}

// Get Marital Status
if(isset($_POST['m_status']) != '' ){
	if (isset($_POST['m_status']) && $_POST['m_status'] != 'null') {
		$m_status = str_replace(",", "','", $_POST['m_status']);
		$_POST['m_status'] = $m_status;
	} else if (isset($_POST['m_status']) && $_POST['m_status'] == 'null') {
		$m_status = '';
		$_POST['m_status'] = $m_status;
	} else {
		$m_status = $_POST['m_status'];
	}
}

// Get Physical Status
if(isset($_POST['physical_status']) != '' ){
	if (isset($_POST['physical_status']) && $_POST['physical_status'] != 'null') {
		$physical_status = str_replace(",", "','", $_POST['physical_status']);
		$_POST['physical_status'] = $physical_status;
	} else if (isset($_POST['physical_status']) && $_POST['physical_status'] == 'null') {
		$physical_status = '';
		$_POST['physical_status'] = $physical_status;
	} else {
		$physical_status = $_POST['physical_status'];
	}
}

// Get Mother Tongue Id
if(isset($_POST['m_tongue']) != '' ){
	if (isset($_POST['m_tongue']) && $_POST['m_tongue'] != 'null') {
		$m_tongue = $_POST['m_tongue'];
		$_POST['m_tongue'] = $m_tongue;
	} elseif ((isset($_POST['m_tongue']) && $_POST['m_tongue'] == 'null')) {
		$m_tongue = '';
		$_POST['m_tongue'] = $m_tongue;
	} else {
		$m_tongue = $_POST['m_tongue'];
	}
}

// Get Education Id
if(isset($_POST['education']) != '' ){
	if (isset($_POST['education']) && $_POST['education'] != 'null') {
		$education = $_POST['education'];
		$_POST['education'] = $education;
	} elseif ((isset($_POST['education']) && $_POST['education'] == 'null')) {
		$education = '';
		$_POST['education'] = $education;
	} else {
		$education = $_POST['education'];
	}
}

// Get Height From
if(isset($_POST['fromheight']) != '' ){
	if (isset($_POST['fromheight']) && $_POST['fromheight'] != 'null') {
		$fromheight = $_POST['fromheight'];
		$_POST['fromheight'] = $fromheight;
	} elseif ((isset($_POST['fromheight']) && $_POST['fromheight'] == 'null')) {
		$fromheight = '';
		$_POST['fromheight'] = $fromheight;
	} else {
		$fromheight = $_POST['fromheight'];
	}
}

// Get Height To
if(isset($_POST['toheight']) != '' ){
	if (isset($_POST['toheight']) && $_POST['toheight'] != 'null') {
		$toheight = $_POST['toheight'];
		$_POST['toheight'] = $toheight;
	} elseif ((isset($_POST['toheight']) && $_POST['toheight'] == 'null')) {
		$toheight = '';
		$_POST['toheight'] = $toheight;
	} else {
		$toheight = $_POST['toheight'];
	}
}

// Get Photo
if(isset($_POST['photo_search']) != '' ){
	if (isset($_POST['photo_search']) && $_POST['photo_search'] != 'null') {
		$photo = $_POST['photo_search'];
		$_POST['photo_search'] = $photo;
	} elseif ((isset($_POST['photo_search']) && $_POST['photo_search'] == 'null')) {
		$photo = '';
		$_POST['photo_search'] = $photo;
	} else {
		$photo = $_POST['photo_search'];
	}
}

// Get Photo
if(isset($_POST['profile_latest_register']) != '' ){
	if (isset($_POST['profile_latest_register']) && $_POST['profile_latest_register'] != 'null') {
		$profile_latest_register = $_POST['profile_latest_register'];
		$_POST['profile_latest_register'] = $profile_latest_register;
	} elseif ((isset($_POST['profile_latest_register']) && $_POST['profile_latest_register'] == 'null')) {
		$profile_latest_register = '';
		$_POST['profile_latest_register'] = $profile_latest_register;
	} else {
		$profile_latest_register = $_POST['profile_latest_register'];
	}
}

/*if (isset($_POST['keyword']) && $_POST['keyword'] != 'null') {
	$keyword = '';
	$_POST['keyword'] = $keyword;
} elseif ((isset($_POST['keyword']) && $_POST['keyword'] == 'null')) {
	$keyword = '';
	$_POST['keyword'] = $keyword;
} else {
	$keyword = '';
}*/

/*if (isset($_POST['orderby']) && $_POST['orderby'] != 'null') {
	$orderby = $_POST['orderby'];
	$_POST['orderby'] = $orderby;
} elseif ((isset($_POST['orderby']) && $_POST['orderby'] == 'null')) {
	$orderby = '';
	$_POST['orderby'] = $orderby;
} else {
	$orderby = $_POST['orderby'];
}*/

/*if (isset($_POST['tot_children']) && $_POST['tot_children'] != 'null') {
	$tot_children = $_POST['tot_children'];
	$_POST['tot_children'] = $tot_children;
} elseif ((isset($_POST['tot_children']) && $_POST['tot_children'] == 'null')) {
	$tot_children = '';
	$_POST['tot_children'] = $tot_children;
} else {
	$tot_children = $_POST['tot_children'];
}
*/

// Get Occupation
if(isset($_POST['occupation']) != '' ){
	if (isset($_POST['occupation']) && $_POST['occupation'] != 'null') {
		$occupation = $_POST['occupation'];
		$_POST['occupation'] = $occupation;
	} elseif ((isset($_POST['occupation']) && $_POST['occupation'] == 'null')) {
		$occupation = '';
		$_POST['occupation'] = $occupation;
	} else {
		$occupation = $_POST['occupation'];
	}
}

// Get Annual Income
if(isset($_POST['annual_income']) != '' ){
	if (isset($_POST['annual_income']) && $_POST['annual_income'] != 'null') {
		$annual_income = $_POST['annual_income'];
		$_POST['annual_income'] = $annual_income;
	} elseif ((isset($_POST['annual_income']) && $_POST['annual_income'] == 'null')) {
		$annual_income = '';
		$_POST['annual_income'] = $annual_income;
	} else {
		$annual_income = $_POST['annual_income'];
	}
}


// Get Diet
if(isset($_POST['diet']) != '' ){
	if (isset($_POST['diet']) && $_POST['diet'] != 'null') {
		$diet = str_replace(",", "','", $_POST['diet']);
		$_POST['diet'] = $diet;
	} elseif ((isset($_POST['diet']) && $_POST['diet'] == 'null')) {
		$diet = '';
		$_POST['diet'] = $diet;
	} else {
		$diet = $_POST['diet'];
	}
}

// Get Drink 
if(isset($_POST['drink']) != '' ){
	if (isset($_POST['drink']) && $_POST['drink'] != 'null') {
		$drink = str_replace(",", "','", $_POST['drink']);
		$_POST['drink'] = $drink;
	} elseif ((isset($_POST['drink']) && $_POST['drink'] == 'null')) {
		$drink = '';
		$_POST['drink'] = $drink;
	} else {
		$drink = $_POST['drink'];
	}
}

// Get Smoke
if(isset($_POST['smoking']) != '' ){
if (isset($_POST['smoking']) && $_POST['smoking'] != 'null') {
	$smoking = str_replace(",", "','", $_POST['smoking']);
	$_POST['smoking'] = $smoking;
} elseif ((isset($_POST['smoking']) && $_POST['smoking'] == 'null')) {
	$smoking = '';
	$_POST['smoking'] = $smoking;
} else {
	$smoking = $_POST['smoking'];
}
}

/*if (isset($_POST['complexion']) && $_POST['complexion'] != 'null') {
	$complexion = str_replace(",", "','", $_POST['complexion']);
	$_POST['complexion'] = $complexion;
} elseif ((isset($_POST['complexion']) && $_POST['complexion'] == 'null')) {
	$complexion = '';
	$_POST['complexion'] = $complexion;
} else {
	$complexion = $_POST['complexion'];
}

if (isset($_POST['bodytype']) && $_POST['bodytype'] != 'null') {
	$bodytype = str_replace(",", "','", $_POST['bodytype']);
	$_POST['bodytype'] = $bodytype;
} elseif ((isset($_POST['bodytype']) && $_POST['bodytype'] == 'null')) {
	$bodytype = '';
	$_POST['bodytype'] = $bodytype;
} else {
	$bodytype = $_POST['bodytype'];
}
*/
// Get Star
if(isset($_POST['star']) != '' ){
	if (isset($_POST['star']) && $_POST['star'] != 'null') {
		$star = str_replace(",", "','", $_POST['star']);
		$_POST['star'] = $star;
	} elseif ((isset($_POST['star']) && $_POST['star'] == 'null')) {
		$star = '';
		$_POST['star'] = $star;
	} else {
		$star = $_POST['star'];
	}
}


/*if (isset($_POST['manglik']) && $_POST['manglik'] != 'null') {
	$manglik = $_POST['manglik'];
	$_POST['manglik'] = $manglik;
} elseif ((isset($_POST['manglik']) && $_POST['manglik'] == 'null')) {
	$manglik = '';
	$_POST['manglik'] = $manglik;
} else {
	$manglik = isset($_POST['manglik']) ? $_POST['manglik'] : "";
}*/

/*if (isset($_POST['id_search']) && $_POST['id_search'] != 'null') {
	$id_search = $_POST['id_search'];
	$_POST['id_search'] = $id_search;
} elseif ((isset($_POST['id_search']) && $_POST['id_search'] == 'null')) {
	$id_search = '';
	$_POST['id_search'] = $id_search;
} else {
	$id_search = $_POST['id_search'];
}*/

/*if ($page == 1) {
	$start = 0;
} else {
//$start = ($page - 1) * $limit;
	$start = 0;
}*/

if ($t3 != '' && $t4 != '') {
$a = "AND ((
(
date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
)
BETWEEN '$t3'
AND '$t4')";
} else {
$a = '';
}

if ($gender != '') {
$b = "and gender='$gender'";
} else {
$b = '';
}

if(isset($rel)){
	if ($rel != '') {
		$c = "and religion IN ($rel)";
	} else {
		$c = '';
	}
}
if(isset($caste)){
	if ($caste != '') {
		$d = "and caste IN ($caste)";
	} else {
		$d = '';
	}
}

if(isset($m_tongue)){
	if(isset($m_tongue)){
		if ($m_tongue != '') {
			$e = "and m_tongue IN ($m_tongue)";
		} else {
			$e = '';
		}
	}
}
if(isset($education)){
	if ($education != '') {
		$f = "and edu_detail IN ($education)";
	} else {
		$f = '';
	}
}

if(isset($occ)){
	if ($occ != '') {
		$g = "and occupation IN ($occ)";
	} else {
		$g = '';
	}
}

if(isset($m_status)){
	if ($m_status != 'Any' && $m_status != '') {
		$h = "and m_status IN ('$m_status')";
	} else {
		$h = '';
	}
}

if(isset($con)){
	if ($con != '') {
		$i = "and country_id IN ($con)";
	} else {
		$i = '';
	}
}

if(isset($state)){
	if ($state != '') {
		$j = "and state_id IN ($state)";
	} else {
		$j = '';
	}
}

if(isset($city)){
	if ($city != '') {
		$k = "and city IN ($city)";
	} else {
		$k = '';
	}
}
if(isset($fromheight) && isset($toheight)){
	if ($fromheight != '' and $toheight != '') {
		$l = "and height between '$fromheight' and '$toheight'";
	} else {
		$l = '';
	}
}
if(isset($photo)){
	if ($photo == 'Yes') {
		$n = " and photo1!='' AND photo1_approve='APPROVED' ";
	} else {
		$n = '';
	}
}

/*if ($orderby != '' && $orderby == 'register') {
$o = "order by reg_date DESC";
} else {
$o = '';
}
if ($orderby != '' && $orderby == 'login') {
$p = "order by last_login DESC";
} else {
$p = '';
}*/

/*if ($tot_children != '') {
$q = "and tot_children='$tot_children'";
} else {
$q = '';
}*/
if(isset($annual_income)){
	if ($annual_income != '') {
		$s = "and income='$annual_income'";
	} else {
		$s = '';
	}
}
if(isset($diet)){
	if ($diet != '') {
	$t = "and diet IN ('$diet')";
	} else {
	$t = '';
	}
}
if(isset($drink)){
	if ($drink != '') {
		$u = "and drink IN ('$drink')";
	} else {
		$u = '';
	}
}
if(isset($smoking)){
	if ($smoking != '') {
		$v = "and smoke IN ('$smoking')";
	} else {
		$v = '';
	}
}
/*if ($complexion != '') {
$x = "and complexion IN ('$complexion')";

} else {
$x = '';
}*/
/*if ($bodytype != '') {
$y = "and bodytype IN ('$bodytype')";
} else {
$y = '';
}*/
if(isset($star)){
	if ($star != '') {
		$z = "and star IN ('$star')";
	} else {
		$z = '';
	}
}
if(isset($manglik)){
	if ($manglik != '') {
		$a1 = "and manglik='$manglik'";
	} else {
		$a1 = '';
	}
}
/*if ($id_search != '') {
$r = "and matri_id='$id_search'";
} else {
$r = '';
}*/
/*if ($profile_latest_register == '1') {
$d123 = 1;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123 . " day");
$exp_date = date('Y-m-d h:i:s', $date);
$aa = "and reg_date>'" . $exp_date . "'";
} elseif ($profile_latest_register == '2') {
$d123 = 3;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123 . " day");
$exp_date = date('Y-m-d h:i:s', $date);
$aa = "and reg_date >'" . $exp_date . "'";
} elseif ($profile_latest_register == '3') {
$d123 = 7;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123 . " day");
$exp_date = date('Y-m-d h:i:s', $date);
$aa = "and reg_date>'" . $exp_date . "'";
} elseif ($profile_latest_register == '4') {
$d123 = 30;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123 . " day");
$exp_date = date('Y-m-d h:i:s', $date);
$aa = "and reg_date>'" . $exp_date . "'";
} else {
$aa = '';
}*/
if(isset($physical_status)){
	if ($physical_status != '') {
		$ab = "and physicalStatus IN ('$physical_status')";
	} else {
		$ab = "";
	}
}
$rows=($DatabaseCo->dbLink->query("SELECT index_id FROM register_view WHERE status!='Inactive' AND status!='Suspended' $a $b $c $d $e $f $g $h $i $j $k $l $n $q $s $t $u $v $x $y $z $ab $a1 "));
$sql = "select * from register_view where status!='Inactive' and status!='Suspended' $a $b $c $d $e $f $g $h $i $j $k $l $n $q $s $t $u $v $x $y $z $ab $a1  order by fstatus desc";
$data = $DatabaseCo->dbLink->query($sql);
$res = array();

if (mysqli_num_rows($data) > 0) {
	$count=0;
	while ($contact_res = mysqli_fetch_object($data)){
			$matri_id=$contact_res->matri_id;
			$login_id=$_POST['login_matri_id'];
		
			// Check interest sent or not
			$GET_INTEREST_LIST = $DatabaseCo->dbLink->query("SELECT * FROM expressinterest WHERE ei_sender='$login_id' AND ei_receiver='$matri_id'"); 
			if(mysqli_num_rows($GET_INTEREST_LIST) > 0){
				$getinsertdata = mysqli_fetch_object($GET_INTEREST_LIST);
				$ei_id=$getinsertdata->ei_id;
				if($ei_id==""){
					$mes="0";
				}else{
					$mes="1";
				}
			}else{
				$mes="0";
			}
			// Check Blocked or not
			$GET_BLOCK_LIST = $DatabaseCo->dbLink->query("SELECT * FROM block_profile WHERE block_by='$login_id' AND block_to='$matri_id'"); 
			if(mysqli_num_rows($GET_BLOCK_LIST) > 0){
				$getblockdata =  mysqli_fetch_object($GET_BLOCK_LIST);
				$block_id=$getblockdata->block_id;
				if($block_id==""){
					$block="0";
				}else{
					$block="1";
				}
			}else{
				$block="0";
			}
			
			// Check Shortlisted or not
			$GET_SHORT_LIST = $DatabaseCo->dbLink->query("SELECT * FROM shortlist WHERE from_id='$login_id' AND to_id='$matri_id'"); 
			if(mysqli_num_rows($GET_SHORT_LIST) > 0){
				$getshortdata =  mysqli_fetch_object($GET_SHORT_LIST);
				$sh_id=$getshortdata->sh_id;
				if($sh_id==""){
					$sh="0";
				}else{
					$sh="1";
				}
			}else{
				$sh="0";
			}
			
		
			// Get Height
			$ao3 = $contact_res->height;
			$ft3 = (int) ($ao3 / 12);
			$inch3 = $ao3 % 12;
			$height=$ft3 . "ft" . " " . $inch3 . "in";
			
			// Get Age
			$age=floor((time() - strtotime($contact_res->birthdate)) / 31556926);
			
			// Get Occupation,Country,State,City,Religion,Caste Name
			$ocp8 = $contact_res->ocp_name;
			$country_name8= $contact_res->country_name;
			$state8= $contact_res->state_name;
			$city8= $contact_res->city_name;
			$re = $contact_res->religion_name;
			$ca = $contact_res->caste_name;
		
			// Get Education Details
			$edu_detail = $contact_res->edu_detail;
			$sel_plan1 = $DatabaseCo->dbLink->query("SELECT * FROM `education_detail` WHERE  edu_id  in ($edu_detail)");
			$edu_name3 = array();
			while ($contact_res1 = mysqli_fetch_object($sel_plan1)){
				$edu_name3[] = $contact_res1->edu_name;
			}
			$edu5=implode(",",$edu_name3);
			$ed= explode(",",$edu5);
			$edu_fname=$ed[0];
			$add_fname=$ed[1];
			
            

			// Get Photo
 			if(isset($contact_res)){
				if($contact_res->photo1_approve == 'UNAPPROVED' && $contact_res->photo1 !='' ){
					if($contact_res->gender=="Female"){
						$photo=$site_data->web_name."/img/app_img/female-photo-pending-approval.jpg";
					}else{
						$photo=$site_data->web_name."/img/app_img/male-photo-pending-approval.jpg";
					}
				}else {
					if(($contact_res->photo1!="" && $contact_res->photo1_approve=='APPROVED') && (($contact_res->photo_view_status=='1') || ($contact_res->photo_view_status=='2' && $contact_res->status=='Paid')) && (($contact_res->photo_protect=='No') || ($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd==''))){
						$photo=$site_data->web_name."/my_photos/".$contact_res->photo1;
					}elseif($contact_res->photo_protect=="Yes" && $contact_res->photo_pswd!=''){
						if($contact_res->gender=='Male'){
							$photo=$site_data->web_name."/img/app_img/male-photo-protected.jpg";
						}else{
							$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
						}
					}elseif($contact_res->gender=='Male'){
						$photo=$site_data->web_name."/img/app_img/male-upload-photo.jpg";
					}else{
						$photo=$site_data->web_name."/img/app_img/female-photo-protected.jpg";
					}
				}
			}

            $status = $contact_res->status;
			if($status=="Paid"){
				$st="1";
			}else{
				$st="0";
			}
			if($site_data->username_setting == 'full_username'){
				$name=$contact_res->username;
			}elseif($site_data->username_setting == 'first_surname'){
				$name=$contact_res->firstname." ".substr($contact_res->lastname, 0, 1);
			}else{
				$name='';
			}
			$all="$age"."Yrs,"."$height".","."$add_fname".","."$re".","."$ca".","."$city8".","."$country_name8";
			$count++;
			$response['responseData'][$count] = array('user_id' => $contact_res->index_id,'matri_id' => $contact_res->matri_id,'birthdate' => $contact_res->birthdate,'ocp_name' =>"$ocp8",'height' =>"$height",'city_name' => $contact_res->city_name,'country_name' => $contact_res->country_name,'photo1_approve' => $contact_res->photo1_approve,'photo_view_status' => $contact_res->photo_view_status,'photo_protect' => $contact_res->photo_protect,'photo_pswd' => $contact_res->photo_pswd,'gender' => $contact_res->gender,'username' => "$name",'is_shortlisted' => "$sh",'is_blocked' => "$block",'is_favourite' => "$mes",'user_profile_picture' =>"$photo",'profile_text'=>"$all",'caste' =>"$ca",'edu_detail' =>"$add_fname",'addition_detail' =>"$edu_fname", 'state_name' =>"$state8",'country_name' =>"$country_name8",'religion_name' =>"$re",'city_name' => "$city8",'age'=>"$age",'member_status'=>"$st",'status'=>"1",'tokan'=>"$contact_res->tokan");
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