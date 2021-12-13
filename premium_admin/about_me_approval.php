<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$about_status = "";
if(isset($_GET['about_status']))
{
$about_status = $_GET['about_status'];
$_SESSION['about_status'] = $_GET['about_status'];
}
else if(isset($_GET['page']))
{
$about_status = $_SESSION['about_status'];
}
else
{
$_SESSION['about_status'] = "all";
$about_status = "all";
}
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{     
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
if(isset($_POST['index_id']))
{
$index_id_arr = $_POST['index_id'];
$index_val = "(";
foreach($index_id_arr as $index_id)
{
$index_val .=	$index_id.",";
}
$index_val = substr($index_val, 0, -1);
$index_val .=")";
switch($ACTION)
{
case 'Delete':		
$SQL_STATEMENT =  "update register set profile_text='' where index_id in ".$index_val;	
$exe=$DatabaseCo->dbLink->query("select profile_text from register where index_id in ".$index_val);
	  
break;
case 'Approved':
$SQL_STATEMENT =  "update  register set profile_text_approve='Approved' where index_id in ".$index_val;	
break;
case 'Unapproved':
$SQL_STATEMENT =  "update  register set profile_text_approve='Unapproved' where index_id in ".$index_val;	
break;
}
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
$STATUS_MESSAGE = $statusObj->getStatusMessage();
}
else
{
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
    <title>Manage | About Me Approval
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
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/all_check.css"/>   
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    <link rel="stylesheet" href="css/libs/select2.css"/>   
    <script type="text/javascript" src="js/util/location.js">
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
            About Me Approval
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active"> About Me Approval</li>
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
              	
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="about_me_approval.php?about_status=all" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-list">
                    </i>All About Me <span class="badge">
                    <?php echo getRowCount("select count(index_id) from register WHERE profile_text!='' ",$DatabaseCo);?></span>
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="about_me_approval.php?about_status=approved" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-thumbs-up">
                    </i>Approved About Me <span class="badge">
                    <?php echo getRowCount("select count(index_id) from register where profile_text!='' AND profile_text_approve='Approved'",$DatabaseCo);?></span>
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="about_me_approval.php?about_status=unapproved" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-thumbs-down">
                    </i>Unapproved About Me <span class="badge">
                    <?php echo getRowCount("select count(index_id) from register where profile_text!='' AND profile_text_approve='Unapproved'",$DatabaseCo);?></span>
                  </a>
                </div>
				<div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="about_me_approval.php?about_status=pending" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-thumbs-down">
                    </i>Pending About Me <span class="badge">
                    <?php echo getRowCount("select count(index_id) from register where profile_text!='' AND profile_text_approve='Pending'",$DatabaseCo);?></span>
                  </a>
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
				}?>
            </div>
            
            <?php
			$main_menu_count = getRowCount("select count(index_id) from register".getWhereClauseForAbout($about_status),$DatabaseCo);
			if($main_menu_count>0)
			{  
			
				$SQL_STATEMENT =  "SELECT * FROM  register".getWhereClauseForAbout($about_status)." ORDER BY profile_text_date DESC";
				//$SQL_STATEMENT = "SELECT * FROM `register` ORDER BY `index_id` DESC";
			?>
          
        <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
          <div class="box-top">
          	<div class="row">
          	<div class="col-lg-1 col-sm-3 col-xs-3">
                	 <input type="checkbox" name="check" id="selectall" class="second" />
                      <label for="selectall" class="label2">&nbsp;</label> 
                </div>
            <div class="col-lg-2 col-xs-12 col-sm-4">
              <a href="javascript:;" class="btn btn-danger btn-lg btn-block" onclick="submitActionForm('Delete');">
                <i class="fa fa-trash">
                </i> Delete
              </a>
            </div>
            <div class="col-lg-2 col-xs-12 col-sm-4">
              <a href="javascript:;" class="btn btn-success btn-lg btn-block" onclick="submitActionForm('Approved');">
                <i class="fa fa-thumbs-up">
                </i>Approve
              </a>
            </div>
            <div class="col-lg-2 col-xs-12 col-sm-4">
              <a href="javascript:;" class="btn btn-warning btn-lg btn-block" onclick="submitActionForm('Unapproved');">
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
                <?php echo strtoupper($about_status); ?>  ABOUT ME LIST
              </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body gtMemPlan">
              <form method="post" action="about_me_approval" id="action_form">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>
                       
                      </th>
                      <th width="10%">Status
                      </th>
                      <th width="15%">User name
                      </th>
                       <th width="20%">Date
                      </th>
                      <th width="20%">Matri ID
                      </th>
                      <th width="15%">User Staus
                      </th>
                      <th width="37%">About Me
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
                        <input type="checkbox" name="index_id[]" id="Item <?php  echo $DatabaseCo->dbRow->index_id;?>" class="second" value="<?php  echo 				$DatabaseCo->dbRow->index_id;?>"/>
                        <label for="Item <?php  echo $DatabaseCo->dbRow->index_id;?>" class="label2">&nbsp;
                        </label>	
                      </td>
                      <?php
						$likeDisLikeCss = "";
							if($DatabaseCo->dbRow->profile_text_approve=="Approved"){
								$likeDisLikeCss = "fa-thumbs-up";
							}elseif($DatabaseCo->dbRow->profile_text_approve=="Pending"){
								$likeDisLikeCss = "fa-clock-o";
							}else{
								$likeDisLikeCss = "fa-thumbs-down";
							}
						?>     
                      <td class="updateSiteApprovalStatus">
                        <i class="fa <?php echo $likeDisLikeCss;?>">
                        </i>
                      </td>
                      
                      <td>
                        <?php echo $DatabaseCo->dbRow->username;?>
                      </td>
                      <td>
                        <?php echo $DatabaseCo->dbRow->profile_text_date;?>
                      </td>
                      <td>
                        <?php echo $DatabaseCo->dbRow->matri_id;?>
                      </td>
                      
                      <td>
                        <?php echo $DatabaseCo->dbRow->status;?>
                      </td>
                      <td title="<?php echo $DatabaseCo->dbRow->username;?>">
                        <?php echo $DatabaseCo->dbRow->profile_text;?>
                      </td>
                    </tr>
                    <?php
$rowCount++;
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
        <div class="col-lg-12 col-xs-12 col-sm-12">
          
         <img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
        </div>
        <?php
			}
			?> 
            </div>  
        <!-- /.col -->
      <!-- /.row -->
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
  setPageContext("approval","about-approve");
</script>	
<!--jquery for left menu active class end-->
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript">
</script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript">
</script>
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
<!-- page script -->
<script type="text/javascript">
  $(function () {
    var refreshRequired = false;
    $("input[name=index_id]").click(function(){
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
<div class="modal fade-in" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<!--jquery for left menu active class-->
<script type="text/javascript" src="dist/js/general.js">
</script>
<script type="text/javascript" src="dist/js/cookieapi.js">
</script>
<script type="text/javascript">
  setPageContext("approval","about-approve");
  
</script>	
<!--jquery for left menu active class end-->
</body>
</html>