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

    

    <title><?php echo $configObj->getConfigFname(); ?></title>

	<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />

	<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  

	<link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>



    <!-----------------------------------Greenstrap------------------------------------>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/custom-responsive.css" rel="stylesheet">

    <link href="css/custom.css" rel="stylesheet">

	 <link href="css/developer.css" rel="stylesheet">

    <!-----------------------------------Greenstrap End-------------------------------->

    <!-----------------------------------Font Awsome----------------------------------->

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >

    <!-----------------------------------Font Awsome End------------------------------->

    <!-----------------------------------choosen------------------------------------>

    <link rel="stylesheet" href="css/prism.css">

    <link rel="stylesheet" href="css/chosen.css">

     <!-----------------------------------choosen js------------------------------------>

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

  <div id="wrap">

  	<div id="main">

    <?php include "parts/header.php"; ?>

    <?php include "parts/menu-aft-login.php"; ?>

    <div class="container" >

    	<div class="row">

        	<div class="col-xs-16 col-lg-16 col-xxl-16 col-xl-16 ">

            	<h2>

                	Chat History
                </h2>

                <p>

                	All saved searches are here,you can just click on single button and you can search your saved criteria.

                </p>

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

            	 <!----------left option visible only in small---------------->

    			<div class="">

            	<a class="btn gt-btn-green gt-margin-bottom-20 visible-xs visible-lg visible-md visible-sm" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >

 					Options <i class="fa fa-cerat-bottom"></i>

				</a>

                <div class="collapse mobile-collapse " id="collapseExample">

                <div class="gt-left-opt-msg">

            		<ul>

                		<li>

                    		<a href="inboxMessages.php"><i class="fa fa-paperplane gt-margin-right-10"></i>Send Message</a>

                    	</li>

                    	<li>

                    		<a href="sentMessages.php"><span class="pull-left">Sent</span><span class="pull-right badge">10</span></a>

                    	</li>

                	</ul>

                </div>

            	<div class="gt-left-opt-msg">

            		<ul>

                    	<li>

                    		<a class="gt-bg-orange text-center gt-text-white"><i class="fa fa-envelope gt-margin-right-10"></i>Messages</a>

                    	</li>

                		<li>

                    		<a href="inboxMessages.php"><span class="pull-left">Inbox</span><span class="pull-right badge">10</span></a>

                    	</li>

                    	<li>

                    		<a href="sentMessages.php"><span class="pull-left">Sent</span><span class="pull-right badge">10</span></a>

                    	</li>

                	</ul>

                </div>

                <div class="gt-left-opt-msg">

            		<ul>

                    	<li>

                    		<a class="gt-bg-orange text-center gt-text-white"><i class="fa fa-star gt-margin-right-10"></i>Interest</a>

                    	</li>

                		<li>

                    		<a href="inboxMessages.php"><span class="pull-left">Received</span><span class="pull-right badge">10</span></a>

                    	</li>

                    	<li>

                    		<a href="sentMessages.php"><span class="pull-left">Sent</span><span class="pull-right badge">10</span></a>

                    	</li>

                	</ul>

                </div>

                <div class="gt-left-opt-msg">

            		<ul>

                    	<li>

                    		<a class="gt-bg-orange text-center gt-text-white"><i class="fa fa-picture-o gt-margin-right-10"></i>Photo Request</a>

                    	</li>

                		<li>

                    		<a href="inboxMessages.php"><span class="pull-left">Received</span><span class="pull-right badge">10</span></a>

                    	</li>

                    	<li>

                    		<a href="sentMessages.php"><span class="pull-left">Sent</span><span class="pull-right badge">10</span></a>

                    	</li>

                	</ul>

                </div>

                </div>

            	</div>

                <div class="clearfix"></div>

                <!---------- left option visible only in small end------------->

            	

            </div>

        	<div class="col-xxl-13 col-xl-12 col-lg-16 col-md-16 col-sm-16">

            	<div class="row">
					<div class="gt-panel gt-panel-border-orange">
                    	<div class="gt-panel-head">
                        	<h4>Chat History</h4>
                        </div>
                        <div class="panel-body">
                        	<form class="gt-margin-bottom-20">
                            	<div class="form-group">
                                	<input type="text" placeholder="Enter User Id" class="gt-form-control">
                                </div>
                                <div class="">
                                	<h5>
                                    	Chat History With Priyanka p(Gt112)
                                    </h5>
                                    
                                </div>
                            </form>
                            <div class="row">
                            	<div class="col-xxl-16 gt-margin-bottom-15">
                                	<div class="col-xxl-1">
                                    	<img src="img/168413723bd00123-world-prem.jpg" class="img-circle" style="width:40px;height:40px">
                                		
                                    </div>
                                	<div class="col-xxl-12">
                                    	<a href="">
                                			<span>Jay P(GT111)</span>
                                    	</a>
                                    	<p>
                                    	sadasjdksjdkjsdjsaldkjsadlksalkdjasljdalsjdklasljdljl
                                       	</p>
                                    </div>
                                    <div class="col-xxl-3">
                                    	29/01/2016 00:06
                                    </div>
                                </div>
                                <div class="col-xxl-16 gt-margin-bottom-15">
                                	<div class="col-xxl-1">
                                    	<img src="img/user_female.png" class="img-circle" style="width:40px;height:40px">
                                		
                                    </div>
                                	<div class="col-xxl-12">
                                    	<a href="">
                                			<span>Priyanka P(GT112)</span>
                                    	</a>
                                    	<p>
                                    	sadasjdksjdkjsdjsaldkjsadlksalkdjasljdalsjdklasljdljl
                                       	</p>
                                    </div>
                                    <div class="col-xxl-3">
                                    	29/01/2016 00:06
                                    </div>
                                </div>
                            </div>
                        </div>
                	</div>



                </div>

            </div>

            

        </div>

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
    <script src="js/jquery.validate.js"></script>

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

</html>                                                                                                                              <?php include'thumbnailjs.php';?>                  