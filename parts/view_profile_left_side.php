<a class="btn gt-btn-green btn-block gt-margin-bottom-20 hidden-xxl hidden-xl" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
 					Options <i class="fa fa-angel-down"></i>
				</a>
                <div class="collapse mobile-collapse" id="collapseExample">
                <div class="gt-left-opt-msg">
            		<ul>
                		<li>
                    		<a href="sentMessages"><i class="fa fa-paper-plane gt-margin-right-10"></i>Send Message</a>
                    	</li>
                    	<li>
                    		<a href="my-photo"><i class="fa fa-picture-o gt-margin-right-10"></i>View Photoes</a>
                    	</li>
                	</ul>
                </div>
            	<div class="gt-left-opt-msg">
            		<ul>
                    	<li>
                    		<a class="gt-bg-orange text-center gt-text-white"><i class="fa fa-envelope gt-margin-right-10"></i>Messages</a>
                    	</li>
                		<li>
                    		<a href="inboxMessages"><span class="pull-left">Inbox</span><span class="pull-right badge"><?php echo $inbox_cnt1=mysqli_num_rows($DatabaseCo->dbLink->query("select mes_id from messages where to_id='".$_SESSION['user_id']."' and msg_status='sent' and trash_receiver='No'"));	?></span></a>
                    	</li>
                    	<li>
                    		<a href="sentMessages"><span class="pull-left">Sent</span><span class="pull-right badge"><?php echo $sent_cnt2=mysqli_num_rows($DatabaseCo->dbLink->query("select mes_id from messages where from_id='".$_SESSION['user_id']."' and msg_status='sent' and trash_sender='No'")); ?></span></a>
                    	</li>
                	</ul>
                </div>
                <div class="gt-left-opt-msg">
            		<ul>
                    	<li>
                    		<a class="gt-bg-orange text-center gt-text-white"><i class="fa fa-star gt-margin-right-10"></i>Interest</a>
                    	</li>
                		<li>
                    		<a href="exp-interest"><span class="pull-left">Received</span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_sender and ei_receiver='$mid' and trash_receiver='No' "));?></span></a>
                    	</li>
                    	<li>
                    		<a href="exp-interest"><span class="pull-left">Sent</span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT ei_id FROM expressinterest,register_view WHERE register_view.matri_id=expressinterest.ei_receiver and ei_sender='$mid' and trash_sender='No' "));?></span></a>
                    	</li>
                	</ul>
                </div>
                <div class="gt-left-opt-msg">
            		<ul>
                    	<li>
                    		<a class="gt-bg-orange text-center gt-text-white"><i class="fa fa-picture-o gt-margin-right-10"></i>Photo Request</a>
                    	</li>
                		<li>
                    		<a href="photo-request"><span class="pull-left">Received</span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_receiver_id and ph_requester_id='$mid' and receiver_response='Pending'"));?></span></a>
                    	</li>
                    	<li>
                    		<a href="photo-request"><span class="pull-left">Sent</span><span class="pull-right badge"><?php echo mysqli_num_rows($DatabaseCo->dbLink->query("SELECT * FROM photoprotect_request,register_view WHERE register_view.matri_id=photoprotect_request.ph_requester_id and ph_receiver_id='$mid' and receiver_response='Pending'"));?></span></a>
                    	</li>
                	</ul>
                </div>
                </div>