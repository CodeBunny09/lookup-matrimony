<?php
   include_once '../databaseConn.php';
   include_once '../class/Config.class.php';
   $configObj = new Config();
   include_once './lib/requestHandler.php';
   $DatabaseCo = new DatabaseConn();
   include_once '../class/Config.class.php';
   $configObj = new Config();
   $search_case = false;
   $city_status = "";
   if(isset($_GET['city_status'])){
   $city_status = $_GET['city_status'];
   $_SESSION['city_status'] = $_GET['city_status'];
   } else if(isset($_GET['page'])){
   $city_status = $_SESSION['city_status'];
   }else{
   $_SESSION['city_status'] = "all";
   $city_status = "all";
   }
   $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
   if($isPostBack){     
   $ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
   if(isset($_POST['city_id']) && is_array($_POST['city_id']) && $ACTION!='SEARCH'){
   $city_id_arr = $_POST['city_id'];
   $city_id_val = "(";
   foreach($city_id_arr as $city_id){
   $city_id_val .=	$city_id.",";
   }
   $city_id_val = substr($city_id_val, 0, -1);
   $city_id_val .=")";
   switch($ACTION){
   case 'DELETE':		
   $SQL_STATEMENT =  "delete from  city where city_id in ".$city_id_val;	
   break;
   case 'APPROVED':
   $SQL_STATEMENT =  "update  city set status='APPROVED' where city_id in ".$city_id_val;	
   break;
   case 'UNAPPROVED':
   $SQL_STATEMENT =  "update  city set status='UNAPPROVED' where city_id in ".$city_id_val;	
   break;
   }
   $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
   $STATUS_MESSAGE = $statusObj->getStatusMessage();
   }else{
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
      <title>Admin | Manage City</title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
      <!-- BOOTSTRAP & CUSTOM CSS -->
      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="css/custom.css" rel="stylesheet" type="text/css" />
      <!-- BOOTSTRAP & CUSTOM CSS END-->    
      <!-- FONTAWSOME -->
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <!-- FONTAWSOME END-->
      <!-- IONICONS -->
      <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
      <!-- IONICONS END-->    
      <!-- THEME CSS -->
      <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
      <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
      <!-- THEME CSS END-->
	  <!-- ICHECK CHECKBOX CSS -->
      <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
      <!-- ICHECK CHECKBOX CSS END -->
      <!-- DATA TABLE CSS -->
 	  <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <!-- DATA TABLE CSS END-->
      <link rel="stylesheet" href="css/all_check.css"/>
      <link rel="stylesheet" href="css/libs/select2.css"/>
      <link rel="stylesheet" type="text/css" href="css/libs/nifty-component.css"/>
      <script type="text/javascript" src="js/util/redirection.js"></script>
      <script type="text/javascript" src="js/util/location.js"></script>  
      <script type="text/javascript">
         //setPageContext("add-new","state");
         function countryList(data){
         $.each(data,function(index,val){
         // alert(val.country_id+" "+val.country_name);
         $('#country_code').append($('<option>', { 
         value: val.country_code,
         text : val.country_name 
         }));
         });
         }
         function stateList(data){
         $('#state_code').empty();
         $('#state_code').append($('<option>', { 
          value: "",
         text : "Select State" 
         }));	      
         $.each(data,function(index,val){
         $('#state_code').append($('<option>', { 
         value: val.state_code,
         text : val.state_name 
         }));
         });
         if(data.length==0)
         $("#validationSummary").html("<b>No States in this country.</b>");
         else
         $("#validationSummary").html("<b>States are loaded.</b>");
         $("#validationSummary").fadeOut(2000);   
         }
       </script>
   </head>
   <body class="skin-blue">
      <!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
         <div class="spinner"></div>
        </div>
        <!-- ICON LOADER END-->
         <div class="wrapper" style="display:none" id="body">
         <?php include "page-part/header.php"; ?> 
         <!-- Left side column. contains the logo and sidebar -->
         <?php include "page-part/left_panel.php"; ?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1 class="lightGrey">
                  Add City
               </h1>
               <ol class="breadcrumb">
                  <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
                  <li class="active">Add City</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <!-- Small boxes (Stat box) -->
               <!-- /.row -->
               <!-- Main row -->
               <div class="row">
                  <div class="col-lg-12 col-xs-12 col-sm-12">
                     <div class="box-top updateSite">
                     	<div class="row">
                        <div class="col-lg-3 col-sm-4">
                           <a class="md-trigger btn btn-default btn-lg btn-block add-details"  href="javascript:;" data-modal="modal-13">
                           <i class="fa fa-plus"></i>Add City
                           </a>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-4">
                           <a href="updateWebSiteCity?city_status=all" class="btn btn-success btn-lg col-xs-12">
                           <i class="fa fa-list"></i>All City <span class="badge"><?php echo getRowCount("select count(city_id) from city",$DatabaseCo);?></span>
                           </a>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-4">
                           <a href="updateWebSiteCity?city_status=approved" class="btn btn-success btn-lg col-xs-12">
                           <i class="fa fa-thumbs-up"></i>Approved City <span class="badge"><?php echo getRowCount("select count(city_id) from     city where  status='APPROVED'",$DatabaseCo);?></span>
                           </a>
                        </div>
                        <div class="col-lg-3 col-xs-12 col-sm-4">
                           <a href="updateWebSiteCity?city_status=unapproved" class="btn btn-success btn-lg col-xs-12">
                           <i class="fa fa-thumbs-down"></i>Unapproved City <span class="badge"><?php echo getRowCount("select count(city_id) from city where  status='UNAPPROVED'",$DatabaseCo);?></span>
                           </a>
                        </div>
                        </div>
                     </div>
                     <?php
                        if(!empty($STATUS_MESSAGE)){	
                        if($statusObj->getActionSuccess()){
                        echo  "<div class='alert alert-success' id='success_msg'><i class='fa fa-check-circle fa-fw fa-lg'></i> ".$STATUS_MESSAGE."</div>";
                        }else{
                        echo  "<div class='alert alert-danger' id='validationSummary' style='display:block'><i class='fa fa-times-circle fa-fw fa-lg'></i> Please Correct Following Errors.<ul ><li>".$STATUS_MESSAGE."</li></ul></div>";		
                        }
                        }
                     ?>     
                  </div>
                  <?php
                     $main_menu_count = getRowCount("select count(city_id) from city".getWhereClauseForStatus($city_status),$DatabaseCo);
                     if($main_menu_count>0){  
                  ?>
               
               <div class="col-lg-12 col-xs-12 col-sm-12 mt-10">
                  <div class="box-top">
                  	 <div class="row">
                     <div class="col-lg-1 col-sm-2">
                        	<input type="checkbox" name="check" id="selectall" class="second" />
                            <label for="selectall" class="label2">&nbsp;</label>
                     </div>
                     <div class="col-lg-2 col-xs-12 col-sm-4">
                        <a href="javascript:;" class="btn btn-danger btn-lg  col-xs-12" onclick="submitActionForm('DELETE');">
                        <i class="fa fa-trash"></i> Delete
                        </a>
                     </div>
                     <div class="col-lg-2 col-xs-12 col-sm-4">
                        <a href="javascript:;" class="btn btn-success btn-lg col-xs-12" onclick="submitActionForm('APPROVED');">
                        <i class="fa fa-thumbs-up"></i>Approve
                        </a>
                     </div>
                     <div class="col-lg-2 col-xs-12 col-sm-4">
                        <a href="javascript:;" class="btn btn-warning btn-lg col-xs-12" onclick="submitActionForm('UNAPPROVED');">
                        <i class="fa fa-thumbs-down"></i>Unapprove
                        </a>
                     </div>
                     </div>
                  </div>
               </div>
               <div class="col-xs-12 mt-10">
                  <!-- /.box -->
                  <div class="box box-success">
                     <div class="box-header">
                        <h4 class=""><?php echo strtoupper($city_status); ?> CITY LIST</h4>
                     </div>
                     <!-- /.box-header -->
                     <div class="box-body">
                        <form method="post" action="updateWebSiteCity" id="action_form">
                           <table id="example1" class="table table-bordered table-striped">
                              <thead>
                                 <tr>
                                    <th>
                                    </th>
                                    <th>Edit</th>
                                    <th>Status</th>
                                    <th>Country Name</th>
                                    <th>State Name</th>
                                    <th>City Name</th>
                                 </tr>
                              </thead>
                              <div id="result"></div>
                           </table>
                           <input  type="hidden" name="action" value="" id="action"/>
                        </form>
                     </div>
                     <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
               </div>
               <?php
                  }
                  else
                  {
               ?>
               <div class="col-lg-12 col-xs-12 col-sm-12">
                  <h4>There are no data for <?php echo strtoupper($city_status); ?> City. Please add data.</h4>
                  <br/>
                  <img src="../img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
               </div>
               <?php
                  }
                ?> 
                </div>  
            </section>
            <!-- /.content -->
            <div class="clearfix"></div>
         </div>
         <!-- /.content-wrapper -->
         <?php include "page-part/footer.php"; ?>
      </div>
      <!-- ./wrapper -->
      <div class="md-modal" id="modal-13">
         <div class="md-content" id="dialog">
            <div class="modal-header" >
               <span id="new_button">
               <button class="md-close close" id="old">&times;</button>
               </span>
               <h4 class="modal-title" id="dialog_title">Add New City</h4>
            </div>
            <div class='error-msg' id='validationSummary'></div>
            <form method="post" id="city-form" action="" method="post">
               <div class="modal-body">
                  <div class="form-group form-group-select2">
                     <label ><b> Country:</b></label>
                     <select name="country_code" id="country_code"  class="form-control">
                        <option value="" >Select Country</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1"><b>State Name</b></label>
                     <select name="state_code" id="state_code"  class="form-control">
                        <option value="" >Select State</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1"><b>City Name</b></label>
                     <input type="text" name="city_name" class="form-control" id="city_name" placeholder="Enter city name">
                  </div>
                  <div class="form-group">
                     <label><b>Status</b></label>
                     <div class="radio">
                        <input id="optionsRadios1" class="city_status" type="radio" checked="" value="APPROVED" name="city_status">
                        <label for="optionsRadios1"><b>Active</b> </label>
                        <input id="optionsRadios2" class="city_status" type="radio" value="UNAPPROVED" name="city_status">
                        <label for="optionsRadios2"><b>Inactive </b></label>
                     </div>
                  </div>
               </div>
               <div class="modal-footer updateSite">
                  <input type="button" id="save" class="btn btn-success" value="Save Changes" title="Save Changes"/>
                  <input type="hidden" name="city_id" id="city_id" value=""/>
                  <input type="hidden" name="action" value="" id="update_action"/>
               </div>
            </form>
         </div>
      </div>
      <div class="md-overlay"></div>
      <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
      <script>
       $(document).ready(function() {
       $('#body').show();
       $('.preloader-wrapper').hide();
       });
   </script>
      <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
      <!-- Bootstrap 3.3.2 JS -->
      <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
      <script src="dist/js/app.min.js" type="text/javascript"></script>
      <script type="text/javascript" src="js/util/select2.min.js"></script>
      <!--3D Slit effect pop js-->
      <script src="js/classie.js"></script>
      <script src="js/modalEffects.js"></script>
      <script type="text/javascript" src="dist/js/general.js"></script>
      <script type="text/javascript" src="dist/js/cookieapi.js"></script>
      <script type="text/javascript">
         setPageContext("add-new","city");
      </script>	
      <script type="text/javascript" language="javascript" >
         $(document).ready(function() {         
         	var dataTable = $('#example1').DataTable( {
         "processing": true,
         "serverSide": true,
          "aaSorting": [  [5,'asc'] ],
         "columnDefs": [ {									
         "orderable": false,
         "targets": [0,1,2,3,4]
         } ],
         "ajax":{
         url :"web-services/processing/city_server_processing?status=<?php echo $_SESSION['city_status'];?>", // json
         type: "post",  // method  , by default get
         error: function(){  // error handling
         $(".table").html("");
         $("#example1").append('<tbody class="table"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
         $("#example1_processing").css("display","none");
         }
         }
         });
         getCountries();	  
         $("input[name=city_id]").click(function(){
         $("#selectall").prop("checked", false);		
         });
         //     js for Check/Uncheck all CheckBoxes by Checkbox     // 
         $("#selectall").click(function(){
         $(".second").prop("checked",$("#selectall").prop("checked"))
         }) 
         // add details //
         $('#country_code').select2();
         $("#state_code").select2();
         $(document).on("click", ".add-details", function () {
         $("#save").val("Save Changes");
         $("#dialog_title").text("Add New City");
         $("#update_action").val("ADD"); 		
         $('#modal-13').modal('show');
         $("#validationSummary").hide();
         $("#city_name").focus();
         $("#city_name").val("");
         });
          //     edit details function starts here    // 
         $(document).on("click", ".edit-popup", function (e){
         var myid = $(this).data('id');
         var country_code = $(this).data('country_code');
         var city_name = $(this).data('city_name');
         var state_code = $(this).data('state_code');
         var city_status = $(this).data('city_status');
         $("#country_code").val(country_code).select2();
         $("#state_code").val(state_code).select2();
         getStateList(country_code);
         $("#state_code").select2();
         $("#city_id").val(myid);
         $("#country_code").val(country_code);
         $("#city_name").val(city_name);
         $("#state_code").val(state_code); 
         $("#save").val("Update");
         $("#dialog_title").text("Update City");
         if(city_status=='1'){
         	$("#optionsRadios1").attr("checked","checked");
         }else{	
         $("#optionsRadios2").attr("checked","checked");
         }
         $("#update_action").val("UPDATE"); 
         //$('#modal-13').modal('show');
         $("#validationSummary").hide();
         $("#city_name").focus();	 
         });
         //     to save popup details    // 
         $("#save" ).button().click(function(){
         $("#validationSummary").attr("class","alert alert-warning");
         $("#validationSummary").html("<img src='../img/6.gif' alt='loading'/> <b>Please wait...</b>");
         $("#validationSummary").show();			
         var dataString =  $("#city-form").serialize();			
         $.ajax({
         type: "post",
         url: "web-services/add-details/add-city",
         dataType:"json",
         data: dataString,
         success: function(data){
         if(data.successStatus){
         $("#validationSummary").attr("class","alert alert-success");
         $("#validationSummary").html("<i class='fa fa-check-circle fa-fw fa-lg'></i>"+data.responseMessage+"");
         $("#validationSummary").show();
         $("#old").remove();
         $('<a href="updateWebSiteCity" id="old" class="md-close close">&times;</a>').appendTo('#new_button');
         }else{
         $("#validationSummary").attr("class","alert alert-danger");
         $("#validationSummary").html("<i class='fa fa-times-circle fa-fw fa-lg'></i>Please correct following errors.<ul class='error-hint cf'>"+data.responseMessage+"</ul>");
         $("#validationSummary").show();
         }
         }
         })
         return false;
         });
         $("#country_code").change(function(){
         var country_code = $(this).val();
         $("#validationSummary").html("<img src='../img/6.gif' alt='loading'/> <b>Please wait...</b>");
         $("#validationSummary").show();
         $('#state_code').empty();
         getStateList(country_code);
         $("#state_code").select2();
         });
         });
      </script>			
      <script type="text/JavaScript">
         function MM_openBrWindow(theURL,winName,features) { 
         window.open(theURL,winName,features);
         }
      </script>
      <SCRIPT LANGUAGE="JavaScript">
         <!-- Begin
         var win = null;
         function newWindow(mypage,myname,w,h,features) {
         var winl = (screen.width-w)/2;
         var wint = (screen.height-h)/2;
         if (winl < 0) winl = 0;
         if (wint < 0) wint = 0;
         var settings = 'height=' + h + ',';
         settings += 'width=' + w + ',';
         settings += 'top=' + wint + ',';
         settings += 'left=' + winl + ',';
         settings += features;
         win = window.open(mypage,myname,settings);
         win.window.focus();
         }
         //  End -->
      </script>
   </body>
</html>