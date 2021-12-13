<?php
   include_once '../databaseConn.php';
   include_once '../class/Config.class.php';
   $configObj = new Config();
   include_once './lib/requestHandler.php';
   $DatabaseCo = new DatabaseConn();
   include_once '../class/Config.class.php';
   $configObj = new Config();
   $mtongue_status = "";
   if(isset($_GET['mtongue_status'])){
   $mtongue_status = $_GET['mtongue_status'];
   $_SESSION['mtongue_status'] = $_GET['mtongue_status'];
   }
   else if(isset($_GET['page'])){
   $mtongue_status = $_SESSION['mtongue_status'];
   }else{
   $_SESSION['mtongue_status'] = "all";
   $mtongue_status = "all";
   }
   $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
   if($isPostBack){  		
   $ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
   if(isset($_POST['mtongue_id']) && is_array($_POST['mtongue_id'])){
   $mtongue_id_arr = $_POST['mtongue_id'];
   $mtongue_id_val = "(";
   foreach($mtongue_id_arr as $mtongue_id){
   $mtongue_id_val .=	$mtongue_id.",";
   }
   $mtongue_id_val = substr($mtongue_id_val, 0, -1);
   $mtongue_id_val .=")";
   switch($ACTION){
   case 'DELETE':		
   $SQL_STATEMENT =  "delete from    mothertongue where mtongue_id in ".$mtongue_id_val;	
   break;
   case 'APPROVED':
   $SQL_STATEMENT =  "update  mothertongue set status='APPROVED' where mtongue_id in ".$mtongue_id_val;	
   break;
   case 'UNAPPROVED':
   $SQL_STATEMENT =  "update  mothertongue set status='UNAPPROVED' where mtongue_id in ".$mtongue_id_val;	
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
      <title>Admin | Manage Mother Toungue </title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
	  <!-- ICHECK CHECKBOX CSS -->
      <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
      <!-- ICHECK CHECKBOX CSS END -->
      <!-- DATA TABLE CSS -->
 	  <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <!-- DATA TABLE CSS END-->
      <link rel="stylesheet" href="css/all_check.css"/>
      <link rel="stylesheet" href="css/libs/select2.css"/>
      <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
      <script type="text/javascript" src="js/util/redirection.js"></script>
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
                  Add MotherToungue
               </h1>
               <ol class="breadcrumb">
                  <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  <li class="active">Mother Toungue</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-lg-12 col-xs-12 col-sm-12">
                     <div class="box-top updateSite">
                     	<div class="row">
                        <div class="col-lg-3 col-sm-4">
                           <a class="md-trigger btn btn-default btn-lg btn-block add-details"  href="javascript:;" data-modal="modal-13">
                           <i class="fa fa-plus"></i>Add Mother Toungue
                           </a>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-4">
                           <a href="updateWebSiteMotherTongue?mtongue_status=all" class="btn btn-success btn-lg col-xs-12">
                           <i class="fa fa-list"></i>All MotherToungue <span class="badge"><?php echo getRowCount("select count(mtongue_id) from  mothertongue",$DatabaseCo);?></span>
                           </a>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-4">
                           <a href="updateWebSiteMotherTongue?mtongue_status=approved" class="btn btn-success btn-lg col-xs-12">
                           <i class="fa fa-thumbs-up"></i>Approved MotherToungue <span class="badge"><?php echo getRowCount("select count(mtongue_id) from  mothertongue where status='APPROVED'",$DatabaseCo);?></span>
                           </a>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-4">
                           <a href="updateWebSiteMotherTongue?mtongue_status=unapproved" class="btn btn-success btn-lg col-xs-12">
                           <i class="fa fa-thumbs-down"></i>Unapproved MotherToungue <span class="badge"><?php echo getRowCount("select count(mtongue_id) from mothertongue where status='UNAPPROVED'",$DatabaseCo);?></span>
                           </a>
                        </div>
                        </div>
                     </div>
                     <?php
                        if(!empty($STATUS_MESSAGE)){	
                        if($statusObj->getActionSuccess()){
                        echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$STATUS_MESSAGE."</div>";
                        }else{
                         echo  "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$STATUS_MESSAGE."</li></ul></div>";		
                       }
                       }
                    ?>     
                  </div>
                  <?php
                     $main_menu_count = getRowCount("select count(mtongue_id) from mothertongue".getWhereClauseForStatus($mtongue_status),$DatabaseCo);
                     if($main_menu_count>0){  
                     $SQL_STATEMENT =  "SELECT * FROM mothertongue ".getWhereClauseForStatus($mtongue_status)." ORDER BY mtongue_id DESC";
                  ?>
                  <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
                     <div class="box-top">
                     	<div class="row">
                        <div class="col-lg-1 col-sm-2">
                        	<input type="checkbox" name="check" id="selectall" class="second" />
                            <label for="selectall" class="label2">&nbsp;</label>
                        </div>
                        <div class="col-lg-2 col-xs-12 col-sm-4">
                           <a href="javascript:;" class="btn btn-danger btn-lg col-xs-12" onclick="submitActionForm('DELETE');">
                           <i class="fa fa-trash"></i> Delete
                           </a>
                        </div>
                        <div class="col-lg-2 col-xs-12 col-sm-4">
                           <a href="javascript:;" class="btn btn-success btn-lg  col-xs-12" onclick="submitActionForm('APPROVED');">
                           <i class="fa fa-thumbs-up"></i>Approve
                           </a>
                        </div>
                        <div class="col-lg-2 col-xs-12 col-sm-4">
                           <a href="javascript:;" class="btn btn-warning btn-lg col-xs-12" onclick="submitActionForm('UNAPPROVED');">
                           <i class="fa fa-thumbs-down"></i>Unapprove
                           </a>
                        </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 mt-10">
                     <!-- /.box -->
                     <div class="box box-success">
                        <div class="box-header">
                           <h4><?php echo strtoupper($mtongue_status); ?> MOTHER TONGUE LIST</h4>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <form method="post" action="updateWebSiteMotherTongue" id="action_form">
                              <table id="example1" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>
                                       </th>
                                       <th>Edit</th>
                                       <th>Status</th>
                                       <th>Mother Toungue</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php						
                                       $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                       $rowCount=0;
                                       while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)){		
                                    ?>
                                    <tr>
                                       <td><input type="checkbox" name="mtongue_id[]" id="Item <?php  echo $DatabaseCo->dbRow->mtongue_id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->mtongue_id;?>"/>
                                          <label for="Item <?php  echo $DatabaseCo->dbRow->mtongue_id;?>" class="label2">&nbsp;</label>	
                                       </td>
                                       <td><a class="btn btn-default btn-sm md-trigger edit-popup"  href="javascript:;" data-modal="modal-13" data-id="<?php  echo $DatabaseCo->dbRow->mtongue_id;?>" data-mtongue_name="<?php  echo $DatabaseCo->dbRow->mtongue_name;?>" data-mtongue_status="<?php  echo $DatabaseCo->dbRow->status;?>"><i class="fa fa-pencil fa-fw"></i><span class="hidden-xs">&nbsp;&nbsp;Edit</span>
                                          </a>
                                       </td>
                                       <?php
                                          $likeDisLikeCss = "";
                                          if($DatabaseCo->dbRow->status=="APPROVED")
                                          $likeDisLikeCss = "fa-thumbs-up";
                                          else
                                          $likeDisLikeCss = "fa-thumbs-down";
                                       ?>     
                                       <td class="updateSiteApprovalStatus"><i class="fa <?php echo $likeDisLikeCss;?>"></i></td>
                                       <td class="updateSite"><span class="textUpdate"><?php  echo $DatabaseCo->dbRow->mtongue_name;?></span></td>
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
                     <h4>There are no data for <?php echo strtoupper($mtongue_status); ?> Mother Toungue. Please add data.</h4>
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
               <button class="md-close close" id="old">&times;</button>
               </span>
               <h4 class="modal-title" id="dialog_title">Add New Mother Tongue</h4>
            </div>
            <div class='error-msg' id='validationSummary'></div>
            <form method="post" id="mtongue-form" action="" method="post">
               <div class="modal-body">
                  <div class="form-group">
                     <label for="exampleInputEmail1"><b>Mother Tongue Name</b></label>
                     <input type="text" name="mtongue_name" class="form-control" id="mtongue_name" placeholder="Enter MotherTongue name">
                  </div>
                  <div class="form-group">
                     <label><b>Status</b></label>
                     <div class="radio">
                        <input id="optionsRadios1" class="mtongue_status" type="radio" checked="" value="APPROVED" name="mtongue_status">
                        <label for="optionsRadios1"><b>Active</b> </label>
                        <input id="optionsRadios2" class="mtongue_status" type="radio" value="UNAPPROVED" name="mtongue_status">
                        <label for="optionsRadios2"><b>Inactive </b></label>
                     </div>
                  </div>
               </div>
               <div class="modal-footer updateSite">
                  <input type="button" id="save" class="btn btn-success" value="Save Changes" title="Save Changes"/>
                  <input type="hidden" name="mtongue_id" id="mtongue_id" value=""/>
                  <input type="hidden" name="action" value="" id="update_action"/>
               </div>
            </form>
         </div>
      </div>
      <div class="md-overlay"></div>
      <!-- jQuery 2.1.3 -->
      <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
      <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
      <!-- Bootstrap 3.3.2 JS -->
      <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!--jquery for left menu active class-->
      <script type="text/javascript" src="dist/js/general.js"></script>
      <script type="text/javascript" src="dist/js/cookieapi.js"></script>
      <script type="text/javascript">
         setPageContext("add-new","mtongue");
      </script>	
      <!--jquery for left menu active class end-->
      <!-- DATA TABES SCRIPT -->
      <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
      <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
      <!-- SlimScroll -->
      <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <!-- FastClick -->
      <script src='plugins/fastclick/fastclick.min.js'></script>
      <!-- AdminLTE App -->
      <script src="dist/js/app.min.js" type="text/javascript"></script>
      <!--3D Slit effect pop js-->
      <script src="js/classie.js"></script>
      <script src="js/modalEffects.js"></script>
      <!--ends-->
      <!-- page script -->
      <script type="text/javascript">
         $(function () {
         var refreshRequired = false;
         $("input[name=mtongue_id]").click(function(){
         $("#selectall").prop("checked", false);		
         });
         //     js for Check/Uncheck all CheckBoxes by Checkbox     // 
         $("#selectall").click(function(){
         $(".second").prop("checked",$("#selectall").prop("checked"))
          }) 
         // add details //
         $(document).on("click", ".add-details", function () {
         $("#save").val("Save Changes");
         $("#dialog_title").text("Add New Mother Tongue");
         $("#update_action").val("ADD"); 		
         $('#modal-13').modal('show');
          $("#validationSummary").hide();
         $("#mtongue_name").focus();
         $("#mtongue_name").val("");
         });
         //     edit details function starts here    // 
         $(document).on("click", ".edit-popup", function () {
         var myid = $(this).data('id');
         var mtongue_name = $(this).data('mtongue_name');
         var mtongue_status = $(this).data('mtongue_status');
         $("#mtongue_id").val(myid);
         $("#mtongue_name").val(mtongue_name);
         $("#save").val("Update");
         $("#dialog_title").text("Update Mother Tongue");
         if(mtongue_status=='APPROVED'){
         $("#optionsRadios1").attr("checked","checked");
         }else{	
         $("#optionsRadios2").attr("checked","checked");
         }
         $("#update_action").val("UPDATE"); 
         $('#modal-13').modal('show');
         $("#validationSummary").hide();
         $("#mtongue_name").focus();	 
         });
          //     to save popup details    // 
         $("#save" ).button().click(function(){
         $("#validationSummary").attr("class","alert alert-warning");
         $("#validationSummary").html("<img src='../img/6.gif' alt='loading'/> <b>Please wait...</b>");
         $("#validationSummary").show();			
         var dataString =  $("#mtongue-form").serialize();			
         $.ajax({
         type: "post",
          url: "web-services/add-details/add_mothertongue",
         dataType:"json",
         data: dataString,
         success: function(data){
         if(data.successStatus){
         $("#validationSummary").attr("class","alert alert-success");
         $("#validationSummary").html("<i class='fa fa-check-circle fa-fw fa-lg'></i>"+data.responseMessage+"");
         $("#validationSummary").show();
         $("#old").remove();
         $('<a href="updateWebSiteMotherTongue" id="old" class="md-close close">&times;</a>').appendTo('#new_button');
         }else{
         $("#validationSummary").attr("class","alert alert-danger");
         $("#validationSummary").html("<i class='fa fa-times-circle fa-fw fa-lg'></i>Please correct following errors.<ul class='error-hint cf'>"+data.responseMessage+"</ul>");
         $("#validationSummary").show();
         }
         }
         })
         return false;
         });
         $('#example1').dataTable({
         "aaSorting": [  [3,'desc'] ],
         'aoColumnDefs': [{
         'bSortable': false,
         'info': true,          
         "paging":   true,
         'aTargets': [0,1,2,],
         'pageLength': 10		   
         }]		
         } );  
         });
</script>
   </body>
</html>
<style type="text/css">
   .modal-open
   {
   padding-right:0px !important;
   overflow:visible !important;
   }
   .md-show
   {
   padding-right:0px !important;
   } 
</style>