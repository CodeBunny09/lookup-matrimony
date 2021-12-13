<?php 

include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	
	include_once 'auth.php';
	$mid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';

if(isset($_POST['hsUpdate'])){
	$rasi1=implode(",",$_POST['rasi1']);
	$rasi2=implode(",",$_POST['rasi2']);
	$rasi3=implode(",",$_POST['rasi3']);
	$rasi4=implode(",",$_POST['rasi4']);
	$rasi5=implode(",",$_POST['rasi5']);
	$rasi6=implode(",",$_POST['rasi6']);
	$rasi7=implode(",",$_POST['rasi7']);
	$rasi8=implode(",",$_POST['rasi8']);
	$rasi9=implode(",",$_POST['rasi9']);
	$rasi10=implode(",",$_POST['rasi10']);
	$rasi11=implode(",",$_POST['rasi11']);
	$rasi12=implode(",",$_POST['rasi12']);
	
	$amsam1=implode(",",$_POST['amsam1']);
	$amsam2=implode(",",$_POST['amsam2']);
	$amsam3=implode(",",$_POST['amsam3']);
	$amsam4=implode(",",$_POST['amsam4']);
	$amsam5=implode(",",$_POST['amsam5']);
	$amsam6=implode(",",$_POST['amsam6']);
	$amsam7=implode(",",$_POST['amsam7']);
	$amsam8=implode(",",$_POST['amsam8']);
	$amsam9=implode(",",$_POST['amsam9']);
	$amsam10=implode(",",$_POST['amsam10']);
	$amsam11=implode(",",$_POST['amsam11']);
	$amsam12=implode(",",$_POST['amsam12']);
	
	$janana1=$_POST['janana1'];
	$janana2=$_POST['janana2'];
	$janana3=$_POST['janana3'];
	$janana4=$_POST['janana4'];
	
	
	
	$DatabaseCo->dbLink->query("update register set rasi1='".$rasi1."',rasi2='".$rasi2."',rasi3='".$rasi3."',rasi4='".$rasi4."',rasi5='".$rasi5."',rasi6='".$rasi6."',rasi7='".$rasi7."',rasi8='".$rasi8."',rasi9='".$rasi9."',rasi10='".$rasi10."',rasi11='".$rasi11."',rasi12='".$rasi12."',amsam1='".$amsam1."',amsam2='".$amsam2."',amsam3='".$amsam3."',amsam4='".$amsam4."',amsam5='".$amsam5."',amsam6='".$amsam6."',amsam7='".$amsam7."',amsam8='".$amsam8."',amsam9='".$amsam9."',amsam10='".$amsam10."',amsam11='".$amsam11."',amsam12='".$amsam12."',janana1='".$janana1."',janana2='".$janana2."',janana3='".$janana3."',janana4='".$janana4."' where matri_id='".$_SESSION['user_id'] ."'");
	//header('location:horoscope');
}

$getimg=mysqli_fetch_object($DatabaseCo->dbLink->query("select hor_photo,username,caste,birthdate,birthtime,birthplace,star,manglik,padham,moonsign,lagnam,dosh,janana1,janana2,janana3,janana4,rasi1,rasi2,rasi3,rasi4,rasi5,rasi6,rasi7,rasi8,rasi9,rasi10,rasi11,rasi12,amsam1,amsam2,amsam3,amsam4,amsam5,amsam6,amsam7,amsam8,amsam9,amsam10,amsam11,amsam12 from register where matri_id='".$_SESSION['user_id']."'"));

$rasi1_val=$getimg->rasi1; 
$rasi1=explode(",",$rasi1_val);
$rasi2_val=$getimg->rasi2; 
$rasi2=explode(",",$rasi2_val);
$rasi3_val=$getimg->rasi3; 
$rasi3=explode(",",$rasi3_val);
$rasi4_val=$getimg->rasi4; 
$rasi4=explode(",",$rasi4_val);
$rasi5_val=$getimg->rasi5; 
$rasi5=explode(",",$rasi5_val);
$rasi6_val=$getimg->rasi6; 
$rasi6=explode(",",$rasi6_val);
$rasi7_val=$getimg->rasi7; 
$rasi7=explode(",",$rasi7_val);
$rasi8_val=$getimg->rasi8; 
$rasi8=explode(",",$rasi8_val);
$rasi9_val=$getimg->rasi9; 
$rasi9=explode(",",$rasi9_val);
$rasi10_val=$getimg->rasi10; 
$rasi10=explode(",",$rasi10_val);
$rasi11_val=$getimg->rasi11; 
$rasi11=explode(",",$rasi11_val);
$rasi12_val=$getimg->rasi12; 
$rasi12=explode(",",$rasi12_val);

$amsam1_val=$getimg->amsam1; 
$amsam1=explode(",",$amsam1_val);
$amsam2_val=$getimg->amsam2; 
$amsam2=explode(",",$amsam2_val);
$amsam3_val=$getimg->amsam3; 
$amsam3=explode(",",$amsam3_val);
$amsam4_val=$getimg->amsam4; 
$amsam4=explode(",",$amsam4_val);
$amsam5_val=$getimg->amsam5; 
$amsam5=explode(",",$amsam5_val);
$amsam6_val=$getimg->amsam6; 
$amsam6=explode(",",$amsam6_val);
$amsam7_val=$getimg->amsam7; 
$amsam7=explode(",",$amsam7_val);
$amsam8_val=$getimg->amsam8; 
$amsam8=explode(",",$amsam8_val);
$amsam9_val=$getimg->amsam9; 
$amsam9=explode(",",$amsam9_val);
$amsam10_val=$getimg->amsam10; 
$amsam10=explode(",",$amsam10_val);
$amsam11_val=$getimg->amsam11; 
$amsam11=explode(",",$amsam11_val);
$amsam12_val=$getimg->amsam12; 
$amsam12=explode(",",$amsam12_val);
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="#549a11">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#549a11">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
        <!-- WEB SITE TITLE DESCRIPTION-->
        <title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
        <!-- WEB SITE TITLE DESCRIPTION END--> 

        <!-- WEB SITE FAVICON--> 
        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE FAVICON END--> 

		<!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/developer.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->


        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->

        <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->

        <!---- CHOSEN CSS----->
		<link rel="stylesheet" href="css/prism.css">
        <link rel="stylesheet" href="css/chosen.css">
        <!---- CHOSEN CSS END----->

        <!--OWL CAROUSEL CSS-->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
        <!--OWL CAROUSEL CSS END-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
  </head>

<body>
		<!-- ICON LOADER-->
		<div class="preloader-wrapper text-center">
			<div class="loader"></div>
			<h5>Loading...</h5>
		</div>
		<!-- ICON LOADER END-->
        <div id="body" style="display:none">
 			<?php include "parts/header.php"; ?>
    		<?php include "parts/menu-aft-login.php"; ?>
	<div class="container gt-margin-top-20">
    	<div class="row">
        	<div class="col-xxl-12 col-xxl-offset-2 col-xl-12 col-xl-offset-2 text-center gt-margin-bottom-20">
            	<h3 class="gt-margin-top-0 gt-text-orange">
                      Edit / Add Horoscope
                </h3>
                <article>
                	<p>
                    	Here is your option to set your Horoscope.Upload your horoscope image(kundli) may be you not believe but other user does.
                    </p>
                </article>
            </div>
        	
            <div class="col-xxl-12 col-xl-12 col-xl-offset-2 col-xxl-offset-2 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
               <div class="gt-profile-pic-title">
               		<div class="col-xxl-10 col-xl-10 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
                		<h4>
                			Edit / Add Horoscope
                		</h4>
                	</div>
               </div>
               <div class="gt-profile-pic-panel">
              		
               		<div class="col-xs-16">
               	       	<div class="row">
               			<div class="col-md-8 gt-margin-bottom-15">
               				<div class="row gt-margin-bottom-15">
               					<div class="col-xs-6">
               						Name
								</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->username ; ?></b>
								</div>
               				</div>
               				<div class="row gt-margin-bottom-15">
               					<div class="col-xs-6">
               						Date of Birth
               					</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->birthdate; ?></b>
								</div>
               				</div>
               				<div class="row gt-margin-bottom-15">
								<div class="col-xs-6">
									Birth Place
								</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->birthplace; ?></b>
								</div>
               				</div>
               				<div class="row gt-margin-bottom-15">
								<div class="col-xs-6">
									Time of Birth
								</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->birthtime; ?></b>
								</div>
               				</div>
               				<div class="row gt-margin-bottom-15">
								<div class="col-xs-6">
									Dosh
								</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->manglik; ?></b>
								</div>
							</div>
						</div>
               			<div class="col-md-8 gt-margin-bottom-15">
               				<div class="row gt-margin-bottom-15" >
               					<div class="col-xs-6">
               						Star
								</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->star; ?></b>
								</div>
               				</div>
               				<div class="row gt-margin-bottom-15">
               					<div class="col-xs-6">
               						Dasa type
               					</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->janana1 ?></b>
								</div>
               				</div>
               				<div class="row gt-margin-bottom-15">
								<div class="col-xs-6">
									Birth Balance Dasa
								</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->janana2 ." Years ".$getimg->janana3 ." Month ".$getimg->janana4 ." Days" ; ?></b>
								</div>
               				</div>
               				<div class="row gt-margin-bottom-15">
								<div class="col-xs-6">
									Raasi
								</div>
								<div class="col-xs-10">
									<b><?php echo $getimg->moonsign; ?></b>
								</div>
               				</div>
               				<div class="row gt-margin-bottom-15">
								<div class="col-xs-6">
									Caste
								</div>
								<div class="col-xs-10">
									<b> <?php
										$caste= $getimg->caste;
									   $SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT caste_name FROM caste WHERE caste_id='$caste'");
		                            $DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste);			
									    echo $DatabaseCo->Row->caste_name; ?>  </b>
								</div>
							</div>
						</div>
              		    </div>
              		  	
               			<div class="row">
                		<form action="" method="post">
                		<div class="col-xl-16">
                			<div class="row">
								<div class="col-xl-8">
									<div class="form-group">
										<label>
											Dasa Type
										</label>
										<select name="janana1" id="" class="gt-form-control">
											<option>-Select-</option>
											<option value="Sun" <?php if($getimg->janana1 == 'Sun'){echo "selected"; } ?>>Sun</option>
											<option value="Moon" <?php if($getimg->janana1 == 'Moon'){echo "selected"; } ?>>Moon</option>
											<option value="Mars" <?php if($getimg->janana1 == 'Mars'){echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if($getimg->janana1 == 'Mercury'){echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if($getimg->janana1 == 'Jupiter'){echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if($getimg->janana1 == 'Venus'){echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if($getimg->janana1 == 'Saturn'){echo "selected"; } ?>>Saturn</option>
											<option value="Rahu" <?php if($getimg->janana1 == 'Rahu'){echo "selected"; } ?>>Rahu</option>
											<option value="Kethu" <?php if($getimg->janana1 == 'Kethu'){echo "selected"; } ?>>Kethu</option>
										</select>
									</div>
									
								</div>
             		    		<div class="col-xl-8">
									<div class="form-group">
										<label>
											Birth Balance Dasa
										</label>
										<div class="row">
                       		
                       		<div class="col-xxl-5 col-xs-16 col-lg-6 col-xl-4 col-md-12">
                       			<select name="janana2" id="" class="gt-form-control">
								<option value="">-YY-</option>
								<option value="0" <?php if($getimg->janana2 == '0'){echo "selected"; } ?>>0</option>
								<option value="1" <?php if($getimg->janana2 == '1'){echo "selected"; } ?>>1</option>
								<option value="2" <?php if($getimg->janana2 == '2'){echo "selected"; } ?>>2</option>
								<option value="3" <?php if($getimg->janana2 == '3'){echo "selected"; } ?>>3</option>
								<option value="4" <?php if($getimg->janana2 == '4'){echo "selected"; } ?>>4</option>
								<option value="5" <?php if($getimg->janana2 == '5'){echo "selected"; } ?>>5</option>
								<option value="6" <?php if($getimg->janana2 == '6'){echo "selected"; } ?>>6</option>
								<option value="7" <?php if($getimg->janana2 == '7'){echo "selected"; } ?>>7</option>
								<option value="8" <?php if($getimg->janana2 == '8'){echo "selected"; } ?>>8</option>
								<option value="9" <?php if($getimg->janana2 == '9'){echo "selected"; } ?>>9</option>
								<option value="10" <?php if($getimg->janana2 == '10'){echo "selected"; } ?>>10</option>
								<option value="11" <?php if($getimg->janana2 == '11'){echo "selected"; } ?>>11</option>
								<option value="12" <?php if($getimg->janana2 == '12'){echo "selected"; } ?>>12</option>
								<option value="13" <?php if($getimg->janana2 == '13'){echo "selected"; } ?>>13</option>
								<option value="14" <?php if($getimg->janana2 == '14'){echo "selected"; } ?>>14</option>
								<option value="15" <?php if($getimg->janana2 == '15'){echo "selected"; } ?>>15</option>
								<option value="16" <?php if($getimg->janana2 == '16'){echo "selected"; } ?>>16</option>
								<option value="17" <?php if($getimg->janana2 == '17'){echo "selected"; } ?>>17</option>
								<option value="18" <?php if($getimg->janana2 == '18'){echo "selected"; } ?>>18</option>
								<option value="19" <?php if($getimg->janana2 == '19'){echo "selected"; } ?>>19</option>
								<option value="20" <?php if($getimg->janana2 == '20'){echo "selected"; } ?>>20</option>
								</select>
                       		</div>
                       		<div class="col-xxl-5 col-xs-16 col-lg-6 col-xl-4 col-md-12">
                       			<select name="janana3" id="" class="gt-form-control">
								<option value="">-MM-</option>
								<option value="0" <?php if($getimg->janana3 == '0'){echo "selected"; } ?>>0</option>
								<option value="1" <?php if($getimg->janana3 == '1'){echo "selected"; } ?>>1</option>
								<option value="2" <?php if($getimg->janana3 == '2'){echo "selected"; } ?>>2</option>
								<option value="3" <?php if($getimg->janana3 == '3'){echo "selected"; } ?>>3</option>
								<option value="4" <?php if($getimg->janana3 == '4'){echo "selected"; } ?>>4</option>
								<option value="5" <?php if($getimg->janana3 == '5'){echo "selected"; } ?>>5</option>
								<option value="6" <?php if($getimg->janana3 == '6'){echo "selected"; } ?>>6</option>
								<option value="7" <?php if($getimg->janana3 == '7'){echo "selected"; } ?>>7</option>
								<option value="8" <?php if($getimg->janana3 == '8'){echo "selected"; } ?>>8</option>
								<option value="9" <?php if($getimg->janana3 == '9'){echo "selected"; } ?>>9</option>
								<option value="10" <?php if($getimg->janana3 == '10'){echo "selected"; } ?>>10</option>
								<option value="11" <?php if($getimg->janana3 == '11'){echo "selected"; } ?>>11</option>
								<option value="12" <?php if($getimg->janana3 == '12'){echo "selected"; } ?>>12</option>
								
								</select>
                       		</div>
                       		<div class="col-xxl-6 col-xs-16 col-lg-6 col-xl-4 col-md-12">
                       			<select name="janana4" id="" class="gt-form-control">
								<option value="">-DD-</option>
								<option value="0" <?php if($getimg->janana4 == '0'){echo "selected"; } ?>>0</option>
								<option value="1" <?php if($getimg->janana4 == '1'){echo "selected"; } ?>>1</option>
								<option value="2" <?php if($getimg->janana4 == '2'){echo "selected"; } ?>>2</option>
								<option value="3" <?php if($getimg->janana4 == '3'){echo "selected"; } ?>>3</option>
								<option value="4" <?php if($getimg->janana4 == '4'){echo "selected"; } ?>>4</option>
								<option value="5" <?php if($getimg->janana4 == '5'){echo "selected"; } ?>>5</option>
								<option value="6" <?php if($getimg->janana4 == '6'){echo "selected"; } ?>>6</option>
								<option value="7" <?php if($getimg->janana4 == '7'){echo "selected"; } ?>>7</option>
								<option value="8" <?php if($getimg->janana4 == '8'){echo "selected"; } ?>>8</option>
								<option value="9" <?php if($getimg->janana4 == '9'){echo "selected"; } ?>>9</option>
								<option value="10" <?php if($getimg->janana4 == '10'){echo "selected"; } ?>>10</option>
								<option value="11" <?php if($getimg->janana4 == '11'){echo "selected"; } ?>>11</option>
								<option value="12" <?php if($getimg->janana4 == '12'){echo "selected"; } ?>>12</option>
								<option value="13" <?php if($getimg->janana4 == '13'){echo "selected"; } ?>>13</option>
								<option value="14" <?php if($getimg->janana4 == '14'){echo "selected"; } ?>>14</option>
								<option value="15" <?php if($getimg->janana4 == '15'){echo "selected"; } ?>>15</option>
								<option value="16" <?php if($getimg->janana4 == '16'){echo "selected"; } ?>>16</option>
								<option value="17" <?php if($getimg->janana4 == '17'){echo "selected"; } ?>>17</option>
								<option value="18" <?php if($getimg->janana4 == '18'){echo "selected"; } ?>>18</option>
								<option value="19" <?php if($getimg->janana4 == '19'){echo "selected"; } ?>>19</option>
								<option value="20" <?php if($getimg->janana4 == '20'){echo "selected"; } ?>>20</option>
								<option value="21" <?php if($getimg->janana4 == '21'){echo "selected"; } ?>>21</option>
								<option value="22" <?php if($getimg->janana4 == '22'){echo "selected"; } ?>>22</option>
								<option value="23" <?php if($getimg->janana4 == '23'){echo "selected"; } ?>>23</option>
								<option value="24" <?php if($getimg->janana4 == '24'){echo "selected"; } ?>>24</option>
								<option value="25" <?php if($getimg->janana4 == '25'){echo "selected"; } ?>>25</option>
								<option value="26" <?php if($getimg->janana4 == '26'){echo "selected"; } ?>>26</option>
								<option value="27" <?php if($getimg->janana4 == '27'){echo "selected"; } ?>>27</option>
								<option value="28" <?php if($getimg->janana4 == '28'){echo "selected"; } ?>>28</option>
								<option value="29" <?php if($getimg->janana4 == '29'){echo "selected"; } ?>>29</option>
								<option value="30" <?php if($getimg->janana4 == '30'){echo "selected"; } ?>>30</option>
								<option value="31" <?php if($getimg->janana4 == '31'){echo "selected"; } ?>>31</option>
								</select>
                       		</div>

                       </div>
										
									</div>
								</div>
              		    	</div>
                		</div>
                		<div class="col-xs-16 text-center gt-margin-top-20 gt-margin-bottom-30">
                				<div class="row">
                				
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="rasi1[]" multiple>
                							
											<option value="Sun" <?php if(in_array("Sun", $rasi1)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi1)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi1)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi1)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi1)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi1)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi1)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi1)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi1)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan", $rasi1)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi1)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="rasi2[]" multiple>
                							
											<option value="Sun" <?php if(in_array("Sun", $rasi2)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi2)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi2)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi2)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi2)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi2)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi2)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi2)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi2)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan", $rasi2)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi2)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="rasi3[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi3)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi3)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi3)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi3)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi3)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi3)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi3)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi3)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi3)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan", $rasi3)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi3)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="rasi4[]" multiple>
                							
											<option value="Sun" <?php if(in_array("Sun", $rasi4)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi4)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi4)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi4)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi4)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi4)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi4)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi4)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi4)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan", $rasi4)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi4)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-xs-4">
                						<div class="form-group">
                							<select class="gt-form-control chosen-select" name="rasi5[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi5)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi5)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi5)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi5)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi5)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi5)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi5)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi5)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi5)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan", $rasi5)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi5)){ echo "selected"; } ?>>Lagna</option>
										</select>
                						</div>
                						<div class="form-group">
                							<select class="gt-form-control chosen-select" name="rasi6[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi6)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi6)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi6)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi6)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi6)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi6)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi6)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi6)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi6)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan", $rasi6)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi6)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					    </div>
                					</div>
                					<div class="col-xs-8">
                						<div class="box">
                							<h4>Raasi</h4>
                						</div>
                					</div>
                					<div class="col-xxl-4">
                						<div class="form-group">
                							<select class="gt-form-control chosen-select" name="rasi7[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi7)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi7)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi7)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi7)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi7)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi7)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi7)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi7)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi7)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$rasi7)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi7)){ echo "selected"; } ?>>Lagna</option>
										</select>
                						</div>
                						<div class="form-group">
                							<select class="gt-form-control chosen-select" name="rasi8[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi8)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi8)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi8)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi8)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi8)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi8)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi8)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi8)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi8)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$rasi8)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi8)){ echo "selected"; } ?>>Lagna</option>
										</select>
                						</div>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="rasi9[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi9)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi9)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi9)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi9)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi9)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi9)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi9)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi9)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi9)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$rasi9)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi9)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="rasi10[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi10)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi10)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi10)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi10)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi10)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi10)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi10)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi10)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi10)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$rasi10)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi10)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="rasi11[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi11)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi11)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi11)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi11)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi11)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi11)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi11)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi11)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi11)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$rasi11)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi11)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="rasi12[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun", $rasi12)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $rasi12)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $rasi12)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $rasi12)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $rasi12)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $rasi12)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $rasi12)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $rasi12)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $rasi12)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$rasi12)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $rasi12)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                				</div>
                		</div>
               			<div class="col-xs-16 text-center gt-margin-top-25">
               				    <div class="row">
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="amsam1[]" multiple>
                							
											<option value="Sun" <?php if(in_array("Sun", $amsam1)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon", $amsam1)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars", $amsam1)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury", $amsam1)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter", $amsam1)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus", $amsam1)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn", $amsam1)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu", $amsam1)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu", $amsam1)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam1)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna", $amsam1)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="amsam2[]" multiple>
                							
											<option value="Sun" <?php if(in_array("Sun",$amsam2)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam2)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam2)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam2)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam2)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam2)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam2)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam2)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam2)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam2)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam2)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="amsam3[]" multiple>
                							
											<option value="Sun" <?php if(in_array("Sun",$amsam3)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam3)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam3)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam3)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam3)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam3)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam3)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam3)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam3)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam3)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam3)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="amsam4[]" multiple>
                							
											<option value="Sun" <?php if(in_array("Sun",$amsam4)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam4)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam4)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam4)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam4)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam4)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam4)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam4)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam4)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam4)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam4)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-xs-4">
                						<div class="form-group">
                							<select class="gt-form-control chosen-select" name="amsam5[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun",$amsam5)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam5)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam5)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam5)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam5)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam5)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam5)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam5)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam5)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam5)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam5)){ echo "selected"; } ?>>Lagna</option>
										</select>
                						</div>
                						<div class="form-group">
                							<select class="gt-form-control chosen-select" name="amsam6[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun",$amsam6)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam6)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam6)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam6)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam6)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam6)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam6)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam6)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam6)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam6)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam6)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					    </div>
                					</div>
                					<div class="col-xs-8">
                						<div class="box">
                							<h4>Amsam</h4>
                						</div>
                					</div>
                					<div class="col-xxl-4">
                						<div class="form-group">
                							<select class="gt-form-control chosen-select" name="amsam7[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun",$amsam7)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam7)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam7)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam7)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam7)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam7)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam7)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam7)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam7)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam7)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam7)){ echo "selected"; } ?>>Lagna</option>
										</select>
                						</div>
                						<div class="form-group">
                							<select class="gt-form-control chosen-select" name="amsam8[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun",$amsam8)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam8)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam8)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam8)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam8)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam8)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam8)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam8)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam8)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam8)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam8)){ echo "selected"; } ?>>Lagna</option>
										</select>
                						</div>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="amsam9[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun",$amsam9)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam9)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam9)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam9)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam9)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam9)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam9)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam9)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam9)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam9)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam9)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="amsam10[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun",$amsam10)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam10)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam10)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam10)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam10)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam10)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam10)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam10)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam10)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam10)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam10)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="amsam11[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun",$amsam11)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam11)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam11)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam11)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam11)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam11)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam11)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam11)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam11)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam11)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam11)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<select class="gt-form-control chosen-select" name="amsam12[]" multiple>
                							<option value="Sun" <?php if(in_array("Sun",$amsam12)){ echo "selected" ;} ?> >Sun</option>
											<option value="Moon" <?php if(in_array("Moon",$amsam12)){ echo "selected" ;} ?>>Moon</option>
											<option value="Mars" <?php if(in_array("Mars",$amsam12)){ echo "selected"; } ?>>Mars</option>
											<option value="Mercury" <?php if(in_array("Mercury",$amsam12)){ echo "selected"; } ?>>Mercury</option>
											<option value="Jupiter" <?php if(in_array("Jupiter",$amsam12)){ echo "selected"; } ?>>Jupiter</option>
											<option value="Venus" <?php if(in_array("Venus",$amsam12)){ echo "selected"; } ?>>Venus</option>
											<option value="Saturn" <?php if(in_array("Saturn",$amsam12)){ echo "selected"; } ?>>Saturn</option>
											<option value="Raagu" <?php if(in_array("Raagu",$amsam12)){ echo "selected"; } ?>>Raagu</option>
											<option value="Kethu" <?php if(in_array("Kethu",$amsam12)){ echo "selected"; } ?>>Kethu</option>
											<option value="Gulikan" <?php if(in_array("Gulikan",$amsam12)){ echo "selected"; } ?>>Gulikan</option>
											<option value="Lagna" <?php if(in_array("Lagna",$amsam12)){ echo "selected"; } ?>>Lagna</option>
										</select>
                					</div>
                				</div>
                				
                		</div>
                		<div class="col-xs-16 gt-margin-top-15 text-center">
                			<input type="submit" class="btn gt-btn-orange btn-lg" value="Update" name="hsUpdate">
                		</div>
						</form>
                	</div>
                	</div>
               </div>  
          </div>
    </div>
    <?php include "parts/footer-before-login.php"; ?>
    </div>
</body>
<!------------------------------------------jQuery------------------------------------------------->
    <script src="js/jquery.min.js"></script>
    <!------------------------------------------jQuery End--------------------------------------------->
    <!------------------------------------------bootstrap and green js--------------------------------->
    <script src="js/bootstrap.js"></script>
    <script src="js/green.js"></script>
    <!-------------------------------------bootstrap and green js End--------------------------------->
<!--------------------------------------Owl Crousel------------------------------------>
   <script src="js/owl.carousel.min.js"></script>
<!--------------------------------------Owl Crousel End ------------------------------->
 <!--- CHOSEN JS --->
        <script src="js/chosen.jquery.js" type="text/javascript"></script>
        <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {allow_single_deselect: true},
                '.chosen-select-no-single': {disable_search_threshold: 10},
                '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                '.chosen-select-width': {width: "100%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        </script>
        <!--- CHOSEN JS END--->
<script>
    $(document).ready(function() {
    $('#body').show();
    $('.preloader-wrapper').hide();
     });
</script>


<script>
	$(document).ready(function(e) {
        $('#horoscope').on('change',function(){
			$('#horoscopeform').submit();
		});
    });
</script>	
<script>
   	$('[data-toggle="popover"]').popover({
   	trigger: 'click',
    'placement': 'top'
     });
</script>
<script>
            (function($) {
                var $window = $(window),
                        $html = $('.mobile-collapse');
                $window.width(function width() {
                    if ($window.width() > 991) {
                        return $html.addClass('in');
                    }
                    $html.removeClass('in');
                });
            })(jQuery);
        </script>



</html>
<?php include'thumbnailjs.php' ; ?> 