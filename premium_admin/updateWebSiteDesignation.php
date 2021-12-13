<?php





  include_once '../databaseConn.php';
  include_once '../class/Config.class.php';

	$configObj = new Config();





  include_once './lib/requestHandler.php';





  $DatabaseCo = new DatabaseConn();





  include_once '../class/Config.class.php';





  	$configObj = new Config();





	





	$desig_status = "";





  if(isset($_GET['desig_status']))





  {





    $desig_status = $_GET['desig_status'];





    $_SESSION['desig_status'] = $_GET['desig_status'];





  }





  else if(isset($_GET['page']))





  {





      $desig_status = $_SESSION['desig_status'];





  }





  else





  {





      $_SESSION['desig_status'] = "all";





      $desig_status = "all";





  }





  





  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");





  if($isPostBack)





  {  		





				





	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;





	if(isset($_POST['desg_id']) && is_array($_POST['desg_id']))





	{





		





		$desg_id_arr = $_POST['desg_id'];





		$desg_id_val = "(";





		foreach($desg_id_arr as $desg_id)





		{





			$desg_id_val .=	$desg_id.",";





		}





		$desg_id_val = substr($desg_id_val, 0, -1);





		$desg_id_val .=")";





		





	    switch($ACTION)





	    {





		    case 'DELETE':		





			     $SQL_STATEMENT =  "delete from  designation where desg_id in ".$desg_id_val;	





			      break;





		    case 'APPROVED':





				$SQL_STATEMENT =  "update  designation set status='APPROVED' where desg_id in ".$desg_id_val;	





			      break;





		    case 'UNAPPROVED':





				$SQL_STATEMENT =  "update  designation set status='UNAPPROVED' where desg_id in ".$desg_id_val;	





			      break;





	    }





	





	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);





	  $STATUS_MESSAGE = $statusObj->getStatusMessage();





	}





	else





	{





	  $statusObj = new Status();





	  $statusObj->setActionSuccess(false);





	  $STATUS_MESSAGE = "Please select value to complete action.";	  





	}





 }





  











?>











<!DOCTYPE html>





<html>





  <head>





    <meta charset="UTF-8">





    <title>Manage | Designation</title>





	<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />





	<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  





	<link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>





    





    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>





    <!-- Bootstrap 3.3.2 -->





    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />





    <!-- Font Awesome Icons -->





    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />





    





    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />





    <!-- Theme style -->





    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />





    <!-- AdminLTE Skins. Choose a skin from the css/skins 





         folder instead of downloading all of them to reduce the load. -->





    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />





    <link rel="stylesheet" href="css/all_check.css"/>   





	<script type="text/javascript" src="js/util/redirection.js"></script>





    <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>





   





  </head>





  <body class="skin-blue">





    <div class="wrapper">





      





      <?php include "page-part/header.php"; ?> 





      <!-- Left side column. contains the logo and sidebar -->





      <?php include "page-part/left_panel.php"; ?>











      <!-- Content Wrapper. Contains page content -->





      <div class="content-wrapper">





        <!-- Content Header (Page header) -->





        <section class="content-header">





          <h1>





          Add Designation





          





          </h1>





          <ol class="breadcrumb">





            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>





            <li>Add New</li>





            <li class="active">Designation</li>





          </ol>





        </section>











        <!-- Main content -->





        <section class="content">





          <div class="row">





          	<div class="col-lg-12 col-xs-12 col-sm-12">





          		<div class="box-top clearfix">





                	<div class="col-lg-3 col-sm-4">





                        	<a class="md-trigger btn btn-default btn-flat btn-lg btn-block add-details"  href="javascript:;" data-modal="modal-13">





                            





                            	 <i class="fa fa-plus"></i>Add Designation





                            </a>





                    </div>





                	<div class="col-lg-3 col-xs-12 col-sm-4">





                    	<a href="updateWebSiteDesignation?desig_status=all" class="btn btn-success btn-lg btn-flat col-xs-12">





                    		<i class="fa fa-list"></i>All Designation (<?php echo getRowCount("select count(desg_id) from designation",$DatabaseCo);?>)





                    	</a>





                    </div> 





                    <div class="col-lg-3 col-xs-12 col-sm-4">





                    	<a href="updateWebSiteDesignation?desig_status=approved" class="btn btn-success btn-lg btn-flat col-xs-12">





                    		<i class="fa fa-thumbs-up"></i>Approved Designation (<?php echo getRowCount("select count(desg_id) from designation where status='APPROVED'",$DatabaseCo);?>)





                    	</a>





                    </div> 





                    <div class="col-lg-3 col-xs-12 col-sm-4">





                    	<a href="updateWebSiteDesignation?desig_status=unapproved" class="btn btn-success btn-lg btn-flat col-xs-12">





                    		<i class="fa fa-thumbs-down"></i>Unapproved Designation (<?php echo getRowCount("select count(desg_id) from designation where status='UNAPPROVED'",$DatabaseCo);?>)





                    	</a>





                    </div>





                    





                   





                </div>





                





             <?php





	if(!empty($STATUS_MESSAGE))





	{	





		if($statusObj->getActionSuccess()){





			echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$STATUS_MESSAGE."</div>";





		}else{





		    echo  "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$STATUS_MESSAGE."</li></ul></div>";		





		}





	}





	 ?>     





            </div>





            





            <?php





	    


	    $main_menu_count = getRowCount("select count(desg_id) from designation".getWhereClauseForStatus($desig_status),$DatabaseCo);





	    if($main_menu_count>0)





		{  





		





		$SQL_STATEMENT =  "SELECT * FROM designation ".getWhereClauseForStatus($desig_status)." ORDER BY desg_id DESC";





	   ?>





            





            <div class="col-lg-12 col-xs-12 col-sm-12 neMrgATop10">





          		<div class="box-top clearfix">





                	





                	<div class="col-lg-2 col-xs-12 col-sm-4">





                    	<a href="javascript:;" class="btn btn-danger btn-lg btn-flat col-xs-12" onclick="submitActionForm('DELETE');">





                    		<i class="fa fa-trash"></i> Delete





                    	</a>





                    </div>





                    <div class="col-lg-2 col-xs-12 col-sm-4">





                    	<a href="javascript:;" class="btn btn-success btn-lg btn-flat col-xs-12" onclick="submitActionForm('APPROVED');">





                    		<i class="fa fa-thumbs-up"></i>Approve





                    	</a>





                    </div>





                    <div class="col-lg-2 col-xs-12 col-sm-4">





                    	<a href="javascript:;" class="btn btn-warning btn-lg btn-flat col-xs-12" onclick="submitActionForm('UNAPPROVED');">





                    		<i class="fa fa-thumbs-down"></i>Unapprove





                    	</a>





                    </div>





                    





                   





                </div>





            </div>         





          





          





            <div class="col-xs-12">





              <!-- /.box -->











              <div class="box">





                <div class="box-header">





                  <h3 class="box-title"><?php echo strtoupper($desig_status); ?> Designation List</h3>





                </div><!-- /.box-header -->





                <div class="box-body">





                <form method="post" action="updateWebSiteDesignation" id="action_form">





                  <table id="example1" class="table table-bordered table-striped">





                    <thead>





                      <tr>





                        <th><input type="checkbox" name="check" id="selectall" class="second" />





<label for="selectall" class="label2">&nbsp;</label> </th>





                        <th>Edit</th>





                        <th>Status</th>





                        <th>Designation Name</th>





                        





                      </tr>





                    </thead>





                    





                    <tbody>





                    <?php						





		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);





		$rowCount=0;





		while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult))





		{		





        	?>





                    





                      <tr>





                        <td><input type="checkbox" name="desg_id[]" id="Item <?php  echo $DatabaseCo->dbRow->desg_id;?>" class="second" value="<?php  echo $DatabaseCo->dbRow->desg_id;?>"/>





	<label for="Item <?php  echo $DatabaseCo->dbRow->desg_id;?>" class="label2">&nbsp;</label>	</td>





    





                        <td><a class="btn btn-danger md-trigger edit-popup"  href="javascript:;" data-modal="modal-13" data-id="<?php  echo $DatabaseCo->dbRow->desg_id;?>" data-desg_name="<?php  echo $DatabaseCo->dbRow->desg_name;?>" data-desg_status="<?php  echo $DatabaseCo->dbRow->status;?>"><i class="fa fa-pencil fa-fw"></i><span class="hidden-xs">&nbsp;&nbsp;Edit</span>





                            	</a></td>





                           <?php





			$likeDisLikeCss = "";





			if($DatabaseCo->dbRow->status=="APPROVED")





			  $likeDisLikeCss = "fa-thumbs-up";





			else





			  $likeDisLikeCss = "fa-thumbs-down";





			





		      ?>     





                        <td><i class="fa <?php echo $likeDisLikeCss;?>"></i></td>





                        <td><?php  echo $DatabaseCo->dbRow->desg_name;?></td>





                        





                      </tr>





                      





            <?php





		}





		?>





                      





                      





                    </tbody>





                    





                  </table>





                  <input  type="hidden" name="action" value="" id="action"/>





                  </form>





                </div><!-- /.box-body -->





              </div><!-- /.box -->





            </div>





         





         <?php





        }





	    else





	    {





	    ?>





        <div class="col-lg-12 col-xs-12 col-sm-12">





          





            <h4>There are no data for <?php echo strtoupper($desig_status); ?> Designation. Please add data.</h4>





          <br/>





	  <img src="../img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>





	 





        </div>





        <?php





	    }





	   ?>   





            





            <!-- /.col -->





          </div><!-- /.row -->





        </section><!-- /.content -->





      </div><!-- /.content-wrapper -->





       <?php include "page-part/footer.php"; ?>





    </div><!-- ./wrapper -->





    





    





    <div class="md-modal md-effect-13" id="modal-13">





<div class="md-content" id="dialog">





<div class="modal-header" >





<span id="new_button">





<button class="md-close close" id="old">&times;</button>





 </span>





<h4 class="modal-title" id="dialog_title">Add New Designation</h4>





</div>





<div class='error-msg' id='validationSummary'></div>





<form method="post" id="desg-form" action="">





<div class="modal-body">

















<div class="form-group">





<label for="exampleInputEmail1"><b>Designation Name</b></label>





<input type="text" name="desg_name" class="form-control" id="desg_name" placeholder="Enter Designation name">





</div>





























   		<div class="form-group">





<label><b>Status</b></label>





<div class="radio">





<input id="optionsRadios1" class="rel_status" type="radio" checked="" value="APPROVED" name="desg_status">





<label for="optionsRadios1"><b>Active</b> </label>





<input id="optionsRadios2" class="desg_status" type="radio" value="UNAPPROVED" name="desg_status">





<label for="optionsRadios2"><b>Inactive </b></label>





</div>

















</div>

















</div>





<div class="modal-footer">











 <input type="button" id="save" class="btn btn-primary" value="Save Changes" title="Save Changes"/>





 





 <input type="hidden" name="desg_id" id="desg_id" value=""/>





 <input type="hidden" name="action" value="" id="update_action"/>





 





</div>





</form>





</div>





</div>





 





 <div class="md-overlay"></div> 











    <!-- jQuery 2.1.3 -->





    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>





    <!-- Bootstrap 3.3.2 JS -->





    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>





    





     <!--jquery for left menu active class-->





    <script type="text/javascript" src="dist/js/general.js"></script>





	<script type="text/javascript" src="dist/js/cookieapi.js"></script>





    <script type="text/javascript">





        setPageContext("add-new","desg");





    </script>	





    <!--jquery for left menu active class end-->





    





    <!-- DATA TABES SCRIPT -->





    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>





    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>





   





    <!-- AdminLTE App -->





    <script src="dist/js/app.min.js" type="text/javascript"></script>





    





    <!--3D Slit effect pop js-->





	<script src="js/classie.js"></script>





    <script src="js/modalEffects.js"></script>





     <!--ends-->





       





   





    <!-- page script -->





    <script type="text/javascript">





      $(function () {





		  





		  var refreshRequired = false;





		  





		  $("input[name=desg_id]").click(function(){





		  $("#selectall").prop("checked", false);		





	});





	  





	





	//     js for Check/Uncheck all CheckBoxes by Checkbox     // 





	





				





	$("#selectall").click(function(){





		$(".second").prop("checked",$("#selectall").prop("checked"))





	}) 





	





	





	// add details //





	





	





	 $(document).on("click", ".add-details", function () {





    	$("#save").val("Save Changes");





	 	$("#dialog_title").text("Add New Designation");





	 	$("#update_action").val("ADD"); 		





	 





		$('#modal-13').modal('show');





		$("#validationSummary").hide();





		$("#desg_name").focus();





		$("#desg_name").val("");





});





	





	





	





	//     edit details function starts here    // 





	





	   $(document).on("click", ".edit-popup", function () {





     var myid = $(this).data('id');





	 var desg_name = $(this).data('desg_name');





	 var desg_status = $(this).data('desg_status');





	 





	 





     $("#desg_id").val(myid);





	 $("#desg_name").val(desg_name);





	 $("#save").val("Update");





	 $("#dialog_title").text("Update Designation");





		 





	  if(desg_status=='APPROVED')





	  {





	    $("#optionsRadios1").attr("checked","checked");





	  }





	  else





	  {	





	    $("#optionsRadios2").attr("checked","checked");





	  }





	 





	 $("#update_action").val("UPDATE"); 





	 





    $('#modal-13').modal('show');





	$("#validationSummary").hide();





	$("#desg_name").focus();	 





});

















	











		//     to save popup details    // 











     $("#save" ).button().click(function(){





     			





			$("#validationSummary").attr("class","alert alert-warning");





     	   	$("#validationSummary").html("<img src='../img/6.gif' alt='loading'/> <b>Please wait...</b>");





     	   	$("#validationSummary").show();			





						





			var dataString =  $("#desg-form").serialize();			





						





			$.ajax({





        type: "post",





        url: "web-services/add-details/add_desg",





        dataType:"json",





        data: dataString,





        success: function(data){





				      if(data.successStatus){





				        $("#validationSummary").attr("class","alert alert-success");





					$("#validationSummary").html("<i class='fa fa-check-circle fa-fw fa-lg'></i>"+data.responseMessage+"");





					$("#validationSummary").show();





					


					$("#old").remove();





					





					$('<a href="updateWebSiteDesignation" id="old" class="md-close close">&times;</a>').appendTo('#new_button');





					





								





				      }else{





					$("#validationSummary").attr("class","alert alert-danger");





					$("#validationSummary").html("<i class='fa fa-times-circle fa-fw fa-lg'></i>Please correct following errors.<ul class='error-hint cf'>"+data.responseMessage+"</ul>");





					$("#validationSummary").show();





				      }





			    }





    })





    return false;





	





	});





	





	





		





		$('#example1').dataTable({





		"aaSorting": [  [3,'desc'] ],





		'aoColumnDefs': [{





           'bSortable': false,





		   'info': true,          





		 	"paging":   true,





			'aTargets': [0,1,2,],





			'pageLength': 10		   





		}]		





	} );  





		





		





      });





    </script>











  </body>





</html>





<style type="text/css">


.modal-open


{


	padding-right:0px !important;


	overflow:visible !important;


	


}


.md-show


{


	padding-right:0px !important;


} 


</style>





