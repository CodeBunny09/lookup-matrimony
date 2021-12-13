<?php
$path = "my_photos_big/";
include ('smart_resize_image.function.php');
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
$name = isset($_FILES['image']['name'])?$_FILES['image']['name']:"";
$size = isset($_FILES['image']['size'])?$_FILES['image']['size']:"";
if(strlen($name))
{
list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats))
{
if($size<(2*1048576))
{
$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
$file = $_FILES['image']['tmp_name'];
//indicate the path and name for the new resized file
$resizedFile = $path.$actual_image_name;
//call the function (when passing path to pic)
// smart_resize_image($file , null, SET_YOUR_WIDTH , SET_YOUR_HIGHT , false , $resizedFile , false , false ,100 );
if(smart_resize_image($file , null, 600, 600 , false , $resizedFile , false , false ,100 ))
{
?>
<div class="component" >   
  <div class="overlay">
    <div class="overlay-inner">
    </div>
  </div>
  <!-- This image must be on the same domain as the demo or it will not work on a local file system -->
  <!-- http://en.wikipedia.org/wiki/Cross-origin_resource_sharing -->
  <img class="resize-image" src="my_photos_big/<?php echo $actual_image_name;?>" alt="image for resizing" >
  <button class="btn-crop js-crop">
    <img class="icon-crop" src="img/crop.svg">&nbsp;&nbsp;Crop
  </button>
</div>
<script src="js/photoupload/edit_more_upload.js" type="text/javascript">
</script>                    
<?php
//echo "<img src='my_photos_big/".$actual_image_name."'  class='resize-image'>";
}
else
echo "<script>alert('failed');</script>";
}
else
echo "<script>alert('Image file size max 2 MB');</script>";					
}                              
else
echo "<script>alert('Invalid file format..');</script>";	
}
else
echo "<script>alert('Please select image..!')</script>";
exit;
}
?>
