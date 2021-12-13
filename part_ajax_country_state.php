<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		
		if(isset($_REQUEST['id'])){
		$country_id =$_REQUEST['id'];
		$each=explode(',',$country_id);
?>
  
 
  <?php
  
   foreach ($each as $rel)
   {
   ?>
  
	<optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select country_name from country where country_id='$rel'")); echo $a['country_name'];?>">
       
	   <?php 
        $SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id ='$rel' ORDER BY state_name ASC");
        while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
        {
        ?>
       		<option value="<?php echo $DatabaseCo->dbRow->state_id; ?>" ><?php echo $DatabaseCo->dbRow->state_name; ?></option>
    	<?php } ?>
	</optgroup>
	<?php
   }
   
		}
		if(isset($_POST['country_id']) && isset($_POST['state_id']))
   		{
			
			$state_id =$_REQUEST['state_id'];
			$each=explode(',',$state_id);
		foreach ($each as $rel)
   		{
	 ?>
     	<optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select state_name from state where state_id='$rel'")); echo $a['state_name'];?>">
        	<?php 
        
		$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE state_id ='$rel' ORDER BY city_name ASC");
        
        while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
            {
       ?>
       		<option value="<?php echo $DatabaseCo->dbRow->city_id; ?>" ><?php echo $DatabaseCo->dbRow->city_name; ?></option>
       <?php }?>
        </optgroup>
     
   <?php
		}
		}
   ?>