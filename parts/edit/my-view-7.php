<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
if(isset($_POST['hobby']))
{
$hobby=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['hobby']);
$diet=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['diet']);
$drink=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['drink']);
$language=isset($_REQUEST['language'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['language'])):"";
$smoke=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['smoke']);
$DatabaseCo->dbLink->query("update register set diet='$diet',drink='$drink',smoke='$smoke',hobby='$hobby',language_known='$language' where matri_id='$matri_id'");
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id = '$matri_id'");
$rowcc = mysqli_fetch_array($result3);
$name = $rowcc['firstname']." ".$rowcc['lastname'];
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
$subject = "Habits & Hobbies Information Updated";	
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
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Habits & hobbies information updated</h5>
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
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
mail($to,$subject,$message,$headers);	
}
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select hobby,smoke,drink,diet,language_known from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT diet,smoke,drink FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>	
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-star">
    </i>Habits And Hobbies
  </span>
  <a  class="pull-right btn gt-btn-orange" onClick="return edit7();">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">EDIT
    </font>
  </a>
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
            <?php if($DatabaseCo->dbRow->diet!=''){ echo $DatabaseCo->dbRow->diet;}else{ echo "N/A";} ?>
          </b>
        </div>	
      </div>
    </div>
	<?php } ?>
	<?php if($row_field->smoke == 'Yes'){ ?>
    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
      <div class="row">
        <div class="col-xs-6">
          Drinking Habits :
        </div>
        <div class="col-xs-10">
          <b>
            <?php  if($DatabaseCo->dbRow->drink!=''){ echo $DatabaseCo->dbRow->drink;}else{ echo "N/A";} ?>
          </b>
        </div>	
      </div>
    </div>
	<?php } ?>
	<?php if($row_field->drink == 'Yes'){ ?>
    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
      <div class="row">
        <div class="col-xs-6">
          Smoke Habits :
        </div>
        <div class="col-xs-10">
          <b>
            <?php  if($DatabaseCo->dbRow->smoke!=''){ echo $DatabaseCo->dbRow->smoke;}else{ echo "N/A";} ?>
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
            <?php if($DatabaseCo->dbRow->hobby!=''){ echo $DatabaseCo->dbRow->hobby;}else{ echo "N/A";} ?>
          </b>
        </div>	
      </div>
    </div>
    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
      <div class="row">
        <div class="col-xs-6 ">
          Language Known  :
        </div>
        <div class="col-xs-10 gt-word-wrap">
          <b> 
            <?php $c=mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS language_known FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id,a.language_known) >0 WHERE a.matri_id = '$matri_id'  GROUP BY a.language_known"));
if(isset($c['language_known']) && $c['language_known']!='')
{
echo $c['language_known']; } ?>
          </b>
        </div>	
      </div>
    </div>
  </div>
</div>
