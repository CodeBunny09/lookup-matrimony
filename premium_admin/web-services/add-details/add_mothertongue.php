<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$mtongue_id = isset($_POST['mtongue_id']) ? $_POST['mtongue_id'] :"" ;



$mtongue_id = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['mtongue_name']))

			{

            	$erroMessage .= "<li>MotherTongue should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['mtongue_name']) < 1)

				{

            		$erroMessage .= "<li>MotherTongue Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['mtongue_status']))

			{

			$erroMessage .= "<li>MotherTongue Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$mtongue_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['mtongue_name']);

				$status=		mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['mtongue_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                   	 $SQL_STATEMENT = "INSERT into mothertongue (mtongue_name,status)  values ('".$mtongue_name."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $mtongue_id = $_POST['mtongue_id'];

                           $SQL_STATEMENT =  "UPDATE mothertongue  set mtongue_name='".$mtongue_name."',status='".$status."' WHERE mtongue_id=".$mtongue_id;	

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