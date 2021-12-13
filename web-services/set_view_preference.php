<?php
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mid=$_SESSION['user_id'];
if(isset($_POST['photo_view_status']))
{
$DatabaseCo->dbLink->query("update register set photo_view_status='".$_POST['photo_view_status']."' where matri_id='$mid'");
?>
<div class="col-xs-16 col-xxl-16 col-xl-16 col-md-16 col-sm-16 col-lg-16 setting-collapse-bucket">
  <div class="row gt-margin-bottom-10">
    <?php if(isset($_POST['photo_view_status']) && $_POST['photo_view_status']=="0"){?>
    <div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-16 col-lg-6 gt-margin-bottom-10">
      <a class="btn btn-success" onClick="photovisbility('1');">
        <span class="gt-margin-left-10">
          <i class="fa fa-eye gt-margin-right-10">
          </i>Visible To All Members
        </span>
      </a>
    </div>
    <div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-16 col-lg-6">
      <a class="btn btn-success" onClick="photovisbility('2');">
        <span class="gt-margin-left-10">
          <i class="fa fa-eye gt-margin-right-10">
          </i>Visible To Paid Members
        </span>
      </a>
    </div>
    <?php }
if(isset($_POST['photo_view_status']) && $_POST['photo_view_status']=="1"){
?>
    <div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-16 col-lg-6 gt-margin-bottom-10">
      <a class="btn btn-success" onClick="photovisbility('2');">
        <span class="gt-margin-left-10">
          <i class="fa fa-eye gt-margin-right-10">
          </i>Visible To Paid Members
        </span>
      </a>
    </div>
    <div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-16 col-lg-6">
      <a class="btn btn-success" onClick="photovisbility('0');">
        <span class="gt-margin-left-10">
          <i class="fa fa-eye-slash gt-margin-right-10">
          </i>Hidden For All 
        </span>
      </a>
    </div>
    <?php }
if(isset($_POST['photo_view_status']) && $_POST['photo_view_status']=="2")
{
?>
    <div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-16 col-lg-6 gt-margin-bottom-10">
      <a class="btn btn-success" onClick="photovisbility('1');">
        <span class="gt-margin-left-10">
          <i class="fa fa-eye gt-margin-right-10">
          </i>Visible To All Members
        </span>
      </a>
    </div>
    <div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-16 col-lg-6">
      <a class="btn btn-success" onClick="photovisbility('0');">
        <span class="gt-margin-left-10">
          <i class="fa fa-eye-slash gt-margin-right-10">
          </i>Hidden For All 
        </span>
      </a>
    </div>
    <?php }?>
  </div>
</div>
<?php
}
if(isset($_POST['remove_photo_pass']))
{
$DatabaseCo->dbLink->query("update register set photo_pswd='',photo_protect='No' where matri_id='$mid'");
}
if(isset($_POST['contact_view_status']))
{
$contactprivacy=$_POST['contact_view_status'];	
$DatabaseCo->dbLink->query("update register set contact_view_security='".$contactprivacy."' where matri_id='".$_SESSION['user_id']."'");
?>
<div class="col-xs-16 col-xxl-16 col-xl-16 col-md-16 col-sm-16 col-lg-16 setting-collapse-bucket">
  <div class="row">
    <div class="col-xxl-7 col-xl-7 col-xs-16 col-sm-16 col-md-16 col-lg-7 gt-margin-bottom-10">
      <a class="btn gt-btn-green" onClick="contactvisbility('0');">
        <span class="gt-margin-left-10">
          <i class="fa fa-eye gt-margin-right-10">
          </i>Show To Express Interest
          <br>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accepted Paid Member
        </span>
      </a>
    </div>
    <div class="col-xxl-6 col-xl-6 col-xs-16 col-sm-16 col-md-16 col-lg-6 gt-margin-bottom-10">
      <a class="btn gt-btn-green" onClick="contactvisbility('1');">
        <span class="gt-margin-left-10">
          <i class="fa fa-eye gt-margin-right-10">
          </i>Show To Paid Members
        </span>
      </a>
    </div>
  </div>	
</div>
<?php
}
?>
