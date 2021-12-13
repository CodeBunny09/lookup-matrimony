<?php 
$get_page=explode("/",$_SERVER["REQUEST_URI"]);
$get_lenght_nm=count($get_page);
$get_lenght_nm=$get_lenght_nm-1;
$sent_cnt=mysqli_num_rows($DatabaseCo->dbLink->query("select mes_id from messages where from_id='".$_SESSION['user_id']."' and msg_status='sent' and trash_sender='No'"));			
$trash_cnt=mysqli_num_rows($DatabaseCo->dbLink->query("select * from messages where (from_id='".$_SESSION['user_id']."' and trash_sender='Yes' and msg_status='trash') or (to_id='".$_SESSION['user_id']."' and trash_receiver='Yes' and msg_status='trash') order by mes_id desc"));			
$important_cnt=mysqli_num_rows($DatabaseCo->dbLink->query("select mes_id from messages where (from_id='".$_SESSION['user_id']."' OR to_id='".$_SESSION['user_id']."') and msg_important_status='Yes' and trash_sender='No'"));			
$inbox_cnt=mysqli_num_rows($DatabaseCo->dbLink->query("select mes_id from messages where to_id='".$_SESSION['user_id']."' and msg_status='sent' and trash_receiver='No'"));			
?>

<div class="col-xxl-3 col-xl-4 gt-left-opt-msg">
            	<a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
 					Options <i class="fa fa-angel-down"></i>
				</a>
                <div class="collapse mobile-collapse" id="collapseExample">
 					<div class="col-xs-16 gt-margin-bottom-10">
                	<div class="row">
                		<a href="composeMessages.php" class="btn gt-btn-orange btn-block gt-btn-lg" data-toggle="popover" title="<?php if($_SESSION['mem_status']=='Active'){?>Upgrade Membership<?php }?>"  data-content="<?php if($_SESSION['mem_status']=='Active'){?>You have to upgrade membership to send mail</br><a href='membershipplans'> Upgrade Membership <i class='fa fa-caret-right'></i></a><?php }?>" data-html="enabled"><i class="fa fa-envelope gt-margin-right-10"></i>Send Message</a>
                   <a href="sms-sending.php" class="btn gt-btn-orange btn-block gt-btn-lg" ><i class="fa fa-tablet gt-margin-right-10"></i>Send SMS</a>
                    </div>
                </div>
            	<ul>
                	<li class="<?php if($get_page[$get_lenght_nm]=='inboxMessages'){echo "active";}?>">
                    	<a href="inboxMessages.php"><span class="pull-left">Inbox</span><span class="pull-right badge"><?php echo $inbox_cnt;?></span></a>
                    </li>
                    <li class="<?php if($get_page[$get_lenght_nm]=='sentMessages'){echo "active";}?>">
                    	<a href="sentMessages.php"><span class="pull-left">Sent</span><span class="pull-right badge"><?php echo $sent_cnt;?></span></a>
                    </li>
                    <li class="<?php if($get_page[$get_lenght_nm]=='importantMessages'){echo "active";}?>">
                    	<a href="importantMessages.php"><span class="pull-left">Important</span><span class="pull-right badge"><?php echo $important_cnt;?></span></a>
                    </li>
                </ul>
               	<?php include "parts/level-2.php"; ?>
                </div>
           	</div>