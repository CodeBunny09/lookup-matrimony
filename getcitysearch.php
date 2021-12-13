<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$state_id =$_REQUEST['state_id'];
		$each=explode(',',$state_id);
?>
  
  <div class="row" id="users_city">
  	<div class="col-xs-16">
         <input class="search form-control" placeholder="Search" />
    </div>
  <div class="list">
  <?php
  
   foreach ($each as $rel)
   {
   ?>
  
	<div class="col-xs-16">
    <h5 class="text-center gt-margin-top-0px gt-margin-bottom-0px gt-font-weight-700"><?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select state_name from state where state_id='$rel'")); echo $a['state_name'];?> </h5>   
    </div>
         <?php 
        
		$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE state_id ='$rel' AND status='APPROVED' ORDER BY city_name ASC");
        
        while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
            {
       ?>
        <div class="col-xs-16">
             	<label for="filter-21<?php echo $DatabaseCo->dbRow->city_id; ?>">
                      <input type="checkbox" id="filter-21<?php echo $DatabaseCo->dbRow->city_id; ?>" name="city_id" value="<?php echo $DatabaseCo->dbRow->city_id; ?>" class="gt-cursor"> <span class="gt-margin-left-10 gt-cursor name"> <?php echo $DatabaseCo->dbRow->city_name; ?></span>
                </label>
        </div>
       
 	<?php } ?>
	
	<?php
   }
   ?>
   </div>
   </div>