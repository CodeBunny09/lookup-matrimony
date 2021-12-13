<?php
	include_once '../databaseConn.php';
	include_once '../class/Config.class.php';
	$configObj = new Config();
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once '../class/Config.class.php';
	$configObj = new Config();
	$mem_email = $_REQUEST['email'];
	$SQLSTATEMENT = $DatabaseCo->dbLink->query("select * from register_view where email='" . $mem_email . "'");
	$Row = mysqli_fetch_array($SQLSTATEMENT);
    $get_edu=explode(",",$Row['edu_detail']);
	$edu_detail=$Row['edu_detail'];

	/*-- Field Enable / Disable -- */
	$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT sub_caste,will_to_marry,weight,body_type,complexion,physical_status,additional_degree,annual_income,diet,smoke,drink,dosh,star,rasi,birthtime,birthplace,family_profile,family_status,family_type,family_value,father_occupation,mother_occupation,no_of_brother,no_of_married_brother,no_of_sister,no_of_married_sister,profile_text,part_physical_status,part_diet,part_drink,part_smoke,part_dosh,part_star,part_state,part_city,part_annual_income,part_rasi,part_expect FROM field_settings WHERE id='1'");
	$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>   
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Manage | View Profile</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <!-- GOOGLE FONTS END-->    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
	<!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
 	<script type="text/javascript" src="js/util/redirection.js"></script>
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
            Members Full Profile
            <small>Control panel</small>
         </h1>
         <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Members Full Profile</li>
         </ol>
      </section>
      <!-- Main content -->
      <section class="content">
         <!-- Small boxes (Stat box) -->
         <!-- /.row -->
         <!-- Main row -->
         <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
               <div class="box-top">
               	<div class="row">
                  <div class="col-lg-2 col-xs-12 col-sm-6">
                     <a href="print_profile?email=<?php echo $Row['email']; ?>" class="btn btn-green btn-lg col-xs-12">
                     <i class="fa fa-print"></i>Print This Profile
                     </a>
                  </div>
                 </div>
               </div>
               <?php
                  if (!empty($STATUS_MESSAGE)) {
                  	if ($statusObj->getActionSuccess()) {
                  		echo "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> " . $STATUS_MESSAGE . "</div>";
                      } else {
                  		echo "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>" . $STATUS_MESSAGE . "</li></ul></div>";
                      }
                  }
                  ?>     
            </div>
            <div class="col-lg-12 col-xs-12 mt-10 gtMemProfile">
               <div class="box box-solid">
                  <div class="box-header with-border">
                    <div class="col-xs-8">
                     <h4 class="gtProfileTitle">
                        <?php echo htmlspecialchars_decode($Row['username']); ?><small class="badge">Matri Id : <?php echo $Row['matri_id']; ?></small>
                     </h4>
                    </div>
                    
                    <div class="col-xs-4 text-right">
                    <?php if(isset($Row['franchies_id'] ) != "" ){?>
                    	<h4>
                    		Franchise id:<?php echo $Row['franchies_id']; ?>
                    	</h4>
                    <?php }else{?>
						<h4 ></h4>
                    <?php }?>
					</div>
                  </div>
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-3 col-xs-12 mt-10">
                           <?php
                              if ($Row['photo1'] != '' && file_exists("../my_photos/".$Row['photo1'])) {
                                  ?>
                           <img src="../my_photos/<?php echo $Row['photo1']; ?>" class="img-responsive img-thumbnail" >
                           <?php
                              } else if ($Row['photo1'] == '' && $Row['gender'] == 'Male') {
                                  ?>
                           <img src="../img/male.png" class="img-responsive img-thumbnail">
                           <?php
                              } else if ($Row['photo1'] == '' && $Row['gender'] == 'Female') {
                                  ?>
                           <img src="../img/female.png" class="img-responsive img-thumbnail">
                           <?php } ?>
                        </div>
                        <div class="col-md-9 col-xs-12">
                           <h4 class="gtMemProfileSecTitle">
                              Basic Details
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                              	<div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Username:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo ucfirst($Row['firstname']) ." ".ucfirst($Row['lastname']); ?></b>
                                       </div>
                                    </div>
                                 </div>
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Mobile No:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php if(isset($Row['mobile_code']) && $Row['mobile_code']!=''){echo $Row['mobile_code']."-";} ?><?php if(isset($Row['mobile']) && $Row['mobile']!=''){echo $Row['mobile'];} ?></b>
                                       </div>
                                    </div>
                                 </div>
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Date of Birth:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo date('jS F Y', strtotime($Row['birthdate'])); ?></b>
                                       </div>
                                    </div>
                                 </div>
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          No of Children:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo ($Row['tot_children'] != "") ? $Row['tot_children'] : "Not Married"; ?></b>
                                       </div>
                                    </div>
                                 </div>
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Mother Tongue:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $m_tongue = $Row['m_tongue'];
                                             
                                             if ($m_tongue != '') {
                                                 $SQL_STATEMENT_mtongue = $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE mtongue_id='$m_tongue'  ORDER BY mtongue_name ASC");
                                             
                                                 $DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_mtongue);
                                             
                                                 echo $DatabaseCo->Row->mtongue_name;
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?>               </b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-xs-12">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Email Id:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['email']; ?></b>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Gender:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['gender']; ?></b>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Marital Status:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['m_status']; ?></b>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Children Living Status:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo ($Row['status_children'] != "") ? $Row['status_children'] : "Not Married"; ?></b>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Profile Created By:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['profileby']; ?></b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
						   <?php if($row_field->profile_text == 'Yes'){ ?>
                           <h4 class="gtMemProfileSecTitle">
                              About Me
                           </h4>
                           <div class="row">
                              <div class="col-xs-12">
                                 <p class="word-wrap fw-500 line-height-25">
                                    <?php echo htmlspecialchars_decode($Row['profile_text']); ?>
                                 </p>
                              </div>
                           </div>
						   <?php } ?>
                           <h4 class="gtMemProfileSecTitle">
                              Religion Information
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Religion
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $religion = $Row['religion'];
                                             $SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT religion_name FROM religion WHERE religion_id='$religion'");
                                             $DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_religion);
                                             echo $DatabaseCo->Row->religion_name;
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
					  			 <?php if($row_field->will_to_marry == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-7 fw-500">
                                          Willing to Marry in other caste?
                                       </div>
                                       <div class="col-xs-5">
                                          <b><?php
                                             if ($Row['will_to_mary_caste'] == '1') {
                                                 echo "Yes";
                                             } else {
                                                 echo "No";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                              <div class="col-md-6 col-xs-12">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Caste
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $caste = $Row['caste'];
                                             $SQL_STATEMENT_caste = $DatabaseCo->dbLink->query("SELECT caste_name FROM caste WHERE caste_id='$caste'");
                                             $DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste);
                                             echo $DatabaseCo->Row->caste_name;
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php if($row_field->sub_caste == 'Yes'){ ?>	
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                         Sub Caste
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $subcaste = $Row['subcaste'];
                                             $SQL_STATEMENT_subcaste = $DatabaseCo->dbLink->query("SELECT sub_caste_name FROM sub_caste WHERE sub_caste_id='$subcaste'");
                                             $DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_subcaste);
                                             if(isset($DatabaseCo->Row->sub_caste_name) != ''){
												  echo $DatabaseCo->Row->sub_caste_name;
											  }else{
												 echo "Not Available";
											 }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                           </div>
                           <h4 class="gtMemProfileSecTitle">
                              Education & Occupation Details
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Highest Education
                                       </div>
                                       <div class="col-xs-7">
                                          <b>
										<?php
										if(isset($get_edu[0]) && $get_edu[0]!==''){
											
											$SQL_STATEMENT_education =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE edu_id='".$get_edu[0]."'  ");
		
											$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_education);							
		
											echo $DatabaseCo->Row->edu_name;
										}
										else
										{
											echo "N/A";	
										}
									   ?>    
                                     </b>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Employed in
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['emp_in']; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php if($row_field->annual_income == 'Yes'){ ?>	
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Annual Income
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['income']; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->additional_degree == 'Yes'){ ?>	
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Additional Degree
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
											
											if(isset($get_edu[1]) && $get_edu[1]!==''){
											$SQL_STATEMENT_education1 =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE edu_id='".$get_edu[1]."'  ");
		
											$DatabaseCo->Row1 = mysqli_fetch_object($SQL_STATEMENT_education1);							
		
											echo $DatabaseCo->Row1->edu_name;
											}else
											{
												echo "N/A";	
											}

									   ?>    </b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Occupation
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['ocp_name']; ?>
                                          </b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
						   <?php if($row_field->family_status == 'Yes' || $row_field->family_type == 'Yes' || $row_field->family_value == 'Yes' || $row_field->father_occupation == 'Yes' || $row_field->mother_occupation == 'Yes' || $row_field->no_of_brother == 'Yes' || $row_field->no_of_married_brother == 'Yes' || $row_field->no_of_sister == 'Yes' || $row_field->no_of_married_sister == 'Yes'){ ?>
                           <h4 class="gtMemProfileSecTitle">
                              Family Details
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->family_type == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Family Type:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['family_type'] != '') {
                                                 echo $Row['family_type'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->family_value == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Family Value:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['family_value'] != '') {
                                                 echo $Row['family_value'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->mother_occupation == 'Yes'){ ?>
                               	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Mothers Occupation:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['mother_occupation'] != '') {
                                                 echo $Row['mother_occupation'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->no_of_married_brother == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          No of Married Brothers:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['no_marri_brother'] != '') {
                                                 echo $Row['no_marri_brother'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->no_of_married_sister == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          No of Married Sisters
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['no_marri_sister'] != '') {
                                                 echo $Row['no_marri_sister'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->family_status == 'Yes'){ ?>
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Family Status:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['family_status'] != '') {
                                                 echo $Row['family_status'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->father_occupation == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Fathers Occupation:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['father_occupation'] != '') {
                                                 echo $Row['father_occupation'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->no_of_brother == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          No of Brothers:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['no_of_brothers'] != '') {
                                                 echo $Row['no_of_brothers'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->no_of_sister == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          No of Sisters:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['no_of_sisters'] != '') {
                                                 echo $Row['no_of_sisters'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                           </div>
						   <?php } ?>
                           <h4 class="gtMemProfileSecTitle">
                              Location Information
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                              	<div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Country Living In
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['country_name']; ?></b>
                                       </div>
                                    </div>
                                 </div>
                                <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          City Living In
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['city_name']; ?></b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          State Living In
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['state_name']; ?></b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <h4 class="gtMemProfileSecTitle">
                              Habits and Hobbies
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->diet == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                         Diet:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['diet']; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->smoke == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Smoking Habit:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['smoke']; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Language known:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $e1 = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS lang_name FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id,a.language_known) >0 WHERE a.email = '$mem_email'  GROUP BY a.language_known"));
                                             
                                             echo $e1['lang_name'];
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->drink == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Drinking Habit:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['drink']; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Hobbies:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['hobby'] != '') {
                                                 echo $Row['hobby'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                           <h4 class="gtMemProfileSecTitle">
                              Physical Attributes
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Height:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $ao = $Row['height'];
                                             $ft = (int) ($ao / 12);
                                             $inch = $ao % 12;
                                             echo $ft . "ft" . " " . $inch . "in";
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php if($row_field->body_type == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Body Type:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['bodytype']; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Physical Status:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['physicalStatus']; ?></b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->weight == 'Yes'){ ?>
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Weight:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['weight'] . " " . "Kg"; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->complexion == 'Yes'){ ?> 
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Complextion:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['complexion']; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                           </div>
						   <?php if($row_field->dosh == 'Yes' || $row_field->star == 'Yes' || $row_field->rasi == 'Yes' || $row_field->birthtime == 'Yes' || $row_field->birthplace == 'Yes'){ ?>
                           <h4 class="gtMemProfileSecTitle">
                              Horoscope detail
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->dosh == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Dosh
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo ($Row['dosh'] != "") ? $Row['dosh'] : "N/A"; ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
					  			 <?php if($row_field->star == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Star
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['star'] != '') {
                                                 echo $Row['star'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->birthplace == 'Yes'){ ?> 
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Birth Place:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['birthplace'] != '') {
                                                 echo $Row['birthplace'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->rasi == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Moonsign
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['moonsign'] != '') {
                                                 echo $Row['moonsign'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->birthtime == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Birthtime
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['birthtime'] != '') {
                                                 echo $Row['birthtime'];
                                             } else {
                                                 echo "N/A";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                           </div>
						   <?php } ?>
                           <h3 class="gtMemProfileMainTitle">
                              Partner Preference
                           </h3>
                           <h4 class="gtMemProfileSecTitle">
                              Basic Preference
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Marital Status
                                       </div>
                                       <div class="col-xs-7">
                                       	  <b><?php
                                             if ($Row['looking_for'] != '') {
                                                 echo $Row['looking_for'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                        
                                       </div>
                                    </div>
                                 </div> 
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Height
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $ao1 = $Row['part_height'];
                                             $ft1 = (int) ($ao1 / 12);
                                             $inch1 = $ao1 % 12;
                                             echo $ft1 . "ft" . " " . $inch1 . "in";
                                             ?> to 
                                          <?php
                                             $ao2 = $Row['part_height_to'];
                                             $ft2 = (int) ($ao2 / 12);
                                             $inch2 = $ao2 % 12;
                                             echo $ft2 . "ft" . " " . $inch2 . "in";
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php if($row_field->part_smoke == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Smoking Habit
                                       </div>
                                       <div class="col-xs-7">
                                       	   <b><?php
                                             if ($Row['part_smoke'] != '') {
                                                 echo $Row['part_smoke'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Physical Status
                                       </div>
                                       <div class="col-xs-7">
                                       	  <b><?php
                                             if ($Row['part_physical'] != '') {
                                                 echo $Row['part_physical'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-xs-12">
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Age
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['part_frm_age']; ?> to <?php echo $Row['part_to_age']; ?> Yrs</b>
                                       </div>
                                    </div>
                                 </div>
								 <?php if($row_field->part_diet == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                         Eating Habit
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['part_diet'] != '') {
                                                 echo $Row['part_diet'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
								 <?php if($row_field->part_drink == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Drinking Habit
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             if ($Row['part_drink'] != '') {
                                                 echo $Row['part_drink'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                           </div>
                           <h4 class="gtMemProfileSecTitle">
                              Education & Occupation Preference
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Education
                                       </div>
                                       <div class="col-xs-7">
                                       	  
                                          <b><?php
                                             $e = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.part_edu) >0 WHERE a.email = '$mem_email'  GROUP BY a.edu_detail"));
                                             
                                             
											  if ($e['edu_name'] != '') {
                                                 echo $e['edu_name'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?>
                                          </b>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                         Employed In
                                       </div>
                                       <div class="col-xs-7">
                                       	  <b><?php
                                             if ($Row['part_emp_in'] != '') {
                                                 echo $Row['part_emp_in'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->part_annual_income == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Annual Income
                                       </div>
                                       <div class="col-xs-7">
                                       	  <b><?php
                                             if ($Row['part_income'] != '') {
                                                 echo $Row['part_income'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Occupation
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $f = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', ocp_name, ''SEPARATOR ', ' ) AS part_occu  FROM   register a INNER JOIN occupation b ON FIND_IN_SET(b.ocp_id, a.part_occu) > 0 where a.email = '$mem_email'  GROUP BY a.part_occu"));
                                             
                                           
											  if ($f['part_occu'] != '') {
                                                 echo $f['part_occu'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?>
                                          </b>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <h4 class="gtMemProfileSecTitle">
                              Religion Preference
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Religion
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $f = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', religion_name, ''SEPARATOR ', ' ) AS part_religion  FROM   register a INNER JOIN religion b ON FIND_IN_SET(b.religion_id, a.part_religion) > 0 where a.email = '$mem_email'  GROUP BY a.part_religion"));
                                             if ($f['part_religion'] != '') {
                                                 echo $f['part_religion'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?>
                                            </b>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Mother Tongue
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $m = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT '', mtongue_name, ''SEPARATOR', ') AS part_mtongue FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id, a.part_mtongue) > 0 where  a.email ='$mem_email'  GROUP BY a.part_mtongue"));
                                             if ($m['part_mtongue'] != '') {
                                                 echo $m['part_mtongue'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php if($row_field->part_rasi == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Moonsign
                                       </div>
                                       <div class="col-xs-7">
                                       	  <b><?php
                                             if ($Row['part_rasi'] != '') {
                                                 echo $Row['part_rasi'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                              <div class="col-md-6 col-xs-12">
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Caste
                                       </div>
                                       <div class="col-xs-7">
                                          <b> <?php
                                             $c = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ',caste_name,''SEPARATOR', ') AS part_caste FROM register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste) > 0  where a.email = '$mem_email'  GROUP BY a.part_caste"));
                                             
                                             if ($c['part_caste'] != '') {
                                                 echo $c['part_caste'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php if($row_field->part_dosh == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Manglik
                                       </div>
                                       <div class="col-xs-7">
                                       	   <b><?php
                                             if ($Row['part_manglik'] != '') {
                                                 echo $Row['part_manglik'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								  <?php } ?>
								 <?php if($row_field->part_star == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Star
                                       </div>
                                       <div class="col-xs-7">
                                       	  <b><?php
                                             if ($Row['part_star'] != '') {
                                                 echo $Row['part_star'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								  <?php } ?>
                                 
                              </div>
                           </div>
                           <h4 class="gtMemProfileSecTitle">
                              Location Preference
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Country Living In
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $d = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', country_name, ''SEPARATOR ', ' ) AS part_country FROM register a INNER JOIN country b ON FIND_IN_SET(b.country_id, a.part_country_living) > 0 where a.email = '$mem_email'  GROUP BY a.part_country_living"));
                                             if ($d['part_country'] != '') {
                                                 echo $d['part_country'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php if($row_field->part_state == 'Yes'){ ?>
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          State Living In
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $d = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', state_name, ''SEPARATOR ', ' ) AS part_state FROM register a INNER JOIN state b ON FIND_IN_SET(b.state_id, a.part_state) > 0 where a.email = '$mem_email'  GROUP BY a.part_state"));
                                             
                                            if ($d['part_state'] != '') {
                                                 echo $d['part_state'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
								 <?php } ?>
                              </div>
                              <div class="col-md-6 col-xs-12">
								 <?php if($row_field->part_city == 'Yes'){ ?>
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          City Living In
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $d = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', city_name, ''SEPARATOR ', ' ) AS part_city FROM register a INNER JOIN city b ON FIND_IN_SET(b.city_id, a.part_city) > 0 where a.email = '$mem_email'  GROUP BY a.part_city"));
                                             
                                             if ($d['part_city'] != '') {
                                                 echo $d['part_city'];
                                             } else {
                                                 echo "Not Available";
                                             }
                                             ?></b>
                                       </div>
                                    </div>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
						   <?php if($row_field->part_expect == 'Yes'){ ?>
                           <h4 class="gtMemProfileSecTitle">
                              Partner Expectation
                           </h4>
                           <div class="row">
                              <div class="col-xs-12">
                                 <p class="word-wrap fw-500 line-height-25">
                                    <?php echo $Row['part_expect']; ?>
                                 </p>
                              </div>
							</div>
					        <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
               <section class="col-lg-7 col-xs-12 connectedSortable">
               </section>
               <!-- /.Left col -->
               <!-- right col (We are only adding the ID to make the widgets sortable)-->
               <section class="col-lg-5 col-xs-12 connectedSortable">
               </section>
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
   <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>    
   <script src="dist/js/app.min.js" type="text/javascript"></script>
   <!--jquery for left menu active class-->
   <script type="text/javascript" src="dist/js/general.js"></script>
   <script type="text/javascript" src="dist/js/cookieapi.js"></script>
   <script type="text/javascript">
      setPageContext("members", "all-members");      
   </script>	
</body>
</html>