<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select part_edu,part_occu,part_emp_in,part_income from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
$part_edu=$DatabaseCo->dbRow->part_edu; 
$part_occu=$DatabaseCo->dbRow->part_occu;
/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_annual_income FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-university">
    </i>Education / Professional Preference
  </span>
  <a class="pull-right btn gt-btn-orange" onClick="return part_view_22('edit');">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">submit
    </font>
  </a>
</div>
<div class="gt-panel-body">
  <form method="post" name="reg_edit_2" id="part_edit_2">
    <div class="row">
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Education  :
        </label>
        <select  class="chosen-select gt-form-control"  multiple name="part_edu[]" data-validetta="required">
          <option value="Any Education">Any Education</option>
          <?php
$search_arr2 = explode(',',$DatabaseCo->dbRow->part_edu);
$SQL_STATEMENT_part_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ");
while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_part_edu))
{
?>
          <option value="<?php echo $DatabaseCo->Row->edu_id ?>"
                  <?php
          if(in_array($DatabaseCo->Row->edu_id, $search_arr2))
          {
          echo "selected";
          }
          ?>
          >  
          <?php echo $DatabaseCo->Row->edu_name; ?>
          </option>
        <?php } ?>
        </select>
    </div>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
      <label>
        Occupation  :
      </label>
      <select  class="chosen-select gt-form-control"  multiple name="part_occu[]">
       	<option value="Any Occupation">Any Occupation</option>
        <?php $search_arr2 = explode(',',$DatabaseCo->dbRow->part_occu);
$SQL_STATEMENT_part_ocp =  $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ");
while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_part_ocp))
{
?>
        <option value="<?php echo $DatabaseCo->Row->ocp_id ?>"
                <?php
        if(in_array($DatabaseCo->Row->ocp_id, $search_arr2))
        {
        echo "selected";
        }
        ?>
        >  
        <?php echo $DatabaseCo->Row->ocp_name; ?>
        </option>
      <?php } ?>
      </select>
    </div>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
    <label>
      Employed in :
    </label>
    <select data-validetta="required" name="empin" class="gt-form-control">
      <option value="">Choose Employement
      </option>
      <option value="Private" <?php if($DatabaseCo->dbRow->part_emp_in == "Private"){ echo "selected"; }?>>Private
      </option>
      <option value="Government" <?php if($DatabaseCo->dbRow->part_emp_in == "Government"){ echo "selected"; }?>>Government
      </option>
      <option value="Business" <?php if($DatabaseCo->dbRow->part_emp_in == "Business"){ echo "selected"; }?>>Business
      </option>
      <option value="Defence" <?php if($DatabaseCo->dbRow->part_emp_in == "Defence"){ echo "selected"; }?>>Defence
      </option>
      <option value="Not Employed in" <?php if($DatabaseCo->dbRow->part_emp_in == "Not Employed in"){ echo "selected"; }?>>Not Employed in
      </option>
      <option value="Others" <?php if($DatabaseCo->dbRow->part_emp_in == "Others"){ echo "selected"; }?>>Others
      </option>
    </select>
  </div>
	  <?php if($row_field->part_annual_income == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
    <label>
      Annual Income  :
    </label>
    <select class="chosen-select gt-form-control" multiple name="part_income[]"  data-validetta="required">
      <?php $part_income=explode(".",$DatabaseCo->dbRow->part_income); ?>
      <option value="Rs 10,000 - 50,000" <?php if(in_array("Rs 10,000 - 50,000", $part_income)){ echo "selected"; } ?>>Rs 10,000 - 50,000</option>
                            <option value="Rs 50,000 - 1,00,000" <?php if(in_array("Rs 50,000 - 1,00,000", $part_income)){ echo "selected"; } ?>>Rs 50,000 - 1,00,000</option>
                            <option value="Rs 1,00,000 - 2,00,000" <?php if(in_array("Rs 1,00,000 - 2,00,000", $part_income)){ echo "selected"; } ?>>Rs 1,00,000 - 2,00,000</option>
                            <option value="Rs 2,00,000 - 4,00,000" <?php if(in_array("Rs 2,00,000 - 4,00,000", $part_income)){ echo "selected"; } ?>>Rs 2,00,000 - 4,00,000</option>
                            <option value="Rs 4,00,000 - 6,00,000" <?php if(in_array("Rs 4,00,000 - 6,00,000", $part_income)){ echo "selected"; } ?>>Rs 4,00,000 - 6,00,000</option>
                            <option value="Rs 6,00,000 - 8,00,000" <?php if(in_array("Rs 6,00,000 - 8,00,000", $part_income)){ echo "selected"; } ?>>Rs 6,00,000 - 8,00,000</option>
                            <option value="Rs 8,00,000 - 10,00,000" <?php if(in_array("Rs 8,00,000 - 10,00,000", $part_income)){ echo "selected"; } ?>>Rs 8,00,000 - 10,00,000</option>
                            <option value="Rs 10,00,000 - 12,00,000" <?php if(in_array("Rs 10,00,000 - 12,00,000", $part_income)){ echo "selected"; } ?>>Rs 10,00,000 - 12,00,000</option>
                            <option value="Rs 12,00,000 - 14,00,000" <?php if(in_array("Rs 12,00,000 - 14,00,000", $part_income)){ echo "selected"; } ?>>Rs 12,00,000 - 14,00,000</option>
                            <option value="Rs 14,00,000 - 16,00,000" <?php if(in_array("Rs 14,00,000 - 16,00,000", $part_income)){ echo "selected"; } ?>>Rs 14,00,000 - 16,00,000</option>
                            <option value="Rs 16,00,000 - 18,00,000" <?php if(in_array("Rs 16,00,000 - 18,00,000", $part_income)){ echo "selected"; } ?>>Rs 16,00,000 - 18,00,000</option>
                            <option value="Rs 18,00,000 - 20,00,000" <?php if(in_array("Rs 18,00,000 - 20,00,000", $part_income)){ echo "selected"; } ?>>Rs 18,00,000 - 20,00,000</option>
                            <option value="Rs 20,00,000 - 22,00,000" <?php if(in_array("Rs 20,00,000 - 22,00,000", $part_income)){ echo "selected"; } ?>>Rs 20,00,000 - 22,00,000</option>
                            <option value="Rs 22,00,000 - 24,00,000" <?php if(in_array("Rs 22,00,000 - 24,00,000", $part_income)){ echo "selected"; } ?>>Rs 22,00,000 - 24,00,000</option>
                            <option value="Rs 24,00,000 - 26,00,000" <?php if(in_array("Rs 24,00,000 - 26,00,000", $part_income)){ echo "selected"; } ?>>Rs 24,00,000 - 26,00,000</option>
                            <option value="Rs 26,00,000 - 28,00,000" <?php if(in_array("Rs 26,00,000 - 28,00,000", $part_income)){ echo "selected"; } ?>>Rs 26,00,000 - 28,00,000</option>
                            <option value="Rs 28,00,000 - 30,00,000" <?php if(in_array("Rs 28,00,000 - 30,00,000", $part_income)){ echo "selected"; } ?>>Rs 28,00,000 - 30,00,000</option>
                            <option value="Rs 30,00,000 - 32,00,000" <?php if(in_array("Rs 30,00,000 - 32,00,000", $part_income)){ echo "selected"; } ?>>Rs 30,00,000 - 32,00,000</option>
                            <option value="Rs 32,00,000 - 34,00,000" <?php if(in_array("Rs 32,00,000 - 34,00,000", $part_income)){ echo "selected"; } ?>>Rs 32,00,000 - 34,00,000</option>
                            <option value="Rs 34,00,000 - 36,00,000" <?php if(in_array("Rs 34,00,000 - 36,00,000", $part_income)){ echo "selected"; } ?>>Rs 34,00,000 - 36,00,000</option>
                            <option value="Rs 36,00,000 - 38,00,000" <?php if(in_array("Rs 36,00,000 - 38,00,000", $part_income)){ echo "selected"; } ?>>Rs 36,00,000 - 38,00,000</option>
                            <option value="Rs 38,00,000 - 40,00,000" <?php if(in_array("Rs 38,00,000 - 40,00,000", $part_income)){ echo "selected"; } ?>>Rs 38,00,000 - 40,00,000</option>
                            <option value="Rs 40,00,000 - 42,00,000" <?php if(in_array("Rs 40,00,000 - 42,00,000", $part_income)){ echo "selected"; } ?>>Rs 40,00,000 - 42,00,000</option>
                            <option value="Rs 42,00,000 - 44,00,000" <?php if(in_array("Rs 42,00,000 - 44,00,000", $part_income)){ echo "selected"; } ?>>Rs 42,00,000 - 44,00,000</option>
                            <option value="Rs 44,00,000 - 46,00,000" <?php if(in_array("Rs 44,00,000 - 46,00,000", $part_income)){ echo "selected"; } ?>>Rs 44,00,000 - 46,00,000</option>
                            <option value="Rs 46,00,000 - 48,00,000" <?php if(in_array("Rs 46,00,000 - 48,00,000", $part_income)){ echo "selected"; } ?>>Rs 46,00,000 - 48,00,000</option>
                            <option value="Rs 48,00,000 - 50,00,000" <?php if(in_array("Rs 48,00,000 - 50,00,000", $part_income)){ echo "selected"; } ?>>Rs 48,00,000 - 50,00,000</option>
                            <option value="Rs 50,00,000 - 52,00,000" <?php if(in_array("Rs 50,00,000 - 52,00,000", $part_income)){ echo "selected"; } ?>>Rs 50,00,000 - 52,00,000</option>
                            <option value="Rs 52,00,000 - 54,00,000" <?php if(in_array("Rs 52,00,000 - 54,00,000", $part_income)){ echo "selected"; } ?>>Rs 52,00,000 - 54,00,000</option>
                            <option value="Rs 54,00,000 - 56,00,000" <?php if(in_array("Rs 54,00,000 - 56,00,000", $part_income)){ echo "selected"; } ?>>Rs 54,00,000 - 56,00,000</option>
                            <option value="Rs 56,00,000 - 58,00,000" <?php if(in_array("Rs 56,00,000 - 58,00,000", $part_income)){ echo "selected"; } ?>>Rs 56,00,000 - 58,00,000</option>
                            <option value="Rs 58,00,000 - 60,00,000" <?php if(in_array("Rs 58,00,000 - 60,00,000", $part_income)){ echo "selected"; } ?>>Rs 58,00,000 - 60,00,000</option>
                            <option value="Rs 60,00,000 - 62,00,000" <?php if(in_array("Rs 60,00,000 - 62,00,000", $part_income)){ echo "selected"; } ?>>Rs 60,00,000 - 62,00,000</option>
                            <option value="Rs 62,00,000 - 64,00,000" <?php if(in_array("Rs 62,00,000 - 64,00,000", $part_income)){ echo "selected"; } ?>>Rs 62,00,000 - 64,00,000</option>
                            <option value="Rs 64,00,000 - 66,00,000" <?php if(in_array("Rs 64,00,000 - 66,00,000", $part_income)){ echo "selected"; } ?>>Rs 64,00,000 - 66,00,000</option>
                            <option value="Rs 66,00,000 - 68,00,000" <?php if(in_array("Rs 66,00,000 - 68,00,000", $part_income)){ echo "selected"; } ?>>Rs 66,00,000 - 68,00,000</option>
                            <option value="Rs 68,00,000 - 70,00,000" <?php if(in_array("Rs 68,00,000 - 70,00,000", $part_income)){ echo "selected"; } ?>>Rs 68,00,000 - 70,00,000</option>
                            <option value="Rs 70,00,000 - 72,00,000" <?php if(in_array("Rs 70,00,000 - 72,00,000", $part_income)){ echo "selected"; } ?>>Rs 70,00,000 - 72,00,000</option>
                            <option value="Rs 72,00,000 - 74,00,000" <?php if(in_array("Rs 72,00,000 - 74,00,000", $part_income)){ echo "selected"; } ?>>Rs 72,00,000 - 74,00,000</option>
                            <option value="Rs 74,00,000 - 76,00,000" <?php if(in_array("Rs 74,00,000 - 76,00,000", $part_income)){ echo "selected"; } ?>>Rs 74,00,000 - 76,00,000</option>
                            <option value="Rs 76,00,000 - 78,00,000" <?php if(in_array("Rs 76,00,000 - 78,00,000", $part_income)){ echo "selected"; } ?>>Rs 76,00,000 - 78,00,000</option>
                            <option value="Rs 78,00,000 - 80,00,000" <?php if(in_array("Rs 78,00,000 - 80,00,000", $part_income)){ echo "selected"; } ?>>Rs 78,00,000 - 80,00,000</option>
                            <option value="Rs 80,00,000 - 82,00,000" <?php if(in_array("Rs 80,00,000 - 82,00,000", $part_income)){ echo "selected"; } ?>>Rs 80,00,000 - 82,00,000</option>
                            <option value="Rs 82,00,000 - 84,00,000" <?php if(in_array("Rs 82,00,000 - 84,00,000", $part_income)){ echo "selected"; } ?>>Rs 82,00,000 - 84,00,000</option>
                            <option value="Rs 84,00,000 - 86,00,000" <?php if(in_array("Rs 84,00,000 - 86,00,000", $part_income)){ echo "selected"; } ?>>Rs 84,00,000 - 86,00,000</option>
                            <option value="Rs 86,00,000 - 88,00,000" <?php if(in_array("Rs 86,00,000 - 88,00,000", $part_income)){ echo "selected"; } ?>>Rs 86,00,000 - 88,00,000</option>
                            <option value="Rs 88,00,000 - 90,00,000" <?php if(in_array("Rs 88,00,000 - 90,00,000", $part_income)){ echo "selected"; } ?>>Rs 88,00,000 - 90,00,000</option>
                            <option value="Rs 90,00,000 - 92,00,000" <?php if(in_array("Rs 90,00,000 - 92,00,000", $part_income)){ echo "selected"; } ?>>Rs 90,00,000 - 92,00,000</option>
                            <option value="Rs 92,00,000 - 94,00,000" <?php if(in_array("Rs 92,00,000 - 94,00,000", $part_income)){ echo "selected"; } ?>>Rs 92,00,000 - 94,00,000</option>
                            <option value="Rs 94,00,000 - 96,00,000" <?php if(in_array("Rs 94,00,000 - 96,00,000", $part_income)){ echo "selected"; } ?>>Rs 94,00,000 - 96,00,000</option>
                            <option value="Rs 96,00,000 - 98,00,000" <?php if(in_array("Rs 96,00,000 - 98,00,000", $part_income)){ echo "selected"; } ?>>Rs 96,00,000 - 98,00,000</option>
                            <option value="Rs 98,00,000 - 1,00,00,000" <?php if(in_array("Rs 98,00,000 - 1,00,00,000", $part_income)){ echo "selected"; } ?>>Rs 98,00,000 - 1,00,00,000</option>
                            <option value="Above Rs 1,00,00,000" <?php if(in_array("Above Rs 1,00,00,000", $part_income)){ echo "selected"; } ?>>Above Rs 1,00,00,000</option>
                            <option value="Does not matter" <?php if(in_array("Does not matter", $part_income)){ echo "selected"; } ?>>Does not matter</option>
      
      
      
</select>
</div>
	  <?php } ?>
</div>
</form>
</div>
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

<script type="text/javascript" src="./js/validetta.js">
</script>
<script type="text/javascript">
  function part_view_22(status){
    $(function(){
      $('#part_edit_2').validetta({
        errorClose : false,
        onValid : function( event ) {
          event.preventDefault();
          part_view_2(status);
        }
      }
                                 );
    }
     );
    $('#part_edit_2').submit();
  }
</script>
