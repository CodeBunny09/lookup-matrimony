<?php
   include_once '../databaseConn.php';
   include_once '../class/Config.class.php';
   $configObj = new Config();
   include_once '../lib/requestHandler.php';
   $DatabaseCo = new DatabaseConn();
   if(isset($_REQUEST['basicupdate'])){
   $web_domainname=htmlspecialchars($_REQUEST['web_domainname'],ENT_QUOTES);
   $welcome_text=htmlspecialchars($_REQUEST['welcome_text'],ENT_QUOTES);
   $webname=htmlspecialchars($_REQUEST['webname'],ENT_QUOTES);
   $webtitle=htmlspecialchars($_REQUEST['webtitle'],ENT_QUOTES);
   $web_description=htmlspecialchars($_REQUEST['web_description'],ENT_QUOTES);
   $web_fshort_description=htmlspecialchars($_REQUEST['web_fshort_description'],ENT_QUOTES);
   $f_text=htmlspecialchars($_REQUEST['f_text'],ENT_QUOTES);
   $contact_no=htmlspecialchars($_REQUEST['contact_no'],ENT_QUOTES);
   $web_keyword=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['web_keyword']);
   $interest_setting=$_POST['interest_setting'];
   $profile_view_setting=$_POST['profile_view_setting'];
   $username_setting=$_POST['username_setting'];
   $profile_verification=$_POST['profile_verification'];
   mysqli_query($DatabaseCo->dbLink,"update site_config set web_name='$web_domainname',web_frienly_name='$webname',welcome_text='$welcome_text',description='$web_description',title='$webtitle',footer='$f_text',web_fshort_description='$web_fshort_description',contact_no='$contact_no',keywords='$web_keyword',interest_setting='$interest_setting',profile_view_setting='$profile_view_setting',username_setting='$username_setting',profile_verification='$profile_verification' where id='1'");
   $msg="Record is updated successfully.";
   }
   $sql=mysqli_query($DatabaseCo->dbLink,"select web_name,welcome_text,web_frienly_name,title,description,footer,web_fshort_description,contact_no,keywords,profile_view_setting,interest_setting,username_setting,profile_verification from site_config where id='1'");
   $data=mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>Manage | Basic Site Settings</title>
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
               <h1 class="lightGrey">Basic Site Settings</h1>
               <ol class="breadcrumb">
                  <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  <li class="active">Basic Site Settings</li>
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
                           <form method="post" name="basic_form" id="basic_form">
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
                                       Enter Webname (<b class="text-danger">Domain name</b>)
                                       </label>
                                       <input type="text" class="form-control" name="web_domainname" value="<?php echo htmlspecialchars_decode($data['web_name']); ?>" data-validetta="required">
                                    </div>
                                     <div class="form-group">
                                       <label>
                                       Enter Welcome text (Index Page)
                                       </label>
                                       <input type="text" class="form-control" name="welcome_text" value="<?php echo htmlspecialchars_decode($data['welcome_text']); ?>" data-validetta="required">
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Enter Web Friendly Name
                                       </label>
                                       <input type="text" class="form-control" name="webname" value="<?php echo htmlspecialchars_decode($data['web_frienly_name']); ?>" data-validetta="required">
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Enter Website Title
                                       </label>
                                       <input type="text" class="form-control" name="webtitle" value="<?php echo htmlspecialchars_decode($data['title']); ?>" data-validetta="required">
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Enter Website Keywords
                                       </label>
                                       <textarea class="form-control" name="web_keyword" data-validetta="required"><?php echo htmlspecialchars_decode($data['keywords']); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       	Express Interest Sent Setting
                                       </label>
                                      	<select name="interest_setting" class="form-control">
											<option value="send_to_all" <?php if($data['interest_setting'] == 'send_to_all'){ echo 'selected'; } ?>>All Member Can Send</option>
											<option value="send_to_paid" <?php if($data['interest_setting'] == 'send_to_paid'){ echo 'selected'; } ?>>Only Paid Member Can Send</option>
										</select>
                                    </div>
									<div class="form-group">
                                       <label>
                                       	Profile View Setting
                                       </label>
                                      	<select name="profile_view_setting" class="form-control">
											<option value="visible_to_all" <?php if($data['profile_view_setting'] == 'visible_to_all'){ echo 'selected'; } ?>>All Member View</option>
											<option value="visible_to_paid" <?php if($data['profile_view_setting'] == 'visible_to_paid'){ echo 'selected'; } ?>>Only Paid Member View</option>
										</select>
                                    </div>
									<div class="form-group">
                                       <label>
                                       	Username Setting
                                       </label>
                                      	<select name="username_setting" class="form-control">
											<option value="full_username" <?php if($data['username_setting'] == 'full_username'){ echo 'selected'; } ?>>Show full username</option>
											<option value="first_surname" <?php if($data['username_setting'] == 'first_surname'){ echo 'selected'; } ?>>Show firstname and lastname first letter</option>
											<option value="hide_username" <?php if($data['username_setting'] == 'hide_username'){ echo 'selected'; } ?>>Hide username</option>
										</select>
                                    </div>
									<div class="form-group">
                                       <label>
                                       	Profile Activation Method Setting
                                       </label>
                                      	<select name="profile_verification" class="form-control">
											<option value="auto_approve" <?php if($data['profile_verification'] == 'auto_approve'){ echo 'selected'; } ?>>User can activate profile via email verification link</option>
											<option value="manual_approve" <?php if($data['profile_verification'] == 'manual_approve'){ echo 'selected'; } ?>>Approve Profile Only Via Admin</option>
										</select>
                                    </div>
                                 </div>
                                 <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <label>
                                       Enter Footer Text
                                       </label>
                                       <input type="text" class="form-control" name="f_text" value="<?php echo htmlspecialchars_decode($data['footer']); ?>" data-validetta="required">
                                    </div>
                                    
                                    <div class="form-group">
                                       <label>
                                       Enter Contact Number
                                       </label>
                                       <input type="text" class="form-control" name="contact_no" value="<?php echo htmlspecialchars_decode($data['contact_no']); ?>" data-validetta="required">
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Enter Website Description
                                       </label>
                                       <textarea class="form-control" name="web_description" data-validetta="required" rows="5"><?php echo htmlspecialchars_decode($data['description']);?></textarea>
                                    </div>
                                    <div class="form-group">
                                       <label>
                                       Website Footer Short Description
                                       </label>
                                       <textarea class="form-control" name="web_fshort_description" data-validetta="required" rows="5"><?php echo htmlspecialchars_decode($data['web_fshort_description']);?></textarea>
                                    </div>
                                 </div>
                                 <div class="col-xs-12 text-center siteLogo">
                                    <div class="form-group">
                                       <input type="submit" name="basicupdate" class="btn btn-danger" value="Submit">
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
        	$('#basic_form').validetta({
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
         setPageContext("site-settings","sitebasicsetting");
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