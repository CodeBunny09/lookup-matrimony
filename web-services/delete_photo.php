<?php 
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mid=$_SESSION['user_id'];
if(isset($_POST['photo_id'])){
$var_img='photo'.$_POST['photo_id'].'';
$get_img_name=mysqli_fetch_array($DatabaseCo->dbLink->query("select ".$var_img." from register where matri_id='$mid'"));
unlink("../my_photos/".$get_img_name[0]);
unlink("../my_photos_big/".$get_img_name[0]);
$photo_approve=$var_img.'_approve';
$DatabaseCo->dbLink->query("update register set $var_img='',$photo_approve='UNAPPROVED' where matri_id='$mid'");
$_SESSION['photo1']='';
}
?>
