<?php 
include_once '../../databaseConn.php';
$DatabaseCo = new DatabaseConn();


if(isset($_POST['hobby'])){
	$_SESSION['reg_user_id'];	
	$hobby=implode(",",$_POST['hobby']);
	$spoken_language=implode(",",$_POST['spoken_language']);
	$DatabaseCo->dbLink->query("update register set hobby='".$hobby."',language_known='".$spoken_language."' where matri_id='".$_SESSION['matri_id_reg']."'");	
}

?>

<!-----------------------photo crop css----------------------------------->

<link rel="stylesheet" type="text/css" href="css/photocrop/component.css"/>

<!----------------------photo crop css end-------------------------------->

<div class="container gt-margin-top-20">

<div class="row">

   <div class="col-xxl-4 col-xl-4 col-xs-16 col-sm-16 col-md-16 gt-left-opt-msg">

        <?php include "../../parts/level-2.php"; ?>

   </div>

   <div class="col-xxl-12 col-xl-12 col-xs-16 col-sm-16 col-md-16 gt-upload-photo">

   	   <div class="row text-center">

                <div class="col-xs-16">

                   <h3 class="gt-text-green">Upload Profile Picture</h3>

                   <article><p>Uploading your profile picture give you 10 time more response.</p></article>

                </div>

                

            </div>

      <div class="gt-profile-pic-panel">

          <div class="col-xs-16 col-md-16 col-xxl-16 col-xl-16 col-lg-16">

              <div class="row">

               		<div class="col-xxl-13">

                    	<div class="col-xxl-7 col-xl-7 col-lg-8 gt-margin-bottom-15">

                         	<h4 class="gt-font-weight-400 text-muted">

                                Photo Privacy Status:- 

                         	</h4>

                     	</div>

                        <div class="col-xxl-5 col-xl-7 col-lg-8 gt-margin-bottom-15">

                            <select class="gt-form-control" id="view_photo" name="view_photo">	

                              <option value="1">Visible To All</option>

                              <option value="2">Visible To Paid Members</option>

                              <option value="0">Hidden For All</option>

                            </select>

                         </div>

                    </div>

                    <div class="col-xxl-3">

                    	<a class="btn gt-btn-green btn-block" onclick="skip4();"> Skip <i class="fa fa-caret-right"></i></a>

                    </div>

                    

                </div>

                
			 
               <div class="row" id="preview">
				
                   <div class="col-xxl-6 col-xxl-offset-5 col-xl-6 col-xxl-offset-5 col-md-12 col-md-offset-2 col-lg-6 col-lg-offset-5">

                        <div class="thumbnail">

                           <img src="img/photo-default.png" class="img-responsive img-developer-larg">

                        </div>

                    </div>

                </div>

               <div class="row">

                   <div class="col-xxl-6 col-xl-16 col-xxl-offset-5 text-center">

                        <div class="row">

                             <div class="col-xxl-16 col-xl-16 col-xs-16 col-sm-16 col-lg-7 gt-margin-bottom-15">

                                  <a class="btn btn-computer gt-cursor" id="get_img" >

                                    <i class="fa fa-desktop"></i><h4>Upload From Computer</h4>

                                  </a>

                                  

                                  <form action="upload" name="imageform" id="imageform" method="post" enctype="multipart/form-data">

                                  	<center>

                                     <input type="file" id="my_file" name="image" >

                                    </center>

                                  </form>

                             </div>

                             <a class="btn gt-btn-orange gt-btn-xxl" onClick="skip4();"> Continue</a>

                             

                         </div>

                    </div>

               </div>

         </div>

      </div>

    </div>

 </div>

</div>

<script>

document.getElementById('get_img').onclick = function() {

    document.getElementById('my_file').click();

};

function skip4(){

	window.location='register-confirm-password';

}

</script>

<!--Js for crop photo -->



<!-----------------------jquery photoupload-------------------->

<script type="text/javascript" src="js/photoupload/jquery.min.js"></script>

<script type="text/javascript">

	var $16 = jQuery.noConflict();

</script>

<script type="text/javascript" src="js/photoupload/jquery.form.js"></script>

<script type="text/javascript">

    $(document).ready(function(){ 

		$('#editimg').on('click',function(){

			$("#preview").html('');

		});

		$('#editimgmobile').on('click',function(){

			$("#preview").html('');

		});

		

		

		    $16('#my_file').live('change', function()			{ 

			$16("#preview").html('');

			$16('#preview').html('<div style="height:240px;text-align:center;"><img src="img/loading.gif" alt="Uploading...."/></div>');

			$16('#imageform').ajaxForm({

					target: '#preview'

			}).submit();

			$16('#demo_photo').hide();

			});

			$16('#image_mobile').live('change', function(){ 

			    $16("#preview").html('');

			    $16('#preview').html('<div style="height:240px;text-align:center;"><img src="img/loading.gif" alt="Uploading...."/></div>');

			$16('#imageformmobile').ajaxForm({

					target: '#preview'

		}).submit();

			$16('#demo_photo').hide();

			});

			

        }); 

</script>

<!-----------------------jquery photoupload End-------------------->



