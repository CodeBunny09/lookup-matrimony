<?php 
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mid=$_SESSION['user_id'];
$Row = mysqli_fetch_object($DatabaseCo->dbLink->query("select photo1,photo2,photo3,photo4,photo5,photo6,gender from register where matri_id='".$mid."'"));
?>									
<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-16 col-xs-16">
  <div class="thumbnail">	
    <?php
if($Row->photo1!='' && file_exists('../my_photos/'.$Row->photo1))						{
?> 
    <img src="my_photos/<?php echo $Row->photo1;?>" class="img-responsive imgheight">
    <?php
}
else
{
?> <?php
	if($Row->gender == 'Male'){
   ?>
   <img src="img/male.png" class="img-responsive imgheight">
   <?php
	}else{
   ?>
   <img src="img/female.png" class="img-responsive imgheight">
   <?php
	}
   ?>
    
    <?php
}
?>
    <div class="caption">
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle btn-block flat" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Options
          <span class="caret">
          </span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li>
            <a class="gt-cursor" id="edit1">
              Edit
            </a>
          </li>
          <?php if($Row->photo1!=''){?>
          <li>
            <a class="gt-cursor" id="delete1">
              Delete
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-16 col-xs-16">
  <div class="thumbnail">	
    <?php
if($Row->photo2!='' && file_exists('../my_photos/'.$Row->photo2))						{
?> 
    <img src="my_photos/<?php echo $Row->photo2;?>" class="img-responsive imgheight">
    <?php
}
else
{
?> 
    <?php
	if($Row->gender == 'Male'){
   ?>
   <img src="img/male.png" class="img-responsive imgheight">
   <?php
	}else{
   ?>
   <img src="img/female.png" class="img-responsive imgheight">
   <?php
	}
   ?>
    <?php
}
?>
    <div class="caption">
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle btn-block flat" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Options
          <span class="caret">
          </span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li>
            <a class="gt-cursor" id="edit2">
              Edit
            </a>
          </li>
          <?php if($Row->photo2!='' && file_exists('../my_photos/'.$Row->photo2)){?>
          <li>
            <a class="gt-cursor" onClick="set_as_profile_photo(2);">
              Set as profile Picture
            </a>
          </li>
          <li>
            <a class="gt-cursor" id="delete2">
              Delete
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-16 col-xs-16">
  <div class="thumbnail">	
    <?php
if($Row->photo3!='' && file_exists('../my_photos/'.$Row->photo3))						{
?> 
    <img src="my_photos/<?php echo $Row->photo3;?>" class="img-responsive imgheight">
    <?php
}
else
{
?> 
    <?php
	if($Row->gender == 'Male'){
   ?>
   <img src="img/male.png" class="img-responsive imgheight">
   <?php
	}else{
   ?>
   <img src="img/female.png" class="img-responsive imgheight">
   <?php
	}
   ?>
    <?php
}
?>
    <div class="caption">
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle btn-block flat" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Options
          <span class="caret">
          </span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li>
            <a class="gt-cursor" id="edit3">
              Edit
            </a>
          </li>
          <?php if($Row->photo3!='' && file_exists('../my_photos/'.$Row->photo3)){?>
          <li>
            <a class="gt-cursor" onClick="set_as_profile_photo(3);">
              Set as profile Picture
            </a>
          </li>
          <li>
            <a class="gt-cursor" id="delete3">
              Delete
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-16 col-xs-16">
  <div class="thumbnail">	
    <?php
if($Row->photo4!='' && file_exists('../my_photos/'.$Row->photo4))						{
?> 
    <img src="my_photos/<?php echo $Row->photo4;?>" class="img-responsive imgheight">
    <?php
}
else
{
?> 
    <?php
	if($Row->gender == 'Male'){
   ?>
   <img src="img/male.png" class="img-responsive imgheight">
   <?php
	}else{
   ?>
   <img src="img/female.png" class="img-responsive imgheight">
   <?php
	}
   ?>
    <?php
}
?>
    <div class="caption">
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle btn-block flat" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Options
          <span class="caret">
          </span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li>
            <a class="gt-cursor" id="edit4">
              Edit
            </a>
          </li>
          <?php if($Row->photo4!='' && file_exists('../my_photos/'.$Row->photo4)){?>
          <li>
            <a class="gt-cursor" onClick="set_as_profile_photo(4);">
              Set as profile Picture
            </a>
          </li>
          <li>
            <a class="gt-cursor" id="delete4">
              Delete
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-16 col-xs-16">
  <div class="thumbnail">	
    <?php
if($Row->photo5!='' && file_exists('../my_photos/'.$Row->photo5))						{
?> 
    <img src="my_photos/<?php echo $Row->photo5;?>" class="img-responsive imgheight">
    <?php
}
else
{
?> 
    <?php
	if($Row->gender == 'Male'){
   ?>
   <img src="img/male.png" class="img-responsive imgheight">
   <?php
	}else{
   ?>
   <img src="img/female.png" class="img-responsive imgheight">
   <?php
	}
   ?>
    <?php
}
?>
    <div class="caption">
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle btn-block flat" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Options
          <span class="caret">
          </span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li>
            <a class="gt-cursor" id="edit5">
              Edit
            </a>
          </li>
          <?php if($Row->photo5!='' && file_exists('../my_photos/'.$Row->photo5)){?>
          <li>
            <a class="gt-cursor" onClick="set_as_profile_photo(5);">
              Set as profile Picture
            </a>
          </li>
          <li>
            <a class="gt-cursor" id="delete5">
              Delete
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-8 col-sm-16 col-xs-16">
  <div class="thumbnail">	
    <?php
if($Row->photo6!='' && file_exists('../my_photos/'.$Row->photo6))						{
?> 
    <img src="my_photos/<?php echo $Row->photo6;?>" class="img-responsive imgheight">
    <?php
}
else
{
?> 
    <?php
	if($Row->gender == 'Male'){
   ?>
   <img src="img/male.png" class="img-responsive imgheight">
   <?php
	}else{
   ?>
   <img src="img/female.png" class="img-responsive imgheight">
   <?php
	}
   ?>
    <?php
}
?>
    <div class="caption">
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle btn-block flat" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Options
          <span class="caret">
          </span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li>
            <a class="gt-cursor" id="edit6">
              Edit
            </a>
          </li>
          <?php if($Row->photo6!='' && file_exists('../my_photos/'.$Row->photo6)){?>
          <li>
            <a class="gt-cursor" onClick="set_as_profile_photo(6);">
              Set as profile Picture
            </a>
          </li>
          <li>
            <a class="gt-cursor" id="delete6">
              Delete
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
