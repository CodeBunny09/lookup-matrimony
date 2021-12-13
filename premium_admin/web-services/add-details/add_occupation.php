<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$ocp_id = isset($_POST['ocp_id']) ? $_POST['ocp_id'] :"" ;



$ocp_name = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['ocp_name']))

			{

            	$erroMessage .= "<li>Occupation should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['ocp_name']) < 1)

				{

            		$erroMessage .= "<li>Occupation Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['occupation_status']))

			{

			$erroMessage .= "<li>Occupation Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$ocp_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['ocp_name']);

				$status=  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['occupation_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                      	 $SQL_STATEMENT = "INSERT into occupation (ocp_name,status)  values ('".$ocp_name."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $ocp_id = $_POST['ocp_id'];

                           $SQL_STATEMENT =  "UPDATE occupation  set ocp_name='".$ocp_name."',status='".$status."' WHERE ocp_id=".$ocp_id;	

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