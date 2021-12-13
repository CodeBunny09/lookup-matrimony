<?php
error_reporting(0);
backup_tables();
function backup_tables($tables = '*') 
{ 
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
$DatabaseCo = new DatabaseConn();
$db_name=$name;
$abc=$DatabaseCo->dbLink; 
$return='';          
//get all of the tables 
if($tables == '*') 
{ 
$tables = array();
$result = mysqli_query($abc,"SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME NOT LIKE '%view%'");
while($row = mysqli_fetch_row($result)) 
{ 
$tables[] = $row[0];
}
}
else 
{ 
$tables = is_array($tables) ? $tables : 
explode(',',$tables);
} 
//cycle through 
foreach($tables as $table) 
{ 
$result = mysqli_query($abc,'SELECT * FROM '.$table);
$num_fields = mysqli_num_fields($result);
$row2 = mysqli_fetch_row(mysqli_query($abc,'SHOW CREATE TABLE '.$table));
$return.= "\n\n".$row2[1].";\n\n";
for ($i = 0; $i < $row = mysqli_fetch_row($result); $i++) 
{ 
$return.= 'INSERT INTO '.$table.' VALUES(';
for($j=0; $j<$num_fields; $j++) 
{ 
$row[$j] = addslashes($row[$j]);
$row[$j] = @ereg_replace("\n","\\n",$row[$j]);
if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; } 
if ($j<($num_fields-1)) { $return.= ','; } 
} 
$return.= ");\n";
} 
} 
//$return.="\n\n\n";
//} 
//save file 
$now = date("F j, Y");
$myfoldername = 'backup/';
$handle = fopen($myfoldername.$now.'.sql','w+');
//$handle = fopen(getcwd().$myfoldername.'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
fwrite($handle,$return);
fclose($handle);
}
echo "<script>alert('Your database is stored in backup folder.')</script>";
echo "<script>window.location='DatabaseBackup'</script>";
?>