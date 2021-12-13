<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
if(isset($_REQUEST['edit_template_id']))
{
$email_temp_id=$_REQUEST['edit_template_id'];
$data=$DatabaseCo->dbLink->query("select * from email_templates where  EMAIL_TEMPLATE_ID='$email_temp_id'");
$row=mysqli_fetch_array($data);
if(isset($_REQUEST['updateemail_temp']))
{
$email_temp_id=$_REQUEST['edit_template_id'];
$temp_name=htmlspecialchars($_REQUEST['temp_name'],ENT_QUOTES);
$subject=htmlspecialchars($_REQUEST['email_subject'],ENT_QUOTES);
$condition=$_REQUEST['condition'];
$status=$_REQUEST['status'];
$msg=htmlspecialchars($_REQUEST['message'],ENT_QUOTES);
$DatabaseCo->dbLink->query("update email_templates set EMAIL_TEMPLATE_NAME='$temp_name',EMAIL_SUBJECT='$subject',PRE_CONDITION='$condition',EMAIL_CONTENT='$msg',STATUS='$status' where EMAIL_TEMPLATE_ID='$email_temp_id'");
echo "<script>window.location='EmailTemplates?update_status=success';</script>";
}
else
{
$statusObj = new Status();
$statusObj->setActionSuccess(false);
$STATUS_MESSAGE = "Please select value to complete action.";	  
}
}
if(isset($_POST['addemail_temp']))
{
$temp_name=htmlspecialchars($_POST['temp_name'],ENT_QUOTES);
$subject=htmlspecialchars($_POST['email_subject'],ENT_QUOTES);
$condition=$_POST['condition'];
$status=$_POST['status'];
$msg=htmlspecialchars($_POST['message'],ENT_QUOTES);
$DatabaseCo->dbLink->query("insert into email_templates (EMAIL_TEMPLATE_NAME,EMAIL_SUBJECT,PRE_CONDITION,EMAIL_CONTENT,STATUS) values('$temp_name','$subject','$condition','$msg','$status') ");
echo "<script>window.location='EmailTemplates?update_status=success';</script>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Add Email Template
    </title>
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
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-------------------Validation css ------------------>
    <link rel="stylesheet" href="../css/validate.css">
    <!-------------------Validation css------------------>
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
          <h1 class="lightGrey">
            Add New Email Template
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
            <li class="active"> Add New Email Template
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
              <div class="box-top updateSite">
              	<div class="row">
                <div class="col-md-3 col-sm-6">
                  <a href="EmailTemplates?email_status=all" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-list hidden-xs">
                    </i>All Email Templates
                  </a>
                </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xs-12 mt-10">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h4>
                    <i class="fa fa-plus fa-fw">
                    </i> New Email Template
                  </h4>
                </div>
                <div class="row gtNewMemPlan">
                  <form name="add_emailtemp" id="add_emailtemp" method="post">
                    <div class="box-body">
                      <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                          <label>
                            Template Name:
                          </label>
                          <input type="text" class="form-control" name="temp_name"data-validetta="required" value="<?php  if(isset($_REQUEST['edit_template_id'])) {echo htmlspecialchars_decode($row['EMAIL_TEMPLATE_NAME']); } ?>">
                        </div>
                        <div class="form-group">
                          <label>
                            Email Subject:
                          </label>
                          <input type="text" class="form-control" name="email_subject" data-validetta="required"  value="<?php if(isset($_REQUEST['edit_template_id'])){ echo htmlspecialchars_decode($row['EMAIL_SUBJECT']);} ?>">
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                          <label>
                            Pre Condition:
                          </label>
                          <select class="form-control" name="condition" data-validetta="required">
                            <option value="Registration" 
                                    <?php if(isset($_REQUEST['edit_template_id'])){ if($row['PRE_CONDITION']=='REGISTRATION') {echo "selected";} }?>>
                            Registration 	
                            </option>
                          <option value="MEMBER_ACTION" 
                                  <?php if(isset($_REQUEST['edit_template_id'])){ if($row['PRE_CONDITION']=='MEMBER_ACTION') {echo "selected";} }?>>
                          Member Action
                          </option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label>
                        Status:
                      </label>
                      <select class="form-control" name="status" data-validetta="required">
                        <option value="APPROVED" 
                                <?php if(isset($_REQUEST['edit_template_id'])){ if($row['STATUS']=='APPROVED') {echo "selected";} } ?>>
                        Active 
                        </option>
                      <option value="UNAPPROVED" 
                              <?php if(isset($_REQUEST['edit_template_id'])) { if($row['STATUS']=='UNAPPROVED') {echo "selected";} }?>>
                      Inactive
                      </option>
                    </select>
                </div>
              </div>
              <div class="col-xs-12 col-md-12">
                <div class="form-group">
                  <label>
                    Email Body:
                  </label>
                  <textarea class="form-control textarea" style="height:200px;" name="message" data-validetta="required">
                    <?php if(isset($_REQUEST['edit_template_id'])) { echo htmlspecialchars_decode($row['EMAIL_CONTENT']); } ?>
                  </textarea>
                </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12 pull-left form-group">
                  
              
                <?php
if(isset($_REQUEST['edit_template_id']))
{?>
                <input type="submit" name="updateemail_temp" value="Save" class="btn btn-success " >
                <?php	}
else
{ ?>
                <input type="submit" name="addemail_temp" value="Save" class="btn btn-success"> 
                <?php }
?>
			  <input type="reset" value="Cancel" class="btn btn-danger" >
              </div>
              <input type="hidden" name="action" value="update">
              </form>
              </div>
          </div>
      </div>
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
<script src="plugins/jQuery/jQuery-2.1.3.min.js">
</script>
<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript">
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="../js/validetta.js" type="text/javascript">
</script>
<script type="text/javascript">
  $(function(){
    $('#add_emailtemp').validetta({
      errorClose : false,
      realTime : true
    }
                                 );
  }
   );
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
</script> 
<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>    
<!--jquery for left menu active class-->
<script type="text/javascript" src="dist/js/general.js">
</script>
<script type="text/javascript" src="dist/js/cookieapi.js">
</script>
<script type="text/javascript">
  setPageContext("email-temp","add-new-email");
</script>	
<!--jquery for left menu active class end-->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript">
</script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js" type="text/javascript">
</script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript">
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js" type="text/javascript">
</script>
</body>
</html>