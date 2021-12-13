<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css">
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
        	  <aside class="col-xxl-4 col-xl-4 col-xs-16">
                <a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20 gt-margin-top-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
                        Options <i class="fa fa-angel-down"></i>
                    </a>
                <div class="collapse mobile-collapse" id="collapseExample">
                <?php include "parts/match-sidebar.php"; ?>
                <?php include "parts/left_panel_spotlight.php"; ?>
                </div>
            </aside>
           
            <div class="col-xxl-12 col-xl-12 col-xs-16">
            	<h3 class="text-center gt-text-orange">Preferred Match</h3>
                <article class="text-center">
                	<p>
                    	Preferred match is the profile show in perticular criteria at its best.its help you to find out your life partner easily.
                    </p>
                </article>                 
                 <div id="loaderID" style="position:fixed;  left:50%; top:50%; z-index:-1; opacity:0">
           		    <div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange"><font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;</font></div>
                 </div>	
                 <div id="pagination"></div> 
              </div>      
        </div>
    </div>
    <?php include "parts/footer-before-login.php"; ?>
	</div>
    <!------------------------------------------jQuery------------------------------------------------->
    <script src="js/jquery.min.js"></script>
    <!------------------------------------------jQuery End--------------------------------------------->
    <!------------------------------------------bootstrap and green js--------------------------------->
    <script src="js/bootstrap.js"></script>
    <script src="js/green.js"></script>
    <script>
	$(document).ready(function() {
    	$('#body').show();
    	$('.preloader-wrapper').hide();
	});
  </script>
    <!-------------------------------------bootstrap and green js End--------------------------------->
    <!--------------------------------------owl crousel js-------------------------------------------->
     <script src="js/owl.carousel.min.js"></script>
     
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

	<!--------------------------------------owl crousel js end-------------------------------------------->
    <script type="text/javascript">
	$(document).ready(function() {
		
		var dataString = 'result_status=preferred&actionfunction=showData' + '&page=1';
		
		$("#loaderID").css("opacity",1);
		$("#loaderID").css("z-index",9999);
			
		
		$.ajax({			
			 url:"dbmanupulate1",
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
		   
		   var dataString = 'result_status=preferred&actionfunction=showData' + '&page='+$page;
		   
			$.ajax({
			url:"dbmanupulate1",
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
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  