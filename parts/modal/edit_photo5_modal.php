<div class="modal fade" id="editPhoto5Modal" tabindex="-1" role="dialog" aria-labelledby="editPhoto1Modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
       	<div class="col-12">
        	<h5 class="modal-title" id="exampleModalLabel">Edit Photo 5
         	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
        	</h5>
        </div>
      </div>
      <div class="modal-body">
       	<form action="" method="post" enctype="multipart/form-data" class="editPhotoModal">
       		<p class="text-center">Select image and then click on submit button to upload image</p>
        	<div class="col-xxl-10 col-xxl-offset-3">
				<center>
   				<?php if($Row->photo5 != ''){?>
   					<img src="my_photos/<?php echo $Row->photo5; ?>" class="img-fluid img-thumbnail" id="photo5_prev">
   				<?php }else{?>
   					<?php if($Row->gender =='Female'){ ?>
   						<img src="img/female.png" class="img-fluid img-thumbnail" id="photo5_prev">
					<?php }else{ ?>
 						<img src="img/male.png" class="img-fluid img-thumbnail" id="photo5_prev">
  					<?php } ?>
   				<?php }?>
   				<input type="file" name="photo5" id="photo5" onchange="readURL5(this);">
   				<label for="photo5" class="btn gt-btn-orange btn-block gt-margin-top-20">
					Select Image
				</label>
				<div class="form-group text-center">
					<input type="submit" name="editPhoto5" value="SUBMIT" class="btn gt-btn-green btn-block gt-margin-top-20">
				</div>
				</center>
       		</div>
        </form>
		<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>