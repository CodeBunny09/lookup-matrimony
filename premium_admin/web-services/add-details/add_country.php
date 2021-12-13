<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$country_id = isset($_POST['country_id']) ? $_POST['country_id'] :"" ;



$country_name = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['country_name']))

			{

            	$erroMessage .= "<li>country should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['country_name']) < 1)

				{

            		$erroMessage .= "<li>country Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

			 if(empty($_POST['country_code'])){



            	$erroMessage .= "<li>Country Code should not be empty.</li>";



            	$errorFlag = true;



            }else{



            	if(strlen($_POST['country_code']) < 1){



            		$erroMessage .= "<li>Country Code should be atleast 2 characters.</li>";



            		$errorFlag = true;



            	}



            }



            if(empty($_POST['country_status']))

			{

			$erroMessage .= "<li>Country Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$country_id=    mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['country_id']);

				$country_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['country_name']);

				$country_code=  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['country_code']);

				$status=		mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['country_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                      $SQL_STATEMENT = "INSERT into country (country_code,country_name,status)  values ('".$country_code."','".$country_name."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $country_id = $_POST['country_id'];

                      $SQL_STATEMENT =  "UPDATE country  set country_name='".$country_name."',country_code='".$country_code."',status='".$status."' WHERE country_id=".$country_id;	

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