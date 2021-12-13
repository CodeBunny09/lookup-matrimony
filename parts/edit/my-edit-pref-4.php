<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select part_country_living,part_state,part_city from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_state,part_city FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-map-marker">
    </i>Location Preference
  </span>
  <a class="pull-right btn gt-btn-orange" onClick="return part_view_44('edit');">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">submit
    </font>
  </a>
</div>
<div class="gt-panel-body" >
  <form name="part_edit4" method="post" id="part_edit4">
    <div class="row">
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Country  :
        </label>
        <select class="chosen-select gt-form-control"  multiple name="part_con_living[]" id="part_con_living" data-validetta="required">
          <?php $search_con=explode(',',$DatabaseCo->dbRow->part_country_living);
$SQLSTATEMENT_part_con=$DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED' ");
?>
          <?php
while($DatabaseCo->Row=mysqli_fetch_object($SQLSTATEMENT_part_con))
{?>
          <option value="<?php echo $DatabaseCo->Row->country_id; ?>"
                  <?php if(in_array($DatabaseCo->Row->country_id, $search_con))
          { echo "selected"; }?> >
          <?php echo $DatabaseCo->Row->country_name; ?>
          </option> 
        <?php } ?> 
        </select>
      <div id="status1">
      </div>
    </div>
	  <?php if($row_field->part_state == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
      <label>
        State :
      </label>
      <select class="chosen-select gt-form-control"  multiple name="part_state[]" id="part_state"> 
        <?php $part_state=explode(',',$DatabaseCo->dbRow->part_state);
$SQLSTATEMENT_part_state=$DatabaseCo->dbLink->query("SELECT * FROM state WHERE status='1' and state_id in (".$DatabaseCo->dbRow->part_state.") ");
?>
        <?php
while($DatabaseCo->Row=mysqli_fetch_object($SQLSTATEMENT_part_state))
{?>
        <option value="<?php echo $DatabaseCo->Row->state_id; ?>" 
                <?php if(in_array($DatabaseCo->Row->state_id, $part_state))
        { echo "selected"; }?> >
        <?php echo $DatabaseCo->Row->state_name; ?>
        </option> 
      <?php } ?> 
      </select>
    <div id="status12">
    </div>
    </div>
	  <?php } ?>
	  <?php if($row_field->part_city == 'Yes'){ ?>
  	  <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
    <label>
      City :
    </label>
    <select class="chosen-select gt-form-control"  multiple name="part_city[]" id="part_city">
      <?php $part_city=explode(',',$DatabaseCo->dbRow->part_city);
$SQLSTATEMENT_part_city=$DatabaseCo->dbLink->query("SELECT * FROM city WHERE status='1' and city_id in(".$DatabaseCo->dbRow->part_city.") ");
?>
      <?php
while($DatabaseCo->Row=mysqli_fetch_object($SQLSTATEMENT_part_city))
{?>
      <option value="<?php echo $DatabaseCo->Row->city_id; ?>" 
              <?php if(in_array($DatabaseCo->Row->city_id, $part_city))
      { echo "selected"; }?> >
      <?php echo $DatabaseCo->Row->city_name; ?>
      </option> 
    <?php } ?>
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
<!-------------------------------------- jQuery Validation ----------------------------------->
<script type="text/javascript" src="./js/validetta.js">
</script>
<!-------------------------------------- jQuery Validation End---------------------------------->
<!---------------Jquery Form validation------------------>
<script type="text/javascript">
  function part_view_44(status){
    $(function(){
      $('#part_edit4').validetta({
        errorClose : false,
        onValid : function( event ) {
          event.preventDefault();
          part_view_4(status);
        }
      }
                                );
    }
     );
    $('#part_edit4').submit();
  }
</script>
<script>
  $("#part_con_living").change(function()
                               {
    $("#status1").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
    var id=$(this).val();
    var dataString = 'id='+id;
    $.ajax
    ({
      type: "POST",
      url: "part_ajax_country_state",
      data: dataString,
      cache: false,
      success: function(html)
      {
        $("#part_state").html(html);
        $("#status1").html('');
        $("#part_state").trigger("chosen:updated");
      }
    }
    );
  }
                              );
  $("#part_state").change(function()
                          {
    $("#status2").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
    var id=$(this).val();
    var cnt_id=$("#part_con_living").val();
    var dataString = 'state_id='+ id+'&country_id='+ cnt_id;
    $.ajax
    ({
      type: "POST",
      url: "part_ajax_country_state",
      data: dataString,
      cache: false,
      success: function(html)
      {
        $("#part_city").html(html);
        $("#status2").html('');
        $("#part_city").trigger("chosen:updated");
      }
    }
    );
  }
                         );
</script>
