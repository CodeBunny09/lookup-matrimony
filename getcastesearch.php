<?php 
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
include_once './class/Location.class.php';
$DatabaseCo = new DatabaseConn();
$religion_id =$_REQUEST['religion_id'];
$each=explode(',',$religion_id);
?>
<div class="row" id="users_caste">
  <div class="col-xs-16">
    <input class="search form-control" placeholder="Search" />
  </div>
  <div class="list">
    <?php
foreach ($each as $rel)
{
?>
    <h5 class="text-center gt-margin-top-0px gt-margin-bottom-0px gt-font-weight-700">
      <?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?> 
    </h5>   
  </div> 
  <?php 
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE religion_id ='$rel' AND status='APPROVED' ORDER BY caste_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
$get_mem=mysqli_num_rows($DatabaseCo->dbLink->query("select matri_id from register_view where caste='".$DatabaseCo->dbRow->caste_id."' and status!='Suspended' and status!='Inactive'"));
?>
  <div class="col-xs-16 gt-filter-border">
    <div class="row">
      <label for="filter-14<?php echo $DatabaseCo->dbRow->caste_id;?>" class="col-xs-16">
        <div class="row">	
          <span class="col-xs-3">
            <input type="checkbox" id="filter-14<?php echo $DatabaseCo->dbRow->caste_id;?>" name="caste_id" value="<?php echo $DatabaseCo->dbRow->caste_id ?>" class="gt-cursor">
          </span>
          <span class="gt-cursor name col-xs-10">
            <?php echo $DatabaseCo->dbRow->caste_name ?>
          </span>
          <span class="badge col-xxl-3">
            <?php echo $get_mem;?>                                        
          </span>
        </div>
      </label>
    </div>
  </div>
  <?php } ?>
  <?php
}
?>
</div>

