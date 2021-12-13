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
$sel="select * from register_view where email='$mid' or matri_id='$mid'";
$query=$DatabaseCo->dbLink->query($sel)or die(mysqli_error($DatabaseCo->dbLink));
$row=mysqli_fetch_array($query);
if(isset($_POST['result_status']) && $_POST['result_status']=='one_way'){
	
$cou=$row['part_country_living'];
$rel=$row['part_religion'];
$look=$row['looking_for'];
$caste=$row['part_caste'];
$e=$row['part_frm_age'];
$f=$row['part_to_age'];
$g=$row['gender'];
	
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id FROM register_view where country_id IN('$cou') AND religion IN ('$rel') AND caste IN ($caste) AND looking_for='$look' AND  gender!='$g' AND ((
(
date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
)
BETWEEN '$e'
AND '$f')"));
	
$sql = "select * from register_view where country_id IN('$cou') AND religion IN ('$rel') AND caste IN ($caste) AND gender!='$g' AND ((
(
date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
)
BETWEEN '$e'
AND '$f') order by fstatus desc LIMIT $start, $limit";  
}

	
if(isset($_POST['result_status']) && $_POST['result_status']=='two_way')
{
$edu=$row['edu_detail'];
$edu_array=explode(',',$edu);
$edu_main=$edu_array[0];
$con=$row['country_id'];
$rel=$row['religion'];
$gen=$row['gender'];
$caste=$row['caste'];
$mat=$row['m_status'];
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id FROM register_view WHERE gender!='$gen' AND (find_in_set($edu_main, part_edu) > 0) AND country_id='$con' and religion='$rel' and caste='$caste' and m_status='$mat'"));
$sql = "SELECT * FROM register_view WHERE gender!='$gen' AND (find_in_set($edu_main, part_edu) > 0)  and country_id='$con' and religion='$rel' and caste='$caste' and m_status='$mat' order by fstatus desc LIMIT $start, $limit";  
}
	
	
if(isset($_POST['result_status']) && $_POST['result_status']=='broader')
{		
$con=$row['country_id'];
$rel=$row['religion'];               
$gen=$row['gender'];
	
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id FROM register_view where (find_in_set($con, part_country_living) > 0) AND (find_in_set($rel, part_religion) > 0) AND gender!='$gen'"));
$sql = "select * from register_view where (find_in_set($con, part_country_living) > 0) AND (find_in_set($rel, part_religion) > 0) AND gender!='$gen' order by fstatus desc LIMIT $start, $limit"; 
}
	
if(isset($_POST['result_status']) && $_POST['result_status']=='preferred')
{		
$edu=$row['edu_detail'];
$edu_array=explode(',',$edu);
$edu_main=$edu_array[0];

$hei=$row['height'];
$con=$row['country_id'];
$rel=$row['religion'];
$e=$row['birthdate'];
$gen=$row['gender'];
$caste=$row['caste'];
$mat=$row['m_status'];
$current_date = date('Y-m-d'); //today is 2011-10-04
$diff_in_mill_seconds = strtotime($current_date) - strtotime($e);
$age = floor($diff_in_mill_seconds / (365.2425 *60*60*24)) + 1;
$age;	
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id FROM register_view where (find_in_set($con, part_country_living) > 0) AND part_height<='$hei' AND (find_in_set($rel, part_religion) > 0) AND (find_in_set($edu_main, part_edu) > 0) AND gender!='$gen' AND (find_in_set($caste, part_caste) > 0) AND part_frm_age<=$age"));
 $sql = "select * from register_view where (find_in_set($con, part_country_living) > 0) AND part_height<='$hei' AND (find_in_set($rel, part_religion) > 0) AND (find_in_set($edu_main, part_edu) > 0) AND gender!='$gen' AND (find_in_set($caste, part_caste) > 0) AND part_frm_age<=$age order by fstatus desc LIMIT $start, $limit"; 
}
	
if(isset($_POST['result_status']) && $_POST['result_status']=='custom')
{		
$SQL_STATEMENT_match = "select * from matches where matri_id='$mid'";
$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
$education=$DatabaseCo->dbRow->part_edu;
$m_status=str_ireplace(", ","','",$DatabaseCo->dbRow->looking_for);
$t3=$DatabaseCo->dbRow->part_frm_age;
$t4=$DatabaseCo->dbRow->part_to_age;
$fromheight=$DatabaseCo->dbRow->part_height;
$toheight=$DatabaseCo->dbRow->part_height_to;
$rel=$DatabaseCo->dbRow->part_religion;
$caste=$DatabaseCo->dbRow->part_caste;
$m_tongue=$DatabaseCo->dbRow->part_mtongue;
$complexion=str_ireplace(", ","','",$DatabaseCo->dbRow->part_complexation);
$country=$DatabaseCo->dbRow->part_country_living;

if($m_status!='Any' && $m_status!='')
{
$h= "and m_status IN ('$m_status')";				
}
else
{
$h="";	
}
if($t3!='' && $t4!='')
{
$a="AND ((
(
date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
)
BETWEEN '$t3'
AND '$t4')";	
}
else
{
$a="";	
}	
if($fromheight!='' && $toheight!='')
{
$b="and height between '$fromheight' and '$toheight'";	
}
else
{
$b="";	
}
if($rel!='')
{
$c= "and religion IN ($rel)";				
}
else
{
$c="";	
}
if($caste!='')
{
$d="and caste IN ($caste)";
}
else
{
$d='';	
}
if($m_tongue!='')
{
$e="and m_tongue IN ($m_tongue)";
}	
else
{
$e="";	
}
if($education!='' && $education!='89')
{
$search_array3 = explode(',',$education);
global $d1;
foreach ($search_array3 as $value3)
{
$d1.="(find_in_set($value3, edu_detail) > 0) or ";
}
$d2=rtrim($d1, "or ");
$f="and ($d2)";
}
else
{
$f="";
}
if($country!='')
{
$g="and country_id IN ($country)";
}
else
{
$g="";	
}
if($complexion!='')
{
$j="and complexion IN ('$complexion')";
}
else
{
$j='';
}


$rows = mysqli_num_rows($DatabaseCo->dbLink->query("select matri_id from register_view where  status!='Inactive' and status!='Suspended' and gender!='".$_SESSION['gender123']."' $a $b $c $d $e $f $g $h  $j"));
$sql = "select * from register_view where  status!='Inactive' and status!='Suspended' and gender!='".$_SESSION['gender123']."' $a $b $c $d $e $f $g $h $j order by fstatus desc  limit $start,$limit";  
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
$sql_exp=mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM expressinterest,register_view WHERE ei_receiver='".$Row->matri_id."' and ei_sender='".$_SESSION['user_id']."' and trash_sender='No'"));
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
    <div class="modal-content ">
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
          
          Saved Search Name :
          <div class="">
            <input type="text" name="txt_saved_search_name" id="txt_saved_search_name" class="form-control">
          </div>
        </div>
        <div class="modal-body " id="div_success">
        </div>
        <div class="modal-footer ">
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