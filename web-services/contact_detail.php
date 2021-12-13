<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();	
$mid = isset($_SESSION['user_id']) ? $_SESSION['user_id']:'';
$from_id = isset($_REQUEST['toid']) ? $_REQUEST['toid']:0;   
$select="select * from payment_view where pmatri_id='$mid'";
$exe=$DatabaseCo->dbLink->query($select);
$fetch=mysqli_fetch_array($exe);
$total_cnt=$fetch['p_no_contacts'];
$used_cnt=$fetch['r_cnt'];
$checker=mysqli_num_rows($DatabaseCo->dbLink->query("select * from contact_checker where my_id='$mid' and viewed_id='$from_id'"));
if($_SESSION['user_id']!=''){
	if($total_cnt-$used_cnt>0){
		$get=$DatabaseCo->dbLink->query("select * from register_view where matri_id='$from_id'");
		$Row=mysqli_fetch_object($get);
		$Row->contact_view_security;
?>
<?php 
	if($Row->contact_view_security=='1'){ 
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
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
      <div class="row">
        <div class="col-sm-12">
          <h4>This member has blocked you.You can't see his contact details.
          </h4>
        </div>
      </div>
    </form>
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
<?php }else{
		$whocheck=mysqli_query($DatabaseCo->dbLink,"SELECT * FROM contact_view where my_id='$mid' and viewed_mem_id='$from_id'");
		if(mysqli_num_rows($whocheck)==0){
			$insert=mysqli_query($DatabaseCo->dbLink,"insert into contact_view(my_id,viewed_mem_id,viewed_date) values('$mid','$from_id',now())");
		}else{
			$update=mysqli_query($DatabaseCo->dbLink,"update contact_view set my_id='$mid',viewed_mem_id='$from_id',viewed_date=now() where my_id='$mid' and viewed_mem_id='$from_id'");	
		}
?>
	<!-- Details 1 -->
	<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel">
        <?php if($checker!=0){ echo "Contact details have been already seen."; ?>
        <br> Remaining Contacts  (
        <?php echo $total_cnt-$used_cnt;?> / 
        <?php echo $total_cnt;?>)
        <?php } else {?>
        Remaining Contacts  (
        <?php echo $total_cnt-$used_cnt-1;?> / 
        <?php echo $total_cnt;?>) 
        <?php } ?>
      </h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
          <div class="col-xs-16 form-group">
            <center>
              <div class="col-xs-6">
                <div class="thumbnail">
                 <?php include('../parts/mem_detail_photo.php');?>
                </div>
              </div> 
            </center>    
            <div class="col-xs-10">  
              <table class="table table-hover table-striped">
                <tr>
                  <td>
                    <strong>Matri ID :
                    </strong>
                  </td> 
                  <td>
                    <?php echo $Row->matri_id; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Full Name :
                    </strong>
                  </td> 
                  <td> 
                    <?php echo $Row->firstname." ".$Row->lastname;?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Caste :
                    </strong>
                  </td> 
                  <td> 
                    <?php echo $Row->caste_name; ?>
                  </td>
                </tr> 
                
                <tr>
                  <td>
                    <strong>Country :
                    </strong>
                  </td> 
                  <td> 
                    <?php echo $Row->country_name; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>State :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->state_name; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>City :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->city_name; ?>
                  </td>
                </tr>
                
                <tr>
                  <td>
                    <strong>Mobile :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->mobile; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Date of Birth :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->birthdate; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Time of Birth:
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->birthtime; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Raasi :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->moonsign; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Star :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->star; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Email :
                    </strong>
                  </td> 
                  <td> 
                    <?php echo $Row->email; ?>
                  </td>
                </tr>
              </table>	
              <div class="clerfix">
              </div>
            </div>
            <div class="clerfix">
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php
$DatabaseCo->dbLink->query("insert into reminder(rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) values('','".$mid."','".$from_id."','chk_contact','check','Yes','Yes',NOW())");
if($checker==0){
	$sel=$DatabaseCo->dbLink->query("SELECT * FROM payments where pmatri_id='$mid'"); 
	$fetch123=mysqli_fetch_array($sel);
	$tot_cnt=$fetch123['p_no_contacts'];
	$use_cnt=$fetch123['r_cnt'];
	$use_cnt=$use_cnt+1;
if($tot_cnt>=$use_cnt){
	$update="UPDATE payments SET r_cnt='$use_cnt' WHERE pmatri_id='$mid' ";
	$d=$DatabaseCo->dbLink->query($update);
}
	$ins=$DatabaseCo->dbLink->query("insert into contact_checker (my_id,viewed_id,date) values ('$mid','$from_id',now())");	
}
?>
  </div>
</div>
<?php
	} }else if($Row->contact_view_security=='0'){
$exp_sel=$DatabaseCo->dbLink->query("select * from expressinterest where ei_sender='$mid' and ei_receiver='$from_id' and receiver_response ='Accept'");
$num=mysqli_num_rows($exp_sel);
if($num>0){
$sel=$DatabaseCo->dbLink->query("select * from  block_profile where block_by='$from_id' and block_to='$mid'");
$num_block=mysqli_num_rows($sel);
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
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
      <div class="row">
        <div class="col-sm-12">
          <h4>This member has blocked you.You can't see his contact details.
          </h4>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
}else{
$whocheck=mysqli_query($DatabaseCo->dbLink,"SELECT * FROM contact_view where my_id='$mid' and viewed_mem_id='$from_id'");
if(mysqli_num_rows($whocheck)==0){
$insert=mysqli_query($DatabaseCo->dbLink,"insert into contact_view(my_id,viewed_mem_id,viewed_date) values('$mid','$from_id',now())");
}else{
$update=mysqli_query($DatabaseCo->dbLink,"update contact_view set my_id='$mid',viewed_mem_id='$from_id',viewed_date=now() where my_id='$mid' and viewed_mem_id='$from_id'");	
}
?>
<!-- Details -->
<div class="modal-dialog yoyo-large">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel">
        <?php if($checker!=0){ echo "Contact details have been already seen."; ?>
        <br> Remaining Contacts  (
        <?php echo $total_cnt-$used_cnt;?> / 
        <?php echo $total_cnt;?>)
        <?php } else {?>
        Remaining Contacts  (
        <?php echo $total_cnt-$used_cnt-1;?> / 
        <?php echo $total_cnt;?>) 
        <?php } ?>
      </h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
          <div class="col-xs-16 form-group">
            <center>
              <div class="col-xs-6">
                <div class="thumbnail">
                   <?php include('../parts/mem_detail_photo.php');?>
                </div>
              </div> 
            </center>    
            <div class="col-xs-10">  
              <table class="table table-hover table-striped">
                <tr>
                  <td>
                    <strong>Matri ID :
                    </strong>
                  </td> 
                  <td>
                    <?php echo $Row->matri_id; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Full Name :
                    </strong>
                  </td> 
                  <td> 
                    <?php echo $Row->firstname." ".$Row->lastname;?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Caste :
                    </strong>
                  </td> 
                  <td> 
                    <?php echo $Row->caste_name; ?>
                  </td>
                </tr> 
                
                <tr>
                  <td>
                    <strong>Country :
                    </strong>
                  </td> 
                  <td> 
                    <?php echo $Row->country_name; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>State :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->state_name; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>City :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->city_name; ?>
                  </td>
                </tr>
                
                <tr>
                  <td>
                    <strong>Mobile :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->mobile; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Date of Birth :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->birthdate; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Time of Birth:
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->birthtime; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Raasi :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->moonsign; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Star :
                    </strong> 
                  </td> 
                  <td>
                    <?php echo $Row->star; ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Email :
                    </strong>
                  </td> 
                  <td> 
                    <?php echo $Row->email; ?>
                  </td>
                </tr>
              </table>	
              <div class="clerfix">
              </div>
            </div>
            <div class="clerfix">
            </div>
          </div>
        </form>
      </div>
      <div class="clerfix">
      </div>
    </div>
    <?php
$DatabaseCo->dbLink->query("insert into reminder(rem_id,sender_id,receiver_id,reminder_mes_type,reminder_msg,reminder_view_status,status,sent_date) values('','".$mid."','".$from_id."','chk_contact','check','Yes','Yes',NOW())");
if($checker==0)
{
$sel=$DatabaseCo->dbLink->query("SELECT * FROM payments where pmatri_id='$mid'"); 
$Row=mysqli_fetch_array($sel);
$tot_cnt=$Row['p_no_contacts'];
$use_cnt=$Row['r_cnt'];
$use_cnt=$use_cnt+1;
if($tot_cnt>=$use_cnt)
{
$update="UPDATE payments SET r_cnt='$use_cnt' WHERE pmatri_id='$mid' ";
$d=$DatabaseCo->dbLink->query($update);
}
$ins=$DatabaseCo->dbLink->query("insert into contact_checker (my_id,viewed_id,date) values ('$mid','$from_id',now())");	
}
?>
  </div>
</div>
<?php
}
?>
<?php
}else{
?>
<div class="modal-dialog">  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;">Only for express interest accepted
      </h4>
    </div>
    <div class="modal-body">
    <div class="row">
      <div class="col-xs-16 text-center">
        <h5>This member only shows his/her contact details if you have already sent him/her express interest, and he/she has accepted it.
        </h5>
      </div>
      <div class="col-sm-16">
        <h4 class="text-center text-danger">Please send him/her express interest if you are interested.
        </h4>
      </div>
    </div>
    </div>
  </div>
</div>
<?php   } } ?>
<?php	}else{  ?>		
<div class="modal-dialog yoyo-large">		  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;">Upgrade Your Membership
      </h4>
    </div>			  
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="membershipplans.php" method="post">
      <div class="row">
        <div class="col-sm-12">
          <h4>&nbsp;&nbsp;Please get the contact view balance by upgrading your membership.
          </h4>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
          <button class="btn gt-btn-orange" formaction="membershipplans.php">Upgrade Now
          </button>
        </div>
      </div>
    </form>			  
  </div>
</div>
<?php	}    }else{   ?>
<div class="modal-dialog">  
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel" style="color:red;">Please Login !!!
      </h4>
    </div>      
    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="membershipplans.php" method="post">
      <div class="row">
        <div class="col-sm-12">
          <h4>&nbsp;&nbsp;Please Login to access this feature.
          </h4>
        </div>
      </div>                                                   
      <div class="row">
        <div class="col-sm-offset-4 col-sm-10">                
          <button class="btn gt-btn-orange" formaction="login.php">Login Now
          </button>
        </div>
      </div>
    </form>      
  </div>
</div>
<?php    }    ?>