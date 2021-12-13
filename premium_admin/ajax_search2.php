<?php 
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
include_once '../class/Location.class.php';
$DatabaseCo = new DatabaseConn();
$religion_id =$_REQUEST['religionId'];
?>
<option value="">Please select Caste
</option>
<?php 
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE religion_id='$religion_id' ORDER BY caste_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
?>
<option value="<?php echo $DatabaseCo->dbRow->caste_id ?>">
  <?php echo $DatabaseCo->dbRow->caste_name ?>
</option>
<?php } ?>