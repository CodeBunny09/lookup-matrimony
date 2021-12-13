<?php

include_once 'databaseConn.php';

$DatabaseCo = new DatabaseConn();

if(isset($_REQUEST['id']))
		{
				$from_id=$_SESSION['user_id'];
		  		$to_id = $_REQUEST['id'];
			    $SQL_STATEMENT = "DELETE FROM shortlist WHERE from_id='$from_id' and to_id='$to_id'";
				$exe=$DatabaseCo->dbLink->query($SQL_STATEMENT) or die(mysqli_error($DatabaseCo->dbLink));
							
		}
		
if(isset($_REQUEST['add_id']))
		{
			$from_id=$_SESSION['user_id'];
		  	$to_id = $_REQUEST['add_id'];
		    $SQL_STATEMENT = "insert into shortlist (from_id,to_id,add_date) values ('$from_id','$to_id',now())";
			$exe=$DatabaseCo->dbLink->query($SQL_STATEMENT) or die(mysqli_error($DatabaseCo->dbLink));
							
		}
		
		
if(isset($_REQUEST['block_id']))
		{
				$block_by=$_SESSION['user_id'];;
		  		$block_to = $_REQUEST['block_id'];
			    $SQL_STATEMENT = "DELETE FROM  block_profile WHERE block_by='$block_by' and block_to='$block_to'";
				$exe=$DatabaseCo->dbLink->query($SQL_STATEMENT) or die(mysqli_error($DatabaseCo->dbLink));
							
		}
		
if(isset($_REQUEST['block_add_id']))
		{
			$block_by=$_SESSION['user_id'];
		  	$block_to = $_REQUEST['block_add_id'];
			$SQL_STATEMENT = "insert into block_profile (block_by,block_to,block_date) values ('$block_by','$block_to',now())";
			$exe=$DatabaseCo->dbLink->query($SQL_STATEMENT) or die(mysqli_error($DatabaseCo->dbLink));
							
		}

?>