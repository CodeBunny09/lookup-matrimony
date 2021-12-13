<?php 
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$SQL_STATEMENT_USERSETTING=$DatabaseCo->dbLink->query("SELECT username_setting FROM site_config WHERE id='1'");
$username_settings=mysqli_fetch_object($SQL_STATEMENT_USERSETTING);
$mid=$_SESSION['user_id'];
include('./pagination.php');
if(isset($_POST['exp_status']) && $_POST['exp_status']=='sent_pending_interest')
{
if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
$page=$_REQUEST['page'];
$limit = 3;
$adjacent = 2;
if($page==1)
{
$start = 0;  
}	
else
{
$start = ($page-1)*$limit;
}
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_receiver and ei_sender='$mid' and trash_sender='No' and receiver_response='Pending'"));
$sql="SELECT * FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_receiver and ei_sender='$mid' and trash_sender='No' and receiver_response='Pending' limit $start,$limit ";		 	 
?>
<div class="col-xxl-16 col-xl-16 text-center">
  <h2 class="gt-margin-top-0 gt-text-orange">
    Express Interest Sent Pending
  </h2>
  <article class="gt-margin-bottom-20">
    <p>
      Here you can see your all express interest which you sent to members and not yet responded.
    </p>
  </article>
</div>
<div class="clearfix">
</div>
<?php
$data=$DatabaseCo->dbLink->query($sql);
if($rows >0)
{ 
?>
<div class="gt-exp-strip ">
  <label class="col-xxl-1 col-xl-1 col-lg-1 col-xs-2 hidden-xs hidden-sm hidden-md" for="exp-rec-all-1">
    <input type="checkbox" id="exp-rec-all-1 gt-cursor" onchange="checkAllpending(this);">
  </label>
  <div class="col-xxl-3 col-xl-3 col-md-5 col-xs-6  hidden-xs hidden-sm hidden-md">
    <a class="btn btn-danger gt-cursor"  id="delete_exp_reject">
      <i class="fa fa-trash gt-margin-right-10">
      </i>Delete
    </a>
  </div>
  <div class="col-xxl-3 col-xl-4 col-md-6 col-xs-6 pull-right">
    <div class="btn-group" role="group">
      <?php pagination($limit,$adjacent,$rows,$page);  ?> 
    </div>
  </div>
</div>
<?php	   
while( $Row = mysqli_fetch_object($data))
{
?>
<div id="delsentacceptall<?php echo $Row->ei_id;?>">
  <div class="gt-interest-rec">
    <div class="col-xxl-16 col-xl-16 col-sm-16 col-md-16 col-lg-16 hidden-xs hidden-sm hidden-md">
      <div class="row">
        <label class="col-lg-8 col-md-16 col-xxl-16 col-xl-8 col-xs-16 col-sm-16 gt-margin-bottom-0">
          <input type="checkbox" id="exp_sent_id" class="" name="exp_sent_pending_id" value="<?php echo $Row->ei_id;?>">
        </label>
      </div>
    </div>
    <?php include'exp-sent.php';?>
  </div>
</div>
<?php }?>                    
<?php 
}
else
{?>
<div class="col-xxl-16 col-xs-16 gt-margin-top-10">
  <div class="thumbnail">
    <img src="img/nodata-available.jpg">
  </div>
</div>
<?php	
}
}
}?>                                      
<script>
  function checkAllpending(ele) {
    var checkboxes = $('input[name="exp_sent_pending_id"]');
    if (ele.checked) {
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type == 'checkbox') {
          checkboxes[i].checked = true;
        }
      }
    }
    else {
      for (var i = 0; i < checkboxes.length; i++) {
        console.log(i)
        if (checkboxes[i].type == 'checkbox') {
          checkboxes[i].checked = false;
        }
      }
    }
  }
  function deleteexp(id,exppagenm){
    $('#delsentacceptall'+id+'').fadeIn();
    $.ajax({
      url:"delete_expressinterest",
      type:"POST",
      data:'exp_id='+id+'&exp_page='+exppagenm,
      cache: false,
      success: function()
      {
        $('#delsentacceptall'+id+'').fadeOut();
        getexpsentpendingdata();
      }
    }
          );
  }
</script>
<script type="application/javascript">
  $(document).ready(function(e) {
    $('#delete_exp_pending').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="exp_sent_pending_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                                         );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'delete_expressinterest',
          type: 'POST',
          data: 'exp_status=trash_all&exp_id='+selectedOrderBy+'&exp_page=sent',
          success: function(data) {
            getexpsentpendingdata();
          }
          ,
          error: function() {
            //called when there is an error
            //console.log(e.message);
          }
        }
              );
      }
      else{
        alert('Please select at list one message to complete trash action.');
        return false;
      }
    }
                                  );
    $('#delete_exp_pending1').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="exp_sent_pending_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                                         );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'delete_expressinterest',
          type: 'POST',
          data: 'exp_status=trash_all&exp_id='+selectedOrderBy+'&exp_page=sent',
          success: function(data) {
            getexpsentpendingdata();
          }
          ,
          error: function() {
            //called when there is an error
            //console.log(e.message);
          }
        }
              );
      }
      else{
        alert('Please select at list one message to complete trash action.');
        return false;
      }
    }
                                   );
  }
                   );
</script>
