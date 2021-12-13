<?php  
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$adv_id=isset($_GET['id']) ? $_GET['id'] :"" ;	
if($adv_id!=''){
	$result=$DatabaseCo->dbLink->query("select * from advertisement where adv_id='$adv_id'");
	$row=mysqli_fetch_array($result);
}
if(isset($_REQUEST['add_advertise'])){	
	$adv_name=$_POST['adv_name'];
	$adv_link=$_POST['adv_link'];
	$adv_level=$_POST['adv_level'];
	$contact_name=$_POST['contact_name'];
	$phone=$_POST['phone'];
	$datepicker=$_POST['datepicker'];
	$status=$_POST['status'];
	$image=$_FILES["adv_img"]["name"];   
	$target_dir = "../advertise/";
	$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
	$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$img_name; 
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='AddAdvertisement.php'</script>";
	}elseif($_FILES["adv_img"]["size"] > 5000000) {
		echo "<script>alert('your file size is more than 5MB.')</script>";
		echo "<script>window.location='AddAdvertisement.php'</script>";
	}else {
		move_uploaded_file($_FILES["adv_img"]["tmp_name"], $target_file);
		$DatabaseCo->dbLink->query("insert into advertisement(adv_date,adv_name,adv_link,adv_img,contact_name,phone,status,adv_level) values('$datepicker','".$adv_name."','$adv_link','$img_name','$contact_name','$phone','$status','$adv_level')");
		echo "<script>window.location='Advertise?success=Yes'</script>";
	}	
}
if(isset($_REQUEST['update_advertise'])){	
	$adv_id=$_GET['id'];
	$adv_name=$_POST['adv_name'];
	$adv_link=$_POST['adv_link'];
	$adv_level=$_POST['adv_level'];
	$contact_name=$_POST['contact_name'];
	$phone=$_POST['phone'];
	$datepicker=$_POST['datepicker'];
	$status=$_POST['status'];
	if(@is_uploaded_file($_FILES["adv_img"]["tmp_name"])){
		unlink("../advertise/".$_REQUEST['oldimg']);
	
		$image=$_FILES["adv_img"]["name"];   
		$target_dir = "../advertise/";
		$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
		$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
		$target_file = $target_dir.$img_name; 
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
			echo "<script>window.location='AddAdvertisement.php'</script>";
		}elseif($_FILES["adv_img"]["size"] > 5000000) {
			echo "<script>alert('your file size is more than 5MB.')</script>";
			echo "<script>window.location='AddAdvertisement.php'</script>";
		}else {
			move_uploaded_file($_FILES["adv_img"]["tmp_name"], $target_file);
			$DatabaseCo->dbLink->query("update advertisement set adv_name='$adv_name',adv_link='$adv_link',adv_img='".$img_name."',contact_name='$contact_name',phone='$phone',status='$status',adv_date='$datepicker',adv_level='$adv_level' where adv_id='$adv_id'");
			echo "<script>window.location='Advertise?success=Yes'</script>";
		}	
	}else{
		$img_name=$_POST['oldimg'];
		move_uploaded_file($_FILES["adv_img"]["tmp_name"], $target_file);
		$DatabaseCo->dbLink->query("update advertisement set adv_name='$adv_name',adv_link='$adv_link',adv_img='".$img_name."',contact_name='$contact_name',phone='$phone',status='$status',adv_date='$datepicker',adv_level='$adv_level' where adv_id='$adv_id'");
		echo "<script>window.location='Advertise?success=Yes'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Add Advertisement
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
	<!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
    <link rel="stylesheet" href="../css/validate.css">
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
            Manage Advertisement
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active"> Add New Advertisement
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
                  <a href="Advertise" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-list hidden-xs">
                    </i>All Advertisement
                  </a>
                </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xs-12 mt-10">
              <div class="box box-success">
                <div class="box-header with-border"><h4>ADD / UPDATE ADVERTISEMENT</h4></div>   
                <?php
					if(!empty($STATUS_MESSAGE))
					{	
					if($save)
					{
					echo  "<div class='success-msg cf' id='success_msg'><h4>".$STATUS_MESSAGE."</h4>    
					</div>";
					echo "<div class='error-msg' id='validationSummary'></div>";							
					}
					else
					{
					echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";	
					}
					}
					else
					{
					echo "<div class='error-msg' id='validationSummary'></div>";						
					}
					?>	
                <div class="row">
                  <div class="box-body gtNewMemPlan">
                    <form action="" enctype="multipart/form-data" method="post" class="form-data" id="add_form">
                      <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                          <label>
                            Advertisement  Name:
                          </label>
                          <input type="text" class="form-control" name="adv_name" value="<?php if($adv_id!=''){echo  $row['adv_name'];}?>" id="adv_name" title="name" data-validetta="required"/>
                        </div>
                        <div class="form-group">
                          <label>
                            Advertisement Level:
                          </label>
                          <select name="adv_level" id="adv_level" class="form-control" data-validetta="required">
                            <option value="level-1" 
                                    <?php if ($adv_id!='' && $row['adv_level']=='level-1'){ ?> selected="selected" 
                            <?php } ?>>Image size must be 160*600 for best result - Level 1 
                            </option>
                          <option value="level-2" 
                                  <?php if ($adv_id!='' && $row['adv_level']=='level-2'){ ?> selected="selected" 
                          <?php } ?>>Image size must be 250*600 for best result - Level 2 
                          </option>
                        <option value="level-3" 
                                <?php if ($adv_id!='' && $row['adv_level']=='level-3'){ ?> selected="selected" 
                        <?php } ?>>Image size must be 1170*80 for best result - Level 3 
                        </option>
                      </select>
                  </div>
                        <div class="form-group">
                        <label>
                          Select Advertisement Image:
                        </label>
                        <input type="file"  class="form-control" name="adv_img" id="adv_img" size="8" 
                               <?php if($adv_id==''){?>data-validetta="required"
                        <?php }?>/>
                        <input type="hidden" name="adv_img" id="adv_img" value="<?php if($adv_id!=''){echo $row['adv_img']; }?>" />
                        <?php if ($adv_id!='')
    {?>	
                        <img src="../advertise/<?php  if($adv_id!=''){echo $row['adv_img'];} ?>" style="margin-left:215px;" width="170px" height="160px" />
                        <?php }else{
    ?>
                        <?php }?>
                      </div>
                  		<div class="form-group">
                    <label>
                      Contact person:
                    </label>
                    <input type="text" class="form-control" name="contact_name" value="<?php if($adv_id!=''){echo  $row['contact_name'];}?>" id="contact_name"  data-validetta="required"/>
                  </div>
                	 </div>
               	 	 <div class="col-xs-12 col-md-6">
                  	   <div class="form-group">
                    <label>
                      Advertisement Date:
                    </label>
                    <input type="text" class="form-control"  name="datepicker" value="<?php if($adv_id!=''){echo  $row['adv_date'];}?>" id="datepicker" data-validetta="required"/>
                  </div> 
                  	   <div class="form-group">
                        <label>
                          Advertisement Link:
                        </label>
                        <input type="text" class="form-control" name="adv_link" value="<?php if($adv_id!=''){echo 
                                                                                       $row['adv_link'];}?>" id="adv_link" data-validetta="required"/>
                      </div>
                       <div class="form-group">
                        <label>
                          Contact Number:
                        </label>
                        <input type="text" class="form-control" name="phone" value="<?php if($adv_id!=''){echo  $row['phone'];}?>" id="phone"  data-validetta="required"/>
                      </div>
                       <div class="form-group">
                    <label>
                      Advertisement Status:
                    </label>
                    <input type="radio"  value="APPROVED" name="status" id="status" 
                           <?php if($adv_id!='' &&  $row['status']=="APPROVED") {?> checked="checked" 
                    <?php } ?>  data-validetta="required"/>
                    <span class="radio-btn-text">Active
                    </span>
                    <input type="radio"  value="UNAPPROVED" name="status" id="status" 
                           <?php if($adv_id!='' &&  $row['status']=="UNAPPROVED") {?> checked="checked" 
                    <?php } ?> data-validetta="required" />
                    <span class="radio-btn-text">Inactive
                    </span>
                  </div>
                     </div>
                	  <div class="col-xs-12">
                  <div class="col-md-3 col-md-offset-5 col-sm-5 col-sm-offset-3 col-xs-12 form-group">
                    <?php
if(!empty($adv_id)){
?>
                    <input type="submit"  class="btn btn-green btn-lg" value="Update" name="update_advertise" title="Update"/>
                    <input type="hidden" name="update_advertise" class="btn btn-green btn-lg" value="submit" />
                    <input type="hidden" name="oldimg" value="<?php echo $row['adv_img'];?>" />
                    <?php
} else{
?>
                    <input type="submit"  class="btn btn-green btn-lg" value="Add" name="add_advertise" title="Add"/>
                    <input type="hidden" name="add_advertise" value="submit" />
                    <?php } ?>
                  
                  <input type="reset" class="btn btn-danger btn-lg" value="Cancel" title="Cancel"/>
                  </div>
                </div>
                	</form>
            	  </div>
          		</div>
            </div>
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
<script src="plugins/jQuery/jQuery-2.1.3.min.js">
</script>
<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript">
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
<!-- Morris.js charts -->
<!--jquery for left menu active class-->
<script type="text/javascript" src="dist/js/general.js">
</script>
<script type="text/javascript" src="dist/js/cookieapi.js">
</script>
<script type="text/javascript">
  // setPageContext("site-settings","site");
</script>
<script type="text/javascript" src="js/util/redirection.js">
</script>
<!---------------Jquery Form validation------------------>
<script src="../js/validetta.js" type="text/javascript">
</script>
<script type="text/javascript">
  $(function(){
    $('#add_form').validetta({
      errorClose : false,
      custom : {
        regname : {
          pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
          errorMessage : 'Custom Reg Error Message !'
        }
        ,
        // you can add more
        example : {
          pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
          errorMessage : 'Lan mal !'
        }
      }
      ,
      realTime : true
    }
                            );
  }
   );
</script>
<!---------------Jquery Form validation End------------------>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js">
</script>
<script>
  $(function() {
    $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true
    }
                               );
  }
   );
</script> 
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- daterangepicker -->
<script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript">
</script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript">
</script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript">
</script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js" type="text/javascript">
</script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript">
</script>
<!-- FastClick -->
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript">
</script>
</body>
</html>