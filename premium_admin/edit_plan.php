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
unset($_SESSION['franchies_id']);
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
    <title>Manage | Edit Plan
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
    <!-------------------Validation css ------------------>
    <link rel="stylesheet" href="../css/validate.css">
    <!-------------------Validation css------------------>
    <script type="text/javascript">
      function paggination(status){
        $('#result').on('click','.page-numbers',function(){
          $("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
          $page = $(this).attr('href');
          $pageind = $page.indexOf('page=');
          $page = $page.substring(($pageind+5));
          var dataString = 'actionfunction=showData' + '&page='+$page;
          $.ajax({
            url:"web-services/memedit",
            type:"POST",
            data:dataString,
            cache: false,
            success: function(response)
            {
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
      function activetopaid(){
        var dataString = 'actionfunction=showData' + '&page=1' + '&status=Paid' +'&plan_status=Edit';
        $("#result").html('<img src="img/ajax_loader_blue_256.gif" style="margin-left:25%;">');
        $.ajax({
          url:"web-services/memedit",
          type:"POST",
          data:dataString,
          cache: false,
          success: function(response)
          {
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
            Upgrade/Downgrade Membership Plan
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active"> Edit Plan
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
                               		<i class="fa fa-users"></i>All Member
                               </a>
                            </div>
                            <div class="col-lg-2 col-xs-12 col-sm-6">
                               <a href="editprofile.php" class="btn btn-green btn-lg btn-block">
                               	<i class="fa fa-user-plus"></i>Add Member
                               </a>
                            </div>
                        <?php 
                           if(isset($_SESSION['search_gender']) || isset($_SESSION['search_keyword']) || isset($_SESSION['search_country']) || isset($_SESSION['search_state']) || isset($_SESSION['search_city']) || isset($_SESSION['search_religion']) || isset($_SESSION['search_caste'])){
                        ?>
                        	<div class="col-lg-2 col-xs-12 col-sm-6">
                           		<a class="md-trigger btn btn-green btn-lg btn-block add-details"  href="?clear-filter">
                           			<i class="fa fa-times-circle"></i>Clear Filter
                           		</a>
                        	</div>
                        <?php }else{?>
                            <div class="col-lg-2 col-xs-12 col-sm-6">
                               <a class="md-trigger btn btn-green btn-lg btn-block add-details"  href="javascript:;" data-modal="modal-13">
                               		<i class="fa fa-filter"></i>Filter Profile
                               </a>
                            </div>
                        <?php }?>
                        </div>
                     </div>
              <?php
				$success= isset($_GET['success']) ? $_GET['success'] :"" ;
				if(!empty($success))
				{
				echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i>Record is updated successfully.</div>";
				}
			  ?>
            </div>
            <section class="col-lg-12 col-xs-12 col-md-12">
               <div id="result"></div>
              
            </section>
            <section class="col-lg-7 col-xs-12 connectedSortable"></section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 col-xs-12 connectedSortable"></section>
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
    <div class="md-modal" id="modal-13">
         <div class="md-content" id="dialog">
            <div class="modal-header" >
               <span id="new_button">
               <button class="md-close close" id="old">&times;</button>
               </span>
               <h4 class="modal-title" id="dialog_title">Filter Profile</h4>
            </div>
            <div class='error-msg' id='validationSummary'></div>
            <form method="post" id="search-form" action="" >
               <div class="modal-body">
               		<div class="col-xs-12">
                      <div class="form-group">
                         <label for="exampleInputEmail1"><b>Gender</b></label>&nbsp;&nbsp;&nbsp;
                         <input type="radio" name="gender" class="" id="gender" value="Male">&nbsp;Male&nbsp;&nbsp;
                         <input type="radio" name="gender" class="" id="gender" value="Female">&nbsp;Female
                      </div>
                      <div class="form-group">
                         <label for="exampleInputEmail1"><b>Keyword</b></label>
                         <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Enter country name">
                      </div>
                      <div class="form-group form-group-select2">
                        <label for="exampleInputEmail1"><b>Country</b></label>
                         <select class="form-control chosen-select" name="country_id" id="country_id" data-validetta="required">
										<option value="">Select Your Country
										</option>
										<?php
								$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED'");
								while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
								{
								?>
										<option value="<?php echo $DatabaseCo->dbRow->country_id; ?>" 
												>
										<?php echo $DatabaseCo->dbRow->country_name; ?>
										</option>
									  <?php } ?>
									  </select>
						<div id="status123">
						</div>
                      </div>
                      <div class="form-group ">
                         
                         <label for="exampleInputEmail1"><b>State</b></label>
                        <select class="form-control chosen-select" id="state123" name="state" data-validetta="required">
						  <option value="">
						  Select
						  </option>   
						</select>
						<div id="status23">
						</div>
                      </div>
                      <div class="form-group">
                        
                         <label for="exampleInputEmail1"><b>City</b></label>
                        <select class="form-control chosen-select" name="city" id="city123" data-validetta="required">
      <option value="">Select state first
      </option>
      
    </select>
                      </div>
                      <div class="form-group form-group-select2">
                         <label for="exampleInputEmail1"><b>Religion</b></label>
                         <input type="hidden" name="religion_name" id="religion_name" value="">
                         <select name="religion_id" id="religion_id" class="form-control">
                            <option value="">Select Religion</option>
                            <?php 
                               $sel_country=mysqli_query($DatabaseCo->dbLink,"SELECT * FROM religion WHERE status='APPROVED'") or die(mysqli_error());
                                while($get_cunt = mysqli_fetch_object($sel_country)){
                            ?>
                            <option value="<?php echo $get_cunt->religion_id;?>"><?php echo $get_cunt->religion_name;?></option>
                            <?php }?>
                         </select>
                         <div class="status3"></div>
                      </div>
                      <div class="form-group form-group-select2">
                         <label for="exampleInputEmail1"><b>Caste</b></label>
                         <input type="hidden" name="caste_name" id="caste_name" value="">
                         <select name="caste_id" id="caste_id" class="form-control">
                            <option value="">Select Caste</option>
                         </select>
                      </div>
                    </div>
                    <div class="clearfix"></div>
               </div>
               <div class="modal-footer">
               		<div class="col-md-4 col-md-offset-4">
                  <input type="submit" id="save" class="btn btn-green btn-lg btn-block" name="search" value="SEARCH" title="SEARCH"/>
                  <input type="hidden" name="keyword_id" id="keyword_id" value=""/>
                  <input type="hidden" name="action" value="SEARCH" id="update_action"/>
                  </div>
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
    <script src="../js/validetta.js" type="text/javascript">
    </script>
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
      setPageContext("members","edit-plan-member");
    </script>	
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
    <script src="js/classie.js">
    </script>
    <script src="js/modalEffects.js">
    </script>
    <script src="js/util/select2.min.js">
    </script>
     <script src="js/chosen.jquery.js" type="text/javascript"></script>
        <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {allow_single_deselect: true},
                '.chosen-select-no-single': {disable_search_threshold: 10},
                '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                '.chosen-select-width': {width: "100%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        </script>
    <script type="text/javascript">
      $(document).ready(function() {
        activetopaid();
        userstatusbtn();
        
       
        $('#religion_id').select2();
        $('#caste_id').select2();
      }
                       );
      $("#country_id").change(function()
                            {
      $("#status123").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
      var id=$(this).val();
      var dataString = 'id='+ id;
      $.ajax
      ({
        type: "POST",
        url: "../ajax_country_state",
        data: dataString,
        cache: false,
        success: function(html)
        {
          $("#state123").html(html);
          $("#status123").html('');
        }
      }
      );
    }
                           );

      $("#state123").on('change',function()
                        {
        $("#status23").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        var id=$(this).val();
        var cnt_id=$("#country_id").val();
        var dataString = 'state_id='+ id+'&country_id='+ cnt_id;
        $.ajax
        ({
          type: "POST",
          url: "../ajax_country_state",
          data: dataString,
          cache: false,
          success: function(html)
          {
            $("#city123").html(html);
            $("#status23").html('');
          }
        }
        );
      }
                       );

         
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