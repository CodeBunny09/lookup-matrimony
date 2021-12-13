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
        
     	<!-- CHOOSEN CSS -->
        <link rel="stylesheet" href="css/prism.css">
        <link rel="stylesheet" href="css/chosen.css">
        <!-- CHOOSEN CSS END -->
        
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
  			<div id="wrap">
  				<div id="main">
   					<!-- HEADER -->
                    <?php include "parts/header.php"; ?>
                    <?php include "parts/menu-aft-login.php"; ?>
                    <!-- HEADER END-->
                    
                    <!-- MAIN CONTAINER--> 
    				<div class="container">
                    	<h3 class="gt-text-orange text-center">Membership Plans</h3>
                		<p class="text-center">
               				Select from our multiple membership plan and find your best life partner with membership benefits.
                		</p>
                        
    					<div class="row">
        					<div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 ">
        							<div class="row gt-margin-bottom-20">
                						<?php 
											$sel_plan = $DatabaseCo->dbLink->query("SELECT * FROM `membership_plan` WHERE `status`='APPROVED'");
												while($get_plan = mysqli_fetch_object($sel_plan)){
										?>
                       					<label for="gt-plan-<?php echo $get_plan->plan_id;?>" class="col-xxl-4 col-xl-4 col-xs-16 col-lg-8" >
                    						<div class="gt-plan" id="setselected<?php echo $get_plan->plan_id;?>">
                    							<div class="gt-plan-header">
                                					<h1><i class="fa fa-certificate"></i></h1>
                            						<h4>
                                                    	<input type="radio" id="gt-plan-<?php echo $get_plan->plan_id;?>" name="plan" onChange="getselected('<?php echo $get_plan->plan_id;?>');" class="Table_Details">
                                                        <span class="gt-margin-left-10" id="planname<?php echo $get_plan->plan_id;?>">
															<?php echo $get_plan->plan_name;?>
                                                         </span>
                               	    				</h4>
                                    				<div class="gt-plan-price">
                                						<h4 id="planamount<?php echo $get_plan->plan_id;?>">
                                							<?php echo $get_plan->plan_amount_type.' '.$get_plan->plan_amount;?>
                                						</h4>
                                    				</div>
                        						</div>
												<div class="clearfix"></div>
                       						<!-- Plan For Mobile -->
                       						<a class="btn btn-primary gtMobPlan visible-xs visible-sm visible-md" role="button" data-toggle="collapse" href="#collapsePlan<?php echo $get_plan->plan_id;?>" aria-expanded="false" aria-controls="collapsePlan<?php echo $get_plan->plan_id;?>">
  													View Plan Detail
												<div class="clearfix"></div>
												<i class="fa fa-chevron-down"></i>
												</a>
                       						<div class="collapse" id="collapsePlan<?php echo $get_plan->plan_id;?>">
  													<div class="well">
    													<div class="gt-plan-body">
                                					<ul class="gt-plan-desc">
                                    					<li>
                                        					<h3>Duration</h3>
                                            				<h5 id="planduration<?php echo $get_plan->plan_id;?>">
                                            					<?php echo $get_plan->plan_duration;?> Days
                                            				</h5>
                                        				</li>
                                        				
                                        				<li>
                                        					<h3>Messages</h3>
                                        					<h5>
                                            					<?php echo $get_plan->plan_msg;?>  
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>SMS</h3>
                                        					<h5>
                                            					<?php echo $get_plan->plan_sms;?>  
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>Contact Views</h3>
                                            				<h5>
                                            					<?php echo $get_plan->plan_contacts;?>
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>Live Chat</h3>
                                            				<h5>
                                            					<?php echo $get_plan->chat;?>
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>Profile Views</h3>
                                            				<h5>
                                            					<?php echo $get_plan->profile;?>
                                            				</h5>
                                        				</li>
                                    				</ul>
                        						</div>
  													</div>
												</div>
                       					<!-- Plan For Mobile End -->
                        						<div class="gt-plan-body hidden-xs hidden-sm hidden-md">
                                					<ul class="gt-plan-desc">
                                    					<li>
                                        					<h3>Duration</h3>
                                            				<h5 id="planduration<?php echo $get_plan->plan_id;?>">
                                            					<?php echo $get_plan->plan_duration;?> Days
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>Messages</h3>
                                        					<h5>
                                            					<?php echo $get_plan->plan_msg;?>  
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>SMS</h3>
                                        					<h5>
                                            					<?php echo $get_plan->plan_sms;?>  
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>Contact Views</h3>
                                            				<h5>
                                            					<?php echo $get_plan->plan_contacts;?>
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>Live Chat</h3>
                                            				<h5>
                                            					<?php echo $get_plan->chat;?>
                                            				</h5>
                                        				</li>
                                        				<li>
                                        					<h3>Profile Views</h3>
                                            				<h5>
                                            					<?php echo $get_plan->profile;?>
                                            				</h5>
                                        				</li>
                                    				</ul>
                        						</div>
                        						<div class="gt-plan-footer hidden-xs hidden-sm hidden-md">
                                					<i class="fa fa-shopping-cart gt-margin-right-10"></i>
													<?php if($get_plan->plan_name=='Free'){ echo "Contact to admin";} else { echo "Select";}?>
                                				</div>
                        					</div>
                   						</label>
                       					
                        				<?php } ?>
                    			    </div>
                    				<div class="row">
                    					<div class="col-xxl-16 col-xl-16 box">
                        					<div class="gt-panel gt-Membership-plan" id="chkplan">
                            					<div class="gt-panel-head gt-bg-green">You Have Selected</div>
                                				<div class="gt-panel-body">
                                					<div class="row">
                                    						<div class="col-xxl-5 col-xl-5 col-lg-4">
                                            					<h4>Plan Name</h4>
                                            					<h5 class="gt-text-orange" id="dis_plan_name">Bronze</h5>
                                            				</div>
                                        					<div class="col-xxl-5 col-xl-5 col-lg-4">
                                            					<h4>Duration</h4>
                                            					<h5 class="gt-text-orange" id="dis_plan_duaration">
                                               						30 days
                                            					</h5>
                                        					</div>
                                        					<div class="col-xxl-6 col-xl-6 col-lg-8">
                                            					<h4 class="gt-margin-top-30">
                                               						Total  Amount  :- 
                                                                    <span class="gt-margin-left-10 gt-text-green" id="dis_plan_amount">Rs.1000</span>
                                            					</h4>
                                        					</div>
                                    					</div>
                                    					
                                    				   <div class="row text-center">
                                       						<a href="" id="checkout" class="btn gt-btn-green gt-btn-md">
                                            					<i class="gi gi-cart gt-margin-right-10 font-12"></i>Checkout
                                        					</a>
                                        				</div>
                                    					
                                    				<div class="row text-right">
                                    						<div class="col-xs-16">
                                        						<p>Including 14.5% Service Tax </p>
                                        					</div>
                                    					</div>
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
         <script>
            (function($) {
                var $window = $(window),
                        $html = $('.mobile-collapse');
                $window.width(function width() {
                    if ($window.width() > 767) {
                        return $html.addClass('in');
                    }
                    $html.removeClass('in');
                });
            })(jQuery);
        </script> 
    	<!--- LOADER JS END --->
 	 	<!--- PLAN SELECTED BUCKET --->
    	<script type="text/javascript">
		$(document).ready(function(e) {
        	$('#chkplan').hide();
    	});
		function getselected(planid){
			$('.gt-reco').removeClass('gt-reco');
			$('#setselected'+planid).addClass('gt-reco');
			$('#chkplan').show();
				var planname=$('#planname'+planid).html();
				var planduration=$('#planduration'+planid).html();
				var planamount=$('#planamount'+planid).html();
			    var plantype=$('#plantype'+planid).html();
				$('#dis_plan_name').html('');
				$('#dis_plan_name').html(planname);
				$('#dis_plan_duaration').html('');
				$('#dis_plan_duaration').html(planduration);
				$('#dis_plan_amount').html('');
				$('#dis_plan_amount').html(planamount);
				$('#dis_plan_type').html('');
				$('#dis_plan_type').html(plantype);
				$('a#checkout').attr("href", 'paymentOptions.php?pid='+planid);
			}
    	</script>
    	<!--- PLAN SELECTED BUCKET END --->
        <script>
        $('html, body').animate({scrollTop:$('.Table_Details').position().top}, 'slow');
			$(".Table_Details").click(function(){
   				$('html, body').animate({scrollTop:$('.box').position().top}, 'slow');
			});
		</script>
 	 </body>
	</html>                                                                                                                             
	<?php include 'thumbnailjs.php';?>                  