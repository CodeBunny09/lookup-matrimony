<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
?>
<?php
if(isset($_POST['msg_status']) && $_POST['msg_status']=='replay_msg')
{
echo "<script>window.location='composeMessages?msg_id=".$_POST['msg_id']."&inb=1'</script>";	
}
if(isset($_POST['msg_status']) && $_POST['msg_status']=='forward_msg')
{
echo "<script>window.location='composeMessages?msg_id=".$_POST['msg_id']."&frwd=1'</script>";	
}
if(isset($_POST['msg_status']) && $_POST['msg_status']=='trash')	
{
$msg_id=explode(",",$_POST['msg_id']);
foreach($msg_id as $key=>$value)
{
$DatabaseCo->dbLink->query("update messages set msg_status='trash' and trash_receiver='Yes' where mes_id='".$value."'");
}
echo "<script>alert('Your messages trash action complete successfully.');</script>";
echo "<script>window.location='inboxMessages';</script>";
}
if(isset($_POST['msg_status']) && $_POST['msg_status']=='important')	
{
$msg_id=explode(",",$_POST['msg_id']);
foreach($msg_id as $key=>$value)
{
$DatabaseCo->dbLink->query("update messages set msg_important_status='Yes' where mes_id='".$value."'");
}
echo "<script>alert('Your messages important action complete successfully.');</script>";
}
if(isset($_POST['msg_important_status']) && $_POST['msg_important_status']=='No')
{
$DatabaseCo->dbLink->query("update messages set msg_important_status='No' where mes_id='".$_POST['msg_id']."'");
echo "<script>alert('Your messages important action complete successfully.');</script>";
}
if(isset($_POST['msg_important_status']) && $_POST['msg_important_status']=='Yes')
{
$DatabaseCo->dbLink->query("update messages set msg_important_status='Yes' where mes_id='".$_POST['msg_id']."'");
echo "<script>alert('Your messages important action complete successfully.');</script>";
}
if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='read')
{
$get_msg=$DatabaseCo->dbLink->query("select * from messages where to_id='".$_SESSION['user_id']."' and msg_read_status='Yes' and msg_status='sent' and trash_receiver='No' order by mes_id desc");
}
else if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='unread')
{
$get_msg=$DatabaseCo->dbLink->query("select * from messages where to_id='".$_SESSION['user_id']."' and msg_read_status='No' and msg_status='sent' and trash_receiver='No' order by mes_id desc");
}
else if(isset($_POST['msg_read_type']) && $_POST['msg_read_type']=='read_all')
{
$get_msg=$DatabaseCo->dbLink->query("select * from messages where to_id='".$_SESSION['user_id']."' and msg_status='sent' and trash_receiver='No' order by mes_id desc");	
}
else
{
$get_msg=$DatabaseCo->dbLink->query("select * from messages where to_id='".$_SESSION['user_id']."' and msg_status='sent' and trash_receiver='No' order by mes_id desc");	
}
if(mysqli_num_rows($get_msg)>0)
{									
?>
<form method="post" action="" id="msg_data_form">
  <ul class="list">
    <?php
		while($DatabaseCo->dbRow = mysqli_fetch_object($get_msg))							{
	?>
    <?php include "parts/main_msg_inbox.php" ;?>
    <?php
}
?>
  </ul>
</form>
<?php
}
else{
?>
<form method="post" action="" id="msg_data_form">
  <ul class="list"  >
    <div class="thumbnail">
      <img src="img/nodata-available.jpg">
    </div>
  </ul>  
</form>
<?php 
}
?>                       
