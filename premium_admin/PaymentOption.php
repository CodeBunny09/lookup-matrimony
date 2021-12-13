<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

// Update Razorpay Details
if(isset($_REQUEST['razorpay'])){
	$pay_name="Razorpay";
	$razorpay_key=$_REQUEST['razorpay_key'];
	$status=$_REQUEST['status'];
	$DatabaseCo->dbLink->query("update payment_method set `razorpay_key`='$razorpay_key',`status`='$status' WHERE pay_id='2'"); 
	echo '<script>alert("Record updated Successfully");</script>';
	echo '<script>window.location="PaymentOption";</script>';
}

// Update Bank Details
if(isset($_REQUEST['bank_detail_submit'])){
	$pay_name="Bank Detail";
	$bank_name=htmlspecialchars($_REQUEST['bank_name'],ENT_QUOTES);
	$bank_account_no=htmlspecialchars($_REQUEST['bank_account_no'],ENT_QUOTES);
	$bank_account_name=htmlspecialchars($_REQUEST['bank_account_name'],ENT_QUOTES);
	$bank_account_type=htmlspecialchars($_REQUEST['bank_account_type'],ENT_QUOTES);
	$bank_ifsc=htmlspecialchars($_REQUEST['bank_ifsc'],ENT_QUOTES);
	$bank_status=$_REQUEST['bank_status'];
	
	$DatabaseCo->dbLink->query("UPDATE payment_method SET `bank_name`='".$bank_name."',`bank_account_no`='".$bank_account_no."',`bank_account_name`='".$bank_account_name."',`bank_account_type`='".$bank_account_type."',`bank_ifsc`='".$bank_ifsc."',`status`='".$bank_status."' where pay_id='1'");
	echo '<script>alert("Record updated Successfully");</script>';
	echo '<script>window.location="PaymentOption";</script>';
}
// Fetch Bank Details 
$STATEMENT_BANK_DETAIL=$DatabaseCo->dbLink->query("SELECT `bank_name`,`bank_account_no`,`bank_account_type`,`bank_account_name`,`bank_ifsc`,`status` FROM payment_method WHERE pay_id='1'");
$row_bank=mysqli_fetch_object($STATEMENT_BANK_DETAIL);

// Fetch Razorpay Details 
$STATEMENT_RAZOR_DETAIL=$DatabaseCo->dbLink->query("SELECT `razorpay_key`,`status` FROM payment_method WHERE pay_id='2'");
$row_razorpay=mysqli_fetch_object($STATEMENT_RAZOR_DETAIL);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Payment Option</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	  
    <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
   
    <!-- Validation css -->
    <link rel="stylesheet" href="../css/validate.css">
   
  </head>
  <body class="skin-blue">
   		<!-- ICON LOADER -->
        <div class="preloader-wrapper text-center">
          <div class="spinner"></div>
        </div>
   		<div class="wrapper" style="display:none" id="body">

      		<?php include "page-part/header.php"; ?> 
      		<!-- Left side column. contains the logo and sidebar -->
      		<?php include "page-part/left_panel.php"; ?>
      		<!-- Content Wrapper. Contains page content -->
			  <div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
				  <h1 class="lightGrey">
					Payment Option
				  </h1>
				  <ol class="breadcrumb">
					<li>
					  <a href="dashboard">
						<i class="fa fa-dashboard">
						</i> Home
					  </a>
					</li>
					<li class="active">Payment Option
					</li>
				  </ol>
				</section>
				<!-- Main content -->
				<section class="content">
				  <!-- Small boxes (Stat box) -->
				  <!-- /.row -->
				  <!-- Main row -->
				  <div class="row">
					<div class="col-lg-12 col-xs-12">
             			<div class="box box-success">
							<div class="box-header with-border">
							  <h4>Razorpay Setting</h4>
							</div>
                			<div class="box-body">
                				<div class="row gtNewMemPlan">
                 		 			<form name="add_razorpay" id="add_razorpay" method="post">
                    					<center><img src="dist/img/credit/razorpay.png" class="img-thumbnail"></center>
										<div class="col-md-6 col-xs-12 mt-10">
										  <div class="form-group">
											<label>
											  Razorpay Key
											</label>
											<input type="text" class="form-control" name="razorpay_key" data-validetta="required" value="<?php echo $row_razorpay->razorpay_key; ?>">
										  </div>
										</div>
										<div class="col-md-6 col-xs-12 mt-10">
											<div class="form-group">
												<label>Status</label>
												<select class="form-control" name="status" data-validetta="required">
													<option value="APPROVED" <?php if($row_razorpay->status=='APPROVED'){ echo "selected"; }?>>
														Active
													</option>
													<option value="UNAPPROVED" <?php if($row_razorpay->status=='UNAPPROVED'){ echo "selected";}?>>
														Inactive
													</option>
												</select>
											</div>
                						</div>
										<div class="form-group text-center">
										  <input type="submit" name="razorpay" class="btn btn-green" value="Submit">
										  <input type="reset" class="btn btn-danger" value="cancel">
										</div>
                					</form>
                				</div>
            				</div>
          	 			</div>
          			</div>  
					<div class="col-lg-12 col-xs-12 mt-10">
						<div class="box box-success">
							<form name="add_bank_detail" id="add_bank_detail" method="post">
								<div class="box-header with-border">
									<h4>Bank Details</h4>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-md-12 col-xs-12 mt-10">
											<div class="col-md-6">
												<div class="form-group">
													<label>Enter Bank Name</label>
													<input type="text" class="form-control" name="bank_name" data-validetta="required" value="<?php echo $row_bank->bank_name; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Enter Account Type</label>
													<input type="text" class="form-control" name="bank_account_type" data-validetta="required" value="<?php echo $row_bank->bank_account_type; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Enter Account No</label>
													<input type="text" class="form-control" name="bank_account_no" data-validetta="required" value="<?php echo $row_bank->bank_account_no; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Enter Bank IFSC Code</label>
													<input type="text" class="form-control" name="bank_ifsc" data-validetta="required" value="<?php echo $row_bank->bank_ifsc; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Enter Account Name</label>
													<input type="text" class="form-control" name="bank_account_name" data-validetta="required" value="<?php echo $row_bank->bank_account_name; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Status</label>
													<select class="form-control" name="bank_status" data-validetta="required">
														<option value="APPROVED" <?php if($row_bank->status=='APPROVED'){echo "selected";}?>>
															Active
														</option>
														<option value="UNAPPROVED" <?php if($row_bank->status=='UNAPPROVED'){echo "selected";}?>>
															Inactive
														</option>
													</select>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="form-group text-center">
											<input type="submit" name="bank_detail_submit" class="btn btn-green" value="Submit">
											<input type="reset" class="btn btn-danger" value="cancel">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- right col -->
				  </div>
				  <!-- /.row (main row) -->
				</section>
				<!-- /.content -->
			 </div>
			<!-- /.content-wrapper -->
			<?php include "page-part/footer.php"; ?>
		</div>
		<!-- ./wrapper -->
	  
		<!-- jQuery 2.1.3 -->
		<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
		<!-- jQuery UI 1.11.2 -->
		<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
		<script>
		   $(document).ready(function() {
		   $('#body').show();
		   $('.preloader-wrapper').hide();
		   });
		</script>
		<script src="../js/validetta.js" type="text/javascript"></script>
		<script type="text/javascript">
		  $(function(){
			$('#add_bank_detail').validetta({
			  errorClose : false,
			  realTime : true
			});
		  });
		</script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
		  $.widget.bridge('uibutton', $.ui.button);
		</script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
		<!-- Morris.js charts -->
		<!--jquery for left menu active class-->
		<script type="text/javascript" src="dist/js/general.js"></script>
		<script type="text/javascript" src="dist/js/cookieapi.js"></script>
		<script type="text/javascript">
		  setPageContext("payment","pay-add");
		</script>	
		<!--jquery for left menu active class end--> 
		<script src="dist/js/app.min.js" type="text/javascript"></script>
	</body>
</html> 