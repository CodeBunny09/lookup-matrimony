<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
$SQLSTATEMENT=$DatabaseCo->dbLink->query("select part_expect,part_complexation,part_drink,part_smoke,part_diet,part_height_to,part_height,part_frm_age,part_to_age,looking_for,part_mtongue,part_physical from register where matri_id='$matri_id'");
$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
$m_tongue=$DatabaseCo->dbRow->part_mtongue;

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_physical_status,part_diet,part_drink,part_smoke FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<div class="gt-panel-head">
  <span class="pull-left">
    <i class="fa fa-file">
    </i>Basic Preferences
  </span>
  <a class="pull-right btn gt-btn-orange" onClick="return part_view_11('edit');">
    <i class="fa fa-pencil">
    </i>
    <font class="gt-margin-left-5">submit
    </font>
  </a>
</div>
<div class="gt-panel-body" >
  <form name="part_edit1" method="post" id="part_edit1">
    <div class="row">
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Age :
        </label>
        <div class="row">
          <div class="col-xs-6">
            <select class="gt-form-control" name="part_frm_age" data-validetta="required">
              <option value="">
                Select
              </option>
              <option value="18" <?php if($DatabaseCo->dbRow->part_frm_age =='18'){ echo "selected"; } ?>>18 Years
              </option>
              <option value="19" <?php if($DatabaseCo->dbRow->part_frm_age =='19'){ echo "selected"; } ?>>19 Years
              </option>
              <option value="20" <?php if($DatabaseCo->dbRow->part_frm_age =='20'){ echo "selected"; } ?>>20 Years
              </option>
              <option value="21" <?php if($DatabaseCo->dbRow->part_frm_age =='21'){ echo "selected"; } ?>>21 Years
              </option>
              <option value="22" <?php if($DatabaseCo->dbRow->part_frm_age =='22'){ echo "selected"; } ?>>22 Years
              </option>
              <option value="23" <?php if($DatabaseCo->dbRow->part_frm_age =='23'){ echo "selected"; } ?>>23 Years
              </option>
              <option value="24" <?php if($DatabaseCo->dbRow->part_frm_age =='24'){ echo "selected"; } ?>>24 Years
              </option>
              <option value="25" <?php if($DatabaseCo->dbRow->part_frm_age =='25'){ echo "selected"; } ?>>25 Years
              </option>
              <option value="26" <?php if($DatabaseCo->dbRow->part_frm_age =='26'){ echo "selected"; } ?>>26 Years
              </option>
              <option value="27" <?php if($DatabaseCo->dbRow->part_frm_age =='27'){ echo "selected"; } ?>>27 Years
              </option>
              <option value="28" <?php if($DatabaseCo->dbRow->part_frm_age =='28'){ echo "selected"; } ?>>28 Years
              </option>
              <option value="29" <?php if($DatabaseCo->dbRow->part_frm_age =='29'){ echo "selected"; } ?>>29 Years
              </option>
              <option value="30" <?php if($DatabaseCo->dbRow->part_frm_age =='30'){ echo "selected"; } ?>>30 Years
              </option>
              <option value="31" <?php if($DatabaseCo->dbRow->part_frm_age =='31'){ echo "selected"; } ?>>31 Years
              </option>
              <option value="32" <?php if($DatabaseCo->dbRow->part_frm_age =='32'){ echo "selected"; } ?>>32 Years
              </option>
              <option value="33" <?php if($DatabaseCo->dbRow->part_frm_age =='33'){ echo "selected"; } ?>>33 Years
              </option>
              <option value="34" <?php if($DatabaseCo->dbRow->part_frm_age =='34'){ echo "selected"; } ?>>34 Years
              </option>
              <option value="35" <?php if($DatabaseCo->dbRow->part_frm_age =='35'){ echo "selected"; } ?>>35 Years
              </option>
              <option value="36" <?php if($DatabaseCo->dbRow->part_frm_age =='36'){ echo "selected"; } ?>>36 Years
              </option>
              <option value="37" <?php if($DatabaseCo->dbRow->part_frm_age =='37'){ echo "selected"; } ?>>37 Years
              </option>
              <option value="38" <?php if($DatabaseCo->dbRow->part_frm_age =='38'){ echo "selected"; } ?>>38 Years
              </option>
              <option value="39" <?php if($DatabaseCo->dbRow->part_frm_age =='39'){ echo "selected"; } ?>>39 Years
              </option>
              <option value="40" <?php if($DatabaseCo->dbRow->part_frm_age =='40'){ echo "selected"; } ?>>40 Years
              </option>
              <option value="41" <?php if($DatabaseCo->dbRow->part_frm_age =='41'){ echo "selected"; } ?>>41 Years
              </option>
              <option value="42" <?php if($DatabaseCo->dbRow->part_frm_age =='42'){ echo "selected"; } ?>>42 Years
              </option>
              <option value="43" <?php if($DatabaseCo->dbRow->part_frm_age =='43'){ echo "selected"; } ?>>43 Years
              </option>
              <option value="44" <?php if($DatabaseCo->dbRow->part_frm_age =='44'){ echo "selected"; } ?>>44 Years
              </option>
              <option value="45" <?php if($DatabaseCo->dbRow->part_frm_age =='45'){ echo "selected"; } ?> >45 Years
              </option>
              <option value="46" <?php if($DatabaseCo->dbRow->part_frm_age =='46'){ echo "selected"; } ?>>46 Years
              </option>
              <option value="47" <?php if($DatabaseCo->dbRow->part_frm_age =='47'){ echo "selected"; } ?>>47 Years
              </option>
              <option value="48" <?php if($DatabaseCo->dbRow->part_frm_age =='48'){ echo "selected"; } ?>>48 Years
              </option>
              <option value="49" <?php if($DatabaseCo->dbRow->part_frm_age =='49'){ echo "selected"; } ?>>49 Years
              </option>
              <option value="50" <?php if($DatabaseCo->dbRow->part_frm_age =='50'){ echo "selected"; } ?>>50 Years
              </option>
              <option value="51" <?php if($DatabaseCo->dbRow->part_frm_age =='51'){ echo "selected"; } ?>>51 Years
              </option>
              <option value="52" <?php if($DatabaseCo->dbRow->part_frm_age =='52'){ echo "selected"; } ?>>52 Years
              </option>
              <option value="53" <?php if($DatabaseCo->dbRow->part_frm_age =='53'){ echo "selected"; } ?>>53 Years
              </option>
              <option value="54" <?php if($DatabaseCo->dbRow->part_frm_age =='54'){ echo "selected"; } ?>>54 Years
              </option>
              <option value="55" <?php if($DatabaseCo->dbRow->part_frm_age =='55'){ echo "selected"; } ?>>55 Years
              </option>
              <option value="56" <?php if($DatabaseCo->dbRow->part_frm_age =='56'){ echo "selected"; } ?>>56 Years
              </option>
              <option value="57" <?php if($DatabaseCo->dbRow->part_frm_age =='57'){ echo "selected"; } ?>>57 Years
              </option>
              <option value="58" <?php if($DatabaseCo->dbRow->part_frm_age =='58'){ echo "selected"; } ?>>58 Years
              </option>
              <option value="59" <?php if($DatabaseCo->dbRow->part_frm_age =='59'){ echo "selected"; } ?>>59 Years
              </option>
              <option value="60" <?php if($DatabaseCo->dbRow->part_frm_age =='60'){ echo "selected"; } ?>>60 Years
              </option>
            </select>
          </div>
          <div class="col-xs-4 text-center">
            <h4 class="gt-font-weight-400">TO
            </h4>
          </div>
          <div class="col-xs-6">
            <select class="gt-form-control" name="part_to_age" data-validetta="required">
              <option value="">
                Select
              </option>
              <option value="18" <?php if($DatabaseCo->dbRow->part_to_age =='18'){ echo "selected"; } ?>>18 Years
              </option>
              <option value="19" <?php if($DatabaseCo->dbRow->part_to_age =='19'){ echo "selected"; } ?>>19 Years
              </option>
              <option value="20" <?php if($DatabaseCo->dbRow->part_to_age =='20'){ echo "selected"; } ?>>20 Years
              </option>
              <option value="21" <?php if($DatabaseCo->dbRow->part_to_age =='21'){ echo "selected"; } ?>>21 Years
              </option>
              <option value="22" <?php if($DatabaseCo->dbRow->part_to_age =='22'){ echo "selected"; } ?>>22 Years
              </option>
              <option value="23" <?php if($DatabaseCo->dbRow->part_to_age =='23'){ echo "selected"; } ?>>23 Years
              </option>
              <option value="24" <?php if($DatabaseCo->dbRow->part_to_age =='24'){ echo "selected"; } ?>>24 Years
              </option>
              <option value="25" <?php if($DatabaseCo->dbRow->part_to_age =='25'){ echo "selected"; } ?>>25 Years
              </option>
              <option value="26" <?php if($DatabaseCo->dbRow->part_to_age =='26'){ echo "selected"; } ?>>26 Years
              </option>
              <option value="27" <?php if($DatabaseCo->dbRow->part_to_age =='27'){ echo "selected"; } ?>>27 Years
              </option>
              <option value="28" <?php if($DatabaseCo->dbRow->part_to_age =='28'){ echo "selected"; } ?>>28 Years
              </option>
              <option value="29" <?php if($DatabaseCo->dbRow->part_to_age =='29'){ echo "selected"; } ?>>29 Years
              </option>
              <option value="30" <?php if($DatabaseCo->dbRow->part_to_age =='30'){ echo "selected"; } ?>>30 Years
              </option>
              <option value="31" <?php if($DatabaseCo->dbRow->part_to_age =='31'){ echo "selected"; } ?>>31 Years
              </option>
              <option value="32" <?php if($DatabaseCo->dbRow->part_to_age =='32'){ echo "selected"; } ?>>32 Years
              </option>
              <option value="33" <?php if($DatabaseCo->dbRow->part_to_age =='33'){ echo "selected"; } ?>>33 Years
              </option>
              <option value="34" <?php if($DatabaseCo->dbRow->part_to_age =='34'){ echo "selected"; } ?>>34 Years
              </option>
              <option value="35" <?php if($DatabaseCo->dbRow->part_to_age =='35'){ echo "selected"; } ?>>35 Years
              </option>
              <option value="36" <?php if($DatabaseCo->dbRow->part_to_age =='36'){ echo "selected"; } ?>>36 Years
              </option>
              <option value="37" <?php if($DatabaseCo->dbRow->part_to_age =='37'){ echo "selected"; } ?>>37 Years
              </option>
              <option value="38" <?php if($DatabaseCo->dbRow->part_to_age =='38'){ echo "selected"; } ?>>38 Years
              </option>
              <option value="39" <?php if($DatabaseCo->dbRow->part_to_age =='39'){ echo "selected"; } ?>>39 Years
              </option>
              <option value="40" <?php if($DatabaseCo->dbRow->part_to_age =='40'){ echo "selected"; } ?>>40 Years
              </option>
              <option value="41" <?php if($DatabaseCo->dbRow->part_to_age =='41'){ echo "selected"; } ?>>41 Years
              </option>
              <option value="42" <?php if($DatabaseCo->dbRow->part_to_age =='42'){ echo "selected"; } ?>>42 Years
              </option>
              <option value="43" <?php if($DatabaseCo->dbRow->part_to_age =='43'){ echo "selected"; } ?>>43 Years
              </option>
              <option value="44" <?php if($DatabaseCo->dbRow->part_to_age =='44'){ echo "selected"; } ?>>44 Years
              </option>
              <option value="45" <?php if($DatabaseCo->dbRow->part_to_age =='45'){ echo "selected"; } ?> >45 Years
              </option>
              <option value="46" <?php if($DatabaseCo->dbRow->part_to_age =='46'){ echo "selected"; } ?>>46 Years
              </option>
              <option value="47" <?php if($DatabaseCo->dbRow->part_to_age =='47'){ echo "selected"; } ?>>47 Years
              </option>
              <option value="48" <?php if($DatabaseCo->dbRow->part_to_age =='48'){ echo "selected"; } ?>>48 Years
              </option>
              <option value="49" <?php if($DatabaseCo->dbRow->part_to_age =='49'){ echo "selected"; } ?>>49 Years
              </option>
              <option value="50" <?php if($DatabaseCo->dbRow->part_to_age =='50'){ echo "selected"; } ?>>50 Years
              </option>
              <option value="51" <?php if($DatabaseCo->dbRow->part_to_age =='51'){ echo "selected"; } ?>>51 Years
              </option>
              <option value="52" <?php if($DatabaseCo->dbRow->part_to_age =='52'){ echo "selected"; } ?>>52 Years
              </option>
              <option value="53" <?php if($DatabaseCo->dbRow->part_to_age =='53'){ echo "selected"; } ?>>53 Years
              </option>
              <option value="54" <?php if($DatabaseCo->dbRow->part_to_age =='54'){ echo "selected"; } ?>>54 Years
              </option>
              <option value="55" <?php if($DatabaseCo->dbRow->part_to_age =='55'){ echo "selected"; } ?>>55 Years
              </option>
              <option value="56" <?php if($DatabaseCo->dbRow->part_to_age =='56'){ echo "selected"; } ?>>56 Years
              </option>
              <option value="57" <?php if($DatabaseCo->dbRow->part_to_age =='57'){ echo "selected"; } ?>>57 Years
              </option>
              <option value="58" <?php if($DatabaseCo->dbRow->part_to_age =='58'){ echo "selected"; } ?>>58 Years
              </option>
              <option value="59" <?php if($DatabaseCo->dbRow->part_to_age =='59'){ echo "selected"; } ?>>59 Years
              </option>
              <option value="60" <?php if($DatabaseCo->dbRow->part_to_age =='60'){ echo "selected"; } ?>>60 Years
              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Height :
        </label>
        <div class="row">
          <div class="col-xs-6">
            <select class="gt-form-control" name="part_height" data-validetta="required">
              
              <option value="" >
                Select
              </option>
              <option value="48" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "48"){echo "selected";}?>>Below 4ft
              </option>
              <option value="54" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "54"){echo "selected";}?>>4ft 06in
              </option>
              <option value="55" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "55"){echo "selected";}?>>4ft 07in
              </option>
              <option value="56" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "56"){echo "selected";}?>>4ft 08in
              </option>
              <option value="57" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "57"){echo "selected";}?>>4ft 09in
              </option>
              <option value="58" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "58"){echo "selected";}?>>4ft 10in
              </option>
              <option value="59" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "59"){echo "selected";}?>>4ft 11in
              </option>
              <option value="60" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "60"){echo "selected";}?>>5ft
              </option>
              <option value="61" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "61"){echo "selected";}?>>5ft 01in
              </option>
              <option value="62" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "62"){echo "selected";}?>>5ft 02in
              </option>
              <option value="63" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "63"){echo "selected";}?>>5ft 03in
              </option>
              <option value="64" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "64"){echo "selected";}?>>5ft 04in
              </option>
              <option value="65" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "65"){echo "selected";}?>>5ft 05in
              </option>
              <option value="66" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "66"){echo "selected";}?>>5ft 06in
              </option>
              <option value="67" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "67"){echo "selected";}?>>5ft 07in
              </option>
              <option value="68" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "68"){echo "selected";}?>>5ft 08in
              </option>
              <option value="69" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "69"){echo "selected";}?>>5ft 09in
              </option>
              <option value="70" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "70"){echo "selected";}?>>5ft 10in
              </option>
              <option value="71" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "71"){echo "selected";}?>>5ft 11in
              </option>
              <option value="72" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "72"){echo "selected";}?>>6ft
              </option>
              <option value="73" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "73"){echo "selected";}?>>6ft 01in
              </option>
              <option value="74" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "74"){echo "selected";}?>>6ft 02in
              </option>
              <option value="75" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "75"){echo "selected";}?>>6ft 03in
              </option>
              <option value="76" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "76"){echo "selected";}?>>6ft 04in
              </option>
              <option value="77" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "77"){echo "selected";}?>>6ft 05in
              </option>
              <option value="78" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "78"){echo "selected";}?>>6ft 06in
              </option>
              <option value="79" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "79"){echo "selected";}?>>6ft 07in
              </option>
              <option value="80" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "80"){echo "selected";}?>>6ft 08in
              </option>
              <option value="81" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "81"){echo "selected";}?>>6ft 09in
              </option>
              <option value="82" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "82"){echo "selected";}?>>6ft 10in
              </option>
              <option value="83" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "83"){echo "selected";}?>>6ft 11in
              </option>
              <option value="84" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "84"){echo "selected";}?>>7ft
              </option>
              <option value="85" <?php if($ao2 = $DatabaseCo->dbRow->part_height == "85"){echo "selected";}?>>Above 7ft
              </option>
            </select>
          </div>
          <div class="col-xs-4 text-center">
            <h4 class="gt-font-weight-400">TO
            </h4>
          </div>
          <div class="col-xs-6">
            <select class="gt-form-control" name="part_height_to" data-validetta="required">
              <option value="" >
                Select
              </option>
              <option value="48" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "48"){echo "selected";}?>>Below 4ft
              </option>
              <option value="54" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "54"){echo "selected";}?>>4ft 06in
              </option>
              <option value="55" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "55"){echo "selected";}?>>4ft 07in
              </option>
              <option value="56" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "56"){echo "selected";}?>>4ft 08in
              </option>
              <option value="57" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "57"){echo "selected";}?>>4ft 09in
              </option>
              <option value="58" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "58"){echo "selected";}?>>4ft 10in
              </option>
              <option value="59" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "59"){echo "selected";}?>>4ft 11in
              </option>
              <option value="60" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "60"){echo "selected";}?>>5ft
              </option>
              <option value="61" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "61"){echo "selected";}?>>5ft 01in
              </option>
              <option value="62" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "62"){echo "selected";}?>>5ft 02in
              </option>
              <option value="63" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "63"){echo "selected";}?>>5ft 03in
              </option>
              <option value="64" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "64"){echo "selected";}?>>5ft 04in
              </option>
              <option value="65" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "65"){echo "selected";}?>>5ft 05in
              </option>
              <option value="66" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "66"){echo "selected";}?>>5ft 06in
              </option>
              <option value="67" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "67"){echo "selected";}?>>5ft 07in
              </option>
              <option value="68" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "68"){echo "selected";}?>>5ft 08in
              </option>
              <option value="69" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "69"){echo "selected";}?>>5ft 09in
              </option>
              <option value="70" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "70"){echo "selected";}?>>5ft 10in
              </option>
              <option value="71" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "71"){echo "selected";}?>>5ft 11in
              </option>
              <option value="72" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "72"){echo "selected";}?>>6ft
              </option>
              <option value="73" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "73"){echo "selected";}?>>6ft 01in
              </option>
              <option value="74" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "74"){echo "selected";}?>>6ft 02in
              </option>
              <option value="75" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "75"){echo "selected";}?>>6ft 03in
              </option>
              <option value="76" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "76"){echo "selected";}?>>6ft 04in
              </option>
              <option value="77" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "77"){echo "selected";}?>>6ft 05in
              </option>
              <option value="78" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "78"){echo "selected";}?>>6ft 06in
              </option>
              <option value="79" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "79"){echo "selected";}?>>6ft 07in
              </option>
              <option value="80" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "80"){echo "selected";}?>>6ft 08in
              </option>
              <option value="81" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "81"){echo "selected";}?>>6ft 09in
              </option>
              <option value="82" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "82"){echo "selected";}?>>6ft 10in
              </option>
              <option value="83" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "83"){echo "selected";}?>>6ft 11in
              </option>
              <option value="84" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "84"){echo "selected";}?>>7ft
              </option>
              <option value="85" <?php if($ao2 = $DatabaseCo->dbRow->part_height_to == "85"){echo "selected";}?>>Above 7ft
              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
        <label>
          Marital Status :
        </label>
        <select  class="chosen-select gt-form-control" multiple name="part_mstatus[]" data-validetta="required">
          <?php $search_array = explode(', ',$DatabaseCo->dbRow->looking_for); ?>
          <option value="any" 
                  <?php if(in_array('any', $search_array)){ echo "selected"; } ?>>Any
          </option>
          <option value="Never Married" 
                  <?php if(in_array('Never Married', $search_array)){ echo "selected"; } ?>>Never Married
          </option>
          <?php if($DatabaseCo->dbRow->gender == 'Male'){ ?>
        	<option value="Widow" 
                <?php if(in_array('Widow', $search_array)){ echo "selected"; } ?>>Widow
        	</option>
        <?php }else{?>
        	<option value="Widower" 
                <?php if(in_array('Widower', $search_array)){ echo "selected"; } ?>>Widower
        	</option>
        <?php }?>
      <option value="Divorced" 
              <?php if(in_array('Divorced', $search_array)){ echo "selected"; } ?>>Divorced
      </option>
    <option value="Awaiting Divorce" 
            <?php if(in_array('Awaiting Divorce', $search_array)){ echo "selected"; } ?>>Awaiting Divorce
    </option>
  </select>
</div>
	  <?php if($row_field->part_diet == 'Yes'){ ?>
	  <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Eating Habits :
  </label>
  <select class="chosen-select gt-form-control" multiple name="part_diet[]">
    <option>Select Your Diet
    </option>
    <option value="<?php  echo  $DatabaseCo->dbRow->part_diet; ?>" disabled>
      <?php  echo  $DatabaseCo->dbRow->part_diet;?>  
    </option>
    <?php 
$part_dietmul=explode(", ",$DatabaseCo->dbRow->part_diet);
?>
    <option value="Vegetarian" 
            <?php if(in_array('Vegetarian', $part_dietmul)){ echo "selected"; } ?>>Vegetarian
    </option>
  <option value="Non-Vegetarian" 
          <?php if(in_array('Non-Vegetarian', $part_dietmul)){ echo "selected"; } ?>>Non-Vegetarian
  </option>
<option value="Doesn't Matter" 
        <?php if(in_array("Doesn't Matter", $part_dietmul)){ echo "selected"; } ?>>Doesn't Matter
</option>
</select>
</div>
	  <?php } ?>
	  <?php if($row_field->part_smoke == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Smoking Habits :
  </label>
  <select class="chosen-select gt-form-control" multiple name="part_smoke[]">
    <option value="<?php  echo  $DatabaseCo->dbRow->part_smoke; ?>" disabled>
      <?php  echo  $DatabaseCo->dbRow->part_smoke;?>  
    </option>
    <?php 
$part_smokemul=explode(", ",$DatabaseCo->dbRow->part_smoke);
?>
    <option value="Doesn't Matter" 
            <?php if(in_array("Doesn't Matter", $part_smokemul)){ echo "selected"; } ?>>Doesn't Matter
    </option>
  <option value="No" 
          <?php if(in_array("No", $part_smokemul)){ echo "selected"; } ?>>Never Smokes
  </option>
<option value="Smokes Occasionally" 
        <?php if(in_array("Smokes Occasionally", $part_smokemul)){ echo "selected"; } ?>>Smokes Occasionally
</option>
<option value="Smokes Regularly" 
        <?php if(in_array("Smokes Regularly", $part_smokemul)){ echo "selected"; } ?>>Smokes Regularly
</option>
</select>
</div>
	  <?php } ?>
	  <?php if($row_field->part_drink == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Drinking Habits :
  </label>
  <select class="chosen-select gt-form-control" multiple name="part_drink[]">
    <option value="<?php  echo  $DatabaseCo->dbRow->part_drink ?>" disabled>
      <?php  echo  $DatabaseCo->dbRow->part_drink; ?>
    </option>
    <?php $part_drinkmul=explode(", ",$DatabaseCo->dbRow->part_drink); ?>
    <option value="Doesn't Matter" 
            <?php if(in_array("Doesn't Matter", $part_drinkmul)){ echo "selected"; } ?>>Doesn't Matter
    </option>
  <option value="No" 
          <?php if(in_array("No", $part_drinkmul)){ echo "selected"; } ?>>Never Drinks
  </option>
<option value="Drinks Socially" 
        <?php if(in_array("Drinks Socially", $part_drinkmul)){ echo "selected"; } ?>>Drinks Socially
</option>
<option value="Drinks Regularly" 
        <?php if(in_array("Drinks Regularly", $part_drinkmul)){ echo "selected"; } ?>>Drinks Regularly
</option>
</select>
</div>
	  <?php } ?>
	  <?php if($row_field->part_physical_status == 'Yes'){ ?>
      <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
  <label>
    Physical status :
  </label>
  <select class="gt-form-control" name="part_physicalstatus">
    <option value="Normal" 
            <?php if($DatabaseCo->dbRow->part_physical=='Normal'){ echo "selected"; } ?>>Normal
    </option>
  <option value="Physically-challenged" 
          <?php if($DatabaseCo->dbRow->part_physical=='Physically-challenged'){ echo "selected"; } ?>> Physically-challenged 
  </option>
<option value="Doesn't Matter" 
        <?php if($DatabaseCo->dbRow->part_physical=="Doesn't Matter"){ echo "selected"; } ?>>Doesn't Matter
</option>
</select>
</div>
	  <?php } ?>
</div>
</form>
</div>
<!-- CHOSEN -->
<script type="text/javascript">
   	 var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
   </script>
<!-- CHOSEN END -->
<script type="text/javascript" src="./js/validetta.js">
</script>
<script type="text/javascript">
  function part_view_11(status){
    $(function(){
      $('#part_edit1').validetta({
        errorClose : false,
        onValid : function( event ) {
          event.preventDefault();
          part_view_1(status);
        }
      }
                                );
    }
     );
    $('#part_edit1').submit();
  }
</script>

