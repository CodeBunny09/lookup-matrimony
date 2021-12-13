<?php


if(isset($_POST['fvicon']) || isset($_POST['logo'])){


if(isset($_POST['fvicon']))
{
$fvcon=$_POST['fvicon'];	
}

else if(isset($_POST['logo']))
{
	$fvcon=$_POST['logo'];
}
$fvcon=explode(".",$fvcon);


$acceptable = array(
			'jpeg',
			'jpg',
			'gif',
			'png'
		);

  if (!in_array($fvcon[1],$acceptable)) 
  {
  
    $response = array( 'valid' => false, 'message' => 'Invalid file type. Only JPEG,JPG, GIF and PNG types are accepted.!' );
  
  }
  else
  {
	  $response = array( 'valid' => true );
  }

}
echo json_encode($response);



if(isset($_POST['banner2']) || isset($_POST['banner3'])){




if(isset($_POST['banner2']))
{
	$fvcon=$_POST['banner2'];
}
else if(isset($_POST['banner3']))
{
	$fvcon=$_POST['banner3'];
}
$fvcon=explode(".",$fvcon);


$acceptable = array(
			'jpeg',
			'jpg',
			'gif',
			'png'
		);

  if (!in_array($fvcon[1],$acceptable)) 
  {
  
    $response = array( 'valid' => false, 'message' => 'Invalid file type. Only JPEG,JPG, GIF and PNG types are accepted.!' );
  
  }
  else
  {
	  $response = array( 'valid' => true );
  }

}
echo json_encode($response);
?>