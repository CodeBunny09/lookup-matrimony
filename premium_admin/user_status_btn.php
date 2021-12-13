<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
if (isset($_POST['status'])) {
    $member_status         = $_POST['status'];
    $_SESSION['memstatus'] = $member_status;
} elseif (!isset($_SESSION['memstatus'])) {
    $member_status = '';
} else {
    $member_status = $_SESSION['memstatus'];
}
if ($member_status != '' && $member_status != 'Featured') {
    $a = "where status='" . $member_status . "'";
} else if ($member_status != '' && $member_status == 'Featured') {
    $a = "where fstatus='" . $member_status . "'";
} else {
    $a = '';
    
}
if (isset($_SESSION['search_gender'])) {
    if ($_SESSION['search_gender'] != '') {
        $b = "and gender='" . $_SESSION['search_gender'] . "'";
    }
} else {
    $b = "";
}
if (isset($_SESSION['search_keyword'])) {
    if ($_SESSION['search_keyword'] != '') {
        $c = "and ((email like '%" . $_SESSION['search_keyword'] . "%') OR (matri_id = '" . $_SESSION['search_keyword'] . "') OR (firstname like '%" . $_SESSION['search_keyword'] . "%') OR (lastname like '%" . $_SESSION['search_keyword'] . "%'))";
    }
} else {
    $c = "";
}
if (isset($_SESSION['search_country'])) {
    if ($_SESSION['search_country'] != '') {
        $d = "and country_id='" . $_SESSION['search_country'] . "'";
    }
} else {
    $d = "";
}
if (isset($_SESSION['search_state'])) {
    if ($_SESSION['search_state'] != '') {
        $e = "and state_id='" . $_SESSION['search_state'] . "'";
    }
} else {
    $e = "";
}
if (isset($_SESSION['search_city'])) {
    if ($_SESSION['search_city'] != '') {
        $f = "and city='" . $_SESSION['search_city'] . "'";
    }
} else {
    $f = "";
}
if (isset($_SESSION['search_religion'])) {
    if ($_SESSION['search_religion'] != '') {
        $g = "and religion='" . $_SESSION['search_religion'] . "'";
    }
} else {
    $g = "";
}
if (isset($_SESSION['search_caste'])) {
    if ($_SESSION['search_caste'] != '') {
        $h = "and caste='" . $_SESSION['search_caste'] . "'";
    }
} else {
    $h = "";
}
if ($b != '' || $c != '' || $d != '' || $e != '' || $f != '' || $g != '' || $h != '') {
    $get_active    = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where status='Active' $b $c $d $e $f $g $h "));
    $get_inactive  = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where status='Inactive' $b $c $d $e $f $g $h"));
   $get_paid      = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where status='Paid' $b $c $d $e $f $g $h"));
    $get_featured  = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where fstatus='Featured' $b $c $d $e $f $g $h"));
    $get_suspended = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where status='Suspended' $b $c $d $e $f $g $h"));
    $get_all       = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where 1=1 $b $c $d $e $f $g $h"));
} else {
    $get_active    = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where status='Active'"));
    $get_inactive  = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where status='Inactive'"));
   $get_paid      = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where status='Paid'"));
    $get_featured  = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where fstatus='Featured'"));
    $get_suspended = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view where status='Suspended'"));
    $get_all       = mysqli_num_rows($DatabaseCo->dbLink->query("select index_id from register_view"));
}
?>
<div class="row">
<div class="col-lg-2 col-xs-12 col-md-4">
   <a class="btn btn-danger btn-lg btn-block" onClick="memstatus('Active');" id="Active">
   		Active <span class="badge"><?php echo $get_active; ?></span>
   </a>
</div>
<div class="col-lg-2 col-xs-12 col-md-4">
   <a class="btn btn-danger btn-lg btn-block" onClick="memstatus('Paidfilter');" id="Paid">
   Paid <span class="badge"><?php echo $get_paid; ?></span>
   </a>
</div>
<div class="col-lg-2 col-xs-12 col-md-4">
   <a class="btn btn-danger btn-lg btn-block" onClick="memstatus('Featured');" id="Featured">
   Featured <span class="badge"><?php echo $get_featured; ?></span>
   </a>
</div>
<div class="col-lg-2 col-xs-12 col-md-4">
   <a class="btn btn-danger btn-lg btn-block" onClick="memstatus('Inactive');" id="Inactive">
   Inactive <span class="badge"><?php echo $get_inactive; ?></span>
   </a>
</div>
<div class="col-lg-2 col-xs-12 col-md-4">
   <a class="btn btn-danger btn-lg btn-block" onClick="memstatus('Suspended');" id="Suspended">
   Suspended <span class="badge"><?php echo $get_suspended; ?></span>
   </a>
</div>
<div class="col-lg-2 col-xs-12 col-md-4">
   <a class="btn btn-danger btn-lg btn-block" onClick="memstatus('All');" id="All">
   All <span class="badge"><?php echo $get_all; ?></span>
   </a>
</div>
</div>