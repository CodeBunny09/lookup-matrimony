<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
include_once 'auth.php';
$mid=$_SESSION['user_id']?$_SESSION['user_id']:'';
?>
<?php if(isset($_GET['mp-rem-id'])){
$DatabaseCo->dbLink->query("update reminder set reminder_view_status='No' where rem_id='".$_GET['mp-rem-id']."'");  
}?>
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
    <title>
      <?php echo $configObj->getConfigFname(); ?>
    </title>
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
    <!-- ICON LOADER-->
    <div class="preloader-wrapper text-center">
      <div class="loader">
      </div>
      <h5>Loading...
      </h5>
    </div>
    <!-- ICON LOADER END-->
    <div id="body" style="display:none">
      <?php include "parts/header.php"; ?>
      <?php include "parts/menu-aft-login.php"; ?>
      <div class="container gt-margin-top-20">
        <div class="row">
          <div class="col-xxl-12 col-xxl-offset-4 col-xl-12 col-xl-offset-4 text-center">
            <h3 class="gt-margin-top-0 gt-text-orange">
              Photo Password Request
            </h3>
            <article>
              <p>
                With this tabs(photo req sent and photo req received) you can check all your photo req send and received.
              </p>
            </article>
          </div>
          <div class="col-xxl-4 col-xl-4 gt-left-opt-msg">
            <a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
              Options  
              <i class="fa fa-angle-down">
              </i>
            </a>
            <div class="collapse mobile-collapse" id="collapseExample">
              <?php include "parts/left_panel.php"; ?>
            </div>
          </div>
          <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-exp-main">
            <div class="alert alert-danger" role="alert">
              <div class="row">
                <div class="col-xxl-16 col-xs-16">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;
                    </span>
                  </button>
                </div>
                <div class="col-xxl-16 col-xs-16">
                  <h4 class="">
                    <i class="fa fa-cog gt-text-blue gt-margin-right-10 fa-spin">
                    </i>Photo Privacy
                  </h4>
                  <p>
                    You can set you photo privacy with our settings tab.
                  </p>
                  <a href="settings?photoVisiblity" class="btn btn-danger">
                    Change Photo Settings 
                    <i class="fa fa-caret-right gt-margin-right-10">
                    </i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-md-16">
          
              <div class="row" id="exp-1">
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include "parts/footer-before-login.php"; ?>
    </div>
   
    <script src="js/jquery.min.js">
    </script>
    
    <script src="js/bootstrap.js">
    </script>
    <script src="js/green.js">
    </script>
    <script>
      $(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
      }
                       );
    </script>
    
    <script>
      $('[data-toggle="popover"]').popover({
        trigger: 'click',
        'placement': 'top'
      }
                                          );
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
        }
                     );
      }
      )(jQuery);
    </script>
    <script src="js/jquery.bootpag.js">
    </script>
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
      }
        ).on("page", function(event, num){
        $(".content4").html("Page " + num);
        // or some ajax content loading...
      }
                                               );
    </script>
    <script type="text/javascript">
      $('#exp-1').on('click','.page-numbers',function(){
       
        if($(".xyz.active").attr("id")=='sent_all_define')
        {
          var exp_status='sent_all_request';
        }
        else if($(".xyz.active").attr("id")=='receive_all_define'){
          var exp_status='receive_all_request';
        }
        
        $page = $(this).attr('href');
        $pageind = $page.indexOf('page=');
        $page = $page.substring(($pageind+5));
        var dataString = 'exp_status='+exp_status+'&actionfunction=showData' + '&page='+$page;
        $.ajax({
          url:"parts/photo-password",
          type:"POST",
          data:dataString,
          cache: false,
          success: function(response)
          {
            $('#exp-1').html(response);
          }
        }
              );
        return false;
      }
                    );
      $('#exp-link-1').on('click',function(){
        getexpsentdata();
      }
                         );
      function getphotopasssent(){
        $.ajax({
          url: 'parts/photo-password',
          type: 'POST',
          data: 'exp_status=sent_all_request&actionfunction=showData' + '&page=1',
          success: function(data) {
            $("#loader").fadeOut('slow');
            $('#exp-1').html(data);
            $('#exp-1').addClass('active');
          }
          ,
          error: function() {
            //called when there is an error
            //console.log(e.message);
          }
        }
              );
      }
      function getphotopassreceived(){
        $.ajax({
          url: 'parts/photo-password',
          type: 'POST',
          data: 'exp_status=receive_all_request&actionfunction=showData' + '&page=1',
          success: function(data) {
            $("#loader").fadeOut("slow");
            $('#exp-1').html(data);
            $("#exp-1").addClass('active');
            $("#exp-1-a").addClass('active');
          }
          ,
          error: function() {
            //called when there is an error
            //console.log(e.message);
          }
        }
              );
      }
      $(document).ready(function(e) {
        getphotopasssent();
		   
      }
                       );
    </script>
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
