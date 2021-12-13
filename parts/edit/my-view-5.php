<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
if (isset($_POST['family_type'])) {
$family_type = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['family_type']);
$family_status = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['family_status']);
$family_value = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['family_value']);
$father_occupation = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['father_occupation']);
$mother_occupation = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['mother_occupation']);
$no_of_brothers = $_POST['no_of_brothers'];
$no_of_sisters = $_POST['no_of_sisters'];
$nsm = $_REQUEST['nsm'];
$nbm = $_REQUEST['nbm'];
$DatabaseCo->dbLink->query("update register set family_type='$family_type',family_value='$family_value',family_status='$family_status',father_occupation='$father_occupation',mother_occupation='$mother_occupation',no_of_brothers='$no_of_brothers',no_of_sisters='$no_of_sisters',no_marri_sister='$nsm',no_marri_brother='$nbm' where matri_id='$matri_id'");
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$matri_id'");
$rowcc = mysqli_fetch_array($result3);
$name = $rowcc['firstname'] . " " . $rowcc['lastname'];
$matriid = $rowcc['matri_id'];
$cpass = $rowcc['cpassword'];
$website = $rowcc['web_name'];
$webfriendlyname = $rowcc['web_frienly_name'];
$from = $rowcc['from_email'];
$to = $rowcc['email'];
$name = $rowcc['username'];
	
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$logo = $rowcc['web_logo_path'];
	$contact = $rowcc['contact_no'];
$subject = "Family Details Updated";
$message = "
 <!doctype html>
<html>
<link href='https://fonts.googleapis.com/css?family=Courgette|Roboto:300,400,500' rel='stylesheet'>
<body  style='margin: 0 auto;padding-top:20px;padding-bottom:20px;background: rgba(233,233,233,1.00);'>
	<div id='templateBody' style='border: 3px solid #e2e2e2;
    width: 64%;
    margin: 40px auto 40px auto;
    border-radius: 5px;background-color:white;'>
		<div id='gtheader' style='background: #fff;padding: 15px;'>
			<div id='gtLogo' style=''>
				<img src='$website/img/$logo' style='max-height: 70px;'>
			</div>	
		</div>
		<div id='gtstrip' style='background: #ea2626;padding: 10px;text-align:center;'>
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Family details updated</h5>
		</div>
		<div id='gtBody' style='margin-top: 0px;margin-bottom: 5px;padding: 15px;'>
			<div id='gtUDetails' style='padding: 15px;'>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>Name : $name</h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;text-decoration:none;color:black;'>Email : $to </h5>
				<h5 style='font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 10px;font-size: 16px;
    font-weight: 400;'>User Id: $matriid</h5>
			</div>
			<div id='gtlogin' style='text-align: center;'>
				<a href='$website/login' style='font-family: Roboto, sans-serif;
				padding: 10px 30px 10px 30px;
    font-size: 18px;
    background: rgb(234, 38, 38);
    display: inline-block;
    color: white;
    text-decoration: none;
    border-radius: 3px;
    margin-top: 15px;
    margin-bottom: 15px;'>LOGIN</a>
			</div>
			<div id='gtIncase'>
				<p style='font-family: Roboto, sans-serif;
    font-weight: 400;
    font-size: 14px;
    color: #565656;'>In case of profile not updated by you,Please change password or contact us on $contact.</p>
			</div>
			<div id='gtThank'>
				<p style='font-family: Roboto, sans-serif;
    font-weight: 500;
    font-size: 14px;
    color: #565656;
    margin-top: 30px;
    margin-bottom: 5px;'>Thank You</p>
				<h5 style='font-family: Roboto, sans-serif;
    font-size: 18px;
    color: #ea2626;
    margin-top: 5px;
    font-weight: 200;'>Team $webfriendlyname</h5>
			</div>
		</div>
		<div id='gtFooter' style='padding: 15px;text-align: center;background: #efefef;
    '>
			<h5 style='font-family: Roboto, sans-serif;margin-top: 10px;
    margin-bottom: 5px;
    font-size: 18px;
    font-weight: 300;'>Join us on</h5>
    <div>
    	<a href='$fb' style='margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-facebook_317727.png' style='width:38px;'></a>
    	<a href='$tw' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-twitter_317723.png' style='width:38px;'></a>
    	<a href='$li' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-linkedin_317725.png' style='width:38px;'></a>
    	<a href='$gp' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='$website/img/if_square-google-plus_317726.png' style='width:38px;'></a>
    	</div>
		</div>
	</div>
</body>
</html>
";
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:' . $from . "\r\n";
mail($to, $subject, $message, $headers);
}
$SQLSTATEMENT = $DatabaseCo->dbLink->query("select family_type,family_status,family_value,family_origin,father_name,father_occupation,mother_name,mother_occupation,no_of_brothers,no_marri_brother,no_of_sisters,no_marri_sister from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT family_profile,family_status,family_type,family_value,father_occupation,mother_occupation,no_of_brother,no_of_married_brother,no_of_sister,no_of_married_sister FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>	
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-users">
    </i>Family Details
  </span>
  <a  class="pull-right btn gt-btn-orange" onClick="return edit5();">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">EDIT
    </font>
  </a>
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
            <?php echo ($DatabaseCo->dbRow->family_type != "") ? $DatabaseCo->dbRow->family_type : "Not Available"; ?>
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
            <?php echo ($DatabaseCo->dbRow->family_status != "") ? $DatabaseCo->dbRow->family_status : "Not Available"; ?>
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
            <?php echo ($DatabaseCo->dbRow->family_value != "") ? $DatabaseCo->dbRow->family_value : "Not Available"; ?>
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
            <?php echo ($DatabaseCo->dbRow->father_occupation != "") ? $DatabaseCo->dbRow->father_occupation : "Not Available"; ?>
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
            <?php echo ($DatabaseCo->dbRow->mother_occupation != "") ? $DatabaseCo->dbRow->mother_occupation : "Not Available"; ?>
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
if ($DatabaseCo->dbRow->no_of_brothers != "" && $DatabaseCo->dbRow->no_of_brothers != 0) {
echo $DatabaseCo->dbRow->no_of_brothers;
} else {
echo 'No brother';
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
            <?php
if ($DatabaseCo->dbRow->no_marri_brother != "" && $DatabaseCo->dbRow->no_of_brothers != 0) {
echo $DatabaseCo->dbRow->no_marri_brother;
} else {
echo 'No brother ';
}
?>
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
if ($DatabaseCo->dbRow->no_of_sisters != "" && $DatabaseCo->dbRow->no_of_sisters != 0) {
echo $DatabaseCo->dbRow->no_of_sisters;
} else {
echo 'No Sister';
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
            <?php
if ($DatabaseCo->dbRow->no_marri_sister != "" && $DatabaseCo->dbRow->no_of_sisters != 0) {
echo $DatabaseCo->dbRow->no_marri_sister;
} else {
echo 'No sister ';
}
?>
          </b>
        </div>	
      </div>
    </div>
	<?php } ?>
  </div>
</div>
