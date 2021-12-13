<?php
//Database connection
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
if(isset($_POST['hobby'])){
	$_SESSION['reg_user_id'];	
	$hobby=implode(",",$_POST['hobby']);
	$spoken_language=implode(",",$_POST['spoken_language']);
	$DatabaseCo->dbLink->query("update register set hobby='".$hobby."',language_known='".$spoken_language."' where matri_id='".$_SESSION['matri_id_reg']."'");	
}
include_once './class/Config.class.php';
$configObj = new Config();
if(isset($_POST['submit']) && isset($_FILES['photo1'])){
$maxDimW = 180;
$maxDimH = 240;

list($width, $height, $type, $attr) = getimagesize( $_FILES['photo1']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo1']['tmp_name'];
    $fn = $_FILES['photo1']['tmp_name'];
    $size = getimagesize( $fn );
    $ratio = $size[0]/$size[1]; // width/height
    if( $ratio > 1) {
        $width = $maxDimW;
        $height = $maxDimH;
    } else {
        $width = $maxDimW;
        $height = $maxDimH;
    }
    $src = imagecreatefromstring(file_get_contents($fn));
    $dst = imagecreatetruecolor( $width, $height );
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
    imagejpeg($dst, $target_filename); // adjust format as needed
}
	$target_dir='my_photos/';
	$imagename=$_FILES['photo1']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName;
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='register-photo-upload'</script>";
	}elseif($_FILES["photo1"]["size"] > 2000000) {
		echo "<script>alert('your file size is more than 2MB.');</script>";
		echo "<script>window.location='register-photo-upload';</script>";
	}else{
		if(move_uploaded_file($_FILES['photo1']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("update register set photo1='".$imgConvertedName."',photo1_approve='UNAPPROVED',photo_view_status='1',photo_protect='No' where matri_id='" . $_SESSION['reg_user_id'] . "'");
			echo "<script>alert('Photo Uploaded Successfully');window.location='aadhaar_upload';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='register-photo-upload';</script>";
		}
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

        <!---CHOOSEN CSS--->
        <link rel="stylesheet" href="css/prism.css">
        <link rel="stylesheet" href="css/chosen.css">
        <!---CHOOSEN CSS END--->
        
		<!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->
        
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/developer.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->

        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END-->


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
                    <!-- Main Container-->
                	<div class="container">
						<div class="row">		
						   <div class="col-xxl-4 col-xl-4 col-xs-16 col-sm-16 col-md-16 gt-left-opt-msg gt-margin-top-20">
								<?php include "parts/level-2.php"; ?>
						   </div>
						   <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
							 <div class="row text-center">
								<div class="col-xs-16">
								   <h3 class="gt-text-green">Upload Profile Picture</h3>
								   <article><p>Uploading your profile picture give you 10 time more response.</p></article>
								</div>
							</div>
							<div class="gt-profile-pic-panel">
							  <div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">
								   <div class="row">
										<div class="col-xxl-3 col-xxl-offset-13">
											<a class="btn gt-btn-green btn-block" href="aadhaar_upload"> Skip <i class="fa fa-caret-right"></i></a>
										</div>
									</div>
								    <form class="" method="POST" action="" enctype="multipart/form-data">
										<div class="row">
											<div class="col-xxl-16">
												<div class="form-group text-center">
													<p class="">Click on <b>Select Image</b> and then <b>UPLOAD</b> to upload image.</p>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="col-xxl-6 col-xxl-offset-5 col-xl-6 col-xxl-offset-5 col-md-12 col-md-offset-2 col-lg-6 col-lg-offset-5">
												<div class="thumbnail">
													<img src="img/photo-default.png" class="img-responsive" id="photo1_prev">
												</div>
											</div>
										</div>
										<div class="row">
										   <div class="col-xxl-6 col-xl-16 col-xxl-offset-5 text-center">
												<div class="row">
													 <div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-lg-7 gt-margin-bottom-15">
														 <input type="file" name="photo1" id="my_file" onchange="readURL(this);">
														 <label for="my_file" class="btn btn-computer btn-block">
																Select Image
														 </label>
													 </div>
													 <input type="submit" name="submit" value="UPLOAD & CONTINUE" class="btn gt-btn-green gt-btn-xxl">
												</div>
											</div>
               							</div>
								  	</form>
         							</div>
      							</div>
    						</div>
						</div>
                	</div>
            	</div>
        	</div>  
        	<!--- FOOTER ---> 
            <?php include "parts/footer-before-login.php"; ?>
            <!--- FOOTER END --->

        </div>
        <!--- BOOTSTRAP AND GREEN JS--->
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/green.js"></script>
        <!--- BOOTSTRAP AND GREEN JS END--->

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

        <!--- VALIDATION JS --->
        <script type="text/javascript" src="js/validetta.js"></script>
        <!---VALIDATION JS END --->

        <!--- LOADER JS --->
        <script>
            $(document).ready(function() {
                $('#body').show();
                $('.preloader-wrapper').hide();
            });
        </script>
        <!--- LOADER JS END --->
		<script>
		  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#photo1_prev')
                        .attr('src', e.target.result)
                };
				reader.readAsDataURL(input.files[0]);
            }
        }
		</script>
    </body>
</html>



