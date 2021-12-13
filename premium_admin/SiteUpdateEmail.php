<?php 
   include_once '../databaseConn.php';
   include_once '../class/Config.class.php';
   $configObj = new Config();
   include_once '../lib/requestHandler.php';
   $DatabaseCo = new DatabaseConn();
   if(isset($_REQUEST['emailupdate'])){
	   $host=htmlspecialchars($_REQUEST['host'],ENT_QUOTES);
	   $from_email=htmlspecialchars($_REQUEST['email'],ENT_QUOTES);
	   $email_password=htmlspecialchars($_REQUEST['password'],ENT_QUOTES);
	   $email_port=$_POST['email_port'];
	   $email_name=htmlspecialchars($_REQUEST['email_name'],ENT_QUOTES);
	   
	   $DatabaseCo->dbLink->query("UPDATE email_setting SET host='".$host."',email='".$from_email."',email_password='".$email_password."',port='".$email_port."',email_name='".$email_name."' WHERE email_config_id='1'");
	   $msg="Record is updated successfully.";
   }
   $sql=$DatabaseCo->dbLink->query("SELECT * from email_setting WHERE email_config_id='1'");
   $data=mysqli_fetch_object($sql);
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Manage | Email Setting</title>
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
         <?php include "page-part/header.php"; ?> 
         <!-- Left side column. contains the logo and sidebar -->
         <?php include "page-part/left_panel.php"; ?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1 class="lightGrey">Email Setting</h1>
               <ol class="breadcrumb">
                  <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  <li class="active">Email Settings</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <!-- Main row -->
               <div class="row">
                  <div class="box-body">
                     <div class="box box-success gtSiteChangeId">
                        <div class="box-body">
                           <form method="post" name="update_email" id="update_email">
                              <div class="row">
                                 <?php
                                    if(isset($msg)){
								 ?>
                                 <div class="col-xs-12">
									 <div id="success_msg" class="alert alert-success">
										<i class="fa fa-check-circle fa-fw fa-lg"></i>
										Record is updated successfully.
									 </div>
                                 </div>
                                 <?php } ?>
                                 <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <label>Host</label>
                                       <input type="text" class="form-control" name="host" value="<?php echo htmlspecialchars_decode($data->host);?>" data-validetta="required">
                                    </div>
								 </div>
								 <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <label>From Email</label>
                                       <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars_decode($data->email);?>" data-validetta="required">
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <label>Email Password</label>
                                       <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars_decode($data->email_password);?>" data-validetta="required">
                                    </div>
								 </div>
								 <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <label>Port</label>
                                       <input type="text" class="form-control" name="email_port" value="<?php echo $data->port;?>" data-validetta="required" >
                                    </div>
                                 </div>
								 <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <label>Email Name</label>
                                       <input type="text" class="form-control" name="email_name" value="<?php echo htmlspecialchars_decode($data->email_name);?>" data-validetta="required">
                                    </div>
								 </div>
                                 <div class="col-xs-12 text-center siteLogo">
                                    <div class="form-group">
                                       <input type="submit" name="emailupdate" class="btn btn-danger" value="Submit">
                                       <input type="reset"  class="btn btn-danger" value="Cancel">
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
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
      <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
      <script src="../js/validetta.js" type="text/javascript"></script>
      <script type="text/javascript">
         $(function(){
         	$('#update_email').validetta({
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
         }, 4000);	
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
         setPageContext("site-settings","siteupdateemail");
      </script>	
      <script src="dist/js/app.min.js" type="text/javascript"></script>
   </body>
</html>