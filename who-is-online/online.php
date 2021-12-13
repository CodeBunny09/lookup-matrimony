<?php
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
require "functions.php";

// We don't want web bots scewing our stats:
if(is_bot()) die();

if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
$ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
$ip = $_SERVER["REMOTE_ADDR"];
}

$indexid = $_SESSION['uid'];
$asset=mysqli_fetch_array(mysqli_query($DatabaseCo->dbLink,"SELECT * FROM register where index_id='$indexid'"));
$username=$asset['username'];
$temp_gender=$asset['gender'];

// Checking wheter the visitor is already marked as being online:
$inDB = mysqli_query($DatabaseCo->dbLink,"SELECT * FROM online_users WHERE index_id=".$indexid);

if(mysqli_num_rows($inDB)==0)
{
	
	mysqli_query($DatabaseCo->dbLink,"INSERT INTO online_users (ip,username,gender,index_id)
					VALUES('".$ip."','".$username."','".$temp_gender."','".$indexid."')");
}
else
{
	// If the visitor is already online, just update the dt value of the row:
	mysqli_query($DatabaseCo->dbLink,"UPDATE online_users SET dt=NOW() WHERE index_id=".$indexid);
}



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
list($totalOnline) = mysqli_fetch_array(mysqli_query($DatabaseCo->dbLink,"SELECT COUNT(*) FROM online_users where index_id!='$indexid' $gender"));

// Outputting the number as plain text:
echo $totalOnline;

?>