<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	
	$trans = array("(" =>"",")"=>"","-"=>""," "=>"","'"=>"");
	$cms_id=isset($_GET['cms_id'])?$_GET['cms_id']:'';
	$cms_id = strtr($cms_id, $trans);
	
	
	$res2=mysqli_fetch_object($DatabaseCo->dbLink->query("select * from cms_pages where cms_id='".$cms_id."' and status='APPROVED'" ));
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
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->

        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->
        
        <!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css">
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
  	<?php include "parts/header.php"; ?>
    <?php include "parts/menu-aft-login.php"; ?>
    <div class="container gt-margin-top-20">
    	<div class="row">
        	<div class="col-xs-16 col-lg-16 col-xxl-12 col-offset-2 col-xl-12 col-xl-offset-2">
            	<div class="gt-panel ">
                	<div class="gt-panel-border-orange">
            			<h2 class="gt-text-orange text-center">
                        	 <?php  if(isset($res2)){
									echo $res2->cms_title;
							}?>
                			
                		</h2>
                    </div>
            		<div class="gt-panel-body">
                    <?php  if(isset($res2)){
						echo htmlspecialchars_decode($res2->cms_content);	
					}?>
                      
                    	<p><?php ?></p>
                    </div>
            	</div>
        	</div>
    	</div>
    </div>
  	</div>
  		<?php include "parts/footer-before-login.php"; ?>
		</div>
   		<!-- Jquery --->
   	 	<script src="js/jquery.min.js"></script>
    	<!--- Jquery END --->
    
    	<!--- BOOTSTRAP AND GREEN JS--->
    	<script src="js/bootstrap.js"></script>
    	<script src="js/jquery.validate.js"></script>
    	<script src="js/green.js"></script> 
    	<!--- BOOTSTRAP AND GREEN JS END--->
        
		<!--- LOADER JS--->
    	<script> 
			$(document).ready(function() {
        	$('#body').show();
        	$('.preloader-wrapper').hide();
        	});
    	</script>
    	<!--- LOADER JS END --->
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