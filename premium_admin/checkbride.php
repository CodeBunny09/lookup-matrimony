<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once 'lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$q=$_GET["q"];
$sql="SELECT username FROM register WHERE matri_id = '".$q."' and gender='Male'";
$result=$DatabaseCo->dbLink->query($sql) or die(mysqli_error($DatabaseCo->dbLink));
if(mysqli_num_rows($result)==0)
{
echo "";
}
else
{
$abc=mysqli_fetch_array($result);
$fullname=$abc['username'];
echo $fullname;
}
?> 
