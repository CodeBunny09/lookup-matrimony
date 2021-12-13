<?php 

include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
include_once './class/Location.class.php';
$DatabaseCo = new DatabaseConn();
$cst_id =isset($_REQUEST['c_id'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_REQUEST['c_id']):'';
if($cst_id!=''){                
?>
   <?php 
	$SQL_STATEMENT_state =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE religion_id='$cst_id' and status='APPROVED' ORDER BY caste_name ASC");
	echo "SELECT * FROM caste WHERE religion_id='$cst_id' and status='APPROVED' ORDER BY caste_name ASC";
	while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_state))
	{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->caste_id; ?>"><?php echo $DatabaseCo->dbRow->caste_name ?></option>
     <?php } ?>


<?php
}
	