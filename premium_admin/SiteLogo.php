<?php 
	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once '../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once '../class/Config.class.php';
	$configObj = new Config();
	$sql=$DatabaseCo->dbLink->query("select web_logo_path,favicon from site_config where id='1'");
	$data=mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
    <title>Manage | Logo & Favicon </title>
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
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1 class="lightGrey">Logo & Favicon</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Logo & Favicon</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<!-- Main row -->
			<div class="row">
				<div class="box-body">
					<div class="box box-success">
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12">
									<div class='error-msg' id='validationSummary' style="display:none !important;"></div>
								</div>
								<div class="clearfix"></div>
								<form name="add-form" id="add-form" action="newvalidation" method="post" enctype="multipart/form-data">	 
									<div class="col-md-6 col-xs-12">
										<div class="form-group logoUpload">
											<label><h4>Upload Logo</h4></label>
                                            <div class="col-xs-12 thumbnail">
                                        		<img src="../img/<?php echo $data['web_logo_path'];?>" width="300">
                                            </div>
											<input type="file" class="form-control" name="siteimage" id="logo"  >
										</div>
									</div>
									
									<div class="col-md-6 col-xs-12 faviconUpload">
										<div class="form-group">
											<label><h4>Upload Favicon</h4></label>
                                            <div class="col-xs-12 thumbnail">
                                            	<img src="../img/<?php echo $data['favicon'];?>" width="50">
                                            </div>
											<input type="file" class="form-control" name="fvicon" id="fvicon" >
										</div>
									</div>
                                    
                                    <div class="col-xs-12 logoUpload">
                                    <div class="alert alert-success alert-dismissable">
										<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
										<i class="icon fa fa-info"></i>Only JPEG, JPG, GIF, PNG types are accepted. 2 MB maximum size.
									</div>
                                    </div>
									<div class="col-xs-12 text-center siteLogo">
										<div class="form-group">
											<input type="submit" class="btn btn-danger"name="sub_add_logo" value="Submit">
											<input type="reset" class="btn btn-danger" value="Cancel" id="configreset">
											<input type="hidden" id="max_basic_id">
											<input type="hidden" name="logo_photo" value="<?php echo $data['web_logo_path'];?>">
											<input type="hidden" name="fvcon_photo" value="<?php echo $data['favicon'];?>">
											<input type="hidden" name="action" value="UPDATE">
										</div>
									</div>
								</form>
							</div>
							  
						</div>
					</div>
				</div>
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php include "page-part/footer.php"; ?>
	</div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/util/location.js"></script>
    <script type="text/javascript" src="js/util/jquery.form.js"></script>
    <script type="text/javascript" src="./js/util/location-validation.js"></script>
    <script type="text/javascript">
    	registerForm();
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js"></script>
    <script type="text/javascript" src="dist/js/cookieapi.js"></script>
    <script type="text/javascript">
    	setPageContext("site-settings","sitelogo");
    </script>	
    <!--jquery for left menu active class end-->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    	$.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
</body>
</html>