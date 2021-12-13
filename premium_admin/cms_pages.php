<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$cms_status = "";
if (isset($_GET['cms_status'])) {
$cms_status = $_GET['cms_status'];
$_SESSION['cms_status'] = $_GET['cms_status'];
} else if (isset($_GET['page'])) {
$cms_status = $_SESSION['cms_status'];
} else {
$_SESSION['cms_status'] = "all";
$cms_status = "all";
}
$isPostBack = ($_SERVER["REQUEST_METHOD"] === "POST");
if ($isPostBack) {
$ACTION = isset($_POST['action']) ? $_POST['action'] : "";
if (isset($_POST['cms_id']) && is_array($_POST['cms_id'])) {
$cms_id_arr = $_POST['cms_id'];
$cms_id_val = "(";
foreach ($cms_id_arr as $cms_id) {
$cms_id_val .= $cms_id . ",";
}
$cms_id_val = substr($cms_id_val, 0, -1);
$cms_id_val .=")";
switch ($ACTION) {
case 'DELETE':
$SQL_STATEMENT = "delete from    cms_pages where cms_id in " . $cms_id_val;
break;
case 'APPROVED':
$SQL_STATEMENT = "update   cms_pages set status='APPROVED' where cms_id in " . $cms_id_val;
break;
case 'UNAPPROVED':
$SQL_STATEMENT = "update   cms_pages set status='UNAPPROVED' where cms_id in " . $cms_id_val;
break;
}
$statusObj = handle_post_request("UPDATE", $SQL_STATEMENT, $DatabaseCo);
$STATUS_MESSAGE = $statusObj->getStatusMessage();
} else {
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
    <title>Manage |  CMS Page 
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
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/all_check.css"/>   
    <script type="text/javascript" src="js/util/redirection.js">
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
            CMS Page List
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-dashboard">
                </i> Home
              </a>
            </li>
            <li class="active">CMS Page
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
              <div class="box-top updateSite">
              	<div class="row">
                <div class="col-lg-3 col-sm-4">
                  <a class="md-trigger btn btn-default btn-lg btn-block add-details"  href="edit_cms">
                    <i class="fa fa-plus">
                    </i>Add New CMS Page
                  </a>
                </div>
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="cms_pages?cms_status=all" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-list">
                    </i>All CMS Page <span class="badge">
                    <?php echo getRowCount("select count(cms_id) from   cms_pages", $DatabaseCo); ?></span>
                  </a>
                </div> 
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="cms_pages?cms_status=approved" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-thumbs-up">
                    </i>Approved CMS Page <span class="badge">
                    <?php echo getRowCount("select count(cms_id) from   cms_pages where status='APPROVED'", $DatabaseCo); ?></span>
                  </a>
                </div> 
                <div class="col-lg-3 col-xs-12 col-sm-4">
                  <a href="cms_pages?cms_status=unapproved" class="btn btn-success btn-lg btn-block">
                    <i class="fa fa-thumbs-down">
                    </i>Unapproved CMS Page <span class="badge">
                    <?php echo getRowCount("select count(cms_id) from  cms_pages where status='UNAPPROVED'", $DatabaseCo); ?></span>
                  </a>
                </div>
                </div>
              </div>
              <?php
if (!empty($STATUS_MESSAGE)) {
if ($statusObj->getActionSuccess()) {
echo "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> " . $STATUS_MESSAGE . "</div>";
} else {
echo "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>" . $STATUS_MESSAGE . "</li></ul></div>";
}
}
?>
              <?php
$success = isset($_GET['update_status']) ? $_GET['update_status'] : "";
if (!empty($success)) {
echo "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i>Record Updated Successfully.</div>";
}
?>         
            </div>
            <?php
$main_menu_count = getRowCount("select count(cms_id) from  cms_pages" . getWhereClauseForStatus($cms_status), $DatabaseCo);
if ($main_menu_count > 0) {
$SQL_STATEMENT = "SELECT * FROM  cms_pages " . getWhereClauseForStatus($cms_status) . " ORDER BY cms_id DESC";
?>
            <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
              <div class="box-top">
              	<div class="row">
                <div class="col-lg-1 col-xs-3">
                	<input type="checkbox" name="check" id="selectall" class="second" />
                            <label for="selectall" class="label2">&nbsp;
                            </label> 
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
                    <?php echo strtoupper($cms_status); ?> CMS Page List
                  </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body gtMemPlan">
                  <form method="post" action="cms_pages" id="action_form">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>
                            
                          </th>
                          <th>CMS ID
                          </th>
                          <th>Edit
                          </th>
                          <th>Status
                          </th>
                          <th>Title
                          </th>
                          <th>Content
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
$rowCount = 0;
while ($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)) {
?>
                        <tr>
                          <td>
                            <input type="checkbox" name="cms_id[]" id="Item <?php echo $DatabaseCo->dbRow->cms_id; ?>" class="second" value="<?php echo $DatabaseCo->dbRow->cms_id; ?>"/>
                            <label for="Item <?php echo $DatabaseCo->dbRow->cms_id; ?>" class="label2">&nbsp;
                            </label>	
                          </td>
                          <td>
                            <?php  echo "cms?cms_id=".$DatabaseCo->dbRow->cms_id;?>
                          </td>
                          <td>
                            <a class="btn btn-default btn-sm md-trigger edit-popup"  href="edit_cms?edit_id=<?php echo $DatabaseCo->dbRow->cms_id; ?>">
                              <i class="fa fa-pencil fa-fw">
                              </i>
                              <span class="hidden-xs">&nbsp;&nbsp;Edit
                              </span>
                            </a>
                          </td>
                          <?php
$likeDisLikeCss = "";
if ($DatabaseCo->dbRow->status == "APPROVED")
$likeDisLikeCss = "fa-thumbs-up";
else
$likeDisLikeCss = "fa-thumbs-down";
?>     
                          <td class="updateSiteApprovalStatus">
                            <i class="fa <?php echo $likeDisLikeCss; ?>">
                            </i>
                          </td>
                          
                          <td>
                            <?php echo $DatabaseCo->dbRow->cms_title; ?>
                          </td>
                          <td>
                            <?php echo htmlspecialchars_decode($DatabaseCo->dbRow->cms_content, ENT_QUOTES); ?>
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
else {
?>
            <div class="col-lg-12 col-xs-12 col-sm-12">
              <h4>There are no data for 
                <?php echo strtoupper($cms_status); ?> CMS Page. Please add data.
              </h4>
              <br/>
              <img src="../img/nodata-available.png" alt="No Data" style="border: 2px solid #ccc;"/>
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
      setPageContext("cms", "cms_page");
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
    <script>
      $(function() {
        $("input[name=index_id]").click(function() {
          $("#selectall").prop("checked", false);
        }
                                       );
        //     js for Check/Uncheck all CheckBoxes by Checkbox     // 
        $("#selectall").click(function() {
          $(".second").prop("checked", $("#selectall").prop("checked"))
        }
                             )
        $('#example1').dataTable({
          "aaSorting": [[3, 'desc']],
          'aoColumnDefs': [{
            'bSortable': false,
            'info': true,
            "paging": true,
            'aTargets': [0, 1],
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