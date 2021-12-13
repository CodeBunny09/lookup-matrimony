<?php
   include_once '../../../databaseConn.php';
  include_once '../../lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  
  $conn = $DatabaseCo->dbLink;
  
  function find_country($country_code)
  {
	  $DatabaseCo = new DatabaseConn();
	  $exe=mysqli_query($DatabaseCo->dbLink,"select country_name from country where country_code ='$country_code'");
	  $cname=mysqli_fetch_object($exe);
	  return $cname->country_name;
  }
  
  function find_state($country_code,$state_code)
  {
	  $DatabaseCo = new DatabaseConn();
	  $exe1=mysqli_query($DatabaseCo->dbLink,"select state_name from state where country_code='$country_code' and state_code ='$state_code'");
	  $sname=mysqli_fetch_object($exe1);
	  return $sname->state_name;
  }

$where=$_REQUEST['status'];


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	5 =>'city_name',
	2 =>'status', 
	3 =>'country_code', 
	4 =>'state_code',	
	0 =>'city_id'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM city";
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM city WHERE 1=1";
if( !empty($requestData['search']['value']) ) 
{   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( country_code LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR state_code LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR city_name LIKE '".$requestData['search']['value']."%' )";
}

if($where!='all')
{	
	if($where=='approved')
	{
	$sql.=" and status = 'APPROVED'";	
	}
	else
	{
	$sql.=" and status = 'UNAPPROVED'";			
	}
}


$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	


$query=mysqli_query($conn, $sql) or die(mysqli_error($conn));

$data = array();
while( $row=mysqli_fetch_array($query) ) 
{  // preparing an array
			$likeDisLikeCss = "";
			if($row["status"]=="APPROVED"){
			  $likeDisLikeCss = "fa-thumbs-up";
			}else
			{
			  $likeDisLikeCss = "fa-thumbs-down";
			}
		$icon= '<span class="updateSiteApprovalStatus"><i class="fa  '.$likeDisLikeCss.'"></i></span>';
		
		$edit='<a class="btn btn-default btn-sm"  href="javascript:;" data-modal="modal-13" onClick="newWindow(\'update_city?city_id='.$row['city_id'].'\',\'\',700,540)"><i class="fa fa-pencil fa-fw"></i>
		<span class="hidden-xs">&nbsp;&nbsp;Edit</span></a>';	
		
		$checkbox='<input type="checkbox" name="city_id[]" id="Item '.$row['city_id'].'" class="second" value="'.$row['city_id'].'"/>
	<label for="Item '.$row['city_id'].'" class="label2">&nbsp;</label>';
					
	$nestedData=array(); 
	$nestedData[] = $checkbox;
	$nestedData[] = $edit;
	$nestedData[] = $icon;
	$nestedData[] = find_country($row["country_code"]);
	$nestedData[] = find_state($row["country_code"],$row["state_code"]);
	$nestedData[] = $row["city_name"];
	

					
					
	
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
