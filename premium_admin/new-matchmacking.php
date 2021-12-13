<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
unset($_SESSION['memstatus']);
unset($_SESSION['m_status']);
$search_case = false;
$member_status = "";
if(isset($_GET['member_status']))
{
$member_status = $_GET['member_status'];
$_SESSION['member_status'] = $_GET['member_status'];
}
else if(isset($_GET['page']))
{
$member_status = $_SESSION['member_status'];
}
else
{
$_SESSION['member_status'] = "all";
$member_status = "all";
}
if(isset($_GET['option']) && $_GET['option']=='clear_search')
{
unset($_SESSION['search_title']);
unset($_SESSION['where_clause']);
unset($_SESSION['search_action']);
$search_case = false;
}
$search_title = "";
$where_clause = "";
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{     
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
if(isset($_POST['index_id']))
{
$index_id_arr = $_POST['index_id'];
$index_id_val = "(";
foreach($index_id_arr as $index_id)
{
$index_id_val .=	$index_id.",";
}
$index_id_val = substr($index_id_val, 0, -1);
$index_id_val .=")";
$website =  $configObj->getConfigName();
$webfriendlyname =  $configObj->getConfigFname();
$from = $configObj->getConfigFrom();
switch($ACTION)
{
case 'DELETE':		
$result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Delete Member'");
$rowcs5 = mysqli_fetch_array($result45);
$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
$trans = array("webfriendlyname" =>$webfriendlyname);
$email_template = strtr($email_template, $trans);
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
foreach($index_id_arr as $index_id){
	$select=$DatabaseCo->dbLink->query("select email,photo1,photo2,photo3,photo4,photo5,photo6,matri_id  from register where index_id =".$index_id);
	$row = mysqli_fetch_array($select);
	is_file(unlink("../my_photos/".$row['photo1']));
	is_file(unlink("../my_photos_big/".$row['photo1']));
	is_file(unlink("../my_photos/".$row['photo2']));
	is_file(unlink("../my_photos_big/".$row['photo2']));
	is_file(unlink("../my_photos/".$row['photo3']));
	is_file(unlink("../my_photos_big/".$row['photo3']));
	is_file(unlink("../my_photos/".$row['photo4']));
	is_file(unlink("../my_photos_big/".$row['photo4']));
	is_file(unlink("../my_photos/".$row['photo5']));
	is_file(unlink("../my_photos_big/".$row['photo5']));
	is_file(unlink("../my_photos/".$row['photo6']));
	is_file(unlink("../my_photos_big/".$row['photo6'])); 
	$email = $row['email'];
mail($email, $subject, $email_template, $headers);
$del_membership =$DatabaseCo->dbLink->query("delete from  payments where pmatri_id ='".$row['matri_id']."'");	   	
}
$SQL_STATEMENT =  "delete from  register where index_id in ".$index_id_val;
break;	  
case 'Active':
$SQL_STATEMENT =  "update register set status='Active',fstatus='' where index_id in ".$index_id_val;
$result45 =$DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Active Member'");
$rowcs5 = mysqli_fetch_array($result45);
$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
$trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website);
$email_template = strtr($email_template, $trans);
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
$select=$DatabaseCo->dbLink->query("select email from register where index_id in ".$index_id_val);
while ($row = mysqli_fetch_array($select))
{
$email = $row['email'];
mail($email, $subject, $email_template, $headers);
}
break;
case 'Inactive':
$SQL_STATEMENT =  "update  register set status='Inactive',fstatus='' where index_id in ".$index_id_val;	
break;
case 'Suspended':
$SQL_STATEMENT =  "update  register set status='Suspended',fstatus='' where index_id in ".$index_id_val;
 $result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Suspend Member'");
$rowcs5 = mysqli_fetch_array($result45);
$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
$trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website);
$email_template = strtr($email_template, $trans);
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";
$select=$DatabaseCo->dbLink->query("select email from register_view where index_id in ".$index_id_val);
while ($row = mysqli_fetch_array($select))
{
$email = $row['email'];
mail($email, $subject, $email_template, $headers);
}		
break;
}
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$status_MESSAGE = $statusObj->getstatusMessage();
}
else if($ACTION=='SEARCH')
{
$search_case = true;
$search_title = isset($_POST['search_title'])?$_POST['search_title']:"";
$where_clause = isset($_POST['where_clause'])?$_POST['where_clause']:"";
$_SESSION['search_title'] = $search_title;
$_SESSION['where_clause'] = stripslashes($where_clause);
$_SESSION['search_action'] = 'SEARCH';
}
else
{
$statusObj = new status();
$statusObj->setActionSuccess(false);
$status_MESSAGE = "Please select value to complete action.";	  
}
}
if(isset($_SESSION['search_action']) && $_SESSION['search_action']=='SEARCH')
{
$search_case = true;
$search_title = $_SESSION['search_title'];
$where_clause =stripslashes($_SESSION['where_clause']);} 
if(isset($_POST['search']))
{
if(isset($_POST['gender']) && $_POST['gender']!='')
{
$_SESSION['search_gender']=$_POST['gender'];
}
else
{
unset($_SESSION['search_gender']);   
}
if(isset($_POST['keyword']) && $_POST['keyword']!='')
{
$_SESSION['search_keyword']=$_POST['keyword'];
}
else
{
unset($_SESSION['search_keyword']); 
}
if(isset($_POST['cnt_name']) && $_POST['cnt_name']!='')
{
$_SESSION['search_cntnm']=$_POST['cnt_name'];  
}
else
{
unset($_SESSION['search_cntnm']);
}
if(isset($_POST['state_name']) && $_POST['state_name']!='')
{
$_SESSION['search_statenm']=$_POST['state_name'];  
}
else
{
unset($_SESSION['search_statenm']);  
}
if(isset($_POST['city_name']) && $_POST['city_name']!='')
{
$_SESSION['search_citynm']=$_POST['city_name'];  
}
else
{
unset($_SESSION['search_citynm']);
}
if(isset($_POST['religion_name']) && $_POST['religion_name']!='')
{
$_SESSION['search_relnm']=$_POST['religion_name'];  
}
else
{
unset($_SESSION['search_relnm']);
}
if(isset($_POST['caste_name']) && $_POST['caste_name']!='')
{
$_SESSION['search_castenm']=$_POST['caste_name'];  
}
else
{
unset($_SESSION['search_castenm']);
}
if(isset($_POST['country_id']) && $_POST['country_id']!='')
{
$_SESSION['search_country']=$_POST['country_id'];  
}
else
{
unset($_SESSION['search_country']);
}
if(isset($_POST['state_id']) && $_POST['state_id']!='')
{
$_SESSION['search_state']=$_POST['state_id'];  
}
else
{
unset($_SESSION['search_state']); 
}
if(isset($_POST['city_id']) && $_POST['city_id']!='')
{
$_SESSION['search_city']=$_POST['city_id'];  
}
else
{
unset($_SESSION['search_city']); 
}
if(isset($_POST['religion_id']) && $_POST['religion_id']!='')
{
$_SESSION['search_religion']=$_POST['religion_id'];  
}
else
{
unset($_SESSION['search_religion']); 
}
if(isset($_POST['caste_id']) && $_POST['caste_id']!='')
{
$_SESSION['search_caste']=$_POST['caste_id'];  
}
else
{
unset($_SESSION['search_caste']);
}
}
elseif(isset($_GET['clear-filter']))
{
unset($_SESSION['search_gender']); 
unset($_SESSION['search_keyword']);
unset($_SESSION['search_country']);
unset($_SESSION['search_state']);
unset($_SESSION['search_city']);
unset($_SESSION['search_religion']);
unset($_SESSION['search_caste']);
unset($_SESSION['search_castenm']);
unset($_SESSION['search_relnm']);
unset($_SESSION['search_citynm']);
unset($_SESSION['search_statenm']);
unset($_SESSION['search_cntnm']);  
}
else
{
unset($_SESSION['search_gender']); 
unset($_SESSION['search_keyword']);
unset($_SESSION['search_country']);
unset($_SESSION['search_state']);
unset($_SESSION['search_city']);
unset($_SESSION['search_religion']);
unset($_SESSION['search_caste']);
unset($_SESSION['search_castenm']);
unset($_SESSION['search_relnm']);
unset($_SESSION['search_citynm']);
unset($_SESSION['search_statenm']);
unset($_SESSION['search_cntnm']);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Matchmaking
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
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
    <!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
    <!-- MODAL CSS -->
    <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
    <link rel="stylesheet" type="text/css" href="css/libs/select2.css"/>
    <!-- MODAL CSS END-->
   <!-- iCheck -->
    <script type="text/javascript">
      function memstatus(status){
        var dataString = 'actionfunction=showData' + '&page=1&status='+status;
        $("#loaderID").css("opacity",1);
        $("#loaderID").css("z-index",9999);
        $.ajax({
          url:"web-services/memres",
          type:"POST",
          data:dataString,
          cache: false,
          success: function(response)
          {
            $("#loaderID").css("opacity",0);
            $("#loaderID").css("z-index",-1);
            $('#result').html('');
            $('#result').html(response);
            $('.active').removeClass('active');
            $('#'+status+'').addClass('active');
            paggination();
          }
        }
              );
      }
      function paggination(status){
        $('#result').on('click','.page-numbers',function(){
          $("#loaderID").css("opacity",1);
          $("#loaderID").css("z-index",9999);
          $page = $(this).attr('href');
          $pageind = $page.indexOf('page=');
          $page = $page.substring(($pageind+5));
          var dataString = 'actionfunction=showData' + '&page='+$page;
          $.ajax({
            url:"web-services/memres",
            type:"POST",
            data:dataString,
            cache: false,
            success: function(response)
            {
              $("#loaderID").css("opacity",0);
              $("#loaderID").css("z-index",-1);
              $('#chkall').attr('checked', false);
              $('#result').html(response);
            }
          }
                );
          return false;
        }
                       );
      }
    </script>
    <script>
      function checkAll(ele) {
        var checkboxes = $('input[name="action_id"]');
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
      function deleteexp(id){
        $('#delsentacceptall'+id+'').fadeIn();
        $.ajax({
          url:"delete_expressinterest.php",
          type:"POST",
          data:'exp_id='+id,
          cache: false,
          success: function()
          {
            $('#delsentacceptall'+id+'').fadeOut();
            getexpsentpendingdata();
          }
        }
              );
      }
      function delete_user(){
        var selectedOrderBy = new Array();
        $('input[name="action_id"]:checked').each(function() {
          selectedOrderBy.push(this.value);
        }
                                                 );
        if(selectedOrderBy!='')
        {
          $.ajax({
            url: 'user_action',
            type: 'POST',
            data: 'ac_status=trash_all&user_id='+selectedOrderBy,
            success: function(data) {
              allmatch();
              userstatusbtn();
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
      function active(){
        var selectedOrderBy = new Array();
        $('input[name="action_id"]:checked').each(function() {
          selectedOrderBy.push(this.value);
        }
                                                 );
        if(selectedOrderBy!='')
        {
          $.ajax({
            url: 'user_action',
            type: 'POST',
            data: 'ac_status=active&user_id='+selectedOrderBy,
            success: function(data) {
              allmatch();
              userstatusbtn();
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
          alert('Please select at list one message to complete active action.');
          return false;
        }
      }
      function inactive(){
        var selectedOrderBy = new Array();
        $('input[name="action_id"]:checked').each(function() {
          selectedOrderBy.push(this.value);
        }
                                                 );
        if(selectedOrderBy!='')
        {
          $.ajax({
            url: 'user_action',
            type: 'POST',
            data: 'ac_status=inactive&user_id='+selectedOrderBy,
            success: function(data) {
              allmatch();
              userstatusbtn();
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
          alert('Please select at list one message to complete inactive action.');
          return false;
        }
      }
      function suspended(){
        var selectedOrderBy = new Array();
        $('input[name="action_id"]:checked').each(function() {
          selectedOrderBy.push(this.value);
        }
                                                 );
        if(selectedOrderBy!='')
        {
          $.ajax({
            url: 'user_action',
            type: 'POST',
            data: 'ac_status=suspended&user_id='+selectedOrderBy,
            success: function(data){
              allmatch();
              userstatusbtn();
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
          alert('Please select at list one message to complete suspended action.');
          return false;
        }
      }
      function featured(){
        var selectedOrderBy = new Array();
        $('input[name="action_id"]:checked').each(function() {
          selectedOrderBy.push(this.value);
        }
                                                 );
        if(selectedOrderBy!='')
        {
          $.ajax({
            url: 'user_action',
            type: 'POST',
            data: 'ac_status=trash_all&user_id='+selectedOrderBy,
            success: function(data) {
              allmatch();
              userstatusbtn();
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
          alert('Please select at list one message to complete featured action.');
          return false;
        }
      }
      function paid(){
        var selectedOrderBy = new Array();
        $('input[name="action_id"]:checked').each(function() {
          selectedOrderBy.push(this.value);
        }
                                                 );
        if(selectedOrderBy!='')
        {
          $.ajax({
            url: 'user_action',
            type: 'POST',
            data: 'ac_status=trash_all&user_id='+selectedOrderBy,
            success: function(data) {
              allmatch();
              userstatusbtn();
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
          alert('Please select at list one message to complete paid action.');
          return false;
        }
      }
      function allmatch(){
        var dataString = 'actionfunction=showData' + '&page=1' + '&m_status=match';
        $("#loaderID").css("opacity",1);
        $("#loaderID").css("z-index",9999);
        $.ajax({
          url:"web-services/memres",
          type:"POST",
          data:dataString,
          cache: false,
          success: function(response)
          {
            $("#loaderID").css("opacity",0);
            $("#loaderID").css("z-index",-1);
            $('#result').html(response);
            $('#result').addClass('All');
            paggination('All');
          }
        }
              );
      }
      function userstatusbtn(){
        var dataString = '';
        $.ajax({
          url:"user_status_btn",
          type:"POST",
          data:dataString,
          cache: false,
          success: function(response)
          {
            $('#user_staus_btn').html(response);
          }
        }
              );
      }
    </script>
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
            Match Making
            
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="#">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active">Match Making
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
              <div class="box-top">
              	<div class="row">
                <div class="col-lg-2 col-xs-12 col-sm-6">
                  <a href="members.php" class="btn btn-green btn-lg btn-block">
                    <i class="fa fa-users">
                    </i>All Member
                  </a>
                </div>
                <div class="col-lg-2 col-xs-12 col-sm-6">
                  <a href="editprofile.php" class="btn btn-green btn-lg btn-block">
                    <i class="fa fa-user-plus">
                    </i>Add Member
                  </a>
                </div>
                <?php 
				if(isset($_SESSION['search_gender']) || isset($_SESSION['search_keyword']) || isset($_SESSION['search_country']) || isset($_SESSION['search_state']) || isset($_SESSION['search_city']) || isset($_SESSION['search_religion']) || isset($_SESSION['search_caste']))
				{
				?>
                <div class="col-lg-2 col-xs-12 col-sm-6">
                  <a class="md-trigger btn btn btn-green btn-lg btn-block add-details"  href="?clear-filter">
                    <i class="fa fa-times-circle">
                    </i>Clear Filter
                  </a>
                </div>
                <?php }else{?>
                <div class="col-lg-2 col-xs-12 col-sm-6">
                  <a class="md-trigger btn btn-green btn-lg btn-block add-details"  href="javascript:;" data-modal="modal-13">
                    <i class="fa fa-filter">
                    </i>Filter Profile
                  </a>
                </div>
                <?php }?>
              </div>
              <?php
				$success= isset($_GET['success']) ? $_GET['success'] :"" ;
				if(!empty($success))
				{
				echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i>Record is updated successfully.</div>";
				}
				?>
            </div>
            </div>
            <section class="col-lg-12 col-xs-12 col-md-12 mt-10">
              <div class="box-top gtUserStatusBtn">
              	 <label class="lightGrey">SORT MEMBERS</label>
              	 <div id="user_staus_btn"></div>
              </div>
              <div class="row">
              <div class="col-lg-12 col-xs-12 col-md-12 mt-10">
              	<div class="box-top gtSelectMember">
                  
                    <div class="btn btn-default col-lg-2 col-xs-12 col-md-2 btn-flat" style="cursor:default;">
                      <input type="checkbox" onchange="checkAll(this);" name="chkall" id="chkall" style="cursor:pointer;" class="mt-0">&nbsp;&nbsp;&nbsp;Select All
                    </div>
                    <div class="clearfix visible-xs">
                    </div>
                    <a class="btn btn-default btn-flat col-lg-2 col-xs-6 col-md-2" onClick="delete_user();">
                      <i class="fa fa-trash-o mr-10">
                      </i> Delete
                    </a>
                    <a class="btn btn-default btn-flat col-lg-2 col-xs-6 col-md-2" onClick="active();">
                      <i class="fa fa-thumbs-up mr-10">
                      </i>Active
                    </a>
                    <a class="btn btn-default btn-flat col-lg-2 col-xs-6 col-md-3" onClick="inactive();">
                      <i class="fa fa-thumbs-down mr-10">
                      </i>Inactive
                    </a>
                    <a class="btn btn-default btn-flat col-lg-2 col-xs-6 col-md-3"  onClick="suspended();">
                      <i class="fa fa-user-times mr-10">
                      </i>Suspended
                    </a>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <div id="result"></div>
            </section>
            <section class="col-lg-7 col-xs-12 connectedSortable">
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 col-xs-12 connectedSortable">
            </section>
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
    <div class="md-modal md-effect-13" id="modal-13">
      <div class="md-content" id="dialog">
        <div class="modal-header" >
          <span id="new_button">
            <button class="md-close close" id="old">&times;
            </button>
          </span>
          <h4 class="modal-title" id="dialog_title">Filter Profile
          </h4>
        </div>
        <div class='error-msg' id='validationSummary'>
        </div>
        <form method="post" id="search-form" action="" >
          <div class="modal-body">
            <!--<div class="form-group">
<label ><b> Country:</b></label>
<select name="country_id" id="country_id"  class="form-control">
<option value="" >Select religion</option>
</select>
</div>-->
            <div class="form-group">
              <label for="exampleInputEmail1">
                <b>Gender
                </b>
              </label>&nbsp;&nbsp;&nbsp;
              <input type="radio" name="gender" class="" id="gender" value="Groom">&nbsp;Male&nbsp;&nbsp;
              <input type="radio" name="gender" class="" id="gender" value="Bride">&nbsp;Female
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <b>Keyword
                </b>
              </label>
              <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Enter country name">
            </div>
            <div class="form-group form-group-select2">
              <input type="hidden" name="cnt_name" id="cnt_name" value="">
              <label for="exampleInputEmail1">
                <b>Country
                </b>
              </label>
              <select name="country_id" id="country_id" style="width:99%;">
                <option value="">Select Country
                </option>
                <?php 
$sel_country=mysqli_query($DatabaseCo->dbLink,"SELECT * FROM country WHERE status='APPROVED'") or die(mysqli_error());
while($get_cunt = mysqli_fetch_object($sel_country)){
?>
                <option value="<?php echo $get_cunt->country_id;?>">
                  <?php echo $get_cunt->country_name;?>
                </option>
                <?php }?>
              </select>
              <div id="status1">
              </div>
            </div>
            <div class="form-group form-group-select2">
              <input type="hidden" name="state_name" id="state_name" value="">
              <label for="exampleInputEmail1">
                <b>State
                </b>
              </label>
              <select name="state_id" id="state_id" style="width:99%;">
                <option value="">Select state
                </option>
              </select>
              <div id="status2">
              </div>
            </div>
            <div class="form-group form-group-select2">
              <input type="hidden" name="city_name" id="city_name" value="">
              <label for="exampleInputEmail1">
                <b>City
                </b>
              </label>
              <select name="city_id" id="city_id" style="width:99%;">
                <option value="">Select City
                </option>
              </select>
            </div>
            <div class="form-group form-group-select2">
              <label for="exampleInputEmail1">
                <b>Religion
                </b>
              </label>
              <input type="hidden" name="religion_name" id="religion_name" value="">
              <select name="religion_id" id="religion_id" style="width:99%;">
                <option value="">Select Religion
                </option>
                <?php 
$sel_country=mysqli_query($DatabaseCo->dbLink,"SELECT * FROM religion WHERE status='APPROVED'") or die(mysqli_error());
while($get_cunt = mysqli_fetch_object($sel_country)){
?>
                <option value="<?php echo $get_cunt->religion_id;?>">
                  <?php echo $get_cunt->religion_name;?>
                </option>
                <?php }?>
              </select>
              <div class="status3">
              </div>
            </div>
            <div class="form-group form-group-select2">
              <label for="exampleInputEmail1">
                <b>Caste
                </b>
              </label>
              <input type="hidden" name="caste_name" id="caste_name" value="">
              <select name="caste_id" id="caste_id" style="width:99%;">
                <option value="">Select Caste
                </option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" id="save" class="btn btn-primary" name="search" value="Save Changes" title="Save Changes"/>
            <input type="hidden" name="keyword_id" id="keyword_id" value=""/>
            <input type="hidden" name="action" value="" id="update_action"/>
          </div>
        </form>
      </div>
    </div>
    <div class="md-overlay">
    </div>
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript">
    </script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script> 
    <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>   
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">
      setPageContext("match-macking","match");
    </script>	
    <!--jquery for left menu active class end-->
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
    <!--3D Slit effect pop js-->
    <script src="js/classie.js">
    </script>
    <script src="js/modalEffects.js">
    </script>
    <script src="js/util/select2.min.js">
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        allmatch();
        userstatusbtn();
        $('#country_id').select2();
        $('#state_id').select2();
        $('#city_id').select2();
        $('#religion_id').select2();
        $('#caste_id').select2();
      }
                       );
      <!-------------------jquery get state---------------->
        $("#country_id").change(function()
                                {
          $("#status1").html('<img src="../img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
          var cnt_name = $("#country_id option:selected").text();
          $('#cnt_name').val(cnt_name);
          var id=$(this).val();
          var dataString = 'id='+ id;
          $.ajax
          ({
            type: "POST",
            url: "../ajax_country_state.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#state_id").html(html);
              $("#status1").html('');
            }
          }
          );
        }
                               );
      <!-------------------jquery get state End---------------->
        $("#state_id").on('change',function()
                          {
          $("#status2").html('<img src="../img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
          var state_name = $("#state_id option:selected").text();
          $('#state_name').val(state_name);
          var id=$(this).val();
          var cnt_id=$("#country_id").val();
          var dataString = 'state_id='+ id+'&country_id='+ cnt_id;
          $.ajax
          ({
            type: "POST",
            url: "../ajax_country_state.php",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#city_id").html(html);
              $("#status2").html('');
            }
          }
          );
        }
                         );
      <!-------------------jquery get city End---------------->
        $("#city_id").on('change',function()
                         {
          var city_name = $("#city_id option:selected").text();
          $('#city_name').val(city_name);
        }
                        );
      <!-------------------jquery get caste End---------------->
        $("#religion_id").on('change',function()
                             {
          $("#status3").html('<img src="../img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
          var religion_name = $("#religion_id option:selected").text();
          $('#religion_name').val(religion_name);
          var religionId=$("#religion_id").val();
          var dataString = 'religionId='+religionId;
          $.ajax
          ({
            type: "POST",
            url: "ajax_search2",
            data: dataString,
            cache: false,
            success: function(html)
            {
              $("#caste_id").html(html);
              $('#caste_id').select2();
              //alert($("#caste_id").html());
              $("#status3").html('');
            }
          }
          );
        }
                            );
      <!-------------------jquery get caste End---------------->
        $("#caste_id").on('change',function()
                          {
          var caste_name = $("#caste_id option:selected").text();
          $('#caste_name').val(caste_name);
        }
                         );
    </script>
  </body>
</html>
