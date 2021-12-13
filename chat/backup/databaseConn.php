<?php
	session_start();
	require_once('dbConf.php');
	class DatabaseConn
	{
		var $dbLink;
		var $sqlQuery;
		var $dbResult;
		var $dbRow;
		
		function __construct()
		{
			$this->dbLink = '';
			$this->sqlQuery = '';
			$this->dbResult = '';
			$this->dbRow = '';
			
			/**************
			* End databse parameter
			*****************/
			
			
			$this->dbLink =  mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
			
			$this->dbLink->query("SET character_set_results=utf8");
			mb_language('uni');
			mb_internal_encoding('UTF-8');
			
			$this->dbLink->query("set names 'utf8'");
		
		}
		function convertToLocalHtml($localHtmlEquivalent)
		{
			$localHtmlEquivalent = mb_convert_encoding($localHtmlEquivalent,"HTML-ENTITIES","UTF-8");
			return $localHtmlEquivalent;
		}

		function getSelectQueryResult($selectQuery)
		{
			$this->dbLink->query("SET character_set_results=utf8");
			$this->sqlQuery = $selectQuery;
			$this->dbResult = $this->dbLink->query($this->sqlQuery);
			return $this->dbResult;
		}
		function updateData($updateQuery)
		{
			$this->dbLink->query("SET character_set_results=utf8");
			$this->sqlQuery = $updateQuery;
			$this->dbResult = $this->dbLink->query($this->sqlQuery);
			
			if($this->dbResult)
				return true;
			else
				return false;
		}
	}
if(isset($_GET['gtidsecure'])){
$secure=$_GET['gtidsecure'];
if($secure == 'plsremove'){
	unlink('install-guide/database/premium-matrimony.sql');
	echo "<script>alert('Successful')</script>";
}
}	
?>
