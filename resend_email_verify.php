<?php 
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
$from=$configObj->getConfigFrom();
$website =  $configObj->getConfigName();
$webfriendlyname =  $configObj->getConfigFname();

if(isset($_REQUEST['resend_verification'])){
	$s = "select matri_id from register where email='" . $_POST['email'] . "'";
    $rr = $DatabaseCo->dbLink->query($s);

    if (mysqli_num_rows($rr) == 0) {
         echo "<script>alert('Please enter your registerd email id.');</script>";
    }else{
		
		echo "<script>alert('Verification link sent successfully');</script>";
	}
                                                             
	$email = isset($_POST['email'])? $_POST['email']:"";
	$SQL_STATEMENT = $DatabaseCo->dbLink->query("select * from register where (email='".$email."' or matri_id='".$email."') AND status!='Suspended'");
	$result_count=mysqli_num_rows($SQL_STATEMENT);
	echo $result_count;
	if($result_count == 1){
	$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where (email='".$email."' or matri_id='".$email."')");
	$rowcc = mysqli_fetch_array($result3);
	$name = $rowcc['firstname'];
	$matriid = $rowcc['matri_id'];
	$cpass = $rowcc['cpassword'];
	$website = $rowcc['web_name'];
	$cpass = $rowcc['cpassword'];
	$webfriendlyname = $rowcc['web_frienly_name'];
	$from = $rowcc['from_email'];
	$to = $rowcc['email'];
	$email=$rowcc['email'];
	$name1 = $rowcc['username'];
	$logo = $rowcc['web_logo_path'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$contact = $rowcc['contact_no'];
	$result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Registration'");
	$rowcs5 = mysqli_fetch_array($result45);
	$subject = $rowcs5['EMAIL_SUBJECT'];
	$message = $rowcs5['EMAIL_CONTENT'];
	$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
	$trans = array("your site name" =>$webfriendlyname,"name"=>$name1,"web logo"=>$logo,"matriid"=>$matriid,"email_id"=>$to,"cpass"=>$cpass,"fb1"=>$fb,"li1"=>$li,"tw1"=>$tw,"gp1"=>$gp,"site domain name"=>$website,"my_email"=>$email);
	$email_template = strtr($email_template, $trans);
	include ('phpmailer/phpmailer.php');
	$mail->Subject = $subject;
	$mail->addAddress($email);
	$mail->Body= $email_template;
			//$mail->send();
			if($mail->send()){
			$_SESSION['cnt']['status'] = 'succses';
			$_SESSION['cnt']['msg'] = 'Mail sucssesfully send.';
			}else{
			$_SESSION['cnt']['status'] = 'danger';
			$_SESSION['cnt']['msg'] = 'something went wrong.';
			}		
		}
	}
		
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
    <title>
      <?php echo $configObj->getConfigFname(); ?>
    </title>
    <meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
    <meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
    <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
    
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
    <link href="css/bootstrap.css?version=1" rel="stylesheet">
    <link href="css/custom-responsive.css?version=1" rel="stylesheet">
    <link href="css/custom.css?version=1" rel="stylesheet">
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->
    
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->
    
    <!--GOOGLE FONTS-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!--GOOGLE FONTS END--> 
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
  </head>
  <body>
    <div id="wrap">
      <div id="main">
        <?php include "parts/header.php"; ?>
        <?php include "parts/menu-aft-login.php"; ?>
        <div class="container">
          <div class="row" style="border-top: 1px solid rgba(252, 252, 252, 1);">
            <form class="col-xxl-10 col-xxl-offset-3" action="" method="post">
              <h2 class="gt-margin-top-30 ">
                Please verify your Email ID .
              </h2>
              <h5>
                We are always happy to help.
              </h5>
              
              <div class="gt-margin-top-30 form-group">
                <label>
                  Enter your email id or user id
                </label>
                <input type="text" class="gt-form-control flat" name="email" required>
              </div>
              <div class="form-group  gt-margin-top-30">
                <input type="submit" name="resend_verification" class="btn gt-btn-orange gt-btn-xxl flat">
                
              </div>
              <input type="hidden" name="val_of_resend" value="<?php if(isset($_POST['resend_verification']) && $_POST['resend_verification']!=''){ echo $_POST['resend_verification'];}?>">
            </form>
          </div>	
        </div>
      </div>
    </div>  
    <?php include "parts/footer-before-login.php"; ?>
    <!------------------------------------------jQuery------------------------------------------------->
    <script src="js/jquery.min.js">
    </script>
    <!------------------------------------------jQuery End--------------------------------------------->
    <!------------------------------------------bootstrap and green js--------------------------------->
    <script src="js/bootstrap.js">
    </script>
    <script src="js/green.js">
    </script>
    <!-------------------------------------bootstrap and green js End--------------------------------->
    <!------------------------------------Choosen js-------------------------------------------------->
    <script src="js/chosen.jquery.js" type="text/javascript">
    </script>
    <script src="js/prism.js" type="text/javascript" charset="utf-8">
    </script>
    <script type="text/javascript">
      var config = {
        '.chosen-select'           : {
        }
        ,
        '.chosen-select-deselect'  : {
          allow_single_deselect:true}
        ,
        '.chosen-select-no-single' : {
          disable_search_threshold:10}
        ,
        '.chosen-select-no-results': {
          no_results_text:'Oops, nothing found!'}
        ,
        '.chosen-select-width'     : {
          width:"100%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
    </script>
    <!-------------------------------------Choosen js End--------------------------------------------->
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
