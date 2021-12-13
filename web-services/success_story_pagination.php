<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
include_once 'pagination.php';

$con='';
$limit='';
$adjacent='';

if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){
$actionfunction = $_REQUEST['actionfunction'];
    call_user_func($actionfunction,$_REQUEST,$con,$limit,$adjacent);
}
										
function showData($data,$con,$limit,$adjacent){
$limit = 8;
$adjacent = 1;					
$DatabaseCo = new DatabaseConn();											
$page = $_POST['page'];   
	if($page==1){
		$start = 0;  
		} else {
		$start = ($page-1)*$limit;
	}
	$sql = "select weddingphoto,successmessage,bridename,groomname,story_id from success_story where status='APPROVED' and fstatus='0'";
	$rows  = $DatabaseCo->dbLink->query($sql);
	$rows  = mysqli_num_rows($rows);
	$sql = "select weddingphoto,successmessage,bridename,groomname,story_id from success_story where status='APPROVED' and fstatus='0' order by story_id limit $start,$limit";
	$data = $DatabaseCo->dbLink->query($sql);
?>
<?php if(mysqli_num_rows($data)>0){ ?>
<?php pagination($limit,$adjacent,$rows,$page); ?>   
   <div class="col-xxl-16 col-xs-16">
       <div class="row">     
	   <?php
           while($get_st_photo = mysqli_fetch_object($data)){						
           $str1='<a data-toggle="modal" data-target="#mainread'.$get_st_photo->story_id.'" title="Full Success Story" onclick="success_story('.$get_st_photo->story_id.')" class="col-xxl-4  col-xl-4 col-lg-8 col-md-8 col-sm-16 col-xs-16 gt-margin-bottom-15" style="cursor:pointer;">
              <div class="thumbnail">
                 <img src="SuccessStory/';
					$str1.=$get_st_photo->weddingphoto;
					$str1.='" style="width: 100%; height: 180px;">
					<div class="caption text-center">
						<h5>'.$get_st_photo->bridename.' & '.$get_st_photo->groomname.'</h5>
						<p>'.substr($get_st_photo->successmessage,0,70).'</p>
						<b class="btn gt-btn-orange btn-sm" >Read More</b>
					</div>
              </div>
            </a>
              <div class="modal fade" id="mainread'.$get_st_photo->story_id.'" tabindex="-1" role="dialog" aria-labelledby="mainreadLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">'.$get_st_photo->bridename.' & '.$get_st_photo->groomname.'</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <a href="" class="thumbnail">
														<img src="SuccessStory/'.$get_st_photo->weddingphoto.'" style="width:100%;height:350px;">
                                        	        </a>
                                                    <div class="row gt-margin-top-20">
                                                    	<div class="col-xs-16">
                                                        	<h4 class="gt-text-green">Full Success Story</h4>
                                                        	<p>
															'.$get_st_photo->successmessage.'
															
                                                            </p>
                                                        </div>
                                                  	</div>		
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
            ';
            echo $str1;
           }?>
      </div>
 </div> 
<?php pagination($limit,$adjacent,$rows,$page);  ?>      
<?php } ?>
<?php } ?>
