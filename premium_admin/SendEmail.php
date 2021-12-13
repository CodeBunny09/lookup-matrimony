<?php 
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$SQL_STATEMENT='';
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{      
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
if(isset($_POST['sendEmail'])){
$subject=$_REQUEST['subject'];
$message=$_REQUEST['msg'];	
$website =  $configObj->getConfigName();
$webfriendlyname =  $configObj->getConfigFname();
$from = $configObj->getConfigFrom();
switch($ACTION){
case 'SEND':
include ('phpmailer/phpmailer.php');	
ob_start();
include ("email_format.php");
$html_message=ob_get_clean();
if(in_array('selectall',$_REQUEST['emailto'])){
	$status=$_REQUEST['status'];
	$sql=$DatabaseCo->dbLink->query("select email,mobile from register_view where status='$status'");
	$emailto='';
	while($row=mysqli_fetch_array($sql)){
		if($row['email']!=''){
			$emailto.= $row['email'].",";
			//$mail->addAddress($emailto);
		}
	}
	$email=str_ireplace(",","','",$emailto);	
	$sub_email=substr($email,0,-3);				
	$email123="'$sub_email'";
	
}else{
	//$emailto=implode(",",$_REQUEST['emailto']);
	//$email123="$emailto";
    $to=$_REQUEST['emailto'];
	foreach ($to as $address) {
		$mail->addAddress($address);
		//print_r($address);
	}
	//$mail->addAddress($to);
}	
//$mail->addAddress($emailto);
$mail->Subject= $subject;
$mail->Body= $html_message;
$mail->send();
/*$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
$headers .= "BCC: " . $email123 . "\r\n";
mail($from, $subject, $html_message, $headers);*/
    
break;	  
}
$statusObj = handle_post_request("SEND",$SQL_STATEMENT,$DatabaseCo);
$status_MESSAGE = $statusObj->getstatusMessage();
}
else
{
$statusObj = new status();
$statusObj->setActionSuccess(false);
$status_MESSAGE = "Please select value to complete action.";	  
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Send Email
    </title>
    <meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
    <meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
    <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
     <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->
    <!-- IONICONS -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- IONICONS END-->    
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
    <!-- Bootstrap 3.3.2 --> 
    <link rel="stylesheet" href="chosen_v0.13.0/chosen.min.css"/>  
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    <!-------------------Validation css ------------------>
    <link rel="stylesheet" href="../css/validate.css">
    <!-------------------Validation css------------------>
  </head>
  <body class="skin-blue">
    <!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
          <div class="spinner"></div>
        </div>
        <!-- ICON LOADER END-->
  <div class="wrapper" style="display:none" id="body">
      <?php include "page-part/header.php"; ?> 
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "page-part/left_panel.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="lightGrey">
            Send Email To
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active">Send Email To
            </li>
          </ol>
        </section>
        <?php
			if(!empty($status_MESSAGE))
			{	
			if($statusObj->getActionSuccess()){
			echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$status_MESSAGE."</div>";
			}else{
			echo  "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$status_MESSAGE."</li></ul></div>";		
			}
			}
			?>     
        <?php
		$success= isset($_GET['success']) ? $_GET['success'] :"" ;
		if(!empty($success))
		{
		echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
		}
		?>   
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-success">
                <div class="box-header">
                  
                  <h4> <i class="fa fa-envelope">
                  </i>&nbsp;&nbsp;Send Email To
                  </h4>
                  <!-- tools box -->
                </div>
                <form action="" method="post" id="action_form">
                  <div class="box-body">
                    <div class="form-group">
                      <select class="form-control form-flat" name="status" id="status" onChange="getdetail(this.value);" data-validetta="required">
                        <option value="">Select Status
                        </option>
                        <option value="Active">Active Members
                        </option>
                        <option value="Inactive">Inactive Members
                        </option>
                        <option value="Paid">Paid Members
                        </option>
                        <option value="Featured">Featured Members
                        </option>
                        <option value="Suspended">Suspended Members
                        </option>
                      </select>
                      <div id="status1">
                      </div>
                    </div>
                    <div class="form-group">
                      <select multiple class="chzn-select-width form-control" tabindex="16" name="emailto[]" data-placeholder="Email to:" style="height:34px !important;" id="email123" data-validetta="required">
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" placeholder="Subject" data-validetta="required"/>
                    </div>
                    <div>
                      <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="msg" data-validetta="required"></textarea>
                    </div>
                  </div>
                  <div class="box-footer">
                  	<div class="row">
                    	<div class="col-xs-12 text-center">
                    		<button class="btn btn-green btn-lg" id="sendEmail" name="sendEmail"onClick="submitActionForm('SEND');">Send Email</button>
                    	</div>
                    </div>
                  </div>
                  <input  type="hidden" name="action" value="" id="action"/>
                </form>
              </div>
            </div>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php include "page-part/footer.php"; ?>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <script type="text/javascript">
      function getdetail(val) {
        $("#status1").html('<img src="../img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        $.ajax({
          type: "POST",
          url: "get_email_list",
          data:'status_name='+val,
          success: function(data){
            $('#email123').find('option').remove().end().append(data);
            $('#email123').trigger('liszt:updated');
            $("#status1").html('');
          }
        }
              );
      }
    </script>
    <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript">
    </script>
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">
      setPageContext("send-email","email-list");
    </script>	
    <script src="../js/validetta.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      $(function(){
        $('#action_form').validetta({
          errorClose : false,
          realTime : true
        }
       );
      }
       );
    </script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>    
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js">
    </script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript">
    </script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript">
    </script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript">
    </script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript">
    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript">
    </script>
    <script src="chosen_v0.13.0/chosen.jquery.js" type="text/javascript">
    </script>
    <script type="text/javascript"> 
      var config = {
        '.chzn-select'           : {
        }
        ,
        '.chzn-select-deselect'  : {
          allow_single_deselect:true}
        ,
        '.chzn-select-no-single' : {
          disable_search_threshold:10}
        ,
        '.chzn-select-no-results': {
          no_results_text:'Oops, nothing found!'}
        ,
        '.chzn-select-width'     : {
          width:"100%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
    </script>
  </body>
</html>