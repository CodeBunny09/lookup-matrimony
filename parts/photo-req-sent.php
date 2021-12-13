<div class="gt-interest-rec"  >
                                
                                <div class="col-lg-4 col-lg-offset-0 col-xxl-3 col-xxl-offset-0 col-xl-offset-0 col-xl-3 col-sm-10 col-sm-offset-3 col-xs-10 col-xs-offset-3 col-md-6 col-md-offset-0">
                                    <div class="thumbnail">
                                       <?php include('../parts/exp-result-photo.php');?>
                                    </div>
                                </div>
                                   	<div class="col-xxl-13 col-xl-13 col-xs-16 col-sm-16 col-md-10 col-lg-12">
                                    	<div class="row">
                                        	<div class="col-xxl-8 col-xl-8 col-xs-16 col-lg-8 col-md-16 text-center">
                                    			<a href="" class="gt-text-black">
                                        			<h4>
                                            			<?php echo $Row->username; ?> <small class="text-muted">(<?php echo $Row->matri_id; ?>)</small>
                                            		</h4>
                                        		</a>
                                            </div>
                                            <div class="col-xxl-8 col-xl-8 col-xs-16 col-lg-8 col-md-16  text-center">
                                            	<label class="gt-margin-top-10"><?php $date=date_create($Row->ph_reqdate);
												echo date_format($date,'g:ia jS F Y');?> </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                        	<div class="col-xxl-16 col-xl-16 col-md-16 col-lg-16 col-sm-16">
                                            	<h4 class="gt-text-orange">
                                                	<i class="fa fa-paper-plane gt-margin-right-10"></i> Photo Request Sent
                                                </h4>
                                        	</div>
                                        </div>
                                         <div class="row">
                                        	<div class="col-xxl-16 col-xl-16 col-md-16 col-lg-16 col-sm-16">
                                            	<p class="gt-margin-top-0">
                                                	<?php echo $Row->ph_msg; ?>
                                                </p>
                                        	</div>
                                        </div>
                                        <div class="row">
                                        	<div class="col-xxl-8">
                                        		Status :- <b class="text-danger"><?php echo $Row->receiver_response; ?></b>
                                        	</div>
                                        	<?php if($Row->receiver_response == 'Accepted' && $Row->photo_pswd != ''){?>
												<div class="col-xxl-8">
													Password :- <b class="text-danger"><?php echo $Row->photo_pswd; ?></b>
												</div>
                                        	<?php }?>
                                        </div>
                                    </div>
                                  	<div class="col-xxl-16 col-lg-16 col-xs-16 col-sm-16 col-md-16">
                                      <div class="row">
                                         <div class="col-xxl-2 col-xl-3 col-xs-16 col-md-6 col-lg-3 text-center gt-margin-top-10">
                                             <a href="composeMessages?user_id=<?php echo $Row->matri_id; ?>" class="btn gt-text-green">
                                                <i class="fa fa-envelope gt-margin-right-10"></i> Send Message
                                             </a>
                                         </div>
                                         <div class="col-xxl-3 col-xl-3 col-xs-8 col-sm-8 col-md-5 col-lg-3 pull-right gt-margin-top-10">
                                             <a class="btn btn-danger gt-cursor" onClick="deletereq('<?php echo $Row->ph_reqid; ?>','sent');">
                                                <i class="fa fa-trash gt-margin-right-10"></i>Delete
                                             </a>
                                         </div>
                                         
                                       </div>
                                    </div>
                                </div>