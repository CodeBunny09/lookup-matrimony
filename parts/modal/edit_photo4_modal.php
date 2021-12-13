<div class="modal fade" id="editPhoto4Modal" tabindex="-1" role="dialog" aria-labelledby="editPhoto1Modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
       	<div class="col-12">
        	<h5 class="modal-title" id="exampleModalLabel">Edit Photo 4
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
   				<?php if($Row->photo4 != ''){?>
   					<img src="my_photos/<?php echo $Row->photo4; ?>" class="img-fluid img-thumbnail" id="photo4_prev">
   				<?php }else{?>
   					<?php if($Row->gender =='Female'){ ?>
   						<img src="img/female.png" class="img-fluid img-thumbnail" id="photo4_prev">
					<?php }else{ ?>
 						<img src="img/male.png" class="img-fluid img-thumbnail" id="photo4_prev">
  					<?php } ?>
   				<?php }?>
   				<input type="file" name="photo4" id="photo4" onchange="readURL4(this);">
   				<label for="photo4" class="btn gt-btn-orange btn-block gt-margin-top-20">
					Select Image
				</label>
				<div class="form-group text-center">
					<input type="submit" name="editPhoto4" value="SUBMIT" class="btn gt-btn-green btn-block gt-margin-top-20">
				</div>
				</center>
       		</div>
        </form>
		<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>