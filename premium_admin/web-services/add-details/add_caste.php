<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$religion_id = isset($_POST['caste_id']) ? $_POST['caste_id'] :"" ;



$caste_name = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['caste_name']))

			{

            	$erroMessage .= "<li>Caste should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['caste_name']) < 1)

				{

            		$erroMessage .= "<li>Caste Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['caste_status']))

			{

			$erroMessage .= "<li>Caste Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            { 

				$religion_id= mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['religion_id']);

				$caste_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['caste_name']);

				$status=      mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['caste_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                      $SQL_STATEMENT = "INSERT into caste (religion_id,caste_name,status)  values ('".$religion_id."','".$caste_name."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $caste_id = $_POST['caste_id'];

                      $SQL_STATEMENT =  "UPDATE caste  set caste_name='".$caste_name."',status='".$status."', religion_id=".$religion_id." WHERE caste_id=".$caste_id;	

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