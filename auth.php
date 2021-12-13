<?php
    if(!isset($_SESSION['user_name']) || (trim($_SESSION['user_id']) == ''))
	 {
               echo "<script>window.location='login'</script>";
     }
?>