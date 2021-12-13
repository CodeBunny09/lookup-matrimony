<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
$DatabaseCo = new DatabaseConn();
include_once 'auth.php';
$matri_id = $_GET['matri_id'];
$sel = $DatabaseCo->dbLink->query("select * from register where matri_id='$matri_id'");
$res1=mysqli_fetch_array($sel);
?>
<script type="text/javascript" src="js/jquery-1.11.1.min.js">
</script>
<script type="text/javascript" src="js/jquery.js">
</script>
<script type="text/javascript">var $1 = jQuery.noConflict();
</script>
<script language="JavaScript">
  function setVisibility(id, visibility)
  {
    document.getElementById(id).style.display = visibility;
  }
</script>
<script type="text/javascript">
  jQuery(document).ready(function($){
    $1('#image1').addimagezoom({
      zoomrange: [2, 4],
      magnifiersize: [300,200],
      magnifierpos: 'right',
      largeimage: 'my_photos/<?php echo $res1['photo1'];?>'//<-- No comma after last option!
    }
                              )
  }
                        )
</script>
<!--end fof zoom-->
<script type="text/javascript">
  $(document).ready(function(){
    $("h2").append('<em></em>')
    $(".thumb a").click(function(){
      var str = $(this).attr("href");
      var largePath = str.replace("my_photos", "my_photos");
      var largeAlt = $(this).attr("title");
      $("#largeImg1").attr({
        src: largePath, alt: largeAlt, value:largeAlt  }
                          );
      $("h2 em").html(" (" + largeAlt + ")");
      return false;
    }
                       );
  }
                   );
</script>
<style type="text/css">
  body
  {
    margin-top:5px !important;
  }
  #largeImg {
    border: solid 1px #ccc;
    width: 100px;
    height: 100px;
    padding: 4px;
  }
  .thumbs img {
    border: solid 1px #ccc;
    width: 42px;
    height: 42px;
    padding: 2px;
  }
  .thumbs img:hover {
    border-color: #FF9900;
    border:0;
  }
  #largeImg1 {
    border: solid 0px #7e70e0;
    width: 260px;
    height: 340px;
    padding: 0px;
  }
  .thumb img {
    border: 2px solid #7e70e0;
    width: 50px;
    height: 50px;
    padding: 2px;
    margin-bottom:10px;
  }
  .thumb img:hover {
    /*border-color: #FF9900;*/
    border:0;
  }
</style>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
      </button>
      <h4 class="modal-title" id="myModalLabel">Photo of 
        <?php echo $res1['username'];?>
      </h4>
    </div>
    <div class="modal-body">                 
      <div class="form-group"> 
        <table width="100%" align="left" border="0" class="verdana_12">
          <tr class="verdana_12">
            <td valign="top" align="center" style="text-align:center;">
			  <?php if(is_file("my_photos/".$res1['photo1'])){?>
              <img src="my_photos/<?php echo $res1['photo1'];?>" width="500px" height="400px"  id="largeImg1" alt="Large image" title="<?php echo $res1['photo1']; ?>"/>
			  <?php }else{?>
				<h3 class="text-center">Photo not yet uploaded or approved.</h3>
			  <?php } ?>
              <br />
              <br />
              <div class="thumb margin-bottom-10px">
                <?php  if($res1['photo1_approve'] == "APPROVED")
{
?>
                <a href="my_photos/<?php echo $res1['photo1'] ?>" title="Image 1">
                  <img src="my_photos/<?php echo $res1['photo1'];?>" border="0" height="100" width="80" class="rounded_STYLE"/>
                </a>
                <?php
}
?>
                &nbsp;&nbsp;&nbsp;
                <?php  if($res1['photo2_approve'] == "APPROVED")
{
?>
                <a href="my_photos/<?php echo $res1['photo2'] ?>" title="Image 2">
                  <img src="my_photos/<?php echo $res1['photo2'];?>" border="0" height="100" width="80" class="rounded_STYLE"/>
                </a>
                <?php
}
?>
                &nbsp;&nbsp;&nbsp;
                <?php  if($res1['photo3_approve'] == "APPROVED")
{
?>
                <a href="my_photos/<?php echo $res1['photo3'] ?>" title="Image 3">
                  <img src="my_photos/<?php echo $res1['photo3'];?>" border="0" height="100" width="80" class="rounded_STYLE"/>
                </a>
                <?php
}
?>
                &nbsp;&nbsp;&nbsp;
                <?php  if($res1['photo4_approve'] == "APPROVED")
{
?>
                <a href="my_photos/<?php echo $res1['photo4'] ?>" title="Image 4">
                  <img src="my_photos/<?php echo $res1['photo4'];?>" border="0" height="100" width="80" class="rounded_STYLE"/>
                </a>
                <?php
}
?>
                &nbsp;&nbsp;&nbsp;
                <?php  if($res1['photo5_approve'] == "APPROVED")
{
?>
                <a href="my_photos/<?php echo $res1['photo5'] ?>" title="Image 4">
                  <img src="my_photos/<?php echo $res1['photo5'];?>" border="0" height="100" width="80" class="rounded_STYLE"/>
                </a>
                <?php
}
?>
                &nbsp;&nbsp;&nbsp;
                <?php  if($res1['photo6_approve'] == "APPROVED")
{
?>
                <a href="my_photos/<?php echo $res1['photo6'] ?>" title="Image 4">
                  <img src="my_photos/<?php echo $res1['photo6'];?>" border="0" height="100" width="80" class="rounded_STYLE"/>
                </a>
                <?php
}
?>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>		
    <div class="clearfix">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close
      </button>
    </div>
  </div>
</div>
