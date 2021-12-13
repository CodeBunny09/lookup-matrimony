<?php 
error_reporting(0);
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$ACTION = isset($_REQUEST['action']) ? $_REQUEST['action'] :"" ;
$sample='';
$siteimage_new='';
$fvicon_new ='';
$errorFlag = false;
$erroMessage = "";
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{		
$maxsize    = 2097152;
$acceptable = array(
'image/jpeg',
'image/jpg',
'image/gif',
'image/png');
if(isset($_REQUEST['sub_add_logo']))
{			
if(@is_uploaded_file($_FILES["siteimage"]["tmp_name"]))
{
if(!in_array($_FILES['siteimage']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid <b>Logo image</b> file type. Only JPEG,JPG,GIF and PNG types are accepted.</li>";
$errorFlag = true;
}
else if($_FILES['siteimage']['size']>=$maxsize || $_FILES['siteimage']['size'] == 0)
{
$erroMessage .= "<li><b>Logo image</b> size to large .</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$siteimage=$_FILES['siteimage']['name'];
$siteimage_new = str_replace(" ","-",$siteimage);
unlink("../img/".$_REQUEST['logo_photo']);
$upload_siteimage=copy($_FILES["siteimage"]["tmp_name"], "../img/" .$siteimage_new);
}
}		
else
{
$siteimage_new=$_REQUEST['logo_photo'];
}
if(@is_uploaded_file($_FILES["fvicon"]["tmp_name"]))
{
if(!in_array($_FILES['fvicon']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid <b>fevicon image</b> file type. Only JPEG,JPG,GIF and PNG types are accepted.</li>";
$errorFlag = true;
}
else if($_FILES['fvicon']['size']>=$maxsize || $_FILES['fvicon']['size'] == 0)
{
$erroMessage .= "<li> <b>Fevicon image</b> size to large .</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$fvicon=$_FILES['fvicon']['name'];
$fvicon_new = str_replace(" ","-",$fvicon);
unlink("../img/".$_REQUEST['fvcon_photo']);
$upload_fvicon=copy($_FILES["fvicon"]["tmp_name"], "../img/" .$fvicon_new);
}
}
else
{
$fvicon_new=$_REQUEST['fvcon_photo'];
}
}
if(!$errorFlag)
{
$STATUS_MESSAGE="";            
$SQL_STATEMENT = "";
$ERROR_FLAG = false;
if($ERROR_FLAG != true)
{
if(isset($_REQUEST['sub_add_logo']))
{
switch($ACTION)
{
case 'UPDATE':
$SQL_STATEMENT="update site_config set web_logo_path='$siteimage_new',favicon='$fvicon_new' where id='1' ";
break;
}
$statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);
$STATUS_MESSAGE = $statusObj->getStatusMessage();
$response = array();
$response['successStatus'] = $statusObj->getActionSuccess();
$response['responseMessage'] = $STATUS_MESSAGE;
header('Content-type: application/json');
echo json_encode($response);
}
}
}
else
{
$response = array();
$response['successStatus'] = false;
$response['responseMessage'] = $erroMessage;
header('Content-type: application/json');
echo json_encode($response);	   		
}
}
?>