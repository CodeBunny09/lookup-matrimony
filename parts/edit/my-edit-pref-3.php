<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select part_religion,part_caste,part_subcaste,part_manglik,part_dosh,part_rasi,part_star,part_mtongue from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
$part_rel=$DatabaseCo->dbRow->part_religion; 
$part_caste=$DatabaseCo->dbRow->part_caste;
/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_dosh,part_star,part_rasi FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-book">
    </i>Religion Preference
  </span>
  <a class="pull-right btn gt-btn-orange" onClick="return part_view_33('edit');">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">submit
    </font>
  </a>
</div>
<div class="gt-panel-body" >
  <form method="post" name="part_edit3" id="part_edit3">
    <div class="row">
    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Religion :
        </label>
        <select  name="part_religion_id[]" id="rel_id" class="chosen-select gt-form-control" multiple data-validetta="required">
          <option value="any">Any Religion</option>
          <?php
$search_arr3 = explode(',',$DatabaseCo->dbRow->	part_religion);
$SQL_STATEMENT_rel =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ");
while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_rel))
{
?>
          <option value="<?php echo $DatabaseCo->Row->religion_id ?>"
                  <?php
          if(in_array($DatabaseCo->Row->religion_id, $search_arr3))
          {
          echo "selected";
          }
          ?>
          >  
          <?php echo $DatabaseCo->Row->religion_name; ?>
          </option>
        <?php } ?>
        </select>
    </div>
    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
      <label>
        Caste :
      </label>
      <div  id="castediv">
        <select class="chosen-select gt-form-control" multiple name="part_caste_id[]" id="caste_id" data-validetta="required">
          <?php 
$search_caste = explode(',',$DatabaseCo->dbRow->part_caste);
$SQL_STATEMENT_caste =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' ");
foreach($search_arr3 as $rel)
{?>
          <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?>">
            <?php
while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_caste))
{
?>
            <option value="<?php echo $DatabaseCo->Row->caste_id ?>" 
                    <?php if (in_array($DatabaseCo->Row->caste_id, $search_caste)){ echo "selected"; }?>>
            <?php echo $DatabaseCo->Row->caste_name ?>
          </option>
        <?php } ?>
        </optgroup>
      <?php
}
?>
      </select>
    <div id="status123">
    </div>
    </div>
</div>
	<?php if($row_field->part_dosh == 'Yes'){ ?>
 	<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Have Dosh? :
        </label>
        <select id="part_dosh" name="part_dosh" class="gt-form-control" onchange="yesnoCheck(this);">
			<?php  $part_dosh = explode(', ',$DatabaseCo->dbRow->part_dosh);?>
			<option value="Yes" 
					<?php if(in_array('Yes', $part_dosh)){ echo "selected";}?>>Yes
			</option>
		  <option value="No" 
				  <?php if(in_array('No', $part_dosh)){ echo "selected";}?>>No
		  </option>
		<option value="Doesn't Matter" 
				<?php if(in_array('', $part_dosh)){ echo "selected";}?>>Doesn't Matter
		</option>
		</select>
        
      </div>
    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail" id="ifYes" style="display: <?php if(isset($DatabaseCo->dbRow->part_dosh ) == 'Yes' ){ echo 'block'; }elseif(isset($DatabaseCo->dbRow->part_dosh ) == "Doesn't Matter" ){ echo 'none'; }else{ echo 'none';} ?> ;">
        <label>
          Dosh Type :
        </label>
        <select class="chosen-select gt-form-control" name="part_manglik[]" id="part_manglik" multiple>
          <?php $arr_part_manglik=explode(", ",$DatabaseCo->dbRow->part_manglik);?>
          <option value="Manglik" 
                  <?php if(in_array("Manglik",$arr_part_manglik)){ ?> selected="selected" 
          <?php } ?>>Manglik
          </option>
        <option value="Sarpa-dosh" 
                <?php if(in_array("Sarpa-dosh",$arr_part_manglik)){ ?> selected="selected" 
        <?php } ?>>Sarpa-dosh
        </option>
      <option value="Kala sarpa dosh" 
              <?php if(in_array("Kala sarpa dosh",$arr_part_manglik)){ ?> selected="selected" 
      <?php } ?>>Kala sarpa dosh
      </option>
    <option value="Rahu-dosh" 
            <?php if(in_array("Rahu-dosh",$arr_part_manglik)){ ?> selected="selected" 
    <?php } ?>>Rahu-dosh
    </option>
  <option value="Kethu dosh" 
          <?php if(in_array("Kethu dosh",$arr_part_manglik)){ ?> selected="selected" 
  <?php } ?>>Kethu dosh
  </option>
<option value="Kalathra-dosh" 
        <?php if(in_array("Kalathra-dosh",$arr_part_manglik)){ ?> selected="selected" 
<?php } ?>>Kalathra-dosh
</option>
</select>
      </div>
	<?php } ?>
	<?php if($row_field->part_rasi == 'Yes'){ ?>
	<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Moonsign :
  </label>
  <select class="chosen-select gt-form-control" name="part_moonsign[]" id="moonsign" multiple>
    </option>
  <?php  $part_moonsign = explode(',',$DatabaseCo->dbRow->part_rasi);?>
  <option value="Does not matter" 
          <?php if(in_array('Does not matter', $part_moonsign)){ echo "selected";}?>>Does not matter
  </option>
<option value="Mesh(Aries)" 
        <?php if(in_array('Mesh(Aries)', $part_moonsign)){ echo "selected";}?>>Mesh (Aries)
</option>
<option value="Vrishabh(Taurus)" 
        <?php if(in_array('Vrishabh(Taurus)', $part_moonsign)){ echo "selected";}?>>Vrishabh (Taurus)
</option>
<option value="Mithun(Gemini)" 
        <?php if(in_array('Mithun(Gemini)', $part_moonsign)){ echo "selected";}?>>Mithun (Gemini)
</option>
<option value="Karka(Cancer)" 
        <?php if(in_array('Karka(Cancer)', $part_moonsign)){ echo "selected";}?>>Karka (Cancer)
</option>
<option value="Simha(Leo)" 
        <?php if(in_array('Simha(Leo)', $part_moonsign)){ echo "selected";}?>>Simha (Leo)
</option>
<option value="Kanya(Virgo)" 
        <?php if(in_array('Kanya(Virgo)', $part_moonsign)){ echo "selected";}?>>Kanya (Virgo)
</option>
<option value="Tula(Libra)" 
        <?php if(in_array('Tula(Libra)', $part_moonsign)){ echo "selected";}?>>Tula (Libra)
</option>
<option value="Vrischika(Scorpio)" 
        <?php if(in_array('Vrischika(Scorpio)', $part_moonsign)){ echo "selected";}?>>Vrischika (Scorpio)
</option>
<option value="Dhanu(Sagittarious)" 
        <?php if(in_array('Dhanu(Sagittarious)', $part_moonsign)){ echo "selected";}?>>Dhanu (Sagittarious)
</option>
<option value="Makar(Capricorn)" 
        <?php if(in_array('Makar(Capricorn)', $part_moonsign)){ echo "selected";}?>>Makar (Capricorn)
</option>
<option value="Kumbha(Aquarious)" 
        <?php if(in_array('Kumbha(Aquarious)', $part_moonsign)){ echo "selected";}?>>Kumbha (Aquarious)
</option>
<option value="Meen(Pisces)" 
        <?php if(in_array('Meen(Pisces)', $part_moonsign)){ echo "selected";}?>>Meen (Pisces)
</option>
</select>
</div>
	<?php } ?>
	<?php if($row_field->part_star == 'Yes'){ ?>
	<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Star :
  </label>
  <select class="chosen-select gt-form-control" name="part_star[]" id="star" multiple>
    <?php  $part_star = explode(', ',$DatabaseCo->dbRow->part_star);?>
    <option value="Does not matter" 
            <?php if(in_array('Does not matter', $part_star)){ echo "selected";}?>>Does not matter
    </option>
  <option value="Ashvini"  <?php if(in_array('Ashvini', $part_star)){ echo "selected";}?>>Ashvini</option>
                            <option value="Bharani" <?php if(in_array('Bharani', $part_star)){ echo "selected";}?>>Bharani</option>
                            <option value="Krittika" <?php if(in_array('Krittika', $part_star)){ echo "selected";}?>>Krittika</option>
                            <option value="Rohini" <?php if(in_array('Rohini', $part_star)){ echo "selected";}?>>Rohini</option>
                            <option value="Mrigashirsha" <?php if(in_array('Mrigashirsha', $part_star)){ echo "selected";}?>>Mrigashirsha</option>
                            <option value="Ardra" <?php if(in_array('Ardra', $part_star)){ echo "selected";}?>>Ardra</option>
                            <option value="Punarvasu" <?php if(in_array('Punarvasu', $part_star)){ echo "selected";}?>>Punarvasu</option>
                            <option value="Pushya" <?php if(in_array('Pushya', $part_star)){ echo "selected";}?>>Pushya</option>
                            <option value="Ashlesha" <?php if(in_array('Ashlesha', $part_star)){ echo "selected";}?>>Ashlesha</option>
                            <option value="Magha" <?php if(in_array('Magha', $part_star)){ echo "selected";}?>>Magha</option>
                            <option value="Purva Phalguni" <?php if(in_array('Purva Phalguni', $part_star)){ echo "selected";}?>>Purva Phalguni</option>
                            <option value="Uttara Phalguni" <?php if(in_array('Uttara Phalguni', $part_star)){ echo "selected";}?>>Uttara Phalguni</option>
                            <option value="Hasta" <?php if(in_array('Hasta', $part_star)){ echo "selected";}?>>Hasta</option>
                            <option value="Chitra" <?php if(in_array('Chitra', $part_star)){ echo "selected";}?>>Chitra</option>
                            <option value="Swati" <?php if(in_array('Swati', $part_star)){ echo "selected";}?>>Swati</option>
                            <option value="Vishakha" <?php if(in_array('Vishakha', $part_star)){ echo "selected";}?>>Vishakha</option>
                            <option value="Anuradha" <?php if(in_array('Anuradha', $part_star)){ echo "selected";}?>>Anuradha</option>
                            <option value="Jyeshtha" <?php if(in_array('Jyeshtha', $part_star)){ echo "selected";}?>>Jyeshtha</option>
                            <option value="Mula" <?php if(in_array('Mula', $part_star)){ echo "selected";}?>>Mula</option>
                            <option value="Purva Ashadha" <?php if(in_array('Purva Ashadha', $part_star)){ echo "selected";}?>>Purva Ashadha</option>
                            <option value="Uttara Ashadha"<?php if(in_array('Uttara Ashadha', $part_star)){ echo "selected";}?>>Uttara Ashadha</option>
                            <option value="Shravana" <?php if(in_array('Shravana', $part_star)){ echo "selected";}?>>Shravana</option>
                            <option value="Dhanishtha" <?php if(in_array('Dhanishtha', $part_star)){ echo "selected";}?>>Dhanishtha</option>
                            <option value="Shatabhisha" <?php if(in_array('Shatabhisha', $part_star)){ echo "selected";}?>>Shatabhisha</option>
                            <option value="Purva Bhadrapada" <?php if(in_array('Purva Bhadrapada', $part_star)){ echo "selected";}?>>Purva Bhadrapada</option>
                            <option value="Uttara Bhadrapada" <?php if(in_array('Uttara Bhadrapada', $part_star)){ echo "selected";}?>>Uttara Bhadrapada</option>
                            <option value="Revati" <?php if(in_array('Revati', $part_star)){ echo "selected";}?>>Revati</option>
</select>
</div>
	<?php } ?>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Mother Tongue :
  </label>
  <select  class="chosen-select gt-form-control" multiple name="part_mtongue[]" data-validetta="required">
    <option value="Any Mother Tongue">Any Mother Tongue</option>
    <?php
$search_arr2 = explode(',',$DatabaseCo->dbRow->part_mtongue);
$SQL_STATEMENT_Mtongu =  $DatabaseCo->dbLink->query("SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
while($new=$DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_Mtongu))
{
?>
    <option value="<?php echo $DatabaseCo->Row->mtongue_id ?>"
            <?php if(in_array($DatabaseCo->Row->mtongue_id, $search_arr2))
    {
    echo "selected";
    }
    ?>>  
    <?php echo $DatabaseCo->Row->mtongue_name; ?>
    </option>
  <?php } ?>
  </select>
</div>
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
<script type="text/javascript">
  $("#rel_id").change(function()
                      {
    $("#status123").html('<div class="gtLoaderBottom"><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</div>');
    var id=$(this).val();
    var dataString = 'religionId='+id +'&edit=yes';
    $.ajax
    ({
      type: "POST",
      url: "part_rel_caste",
      data: dataString,
      cache: false,
      success: function(data)
      {
        $("#caste_id").html('');
        $("#caste_id").append(data);
        $("#caste_id.chosen-select").trigger("chosen:updated");
        $("#status123").html('');
      }
    }
    );
  }
                     );
</script>
<script>
		function yesnoCheck(that) {
			if (that.value == "Yes") {

				document.getElementById("ifYes").style.display = "block";
			} else {
				document.getElementById("ifYes").style.display = "none";
			}
		}
	   </script>
<script type="text/javascript" src="./js/validetta.js">
</script>
<script type="text/javascript">
  function part_view_33(status){
    $(function(){
      $('#part_edit3').validetta({
        errorClose : false,
        onValid : function( event ) {
          event.preventDefault();
          part_view_3(status);
        }
      }
                                );
    }
     );
    $('#part_edit3').submit();
  }
</script>
