<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
if (isset($_POST['first_name'])) {
    $first_name = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['sur_name']);
    $mobile = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['mobile']);
    $code = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['mobile_code']);
    $m_tongue = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['m_tongue']);
    $m_status = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['m_status']);
	if($_REQUEST['m_status'] == 'Never Married'){
		$tot_children = "0";
    	$status_children = "NULL";
	}else{
    	$tot_children = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['tot_children']);
    	$status_children = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['child_status']);
	}
    $profileby = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['profileby']);
    $DatabaseCo->dbLink->query("UPDATE register SET  username='$first_name $last_name',firstname='$first_name',lastname='$last_name',mobile='$mobile',mobile_code='$code',m_tongue='$m_tongue',m_status='$m_status',tot_children='$tot_children',status_children='$status_children',profileby='$profileby' where matri_id='$matri_id'");
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
	$logo = $rowcc['web_logo_path'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$contact = $rowcc['contact_no'];
    $result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Edit Profile'");
    $rowcs5 = mysqli_fetch_array($result45);
    $subject = "Basic Details Updated";
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
				<h5 style='font-size: 40px;font-weight:500;font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Basic details updated</h5>
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
$seldata = $DatabaseCo->dbLink->query("select email,m_tongue,firstname,lastname,gender,birthdate,m_tongue,mobile,mobile_code,m_tongue,m_status,tot_children,status_children,profileby from register where matri_id='$matri_id'");
$getdata = mysqli_fetch_object($seldata);
$m_tongue = isset($getdata->m_tongue) ? $getdata->m_tongue : "";
?>
<div class="gt-panel-head">
    <span class="pull-left"><i class="fa fa-file"></i>Basic Details</span>
    <a class="pull-right btn gt-btn-orange" onClick="return edit1();">
        <i class="fa fa-pencil"></i><font class="gt-margin-left-5">EDIT</font>
    </a>
</div>
<div class="gt-panel-body">
    <div class="row">

        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    User Name  :
                </div>
                <div class="col-xs-10">
                    <b><?php echo isset($getdata->firstname) && isset($getdata->lastname)   ? $getdata->firstname  . "  " . $getdata->lastname: "Not Available"; ?></b>
                </div>	
            </div>
        </div>
        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    Email :
                </div>
                <div class="col-xs-10">
                    <b><?php echo isset($getdata->email) ? $getdata->email : "Not Available"; ?></b>
                </div>	
            </div>
        </div>
        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    Mobile No :
                </div>
                <div class="col-xs-10">
                    <b><?php echo isset($getdata->mobile_code) ? $getdata->mobile_code : "Not Available"; ?>-<?php echo isset($getdata->mobile) ? $getdata->mobile : "Not Available"; ?> </b>
                   
                </div>
            </div>
        </div>
        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    Gender :
                </div>
                <div class="col-xs-10">
                    <b><?php echo (isset($getdata->gender)) ? $getdata->gender : "Not Available"; ?></b>
                </div>
            </div>
        </div>

        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    Date Of Birth :
                </div>
                <div class="col-xs-10">
                     <b><?php
                        if (isset($getdata->birthdate) != '') {
                            echo date('d/ m /Y', strtotime($getdata->birthdate)); 
                        } else {
                            echo 'Not Available';
                        }
                        ?></b>
                    
                </div>
            </div>
        </div>

        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    Marital Status :
                </div>
                <div class="col-xs-10">
                    <b><?php echo isset($getdata->m_status) ? $getdata->m_status : "Not Available"; ?></b>
                </div>	
            </div>
        </div>
		<?php if(($getdata->m_status == "Widower") || ($getdata->m_status == "Awaiting Divorce") || ($getdata->m_status == "Divorced") ){ ?>
        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    No Of Children :
                </div>
                <div class="col-xs-10">
                    <b><?php
                        if (isset($getdata->m_status) && $getdata->m_status == "Never Married") {
                            echo 'Not married';
                        } elseif (isset($getdata->m_status) && isset($getdata->tot_children) && $getdata->tot_children != "") {
                            echo $getdata->tot_children;
                        } else {
                            echo 'Not Available';
                        }
                        ?></b>
                </div>	
            </div>
        </div>
		<?php } ?>
       <?php if(($getdata->m_status == "Widower") || ($getdata->m_status == "Awaiting Divorce") || ($getdata->m_status == "Divorced") ){ ?>
        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    Children Living Status :
                </div>
                <div class="col-xs-10">
                    <b>
                        <?php
                        if (isset($getdata->m_status) && $getdata->m_status == "Never Married") {
                            echo 'Not married';
                        } elseif (isset($getdata->m_status) && isset($getdata->status_children) && $getdata->status_children != "") {
                            echo $getdata->status_children;
                        } else {
                            echo 'Not Available';
                        }
                        ?></b>
                </div>	
            </div>
        </div>
		<?php } ?>

        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    Mother Tongue :
                </div>
                <div class="col-xs-10">
                    <b>
                    
					<?php
					
                        $SQL_STATEMENT_mtongue = $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE mtongue_id='$m_tongue'  ORDER BY mtongue_name ASC");
						

                        $DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_mtongue);
                        if (isset($DatabaseCo->Row->mtongue_name)) {
                            echo $DatabaseCo->Row->mtongue_name;
                        } else {
                            echo 'Not Available';
                        }
                        ?></b>
                </div>	
            </div>
        </div>


        <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
            <div class="row">
                <div class="col-xs-6">
                    Profile Created By  :
                </div>
                <div class="col-xs-10">
                    <b><?php
                        if (isset($getdata->profileby)) {
                            if ($getdata->profileby != '') {
                                echo $getdata->profileby;
                            } else {
                                echo "Not Available";
                            }
                        } else {
                            echo "Not Available";
                        }
                        ?></b>
                </div>	
            </div>
        </div>


    </div>
</div>