<?php 

include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	
	include_once 'auth.php';
	$mid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';

if(isset($_POST['subform'])){
		 	$image=$_FILES["horoscope"]["name"];   
			$target_dir = "horoscope-list/";
			$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
			$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
			$target_file = $target_dir.$img_name; 
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			 echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
			 echo "<script>window.location='horoscope.php'</script>";
			}
			elseif($_FILES["horoscope"]["size"] > 5000000) {
			 echo "<script>alert('your file size is more than 5MB.')</script>";
			 echo "<script>window.location='horoscope.php'</script>";
			}else {
				move_uploaded_file($_FILES["horoscope"]["tmp_name"], $target_file);
			}
			$DatabaseCo->dbLink->query("update register set hor_photo='".$img_name."',hor_check='UNAPPROVED' where matri_id='".$_SESSION['user_id']."'");	
			echo "<script>alert('Your Horoscope image uploade successfully.');</script>";



}

$getimg=mysqli_fetch_object($DatabaseCo->dbLink->query("select hor_photo,username,caste,birthdate,birthtime,birthplace,star,padham,moonsign,lagnam,dosh,janana1,janana2,janana3,janana4,rasi1,rasi2,rasi3,rasi4,rasi5,rasi6,rasi7,rasi8,rasi9,rasi10,rasi11,rasi12,amsam1,amsam2,amsam3,amsam4,amsam5,amsam6,amsam7,amsam8,amsam9,amsam10,amsam11,amsam12 from register where matri_id='".$_SESSION['user_id']."'"));



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
        	<div class="col-xxl-12 col-xxl-offset-4 col-xl-12 col-xl-offset-4 text-center gt-margin-bottom-20">
            	<h3 class="gt-margin-top-0 gt-text-orange">
                      Upload Horoscope
                </h3>
                <article>
                	<p>
                    	Here is your option to set your Horoscope.Upload your horoscope image(kundli) may be you not believe but other user does.
                    </p>
                </article>
            </div>
        	<div class="col-xxl-4 col-xl-4 gt-left-opt-msg">
                    <a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
                        Options <i class="fa fa-angel-down"></i>
                    </a>
                    <div class="collapse mobile-collapse" id="collapseExample">
                        <?Php include "parts/left_panel_spotlight.php"; ?>
                    </div>
                </div>
            <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
               <div class="gt-profile-pic-title">
               		<div class="col-xxl-10 col-xl-10 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
                		<h4>
                			Change Or Upload Horoscope
                		</h4>
                	</div>
               </div>
               <div class="gt-profile-pic-panel">
                	<div class="col-xs-16 gt-margin-bottom-15">
                    	<div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-8 gt-padding-top-5">
                        	<label>Upload Your Horoscope Image</label>
                        </div>	
                    	<div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-8 gt-upload-photo">
               				<form action="" method="post" enctype="multipart/form-data" name="horoscopeform" id="horoscopeform">
    							<input type="file" name="horoscope" id="horoscope" class="upload btn btn-default" placeholder="Change Horoscope"/>
                            	<input type="hidden" name="subform" value="submit">
               				</form>
               			</div>
                    </div>
                	<div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">
                    	
                    	
                        
                        <div class="row">
                        	<?php 

											if($getimg->hor_photo!='')

											{

											?>

                                            <img class="img-thumbnail" src="horoscope-list/<?php echo $getimg->hor_photo;?>">

											<?php 

											}

											else

											{?>

                                            <img class="img-thumbnail" src="img/nodata-available.jpg">

                                            <?php  }?>
                        </div>
                    </div>
               </div>
               
               <div class="gt-profile-pic-title">
               		<div class="col-xxl-10 col-xl-10 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
                		<h4>
                			Edit / Add Horoscope
                		</h4>
                	</div>
               </div>
               <div class="gt-profile-pic-panel">
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
									<b><?php echo $getimg->dosh; ?></b>
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
                		
                		<div class="col-xs-16 text-center">
                			<a href="edit-horoscope.php" class="btn gt-btn-orange"><i class="fa fa-pencil"></i> Edit Horoscope</a>
                		</div>
                		<div class="col-xs-16 text-center gt-margin-top-20 gt-margin-bottom-30">
                			<form>
                				<div class="row">
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi1; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi2; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi3; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi4; ?>" disabled>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-xs-4">
                						<div class="form-group">
                							<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi5; ?>"  disabled>
                						</div>
                						<div class="form-group">
                							<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi6; ?>" disabled>
                					    </div>
                					</div>
                					<div class="col-xs-8">
                						<div class="box">
                							<h4>Rasi</h4>
                						</div>
                					</div>
                					<div class="col-xxl-4">
                						<div class="form-group">
                							<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi7; ?>" disabled>
                						</div>
                						<div class="form-group">
                							<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi8; ?>" disabled>
                						</div>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi9; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi10; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi11; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->rasi12; ?>" disabled>
                					</div>
                				</div>
                			</form>
						</div>
               			<div class="col-xs-16 text-center gt-margin-top-25">
                			<form>
                				<div class="row">
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam1; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam2; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam3; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam4; ?>" disabled>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-xs-4">
                						<div class="form-group">
                							<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam5; ?>" disabled>
                						</div>
                						<div class="form-group">
                							<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam6; ?>" disabled>
                					    </div>
                					</div>
                					<div class="col-xs-8">
                						<div class="box">
                							<h4>Amsam</h4>
                						</div>
                					</div>
                					<div class="col-xxl-4">
                						<div class="form-group">
                							<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam7; ?>" disabled>
                						</div>
                						<div class="form-group">
                							<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam8; ?>" disabled>
                						</div>
                					</div>
                				</div>
                				<div class="row">
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam9; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam10; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam11; ?>" disabled>
                					</div>
                					<div class="col-xs-4 gt-margin-bottom-15">
                						<input type="text" class="gt-form-control" value="<?php echo $getimg->amsam12; ?>" disabled>
                					</div>
                				</div>
                			</form>
						</div>
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
<style>
.owl-theme .owl-controls {
    text-align: center;
	float: none;
	margin-top: 10px;
	font-size: 14px;
	position: relative;
	background-color: transparent;
	margin-left: 0px;
	width: 100%;
}
.owl-theme .owl-controls .owl-buttons div {
    color: #FFF;
    display: inline-block;
    margin: 5px;
    padding: 3px 10px;
    font-size: 18px;
    border-radius: 5px;
    background:#2C2B2A;
}
</style>
<style>
  	#owl-demo .item{
        margin-top : 3px;
		padding-bottom:15px;
		padding-top:10px;
		border-bottom:1px solid rgba(213,213,213,1.00);
    }
    #owl-demo .item img{
        display: block;
    }
	#owl-demo-1 .item{
        margin-top : 3px;
		padding-bottom:15px;
		padding-top:10px;
		border-bottom:1px solid rgba(213,213,213,1.00);
    }
    #owl-demo-1 .item img{
        display: block;
		width:100%;
    }
</style>
<script>
    $(document).ready(function() {
    $('#body').show();
    $('.preloader-wrapper').hide();
     });
</script>
<script>
$(document).ready(function() {
  $("#owl-demo").owlCarousel({
      navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
	  autoPlay: 3000,
      singleItem:true,
	  items : 1, //10 items above 1000px browser width
	  navigationText: [
      "<span class='icon-chevron-left icon-white'><</span>",
      "<span class='icon-chevron-right icon-white'>></span>"
      ],
      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false
  });
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

<script>
      $(document).ready(function() {
      $("#owl-demo-1").owlCarousel({
        autoPlay: 3000,
        items : 1,
		navigation:true,
		navigationText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1]
      });
      });
</script>

</html>
<?php include'thumbnailjs.php' ; ?> 