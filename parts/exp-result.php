<?php
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mid=$_SESSION['user_id'];
include('./pagination.php');
$SQL_STATEMENT_USERSETTING=$DatabaseCo->dbLink->query("SELECT username_setting FROM site_config WHERE id='1'");
$username_settings=mysqli_fetch_object($SQL_STATEMENT_USERSETTING);
?>
<div class="col-xxl-16 col-xl-16 text-center">
  <h2 class="gt-margin-top-0 gt-text-orange">
    All Express Interest
  </h2>
  <article class="gt-margin-bottom-20">
    <p>
      Here you can see your all express interest which you send and received from members.and with left side panel you can access other particluar express interest.
    </p>
  </article>
</div>
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="col-xxl-8 col-xs-16 col-sm-16 col-md-8 col-xl-8 col-lg-8 text-center <?php if($_POST['exp_status']=='sent_all_interest'){ echo 'xyz active'; }?>"  id="sent_all_define">
    <a href="#exp-tab-2" aria-controls="exp-tab-2" role="tab" data-toggle="tab" onClick="getexpsentdata();">
      <i class="fa fa-paper-plane gt-margin-right-10">
      </i> All Sent Interest 
    </a>
  </li>
  <li role="presentation" class="col-xxl-8 col-xs-16 col-sm-16 col-md-8 col-xl-8 col-lg-8 text-center <?php if($_POST['exp_status']=='receive_all_interest'){ echo 'xyz active'; }?>" id="receive_all_define">
    <a href="#exp-tab-1" aria-controls="exp-tab-1" role="tab" data-toggle="tab" onClick="getexpreceivedata();">
      <i class="fa fa-inbox gt-margin-right-10">
      </i> All Received Interest
    </a>
  </li>
</ul>
<div class="tab-content">
  <div role="tabpanel" class="tab-pane <?php if($_POST['exp_status']=='sent_all_interest'){ echo 'active'; }?>" id="exp-tab-1">
    <?php 
		if(isset($_POST['exp_status']) && $_POST['exp_status']=='sent_all_interest')
		{
		if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!='')
		{
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
		$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_receiver and ei_sender='$mid' and trash_sender='No'"));
		$sql="SELECT * FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_receiver and ei_sender='$mid' and trash_sender='No' limit $start,$limit ";	 	 
		$data = $DatabaseCo->dbLink->query($sql);
		if($rows >0)
		{ 
   ?>
    <div class="gt-exp-strip gt-margin-top-15">
      <label class="col-xxl-1 col-xl-1 col-lg-1 col-xs-2 hidden-xs hidden-sm hidden-md" for="exp-rec-all-1">
        <input type="checkbox" id="exp-rec-all-1" onchange="checkAll(this);">
      </label>
      <div class="col-xxl-3 col-xl-3 col-md-5 col-xs-6  hidden-xs hidden-sm hidden-md">
        <a class="btn btn-danger gt-cursor" id="delete_exp">
          <i class="fa fa-trash gt-margin-right-10">
          </i>Delete
        </a>
      </div>
      <div class="col-xxl-3 col-xl-4 col-md-6 col-xs-6 pull-right">
        <div class="btn-group" role="group">
          <?php pagination($limit,$adjacent,$rows,$page); ?>
        </div> 
      </div>
    </div>
    <?php	   
	while( $Row = mysqli_fetch_object($data))
	{
	?>
    <div id="delsentall<?php echo $Row->ei_id;?>">
      <div class="gt-interest-rec">
        <div class="col-xxl-16 col-xl-16 col-sm-16 col-md-16 col-lg-16 hidden-xs hidden-sm hidden-md">
          <div class="row">
            <label class="col-lg-8 col-md-16 col-xxl-16 col-xl-8 col-xs-16 col-sm-16 gt-margin-bottom-0">
              <input type="checkbox" id="exp_sent_id" class="gt-cursor" name="exp_sent_id" value="<?php echo $Row->ei_id;?>">
            </label>
          </div>
        </div>
        <?php include 'exp-sent.php';?>
      </div>
    </div>
    <?php }?>
    <?php }
		else
		{
		?>
    <div class="col-xs-16">
      <div class="thumbnail">
        <img src="img/nodata-available.jpg" class="img-responsive">
      </div>
    </div>
    <?php	
		}   
		}
		}
	  ?>
  </div>
    <div role="tabpanel" class="tab-pane <?php if($_POST['exp_status']=='receive_all_interest'){ echo 'active'; }?>" id="exp-tab-2">
    <?php 
		if(isset($_POST['exp_status']) && $_POST['exp_status']=='receive_all_interest')
		{
		if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!='')
		{
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
		$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_sender and ei_receiver='$mid' and trash_receiver='No' "));
		$sql = "SELECT * FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_sender and ei_receiver='$mid' and trash_receiver='No' limit $start,$limit ";	 	 
		$data = $DatabaseCo->dbLink->query($sql);
		if($rows >0)
		{ 
    ?> 
    <div class="gt-exp-strip gt-margin-top-15">
      <label class="col-xxl-1 col-xl-1 col-lg-1 col-xs-2 hidden-xs hidden-sm hidden-md" for="exp-rec-all-1">
        <input type="checkbox" id="exp-rec-all-1" onchange="checkAllres(this);">
      </label>
      <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-5 col-xs-7  hidden-xs hidden-sm hidden-md">
        <a class="btn btn-danger gt-cursor" id="delete_res_all">
          <i class="fa fa-trash gt-margin-right-10">
          </i>Delete
        </a>
      </div>
      <div class="col-xxl-2 col-xl-3 col-md-5 col-xs-6  hidden-xs hidden-sm hidden-md">
        <a class="btn gt-btn-green gt-cursor" id="accept_res_all">
          <i class="fa fa-check gt-margin-right-10">
          </i>Accept
        </a>
      </div>
      <div class="col-xxl-3 col-xl-3 col-md-6 col-xs-6 pull-right">
        <div class="btn-group" role="group">
          <?php pagination($limit,$adjacent,$rows,$page); ?>
        </div>
      </div>
    </div>
    <?php	   
while( $Row = mysqli_fetch_object($data))
{
?>
    <div class="gt-interest-rec">
      <div class="col-xxl-16 col-xl-16 col-sm-16 col-md-16 col-lg-16 hidden-xs hidden-sm hidden-md">
        <div class="row">
          <label class="col-lg-8 col-md-16 col-xxl-16 col-xl-8 col-xs-16 col-sm-16 gt-margin-bottom-0">
            <input type="checkbox" id="exp_recive_id" class="" name="exp_recive_id" value="<?php echo $Row->ei_id;?>">
          </label>
        </div>
      </div>
      <?php include "exp-received.php";?>
    </div>
    <?php
}
}
else
{?>
    <div class="col-xs-16">
      <div class="thumbnail">
        <img src="img/nodata-available.jpg" class="img-responsive">
      </div>
    </div>
    <?php	
}   
}
}
?>
  </div>
</div>
<script type="application/javascript">
  function deleteexp(id,exppagenm){
    $('#delsentall'+id+'').fadeIn();
    $.ajax({
      url:"delete_expressinterest",
      type:"POST",
      data:'exp_id='+id+'&exp_page='+exppagenm,
      cache: false,
      success: function()
      {
        $('#delsentall'+id+'').fadeOut();
        if($(".xyz.active").attr("id")=='sent_all_define')
        {
          getexpsentdata();
        }
        else if($(".xyz.active").attr("id")=='receive_all_define')
        {
          getexpreceivedata();
        }
      }
    }
          );
  }
   
</script>
<script type="text/javascript">
 
  function checkAll(ele) {
    var checkboxes = $('input[name="exp_sent_id"]');
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
  function checkAllres(ele) {
    var checkboxes = $('input[name="exp_recive_id"]');
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
</script>
<script type="application/javascript">
  $(document).ready(function(e) {
    $('#delete_exp').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="exp_sent_id"]:checked').each(function() {
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
            getexpsentdata();
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
    $('#delete_exp1').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="exp_sent_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                                 );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'delete_expressinterest',
          type: 'POST',
          data: 'exp_status=trash_all&exp_id='+selectedOrderBy,
          success: function(data) {
            getexpsentdata();
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
    $('#delete_res_all').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="exp_recive_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                                   );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'delete_expressinterest',
          type: 'POST',
          data: 'exp_status=trash_all&exp_id='+selectedOrderBy+'&exp_page=receiver',
          success: function(data) {
            getexpreceivedata();
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
    $('#delete_res_all1').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="exp_recive_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                                   );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'delete_expressinterest',
          type: 'POST',
          data: 'exp_status=trash_all&exp_id='+selectedOrderBy,
          success: function(data) {
            getexpreceivedata();
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
    $('#accept_res_all').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="exp_recive_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                                   );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'accept_expressinterest',
          type: 'POST',
          data: 'exp_status=accept_all&exp_id='+selectedOrderBy,
          success: function(data) {
            getexpreceivedata();
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
        alert('Please select at list one message to complete accept action.');
        return false;
      }
    }
                              );
    $('#accept_res_all1').click(function(){
      var selectedOrderBy = new Array();
      $('input[name="exp_recive_id"]:checked').each(function() {
        selectedOrderBy.push(this.value);
      }
                                                   );
      if(selectedOrderBy!='')
      {
        $.ajax({
          url: 'accept_expressinterest',
          type: 'POST',
          data: 'exp_status=accept_all&exp_id='+selectedOrderBy,
          success: function(data) {
            getexpreceivedata();
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
        alert('Please select at list one message to complete accept action.');
        return false;
      }
    }
                               );
  }
                   );
</script>
