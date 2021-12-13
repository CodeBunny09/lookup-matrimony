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
    if(!isset($_SESSION['admin_user_name'])){
            header("location: index.php");
			echo "<script>window.location='index'</script>";
    }
	$loggedn_user = isset($_SESSION['admin_user_name'])?$_SESSION['admin_user_name']:"Admin";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Print Profile</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->
    <!-- GOOGLE FONTS -->
<!--    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">-->
    <!-- GOOGLE FONTS END-->    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
	<!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
 	<script type="text/javascript" src="js/util/redirection.js"></script>
    <link rel="stylesheet" href="css/all_check.css"/> 
    </script>
  </head>
  <body>
    <div class="container">
    	<div class="col-md-10 col-md-offset-1">
      <section class="content-header" style="text-align:center">
        <h1>
          <?php echo $Row['username'];?>
        </h1>
      </section>
      <div class="col-lg-12 col-xs-12 mt-10 gtMemProfile">
               <div class="box box-solid">
                  <div class="box-header with-border">
                     <h4 class="gtProfileTitle">
                        <?php echo htmlspecialchars_decode($Row['username']); ?><small class="badge">Matri Id : <?php echo $Row['matri_id']; ?></small>
                     </h4>
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
                                          Heighest Education
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
                                             $e = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.part_edu) >0 WHERE a.email = '$mem_email'  GROUP BY a.edu_detail"));
                                             
                                             $edu_data = explode(",", $e['edu_name']);
                                             
                                             echo $edu_data[0];
                                             ?></b>
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
                              </div>
                              <div class="col-md-6 col-xs-12">
                              	 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Additional Degree
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php if(isset($edu_data[1]) && $edu_data[1]!=''){ echo $edu_data[1]; }?></b>
                                       </div>
                                    </div>
                                 </div>
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
                           <h4 class="gtMemProfileSecTitle">
                              Family Details
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
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
                              </div>
                              <div class="col-md-6 col-xs-12">
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
                              </div>
                           </div>
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
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Language known:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php
											 if($Row['language_known'] != ''){
                                            	 $e1 = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS lang_name FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id,a.language_known) >0 WHERE a.email = '$mem_email'  GROUP BY a.language_known"));
                                             	 echo $e1['lang_name'];
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
                                          Drinking Habit:
                                       </div>
                                       <div class="col-xs-7">
                                          <b><?php echo $Row['drink']; ?></b>
                                       </div>
                                    </div>
                                 </div>
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
                              </div>
                           </div>
                           <h4 class="gtMemProfileSecTitle">
                              Horoscope detail
                           </h4>
                           <div class="row">
                              <div class="col-md-6 col-xs-12">
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
                                 <div class="form-group">
                                    <div class="row">
                                       <div class="col-xs-5 fw-500">
                                          Birth Place:
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
                              </div>
                              <div class="col-md-6 col-xs-12">
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
                              </div>
                           </div>
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
                              </div>
                              <div class="col-md-6 col-xs-12">
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
                                 
                              </div>
                           </div>
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
                        </div>
                     </div>
                  </div>
               </div>
               <!-- right col -->
            </div>
        <!-- /.content -->
        </div>
        </div>
      <!-- /.content-wrapper -->
    <!-- ./wrapper -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>    
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
  </body>
</html>