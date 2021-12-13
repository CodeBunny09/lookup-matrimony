<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
$matri_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
$get_memdata = mysqli_fetch_object($DatabaseCo->dbLink->query("select * from register where matri_id='" . $matri_id . "'"));
include 'auth.php';

$SQL_STATEMENT_SETTINGS=$DatabaseCo->dbLink->query("SELECT profile_view_setting,username_setting FROM site_config WHERE id='1'");
$site_settings=mysqli_fetch_object($SQL_STATEMENT_SETTINGS);

if($site_settings->profile_view_setting == 'visible_to_paid'){
	if($_SESSION['mem_status'] != 'Paid'){
		echo "<script>alert('Your View Profile balance is over, to see furthur member\'s profile, please upgrade your membership');</script>";
		echo "<script>window.location='myHome.php'</script>";   
	}
}
$trans = array("(" => "", ")" => "", "-" => "", " " => "", "'" => "");
$view_id = isset($_GET['view_id']) ? $_GET['view_id'] : '';
$view_id = strtr($view_id, $trans);

if(isset($view_id)){
	$check_paid = $DatabaseCo->dbLink->query("select * from register_view where matri_id='$matri_id'");
	$Row_check = mysqli_fetch_object($check_paid);
	$status = $Row_check->status;
    /*$whocheck=$DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile where my_id='$matri_id' and viewed_member_id='$view_id'");
    if($whocheck->num_rows==0 && $status=="Paid"){
        $insert=$DatabaseCo->dbLink->query("insert into who_viewed_my_profile(my_id,viewed_member_id,viewed_date) values('$matri_id','$view_id',now())");
    } else {
    	$update=$DatabaseCo->dbLink->query("update who_viewed_my_profile set my_id='$matri_id',viewed_member_id='$view_id',viewed_date=now() where my_id='$matri_id' and viewed_member_id='$view_id'");    
    }*/
	if($site_settings->profile_view_setting == 'visible_to_paid'){
		$sel=$DatabaseCo->dbLink->query("SELECT * FROM payments where pmatri_id='$matri_id'"); 
		$fet=mysqli_fetch_object($sel);
		$whocheck=$DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile where my_id='$matri_id' and viewed_member_id='$view_id'");
		$tot_profile=$fet->profile;
		$use_profile=$fet->r_profile;
		if($whocheck->num_rows==0){
			echo $use_profile=$use_profile+1;
		}
		if($tot_profile>=$use_profile){
		  $update="UPDATE payments SET r_profile='$use_profile' WHERE pmatri_id='$matri_id' ";
		  $d=$DatabaseCo->dbLink->query($update);
		  $whocheck=$DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile where my_id='$matri_id' and viewed_member_id='$view_id'");
			if($whocheck->num_rows==0 && $status=="Paid"){
				$insert=$DatabaseCo->dbLink->query("insert into who_viewed_my_profile(my_id,viewed_member_id,viewed_date) values('$matri_id','$view_id',now())");
			} else {
				$update=$DatabaseCo->dbLink->query("update who_viewed_my_profile set my_id='$matri_id',viewed_member_id='$view_id',viewed_date=now() where my_id='$matri_id' and viewed_member_id='$view_id'");    
			}
		} else {
			echo "<script>alert('Your View Profile balance is over, to see furthur member\'s profile, please upgrade your membership');</script>";
			echo "<script>window.location='myHome.php'</script>";   
		}
	}else{
		if(isset($view_id)){
			$whocheck=$DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile where my_id='$matri_id' and viewed_member_id='$view_id'");
			if($whocheck->num_rows==0){
				$insert=$DatabaseCo->dbLink->query("insert into who_viewed_my_profile(my_id,viewed_member_id,viewed_date) values('$matri_id','$view_id',now())");
			} else {
				$update=$DatabaseCo->dbLink->query("update who_viewed_my_profile set my_id='$matri_id',viewed_member_id='$view_id',viewed_date=now() where my_id='$matri_id' and viewed_member_id='$view_id'");    
			}
		}
	}
}
$sel_mem_data = mysqli_query($DatabaseCo->dbLink, "select * from register_view where matri_id='$view_id'");
$Row = mysqli_fetch_object($sel_mem_data);
if (isset($_REQUEST['req-photo'])) {
	$to = $_POST['email'];
	$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where email = '$to'");
	$rowcc = mysqli_fetch_array($result3);
	$name = $rowcc['firstname'] . " " . $rowcc['lastname'];
	$matriid = $rowcc['matri_id'];
	$cpass = $rowcc['cpassword'];
	$website = $rowcc['web_name'];
	$cpass = $rowcc['cpassword'];
	$webfriendlyname = $rowcc['web_frienly_name'];
	$from = $rowcc['from_email'];
	$DatabaseCo->dbLink->query("INSERT INTO reminder (rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('','$matri_id','$matriid','photo_req','Sent','Yes','Yes',NOW())");
	$result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Photo Password Request'");
	$rowcs5 = mysqli_fetch_array($result45);
	$subject = $_REQUEST['msg'];
	$message = $rowcs5['EMAIL_CONTENT'];
	$email_template = htmlspecialchars_decode($message, ENT_QUOTES);
	$trans = array("your site name" => $webfriendlyname, "yourname" => $name, "xyz" => $_SESSION['uname'], "email_id" => $to, "cpass" => $cpass, "site domain name" => $website, "../images/" => "", "my_email" => $to);
	$email_template = strtr($email_template, $trans);
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From:' . $from . "\r\n";
	mail($to, $subject, $email_template, $headers);
	$result = "Your Request has been Sent to the member Successfully.";
	echo "<script>alert('" . $result . "');</script>";
}
if (isset($_REQUEST['req-password'])) {
	$msg = $_REQUEST['msg'];
	$strresponse = "Pending";
	$receiver = $_POST['recever_id'];
	$insert = $DatabaseCo->dbLink->query("insert into photoprotect_request(ph_requester_id,ph_receiver_id,ph_msg,ph_reqdate,
	receiver_response,status) values ('$matri_id','$receiver','$msg',now(),'$strresponse','1')");
	$DatabaseCo->dbLink->query("INSERT INTO reminder (rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) VALUES ('','$matri_id','$receiver','photo_pass_req','Sent','Yes','Yes',NOW())");
	$sql_noti = "INSERT INTO notification (sender_id,receiver_id,notification,notification_type,seen,date) VALUES ('$matri_id','$receiver','Photo Password Request Received','Photo Password','No',now())";
					$DatabaseCo->dbLink->query($sql_noti);
	$result = "Your Request has been Sent to the member Successful.(Note : Your Request password will be sent to your email after your receiver responded.) ";
	echo "<script>alert('" . $result . "');</script>";
}
$j = 0;
$get_photo = $Row->photo1 . ',' . $Row->photo2 . ',' . $Row->photo3 . ',' . $Row->photo4 . ',' . $Row->photo5 . ',' . $Row->photo6 . ',' . $Row->photo1_approve . ',' . $Row->photo2_approve . ',' . $Row->photo3_approve . ',' . $Row->photo4_approve . ',' . $Row->photo5_approve . ',' . $Row->photo6_approve;
$get_photo = explode(",", $get_photo);


$a=0;
if(($Row->photo1) !=  '' && ($Row->photo1_approve) == 'APPROVED'){
	$a++;
}
if(($Row->photo2) !=  '' && ($Row->photo2_approve) == 'APPROVED'){
	$a++;
}
if(($Row->photo3) !=  '' && ($Row->photo3_approve) == 'APPROVED'){
	$a++;
}
if(($Row->photo4) !=  '' && ($Row->photo4_approve) == 'APPROVED'){
   $a++;
}
if(($Row->photo5) !=  '' && ($Row->photo5_approve) == 'APPROVED'){
   $a++;
}
if(($Row->photo6) !=  '' && ($Row->photo6_approve) == 'APPROVED'){
   $a++;
}

$sql_exp = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM expressinterest,register_view WHERE ei_receiver='" . $Row->matri_id . "' and ei_sender='" . $_SESSION['user_id'] . "' and trash_sender='No'"));

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT sub_caste,will_to_marry,weight,body_type,complexion,physical_status,additional_degree,annual_income,diet,smoke,drink,dosh,star,rasi,birthtime,birthplace,family_profile,family_status,family_type,family_value,father_occupation,mother_occupation,no_of_brother,no_of_married_brother,no_of_sister,no_of_married_sister,profile_text,part_physical_status,part_diet,part_drink,part_smoke,part_dosh,part_star,part_state,part_city,part_annual_income,part_rasi,part_expect FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="#549a11">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#549a11">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
    <!-- WEB SITE TITLE DESCRIPTION-->
    <title>
      <?php echo $configObj->getConfigFname(); ?>
    </title>
    <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
    <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
    <!-- WEB SITE TITLE DESCRIPTION END--> 
    <!-- WEB SITE FAVICON--> 
    <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
    <!-- WEB SITE FAVICON END--> 
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom-responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/developer.css" rel="stylesheet">
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->
     <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->
    <!---- CHOSEN CSS----->
    <link rel="stylesheet" href="css/prism.css">
    <link rel="stylesheet" href="css/chosen.css">
    <!---- CHOSEN CSS END----->
    <!--OWL CAROUSEL CSS-->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <!--OWL CAROUSEL CSS END-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
  </head>
  <body>
    <!-- ICON LOADER-->
    <div class="preloader-wrapper text-center">
      <div class="loader">
      </div>
      <h5>Loading...
      </h5>
    </div>
    <!-- ICON LOADER END-->
    <div id="body" style="display:none">
      <div id="wrap">
        <div id="main">
          <?php include "parts/header.php"; ?>
          <?php include "parts/menu-aft-login.php"; ?>
          <?php ?>
          <div class="container">
            <div class="row">
              <div class="col-xxl-14 col-xxl-offset-1 col-xl-16 col-xl-offset-0 col-lg-16 col-md-16 col-sm-16">
                <h3 class="gt-text-orange">
                  <?php echo $Row->matri_id; ?> - 
                   <?php if($site_settings->username_setting == 'full_username'){?>
                  														<?php echo $Row->username; ?>
																	  	<?php }elseif($site_settings->username_setting == 'first_surname'){?>
																		<?php echo $Row->firstname." ".substr($Row->lastname, 0, 1); ?>
																	<?php }else{ ?>
																	<?php } ?> 
                </h3>
              </div>
            </div>	
          </div>
          <div id="loaderID"></div>
          <div class="container gt-view-profile gt-margin-top-15">
            <div class="row">
              <div class="col-xxl-14 col-xxl-offset-1 col-xl-16 col-xl-offset-0 col-lg-16 col-md-16 col-sm-16">
                <div class="row">
                  <div class="col-xxl-4 col-xxl-offset-0 col-xl-4 col-xl-offset-0 col-xs-16 col-sm-16 col-md-8 col-md-offset-4 col-lg-4 col-lg-offset-0">
                    <?php if ($Row->photo_protect == "Yes" && $Row->photo_pswd != '') { ?>
                    <a data-toggle="modal" data-target="#myModal5" title="View Contact Details" class="thumbnail gt-cursor gt-margin-bottom-0" onClick="send_pass_req('<?php echo $Row->matri_id; ?>');" >
                      <?php include('parts/search-result-photo.php'); ?>
                      <span class="gtMemAlbum">
                        <?php echo $a; ?>
                      </span>
                    </a>
                    <?php } else { ?>      
                    <a class="thumbnail gt-cursor gt-margin-bottom-0" data-toggle="modal" data-target="#myModal5" onClick="photoview('<?php echo $Row->matri_id; ?>');">
                      <?php include('parts/search-result-photo.php'); ?>
                      <span class="gtMemAlbum">
                        <?php echo $a; ?>
                      </span>
                    </a>
                    <?php }
?>
                  </div>
                  <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-lg-12">
                    <div class="gt-panel gt-panel-default">
                      <div class="gt-panel-head">
                        <span class="pull-left">
                          <i class="fa fa-file">
                          </i>Basic Details
                        </span>
                      </div>
                      <div class="gt-panel-body">
                        <div class="row">
                          <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            <div class="row">
                              <div class="col-xs-7">
                                Name  :
                              </div>
                              <div class="col-xs-9">
                                <b>
                                  <?php echo $Row->firstname . ' ' . $Row->lastname; ?>
                                </b>
                              </div>	
                            </div>
                          </div>
                          <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            <div class="row">
                              <div class="col-xs-7">
                                Marital Status:
                              </div>
                              <div class="col-xs-9">
                                <b>
                                  <?php
									if ($Row->m_status != "") {
									echo $Row->m_status;
									} else {
									echo 'Not Available';
									}
								   ?>
                                </b>
                              </div>	
                            </div>
                          </div>
                          <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            <div class="row">
                              <div class="col-xs-7">
                                No Of Children:
                              </div>
                              <div class="col-xs-9">
                                <b>
                                  <?php
									if ($Row->m_status != 'Never Married') {
									if ($Row->tot_children != '') {
									echo $Row->tot_children;
									} else {
									echo "No Children";
									}
									} else {
									echo 'Not Married';
									}
								  ?>
                                </b>
                              </div>	
                            </div>
                          </div>
                          <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            <div class="row">
                              <div class="col-xs-7">
                                Children Living Status:
                              </div>
                              <div class="col-xs-9">
                                <b>
                                  <?php
if ($Row->m_status != 'Never Married') {
if ($Row->status_children != '') {
echo $Row->tot_children;
} else {
echo "No Children";
}
} else {
echo 'Not Married';
}
?>
                                </b>
                              </div>	
                            </div>
                          </div>
                          <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            <div class="row">
                              <div class="col-xs-7">
                                Mother Tongue :
                              </div>
                              <div class="col-xs-9">
                                <b>
                                  <?php
									$m_tongue = $Row->m_tongue;
									$SQL_STATEMENT_mtongue = $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE mtongue_id='$m_tongue'  ORDER BY mtongue_name ASC");
									$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_mtongue);
									echo $DatabaseCo->Row->mtongue_name;
									?>
                                </b>
                              </div>	
                            </div>
                          </div>
                          <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            <div class="row">
                              <div class="col-xs-7">
                                Profile Created By  :
                              </div>
                              <div class="col-xs-9">
                                <b>
                                  <?php
									if ($Row->profileby != '') {
									echo $Row->profileby;
									} else {
									echo "No";
									}
									?>
                                </b>
                              </div>	
                            </div>
                          </div>
                        </div>
                      </div>
					  <?php if($row_field->profile_text == 'Yes'){ ?>
                      <div class="gt-panel gt-panel-default gt-margin-top-10">
                        <div class="gt-panel-head">
                          <span class="pull-left">
                            <i class="fa fa-star">
                            </i>About Me
                          </span>
                        </div>
                        <div class="gt-panel-body" >
                          <div class="row">
                            <div class="col-xxl-16 col-xl-16 col-lg-16 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                              <article>
                                <?php if($Row->profile_text_approve == 'Pending' || $Row->profile_text_approve == 'Unapproved' ){?>
                                  		<h4 class="text-center text-danger">About me is under approval or Unapproved.</h4>
                                  	<?php }else{?>
								  <p><?php echo $Row->profile_text; ?></p>
                                  	<?php }?>
                               
                              </article>
                            </div>
                          </div>
                        </div>
                      </div>
					   <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="btn-group btn-group-justified gt-margin-bottom-15 gtMemProfileBtn" role="group" aria-label="...">
                  <?php
					if (isset($sql_exp) && $sql_exp->receiver_response == 'Pending') {
					?>
                  <div class="btn-group" role="group">
                    <button type="button" title="Send Reminder" onClick="sendreminder(<?php echo $sql_exp->ei_id ?>);" id="reminder<?php echo $sql_exp->ei_id; ?>" class="gt-cursor btn btn-default">
                      <i class="fa fa-bell">
                      </i>
                       <p class="hidden-xs hidden-sm hidden-md">
                        Send Reminder
                      </p>
                    </button>
                  </div>
                  <?php
} else {
?>
                  <div class="btn-group" role="group">
                    <button type="button" data-toggle="modal" data-target="#myModal1" title="Send Interest" onclick="ExpressInterest('<?php echo $Row->matri_id; ?>')" class="gt-cursor btn btn-default">
                      <i class="fa fa-star">
                      </i>
                        <p class="hidden-xs hidden-sm hidden-md">
                        Send Express Interest
                      </p>
                    </button>
                  </div>
                  <?php } ?>
                  <div class="btn-group " role="group">
                    <button type="button" data-toggle="modal" data-target="#myModal2" title="View Contact Details" onClick="checkcontactcount('<?php echo $Row->matri_id; ?>')" class="gt-cursor btn btn-default">
                      <i class="fa fa-phone">
                      </i>
                       <p class="hidden-xs hidden-sm hidden-md">
                        View Contact Details
                      </p>
                    </button>
                  </div>
                  <div class="btn-group" role="group">
                    <a href="<?php
                             if (isset($_SESSION['user_id'])) {
                             echo "composeMessages?user_id=" . $Row->matri_id . "";
                                                                                  } else {
                                                                                  echo "login";
                                                                                              }
                                                                                              ?>" class="btn btn-default">
                      <i class="fa fa-envelope">
                      </i>
                       <p class="hidden-xs hidden-sm hidden-md">
                        Send Personal Message
                      </p>
                    </a>
                  </div>
                  <?php
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$select1 = $DatabaseCo->dbLink->query("select block_id from block_profile where block_by='" . $user_id . "' and block_to='" . $Row->matri_id . "'");
if (mysqli_num_rows($select1) == 0) {
?>
                  <div class="btn-group" role="group">
                    <a class="btn btn-default gt-cursor <?php
                              if (isset($_SESSION['user_id'])) {
                              echo "addToshort-data";
                                                    }
                                                    ?>" id="<?php echo $Row->matri_id; ?>" title="Add to Blocklist">
                      <i class="fa fa-ban">
                      </i>
                       <p class="hidden-xs hidden-sm hidden-md">
                        Add to Blocklist
                      </p>
                    </a>
                  </div>         
                  <?php } else { ?> 
                  <div class="btn-group" role="group">
                    <a class="btn btn-default gt-cursor <?php
                              if (isset($_SESSION['user_id'])) {
                              echo "addToblock-data";
                                                    }
                                                    ?>" id="<?php echo $Row->matri_id; ?>" title="Remove Blocklist">
                      <i class="fa fa-ban">
                      </i>
                      <p class="hidden-xs hidden-sm hidden-md">
                        Remove Blocklist
                      </p>
                    </a>
                  </div>         
                  <?php
}
$select = $DatabaseCo->dbLink->query("select sh_id from shortlist where to_id='" . $Row->matri_id . "' and from_id='" . $user_id . "'");
if (mysqli_num_rows($select) == 0) {
?>
                  <div class="btn-group" role="group">
                    <a class="btn btn-default gt-cursor <?php
                              if (isset($_SESSION['user_id'])) {
                              echo "addToshort-link";
                                                    }
                                                    ?>" id="<?php echo $Row->matri_id; ?>" title="Add to Shortlist">
                      <i class="fa fa-sort">
                      </i>
                      <p class="hidden-xs hidden-sm hidden-md">
                        Add to Shortlist
                      </p>
                    </a>
                  </div>          
                  <?php } else { ?>
                  <div class="btn-group" role="group">
                    <a class="btn btn-default gt-cursor <?php
                              if (isset($_SESSION['user_id'])) {
                              echo "addToblock-link";
                                                    }
                                                    ?>" id="<?php echo $Row->matri_id; ?>" title="Remove From Shortlist">
                      <i class="fa fa-sort">
                      </i>
                       <p class="hidden-xs">
                        Remove From Shortlist
                      </p>
                    </a>
                  </div>    
                  <?php } ?>                    
                </div>
                <div class="gt-panel gt-panel-default">
                  <div class="gt-panel-head">
                    <span class="pull-left">
                      <i class="fa fa-book">
                      </i>Physical Attributes
                    </span>
                  </div>
                  <div class="gt-panel-body" >
                    <div class="row">
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Height  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
								$ao2 = $Row->height;
								$ft2 = (int) ($ao2 / 12);
								$inch2 = $ao2 % 12;
								echo $ft2 . "ft" . " " . $inch2 . "in";
								?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php if($row_field->weight == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Weight  :
                          </div>
                          <div class="col-xs-10">
                            <b> 
                              <?php echo $Row->weight . ' Kg'; ?>  
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->body_type == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Body type  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if ($Row->bodytype != '') {
echo $Row->bodytype;
} else {
echo "No";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->complexion == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Complexion  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if ($Row->complexion != '') {
echo $Row->complexion;
} else {
echo "No";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Physical status  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if ($Row->physicalStatus != '') {
echo $Row->physicalStatus;
} else {
echo "No";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="gt-panel gt-panel-default" >
                  <div class="gt-panel-head">
                    <span class="pull-left">
                      <i class="fa fa-book">
                      </i>Religion Information
                    </span>
                  </div>
                  <div class="gt-panel-body" >
                    <div class="row">
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Religion :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
$religion = $Row->religion;
$SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT religion_name FROM religion WHERE religion_id='$religion'");
$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_religion);
echo $DatabaseCo->Row->religion_name;
?>
                            </b>
                          </div>	
                        </div>
                      </div>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Caste :
                          </div>
                          <div class="col-xs-10">
                            <b> 
                              <?php
$caste = $Row->caste;
$SQL_STATEMENT_caste = $DatabaseCo->dbLink->query("SELECT caste_name FROM caste WHERE caste_id='$caste'");
$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste);
echo $DatabaseCo->Row->caste_name;
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php if($row_field->sub_caste == 'Yes'){ ?>	
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Sub Caste :
                          </div>
                          <div class="col-xs-10">
                            <b> 
                              <?php
$subcaste = $Row->subcaste;
$SQL_STATEMENT_subcaste = $DatabaseCo->dbLink->query("SELECT sub_caste_name FROM sub_caste WHERE sub_caste_id='$subcaste'");
$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_subcaste);
if(isset($DatabaseCo->Row->sub_caste_name) != ''){								
echo $DatabaseCo->Row->sub_caste_name;
}else{
	echo "Not Available";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->will_to_marry == 'Yes'){ ?>	
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Willing To marry in other caste? :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php if($Row->will_to_mary_caste!='' && $Row->will_to_mary_caste=='1'){ echo "Yes"; }elseif($Row->will_to_mary_caste!='' && $Row->will_to_mary_caste=='0'){ echo "No";} else{ echo "Not Available";}?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="gt-panel gt-panel-default" >
                  <div class="gt-panel-head">
                    <span class="pull-left">
                      <i class="fa fa-university">
                      </i>Education / Profession Information
                    </span>
                  </div>
                  <div class="gt-panel-body" >
                    <div class="row">
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Highest Education  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
$get_edu = explode(",", $Row->edu_detail);
if (isset($get_edu[0]) && $get_edu[0] !== '') {
$SQL_STATEMENT_education = $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE edu_id='" . $get_edu[0] . "'  ");
$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_education);
echo $DatabaseCo->Row->edu_name;
} else {
echo "No";
}
?>    
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php if($row_field->additional_degree == 'Yes'){ ?>	
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Additional Degree   :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if (isset($get_edu[1]) && $get_edu[1] !== '') {
$SQL_STATEMENT_education = $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE edu_id='" . $get_edu[1] . "'  ");
$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_education);
echo $DatabaseCo->Row->edu_name;
} else {
echo "No";
}
?>    
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Employed in :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->emp_in != "") ? $Row->emp_in : 'Not Available'; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Occupation  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->ocp_name != "") ? $Row->ocp_name : 'Not Available'; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php if($row_field->annual_income == 'Yes'){ ?>	
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Annual Income  :
                          </div>
                          <div class="col-xs-10">
                            <b> 
                              <?php echo ($Row->income != "") ? $Row->income : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
                    </div>
                  </div>
                </div>
				<?php if($row_field->family_status == 'Yes' || $row_field->family_type == 'Yes' || $row_field->family_value == 'Yes' || $row_field->father_occupation == 'Yes' || $row_field->mother_occupation == 'Yes' || $row_field->no_of_brother == 'Yes' || $row_field->no_of_married_brother == 'Yes' || $row_field->no_of_sister == 'Yes' || $row_field->no_of_married_sister == 'Yes'){ ?>
                <div class="gt-panel gt-panel-default">
                  <div class="gt-panel-head">
                    <span class="pull-left">
                      <i class="fa fa-users">
                      </i>Family Details
                    </span>
                  </div>
                  <div class="gt-panel-body" >
                    <div class="row">
					  <?php if($row_field->family_type == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Family Type  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->family_type != "") ? $Row->family_type : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->family_status == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Family Status :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->family_status != "" ) ? $Row->family_status : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->family_value == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Family Value :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->family_value != "") ? $Row->family_value : "Not Available"; ?>
                            </b>
                          </div>  
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->father_occupation == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Father Occupation :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->father_occupation != "") ? $Row->father_occupation : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->mother_occupation == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Mother Occupation :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->mother_occupation != "") ? $Row->mother_occupation : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->no_of_brother == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            No. of Brothers  :
                          </div>
                          <div class="col-xs-10">
                            <b> 
                              <?php
if ($Row->no_of_brothers != '') {
echo $Row->no_of_brothers;
} else {
echo "No Brother";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->no_of_married_brother == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Married Brothers  :
                          </div>
                          <div class="col-xs-10">
                            <b> 
                              <?php echo ( $Row->no_marri_brother != "") ? $Row->no_marri_brother : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->no_of_sister == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            No. of Sisters  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if ($Row->no_of_sisters != '') {
echo $Row->no_of_sisters;
} else {
echo "No Sister";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->no_of_married_sister == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Married Sisters  :
                          </div>
                          <div class="col-xs-10">
                            <b> 
                              <?php echo ($Row->no_marri_sister != "") ? $Row->no_marri_sister : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
                    </div>
                  </div>
                </div>
				 <?php } ?>
				<?php if($row_field->dosh == 'Yes' || $row_field->star == 'Yes' || $row_field->rasi == 'Yes' || $row_field->birthtime == 'Yes' || $row_field->birthplace == 'Yes'){ ?>
				<div class="gt-panel gt-panel-default">
                  <div class="gt-panel-head">
                    <span class="pull-left">
                      <i class="fa fa-map-marker">
                      </i>Horoscope Information
                    </span>
                  </div>
                  <div class="gt-panel-body" >
                    <div class="row">
					  <?php if($row_field->dosh == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Have Dosh? :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if ($Row->manglik != '') {
echo $Row->manglik;
} else {
echo "No Dosh";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->star == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Star :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo $country_id = $Row->star; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->rasi == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Moonsign :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->moonsign != "") ? $Row->moonsign : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
				      <?php } ?>
					  <?php if($row_field->birthtime == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Birthtime :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->birthtime != "") ? $Row->birthtime : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->birthplace == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Birthplace :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->birthplace != "") ? $Row->birthplace : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
                      <?php if(isset($Row->hor_photo) != '' && ($Row->hor_check) == 'APPROVED'){?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Horoscope :
                          </div>
                          <div class="col-xs-10">
                            <b>
                             	<a href="#myModal" data-toggle="modal" class="btn gt-btn-orange btn-sm">View Horoscope</a>
                              
                            </b>
                          </div>	
                        </div>
                      </div>
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Horoscope</h4>
      </div>
      <div class="modal-body">
        <div class="col-xxl-16">
        	<div class="row">
        		<img src="horoscope-list/<?php echo $Row->hor_photo; ?>" class="img-responsive">
        	</div>
        </div>
        <div class="clearfix"></div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
				<?php } ?>
                <div class="gt-panel gt-panel-default">
                  <div class="gt-panel-head">
                    <span class="pull-left">
                      <i class="fa fa-map-marker">
                      </i>Location Information
                    </span>
                  </div>
                  <div class="gt-panel-body" >
                    <div class="row">
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Country  :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo $Row->country_name; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            State :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->state_name != "") ? $Row->state_name : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            City :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php echo ($Row->city_name != "") ? $Row->city_name : "Not Available"; ?>
                            </b>
                          </div>	
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="gt-panel gt-panel-default">
                  <div class="gt-panel-head">
                    <span class="pull-left">
                      <i class="fa fa-star">
                      </i>Habits And Hobbies
                    </span>
                  </div>
                  <div class="gt-panel-body" >
                    <div class="row">
					  <?php if($row_field->diet == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Diet Habits :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if ($Row->diet != '') {
echo $Row->diet;
} else {
echo "No Available";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->drink == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Drinking Habits :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if ($Row->drink != '') {
echo $Row->drink;
} else {
echo "Not Available";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
					  <?php if($row_field->smoke == 'Yes'){ ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Smoke Habits :
                          </div>
                          <div class="col-xs-10">
                            <b>
                              <?php
if ($Row->smoke != '') {
echo $Row->smoke;
} else {
echo "Not Available";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
					  <?php } ?>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Hobby :
                          </div>
                          <div class="col-xs-10 gt-word-wrap">
                            <b> 
                              <?php
if ($Row->hobby != '') {
echo $Row->hobby;
} else {
echo "Not Available";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
                      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                        <div class="row">
                          <div class="col-xs-6">
                            Language known :
                          </div>
                          <div class="col-xs-10 gt-word-wrap">
                            <b> 
                              <?php
if ($Row->language_known != '') {
$f = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS language_known  FROM   register a INNER JOIN  mothertongue b ON FIND_IN_SET(b.mtongue_id, a.language_known) > 0 where a.matri_id = '" . $Row->matri_id . "'  GROUP BY a.language_known"));
echo $f['language_known'];
} else {
echo "No Available";
}
?>
                            </b>
                          </div>	
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-16">
                  <div class="row">
                    <h4 class="text-center gt-bg-green gt-padding-top-15 gt-padding-bottom-15">
                      <i class="fa fa-heart gt-margin-right-10">
                      </i>Partner Preference
                    </h4>
                  </div>
                </div>
                <div class="col-xs-16 col-xxl-16 col-xl-16">
                  <div class="row">
                    <div class="col-xs-3 ">
                      <?php if (file_exists('my_photos/' . $get_memdata->photo1 ) && $get_memdata->photo1 != "") { ?>
                      <img src="my_photos/watermark.php?image=<?php echo $get_memdata->photo1; ?>&watermark=watermark.png" title="<?php echo $get_memdata->username; ?>" alt="<?php echo $get_memdata->matri_id; ?>" class="img-thumbnail">   
                      <?php } elseif ($get_memdata->gender == 'Male') { ?>
                      <img src="./img/male.png" title="<?php echo $get_memdata->username; ?>" alt="<?php echo $get_memdata->matri_id; ?>" class="img-thumbnail">         
                      <?php
} else {
?>  
                      <img src="./img/female.png" title="<?php echo $get_memdata->username; ?>" alt="<?php echo $get_memdata->matri_id; ?>" class="img-thumbnail">               
                      <?php } ?>
                    </div>
                    <div class="col-xs-10 text-center gt-margin-top-30">
                      <?php
$i = 0;
$pheight = '';
if ($get_memdata->height >= $Row->part_height && $get_memdata->height <= $Row->part_height_to) {
$i++;
$pheight = 1;
}
$age = floor((time() - strtotime($get_memdata->birthdate)) / 31556926);					
if ($age >= $Row->part_frm_age && $age <= $Row->part_to_age) {
$i++;
$age = 1;
}

$lok_var = explode(", ", $Row->looking_for);
if (in_array($get_memdata->m_status, $lok_var)) {
    $i++;
$lok_var = 1;
}						
															
$pmtongue = explode(",", $Row->part_mtongue);
$rasi = explode(",", $get_memdata->m_tongue);					
if(count(array_intersect($pmtongue,$rasi)) > 0){
$i++;
$pmtongue = '1';
}
						
$diet_var = explode(", ", $Row->part_diet);
if (in_array($get_memdata->diet, $diet_var)) {
$i++;
$diet_var = 1;
}
$smoke_var = explode(", ", $Row->part_smoke);
if (in_array($get_memdata->smoke, $smoke_var)) {
$i++;
$smoke_var = '1';
}
$drink_var = explode(", ", $Row->part_drink);
if (in_array($get_memdata->drink, $drink_var)) {
$i++;
$drink_var = '1';
}
$phy_var = explode(", ", $Row->part_physical);
if (in_array($get_memdata->physicalStatus, $phy_var)) {
$i++;
$phy_var = '1';
}
$part_edu = explode(",", $Row->part_edu);
$get_edu_own = explode(",", $get_memdata->edu_detail);
if (in_array($get_edu_own[0], $part_edu)) {
$i++;
$part_edu = '1';
}
$part_income = explode(".", $Row->part_income);
$income = explode(".", $get_memdata->income);						
if(count(array_intersect($part_income,$income)) > 0){
$i++;
$part_income = '1';
}						
$part_emp_in = '';
if ($get_memdata->emp_in == $Row->part_emp_in) {
$i++;
$part_emp_in = '1';
}

$partocp = explode(",", $Row->part_occu);
$my_ocp = explode(",", $get_memdata->occupation);						
if(count(array_intersect($partocp,$my_ocp)) > 0){
$i++;
$partocp = '1';
}						
						
$parrel = explode(",", $Row->part_religion);
if (in_array($get_memdata->religion, $parrel)) {
$i++;
$parrel = '1';
}
$parcaste = explode(",", $Row->part_caste);
if (in_array($get_memdata->caste, $parcaste)) {
$i++;
$parcaste = '1';
}
$ownmanglik = explode(", ", $get_memdata->manglik);
if (in_array($Row->part_manglik, $ownmanglik)) {
$i++;
$ownmanglik = '1';
}
					
$part_rasi = explode(",", $Row->part_rasi);
$rasi = explode(",", $get_memdata->moonsign);					
if(count(array_intersect($part_rasi,$rasi)) > 0){
$i++;
$part_rasi = '1';
}	

$parcnt = explode(",", $Row->part_country_living);
$mycountry = explode(",", $get_memdata->country_id);					
if(count(array_intersect($parcnt,$mycountry)) > 0){
$i++;
$parcnt  = '1';
}						
$parstate = explode(",", $Row->part_state);
$mystate = explode(",", $get_memdata->state_id);					
if(count(array_intersect($parstate,$mystate)) > 0){
$i++;
$parstate  = '1';
}						
$parcity = explode(",", $Row->part_city);
$mycity = explode(",", $get_memdata->city);					
if(count(array_intersect($parcity,$mycity)) > 0){
$i++;
$parcity  = '1';
}

?>
                      <h4>	
                        Your profile matches with 
                        <b>
                          <?php echo $i; ?> / 19
                        </b> of 
                        <b class="gt-text-orange">
                          <?php echo $Row->firstname; ?>'s
                        </b> preferences!
                      </h4>
                    </div>
                    <div class="col-xs-3">
                      <?php if ($Row->photo_protect == "Yes" && $Row->photo_pswd != '') { ?>
                      <a data-toggle="modal" data-target="#myModal5" title="View Contact Details" class="btn btn-primary btn-lg thumbnail gt-cursor" onClick="send_pass_req('<?php echo $Row->matri_id; ?>');" >
                        <?php include('parts/search-result-photo.php'); ?>
                        <span class="gtMemAlbum">
                          <?php echo $a; ?>
                        </span>
                      </a>
                      <?php } else { ?>      
                      <a class="btn btn-primary btn-lg thumbnail" data-toggle="modal" data-target="#myModal5" onClick="photoview('<?php echo $Row->matri_id; ?>');">
                        <?php include('parts/search-result-photo.php'); ?>
                        <span class="gtMemAlbum">
                          <?php echo $a; ?>
                        </span>
                      </a>
                      <?php }
?>
                    </div>
                  </div>
                </div>
                <div class="col-xs-16 col-xxl-16 gt-margin-top-15">
                  <h3 class="gt-padding-bottom-15 gt-border-bottom-smoke-white font-18">
                    <i class="fa fa-file gt-margin-right-10 gt-text-orange">
                    </i>Basic Preferences
                  </h3>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Marital Status :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php echo $Row->looking_for; ?>
                      </div>
                      <?php
if ($lok_var == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Age :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php echo $Row->part_frm_age . ' Years'; ?> &nbsp;&nbsp;&nbsp;&nbsp;To &nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo $Row->part_to_age . ' Years'; ?>
                      </div>
                      <?php
if ($age == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Height :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
$ao3 = $Row->part_height;
$ft3 = (int) ($ao3 / 12);
$inch3 = $ao3 % 12;
echo $ft3 . "ft" . " " . $inch3 . "in";
?> &nbsp;&nbsp;&nbsp;&nbsp; To  &nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
$ao2 = $Row->part_height_to;
$ft2 = (int) ($ao2 / 12);
$inch2 = $ao2 % 12;
echo $ft2 . "ft" . " " . $inch2 . "in";
?>
                      </div>
                      <?php
if ($pheight == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php if($row_field->part_diet == 'Yes'){ ?>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Eating Habits :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
if ($Row->part_diet != '') {
echo $Row->part_diet;
} else {
echo "Not Available";
}
?>
                      </div>
                      <?php
if ($diet_var == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php } ?>
                  </div>
                  <div class="row gt-margin-top-20">
					<?php if($row_field->part_smoke == 'Yes'){ ?>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Smoking Habits :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
						  
if ($Row->part_smoke != '') {
echo $Row->part_smoke;
} else {
echo "Not Available";
}
?>
                      </div>
                      <?php
if ($smoke_var == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php } ?>
					<?php if($row_field->part_drink == 'Yes'){ ?>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Drinking Habits :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
if ($Row->part_drink != '') {
echo $Row->part_drink;
} else {
echo "Not Available";
}
?>
                      </div>
                      <?php
if ($drink_var == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php } ?>
                  </div>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Physical status :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
if ($Row->part_physical != '') {
echo $Row->part_physical;
} else {
echo "No";
}
?>
                      </div>
                      <?php
if ($phy_var == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="col-xs-16 col-xxl-16 gt-margin-top-15">
                  <h3 class="gt-padding-bottom-15 gt-border-bottom-smoke-white font-18">
                    <i class="fa fa-university gt-margin-right-10 gt-text-orange">
                    </i>Education / Profession Preference
                  </h3>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Education  :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
$c = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.part_edu) >0 WHERE a.matri_id = '$view_id'  GROUP BY a.edu_detail"));
echo $c['edu_name'];
?>
                      </div>
                      <?php
if ($part_edu == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php if($row_field->part_annual_income == 'Yes'){ ?>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Annual Income:
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
if ($Row->part_income != '') {
echo $Row->part_income;
} else {
echo "Not Available";
}
?>
                      </div>
                      <?php
if ($part_income == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php } ?>
                  </div>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Employed in :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
if ($Row->part_emp_in != '') {
echo $Row->part_emp_in;
} else {
echo "No";
}
?>
                      </div>
                      <?php
if ($part_emp_in == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Occupation  :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 col-xs-11 font-14 gt-padding-top-5">
                        <?php
$part_occu = $Row->part_occu;
if ($part_occu != '') {
$SQL_STATEMENT_occ = $DatabaseCo->dbLink->query("SELECT * FROM `occupation` WHERE `ocp_id` IN ($part_occu)  ");
while ($DatabaseCo->data = mysqli_fetch_object($SQL_STATEMENT_occ)) {
echo $DatabaseCo->data->ocp_name . " , ";
}
} else {
echo "Not Available";
}
?>
                      </div>
                      <?php
if ($partocp == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="col-xs-16 col-xxl-16 gt-margin-top-15">
                  <h3 class="gt-padding-bottom-15 gt-border-bottom-smoke-white font-18">
                    <i class="fa fa-book gt-margin-right-10 gt-text-orange">
                    </i>Religion Preference
                  </h3>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Religion :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
$d = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', religion_name, ''SEPARATOR ', ' ) AS part_religion  FROM   register a INNER JOIN religion b ON FIND_IN_SET(b.religion_id, a.part_religion) > 0 where a.matri_id = '$view_id'  GROUP BY a.part_religion"));
echo $d['part_religion'];
?>
                      </div>
                      <?php
if ($parrel == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Caste :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
$e = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', caste_name, ''SEPARATOR ', ' ) AS part_sect  FROM   register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste) > 0 where a.matri_id = '$view_id'  GROUP BY a.part_caste"));
echo $e['part_sect'];
?> 
                      </div>
                      <?php
if ($parcaste == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
				  
                  <div class="row gt-margin-top-20">
					<?php if($row_field->part_dosh == 'Yes'){ ?>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Manglik :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
if ($Row->part_manglik != '') {
echo $Row->part_manglik;
} else {
echo "No";
}
?>
                      </div>
                      <?php
if ($ownmanglik == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php } ?>
                    <?php if($row_field->part_rasi == 'Yes'){ ?>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Moonsign (Raasi) :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
if ($Row->part_rasi != '') {
echo $Row->part_rasi;
} else {
echo "Not Available";
}
?> 
                        
                      </div>
                      <?php
if ($part_rasi == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php } ?>
                  </div>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Mother Tongue :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
$f = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS part_mtongue  FROM   register a INNER JOIN  mothertongue b ON FIND_IN_SET(b.mtongue_id, a.part_mtongue) > 0 where a.matri_id = '$view_id'  GROUP BY a.part_mtongue"));
echo $f['part_mtongue'];
?>
                      </div>
                      <?php
if ($pmtongue == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="col-xs-16 col-xxl-16 gt-margin-top-15">
                  <h3 class="gt-padding-bottom-15 gt-border-bottom-smoke-white font-18">
                    <i class="fa fa-map-marker gt-margin-right-10 gt-text-orange">
                    </i>Location Preference
                  </h3>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Country  :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
$b = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', country_name, ''SEPARATOR ', ' ) AS part_country FROM register a INNER JOIN country b ON FIND_IN_SET(b.country_id, a.part_country_living) > 0 where a.matri_id = '$view_id'  GROUP BY a.part_country_living"));
echo $b['part_country'];
?>
                      </div>
                      <?php
if ($parcnt == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php if($row_field->part_state == 'Yes'){ ?>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            State :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
$c = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', state_name, ''SEPARATOR ', ' ) AS part_state FROM register a INNER JOIN state b ON FIND_IN_SET(b.state_id, a.part_state) > 0 where a.matri_id = '$view_id'  GROUP BY a.part_state"));
if ($c['part_state'] != '') {
echo $c['part_state'];
} else {
echo "No";
}
?>
                      </div>
                      <?php
if ($parstate == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php } ?>
                  </div>
                  <div class="row gt-margin-top-20">
					<?php if($row_field->part_city == 'Yes'){ ?>
                    <div class="col-xxl-8 col-xs-16">
                      <div class="col-xxl-6 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            City :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-8 font-14 gt-padding-top-5">
                        <?php
$d = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', city_name, ''SEPARATOR ', ' ) AS part_city FROM register a INNER JOIN city b ON FIND_IN_SET(b.city_id, a.part_city) > 0 where a.matri_id = '$view_id'  GROUP BY a.part_city"));
if ($d['part_city'] != '') {
echo $d['part_city'];
} else {
echo "No";
}
?>
                      </div>
                      <?php
if ($parcity == '1') {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php
} else {
?>
                      <div class="col-xxl-2">
                        <div class="check-circle gt-pref-not-match" style="">
                          <i class="fa fa-check gt-text-white">
                          </i>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
					<?php } ?>
                  </div>
                </div>
				<?php if($row_field->part_expect == 'Yes'){ ?>
                <div class="col-xs-16 col-xxl-16 gt-margin-top-15">
                  <h3 class="gt-padding-bottom-15 gt-border-bottom-smoke-white font-18">
                    <i class="fa fa-star gt-margin-right-10 gt-text-orange">
                    </i>Partner Expectation
                  </h3>
                  <div class="row gt-margin-top-20">
                    <div class="col-xxl-16 col-xs-16">
                      <div class="col-xxl-3 col-xs-5 gt-padding-top-5">
                        <label class="font-14">
                          <b>
                            Expectations :
                          </b>
                        </label>
                      </div>
                      <div class="col-xxl-13 col-xs-11 font-14 gt-padding-top-5">
                       	<?php if($Row->part_expect_approve == 'Pending' || $Row->part_expect_approve == 'Unapproved' ){?>
                             <h4 class="text-center text-danger">Partner Expectation is under approval or Unapproved.</h4>
                        <?php }else{?>
							<p><?php echo $Row->part_expect; ?></p>
                        <?php }?>
                        
                      </div>
                    </div>
                  </div>
                </div>
				<?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- For Photo Album Display--->
      <?php
if (isset($Row)) {
if (($Row->photo1 != "" && $Row->photo1_approve == 'APPROVED' && file_exists('my_photos/' . $Row->photo1)) && (($Row->photo_view_status == '1') || ($Row->photo_view_status == '2' && $_SESSION['mem_status'] == 'Paid')) && (($Row->photo_protect == 'No') || ($Row->photo_protect == "Yes" && $Row->photo_pswd == ''))) {
$exp_sel = $DatabaseCo->dbLink->query("select * from expressinterest where ei_sender='$mid' and ei_receiver='" . $Row->matri_id . "' and receiver_response ='Accept'");
$num = mysqli_num_rows($exp_sel);
if ($num > 0) {
?>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;
                </span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Photo Album Of - 
                <?php echo $Row->matri_id; ?> -
                <?php echo $Row->username; ?>
              </h4>
            </div>
            <div class="modal-body">
              <div id="owl-demo" class="owl-carousel">
                <?php if ($Row->photo1 != '' && $Row->photo1_approve == 'APPROVED') { ?>
                <div class="item">
                  <div class="col-xxl-6 col-xxl-offset-5 col-xs-16 col-lg-16">
                    <a href="#" class="thumbnail">
                      <img src="my_photos/<?php echo $Row->photo1; ?>" class="img-responsive">
                    </a>
                  </div>
                </div>
                <?php } ?>
                <?php if ($Row->photo2 != '' && $Row->photo2_approve == 'APPROVED') { ?>
                <div class="item">
                  <div class="col-xxl-6 col-xxl-offset-5 col-xs-16 col-lg-16">
                    <a href="#" class="thumbnail">
                      <img src="my_photos/<?php echo $Row->photo2; ?>" class="img-responsive">
                    </a>
                  </div>
                </div>
                <?php }if ($Row->photo3 != '' && $Row->photo3_approve == 'APPROVED') { ?>
                <div class="item">
                  <div class="col-xxl-6 col-xxl-offset-5 col-xs-16 col-lg-16">
                    <a href="#" class="thumbnail">
                      <img src="my_photos/<?php echo $Row->photo3; ?>" class="img-responsive">
                    </a>
                  </div>
                </div>
                <?php }if ($Row->photo4 != '' && $Row->photo4_approve == 'APPROVED') { ?>
                <div class="item">
                  <div class="col-xxl-6 col-xxl-offset-5 col-xs-16 col-lg-16">
                    <a href="#" class="thumbnail">
                      <img src="my_photos/<?php echo $Row->photo4; ?>" class="img-responsive">
                    </a>
                  </div>
                </div>
                <?php }if ($Row->photo5 != '' && $Row->photo5_approve == 'APPROVED') { ?>
                <div class="item">
                  <div class="col-xxl-6 col-xxl-offset-5 col-xs-16 col-lg-16">
                    <a href="#" class="thumbnail">
                      <img src="my_photos/<?php echo $Row->photo5; ?>" class="img-responsive">
                    </a>
                  </div>
                </div>
                <?php
}
if ($Row->photo6 != '' && $Row->photo6_approve == 'APPROVED') {
?>
                <div class="item">
                  <div class="col-xxl-6 col-xxl-offset-5 col-xs-16 col-lg-16">
                    <a href="#" class="thumbnail">
                      <img src="my_photos/<?php echo $Row->photo6; ?>" class="img-responsive">
                    </a>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close
              </button>
            </div>
          </div>
        </div>
      </div>
      <?php
}
}
}
?>
      <!-- For Photo Album Display--->
      <?php include "parts/footer-before-login.php"; ?>
    </div>
    <!------------------------------------------jQuery------------------------------------------------->
    <script src="js/jquery.min.js">
    </script>
    <!------------------------------------------jQuery End--------------------------------------------->
    <!------------------------------------------bootstrap and green js--------------------------------->
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.validate.js">
    </script>
    <script src="js/green.js">
    </script>
    <script>
      $(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
      }
                       );
    </script>
    <!-------------------------------------bootstrap and green js End--------------------------------->
    <!------------------------------------Choosen js-------------------------------------------------->
    <script src="js/chosen.jquery.js" type="text/javascript">
    </script>
    <script src="js/prism.js" type="text/javascript" charset="utf-8">
    </script>
    <script type="text/javascript">
      var config = {
        '.chosen-select': {
        }
        ,
        '.chosen-select-deselect': {
          allow_single_deselect: true}
        ,
        '.chosen-select-no-single': {
          disable_search_threshold: 10}
        ,
        '.chosen-select-no-results': {
          no_results_text: 'Oops, nothing found!'}
        ,
        '.chosen-select-width': {
          width: "100%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
    </script>
    <!-------------------------------------Choosen js End--------------------------------------------->
    <?php
if (isset($_REQUEST['submit'])) {
$receiver = $_POST['recever_id'];
$pass = $_REQUEST['pass'];
$sel = $DatabaseCo->dbLink->query("select * from register where matri_id='$receiver' and photo_pswd='$pass'");
$num = mysqli_num_rows($sel);
if ($num > 0) {
?>
    <script>
      function photoview(toid)
      {
        $("#myModal5").html("Please wait...");
        $.get("view_photo_album?matri_id=" + toid,
              function(data)
              {
          $("#myModal5").html(data);
        }
             );
      }
      photoview('<?php echo $receiver; ?>');
      $(function() {
        $("#myModal5").modal({
          title: "jQuery Dialog Popup",
          buttons: {
            Close: function() {
              $(this).modal('close');
            }
          }
        }
                            );
      }
       );
      //$("#photoview" ).trigger( "click" );
    </script>
    <?php
//include "view_photo_album.php?matri_id=$receiver";
} else {
$result = "Given Passowrd is wrong.";
echo "<script>alert('" . $result . "');</script>";
}
}
?>
    <script>
      (function($) {
        var $window = $(window),
            $html = $('.mobile-collapse');
        $window.width(function width() {
          if ($window.width() > 991) {
            return $html.addClass('in');
          }
          $html.removeClass('in');
        }
                     );
      }
      )(jQuery);
    </script>
    <script type="text/JavaScript">
      function MM_openBrWindow(theURL,winName,features) {
        window.open(theURL,winName,features);
      }
    </script>
    <SCRIPT LANGUAGE="JavaScript">
      <!-- Begin
      var win = null;
      function newWindow(mypage, myname, w, h, features) {
        var winl = (screen.width - w) / 2;
        var wint = (screen.height - h) / 2;
        if (winl < 0)
          winl = 0;
        if (wint < 0)
          wint = 0;
        var settings = 'height=' + h + ',';
        settings += 'width=' + w + ',';
        settings += 'top=' + wint + ',';
        settings += 'left=' + winl + ',';
        settings += features;
        win = window.open(mypage, myname, settings);
        win.window.focus();
      }
      //  End -->
      </script>
    <style>
      #owl-demo .item{
        margin: 3px;
      }
      #owl-demo .item img{
        display: block;
        width:100%;
      }
    </style>
    <!--------------------------------------owl crousel js-------------------------------------------->
    <script src="js/owl.carousel.min.js">
    </script>
    <script>
      $(document).ready(function() {
        $("#owl-demo").owlCarousel({
          autoPlay: false,
          items: 1,
          navigation: true,
          navigationText: ["PREV", "NEXT"],
          itemsDesktop: [1199, 1],
          itemsDesktopSmall: [979, 1]
        }
                                  );
      }
                       );
    </script>
    <!--------------------------------------owl crousel js end-------------------------------------------->
    <div class="modal fade-in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>  
    <div class="modal fade-in" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>  
    <div class="modal fade-in" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>   
    <div class="modal fade-in" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>   
    <div class="modal fade-in" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    </div>   
    <script src="js/function.js" type="text/javascript">
    </script>
    <script>
    (function($) {
    var $window = $(window),
        $html = $('.mobile-collapse');
      $window.width(function width(){
            if ($window.width() > 767) {
              return $html.addClass('in');
          }
      $html.removeClass('in');
        });
    })(jQuery);
    </script>
  </body>
</html>
<?php include'thumbnailjs.php'; ?>
