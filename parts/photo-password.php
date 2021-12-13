<?php
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mid=$_SESSION['user_id'];
$sent= mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_receiver_id and ph_requester_id='$mid' and receiver_response='Pending' ORDER BY ph_reqdate DESC"));

$receive = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_requester_id and ph_receiver_id='$mid' and receiver_response='Pending' ORDER BY ph_reqdate DESC"));
?>
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="col-xxl-8 col-xs-16 col-sm-16 col-md-8 col-xl-8 col-lg-8 text-center <?php if($_POST['exp_status']=='receive_all_request'){ echo 'xyz active'; }?>" id="receive_all_define">
    <a href="#exp-tab-2" aria-controls="exp-tab-2" role="tab" data-toggle="tab" onClick="getphotopassreceived();">
      <i class="fa fa-inbox gt-margin-right-10">
      </i> Photo Request Received 
      <span class="badge gt-margin-left-10">
        <?php echo $receive;?>
      </span>
    </a>
  </li>
  <li role="presentation" class="col-xxl-8 col-xs-16 col-sm-16 col-md-8 col-xl-8 col-lg-8 text-center <?php if($_POST['exp_status']=='sent_all_request'){ echo 'xyz active'; }?>" id="sent_all_define">
    <a href="#exp-tab-1" aria-controls="exp-tab-1" role="tab" data-toggle="tab" onClick="getphotopasssent();">
      <i class="fa fa-paper-plane gt-margin-right-10">
      </i> Photo Request Sent
      <span class="badge gt-margin-left-10">
        <?php echo $sent;?>
      </span>
    </a>
  </li> 
</ul>
<div class="tab-content">
  <div role="tabpanel" class="tab-pane <?php if($_POST['exp_status']=='sent_all_request'){ echo 'active'; }?>" id="exp-tab-1">
    <?php 
if(isset($_POST['exp_status']) && $_POST['exp_status']=='sent_all_request'){
if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
$page=$_REQUEST['page'];
$limit = 3;
$adjacent = 2;
if($page==1){
$start = 0;  
}	else{
$start = ($page-1)*$limit;
}
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_receiver_id and ph_requester_id='$mid'  ORDER BY ph_reqdate DESC"));
$sql="SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_receiver_id and ph_requester_id='$mid'  ORDER BY ph_reqdate DESC limit $start,$limit ";	 	 
$data = $DatabaseCo->dbLink->query($sql);
if($rows >0)
{ 
if($rows>3)
{
?>
    <div class="gt-exp-strip gt-margin-top-15">
     
      <div class="col-xxl-15 col-xl-15 col-md-16 col-xs-16 pull-right">
        <div class="btn-group" role="group">
          <?php pagination($limit,$adjacent,$rows,$page); ?>
          
        </div> 
      </div>
    </div>
    <?php	  
}
while( $Row = mysqli_fetch_object($data)){
?>
    <div id="delsentall<?php echo $Row->ph_reqid;?>">
      <?php include'photo-req-sent.php';?>
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
  <div role="tabpanel" class="tab-pane <?php if($_POST['exp_status']=='receive_all_request'){ echo 'active'; }?>" id="exp-tab-2">
    <?php 
if(isset($_POST['exp_status']) && $_POST['exp_status']=='receive_all_request')
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
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_requester_id and ph_receiver_id='$mid' and receiver_response='Pending' ORDER BY ph_reqdate DESC"));
$sql="SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_requester_id and ph_receiver_id='$mid' and receiver_response='Pending' ORDER BY ph_reqdate DESC limit $start,$limit ";	 	 
$data = $DatabaseCo->dbLink->query($sql);
if($rows >0)
{ 
if($rows>3)
{
?> 
    <div class="gt-exp-strip gt-margin-top-15">
      <div class="col-xxl-15 col-xl-15 col-md-16 col-xs-16 pull-right">
        <div class="btn-group" role="group">
          <?php pagination($limit,$adjacent,$rows,$page); ?>
       
        </div>
      </div>
    </div>
    <?php	
}
while( $Row = mysqli_fetch_object($data)){
?>
    <div id="delreceiveall<?php echo $Row->ph_reqid; ?>">
      <?php include"photo-req-received.php";?>
    </div>
    <?php } ?>      
    <?php 
} else { ?>
    <div class="col-xs-16">
      <div class="thumbnail">
        <img src="img/nodata-available.jpg" class="img-responsive">
      </div>
    </div>
    <?php	
} } }
?>
  </div>
</div>
<script type="application/javascript">
  function deletereq(id,exppagenm){
    $('#delsentall'+id+'').fadeIn();
    $.ajax({
      url:"delete_photoreq",
      type:"POST",
      data:'req_id='+id+'&req_page='+exppagenm,
      cache: false,
      success: function()
      {
        $('#delsentall'+id+'').fadeOut();
        if($(".xyz.active").attr("id")=='sent_all_define')
        {
          getphotopasssent();
        }
        else if($(".xyz.active").attr("id")=='receive_all_define')
        {
          getphotopassreceived();
        }
      }
    }
          );
  }
</script>
<script type="application/javascript">
  function deletereq(id,exppagenm){
    $('#delreceiveall'+id+'').fadeIn();
    $.ajax({
      url:"delete_photoreq",
      type:"POST",
      data:'req_id='+id+'&req_page='+exppagenm,
      cache: false,
      success: function()
      {
        $('#delreceiveall'+id+'').fadeOut();
        if($(".xyz.active").attr("id")=='sent_all_define')
        {
          getphotopasssent();
        }
        else if($(".xyz.active").attr("id")=='receive_all_define')
        {
          getphotopassreceived();
        }
      }
    }
          );
  }
</script>
<?php
function pagination($limit,$adjacents,$rows,$page)
{
$pagination='';
if ($page == 0) $page = 1;					//if no page var is given, default to 1.
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$prev_='';
$first='';
$lastpage = ceil($rows/$limit);	
$next_='';
$last='';
if($lastpage > 1)
{	
if ($page > 1) 
$prev_.= "<a class='page-numbers' href=\"?page=$prev\">&lt;&lt;</a>";
else{
//$pagination.= "<span class=\"disabled\">previous</span>";	
}
//pages	
if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
{	
$first='';
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
}
$last='';
}
elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
{
//close to beginning; only hide later pages
$first='';
if($page < 1 + ($adjacents * 2))		
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
}
$last.= "<a class='page-numbers' href=\"?page=$lastpage\">&gt;&gt; &gt;&gt;</a>";			
}
//in middle; hide some front and some back
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
{
$first.= "<a class='page-numbers' href=\"?page=1\">&lt;&lt; &lt;&lt;</a>";	
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
}
$last.= "<a class='page-numbers' href=\"?page=$lastpage\">&gt;&gt; &gt;&gt;</a>";			
}
//close to end; only hide early pages
else
{
$first.= "<a class='page-numbers' href=\"?page=1\">&lt;&lt; &lt;&lt;</a>";	
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
}
$last='';
}
}
if ($page < $counter - 1) 
$next_.= "<a class='page-numbers' href=\"?page=$next\">&gt;&gt;</a>";
else{
//$pagination.= "<span class=\"disabled\">next</span>";
}
$pagination = "<div class='text-center'><div class='row'><nav class=''>
<ul class=\"pagination\"><li>"
.$first."</li><li>".$prev_.$pagination."</li><li>".$next_.$last."</li>";
//next button
$pagination.= "</ul></nav></div></div>\n";	
}
echo $pagination;  
}
?>
<style>
  nav.center-text
  {
    background:none;
  }
  .current {
    background: none repeat scroll 0 0 #428bca !important;
    color: #fff !important;
  }
  .pagination {
    margin-bottom: 0;
    margin-top: 0;
  }
</style>
<script type="text/javascript">
  function getPhotoReq(frmid)
  {
    $("#myModal2").html("Please wait...");
    $.get("./web-services/reply_photo_pass.php?frmid="+frmid,
          function(data){
      $("#myModal2").html(data);
    }
         );
  }
</script>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
