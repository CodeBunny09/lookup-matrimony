<li>
                            	<div class="col-xxl-2 col-xs-6 col-sm-6 col-md-8 col-lg-2 gt-margin-top-5">
                                	<input type="checkbox" class="display-inline" name="msg_id" id="msg_id" value="<?php echo $DatabaseCo->dbRow->mes_id;?>" >
                                    <a class="gt-margin-left-10 font-18 gt-cursor" onClick="importantfun(<?php echo $DatabaseCo->dbRow->mes_id;?>,<?php if($DatabaseCo->dbRow->msg_important_status=='Yes'){ echo "'No'";}else{ echo "'Yes'";} ?>);">
                                    	<i class="fa fa-star <?php if($DatabaseCo->dbRow->msg_important_status=='Yes'){ echo "gt-text-blue gt-margin-right-10";} ?>"></i>
                                    </a>
                                </div>
                                <?php if($DatabaseCo->dbRow->to_id!=$_SESSION['user_id']){?>
                                <a href="inbox_main_msg.php?msg_id=<?php echo $DatabaseCo->dbRow->mes_id;?>&imp=1" class="col-xxl-4 col-xs-10 col-sm-10 col-md-8 col-lg-4" data-toggle="tooltip" data-placement="left" title="<?php echo $DatabaseCo->dbRow->to_id;?>" >
                                	<h4 class="name"><?php echo $DatabaseCo->dbRow->to_id;?></h4>
                                </a>
                               <?php }else{?>
                               <a href="inbox_main_msg.php?msg_id=<?php echo $DatabaseCo->dbRow->mes_id;?>&imp=1" class="col-xxl-4 col-xs-10 col-sm-10 col-md-8 col-lg-4" data-toggle="tooltip" data-placement="left" title="<?php echo $DatabaseCo->dbRow->from_id;?>" >
                                	<h4 class="name"><?php echo $DatabaseCo->dbRow->from_id;?></h4>
                                </a>
                                <?php }?>
                                <a href="inbox_main_msg.php?msg_id=<?php echo $DatabaseCo->dbRow->mes_id;?>&imp=1" class="col-xxl-8 col-xs-16 col-sm-16 col-md-16 col-lg-8 gt-margin-top-8" title="<?php echo $DatabaseCo->dbRow->to_id;?>">
                                	<span class="font-12"><b class="name1"><?php $data_msg=substr($DatabaseCo->dbRow->subject,0,50);
									
										if($data_msg!=''){echo $data_msg;}else{ echo "N/A";}
									?></b></span>
                                </a>
                                <div class="col-xxl-2 col-xs-16 col-sm-16 col-md-16 col-lg-2 ">
                                	<h4 class="name2"><?php echo date('d M Y', strtotime($DatabaseCo->dbRow->sent_date)); ?></h4>
                                </div>
                                
                            </li>
                            

