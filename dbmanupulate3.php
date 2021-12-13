<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$SQL_STATEMENT_USERSETTING=$DatabaseCo->dbLink->query("SELECT username_setting FROM site_config WHERE id='1'");
$username_settings=mysqli_fetch_object($SQL_STATEMENT_USERSETTING);
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
$mid = $_SESSION['user_id'];
if(isset($_POST['result_status']) && $_POST['result_status']=='shortlist')
{
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * from register_view JOIN shortlist ON shortlist.to_id=register_view.matri_id where from_id='$mid'"));
$sql = "SELECT * from register_view JOIN shortlist ON shortlist.to_id=register_view.matri_id where from_id='$mid' order by fstatus desc LIMIT $start, $limit";  
}
if(isset($_POST['result_status']) && $_POST['result_status']=='blocklist')
{
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * from register_view JOIN block_profile ON block_profile.block_to=register_view.matri_id where block_by='$mid'"));
$sql = "SELECT * from register_view JOIN block_profile ON block_profile.block_to=register_view.matri_id where block_by='$mid' order by fstatus desc LIMIT $start, $limit";  
}
if(isset($_POST['result_status']) && $_POST['result_status']=='memvisitedme')
{
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.my_id=register_view.matri_id where who_viewed_my_profile.viewed_member_id='$mid'"));
$sql = "SELECT * FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.my_id=register_view.matri_id where who_viewed_my_profile.viewed_member_id='$mid' order by fstatus desc LIMIT $start, $limit";  
}
if(isset($_POST['result_status']) && $_POST['result_status']=='ivisitedmem')
{
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.viewed_member_id=register_view.matri_id where who_viewed_my_profile.my_id='$mid'"));
$sql = "SELECT * FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.viewed_member_id=register_view.matri_id where who_viewed_my_profile.my_id='$mid' order by fstatus desc LIMIT $start, $limit";  
}
if(isset($_POST['result_status']) && $_POST['result_status']=='watch_mobileno')
{
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM contact_view JOIN register_view ON contact_view.my_id=register_view.matri_id where contact_view.viewed_mem_id='$mid'"));
$sql = "SELECT * FROM contact_view JOIN register_view ON contact_view.my_id=register_view.matri_id where contact_view.viewed_mem_id='$mid' order by fstatus desc LIMIT $start, $limit";  
}
$data = $DatabaseCo->dbLink->query($sql);
?>
<script type="text/javascript">
  function save_search()
  {
    $('#txt_saved_search_name').val('');
    $("#div_saved_search").show();
    $("#div_success").hide();
  }
  $(document).ready(function(e) {
    $('#sub_saved_search').click( function(){
      if($('#txt_saved_search_name').val()==''){
        alert('Please fill up the saved search name.');
        return false;
      }
      else{
        var txt_saved_search_nm=$('#txt_saved_search_name').val();
        $.ajax
        ({
          type: "POST",
          url: "saved_search_query",
          data: 'saved_nm='+txt_saved_search_nm,
          success: function(data)
          {
            $("#div_saved_search").hide();
            $('#sub_saved_search').hide();
            $("#div_success").show();
            $("#div_success").html(data);
          }
        }
        );
      }
    }
                                );
  }
                   );
</script>        
<div class="alert alert-info" role="alert">
  <div class="row">
    <div class="col-xxl-16 col-xs-16">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;
        </span>
      </button>
    </div>
    <div class="col-xxl-16 col-xs-16">
      <h4 class="">
        <i class="fa fa-star gt-text-blue gt-margin-right-10">
        </i>Spotlight Profile
      </h4>
      <p>
        Blue color profile is are spotlight profile which was showing top of the search result.Its gives 10 times faster results.
      </p>
      <p>
        <span style="color:red;">
          <b>
            <?php echo $rows;?>
          </b>
        </span> Profiles found 
      </span>
    </p>
</div>
</div>
</div>    
<?php
if($rows >0)
{
pagination($limit,$adjacent,$rows,$page);  
function ageDOB($y,$m,$d){ /* $y = year, $m = month, $d = day */
date_default_timezone_set("Asia/Jakarta"); /* can change with others time zone */
$ageY = date("Y")-intval($y);
$ageM = date("n")-intval($m);
$ageD = date("j")-intval($d);
if ($ageD < 0){
$ageD = $ageD += date("t");
$ageM--;
}
if ($ageM < 0){
$ageM+=12;
$ageY--;
}
if ($ageY < 0){ $ageD = $ageM = $ageY = -1; }
return array( 'y'=>$ageY, 'm'=>$ageM, 'd'=>$ageD );
}
while( $Row = mysqli_fetch_object($data))
{
include "parts/main-result.php";
}
pagination($limit,$adjacent,$rows,$page);  
}else
{ ?>
<div class="">
  <div class="thumbnail">
    <img src="img/nodata-available.jpg">
  </div>
</div>
<?php  }
?>
<div class="modal fade-in" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>  
<div class="modal fade-in" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>   
<div class="modal fade-in" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>   
<div class="modal fade-in" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>   
<script src="js/function.js" type="text/javascript">
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <form name="saved_search_form" id="saved_search_form" method="post" action="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;
            </span>
          </button>
          <h4 class="modal-title" id="myModalLabel">
            Saved Search
          </h4>
        </div>
        <div class="modal-body" id="div_saved_search">
          <h5 class="margin-bottom-15px" style="text-align:justify;">
          </h5>
          Saved Search Name :
          <div class="">
            <input type="text" name="txt_saved_search_name" id="txt_saved_search_name" class="form-control">
          </div>
        </div>
        <div class="modal-body" id="div_success">
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default pull-right" data-dismiss="modal" value="Close">
          <input type="button" class="btn btn-default pull-right"  id="sub_saved_search" value="Submit">
        </div>
      </form>
      <div class="clearfix">
      </div>
    </div>
  </div>
</div> 
<?php
}
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
</style>
