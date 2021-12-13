<?php
error_reporting(0);
//error_reporting( E_ALL );
	define('DB_HOST', 'localhost');
    define('DB_USER', 'samplede_prem');
    define('DB_PASSWORD', '*GM+FV]aa%+a');
    define('DB_DATABASE', 'samplede_prem');
	$db=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD);
	$connection=mysqli_select_db($db,DB_DATABASE);
	
	
?>
<?php date_default_timezone_set("Asia/Kolkata");?>