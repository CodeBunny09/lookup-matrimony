<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
if (isset($_SESSION['user_name'])) {
    header("location: myHome.php");
    exit();
}
$getdata = isset($_COOKIE['planid']) ? $_COOKIE['planid'] : '';
if (isset($_POST['member_login'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = md5(isset($_POST['password']) ? $_POST['password'] : "");
    if (isset($_POST['keep_login'])) {
        setcookie("user", $username, time() + (86400 * 30), "/");
        setcookie("pass", $_POST['password'], time() + (86400 * 30), "/");
    } else {
        setcookie("user","", time() - (86400 * 30), "/");
        setcookie("pass","", time() - (86400 * 30), "/");
    }
    $STATUS_MESSAGE = "";
    $SQL_STATEMENT1 = $DatabaseCo->dbLink->query("select email,matri_id,username,gender,index_id,status from register where (matri_id='" . $username . "' OR email='" . $username . "') and password='" . $password . "' AND status!='Suspended'");
    if (mysqli_num_rows($SQL_STATEMENT1) > 0) {
        $sql = "UPDATE register set logged_in='1' WHERE (matri_id='" . $username . "' OR email='" . $username . "')";
        $DatabaseCo->dbLink->query($sql);
    }
	
    if (mysqli_num_rows($SQL_STATEMENT1) > 0) {
        $sql = "UPDATE register set logged_in='1' WHERE (matri_id='" . $username . "' OR email='" . $username . "')";
        $DatabaseCo->dbLink->query($sql);
    }
    $SQL_STATEMENT = $DatabaseCo->dbLink->query("select email,matri_id,username,gender,index_id,status,last_login,photo1,photo2,photo3,photo4,photo5,photo6 from register where (matri_id='" . $username . "' OR email='" . $username . "') and password='" . $password . "' AND status!='Suspended'");
    if ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)) {
        if ($DatabaseCo->dbRow->status != 'Inactive') {
            session_regenerate_id();
            $_SESSION['login_time'] = date('Y-m-d h:i:s');
            $_SESSION['user_name'] = $DatabaseCo->dbRow->email;
            $_SESSION['user_id'] = $DatabaseCo->dbRow->matri_id;
            $_SESSION['uname'] = $DatabaseCo->dbRow->username;
            $_SESSION['gender123'] = $DatabaseCo->dbRow->gender;
            $_SESSION['uid'] = $DatabaseCo->dbRow->index_id;
            $_SESSION['email'] = $DatabaseCo->dbRow->email;
            $_SESSION['photo1'] = $DatabaseCo->dbRow->photo1;
            $_SESSION['photo2'] = $DatabaseCo->dbRow->photo2;
            $_SESSION['photo3'] = $DatabaseCo->dbRow->photo3;
            $_SESSION['photo4'] = $DatabaseCo->dbRow->photo4;
            $_SESSION['photo5'] = $DatabaseCo->dbRow->photo5;
            $_SESSION['photo6'] = $DatabaseCo->dbRow->photo6;
            $_SESSION['mem_status'] = $DatabaseCo->dbRow->status;
            $_SESSION['last_login'] = $DatabaseCo->dbRow->last_login;
            $email = $_SESSION['email'];
            $browser = $_SERVER['HTTP_USER_AGENT'];
            $url = $_SERVER['HTTP_HOST'];
            $ip = $_SERVER['SERVER_ADDR'];
            if (isset($getdata) && $getdata != '') {
                session_write_close();
                echo "<script>window.location='paymentOptions.php'</script>";
            } else {
                session_write_close();
                echo "<script>window.location='myHome'</script>";
                exit();
            }
       	 	} else {
         ?>
		<script>
			alert('Please verifiy your profile by confirmation link.');
        </script>
        <?php } } else { ?>
        <script>
			alert('Your username or password is wrong. Please try again...');
        </script>
        <?php } } ?>
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
    	<title><?php echo $configObj->getConfigFname(); ?></title>
    	<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
    	<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
    	<!-- WEB SITE TITLE DESCRIPTION END--> 
        
		<!-- WEB SITE FAVICON--> 
        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE FAVICON END-->
        
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

        <!-- VALIDATION CSS --->
        <link rel="stylesheet" href="css/validate.css">
        <!-- VALIDATION CSS END --->
        
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
        	<div class="loader"></div>
        	<h5>Loading...</h5>
    	</div>
    	<!-- ICON LOADER END-->
        <div id="body" style="display:none">
            <div id="wrap" class="gtLogin">
                <div id="main">
				<!-- HEADER -->
            	<?php include "parts/header.php"; ?>
            	<?php include "parts/menu-aft-login.php"; ?>
            	<!-- HEADER END-->
					<div class="container">
                        <div class="row">
                            <div class="col-xxl-6 col-xs-16 col-xl-6 col-xs-offset-0 col-xxl-offset-5 col-sm-offset-0 col-md-offset-0 col-xl-offset-5 col-lg-10 col-lg-offset-3 ">
                                <form class="gt-login-form" action="" name="login_form" id="login_form" method="post">
                                    <h2 class="text-center">LOGIN</h2>
                                    <h5 class="text-center">And search your life partner</h5>
                                    <div class="form-group">
                                        <label>User Id / Email Id</label>
										<input type="text" class="gt-form-control " placeholder="Enter your user id" name="username" id="username" data-validetta="required" value="<?php if (isset($_COOKIE['user'])) { echo $_COOKIE['user']; } ?>">
									</div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="gt-form-control "  placeholder="Enter your password" name="password" id="password" data-validetta="required" value="<?php if (isset($_COOKIE['pass'])) { echo $_COOKIE['pass']; } ?>">
 									</div>
									<div class="form-group">
                                      <div class="row">
                                      	 <div class="col-xxl-8">
										   <label for="keep_login">
											<input type="checkbox" class="" name="keep_login" id="keep_login" <?php
												if (isset($_COOKIE['pass']) && isset($_COOKIE['user'])) {
													echo "checked";
												}
											?>> Keep me logged in
										   </label>
                                      	 </div>
                                      	 <div class="col-xxl-8 text-right">
                                      	 	 <a href="forgot-password-password" class="">Forgot Password ?</a>
										 </div>
                                       </div>
                                    </div>
                                    <div class="form-group text-center">
										<input type="submit" class="btn gt-btn-orange gt-btn-xl btn-block" name="member_login" value="Login">
                                    </div>
 									<div class="form-group text-center">
										<a href="resend_email_verify" class="btn gt-btn-green gt-btn-xl btn-block">Resend Email Verification</a>
                                    </div>
                                </form>
						 	</div>
						</div>
					</div>
				</div>
			</div>
            <?php include "parts/footer-before-login.php"; ?>
        </div>
       
 	<!-- Jquery --->
    <script src="js/jquery.min.js"></script>
    <!--- Jquery END --->
    <!--- BOOTSTRAP AND GREEN JS--->
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/green.js"></script> 
    <!--- BOOTSTRAP AND GREEN JS END--->
	<!--- LOADER JS--->
    <script> 
		$(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
        });
    </script>
    <!--- LOADER JS END ---> 
	<!---- VALIDATION JS --->
	<script type="text/javascript" src="js/validetta.js"></script>
    <script type="text/javascript">
		 $(function() {
                $('#login_form').validetta({
                    errorClose: false,
                    custom: {
                        regname: {
                            pattern: /^[\+][0-9]+?$|^[0-9]+?$/,
                            errorMessage: 'Custom Reg Error Message !'
						},
                        example: {
                            pattern: /^[\+][0-9]+?$|^[0-9]+?$/,
                            errorMessage: 'Lan mal !'
                        }
                    },
                    realTime: true
                });
            });
     </script>
	<!---- VALIDATION JS END --->
	</body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  