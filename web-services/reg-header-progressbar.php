<?php
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();

include_once './progressbar.php';
?>
<h5>
                		Your Profile Is <?php echo $percentage; ?>% completed.
                	</h5>
<div class="progress">
  						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage; ?>%">
    						<span class="sr-only"><?php echo $percentage; ?>% Complete (success)</span>
  						</div>
					</div>