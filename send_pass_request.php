<?php
include_once 'databaseConn.php';
require_once('auth.php');
include_once './lib/requestHandler.php';
include_once './class/Config.class.php';
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
$configObj = new Config();
$DatabaseCo = new DatabaseConn();
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title" id="myModalLabel">Photo Password Request</h4>
		</div>
		
		<div class="modal-body">
			<form action="" method="post" class="col-xs-16">
				 <input type="hidden" name="recever_id" value="<?php echo $_GET['id'];?>">
				 <div class="row text">
		 	 		<div class="col-xs-16">
			 	 	<?php
						if(isset($_REQUEST['req-password'])){
					?>
				 	 <div class="col-xs-16">
				 	 	<h5><?php if(isset($result)){ echo $result; }?></h5>
				 	 </div>
				 	 <?php
						} else { 
					 ?>
					 <div class="row">
					 	<label class="col-xs-16 form-group gt-font-weight-500" for="pass-val-1">
						   <input type="radio" checked="checked" value="We found your profile to be a good match. Please send me Photo password to proceed further." name="msg" id="pass-val-1" />&nbsp;&nbsp; We found your profile to be a good match. Please send me Photo password to proceed further.
					    </label>
					    <label class="col-xs-16 form-group gt-font-weight-500" for="pass-val-2">
							<input type="radio" value="I am interested in your profile. I would like to view photo now, send me password." name="msg" id="pass-val-2" />&nbsp;&nbsp;I am interested in your profile. I would like to view photo now, send me password.
						  
						</label>
						<div class="col-xs-16 form-group text-center">
							<input class="btn gt-btn-green" type="submit" name="req-password"  value="Send Request">
							<a data-toggle="modal" data-target="#myModal6" onClick="view_protect_photo('<?php echo $_GET['id'];?>');">
							  <input class="btn gt-btn-green" type="button" name="req-password" value="Click here if you have password" >
							</a>
						  
						</div>
					 </div>
					 <?php
						}
					 ?>
					 </div>
				 </div>
			</form>
		</div>
		<div class="clearfix"></div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>

