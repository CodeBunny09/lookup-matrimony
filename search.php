<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
		$gender='';
		$from_age='';
		$to_age='';
		$from_height='';	
		$to_height='';
		$m_status='';
		$religion_id='';
		$caste_id='';
		$m_tongue='';
		$country_id='';
		$state_id='';
		$city_id='';
		$education='';
		$photo_search='';
		$education='';
		$occupation='';
		$annual_income='';
		$diet='';
		$drink='';
		$manglik='';
		$smoking='';
		$star='';
		$tot_children='';
		$physical_status='';
		
	unset($_SESSION['religion']);
	unset($_SESSION['caste']);
	unset($_SESSION['m_tongue']);
	unset($_SESSION['fromage']);
	unset($_SESSION['toage']);
	unset($_SESSION['fromheight']);
	unset($_SESSION['toheight']);
	unset($_SESSION['m_status']);
	unset($_SESSION['education']);
	unset($_SESSION['occupation']);
	unset($_SESSION['country']);
	unset($_SESSION['state']);
	unset($_SESSION['city']);
	unset($_SESSION['manglik']);
	unset($_SESSION['keyword']);
	unset($_SESSION['photo_search']);
	unset($_SESSION['gender']);
	unset($_SESSION['tot_children']);
	unset($_SESSION['annual_income']);
	unset($_SESSION['diet']);
	unset($_SESSION['drink']);
	unset($_SESSION['complexion']);
	unset($_SESSION['bodytype']);
	unset($_SESSION['star']);
	unset($_SESSION['id_search']);
	unset($_SESSION['smoking']);
	unset($_SESSION['physical_status']);
	
if(isset($_POST['quick_sub']))
{
	if(isset($_POST['gender'])){
		$gender=$_POST['gender'];
	}
	else
	{
		$gender='';
	}
	if(isset($_POST['from_age'])){
		$from_age=$_POST['from_age'];
	}
	else
	{
		$from_age='';
	}
	if(isset($_POST['to_age'])){
		$to_age=$_POST['to_age'];
	}
	else
	{
		$to_age='';
	}
	if(isset($_POST['religion_id'])){
		$religion_id=implode(',',$_POST['religion_id']);
	}
	else
	{
		$religion_id='';
	}
	
	if(isset($_POST['caste_id'])){
		$caste_id=implode(',',$_POST['caste_id']);
	}
	else
	{
		$caste_id='';
	}
		
	/*if(isset($_POST['m_tongue'])){
		$m_tongue=implode(',',$_POST['m_tongue']);
	}
	else
	{
		$m_tongue='';	
	}*/
	
	$_SESSION['gender']=$gender;
	$_SESSION['fromage']=$from_age;
	$_SESSION['toage']=$to_age;
	$_SESSION['religion']=$religion_id;
	$_SESSION['caste']=$caste_id;
	//$_SESSION['m_tongue']=$m_tongue;

	echo "<script>window.location='search_result';</script>";
}

if(isset($_POST['basic_sub']))
{
	if(isset($_POST['gender'])){
		$gender=$_POST['gender'];
	}
	else
	{
		$gender='';
	}
	if(isset($_POST['from_age'])){
		$from_age=$_POST['from_age'];
	}
	else
	{
		$from_age='';
	}
	if(isset($_POST['to_age'])){
		$to_age=$_POST['to_age'];
	}
	else
	{
		$to_age='';
	}
	
	if(isset($_POST['from_height'])){
		$from_height=$_POST['from_height'];
	}
	else
	{
		$from_height='';
	}
	
	if(isset($_POST['to_height'])){
		$to_height=$_POST['to_height'];
	}
	else
	{
		$to_height='';	
	}
		
	if(isset($_POST['m_status'])){
		$m_status=implode(',',$_POST['m_status']);
	}
	else
	{
		$m_status='';
	}
	
	if(isset($_POST['religion_id'])){
		$religion_id=implode(',',$_POST['religion_id']);
	}
	else
	{
		$religion_id='';
	}
	
	if(isset($_POST['caste_id'])){
		$caste_id=implode(',',$_POST['caste_id']);
	}
	else
	{
		$caste_id='';
	}
	
	if(isset($_POST['m_tongue'])){
		$m_tongue=implode(',',$_POST['m_tongue']);
	}
	else
	{
		$m_tongue='';	
	}
		
	if(isset($_POST['country_id'])){
		$country_id=implode(',',$_POST['country_id']);
	}
	else
	{
		$country_id='';
	}
	if(isset($_POST['state_id'])){
		$state_id=implode(',',$_POST['state_id']);
	}
	else
	{
		$state_id='';
	}
	
	if(isset($_POST['city_id'])){
		$city_id=implode(',',$_POST['city_id']);
	}
	else
	{
		$city_id='';
	}
	if(isset($_POST['education'])){
		$education=implode(',',$_POST['education']);
	}
	else
	{
		$education='';
	}
	
	if(isset($_POST['photo_search'])){
		$photo_search=$_POST['photo_search'];
	}
	else
	{
		$photo_search='';
	}
	
	$_SESSION['gender']=$gender;
	$_SESSION['fromage']=$from_age;
	$_SESSION['toage']=$to_age;
	$_SESSION['fromheight']=$from_height; 
	$_SESSION['toheight']=$to_height;
	$_SESSION['m_status']=$m_status;
	$_SESSION['religion']=$religion_id;
	$_SESSION['caste']=$caste_id;
	$_SESSION['m_tongue']=$m_tongue;
	$_SESSION['country']=$country_id;
	$_SESSION['state']=$state_id;
	$_SESSION['city']=$city_id;
	$_SESSION['education']=$education;
	$_SESSION['photo_search']=$photo_search;
	echo "<script>window.location='search_result';</script>";
}

if(isset($_POST['advance_sub']))
{
	if(isset($_POST['gender'])){
		$gender=$_POST['gender'];
	}
	else
	{
		$gender='';
	}
	if(isset($_POST['from_age'])){
		$from_age=$_POST['from_age'];
	}
	else
	{
		$from_age='';
	}
	if(isset($_POST['to_age'])){
		$to_age=$_POST['to_age'];
	}
	else
	{
		$to_age='';
	}
	if(isset($_POST['from_height'])){
		$from_height=$_POST['from_height'];
	}
	else
	{
		$from_height='';
	}
	if(isset($_POST['to_height'])){
		$to_height=$_POST['to_height'];
	}
	else
	{
		$to_height='';
	}
	if(isset($_POST['m_status'])){
		$m_status=implode(',',$_POST['m_status']);
	}
	else
	{
		$m_status='';
	}
	
	if(isset($_POST['physical_status'])){
		$physical_status=implode(',',$_POST['physical_status']);
	}
	else
	{
		$physical_status='';
	}
	
	
	
	if(isset($_POST['religion_id'])){
		$religion_id=implode(',',$_POST['religion_id']);
	}
	else
	{
		$religion_id='';
	}
	if(isset($_POST['caste_id'])){
		$caste_id=implode(',',$_POST['caste_id']);
	}
	else
	{
		$caste_id='';
	}
	if(isset($_POST['m_tongue'])){
		$m_tongue=implode(',',$_POST['m_tongue']);
	}
	else
	{
		$m_tongue='';
	}
	
	
	if(isset($_POST['country_id'])){
		$country_id=implode(',',$_POST['country_id']);
	}
	else
	{
		$country_id='';
	}
	if(isset($_POST['state_id'])){
		$state_id=implode(',',$_POST['state_id']);
	}
	else
	{
		$state_id='';
	}
	
	if(isset($_POST['city_id'])){
		$city_id=implode(',',$_POST['city_id']);
	}
	else
	{
		$city_id='';
	}
	if(isset($_POST['education'])){
		$education=implode(',',$_POST['education']);
	}
	else
	{
		$education='';
	}
	if(isset($_POST['occupation'])){
		$occupation=implode(',',$_POST['occupation']);
	}
	else
	{
		$occupation='';
	}
	if(isset($_POST['annual_income'])){
		$annual_income=$_POST['annual_income'];
	}
	else
	{
		$annual_income='';	
	}
	
	
	if(isset($_POST['star'])){
		$star=implode(',',$_POST['star']);
	}
	else
	{
		$star='';
	}
	
	if(isset($_POST['manglik'])){
		$manglik=$_POST['manglik'];
	}
	else
	{
		$manglik='';
	}
	
	$_SESSION['gender']=$gender;
	$_SESSION['fromage']=$from_age;
	$_SESSION['toage']=$to_age;
	$_SESSION['fromheight']=$from_height; 
	$_SESSION['toheight']=$to_height;
	$_SESSION['m_status']=$m_status;
	$_SESSION['physical_status']=$physical_status;
	$_SESSION['religion']=$religion_id;
	$_SESSION['caste']=$caste_id;
	$_SESSION['m_tongue']=$m_tongue;
	$_SESSION['country']=$country_id;
	$_SESSION['state']=$state_id;
	$_SESSION['city']=$city_id;
	$_SESSION['education']=$education;
	$_SESSION['occupation']=$occupation;
	$_SESSION['annual_income']=$annual_income;
	$_SESSION['star']=$star;
	$_SESSION['manglik']=$manglik;	
	
	echo "<script>window.location='search_result';</script>";
}

if(isset($_POST['keyword_sub']))
{
	if(isset($_POST['keyword']))
	{
		$keyword=$_POST['keyword'];
	}
	else
	{
		$keyword='';
	}
	if(isset($_POST['photo_search']))
	{
		$photo_search=$_POST['photo_search'];	
	}
	else
	{
		$photo_search='';
	}
	
	$_SESSION['keyword']=$keyword;
	$_SESSION['photo_search']=$photo_search;
	
	echo "<script>window.location='search_result';</script>";		
}

if(isset($_POST['location_sub']))
{
	
	
	if(isset($_POST['gender'])){
		$gender=$_POST['gender'];
	}
	else
	{
		$gender='';
	}
	if(isset($_POST['country_id'])){
		$country_id=implode(',',$_POST['country_id']);
	}
	else
	{
		$country_id='';
	}
	if(isset($_POST['state_id'])){
		$state_id=implode(',',$_POST['state_id']);
	}
	else
	{
		$state_id='';
	}
	
	if(isset($_POST['city_id'])){
		$city_id=implode(',',$_POST['city_id']);
	}
	else
	{
		$city_id='';
	}
	if(isset($_POST['photo_search'])){
		$photo_search=$_POST['photo_search'];
	}
	else
	{
		$photo_search='';
	}
	$_SESSION['gender']=$gender;
	$_SESSION['country']=$country_id;
	$_SESSION['state']=$state_id;
	$_SESSION['city']=$city_id;
	$_SESSION['photo_search']=$photo_search;

	echo "<script>window.location='search_result';</script>";

}

if(isset($_POST['occupation_sub']))
{
	
	if(isset($_POST['gender'])){
		$gender=$_POST['gender'];
	}
	else
	{
		$gender='';
	}
	
	if(isset($_POST['education'])){
		$education=implode(',',$_POST['education']);
	}
	else
	{
		$education='';
	}
	if(isset($_POST['occupation'])){
		$occupation=implode(',',$_POST['occupation']);
	}
	else
	{
		$occupation='';
	}
	if(isset($_POST['annual_income'])){
		$annual_income=$_POST['annual_income'];
	}
	else
	{
		$annual_income='';	
	}
	
	$_SESSION['gender']=$gender;
	$_SESSION['education']=$education;
	$_SESSION['occupation']=$occupation;
	$_SESSION['annual_income']=$annual_income;
	
	echo "<script>window.location='search_result';</script>";
}
?>
<?php
if ($_SESSION['gender123'] == 'Male') {
$my_gender = 'Male';
} elseif ($_SESSION['gender123'] == 'Female') {
$my_gender = 'Female';
}
?>
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
        
        <!--- BEST TAB VIEW FOR MOBILE SCREEN CSS--->
        <link rel="stylesheet" href="css/bootstrap-responsive-tabs.css">
        <!--- BEST TAB VIEW FOR MOBILE SCREEN CSS END--->
        
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
  			<div id="wrap">
  				<div id="main">
     				<!-- HEADER -->
                    <?php include "parts/header.php"; ?>
                    <?php include "parts/menu-aft-login.php"; ?>
                    <!-- HEADER END-->
    				<div class="container">
                    	
    					<div class="row">
        					<div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 gt-margin-bottom-20">
            					<h2>Search Options</h2>
                				<p>Search perfect partner with our multiple search options which help you to find out perfect partner for life.</p>
            				</div>
            				<div class="clearfix"></div>
        					<div class="col-xs-16 col-lg-16 col-xxl-12 col-xl-12 gt-search-opt gt-margin-bottom-20">
        						<div role="tabpanel">
			 						<ul class="nav nav-tabs responsive-tabs" role="tablist">
                        <li role="presentation" class="<?php if(isset($_GET['gt-quick-search'])){ echo "active";}?>">
                        	<a href="#quick-search" aria-controls="quick-search" role="tab" data-toggle="tab">
                            	Quick Search
                            </a>
                        </li>
                        
    					<li role="presentation" class="<?php if(isset($_GET['gt-basic-search'])){ echo "active";}?>">
                        	<a href="#basic-search" aria-controls="basic-search" role="tab" data-toggle="tab">
                            	Basic Search
                            </a>
                        </li>
    					<li role="presentation" class="<?php if(isset($_GET['gt-advance-search'])){ echo "active";}?>">
                        	<a href="#adv-search" aria-controls="adv-search" role="tab" data-toggle="tab">
                            	Advanced Search
                            </a>
                        </li>
    					<li role="presentation" class="<?php if(isset($_GET['gt-keyword-search'])){ echo "active";}?>">
                        	<a href="#key-search" aria-controls="key-search" role="tab" data-toggle="tab">
                            	Keyword Search
                            </a>
                        </li>
    					<li role="presentation" class="<?php if(isset($_GET['gt-location-search'])){ echo "active";}?>">
                        	<a href="#loc-search" aria-controls="loc-search" role="tab" data-toggle="tab">
                            	location Search
                            </a>
                        </li>
                        <li role="presentation" class="<?php if(isset($_GET['gt-occupation-search'])){ echo "active";}?>">
                        	<a href="#oct-search" aria-controls="oct-search" role="tab" data-toggle="tab">
                            	Occupation Search
                            </a>
                        </li>
  					</ul>
					<div class="tab-content">
                        <div role="tabpanel" class="tab-pane <?php if(isset($_GET['gt-quick-search'])){ echo "active";}?>" id="quick-search">
                        	<div class="row">
                        		<div class="col-xxl-14 col-xxl-offset-1">
                                	<h3>
                                    	Quick Search
                                    </h3>
                                    <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                                    	Searches profiles and provide you suitable profiles quickly.
                                    </p>
									<form action="" id="quick_search_form" method="post">                        			
                                       <?php 
										if(!isset($_SESSION['gender123']))
										{
										?>
                                        <div class="form-group gt-margin-top-15" >
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Gender
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select class="gt-form-control flat" name="gender">
                                                        <option value="Female">Bride</option>
                                                        <option value="Male">Groom</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Age
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <select class="gt-form-control flat" name="from_age">
                                                                <option value="18">18 Years</option>
                                                                <option value="19">19 Years</option>
                                                                <option value="20" selected="selected">20 Years</option>
                                                                <option value="21">21 Years</option>
                                                                <option value="22">22 Years</option>
                                                                <option value="23">23 Years</option>
                                                                <option value="24">24 Years</option>
                                                                <option value="25">25 Years</option>
                                                                <option value="26">26 Years</option>
                                                                <option value="27">27 Years</option>
                                                                <option value="28">28 Years</option>
                                                                <option value="29">29 Years</option>
                                                                <option value="30">30 Years</option>
                                                                <option value="31">31 Years</option>
                                                                <option value="32">32 Years</option>
                                                                <option value="33">33 Years</option>
                                                                <option value="34">34 Years</option>
                                                                <option value="35">35 Years</option>
                                                                <option value="36">36 Years</option>
                                                                <option value="37">37 Years</option>
                                                                <option value="38">38 Years</option>
                                                                <option value="39">39 Years</option>
                                                                <option value="40">40 Years</option>
                                                                <option value="41">41 Years</option>
                                                                <option value="42">42 Years</option>
                                                                <option value="43">43 Years</option>
                                                                <option value="44">44 Years</option>
                                                                <option value="45">45 Years</option>
                                                                <option value="46">46 Years</option>
                                                                <option value="47">47 Years</option>
                                                                <option value="48">48 Years</option>
                                                                <option value="49">49 Years</option>
                                                                <option value="50">50 Years</option>
                                                                <option value="51">51 Years</option>
                                                                <option value="52">52 Years</option>
                                                                <option value="53">53 Years</option>
                                                                <option value="54">54 Years</option>
                                                                <option value="55">55 Years</option>
                                                                <option value="56">56 Years</option>
                                                                <option value="57">57 Years</option>
                                                                <option value="58">58 Years</option>
                                                                <option value="59">59 Years</option>
                                                                <option value="60">60 Years</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-4 text-center gt-margin-top-10">
                                                            To
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <select class="gt-form-control flat" name="to_age">
                                                                <option value="18">18 Years</option>
                                                                <option value="19">19 Years</option>
                                                                <option value="20">20 Years</option>
                                                                <option value="21">21 Years</option>
                                                                <option value="22">22 Years</option>
                                                                <option value="23">23 Years</option>
                                                                <option value="24">24 Years</option>
                                                                <option value="25">25 Years</option>
                                                                <option value="26">26 Years</option>
                                                                <option value="27">27 Years</option>
                                                                <option value="28">28 Years</option>
                                                                <option value="29">29 Years</option>
                                                                <option value="30" selected="selected">30 Years</option>
                                                                <option value="31">31 Years</option>
                                                                <option value="32">32 Years</option>
                                                                <option value="33">33 Years</option>
                                                                <option value="34">34 Years</option>
                                                                <option value="35">35 Years</option>
                                                                <option value="36">36 Years</option>
                                                                <option value="37">37 Years</option>
                                                                <option value="38">38 Years</option>
                                                                <option value="39">39 Years</option>
                                                                <option value="40">40 Years</option>
                                                                <option value="41">41 Years</option>
                                                                <option value="42">42 Years</option>
                                                                <option value="43">43 Years</option>
                                                                <option value="44">44 Years</option>
                                                                <option value="45">45 Years</option>
                                                                <option value="46">46 Years</option>
                                                                <option value="47">47 Years</option>
                                                                <option value="48">48 Years</option>
                                                                <option value="49">49 Years</option>
                                                                <option value="50">50 Years</option>
                                                                <option value="51">51 Years</option>
                                                                <option value="52">52 Years</option>
                                                                <option value="53">53 Years</option>
                                                                <option value="54">54 Years</option>
                                                                <option value="55">55 Years</option>
                                                                <option value="56">56 Years</option>
                                                                <option value="57">57 Years</option>
                                                                <option value="58">58 Years</option>
                                                                <option value="59">59 Years</option>
                                                                <option value="60">60 Years</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                       Religion
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Religion..." class="chosen-select gt-form-control flat" multiple tabindex="5" id="religion_id" name="religion_id[]">
                                                        <?php
														   $SQL_STATEMENT_preligion =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
														  
														   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_preligion))
														   {
														?>
															 <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
														<?php 
															} 
														?>
                                                    </select><div id="CasteDivloader"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Caste
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Caste..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="caste_id" name="caste_id[]">
                                                        <option value=""></option>
                                                        
                                                      </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="submit" value="Search Now" name="quick_sub" class="btn gt-btn-green">
                                                      <?php 
												if(isset($_SESSION['user_id']))
												{
												?>
                                                <a class="btn gt-btn-green gt-cursor" data-toggle="modal" data-target="#myModal" onClick="save_search();"><i class="fa fa-floppy-o gt-margin-right-5"></i>Saved Search</a>
                                                
                                                <?php }?>
                                        </div>
                                    </form>
                            	</div>
                            </div>
                        </div>
    					<div role="tabpanel" class="tab-pane <?php if(isset($_GET['gt-basic-search'])){ echo "active";}?>" id="basic-search">
                        	<div class="row">
                        		<div class="col-xxl-14 col-xxl-offset-1">
                                	<h3>
                                    	Basic Search
                                    </h3>
                                    <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                                    	Searches to provide suitable profiles.
                                    </p>
                        			<form action="" id="baisc_search_form" method="post">
									<?php 
									if(!isset($_SESSION['gender123']))
									{
									?>
                                        <div class="form-group gt-margin-top-15" >
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Gender
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select class="gt-form-control flat" name="gender">
                                                        <option value="Female">Bride</option>
                                                        <option value="Male">Groom</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Age
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <select class="gt-form-control flat" name="from_age">
                                                                <option value="18">18 Years</option>
                                                                <option value="19">19 Years</option>
                                                                <option value="20" selected="selected">20 Years</option>
                                                                <option value="21">21 Years</option>
                                                                <option value="22">22 Years</option>
                                                                <option value="23">23 Years</option>
                                                                <option value="24">24 Years</option>
                                                                <option value="25">25 Years</option>
                                                                <option value="26">26 Years</option>
                                                                <option value="27">27 Years</option>
                                                                <option value="28">28 Years</option>
                                                                <option value="29">29 Years</option>
                                                                <option value="30">30 Years</option>
                                                                <option value="31">31 Years</option>
                                                                <option value="32">32 Years</option>
                                                                <option value="33">33 Years</option>
                                                                <option value="34">34 Years</option>
                                                                <option value="35">35 Years</option>
                                                                <option value="36">36 Years</option>
                                                                <option value="37">37 Years</option>
                                                                <option value="38">38 Years</option>
                                                                <option value="39">39 Years</option>
                                                                <option value="40">40 Years</option>
                                                                <option value="41">41 Years</option>
                                                                <option value="42">42 Years</option>
                                                                <option value="43">43 Years</option>
                                                                <option value="44">44 Years</option>
                                                                <option value="45">45 Years</option>
                                                                <option value="46">46 Years</option>
                                                                <option value="47">47 Years</option>
                                                                <option value="48">48 Years</option>
                                                                <option value="49">49 Years</option>
                                                                <option value="50">50 Years</option>
                                                                <option value="51">51 Years</option>
                                                                <option value="52">52 Years</option>
                                                                <option value="53">53 Years</option>
                                                                <option value="54">54 Years</option>
                                                                <option value="55">55 Years</option>
                                                                <option value="56">56 Years</option>
                                                                <option value="57">57 Years</option>
                                                                <option value="58">58 Years</option>
                                                                <option value="59">59 Years</option>
                                                                <option value="60">60 Years</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-4 text-center gt-margin-top-10">
                                                            To
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <select class="gt-form-control flat" name="to_age">
                                                                <option value="18">18 Years</option>
                                                                <option value="19">19 Years</option>
                                                                <option value="20">20 Years</option>
                                                                <option value="21">21 Years</option>
                                                                <option value="22">22 Years</option>
                                                                <option value="23">23 Years</option>
                                                                <option value="24">24 Years</option>
                                                                <option value="25">25 Years</option>
                                                                <option value="26">26 Years</option>
                                                                <option value="27">27 Years</option>
                                                                <option value="28">28 Years</option>
                                                                <option value="29">29 Years</option>
                                                                <option value="30" selected="selected">30 Years</option>
                                                                <option value="31">31 Years</option>
                                                                <option value="32">32 Years</option>
                                                                <option value="33">33 Years</option>
                                                                <option value="34">34 Years</option>
                                                                <option value="35">35 Years</option>
                                                                <option value="36">36 Years</option>
                                                                <option value="37">37 Years</option>
                                                                <option value="38">38 Years</option>
                                                                <option value="39">39 Years</option>
                                                                <option value="40">40 Years</option>
                                                                <option value="41">41 Years</option>
                                                                <option value="42">42 Years</option>
                                                                <option value="43">43 Years</option>
                                                                <option value="44">44 Years</option>
                                                                <option value="45">45 Years</option>
                                                                <option value="46">46 Years</option>
                                                                <option value="47">47 Years</option>
                                                                <option value="48">48 Years</option>
                                                                <option value="49">49 Years</option>
                                                                <option value="50">50 Years</option>
                                                                <option value="51">51 Years</option>
                                                                <option value="52">52 Years</option>
                                                                <option value="53">53 Years</option>
                                                                <option value="54">54 Years</option>
                                                                <option value="55">55 Years</option>
                                                                <option value="56">56 Years</option>
                                                                <option value="57">57 Years</option>
                                                                <option value="58">58 Years</option>
                                                                <option value="59">59 Years</option>
                                                                <option value="60">60 Years</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Height
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                            	<div class="row">
                                                	<div class="col-xs-6">
                                                    	<select class="gt-form-control flat" name="from_height">
                                                			<option value="48">Below 4ft</option>
                                                            <option value="54" selected>4ft 06in</option>
                                                            <option value="55">4ft 07in</option>
                                                            <option value="56">4ft 08in</option>
                                                            <option value="57">4ft 09in</option>
                                                            <option value="58">4ft 10in</option>
                                                            <option value="59">4ft 11in</option>
                                                            <option value="60">5ft</option>
                                                            <option value="61">5ft 01in</option>
                                                            <option value="62">5ft 02in</option>
                                                            <option value="63">5ft 03in</option>
                                                            <option value="64">5ft 04in</option>
                                                            <option value="65">5ft 05in</option>
                                                            <option value="66">5ft 06in</option>
                                                            <option value="67">5ft 07in</option>
                                                            <option value="68">5ft 08in</option>
                                                            <option value="69">5ft 09in</option>
                                                            <option value="70">5ft 10in</option>
                                                            <option value="71">5ft 11in</option>
                                                            <option value="72">6ft</option>
                                                            <option value="73">6ft 01in</option>
                                                            <option value="74">6ft 02in</option>
                                                            <option value="75">6ft 03in</option>
                                                            <option value="76">6ft 04in</option>
                                                            <option value="77">6ft 05in</option>
                                                            <option value="78">6ft 06in</option>
                                                            <option value="79">6ft 07in</option>
                                                            <option value="80">6ft 08in</option>
                                                            <option value="81">6ft 09in</option>
                                                            <option value="82">6ft 10in</option>
                                                            <option value="83">6ft 11in</option>
                                                            <option value="84">7ft</option>
                                                            <option value="85">Above 7ft</option>
                                                		</select>
                                                    </div>
                                                    <div class="col-xs-4 text-center gt-margin-top-10">
                                                    	To
                                                    </div>
                                                    <div class="col-xs-6">
                                                    	<select class="gt-form-control flat" name="to_height">
                                                			<option value="48">Below 4ft</option>
                                                            <option value="54">4ft 06in</option>
                                                            <option value="55">4ft 07in</option>
                                                            <option value="56">4ft 08in</option>
                                                            <option value="57">4ft 09in</option>
                                                            <option value="58">4ft 10in</option>
                                                            <option value="59">4ft 11in</option>
                                                            <option value="60">5ft</option>
                                                            <option value="61">5ft 01in</option>
                                                            <option value="62">5ft 02in</option>
                                                            <option value="63">5ft 03in</option>
                                                            <option value="64" selected>5ft 04in</option>
                                                            <option value="65">5ft 05in</option>
                                                            <option value="66">5ft 06in</option>
                                                            <option value="67">5ft 07in</option>
                                                            <option value="68">5ft 08in</option>
                                                            <option value="69">5ft 09in</option>
                                                            <option value="70">5ft 10in</option>
                                                            <option value="71">5ft 11in</option>
                                                            <option value="72">6ft</option>
                                                            <option value="73">6ft 01in</option>
                                                            <option value="74">6ft 02in</option>
                                                            <option value="75">6ft 03in</option>
                                                            <option value="76">6ft 04in</option>
                                                            <option value="77">6ft 05in</option>
                                                            <option value="78">6ft 06in</option>
                                                            <option value="79">6ft 07in</option>
                                                            <option value="80">6ft 08in</option>
                                                            <option value="81">6ft 09in</option>
                                                            <option value="82">6ft 10in</option>
                                                            <option value="83">6ft 11in</option>
                                                            <option value="84">7ft</option>
                                                            <option value="85">Above 7ft</option>
                                                		</select>
                                                    </div>
                                                </div>
                                    		</div>
                                		</div>
                                	</div>
                                    <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Marital status
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select data-placeholder="Choose a Marital Status..." class="chosen-select gt-form-control flat" multiple tabindex="4" name="m_status[]">
                                                       
                                                        <option value="Never Married">Never Married</option>
                                                        <?php if($my_gender=='Male'){ ?>
                                                        <option value="Widow">Widow</option>
                                                        <?php } else{ ?>
                                                        <option value="Widower">Widower</option>
                                                        <?php } ?>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Awaiting Divorce">Awaiting Divorce</option>
                                                </select>
                                    		</div>
                                		</div>
                                	</div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Religion
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Religion..." class="chosen-select gt-form-control flat" multiple tabindex="5" id="religion_id_basic" name="religion_id[]">
                                                        <?php
														   $SQL_STATEMENT_preligion =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
														  
														   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_preligion))
														   {
														?>
															 <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
														<?php 
															} 
														?>
                                                    </select><div id="CasteDivloaderbasic"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Caste
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select data-placeholder="Choose a Caste..." class="chosen-select gt-form-control flat" multiple id="caste_id_basic" name="caste_id[]">
                                                	
                                                </select>
                                    		</div>
                                		</div>
                                	</div>
                                    <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Country living in
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select data-placeholder="Choose a Country..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="country_id_bsc" name="country_id[]">
                                                   <option value=""></option>
                                                   <?php
												   $SQL_STATEMENT_pcountry =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'");
												   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_pcountry))
												   {
												?>
												   <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
												<?php } ?>
                                                </select><div id="stateDivloader_bsc"></div>
                                    		</div>
                                		</div>
                                	</div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        State living in
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a State..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="state_id_bsc" name="state_id[]">
                                                        <option value=""></option>
                                                       
                                                    </select><div id="cityDivloader_bsc"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        City living in
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a City..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="city_id_bsc" name="city_id[]">
                                                        <option value=""></option>
                                               
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Education
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Education..." class="chosen-select gt-form-control flat" multiple tabindex="4" name="education[]">
                                                        <option value=""></option>
                                                        <?php
														   $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
														   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu))
														   {
														   ?>
														   <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
														 <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Photo settings
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select class="gt-form-control flat" name="photo_search">
                                                	<option value="">Does Not Matter</option>
                                                    <option value="Yes">With Photo</option>
                                                    
                                                </select>
                                    		</div>
                                		</div>
                                	</div>
                                    <div class="form-group text-center">
                                        <input type="submit" value="Search Now" name="basic_sub" class="btn gt-btn-green">
                                                     <?php 
												if(isset($_SESSION['user_id']))
												{
												?>
                                        <a class="btn gt-btn-green gt-cursor" data-toggle="modal" data-target="#myModal" onClick="save_search();"><i class="fa fa-floppy-o gt-margin-right-5"></i>Saved Search</a>
                                                
                                                <?php }?>
                                                
                                     </div>
                                    </form> 
                            	</div>
                            </div>
                        </div>
    					<div role="tabpanel" class="tab-pane <?php if(isset($_GET['gt-advance-search'])){ echo "active";}?>" id="adv-search">
                        	<div class="row">
                        		<div class="col-xxl-14 col-xxl-offset-1">
                                	<h3>
                                    	Advanced Search
                                    </h3>
                                    <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                                    	Advance search contain criteria that helps you to find a suitable profile.

                                    </p>
                        			<form action="" id="baisc_search_form" method="post">
									<?php 
									if(!isset($_SESSION['gender123']))
									{
									?>
                                        <div class="form-group gt-margin-top-15" >
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Gender
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select class="gt-form-control flat" name="gender">
                                                        <option value="Female">Bride</option>
                                                        <option value="Male">Groom</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Age
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <select class="gt-form-control flat" name="from_age">
                                                                <option value="18">18 Years</option>
                                                                <option value="19">19 Years</option>
                                                                <option value="20" selected="selected">20 Years</option>
                                                                <option value="21">21 Years</option>
                                                                <option value="22">22 Years</option>
                                                                <option value="23">23 Years</option>
                                                                <option value="24">24 Years</option>
                                                                <option value="25">25 Years</option>
                                                                <option value="26">26 Years</option>
                                                                <option value="27">27 Years</option>
                                                                <option value="28">28 Years</option>
                                                                <option value="29">29 Years</option>
                                                                <option value="30">30 Years</option>
                                                                <option value="31">31 Years</option>
                                                                <option value="32">32 Years</option>
                                                                <option value="33">33 Years</option>
                                                                <option value="34">34 Years</option>
                                                                <option value="35">35 Years</option>
                                                                <option value="36">36 Years</option>
                                                                <option value="37">37 Years</option>
                                                                <option value="38">38 Years</option>
                                                                <option value="39">39 Years</option>
                                                                <option value="40">40 Years</option>
                                                                <option value="41">41 Years</option>
                                                                <option value="42">42 Years</option>
                                                                <option value="43">43 Years</option>
                                                                <option value="44">44 Years</option>
                                                                <option value="45">45 Years</option>
                                                                <option value="46">46 Years</option>
                                                                <option value="47">47 Years</option>
                                                                <option value="48">48 Years</option>
                                                                <option value="49">49 Years</option>
                                                                <option value="50">50 Years</option>
                                                                <option value="51">51 Years</option>
                                                                <option value="52">52 Years</option>
                                                                <option value="53">53 Years</option>
                                                                <option value="54">54 Years</option>
                                                                <option value="55">55 Years</option>
                                                                <option value="56">56 Years</option>
                                                                <option value="57">57 Years</option>
                                                                <option value="58">58 Years</option>
                                                                <option value="59">59 Years</option>
                                                                <option value="60">60 Years</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-4 text-center gt-margin-top-10">
                                                            To
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <select class="gt-form-control flat" name="to_age">
                                                                <option value="18">18 Years</option>
                                                                <option value="19">19 Years</option>
                                                                <option value="20">20 Years</option>
                                                                <option value="21">21 Years</option>
                                                                <option value="22">22 Years</option>
                                                                <option value="23">23 Years</option>
                                                                <option value="24">24 Years</option>
                                                                <option value="25">25 Years</option>
                                                                <option value="26">26 Years</option>
                                                                <option value="27">27 Years</option>
                                                                <option value="28">28 Years</option>
                                                                <option value="29">29 Years</option>
                                                                <option value="30" selected="selected">30 Years</option>
                                                                <option value="31">31 Years</option>
                                                                <option value="32">32 Years</option>
                                                                <option value="33">33 Years</option>
                                                                <option value="34">34 Years</option>
                                                                <option value="35">35 Years</option>
                                                                <option value="36">36 Years</option>
                                                                <option value="37">37 Years</option>
                                                                <option value="38">38 Years</option>
                                                                <option value="39">39 Years</option>
                                                                <option value="40">40 Years</option>
                                                                <option value="41">41 Years</option>
                                                                <option value="42">42 Years</option>
                                                                <option value="43">43 Years</option>
                                                                <option value="44">44 Years</option>
                                                                <option value="45">45 Years</option>
                                                                <option value="46">46 Years</option>
                                                                <option value="47">47 Years</option>
                                                                <option value="48">48 Years</option>
                                                                <option value="49">49 Years</option>
                                                                <option value="50">50 Years</option>
                                                                <option value="51">51 Years</option>
                                                                <option value="52">52 Years</option>
                                                                <option value="53">53 Years</option>
                                                                <option value="54">54 Years</option>
                                                                <option value="55">55 Years</option>
                                                                <option value="56">56 Years</option>
                                                                <option value="57">57 Years</option>
                                                                <option value="58">58 Years</option>
                                                                <option value="59">59 Years</option>
                                                                <option value="60">60 Years</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Height
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                            	<div class="row">
                                                	<div class="col-xs-6">
                                                    	<select class="gt-form-control flat" name="from_height">
                                                			<option value="48">Below 4ft</option>
                                                            <option value="54" selected>4ft 06in</option>
                                                            <option value="55">4ft 07in</option>
                                                            <option value="56">4ft 08in</option>
                                                            <option value="57">4ft 09in</option>
                                                            <option value="58">4ft 10in</option>
                                                            <option value="59">4ft 11in</option>
                                                            <option value="60">5ft</option>
                                                            <option value="61">5ft 01in</option>
                                                            <option value="62">5ft 02in</option>
                                                            <option value="63">5ft 03in</option>
                                                            <option value="64">5ft 04in</option>
                                                            <option value="65">5ft 05in</option>
                                                            <option value="66">5ft 06in</option>
                                                            <option value="67">5ft 07in</option>
                                                            <option value="68">5ft 08in</option>
                                                            <option value="69">5ft 09in</option>
                                                            <option value="70">5ft 10in</option>
                                                            <option value="71">5ft 11in</option>
                                                            <option value="72">6ft</option>
                                                            <option value="73">6ft 01in</option>
                                                            <option value="74">6ft 02in</option>
                                                            <option value="75">6ft 03in</option>
                                                            <option value="76">6ft 04in</option>
                                                            <option value="77">6ft 05in</option>
                                                            <option value="78">6ft 06in</option>
                                                            <option value="79">6ft 07in</option>
                                                            <option value="80">6ft 08in</option>
                                                            <option value="81">6ft 09in</option>
                                                            <option value="82">6ft 10in</option>
                                                            <option value="83">6ft 11in</option>
                                                            <option value="84">7ft</option>
                                                            <option value="85">Above 7ft</option>
                                                		</select>
                                                    </div>
                                                    <div class="col-xs-4 text-center gt-margin-top-10">
                                                    	To
                                                    </div>
                                                    <div class="col-xs-6">
                                                    	<select class="gt-form-control flat" name="to_height">
                                                			<option value="48">Below 4ft</option>
                                                            <option value="54">4ft 06in</option>
                                                            <option value="55">4ft 07in</option>
                                                            <option value="56">4ft 08in</option>
                                                            <option value="57">4ft 09in</option>
                                                            <option value="58">4ft 10in</option>
                                                            <option value="59">4ft 11in</option>
                                                            <option value="60">5ft</option>
                                                            <option value="61">5ft 01in</option>
                                                            <option value="62">5ft 02in</option>
                                                            <option value="63">5ft 03in</option>
                                                            <option value="64" selected>5ft 04in</option>
                                                            <option value="65">5ft 05in</option>
                                                            <option value="66">5ft 06in</option>
                                                            <option value="67">5ft 07in</option>
                                                            <option value="68">5ft 08in</option>
                                                            <option value="69">5ft 09in</option>
                                                            <option value="70">5ft 10in</option>
                                                            <option value="71">5ft 11in</option>
                                                            <option value="72">6ft</option>
                                                            <option value="73">6ft 01in</option>
                                                            <option value="74">6ft 02in</option>
                                                            <option value="75">6ft 03in</option>
                                                            <option value="76">6ft 04in</option>
                                                            <option value="77">6ft 05in</option>
                                                            <option value="78">6ft 06in</option>
                                                            <option value="79">6ft 07in</option>
                                                            <option value="80">6ft 08in</option>
                                                            <option value="81">6ft 09in</option>
                                                            <option value="82">6ft 10in</option>
                                                            <option value="83">6ft 11in</option>
                                                            <option value="84">7ft</option>
                                                            <option value="85">Above 7ft</option>
                                                		</select>
                                                    </div>
                                                </div>
                                    		</div>
                                		</div>
                                	</div>
                                        <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Marital status
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select data-placeholder="Choose a Marital Status..." class="chosen-select gt-form-control flat" multiple tabindex="4" name="m_status[]">
                                                       
                                                        <option value="Never Married">Never Married</option>
                                                        <?php if($my_gender=='Male'){ ?>
                                                        <option value="Widow">Widow</option>
                                                        <?php } else{ ?>
                                                        <option value="Widower">Widower</option>
                                                        <?php } ?>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Awaiting Divorce">Awaiting Divorce</option>
                                                </select>
                                    		</div>
                                		</div>
                                	</div>
                                        <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Physical status
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select data-placeholder="Choose a Physical Status..." class="chosen-select gt-form-control flat" multiple tabindex="4" name="physical_status[]">
                                                       
                                                         <option value="Normal">Normal</option>
                                    					 <option value="Physically-challenged">Physically-challenged</option>
                                                </select>
                                    		</div>
                                		</div>
                                	</div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                      	Religion
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Religion..." class="chosen-select gt-form-control flat" multiple tabindex="5" id="religion_id_adv" name="religion_id[]">
                                                        <?php
														   $SQL_STATEMENT_preligion =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
														  
														   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_preligion))
														   {
														?>
															 <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
														<?php 
															} 
														?>
                                                    </select><div id="CasteDivloaderadv"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Caste
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Caste..." class="chosen-select gt-form-control flat" multiple id="caste_id_adv" name="caste_id[]">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="gt-text-orange gt-border-bottom-smoke-white gt-padding-bottom-15">
                                            Location Details
                                        </h4>
                                        <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Country living in
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select data-placeholder="Choose a Country..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="country_id_adv" name="country_id[]">
                                                   <option value=""></option>
                                                   <?php
												   $SQL_STATEMENT_pcountry =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'");
												   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_pcountry))
												   {
												?>
												   <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
												<?php } ?>
                                                </select><div id="stateDivloader_adv"></div>
                                    		</div>
                                		</div>
                                	</div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        State living in
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a State..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="state_id_adv" name="state_id[]">
                                                        <option value=""></option>
                                                       
                                                    </select><div id="cityDivloader_adv"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        City living in
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a City..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="city_id_adv" name="city_id[]">
                                                        <option value=""></option>
                                               
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="gt-text-orange gt-border-bottom-smoke-white gt-padding-bottom-15">
                                            Education / Occupation / income Details
                                        </h4>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Education
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Education..." class="chosen-select gt-form-control flat" multiple tabindex="4" name="education[]">
                                                        <option value=""></option>
                                                        <?php
														   $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
														   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu))
														   {
														   ?>
														   <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
														 <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Occupation
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Occupation..." class="chosen-select gt-form-control flat" multiple name="occupation[]" >
                                                        <option value=""></option>
                                                        <?php
															$SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
															
															while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp))
															{
																?>
																<option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>"><?php echo $DatabaseCo->dbRow->ocp_name; ?></option>
													   <?php } ?>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Annual income
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select class="gt-form-control flat" name="annual_income" >
                                                        <option value="">Select Annual Income</option>
                                                        <option value="Rs. 10,000 - 50,000">Rs. 10,000 - 50,000</option>
                                                        <option value="Rs. 50,000 - 1,00,000">Rs. 50,000 - 1,00,000</option>
                                                        <option value="Rs. 1,00,000 - 2,00,000">Rs. 1,00,000 - 2,00,000</option>
                                                        <option value="Rs. 2,00,000 - 5,00,000">Rs. 2,00,000 - 5,00,000</option>
                                                        <option value="Rs. 5,00,000 - 10,00,000">Rs. 5,00,000 - 10,00,000</option>
                                                        <option value="Rs. 10,00,000 - 50,00,000">Rs. 10,00,000 - 50,00,000</option>
                                                        <option value="Rs. 50,00,000 - 1,00,00,000">Rs. 50,00,000 - 1,00,00,000</option>
                                                        <option value="Above Rs. 1,00,00,000">Above Rs. 1,00,00,000</option>
                                                        <option value="Does not matter">Does not matter</option>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="gt-text-orange gt-border-bottom-smoke-white gt-padding-bottom-15">
                                            Horoscope Details
                                        </h4>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Star
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Star..." class="chosen-select gt-form-control flat" multiple name="star[]">
                                                        <option value="">Does not matter</option>
                                                        <option value="ANUSHAM">ANUSHAM</option>
                                                        <option value="ASWINI">ASWINI</option>
                                                        <option value="AVITTAM">AVITTAM</option>
                                                        <option value="AYILYAM">AYILYAM</option>
                                                        <option value="BHARANI">BHARANI</option>
                                                        <option value="CHITHIRAI">CHITHIRAI</option>
                                                        <option value="HASTHAM">HASTHAM</option>
                                                        <option value="KETTAI">KETTAI</option>
                                                        <option value="KRITHIGAI">KRITHIGAI</option>
                                                        <option value="MAHAM">MAHAM</option>
                                                        <option value="MOOLAM">MOOLAM</option>
                                                        <option value="MRIGASIRISHAM">MRIGASIRISHAM</option>
                                                        <option value="POOSAM">POOSAM</option>
                                                        <option value="PUNARPUSAM">PUNARPUSAM</option>
                                                        <option value="PURADAM">PURADAM</option>
                                                        <option value="PURAM">PURAM</option>
                                                        <option value="PURATATHI">PURATATHI</option>
                                                        <option value="REVATHI">REVATHI</option>
                                                        <option value="ROHINI">ROHINI</option>
                                                        <option value="SADAYAM">SADAYAM</option>
                                                        <option value="SWATHI">SWATHI</option>
                                                        <option value="THIRUVADIRAI">THIRUVADIRAI</option>
                                                        <option value="THIRUVONAM">THIRUVONAM</option>
                                                        <option value="UTHRADAM">UTHRADAM</option>
                                                        <option value="UTHRAM">UTHRAM</option>
                                                        <option value="UTHRATADHI">UTHRATADHI</option>
                                                        <option value="VISAKAM">VISAKAM</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Manglik
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select class="gt-form-control flat" name="manglik">
                                                        		<option value="">Does Not Matter</option>
            													<option value="Yes">Yes</option>
            													<option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group text-center">
                                            <input type="submit" value="Search Now" name="advance_sub" class="btn gt-btn-green ">
                                                        <?php 
												if(isset($_SESSION['user_id']))
												{
												?>
                                                <a class="btn gt-btn-green gt-cursor" data-toggle="modal" data-target="#myModal" onClick="save_search();"><i class="fa fa-floppy-o gt-margin-right-5"></i>Saved Search</a>
                                                
                                                <?php }?>
                                                
                                     </div>
                                   </form>     
                            	</div>
                            </div>
                        </div>
    					<div role="tabpanel" class="tab-pane <?php if(isset($_GET['gt-keyword-search'])){ echo "active";}?>" id="key-search">
                        	<div class="row">
                        		<div class="col-xxl-14 col-xxl-offset-1">
                                	<h3>
                                    	Keyword Search
                                    </h3>
                                    <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                                    	With keyword search, you can get suitable profiles with specific keywords.
                                    </p>
                        			<form action="" id="baisc_search_form" method="post">
                                		<div class="form-group gt-margin-top-15" >
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Keyword search
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<input type="text" class="gt-form-control flat" name="keyword">
                                                <p class="text-muted ">
                                    			Example - First Name, Last Name, Email id.
                                    			</p>
                                    		</div>
                                            
                                		</div>
                                	</div>
                                    	<div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Photo settings
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select class="gt-form-control flat" name="photo_search">
                                                	<option value="">Does Not Matter</option>
                                                    <option value="Yes">With Photo</option>
                                                    
                                                </select>
                                    		</div>
                                		</div>
                                	</div>
                                    	<div class="form-group text-center">
                                            
                                                <input type="submit" value="Search Now" name="keyword_sub" class="btn gt-btn-green">
                                                     <?php 
												if(isset($_SESSION['user_id']))
												{
												?>
                                                
                                                	<a class="btn gt-btn-green gt-cursor" data-toggle="modal" data-target="#myModal" onClick="save_search();"><i class="fa fa-floppy-o gt-margin-right-5"></i>Saved Search</a>
                                                
                                                <?php }?>
                                             
                                     </div>
                            		</form>
                                </div>
                            </div>
                        </div>
    					<div role="tabpanel" class="tab-pane <?php if(isset($_GET['gt-location-search'])){ echo "active";}?>" id="loc-search">
                        	<div class="row">
                        		<div class="col-xxl-14 col-xxl-offset-1">
                                	<h3>
                                    	Location search
                                    </h3>
                                    <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                                    	With Location search, you can get suitable profiles from specific  location or place.                                    </p>
                        			<form action="" id="location_search_form" method="post">
                                    <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Country living in
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select data-placeholder="Choose a Country..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="country_id_loc" name="country_id[]">
                                                   <option value=""></option>
                                                   <?php
												   $SQL_STATEMENT_pcountry =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'");
												   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_pcountry))
												   {
												?>
												   <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
												<?php } ?>
                                                </select><div id="stateDivloader_loc"></div>
                                    		</div>
                                		</div>
                                	</div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        State living in
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a State..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="state_id_loc" name="state_id[]">
                                                        <option value=""></option>
                                                       
                                                    </select><div id="cityDivloader_loc"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        City living in
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a City..." class="chosen-select gt-form-control flat" multiple tabindex="4" id="city_id_loc" name="city_id[]">
                                                        <option value=""></option>
                                               
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group">
                            			<div class="row">
                                			<div class="col-xxl-6 col-xl-6">
                                    			<label class="gt-margin-top-10">
                                        			Photo settings
                                        		</label>
                                    		</div>
                                    		<div class="col-xxl-10 col-xl-10">
                                    			<select class="gt-form-control flat" name="photo_search">
                                                	<option value="">Does Not Matter</option>
                                                    <option value="Yes">With Photo</option>
                                                    
                                                </select>
                                    		</div>
                                		</div>
                                	</div>
                                    
                                    <div class="form-group text-center">
                                          <input type="submit" value="Search Now" name="location_sub" class="btn gt-btn-green">
                                                       <?php 
												if(isset($_SESSION['user_id']))
												{
												?>
                                                
                                                	<a class="btn gt-btn-green gt-cursor" data-toggle="modal" data-target="#myModal" onClick="save_search();"><i class="fa fa-floppy-o gt-margin-right-5"></i>Saved Search</a>
                                                
                                                <?php }?>
                                      </div>
                                    </form>
                            	</div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane <?php if(isset($_GET['gt-occupation-search'])){ echo "active";}?>" id="oct-search">
                        	<div class="row">
                        		<div class="col-xxl-14 col-xxl-offset-1">
                                	<h3>
                                    	Occupation Search
                                    </h3>
                                    <p class="gt-padding-bottom-10 gt-border-bottom-smoke-white">
                                    	With Occupation Search, you can get suitable profiles with specific type of occupation.

                                    </p>
                        			<form action="" id="ocp_search_form" method="post">
                                       <?php 
									if(!isset($_SESSION['gender123']))
									{
									?>
                                        <div class="form-group gt-margin-top-15" >
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Gender
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select class="gt-form-control flat" name="gender">
                                                        <option value="Female">Bride</option>
                                                        <option value="Male">Groom</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Education
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Education..." class="chosen-select gt-form-control flat" multiple tabindex="4" name="education[]">
                                                        <option value=""></option>
                                                        <?php
														   $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
														   while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu))
														   {
														   ?>
														   <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
														 <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Occupation
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select data-placeholder="Choose a Occupation..." class="chosen-select gt-form-control flat" multiple name="occupation[]" >
                                                        <option value=""></option>
                                                        <?php
															$SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
															
															while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp))
															{
																?>
																<option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>"><?php echo $DatabaseCo->dbRow->ocp_name; ?></option>
													   <?php } ?>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xxl-6 col-xl-6">
                                                    <label class="gt-margin-top-10">
                                                        Annual income
                                                    </label>
                                                </div>
                                                <div class="col-xxl-10 col-xl-10">
                                                    <select class="gt-form-control flat" name="annual_income" >
                                                        <option value="">Select Annual Income</option>
                                                        <option value="Rs. 10,000 - 50,000">Rs. 10,000 - 50,000</option>
                                                        <option value="Rs. 50,000 - 1,00,000">Rs. 50,000 - 1,00,000</option>
                                                        <option value="Rs. 1,00,000 - 2,00,000">Rs. 1,00,000 - 2,00,000</option>
                                                        <option value="Rs. 2,00,000 - 5,00,000">Rs. 2,00,000 - 5,00,000</option>
                                                        <option value="Rs. 5,00,000 - 10,00,000">Rs. 5,00,000 - 10,00,000</option>
                                                        <option value="Rs. 10,00,000 - 50,00,000">Rs. 10,00,000 - 50,00,000</option>
                                                        <option value="Rs. 50,00,000 - 1,00,00,000">Rs. 50,00,000 - 1,00,00,000</option>
                                                        <option value="Above Rs. 1,00,00,000">Above Rs. 1,00,00,000</option>
                                                        <option value="Does not matter">Does not matter</option>
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                         <div class="form-group text-center">
                                              <input type="submit" value="Search Now" name="occupation_sub" class="btn gt-btn-green">
                                                      <?php 
												if(isset($_SESSION['user_id']))
												{
												?>
                                                
                                                	<a class="btn gt-btn-green gt-cursor" data-toggle="modal" data-target="#myModal" onClick="save_search();"><i class="fa fa-floppy-o gt-margin-right-5"></i>Saved Search</a>
                                                
                                                <?php }?>
                                                
                                               
                                         </div>
                                    </form>
                                    
                            	</div>
                            </div>
                        </div>
  					</div>
								</div>
            				</div>
            				<div class="col-xxl-4 col-xl-4 col-lg-16 col-xs-16 col-md-16 col-sm-16">	
            					<div class="gt-panel">
                					<div class="gt-panel-head gt-panel-border-orange">
                    					<div class="gt-panel-title">Search By Id</div>
                    				</div>
                    				<div class="gt-panel-body">
                    					<div class="row">
                    						<form action="search_result" method="post">
                        						<?php 
													if(!isset($_SESSION['gender123']))
														{
												?>
                                        		<div class="col-xs-16 form-group">
                        							<label>Gender </label>
                    								<select class="gt-form-control" name="gender">
                                  						<option value="Female">Bride</option>
                                  						<option value="Male">Groom</option>
                            						</select>
                        						</div>
                                        		<?php }?>
                        						<div class="col-xs-16 form-group">
                        								<label>Enter Matri Id </label>
                    									<input type="text" class="gt-form-control" name="id_search" placeholder="Enter Matri Id Here">
                            							<p class="text-muted">Example - GT123456</p>
                            					</div>
                        						<div class="form-group text-center">
                                    				<div class="row">
                                        				<button type="submit" class="btn gt-btn-orange gt-margin-bottom-20">
                                                   			Search Now
                                            			</button>
                                        			</div>
                        						</div>
                        					</form>
                        				</div>
                    				</div>
                				</div>
								<?php include('parts/level-2.php');?>
            				</div>
        				</div>
    				</div>
    			</div>
  			</div>
  			<?php include "parts/footer-before-login.php"; ?>
        </div>
        
        <!---- SAVE SEARCH MODAL---->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  			<div class="modal-dialog modal-sm">
    			<div class="modal-content">
      				
        				<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            					<span aria-hidden="true">&times;</span>
            				</button>
        					<h4 class="modal-title ne_font_weight_nrm font-orange" id="myModalLabel">
            					Save Search
            				</h4>
        				</div>
        				<form name="saved_search_form" id="saved_search_form" method="post" action="">
        				<div class="modal-body" id="div_saved_search">
            				<div class="col-xs-16">  
                            	<label>Saved Search Name :</label> 
            					<input type="text" name="txt_saved_search_name" id="txt_saved_search_name" class="form-control">
            				</div>
                            <div class="clearfix"></div>
        				</div>
        				
        				<div class="modal-body col-xs-16" id="div_success">
                        </div>
                        </form>
                        <div class="clearfix"></div>
        				<div class="modal-footer">
           					<input type="button" class="btn gt-btn-orange"  id="sub_saved_search" value="Submit">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
        				</div>
        			
       				
    			</div>
 		 	</div>
		</div>
		<!---- SAVE SEARCH MODAL END --->
        
    	<!---- JQUERY ----->
        <script src="js/jquery.min.js"></script>
        <!---- JQUERY END ----->
        
        <!--- BOOTSTRAP AND GREEN JS--->
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/green.js"></script> 
        <script>
            $(document).ready(function() {
              $('#body').show();
              $('.preloader-wrapper').hide();
            });
		</script>
		 <script>
            (function($) {
                var $window = $(window),
                        $html = $('.mobile-collapse');
                $window.width(function width() {
                    if ($window.width() > 767) {
                        return $html.addClass('in');
                    }
                    $html.removeClass('in');
                });
            })(jQuery);
        </script> 
        <!--- BOOTSTRAP AND GREEN JS END--->
        <!--- BEST TAB VIEW FOR MOBILE SCREEN JS--->
        <script src="js/jquery.bootstrap-responsive-tabs.min.js" type="text/javascript"></script>
        <script>
			$('.responsive-tabs').responsiveTabs({
  			accordionOn: ['xs', 'sm']
		});
		</script>
        <!--- BEST TAB VIEW FOR MOBILE SCREEN JS END--->
        <!----- CHOSEN JS ---->
     	<script src="js/chosen.jquery.js" type="text/javascript"></script>
     	<script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
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
        
        <!----- SEARCH AJAX ---->
  		<script type="text/javascript">
		   $("#religion_id").on('change', function()
		   {
			$("#CasteDivloader").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
		    var selectedReligion = $("#religion_id").val() 
			var dataString = 'religion='+ selectedReligion;
			
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "search_rel_caste", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response)
			{
				
				$("#caste_id").find('option').remove().end().append(response);
				$('#caste_id').trigger('chosen:updated');
					
				$("#CasteDivloader").html('');		
				
			},			
			});		
		});	 
		   $("#religion_id_basic").on('change', function()
		   {
			   
			$("#CasteDivloaderbasic").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
		    var selectedReligion = $("#religion_id_basic").val() 
			var dataString = 'religion='+ selectedReligion;
			
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "search_rel_caste", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response)
			{
				
				$("#caste_id_basic").find('option').remove().end().append(response);
				$('#caste_id_basic').trigger('chosen:updated');
					
				$("#CasteDivloaderbasic").html('');		
				
			},			
			});		
		});	
      
		   $("#religion_id_adv").on('change', function()
		   {
			   
			$("#CasteDivloaderadv").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');			
		    var selectedReligion = $("#religion_id_adv").val() 
			var dataString = 'religion='+ selectedReligion;
			
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "search_rel_caste", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response)
			{
				
				$("#caste_id_adv").find('option').remove().end().append(response);
				$('#caste_id_adv').trigger('chosen:updated');
					
				$("#CasteDivloaderadv").html('');		
				
			},			
			});		
		});	
     	
			$("#country_id_adv").change(function()
			{
				$("#stateDivloader_adv").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
				
				var id=$(this).val();
				var dataString = 'state='+ id;
			
				$.ajax
				({
					type: "POST",
					url: "search_state",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						$("#state_id_adv").find('option').remove().end().append(html);
						$('#state_id_adv').trigger('chosen:updated');
						$("#stateDivloader_adv").html('');
						
					} 
				});
			
			});
		
			$("#state_id_adv").on('change',function()
			{
				
				$("#cityDivloader_adv").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
				
				var id=$(this).val();
				var cnt_id=$("#country_id_adv").val();
				var dataString = 'state_id='+ id+'&country_id='+ cnt_id;
			
				$.ajax
				({
					type: "POST",
					url: "search_city",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#city_id_adv").find('option').remove().end().append(html);
						$('#city_id_adv').trigger('chosen:updated');
						$("#cityDivloader_adv").html('');					
					} 
				});
			
			});
		
			$("#country_id_loc").change(function()
			{
				$("#stateDivloader_loc").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
				
				var id=$(this).val();
				var dataString = 'state='+ id;
			
				$.ajax
				({
					type: "POST",
					url: "search_state",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						$("#state_id_loc").find('option').remove().end().append(html);
						$('#state_id_loc').trigger('chosen:updated');
						$("#stateDivloader_loc").html('');
						
					} 
				});
			
			});
		
			$("#state_id_loc").on('change',function()
			{
				
				$("#cityDivloader_loc").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
				
				var id=$(this).val();
				var cnt_id=$("#country_id_loc").val();
				var dataString = 'state_id='+ id+'&country_id='+ cnt_id;
			
				$.ajax
				({
					type: "POST",
					url: "search_city",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#city_id_loc").find('option').remove().end().append(html);
						$('#city_id_loc').trigger('chosen:updated');
						$("#cityDivloader_loc").html('');					
					} 
				});
			
			});
		
			$("#country_id_bsc").change(function()
			{
				$("#stateDivloader_bsc").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
				
				var id=$(this).val();
				var dataString = 'state='+ id;
			
				$.ajax
				({
					type: "POST",
					url: "search_state",
					data: dataString,
					cache: false,
					success: function(html)
					{
						
						$("#state_id_bsc").find('option').remove().end().append(html);
						$('#state_id_bsc').trigger('chosen:updated');
						$("#stateDivloader_bsc").html('');
						
					} 
				});
			
			});
		
			$("#state_id_bsc").on('change',function()
			{
				
				$("#cityDivloader_bsc").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
				
				var id=$(this).val();
				var cnt_id=$("#country_id_bsc").val();
				var dataString = 'state_id='+ id+'&country_id='+ cnt_id;
			
				$.ajax
				({
					type: "POST",
					url: "search_city",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#city_id_bsc").find('option').remove().end().append(html);
						$('#city_id_bsc').trigger('chosen:updated');
						$("#cityDivloader_bsc").html('');					
					} 
				});
			
			});
	</script>
  		<script type="text/javascript">
 	
	function save_search()
		{
			$('#txt_saved_search_name').val('');
			$("#div_saved_search").show();
			$("#div_success").hide();	
		}
	
	$(document).ready(function(e) {
	    $('#sub_saved_search').click( function(){
			if($(".define.active").attr("id")=='quick-search')
			{
				var search_page_form=$("#quick_search_form").serialize();
				var search_page_nm='quick_search';
			}
			if($(".define.active").attr("id")=='basic-search')
			{
				var search_page_form=$("#quick_search_form").serialize();
				var search_page_nm='basic-search';
			}
			
			else if($(".define.active").attr("id")=='adv-search')
			{
				var search_page_form=$("#advance_search_form").serialize();
				var search_page_nm='advance_search';
			}
			else if($(".define.active").attr("id")=='key-search')
			{
				var search_page_form=$("#keyword_search_form").serialize();	
				var search_page_nm='keyword_search';
			}
			else if($(".define.active").attr("id")=='loc-search')
			{
				var search_page_form=$("#location_search_form").serialize();	
				var search_page_nm='id_search';
			}
			else if($(".define.active").attr("id")=='oct-search')
			{
				var search_page_form=$("#ocp_search_form").serialize();	
				var search_page_nm='id_search';
			}
			
			else if($(".define.active").attr("id")=='my-saved-search')
			{
				var search_page_form=$("#who_is_online_search_form").serialize();	
				var search_page_nm='who_is_online_search';
			}
			
			if($('#txt_saved_search_name').val()==''){
				alert('Please fill up the saved search name.');
				return false;
			}
			else{
				
				var txt_saved_search_nm=$('#txt_saved_search_name').val();
				
				$.ajax
				({
					type: "POST",
					url: "saved_search_query",
					data: search_page_form+'&saved_nm='+txt_saved_search_nm+'&search_page_nm='+search_page_nm,
					success: function(data)
					{
						$("#div_saved_search").hide();
						$('#sub_saved_search').hide();
						$("#div_success").show();
						$("#div_success").html(data);
					} 
				});
			}		
		});			
    });
</script>
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  