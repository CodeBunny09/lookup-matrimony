<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

include_once 'auth.php';
$mid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if(isset($_POST['editPhoto1'])){
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
		echo "<script>window.location='my-photo'</script>";
	}elseif($_FILES["photo1"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo1']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("update register set photo1='".$imgConvertedName."',photo1_approve='UNAPPROVED',photo_view_status='1',photo_protect='No' where matri_id='".$mid."'");
			echo "<script>alert('Photo Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto2'])){
$maxDimW = 180;
$maxDimH = 240;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo2']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo1']['tmp_name'];
    $fn = $_FILES['photo2']['tmp_name'];
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
	$imagename=$_FILES['photo2']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}elseif($_FILES["photo2"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo2']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("update register set photo2='".$imgConvertedName."',photo2_approve='UNAPPROVED' where matri_id='".$mid."'");
			echo "<script>alert('Photo 2 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto3'])){
$maxDimW = 180;
$maxDimH = 240;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo3']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo3']['tmp_name'];
    $fn = $_FILES['photo3']['tmp_name'];
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
	$imagename=$_FILES['photo3']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}elseif($_FILES["photo3"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo3']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("update register set photo3='".$imgConvertedName."',photo3_approve='UNAPPROVED' where matri_id='".$mid."'");
			echo "<script>alert('Photo 3 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto4'])){
$maxDimW = 180;
$maxDimH = 240;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo4']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo4']['tmp_name'];
    $fn = $_FILES['photo4']['tmp_name'];
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
	$imagename=$_FILES['photo4']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}elseif($_FILES["photo4"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo4']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("update register set photo4='".$imgConvertedName."',photo4_approve='UNAPPROVED' where matri_id='".$mid."'");
			echo "<script>alert('Photo 4 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto5'])){
$maxDimW = 180;
$maxDimH = 240;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo5']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo5']['tmp_name'];
    $fn = $_FILES['photo5']['tmp_name'];
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
	$imagename=$_FILES['photo5']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}elseif($_FILES["photo5"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo5']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("update register set photo5='".$imgConvertedName."',photo5_approve='UNAPPROVED' where matri_id='".$mid."'");
			echo "<script>alert('Photo 5 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_POST['editPhoto6'])){
$maxDimW = 180;
$maxDimH = 240;
list($width, $height, $type, $attr) = getimagesize( $_FILES['photo6']['tmp_name'] );
if ( $width > $maxDimW || $height > $maxDimH ) {
    $target_filename = $_FILES['photo6']['tmp_name'];
    $fn = $_FILES['photo6']['tmp_name'];
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
	$imagename=$_FILES['photo6']['name'];
	$imageFileType = pathinfo($imagename,PATHINFO_EXTENSION);
	$imgConvertedName=strtotime(date('Y-m-d H:i:s')).'.'.$imageFileType;
	$target_file = $target_dir.$imgConvertedName; 
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}elseif($_FILES["photo6"]["size"] > 4000000) {
		echo "<script>alert('your file size is more than 4MB.')</script>";
		echo "<script>window.location='my-photo'</script>";
	}else{
		if(move_uploaded_file($_FILES['photo6']['tmp_name'],$target_file) == 1){
			 $DatabaseCo->dbLink->query("update register set photo6='".$imgConvertedName."',photo6_approve='UNAPPROVED' where matri_id='".$mid."'");
			echo "<script>alert('Photo 6 Uploaded Successfully');window.location='my-photo';</script>";
		}else{
			echo "<script>alert('Photo size is too large or not image file.');</script>";
			echo "<script>window.location='my-photo';</script>";
		}
	}
}
if(isset($_GET['del_id'])){
if($_GET['del_id'] == 1){
	if (file_exists('my_photos/'."".$Row->photo1)) {
		unlink('my_photos/'."".$Row->photo1);
	}
	$del1=$DatabaseCo->dbLink->query("UPDATE register SET photo1='',photo1_approve='' WHERE matri_id='$mid'");
	echo "<script>window.location='my-photo';</script>";
}
if($_GET['del_id'] == 2){
	if (file_exists('my_photos/'."".$Row->photo2)) {
		unlink('my_photos/'."".$Row->photo2);
	}
	$del2=$DatabaseCo->dbLink->query("UPDATE register SET photo2='',photo2_approve='' WHERE matri_id='$mid'");
	echo "<script>window.location='my-photo';</script>";
}
if($_GET['del_id'] == 3){
	if (file_exists('my_photos/'."".$Row->photo3)) {
		unlink('my_photos/'."".$Row->photo3);
	}
	$del3=$DatabaseCo->dbLink->query("UPDATE register SET photo3='',photo3_approve='' WHERE matri_id='$mid'");
	echo "<script>window.location='my-photo';</script>";
}
if($_GET['del_id'] == 4){
	if (file_exists('my_photos/'."".$Row->photo4)) {
		unlink('my_photos/'."".$Row->photo4);
	}
	$del4=$DatabaseCo->dbLink->query("UPDATE register SET photo4='',photo4_approve='' WHERE matri_id='$mid'");
	echo "<script>window.location='my-photo';</script>";
}
if($_GET['del_id'] == 5){
	if (file_exists('my_photos/'."".$Row->photo5)) {
		unlink('my_photos/'."".$Row->photo5);
	}
	$del5=$DatabaseCo->dbLink->query("UPDATE register SET photo5='',photo5_approve='' WHERE matri_id='$mid'");
	echo "<script>window.location='my-photo';</script>";
}
if($_GET['del_id'] == 6){
	if (file_exists('my_photos/'."".$Row->photo6)) {
		unlink('my_photos/'."".$Row->photo6);
	}
	$del6=$DatabaseCo->dbLink->query("UPDATE register SET photo6='',photo6_approve='' WHERE matri_id='$mid'");
	echo "<script>window.location='my-photo';</script>";
}
}
$Row = $DatabaseCo->dbLink->query("SELECT photo1,photo2,photo3,photo4,photo5,photo6,gender,photo_view_status,photo_protect,photo_pswd FROM register WHERE matri_id='".$mid."'") or die(mysqli_error($DatabaseCo->dbLink));
$Row = mysqli_fetch_object($Row);

?>
<?php
if (isset($_GET['mp-rem-id'])) {
    $DatabaseCo->dbLink->query("update reminder set reminder_view_status='No' where rem_id='" . $_GET['mp-rem-id'] . "'");
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
        
		<!----PHOTO CROP CSS---->
        <link rel="stylesheet" type="text/css" href="css/photocrop/component.css"/>
        <!----PHOTO CROP CSS END---->
        
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
                <div class="col-xxl-12 col-xxl-offset-4 col-xl-12 col-xl-offset-4 text-center">
                    <h2 class="gt-margin-top-0 gt-text-orange">
                        Upload & Profile Picture Settings
                    </h2>
                    <article>
                        <p>
                            Here is your option to set your profile pictures and other pictures.Remember upload profile picture gives you 10 times better respose.So do it now if you didnt.
                        </p>
                    </article>
                </div>
                <div class="col-xxl-4 col-xl-4 gt-left-opt-msg">
                    <a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
                        Options <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="collapse mobile-collapse" id="collapseExample">
                        <?php include "parts/left_panel.php"; ?>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">
                    <div class="gt-profile-pic-title">
                        <h4>
                            Change Or Upload Profile Picture
                        </h4>
                    </div>
                    <div class="gt-profile-pic-panel">
                        <div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">
                            <div class="row">
                                <div class="col-xxl-5 col-xxl-offset-3 col-xl-7 col-xl-offset-1 col-lg-8 gt-margin-bottom-15">
                                    <h4 class="gt-font-weight-400 text-muted">
                                        Photo Privacy Status:- 
                                    </h4>
                                </div>
                                
                                <div class="col-xxl-5 col-xl-7 col-lg-8 gt-margin-bottom-15">
                                	<?Php 
									  if ($Row->photo_protect == 'Yes' && $Row->photo_pswd!=''){ ?>
                                    	<a href="settings?photoVisiblity" class="btn gt-btn-green">SET PHOTO PRIVACY</a>
                                    <?Php }else{ ?>
                                    <select class="gt-form-control" id="view_photo" name="view_photo">	
                                        <option value="1" <?php
                                        if ($Row->photo_view_status == '1') {
                                            echo "selected";
                                        }
                                        ?>>Visible To All</option>
                                        <option value="2" <?php
                                        if ($Row->photo_view_status == '2') {
                                            echo "selected";
                                        }
                                        ?>>Visible To Paid Members</option>
                                        <option value="0" <?php
                                        if ($Row->photo_view_status == '0') {
                                            echo "selected";
                                        }
                                        ?>>Hidden For All</option>
                                    </select>
                                    <?php }?>
                                </div>
                            </div>
							<div class="row">
								<div class="col-xxl-6 col-xxl-offset-5 col-xl-6 col-xxl-offset-5 col-md-12 col-md-offset-2 col-lg-6 col-lg-offset-5">
                                     <div class="col-xs-16 gtImageUpload">
										  <?php if($Row->photo1 != ''){ ?>
											<img src="my_photos/<?php echo $Row->photo1; ?>" class="img-responsive img-thumbnail gt-margin-bottom-15">
										  <?php }else{?>
										  <?php if($Row->gender == 'Male' && $Row->photo1 == ''){ ?>
											<img src="img/male.png" class="img-responsive img-thumbnail gt-margin-bottom-15">
										  <?php }else{ ?>
											<img src="img/female.png" class="img-responsive img-thumbnail gt-margin-bottom-15">	
										  <?php }}?>										 
                                    	  
                                          <a href="#editPhoto1Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
                                               Change Profile Picture
                                          </a>
										  <?php if($Row->photo1 != ''){ ?>
										 	 <a href="my-photo.php?del_id=1" class="btn btn-danger btn-block">
                                               Delete Profile Picture
                                         	 </a>
										  <?php }?>
                                      </div>
                                 </div>
							</div>
                        </div>
                    </div>
                    <div class="gt-profile-pic-title">
                        <h4>
                            Upload More Photoes
                        </h4>
                    </div>
					<div class="gt-profile-pic-panel">
                        <div class="row">
							 <div class="col-xxl-4 col-xs-8 col-md-4">
								 <div class="gtImageUpload">
									 <div class="thumbnail">
										 <div class="caption text-center">
											 Photo 2
										 </div>
										  <?php if($Row->photo2 != ''){ ?>
											<img src="my_photos/<?php echo $Row->photo2; ?>" class="img-responsive gt-margin-bottom-15">
										  <?php }else{?>
										  <?php if($Row->gender == 'Male' && $Row->photo2 == ''){ ?>
											<img src="img/male.png" class="img-responsive gt-margin-bottom-15">
										  <?php }else{ ?>
											<img src="img/female.png" class="img-responsive gt-margin-bottom-15">	
										  <?php }}?>										 
                                     </div>  
                                          <a href="#editPhoto2Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
                                              Edit Photo 2
                                          </a>
										  <?php if($Row->photo2 != ''){ ?>
										 	 <a href="my-photo.php?del_id=2" class="btn btn-danger btn-block">
                                               Delete Photo 2
                                         	 </a>
										  <?php }?>
                                      </div>
							 </div>
							 <div class="col-xxl-4 col-xs-8 col-md-4">
								 <div class="gtImageUpload">
									 <div class="thumbnail">
										 <div class="caption text-center">
											 Photo 3
										 </div>
										  <?php if($Row->photo3 != ''){ ?>
											<img src="my_photos/<?php echo $Row->photo3; ?>" class="img-responsive gt-margin-bottom-15">
										  <?php }else{?>
										  <?php if($Row->gender == 'Male' && $Row->photo3 == ''){ ?>
											<img src="img/male.png" class="img-responsive gt-margin-bottom-15">
										  <?php }else{ ?>
											<img src="img/female.png" class="img-responsive gt-margin-bottom-15">	
										  <?php }}?>										 
                                     </div>  
                                     <a href="#editPhoto3Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
                                          Edit Photo 3
                                     </a>
									<?php if($Row->photo3 != ''){ ?>
										<a href="my-photo.php?del_id=3" class="btn btn-danger btn-block">
                                               Delete Photo 3
                                        </a>
									<?php }?>
                                   </div>
							 </div>
							 <div class="col-xxl-4 col-xs-8 col-md-4">
								 <div class="gtImageUpload">
									 <div class="thumbnail">
										 <div class="caption text-center">
											 Photo 4
										 </div>
										  <?php if($Row->photo4 != ''){ ?>
											<img src="my_photos/<?php echo $Row->photo4; ?>" class="img-responsive gt-margin-bottom-15">
										  <?php }else{?>
										  <?php if($Row->gender == 'Male' && $Row->photo4 == ''){ ?>
											<img src="img/male.png" class="img-responsive gt-margin-bottom-15">
										  <?php }else{ ?>
											<img src="img/female.png" class="img-responsive gt-margin-bottom-15">	
										  <?php }}?>										 
                                     </div>  
                                     <a href="#editPhoto4Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
                                          Edit Photo 4
                                     </a>
									<?php if($Row->photo4 != ''){ ?>
										<a href="my-photo.php?del_id=4" class="btn btn-danger btn-block">
                                               Delete Photo 4
                                        </a>
									<?php }?>
                                   </div>
							 </div>
							 <div class="col-xxl-4 col-xs-8 col-md-4">
								 <div class="gtImageUpload">
									 <div class="thumbnail">
										 <div class="caption text-center">
											 Photo 5
										 </div>
										  <?php if($Row->photo5 != ''){ ?>
											<img src="my_photos/<?php echo $Row->photo5; ?>" class="img-responsive gt-margin-bottom-15">
										  <?php }else{?>
										  <?php if($Row->gender == 'Male' && $Row->photo5 == ''){ ?>
											<img src="img/male.png" class="img-responsive gt-margin-bottom-15">
										  <?php }else{ ?>
											<img src="img/female.png" class="img-responsive gt-margin-bottom-15">	
										  <?php }}?>										 
                                     </div>  
                                     <a href="#editPhoto5Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
                                          Edit Photo 5
                                     </a>
									<?php if($Row->photo5 != ''){ ?>
										<a href="my-photo.php?del_id=5" class="btn btn-danger btn-block">
                                               Delete Photo 5
                                        </a>
									<?php }?>
                                   </div>
							 </div>
						 </div>
						 <div class="row gt-margin-top-20">
							 <div class="col-xxl-4 col-xs-8 col-md-4">
								 <div class="gtImageUpload">
									 <div class="thumbnail">
										 <div class="caption text-center">
											 Photo 6
										 </div>
										  <?php if($Row->photo6 != ''){ ?>
											<img src="my_photos/<?php echo $Row->photo6; ?>" class="img-responsive gt-margin-bottom-15">
										  <?php }else{?>
										  <?php if($Row->gender == 'Male' && $Row->photo6 == ''){ ?>
											<img src="img/male.png" class="img-responsive gt-margin-bottom-15">
										  <?php }else{ ?>
											<img src="img/female.png" class="img-responsive gt-margin-bottom-15">	
										  <?php }}?>										 
                                     </div>  
                                     <a href="#editPhoto6Modal" data-toggle="modal" class="btn gt-btn-green btn-block gt-margin-bottom-10">
                                          Edit Photo 6
                                     </a>
									<?php if($Row->photo6 != ''){ ?>
										<a href="my-photo.php?del_id=6" class="btn btn-danger btn-block">
                                               Delete Photo 6
                                        </a>
									<?php }?>
                                   </div>
							 </div>
							 
						 </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "parts/footer-before-login.php"; ?>
	    <!-- Photo Edit Modal -->
    	<?php include 'parts/modal/edit_photo1_modal.php'; ?>
    	<?php include 'parts/modal/edit_photo2_modal.php'; ?>
    	<?php include 'parts/modal/edit_photo3_modal.php'; ?>
    	<?php include 'parts/modal/edit_photo4_modal.php'; ?>
    	<?php include 'parts/modal/edit_photo5_modal.php'; ?>
		<?php include 'parts/modal/edit_photo6_modal.php'; ?>
		</div>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/green.js"></script>
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
		 <script>
		  function readURL1(input) {
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
	  <script>
		  function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo2_prev')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	  </script>
	  <script>
		  function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo3_prev')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	  </script>
	  <script>
		  function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo4_prev')
                        .attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
	  </script>
	  <script>
		  function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo5_prev')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	  </script>
	  <script>
		  function readURL6(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#photo6_prev')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	  </script>
    </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  


