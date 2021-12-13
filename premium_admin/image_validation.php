<?php 
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$ACTION = isset($_REQUEST['action']) ? $_REQUEST['action'] :"" ;
$matri_id = isset($_GET['matri_id']) ? $_GET['matri_id'] :"" ;
$sample='';
$photo1='';
$photo2 ='';
$photo3 ='';
$photo4 ='';
$photo5 ='';
$photo6 ='';
$que1='';
$que2='';
$que3='';
$que4='';
$que5='';
$que6='';
$errorFlag = false;
$erroMessage = "";
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{	// Basic Detail
$maxsize    = 2097152;
$acceptable = array(
'image/jpeg',
'image/jpg',
'image/gif',
'image/png');
if(@is_uploaded_file($_FILES["photo1"]["tmp_name"]))
{
if($_FILES['photo1']['size']>=$maxsize || $_FILES['photo1']['size'] == 0)
{
$erroMessage .= "<li>Image size to large .</li>";
$errorFlag = true;
}
else if(!in_array($_FILES['photo1']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid file type. Only JPEG,JPG, GIF and PNG types are accepted.!.</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$photo1=$_FILES['photo1']['name'];
$photo1_new = str_replace(" ","-",$photo1);
if(file_exists("../my_photos/".$_REQUEST['old_photo1']) && $_REQUEST['old_photo1']!='')
{
unlink("../my_photos/".$_REQUEST['old_photo1']);
}
$upload_photo1=copy($_FILES["photo1"]["tmp_name"], "../my_photos/" .$photo1_new);
$upload_photo1=copy($_FILES["photo1"]["tmp_name"], "../my_photos_big/" .$photo1_new);	
}
}
else
{
$photo1_new=$_REQUEST['old_photo1'];
}
if(@is_uploaded_file($_FILES["photo2"]["tmp_name"]))
{
//$que2=",photo2_approve='APPROVED'";
if($_FILES['photo2']['size']>=$maxsize || $_FILES['photo2']['size'] == 0)
{
$erroMessage .= "<li>Image size to large .</li>";
$errorFlag = true;
}
else if(!in_array($_FILES['photo2']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid file type. Only JPEG,JPG, GIF and PNG types are accepted.!.</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$photo2=$_FILES['photo2']['name'];
$photo2_new = str_replace(" ","-",$photo2);
if(file_exists("../my_photos/".$_REQUEST['old_photo2']) && $_REQUEST['old_photo2']!='')
{
unlink("../my_photos/".$_REQUEST['old_photo2']);
}
$upload_photo2=copy($_FILES["photo2"]["tmp_name"], "../my_photos/".$photo2_new);
$upload_photo2=copy($_FILES["photo2"]["tmp_name"], "../my_photos_big/".$photo2_new);
}
}
else
{
$photo2_new=$_REQUEST['old_photo2'];
}
if(@is_uploaded_file($_FILES["photo3"]["tmp_name"]))
{
//$que3=",photo3_approve='APPROVED'";
if($_FILES['photo3']['size']>=$maxsize || $_FILES['photo3']['size'] == 0)
{
$erroMessage .= "<li>Image size to large .</li>";
$errorFlag = true;
}
else if(!in_array($_FILES['photo3']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid file type. Only JPEG,JPG, GIF and PNG types are accepted.!.</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$photo3=$_FILES['photo3']['name'];
$photo3_new = str_replace(" ","-",$photo3);
if(file_exists("../my_photos/".$_REQUEST['old_photo3']) && $_REQUEST['old_photo3']!='')
{
unlink("../my_photos/".$_REQUEST['old_photo3']);
}
$upload_photo3=copy($_FILES["photo3"]["tmp_name"], "../my_photos/" .$photo3_new);
$upload_photo3=copy($_FILES["photo3"]["tmp_name"], "../my_photos_big/" .$photo3_new);
}
}
else
{
$photo3_new=$_REQUEST['old_photo3'];
}
if(@is_uploaded_file($_FILES["photo4"]["tmp_name"]))
{
//$que4=",photo4_approve='APPROVED'";
if($_FILES['photo4']['size']>=$maxsize || $_FILES['photo4']['size'] == 0)
{
$erroMessage .= "<li>Image size to large .</li>";
$errorFlag = true;
}
else if(!in_array($_FILES['photo4']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid file type. Only JPEG,JPG, GIF and PNG types are accepted.!.</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$photo4=$_FILES['photo4']['name'];
$photo4_new = str_replace(" ","-",$photo4);
if(file_exists("../my_photos/".$_REQUEST['old_photo4']) && $_REQUEST['old_photo4']!='')
{
unlink("../my_photos/".$_REQUEST['old_photo4']);
}
$upload_photo4=copy($_FILES["photo4"]["tmp_name"], "../my_photos/" .$photo4_new);
$upload_photo4=copy($_FILES["photo4"]["tmp_name"], "../my_photos_big/" .$photo4_new);
}
}
else
{
$photo4_new=$_REQUEST['old_photo4'];
}
if(@is_uploaded_file($_FILES["photo5"]["tmp_name"]))
{
//$que5=",photo5_approve='APPROVED'";
if($_FILES['photo5']['size']>=$maxsize || $_FILES['photo5']['size'] == 0)
{
$erroMessage .= "<li>Image size to large .</li>";
$errorFlag = true;
}
else if(!in_array($_FILES['photo5']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid file type. Only JPEG,JPG, GIF and PNG types are accepted.!.</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$photo5=$_FILES['photo5']['name'];
$photo5_new = str_replace(" ","-",$photo5);
if(file_exists("../my_photos/".$_REQUEST['old_photo5']) && $_REQUEST['old_photo5']!='')
{
unlink("../my_photos/".$_REQUEST['old_photo5']);
}
$upload_photo5=copy($_FILES["photo5"]["tmp_name"], "../my_photos/" .$photo5_new);
$upload_photo5=copy($_FILES["photo5"]["tmp_name"], "../my_photos_big/" .$photo5_new);
}
}
else
{
$photo5_new=$_REQUEST['old_photo5'];
}
if(@is_uploaded_file($_FILES["photo6"]["tmp_name"]))
{
//$que6=",photo6_approve='APPROVED'";
if($_FILES['photo6']['size']>=$maxsize || $_FILES['photo6']['size'] == 0)
{
$erroMessage .= "<li>Image size to large .</li>";
$errorFlag = true;
}
else if(!in_array($_FILES['photo6']['type'],$acceptable))
{
$erroMessage .= "<li> Invalid file type. Only JPEG,JPG, GIF and PNG types are accepted.!.</li>";
$errorFlag = true;
}
else if($erroMessage=='')
{
$photo6=$_FILES['photo6']['name'];
if(file_exists("../my_photos/".$_REQUEST['old_photo6']) && $_REQUEST['old_photo6']!='')
{
unlink("../my_photos/".$_REQUEST['old_photo6']);
}
$photo6_new = str_replace(" ","-",$photo6);	
$upload_photo6=copy($_FILES["photo6"]["tmp_name"], "../my_photos/" .$photo6_new);
$upload_photo6=copy($_FILES["photo6"]["tmp_name"], "../my_photos_big/" .$photo6_new);
}
}
else
{
$photo6_new=$_REQUEST['old_photo6'];
}
if(!$errorFlag)
{
$STATUS_MESSAGE="";
$SQL_STATEMENT = "";
$ERROR_FLAG = false;
if($ERROR_FLAG != true)
{
if(isset($_REQUEST['submitimage']))
{
switch($ACTION)
{
case 'UPDATE':
$matri_id = $_REQUEST['matri_id'];
$SQL_STATEMENT="update register set photo1='".$photo1_new."',photo2='".$photo2_new."',photo3='".$photo3_new."',photo4='".$photo4_new."',photo5='".$photo5_new."',photo6='".$photo6_new."',photo1_approve='APPROVED',photo2_approve='APPROVED',photo3_approve='APPROVED',photo4_approve='APPROVED',photo5_approve='APPROVED',photo6_approve='APPROVED' where matri_id='".$matri_id."' ";
break;
}
$statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);
$STATUS_MESSAGE = $statusObj->getStatusMessage();
$response = array();
$response['successStatus'] = $statusObj->getActionSuccess();
$response['matri_id'] = $matri_id;
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