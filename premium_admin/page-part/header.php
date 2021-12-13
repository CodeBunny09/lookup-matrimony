<?php 
    if(!isset($_SESSION['admin_user_name'])){
            header("location: index.php");
			echo "<script>window.location='index'</script>";
    }
	$loggedn_user = isset($_SESSION['admin_user_name'])?$_SESSION['admin_user_name']:"Admin";
?>
<header class="main-header">
   <a href="dashboard" class="logo"><b>Control</b> Panel</a>
     <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="javascript:;" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">HELLO, <?php echo strtoupper($loggedn_user);?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <p><?php echo $_SESSION['admin_email'];?></p>
                  </li>
                </ul>
              </li>
              <li>
              	<a href="../index" target="_blank" class="">
                	<span class="pull-left mr-10"><i class="fa fa-desktop"></i></span>
                    <span class="pull-left">FRONT END</span>
                    <div class="clearfix"></div>
                </a>
              </li>
              <li>
              	<a href="index.php?option=logout" class="">
                	<span class="pull-left mr-10"><i class="fa fa-sign-out"></i></span>
                    <span class="pull-left">LOGOUT</span>
                    <div class="clearfix"></div>
                </a>
             </li>
           </ul>
         </div>
       </nav>
    </header>