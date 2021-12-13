<?php if (!isset($_SESSION['user_id'])) { ?>
    <header class="container gtHeaderForm">
        <div class="row">

            <!-- LOGO -->
            <div class="col-xxl-5 col-xl-4 col-xs-8 col-md-8 col-lg-5">		
                <a href="index" class="ripplelink">
                    <img src="img/<?php echo $configObj->getConfigLogo(); ?>" class="img-responsive gt-header-logo">
                </a>
            </div>
            <!-- LOGO END -->
            <!-- HEADER LOGIN FORM STARTS HERE -->
            <div class="col-xxl-8 col-xl-10 col-lg-11 col-xs-16 col-sm-16 col-md-16 pull-right gt-margin-top-20 hidden-xs hidden-sm hidden-md">
                <div class="row">
                    <form action="login" method="post" id="headerloginForm">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 form-group gt-margin-bottom-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope fa-fw"></i></span>
                                <input  type="text" class="gt-form-control" name="username" id="username" placeholder="Enter your login id" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 form-group gt-margin-bottom-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-unlock-alt fa-fw"></i></span>
                                <input  type="password" class="gt-form-control" placeholder="Enter your password" name="password" id="password" aria-describedby="basic-addon2" required>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 form-group gt-margin-bottom-10">
                            <input type="submit" class="btn gt-btn-orange btn-block gt-btn-lg" name="member_login" value="LOGIN">
                        </div>
                    </form>	
                </div>
                <div class="row">
                    <div class="col-xxl-5 pull-right text-right">
                        <a href="forgot-password-password" class="gt-text-Grey">Need Help To login ?</a>
                    </div>
                </div>
            </div>
            <!-- HEADER LOGIN FORM END HERE -->
            
            <!-- HEADER LOGIN MOBILE-->
            <div class="col-xs-8 visible-xs visible-sm visible-md text-right">
            	<a class="btn gt-btn-orange gt-margin-top-15" role="button" data-toggle="collapse" href="#collapseHeadLogin" aria-expanded="false" aria-controls="collapseHeadLogin">
 					Login
				</a>
			</div>
			<!-- HEADER LOGIN MOBILE END-->
        </div>
        <div class="container gt-margin-top-15">
        <div class="row ">
        	<div class="collapse" id="collapseHeadLogin">
   				<div class="row">
                    <form action="login" method="post" id="headerloginForm">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 form-group gt-margin-bottom-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope fa-fw"></i></span>
                                <input  type="text" class="gt-form-control" name="username" id="username" placeholder="Enter your login id" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 form-group gt-margin-bottom-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-unlock-alt fa-fw"></i></span>
                                <input  type="password" class="gt-form-control" placeholder="Enter your password" name="password" id="password" aria-describedby="basic-addon2" required>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 form-group gt-margin-bottom-10">
                            <input type="submit" class="btn gt-btn-orange btn-block gt-btn-lg" name="member_login" value="LOGIN">
                        </div>
                    </form>	
                </div>
                <div class="row">
                    <div class="col-xxl-5 pull-right text-right">
                        <a href="forgot-password-password" class="gt-text-Grey">Need Help To login ?</a>
                    </div>
                </div>
			</div>
        </div>
		</div>
    </header>
    <?php
} else {
    ?>
    <!--MENU AFTER LOGIN STARTS HERE -->
    <header class="container">
        <div class="row">

            <!-- LOGO -->
            <div class="col-xxl-5 col-sm-6 col-xs-6 col-md-6 col-lg-4">
                <a href="index" class="ripplelink">
                    <img src="img/<?php echo $configObj->getConfigLogo(); ?>" class="img-responsive">
				</a>
            </div>
            <!-- LOGO END-->
            <!-- MOBILE BUTTON END --->
            
            <div class="col-sm-10 col-xs-10 col-md-10 visible-xs visible-sm visible-md pull-right text-right gt-padding-top-10">
            
            	<a class="btn gt-btn-orange" role="button" data-toggle="collapse" href="#collapseHeadDetails" aria-expanded="false" aria-controls="collapseHeadDetails">
            		
					<p class="gt-margin-bottom-0 gt-margin-top-0"><?php echo $_SESSION['uname']; ?></b>&nbsp;&nbsp;<i class="fa fa-angle-down"></i></p>
				</a>
			</div>
           
            <!--MOBILE BUTTON END HERE --->
            <div class="collapse mobile-collapse" id="collapseHeadDetails">
            <div class="col-xxl-5 col-sm-16 col-xs-16 col-md-10 col-lg-8 pull-right gt-margin-top-10">
               	<div class="row">
                <!-- USER IMG THUMBNAIL -->
                <div class="col-xxl-4 col-xs-4 col-md-5">
                    <div id="dis_thumbnail"></div>
                </div>
				<!-- USER IMG THUMBNAIL END-->

                <!--USERNAME AND LAST LOGIN DETAIL -->
                
                <div class="col-xxl-11 col-xs-12 col-md-11">

                    <h5 class="gt-margin-bottom-5 gt-margin-top-5"><b><?php echo $_SESSION['uname']; ?></b> : <b><span class="gt-text-orange"><?php echo $_SESSION['user_id']; ?></span></b> </h5>
					<?php
						$matri_id_logged=$_SESSION['user_id'];
						$SQL_STATEMENT_GETLOG=$DatabaseCo->dbLink->query("SELECT last_login FROM register WHERE matri_id='$matri_id_logged'");
						$logged_data=mysqli_fetch_object($SQL_STATEMENT_GETLOG);
						if($logged_data->last_login != '' || $logged_data->last_login != NULL ){
					?>
                    <p class="gt-margin-bottom-5 font-13">Last Login: 
                        <span class="gt-text-orange">
                            <?php
                            $date = strtotime($_SESSION['last_login']);
                            echo date('H:i , jS F Y', $date);
                            ?>
                            
                        </span>
                    </p>
					<?php } ?>
                    <p class="gt-margin-bottom-5 font-13">Membership : <span class="gt-text-orange"><?php echo $_SESSION['mem_status']; ?></span></p>
                    <h6 class="gt-margin-bottom-0 gt-margin-top-5">
                    	<?php if($_SESSION['mem_status']=='Free'){?>
                        <a href="membershipplans">Upgrade Membership <i class="fa fa-caret-right gt-margin-right-5"></i></a>
                        <?php } ?>
                    </h6>
                </div>
                <!--USERNAME AND LAST LOGIN DETAIL END-->
				</div>
            </div> 
			</div>
        </div>
        
    </header>
    <!--MENU AFTER LOGIN END HERE -->
	
    <?php
}?>