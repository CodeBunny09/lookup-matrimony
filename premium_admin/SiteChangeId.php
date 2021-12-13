<?php 
	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once '../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	if(isset($_POST['change'])){
		$prifix=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['prifix']);
		mysqli_query($DatabaseCo->dbLink,"update register set prefix='$prifix' ");
		$msg="Record is updated successfully.";
	}
	$sql=mysqli_query($DatabaseCo->dbLink,"select prefix from register");
	$data=mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Manage | Prefix</title>
	<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
	<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
	<link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->
    <!-- IONICONS -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- IONICONS END-->    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
	<!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->   
	<!-- VALIDATION CSS -->
    <link href="css/postvalidationcss.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/validate.css">
    <!-- VALIDATION CSS END-->
</head>
<body class="skin-blue">
 	<!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
        	<div class="spinner"></div>
        </div>
        <!-- ICON LOADER END-->
	<div class="wrapper" style="display:none" id="body">
	<!-- HEADER & LEFT MENU BAR -->
	<?php include "page-part/header.php"; ?> 
	<?php include "page-part/left_panel.php"; ?>
	<!-- HEADER & LEFT MENU BAR END-->
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1 class="lightGrey">Update Prefix Id</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
				<li class="active"> Update Prefix Id</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
		<!-- /.row -->
			<div class="row">
				<div class="box-body">
					<div class="box box-success">
						<div class="box-body gtSiteChangeId">
							<form method="post" name="changeprifix" id="changeprifix">
								<div class="row">
								<?php 
									if(isset($msg)){
								?>
								<div class="col-xs-12">
									<div id="success_msg" class="alert alert-success">
                    					<i class="fa fa-check-circle fa-fw fa-lg"></i>Record is updated successfully.
                                    </div>
                                </div>
								<?php
									}
								?>
								<div class="col-md-6 col-md-offset-3 col-xs-12">
									<div class="form-group">
										<label>Update Prefix Id</label>
										<input type="text" class="form-control" name="prifix" data-validetta="required" value="<?php echo htmlspecialchars_decode($data['prefix']);?>">
									</div>
								</div>
								<div class="col-xs-12 text-center siteLogo">
									<div class="form-group">
										<input type="submit" class="btn btn-danger" value="Submit" name="change"/>
										<input type="reset" class="btn btn-danger" value="Cancel"/>
									</div>
 								</div>
								</div>
							</form> 
 						</div>
					</div>
				</div>
          </div><!-- /.row (main row) -->
	</section><!-- /.content -->
</div>
<?php include "page-part/footer.php"; ?>
</div><!-- ./wrapper -->
	<!-- jQuery 2.1.3 -->
	<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
	<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
    <!-- jQuery UI 1.11.2 -->
    <script src="../js/validetta.js" type="text/javascript"></script>
    <script type="text/javascript">
   	 	$(function(){
    		$('#changeprifix').validetta({
    			errorClose : false,
    			realTime : true
    		});
    	});
    </script>
    <script>
    	$(document).ready(function(e) {
    		if($('#success_msg').html()!=''){
    			setTimeout(function() {
    				$("#success_msg").css("opacity",0);
   					 $("#success_msg").html('');
    			},4000);	
    		}
    	});
    </script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    	$.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js"></script>
    <script type="text/javascript" src="dist/js/cookieapi.js"></script>
    <script type="text/javascript">
    	setPageContext("site-settings","sitechangeid");
    </script>	
    <!--jquery for left menu active class end-->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
</body>
</html>