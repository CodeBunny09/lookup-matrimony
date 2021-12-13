<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select hobby,smoke,drink,diet,language_known from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT diet,smoke,drink FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-star">
    </i>Habits And Hobbies
  </span>
  <a  class="pull-right btn gt-btn-orange" onClick="return view77('edit');">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">submit
    </font>
  </a>
</div>
<div class="gt-panel-body" >
  <form  method="post" name="reg_edit_7" id="reg_edit_7">	
    <div class="row">
	  <?php if($row_field->diet == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Diet Habits :
        </label>
        <select class="gt-form-control" name="diet">
          
          <option value="">Select 
          </option>
          <option value="Vegetarian" <?php if($DatabaseCo->dbRow->diet == "Vegetarian"){echo "selected";}?>>Vegetarian
          </option>
          <option value="Eggetarian" <?php if($DatabaseCo->dbRow->diet == "Eggetarian"){echo "selected";}?>>Eggetarian
          </option>
          <option value="Non-Vegetarian" <?php if($DatabaseCo->dbRow->diet == "Non-Vegetarian"){echo "selected";}?>>Non-Vegetarian
          </option>
        </select>
      </div>
	  <?php } ?>
	  <?php if($row_field->smoke == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Drinking Habits :
        </label>
        <select class="gt-form-control" name="drink">
          <option value="">Select 
          </option>
          <option value="No" <?php if($DatabaseCo->dbRow->drink == "No"){echo "selected";}?>>No
          </option>
          <option value="Yes" <?php if($DatabaseCo->dbRow->drink == "No"){echo "Yes";}?>>Yes
          </option>
          <option value="Occasionally" <?php if($DatabaseCo->dbRow->drink == "Occasionally"){echo "selected";}?>>Occasionally
          </option>
        </select>
      </div>
	  <?php } ?>
	  <?php if($row_field->drink == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Smoke Habits :
        </label>
        <select class="gt-form-control" name="smoke">
          <option value="" >
            Select
          </option>
          <option value="No" <?php if($DatabaseCo->dbRow->smoke == "No"){echo "selected";}?>>No
          </option>
          <option value="Yes" <?php if($DatabaseCo->dbRow->smoke == "Yes"){echo "selected";}?>>Yes
          </option>
          <option value="Occasionally" <?php if($DatabaseCo->dbRow->smoke == "Occasionally"){echo "selected";}?>>Drinks Socially
          </option>
        </select>
      </div>
	  <?php } ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>Language known
        </label>
        
        <select class="chosen-select form-control" multiple name="language[]">
          <?php
			
$search_array912 = explode(',', $DatabaseCo->dbRow->language_known);
			
$SQL_STATEMENT_pmtong = $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
while($DatabaseCo->dbRow1 = mysqli_fetch_object($SQL_STATEMENT_pmtong))
{
?>
          <option value="<?php echo $DatabaseCo->dbRow1->mtongue_id; ?>"
                  <?php
          if(in_array($DatabaseCo->dbRow1->mtongue_id,$search_array912)) 
          {
          echo "selected";
          }
          ?>>
          <?php echo $DatabaseCo->dbRow1->mtongue_name; ?>
          </option>
        <?php } ?>
        </select>
    </div>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
      <label>
        Hobby :
      </label>
      <textarea class="gt-form-control valid" cols="4" rows="4" name="hobby"><?php echo $DatabaseCo->dbRow->hobby;?></textarea>
    </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="./js/validetta.js">
</script>
<script type="text/javascript">
  var config = {
    '.chosen-select'           : {
    }
    ,
    '.chosen-select-deselect'  : {
      allow_single_deselect:true}
    ,
    '.chosen-select-no-single' : {
      disable_search_threshold:10}
    ,
    '.chosen-select-no-results': {
      no_results_text:'Oops, nothing found!'}
    ,
    '.chosen-select-width'     : {
      width:"100%"}
  }
  for (var selector in config) {
    $(selector).chosen(config[selector]);
  }
</script>
<script type="text/javascript">
  function view77(status){
    view7(status);
  }
</script>
<script>
		$('.valid').on('keypress', function (event) {
    var regex = new RegExp("[a-zA-Z,]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault(alert('Spacial Character & Numbers Not Allowed.'));
       return false;
		  
	}
			
});
</script>