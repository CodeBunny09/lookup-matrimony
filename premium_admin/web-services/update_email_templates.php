<?php
include_once '../../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
$EMAIL_TEMPLATE_ID = isset($_POST['EMAIL_TEMPLATE_ID']) ? $_POST['EMAIL_TEMPLATE_ID'] :"" ;

$email_name = "";
$pre_condition="";
$email_subject="";
$status="";

	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['email_name']))
			{
            	$erroMessage .= "<li>Email templates name should not be empty.</li>";
            	$errorFlag = true;
            }
			
            if(empty($_POST['email_status']))
			{
			$erroMessage .= "<li>Email templates Status should not be empty.</li>";
			$errorFlag = true;
          	}	
			if(empty($_POST['pre_action']))
			{
			$erroMessage .= "<li>  Pre condition should not be empty.</li>";
			$errorFlag = true;
          	}	
			
			if(empty($_POST['email_subject']))
			{
			$erroMessage .= "<li> Email templates subject should not be empty.</li>";
			$errorFlag = true;
          	}	
			
            if(!$errorFlag)
            {
				$email_name = $_POST['email_name'];
				$status=$_POST['email_status'];
				$pre_action=$_POST['pre_action'];
				$email_subject=$_POST['email_subject'];
				
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    
                    case 'UPDATE':
                            $EMAIL_TEMPLATE_ID = $_POST['EMAIL_TEMPLATE_ID'];
                           $SQL_STATEMENT =  "UPDATE email_templates  set EMAIL_TEMPLATE_NAME='".$email_name."',STATUS='".$status."',PRE_CONDITION='".$pre_action."' ,EMAIL_SUBJECT='".$email_subject."' WHERE EMAIL_TEMPLATE_ID=".$EMAIL_TEMPLATE_ID;	
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