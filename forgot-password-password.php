<?php 
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
$from=$configObj->getConfigFrom();
$website =  $configObj->getConfigName();
$webfriendlyname =  $configObj->getConfigFname();

if(isset($_REQUEST['forgoten_sub'])){
	$s = "select matri_id from register where email='" . $_POST['email'] . "'";
    $rr = $DatabaseCo->dbLink->query($s);

    if (mysqli_num_rows($rr) == 0) {
         echo "<script>alert('Please enter your registerd email id.');</script>";
    }else{
		
		echo "<script>alert('Please check your email account for further process.');</script>";
	}
                                                             
	$email = isset($_POST['email'])? $_POST['email']:"";
	$SQL_STATEMENT = "select * from register where (email='".$email."' or matri_id='".$email."') AND status!='Suspended'";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$statusObj = handle_post_request("FORGET",$SQL_STATEMENT,$DatabaseCo);
	$STATUS_MESSAGE = $statusObj->getStatusMessage();
	if($statusObj->getActionSuccess()){
		$matri_id = $DatabaseCo->dbRow->matri_id; 
		$username = $DatabaseCo->dbRow->username; 
		function RandomPassword() {
			$chars = "abcdefghijkmnopqrstuvwxyz023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '' ;
			while ($i <= 7) {
				$num = rand() % 33;
				$tmp = substr($chars, $num, 1);
				$pass = $pass . $tmp;
				$i++;
			}
			return $pass;
		}
		$pswd = RandomPassword();
			$upasswd = md5($pswd);
			$sql = "update register set password='".$upasswd."' where email='".$email."'";
			mysqli_query($DatabaseCo->dbLink,$sql) or mysqli_error($DatabaseCo->dbLink);
			include ('phpmailer/phpmailer.php');
			$mail->addAddress($email);
			$mail->Subject = 'Your new password';
    		$message="
			<html>
			<head>
			<title><h1>Your new password</h1></title>
			</head>
			<body>
			<table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
			<tbody>
			<tr>
			<td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
			<table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
			<tbody>
			<tr style='background:#f9f9f9'>
			<td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
			<span tabindex='0' class='aBn' data-term='goog_849968294'>
			<span class='aQJ'>$date</span></span></td>
			<td style='float:left;margin-top:30px;color:#048c2e;font-size:26px;padding-left:15px'>$webfriendlyname</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			<tr>
			<td style='float:left;width:710px;min-height:auto'>
			<h6 style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px'>Hello, $username</h6><p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Message : Your forgot password request has been received in our system.Given below is your profile login details,</p>
			<p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'><b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>Matri ID : $matri_id (or) <a style='text-decoration:none;color:#096b53;outline:none'>$email</a><br>New Password : $pswd </b></p>
			<p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:500px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thanks & Regards ,<br>Team At $webfriendlyname</p>
			</td>
			</tr>
			</tbody></table>
			</body>
			</html>
			";
			$mail->Body= $message;
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
                <input type="submit" name="forgoten_sub" class="btn gt-btn-orange gt-btn-xxl flat">
                
              </div>
              <input type="hidden" name="val_of_forgot" value="<?php if(isset($_POST['forgot']) && $_POST['forgot']!=''){ echo $_POST['forgot'];}?>">
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
