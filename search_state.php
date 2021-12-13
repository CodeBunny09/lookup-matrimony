<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$state_id =$_REQUEST['state'];
		$each=explode(',',$state_id);
		?>
   
 
  <?php
  if($_REQUEST['state']!='Any Country')
   {
   foreach ($each as $rel)
   {?>
  
 <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select country_name from country where country_id='$rel'")); echo $a['country_name'];?>">
  
   <?php 
  $SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id ='$rel' ORDER BY state_name ASC");
	
	while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
		{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->state_id ?>"><?php echo $DatabaseCo->dbRow->state_name ?></option>
     <?php } ?>
</optgroup>
	<?php
   }
   }
   else
   {
   ?>
    <?php 
  $SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM state_view ORDER BY state_name ASC");
	
	while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
		{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->state_id ?>"><?php echo $DatabaseCo->dbRow->state_name ?></option>
     <?php } ?>
<?php }?>