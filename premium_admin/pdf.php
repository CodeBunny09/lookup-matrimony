<?php
//error_reporting(0);
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
include_once '../class/Config.class.php';
$configObj = new Config();
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
$index_id = $_SESSION['id'];
$DatabaseCo = new DatabaseConn(); 
$SQL_STATEMENT = "select * from site_config, register_view,payment_view where register_view.index_id=payment_view.index_id and register_view.index_id=".$index_id;
$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
?>
<body style="background:rgba(255,255,255,1.00);font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif;">
  <div style="width:80%;margin:0 auto;">
    <div class="" style="width:100%;padding-top:20px; border-bottom: 1px solid rgb(220, 220, 220);float:left;">
      <h3 style="display:inline-block;margin-top:7px;margin-left:15px;">
        <strong>
          <?php echo $DatabaseCo->dbRow->web_frienly_name;?>
        </strong>
        <br>
      </h3>
    </div>
    <div class="" style="width:100%;padding-top:20px; border-bottom: 1px solid rgb(220, 220, 220);float:left;padding-bottom:20px;">
      <div style="width:30%;float:left;padding-left:15px;padding-right:15px;">
        <h5 style="margin-bottom:5px;font-weight:normal;">
          From
        </h5>
        <p style="margin-top:0px;margin-bottom:5px;">
          <strong>
            <?php echo $DatabaseCo->dbRow->web_frienly_name;?>
          </strong>
        </p>
        <p style="margin-top:0px;margin-bottom:5px;font-size:14px;">
          Contact No : 
          <span>
            <?php echo $DatabaseCo->dbRow->contact_no;?>
          </span>
        </p>
        <p style="margin-top:0px;margin-bottom:0px;font-size:14px;">
          Email Id :   
          <span>
            <?php echo $DatabaseCo->dbRow->from_email;?>
          </span>
        </p>
      </div>
      <div style="width:30%;float:left;padding-left:15px;padding-right:15px;">
        <h5 style="margin-bottom:5px;font-weight:normal;">
          To
        </h5>
        <p style="margin-top:0px;margin-bottom:5px;">
          <strong>
            <?php echo $DatabaseCo->dbRow->pname;?>
          </strong>
        </p>
        <p style="margin-top:0px;margin-bottom:5px;font-size:14px;">
          Address : 
          <span>
            <?php echo $DatabaseCo->dbRow->paddress;?>
          </span>
        </p>
        <p style="margin-top:0px;margin-bottom:0px;font-size:14px;">
          Phone no :   
          <span>
            <?php echo $DatabaseCo->dbRow->phone;?>
          </span>
        </p>
        <p style="margin-top:0px;margin-bottom:0px;font-size:14px;">
          Email Id :   
          <span>
            <?php echo $DatabaseCo->dbRow->pemail;?>
          </span>
        </p>
      </div>
      <div style="width:30%;float:left;padding-left:15px;padding-right:15px;">
        <p style="margin-top:0px;margin-bottom:5px;">
          <b>Invoice: 
          </b>INV001
          <?php echo $DatabaseCo->dbRow->pmatri_id;?>
        </p>
        <p style="margin-top:0px;margin-bottom:5px;">
          <b>Customer Id: 
          </b>
          <?php echo $DatabaseCo->dbRow->pmatri_id;?>
        </p>
        <p style="margin-top:0px;margin-bottom:5px;font-size:14px;">
          <b>Payment Mode: 
          </b>
          <?php echo $DatabaseCo->dbRow->paymode;?>
        </p>
        <p style="margin-top:0px;margin-bottom:5px;font-size:14px;">
          <b>Activated On: 
          </b>
          <?php echo $DatabaseCo->dbRow->pactive_dt;?>
        </p>
        <p style="margin-top:0px;margin-bottom:5px;font-size:14px;">
          <b>Account No: 
          </b>
          <?php echo $DatabaseCo->dbRow->payid;?>
        </p>
      </div>
    </div>
    <div style="width:100%;padding-top:20px;float:left;">
      <div class="" style="width:100%;float:left;padding-top:10px;padding-bottom:10px;border-bottom: 1px solid #D2D2D2;">
        <div style="width:10%;float:left;text-align:center;">
          <b>Qty
          </b>
        </div>
        <div style="width:25%;float:left;text-align:center;">
          <b>Products
          </b>
        </div>
        <div style="width:20%;float:left;text-align:center;">
          <b>Expires On
          </b>
        </div>
        <div style="width:25%;float:left;text-align:center;">
          <b>Desciption
          </b>
        </div>
        <div style="width:20%;float:left;text-align:center;">
          <b>Sub total
          </b>
        </div>
      </div>
      <div class="" style="width:100%;float:left;padding-top:10px;padding-bottom:10px;background:rgb(247, 247, 247);border-bottom: 1px solid #E6E6E6;">
        <div style="width:10%;float:left;text-align:center;font-size:13px; padding-top:5px;padding-bottom:5px;">
          1
        </div>
        <div style="width:25%;float:left;text-align:center;font-size:13px; padding-top:5px;padding-bottom:5px;">
          <b>
            <?php echo $DatabaseCo->dbRow->p_plan;?> Membership for 
            <?php echo $DatabaseCo->dbRow->plan_duration;?> Days
          </b>
        </div>
        <div style="width:20%;float:left;text-align:center;font-size:13px; padding-top:5px;padding-bottom:5px;">
          <b>
            <?php echo $DatabaseCo->dbRow->exp_date;?>
          </b>
        </div>
        <div style="width:25%;float:left;text-align:center;font-size:13px; padding-top:5px;padding-bottom:5px;">
          <b>
            <?php echo $DatabaseCo->dbRow->description;?>
          </b>
        </div>
        <div style="width:20%;float:left;text-align:center;font-size:13px;padding-top:5px;padding-bottom:5px;">
          <b>
            <?php echo $DatabaseCo->dbRow->p_amount;?>
          </b>
        </div>
      </div>

      <div style="width:100%;padding-top:20px;float:left;">
        <div style="width:30%;float:right;">
          <h2 style="margin-bottom:20px;float:left;font-weight:normal; border-bottom:1px solid rgba(211,211,211,1.00);width:100%;padding-bottom:20px;">
            Billing Information
          </h2>
          <div class="" style="width:100%;float:left;">
            <div style="width:40%;float:left;">
              <b>Total
              </b>
            </div>
            <div style="width:60%;float:left;">
              <?php echo $DatabaseCo->dbRow->p_amount;?>
            </div>
          </div>
        </div>
      </div>
    </div>
    </body>
  </html>