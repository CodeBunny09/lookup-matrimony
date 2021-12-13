<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();

	if(!isset($_SESSION['user_id'])){
		setcookie("planid", $_POST['planid'], time() + (60 * 1), "/");
		echo "<script>window.location='login.php';</script>";
	} else {
		$mid=$_SESSION['user_id'];
	}
	if(isset($_GET['pid'])){
		$planid=$_GET['pid'];	
	} elseif(isset($_COOKIE['planid'])) {
		$planid=$_COOKIE['planid'];
	}

	$planname =  $DatabaseCo->dbLink->query("SELECT pmatri_id,p_plan FROM payments WHERE pmatri_id='$mid'");
	while($DatabaseCo->dbRow = mysqli_fetch_object($planname)){
		if($DatabaseCo->dbRow->p_plan =='free'){
			echo "<script>alert('Welcome plan already used please select another membership plan.');</script>";
			echo "<script>window.location='membershipplans'</script>";
		}else{
			$plantype =  $DatabaseCo->dbLink->query("SELECT plan_type FROM membership_plan WHERE plan_id='$planid'");
			while($DatabaseCo->dbRow = mysqli_fetch_object($plantype)){
				if($DatabaseCo->dbRow->plan_type =='FREE'){
					$get_gata=mysqli_fetch_object($DatabaseCo->dbLink->query("select register.matri_id,register.email,register.mobile,register.username,register.franchies_id,register.address,membership_plan.plan_name,membership_plan.plan_duration,membership_plan.profile,membership_plan.chat,membership_plan.plan_contacts,membership_plan.plan_msg,membership_plan.plan_amount,membership_plan.plan_amount_type from register,membership_plan where register.matri_id='$mid' and membership_plan.plan_id='$planid'"));
				
					$pmatri_id=$get_gata->matri_id;
					$pname=$get_gata->username;
					$pemail=$get_gata->email;
					$paddress=$get_gata->address;
					$paymode='Online Payment';
					$today1 = strtotime ('now');
					$today=date("Y-m-d",$today1);
					$pactive_dt=$today;
					$p_plan=$get_gata->plan_name;
					$plan_duration=$get_gata->plan_duration;
					$profile=$get_gata->profile;
					$franchies_id=$get_gata->franchies_id;

					$chat=$get_gata->chat;
					$p_no_contacts=$get_gata->plan_contacts;
					$p_amount=$get_gata->plan_amount_type.' '.$get_gata->plan_amount;
					$p_bank_detail='';
					$p_msg=$get_gata->plan_msg;
					$date = strtotime(date("Y-m-d", strtotime($pactive_dt)) . + $plan_duration." day");
					$exp_date=date('Y-m-d', $date);
					$pay_id=$planid;
					$DatabaseCo->dbLink->query("DELETE FROM payments WHERE pmatri_id='".$pmatri_id."'");
					$sql=$DatabaseCo->dbLink->query("insert into payments(pmatri_id,pname,pemail,paddress, paymode,pactive_dt,p_plan,plan_duration,profile,chat,p_no_contacts, p_amount,p_bank_detail,pay_id,p_msg,exp_date) values('$pmatri_id','$pname','$pemail','$paddress','$paymode','$pactive_dt','$p_plan','$plan_duration','$profile','$chat','$p_no_contacts','$p_amount','$p_bank_detail','$pay_id','$p_msg','$exp_date')");
					$DatabaseCo->dbLink->query("UPDATE register SET status='Paid' WHERE matri_id='$mid'");
					echo "<script>alert('Free membership plan updated successfully.');</script>";
					echo "<script>window.location='logout?action=logout';</script>";
				}
			}
		}
	}
	
	// Get Plan Details
	$SQL_STATEMENT_PLAN =  $DatabaseCo->dbLink->query("SELECT * FROM membership_plan WHERE plan_id='".$planid."'");
	$DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_PLAN);
	$_SESSION['session_plan_id']=$DatabaseCo->dbRow->plan_id;

	// Get Member Details
	$SQL_STATEMENT_MEMBER =  $DatabaseCo->dbLink->query("SELECT mobile,email FROM register_view WHERE matri_id='".$mid."'");
	$row_user = mysqli_fetch_object($SQL_STATEMENT_MEMBER);
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
    <title>
      <?php echo $configObj->getConfigFname(); ?>
    </title>
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
    <!-- Icon -->
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

			  <div class="container">
				  <div class="row">
					  <div class="col-xl-12 col-xl-offset-2">
				  		<h2 class="gt-text-orange text-center gt-margin-top-20">Payment Options</h2>
						<p class="text-center">Pay fast and securly with our multiple payment option.</p>
						<h4 class="gt-border-bottom-smoke-white gt-padding-bottom-15 gt-margin-top-30">
							Select your payment options to pay
						</h4>
						<?php
						 	$razorpay_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payment_method WHERE pay_id='2'"));
							if($razorpay_data->status=='APPROVED'){
						?>	
						<label for="gt-plan-5" class="col-xxl-16 col-xl-16 col-xs-16 col-lg-16 gt-payment-opt">
							<div class="col-xxl-11 col-xl-11 col-lg-14 col-sm-14 col-xs-16">
								<h4>Pay using razorpay</h4>
								<p>
									Plan: 
                  					<span class="gt-text-orange">
                    					<?php echo $DatabaseCo->dbRow->plan_name;?>
                  					</span> , Amount: 
                  					<span class="gt-text-orange">
                    					<?php echo $DatabaseCo->dbRow->plan_amount_type.' '.$DatabaseCo->dbRow->plan_amount; ?>
                  					</span>
                				</p>
							</div>
							<div class="col-xxl-4 col-xl-4 col-lg-16 col-sm-16 col-xs-16 gt-margin-top-15 text-center">
								<form action="paymentConfirmation" method="POST">
									<script
										src="https://checkout.razorpay.com/v1/checkout.js"
										data-key="<?php echo $razorpay_data->razorpay_key;?>"
										data-amount="<?php echo ($DatabaseCo->dbRow->plan_amount*100); ?>"
										data-buttontext="PAY NOW"
										data-name="<?php echo $configObj->getConfigTitle(); ?>"
										data-description="<?php echo $DatabaseCo->dbRow->plan_name;?>"
										data-image="img/<?php echo $configObj->getConfigLogo();?>"
										data-email="<?php echo $row_user->mobile; ?>"
										data-mobile=""
										data-theme.color="#e47203"
									></script>
								</form>
							</div>
						</label>
						<?php } ?>
						<?php
							$bank_data = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM payment_method WHERE pay_id='1'"));
							if($bank_data->status=='APPROVED'){
						?>	
						<label for="gt-plan-5" class="col-xxl-16 col-xl-16 col-xs-16 col-lg-16 gt-payment-opt">
							<div class="col-xxl-11 col-xl-11 col-lg-14 col-sm-14 col-xs-16">
								<h4>Pay at Office</h4>
								<p class="gt-margin-top-20">
								  Bank Name :
								  <span class="gt-text-orange">
									<?php echo $bank_data->bank_name;?>
								  </span>
								</p>
								<p>
								  Bank Account Type :
								  <span class="gt-text-orange">
									<?php echo $bank_data->bank_account_type;?>
								  </span>
								</p>
								<p>
								  Bank Account Name :
								  <span class="gt-text-orange">
									<?php echo $bank_data->bank_account_name;?>
								  </span>
								</p>
								<p>
								  Bank Account No :
								  <span class="gt-text-orange">
									<?php echo $bank_data->bank_account_no;?>
								  </span>
								</p>
								<p>
								  Bank IFSC Code :
								  <span class="gt-text-orange">
									<?php echo $bank_data->bank_ifsc;?>
								  </span>
								</p>
							</div>
						</label>
						<?php } ?>
						
					  </div>
				  </div>
			  </div>
		   </div>
      	</div>
      	<?php include "parts/footer-before-login.php"; ?>
    </div>
    <!-- Jquery --->
    <script src="js/jquery.min.js"></script>
    
    <!-- Bootstrap and green js -->
    <script src="js/bootstrap.js"></script>
    <script src="js/green.js"></script> 

    <!-- Loader js -->
	<script> 
      $(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
      });
    </script>

  </body>
</html>                                                                                                                              
<?php include 'thumbnailjs.php';?>