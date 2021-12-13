<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$religion_id = isset($_POST['religion_id']) ? $_POST['religion_id'] :"" ;



$rel_name = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['rel_name']))

			{

            	$erroMessage .= "<li>Religion should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['rel_name']) < 1)

				{

            		$erroMessage .= "<li>Religion Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['rel_status']))

			{

			$erroMessage .= "<li>Religion Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$rel_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['rel_name']);

				$status   = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['rel_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                      	 $SQL_STATEMENT = "INSERT into religion (religion_name,status)  values ('".$rel_name."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $religion_id = $_POST['religion_id'];

                           $SQL_STATEMENT =  "UPDATE religion  set religion_name='".$rel_name."',status='".$status."' WHERE religion_id=".$religion_id;	

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