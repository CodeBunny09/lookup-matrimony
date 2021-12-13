<?php

include_once '../../databaseConn.php';
$DatabaseCo = new DatabaseConn();

 if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!='')
 {
	
	$page=$_REQUEST['page'];
	$limit = 3;
	$adjacent = 1;
  
	if($page==1)
	{
	   $start = 0;  
	}	
	else
	{
	   $start = ($page-1)*$limit;
	}
		  
		//$matri_id=$_SESSION['user_id'];

	
	if(isset($_POST['status']))
	{
		$member_status=$_POST['status'];
		$_SESSION['memstatus']=$member_status;
	}
	elseif(!isset($_SESSION['memstatus'])){
		$member_status='';
	}
	else
	{
		$member_status=$_SESSION['memstatus'];
	}
	
	if(isset($_POST['m_status']))
	{
		$match_status=$_POST['m_status'];
		$_SESSION['m_status']=$match_status;
	}
	elseif(!isset($_SESSION['m_status'])){
		$match_status='';
	}
	else
	{
		$match_status=$_SESSION['m_status'];
	}
		
	
		
	if($member_status!='' && $member_status!='Featured')
	{
		$a = "and status='".$member_status."'";	
	}
	else if($member_status!='' && $member_status=='Featured')
	{
		$a = "and fstatus='".$member_status."'";		
	}
	
	else
	{
		$a='';	
	}
	
	
	if(isset($_SESSION['search_gender']))
	{
		if($a!='' && $_SESSION['search_gender']!='')
		{
			$b="and gender='".$_SESSION['search_gender']."'";	
		}
		elseif($a=='' && $_SESSION['search_gender']!='')
		{
			$b="and gender='".$_SESSION['search_gender']."'";	
		}
		
	}
	else
	{
		$b="";	
	}
	
	if(isset($_SESSION['search_keyword']))
	{
		if($a!='' || $b!='' && $_SESSION['search_keyword']!='')
		{
			$c="and ((email like '%".$_SESSION['search_keyword']."%') OR (matri_id = '".$_SESSION['search_keyword']."') OR (firstname like '%".$_SESSION['search_keyword']."%') OR (lastname like '%".$_SESSION['search_keyword']."%'))";
			
		}
		elseif($a=='' && $b=='' && $_SESSION['search_keyword']!='')
		{
			$c="and ((email like '%".$_SESSION['search_keyword']."%') OR (matri_id = '".$_SESSION['search_keyword']."') OR (firstname like '%".$_SESSION['search_keyword']."%') OR (lastname like '%".$_SESSION['search_keyword']."%'))";
		}
		
	}
	else
	{
		$c="";	
	}
	
	if(isset($_SESSION['search_country']))
	{
		if($a!='' || $b!='' || $c!='' && $_SESSION['search_country']!='')
		{
			$d="and country_id='".$_SESSION['search_country']."'";
		}
		elseif($a=='' && $b=='' && $c=='' && $_SESSION['search_country']!='')
		{
			$d="and country_id='".$_SESSION['search_country']."'";
		}
		
	}
	else
	{
		$d="";	
	}
	
	if(isset($_SESSION['search_state']))
	{
		if($a!='' || $b!='' || $c!='' || $d!='' && $_SESSION['search_state']!='')
		{
			$e="and state_id='".$_SESSION['search_state']."'";
		}
		elseif($a=='' && $b=='' && $c=='' && $d=='' && $_SESSION['search_state']!='')
		{
			$e="and state_id='".$_SESSION['search_state']."'";
		}
		
	}
	else
	{
		$e="";	
	}
	
	if(isset($_SESSION['search_city']))
	{
		if($a!='' || $b!='' || $c!='' || $d!='' || $e!='' && $_SESSION['search_city']!='')
		{
			$f="and city='".$_SESSION['search_city']."'";
		}
		elseif($a=='' && $b=='' && $c=='' && $d=='' && $e=='' && $_SESSION['search_city']!='')
		{
			$f="and city='".$_SESSION['search_city']."'";
		}
		
	}
	else
	{
		$f="";	
	}
	
	
	if(isset($_SESSION['search_religion']))
	{
		if($a!='' || $b!='' || $c!='' || $d!='' || $e!='' || $f!='' && $_SESSION['search_religion']!='')
		{
			$g="and religion='".$_SESSION['search_religion']."'";
		}
		elseif($a=='' && $b=='' && $c=='' && $d=='' && $e=='' && $f=='' && $_SESSION['search_religion']!='')
		{
			$g="and religion='".$_SESSION['search_religion']."'";
		}
		
	}
	else
	{
		$g="";	
	}
	
	if(isset($_SESSION['search_caste']))
	{
		if($a!='' || $b!='' || $c!='' || $d!='' || $e!='' || $f!='' || $g!='' && $_SESSION['search_caste']!='')
		{
			$h="and caste='".$_SESSION['search_caste']."'";
		}
		elseif($a=='' && $b=='' && $c=='' && $d=='' && $e=='' && $f=='' && $g=='' && $_SESSION['search_caste']!='')
		{
			$h="and caste='".$_SESSION['search_caste']."'";
		}
		
	}
	else
	{
		$h="";	
	}
	
		
	
  $member_mail=$_SESSION['mem_email'];
  $SQL_STATEMENT='';
  
  $fetch_sel=mysqli_fetch_array($DatabaseCo->dbLink->query("select part_religion,part_caste,gender,birthdate,part_country_living,part_edu,part_mtongue,part_caste,part_height,part_height_to from register_view where email='$member_mail'"));
  
  
  $religion=$fetch_sel['part_religion'];
  $gender=$fetch_sel['gender']  ;
  

  if($fetch_sel['part_religion']!='')
	{
		$prel="and religion IN (".$fetch_sel['part_religion'].")";	
	}
	else
	{
		$prel="";
	}
  if($fetch_sel['part_country_living']!='')
	{
		$pcn="and country_id IN (".$fetch_sel['part_country_living'].")";	
	}
	else
	{
		$pcn="";
	}
	if($fetch_sel['part_edu']!='')
	{
		$pet="and edu_detail IN (".$fetch_sel['part_edu'].")";	
	}
	else
	{
		$pet="";
	}
	if($fetch_sel['part_mtongue']!='')
	{
		$pmt="and m_tongue IN (".$fetch_sel['part_mtongue'].")";	
	}
	else
	{
		$pmt="";
	}
	if($fetch_sel['part_caste']!='')
	{
		$pcst="and caste IN (".$fetch_sel['part_caste'].")";	
	}
	else
	{
		$pcst="";
	}
	if($fetch_sel['part_height']!='' && $fetch_sel['part_height_to']!='')
	{
		$phgt="and height BETWEEN '".$fetch_sel['part_height']."' AND '".$fetch_sel['part_height_to']."' ";	
	}
	else
	{
		$phgt="";
	}

    $age= floor((time() - strtotime($fetch_sel['birthdate']))/31556926);	   
  	$t1=$age-8;
	$t2=$age+8;
  
 
		
		$rows = mysqli_num_rows($DatabaseCo->dbLink->query("select * from register_view where gender!='".$gender."' AND (( ( date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) ) ) BETWEEN ".$t1." AND ".$t2.") $prel $pcn $a $b $c $d $e $f $g $h"));
			
		 $sql = "SELECT * FROM register_view where gender!='".$gender."' AND (( ( date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) ) ) BETWEEN ".$t1." AND ".$t2.") $prel $pcn $a $b $c $d $e $f $g $h LIMIT $start, $limit";  
		// $rows = mysqli_num_rows($DatabaseCo->dbLink->query("select * from register_view $a $b $c $d $e $f $g $h"));
		
		// $sql = "SELECT * FROM register_view $a $b $c $d $e $f $g $h LIMIT $start, $limit";  
		
	 $data= $DatabaseCo->dbLink->query($sql);
	
		?>
        
        <?php
		
		  if($rows>0)
		   {
		?>
        
        <?php if($b!='' || $c!='' || $d!='' || $e!='' || $f!='' || $g!='' || $h!='') {?>
         <div class="col-xs-12">
                    <div class="nodata-avail">
                        
                        <h5>Search : <?php
						
						 if(isset($_SESSION['search_gender'])){ echo "Gender: ".$_SESSION['search_gender']."  ||";}?> <?php if(isset($_SESSION['search_keyword'])){ echo " Keyword: ".$_SESSION['search_keyword']." ||";}?> <?php if(isset($_SESSION['search_castenm'])){ echo " Caste: ".$_SESSION['search_castenm']." ||";}?> <?php if(isset($_SESSION['search_relnm'])){ echo " Religion: ".$_SESSION['search_relnm']." ||";}?> <?php if(isset($_SESSION['search_cntnm'])){ echo " Country: ".$_SESSION['search_cntnm']." ||";}?> <?php if(isset($_SESSION['search_statenm'])){ echo " State: ".$_SESSION['search_statenm']." ||";}?> <?php if(isset($_SESSION['search_citynm'])){ echo " City: ".$_SESSION['search_citynm']." ||";}?> </h5>
                    </div>
	     </div>
        
		
		<?php 
		}
			?><form action="" method="post" class="form-data" id="action_form"><?php
			   while($Row = mysqli_fetch_object($data))
				{
						
						
						if($Row->part_religion!='')
						{
							$prel="and religion IN (".$Row->part_religion.")";	
						}
						else
						{
							$prel="";
						}

						if($Row->part_country_living!='')
						{
							$pcn="and country_id IN (".$Row->part_country_living.")";	
						}
						else
						{
							$pcn="";
						}
						if($Row->part_edu!='')
						{
							$pet="and edu_detail IN (".$Row->part_edu.")";	
						}
						else
						{
							$pet="";
						}
						if($Row->part_mtongue!='')
						{
							$pmt="and m_tongue IN (".$Row->part_mtongue.")";	
						}
						else
						{
							$pmt="";
						}
						if($Row->part_caste!='')
						{
							$pcst="and caste IN (".$Row->part_caste.")";	
						}
						else
						{
							$pcst="";
						}
						if($Row->part_height!='' && $Row->part_height_to!='')
						{
							$phgt="and height BETWEEN '".$Row->part_height."' AND '".$Row->part_height_to."' ";	
						}
						else
						{
							$phgt="";
						}
						

						$age= floor((time() - strtotime($Row->birthdate))/31556926);
						   
						$t1=$age-8; $t2=$age+8;
							
						$sql_match="select * from register_view where gender!='".$Row->gender."' AND (( ( date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) ) ) BETWEEN ".$t1." AND ".$t2.") $prel $pcn ";
					 
					 $sm=mysqli_num_rows($DatabaseCo->dbLink->query($sql_match));
	 
					
					include "../page-part/admin-match-result.php";
				}
				?></form><?php
				   
		     pagination($limit,$adjacent,$rows,$page);  
		   }
		  
		   else
		   {
			
		?>
                  <div class="col-xs-12">
                    <div class="nodata-avail">
                        <h1>There are no data for <?php echo strtoupper($member_status); ?> Members. Please add data.</h1>
                        <br/>
                        <img src="../img/nodata.jpg" alt="No Data" style="border: 2px solid #ccc;"/>
                    </div>
	             </div>
      <?php	
		   }   
 		?>
         
   <div class="modal fade-in " id="modal-14" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>    

<div class="modal fade-in " id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>  
<div class="modal fade-in" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>   
<div class="modal fade-in" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>   
<div class="modal fade-in" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<script src="../js/function.js" type="text/javascript"></script>
                                               
    <?php
}

function pagination($limit,$adjacents,$rows,$page)
{
		
	$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit );	
	$next_='';
	$last='';
	if($lastpage > 1)
	{	
		
		if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">Previous</a>";
		else{
			//$pagination.= "<span class=\"disabled\">previous</span>";	
			}
		
		//pages	
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		       $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			//close to end; only hide early pages
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
            
			}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">Next</a>";
		else{
			//$pagination.= "<span class=\"disabled\">next</span>";
			}
		$pagination = "<div class='col-xs-12 col-md-12 col-lg-12 col-sm-12 ne-result-pagination'><div class='row'><nav class='center-text'>
		<ul class=\"pagination\"><li>"
		.$first."</li><li>".$prev_.$pagination."</li><li>".$next_.$last."</li>";
		//next button
		
		$pagination.= "</ul></nav></div></div>\n";	
	}
	echo $pagination;  
}
?>
<style>
nav.center-text
{
	background:none;	
}
.current {
    background: none repeat scroll 0 0 #428bca !important;
    color: #fff !important;
}
</style>

