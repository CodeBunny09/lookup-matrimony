<?php

	include_once '../../../databaseConn.php';

	$DatabaseCo = new DatabaseConn();
	$country_code = isset($_GET['country_code']) ? $_GET['country_code'] :"" ;
	if(empty($country_code))
		$SQL_STATEMENT = "SELECT * FROM state order by state_name";
	else
		$SQL_STATEMENT = "SELECT * FROM state WHERE country_code='".$country_code."' order by state_name";
	
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$state_list = array();
	while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)){
				$state_code = $DatabaseCo->dbRow->state_code;
				$state_name = $DatabaseCo->dbRow->state_name;
				$state = array();
				$state['state_code'] = $state_code;
				$state['state_name'] = $state_name;
				array_push($state_list,$state);
	}
	header('Content-type: application/json');
	echo json_encode($state_list);
?>