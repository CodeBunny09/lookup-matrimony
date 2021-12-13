<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	include_once 'auth.php';
	
	$mid=$_SESSION['user_id']?$_SESSION['user_id']:'';
	
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
     <div class="preloader-wrapper text-center">
        	<div class="loader"></div>
            <h5>Loading...</h5>
        </div>
    <div id="body" style="display:none">
    <?php include "parts/header.php"; ?>
    <?php include "parts/menu-aft-login.php"; ?>
    
    <div class="container gt-margin-top-20">
    	<div class="row">
        	<aside class="col-xxl-12 col-xxl-offset-4 col-xl-12 col-xl-offset-4 text-center">
            	<h3 class="gt-margin-top-0 gt-text-orange">
                       Shortlisted Member Profile
                </h3>
                <article>
                	<p>
                    	You can check all of your shortlisted members list here.
                    </p>
                </article>
                
            </aside>
        	<div class="col-xxl-4 col-xl-4 gt-left-opt-msg">
            	<a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
 					Options <i class="fa fa-angle-down"></i>
				</a>
                <div class="collapse mobile-collapse" id="collapseExample">
                	<?Php include "parts/left_panel.php"; ?>
 				</div>
           	</div>
            <div class="col-xxl-12 col-xl-12 col-xs-16">
            <div id="loaderID" style="position:fixed; left:50%; top:50%; z-index:-1; opacity:0">
           		    <div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange"><font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;</font></div>
                 </div>	
                 <div id="pagination"></div>
                 <div class="clearfix"></div>
           </div>      
        </div>
    </div>
    <?php include "parts/footer-before-login.php"; ?>

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
			$window.width(function width(){
        		if ($window.width() > 991) {
            	return $html.addClass('in');
        	}
			$html.removeClass('in');
    		});
		})(jQuery);
    </script>
	
<script type="text/javascript">
	$(document).ready(function() {
		
		var dataString = 'result_status=shortlist&actionfunction=showData' + '&page=1';
		
		$("#loaderID").css("opacity",1);
		$("#loaderID").css("z-index",9999);
			
		
		$.ajax({			
			 url:"dbmanupulate3",
			 type:"POST",
			 data:dataString,
			 cache: false,
			 success: function(response)
			 {
			  
			  $("#loaderID").css("opacity",0);
			  $("#loaderID").css("z-index",-1);
			  $('#pagination').html(response);
				
			}
			
		   });
		$('#pagination').on('click','.page-numbers',function(){
			$("#loaderID").css("opacity",1);
			$("#loaderID").css("z-index",9999);
			
		   $page = $(this).attr('href');
		   $pageind = $page.indexOf('page=');
		   $page = $page.substring(($pageind+5));
		   
		   var dataString = 'result_status=shortlist&actionfunction=showData' + '&page='+$page;
		   
			$.ajax({
			url:"dbmanupulate3",
			type:"POST",
			data:dataString,
			cache: false,
			success: function(response)
			{
			  $("#loaderID").css("opacity",0);
			  $("#loaderID").css("z-index",-1);
			  $('#pagination').html(response);
			}
		  });
		return false;
		});
		
	});
</script>
	
  </body>
</html> 
<?php include'thumbnailjs.php';?>                  