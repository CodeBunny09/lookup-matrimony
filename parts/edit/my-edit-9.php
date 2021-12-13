<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select height,weight,bodytype,complexion,physicalStatus from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT weight,body_type,complexion FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-star">
    </i>Physical Attributes
  </span>
  <a class="pull-right btn gt-btn-orange" onClick="return view99('edit');">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">Submit
    </font>
  </a>
</div>
<div class="gt-panel-body" >
  <form  method="post" name="reg_edit_8" id="reg_edit_9" >
    <div class="row">
	  
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <div class="row">
          <div class="col-xs-6">
            <label>
              Height :
            </label>
          </div>
		  <?php if($row_field->weight == 'Yes'){ ?>
          <div class="col-xs-4 text-center">
            <h4 class="gt-font-weight-400">
            </h4>
          </div>
		  
          <div class="col-xs-6">
            <label>Weight :
            </label>
          </div>
		  <?php } ?>
        </div>   
        <div class="row">
          <div class="col-xs-6">
            <select class="gt-form-control" name="height" data-validetta="required">
              <option value="">Select</option>
              <option value="48" <?php if($ao2 = $DatabaseCo->dbRow->height == "48"){echo "selected";}?>>Below 4ft
              </option>
              <option value="54" <?php if($ao2 = $DatabaseCo->dbRow->height == "54"){echo "selected";}?>>4ft 06in
              </option>
              <option value="55" <?php if($ao2 = $DatabaseCo->dbRow->height == "55"){echo "selected";}?>>4ft 07in
              </option>
              <option value="56" <?php if($ao2 = $DatabaseCo->dbRow->height == "56"){echo "selected";}?>>4ft 08in
              </option>
              <option value="57" <?php if($ao2 = $DatabaseCo->dbRow->height == "57"){echo "selected";}?>>4ft 09in
              </option>
              <option value="58" <?php if($ao2 = $DatabaseCo->dbRow->height == "58"){echo "selected";}?>>4ft 10in
              </option>
              <option value="59" <?php if($ao2 = $DatabaseCo->dbRow->height == "59"){echo "selected";}?>>4ft 11in
              </option>
              <option value="60" <?php if($ao2 = $DatabaseCo->dbRow->height == "60"){echo "selected";}?>>5ft
              </option>
              <option value="61" <?php if($ao2 = $DatabaseCo->dbRow->height == "61"){echo "selected";}?>>5ft 01in
              </option>
              <option value="62" <?php if($ao2 = $DatabaseCo->dbRow->height == "62"){echo "selected";}?>>5ft 02in
              </option>
              <option value="63" <?php if($ao2 = $DatabaseCo->dbRow->height == "63"){echo "selected";}?>>5ft 03in
              </option>
              <option value="64" <?php if($ao2 = $DatabaseCo->dbRow->height == "64"){echo "selected";}?>>5ft 04in
              </option>
              <option value="65" <?php if($ao2 = $DatabaseCo->dbRow->height == "65"){echo "selected";}?>>5ft 05in
              </option>
              <option value="66" <?php if($ao2 = $DatabaseCo->dbRow->height == "66"){echo "selected";}?>>5ft 06in
              </option>
              <option value="67" <?php if($ao2 = $DatabaseCo->dbRow->height == "67"){echo "selected";}?>>5ft 07in
              </option>
              <option value="68" <?php if($ao2 = $DatabaseCo->dbRow->height == "68"){echo "selected";}?>>5ft 08in
              </option>
              <option value="69" <?php if($ao2 = $DatabaseCo->dbRow->height == "69"){echo "selected";}?>>5ft 09in
              </option>
              <option value="70" <?php if($ao2 = $DatabaseCo->dbRow->height == "70"){echo "selected";}?>>5ft 10in
              </option>
              <option value="71" <?php if($ao2 = $DatabaseCo->dbRow->height == "71"){echo "selected";}?>>5ft 11in
              </option>
              <option value="72" <?php if($ao2 = $DatabaseCo->dbRow->height == "72"){echo "selected";}?>>6ft
              </option>
              <option value="73" <?php if($ao2 = $DatabaseCo->dbRow->height == "73"){echo "selected";}?>>6ft 01in
              </option>
              <option value="74" <?php if($ao2 = $DatabaseCo->dbRow->height == "74"){echo "selected";}?>>6ft 02in
              </option>
              <option value="75" <?php if($ao2 = $DatabaseCo->dbRow->height == "75"){echo "selected";}?>>6ft 03in
              </option>
              <option value="76" <?php if($ao2 = $DatabaseCo->dbRow->height == "76"){echo "selected";}?>>6ft 04in
              </option>
              <option value="77" <?php if($ao2 = $DatabaseCo->dbRow->height == "77"){echo "selected";}?>>6ft 05in
              </option>
              <option value="78" <?php if($ao2 = $DatabaseCo->dbRow->height == "78"){echo "selected";}?>>6ft 06in
              </option>
              <option value="79" <?php if($ao2 = $DatabaseCo->dbRow->height == "79"){echo "selected";}?>>6ft 07in
              </option>
              <option value="80" <?php if($ao2 = $DatabaseCo->dbRow->height == "80"){echo "selected";}?>>6ft 08in
              </option>
              <option value="81" <?php if($ao2 = $DatabaseCo->dbRow->height == "81"){echo "selected";}?>>6ft 09in
              </option>
              <option value="82" <?php if($ao2 = $DatabaseCo->dbRow->height == "82"){echo "selected";}?>>6ft 10in
              </option>
              <option value="83" <?php if($ao2 = $DatabaseCo->dbRow->height == "83"){echo "selected";}?>>6ft 11in
              </option>
              <option value="84" <?php if($ao2 = $DatabaseCo->dbRow->height == "84"){echo "selected";}?>>7ft
              </option>
              <option value="85" <?php if($ao2 = $DatabaseCo->dbRow->height == "85"){echo "selected";}?>>Above 7ft
              </option>
            </select>
          </div>
		  <?php if($row_field->weight == 'Yes'){ ?>
          <div class="col-xs-4 text-center">
            <h4 class="gt-font-weight-400">&amp;
            </h4>
          </div>
          <div class="col-xs-6">
            <select class="gt-form-control" name="weight" data-validetta="required">
              <option value="">
              	Select
              </option>  
              <option value="40" <?php if($DatabaseCo->dbRow->weight == "40"){echo "selected";}?>>40 Kg
              </option>
              <option value="41" <?php if($DatabaseCo->dbRow->weight == "41"){echo "selected";}?>>41 Kg
              </option>
              <option value="42" <?php if($DatabaseCo->dbRow->weight == "42"){echo "selected";}?>>42 Kg
              </option>
              <option value="43" <?php if($DatabaseCo->dbRow->weight == "43"){echo "selected";}?>>43 Kg
              </option>
              <option value="44" <?php if($DatabaseCo->dbRow->weight == "44"){echo "selected";}?>>44 Kg
              </option>
              <option value="45" <?php if($DatabaseCo->dbRow->weight == "45"){echo "selected";}?>>45 Kg
              </option>
              <option value="46" <?php if($DatabaseCo->dbRow->weight == "46"){echo "selected";}?>>46 Kg
              </option>
              <option value="47" <?php if($DatabaseCo->dbRow->weight == "47"){echo "selected";}?>>47 Kg
              </option>
              <option value="48" <?php if($DatabaseCo->dbRow->weight == "48"){echo "selected";}?>>48 Kg
              </option>
              <option value="49" <?php if($DatabaseCo->dbRow->weight == "49"){echo "selected";}?>>49 Kg
              </option>
              <option value="50" <?php if($DatabaseCo->dbRow->weight == "50"){echo "selected";}?>>50 Kg
              </option>
              <option value="51" <?php if($DatabaseCo->dbRow->weight == "51"){echo "selected";}?>>51 Kg
              </option>
              <option value="52" <?php if($DatabaseCo->dbRow->weight == "52"){echo "selected";}?>>52 Kg
              </option>
              <option value="53" <?php if($DatabaseCo->dbRow->weight == "53"){echo "selected";}?>>53 Kg
              </option>
              <option value="54" <?php if($DatabaseCo->dbRow->weight == "54"){echo "selected";}?>>54 Kg
              </option>
              <option value="55" <?php if($DatabaseCo->dbRow->weight == "55"){echo "selected";}?>>55 Kg
              </option>
              <option value="56" <?php if($DatabaseCo->dbRow->weight == "56"){echo "selected";}?>>56 Kg
              </option>
              <option value="57" <?php if($DatabaseCo->dbRow->weight == "57"){echo "selected";}?>>57 Kg
              </option>
              <option value="58" <?php if($DatabaseCo->dbRow->weight == "58"){echo "selected";}?>>58 Kg
              </option>
              <option value="59" <?php if($DatabaseCo->dbRow->weight == "59"){echo "selected";}?>>59 Kg
              </option>
              <option value="60" <?php if($DatabaseCo->dbRow->weight == "60"){echo "selected";}?>>60 Kg
              </option>
              <option value="61" <?php if($DatabaseCo->dbRow->weight == "61"){echo "selected";}?>>61 Kg
              </option>
              <option value="62" <?php if($DatabaseCo->dbRow->weight == "62"){echo "selected";}?>>62 Kg
              </option>
              <option value="63" <?php if($DatabaseCo->dbRow->weight == "63"){echo "selected";}?>>63 Kg
              </option>
              <option value="64" <?php if($DatabaseCo->dbRow->weight == "64"){echo "selected";}?>>64 Kg
              </option>
              <option value="65" <?php if($DatabaseCo->dbRow->weight == "65"){echo "selected";}?>>65 Kg
              </option>
              <option value="66" <?php if($DatabaseCo->dbRow->weight == "66"){echo "selected";}?>>66 Kg
              </option>
              <option value="67" <?php if($DatabaseCo->dbRow->weight == "67"){echo "selected";}?>>67 Kg
              </option>
              <option value="68" <?php if($DatabaseCo->dbRow->weight == "68"){echo "selected";}?>>68 Kg
              </option>
              <option value="69" <?php if($DatabaseCo->dbRow->weight == "69"){echo "selected";}?>>69 Kg
              </option>
              <option value="70" <?php if($DatabaseCo->dbRow->weight == "70"){echo "selected";}?>>70 Kg
              </option>
              <option value="71" <?php if($DatabaseCo->dbRow->weight == "71"){echo "selected";}?>>71 Kg
              </option>
              <option value="72" <?php if($DatabaseCo->dbRow->weight == "72"){echo "selected";}?>>72 Kg
              </option>
              <option value="73" <?php if($DatabaseCo->dbRow->weight == "73"){echo "selected";}?>>73 Kg
              </option>
              <option value="74" <?php if($DatabaseCo->dbRow->weight == "74"){echo "selected";}?>>74 Kg
              </option>
              <option value="75" <?php if($DatabaseCo->dbRow->weight == "75"){echo "selected";}?>>75 Kg
              </option>
              <option value="76" <?php if($DatabaseCo->dbRow->weight == "76"){echo "selected";}?>>76 Kg
              </option>
              <option value="77" <?php if($DatabaseCo->dbRow->weight == "77"){echo "selected";}?>>77 Kg
              </option>
              <option value="78" <?php if($DatabaseCo->dbRow->weight == "78"){echo "selected";}?>>78 Kg
              </option>
              <option value="79" <?php if($DatabaseCo->dbRow->weight == "79"){echo "selected";}?>>79 Kg
              </option>
              <option value="80" <?php if($DatabaseCo->dbRow->weight == "80"){echo "selected";}?>>80 Kg
              </option>
              <option value="81" <?php if($DatabaseCo->dbRow->weight == "81"){echo "selected";}?>>81 Kg
              </option>
              <option value="82" <?php if($DatabaseCo->dbRow->weight == "82"){echo "selected";}?>>82 Kg
              </option>
              <option value="83" <?php if($DatabaseCo->dbRow->weight == "83"){echo "selected";}?>>83 Kg
              </option>
              <option value="84" <?php if($DatabaseCo->dbRow->weight == "84"){echo "selected";}?>>84 Kg
              </option>
              <option value="85" <?php if($DatabaseCo->dbRow->weight == "85"){echo "selected";}?>>85 Kg
              </option>
              <option value="86" <?php if($DatabaseCo->dbRow->weight == "86"){echo "selected";}?>>86 Kg
              </option>
              <option value="87" <?php if($DatabaseCo->dbRow->weight == "87"){echo "selected";}?>>87 Kg
              </option>
              <option value="88" <?php if($DatabaseCo->dbRow->weight == "88"){echo "selected";}?>>88 Kg
              </option>
              <option value="89" <?php if($DatabaseCo->dbRow->weight == "89"){echo "selected";}?>>89 Kg
              </option>
              <option value="90" <?php if($DatabaseCo->dbRow->weight == "90"){echo "selected";}?>>90 Kg
              </option>
              <option value="91" <?php if($DatabaseCo->dbRow->weight == "91"){echo "selected";}?>>91 Kg
              </option>
              <option value="92" <?php if($DatabaseCo->dbRow->weight == "92"){echo "selected";}?>>92 Kg
              </option>
              <option value="93" <?php if($DatabaseCo->dbRow->weight == "93"){echo "selected";}?>>93 Kg
              </option>
              <option value="94" <?php if($DatabaseCo->dbRow->weight == "94"){echo "selected";}?>>94 Kg
              </option>
              <option value="95" <?php if($DatabaseCo->dbRow->weight == "95"){echo "selected";}?>>95 Kg
              </option>
              <option value="96" <?php if($DatabaseCo->dbRow->weight == "96"){echo "selected";}?>>96 Kg
              </option>
              <option value="97" <?php if($DatabaseCo->dbRow->weight == "97"){echo "selected";}?>>97 Kg
              </option>
              <option value="98" <?php if($DatabaseCo->dbRow->weight == "98"){echo "selected";}?>>98 Kg
              </option>
              <option value="99" <?php if($DatabaseCo->dbRow->weight == "99"){echo "selected";}?>>99 Kg
              </option>
              <option value="100" <?php if($DatabaseCo->dbRow->weight == "100"){echo "selected";}?>>100 Kg
              </option>
              <option value="101" <?php if($DatabaseCo->dbRow->weight == "101"){echo "selected";}?>>101 Kg
              </option>
              <option value="102" <?php if($DatabaseCo->dbRow->weight == "102"){echo "selected";}?>>102 Kg
              </option>
              <option value="103" <?php if($DatabaseCo->dbRow->weight == "103"){echo "selected";}?>>103 Kg
              </option>
              <option value="104" <?php if($DatabaseCo->dbRow->weight == "104"){echo "selected";}?>>104 Kg
              </option>
              <option value="105" <?php if($DatabaseCo->dbRow->weight == "105"){echo "selected";}?>>105 Kg
              </option>
              <option value="106" <?php if($DatabaseCo->dbRow->weight == "106"){echo "selected";}?>>106 Kg
              </option>
              <option value="107" <?php if($DatabaseCo->dbRow->weight == "107"){echo "selected";}?>>107 Kg
              </option>
              <option value="108" <?php if($DatabaseCo->dbRow->weight == "108"){echo "selected";}?>>108 Kg
              </option>
              <option value="109" <?php if($DatabaseCo->dbRow->weight == "109"){echo "selected";}?>>109 Kg
              </option>
              <option value="110" <?php if($DatabaseCo->dbRow->weight == "110"){echo "selected";}?>>110 Kg
              </option>
              <option value="111" <?php if($DatabaseCo->dbRow->weight == "111"){echo "selected";}?>>111 Kg
              </option>
              <option value="112" <?php if($DatabaseCo->dbRow->weight == "112"){echo "selected";}?>>112 Kg
              </option>
              <option value="113" <?php if($DatabaseCo->dbRow->weight == "113"){echo "selected";}?>>113 Kg
              </option>
              <option value="114" <?php if($DatabaseCo->dbRow->weight == "114"){echo "selected";}?>>114 Kg
              </option>
              <option value="115" <?php if($DatabaseCo->dbRow->weight == "115"){echo "selected";}?>>115 Kg
              </option>
              <option value="116" <?php if($DatabaseCo->dbRow->weight == "116"){echo "selected";}?>>116 Kg
              </option>
              <option value="117" <?php if($DatabaseCo->dbRow->weight == "117"){echo "selected";}?>>117 Kg
              </option>
              <option value="118" <?php if($DatabaseCo->dbRow->weight == "118"){echo "selected";}?>>118 Kg
              </option>
              <option value="119" <?php if($DatabaseCo->dbRow->weight == "119"){echo "selected";}?>>119 Kg
              </option>
              <option value="120" <?php if($DatabaseCo->dbRow->weight == "120"){echo "selected";}?>>120 Kg
              </option>
              <option value="121" <?php if($DatabaseCo->dbRow->weight == "121"){echo "selected";}?>>121 Kg
              </option>
              <option value="122" <?php if($DatabaseCo->dbRow->weight == "122"){echo "selected";}?>>122 Kg
              </option>
              <option value="123" <?php if($DatabaseCo->dbRow->weight == "123"){echo "selected";}?>>123 Kg
              </option>
              <option value="124" <?php if($DatabaseCo->dbRow->weight == "124"){echo "selected";}?>>124 Kg
              </option>
              <option value="125" <?php if($DatabaseCo->dbRow->weight == "125"){echo "selected";}?>>125 Kg
              </option>
              <option value="126" <?php if($DatabaseCo->dbRow->weight == "126"){echo "selected";}?>>126 Kg
              </option>
              <option value="127" <?php if($DatabaseCo->dbRow->weight == "127"){echo "selected";}?>>127 Kg
              </option>
              <option value="128" <?php if($DatabaseCo->dbRow->weight == "128"){echo "selected";}?>>128 Kg
              </option>
              <option value="129" <?php if($DatabaseCo->dbRow->weight == "129"){echo "selected";}?>>129 Kg
              </option>
              <option value="130" <?php if($DatabaseCo->dbRow->weight == "130"){echo "selected";}?>>130 Kg
              </option>
              <option value="131" <?php if($DatabaseCo->dbRow->weight == "131"){echo "selected";}?>>131 Kg
              </option>
              <option value="132" <?php if($DatabaseCo->dbRow->weight == "132"){echo "selected";}?>>132 Kg
              </option>
              <option value="133" <?php if($DatabaseCo->dbRow->weight == "133"){echo "selected";}?>>133 Kg
              </option>
              <option value="134" <?php if($DatabaseCo->dbRow->weight == "134"){echo "selected";}?>>134 Kg
              </option>
              <option value="135" <?php if($DatabaseCo->dbRow->weight == "135"){echo "selected";}?>>135 Kg
              </option>
              <option value="136" <?php if($DatabaseCo->dbRow->weight == "136"){echo "selected";}?>>136 Kg
              </option>
              <option value="137" <?php if($DatabaseCo->dbRow->weight == "137"){echo "selected";}?>>137 Kg
              </option>
              <option value="138" <?php if($DatabaseCo->dbRow->weight == "138"){echo "selected";}?>>138 Kg
              </option>
              <option value="139" <?php if($DatabaseCo->dbRow->weight == "139"){echo "selected";}?>>139 Kg
              </option>
              <option value="140" <?php if($DatabaseCo->dbRow->weight == "140"){echo "selected";}?>>140 Kg
              </option>
            </select>
          </div>
		  <?php } ?>
        </div>
      </div>
	  <?php if($row_field->body_type == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Body Type  :
        </label>
        <select class="gt-form-control" name="bodytype">
          <option value="" >
            Select
          </option>
          <option value="Slim" <?php if($DatabaseCo->dbRow->bodytype == "Slim"){echo "selected";}?>>Slim
          </option>
          <option value="Average" <?php if($DatabaseCo->dbRow->bodytype == "Average"){echo "selected";}?>>Average
          </option>
          <option value="Athletic" <?php if($DatabaseCo->dbRow->bodytype == "Athletic"){echo "selected";}?>>Athletic
          </option>
          <option value="Heavy" <?php if($DatabaseCo->dbRow->bodytype == "Heavy"){echo "selected";}?>>Heavy
          </option> 
        </select>
      </div>
	  <?php } ?>
	  <?php if($row_field->complexion == 'Yes'){ ?>  	
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Complexion  :
        </label>
        <select class="gt-form-control" name="complexion">
          <option value=""> 
              Select
          </option>
          <option value="Very Fair" <?php if($DatabaseCo->dbRow->complexion == "Very fair"){echo "selected";}?>>Very Fair

          </option>
          <option value="Fair" <?php if($DatabaseCo->dbRow->complexion == "Fair"){echo "selected";}?>>Fair
          </option>
          <option value="Wheatish" <?php if($DatabaseCo->dbRow->complexion == "Wheatish"){echo "selected";}?>>Wheatish
          </option>
          <option value="Wheatish Brown" <?php if($DatabaseCo->dbRow->complexion == "Wheatish Brown"){echo "selected";}?>>Wheatish Brown
          </option>
          <option value="Dark" <?php if($DatabaseCo->dbRow->complexion == "Dark"){echo "selected";}?>>Dark
          </option>
        </select>
      </div>
	  <?php } ?>	
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Physical status :
        </label>
        <select class="gt-form-control" name="physicalStatus">
          <option value="">
            Select
          </option>
          <option value="Normal" <?php if($DatabaseCo->dbRow->physicalStatus == "Normal"){echo "selected";}?>>Normal
          </option>
          <option value="Physically-challenged" <?php if($DatabaseCo->dbRow->physicalStatus == "Physically-challenged"){echo "selected";}?>>Physically-challenged
          </option>
        </select>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="./js/validetta.js">
</script>                
<script type="text/javascript">
  function view99(status){
    $(function(){
      $('#reg_edit_9').validetta({
        errorClose : false,
        onValid : function( event ) {
          event.preventDefault();
          view9(status);
        }
      }
                                );
    }
     );
    $('#reg_edit_9').submit();
  }
</script>
