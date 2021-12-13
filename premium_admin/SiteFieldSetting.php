<?php 
	include_once '../databaseConn.php';
  	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once '../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	if(isset($_POST['change'])){
		$sub_caste=$_POST['sub_caste'];
		$body_type=$_POST['body_type'];
		$will_to_marry=$_POST['will_to_marry'];
		$weight=$_POST['weight'];
		$additional_degree=$_POST['additional_degree'];
		$annual_income=$_POST['annual_income'];
		$diet=$_POST['diet'];
		$complexion=$_POST['complexion'];
		$smoke=$_POST['smoke'];
		$drink=$_POST['drink'];
		$dosh=$_POST['dosh'];
		$star=$_POST['star'];
		$rasi=$_POST['rasi'];
		$birthtime=$_POST['birthtime'];
		$birthplace=$_POST['birthplace'];
		$family_status=$_POST['family_status'];
		$family_type=$_POST['family_type'];
		$family_value=$_POST['family_value'];
		$father_occupation=$_POST['father_occupation'];
		$mother_occupation=$_POST['mother_occupation'];
		$no_of_brother=$_POST['no_of_brother'];
		$no_of_married_brother=$_POST['no_of_married_brother'];
		$no_of_sister=$_POST['no_of_sister'];
		$no_of_married_sister=$_POST['no_of_married_sister'];
		$profile_text=$_POST['profile_text'];
		$part_diet=$_POST['part_diet'];
		$part_drink=$_POST['part_drink'];
		$part_smoke=$_POST['part_smoke'];
		$part_dosh=$_POST['part_dosh'];
		$part_star=$_POST['part_star'];
		$part_state=$_POST['part_state'];
		$part_city=$_POST['part_city'];
		$part_rasi=$_POST['part_rasi'];
		$part_annual_income=$_POST['part_annual_income'];
		$part_expect=$_POST['part_expect'];
		
		mysqli_query($DatabaseCo->dbLink,"UPDATE field_settings SET sub_caste='$sub_caste',will_to_marry='$will_to_marry',weight='$weight',body_type='$body_type',complexion='$complexion',additional_degree='$additional_degree',annual_income='$annual_income',diet='$diet',smoke='$smoke',drink='$drink',dosh='$dosh',star='$star',rasi='$rasi',birthtime='$birthtime',birthplace='$birthplace',family_status='$family_status',family_type='$family_type',family_value='$family_value',father_occupation='$father_occupation',mother_occupation='$mother_occupation',no_of_brother='$no_of_brother',no_of_married_brother='$no_of_married_brother',no_of_sister='$no_of_sister',no_of_married_sister='$no_of_married_sister',profile_text='$profile_text',part_diet='$part_diet',part_drink='$part_drink',part_smoke='$part_smoke',part_dosh='$part_dosh',part_star='$part_star',part_state='$part_state',part_city='$part_city',part_rasi='$part_rasi',part_annual_income='$part_annual_income',part_expect='$part_expect' WHERE id='1' ");
		$msg="Record is updated successfully.";
	}
	$sql=mysqli_query($DatabaseCo->dbLink,"SELECT * FROM field_settings WHERE id='1'");
	$data=mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Manage | Enable / Disable Field</title>
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
    <link rel="stylesheet" href="../css/validate.css">
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
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1 class="lightGrey">Field Enable / Disable</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
				<li class="active"> Field Enable / Disable</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
		<!-- /.row -->
			<div class="row">
				<div class="box-body">
					<div class="box box-success">
						<div class="box-body gtSiteChangeId">
							<form method="post" name="changefield" id="changefield">
								<div class="row">
								<?php  if(isset($msg)){ ?>
								<div class="col-xs-12">
									<div id="success_msg" class="alert alert-success">
                    					<i class="fa fa-check-circle fa-fw fa-lg"></i>Record is updated successfully.
                                    </div>
                                </div>
								<?php } ?>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Sub Caste</label>
										<select class="form-control" name="sub_caste">
											<option value="Yes" <?php if($data['sub_caste'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['sub_caste'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Will to marry in other caste ?</label>
										<select class="form-control" name="will_to_marry">
											<option value="Yes" <?php if($data['will_to_marry'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['will_to_marry'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Weight</label>
										<select class="form-control" name="weight">
											<option value="Yes" <?php if($data['weight'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['weight'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Body Type </label>
										<select class="form-control" name="body_type">
											<option value="Yes" <?php if($data['body_type'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['body_type'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Complexion</label>
										<select class="form-control" name="complexion">
											<option value="Yes" <?php if($data['complexion'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['complexion'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Additional Degree</label>
										<select class="form-control" name="additional_degree">
											<option value="Yes" <?php if($data['additional_degree'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['additional_degree'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Annual Income</label>
										<select class="form-control" name="annual_income">
											<option value="Yes" <?php if($data['annual_income'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['annual_income'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Diet</label>
										<select class="form-control" name="diet">
											<option value="Yes" <?php if($data['diet'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['diet'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Smoke</label>
										<select class="form-control" name="smoke">
											<option value="Yes" <?php if($data['smoke'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['smoke'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Drink</label>
										<select class="form-control" name="drink">
											<option value="Yes" <?php if($data['drink'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['drink'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Dosh</label>
										<select class="form-control" name="dosh">
											<option value="Yes" <?php if($data['dosh'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['dosh'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Star</label>
										<select class="form-control" name="star">
											<option value="Yes" <?php if($data['star'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['star'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Rasi</label>
										<select class="form-control" name="rasi">
											<option value="Yes" <?php if($data['rasi'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['rasi'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Birth Time</label>
										<select class="form-control" name="birthtime">
											<option value="Yes" <?php if($data['birthtime'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['birthtime'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Birth Place</label>
										<select class="form-control" name="birthplace">
											<option value="Yes" <?php if($data['birthplace'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['birthplace'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Family Status</label>
										<select class="form-control" name="family_status">
											<option value="Yes" <?php if($data['family_status'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['family_status'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Family Type</label>
										<select class="form-control" name="family_type">
											<option value="Yes" <?php if($data['family_type'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['family_type'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Family Value</label>
										<select class="form-control" name="family_value">
											<option value="Yes" <?php if($data['family_value'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['family_value'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Father Occupation</label>
										<select class="form-control" name="father_occupation">
											<option value="Yes" <?php if($data['father_occupation'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['father_occupation'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Mother Occupation</label>
										<select class="form-control" name="mother_occupation">
											<option value="Yes" <?php if($data['mother_occupation'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['mother_occupation'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>No of brother</label>
										<select class="form-control" name="no_of_brother">
											<option value="Yes" <?php if($data['no_of_brother'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['no_of_brother'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>No of married brother</label>
										<select class="form-control" name="no_of_married_brother">
											<option value="Yes" <?php if($data['no_of_married_brother'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['no_of_married_brother'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>No of sister</label>
										<select class="form-control" name="no_of_sister">
											<option value="Yes" <?php if($data['no_of_sister'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['no_of_sister'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>No of married sister</label>
										<select class="form-control" name="no_of_married_sister">
											<option value="Yes" <?php if($data['no_of_married_sister'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['no_of_married_sister'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>About Us</label>
										<select class="form-control" name="profile_text">
											<option value="Yes" <?php if($data['profile_text'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['profile_text'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner Diet</label>
										<select class="form-control" name="part_diet">
											<option value="Yes" <?php if($data['part_diet'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_diet'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner Drink</label>
										<select class="form-control" name="part_drink">
											<option value="Yes" <?php if($data['part_drink'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_drink'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner Smoke</label>
										<select class="form-control" name="part_smoke">
											<option value="Yes" <?php if($data['part_smoke'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_smoke'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner Dosh</label>
										<select class="form-control" name="part_dosh">
											<option value="Yes" <?php if($data['part_dosh'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_dosh'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner Star</label>
										<select class="form-control" name="part_star">
											<option value="Yes" <?php if($data['part_star'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_star'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>part_state</label>
										<select class="form-control" name="part_state">
											<option value="Yes" <?php if($data['part_state'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_state'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner City</label>
										<select class="form-control" name="part_city">
											<option value="Yes" <?php if($data['part_city'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_city'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner Rasi</label>
										<select class="form-control" name="part_rasi">
											<option value="Yes" <?php if($data['part_rasi'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_rasi'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner Annual Income</label>
										<select class="form-control" name="part_annual_income">
											<option value="Yes" <?php if($data['part_annual_income'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_annual_income'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label>Partner Expectation</label>
										<select class="form-control" name="part_expect">
											<option value="Yes" <?php if($data['part_expect'] == 'Yes'){ echo 'selected'; }?>>Yes</option>
											<option value="No" <?php if($data['part_expect'] == 'No'){ echo 'selected'; }?>>No</option>
										</select>
									</div>
								</div>
								
								
								<div class="col-xs-12 text-center siteLogo">
									<div class="form-group">
										<input type="submit" class="btn btn-danger" value="Submit" name="change"/>
										<input type="reset" class="btn btn-danger" value="Cancel"/>
									</div>
 								</div>
								</div>
							</form> 
 						</div>
					</div>
				</div>
          </div><!-- /.row (main row) -->
	</section><!-- /.content -->
</div>
<?php include "page-part/footer.php"; ?>
</div><!-- ./wrapper -->
	<!-- jQuery 2.1.3 -->
	<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
	<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
    <!-- jQuery UI 1.11.2 -->
    <script src="../js/validetta.js" type="text/javascript"></script>
    <script type="text/javascript">
   	 	$(function(){
    		$('#changefield').validetta({
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
    			},4000);	
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
    	setPageContext("site-settings","sitefield");
    </script>	
    <!--jquery for left menu active class end-->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
</body>
</html>