<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$religion_id =$_REQUEST['religionId'];
?>
  <select class="form-control" name="my_caste" id="my_caste" data-validetta="required">
  <option value="">Please select Caste</option>
  
   <?php 
	$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE religion_id='$religion_id' and status='APPROVED' ORDER BY caste_name ASC");
	
	while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
		{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->caste_id; ?>" <?php if(isset($_POST['caste']) && $_POST['caste']==$DatabaseCo->dbRow->caste_id){ echo "selected";}?> ><?php echo $DatabaseCo->dbRow->caste_name ?></option>
     <?php } ?>
  </select>    
