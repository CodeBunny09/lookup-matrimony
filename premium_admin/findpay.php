<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
$DatabaseCo = new DatabaseConn();
$plan=$_REQUEST['plan'];
$member_id=$_REQUEST['id'];
$plan2 = "SELECT * from membership_plan where plan_name='$plan'";
$exe=$DatabaseCo->dbLink->query($plan2) or die(mysqli_error());
$rr=mysqli_fetch_array($exe);


$msg="";
$d=$rr['plan_amount'];
$e=$d * 14/100;
$final=$d+$e;

?>
<div class="row">
  <div class="form-group form-group-select2">
    <div class="col-xs-4">
      <label for="exampleInputEmail1">
        <b>Duration :
        </b>
      </label>
    </div>
    <div class="col-xs-6">
      <input name="duration" type="text" class="form-control" id="duration" value="<?php echo $rr['plan_duration'] ?>"/>
    </div>
  </div>
</div>  
<div class="row mt-10">
  <div class="form-group form-group-select2">
    <div class="col-xs-4">
      <label for="exampleInputEmail1">
        <b> No Of Contacts :
        </b>
      </label>
    </div>
    <div class="col-xs-6">
      <input name="no_of_contacts" type="text" class="form-control" id="no_of_contacts" value="<?php echo $rr['plan_contacts'] ?>"/>
    </div>
  </div>
</div>  
<div class="row mt-10">
  <div class="form-group form-group-select2">
    <div class="col-xs-4">
      <label for="exampleInputEmail1">
        <b>No Of Message :
        </b>
      </label>
    </div>
    <div class="col-xs-6">
      <input name="no_of_msg" type="text" class="form-control" id="no_of_msg" value="<?php echo $rr['plan_msg'] ?>"/>
    </div>
  </div>
</div>
<div class="row mt-10">
  <div class="form-group form-group-select2">
    <div class="col-xs-4">
      <label for="exampleInputEmail1">
        <b>No Of SMS :
        </b>
      </label>
    </div>
    <div class="col-xs-6">
      <input name="no_of_sms" type="text" class="form-control" id="no_of_sms" value="<?php echo $rr['plan_sms'] ?>"/>
    </div>
  </div>
</div>  
<div class="row mt-10" >
  <div class="form-group form-group-select2">
    <div class="col-xs-4">
      <label for="exampleInputEmail1">
        <b>No Of view profile :
        </b>
      </label>
    </div>
    <div class="col-xs-6">
      <input name="no_of_profile" type="text" class="form-control" id="no_of_profile" value="<?php echo $rr['profile'] ?>"/>
    </div>
  </div>
</div>
<div class="row mt-10">
  <div class="form-group form-group-select2">
    <div class="col-xs-4">
      <label for="exampleInputEmail1">
        <b>Chat :
        </b>
      </label>
    </div>
    <div class="col-xs-6">
      <select name="chat" class="form-control">
      	<option value="<?php echo $rr['chat'] ?>" <?php if($rr['chat'] === "Yes"){ echo "selected"; } ?> >Yes</option>
      	<option value="<?php echo $rr['chat'] ?>" <?php if($rr['chat'] === "No"){ echo "selected"; }?>>No</option>
      </select>
      
    </div>
  </div>
</div>  
<div class="row mt-10">
  <div class="form-group form-group-select2">
    <div class="col-xs-4">
      <label for="exampleInputEmail1">
        <b>Amount :
        </b>
      </label>
    </div>
    <div class="col-xs-6">   
      <input name="amount" type="text" class="form-control" id="amount" value="<?php echo $rr['plan_amount_type'] ?> <?php echo $rr['plan_amount'] ?>"/>
    </div>
  </div>
</div>