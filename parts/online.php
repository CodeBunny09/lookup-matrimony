<?php

include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();

if($_SESSION['gender123'])
	{
			if($_SESSION['gender123']=='Male')
			{
			 $gender="and gender='Female'";
			}
			else
			{
			 $gender="and gender='Male'";	
			}		
	}
	

// Counting all the online visitors:
list($totalOnline) = mysqli_fetch_array(mysqli_query($DatabaseCo->dbLink,"SELECT COUNT(*) FROM online_users where index_id!='".$_SESSION['uid']."' $gender"));

// Outputting the number as plain text:
echo $totalOnline;


// Removing entries not updated in the last 2 minutes:
mysqli_query($DatabaseCo->dbLink,"DELETE FROM online_users WHERE dt<SUBTIME(NOW(),'0 0:2:0')");
?>