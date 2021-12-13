<?php
	
	include_once '../../../databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
 $SQL_STATEMENT = "SELECT * FROM country where status='APPROVED' order by country_name";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$country_list = array();
	while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)){
				$country_code = $DatabaseCo->dbRow->country_code;
				$country_name = $DatabaseCo->dbRow->country_name;
				$country = array();
				$country['country_code'] = $country_code;
				$country['country_name'] = $country_name;
				array_push($country_list,$country);
	}
	header('Content-type: ../application/json');
	echo json_encode($country_list);
	
?>