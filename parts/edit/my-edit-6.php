<?php
	include_once '../../databaseConn.php';
	include_once '../../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	
	$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';

	$SQLSTATEMENT=$DatabaseCo->dbLink->query("select country_id,state_id,city,city_name,state_name from register_view where matri_id='$matri_id'");
	$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
	
	$country_id=$DatabaseCo->dbRow->country_id;
	$state_id=$DatabaseCo->dbRow->state_id;
	$city=$DatabaseCo->dbRow->city;
?>	
<div class="gt-panel-head">
                    	<span class="pull-left"><i class="fa fa-map-marker"></i>Location Information</span>
                        <a class="pull-right btn gt-btn-orange" onClick="return view66('edit');">
                        	<i class="fa fa-pencil"></i><font class="gt-margin-left-5">submit</font>
                        </a>
                    </div>
                    <div class="gt-panel-body" >
                    	<form  method="post" name="reg_edit_6" id="reg_edit_6">
                        	<div class="row">
                        	<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Country Living In :
                                </label>
                                
                       
                            	<select class="gt-form-control chosen-select" name="country" id="country" data-validetta="required">
									<option value="">Select</option>
                                        <?php
											$SQL_STATEMENT_country =  $DatabaseCo->dbLink->query("SELECT * FROM country where status='APPROVED'  ");
											while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_country))
											{
												?>
												 <option value="<?php echo $DatabaseCo->Row->country_id ?>"<?php if($DatabaseCo->dbRow->country_id==$DatabaseCo->Row->country_id){?>selected="selected" <?php }?>><?php echo $DatabaseCo->Row->country_name; ?></option>
												<?php
											}
											?>		
                                        </select><div id="status1"></div>
                            </div>
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	State Living In :
                                </label>
                               	<select class="gt-form-control" id="state" name="state_id" data-validetta="required">
									<option value="">Select</option>
                                    <option value="<?php echo $DatabaseCo->dbRow->state_id ?>"><?php echo $DatabaseCo->dbRow->state_name; ?></option>
								</select><div id="status2"></div>
                            </div>
							<div class="clearfix"></div>
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	City Living In :
                                </label>
                                <select class="gt-form-control" id="city" name="city" data-validetta="required">
                                 <option value="<?php echo $DatabaseCo->dbRow->city; ?>"><?php echo $DatabaseCo->dbRow->city_name; ?></option>
                                </select>    
                            	
                            </div>
                            </div>
                        </form>
                    </div>
                    
                    
                    
<script type="text/javascript" src="./js/validetta.js"></script>
<script type="text/javascript">
	function view66(status){	
		$(function(){
    	$('#reg_edit_6').validetta({
    		errorClose : false,
			onValid : function( event ) {
       		 event.preventDefault();	
	   		 view6(status);
    		}
    	});
    });
		$('#reg_edit_6').submit();
		      
    }
    </script>
    <script>
		
		$("#country").change(function() {
                    $("#status1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
                    var id = $(this).val();
                    var dataString = 'id=' + id;

                    $.ajax({
                        type: "POST",
                        url: "ajax_country_state",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            $("#state").html(html);
                            $("#status1").html('');
							$("#state").trigger("chosen:updated");
                        }
                    });
                });

                $("#state").on('change', function() {

                    $("#status2").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
                    var id = $(this).val();
                    var cnt_id = $("#country").val();
                    var dataString = 'state_id=' + id + '&country_id=' + cnt_id;
                    
                    $.ajax({
                        type: "POST",
                        url: "ajax_country_state",
                        data: dataString,
                    
                        success: function(html) {

                            $("#city").html(html);
                            $("#status2").html('');
							$("#city").trigger("chosen:updated");
                        }
                    });
                });

</script>
 