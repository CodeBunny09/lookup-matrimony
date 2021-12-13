								<div class="col-lg-4 col-lg-offset-0 col-xxl-3 col-xxl-offset-0 col-xl-offset-0 col-xl-3 col-sm-10 col-sm-offset-3 col-xs-10 col-xs-offset-3 col-md-6 col-md-offset-0">
                                    <a href="member-profile?view_id=<?php echo $Row->matri_id;?>">
                                      <?php include('../parts/exp-result-photo.php');?>
                                    </a>
                                </div>
								<div class="col-xxl-13 col-xl-13 col-xs-16 col-sm-16 col-md-10 col-lg-12">
                                    	<div class="row">
                                        	<div class="col-xxl-8 col-xl-8 col-xs-16 col-lg-8 col-md-16 text-center">
                                    			<a href="member-profile?view_id=<?php echo $Row->matri_id;?>" class="gt-text-black">
                                        			<h4 class="<?php if($username_settings->username_setting == 'hide_username'){echo 'text-left';} ?>">
                                                                       <?php if($username_settings->username_setting == 'full_username'){?>
                  														<?php echo $Row->username; ?>
																	  	<?php }elseif($username_settings->username_setting == 'first_surname'){?>
																		<?php echo $Row->firstname." ".substr($Row->lastname, 0, 1); ?>
																	<?php }else{ ?>
																	<?php } ?>
																		(<?php echo $Row->matri_id;?>)
                                                                    </h4>
                                        		</a>
                                            </div>
                                            <div class="col-xxl-8 col-xl-8 col-xs-16 col-lg-8 col-md-16  text-center">
                                            	<label class="gt-margin-top-10"><?php  
												$date=date_create($Row->ei_sent_date);
												echo date_format($date,'g:ia jS F Y'); ?> </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                        	<div class="col-xxl-16 col-xl-16 col-md-16 col-lg-16 col-sm-16">
                                            	<h5 class="gt-text-orange">
                                                	<i class="fa fa-paper-plane gt-margin-right-10"></i> Express Interest Sent
                                                </h5>
                                        	</div>
                                        </div>
                                        <div class="row">
                                        	<div class="col-xxl-16 col-xl-16 col-md-16 col-lg-16 col-sm-16">
                                            	<p class="gt-margin-top-0">
                                                	<?php echo $Row->ei_message; ?>
                                                </p>
                                        	</div>
                                        </div>
                                    </div>
									<div class="col-xxl-16 col-lg-16 col-xs-16 col-sm-16 col-md-16">
                                      <div class="row">
                                         <div class="col-xxl-2 col-xl-3 col-xs-16 col-md-6 col-lg-3 text-center gt-margin-top-10">
                                             <a href="composeMessages?user_id=<?php echo $Row->matri_id; ?>" class="btn gt-text-green">
                                                <i class="fa fa-envelope gt-margin-right-10"></i> Send Message
                                             </a>
                                         </div>
                                         <div class="col-xxl-3 col-xl-3 col-xs-7 col-sm-7 col-md-4 col-lg-3 pull-right gt-margin-top-10">
                                             <a class="btn btn-danger gt-cursor" onClick="deleteexp(<?php echo $Row->ei_id; ?>,'sent');">
                                                <i class="fa fa-trash gt-margin-right-10"></i>Delete
                                             </a>
                                         </div>
                                         <?php if($Row->receiver_response=='Pending'){?>
                                         
                                         <div class="col-xxl-3 col-xl-4 col-xs-9 col-sm-9 col-md-6 col-lg-4 pull-right gt-margin-top-10">
                                             <a class="btn gt-btn-green gt-cursor" onClick="sendreminder(<?php echo $Row->ei_id?>);" id="reminder<?php echo $Row->ei_id;?>">
                                                <i class="fa fa-bell gt-margin-right-10"></i>Reminder
                                             </a>
                                         </div>
                                          <?php }elseif($Row->receiver_response=='Accept'){?>
                                          <div class="col-xxl-3 col-xl-4 col-xs-9 col-sm-9 col-md-6 col-lg-4 pull-right gt-margin-top-10">
                                             <a class="gt-text-green" >
                                                <i class="fa fa-check gt-margin-right-10"></i>Accepted
                                             </a>
                                         </div>
                                         <?php }elseif($Row->receiver_response=='Reject'){?>
                                         <div class="col-xxl-3 col-xl-4 col-xs-9 col-sm-9 col-md-6 col-lg-4 pull-right gt-margin-top-10">
                                             <a class="gt-text-orange" >
                                                <i class="fa fa-ban gt-margin-right-10"></i>Rejected
                                             </a>
                                         </div>
                                         <?php }?>	
                                       </div>
                                  </div>