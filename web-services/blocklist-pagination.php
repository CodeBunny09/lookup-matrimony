<?php 



include_once '../databaseConn.php';

$DatabaseCo = new DatabaseConn();



$mid=$_SESSION['user_id'];



include('../parts/pagination.php');

	

	if(isset($_REQUEST['actionfunction']) && $_REQUEST['actionfunction']!=''){

	$page=$_REQUEST['page'];

	$limit = 4;

	$adjacent = 2;

	

	if($page==1)

	{

		$start = 0;  

	}	

	else

	{

		$start = ($page-1)*$limit;

	}



$rows=mysqli_num_rows($DatabaseCo->dbLink->query("select block_profile.block_id from register_view JOIN block_profile ON block_profile.block_to=register_view.matri_id where block_by='".$mid."'"));

$sql="SELECT * from register_view JOIN block_profile ON block_profile.block_to=register_view.matri_id where block_by='".$mid."' LIMIT $start, $limit";	 	 

	$data=$DatabaseCo->dbLink->query($sql);

	

	if($rows >0)

	{ 

	

	?>

<div class="row gt-margin-top-20">
                                    	<div class="col-xs-16 col-sm-16 col-md-16 col-lg-16 col-xxl-16 col-xl-16">
                                    		<h3>
                                        		<i class="fa fa-user-times gt-margin-right-10"></i>List Of Blocked Members
                                       	 	</h3>
                                            <p class="gt-border-bottom-smoke-white gt-padding-bottom-15 gt-margin-bottom-20">
                                            	You can see and unblock members from this list from here.
                                            </p>
                                            <div class="row">
                                            	<?php	   
												while( $Row = mysqli_fetch_object($data))
												{
												?>	   
                                                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16">
                                                	<div class="gt-setting-blocklist">
                                            		<div class="col-xxl-5 col-xxl-offset-0 col-xl-5 col-xl-offset-0 col-md-5 col-md-offset-0 col-lg-5  col-lg-offset-0 col-xs-8 col-xs-offset-4 col-sm-offset-4 col-sm-8">
                                                    	<?php include('../parts/exp-result-photo.php');?>
                                                    </div>
                                                    <div class="col-xxl-11 col-xl-11 col-md-11 col-lg-11 col-xs-16 col-sm-16" >
                                                    	<h4>
                                                    		<?php echo $Row->username;?><small class="text-muted">(<?php echo $Row->matri_id;?>)</small>
                                                        </h4>
                                                        <div>
                                                        	<small><b>Age:</b><?php echo floor((time() - strtotime($Row->birthdate))/31556926).' Years';?></small>
                                                        </div>
                                                        
                                                        <div>
                                                        	<small><b>Location:</b><?php echo $Row->city_name;?>,<?php echo $Row->country_name;?></small>
                                                        </div>
                                                        <div>
                                                        	<a class="btn btn-danger btn-sm gt-margin-top-10 gt-cursor addToblock-data" id="<?php echo $Row->matri_id; ?>">
                                                            	<i class="fa fa-unlock gt-margin-right-10"></i>Unblock
                                                            </a>
                                                        </div>
                                                    </div>
                                                    </div>
                                            	</div>
                                                <?php }?> 
                                            </div>
                                        </div>
                                    </div>


            

                     <div class="clearfix"></div>         

           <div class="xxl-16 xl-16 xs-16 l-16 m-16 s-16 padding-lr-zero margin-top-20px">

				<?php pagination($limit,$adjacent,$rows,$page);  ?>                    </div>        

					           

      <?php 

	  }

	  else

      {?>

						<div class="xxl-16 xl-16 l-16 m-16 s-16 xs-16 padding-lr-zero margin-top-10px">

                             <h4>No Data Available</h4>

                        </div>

		  <?php	

		}

	}

	

	

?>                                      



<script>

function checkAllaccept(ele) {

     var checkboxes = $('input[name="exp_sent_accept_id"]');

     if (ele.checked) {

         for (var i = 0; i < checkboxes.length; i++) {

             if (checkboxes[i].type == 'checkbox') {

                 checkboxes[i].checked = true;

             }

         }

     } else {

         for (var i = 0; i < checkboxes.length; i++) {

             console.log(i)

             if (checkboxes[i].type == 'checkbox') {

                 checkboxes[i].checked = false;

             }

         }

     }

 }

 





function deleteexp(id,exppagenm){

	$('#delsentacceptall'+id+'').fadeIn();



	$.ajax({

	    url:"delete_expressinterest",

        type:"POST",

        data:'exp_id='+id+'&exp_page='+exppagenm,

        cache: false,

        success: function()

		{

			$('#delsentacceptall'+id+'').fadeOut();

		 getexpsentacceptdata();	

		}

	   });

	} 

 

</script>



<script type="application/javascript">



$(document).ready(function(e) {



    $('#delete_exp_accept').click(function(){

		

		var selectedOrderBy = new Array();

			$('input[name="exp_sent_accept_id"]:checked').each(function() {

			selectedOrderBy.push(this.value);

		});

		

		

		if(selectedOrderBy!='')

		{

			  $.ajax({

			  url: 'delete_expressinterest',

			  type: 'POST',

			  data: 'exp_status=trash_all&exp_id='+selectedOrderBy+'&exp_page=sent',

			  success: function(data) {

			  getexpsentacceptdata();	

		},

			  error: function() {

				//called when there is an error

				//console.log(e.message);

			  }

			});

		}else{

		alert('Please select at list one message to complete trash action.');	

		return false;

		}

	});

	$('#delete_exp_accept1').click(function(){

		

		var selectedOrderBy = new Array();

			$('input[name="exp_sent_accept_id"]:checked').each(function() {

			selectedOrderBy.push(this.value);

		});

		

		if(selectedOrderBy!='')

		{

			  $.ajax({

			  url: 'delete_expressinterest',

			  type: 'POST',

			  data: 'exp_status=trash_all&exp_id='+selectedOrderBy+'&exp_page=sent',

			  success: function(data) {

			  getexpsentacceptdata();	

		},

			  error: function() {

				//called when there is an error

				//console.log(e.message);

			  }

			});

		}else{

		alert('Please select at list one message to complete trash action.');	

		return false;

		}

	});



});	





$(function() 



{

$(".addToblock-data").click(function() {

$('#blockdiv').fadeIn();

var commentContainer = $(this).parent();

var id = $(this).attr("id");

var string = 'block_id='+ id ;

	

$.ajax({

   type: "POST",

   url: "addshortlist",

   data: string,

   cache: false,

   success: function(){

	commentContainer.slideUp('slow', function() {$(this).remove();});

	$('#blockdiv').fadeOut();

  }

   

 });



return false;

	});

});

</script>



<style>

nav.center-text,nav

{

	background:none;	

}



.pagination{

margin:-6px 0px;	

	}

.current {

    background: none repeat scroll 0 0 rgba(236, 236, 236, 1) !important;

    color: #000 !important;

	padding:4px 8px;

	

}

.pagination > li > a{

	padding:6px 12px !important;	

	}

.page-numbers1{

	display:none;	

}

.ne-success-story ul{

	border-bottom:none !important;	

	

}

.ne-success-story li

{

	background: none !important;

	border-bottom:none !important;	

}

.pagination > li > a, .pagination > li > span {

    background-color: #fff !important;

    border: 1px solid #ddd !important;

    color: #428bca !important;

    float: left;

    line-height: 1.42857;

    margin-left: -1px;

    padding: 6px 12px;

    position: relative;

    text-decoration: none;

}



</style>



