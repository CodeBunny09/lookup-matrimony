<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$q=$_POST["id"];
$sql="SELECT matri_id,firstname,lastname FROM register WHERE matri_id = '".$q."' and gender='Male'";
$result = $DatabaseCo->dbLink->query($sql) or die(mysqli_error());
$getdata=mysqli_fetch_object($result);
if(mysqli_num_rows($result)==0){
	 echo $msg = "Please enter valid Groom id.";
}else{
	$fname=$getdata->firstname;
	$lname=$getdata->lastname;
	$fullname=$fname." ".$lname;
	echo $fullname;
}
?> 