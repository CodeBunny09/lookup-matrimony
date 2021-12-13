<?php
include_once 'databaseConn.php';
//require_once('auth.php');
include_once './lib/requestHandler.php';
include_once './class/Config.class.php';
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
$configObj = new Config();
$DatabaseCo = new DatabaseConn();
$recever_id = $_GET['id'];
?>
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title" id="myModalLabel">View Protected Photo</h4>
		</div>
		
		<div class="modal-body">
			<div class="row">
				<form method="post" action="">
          			<input type="hidden" name="recever_id" value="<?php echo $recever_id;?>">
          			 <?php
						if(isset($result)){
					 ?>
          			<div class="col-xs-16">
          				<h5><?php if(isset($result)){ echo $result; }?>
                </h5>
          			</div>
          			<?php
						}
					?>
					<div class="col-xs-16">
						<p>
							 The Photo has been protected by the owner of this profile. Members are given the feature to protect their Photo from viewing by anyone. If the Photo is protected, then you need a Photo Password to view it. 
						</p>
					</div>
					<div class="col-xs-16 col-xxl-8 col-xxl-offset-4 col-xl-8 col-xl-offset-4">
						<div class="form-group">
							<label>
								Enter Password
							</label>
							<input type="text"  name="pass" id="pass" class="form-control"/>
						</div>
					</div>
					<div class="col-xs-16 text-center">
						<input class="btn gt-btn-orange" type="submit" name="submit"  value="Submit">
						<a data-toggle="modal" data-target="#myModal5" onClick="send_pass_req('<?php echo $recever_id; ?>');"  >
						  <input class="btn gt-btn-green" type="button" name="req-password" value="Don't have password">
						</a>
					</div>
					
				</form>
			</div>	
		</div>
		
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>

