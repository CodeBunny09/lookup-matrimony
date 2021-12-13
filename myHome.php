<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
include_once 'auth.php';
$SQL_STATEMENT_USERSETTING=$DatabaseCo->dbLink->query("SELECT username_setting FROM site_config WHERE id='1'");
$username_settings=mysqli_fetch_object($SQL_STATEMENT_USERSETTING);

$mid = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
unset($_SESSION['religion']);
unset($_SESSION['caste']);
unset($_SESSION['m_tongue']);
unset($_SESSION['fromage']);
unset($_SESSION['toage']);
unset($_SESSION['fromheight']);
unset($_SESSION['toheight']);
unset($_SESSION['m_status']);
unset($_SESSION['education']);
unset($_SESSION['occupation']);
unset($_SESSION['country']);
unset($_SESSION['state']);
unset($_SESSION['city']);
unset($_SESSION['manglik']);
unset($_SESSION['keyword']);
unset($_SESSION['photo_search']);
unset($_SESSION['gender']);
unset($_SESSION['tot_children']);
unset($_SESSION['annual_income']);
unset($_SESSION['diet']);
unset($_SESSION['drink']);
unset($_SESSION['complexion']);
unset($_SESSION['bodytype']);
unset($_SESSION['star']);
unset($_SESSION['id_search']);
unset($_SESSION['smoking']);
include_once 'lib/progressbar.php';
$sel_own_data = $DatabaseCo->dbLink->query("select photo1_approve,photo1,gender,username,will_to_mary_caste,caste,part_caste from register_view where matri_id='$mid'");
$get_own_data = mysqli_fetch_object($sel_own_data);

$SQL_CHECK_PLAN=$DatabaseCo->dbLink->query("SELECT * FROM payments WHERE pmatri_id='$mid'");
$SQL_CHECK_PLAN_COUNT=mysqli_num_rows($SQL_CHECK_PLAN);
if($SQL_CHECK_PLAN_COUNT > 0){
$row_plan=mysqli_fetch_object($SQL_CHECK_PLAN);
$exp_date=$row_plan->exp_date;
$today= date('Y-m-d');
if($_SESSION['user_id']!=''){
	if ($exp_date <= $today){
		$SQL_UPDATE_PLAN=$DatabaseCo->dbLink->query("UPDATE register SET status='Active',fstatus='' WHERE matri_id='$mid'");
		$SQL_DELETE_PLAN=$DatabaseCo->dbLink->query("DELETE FROM payments WHERE pmatri_id='$mid'");
	}
}
}
/*$sel_own_data1 = $DatabaseCo->dbLink->query("select plan_duration,pactive_dt from payments where pmatri_id='$mid'");
$get_own_data1 = mysqli_fetch_object($sel_own_data1);
if(isset($get_own_data1->pactive_dt) != '' ){
	$plan_duration=$get_own_data1->plan_duration;
	$plan_duration+1;
	$now = time();
    $plan_active = strtotime($get_own_data1->pactive_dt);
    $datediff = $now - $plan_active;
    echo $plan_days=round($datediff / (60 * 60 * 24));
	if($plan_duration < $plan_days){
		$updatePlan=$DatabaseCo->dbLink->query("update register set status='Active',fstatus='' where matri_id='$mid'");
	}
}*/

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
        <link href="css/developer.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->


        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->

        <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->

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
			<div class="loader"></div>
			<h5>Loading...</h5>
		</div>
		<!-- ICON LOADER END-->
        <div id="body" style="display:none">
            <!-- HEADER -->
            <?php include "parts/header.php"; ?>
            <?php include "parts/menu-aft-login.php"; ?>
            <!-- HEADER END-->
            <div class="container gt-margin-top-20">
            	<div class="row">
            	<div class="col-xxl-4 col-xs-16 col-sm-16">
                	<div class="thumbnail gt-margin-bottom-0">
                           <?php if($get_own_data->photo1_approve == 'UNAPPROVED'){ ?>
                            	<div class="gtPendingApproval">Pending Approval</div>
                            <?php }?>
                           <?php if ($get_own_data->photo1 != '' && file_exists('my_photos/' . $get_own_data->photo1)) { ?>
                            <img src="my_photos/watermark.php?image=<?php echo $get_own_data->photo1; ?>&watermark=watermark.png" class="img-responsive gtFullWidth">
                            
                            <?php } else { ?>  
							<img src="img/<?php echo strtolower($_SESSION['gender123']) . '.png'; ?>" title="<?php echo $get_own_data->username; ?>" alt="<?php echo $mid; ?>" class="img-responsive gtFullWidth">               	
							<?php }  ?>

							<a href="my-photo" class="gt-myhome-caption ripplelink">
                                <i class="fa fa-camera gt-margin-right-10"></i><span class="">Change Profile Picture</span>
                            </a>
                            
                        </div>
                    <div id="loaderID"></div>
                </div>
				<div class="clearfix visible-xs visible-sm gt-margin-bottom-10"></div>
                
                <div class="col-xxl-12 col-sm-16 col-xs-16">
                	<div class="gt-body gt-margin-bottom-20 gtHomeBody">
                    	<div class="row">
                			<div class="col-xxl-8 col-xl-8 col-lg-10">
						<h4>
                            Hello <span class="gt-text-orange"><?php echo $get_own_data->username; ?></span>
                            <small class="text-muted gt-margin-left-5">( <?php echo $mid; ?> )</small>
                        </h4>
                        <h5 class="gt-margin-top-30">
                            Your profile is <?php echo $percentage; ?>% complete
                        </h5>
                        <div class="progress gt-margin-bottom-10">
                            <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage; ?>%;">
                            </div>
                        </div>
						<div class="font-12">
                            Tip : insert all details which can help you to find perfect life partner
                        </div>
                        <div class="">
                            <a href="view-profile" class="gt-text-green">
                                Complete Your Profile <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                        <h4 class="gt-margin-top-20">
                            Search By Id
                        </h4>
                        <form action="search_result" method="post">
                            <div class="form-group clearfix gt-margin-top-15">
                                <input type="text" class="gt-form-control flat" name="id_search" placeholder="Enter matri id to search">
                            </div>
                            <button type="submit" class="btn gt-btn-orange gt-margin-bottom-10">
                                Search Now
                            </button>
                        </form>
                    </div>
                    <div class="col-xxl-8 col-xl-8 col-lg-16 gt-margin-bottom-20">
                        <h4 class="text-center gt-margin-bottom-20 gt-border-bottom-smoke-white gt-padding-bottom-15">
                            RECENT LOGIN
                        </h4>
                        <div id="owl-demo" class="owl-carousel">
                            <?php
							$my_caste=$get_own_data->caste;
							$part_caste=$get_own_data->part_caste;
							if($get_own_data->will_to_mary_caste == '0'){
								$c="AND caste='$my_caste'";
							}elseif($part_caste != ''){
								$c="AND caste IN ($part_caste)";
							}else{
								$c="";
							}
                            $sel_recent_login_data = $DatabaseCo->dbLink->query("select birthdate,ocp_name,height,city_name,country_name,photo1_approve,photo1,photo_view_status,photo_protect,photo_pswd,gender,username,matri_id,firstname,lastname from register_view where matri_id!='$mid' and gender!='$get_own_data->gender' and status!='Inactive' and status!='Suspendade' $c order by last_login desc limit 0,10;");
							
                            while ($Row = mysqli_fetch_object($sel_recent_login_data)) {
                                $sql_exp = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM expressinterest,register_view WHERE ei_receiver='" . $Row->matri_id . "' and ei_sender='" . $_SESSION['user_id'] . "' and trash_sender='No'"));
                            ?>
                             <div class="item">
                                <div class="col-xxl-16 col-xs-16 col-lg-16">
                                     <a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" target="_blank" class="gt-result">
                                            <div class="col-xxl-6 col-lg-6 col-xs-16">
                                                <div class="thumbnail">
                                                    <?php include('parts/search-result-photo.php'); ?>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="col-xxl-10 col-lg-10 col-xs-16">
                                            <a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" target="_blank" class="gt-result">
                                                <h4 class="text-center gt-text-orange">
												<?php if($username_settings->username_setting == 'full_username'){?>
                                                   <?php echo $Row->username; ?>(<?php echo $Row->matri_id; ?>)
												<?php }elseif($username_settings->username_setting == 'first_surname'){?>
															<?php echo $Row->firstname." ".substr($Row->lastname, 0, 1); ?>(<?php echo $Row->matri_id; ?>)
													<?php }else{ ?>
													<?php echo $Row->matri_id; ?>
												<?php } ?>
													
                                                </h4>
                                                <article class="gt-margin-bottom-5 text-center">
                                                    <?php echo floor((time() - strtotime($Row->birthdate)) / 31556926); ?> Years, <?php
                                                    $ao3 = $Row->height;
                                                    $ft3 = (int) ($ao3 / 12);
                                                    $inch3 = $ao3 % 12;
                                                    echo $ft3 . "ft" . " " . $inch3 . "in";
                                                    ?> , <?php echo $Row->ocp_name; ?> 
                                                </article>
                                                <article class="text-center">
                                                    <?php
                                                    if ($Row->city_name != '') {
                                                        echo $Row->city_name;
                                                    } else {
                                                        echo "N/A";
                                                    }
                                                    ?>,<?php echo $Row->country_name; ?>
                                                </article>
                                            </a>
                                            <?php
                                            	if (isset($_SESSION['user_id'])) {
                                                	if (isset($sql_exp) && $sql_exp->receiver_response == 'Pending') {
                                             ?>
											
											<button class="btn gt-btn-green btn-block gt-margin-top-5" onClick="sendreminder(<?php echo $sql_exp->ei_id ?>);" id="reminder<?php echo $sql_exp->ei_id; ?>" title="Send Reminder" >
                                                   <i class="fa fa-bell gt-margin-right-5"></i>Send Reminder
                                            </button>
											<?php }elseif(isset($sql_exp) && $sql_exp->receiver_response=='Accept'){?>
										<h5 class="interestAccepted">Interest Accepted</h5>
									<?php }elseif(isset($sql_exp) && $sql_exp->receiver_response=='Reject'){?>
										<h5 class="interestRejected">Interest Rejected</h5>
                                            <?php } else { ?>	
                                            <button class="btn gt-btn-green btn-block gt-margin-top-5" onclick="ExpressInterest('<?php echo $Row->matri_id; ?>')" title="Send Interest" data-target="#myModal1" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                   <i class="fa fa-heart-o"></i> Send Interest
                                             </button>
                                            <?php } }?>
										</div>
									</div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    	</div>
                   </div>
                </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <aside class="col-xxl-4 col-xl-4 col-xs-16">
                       <a class="btn gt-btn-orange btn-block gt-margin-bottom-15 visible-xs visible-sm visible-md btn-md" role="button" data-toggle="collapse" href="#collapseLeftPanel" aria-expanded="false" aria-controls="collapseLeftPanel">
							Options &nbsp;&nbsp;<i class="fa fa-angle-down"></i>
					   </a>
					   <div class="clearfix"></div>
                       <div class="collapse mobile-collapse gt-padding-bottom-15" id="collapseLeftPanel">
                        <?Php
                        	include "parts/left_panel.php";
                        	include "parts/level-2.php";
                        ?>
						</div>
                    </aside>
                    <div class="col-xxl-12 col-xl-12 col-xs-16">
                        <div class="gt-panel">
                            <div class="gt-panel-border-green">
                                <div class="gt-panel-title">
                                    RECENTLY JOINED 
                                </div>
                            </div>
                            <div class="gt-panel-body">
                                <div class="row">
                                    <?php
										$my_caste=$get_own_data->caste;
										$part_caste=$get_own_data->part_caste;
										if($get_own_data->will_to_mary_caste == '0'){
											$c="AND caste='$my_caste'";
										}elseif($part_caste != ''){
											$c="AND caste IN ($part_caste)";
										}else{
											$c="";
										}
                                    	$sel_recent_joind_data = $DatabaseCo->dbLink->query("select birthdate,ocp_name,height,city_name,country_name,photo1_approve,photo1,photo_view_status,photo_protect,photo_pswd,gender,username,matri_id,firstname,lastname from register_view where matri_id!='$mid' and gender!='$get_own_data->gender' and status!='Inactive' and status!='Suspendade' $c order by reg_date desc limit 0,4;");
										if (mysqli_num_rows($sel_recent_joind_data) > 0) {
                                        while ($Row = mysqli_fetch_object($sel_recent_joind_data)) {
                                            $sql_exp = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM expressinterest,register_view WHERE ei_receiver='" . $Row->matri_id . "' and ei_sender='" . $_SESSION['user_id'] . "' and trash_sender='No'"));
                                     ?>
                                     <?php include "parts/result.php" ?>
                                     <?php
                                     	}
                                     	} else {
                                     ?>
                                     <div class="xxl-11 xl-11 l-16 m-16 s-16 xs-16 padding-lr-zero margin-top-10px">
                                            <div class="thumbnail">
                                                <img src="img/nodata-available.jpg" class="img-responsive">
											</div>
									 </div>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="gt-panel">
                            <div class="gt-panel-border-green">
                                <div class="gt-panel-title">
                                    FEATURED PROFILES 
                                </div>
                            </div>
                            <div class="gt-panel-body">
                                <div class="row">
                                    <?php
										$my_caste=$get_own_data->caste;
										$part_caste=$get_own_data->part_caste;
										if($get_own_data->will_to_mary_caste == '0'){
											$c="AND caste='$my_caste'";
										}elseif($part_caste != ''){
											$c="AND caste IN ($part_caste)";
										}else{
											$c="";
										}
                                    	$sel_fetured_data = $DatabaseCo->dbLink->query("select birthdate,ocp_name,height,city_name,country_name,photo1_approve,photo1,photo_view_status,photo_protect,photo_pswd,gender,username,matri_id,firstname,lastname from register_view where matri_id!='$mid' and gender!='$get_own_data->gender' and status!='Inactive' and status!='Suspendade' and fstatus='Featured' $c order by reg_date desc limit 0,4;");
									 	if (mysqli_num_rows($sel_fetured_data) > 0) {
                                        while ($Row = mysqli_fetch_object($sel_fetured_data)) {
                                            $sql_exp = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM expressinterest,register_view WHERE ei_receiver='" . $Row->matri_id . "' and ei_sender='" . $_SESSION['user_id'] . "' and trash_sender='No'"));
                                     ?>
                                     <?php include "parts/result.php" ?>
                                     <?php
                                        }
                                    	} else {
                                     ?>
                                     <div class="col-xs-16 padding-lr-zero margin-top-10px">
                                         <img src="img/nodata-available.jpg" class="img-responsive col-xs-16">
									 </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="gt-panel">
							<div class="gt-panel-border-green">
                                <div class="row">
                                    <div class="gt-panel-title col-xxl-10 col-lg-8">
                                        MY MATCHES
                                    </div>
                                </div>
                            </div>
                            <div class="gt-panel-body">
                                <div class="row">
                                    <?php
									//Result showing on criteria of age,height,religion,country
                                    $SQL_STATEMENT_match = "select * from register_view where matri_id='$mid'";
                                    $DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
                                    if (mysqli_num_rows($DatabaseCo->dbResult) > 0) {
                                        $DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
                                        //$education = $DatabaseCo->dbRow->part_edu;
                                        $m_status = str_ireplace(", ", "','", $DatabaseCo->dbRow->looking_for);
                                        $t3 = $DatabaseCo->dbRow->part_frm_age;
                                        $t4 = $DatabaseCo->dbRow->part_to_age;
                                        $fromheight = $DatabaseCo->dbRow->part_height;
                                        $toheight = $DatabaseCo->dbRow->part_height_to;
                                        $rel = $DatabaseCo->dbRow->part_religion;
                                        $country = $DatabaseCo->dbRow->part_country_living;
                                        
                                        if ($m_status != 'Any' && $m_status != '') {
                                            $h = "and m_status IN ('$m_status')";
                                        } else {
                                            $h = "";
                                        }
										if ($rel != '') {
                                            $c = "and religion IN ($rel)";
                                        } else {
                                            $c = "";
                                        }
										if ($t3 != '' && $t4 != '') {
                                            $a = "AND ((
										(
										date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
										) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
										)
										BETWEEN '$t3'
										AND '$t4')";
                                        } else {
                                           $a = "";
                                        }
										if ($country != '') {
                                            $g = "and country_id IN ($country)";
                                        } else {
                                            $g = "";
                                        }
                                        $my_caste=$get_own_data->caste;
										$part_caste=$get_own_data->part_caste;
										if($get_own_data->will_to_mary_caste == '0'){
											$i="AND caste='$my_caste'";
										}elseif($part_caste != ''){
											$i="AND caste IN ($part_caste)";
										}else{
											$i="";
										}
                                         $rows = mysqli_num_rows($DatabaseCo->dbLink->query("select matri_id from register_view where  status!='Inactive' and status!='Suspended' and gender!='" . $_SESSION['gender123'] . "' $i $g $h $c $a "));
                                        $sql = $DatabaseCo->dbLink->query("select * from register_view where  status!='Inactive' and status!='Suspended' and gender!='" . $_SESSION['gender123'] . "' $i $g $h $c $a order by fstatus desc  limit 0,4");
                                        if ($rows > 0) {
                                            while ($Row = mysqli_fetch_object($sql)) {
                                                $sql_exp = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM expressinterest,register_view WHERE ei_receiver='" . $Row->matri_id . "' and ei_sender='" . $_SESSION['user_id'] . "' and trash_sender='No'"));
                                        ?>
										<?php include "parts/result.php" ?>
                                        <?php
                                            }
                                        	} else {
                                        ?>
                                        <div class="col-xs-16 padding-lr-zero margin-top-10px">
                                         <img src="img/nodata-available.jpg" class="img-responsive col-xs-16">
									 </div>
                                        <?php
                                        }
                                    		} else {
                                        ?>
                                        <div class="col-xs-16 padding-lr-zero margin-top-10px">
                                         <img src="img/nodata-available.jpg" class="img-responsive col-xs-16">
									 	</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="gt-panel">
                            	<div class="gt-panel-body gt-border-top-grey">
                                	<div class="row">
                                    	<h5 class="col-xxl-16 col-xs-16 gt-margin-top-0">
                                        	Recently Visited 
                                    	</h5>
                                    <?php
										$rows = $DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.viewed_member_id=register_view.matri_id where who_viewed_my_profile.my_id='$mid' LIMIT 0,8");
                                    	while ($Row = mysqli_fetch_object($rows)) {
                                    ?>
                                        <a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" target="_blank" class="col-xxl-4 col-xl-4 col-xs-8 col-lg-4 gt-margin-bottom-10">
                                           	<div class="row">
                                           		<div class="col-xs-16">
                                           			<div class="thumbnail gt-margin-bottom-0">
                                                		<?php include('parts/search-result-photo.php'); ?>
                                            		</div>
                                           		</div>
                                           		<div class="col-xs-16">
                                           			<h6 class="text-center">
                                                		<span class="gt-text-orange">
															<?php if($username_settings->username_setting == 'full_username'){ ?>
																<?php echo $Row->username; ?>
															<?php }elseif($username_settings->username_setting == 'first_surname'){?>
																<?php echo $Row->firstname." ".substr($Row->firstname, 0, 1); ?>
															<?php }else{ ?>
																<?php echo $Row->matri_id; ?>
															<?php } ?></span><br><span class="gt-text-Grey">(<?php echo $Row->matri_id; ?>),<br>
                                                		<?php echo floor((time() - strtotime($Row->birthdate))/31556926); ?> Years, <?php  echo $Row->m_status;?><span class="gt-text-orange">
                                           			</h6>
												</div>
                                           		
                                           	</div>
                                            
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>	
                    </div>      
                </div>
            </div>
            <?php include "parts/footer-before-login.php"; ?>
            <!-- Jquery --->
        	<script src="js/jquery.min.js"></script>
        	<!--- Jquery END --->
        	<!--- BOOTSTRAP AND GREEN JS--->
        	<script src="js/bootstrap.js"></script>
        	<script src="js/jquery.validate.js"></script>
        	<script src="js/green.js"></script>
            <script>
              $(document).ready(function() {
              $('#body').show();
              $('.preloader-wrapper').hide();
              });
        	</script> 
        	<!--- BOOTSTRAP AND GREEN JS END--->
            <!--- MOBILE HEADER DETAILS COLLAPS BUTTON -->
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
			<!--- MOBILE HEADER DETAILS COLLAPS BUTTON END HERE-->
            <!--- OWL CAROUSEL --->
        	<script src="js/owl.carousel.min.js"></script>    
		 	<script>
                $(document).ready(function() {
                    $("#owl-demo").owlCarousel({
                        autoPlay: 3000,
                        items: 1,
                        navigation: true,
                        navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                        itemsDesktop: [1199, 1],
                        itemsDesktopSmall: [979, 1]
                    });
                });
            </script>
			<!--- OWL CAROUSEL END--->
			<script src="js/function.js" type="text/javascript"></script>
            <!-- MODAL function+send_interest+admit_interest--->
            <div class="modal fade-in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
            <!-- MODAL END --->
        </div>
    </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php' ; ?>                  
