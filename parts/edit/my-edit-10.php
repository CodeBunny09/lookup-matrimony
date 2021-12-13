<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select birthplace,birthtime,star,moonsign,manglik,dosh from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT dosh,star,rasi,birthtime,birthplace FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-book">
    </i>Horoscope Information
  </span>
  <a class="pull-right btn gt-btn-orange" onClick="return view1010('edit');">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">submit
    </font>
  </a>
</div>
<div class="gt-panel-body">
  <form method="post" name="reg_edit_10" id="reg_edit_10">
    <div class="row">
	<?php if($row_field->dosh == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Have Dosh? :
        </label>
        <select class="gt-form-control" name="dosh" onchange="yesnoCheck(this);">
        	<option value="No" <?php if($DatabaseCo->dbRow->dosh == 'No'){ echo 'selected' ;} ?>>
         		No
         	</option>
         	<option value="Yes" <?php if($DatabaseCo->dbRow->dosh == 'Yes' ){ echo 'selected'; } ?>>
         		Yes
         	</option>
         	
		</select>
      </div>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail" id="ifYes" style="display: <?php if(isset($DatabaseCo->dbRow->dosh ) == 'Yes' ){ echo 'block'; }else{ echo 'none';} ?> ;">
        <label>
          Dosh Type :
        </label>
        <select class="chosen-select gt-form-control" name="manglik[]" id="manglik" multiple>
          <?php $arr_manglik=explode(", ",$DatabaseCo->dbRow->manglik);?>
          <option value="Manglik" 
                  <?php if(in_array("Manglik",$arr_manglik)){ ?> selected="selected" 
          <?php } ?>>Manglik
          </option>
        <option value="Sarpa-dosh" 
                <?php if(in_array("Sarpa-dosh",$arr_manglik)){ ?> selected="selected" 
        <?php } ?>>Sarpa-dosh
        </option>
      <option value="Kala sarpa dosh" 
              <?php if(in_array("Kala sarpa dosh",$arr_manglik)){ ?> selected="selected" 
      <?php } ?>>Kala sarpa dosh
      </option>
    <option value="Rahu-dosh" 
            <?php if(in_array("Rahu-dosh",$arr_manglik)){ ?> selected="selected" 
    <?php } ?>>Rahu-dosh
    </option>
  <option value="Kethu dosh" 
          <?php if(in_array("Kethu dosh",$arr_manglik)){ ?> selected="selected" 
  <?php } ?>>Kethu dosh
  </option>
<option value="Kalathra-dosh" 
        <?php if(in_array("Kalathra-dosh",$arr_manglik)){ ?> selected="selected" 
<?php } ?>>Kalathra-dosh
</option>
</select>
      </div>
	<?php } ?>
	
	  <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail" >
  <div class="row">
	<?php if($row_field->rasi == 'Yes'){ ?>
    <div class="col-xs-6">
      <label>
        Moonsign :
      </label>
    </div>
	<?php } ?>
	<?php if($row_field->star == 'Yes'){ ?>
    <div class="col-xs-4 text-center">
      <h4 class="gt-font-weight-400">
      </h4>
    </div>
    <div class="col-xs-6">
      <label>Star :
      </label>
    </div>
	<?php } ?>
  </div>   
  <div class="row">
    <div class="col-xs-6">
      <select id="moonsign" name="moonsign" class="gt-form-control">
        <option value="">
          Select
        </option>
        <option value="Does not matter" <?php if($DatabaseCo->dbRow->moonsign == "Does not matter"){echo "selected";}?>>Does not matter
        </option>
        <option value="Mesh(Aries)" <?php if($DatabaseCo->dbRow->moonsign == "Mesh(Aries)"){echo "selected";}?>>Mesh (Aries)
        </option>
        <option value="Vrishabh(Taurus)" <?php if($DatabaseCo->dbRow->moonsign == "Vrishabh(Taurus)"){echo "selected";}?>>Vrishabh (Taurus)
        </option>
        <option value="Mithun(Gemini)" <?php if($DatabaseCo->dbRow->moonsign == "Mithun(Gemini)"){echo "selected";}?>>Mithun (Gemini)
        </option>
        <option value="Karka(Cancer)" <?php if($DatabaseCo->dbRow->moonsign == "Karka(Cancer)"){echo "selected";}?>>Karka (Cancer)
        </option>
        <option value="Simha(Leo)" <?php if($DatabaseCo->dbRow->moonsign == "Simha(Leo)"){echo "selected";}?>>Simha (Leo)
        </option>
        <option value="Kanya(Virgo)" <?php if($DatabaseCo->dbRow->moonsign == "Kanya(Virgo)"){echo "selected";}?>>Kanya (Virgo)
        </option>
        <option value="Tula(Libra)" <?php if($DatabaseCo->dbRow->moonsign == "Tula(Libra)"){echo "selected";}?>>Tula (Libra)
        </option>
        <option value="Vrischika(Scorpio)" <?php if($DatabaseCo->dbRow->moonsign == "Vrischika(Scorpio)"){echo "selected";}?>>Vrischika (Scorpio)
        </option>
        <option value="Dhanu(Sagittarious)" <?php if($DatabaseCo->dbRow->moonsign == "Dhanu(Sagittarious)"){echo "selected";}?>>Dhanu (Sagittarious)
        </option>
        <option value="Makar(Capricorn)" <?php if($DatabaseCo->dbRow->moonsign == "Makar(Capricorn)"){echo "selected";}?>>Makar (Capricorn)
        </option>
        <option value="Kumbha(Aquarious)" <?php if($DatabaseCo->dbRow->moonsign == "Kumbha(Aquarious)"){echo "selected";}?>>Kumbha (Aquarious)
        </option>
        <option value="Meen(Pisces)" <?php if($DatabaseCo->dbRow->moonsign == "Meen(Pisces)"){echo "selected";}?>>Meen (Pisces)
        </option>
      </select>
    </div>
	<?php if($row_field->star == 'Yes'){ ?>
    <div class="col-xs-4 text-center">
      <h4 class="gt-font-weight-400">&amp;
      </h4>
    </div>
    <div class="col-xs-6">
      <select id="star" name="star" class="gt-form-control">

        <option value="">
         Select
        </option>
        
        <option value="Does not matter" <?php if($DatabaseCo->dbRow->star == "Does not matter"){echo "selected";}?>>Does not matter
        </option>
        <option value="Ashvini" <?php if($DatabaseCo->dbRow->star == "Ashvini"){echo "selected";}?>>Ashvini
        </option>
        <option value="Bharani" <?php if($DatabaseCo->dbRow->star == "Bharani"){echo "selected";}?>>Bharani
        </option>
        <option value="Krittika" <?php if($DatabaseCo->dbRow->star == "Krittika"){echo "selected";}?>>Krittika
        </option>
        <option value="Rohini" <?php if($DatabaseCo->dbRow->star == "Rohini"){echo "selected";}?>>Rohini
        </option>
        <option value="Mrigashirsha " <?php if($DatabaseCo->dbRow->star == "Mrigashirsha"){echo "selected";}?>>Mrigashirsha
        </option>
        <option value="Ardra" <?php if($DatabaseCo->dbRow->star == "Ardra"){echo "selected";}?>>Ardra
        </option>
        <option value="Punarvasu" <?php if($DatabaseCo->dbRow->star == "Punarvasu"){echo "selected";}?>>Punarvasu
        </option>
        <option value="Pushya" <?php if($DatabaseCo->dbRow->star == "Pushya"){echo "selected";}?>>Pushya
        </option>
        <option value="Ashlesha" <?php if($DatabaseCo->dbRow->star == "Ashlesha"){echo "selected";}?>>Ashlesha
        </option>
        <option value="Magha" <?php if($DatabaseCo->dbRow->star == "Magha"){echo "selected";}?>>Magha
        </option>
        <option value="Purva Phalguni" <?php if($DatabaseCo->dbRow->star == "Purva Phalguni"){echo "selected";}?>>Purva Phalguni
        </option>
        <option value="Uttara Phalguni" <?php if($DatabaseCo->dbRow->star == "Uttara Phalguni"){echo "selected";}?>>Uttara Phalguni
        </option>
        <option value="Hasta" <?php if($DatabaseCo->dbRow->star == "Hasta"){echo "selected";}?>>Hasta
        </option>
        <option value="Chitra" <?php if($DatabaseCo->dbRow->star == "Chitra"){echo "selected";}?>>Chitra
        </option>
        <option value="Swati" <?php if($DatabaseCo->dbRow->star == "Swati"){echo "selected";}?>>Swati
        </option>
        <option value="Vishakha" <?php if($DatabaseCo->dbRow->star == "Vishakha"){echo "selected";}?>>Vishakha
        </option>
        <option value="Anuradha" <?php if($DatabaseCo->dbRow->star == "Anuradha"){echo "selected";}?>>Anuradha
        </option>
        <option value="Jyeshtha" <?php if($DatabaseCo->dbRow->star == "Jyeshtha"){echo "selected";}?>>Jyeshtha
        </option>
        <option value="Mula" <?php if($DatabaseCo->dbRow->star == "Mula"){echo "selected";}?>>Mula
        </option>
        <option value="Purva Ashadha" <?php if($DatabaseCo->dbRow->star == "Purva Ashadha"){echo "selected";}?>>Purva Ashadha
        </option>
        <option value="Uttara Ashadha" <?php if($DatabaseCo->dbRow->star == "Uttara Ashadha"){echo "selected";}?>>Uttara Ashadha
        </option>
        <option value="Shravana" <?php if($DatabaseCo->dbRow->star == "Shravana"){echo "selected";}?>>Shravana
        </option>
        <option value="Dhanishtha" <?php if($DatabaseCo->dbRow->star == "Dhanishtha"){echo "selected";}?>>Dhanishtha
        </option>
        <option value="Shatabhisha" <?php if($DatabaseCo->dbRow->star == "Shatabhisha"){echo "selected";}?>>Shatabhisha
        </option>
        <option value="Purva Bhadrapada" <?php if($DatabaseCo->dbRow->star == "Purva Bhadrapada"){echo "selected";}?>>Purva Bhadrapada
        </option>
        <option value="Uttara Bhadrapada" <?php if($DatabaseCo->dbRow->star == "Uttara Bhadrapada"){echo "selected";}?>>Uttara Bhadrapada
        </option>
        <option value="Revati" <?php if($DatabaseCo->dbRow->star == "Revati"){echo "selected";}?>>Revati
        </option>
      </select>
    </div>
	<?php } ?>
  </div>
</div>
	  <div class="clearfix"></div>
	<?php if($row_field->birthtime == 'Yes'){ ?>
	  <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Birth Time   :
  </label>
  <select name="birthtime" class="gt-form-control">
    <?php 	
for($i=12;$i>0;$i--)
{
for($j=0;$j<60;$j++)
{
if(strlen($j)=='1')
{
$k='0'.$j;	
}else
{
$k=$j;
}
?>
    <option value="<?php echo $i.":".$k." am";?>" >
      <?php echo $i.":".$k." am";?>
    </option>	
    <?php
}
}
?>
    <?php 	
for($i=12;$i>0;$i--)
{
for($j=0;$j<60;$j++)
{
if(strlen($j)=='1')
{
$k='0'.$j;	
}else
{
$k=$j;
}
?>
    <option value="<?php echo $i.":".$k." pm";?>" >
      <?php echo $i.":".$k." pm";?>
    </option>	
    <?php
}
}
?>
    <option value="<?php echo htmlspecialchars_decode($DatabaseCo->dbRow->birthtime,ENT_QUOTES); ?>" selected>
      <?php echo htmlspecialchars_decode($DatabaseCo->dbRow->birthtime,ENT_QUOTES); ?>
    </option>
  </select>	
</div>
	<?php } ?>
	<?php if($row_field->birthplace == 'Yes'){ ?>
	  <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
		  <label>
			Birth Place :
		  </label>
		  <input type="text" class="gt-form-control valid" value="<?php echo htmlspecialchars_decode($DatabaseCo->dbRow->birthplace,ENT_QUOTES); ?>" name="birthplace" >
		</div>
	<?php } ?>
	</div>
</form>
</div>
<script>
		function yesnoCheck(that) {
			if (that.value == "Yes") {

				document.getElementById("ifYes").style.display = "block";
			} else {
				document.getElementById("ifYes").style.display = "none";
			}
		}
	   </script>
<script type="text/javascript">
  function view1010(status){
    view10(status);
  }
</script>                    
<!-- CHOSEN -->
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
<!-- CHOSEN END-->
<script>
		$('.valid').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault(alert('Spacial Character Not Allowed.'));
       return false;	  
	}		
});
</script>
