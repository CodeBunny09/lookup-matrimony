<?php 

include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	
	include_once 'auth.php';
	$mid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
if(isset($_POST['submit']))
{
	$image=$_FILES["attachment"]["name"];   
	$target_dir = "uploads/";
	$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
	$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$img_name; 
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		
	} elseif($_FILES["attachment"]["size"] > 5000000) {
        echo "<script>alert('your file size is more than 5MB.')</script>";
	    
	} else {
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);
    }
	$DatabaseCo->dbLink->query("update register set aadhaar_card='".$img_name."',aadhaar_card_status='PENDING' where matri_id='".$mid."'");	
}
$fetch=$DatabaseCo->dbLink->query("select aadhaar_card,aadhaar_card_status from register where matri_id='".$mid."'");
$row1=mysqli_fetch_object($fetch);
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
					<div class="col-xxl-12 col-xxl-offset-2 col-xl-12 col-xl-offset-2  gt-margin-bottom-20 gt-upload-photo">
						<h3 class="gt-margin-top-0 gt-text-orange text-center">
							  Document – Upload/ Edit Details
						</h3>
						<article class="text-center">
							<p>
								Uploading document will get your profile approval of authentication
							</p>
						</article>
						<div class="gt-profile-pic-panel gt-margin-top-20">
						<div class="row">
						
								<div class="col-xxl-6 gtPreviewAadhaar">
									<div class="thumbnail">
										<div class="caption">
											<h4 class="text-center gt-margin-bottom-0 gt-margin-top-0">Preview</h4>
										</div>
										<?php if($row1->aadhaar_card != ''){?>
										<a href="#myModal" data-toggle="modal" >
											<img src="documents/<?php echo $row1->aadhaar_card; ?>" class="img-responsive">
										</a>
										<?php }else{?>
											<img src="img/document-default.jpg" class="img-responsive">
										<?php }?>
										<div class="caption">
											<h5 class="text-center gt-margin-bottom-0 gt-margin-top-0">Status :- <b class="text-danger"><?php echo $row1->aadhaar_card_status; ?></b></h5>
										</div>
									</div>
								</div>
								<form action="" class="col-xxl-10 gt-margin-top-40" method="post" enctype="multipart/form-data" >
									<div class="form-group">
										<label>To get verified Upload document below:</label>
										<input type="file" placeholder="Select File" class="gt-form-control" name="attachment"/>
									</div>
									<div class="col-xxl-16 text-center">
									<input type="Submit" value="Upload" name="submit" class="btn gt-btn-orange">
									</div>
							   </form>
							
						</div>
						</div>
					</div>
			   </div>
			 </div>
    <?php include "parts/footer-before-login.php"; ?>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
       	<div class="col-xxl-16">
       		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       	</div>
       	<div class="col-xxl-16 gtAadhaarModal">
        <img src="uploads/<?php echo $row1->aadhaar_card; ?>" class="img-responsive">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
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


<script>
    $(document).ready(function() {
    $('#body').show();
    $('.preloader-wrapper').hide();
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