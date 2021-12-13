<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
include_once 'auth.php';
$mid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
if (isset($_GET['user_id'])) {
	$get_user_id = mysqli_real_escape_string($DatabaseCo->dbLink, $_GET['user_id']);
	$get_arr_username_email = $DatabaseCo->dbLink->query("select username,email,matri_id,mobile from register where status!='Suspended' and status!='Inactive' and matri_id='" . $get_user_id . "'");
} else {
	$get_arr_username_email = $DatabaseCo->dbLink->query("select username,email,matri_id,mobile from register where status!='Suspended' and status!='Inactive' and matri_id!='" . $_SESSION['user_id'] . "' and gender!='" . $_SESSION['gender123'] . "'");
}
if (isset($_POST['to_email'])) {
	$select = "select * from payment_view where pmatri_id='$mid'";
	$exe = $DatabaseCo->dbLink->query($select) or die(mysqli_error($DatabaseCo->dbLink));
	$fetch = mysqli_fetch_array($exe);
	$total_sms = $fetch['p_sms'];
	$used_sms = $fetch['r_sms'];
	$total_msg = $fetch['p_msg'];
	$used_msg = $fetch['r_msg'];
	$exp_date = $fetch['exp_date'];
	$today = date('Y-m-d');
	if ($total_msg != $used_msg && $exp_date > $today) {
	
	foreach ($_POST['to_email'] as $key => $val) {
			
				$from_id = $_SESSION['user_id'];
				$val = mysqli_real_escape_string($DatabaseCo->dbLink, $val);
				$get_to_id = mysqli_fetch_object($DatabaseCo->dbLink->query("select matri_id,mobile from register where email='" . $val . "'"));
				$to_id = $get_to_id->matri_id;
				$mobile= $get_to_id->mobile;
			    $msg_content = mysqli_real_escape_string($DatabaseCo->dbLink, htmlspecialchars($_POST['smscontent'], ENT_QUOTES));
				$sel = $DatabaseCo->dbLink->query("select * from  block_profile where block_by='$to_id' and block_to='$from_id'");
				$num = mysqli_num_rows($sel);
				$sel1 = $DatabaseCo->dbLink->query("select * from  block_profile where block_to='$to_id' and block_by='$from_id'");
				$num1 = mysqli_num_rows($sel1);
				if (isset($num) && $num > 0) {
					echo "<script>alert('" . $to_id . " has blocked you. You can\'t send him messages anymore...');</script>";
				}elseif(isset($num1) && $num1 > 0){
					echo "<script>alert('" . $from_id . " been blocked by you . Please unblock to send message...');</script>";
				} else {
					
					
	
    				$text = $msg_content ." ,From ".$mid;
    				$message = str_replace(" ", "%20", $text);
    				$mno = $mobile;
    //$mobile=substr($row1['code'],0,3);
   //$mno=substr($row1['mobile'],3,15);
	include 'mobile-apis.php';
	//$url;
	//$url="https://control.msg91.com/api/sendhttp.php?authkey=176253A9UrfOSn1RT59c79510&mobiles=$code$mno&message=$message&sender=SHMATE&route=4&country=0";
    $ret = file($url);	
					$sel = $DatabaseCo->dbLink->query("SELECT * FROM payments where pmatri_id='$mid'");
						$fet = mysqli_fetch_array($sel);
						$tot_sms = $fet['p_sms'];
						$use_sms = $fet['r_sms'];
						$use_sms = $use_sms + 1;
						if ($tot_sms >= $use_sms) {
							$update = "UPDATE payments SET r_sms='$use_sms' WHERE pmatri_id='$mid' ";
							$d = $DatabaseCo->dbLink->query($update);
						}
					echo "<script>alert('SMS Sent Successfully.');</script>";
					echo "<script>window.location='sms-sending';</script>";
				}
				
	}
}else{
		?>
		<div class="modal fade-in in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="close1();">&times;
        </button>
        <h4 class="modal-title" id="myModalLabel" style="color:red;">Upgrade Your Membership
        </h4>
      </div>
      <form name="MatriForm" id="MatriForm" class="form-horizontal" action="premium_member" method="post">
        <div class="form-group">
          <div class="col-sm-12">
            <h5>&nbsp;&nbsp;Please get the send message balance by upgrading your membership.
            </h5>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-6 text-center">
            <button class="btn gt-btn-orange btn-block gt-cursor" formaction="membershipplans">Upgrade Now
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
	
}
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
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom-responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/developer.css" rel="stylesheet">
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
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
    <script>
      function close1()
      {
        $('#myModal1').hide();
      }
    </script>
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
          <div class="col-xxl-13 col-xxl-offset-3 col-xl-13 col-xl-offset-3">
            <h2 class="gt-margin-top-0 gt-text-orange">
              <span class="gt-font-weight-300">SMS
              </span> - Send
            </h2>
            <p>Sent SMS to members from here.
            </p>
          </div>
          <?php include('parts/msg_left_menu.php'); ?>
          <div class="col-xxl-13 col-xl-12 gt-msg-board">
            <form id="" name="" method="post" action="">
              <div class="col-xxl-16 col-xl-16 gt-msg-top-strip gt-margin-top-10">
                <div class="form-group">
                  <label>
                    <h4>
                      To ,
                    </h4>
                  </label>
                  <select data-placeholder="Select Matri id to send message" class="chosen-select gt-form-control flat" multiple tabindex="4" name="to_email[]" data-validetta="required" id="to_email">
                    <option value="">
                    </option>
                    <?php while ($DatabaseCo->dbRow = mysqli_fetch_object($get_arr_username_email)) { ?>
                    <option value="<?php echo $DatabaseCo->dbRow->email; ?>">
                      <?php echo $DatabaseCo->dbRow->matri_id; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <textarea name="smscontent" class="gt-form-control"></textarea>
                  
                 </div>
                 <div class="form-group text-center">
                 	<input type="submit" value="SEND MESSAGE" name="sms" class="btn gt-btn-orange">

                 </div>
              </div>
            </form>
            
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
    <script src="js/jquery.validate.js">
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
        $window.width(function width() {
          if ($window.width() > 991) {
            return $html.addClass('in');
          }
          $html.removeClass('in');
        }
                     );
      }
      )(jQuery);
    </script>
    <script src="js/chosen.jquery.js" type="text/javascript">
    </script>
    <script src="js/prism.js" type="text/javascript" charset="utf-8">
    </script>
    <script type="text/javascript">
      var config = {
        '.chosen-select': {
        }
        ,
        '.chosen-select-deselect': {
          allow_single_deselect: true}
        ,
        '.chosen-select-no-single': {
          disable_search_threshold: 10}
        ,
        '.chosen-select-no-results': {
          no_results_text: 'Oops, nothing found!'}
        ,
        '.chosen-select-width': {
          width: "100%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
    </script>
    <script src="js/bootstrap-wysiwyg.js">
    </script>
    
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  

<script type="text/javascript" src="js/validetta.js">
</script>
<script type="text/javascript">
  $(document).ready(function() {
   
</script>

<script type="text/javascript">
  <?php if (isset($_GET['user_id']) && !isset($_GET['frwd'])) {
    ?>
      $.ajax({
      url: 'to_msg_compose',
      type: 'POST',
      data: 'msg_status=sent_msg&user_id=<?php echo mysqli_real_escape_string($DatabaseCo->dbLink, $_GET['user_id']); ?>',
      success: function(data) {
      $('#to_email').find('option').remove().end().append(data);
      $('#to_email').trigger("chosen:updated");
      var config = {
      '.chosen-select': {
    }
             ,
             '.chosen-select-deselect': {
             allow_single_deselect: true}
             ,
             '.chosen-select-no-single': {
             disable_search_threshold: 10}
             ,
             '.chosen-select-no-results': {
             no_results_text: 'Oops, nothing found!'}
             ,
             '.chosen-select-width': {
             width: "95%"}
             }
             for (var selector in config)
    {
      $(selector).chosen(config[selector]);
    }
  }
  ,
    error: function() {
      //called when there is an error
      //console.log(e.message);
    }
  }
  );
  <?php }
  elseif (isset($_GET['msg_id']) && !isset($_GET['frwd']) && !isset($_GET['inb'])) {
    ?>
      $.ajax({
      url: 'to_msg_compose',
      type: 'POST',
      data: 'msg_status=replay_msg&msg_id=' +<?php echo $_GET['msg_id'];
      ?>,
      success: function(data) {
      $('#to_email').find('option').remove().end().append(data);
      $('#to_email').trigger("chosen:updated");
      var config = {
      '.chosen-select': {
    }
             ,
             '.chosen-select-deselect': {
             allow_single_deselect: true}
             ,
             '.chosen-select-no-single': {
             disable_search_threshold: 10}
             ,
             '.chosen-select-no-results': {
             no_results_text: 'Oops, nothing found!'}
             ,
             '.chosen-select-width': {
             width: "95%"}
             }
             for (var selector in config)
    {
      $(selector).chosen(config[selector]);
    }
  }
  ,
    error: function() {
      //called when there is an error
      //console.log(e.message);
    }
  }
  );
  <?php
  }
  elseif (isset($_GET['msg_id']) && isset($_GET['frwd'])) {
    ?>
      $.ajax({
      url: 'to_msg_compose',
      type: 'POST',
      data: 'msg_status=forward_msg&msg_id=' +<?php echo $_GET['msg_id'];
      ?>,
      success: function(data) {
      $("#editor").html(data);
    }
             ,
             error: function() {
      //called when there is an error
      //console.log(e.message);
    }
  }
  );
  <?php
  }
  elseif (isset($_GET['msg_id']) && isset($_GET['inb'])) {
    ?>
      $.ajax({
      url: 'to_msg_compose',
      type: 'POST',
      data: 'msg_status=replay_msg_inbox&msg_id=' +<?php echo $_GET['msg_id'];
      ?>,
      success: function(data) {
      $('#to_email').find('option').remove().end().append(data);
      $('#to_email').trigger("chosen:updated");
    }
             ,
             error: function() {
      //called when there is an error
      //console.log(e.message);
    }
  }
  );
  <?php }
    ?>
</script>
