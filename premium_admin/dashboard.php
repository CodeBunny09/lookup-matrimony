<?php
 include_once '../databaseConn.php';
 include_once '../class/Config.class.php';
 $configObj = new Config();
 include_once './lib/requestHandler.php';
 $DatabaseCo = new DatabaseConn();
 include_once '../class/Config.class.php';
 $configObj = new Config();
 $DatabaseCoCount = new DatabaseConn();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Dashboard</title>
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
		<h1 class="lightGrey">Members Details</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</section>
		<section class="content">
			<div class="row">
				<?php if(isset($_SESSION['is_staff'])){ if($_SESSION['is_staff'] == 'Yes'){ ?>
				<a href="dashboard" class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(index_id) from  register_view", $DatabaseCoCount);?></h3>
							<p>All Members</p>
						</div>
						<div class="icon"><i class="ion ion-person"></i></div>
					</div>
				</a>
				<a  href="dashboard"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(index_id) from  register_view where status='Active'", $DatabaseCoCount);?></h3>
							<p>Active Members</p>
						</div>
						<div class="icon"><i class="ion ion-person"></i></div>
					</div>
				</a>
				<a href="dashboard"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(index_id) from  register_view where status='Paid'", $DatabaseCoCount);?></h3>
							<p>Paid Members</p>
						</div>
						<div class="icon"><i class="ion ion-person-add"></i></div>
					</div>
				</a><!-- ./col -->
				<a href="dashboard"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(index_id) from  register_view where fstatus='Featured'", $DatabaseCoCount);?></h3>
							<p>Featured Members</p>
						</div>
						<div class="icon"><i class="ion ion-person"></i></div>
					</div>
				</a>
				<?php }}else{ ?>
				<a href="members" class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(index_id) from  register_view", $DatabaseCoCount);?></h3>
							<p>All Members</p>
						</div>
						<div class="icon"><i class="ion ion-person"></i></div>
					</div>
				</a>
				<a  href="memberActiveToPaid"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(index_id) from  register_view where status='Active'", $DatabaseCoCount);?></h3>
							<p>Active Members</p>
						</div>
						<div class="icon"><i class="ion ion-person"></i></div>
					</div>
				</a>
				<a href="memberPaidToSpotlight"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(index_id) from  register_view where status='Paid'", $DatabaseCoCount);?></h3>
							<p>Paid Members</p>
						</div>
						<div class="icon"><i class="ion ion-person-add"></i></div>
					</div>
				</a><!-- ./col -->
				<a href="memberPaidToSpotlight"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(index_id) from  register_view where fstatus='Featured'", $DatabaseCoCount);?></h3>
							<p>Featured Members</p>
						</div>
						<div class="icon"><i class="ion ion-person"></i></div>
					</div>
				</a>
				<?php } ?>
			</div>
			<div class="row">
				<section class="content-header margin-bottom">
          			<h1 class="lightGrey">Site Statistics</h1>
				</section>
	 		<?php if(isset($_SESSION['is_staff'])){ if($_SESSION['is_staff'] == 'Yes'){ ?>
	 			<a href="dashboard"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(adv_id) from  advertisement", $DatabaseCoCount);?></h3>
							<p>Advertisement</p>
						</div>
						<div class="icon"><i class="ion ion-stats-bars"></i></div>
					</div>
				</a><!-- ./col -->
				<a href="dashboard"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(plan_id) from  membership_plan", $DatabaseCoCount);?></h3>
							<p>Membership Plans</p>
						</div>
						<div class="icon"><i class="ion ion-pie-graph"></i></div>
					</div>
				</a><!-- ./col -->
 				<a href="dashboard" class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
 							<h3><?php echo getRowCount("select count(ei_id) from  expressinterest", $DatabaseCoCount);?></h3>
 							<p>Express Interest</p>
						</div>
						<div class="icon"><i class="ion ion-bag"></i></div>
					</div>
				</a><!-- ./col -->
 				<a href="dashboard"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(story_id) from  success_story", $DatabaseCoCount);?></h3>
							<p>Success Story</p>
						</div>
						<div class="icon"><i class="ion ion-person"></i></div>
					</div>
				</a><!-- ./col -->
				<?php }}else{ ?>
				<a href="Advertise"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(adv_id) from  advertisement", $DatabaseCoCount);?></h3>
							<p>Advertisement</p>
						</div>
						<div class="icon"><i class="ion ion-stats-bars"></i></div>
					</div>
				</a><!-- ./col -->
				<a href="membership_plan"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(plan_id) from  membership_plan", $DatabaseCoCount);?></h3>
							<p>Membership Plans</p>
						</div>
						<div class="icon"><i class="ion ion-pie-graph"></i></div>
					</div>
				</a><!-- ./col -->
 				<a href="memberExpInterestDetail" class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
 							<h3><?php echo getRowCount("select count(ei_id) from  expressinterest", $DatabaseCoCount);?></h3>
 							<p>Express Interest</p>
						</div>
						<div class="icon"><i class="ion ion-bag"></i></div>
					</div>
				</a><!-- ./col -->
 				<a href="success_story_approval"  class="col-lg-3 col-xs-6">
					<div class="small-box bg-white">
						<div class="inner">
							<h3><?php echo getRowCount("select count(story_id) from  success_story", $DatabaseCoCount);?></h3>
							<p>Success Story</p>
						</div>
						<div class="icon"><i class="ion ion-person"></i></div>
					</div>
				</a><!-- ./col -->
				<?php } ?>
			</div>
			<!-- /.row (main row) -->
			<div class="row">
				<section class="content-header margin-bottom">
          			<h1 class="lightGrey">Recent Members</h1>
				</section>
				<div class="col-md-12 dashboard-box">
				<!-- USERS LIST -->
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Latest Members</h3>
						<div class="box-tools pull-right">
							<span class="label label-danger">12 Latest Members</span>
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<ul class="users-list clearfix">
							<?php
								$exe=mysqli_query($DatabaseCo->dbLink,"select username,index_id,photo1,m_status,gender,reg_date,religion_name,caste_name,country_name,city_name,email from register_view order by index_id DESC  limit 0,12");
								while($fetch=mysqli_fetch_object($exe)){
								
							?>
							<li class="col-xs-6 col-md-3 col-lg-3">
							<?php 
								if($fetch->photo1!='' && file_exists("../my_photos/".$fetch->photo1)){
							?>
                            <img src="../my_photos/<?php echo $fetch->photo1;?>" alt="<?php echo $fetch->username;?>" class="img-thumbnail"/>
                            <?php } elseif($fetch->gender=="Male") { ?>
                            <img src="../img/male.png" alt="<?php echo $fetch->username;?>" class="img-thumbnail" /> 
                                
							<?php }else{ ?>
							 <img src="../img/female.png" alt="<?php echo $fetch->username;?>" class="img-thumbnail" /> 
							<?php }?>
								<a target="_blank" class="users-list-name" href="memberFullProfile?email=<?php echo $fetch->email;?>"><?php echo $fetch->username;?></a>
								<span class="users-list-date"><?php echo $fetch->m_status ;?>,<?php echo $fetch->gender; ?></span>
								<span class="users-list-date"><?php echo date("l, d M Y", (strtotime($fetch->reg_date)))?></span>
								<span class="users-list-date"><?php echo $fetch->religion_name;?>,<?php echo $fetch->caste_name;?></span>
								<span class="users-list-date"><?php echo $fetch->city_name;?>,<?php echo $fetch->country_name;?></span>
							</li>
							<?php } ?>
						</ul><!-- /.users-list -->
					</div><!-- /.box-body -->
				</div>
                </div>
            </div>
		</section><!-- /.content -->
		<!-- /.content-wrapper -->
      </div>
		<?php include "page-part/footer.php"; ?>
	<!-- ./wrapper -->
 </div>
    
	<!-- jQuery 2.1.3 -->
	<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    
	<!-- jQuery UI 1.11.2 -->
	<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.2 JS -->
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>     
	
	
	<!-- Slimscroll -->
	<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<!-- FastClick -->
	<script src='plugins/fastclick/fastclick.min.js'></script>
	<!-- AdminLTE App -->
	<script src="dist/js/app.min.js" type="text/javascript"></script>
	<!--jquery for left menu active class-->
	<script type="text/javascript" src="dist/js/general.js"></script>
	<script type="text/javascript" src="dist/js/cookieapi.js"></script>
	<script type="text/javascript">
		setPageContext("dashy","dashy");
	</script>
    <?php include ('profile_function.php'); ?>
</body>
</html>