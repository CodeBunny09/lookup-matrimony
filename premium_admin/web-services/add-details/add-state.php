<?php
include_once '../../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;


$STATE_ID = isset($_POST['state_id']) ? $_POST['state_id'] :"" ;

$state_name = ""; 
$state_status ="";
$country_code = "";


$stateRealID = "Real-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		//echo "hi";
	$statusObj = new Status();

	
	$errorFlag = false;
	$erroMessage = "";
            if(empty($_POST['country_id'])){
            	$erroMessage .= "<li>Country Should be required.</li>";
            	$errorFlag = true;            	
             }            	     
	
            if(empty($_POST['state_name']))
			{
            	$erroMessage .= "<li>State Name is required.</li>";
            	$errorFlag = true;
            }
			else
			{
            	if(strlen($_POST['state_name']) < 1)
				{
            		$erroMessage .= "<li>State Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
			if(empty($_POST['state_code']))
			{
            	$erroMessage .= "<li>State Code is required.</li>";
            	$errorFlag = true;
            }
            if(empty($_POST['state_status']))
			{
			$erroMessage .= "<li>State Status should not be empty.</li>";
			$errorFlag = true;
             }
	    
            if(!$errorFlag)
            {	
				//echo "hi";
				$state_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['state_name']);
				$state_code = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['state_code']);
           		 $state_status=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['state_status']);
				$country_code = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['country_id']);										
            	
				$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	
				
				switch($ACTION)
            	{ 
                    case 'ADD':
                     $SQL_STATEMENT = "INSERT into state  (country_code,state_code,state_name,status)  values ('".$country_code."','".$state_code."','".$state_name."','".$state_status."')";

    
                            break;
                    case 'UPDATE':
                            $state_id = $_POST['state_id'];
                            $SQL_STATEMENT =  "UPDATE state  set state_code='".$state_code."', state_name='".$state_name."',status='".$state_status."',country_code='".$country_code."' WHERE state_id=".$state_id;	
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