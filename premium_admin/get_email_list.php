<?php 		
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
if(isset($_POST["status_name"])) {
$query =$DatabaseCo->dbLink->query("SELECT matri_id,email FROM register_view WHERE status= '" . $_POST["status_name"] . "'");
$count=mysqli_num_rows($query);
?>
<option value="selectall">Select All
</option>
<?php
while($array=mysqli_fetch_array($query))
{
?>
<option value="<?php echo $array['email']; ?>">
  <?php echo $array['matri_id'];?>(
  <?php echo $array['email']; ?>)
</option>
<?php	
} ?>
<?php
}
?>