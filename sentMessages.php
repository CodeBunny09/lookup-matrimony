<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	include_once 'auth.php';

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
    
    <div class="container">
    	<div class="row">
        	<div class="col-xxl-13 col-xxl-offset-3 col-xl-13 col-xl-offset-3 text-center">
            	<h2 class="gt-margin-top-0 gt-margin-top-20 gt-text-orange">
                       <span class="gt-font-weight-300">Message</span> - Sent
                </h2>
                <p>Check all your sent messages from here.</p>
            </div>
        	<?php include('parts/msg_left_menu.php');?>
            <div class="col-xxl-13 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-msg-board" id="test-list">
              <div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-md-16">
                	<div class="row">
                		<div class="col-xxl-6 col-lg-8 col-xl-8 col-xs-16 col-sm-16 col-md-16 pull-right">
                    		<p class="demo demo4_top pull-right"></p>
                    	</div>
                    </div>
               </div>
               
              <div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-md-16 gt-msg-top-strip">
                  <div class="row">
                   		<div class="col-xxl-1 col-xl-1 col-lg-2 col-xs-2 col-sm-2 col-md-2 gt-margin-top-5 gt-margin-bottom-5">
                        	<input type="checkbox" onchange="checkAll(this);">
                        </div>
                   		<div class="dropdown col-xxl-2 col-lg-4 col-xl-3 col-xs-7 col-sm-7 col-md-7 gt-margin-bottom-5">
  							<button id="dLabel" class="btn btn-default btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    							Select <i class="fa fa-angle-down"></i>
    						</button>
  							<ul class="dropdown-menu" aria-labelledby="dLabel">
    							
                                <li>
                                	<a class="gt-cursor" title="Read" id="read_id">Read</a>
                                </li>
                                <li>
                                	<a class="gt-cursor" title="Unread" id="unread_id">Unreaded</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                	<a class="gt-cursor" title="All" id="read_all">All</a>
                                </li>
                                
  							</ul>
						</div>
                        <div class="dropdown col-xxl-2 col-xl-3 col-lg-4 col-xs-7 col-sm-7 col-md-7 gt-margin-bottom-5">
  							<button id="dLabel" class="btn btn-default btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    							Actions <i class="fa fa-angle-down"></i>
    						</button>
  							<ul class="dropdown-menu" aria-labelledby="dLabel">
    							<li>
                                	<a class="gt-cursor" title="Reply" id="replay_msg">Replay</a>
                                </li>
                                <li>
                                	<a class="gt-cursor" title="Forward" id="forward_msg">Forward</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                	<a class="gt-cursor" title="Mark as Important" id="important_msg">Mark As Important</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                	<a class="gt-cursor" title="Delete" id="delete_msg">Delete</a>
                                </li>
  							</ul>
						</div>
                        <div class="col-xxl-5 col-xl-6 col-md-16 col-lg-6 pull-right">
                        	<div class="input-group">
      							<input type="text" class="gt-form-control flat search" placeholder="Search Message By Matri Id">
      							<span class="input-group-btn">
        							<button class="btn btn-default gt-btn-lg flat" type="button"><i class="fa fa-search"></i></button>
     					   		</span>
    						</div>
                   
                        </div>
                  </div>
              </div>
              <div class="content4 col-xs-16 col-xxl-16 col-xl-16 gt-msg-dash">
                  
                  <div id="msg_result_data" class="row">
			      	<?php include('msg_result.php');?>
				  </div>	 
		          
                  
               </div>
               
            </div>
        </div>
    </div>
    <?php include "parts/footer-before-login.php"; ?>
	</div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.validate.js"></script>
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
	<script src="js/jquery.bootpag.js"></script>
    <script>
		$('.demo4_top,.demo4_bottom').bootpag({
    		total: 50,
    		page: 1,
    		maxVisible: 4,
    		leaps: true,
   			 firstLastUse: true,
    		 first: '←',
    		 last: '→',
    		wrapClass: 'pagination',
   		    activeClass: 'active',
            disabledClass: 'disabled',
            nextClass: 'next',
            prevClass: 'prev',
            lastClass: 'last',
            firstClass: 'first'
        }).on("page", function(event, num){
       $(".content4").html("Page " + num); // or some ajax content loading...
    }); 
	</script>
  </body>
</html>                                                                                                                              <?php include'thumbnailjs.php';?>                  
<!--list ul li with pagination and filter--> 
<script src="js/listpagination_search/list.js"></script>
<script src="js/listpagination_search/list.pagination.js"></script> 
<script type="text/javascript">
  var monkeyList = new List('test-list', {
    valueNames: ['name','name1','name2'],
    page: 10,
    plugins: [ ListPagination({
    }
                             ) ] 
  }
                           );
</script>
<script type="text/javascript">
  function checkAll(ele) {
    var checkboxes = document.getElementsByTagName('input');
    if (ele.checked) {
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type == 'checkbox') {
          checkboxes[i].checked = true;
        }
      }
    }
    else {
      for (var i = 0; i < checkboxes.length; i++) {
        console.log(i)
        if (checkboxes[i].type == 'checkbox') {
          checkboxes[i].checked = false;
        }
      }
    }
  }
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#replay_msg').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="msg_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                            );
      if(selectedOrderBy!='')
      {
        if(selectedOrderBy.length=='1')
        {
          $.ajax({
            url: 'msg_result',
            type: 'POST',
            data: 'msg_status=replay_msg&msg_id='+selectedOrderBy,
            success: function(data)
            {
              $('#msg_result_data').html(data);
              var monkeyList = new List('test-list', {
                valueNames: ['name','name1','name2'],
                page: 10,
                plugins: [ ListPagination({
                }
                                         ) ] 
              }
                                       );
            }
            ,
            error: function() {
              //called when there is an error
              //console.log(e.message);
            }
          }
                );
        }
        else
        {
          alert('Please select only one message to complete message reply.');
          return false;
        }
      }
      else
      {
        alert('Please select at list one message to complete message reply.');
        return false;
      }
    }
                          );
    $('#forward_msg').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="msg_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                            );
      if(selectedOrderBy!='')
      {
        if(selectedOrderBy.length=='1')
        {
          $.ajax({
            url: 'msg_result',
            type: 'POST',
            data: 'msg_status=forward_msg&msg_id='+selectedOrderBy,
            success: function(data) {
              $('#msg_result_data').html(data);
              var monkeyList = new List('test-list', {
                valueNames: ['name','name1','name2'],
                page: 10,
                plugins: [ ListPagination({
                }
                                         ) ] 
              }
                                       );
            }
            ,
            error: function() {
            }
          }
                );
        }
        else{
          alert('Please select only one message to complete message forward.');
          return false;
        }
      }
      else{
        alert('Please select at list one message to complete message forward.');
        return false;
      }
    }
                           );
    $('#refresh_msg').click(function(){
      $('#msg_result_data').empty();
      $.ajax({
        url: 'msg_result',
        type: 'POST',
        success: function(data) {
          $('#msg_result_data').html(data);
          var monkeyList = new List('test-list', {
            valueNames: ['name','name1','name2'],
            page: 10,
            plugins: [ ListPagination({
            }
                                     ) ] 
          }
                                   );
        }
        ,
        error: function() {
          //called when there is an error
          //console.log(e.message);
        }
      }
            );
    }
                           );
    $('#delete_msg').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="msg_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                            );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'msg_result',
          type: 'POST',
          data: 'msg_status=trash&msg_id='+selectedOrderBy,
          success: function(data) {
            $('#msg_result_data').html(data);
            var monkeyList = new List('test-list', {
              valueNames: ['name','name1','name2'],
              page: 10,
              plugins: [ ListPagination({
              }
                                       ) ] 
            }
                                     );
          }
          ,
          error: function() {
            //called when there is an error
            //console.log(e.message);
          }
        }
              );
      }
      else{
        alert('Please select at list one message to complete trash action.');
        return false;
      }
    }
                          );
    $('#important_msg').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="msg_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                            );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'msg_result',
          type: 'POST',
          data: 'msg_status=important&msg_id='+selectedOrderBy,
          success: function(data) {
            $('#msg_result_data').html(data);
            var monkeyList = new List('test-list', {
              valueNames: ['name','name1','name2'],
              page: 10,
              plugins: [ ListPagination({
              }
                                       ) ] 
            }
                                     );
          }
          ,
          error: function() {
            //called when there is an error
            //console.log(e.message);
          }
        }
              );
      }
      else{
        alert('Please select at list one message to complete important action.');
        return false;
      }
    }
                             );
    $('#read_id').click(function(){
      $.ajax({
        url: 'msg_result',
        type: 'POST',
        data: 'msg_read_type=read',
        success: function(data) {
          $('#msg_result_data').html(data);
          var monkeyList = new List('test-list', {
            valueNames: ['name','name1','name2'],
            page: 10,
            plugins: [ ListPagination({
            }
                                     ) ] 
          }
                                   );
        }
        ,
        error: function() {
          //called when there is an error
          //console.log(e.message);
        }
      }
            );
    }
                       );
    $('#unread_id').click(function(){
      $.ajax({
        url: 'msg_result',
        type: 'POST',
        data: 'msg_read_type=unread',
        success: function(data) {
          $('#msg_result_data').html(data);
          var monkeyList = new List('test-list', {
            valueNames: ['name','name1','name2'],
            page: 10,
            plugins: [ ListPagination({
            }
                                     ) ] 
          }
                                   );
        }
        ,
        error: function() {
          //called when there is an error
          //console.log(e.message);
        }
      }
            );
    }
                         );
    $('#read_all').click(function(){
      $.ajax({
        url: 'msg_result',
        type: 'POST',
        data: 'msg_read_type=read_all',
        success: function(data) {
          $('#msg_result_data').html(data);
          var monkeyList = new List('test-list', {
            valueNames: ['name','name1','name2'],
            page: 10,
            plugins: [ ListPagination({
            }
                                     ) ] 
          }
                                   );
        }
        ,
        error: function() {
          //called when there is an error
          //console.log(e.message);
        }
      }
            );
    }
                        );
  }
                   );
  $('[data-toggle="tooltip"]').tooltip({
    trigger: 'hover',
    'placement': 'top'
  }
                                      );
</script>


<script type="text/javascript">
  function importantfun(msg_id,msg_imp_status){
    if(msg_imp_status=='Yes')
    {
      var msg_imp='Yes';
    }
    else if(msg_imp_status=='No')
    {
      var msg_imp='No';
    }
    $.ajax({
      url: 'msg_result',
      type: 'POST',
      data: 'msg_important_status='+msg_imp+'&msg_id='+msg_id,
      success: function(data) {
        $('#msg_result_data').html(data);
        var monkeyList = new List('test-list', {
          valueNames: ['name','name1','name2'],
          page: 10,
          plugins: [ ListPagination({
          }
                                   ) ] 
        }
                                 );
      }
      ,
      error: function() {
        //called when there is an error
        //console.log(e.message);
      }
    }
          );
  }
</script>
