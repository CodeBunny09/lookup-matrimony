<?php if (isset($_SESSION['user_id'])) { ?>
    <!-- MENU AFTER LOGIN -->
    <nav class="navbar gt-navbar-green flat gt-margin-bottom-0">
        <div class="container">

            <!-- MOBILE MENU BUTTON -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background-color:rgba(247,247,247,1.00);color:rgba(0,0,0,1.00) !important;">
                    <span>MENU</span>
                </button>
            </div>
            <!-- MOBILE MENU BUTTON END-->

            <!-- MENU ITEMS-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active ripplelink"><a href="myHome">MY HOME</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="gt-margin-right-5">MY PROFILE</span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="view-profile">View Profile</a></li>
                            <li><a href="view-profile">Edit Profile</a></li>
                            <li><a href="saved-searches">My Saved Searches</a></li>
                            <li><a href="inboxMessages">My Messages</a></li>
                            <li><a href="exp-interest">My Express Interest</a></li>
                            <li><a href="my-photo">Manage Photo</a></li>
                            <li><a href="horoscope">Manage Horoscope</a></li>
							<li><a href="aadhaar_upload_edit">Manage Document</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="gt-margin-right-5">SEARCH</span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="search?gt-quick-search">Quick Search</a></li>
                            <li><a href="search?gt-basic-search">Basic Search</a></li>
                            <li><a href="search?gt-advance-search">Advanced Search</a></li>
                            <li><a href="search?gt-keyword-search">Keyword Search</a></li>
                            <li><a href="search?gt-location-search">Location Search</a></li>
                            <li><a href="search?gt-occupation-search">Occupation Search</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="gt-margin-right-5">MY MATCHES</span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="one-way-matches">One Way Matches</a></li>
                            <li><a href="two-way-matches">Two Way Matches</a></li>
                            <li><a href="broader-matches">Broader Matches</a></li>
                            <li><a href="preferred-matches">Preferred Matches</a></li>
                            <li><a href="custom-matches">Custom Matches</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="gt-margin-right-5">MEMBERSHIP</span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="membershipplans">Membership Plans</a></li>
                            <li><a href="current-plan">Current Plan</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="gt-margin-right-5">PROFILE DETAILS</span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="shortlisted-members">Shortlisted Profile</a></li>
                            <li><a href="blocklisted-members">Blocked Profile</a></li>
                            <li><a href="member-visited-me">My Profile Viewed By</a></li>
                            <li><a href="i-visited-members">I Visited Profile</a></li>
                            <li><a href="who-watch-mobileno">My Mobile No Viewed By</a></li>
                            <li><a href="photo-request">Photo Password Request</a></li>
                        </ul>
                    </li>                 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown gt-border-right-green gt-border-left-green">
                        <a href="#" class="dropdown-toggle ripplelink gt-padding-left-30 gt-padding-right-30" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-cog"></i> <span class="hidden-xxl hidden-xl hidden-lg">Settings</span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="settings?photoVisiblity">Photo Privacy Setting</a></li>
                            <li><a href="settings?contactdiv">Contact View Setting</a></li>
                            <li><a href="settings?changepass">Change Password</a></li>
                            <li><a href="logout?action=logout">Logout</a></li>
                        </ul>
                    </li>
                    <?php
                    $res_reminder = $DatabaseCo->dbLink->query("select * from reminder where receiver_id='" . $_SESSION['user_id'] . "' and reminder_view_status='Yes' ORDER BY rem_id DESC");
                    ?>
                    <li class="dropdown gt-border-right-green">
                        <a href="#" class="dropdown-toggle ripplelink gt-padding-left-30 gt-padding-right-30" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-bell"></i> <span class="hidden-xxl hidden-xl hidden-lg">Notification</span><span class="badge" style="position:absolute;top:8px;right: 16px;"><?php if ($count=$res_reminder->num_rows > 0){echo $count;}?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($res_reminder->num_rows > 0) { ?>
                                <?php
                                while ($res = mysqli_fetch_object($res_reminder)) {
                                    ?>
                                    <li>
                                        <a href="
                                        <?php
                                        if ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Pending') {
                                            echo "exp-interest?exp-res-pen=" . $res->rem_id . "";
                                        } elseif ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Reject') {
                                            echo "exp-interest?exp-sent-rej=" . $res->rem_id . "";
                                        } elseif ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Accept') {
                                            echo "exp-interest?exp-sent-acc=" . $res->rem_id . "";
                                        } elseif ($res->reminder_mes_type == 'msg') {
                                            echo "inboxMessages?msg-id=" . $res->rem_id . "";
                                        } elseif ($res->reminder_mes_type == 'photo_req') {
                                            echo "my-photo?mp-rem-id=" . $res->rem_id . "";
                                        } elseif ($res->reminder_mes_type == 'photo_pass_req') {
                                            echo "photo-request?mp-rem-id=" . $res->rem_id . "";
                                        } elseif ($res->reminder_mes_type == 'chk_contact') {
                                            echo "who-watch-mobileno?mp-rem-id=" . $res->rem_id . "";
                                        }
                                        ?>" 
                                           onClick="reminder('<?php echo $res->rem_id; ?>');"> 
                                               <?php
                                               if ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Pending') {
                                                   echo "Express Interest received from " . $res->sender_id . ".";
                                               } elseif ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Accept') {
                                                   echo "Express Interest accepted from " . $res->sender_id . ".";
                                               }
                                               if ($res->reminder_mes_type == 'exp_interest' && $res->reminder_msg == 'Reject') {
                                                   echo "Express Interest rejected from " . $res->sender_id . ".";
                                               }
                                               if ($res->reminder_mes_type == 'msg' && $res->reminder_msg == 'Send') {
                                                   echo "Message received from " . $res->sender_id . ".";
                                               }
                                               if ($res->reminder_mes_type == 'photo_req' && $res->reminder_msg == 'Sent') {
                                                   echo "Photo request received from " . $res->sender_id . ".";
                                               }
                                               if ($res->reminder_mes_type == 'chk_contact' && $res->reminder_msg == 'check') {
                                                   echo "Contact Details check from " . $res->sender_id . ".";
                                               }
                                               if ($res->reminder_mes_type == 'photo_pass_req' && $res->reminder_msg == 'Sent') {
                                                   echo "Photo password request received from " . $res->sender_id . ".";
                                               }
                                               ?>
                                        </a>
                                    </li>
                                <?php } ?>	
                            <?php } else { ?>
                                    <li><a>Not Available</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- MENU ITEMS END -->

        </div>
    </nav>
    <!-- MENU AFTER LOGIN END-->
<?php } else { ?>
    <nav class="navbar gt-navbar-green flat gt-margin-bottom-0">
        <div class="container"> 

            <!-- MOBILE MENU BUTTON -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background-color:rgba(247,247,247,1.00);color:rgba(0,0,0,1.00) !important;">
                    <span>MENU</span>
                </button>
            </div>
            <!-- MOBILE MENU BUTTON END-->

            <!-- MENU ITEMS-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active ripplelink"><a href="index.php"><i class="fa fa-home gt-margin-right-10 fa-lg"></i>HOME</a></li>
                    <li class="dropdown">
                        <a href="search.php" class="dropdown-toggle ripplelink" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="gt-margin-right-5"><i class="fa fa-search gt-margin-right-10 fa-lg"></i>SEARCH</span><span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu flat" role="menu">
                            <li><a href="search?gt-quick-search">Quick Search</a></li>
                            <li><a href="search?gt-basic-search">Basic Search</a></li>
                            <li><a href="search?gt-advance-search">Advanced Search</a></li>
                            <li><a href="search?gt-keyword-search">Keyword Search</a></li>
                            <li><a href="search?gt-location-search">Location Search</a></li>
                            <li><a href="search?gt-occupation-search">Occupation Search</a></li>
                        </ul>
                    </li>
                    <li class="ripplelink"><a href="success-story.php"><i class="fa fa-users gt-margin-right-10 fa-lg"></i>SUCCESS STORY</a></li>
                    <li class="ripplelink"><a href="membershipplans.php"><i class="fa fa-star gt-margin-right-10 fa-lg"></i>MEMBERSHIP</a></li>
                    <li class="ripplelink"><a href="contactUs.php"><i class="fa fa-phone-square gt-margin-right-10 fa-lg"></i>CONTACT US</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="active ripplelink gt-border-right-green gt-border-left-green gtBorderRightSMXS0 gtBorderLeftSMXS0">
                        <a href="login.php"><i class="fa fa-sign-in gt-margin-right-10 fa-lg"></i>LOGIN</a>
                    </li>
                    <li class="ripplelink gt-border-right-green gtBorderRightSMXS0">
                        <a href="index.php"><i class="fa fa-pencil-square gt-margin-right-10 fa-lg"></i>SIGN UP</a>
                    </li>
                </ul>

            </div>
            <!-- MENU ITEMS END -->

        </div>
    </nav>

<?php }
?>