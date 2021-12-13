<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
if(isset($_REQUEST['id']))
{
$plan_id=$_REQUEST['id'];	
$data=$DatabaseCo->dbLink->query("select * from membership_plan where  plan_id='$plan_id'");
$row=mysqli_fetch_array($data);
if(isset($_REQUEST['update_plan']))
{
$plan_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['id']);	
$plan_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_name']);
$plan_type = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_type']);
$plan_amount = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_amount']);
$Plan_currency_type = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['Plan_currency_type']);
$plan_duration = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_duration']);
$plan_contacts = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_contacts']);
$profile  =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['profile']);
$plan_msg = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_msg']);
$plan_sms = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_sms']);
$chat =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['chat']);

$plan_status =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_status']);
$DatabaseCo->dbLink->query("update membership_plan set plan_name='$plan_name',plan_type='$plan_type',plan_amount='$plan_amount',plan_amount_type='$Plan_currency_type',plan_duration='$plan_duration',plan_contacts='$plan_contacts',profile='$profile',plan_msg='$plan_msg',plan_sms='$plan_sms',chat='$chat',status='$plan_status' where plan_id='$plan_id'");
echo "<script>window.location='membership_plan?update_status=success';</script>";
}
else
{
$statusObj = new Status();
$statusObj->setActionSuccess(false);
$STATUS_MESSAGE = "Please select value to complete action.";	  
}
}
if(isset($_POST['add_plan']))
{
$plan_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_name']);
$plan_type = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_type']);
$plan_amount = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_amount']);
$Plan_currency_type = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['Plan_currency_type']);
$plan_duration = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_duration']);
$plan_contacts = mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_contacts']);
$profile  =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['profile']);
$plan_msg =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_msg']);
$plan_sms =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_sms']);
$chat =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['chat']);

$plan_status =mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['plan_status']);
$DatabaseCo->dbLink->query("insert into membership_plan (plan_name,plan_type,plan_amount,plan_amount_type,plan_duration,plan_contacts,profile,plan_msg,plan_sms,chat,status) values ('$plan_name','$plan_type','$plan_amount','$Plan_currency_type','$plan_duration','$plan_contacts','$profile','$plan_msg','$plan_sms','$chat','$plan_status')");
echo "<script>window.location='membership_plan?update_status=success';</script>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Manage Plan
    </title>
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
            Manage Plan
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active"> Manage Plan
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
                  <a href="membership_plan" class="btn btn-green btn-lg">
                    <i class="fa fa-list hidden-xs">
                    </i>All Membership Plan
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
                    </i> Manage Plan
                  </h4>
                </div>
                <div class="row">
                  <form name="manage_plan" id="manage_plan" method="post" class="gtNewMemPlan">
                    <div class="box-body">
                      <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                          <label>
                            Plan Name :
                          </label>
                          <input type="text" class="form-control" name="plan_name" data-validetta="required" value="<?php  if(isset($_REQUEST['id'])) { echo $row['plan_name']; } ?>">
                        </div>
                        <div class="form-group">
                          <label>
                            Plan Type :
                          </label>
                          <select class="form-control" name="plan_type" data-validetta="required">
                            <option value="">Select Plan Type
                            </option>
                            <option value="FREE" 
                                    <?php  if(isset($_REQUEST['id']) && $row['plan_type']=='FREE' ) { echo "selected"; } ?> >Free
                            </option>
                          <option value="PAID" 
                                  <?php  if(isset($_REQUEST['id']) && $row['plan_type']=='PAID' ) { echo "selected"; } ?> >Paid
                          </option>
                        </select>
                    </div>
                    </div>
                  <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                      <label>
                        Plan Currency Type :
                      </label>
                      <select class="form-control" name="Plan_currency_type" data-validetta="required">
                        <option value="">Select Currency Type
                        </option>
                        <option value="$" 
                                <?php  if(isset($_REQUEST['id']) && $row['plan_amount_type']=='$' ) { echo "selected"; } ?> >US-Dollar
                        </option>
                      <option value="Rs." 
                              <?php  if(isset($_REQUEST['id']) && $row['plan_amount_type']=='Rs.' ) { echo "selected"; } ?> >Indian-Rupee
                      </option>
                    </select>
                </div>	
               		<div class="form-group">
                  <label>
                    Plan Amount :
                  </label>
                  <input type="text" class="form-control" name="plan_amount" data-validetta="number" value="<?php  if(isset($_REQUEST['id'])) { echo $row['plan_amount']; } ?>" placeholder="Numeric Only">
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label>
                    Plan Duration :
                  </label>
                  <input type="text" class="form-control" name="plan_duration" data-validetta="number" value="<?php  if(isset($_REQUEST['id'])) { echo $row['plan_duration']; } ?>" placeholder="Numeric Only">
                </div>
                <div class="form-group">
                  <label>
                    Allow Contacts :
                  </label>
                  <input type="text" class="form-control" name="plan_contacts" data-validetta="number" value="<?php  if(isset($_REQUEST['id'])) { echo $row['plan_contacts']; } ?>" placeholder="Numeric Only">
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label>
                    Allow Profile :
                  </label>
                  <input type="text" class="form-control" name="profile" data-validetta="number" value="<?php  if(isset($_REQUEST['id'])) { echo $row['profile']; } ?>" placeholder="Numeric Only">
                </div>
                <div class="form-group">
                  <label>
                    Allow Messages :
                  </label>
                  <input type="text" class="form-control" name="plan_msg" data-validetta="number" value="<?php  if(isset($_REQUEST['id'])) { echo $row['plan_msg']; } ?>" placeholder="Numeric Only">
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label>
                    Allow SMS :
                  </label>
                  <input type="text" class="form-control" name="plan_sms" data-validetta="number" value="<?php  if(isset($_REQUEST['id'])) { echo $row['plan_sms']; } ?>" placeholder="Numeric Only">
                </div>
                <div class="form-group">
                    <label>
                      Chat :
                    </label>
                    <div class="radio">
                      <input id="optionsRadios1" class="rel_status" type="radio" name="chat" value="Yes" 
                             <?php  if(isset($_REQUEST['id']) && $row['chat']=='Yes' ) { echo "checked"; } ?> data-validetta="required,minSelected[1]">
                      <label for="optionsRadios1"> 
                        <b>Yes 
                        </b> &nbsp;&nbsp;
                        <input id="optionsRadios2" class="rel_status" type="radio" name="chat" value="No" 
                               <?php  if(isset($_REQUEST['id']) && $row['chat']=='No' ) { echo "checked"; } ?> data-validetta="required,minSelected[1]">
                        <label for="optionsRadios2">
                          <b>No 
                          </b>
                        </label>
                        </div>
                    </div>
                   
              </div>
              <div class="col-xs-12 col-lg-6">
              	<div class="form-group">
                      <label>
                        Status :
                      </label>
                      <select class="form-control" name="plan_status" data-validetta="required">
                        <option value="APPROVED" 
                                <?php if(isset($_REQUEST['id'])){ if($row['status']=='APPROVED') {echo "selected";} } ?>>
                        Active 
                        </option>
                      <option value="UNAPPROVED" 
                              <?php if(isset($_REQUEST['id'])) { if($row['status']=='UNAPPROVED') {echo "selected";} }?>>
                      Inactive
                      </option>
                    </select>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-2 col-md-offset-4 col-sm-4 col-xs-6 pull-left form-group mt-10">
                <?php
if(isset($_REQUEST['id']))
{?>
                <input type="submit" name="update_plan" value="Save" class="btn btn-green btn-block btn-lg" >
                <?php	}
else
{ ?>
                <input type="submit" name="add_plan" value="Save" class="btn btn-green btn-block btn-lg"> 
                <?php }
?>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 pull-left form-group mt-10">
                <input type="reset" value="Cancel" class="btn btn-danger btn-block btn-lg" >  
              </div>    
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
    $('#manage_plan').validetta({
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
  setPageContext("mem_ship","Addplan");
</script>	
<!--jquery for left menu active class end-->
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript">
</script>
</body>
</html>