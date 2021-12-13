<?php 
   include_once '../databaseConn.php';
   include_once '../class/Config.class.php';
   $configObj = new Config();
   include_once '../lib/requestHandler.php';
   $DatabaseCo = new DatabaseConn();
   $salt='%^&$#@*!';
   if(isset($_REQUEST['changepass'])){
   		$oldpass=trim($_REQUEST['oldpassword']);
   		$oldpass=md5($salt.$oldpass);
   		$newpass=trim($_REQUEST['newpassword']);
   		$newpass=md5($salt.$newpass);
   		$num=mysqli_num_rows(mysqli_query($DatabaseCo->dbLink,"select id from admin_users where `pswd`='$oldpass'"));
   		if($num>0) {		
   			$sql="update admin_users set `pswd`='$newpass' where `pswd`='$oldpass' and id='1'";
   			$go=mysqli_query($DatabaseCo->dbLink,$sql);
   			$msg="Record is updated successfully.";
   		}else{
   			$error="Please enter correct old password.";
   		}
	}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Manage | Change Password</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <!-- BOOTSTRAP & CUSTOM CSS -->
      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="css/custom.css" rel="stylesheet" type="text/css" />
      <!-- BOOTSTRAP & CUSTOM CSS END-->    
      <!-- FONTAWSOME -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <!-- FONTAWSOME END--> 
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
               <h1 class="lightGrey">Change Admin Password</h1>
               <ol class="breadcrumb">
                  <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  <li class="active">Change Admin Password</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <!-- Small boxes (Stat box) -->
               <!-- /.row -->
               <!-- Main row -->
               <div class="row">
                  <div class="box-body gtSiteChangeId">
                     <div class="box box-success">
                        <div class="box-body">
                           <form method="post" name="changepass" id="changepass">
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
                                 <?php
                                    }
									if(isset($error)){
								 ?>
                                 <div id="success_msg" class="alert alert-danger">
                                    <i class="fa fa-times-circle fa-fw fa-lg"></i>
                                    Please enter correct old password.
                                 </div>
                                 <?php
                                    }
                                 ?>
                                 <div class="col-md-6 col-md-offset-3 col-xs-12">
                                    <div class="form-group">
                                       <label>
                                       Enter Old Password
                                       </label>
                                       <input type="password" class="form-control" name="oldpassword" data-validetta="required" placeholder="Enter Old Password">
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Enter New Password
                                       </label>
                                       <input type="password" class="form-control" name="newpassword" data-validetta="required" placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Confirm New Password
                                       </label>
                                       <input type="password" class="form-control" name="cpassword" data-validetta="equalTo[newpassword]" placeholder="Confirm New Password">
                                    </div>
                                 </div>
                                 <div class="col-xs-12 text-center siteLogo">
                                    <div class="form-group">
                                       <input type="submit" name="changepass" class="btn btn-danger" value="Submit">
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
         $('#changepass').validetta({
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
      <!-- AdminLTE App -->
      <!--jquery for left menu active class-->
      <script type="text/javascript" src="dist/js/general.js"></script>
      <script type="text/javascript" src="dist/js/cookieapi.js"></script>
      <script type="text/javascript">
         setPageContext("site-settings","sitepassword");
      </script>	
      <!--jquery for left menu active class end-->
      <script src="dist/js/app.min.js" type="text/javascript"></script>
   </body>
</html>