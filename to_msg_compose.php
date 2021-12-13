<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once 'auth.php';
include_once './class/Config.class.php';
$configObj = new Config();
if(isset($_POST['user_id']) && $_POST['msg_status']=='sent_msg'){
$get_arr_username_email = $DatabaseCo->dbLink->query("select username,email,matri_id from register where matri_id='".$_POST['user_id']."'");
while($get_msg_data = mysqli_fetch_object($get_arr_username_email)){
?>
<option value="<?php echo $get_msg_data->email; ?>" selected>
  <?php echo $get_msg_data->matri_id; ?>
</option>  
<?php 	
}
}
if(isset($_POST['msg_id']) && $_POST['msg_status']=='replay_msg')
{
$get_arr_matri_email = mysqli_fetch_object($DatabaseCo->dbLink->query("select msg.to_id as matri_id from messages msg where msg.mes_id='".$_POST['msg_id']."'"));
$get_user_email = $DatabaseCo->dbLink->query("select username,email,matri_id from register where matri_id='".$get_arr_matri_email->matri_id."'");
while($get_msg_data = mysqli_fetch_object($get_user_email)){
?>
<option value="<?php echo $get_msg_data->email; ?>" selected>
  <?php echo $get_msg_data->matri_id; ?>
</option>  
<?php 	
}
}
if(isset($_POST['msg_id']) && $_POST['msg_status']=='forward_msg')
{	
$get_arr_username_email = $DatabaseCo->dbLink->query("select message from messages where mes_id='".$_POST['msg_id']."'");
while($get_msg_data = mysqli_fetch_object($get_arr_username_email))
{
echo htmlspecialchars_decode($get_msg_data->message);		
}
}
if(isset($_POST['msg_id']) && $_POST['msg_status']=='replay_msg_inbox'){	
//$get_arr_username_email = $DatabaseCo->dbLink->query("select msg.msg_from as email from message msg where msg.msg_id='".$_POST['msg_id']."'");
$get_arr_matri_email = mysqli_fetch_object($DatabaseCo->dbLink->query("select msg.from_id as matri_id from messages msg where msg.mes_id='".$_POST['msg_id']."'"));
$get_user_email = $DatabaseCo->dbLink->query("select username,email,matri_id from register where matri_id='".$get_arr_matri_email->matri_id."'");
while($get_msg_data = mysqli_fetch_object($get_user_email)){
?>
<option value="<?php echo $get_msg_data->email; ?>" selected>
  <?php echo $get_msg_data->matri_id; ?>
</option>  
<?php
}
}	
?>    
