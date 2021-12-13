<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();	
$id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
$get_suc=mysqli_fetch_object($DatabaseCo->dbLink->query("select * from success_story where story_id='".$id."'"));
?>
<div class="modal-dialog">  
   <div class="modal-content">
       <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color:red;"><?php echo $get_suc->bridename.' & '.$get_suc->groomname.'`s';?> Success Story</h4>
	   </div>      
		<form name="MatriForm" id="MatriForm" class="form-horizontal" action="membershipplans" method="post">
			<div class="form-group">
				<div class="col-xxl-16">
					<div class="col-xxl-16">
                       <p><?php echo $get_suc->successmessage;?></p>
					</div>
                </div>
			</div>                 

        </form>      
   </div>
</div>