<?php
include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
$CITY_ID = isset($_POST['city_id']) ? $_POST['city_id'] :"" ;

$city_name = "";
$city_status ="";
$state_code = "";
$country_code = "";

	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
$statusObj = new Status();

$errorFlag = false;
$erroMessage = "";
            if(empty($_POST['country_code']))
			{
            	$erroMessage .= "<li>Country Should be required.</li>";
            	$errorFlag = true;            	
             }            	     

            if(empty($_POST['state_code']))
			{
            	$erroMessage .= "<li>State Should be required.</li>";
            	$errorFlag = true;            	
             }            	                  

            if(empty($_POST['city_name']))
			{
            	$erroMessage .= "<li>City Name is required.</li>";
            	$errorFlag = true;
            }
			
            if(empty($_POST['city_status']))
			{
			$erroMessage .= "<li>City Status should not be empty.</li>";
			$errorFlag = true;
             }
	    
            if(!$errorFlag)
            {
				
				$city_name =    mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['city_name']);
            	$city_status = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['city_status']);
    			$state_code =  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['state_code']);
    			$country_code = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['country_code']);
				
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
				
				
            	switch($ACTION)
            	{
                    case 'ADD':
                          $SQL_STATEMENT = "INSERT into city (state_code,country_code,city_name,status) values ('".$state_code."','".$country_code."','".$city_name."','".$city_status."')";

    
                            break;
                    case 'UPDATE':
                            $city_id = $_POST['city_id'];
                            $SQL_STATEMENT =  "UPDATE city  set city_name='".$city_name."',status='".$city_status."',country_code='".$country_code."',state_code='".$state_code."' WHERE city_id=".$city_id;	
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