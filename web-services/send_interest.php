<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();	
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
$from_id = isset($_REQUEST['frmid'])?$_REQUEST['frmid']:0;
$select="select * from payments where pmatri_id='$mid'";
$exe=mysqli_query($DatabaseCo->dbLink,$select) or die(mysqli_error($DatabaseCo->dbLink));
$fetch=mysqli_fetch_array($exe);
$exp_date=$fetch['exp_date'];
$today= date('Y-m-d');
if($_SESSION['user_id']!=''){
$SQL_STATEMENT_SETTINGS=$DatabaseCo->dbLink->query("SELECT interest_setting FROM site_config WHERE id='1'");
$site_settings=mysqli_fetch_object($SQL_STATEMENT_SETTINGS);
if($site_settings->interest_setting == 'send_to_paid'){
	if ($exp_date > $today){
		$sel=$DatabaseCo->dbLink->query("select * from  block_profile where block_by='$from_id' and block_to='$mid'");
		$num_block=mysqli_num_rows($sel);
		$sel_block=$DatabaseCo->dbLink->query("select * from  block_profile where block_to='$from_id' and block_by='$mid'");
		$num_block_list=mysqli_num_rows($sel_block);
		if($num_block>0){ 
	?>
	<div class="modal-dialog">  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;">You are Blocked
      </h4>
    </div>
    <div class="modal-body">      
		<form name="MatriForm" id="MatriForm" action="membershipplans" method="post">
		  <div class="form-group">
			 <h5>This member has blocked you.You can't express your interest.</h5>
			
			<div class="clearfix"></div>
		  </div>                 
		</form>
    </div>      
  </div>
</div>
	<?php }elseif($num_block_list > 0){ ?>
	<div class="modal-dialog">  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;">User Blocked by You.
      </h4>
    </div>
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
      <div class="row">
       <div class="col-xs-16">
        <div class="col-sm-16">
          <h5>Member is blocked by you,if you wish to see contact details please unblock first.
          </h5>
        </div>
        <div class="col-sm-16 text-center gt-margin-bottom-20">
        	<a href="blocklisted-members" class="btn gt-btn-orange">
        		Unblock Now
        	</a>
        </div>
      </div>
      </div>
    </form>
  </div>
</div>
	<?php }else {  ?>
	<div class="modal-dialog modal-lg">
  <div class="modal-content xxl-16 xl-16 m-16 l-16 s-16 xs-16">
   
    <div class="modal-header" id="ExpressLabel">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
        <span aria-hidden="true">&times;
        </span>
      </button>
      <h4 class="modal-title" id="myModalLabel">
        <i class="fa fa-heart gt-margin-right-10 text-danger">
        </i>Express Interest 
      </h4>
    </div>
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
    <div class="clearfix">
    </div>
    <div class="modal-body">
      
        <div class="xxl-16 xl-16 m-16 l-16 s-16 xs-16">
          <input type="hidden" name="ExmatriId" id="ExmatriId" value="<?php echo $from_id; ?>" />
          <ul class="list-unstyled">                              
            <li>
              <label for="interest-1" class="gt-font-weight-500">
                <input name="exp_interest"  class="radio-inline" type="radio" value="I am interested in your profile. Please Accept if you are interested." checked id="interest-1"  />
                I am interested in your profile. Please Accept if you are interested.
              </label>
            </li
            <li>
              <label for="interest-2" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="You are the kind of person we have been looking for. Please respond to proceed further." id="interest-2" > 
                You are the kind of person we have been looking for. Please respond to proceed further.
              </label>
            </li>
            <li>
              <label for="interest-3" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value=" We liked your profile and interested to take it forward. Please reply at the earliest."  id="interest-3"> 
                We liked your profile and interested to take it forward. Please reply at the earliest.
              </label>
            </li>
            <li>
              <label for="interest-4" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="You seem to be the kind of person who suits our family. We would like to contact your parents to proceed further." id="interest-4">
                You seem to be the kind of person who suits our family. We would like to contact your parents to proceed further.
              </label>
            </li>
            <li>
              <label for="interest-5" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="You profile matches my sister's/brother's profile. Please 'Accept' if you are interested." id="interest-5"> You profile matches my sister's/brother's profile. Please 'Accept' if you are interested.
              </label>
            </li>
            <li>
              <label for="interest-6" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="Our children's profile seems to match. Please reply to proceed further." id="interest-6"> Our children's profile seems to match. Please reply to proceed further.
              </label>
            </li>
            <li>
              <label for="interest-7" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="We find a good life partner in you for our friend. Please reply to proceed further." id="interest-7"> We find a good life partner in you for our friend. Please reply to proceed further.
              </label>
            </li>
          </ul>                           
        </div>
        <div class="clearfix">
        </div>
      
    </div>
    <div class="modal-footer">
      <p class="pull-left text-danger">Date - 
        <small><?php echo date('l j F ,Y g:i A');?></small>
      </p>  
      <button type="button" name="send-interest" value="submit" class="btn gt-btn-green" id="sent_interest" >Send Interest
      </button>
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="javascript:window.location.reload()">Close
      </button>
    </div>
    </form>
  </div>
</div>
<?php
	} }else{
?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;
        </span>
      </button>
      <h4 class="modal-title text-danger" id="myModalLabel">
        Upgrade Your Membership 
      </h4>
    </div>
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="membershipplans" method="post">
      <div class="modal-body">
         <h5>You are not a paid member, Please upgrade your membership to express the interest.</h5>
      </div>
     
    </form>
    <div class="modal-footer">
      <a href="membershipplans" type="button" class="btn gt-btn-orange">Upgrade Now
        </a>
      <a href="#" type="button" class="btn btn-default" data-dismiss="modal">Close
      </a>
    </div>
   
  </div>
</div>
<?php
	}
}else{
	$sel=$DatabaseCo->dbLink->query("select * from  block_profile where block_by='$from_id' and block_to='$mid'");
		$num_block=mysqli_num_rows($sel);
		$sel_block=$DatabaseCo->dbLink->query("select * from  block_profile where block_to='$from_id' and block_by='$mid'");
		$num_block_list=mysqli_num_rows($sel_block);
		if($num_block>0){
?>
	<div class="modal-dialog">  
  		<div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;">You are Blocked
      </h4>
    </div>
    <div class="modal-body">      
		<form name="MatriForm" id="MatriForm" action="membershipplans" method="post">
		  <div class="form-group">
			 <h5>This member has blocked you.You can't express your interest.</h5>
			
			<div class="clearfix"></div>
		  </div>                 
		</form>
    </div>      
  </div>
	</div>
	<?php }elseif($num_block_list > 0){ ?>
	<div class="modal-dialog">  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;">User Blocked by You.
      </h4>
    </div>
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
      <div class="row">
       <div class="col-xs-16">
        <div class="col-sm-16">
          <h5>Member is blocked by you,if you wish to see contact details please unblock first.
          </h5>
        </div>
        <div class="col-sm-16 text-center gt-margin-bottom-20">
        	<a href="blocklisted-members" class="btn gt-btn-orange">
        		Unblock Now
        	</a>
        </div>
      </div>
      </div>
    </form>
  </div>
</div>
	<?php }else {  ?>
	<div class="modal-dialog modal-lg">
  <div class="modal-content xxl-16 xl-16 m-16 l-16 s-16 xs-16">
   
    <div class="modal-header" id="ExpressLabel">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()">
        <span aria-hidden="true">&times;
        </span>
      </button>
      <h4 class="modal-title" id="myModalLabel">
        <i class="fa fa-heart gt-margin-right-10 text-danger">
        </i>Express Interest 
      </h4>
    </div>
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
    <div class="clearfix">
    </div>
    <div class="modal-body">
      
        <div class="xxl-16 xl-16 m-16 l-16 s-16 xs-16">
          <input type="hidden" name="ExmatriId" id="ExmatriId" value="<?php echo $from_id; ?>" />
          <ul class="list-unstyled">                              
            <li>
              <label for="interest-1" class="gt-font-weight-500">
                <input name="exp_interest"  class="radio-inline" type="radio" value="I am interested in your profile. Please Accept if you are interested." checked id="interest-1"  />
                I am interested in your profile. Please Accept if you are interested.
              </label>
            </li
            <li>
              <label for="interest-2" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="You are the kind of person we have been looking for. Please respond to proceed further." id="interest-2" > 
                You are the kind of person we have been looking for. Please respond to proceed further.
              </label>
            </li>
            <li>
              <label for="interest-3" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value=" We liked your profile and interested to take it forward. Please reply at the earliest."  id="interest-3"> 
                We liked your profile and interested to take it forward. Please reply at the earliest.
              </label>
            </li>
            <li>
              <label for="interest-4" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="You seem to be the kind of person who suits our family. We would like to contact your parents to proceed further." id="interest-4">
                You seem to be the kind of person who suits our family. We would like to contact your parents to proceed further.
              </label>
            </li>
            <li>
              <label for="interest-5" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="You profile matches my sister's/brother's profile. Please 'Accept' if you are interested." id="interest-5"> You profile matches my sister's/brother's profile. Please 'Accept' if you are interested.
              </label>
            </li>
            <li>
              <label for="interest-6" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="Our children's profile seems to match. Please reply to proceed further." id="interest-6"> Our children's profile seems to match. Please reply to proceed further.
              </label>
            </li>
            <li>
              <label for="interest-7" class="gt-font-weight-500">
                <input name="exp_interest" class="radio-inline" type="radio" value="We find a good life partner in you for our friend. Please reply to proceed further." id="interest-7"> We find a good life partner in you for our friend. Please reply to proceed further.
              </label>
            </li>
          </ul>                           
        </div>
        <div class="clearfix">
        </div>
      
    </div>
    <div class="modal-footer">
      <p class="pull-left text-danger">Date - 
        <small><?php echo date('l j F ,Y g:i A');?></small>
      </p>  
      <button type="button" name="send-interest" value="submit" class="btn gt-btn-green" id="sent_interest">Send Interest
      </button>
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="javascript:window.location.reload()">Close
      </button>
    </div>
    </form>
  </div>
</div>
<?php
}
}}else {
?>
<div class="modal-dialog">  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;">Please Login !!!
      </h4>
    </div>
    <div class="modal-body">
		<form name="MatriForm" id="MatriForm" class="form-horizontal"  method="post">
		   <h5>Please Login to access this feature.</h5>
		</form>
	</div>
	<div class="modal-footer">
		<a href="login" class="btn gt-btn-orange">Login Now</a>
	</div>
  </div>
</div>
<?php 
}
?>

<script type="text/javascript">
  $('#sent_interest').click(function(){
    var dataString =$("#MatriForm").serialize();
    $('#MatriForm').html('<div style="height:240px;text-align:center;"><img src="img/loader.gif" alt="Sending..."/></div>');
    $.ajax({
      url:"web-services/admit_interest",
      type:"POST",
      data:dataString,
      cache: false,
      success: function(response)
      {
        $('#MatriForm').text(response).addClass('admitModal');
      }
    }
          );
  }
     ) 
</script>
