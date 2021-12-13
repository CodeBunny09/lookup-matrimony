<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$SQL_STATEMENT_USERSETTING=$DatabaseCo->dbLink->query("SELECT username_setting FROM site_config WHERE id='1'");
$username_settings=mysqli_fetch_object($SQL_STATEMENT_USERSETTING);
if (isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction'] != '') {
$page = $_REQUEST['page'];
$limit = 8;
$adjacent = 2;
	
if (isset($_POST['religion']) && $_POST['religion'] != 'null') {
$rel = $_POST['religion'];
$_SESSION['religion'] = $rel;
} elseif ((isset($_POST['religion']) && $_POST['religion'] == 'null')) {
$rel = '';
$_SESSION['religion'] = $rel;
} else {
$rel = $_SESSION['religion'];
}
	
if (isset($_POST['caste']) && $_POST['caste'] != 'null') {
$caste = $_POST['caste'];
$_SESSION['caste'] = $caste;
} elseif ((isset($_POST['caste']) && $_POST['caste'] == 'null')) {
$caste = '';
$_SESSION['caste'] = $caste;
} else {
$caste = $_SESSION['caste'];
}
	
if (isset($_POST['occupation']) && $_POST['occupation'] != 'null') {
$occ = $_POST['occupation'];
$_SESSION['occupation'] = $occ;
} elseif ((isset($_POST['occupation']) && $_POST['occupation'] == 'null')) {
$occ = '';
$_SESSION['occupation'] = $occ;
} else {
$occ = $_SESSION['occupation'];
}
if (isset($_POST['gender']) && $_POST['gender'] != '') {
$gender = $_POST['gender'];
$_SESSION['gender'] = $gender;
} elseif (isset($_SESSION['gender123']) && $_SESSION['gender123'] != '') {
if ($_SESSION['gender123'] == 'Male') {
$gender = 'Female';
} else {
$gender = 'Male';
}
} else {
$gender = $_SESSION['gender'];
}
if (isset($_POST['t3']) && $_POST['t3'] != 'null') {
$t3 = $_POST['t3'];
$_SESSION['fromage'] = $t3;
} elseif ((isset($_POST['t3']) && $_POST['t3'] == 'null')) {
$t3 = '';
$_SESSION['fromage'] = $t3;
} else {
$t3 = $_SESSION['fromage'];
}
if (isset($_POST['t4']) && $_POST['t4'] != 'null') {
$t4 = $_POST['t4'];
$_SESSION['toage'] = $t4;
} elseif ((isset($_POST['t4']) && $_POST['t4'] == 'null')) {
$t4 = '';
$_SESSION['toage'] = $t4;
} else {
$t4 = $_SESSION['toage'];
}
if (isset($_POST['country']) && $_POST['country'] != 'null') {
$con = $_POST['country'];
$_SESSION['country'] = $con;
} elseif ((isset($_POST['country']) && $_POST['country'] == 'null')) {
$con = '';
$_SESSION['country'] = $con;
} else {
$con = $_SESSION['country'];
}
if (isset($_POST['state']) && $_POST['state'] != 'null') {
$state = $_POST['state'];
$_SESSION['state'] = $state;
} elseif ((isset($_POST['state']) && $_POST['state'] == 'null')) {
$state = '';
$_SESSION['state'] = $state;
} else {
$state = $_SESSION['state'];
}
if (isset($_POST['city']) && $_POST['city'] != 'null') {
$city = $_POST['city'];
$_SESSION['city'] = $city;
} elseif ((isset($_POST['city']) && $_POST['city'] == 'null')) {
$city = '';
$_SESSION['city'] = $city;
} else {
$city = $_SESSION['city'];
}
if (isset($_POST['m_status']) && $_POST['m_status'] != 'null') {
$m_status = str_replace(",", "','", $_POST['m_status']);
$_SESSION['m_status'] = $m_status;
} else if (isset($_POST['m_status']) && $_POST['m_status'] == 'null') {
$m_status = '';
$_SESSION['m_status'] = $m_status;
} else {
$m_status = $_SESSION['m_status'];
}
if (isset($_POST['physical_status']) && $_POST['physical_status'] != 'null') {
$physical_status = str_replace(",", "','", $_POST['physical_status']);
$_SESSION['physical_status'] = $physical_status;
} else if (isset($_POST['physical_status']) && $_POST['physical_status'] == 'null') {
$physical_status = '';
$_SESSION['physical_status'] = $physical_status;
} else {
$physical_status = $_SESSION['physical_status'];
}
if (isset($_POST['m_tongue']) && $_POST['m_tongue'] != 'null') {
$m_tongue = $_POST['m_tongue'];
$_SESSION['m_tongue'] = $m_tongue;
} elseif ((isset($_POST['m_tongue']) && $_POST['m_tongue'] == 'null')) {
$m_tongue = '';
$_SESSION['m_tongue'] = $m_tongue;
} else {
$m_tongue = $_SESSION['m_tongue'];
}
if (isset($_POST['education']) && $_POST['education'] != 'null') {
$education = $_POST['education'];
$_SESSION['education'] = $education;
} elseif ((isset($_POST['education']) && $_POST['education'] == 'null')) {
$education = '';
$_SESSION['education'] = $education;
} else {
$education = $_SESSION['education'];
}
if (isset($_POST['fromheight']) && $_POST['fromheight'] != 'null') {
$fromheight = $_POST['fromheight'];
$_SESSION['fromheight'] = $fromheight;
} elseif ((isset($_POST['fromheight']) && $_POST['fromheight'] == 'null')) {
$fromheight = '';
$_SESSION['fromheight'] = $fromheight;
} else {
$fromheight = $_SESSION['fromheight'];
}
if (isset($_POST['toheight']) && $_POST['toheight'] != 'null') {
$toheight = $_POST['toheight'];
$_SESSION['toheight'] = $toheight;
} elseif ((isset($_POST['toheight']) && $_POST['toheight'] == 'null')) {
$toheight = '';
$_SESSION['toheight'] = $toheight;
} else {
$toheight = $_SESSION['toheight'];
}
if (isset($_POST['photo_search']) && $_POST['photo_search'] != 'null') {
$photo = $_POST['photo_search'];
$_SESSION['photo_search'] = $photo;
} elseif ((isset($_POST['photo_search']) && $_POST['photo_search'] == 'null')) {
$photo = '';
$_SESSION['photo_search'] = $photo;
} else {
$photo = $_SESSION['photo_search'];
}
if (isset($_POST['profile_latest_register']) && $_POST['profile_latest_register'] != 'null') {
$profile_latest_register = $_POST['profile_latest_register'];
$_SESSION['profile_latest_register'] = $profile_latest_register;
} elseif ((isset($_POST['profile_latest_register']) && $_POST['profile_latest_register'] == 'null')) {
$profile_latest_register = '';
$_SESSION['profile_latest_register'] = $profile_latest_register;
} else {
$profile_latest_register = $_SESSION['profile_latest_register'];
}
if (isset($_POST['keyword']) && $_POST['keyword'] != 'null') {
$keyword = $_POST['keyword'];
$_SESSION['keyword'] = $keyword;
} elseif ((isset($_POST['keyword']) && $_POST['keyword'] == 'null')) {
$keyword = '';
$_SESSION['keyword'] = $keyword;
} else {
$keyword = $_SESSION['keyword'];
}
if (isset($_POST['orderby']) && $_POST['orderby'] != 'null') {
$orderby = $_POST['orderby'];
$_SESSION['orderby'] = $orderby;
} elseif ((isset($_POST['orderby']) && $_POST['orderby'] == 'null')) {
$orderby = '';
$_SESSION['orderby'] = $orderby;
} else {
$orderby = $_SESSION['orderby'];
}
if (isset($_POST['tot_children']) && $_POST['tot_children'] != 'null') {
$tot_children = $_POST['tot_children'];
$_SESSION['tot_children'] = $tot_children;
} elseif ((isset($_POST['tot_children']) && $_POST['tot_children'] == 'null')) {
$tot_children = '';
$_SESSION['tot_children'] = $tot_children;
} else {
$tot_children = $_SESSION['tot_children'];
}
if (isset($_POST['occupation']) && $_POST['occupation'] != 'null') {
$occupation = $_POST['occupation'];
$_SESSION['occupation'] = $occupation;
} elseif ((isset($_POST['occupation']) && $_POST['occupation'] == 'null')) {
$occupation = '';
$_SESSION['occupation'] = $occupation;
} else {
$occupation = $_SESSION['occupation'];
}
if (isset($_POST['annual_income']) && $_POST['annual_income'] != 'null') {
$annual_income = $_POST['annual_income'];
$_SESSION['annual_income'] = $annual_income;
} elseif ((isset($_POST['annual_income']) && $_POST['annual_income'] == 'null')) {
$annual_income = '';
$_SESSION['annual_income'] = $annual_income;
} else {
$annual_income = $_SESSION['annual_income'];
}
if (isset($_POST['diet']) && $_POST['diet'] != 'null') {
$diet = str_replace(",", "','", $_POST['diet']);
$_SESSION['diet'] = $diet;
} elseif ((isset($_POST['diet']) && $_POST['diet'] == 'null')) {
$diet = '';
$_SESSION['diet'] = $diet;
} else {
$diet = $_SESSION['diet'];
}
if (isset($_POST['drink']) && $_POST['drink'] != 'null') {
$drink = str_replace(",", "','", $_POST['drink']);
$_SESSION['drink'] = $drink;
} elseif ((isset($_POST['drink']) && $_POST['drink'] == 'null')) {
$drink = '';
$_SESSION['drink'] = $drink;
} else {
$drink = $_SESSION['drink'];
}
if (isset($_POST['smoking']) && $_POST['smoking'] != 'null') {
$smoking = str_replace(",", "','", $_POST['smoking']);
$_SESSION['smoking'] = $smoking;
} elseif ((isset($_POST['smoking']) && $_POST['smoking'] == 'null')) {
$smoking = '';
$_SESSION['smoking'] = $smoking;
} else {
$smoking = $_SESSION['smoking'];
}
if (isset($_POST['complexion']) && $_POST['complexion'] != 'null') {
$complexion = str_replace(",", "','", $_POST['complexion']);
$_SESSION['complexion'] = $complexion;
} elseif ((isset($_POST['complexion']) && $_POST['complexion'] == 'null')) {
$complexion = '';
$_SESSION['complexion'] = $complexion;
} else {
$complexion = $_SESSION['complexion'];
}
if (isset($_POST['bodytype']) && $_POST['bodytype'] != 'null') {
$bodytype = str_replace(",", "','", $_POST['bodytype']);
$_SESSION['bodytype'] = $bodytype;
} elseif ((isset($_POST['bodytype']) && $_POST['bodytype'] == 'null')) {
$bodytype = '';
$_SESSION['bodytype'] = $bodytype;
} else {
$bodytype = $_SESSION['bodytype'];
}
if (isset($_POST['star']) && $_POST['star'] != 'null') {
$star = str_replace(",", "','", $_POST['star']);
$_SESSION['star'] = $star;
} elseif ((isset($_POST['star']) && $_POST['star'] == 'null')) {
$star = '';
$_SESSION['star'] = $star;
} else {
$star = $_SESSION['star'];
}
if (isset($_POST['manglik']) && $_POST['manglik'] != 'null') {
$manglik = $_POST['manglik'];
$_SESSION['manglik'] = $manglik;
} elseif ((isset($_POST['manglik']) && $_POST['manglik'] == 'null')) {
$manglik = '';
$_SESSION['manglik'] = $manglik;
} else {
$manglik = isset($_SESSION['manglik']) ? $_SESSION['manglik'] : "";
}
	
if (isset($_POST['id_search']) && $_POST['id_search'] != 'null') {
$id_search = $_POST['id_search'];
$_SESSION['id_search'] = $id_search;
} elseif ((isset($_POST['id_search']) && $_POST['id_search'] == 'null')) {
$id_search = '';
$_SESSION['id_search'] = $id_search;
} else {
$id_search = $_SESSION['id_search'];
}
if ($page == 1) {
	$start = 0;
} else {
	$start = ($page - 1) * $limit;
}

if ($t3 != '' && $t4 != '') {
$a = "AND ((
( date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
)
BETWEEN '$t3'
AND '$t4')";
} else {
$a = '';
}
if ($gender != '') {
$b = "and gender='$gender'";
} else {
$b = '';
}
if ($rel != '') {
$c = "and religion IN ($rel)";
} else {
$c = '';
}
if ($caste != '') {
$d = "and caste IN ($caste)";
} else {
$d = '';
}
if ($m_tongue != '') {
$e = "and m_tongue IN ($m_tongue)";
} else {
$e = '';
}
if ($education != '') {
$f = "and edu_detail IN ($education)";
} else {
$f = '';
}
if ($occ != '') {
$g = "and occupation IN ($occ)";
} else {
$g = '';
}
if ($m_status != 'Any' && $m_status != '') {
$h = "and m_status IN ('$m_status')";
} else {
$h = '';
}
if ($con != '') {
$i = "and country_id IN ($con)";
} else {
$i = '';
}
if ($state != '') {
$j = "and state_id IN ($state)";
} else {
$j = '';
}
if ($city != '') {
$k = "and city IN ($city)";
} else {
$k = '';
}
if ($fromheight != '' and $toheight != '') {
$l = "and height between '$fromheight' and '$toheight'";
} else {
$l = '';
}
if ($keyword != '') {
$m = "and ((email like '%$keyword%') OR (matri_id = '$keyword') OR (firstname like '%$keyword%') OR (lastname like '%$keyword%'))";
} else {
$m = '';
}
if ($photo == 'Yes') {
$n = " and photo1!='' and photo1_approve='APPROVED' ";
} elseif ($photo == 'horoscope') {
$n = " and horoscope!='' and hor_check='APPROVED' ";
} else {
$n = '';
}
if ($orderby != '' && $orderby == 'register') {
$o = "order by reg_date DESC";
} else {
$o = '';
}
if ($orderby != '' && $orderby == 'login') {
$p = "order by last_login DESC";
} else {
$p = '';
}
if ($tot_children != '') {
$q = "and tot_children='$tot_children'";
} else {
$q = '';
}
if ($annual_income != '') {
$s = "and income='$annual_income'";
} else {
$s = '';
}
if ($diet != '') {
$t = "and diet IN ('$diet')";
} else {
$t = '';
}
if ($drink != '') {
$u = "and drink IN ('$drink')";
} else {
$u = '';
}
if ($smoking != '') {
$v = "and smoke IN ('$smoking')";
} else {
$v = '';
}
if ($complexion != '') {
$x = "and complexion IN ('$complexion')";

} else {
$x = '';
}
if ($bodytype != '') {
$y = "and bodytype IN ('$bodytype')";
} else {
$y = '';
}
if ($star != '') {
$z = "and star IN ('$star')";
} else {
$z = '';
}
	
if ($manglik == 'Yes') {
	$a1 = "and manglik !=''";
} elseif($manglik == 'No'){
$a1 = "and manglik =''";
} else{
	$a1 = '';
}	
/*if ($manglik != '') {
	$a1 = "and manglik='$manglik'";
} else {
	$a1 = '';
}*/
if ($id_search != '') {
$r = "and matri_id='$id_search'";
} else {
$r = '';
}
if ($profile_latest_register == '1') {
$d123 = 1;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123 . " day");
$exp_date = date('Y-m-d h:i:s', $date);
$aa = "and reg_date>'" . $exp_date . "'";
} elseif ($profile_latest_register == '2') {
$d123 = 3;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123 . " day");
$exp_date = date('Y-m-d h:i:s', $date);
$aa = "and reg_date >'" . $exp_date . "'";
} elseif ($profile_latest_register == '3') {
$d123 = 7;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123 . " day");
$exp_date = date('Y-m-d h:i:s', $date);
$aa = "and reg_date>'" . $exp_date . "'";
} elseif ($profile_latest_register == '4') {
$d123 = 30;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123 . " day");
$exp_date = date('Y-m-d h:i:s', $date);
$aa = "and reg_date>'" . $exp_date . "'";
} else {
$aa = '';
}
if ($physical_status != '') {
$ab = "and physicalStatus IN ('$physical_status')";
} else {
$ab = "";
}
	
$rows = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where  status!='Inactive' and status!='Suspended' $a $b $c $d $e $f $g $h $i $j $k $l $m $n $q $s $t $u $v $x $y $z $aa $ab $a1 $r $o $p"));
$sql = "select firstname,lastname,username,photo1,photo1_approve,photo_protect,matri_id,photo_pswd,gender,email,status,hor_photo,hor_check,video,video_url,profile_text,video_approval,birthdate,height,religion_name,caste_name,last_login,country_name,state_name,ocp_name,logged_in,index_id,fstatus,profileby,city_name,country_name,state_name,photo_view_status,reg_date from register_view where status!='Inactive' and status!='Suspended' $a $b $c $d $e $f $g $h $i $j $k $l $m $n $q $s $t $u $v $x $y $z $aa $ab $a1 $r $o $p order by fstatus desc limit $start,$limit";
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
    $('#sub_saved_search').click(function() {
      if ($('#txt_saved_search_name').val() == '') {
        alert('Please fill up the saved search name.');
        return false;
      }
      else {
        var txt_saved_search_nm = $('#txt_saved_search_name').val();
        $.ajax
        ({
          type: "POST",
          url: "saved_search_query",
          data: 'saved_nm=' + txt_saved_search_nm,
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
<div class="alert alert-warning" role="alert">
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
        Blue Header profile is are spotlight profile which was showing top of the search result.Its gives 10 times faster results.
      </p>
      <p>
        <span style="color:red;">
          <b>
            <?php echo $rows; ?>
          </b>
        </span> Profiles found :
        <span class="text-muted gt-margin-left-10">
          <?php if ($t3 != '' &&  $t4 != '') { ?>
         	Age- 
          <?php echo $t3; ?> to 
          <?php echo $t4; }?> 
          <?php if ($fromheight != '' && $toheight != '') { ?>
          ,height-
          <?php echo $fromheight; ?> to 
          <?php echo $toheight; } ?>
          <?php /*?><?php if ($rel != '' ) { ?>
         	Religion- 
          <?php echo $rel; }?> <?php */?>
        </span>
      </p>
      <?php if (isset($_SESSION['user_id'])) { ?>
      <a data-toggle="modal" data-target="#myModal" onClick="save_search();" class="btn gt-btn-green gt-cursor">
        Add To Saved Search
      </a>
      <?php } ?>
    </div>
  </div>
</div>  
<div class="col-xs-16 text-right">
  <div class="buttons">
    <button class="grid btn gt-btn-green">
      <i class="fa fa-list gt-margin-right-5">
      </i>Grid View
    </button>
    <button class="list btn gt-btn-green">
      <i class="fa fa-th gt-margin-right-5">
      </i>List View
    </button>
  </div>
</div>
<div class="clearfix">
  <script>
    $('button').on('click', function(e) {
      if ($(this).hasClass('grid')) {
        $('#result ul').removeClass('list').addClass('grid');
      }
      else if ($(this).hasClass('list')) {
        $('#result ul').removeClass('grid').addClass('list');
      }
    }
                  );
  </script>
  <?php
if ($rows > 0) {
pagination($limit, $adjacent, $rows, $page);
function ageDOB($y, $m, $d) { /* $y = year, $m = month, $d = day */
date_default_timezone_set("Asia/Jakarta"); /* can change with others time zone */
$ageY = date("Y") - intval($y);
$ageM = date("n") - intval($m);
$ageD = date("j") - intval($d);
if ($ageD < 0) {
$ageD = $ageD += date("t");
$ageM--;
}
if ($ageM < 0) {
$ageM+=12;
$ageY--;
}
if ($ageY < 0) {
$ageD = $ageM = $ageY = -1;
}
return array('y' => $ageY, 'm' => $ageM, 'd' => $ageD);
}
while ($Row = mysqli_fetch_object($data)) {
if (isset($_SESSION['user_id'])) {
$sql_exp = mysqli_fetch_object($DatabaseCo->dbLink->query("SELECT * FROM expressinterest,register_view WHERE ei_receiver='" . $Row->matri_id . "' and ei_sender='" . $_SESSION['user_id'] . "' and trash_sender='No'"));
} else {
$sql_exp = "";
}
include "parts/main-result.php";
}
pagination($limit, $adjacent, $rows, $page);
} else {
?>
  <div class="col-xs-16">
    <div class="thumbnail">
      <img src="img/nodata-available.jpg">
    </div>
  </div>
  <?php }
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
    <div class="modal-dialog modal-sm">
      <div class="modal-content ">
        <form name="saved_search_form" id="saved_search_form" method="post" action="">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;
              </span>
            </button>
            <h4 class="modal-title" id="myModalLabel">
              Save Search
            </h4>
          </div>
          <div class="modal-body" id="div_saved_search">
      		<label>
      			Saved Search Name :
      		</label>
            <div class="form-group">
              <input type="text" name="txt_saved_search_name" id="txt_saved_search_name" class="gt-form-control">
            </div>
          </div>
          <div class="modal-body" id="div_success"></div>
          <div class="modal-footer">
            <input type="button" class="btn gt-btn-orange"  id="sub_saved_search" value="Submit">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
          </div>
        </form>
        <div class="clearfix"></div>
      </div>
    </div>
  </div> 
  <?php
}
function pagination($limit, $adjacents, $rows, $page) {
$pagination = '';
if ($page == 0)
$page = 1;     //if no page var is given, default to 1.
$prev = $page - 1;       //previous page is page - 1
$next = $page + 1;       //next page is page + 1
$prev_ = '';
$first = '';
$lastpage = ceil($rows / $limit);
$next_ = '';
$last = '';
if ($lastpage > 1) {
if ($page > 1)
$prev_.= "<a class='page-numbers' href=\"?page=$prev\">&lt;&lt;</a>";
else {
//$pagination.= "<span class=\"disabled\">previous</span>";	
}
//pages	
if ($lastpage < 5 + ($adjacents * 2)) { //not enough pages to bother breaking it up
$first = '';
for ($counter = 1; $counter <= $lastpage; $counter++) {
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
}
$last = '';
}
elseif ($lastpage > 3 + ($adjacents * 2)) { //enough pages to hide some
//close to beginning; only hide later pages
$first = '';
if ($page < 1 + ($adjacents * 2)) {
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
}
$last.= "<a class='page-numbers' href=\"?page=$lastpage\">&gt;&gt; &gt;&gt;</a>";
}
//in middle; hide some front and some back
elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
$first.= "<a class='page-numbers' href=\"?page=1\">&lt;&lt; &lt;&lt;</a>";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
}
$last.= "<a class='page-numbers' href=\"?page=$lastpage\">&gt;&gt; &gt;&gt;</a>";
}
//close to end; only hide early pages
else {
$first.= "<a class='page-numbers' href=\"?page=1\">&lt;&lt; &lt;&lt;</a>";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
}
$last = '';
}
}
if ($page < $counter - 1)
$next_.= "<a class='page-numbers' href=\"?page=$next\">&gt;&gt;</a>";
else {
//$pagination.= "<span class=\"disabled\">next</span>";
}
$pagination = "<div class='text-center'><div class='row'><nav class=''>
<ul class=\"pagination\"><li>"
. $first . "</li><li>" . $prev_ . $pagination . "</li><li>" . $next_ . $last . "</li>";
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