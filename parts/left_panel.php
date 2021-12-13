<div class="gt-panel gt-panel-orange">
    <div class="gt-panel-head">
        <div class="gt-panel-title text-center">
            MESSAGES
        </div>
    </div>
    <div class="gt-left-pan-option">
        <div class="row">
            <a href="inboxMessages" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        Inbox
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo $inbox_cnt = mysqli_num_rows($DatabaseCo->dbLink->query("select mes_id from messages where to_id='" . $_SESSION['user_id'] . "' and msg_status='sent' and trash_receiver='No'")); ?>
                        </div>
                    </span>
                </div>
            </a>
            <a href="sentMessages" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        Outbox
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo $sent_cnt = mysqli_num_rows($DatabaseCo->dbLink->query("select mes_id from messages where from_id='" . $_SESSION['user_id'] . "' and msg_status='sent' and trash_sender='No'")); ?>
                        </div>
                    </span>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="gt-panel gt-panel-orange">
    <div class="gt-panel-head">
        <div class="gt-panel-title text-center">
            MY PROFILE 
        </div>
    </div>
    <div class="gt-left-pan-option">
        <div class="row">
            <a href="view-profile" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                Edit profile
            </a>
            <a href="my-photo" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                Manage Photoes
            </a>
        </div>
    </div>
</div>
<div class="gt-panel gt-panel-orange">
    <div class="gt-panel-head">
        <div class="gt-panel-title text-center">
            PROFILE DETAILS
        </div>
    </div>
    <div class="gt-left-pan-option">
        <div class="row">
            <a href="exp-interest" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        Express Interest Received
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_sender and ei_receiver='$mid' and trash_receiver='No' ")); ?>
                        </div>
                    </span>
                </div>
            </a>
            <a href="shortlisted-members" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        My Shortlist Profile
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id from register_view JOIN shortlist ON shortlist.to_id=register_view.matri_id where from_id='$mid'")); ?>
                        </div>
                    </span>
                </div>
            </a>
            <a href="blocklisted-members" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        My Blocklist Profile
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id from register_view JOIN block_profile ON block_profile.block_to=register_view.matri_id where block_by='$mid'")); ?>
                        </div>
                    </span>
                </div>
            </a>

            <a href="member-visited-me" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        My Profile Viewd By
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.my_id=register_view.matri_id where who_viewed_my_profile.viewed_member_id='$mid'")); ?>
                        </div>
                    </span>
                </div>
            </a>
            <a href="i-visited-members" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        I Visited Profile
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT matri_id FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.viewed_member_id=register_view.matri_id where who_viewed_my_profile.my_id='$mid'")); ?>
                        </div>
                    </span>
                </div>
            </a>
            <a href="who-watch-mobileno" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        Mobile numbers viewed by me
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM contact_view JOIN register_view ON contact_view.my_id=register_view.matri_id where contact_view.viewed_mem_id='$mid'")); ?>
                        </div>
                    </span>
                </div>
            </a>

            <a href="photo-request" class="col-xxl-16 col-xl-16 col-xs-16 ripplelink">
                <div class="row">
                    <div class="col-xxl-13 col-xl-12 col-xs-13">
                        Photo Password Request Received
                    </div>
                    <span class="col-xxl-3 col-xs-3 col-xl-4">
                        <div class="badge">
                            <?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_receiver_id and ph_requester_id='$mid' and receiver_response='Pending' ORDER BY ph_reqdate DESC")); ?>
                        </div>
                    </span>
                </div>
            </a>
        </div>
    </div>
</div>
<?php
$sel_left_search = $DatabaseCo->dbLink->query("select * from save_search where matri_id='" . $_SESSION['user_id'] . "' order by rand() limit 0,2");
if ($sel_left_search->num_rows > 0) {
    ?>
    <div class="gt-panel gt-panel-orange">
        <div class="gt-panel-head">
            <div class="gt-panel-title text-center">
                SAVED SEARCHES
            </div>
        </div>
        <div class="gt-saved-search">
            <div class="row">
                <?php
                while ($get_ss_data = mysqli_fetch_object($sel_left_search)) {
                    ?>
                    <a href="search_result.php?ss_id=<?php echo$get_ss_data->ss_id; ?>" class="col-xxl-16 col-xl-16 col-xs-16 col-lg-8 ripplelink" >
                        <h4 class="gt-text-orange">
                            <?php echo $get_ss_data->ss_name; ?>
                        </h4>
                        <h5>
                            <i class="fa fa-calendar gt-margin-right-5"></i><?php echo date('d M Y ,H:i A', strtotime($get_ss_data->save_date)); ?> 
                        </h5>

                    </a>
                <?php } ?>
          
            </div>
        </div>
    </div>
<?php } ?>
