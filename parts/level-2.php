<?php
//include 'databaseConn.php';

$DatabaseCo = new DatabaseConn();
$l2=$DatabaseCo->dbLink->query("SELECT * FROM advertisement WHERE adv_level='level-2' AND status='APPROVED'  order by rand() limit 0,1");
$get_adv_l2 = mysqli_fetch_object($l2);
$get_adv_l2_count=mysqli_num_rows($l2);
?>
<?php if($get_adv_l2_count > 0){?>
<a href="<?php echo $get_adv_l2->adv_link; ?>" class="col-xs-16" target="_blank">
    <div class="row" style="max-width:250px !important;">
        <img src="advertise/<?php echo $get_adv_l2->adv_img; ?>" class="img-responsive" style="width:100%;max-height:600px !important;">
    </div>
</a>
<?php } ?>
