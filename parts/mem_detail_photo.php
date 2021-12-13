<?php

if(isset($Row)){
	?>
    <?php if($Row->photo1_approve == 'UNAPPROVED' && $Row->photo1 !='' ){ ?>
		<?php if($Row->gender=="Female"){ ?>
           <img src="img/female-pending-approval.png" class="img-responsive gtFullWidth">
        <?php }else{?>
           <img src="img/male-pending-approval.png" class="img-responsive gtFullWidth">
        <?php }?>
    <?php } else {?>
		<?php 
			if(($Row->photo1!="" && $Row->photo1_approve=='APPROVED' && file_exists('../my_photos/'.$Row->photo1)) && (($Row->photo_view_status=='1') || ($Row->photo_view_status=='2' && $_SESSION['mem_status']=='Paid')) && (($Row->photo_protect=='No') || ($Row->photo_protect=="Yes" && $Row->photo_pswd==''))){ 		   
		?>
				<img src="my_photos/watermark.php?image=<?php echo $Row->photo1; ?>&watermark=watermark.png" class="img-responsive gtFullWidth" title="<?php echo $Row->username; ?>" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>">             
		<?php 
			}elseif($Row->photo_protect=="Yes" && $Row->photo_pswd!=''){
				if($Row->gender=='Male'){
		?>
    				<img src="./img/photo-protected-male.png" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>" class="img-responsive gtFullWidth">	                                        
				<?php } else { ?>
					<img src="./img/photo-protected-female.png" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>" class="img-responsive gtFullWidth">   
				<?php 	} } else {  if($Row->gender=='Male'){ ?> 
				<img src="./img/male.png" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>" class="img-responsive gtFullWidth">         
				<?php } else { ?>  
				<img src="./img/female.png" title="<?php echo $Row->username; ?>" alt="<?php echo $Row->matri_id; ?>" class="img-responsive gtFullWidth">               
				<?php   } } ?>
      <?php }}?>                    						  
