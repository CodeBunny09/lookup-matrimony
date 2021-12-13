							<div class="col-xxl-4 col-xs-8 col-lg-4 gt-margin-bottom-10">
                    			<a href="member-profile?view_id=<?php echo $Row->matri_id;?>" target="_blank" class="gt-result">
                                	<div class="thumbnail">
										   <?php include('search-result-photo.php');?>
                                         </div>
                                    <h5 class="text-center">
                                    	<?php if($username_settings->username_setting == 'full_username'){?>
                                                   <?php echo $Row->username; ?>(<?php echo $Row->matri_id; ?>)
										<?php }elseif($username_settings->username_setting == 'first_surname'){?>
													<?php echo $Row->firstname." ".substr($Row->lastname, 0, 1); ?>(<?php echo $Row->matri_id; ?>)
											<?php }else{ ?>
											<?php echo $Row->matri_id; ?>
										<?php } ?>
                                    </h5>
                                    <article class="gt-margin-bottom-5 text-center">
                                    	<?php echo floor((time() - strtotime($Row->birthdate))/31556926); ?> Years, <?php $ao3 = $Row->height;$ft3= (int) ($ao3/12);$inch3 = $ao3 % 12;echo $ft3."ft". " ".$inch3."in";?> , <?php echo $Row->ocp_name;?>
                                    </article>
                                    <article class="text-center">
                                    	<?php if($Row->city_name!=''){echo $Row->city_name;}else{ echo "N/A";}?>,<?php echo $Row->country_name;?>
                                    </article>
                                    </a>
                                    
                                    <?php	
										if(isset($_SESSION['user_id'])){
											if(isset($sql_exp) && $sql_exp->receiver_response=='Pending'){
									?>
                            		
                                    <button class="btn gt-btn-green btn-block gt-margin-top-5 gtFontSMXS12" onClick="sendreminder(<?php echo $sql_exp->ei_id?>);" id="reminder<?php echo $sql_exp->ei_id;?>" title="Send Reminder" >
                                    	<i class="fa fa-bell gt-margin-right-5"></i>Send Reminder
                                    </button>
									<?php }elseif(isset($sql_exp) && $sql_exp->receiver_response=='Accept'){?>
										<h5 class="interestAccepted">Interest Accepted</h5>
									<?php }elseif(isset($sql_exp) && $sql_exp->receiver_response=='Reject'){?>
										<h5 class="interestRejected">Interest Rejected</h5>
                                    <?php }else{?>	
                                        <button class="btn gt-btn-green btn-block gt-margin-top-5 gtFontSMXS12" onclick="ExpressInterest('<?php echo $Row->matri_id;?>')" title="Send Interest" data-target="#myModal1" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                    		<i class="fa fa-heart-o"></i> Send Interest
                                    	</button>
                                    <?php }}?>
                                    
                        		
                            </div>