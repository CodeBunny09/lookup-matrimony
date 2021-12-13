<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$search_case = false;
$state_status = "";
if(isset($_GET['state_status'])){
$state_status = $_GET['state_status'];
$_SESSION['state_status'] = $_GET['state_status'];
}
else if(isset($_GET['page']))
{
$state_status = $_SESSION['state_status'];
}
else
{
$_SESSION['state_status'] = "all";
$state_status = "all";
}
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack){     
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
if(isset($_POST['state_id']) && is_array($_POST['state_id']) && $ACTION!='SEARCH'){
$state_id_arr = $_POST['state_id'];
$state_id_val = "(";
foreach($state_id_arr as $state_id){
$state_id_val .=  $state_id.",";
}
$state_id_val = substr($state_id_val, 0, -1);
$state_id_val .=")";
switch($ACTION){
case 'DELETE':    
$SQL_STATEMENT =  "delete from  state where state_id in ".$state_id_val;   
break;
case 'APPROVED':
$SQL_STATEMENT =  "update state_view set status='APPROVED' where state_id in ".$state_id_val;  
break;
case 'UNAPPROVED':
$SQL_STATEMENT =  "update state_view set status='UNAPPROVED' where state_id in ".$state_id_val;   
break;
}
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$STATUS_MESSAGE = $statusObj->getStatusMessage();
}else{
$statusObj = new Status();
$statusObj->setActionSuccess(false);
$STATUS_MESSAGE = "Please select value to complete action.";     
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Manage State
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
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
    <!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
    <!-- DATA TABLE CSS -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLE CSS END-->
    <link rel="stylesheet" href="css/all_check.css"/>
    <link rel="stylesheet" href="css/libs/select2.css"/>
    <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    <script type="text/javascript" src="js/util/location.js">
    </script>  
    <script type="text/javascript">
      function countryList(data){
        $.each(data,function(index,val){
          $('#country_id').append($('<option>', {
            value: val.country_code,
            text : val.country_name 
          }
                                   ));
        }
              );
      }
    </script>
  </head>
  <body class="skin-blue">
    <!-- ICON LOADER-->
    <div class="preloader-wrapper text-center">
      <div class="spinner">
      </div>
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
            Add State
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active">Add State
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
              <div class="box-top updateSite">
                <div class="row">
                  <div class="col-lg-3 col-sm-4">
                    <a class="md-trigger btn btn-default btn-lg btn-block add-details"  href="javascript:;" data-modal="modal-13">
                      <i class="fa fa-plus">
                      </i>Add State
                    </a>
                  </div>
                  <div class="col-lg-3 col-xs-12 col-sm-4">
                    <a href="updateWebSiteState?state_status=all" class="btn btn-success btn-lg col-xs-12">
                      <i class="fa fa-list">
                      </i>All State 
                      <span class="badge">
                        <?php echo getRowCount("select count(state_id) from state_view",$DatabaseCo);?>
                      </span>
                    </a>
                  </div>
                  <div class="col-lg-3 col-xs-12 col-sm-4">
                    <a href="updateWebSiteState?state_status=approved" class="btn btn-success btn-lg col-xs-12">
                      <i class="fa fa-thumbs-up">
                      </i>Approved State 
                      <span class="badge">
                        <?php echo getRowCount("select count(state_id) from state_view where  status='APPROVED'",$DatabaseCo);?>
                      </span>
                    </a>
                  </div>
                  <div class="col-lg-3 col-xs-12 col-sm-4">
                    <a href="updateWebSiteState?state_status=unapproved" class="btn btn-success btn-lg col-xs-12">
                      <i class="fa fa-thumbs-down">
                      </i>Unapproved state 
                      <span class="badge">
                        <?php echo getRowCount("select count(state_id) from state_view where  status='UNAPPROVED'",$DatabaseCo);?>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
              <?php
if(!empty($STATUS_MESSAGE)){  
if($statusObj->getActionSuccess()){
echo "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$STATUS_MESSAGE."</div>";
}else{
echo "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$STATUS_MESSAGE."</li></ul></div>";     
}
}
?>     
            </div>
            <?php
$main_menu_count = getRowCount("select count(state_id) from state_view".getWhereClauseForStatus($state_status),$DatabaseCo);
if($main_menu_count>0){  
$SQL_STATEMENT =  "SELECT * FROM state_view ".getWhereClauseForStatus($state_status)." ORDER BY state_id DESC";
?>
            <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
              <div class="box-top">
                <div class="row">
                  <div class="col-lg-1 col-sm-2">
                    <input type="checkbox" name="check" id="selectall" class="second" />
                    <label for="selectall" class="label2">&nbsp;
                    </label>
                  </div>
                  <div class="col-lg-2 col-xs-12 col-sm-4">
                    <a href="javascript:;" class="btn btn-danger btn-lg col-xs-12" onclick="submitActionForm('DELETE');">
                      <i class="fa fa-trash">
                      </i> Delete
                    </a>
                  </div>
                  <div class="col-lg-2 col-xs-12 col-sm-4">
                    <a href="javascript:;" class="btn btn-success btn-lg col-xs-12" onclick="submitActionForm('APPROVED');">
                      <i class="fa fa-thumbs-up">
                      </i>Approve
                    </a>
                  </div>
                  <div class="col-lg-2 col-xs-12 col-sm-4">
                    <a href="javascript:;" class="btn btn-warning btn-lg col-xs-12" onclick="submitActionForm('UNAPPROVED');">
                      <i class="fa fa-thumbs-down">
                      </i>Unapprove
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12 mt-10">
              <!-- /.box -->
              <div class="box box-success">
                <div class="box-header">
                  <h4>
                    <?php echo strtoupper($state_status); ?>  STATE LIST
                  </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" action="updateWebSiteState" id="action_form">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>
                          </th>
                          <th>Edit
                          </th>
                          <th>Status
                          </th>
                          <th>State Name
                          </th>
                          <th>Country Name
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                
$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
$rowCount=0;
while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)){    
?>
                        <tr>
                          <td>
                            <input type="checkbox" name="state_id[]" id="Item <?php  echo $DatabaseCo->dbRow->state_id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->state_id;?>"/>
                            <label for="Item <?php  echo $DatabaseCo->dbRow->state_id;?>" class="label2">&nbsp;
                            </label>   
                          </td>
                          <td>
                            <a class="btn btn-default btn-sm md-trigger edit-popup"  href="javascript:;" data-modal="modal-13" data-id="<?php  echo $DatabaseCo->dbRow->state_id;?>" 
                               data-country_id="<?php  echo $DatabaseCo->dbRow->country_code;?>"  data-state_code="<?php  echo $DatabaseCo->dbRow->state_code;?>" data-state_name="<?php  echo $DatabaseCo->dbRow->state_name;?>" data-state_status="<?php  echo $DatabaseCo->dbRow->status;?>">
                              <i class="fa fa-pencil fa-fw">
                              </i>
                              <span class="hidden-xs">&nbsp;&nbsp;Edit
                              </span>
                            </a>
                          </td>
                          <?php
$likeDisLikeCss = "";
if($DatabaseCo->dbRow->status=='APPROVED'){
$likeDisLikeCss = "fa-thumbs-up";
}else{
$likeDisLikeCss = "fa-thumbs-down";
}
?>     
                          <td class="updateSiteApprovalStatus">
                            <i class="fa <?php echo $likeDisLikeCss;?>">
                            </i>
                          </td>
                          <td class="updateSite">
                            <span class="textUpdate">
                              <?php  echo $DatabaseCo->dbRow->state_name;?>
                            </span>
                          </td>
                          <td class="updateSite">
                            <span class="textUpdate">
                              <?php  echo $DatabaseCo->dbRow->country_name;?>
                            </span>
                          </td>
                        </tr>
                        <?php
}
?>
                      </tbody>
                    </table>
                    <input  type="hidden" name="action" value="" id="action"/>
                  </form>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <?php
}else{
?>
            <div class="col-lg-12 col-xs-12 col-sm-12">
              <h4>There are no data for 
                <?php echo strtoupper($state_status); ?> State. Please add data.
              </h4>
              <br/>
              <img src="../img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
            </div>
            <?php
}
?>   
            <!-- /.col -->
          </div>
          <!-- /.row -->
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
            <button class="md-close close" id="old">&times;
            </button>
          </span>
          <h4 class="modal-title" id="dialog_title">Add New State
          </h4>
        </div>
        <div class='error-msg' id='validationSummary'>
        </div>
        <form method="post" id="state-form" action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label >
                <b> Country:
                </b>
              </label>
              <select name="country_id" id="country_id"  class="form-control">
                <option value="" >Select Country
                </option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <b>State Name
                </b>
              </label>
              <input type="text" name="state_name" class="form-control" id="state_name" placeholder="Enter state name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <b>State Code
                </b>
              </label>
              <input type="text" name="state_code" class="form-control" id="state_code" placeholder="Enter state name">
            </div>
            <div class="form-group">
              <label>
                <b>Status
                </b>
              </label>
              <div class="radio">
                <input id="optionsRadios1" class="state_status" type="radio" checked="" value="APPROVED" name="state_status">
                <label for="optionsRadios1">
                  <b>Active
                  </b> 
                </label>
                <input id="optionsRadios2" class="state_status" type="radio" value="UNAPPROVED" name="state_status">
                <label for="optionsRadios2">
                  <b>Inactive 
                  </b>
                </label>
              </div>
            </div>
          </div>
          <div class="modal-footer updateSite">
            <input type="button" id="save" class="btn btn-success" value="Save Changes" title="Save Changes"/>
            <input type="hidden" name="state_id" id="state_id" value=""/>
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
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
    <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript">
    </script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript">
    </script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript">
    </script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'>
    </script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="js/util/select2.min.js">
    </script>
    <!--3D Slit effect pop js-->
    <script src="js/classie.js">
    </script>
    <script src="js/modalEffects.js">
    </script>
    <!--ends-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">
      setPageContext("add-new","state");
    </script>  
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        var refreshRequired = false;
        getCountries();
        $("input[name=state_id]").click(function(){
          $("#selectall").prop("checked", false);
        }
                                       );
        //     js for Check/Uncheck all CheckBoxes by Checkbox     // 
        $("#selectall").click(function(){
          $(".second").prop("checked",$("#selectall").prop("checked"))
        }
                             ) 
        // add details //
        $('#country_id').select2();
        $(document).on("click", ".add-details", function () {
          $("#save").val("Save Changes");
          $("#dialog_title").text("Add New State");
          $("#update_action").val("ADD");
          $('#modal-13').modal('show');
          $("#validationSummary").hide();
          $("#state_name").focus();
          $("#state_name").val("");
        }
                      );
        //     edit details function starts here    // 
        $(document).on("click", ".edit-popup", function () {
          var myid = $(this).data('id');
          var country_id = $(this).data('country_id');
          var state_name = $(this).data('state_name');
          var state_code = $(this).data('state_code');
          var state_status = $(this).data('state_status');
          $("#country_id").val(country_id).select2();
          $("#state_id").val(myid);
          $("#country_id").val(country_id);
          $("#state_name").val(state_name);
          $("#state_code").val(state_code);
          $("#save").val("Update");
          $("#dialog_title").text("Update State");
          if(state_status=='APPROVED')
          {
            $("#optionsRadios1").attr("checked","checked");
          }
          else
          {
            $("#optionsRadios2").attr("checked","checked");
          }
          $("#update_action").val("UPDATE");
          $('#modal-13').modal('show');
          $("#validationSummary").hide();
          $("#state_name").focus();
        }
                      );
        //     to save popup details    // 
        $("#save" ).button().click(function(){
          $("#validationSummary").attr("class","alert alert-warning");
          $("#validationSummary").html("<img src='../img/6.gif' alt='loading'/> <b>Please wait...</b>");
          $("#validationSummary").show();
          var dataString =  $("#state-form").serialize();
          $.ajax({
            type: "post",
            url: "web-services/add-details/add-state",
            dataType:"json",
            data: dataString,
            success: function(data){
              if(data.successStatus){
                $("#validationSummary").attr("class","alert alert-success");
                $("#validationSummary").html("<i class='fa fa-check-circle fa-fw fa-lg'></i>"+data.responseMessage+"");
                $("#validationSummary").show();
                $("#old").remove();
                $('<a href="updateWebSiteState" id="old" class="md-close close">&times;</a>').appendTo('#new_button');
              }
              else{
                $("#validationSummary").attr("class","alert alert-danger");
                $("#validationSummary").html("<i class='fa fa-times-circle fa-fw fa-lg'></i>Please correct following errors.<ul class='error-hint cf'>"+data.responseMessage+"</ul>");
                $("#validationSummary").show();
              }
            }
          }
                )
          return false;
        }
                                  );
        $('#example1').dataTable({
          "aaSorting": [  [3,'desc'] ],
          'aoColumnDefs': [{
            'bSortable': false,
            'info': true,          
            "paging":   true,
            'aTargets': [0,1,2,],
            'pageLength': 10        
          }
                          ]      
        }
                                );
      }
       );
    </script>
  </body>
</html>