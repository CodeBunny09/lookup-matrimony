<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	$mid = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
include 'auth.php';
$sel_own_data = $DatabaseCo->dbLink->query("select photo1,gender,username from register_view where matri_id='$mid'");

$get_own_data = mysqli_fetch_object($sel_own_data);
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
    <div class="preloader-wrapper text-center">
      <div class="loader"> 
      </div>
      <h5>Loading...
      </h5>
    </div>
    <div id="body" style="display:none">
  <div id="wrap">
  	<div id="main">
    <?php include "parts/header.php"; ?>
    <?php include "parts/menu-aft-login.php"; ?>
    <div class="container">
    	<div class="row">
        	<div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 text-center">
            	<h2 class="gt-text-orange ">Saved Searches</h2>
                <p>All saved searches are here,you can just click on single button and you can search your saved criteria.</p>
            </div>
            <div class="col-xxl-16 col-xs-16 gt-margin-bottom-20">
       			<div class="alert alert-info" role="alert">
           			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  						<i class="fa fa-times-circle"></i>
					</button>
            		<article>
                		you can save you searched criteria with save search button on bottom of the search options.Save the search criteria which you find its perfect criteria to find perfect partner.
            		</article>
       			</div>
    		</div>
        </div>
    </div>
    <div class="container gt-view-profile">
    	<div class="row">
        	<div class="col-xxl-3 col-xl-4 col-xs-16 col-sm-16">
            	<!-- left option visible only in small-->
                <?php include_once('parts/view_profile_left_side.php'); ?>
                <!--  left option visible only in small end-->
            </div>
        	<div class="col-xxl-13 col-xl-12 col-lg-16 col-md-16 col-sm-16">
            	<div class="row">
                	<?php
						$sel_save_count =mysqli_num_rows($DatabaseCo->dbLink->query("select * from save_search where matri_id='".$_SESSION['user_id']."'"));
						if($sel_save_count > 0){
					?>
                    <?php
						$sel_save_search = $DatabaseCo->dbLink->query("select * from save_search where matri_id='".$_SESSION['user_id']."'");
						while($get_ss_data = mysqli_fetch_object($sel_save_search)){
				    ?>
                    <div class="col-xxl-8 col-xl-8 col-sm-16 col-md-16 col-xs-16 col-lg-8" id="remove<?php echo $get_ss_data->ss_id;?>">
                    	<div class="gt-saved-search-bucket">
                        	<div class="row">
                    			<h3 class="gt-margin-top-10">
                        			<span class="pull-left"><?php echo $get_ss_data->ss_name;?></span><a class="pull-right gt-cursor"  onClick="del_ss(<?php echo $get_ss_data->ss_id;?>);"><i class="fa fa-trash"></i></a>
                        		</h3>
                            </div>
                            <div class="row">
                    			<h5>
                                	<i class="fa fa-calendar gt-margin-right-5"></i><?php echo date('d M Y ,H:i A', strtotime($get_ss_data->save_date)); ?>
                                </h5>
                            </div>
                            <div class="row text-center">
                            	<a href="search_result.php?ss_id=<?php echo$get_ss_data->ss_id; ?>" class="btn btn-success">Search</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } else { ?>
                   <div class="col-xs-16">
                       <div class="thumbnail">
                           <img src="img/nodata-available.jpg" class="img-responsive">
                       </div>
                    </div>
				  <?php  }

				    ?>
                </div>
            </div>

        </div>
    </div>

    </div>
  </div>
  <?php include "parts/footer-before-login.php"; ?>
</div>
    <!---jQuery-->
    <script src="js/jquery.min.js"></script>
    <!--jQuery End-->
    <!--ootstrap and green js-->
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/green.js"></script>
    <!---bootstrap and green js End-->
    <script>
	$(document).ready(function() {
    	$('#body').show();
    	$('.preloader-wrapper').hide();
	});
  </script>
    <!--Choosen js-->
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
    <!--Choosen js End-->
     <script>
	  function del_ss(ss_id)
  {
			$.ajax({
					type: "POST",
					url: "delete_ss_query",
					data: 'ss_id='+ss_id,
					success: function(data)
					{
						$('#remove'+ss_id+'').fadeOut('slow');
					}
				});

  }


   	(function($) {
    var $window = $(window),
        $html = $('.mobile-collapse');
			$window.width(function width(){
        		if ($window.width() > 991) {
            	return $html.addClass('in');
        	}
			$html.removeClass('in');
    		});
		})(jQuery);
    </script>
  </body>
</html>
<?php include'thumbnailjs.php';?>
