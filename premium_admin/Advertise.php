<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$advertise_status = "";
if(isset($_GET['advertise_status'])){
$advertise_status = $_GET['advertise_status'];
$_SESSION['advertise_status'] = $_GET['advertise_status'];
}
else if(isset($_GET['page']))
{
$advertise_status = $_SESSION['advertise_status'];
}
else
{
$_SESSION['advertise_status'] = "all";
$advertise_status = "all";
}
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{     
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
if(isset($_POST['adv_id']) && is_array($_POST['adv_id']))
{
$adv_id_arr = $_POST['adv_id'];
$adv_id_val = "(";
foreach($adv_id_arr as $adv_id)
{
$adv_id_val .=	$adv_id.",";
}
$adv_id_val = substr($adv_id_val, 0, -1);
$adv_id_val .=")";
switch($ACTION)
{
case 'DELETE':		
$SQL_STATEMENT =  "delete from advertisement where adv_id in ".$adv_id_val;	
$exe=$DatabaseCo->dbLink->query("select adv_img from advertisement where adv_id in ".$adv_id_val);
while($get=mysqli_fetch_array($exe))
{		
unlink("../advertise/".$get['adv_img']);
}
break;
case 'APPROVED':
$SQL_STATEMENT =  "update advertisement set status='APPROVED' where adv_id in ".$adv_id_val;	
break;
case 'UNAPPROVED':
$SQL_STATEMENT =  "update advertisement set status='UNAPPROVED' where adv_id in ".$adv_id_val;	
break;
}
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$STATUS_MESSAGE = $statusObj->getstatusMessage();
}
else
{
$statusObj = new status();
$statusObj->setActionSuccess(false);
$STATUS_MESSAGE = "Please select value to complete action.";	  
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage |  Advertisement
    </title>
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
   
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/all_check.css"/>   
    <link rel="stylesheet" href="css/libs/select2.css"/>   
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
    <!--jquery for left menu active class-->
    <script type="text/javascript" src="dist/js/general.js">
    </script>
    <script type="text/javascript" src="dist/js/cookieapi.js">
    </script>
    <script type="text/javascript">
      setPageContext("advmain","adv");
    </script>	
    <!--jquery for left menu active class end-->
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript">
    </script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript">
    </script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    
  </head>
  <body class="skin-blue">
  	<div class="preloader-wrapper text-center">
          <div class="spinner"></div>
        </div>
    <div class="wrapper" style="display:none" id="body">
      <?php include "page-part/header.php"; ?> 
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "page-part/left_panel.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      	<section class="content-header">
			<h1 class="lightGrey">Advertisement</h1>
			<ol class="breadcrumb">
				<li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Advertisement</li>
			</ol>
		</section>
        <!-- Content Header (Page header) -->
        
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
                  <a class="md-trigger btn btn-default btn-lg btn-block add-details"  onclick="window.location='AddAdvertisement?action=ADD'" href="javascript:;" data-modal="modal-13">
                    <i class="fa fa-plus">
                    </i>Add Adevertisement
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="Advertise?advertise_status=all" class="btn btn-success btn-lg  btn-block">
                    <i class="fa fa-list">
                    </i>All Advertise <span class="badge">
                    <?php echo getRowCount("select count(adv_id) from advertisement",$DatabaseCo);?></span>
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="Advertise?advertise_status=approved" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-thumbs-up">
                    </i>Approved Advertise <span class="badge">
                    <?php echo getRowCount("select count(adv_id) from advertisement where  status='APPROVED'",$DatabaseCo);?></span>
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="Advertise?advertise_status=unapproved" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-thumbs-down">
                    </i>Unapproved Advertise <span class="badge">
                    <?php echo getRowCount("select count(adv_id) from advertisement where  status='UNAPPROVED'",$DatabaseCo);?></span>
                  </a>
                </div>
                </div>
              </div>
            </div>
              <?php
if(!empty($STATUS_MESSAGE))
{	
if($statusObj->getActionSuccess()){
echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$STATUS_MESSAGE."</div>";
}else{
echo  "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$STATUS_MESSAGE."</li></ul></div>";		
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
              <?php
$main_menu_count = getRowCount("select count(adv_id) from advertisement".getWhereClauseForStatus($advertise_status),$DatabaseCo);
if($main_menu_count>0)
{  
$SQL_STATEMENT =  "SELECT * FROM advertisement ".getWhereClauseForStatus($advertise_status)." ORDER BY adv_id DESC";
?>
              <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
                <div class="box-top">
                	<div class="row">
                      <div class="col-lg-1 col-xs-3">
            			<input type="checkbox" name="check" id="selectall" class="second" />
                        <label for="selectall" class="label2">&nbsp;</label> 
            		  </div>
                      <div class="col-lg-2 col-xs-12 col-sm-4">
                        <a href="javascript:;" class="btn btn-danger btn-lg btn-block" onclick="submitActionForm('DELETE');">
                          <i class="fa fa-trash">
                          </i> Delete
                        </a>
                      </div>
                      <div class="col-lg-2 col-xs-12 col-sm-4">
                        <a href="javascript:;" class="btn btn-success btn-lg btn-block" onclick="submitActionForm('APPROVED');">
                          <i class="fa fa-thumbs-up">
                          </i>Approve
                        </a>
                      </div>
                      <div class="col-lg-2 col-xs-12 col-sm-4">
                        <a href="javascript:;" class="btn btn-warning btn-lg btn-block" onclick="submitActionForm('UNAPPROVED');">
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
                      <?php echo strtoupper($advertise_status); ?> ADVERISEMENT LIST
                    </h4>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body gtMemPlan">
                    <form method="post" action="Advertise" id="action_form" class="">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>
                             
                            </th>
                            <th>Edit
                            </th>
                            <th>status
                            </th>
                            <th>Name
                            </th>
                            <th>Link
                            </th>
                            <th >Ad Level
                            </th>
                            <th>Image
                            </th>
                            <th>Contact Person
                            </th>
                            <th >Phone
                            </th>
                            <th>Date
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php						
$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
$rowCount=0;
while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult))
{		
?>
                          <tr>
                            <td>
                              <input type="checkbox" name="adv_id[]" id="Item <?php  echo $DatabaseCo->dbRow->adv_id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->adv_id;?>"/>
                              <label for="Item <?php  echo $DatabaseCo->dbRow->adv_id;?>" class="label2">&nbsp;
                              </label>	
                            </td>
                            <td>
                              <a class="btn btn-default btn-sm" href="AddAdvertisement.php?id=<?php  echo $DatabaseCo->dbRow->adv_id;?>"
                                 title="Edit" id="edit_advertisement"><i class="fa fa-pencil"></i> Edit
                              </a>
                            </td>
                            <?php
$likeDisLikeCss = "";
if($DatabaseCo->dbRow->status=="APPROVED")
$likeDisLikeCss = "fa-thumbs-up";
else
$likeDisLikeCss = "fa-thumbs-down";
?>     
                            <td class="updateSiteApprovalStatus">
                              <i class="fa <?php echo $likeDisLikeCss;?>">
                              </i>
                            </td>
                            <td>
                              <?php  echo $DatabaseCo->dbRow->adv_name;?>
                            </td>
                            <td>
                              <?php  echo $DatabaseCo->dbRow->adv_link;?>
                            </td>
                            <td>
                              <?php  echo $DatabaseCo->dbRow->adv_level;?>
                            </td>
                            <td >
                              <img src="../advertise/<?php echo $DatabaseCo->dbRow->adv_img;?>" width="170" height="160" style="vertical-align:middle;" />
                            </td>
                            <td>
                              <?php  echo $DatabaseCo->dbRow->contact_name;?>
                            </td>
                            <td>
                              <?php  echo $DatabaseCo->dbRow->phone;?>
                            </td>
                            <td>
                              <?php  echo $DatabaseCo->dbRow->adv_date;?>
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
}
else
{
?>
              <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
                
                <img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
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
      <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
      <!-- page script -->
      <script type="text/javascript">
        $(function () {
          var refreshRequired = false;
          $("input[name=adv_id]").click(function(){
            $("#selectall").prop("checked", false);
          }
                                       );
          //     js for Check/Uncheck all CheckBoxes by Checkbox     // 
          $("#selectall").click(function(){
            $(".second").prop("checked",$("#selectall").prop("checked"))
          }
                               ) 
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