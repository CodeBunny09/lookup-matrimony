<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$religion_id =$_REQUEST['religion'];
		$each=explode(',',$religion_id);
		?>
  
  
  <?php
  
   foreach ($each as $rel)
   {?>
  
 <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?>">
  
   <?php 
  $SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE religion_id ='$rel' AND status='APPROVED' ORDER BY caste_name ASC");
	
	while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
		{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->caste_id ?>"><?php echo $DatabaseCo->dbRow->caste_name ?></option>
     <?php } ?>
</optgroup>
	<?php
   }
   ?>
