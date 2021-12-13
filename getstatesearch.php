<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$country_id =$_REQUEST['country_id'];
		$each=explode(',',$country_id);
?>
  
  <div class="row" id="users_state">
  <div class="col-xs-16">
                                      <input class="search form-control" placeholder="Search" />
                                    </div>
  <div class="list">
  <?php
  
   foreach ($each as $rel)
   {
   ?>
  
	<div class="col-xs-16">
   		<h5 class="text-center gt-margin-top-0px gt-margin-bottom-0px gt-font-weight-700"><?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select country_name from country where country_id='$rel'")); echo $a['country_name'];?> </h5>   
   </div>
   
       <?php 
        
		$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id ='$rel' AND status='APPROVED' ORDER BY state_name ASC");
        
        while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
            {
       ?>
       
       <div class="col-xs-16">
                           				<label for="filter-20<?php echo $DatabaseCo->dbRow->state_id; ?>">
                                			<input type="checkbox" id="filter-20<?php echo $DatabaseCo->dbRow->state_id; ?>" name="state_id" value="<?php echo $DatabaseCo->dbRow->state_id; ?>" class="gt-cursor"> <span class="gt-margin-left-10 gt-cursor name"> <?php echo $DatabaseCo->dbRow->state_name; ?></span>
                                		</label>
                                	</div>
     

	
  
 	<?php } ?>
	
	<?php
   }
   ?>
   </div>
   </div>