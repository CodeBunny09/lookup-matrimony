<?php
include_once '../../databaseConn.php';
$DatabaseCo = new DatabaseConn();
if (isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction'] != '') {
    $page     = $_REQUEST['page'];
    $limit    = 10;
    $adjacent = 5;
    if ($page == 1) {
        $start = 0;
    } else {
        $start = ($page - 1) * $limit;
    }
	
	if (isset($_SESSION['franchies_id'])) {
       $franchies_id = $_SESSION['franchies_id'];
    } else {
        $franchies_id="";
    }
	 

    if (isset($_POST['plan_status'])) {
        $plan_status = $_POST['plan_status'];
         $_SESSION['plan_status_se'] = $plan_status;
    } elseif (!isset($_SESSION['plan_status_se'])) {
        $plan_status = '';
    } else {
       $plan_status = $_SESSION['plan_status_se'];
    }
	
	 if (isset($_POST['status'])) {
        $member_status = $_POST['status'];
        $_SESSION['memstatus'] = $member_status;
    } elseif (!isset($_SESSION['memstatus'])) {
        $member_status = '';
    } else {
        $member_status = $_SESSION['memstatus'];
    }
	
    if (isset($_POST['m_status'])) {
        $match_status = $_POST['m_status'];
        $_SESSION['m_status'] = $match_status;
    } elseif (!isset($_SESSION['m_status'])) {
        $match_status = '';
    } else {
        $match_status = $_SESSION['m_status'];
    }
	if ($franchies_id  != '') {
        $franchies_id = "where franchies_id='" . $franchies_id . "'";
    }  else {
        $franchies_id = '';
    }
	
    /*if ($member_status != '' && $member_status != 'Featured' && $member_status != 'All') {
        $a = "where status='" . $member_status . "'";
    } else if ($member_status != '' && $member_status == 'Featured') {
       $a = "where fstatus='" . $member_status . "'";
    } else {
        $a = '';
    }*/
	/*if ($member_status != '' && $member_status != 'Featured' && $member_status != 'All') {
		if($member_status=='Paid'){
			$a = "where status='" . $member_status . "' OR status='Active'";
		}else{
			$a = "where status='" . $member_status . "'";
		}
    } else if ($member_status != '' && $member_status == 'Featured') {
       $a = "where fstatus='" . $member_status . "'";
    } else {
        $a = 'Paid';
    }*/
	$a = "where status='Paid'";
    if (isset($_SESSION['search_gender'])) {
        if ($a != '' && $_SESSION['search_gender'] != '') {
            $b = "and gender='" . $_SESSION['search_gender'] . "'";
        } elseif ($a == '' && $_SESSION['search_gender'] != '') {
            $b = "where gender='" . $_SESSION['search_gender'] . "'";
        }
    } else {
        $b = "";
    }
    if (isset($_SESSION['search_keyword'])) {
        if ($a != '' || $b != '' && $_SESSION['search_keyword'] != '') {
            $c = "and ((email like '%" . $_SESSION['search_keyword'] . "%') OR (matri_id = '" . $_SESSION['search_keyword'] . "') OR (firstname like '%" . $_SESSION['search_keyword'] . "%') OR (lastname like '%" . $_SESSION['search_keyword'] . "%'))";
        } elseif ($a == '' && $b == '' && $_SESSION['search_keyword'] != '') {
            $c = "where ((email like '%" . $_SESSION['search_keyword'] . "%') OR (matri_id = '" . $_SESSION['search_keyword'] . "') OR (firstname like '%" . $_SESSION['search_keyword'] . "%') OR (lastname like '%" . $_SESSION['search_keyword'] . "%'))";
        }
    } else {
        $c = "";
    }
    if (isset($_SESSION['search_country'])) {
        if ($a != '' || $b != '' || $c != '' && $_SESSION['search_country'] != '') {
            $d = "and country_id='" . $_SESSION['search_country'] . "'";
        } elseif ($a == '' && $b == '' && $c == '' && $_SESSION['search_country'] != '') {
            $d = "where country_id='" . $_SESSION['search_country'] . "'";
        }
    } else {
        $d = "";
    }
    if (isset($_SESSION['search_state'])) {
        if ($a != '' || $b != '' || $c != '' || $d != '' && $_SESSION['search_state'] != '') {
            $e = "and state_id='" . $_SESSION['search_state'] . "'";
        } elseif ($a == '' && $b == '' && $c == '' && $d == '' && $_SESSION['search_state'] != '') {
            $e = "where state_id='" . $_SESSION['search_state'] . "'";
        }
    } else {
        $e = "";
    }
    if (isset($_SESSION['search_city'])) {
        if ($a != '' || $b != '' || $c != '' || $d != '' || $e != '' && $_SESSION['search_city'] != '') {
            $f = "and city='" . $_SESSION['search_city'] . "'";
        } elseif ($a == '' && $b == '' && $c == '' && $d == '' && $e == '' && $_SESSION['search_city'] != '') {
            $f = "where city='" . $_SESSION['search_city'] . "'";
        }
    } else {
        $f = "";
    }
    if (isset($_SESSION['search_religion'])) {
        if ($a != '' || $b != '' || $c != '' || $d != '' || $e != '' || $f != '' && $_SESSION['search_religion'] != '') {
            $g = "and religion='" . $_SESSION['search_religion'] . "'";
        } elseif ($a == '' && $b == '' && $c == '' && $d == '' && $e == '' && $f == '' && $_SESSION['search_religion'] != '') {
            $g = "where religion='" . $_SESSION['search_religion'] . "'";
        }
    } else {
        $g = "";
    }
    if (isset($_SESSION['search_caste'])) {
        if ($a != '' || $b != '' || $c != '' || $d != '' || $e != '' || $f != '' || $g != '' && $_SESSION['search_caste'] != '') {
            $h = "and caste='" . $_SESSION['search_caste'] . "'";
        } elseif ($a == '' && $b == '' && $c == '' && $d == '' && $e == '' && $f == '' && $g == '' && $_SESSION['search_caste'] != '') {
            $h = "where caste='" . $_SESSION['search_caste'] . "'";
        }
    } else {
        $h = "";
    }
	
    $rows = mysqli_num_rows($DatabaseCo->dbLink->query("select * from register_view $a $b $c $d $e $f $g $h $franchies_id"));
    $sql  = "SELECT * FROM register_view $a $b $c $d $e $f $g $h $franchies_id ORDER BY reg_date DESC LIMIT $start, $limit";
    $data = $DatabaseCo->dbLink->query($sql);
?>
<?php
    if ($b != '' || $c != '' || $d != '' || $e != '' || $f != '' || $g != '' || $h != '') {
?>
<div class="col-xs-12">
   <div class="nodata-avail">
      <h5>Search : <?php
        if (isset($_SESSION['search_gender'])) {
            echo "<b>Gender</b> : " . $_SESSION['search_gender'] . ",  ";
        }
?>
         <?php
        if (isset($_SESSION['search_keyword'])) {
            echo "<b>Keyword</b> : " . $_SESSION['search_keyword'] . ", ";
        }
?> 			
         <?php
        if (isset($_SESSION['search_castenm'])) {
            echo "<b>Caste</b> : " . $_SESSION['search_castenm'] . ", ";
        }
?>
         <?php
        if (isset($_SESSION['search_relnm'])) {
            echo "<b>Religion</b> : " . $_SESSION['search_relnm'] . ", ";
        }
?> 
         <?php
        if (isset($_SESSION['search_cntnm'])) {
            echo "<b>Country</b> : " . $_SESSION['search_cntnm'] . ", ";
        }
?>
         <?php
        if (isset($_SESSION['search_statenm'])) {
            echo "<b>State</b> : " . $_SESSION['search_statenm'] . ", ";
        }
?> 							 			 
         <?php
        if (isset($_SESSION['search_citynm'])) {
            echo "<b>City</b> : " . $_SESSION['search_citynm'] . ", ";
        }
?>
      </h5>
   </div>
</div>
<?php
    }
    if ($rows > 0) {
        while ($Row = mysqli_fetch_object($data)) {
            if (isset($_SESSION['m_status']) && $_SESSION['m_status'] == 'match') {
                if ($Row->part_religion != '' && $Row->part_religion != 'any') {
                    $prel = "and religion IN (" . $Row->part_religion . ")";
                } else {
                    $prel = "";
                }
                if ($Row->part_country_living != '' && $Row->part_country_living != 'any') {
                    $pcn = "and country_id IN (" . $Row->part_country_living . ")";
                } else {
                    $pcn = "";
                }
                if ($Row->part_edu != '' && $Row->part_edu != 'any') {
                    $pet = "and edu_detail IN (" . $Row->part_edu . ")";
                } else {
                    $pet = "";
                }
                if ($Row->part_mtongue != '' && $Row->part_mtongue != 'any') {
                    $pmt = "and m_tongue IN (" . $Row->part_mtongue . ")";
                } else {
                    $pmt = "";
                }
                if ($Row->part_caste != '' && $Row->part_caste != 'any') {
                    $pcst = "and caste IN (" . $Row->part_caste . ")";
                } else {
                    $pcst = "";
                }
                if ($Row->part_height != '' && $Row->part_height_to != '') {
                    $phgt = "and height BETWEEN '" . $Row->part_height . "' AND '" . $Row->part_height_to . "' ";
                } else {
                    $phgt = "";
                }
                $age       = floor((time() - strtotime($Row->birthdate)) / 31556926);
                $t1        = $age - 8;
                $t2        = $age + 8;
                $sql_match = "select index_id from register_view where gender!='" . $Row->gender . "' AND (( ( date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) ) ) BETWEEN " . $t1 . " AND " . $t2 . ") $prel $pcn ";
                $sm        = mysqli_num_rows($DatabaseCo->dbLink->query($sql_match));
            }
            include "../page-part/adminResult.php";
        }
        pagination($limit, $adjacent, $rows, $page);
    } else {
?>
<div class="col-xs-12 mt-10">
  	<div class="row">
   <div class="nodata-avail">
    
      <img src="img/no-data-available.jpg" alt="No Data" class="img-responsive"/>
   </div>
   </div>
</div>
<?php
    }
?>
<div class="modal fade-in " id="modal-14" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<script src="../js/function.js" type="text/javascript"></script>
<?php
}
function pagination($limit, $adjacents, $rows, $page){
    $pagination = '';
    if ($page == 0)
        $page = 1;
    $prev     = $page - 1; //previous page is page - 1
    $next     = $page + 1; //next page is page + 1
    $prev_    = '';
    $first    = '';
    $lastpage = ceil($rows / $limit);
    $next_    = '';
    $last     = '';
    if ($lastpage > 1) {
        if ($page > 1)
            $prev_ .= "<a class='page-numbers' href=\"?page=$prev\">Previous</a>";
        else {
            //$pagination.= "<span class=\"disabled\">previous</span>";	
        }
        //pages	
        if ($lastpage < 5 + ($adjacents * 2)) {
            $first = '';
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination .= "<span class=\"current\">$counter</span>";
                else
                    $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
            }
            $last = '';
        } elseif ($lastpage > 3 + ($adjacents * 2)) {
            //close to beginning; only hide later pages
            $first = '';
            if ($page < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span class=\"current\">$counter</span>";
                    else
                        $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                }
                $last .= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
            }
            //in middle; hide some front and some back
            elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                $first .= "<a class='page-numbers' href=\"?page=1\">First</a>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span class=\"current\">$counter</span>";
                    else
                        $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                }
                $last .= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";
            }
            //close to end; only hide early pages
            else {
                $first .= "<a class='page-numbers' href=\"?page=1\">First</a>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<span class=\"current\">$counter</span>";
                    else
                        $pagination .= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";
                }
                $last = '';
            }
        }
        if ($page < $counter - 1)
            $next_ .= "<a class='page-numbers' href=\"?page=$next\">Next</a>";
        else {
            //$pagination.= "<span class=\"disabled\">next</span>";
        }
        $pagination = "<div class='col-xs-12 col-md-12 col-lg-12 col-sm-12 text-center'><div class='row'><nav class='center-text'>
   		<ul class=\"pagination\"><li>" . $first . "</li><li>" . $prev_ . $pagination . "</li><li>" . $next_ . $last . "</li>";
        //next button
        $pagination .= "</ul></nav></div></div>\n";
    }
    echo $pagination;
}
?>