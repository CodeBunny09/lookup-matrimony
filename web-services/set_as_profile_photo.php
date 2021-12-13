<?php 
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();

$mid=$_SESSION['user_id'];

if(isset($_POST['photo_id']))
{

$var_img='photo'.$_POST['photo_id'].'';

$get_img_name=mysqli_fetch_array($DatabaseCo->dbLink->query("select ".$var_img.",photo1 from register where matri_id='$mid'"));

$set_as_profile_pic=$get_img_name[0]; 
$replace_profile_pic=$get_img_name['photo1'];	

$DatabaseCo->dbLink->query("update register set $var_img='".$replace_profile_pic."',photo1='".$set_as_profile_pic."' where matri_id='$mid'");

$_SESSION['photo1']=$set_as_profile_pic;

$_SESSION[$var_img]=$replace_profile_pic;

}
?>