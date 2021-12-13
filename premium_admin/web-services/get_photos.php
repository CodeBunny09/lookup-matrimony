<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
			
$from_id = isset($_GET['frmid'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_GET['frmid']):0;

$photoid= isset($_GET['photoid'])?mysqli_real_escape_string($DatabaseCo->dbLink,$_GET['photoid']):0;

$get=$DatabaseCo->dbLink->query("select photo".$photoid.",username,photo".$photoid."_approve,photo_protect,matri_id,email,photo_pswd from register_view where matri_id='$from_id'");
$row=mysqli_fetch_array($get);



?>

<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Photo of <?php echo $row['username'];?></h4>
              </div>
               
              <div class="modal-body">                 
                      <div class="form-group"> 
            
           
            <img src="../my_photos/watermark.php?image=<?php echo $row['photo'.$photoid.'']; ?>&watermark=watermark.png" style="width:535px; height:500px;">          
                
                      </div>
     
              </div>
              
              
              <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
                    
            </div>
          </div>
          
