<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	if($_SESSION['reg_user_id'] == ""){
		echo "<script>window.location='index.php'</script>";
	}

if(isset($_POST['submit'])){
	$_SESSION['reg_user_id'];	
	$image=$_FILES["attachment"]["name"];   
	$target_dir = "documents/";
	$imageFileType = pathinfo($image,PATHINFO_EXTENSION);
	$img_name=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$img_name; 
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
		echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed.')</script>";
		echo "<script>window.location='aadhaar_upload';</script>";
	} elseif($_FILES["attachment"]["size"] > 2000000) {
        echo "<script>alert('your file size is more than 2MB.')</script>";
	    echo "<script>window.location='aadhaar_upload';</script>";
	} else {
		move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);
		echo "<script>window.location='aadhaar_upload';</script>";
		$DatabaseCo->dbLink->query("UPDATE register set aadhaar_card='".$img_name."',aadhaar_card_status='PENDING' WHERE matri_id='".$_SESSION['matri_id_reg']."'");
    }
		
}
$fetch=$DatabaseCo->dbLink->query("select aadhaar_card,aadhaar_card_status from register where matri_id='".$_SESSION['matri_id_reg']."'");
$row1=mysqli_fetch_object($fetch);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#549a11">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#549a11">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">
    <title><?php echo $configObj->getConfigFname(); ?></title>
	<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
	<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
	<link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
    
    <!-----------------------------------choosen------------------------------------>
    <link rel="stylesheet" href="css/prism.css">
    <link rel="stylesheet" href="css/chosen.css">
     <!-----------------------------------choosen js------------------------------------>
     	<!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->
    <!-----------------------------------Greenstrap------------------------------------>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom-responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
	<!-----------------------------------Greenstrap End-------------------------------->
    <!-----------------------------------Font Awsome----------------------------------->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <!-----------------------------------Font Awsome End------------------------------->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="preloader-wrapper">
      	<i class="gi gi-loader gi-spin"></i>
    </div>
    <div id="body" style="display:none">
   <?php include "parts/header.php"; ?>
    <?php include "parts/menu-aft-login.php"; ?>
    
  <div id="wrap">
  	<div id="main">
    	<div class="container gtAadhaar">
        	<div class="row">
          	 	 <div class="col-xxl-12 col-xxl-offset-2">
          	 	 <h3 class="text-center gt-margin-bottom-20">Upload Your Document <a href="register-confirm-password" class="pull-right btn btn-success">Upload Later <i class="fa fa-caret-right"></i></a></h3>
				</div>
            	 <div class="col-xxl-12 col-xxl-offset-2 gtRegister">
              		<div class="row">
              		<?php if($row1->aadhaar_card != ""){ ?>
               		<div class="col-xxl-6 gtAadhaarPrev">
               			<a href="#myModal" data-toggle="modal" >
               				<img src="documents/<?php echo $row1->aadhaar_card; ?>" class="img-responsive img-thumbnail">
               			</a>
               		</div>
               		<?php }else{?>
               			<div class="col-xxl-6 gtAadhaarPrev">
							<img src="img/document-default.jpg" class="img-responsive">
						</div>
					<?php }?>
                	<form class="col-xxl-10 gt-margin-top-50" name="" method="post" enctype="multipart/form-data">
                		<div class="form-group">
							<label>
								Upload Your Id Proof
							</label>
							<input type="file" placeholder="Select File" class="gt-form-control" name="attachment"/>
							<p>Note:-Only .jpg & .png allowded.</p>
						</div>
               			<input type="Submit" value="Upload" name="submit" class="btn gt-btn-orange">
                	</form>
                	 <div class="col-xxl-16 text-center gt-margin-top-30">
                	 	<a href="register-confirm-password" class="btn gt-btn-orange btn-lg">Continue</a>
                	 </div>
                	</div>
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
        <img src="documents/<?php echo $row1->aadhaar_card; ?>" class="img-responsive">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <!------------------------------------------jQuery------------------------------------------------->
    <script src="js/jquery.min.js"></script>
    <!------------------------------------------jQuery End--------------------------------------------->
    <!------------------------------------------bootstrap and green js--------------------------------->
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/green.js"></script>
    <!-------------------------------------bootstrap and green js End--------------------------------->
    <script>
	$(document).ready(function() {
    	$('#body').show();
    	$('.preloader-wrapper').hide();
	});
  </script>
    <!------------------------------------Choosen js-------------------------------------------------->
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
    <!-------------------------------------Choosen js End--------------------------------------------->
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  