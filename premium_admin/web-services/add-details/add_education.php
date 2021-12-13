<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$edu_id = isset($_POST['edu_id']) ? $_POST['edu_id'] :"" ;



$edu_name = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['edu_name']))

			{

            	$erroMessage .= "<li>Education should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['edu_name']) < 1)

				{

            		$erroMessage .= "<li>Education Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['edu_status']))

			{

			$erroMessage .= "<li>Education Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$edu_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['edu_name']);

				$status=	mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['edu_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                      	 $SQL_STATEMENT = "INSERT into  education_detail (edu_name,status)  values ('".$edu_name."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $edu_id = $_POST['edu_id'];

                           $SQL_STATEMENT =  "UPDATE education_detail  set edu_name='".$edu_name."',status='".$status."' WHERE edu_id=".$edu_id;	

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