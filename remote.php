<?php

session_start();

$response = array( 'valid' => false, 'message' => 'Sorry, Something went wrong!');
if(isset($_POST['susphoto'])){

$var=explode(".",$_POST['susphoto']);

$allowed =  array('gif','png' ,'jpg', 'jpeg');

  if(!in_array($var[1],$allowed) ) {
    $response = array( 'valid' => false, 'message' => 'Please enter valid captcha!' );
  } else {
    $response = array( 'valid' => true );
  }

}
echo json_encode($response);
?>