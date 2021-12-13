<?php
   include_once '../databaseConn.php';
   include_once '../class/Config.class.php';
   $configObj = new Config();
   include_once '../lib/requestHandler.php';
   $DatabaseCo = new DatabaseConn();
   if(isset($_REQUEST['linkupdate'])){
   		$facebook=htmlspecialchars($_REQUEST['facebook'],ENT_QUOTES);
   		$twitter=htmlspecialchars($_REQUEST['twitter'],ENT_QUOTES);
   		$linkedin=htmlspecialchars($_REQUEST['linkedin'],ENT_QUOTES);
   		$google=htmlspecialchars($_REQUEST['google'],ENT_QUOTES);
   		$DatabaseCo->dbLink->query("update site_config set facebook='$facebook',twitter='$twitter',linkedin='$linkedin',google='$google' where id='1'") or die(	mysqli_error($DatabaseCo->dbLink));
   		$msg="Record is updated successfully.";
   }
   $sql=mysqli_query($DatabaseCo->dbLink,"select facebook,twitter,linkedin,google from site_config where id='1'");
   $data=mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Manage | Social Icon Link </title>
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
               <h1 class="lightGrey">Social Icon Link</h1>
               <ol class="breadcrumb">
                  <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  <li class="active">Social Icon Link</li>
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
                           <form method="post" name="update_link" id="update_link">
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
                                  ?>
                                 <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <label>
                                       Enter Facebook Icon Link
                                       </label>
                                       <input type="text" class="form-control" name="facebook" value="<?php echo htmlspecialchars_decode($data['facebook']);?>" data-validetta="required">
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Enter Twitter Icon Link
                                       </label>
                                       <input type="text" class="form-control" name="twitter" value="<?php echo htmlspecialchars_decode($data['twitter']);?>" data-validetta="required">
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <label>
                                       Enter LinkedIn Icon Link
                                       </label>
                                       <input type="text" class="form-control" name="linkedin" value="<?php echo htmlspecialchars_decode($data['linkedin']);?>" data-validetta="required"> 
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Enter Google+ Link
                                       </label>
                                       <input type="text" class="form-control" name="google" value="<?php echo htmlspecialchars_decode($data['google']); ?>" data-validetta="required">
                                    </div>
                                 </div>
                                 <div class="col-xs-12 text-center siteLogo">
                                    <div class="form-group">
                                       <input type="submit" name="linkupdate" class="btn btn-danger" value="Submit">
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
     
      <script src="../js/validetta.js" type="text/javascript"></script>
      <script type="text/javascript">
         $(function(){
         	$('#update_link').validetta({
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
         setPageContext("site-settings","sitesocialicon");
       </script>	
      <!--jquery for left menu active class end-->
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