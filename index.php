<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

include_once './class/Config.class.php';
$configObj = new Config();

$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
$SQL_STATEMENT_country = $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");

$SQL_SITE_SETTING = $DatabaseCo->dbLink->query("SELECT profile_verification FROM site_config WHERE id='1' ");
$profile_method = mysqli_fetch_object($SQL_SITE_SETTING);
	
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
        <link href="css/bootstrap.css?version=1" rel="stylesheet">
        <link href="css/custom-responsive.css?version=1" rel="stylesheet">
        <link href="css/custom.css?version=1" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->

        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->

        <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->

        <!--OWL CAROUSEL CSS-->
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="css/owl.theme.css" rel="stylesheet">
        <!--OWL CAROUSEL CSS END-->

        <!-- CHOSEN CSS -->
    	<link rel="stylesheet" href="css/prism.css">
    	<link rel="stylesheet" href="css/chosen.css">
     	<!-- CHOSEN CSS END -->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
        <!-- ANGULAR JS-->
        <script src="js/angular.min.js"></script>
        <!-- ANGULAR JS END-->

        <!--BIRTHDATE JS-->
        <script type="text/javascript">
            var numDays = {'01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31};
            function setDays(oMonthSel, oDaysSel, oYearSel)
            {
                var nDays, oDaysSelLgth, opt, i = 1;
                nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value];
                if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0)
                    ++nDays;
                oDaysSelLgth = oDaysSel.length;
                if (nDays != oDaysSelLgth) {
                    if (nDays < oDaysSelLgth)
                        oDaysSel.length = nDays;
                    else
                        for (i; i < nDays - oDaysSelLgth + 1; i++) {
                            opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i);
                            oDaysSel.options[oDaysSel.length] = opt;
                        }
                }
                var oForm = oMonthSel.form;
                var month = oMonthSel.options[oMonthSel.selectedIndex].value;
                var day = oDaysSel.options[oDaysSel.selectedIndex].value;
                var year = oYearSel.options[oYearSel.selectedIndex].value;
            }
        </script>
        <!--BIRTHDATE JS END-->
    </head>
    <body ng-app class="ng-scope">

        <!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
        	<div class="loader"></div>
            <h5>Loading...</h5>
        </div>
        <!-- ICON LOADER END-->

        <div id="body" style="display:none">
            <div id="wrap">
                <div id="main">
                    <!-- SMS Sending And Account Verification -->
                      <?php
                    if (isset($_REQUEST['confirm_id'])) {
                        $confid = $_REQUEST['confirm_id'];
                        $confemail = $_REQUEST['email'];
                        $select = $DatabaseCo->dbLink->query("select matri_id,country_id,mobile,status from register where email='$confemail' and cpassword='$confid'");
                        $exe = mysqli_num_rows($select);
                        $rowcc = mysqli_fetch_array($select);
                        $rowcc['status'];
                        if ($exe > 0) {
                            if ($rowcc['status'] == 'Inactive') {
                               
								
								$text = "Congratulations! Your account has been activated Successfully.Login and find your life partner with us.Your Login id is " . $rowcc['matri_id'] . "";
                                $message = str_replace(" ", "%20", $text);
                                echo $mno = $rowcc['mobile'];
								include 'mobile-apis.php';
								echo $url;
								$ret = file($url);
								if($profile_method->profile_verification == 'auto_approve'){
                                	$update = $DatabaseCo->dbLink->query("update register set cpass_status='yes',status='Active' where email='$confemail'");
								?>
								<script>alert('Your account has been Activated.');</script>
								<script>window.location='index'</script>
								<?php 
								}else{
									$update = $DatabaseCo->dbLink->query("update register set cpass_status='yes' where email='$confemail'");
								?>
								<script>alert('Your Email id is verified.');</script>
								<script>window.location='index'</script>
								<?php 
								}
                               	?>
                                
                                
                                <?php
                            } else {
								
                                ?>
                                 <script>alert('Profile is already activated.');</script>
                                 <script>window.location='index'</script>
                                <?php
                            }
                        } else {
                            ?>
                            <script>alert('Error in activation...');</script>
                            <?php
                        }
                    }
                    ?>
                    <!-- SMS Sending And Account Verification End -->
                    <!-- HEADER -->
                    <?php include "parts/header.php"; ?>
                    <?php include "parts/menu-aft-login.php"; ?>
                    <!-- HEADER END-->
                    <!-- MAIN CONTAINER-->
                    <div class="container-fluid">
                        <div class="row">
                            <!--- Main Slider-->
							<?php 
								$row_banner = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT banner1,banner2,banner3 FROM site_config WHERE id='1'"));
							?>
                            <div id="owl-demo-2" class="owl-carousel gt-slide-up">
								<?php 
									if($row_banner->banner1 !="" && file_exists('img/banners/'.$row_banner->banner1)){ 
								?>
                                <div class="item">
                                    <img src="img/banners/<?php echo $row_banner->banner1;?>" alt="banner-1">
                                </div>
								<?php } ?>
								<?php 
									if($row_banner->banner2 !="" && file_exists('img/banners/'.$row_banner->banner2)){ 
								?>
                                <div class="item">
                                    <img src="img/banners/<?php echo $row_banner->banner2; ?>" alt="banner-2">
                                </div>
								<?php } ?>
								<?php 
									if($row_banner->banner3 !="" && file_exists('img/banners/'.$row_banner->banner3)){ 
								?>
                                <div class="item">
                                    <img src="img/banners/<?php echo $row_banner->banner3;?>" alt="banner-3">
                                </div>
								<?php } ?>
                            </div>
                            <!-- Main Slider End-->

                            <!-- Registeration Form-->
                            <div class="container gt-pad-lr-0-479">
                                <div class="col-xxl-4 col-xl-4 col-lg-8 hidden-xs hidden-sm hidden-md">
                                    <div class="gt-onslide-stamp">
                                        <span><i class="fa fa-check-square-o"></i></span><h5>100% Verified Profiles</h5>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-8 hidden-xs hidden-sm hidden-md">
                                    <div class="gt-onslide-stamp">
                                        <span><i class="fa fa-users"></i></span><h5>Best Matching Profiles</h5>
                                    </div>
                                </div>
                                <?php if (!isset($_SESSION['user_id'])) { ?>
                                    <div class="col-xxl-6 col-xxl-offset-2 col-xl-7 col-xl-offset-1 col-lg-16 gt-pad-lr-0-479">
                                        <div class="gt-slideUp-form-head">
                                            <span><i class="fa fa-pencil"></i></span>
                                            <div>
                                            	<h4>REGISTER NOW</h4>
                                            </div>
                                        </div>
                                        <div class="gt-slideUp-form-body">
                                            <form action="mobile-verification" id="frm" method="post" name="frm" onsubmit="return validateForm()">
                                                <div class="col-xxl-16 col-xl-16 form-group gt-index-collab">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                                                            <select class="gt-form-control flat form-1" name="profile_by" >
                                                                <option value="">Profile Created By</option>
                                                                <option value="Self">Self</option>
                                                                <option value="Parents">Parents</option>
                                                                <option value="Guardian">Guardian</option>
                                                                <option value="Friends">Friends</option>
                                                                <option value="Sibling">Sibling</option>
                                                                <option value="Relatives">Relatives</option>
                                                            </select>
                                                            <select class="gt-form-control flat form-2" name="gender" >
                                                                <option value="">Select Gender</option>

                                                                <option value="Female" <?php if (isset($gender) && $gender == 'Female') echo "selected" ?>>Female</option>
                                                                <option value="Male" <?php if (isset($gender) && $gender == 'Male') echo "selected" ?>>Male</option>
															</select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group gt-index-collab">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                                            <input type="text" class="gt-form-control flat form-1" placeholder="Enter First Name" name="nickname" id="nickname"  <?php if (isset($fname) && $fname != '') { ?> value="<?php echo $fname ?>" <?php } ?> <?php if (isset($fname) && $fname == '') { ?>ng-maxlength="30" ng-model="user.name" <?php }?> >
                                                            <span ng-show="frm.lastname.$dirty && frm.lastname.$error.maxlength" class="text-danger gt-margin-left-10">Name Is Too Long!</span>
                                                            <input type="text" class="gt-form-control flat form-2" placeholder="Enter Last Name" name="lastname" id="lastname"  <?php if (isset($lname) && $lname != '') { ?> value="<?php echo $lname; ?>" <?php } ?>  <?php if (isset($lname) && $lname == '') { ?> ng-maxlength="30" ng-model="user.lastname"<?php }?>>

                                                            <span ng-show="frm.nickname.$dirty && frm.nickname.$error.maxlength" class="text-danger gt-margin-left-10">Name Is Too Long !</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                                            <div class="row">
                                                                <div class="col-xxl-4 col-xs-5 col-s-5 col-m-5 col-l-5">
                                                                    <select name="day" id="day" class="gt-form-control flat" onchange="setDays(month, this, year)">
                                                                        <?php
                                                                        if ($day != '') {
																			?>
                                                                            <option value='<?php echo "$day"?>'><?php echo "$day"?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <option value="01">01</option>
                                                                        <option value="02">02</option>
                                                                        <option value="03">03</option>
                                                                        <option value="04">04</option>
                                                                        <option value="05">05</option>
                                                                        <option value="06">06</option>
                                                                        <option value="07">07</option>
                                                                        <option value="08">08</option>
                                                                        <option value="09">09</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14">14</option>
                                                                        <option value="15">15</option>
                                                                        <option value="16">16</option>
                                                                        <option value="17">17</option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-5 col-xs-6 col-s-6 col-m-6 col-l-6">
                                                                    <select name="month" id="month" class="gt-form-control flat" onchange="setDays(this, day, year)">
                                                                        <option value="">Month</option>
                                                                        <option value="01">Jan</option>
                                                                        <option value="02">Feb</option>
                                                                        <option value="03">Mar</option>
                                                                        <option value="04">Apr</option>
                                                                        <option value="05">May</option>
                                                                        <option value="06">Jun</option>
                                                                        <option value="07">Jul</option>
                                                                        <option value="08">Aug</option>
                                                                        <option value="09">Sep</option>
                                                                        <option value="10">Oct</option>
                                                                        <option value="11">Nov</option>
                                                                        <option value="12">Dec</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-7 col-xs-5 col-s-5 col-m-5 col-l-5">
                                                                    <select name="year" id="year" class="gt-form-control flat" onchange="setDays(month, day, this)">
                                                                        <option value="">Year</option>
                                                                    
                                                                        <?php
                                                                        for ($x = 2010; $x >= 1924; $x--) {
                                                                            ?>
                                                                            <option value='<?php echo $x; ?>'>
                                                                                <?php echo $x; ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-book fa-fw"></i></span>
                                                            <select class="gt-form-control flat chosen-single chosen-select" name="religion" id="religion">
                                                                <option value="">Select Your Religion</option>
                                                                <?php
                                                                $SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");

                                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion)) {
                                                                    ?>
                                                                    <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                           
                                                            <div id="caste1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-users fa-fw"></i></span>
                                                           	<select class="gt-form-control flat chosen-select" name="caste" id="caste" >
                                                                <option value="">Select Religion First</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group custom-chosen">
                                                            <span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
                                                            <select class="gt-form-control chosen-select flat" name="m_tongue" id="m_tongue" >
                                                                <option value="">Mother Tongue</option>
                                                                <?php
                                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                                                                    ?>
                                                                    <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"><?php echo $DatabaseCo->dbRow->mtongue_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="f2">
                                                            <select class="gt-form-control flat chosen-select" name="country">
                                                                <option value="">Country</option>
                                                                <?php
                                                                while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_country)) {
                                                                    ?>
                                                                    <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                                                                <?php } ?>
                                                            </select>

                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
                                                            <div class="row">
                                                                <div class="col-xxl-5 col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                                                    <select class="gt-form-control flat" name="code" id="code" >
                                                                        <option value="+93">+93</option>
                                                                        <option value="+355">+355</option>
                                                                        <option value="+213">+213</option>
                                                                        <option value="+684">+684</option>
                                                                        <option value="+376">+376</option>
                                                                        <option value="+244">+244</option>
                                                                        <option value="+1">+1</option>
                                                                        <option value="+54">+54</option>
                                                                        <option value="+374">+374</option>
                                                                        <option value="+61">+61</option>
                                                                        <option value="+43">+43</option>
                                                                        <option value="+994">+994</option>
                                                                        <option value="+973">+973</option>
                                                                        <option value="+880">+880</option>
                                                                        <option value="+375">+375</option>
                                                                        <option value="+32">+32</option>
                                                                        <option value="+501">+501</option>
                                                                        <option value="+975">+975</option>
                                                                        <option value="+591">+591</option>
                                                                        <option value="+387">+387</option>
                                                                        <option value="+267">+267</option>
                                                                        <option value="+55">+55</option>
                                                                        <option value="+673">+673</option>
                                                                        <option value="+359">+359</option>
                                                                        <option value="+226">+226</option>
                                                                        <option value="+257">+257</option>
                                                                        <option value="+225">+225</option>
                                                                        <option value="+855">+855</option>
                                                                        <option value="+237">+237</option>
                                                                        <option value="+238">+238</option>
                                                                        <option value="+236">+236</option>
                                                                        <option value="+235">+235</option>
                                                                        <option value="+56">+56</option>
                                                                        <option value="+86">+86</option>
                                                                        <option value="+57">+57</option>
                                                                        <option value="+269">+269</option>
                                                                        <option value="+242">+242</option>
                                                                        <option value="+682">+682</option>
                                                                        <option value="+506">+506</option>
                                                                        <option value="+385">+385</option>
                                                                        <option value="+53">+53</option>
                                                                        <option value="+357">+357</option>
                                                                        <option value="+420">+420</option>
                                                                        <option value="+850">+850</option>
                                                                        <option value="+243">+243</option>
                                                                        <option value="+45">+45</option>
                                                                        <option value="+253">+253</option>
                                                                        <option value="+670">+670</option>
                                                                        <option value="+593">+593</option>
                                                                        <option value="+20">+20</option>
                                                                        <option value="+503">+503</option>
                                                                        <option value="+240">+240</option>
                                                                        <option value="+291">+291</option>
                                                                        <option value="+372">+372</option>
                                                                        <option value="+251">+251</option>
                                                                        <option value="+500">+500</option>
                                                                        <option value="+298">+298</option>
                                                                        <option value="+679">+679</option>
                                                                        <option value="+358">+358</option>
                                                                        <option value="+33">+33</option>
                                                                        <option value="+594">+594</option>
                                                                        <option value="+689">+689</option>
                                                                        <option value="+241">+241</option>
                                                                        <option value="+220">+220</option>
                                                                        <option value="+995">+995</option>
                                                                        <option value="+49">+49</option>
                                                                        <option value="+233">+233</option>
                                                                        <option value="+350">+350</option>
                                                                        <option value="+30">+30</option>
                                                                        <option value="+299">+299</option>
                                                                        <option value="+590">+590</option>
                                                                        <option value="+502">+502</option>
                                                                        <option value="+224">+224</option>
                                                                        <option value="+245">+245</option>
                                                                        <option value="+592">+592</option>
                                                                        <option value="+509">+509</option>
                                                                        <option value="+504">+504</option>
                                                                        <option value="+852">+852</option>
                                                                        <option value="+36">+36</option>
                                                                        <option value="+354">+354</option>
                                                                        <option value="+91" selected>+91</option>
                                                                        <option value="+62">+62</option>
                                                                        <option value="+98">+98</option>
                                                                        <option value="+964">+964</option>
                                                                        <option value="+353">+353</option>
                                                                        <option value="+972">+972</option>
                                                                        <option value="+39">+39</option>
                                                                        <option value="+81">+81</option>
                                                                        <option value="+962">+962</option>
                                                                        <option value="+7">+7</option>
                                                                        <option value="+254">+254</option>
                                                                        <option value="+686">+686</option>
                                                                        <option value="+82">+82</option>
                                                                        <option value="+965">+965</option>
                                                                        <option value="+996">+996</option>
                                                                        <option value="+856">+856</option>
                                                                        <option value="+371">+371</option>
                                                                        <option value="+961">+961</option>
                                                                        <option value="+266">+266</option>
                                                                        <option value="+231">+231</option>
                                                                        <option value="+218">+218</option>
                                                                        <option value="+423">+423</option>
                                                                        <option value="+370">+370</option>
                                                                        <option value="+352">+352</option>
                                                                        <option value="+853">+853</option>
                                                                        <option value="+261">+261</option>
                                                                        <option value="+265">+265</option>
                                                                        <option value="+60">+60</option>
                                                                        <option value="+960">+960</option>
                                                                        <option value="+223">+223</option>
                                                                        <option value="+356">+356</option>
                                                                        <option value="+596">+596</option>
                                                                        <option value="+222">+222</option>
                                                                        <option value="+230">+230</option>
                                                                        <option value="+269">+269</option>
                                                                        <option value="+52">+52</option>
                                                                        <option value="+691">+691</option>
                                                                        <option value="+373">+373</option>
                                                                        <option value="+377">+377</option>
                                                                        <option value="+976">+976</option>
                                                                        <option value="+212">+212</option>
                                                                        <option value="+258">+258</option>
                                                                        <option value="+95">+95</option>
                                                                        <option value="+264">+264</option>
                                                                        <option value="+674">+674</option>
                                                                        <option value="+977">+977</option>
                                                                        <option value="+31">+31</option>
                                                                        <option value="+599">+599</option>
                                                                        <option value="+687">+687</option>
                                                                        <option value="+64">+64</option>
                                                                        <option value="+505">+505</option>
                                                                        <option value="+227">+227</option>
                                                                        <option value="+234">+234</option>
                                                                        <option value="+683">+683</option>
                                                                        <option value="+672">+672</option>
                                                                        <option value="+47">+47</option>
                                                                        <option value="+968">+968</option>
                                                                        <option value="+92">+92</option>
                                                                        <option value="+507">+507</option>
                                                                        <option value="+675">+675</option>
                                                                        <option value="+595">+595</option>
                                                                        <option value="+51">+51</option>
                                                                        <option value="+63">+63</option>
                                                                        <option value="+672">+672</option>
                                                                        <option value="+48">+48</option>
                                                                        <option value="+351">+351</option>
                                                                        <option value="+974">+974</option>
                                                                        <option value="+262">+262</option>
                                                                        <option value="+40">+40</option>
                                                                        <option value="+7">+7</option>
                                                                        <option value="+250">+250</option>
                                                                        <option value="+290">+290</option>
                                                                        <option value="+508">+508</option>
                                                                        <option value="+685">+685</option>
                                                                        <option value="+378">+378</option>
                                                                        <option value="+239">+239</option>
                                                                        <option value="+966">+966</option>
                                                                        <option value="+221">+221</option>
                                                                        <option value="+381">+381</option>
                                                                        <option value="+248">+248</option>
                                                                        <option value="+232">+232</option>
                                                                        <option value="+65">+65</option>
                                                                        <option value="+421">+421</option>
                                                                        <option value="+386">+386</option>
                                                                        <option value="+677">+677</option>
                                                                        <option value="+252">+252</option>
                                                                        <option value="+27">+27</option>
                                                                        <option value="+34">+34</option>
                                                                        <option value="+94">+94</option>
                                                                        <option value="+249">+249</option>
                                                                        <option value="+597">+597</option>
                                                                        <option value="+268">+268</option>
                                                                        <option value="+46">+46</option>
                                                                        <option value="+41">+41</option>
                                                                        <option value="+963">+963</option>
                                                                        <option value="+886">+886</option>
                                                                        <option value="+992">+992</option>
                                                                        <option value="+255">+255</option>
                                                                        <option value="+66">+66</option>
                                                                        <option value="+389">+389</option>
                                                                        <option value="+228">+228</option>
                                                                        <option value="+690">+690</option>
                                                                        <option value="+676">+676</option>
                                                                        <option value="+216">+216</option>
                                                                        <option value="+90">+90</option>
                                                                        <option value="+993">+993</option>
                                                                        <option value="+688">+688</option>
                                                                        <option value="+256">+256</option>
                                                                        <option value="+380">+380</option>
                                                                        <option value="+971">+971</option>
                                                                        <option value="+44">+44</option>
                                                                        <option value="+598">+598</option>
                                                                        <option value="+998">+998</option>
                                                                        <option value="+678">+678</option>
                                                                        <option value="+58">+58</option>
                                                                        <option value="+84">+84</option>
                                                                        <option value="+681">+681</option>
                                                                        <option value="+967">+967</option>
                                                                        <option value="+381">+381</option>
                                                                        <option value="+260">+260</option>
                                                                        <option value="+263">+263</option>
                                                                        <option value="+297">+297</option>
                                                                        <option value="+229">+229</option>
                                                                        <option value="+599">+599</option>
                                                                        <option value="+246">+246</option>
                                                                        <option value="+599">+599</option>
                                                                        <option value="+379">+379</option>
                                                                        <option value="+692">+692</option>
                                                                        <option value="+680">+680</option>
                                                                        <option value="+970">+970</option>
                                                                        <option value="+590">+590</option>
                                                                        <option value="+590">+590</option>
                                                                        <option value="+211">+211</option>
                                                                        <option value="+670">+670</option>
                                                                        <option value="+382">+382</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-xxl-11 col-xs-11 col-sm-11 col-md-11 col-lg-12">
                                                                    <input type="number" class="gt-form-control flat" placeholder="Enter Your 10 Digit No" name="mobile" id="mobile" maxlength="10"  value="<?php
                                                                    if (isset($_REQUEST['mobile'])) {
                                                                        echo $_REQUEST['mobile'];
                                                                    }
                                                                    ?>" ng-maxlength="10" ng-minlength="5" ng-model="user.mobile">
                                                                    <span ng-show="frm.mobile.$dirty && frm.mobile.$error.maxlength" class="text-danger">Mobile Number Is Too Long !</span>
                                                                    <span ng-show="frm.mobile.$dirty && frm.mobile.$error.minlength" class="text-danger">Mobile Number Is Too Short !</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                                                            <input type="email" class="gt-form-control flat" placeholder="Enter Your Email Id" name="email" value="<?php
                                                            if (isset($email)) {
                                                                echo $email;
                                                            }
                                                            ?>" <?php if (isset($email) && $email == '') { ?> ng-model="user.email" <?php }?>  >
                                                            <span ng-show="frm.email.$dirty && frm.email.$error.email" class="text-danger gt-margin-left-10">Enter Valid Email Id !</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-16 col-xl-16 form-group">
                                                    <div class="row">
                                                        <label for="terms" class="font-13">
                                                            <input type="checkbox" id="terms" name="chk_terms" checked data-validetta="required"><span class="gt-margin-left-10">I accept <a href="cms?cms_id=7" target="_blank">terms & conditions</a> and <a href="cms?cms_id=6" target="_blank">privacy policy</a></span>.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-xxl-8 col-xxl-offset-4 col-xl-8 col-xl-offset-4 col-lg-4 col-lg-offset-3 col-md-7 gt-index-reg-btn col-xs-7">
                                                        <button type="submit" class="btn gt-btn-green btn-block" name="reg_sub" ><i class="fa fa-pencil hidden-sm hidden-xs"></i><div>Register Now</div></button>
                                                    </div>
                                                   
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- Registeration Form End-->
                        </div>
                    </div>
                    <!--- WELCOME BUCKETS ---->
                    <section class="gt-bg-lgtGrey">
                        <div class="container">
                            <h2 class="text-center textLightS"><?php echo $configObj->getConfigWelcome(); ?></h2>
                            <p class="text-center gt-text-Grey indexContent">
                                Best matrimony service provider in India.We find the best perfect life partner for you.join us now and<br> find your life partner from our thousand’s of verified profiles.
                            </p>

                            <div class="gt-hearts">
                                <div class="gt-hearts-group">
                                    <i class="fa fa-heart font-20 heart gt-text-orange"></i>
                                    <i class="fa fa-heart font-38 heart gt-text-orange"></i>
                                    <i class="fa fa-heart font-20 heart gt-text-orange"></i>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-8 gt-margin-top-20">
                                <div class="row">
                                    <div class="col-xxl-16 text-center">
                                        <i class="fa fa-star index-color-1 gt-index-icon-font"></i>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h2 class="font-26 gt-font-weight-600">
                                            Success Story
                                        </h2>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <article>
                                            <p>
                                                Hundred’s of successful member found their soulmates with us.
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h5>
                                            <a href="success-story" class="gt-text-Grey">View Success Stories <i class="fa fa-caret-right gt-margin-left-10"></i></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-8 gt-margin-top-20">
                                <div class="row">
                                    <div class="col-xxl-16 text-center">
                                        <i class="fa fa-users index-color-2 gt-index-icon-font tex"></i>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h2 class="font-26 gt-font-weight-600">
                                            Verified Members
                                        </h2>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <article>
                                            <p>
                                                Thousands of verified member profile so our members find perfect partner without any concern.
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h5>
                                            <a href="login" class="gt-text-Grey">View Profiles Now<i class="fa fa-caret-right gt-margin-left-10"></i></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-8 gt-margin-top-20">
                                <div class="row">
                                    <div class="col-xxl-16 text-center">
                                        <i class="fa fa-search index-color-3 gt-index-icon-font"></i>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h2 class="font-26 gt-font-weight-600">
                                            Search Options
                                        </h2>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <article>
                                            <p>
                                                Multiple search options to find partner who know you better.
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h5>
                                            <a href="search" class="gt-text-Grey">Search Now <i class="fa fa-caret-right gt-margin-left-10"></i></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-8 gt-margin-top-20">
                                <div class="row">
                                    <div class="col-xxl-16 text-center">
                                        <i class="fa fa-list-ol index-color-4 gt-index-icon-font"></i>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h2 class="font-26 gt-font-weight-600">
                                            Matching Profiles
                                        </h2>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <article>
                                            <p>
                                                With our auto match profile you can see members which was suits you best and get married.
                                            </p>
                                        </article>
                                    </div>
                                    <div class="col-xxl-16 text-center">
                                        <h5>
                                            <a href="login" class="gt-text-Grey">View Matches Now<i class="fa fa-caret-right gt-margin-left-10"></i></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--- WELCOME BUCKETS END---->
                    <div class="clearfix"></div>
                    <!--- FEATURED BRIDE --->
                    <?php $sel_fet_bride = $DatabaseCo->dbLink->query("select matri_id,birthdate,username,country_name,city_name,photo_view_status,photo1_approve,photo1,photo_protect,photo_pswd,gender from register_view where gender='Female' and fstatus='Featured' order by rand() limit 0,9");
					if (mysqli_num_rows($sel_fet_bride) > 0) {
					?>
                	<section class="gt-bg-index-white">
                       <div class="container">
                            <h2 class="text-center gt-text-Grey">Featured Brides</h2>
                        	<p class="text-center gt-text-Grey">
                            	This is our featured brides section you can contact register and contact them now.
                            </p>
                        	<div class="gt-hearts">
                            		<div class="gt-hearts-group gt-bg-white">
                                    	<i class="fa fa-heart font-20 heart gt-text-green"></i>
                                		<i class="fa fa-heart font-38 heart gt-text-green"></i>
                                		<i class="fa fa-heart font-20 heart gt-text-green"></i>
                            		</div>
                            </div>
                        	<div id="owl-demo-3" class="owl-carousel">
                    			<?php
									while ($Row = mysqli_fetch_object($sel_fet_bride)) {
                    			?>
                               	<a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" class="item text-center col-xxl-16 col-xs-16">
                                	
                                    <div class="thumbnail">
                                    	<?php include 'parts/search-result-photo.php';?>
                                    </div>
                                    <h4 class="gt-text-Grey">
                           	 			<?php echo $Row->username; ?>
                                    </h4>
                                    <p class="gt-text-Grey gt-margin-bottom-5">
                            			<?php echo floor((time() - strtotime($Row->birthdate)) / 31556926) . ' Years'; ?>,<?php
                            				$a = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '" . $Row->matri_id . "'  GROUP BY a.edu_detail"));
                           					echo $a['edu_name'];
                            			?>
                                    </p>
                                    <p class="gt-text-Grey">
                            			<?php
                            				if ($Row->city_name != '') {
                                				echo $Row->city_name;
                            				} else {
                                				echo "N/A";
                            				}
                            			?>,
										<?php echo $Row->country_name; ?>.
                                    </p>
                                    <span class="gt-btn-round gt-inline-block">
                                       <b>View Profile</b><i class="fa fa-angle-right"></i>
                                    </span>
                               </a>
                            	<?php }
         				} else {
                    ?>
                    <div class="col-xs-12">
                       <div class="" style="display:none;"></div>
                    </div>
                    <?php } ?>
                        </div>
                       </div>
                	</section>
                	<!--- FEATURED BRIDE END --->
                  	<div class="clearfix"></div>
                    <!--- FEATURED GROOM --->
                    <?php  $sel_fet_groom = $DatabaseCo->dbLink->query("select matri_id,birthdate,username,country_name,city_name,photo_view_status,photo1_approve,photo1,photo_protect,photo_pswd,gender from register_view where gender='Male' and fstatus='Featured' order by rand() limit 0,9");
                    	if (mysqli_num_rows($sel_fet_groom) > 0) {
					?>
                    <section class="gt-bg-lgtGrey">
                   		<div class="container">
                            <h2 class="text-center gt-text-Grey">
                            	Featured Grooms
                        	</h2>
                        	<p class="text-center gt-text-Grey">
                           	   This is our featured grooms section you can contact register and contact them now.
                            </p>
                        	<div class="gt-hearts">
                            	<div class="gt-hearts-group">
                                    <i class="fa fa-heart font-20 heart gt-text-green"></i>
                                	<i class="fa fa-heart font-38 heart gt-text-green"></i>
                                	<i class="fa fa-heart font-20 heart gt-text-green"></i>
                            	</div>
                        	</div>
                        	<div id="owl-demo-4" class="owl-carousel">
                    		<?php
                   				while ($Row = mysqli_fetch_object($sel_fet_groom)) {
                    		?>
                            <a href="member-profile?view_id=<?php echo $Row->matri_id; ?>" class="item text-center col-xxl-16 col-xs-16">
       							<div class="thumbnail">
                                    	<?php include 'parts/search-result-photo.php';?>
                                </div>
                                <h4 class="gt-text-Grey">
                            		<?php echo $Row->username; ?>
                                </h4>
                                <p class="gt-text-Grey gt-margin-bottom-5">
                            		<?php echo floor((time() - strtotime($Row->birthdate)) / 31556926) . ' Years'; ?>,<?php
                           			 $a = mysqli_fetch_array($DatabaseCo->dbLink->query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '" . $Row->matri_id . "'  GROUP BY a.edu_detail"));
                            		echo $a['edu_name'];
                            		?>
                                </p>
                                <p class="gt-text-Grey">
                            		<?php
                            			if ($Row->city_name != '') {
                                			echo $Row->city_name;
                           			 	} else {
                                			echo "N/A";
                            			}
                            		?>,
									<?php echo $Row->country_name; ?>.
                                </p>
                                <span class="gt-btn-round gt-inline-block">
                                    <b>View Profile</b><i class="fa fa-angle-right"></i>
                                </span>
                           </a>
                          <?php }
                       	 } else {
                    	?>
                    <div class="col-xs-12">
                        <div class="" style="display:none;"></div>
                    </div>
                    <?php } ?>
                        </div>
                    </div>
                	</section>
                	<!--- FEATURED GROOM END --->
                    <div class="clearfix"></div>
                   
                </div>
            </div>
            <?php include "parts/footer-before-login.php"; ?>
        </div>
       	<!---- JQUERY ----->
        <script src="js/jquery.min.js"></script>
        <!---- JQUERY END ----->
        <!--- BOOTSTRAP AND GREEN JS--->
        <script src="js/bootstrap.js"></script>
        <script src="js/green.js"></script>
        <script>
            $(document).ready(function() {
              $('#body').show();
              $('.preloader-wrapper').hide();
            });
		</script>
        <!--- BOOTSTRAP AND GREEN JS END--->

        <!----- CHOSEN JS ---->
     	<script src="js/chosen.jquery.js" type="text/javascript"></script>
     	<script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
     	<!--- VALIDATION JS --->
        <script type="text/javascript">
			function validateForm() {
				var a = document.forms["frm"]["profile_by"].value;
				if (a == "") {
					alert("Select Profile Created By");
					return false;
				}
				var b = document.forms["frm"]["gender"].value;
				if (b == "") {
					alert("Select Your Gender");
					return false;
				}
				var c = document.forms["frm"]["nickname"].value;
				if (c == "") {
					alert("First name must be filled out");
					return false;
				}
				var d = document.forms["frm"]["lastname"].value;
				if (c == "") {
					alert("Last name must be filled out");
					return false;
				}
				var g = document.forms["frm"]["day"].value;
				if (g == "") {
					alert("Please select your birthdate");
					return false;
				}
				var h = document.forms["frm"]["month"].value;
				if (h == "") {
					alert("Please select your birth month");
					return false;
				}
				var i = document.forms["frm"]["year"].value;
				if (i == "") {
					alert("Please select your birth year");
					return false;
				}
				var e = document.forms["frm"]["religion"].value;
				if (e == "") {
					alert("Please select religion");
					return false;
				}
				var f = document.forms["frm"]["caste"].value;
				if (f == "") {
					alert("Please select caste");
					return false;
				}
				var j = document.forms["frm"]["m_tongue"].value;
				if (j == "") {
					alert("Please select mother tongue");
					return false;
				}
				var k = document.forms["frm"]["country"].value;
				if (k == "") {
					alert("Please select country");
					return false;
				}
				var l = document.forms["frm"]["code"].value;
				if (l == "") {
					alert("Please select country code");
					return false;
				}
				var m = document.forms["frm"]["mobile"].value;
				if (m == "") {
					alert("Mobile must be filled out.");
					return false;
				}
				var n = document.forms["frm"]["email"].value;
				if (n == "") {
					alert("Email id must be filled out.");
					return false;
				}
			}
		</script>
        <!---VALIDATION JS END --->
     
     	<script type="text/javascript">
    	var config = {
      	'.chosen-select'           : {},
      	'.chosen-select-deselect'  : {allow_single_deselect:true},
      	'.chosen-select-no-single' : {disable_search_threshold:10},
      	'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      	'.chosen-select-width'     : {width:"100%"}
   		}
    	for (var selector in config) {
      		$(selector).chosen(config[selector]);
    	}
     	</script>
     	<!----- CHOSEN JS END ---->

        <!--- OWL CAROUSEL --->
        <script src="js/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#owl-demo-3").owlCarousel({
                    autoPlay: 3000,
                    items: 5,
                    navigation: true,
                    navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                    itemsDesktop: [1199, 5],
                    itemsDesktopSmall: [979, 4],
                    itemsCustom: [
                        [0, 1],
                        [450, 1],
                        [600, 2],
                        [700, 2],
                        [800, 3],
                        [1000, 5],
                        [1200, 5],
                        [1400, 5],
                        [1600, 5]
                    ],
                });
				$("#owl-demo-4").owlCarousel({
                    autoPlay: 3000,
                    items: 5,
                    navigation: true,
                    navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                    itemsDesktop: [1199, 5],
                    itemsDesktopSmall: [979, 4],
                    itemsCustom: [
                        [0, 1],
                        [450, 1],
                        [600, 2],
                        [700, 2],
                        [800, 3],
                        [1000, 5],
                        [1200, 5],
                        [1400, 5],
                        [1600, 5]
                    ],
                });
				$("#owl-demo-2").owlCarousel({
                    autoPlay: 3000,
                    autoPlay:true,
                            items: 1,
                    itemsDesktop: [1199, 1],
                    itemsDesktopSmall: [979, 1],
                    itemsCustom: [
                        [0, 1],
                        [450, 1],
                        [600, 1],
                        [700, 1],
                        [1000, 1],
                        [1200, 1],
                        [1400, 1],
                        [1600, 1]
                    ],
                });
            });
        </script>
       <script>
				$("#owl-vendor-strip").owlCarousel({
                    autoPlay: 3000,
                    items: 1,
                    navigation: true,
                    navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                    pagination: false,
                   
                });
		</script>

        <!--- OWL CAROUSEL END--->
        <!---- CASTE LOADING JS ---->
        <script type="text/javascript">

            function check_profileby(status) {
                $('#nickname').attr("placeholder", status + "'s Name");
            }
            $(document).ready(function() {
                $("#religion").on('change', function() {
                    $("#caste1").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
                    var id = $(this).val();
                    var dataString = 'religionId=' + id;
                    $.ajax({
                        type: "POST",
                        url: "ajax_search2",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            $("#caste").html(html);
                            $("#caste1").html('');
							$("#caste").trigger("chosen:updated");
                        }});
                });

            });
        </script>
        <!---- CASTE LOADING JS END---->
	</body>
</html>
<?php include'thumbnailjs.php'; ?>
