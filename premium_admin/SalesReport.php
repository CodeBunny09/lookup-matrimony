<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
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
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{     
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
if(isset($_POST['payid']))
{
$payid_arr = $_POST['payid'];
$payid_val = "(";
foreach($payid_arr as $payid)
{
$payid_val .=	$payid.",";
}
$payid_val = substr($payid_val, 0, -1);
$payid_val .=")";
switch($ACTION)
{
case 'DELETE':		
$SQL_STATEMENT =  "delete from payments where payid in ".$payid_val;	
break;
}
$statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
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
    <title>Manage |  Sales Report
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
    <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
    <link rel="stylesheet" href="css/all_check.css"/>   
    <script type="text/javascript" src="js/util/redirection.js">
    </script>
    <link rel="stylesheet" href="css/libs/select2.css"/>  
    <script type="text/javascript" src="js/util/location.js">
    </script>
    <script src="../js/swfobject.js" type="text/javascript">
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
            Manage Sales Report
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
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
            </div>
            <?php
			$main_menu_count = getRowCount("select count(payid) from payment_view".getWhereClauseForStatus($member_status),$DatabaseCo);
			if($main_menu_count>0)
			{  
			$SQL_STATEMENT =  "SELECT * FROM payment_view ".getWhereClauseForStatus($member_status)." ORDER BY payid DESC";
			?>
            <div class="col-lg-12 col-xs-12 col-sm-12">
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
                </div>
              </div>
            </div>         
            <div class="col-xs-12 mt-10">
              <!-- /.box -->
              <div class="box box-success">
                <div class="box-header">
                  <h4>
                    <?php echo strtoupper($member_status); ?> SALES REPORT LIST
                  </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body gtMemPlan">
                  <form method="post" action="SalesReport" id="action_form">
                    <table id="example123" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>
                            
                          </th>
                          <th>Invoice
                          </th>
                          <th>Matri-ID
                          </th>
                          <th>Email
                          </th>
                          <th>Payment Mode
                          </th>
                          <th>Plan Activated On
                          </th>
                          <th>Plan Name
                          </th>
                          <th>Plan Expired On
                          </th>
                          <th>Amount
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
                            <input type="checkbox" name="payid[]" id="Item <?php  echo $DatabaseCo->dbRow->payid;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->payid;?>"/>
                            <label for="Item <?php  echo $DatabaseCo->dbRow->payid;?>" class="label2">&nbsp;
                            </label>	
                          </td>
                          <td>
                            <a class="btn btn-default btn-sm md-trigger" href="Invoice.php?id=<?php  echo $DatabaseCo->dbRow->index_id;?>" title="invoice" id="invoicesales"><i class="fa fa-file-text"></i> Invoice
                            </a>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->pmatri_id;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->pemail;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->paymode;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->pactive_dt;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->p_plan;?>
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->exp_date;?> 
                          </td>
                          <td>
                            <?php echo $DatabaseCo->dbRow->p_amount;?>
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
              <h4>There are no data for 
                <?php echo strtoupper($member_status); ?> Sales Report. Please add data.
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
    </div>
  </div>
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
  setPageContext("sales","report");
</script>	
<!--jquery for left menu active class end--> 
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript">
</script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript">
</script>
<!-- SlimScroll -->
<!--<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>-->
<!-- FastClick -->
<!--<script src='plugins/fastclick/fastclick.min.js'></script>-->
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript">
</script>
<!--<script type="text/javascript" src="js/util/select2.min.js"></script>-->
<!--3D Slit effect pop js-->
<!--<script src="js/classie.js"></script>
<script src="js/modalEffects.js"></script>
-->  
<script type="text/javascript">
  //setPageContext("member_report","sale-report");
  function ShowDialog(modal)
  {
    $("#overlay").show();
    $("#full_detail_dialog").fadeIn(300);
    if (modal)
    {
      $("#overlay").unbind("click");
    }
    else
    {
      $("#overlay").click(function (e)
                          {
        HideDialog();
      }
                         );
    }
  }
  function HideDialog()
  {
    $("#overlay").hide();
    $("#full_detail_dialog").fadeOut(300);
  }
</script>
<script type="text/JavaScript">
  function MM_openBrWindow(theURL,winName,features) {
    window.open(theURL,winName,features);
  }
</script>
<SCRIPT LANGUAGE="JavaScript">
  <!-- Begin
  var win = null;
  function newWindow(mypage,myname,w,h,features) {
    var winl = (screen.width-w)/2;
    var wint = (screen.height-h)/2;
    if (winl < 0) winl = 0;
    if (wint < 0) wint = 0;
    var settings = 'height=' + h + ',';
    settings += 'width=' + w + ',';
    settings += 'top=' + wint + ',';
    settings += 'left=' + winl + ',';
    settings += features;
    win = window.open(mypage,myname,settings);
    win.window.focus();
  }
  //  End -->
  </script> 
<!-- page script -->
<script type="text/javascript">
  $(function () {
    var refreshRequired = false;
    $("input[name=payid]").click(function(){
      $("#selectall").prop("checked", false);
    }
                                );
    //     js for Check/Uncheck all CheckBoxes by Checkbox     // 
    $("#selectall").click(function(){
      $(".second").prop("checked",$("#selectall").prop("checked"))
    }
                         ) 
    // add details //
    $('#example123').dataTable({
      "aaSorting": [  [3,'desc'] ],
      'aoColumnDefs': [{
        'bSortable': false,
        'info': true,          
        "paging":   true,
        'aTargets': [0,1,2,8],
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