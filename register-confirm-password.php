<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#549a11">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#549a11">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
    <title><?php echo $configObj->getConfigFname(); ?></title>
	<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
	<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
	<link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
    
    <!-----------------------------------choosen------------------------------------>
    <link rel="stylesheet" href="css/prism.css">
    <link rel="stylesheet" href="css/chosen.css">
     <!-----------------------------------choosen js------------------------------------>
     	<!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->
    <!-----------------------------------Greenstrap------------------------------------>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom-responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
	<!-----------------------------------Greenstrap End-------------------------------->
    <!-----------------------------------Font Awsome----------------------------------->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <!-----------------------------------Font Awsome End------------------------------->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="preloader-wrapper">
      	<i class="gi gi-loader gi-spin"></i>
    </div>
    <div id="body" style="display:none">
   <?php include "parts/header.php"; ?>
    <?php include "parts/menu-aft-login.php"; ?>
    
  <div id="wrap">
  	<div id="main">
    	<div class="container">
        	<div class="row">
            	<div class="col-xs-16 gt-margin-top-20 gtRegConfirmPass">
                	<h5 class="text-center text-danger"><b>IMPORTANT</b></h5>
                    <h3 class="text-center gt-text-green gt-margin-top-0">Verify your email id</h3>
                    <h5 class="text-center">
                        <b>NOTE:-</b>Verify your email id by checking email and click on activation link for activating email account.If you dont get verification link please contact us.
                    </h5>
                </div>
                <div class="clearfix"></div>
            	<h3 class="text-center gt-margin-top-30">
                	Congratulation !!! You are registered with us.
                </h3>
                
                <div class="col-xxl-10 col-xxl-offset-3 col-xl-16 col-lg-16 col-sm-16 col-md-16 col-xs-16 gt-margin-top-50 gt-margin-bottom-30">
                	<div class="col-xxl-7 col-xs-16 col-xl-7 cl-md-16 col-sm-16 col-lg-7">
                    	<a href="login" class="btn gt-btn-green gt-btn-xxl flat btn-block gt-padding-top-30 gt-padding-bottom-30">
                        	Login Now
                        </a>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-16 col-sm-16 col-xs-16 text-center gt-margin-top-25">
                    	<h4>
                        	OR
                        </h4>
                    </div>
                    <div class="col-xxl-7 col-xs-16 col-xl-7 cl-md-7 col-sm-16 col-lg-7">
                    	<a href="membershipplans" class="btn gt-btn-orange gt-btn-xxl flat btn-block gt-padding-top-30 gt-padding-bottom-30">
                        	Upgrade Membership
                        </a>
                    </div>
                </div>
            </div>	
    	</div>
    </div>
  </div>  
    
    <?php include "parts/footer-before-login.php"; ?>
	</div>
    <!------------------------------------------jQuery------------------------------------------------->
    <script src="js/jquery.min.js"></script>
    <!------------------------------------------jQuery End--------------------------------------------->
    <!------------------------------------------bootstrap and green js--------------------------------->
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/green.js"></script>
    <!-------------------------------------bootstrap and green js End--------------------------------->
    <script>
	$(document).ready(function() {
    	$('#body').show();
    	$('.preloader-wrapper').hide();
	});
  </script>
    <!------------------------------------Choosen js-------------------------------------------------->
     <script src="js/chosen.jquery.js" type="text/javascript"></script>
     <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
     <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
     </script>
    <!-------------------------------------Choosen js End--------------------------------------------->
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  