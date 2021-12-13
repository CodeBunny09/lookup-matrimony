<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$index_id = isset($_GET['id'])?$_GET['id']:0;
if($index_id!=0)
{
$DatabaseCo = new DatabaseConn(); 
$SQL_STATEMENT = "select * from site_config,register_view,payment_view where register_view.index_id=payment_view.index_id and register_view.index_id=".$index_id;
$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
while ($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)) 
{ 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Invoice
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <link href="css/custom.css" rel="stylesheet" type="text/css" />   
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
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
            Invoice
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li>Invoice</li>
          </ol>
        </section>
        <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">												
            <h4>
              <i class="fa fa-info">
              </i> Note:
            </h4>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
          </div>
        </div>
        <form action="" name="adminInvoice" method="post">
          <input type="hidden" name="username" id="username" value=""/>
          <input type="hidden" name="email" id="email" value=""/>
          <!-- Main content -->
          <section class="invoice">
            <!-- title row -->
            <div class="row">
              <div class="col-xs-12">
                <h2 class="page-header">
                  <i class="fa fa-globe"></i>&nbsp;&nbsp;
                  <strong>
                    <?php echo $DatabaseCo->dbRow->web_frienly_name;?>
                  </strong>  
                </h2>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                <!-------------------------------------------------> 
                From
                <address>
                  <address>
                    <strong>
                      <?php echo $DatabaseCo->dbRow->web_frienly_name;?>
                    </strong>
                    <br>
                    <div class="row">
                      <div class="col-xs-12">Contact No:
                        <?php echo $DatabaseCo->dbRow->contact_no;?>
                      </div>
                      <div class="col-xs-12">Email:
                        <?php echo $DatabaseCo->dbRow->from_email;?>
                      </div>     
                    </div>
                  </address>
                  <!------------------------------->
                  </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  &nbsp;&nbsp;&nbsp; To
                  <address>
                    <div class="col-xs-12">
                      <strong>
                        <?php echo $DatabaseCo->dbRow->pname;?>
                      </strong>
                    </div> 
                    <div class="col-xs-12">Address : 
                      <?php echo $DatabaseCo->dbRow->paddress;?>
                    </div>
                    <div class="col-xs-12">Phone : 
                      <?php echo $DatabaseCo->dbRow->phone;?>
                    </div>
                    <div class="col-xs-12">Email : 
                      <?php echo $DatabaseCo->dbRow->pemail;?>
                    </div>
                  </address>
                </div>
                <!-- !-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <div class="col-xs-12">
                    <strong>Invoice : 
                    </strong>INV001
                    <?php echo $DatabaseCo->dbRow->pmatri_id;?>
                  </div>
                  <div class="col-xs-12">
                    <strong>Customer Id : 
                    </strong>
                    <?php echo $DatabaseCo->dbRow->pmatri_id;?>
                  </div>
                  <div class="col-xs-12">
                    <strong>Payment Mode : 
                    </strong>
                    <?php echo $DatabaseCo->dbRow->paymode;?>
                  </div>
                  <div class="col-xs-12">
                    <strong>Activated ON : 
                    </strong>
                    <?php echo $DatabaseCo->dbRow->pactive_dt;?>
                  </div>
                  <div class="col-xs-12">
                    <strong>Account : 
                    </strong>
                    <?php echo $DatabaseCo->dbRow->payid;?>
                  </div> 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Qty
                        </th>
                        <th>Product
                        </th>
                        <th>expire On
                        </th>
                        <th>Description
                        </th>
                        <th>Subtotal
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1
                        </td>
                        <td>
                          <?php echo $DatabaseCo->dbRow->p_plan;?> Membership for 
                          <?php echo $DatabaseCo->dbRow->plan_duration;?> Days
                        </td>
                        <td>
                          <?php echo $DatabaseCo->dbRow->exp_date;?>
                        </td>
                        <td>
                          <?php echo $DatabaseCo->dbRow->description;?>
                        </td>
                        <td>
                          <?php echo $DatabaseCo->dbRow->p_amount;?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <!-- /.col -->
                <div class="col-xs-5" style="float:right;">
                  <p class="lead">Billing Information
                  </p>
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Total:
                        </th>
                        <td>
                          <?php echo $DatabaseCo->dbRow->p_amount;?>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-xs-12">
                  <div align="left">
                    <img src="img/print.png" onClick="window.print()" style=" text-align:center; cursor:pointer;" >
                    </br>
                  <span>
                    <strong>Print Invoice
                    </strong>
                  </span>
                  
                  <!-- <a class="btn btn-primary pull-right" style="margin-right: 5px;" href="form.php?id=<?php  echo $DatabaseCo->dbRow->index_id;?>&username=<?php  echo $DatabaseCo->dbRow->username;?>&email=<?php  echo $DatabaseCo->dbRow->pemail;?>"
title="Edit" id="invoice"><i class="fa fa-download"></i>Generate PDF</a>-->
                </div>
                </form>       
            </div>
            </div>
          </section>
        <!-- /.content -->
        <div class="clearfix">
        </div>
      </div>
      <!-- /.content-wrapper -->
      <?php include "page-part/footer.php"; ?>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
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
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript">
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
    <?php  
}
}else{
echo "<h1>Invalid User ID.</h1>";
}
?>
  </body>
</html>