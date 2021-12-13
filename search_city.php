<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$country_id =$_REQUEST['country_id'];
		$each=explode(',',$country_id);
?>

  <?php
 
	   foreach ($each as $rel)
    {
  	   $state_id =$_REQUEST['state_id'];
  	   $each_state=explode(',',$state_id);
  	   
       
         foreach ($each_state as $rel_state)
       	 {	   
    	   	 
      		  $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select state_name from state_view where cnt_id='".$rel."' AND state_id='".$rel_state."' and status='APPROVED' ORDER BY state_name ASC"));
      		
      		  if($a['state_name']!='')
			  {
      	   ?>
        
        		
              <optgroup label="<?php  echo $a['state_name'];?>" >
        
                <?php 
                  $SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE cnt_id='".$rel."' AND state_id='".$rel_state."'  ORDER BY city_name ASC");

          	       while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
          		    {
                  ?>
                  <option value="<?php echo $DatabaseCo->dbRow->city_id; ?>"><?php echo $DatabaseCo->dbRow->city_name; ?></option>
               <?php } ?>
              </optgroup>
      	   <?php
         	}

       }
	  
   }
  
 
 ?>
