<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
include_once '../class/Config.class.php';
$DatabaseCo = new DatabaseConn();
$configObj = new Config();
$story_id = isset($_GET['story_id']) ? $_GET['story_id'] : "";
if ($story_id != '') {
$sql = "select * from success_story where story_id='$story_id'";
$result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
$row = mysqli_fetch_array($result);
}
if (isset($_REQUEST['add_story'])) {
	$brideid = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['brideid']);
	$bridename = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['bridename']);
	$groomid = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['groomid']);
	$groomname = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['groomname']);
	$weddingphoto = $_FILES['weddingphoto']['name'];
	$marriagedate = $_POST['datepicker'];
	$successmessage = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['successmessage']);
	$status = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['status']);
	$sgg = "select index_id from register where matri_id='$brideid'";
	$rrr = mysqli_query($DatabaseCo->dbLink, $sgg);
	$num_row11 = mysqli_num_rows($rrr);
	$sgg2 = "select index_id from register where matri_id='$groomid'";
	$rrr2 = mysqli_query($DatabaseCo->dbLink, $sgg2);
	$num_row22 = mysqli_num_rows($rrr2);
	if ($num_row11 == 0) {
		$msg1 = "Your Bride  MatriId is Not Found in Our Database.Please, Enter Valid Bride MatriId.";
	} else if ($num_row22 == 0) {
		$msg2 = "Your Groom  MatriId is Not Found in Our Database.Please, Enter Valid Groom MatriId.";
	} else {
		if ($_POST['v_type'] == 'upvediosel') {
$file = $_FILES["weddingvideo"]["name"];
$file_size = isset($_FILES['weddingvideo']['size']) ? $_FILES['weddingvideo']['size'] : '';
$weddingphoto_type = 'video';
$d = explode(".", $file);
$p = count($d);
$chk_ext = $d[$p - 1];
if (($chk_ext == "flv") && ($file_size < 25480000)) {
$time = time() . '.flv';
$weddingphoto = $_FILES['video']['name'];
copy($_FILES["weddingvideo"]["tmp_name"], "../SuccessStory/" . $time);
$sql = "insert into success_story(`weddingphoto`,`weddingphoto_type`, `bridename`, `brideid`, `groomname`, `groomid`, `marriagedate`, `successmessage`, `status`) values('$time','$weddingphoto_type','$bridename','$brideid','$groomname','$groomid','$marriagedate','$successmessage','$status')";
$result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
header("location:success_story_approval?success=Yes");
} else {
echo "<script laguage=\"javascript\">alert(\"Only .flv Extention Video File AND Maximum 25 MB Size Allow \");</script>";
}
} else if ($_POST['v_type'] == 'upphotosel') {
$file = $_FILES["weddingphoto"]["name"];
$file_size = isset($_FILES['weddingphoto']['size']) ? $_FILES['weddingphoto']['size'] : '';
$weddingphoto_type = 'photo';
$d = explode(".", $file);
$p = count($d);
$chk_ext = $d[$p - 1];
if (($chk_ext == "jpg" || $chk_ext == "JPG" || $chk_ext == "jpeg" || $chk_ext == "png" || $chk_ext == "gif") && ($file_size < 50960000)){
$time = time() . '.jpg';
move_uploaded_file($_FILES['weddingphoto']['tmp_name'], "../SuccessStory/" . $time);
$sql = "insert into success_story(`weddingphoto`,`weddingphoto_type`, `bridename`, `brideid`, `groomname`, `groomid`,`marriagedate`, `successmessage`, `status`) values('$time','$weddingphoto_type','$bridename','$brideid','$groomname','$groomid','$marriagedate','$successmessage','$status')";
$result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
header("location:success_story_approval?success=Yes");
} else {
echo "<script laguage=\"javascript\">alert(\"Only .jpg,.jpeg,.png,.gif Extention Photo File AND Maximum 5 MB Size Allow \");</script>";
}
}
}
}
if (isset($_REQUEST['update_story'])) {
//    echo '<pre>';
//print_R($_REQUEST);exit;
$brideid = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['brideid']);
$bridename = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['bridename']);
$groomid = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['groomid']);
$groomname = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['groomname']);
$marriagedate = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['datepicker']);
$successmessage = mysqli_real_escape_string($DatabaseCo->dbLink, $_REQUEST['successmessage']);
$status = $_REQUEST['status'];
$sgg = "select index_id from register where matri_id='$brideid'";
$rrr = mysqli_query($DatabaseCo->dbLink, $sgg);
$num_row11 = mysqli_num_rows($rrr);
$sgg2 = "select index_id from register where matri_id='$groomid'";
$rrr2 = mysqli_query($DatabaseCo->dbLink, $sgg2);
$num_row22 = mysqli_num_rows($rrr2);
if ($num_row11 == 0) {
$msg1 = "Your Bride MatriId Not Found in Our Database.Please, Enter Valid Bride MatriId.";
} else if ($num_row22 == 0) {
$msg2 = "Your Groom MatriId Not Found in Our Database.Please, Enter Valid Groom MatriId.";
} else {
if ($_POST['v_type'] == 'upvediosel') {
if (@is_uploaded_file($_FILES["weddingvideo"]["tmp_name"])) {
$file = $_FILES["weddingvideo"]["name"];
$file_size = isset($_FILES['weddingvideo']['size']) ? $_FILES['weddingvideo']['size'] : '';
$weddingphoto_type = 'video';
$d = explode(".", $file);
$p = count($d);
$chk_ext = $d[$p - 1];
if (($chk_ext == "flv") && ($file_size < 25480000)) {
$time = time() . '.flv';
if(file_exists("../SuccessStory/" . $_REQUEST['oldimg'])){
unlink("../SuccessStory/" . $_REQUEST['oldimg']);
}
move_uploaded_file($_FILES['weddingvideo']['tmp_name'], "../SuccessStory/" . $time);
$sql = "update success_story set weddingphoto='$time',bridename='$bridename',brideid='$brideid',weddingphoto_type='$weddingphoto_type',groomname='$groomname',groomid='$groomid',marriagedate='$marriagedate',successmessage='$successmessage',status='$status' where story_id='$story_id'";
$result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
header("location:success_story_approval?success=Yes");
} else {
echo "<script laguage=\"javascript\">alert(\"Only .flv Extention Video File AND Maximum 25 MB Size Allow \");</script>";
}
} else {
$time = $_POST['oldimg'];
$weddingphoto_type = 'video';
$sql = "update success_story set weddingphoto='$time',bridename='$bridename',brideid='$brideid',weddingphoto_type='$weddingphoto_type',groomname='$groomname',groomid='$groomid',marriagedate='$marriagedate',successmessage='$successmessage',status='$status' where story_id='$story_id'";
$result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
header("location:success_story_approval?success=Yes");
}
} else if ($_POST['v_type'] == 'upphotosel') {
if (@is_uploaded_file($_FILES["weddingphoto"]["tmp_name"])) {
$file = $_FILES["weddingphoto"]["name"];
$file_size = isset($_FILES['weddingphoto']['size']) ? $_FILES['weddingphoto']['size'] : '';
$weddingphoto_type = 'photo';
$d = explode(".", $file);
$p = count($d);
$chk_ext = $d[$p - 1];
if (($chk_ext == "jpg" || $chk_ext == "JPG" || $chk_ext == "jpeg" || $chk_ext == "png" || $chk_ext == "gif") && ($file_size < 50960000)) {
$time = time() . '.jpg';
if(file_exists("../SuccessStory/" . $_REQUEST['oldimg'])){
unlink("../SuccessStory/" . $_REQUEST['oldimg']);
}
move_uploaded_file($_FILES['weddingphoto']['tmp_name'], "../SuccessStory/" . $time);
$sql = "update success_story set weddingphoto='$time',bridename='$bridename',brideid='$brideid',weddingphoto_type='$weddingphoto_type',groomname='$groomname',groomid='$groomid',marriagedate='$marriagedate',successmessage='$successmessage',status='$status' where story_id='$story_id'";
$result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
header("location:success_story_approval?success=Yes");
} else {
echo "<script laguage=\"javascript\">alert(\"Only .jpg,.jpeg,.png,.gif Extention Photo File AND Maximum 5 MB Size Allow \");</script>";
}
} else {
$time = $_POST['oldimg'];
$weddingphoto_type = 'photo';
$sql = "update success_story set weddingphoto='$time',bridename='$bridename',brideid='$brideid',weddingphoto_type='$weddingphoto_type',groomname='$groomname',groomid='$groomid',marriagedate='$marriagedate',successmessage='$successmessage',status='$status' where story_id='$story_id'";
$result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
header("location:success_story_approval?success=Yes");
}
}
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage |  Sucess Story</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- BOOTSTRAP & CUSTOM CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <!-- BOOTSTRAP & CUSTOM CSS END-->    
    <!-- FONTAWSOME -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- FONTAWSOME END-->  
    <!-- THEME CSS -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- THEME CSS END-->
	<!-- ICHECK CHECKBOX CSS -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- ICHECK CHECKBOX CSS END -->
    <link rel="stylesheet" href="../css/validate.css">
    <script type="text/javascript">
      function checkbride(str)
      {
        if (str == "")
        {
          document.getElementById("bridename").value = "";
          return;
        }
        if (window.XMLHttpRequest)
        {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        }
        else
        {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
        {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
          {
            document.getElementById("bridename").value = xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET", "checkbride?q=" + str, true);
        xmlhttp.send();
      }
    </script>
    <script type="text/javascript">
      function checkgroom(str)
      {
        if (str == "")
        {
          document.getElementById("groomname").value = "";
          return;
        }
        if (window.XMLHttpRequest)
        {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        }
        else
        {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
        {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
          {
            document.getElementById("groomname").value = xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET", "checkgroom?q=" + str, true);
        xmlhttp.send();
      }
    </script>
  </head>
  <body class="skin-blue">
    <!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
          <div class="spinner"></div>
        </div>
        <!-- ICON LOADER END-->
  <div class="wrapper" style="display:none" id="body">
      <?php include "page-part/header.php"; ?> 
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "page-part/left_panel.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="lightGrey">
            Manage Sucess Story
          </h1>
          <ol class="breadcrumb">
            <li>
              <a href="dashboard">
                <i class="fa fa-home">
                </i> Home
              </a>
            </li>
            <li class="active"> Add New Sucess Story
            </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
              <div class="box-top updateSite">
              	<div class="row">
                <div class="col-md-3 col-sm-6">
                  <a href="javascript:;" class="btn btn-success btn-lg btn-block" onclick="window.location = 'success_story_approval'">
                    <i class="fa fa-list hidden-xs">
                    </i>All Sucess Story
                  </a>
                </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-xs-12 mt-10">
              <div class="box box-success">
                <div class="box-header with-border">
                	<h4>ADD / UPDATE SUCCESS STORY</h4>
                </div>
                
                <?php
					if (!empty($STATUS_MESSAGE)) {
					if ($save) {
					echo "<div class='success-msg cf' id='success_msg'><h4>" . $STATUS_MESSAGE . "</h4>    
					</div>";
					echo "<div class='error-msg' id='validationSummary'></div>";
					} else {
					echo "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>" . $STATUS_MESSAGE . "</li></ul></div>";
					}
					} else {
					echo "<div class='error-msg' id='validationSummary'></div>";
					}
					?>	
                <div class="row">
                  <div class="box-body">
                    <form action="" enctype="multipart/form-data" method="post" class="form-data gtNewMemPlan" id="add_form" class="">
                      <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                          <label>
                            Bride ID :
                          </label>
                          <input type="text" class="form-control" name="brideid" value="<?php
                                                                                        if ($story_id != '') {
                                                                                        echo $row['brideid'];
                                                                                        }
                                                                                        ?>" id="brideid" title="bridid"
                                 onblur="return checkbride(this.value)" data-validetta="required"/>
                        </div>
                        <div class="form-group">
                          <label>
                            Bride name :
                          </label>
                          <input type="text" class="form-control" name="bridename" value="<?php
                                                                                          if ($story_id != '') {
                                                                                          echo $row['bridename'];
                                                                                          }
                                                                                          ?>" id="bridename" title="bridename" data-validetta="required"/>
                        </div>
                        <div class="form-group">
                          <label>
                            Groom ID :
                          </label>
                          <input type="text" class="form-control" name="groomid" value="<?php
                                                                                        if ($story_id != '') {
                                                                                        echo $row['groomid'];
                                                                                        }
                                                                                        ?>" id="groomid" title="groomid" onblur="return checkgroom(this.value)" data-validetta="required"/>
                        </div>
                        <div class="form-group">
                          <label>
                            Groom Name :
                          </label>
                          <input type="text" class="form-control" name="groomname" value="<?php
                                                                                          if ($story_id != '') {
                                                                                          echo
                                                                                          $row['groomname'];
                                                                                          }
                                                                                          ?>" id="groomname"  data-validetta="required"/>
                        </div>
                        <div class="form-group">
                          <label>
                            Upload Photo :
                          </label>
                          <input type="file"  class="form-control" name="weddingphoto" id="weddingphoto" size="8" 
                                 <?php if ($story_id == '') { ?>data-validetta="required"
                          <?php } ?>/>
                          <input type="hidden" name="oldimg" id="oldimg" value="<?php
                                                                                if ($story_id != '') {
                                                                                echo $row['weddingphoto'];
                                                                                }
                                                                                ?>" />
                        </div>
                        
                        
                      </div>
                      <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                          <label>
                            Success Masssage : 
                          </label>
                          <textarea name="successmessage" id="successmessage" data-validetta="required" class="form-control" rows="10" cols="40">
                            <?php
if ($story_id != '') {
echo $row['successmessage'];
}
?>
                          </textarea>
                        </div>
                        <div class="form-group">
                          <label>
                            Marrage Date :
                          </label>
                          <input type="text" class="form-control" name="datepicker" value="<?php
                                                                                           if ($story_id != '') {
                                                                                           echo $row['marriagedate'];
                                                                                           }
                                                                                           ?>" id="datepicker"  data-validetta="required"/>
                        </div>
                        <div class="form-group">
                          <label>
                            Status:
                          </label>
                          <input type="radio"  value="APPROVED" name="status" id="status" 
                                 <?php if ($story_id != '' && $row['status'] == "APPROVED") { ?> checked="checked" 
                          <?php } ?>  data-validetta="required"/>
                          <span class="radio-btn-text">Active
                          </span>
                          <input type="radio"  value="UNAPPROVED" name="status" id="status" 
                                 <?php if ($story_id != '' && $row['status'] == "UNAPPROVED") { ?> checked="checked" 
                          <?php } ?> data-validetta="required" />
                          <span class="radio-btn-text">Inactive
                          </span>
                        </div>
                      </div>
                      <div class="clearfix">
                      </div>
                      <div class="col-xs-12 mt-10">
                        <div class="col-md-4 col-md-offset-4 col-sm-4 col-xs-12 form-group">
                          <?php
if (!empty($story_id)) {
?>
                          <input type="submit"  class="btn btn-green btn-lg" value="Update" name="update_story" title="Update"/>
                          <input type="hidden" name="update_story" class="btn btn-green btn-lg" value="submit" />
                          <input type="hidden" name="oldimg" value="<?php echo $row['weddingphoto']; ?>" />
                          <?php
} else {
?>
                          <input type="submit"  class="btn btn-green btn-lg" value="Add" name="add_story" title="Add"/>
                          <input type="hidden" name="add_story" value="submit" />
                          <?php
}
?>
						  <input type="reset" class="btn btn-danger btn-lg" value="Cancel" title="Cancel"/>
                        </div>
                        
                      </div>
                    </form> 
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
      </div>
      <!-- /.row (main row) -->
      </section>
    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  <?php include "page-part/footer.php"; ?>
  </div>
<!-- ./wrapper -->
<script src="plugins/jQuery/jQuery-2.1.3.min.js">
</script>
<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript">
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
</script> 
<script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>    
<!-- Morris.js charts -->
<!--jquery for left menu active class-->
<script type="text/javascript" src="dist/js/general.js">
</script>
<script type="text/javascript" src="dist/js/cookieapi.js">
</script>
<script type="text/javascript">
  // setPageContext("site-settings","site");
</script>
<script type="text/javascript" src="js/util/redirection.js">
</script>
<!---------------Jquery Form validation------------------>
<script src="../js/validetta.js" type="text/javascript">
</script>
<script type="text/javascript">
  $(function() {
    $('#add_form').validetta({
      errorClose: false,
      custom: {
        regname: {
          pattern: /^[\+][0-9]+?$|^[0-9]+?$/,
          errorMessage: 'Custom Reg Error Message !'
        }
        ,
        // you can add more
        example: {
          pattern: /^[\+][0-9]+?$|^[0-9]+?$/,
          errorMessage: 'Lan mal !'
        }
      }
      ,
      realTime: true
    }
                            );
  }
   );
</script>
<!---------------Jquery Form validation End------------------>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
  $(function() {
    $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true
    }
                               );
  }
   );
</script> 
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript">
</script>
<!--jquery for left menu active class-->
<script type="text/javascript" src="dist/js/general.js">
</script>
<script type="text/javascript" src="dist/js/cookieapi.js">
</script>
<script type="text/javascript">
  setPageContext("approval", "succ-approve");
</script>	
<!--jquery for left menu active class end-->
<script language="JavaScript">
  $(document).ready(function(e) {
    setVisibility('upvideo', 'none');
    setVisibility('upphoto', 'inline');
  }
                   );
  function setVisibility(id, visibility)
  {
    document.getElementById(id).style.display = visibility;
    if (id == 'upvideo' && visibility == 'inline')
    {
      <?php if ($story_id == '') {
        ?>
          $('#weddingvideo').attr('data-validetta', 'required');
        <?php }
      ?>
    }
      if (id == 'upvideo' && visibility == 'none')
      {
        $('#weddingvideo').attr('data-validetta', '');
      }
      if (id == 'upphoto' && visibility == 'inline')
      {
        <?php if ($story_id == '') {
          ?>
            $('#weddingphoto').attr('data-validetta', 'required');
          <?php }
        ?>
      }
        if (id == 'upphoto' && visibility == 'none')
        {
          $('#weddingphoto').attr('data-validetta', '');
        }
      }
</script>
</body>
</html>