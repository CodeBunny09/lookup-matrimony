<?php
//error_reporting(0); 

require 'exportcsvmember.inc.php';
 
$table="register"; // this is the tablename that you want to export to csv from mysql.
 
exportMysqlToCsv($table);
 
?>