<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
$get_plan_data = mysqli_fetch_object($DatabaseCo->dbLink->query("select * from payments where pmatri_id='" . $_SESSION['user_id'] . "'"));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
		<style>
  	#owl-demo .item{
        margin-top : 3px;
		padding-bottom:15px;
		padding-top:10px;
		border-bottom:1px solid rgba(213,213,213,1.00);
    }
    #owl-demo .item img{
        display: block;
    }
	#owl-demo-1 .item{
        margin-top : 3px;
		padding-bottom:15px;
		padding-top:10px;
		border-bottom:1px solid rgba(213,213,213,1.00);
    }
    #owl-demo-1 .item img{
        display: block;
		width:100%;
    }
</style>
    </head>
    <body>
    	<!-- ICON LOADER-->
		<div class="preloader-wrapper text-center">
			<div class="loader"></div>
			<h5>Loading...</h5>
		</div>
		<!-- ICON LOADER END-->
        <div id="body" style="display:none">
        <div id="wrap">
            <div id="main">
                <?php include "parts/header.php"; ?>
                <?php include "parts/menu-aft-login.php"; ?>
                <div class="container" >
                    <div class="row">
                        <div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 text-center">
                            <h2 class="gt-text-orange">
                                Current Plan Details
                            </h2>
                            <p>
                                You can check your current membership plan detail and also recommanded plan suggestion with that.
                            </p>
                        </div>

                    </div>	
                </div>


                <div class="container gt-margin-top-20">
                    <div class="row">
                        <div class="col-xxl-16 col-xl-16 col-md-16 col-sm-16 col-lg-16">
                            <div class="gt-panel gt-panel-default">
                                <div class="gt-panel-head">
                                    <div class="gt-panel-title">
                                        <h4 class="gt-margin-bottom-0 gt-margin-top-0">
                                            Current Plan -<span class="gt-text-orange"> <?php echo isset($get_plan_data->p_plan) ? $get_plan_data->p_plan : 'none'; ?> </span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="gt-panel-body">
                                    <div class="row">
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
                                            <h4 class="gt-text-orange">
                                                Duration
                                            </h4>
                                            <p>
                                                <b>
                                                    <?php echo isset($get_plan_data->plan_duration) ? $get_plan_data->plan_duration . ' Days' : 0; ?>
                                                </b>
                                            </p>
                                            <p>
                                                <b class="text-danger">
                                                    <?php
                                                    if (isset($get_plan_data->pactive_dt)) {
                                                        $now = time(); // or your date as well
                                                        $your_date = strtotime("$get_plan_data->pactive_dt");
                                                        $datediff = $now - $your_date;
                                                        $diff= $get_plan_data->plan_duration - floor($datediff / 86400);

														if($diff < 0){
														echo 0;
														}else{
															echo $diff;
														}
                                                        ?> 
                                                        <?php
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?> Days
                                                </b>
                                            </p>
                                        </div>
                                        <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
                                            <h4 class="gt-text-orange">
                                                Messages
                                            </h4>
                                            <p>
                                                <b>
                                                    <?php echo isset($get_plan_data->p_msg) ? $get_plan_data->p_msg : "none"; ?>
                                                </b>
                                            </p>
                                            <p>
                                                <b class="text-danger">
                                                   	 <?php echo (isset($get_plan_data->p_msg)) ? $get_plan_data->p_msg - $get_plan_data->r_msg . ' remaining' : 0; ?> 
                                                </b>
                                            </p>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
                                            <h4 class="gt-text-orange">
                                                Contact View
                                            </h4>
                                            <p>
                                                <b>
                                                    <?php echo isset($get_plan_data->p_no_contacts) ? $get_plan_data->p_no_contacts : 0; ?>
                                                </b>
                                            </p>
                                            <p>
                                                <b class="text-danger">
                                                    <?php echo (isset($get_plan_data->p_no_contacts) && isset($get_plan_data->r_cnt)) ? $get_plan_data->p_no_contacts - $get_plan_data->r_cnt . " remaining" : 0; ?> 
                                                </b>
                                            </p>
                                        </div>
                                        <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
                                            <h4 class="gt-text-orange">
                                                Live Chat
                                            </h4>
                                            <p>
                                                <b>
                                                    <?php echo isset($get_plan_data->chat) ? $get_plan_data->chat : 'No'; ?>
                                                </b>
                                            </p>
                                            <p>
                                                <b class="text-danger">
                                                    <?php echo isset($get_plan_data->chat) ? $get_plan_data->chat : 'No'; ?>
                                                </b>
                                            </p>
                                        </div>
                                        <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
                                            <h4 class="gt-text-orange">
                                                SMS
                                            </h4>
                                            <p>
                                                <b>
                                                    <?php echo isset($get_plan_data->p_sms) ? $get_plan_data->p_sms : "none"; ?>
                                                </b>
                                            </p>
                                            <p>
                                                <b class="text-danger">
                                                   <?php echo (isset($get_plan_data->p_sms)) ? $get_plan_data->p_sms - $get_plan_data->r_sms . ' remaining' : 0; ?> 
                                                    
                                                </b>
                                            </p>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-16 col-md-8 col-xs-16 gt-margin-bottom-20 text-center">
                                            <h4 class="gt-text-orange">
                                                Profile View
                                            </h4>
                                            <p>
                                                <b>
                                                    <?php echo isset($get_plan_data->profile) ? $get_plan_data->profile : 0; ?>
                                                </b>
                                            </p>
                                            <p>
                                                <b class="text-danger">
                                                    <?php echo (isset($get_plan_data->profile) && isset($get_plan_data->r_profile)) ? $get_plan_data->profile - $get_plan_data->r_profile . ' remaining' : 0; ?> 
                                                </b>
                                            </p>
                                        </div>

                                    </div>
                                </div>
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
        <script src="js/green.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script>
            $(document).ready(function() {
                $('#body').show();
                $('.preloader-wrapper').hide();
            });
        </script>
        <!-------------------------------------bootstrap and green js End--------------------------------->
        <!------------------------------------Choosen js-------------------------------------------------->
        <script src="js/chosen.jquery.js" type="text/javascript"></script>
        <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {allow_single_deselect: true},
                '.chosen-select-no-single': {disable_search_threshold: 10},
                '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                '.chosen-select-width': {width: "100%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        </script>
        <!-------------------------------------Choosen js End--------------------------------------------->


        <script>
            (function($) {
                var $window = $(window),
                        $html = $('.mobile-collapse');
                $window.width(function width() {
                    if ($window.width() > 991) {
                        return $html.addClass('in');
                    }
                    $html.removeClass('in');
                });
            })(jQuery);
        </script>

    </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  