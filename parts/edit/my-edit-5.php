<?php
	include_once '../../databaseConn.php';
	include_once '../../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
	$SQLSTATEMENT=$DatabaseCo->dbLink->query("select family_type,family_value,family_status,father_occupation,mother_occupation,no_of_brothers,no_marri_brother,no_of_sisters,no_marri_sister from register where matri_id='$matri_id'");
	$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);

	/*-- Field Enable / Disable -- */
	$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT family_profile,family_status,family_type,family_value,father_occupation,mother_occupation,no_of_brother,no_of_married_brother,no_of_sister,no_of_married_sister FROM field_settings WHERE id='1'");
	$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
					<div class="gt-panel-head">
                    	<span class="pull-left"><i class="fa fa-users"></i>Family Details</span>
                        <a  class="pull-right btn gt-btn-orange" onClick="return view55('edit');">
                        	<i class="fa fa-pencil"></i><font class="gt-margin-left-5">submit</font>
                        </a>
                    </div>
                    <div class="gt-panel-body" >
                    	<form  method="post" name="reg_edit_5" id="reg_edit_5">	
                        	<div class="row">
							<?php if($row_field->family_type == 'Yes'){ ?>	
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Family Type  :
                                </label>
                                <select class="gt-form-control" name="family_type" <?php if($row_field->family_type == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                                    <option value="">Select Family Type</option>
                                    <option value="Joint" <?php if($DatabaseCo->dbRow->family_type=='Joint'){ echo "selected";}?>>Joint</option>
									<option value="Nuclear" <?php if($DatabaseCo->dbRow->family_type=='Nuclear'){ echo "selected";}?>>Nuclear</option>
								</select>
                            </div>
							<?php } ?>
							<?php if($row_field->family_status == 'Yes'){ ?>
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Family Status :
                                </label>
                                <select class="gt-form-control" name="family_status" <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?>>
									<option value="">Select Family Status</option>
									<option value="Rich" <?php if($DatabaseCo->dbRow->family_status=='Rich'){ echo "selected";}?>>Rich</option>
                                    <option value="Upper Middle Class" <?php if($DatabaseCo->dbRow->family_status=='Upper Middle Class'){ echo "selected";}?>>Upper Middle Class</option>
                                    <option value="Middle Class" <?php if($DatabaseCo->dbRow->family_status=='Middle Class'){ echo "selected";}?>>Middle Class</option>
                                    <option value="Affluent" <?php if($DatabaseCo->dbRow->family_status=='Affluent'){ echo "selected";}?>>Affluent</option> 	
                               </select>
                            </div>
							<?php } ?>
							<?php if($row_field->family_value == 'Yes'){ ?>	
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                                <label>
                                    Family Value  :
                                </label>
                                <select class="gt-form-control" name="family_value" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?>>

                                            <option value="">Select Family Type</option>

                                                <option value="Orthodox" <?php if($DatabaseCo->dbRow->family_value=='Orthodox'){ echo "selected";}?>>Orthodox</option>

                                                <option value="Traditional" <?php if($DatabaseCo->dbRow->family_value=='Traditional'){ echo "selected";}?>>Traditional</option>

                                                <option value="Moderate" <?php if($DatabaseCo->dbRow->family_value=='Moderate'){ echo "selected";}?>>Moderate</option>

                                                <option value="Liberal" <?php if($DatabaseCo->dbRow->family_value=='Liberal'){ echo "selected";}?>>Liberal</option>
                                            </select>
                                
                            </div>
							<?php } ?>	
							<?php if($row_field->father_occupation == 'Yes'){ ?>	
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Father Occupation :
                                </label>
                                <input type="text" class="gt-form-control valid" value="<?php echo $DatabaseCo->dbRow->father_occupation; ?>" name="father_occupation" >
                            	
                            </div>
                            <div class="clearfix"></div>
							<?php } ?>
							<?php if($row_field->mother_occupation == 'Yes'){ ?>
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Mother Occupation :
                                </label>
                                <input type="text" class="gt-form-control valid" value="<?php echo $DatabaseCo->dbRow->mother_occupation; ?>" name="mother_occupation">
							</div>
							<?php } ?>
							<?php if($row_field->no_of_brother == 'Yes'){ ?>	
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	No. of Brothers  :
                                </label>
                                <select class="gt-form-control" name="no_of_brothers">

                                        	<option value="No Brother" <?php if($DatabaseCo->dbRow->no_of_brothers=='No Brother'){echo "selected";}?>>No Brother</option>

                                                <option value="1 Brother" <?php if($DatabaseCo->dbRow->no_of_brothers=='1 Brother'){echo "selected";}?>>1 Brother</option>

                                                <option value="2 Brothers" <?php if($DatabaseCo->dbRow->no_of_brothers=='2 Brothers'){echo "selected";}?>>2 Brothers</option>

                                                <option value="3 Brothers" <?php if($DatabaseCo->dbRow->no_of_brothers=='3 Brothers'){echo "selected";}?>>3 Brothers</option>

                                                <option value="4 Brothers" <?php if($DatabaseCo->dbRow->no_of_brothers=='4 Brothers'){echo "selected";}?>>4 Brothers</option>

                                                <option value="4 + Brothers" <?php if($DatabaseCo->dbRow->no_of_brothers=='4 + Brothers'){echo "selected";}?>>4 + Brothers</option>

                                        </select>
                            	
                            </div>
							<?php } ?>	
							<?php if($row_field->no_of_married_brother == 'Yes'){ ?>	
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Married Brothers  :
                                </label>
                                <select name="nbm" class="gt-form-control">
										<option value="No married brother" <?php if($DatabaseCo->dbRow->no_marri_brother=='No married brother'){echo "selected";}?>>No married brother</option>
										<option value="1 married brother" <?php if($DatabaseCo->dbRow->no_marri_brother=='1 married brother'){echo "selected";}?>>1 married brother</option>

                                        <option value="2 married brothers" <?php if($DatabaseCo->dbRow->no_marri_brother=='2 married brothers'){echo "selected";}?>>2 married brothers</option>

                                        <option value="3 married brothers" <?php if($DatabaseCo->dbRow->no_marri_brother=='3 married brothers'){echo "selected";}?>>3 married brothers</option>

                                        <option value="4 married brothers" <?php if($DatabaseCo->dbRow->no_marri_brother=='4 married brothers'){echo "selected";}?>>4 married brothers</option>

                                        <option value="4+ brothers" <?php if($DatabaseCo->dbRow->no_marri_brother=='4+ brothers'){echo "selected";}?>>4+ brothers</option>

                                      </select>
                            	
                            </div>
							<?php } ?>	
							<?php if($row_field->no_of_sister == 'Yes'){ ?>	
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	No. of Sisters :
                                </label>
                                <select class="gt-form-control" name="no_of_sisters" >

                                        	<option value="No Sister" <?php if($DatabaseCo->dbRow->no_of_sisters=='No Sister'){echo "selected";}?>>No Sister</option>

                                                <option value="1 Sister" <?php if($DatabaseCo->dbRow->no_of_sisters=='1 Sister'){echo "selected";}?>>1 Sister</option>

                                                <option value="2 Sisters" <?php if($DatabaseCo->dbRow->no_of_sisters=='2 Sisters'){echo "selected";}?>>2 Sisters</option>

                                                <option value="3 Sisters" <?php if($DatabaseCo->dbRow->no_of_sisters=='3 Sisters'){echo "selected";}?>>3 Sisters</option>

                                                <option value="4 Sisters" <?php if($DatabaseCo->dbRow->no_of_sisters=='4 Sisters'){echo "selected";}?>>4 Sisters</option>

                                                <option value="4 + Sisters" <?php if($DatabaseCo->dbRow->no_of_sisters=='4 + Sisters'){echo "selected";}?>>4 + Sisters</option>

                                        </select>
                            	
                            </div>
							<?php } ?>	
							<?php if($row_field->no_of_married_sister == 'Yes'){ ?>	
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Married Sisters :
                                </label>
                                <select name="nsm" class="gt-form-control">

                                        

                                        <option value="No married sister" <?php if($DatabaseCo->dbRow->no_marri_sister=='No married sister'){echo "selected";}?>>No married Sister</option>

                                        <option value="1 married sister" <?php if($DatabaseCo->dbRow->no_marri_sister=='1 married sister'){echo "selected";}?>>1 married sister</option>

                                        <option value="2 married sisters" <?php if($DatabaseCo->dbRow->no_marri_sister=='2 married sisters'){echo "selected";}?>>2 married sisters</option>

                                        <option value="3 married sisters" <?php if($DatabaseCo->dbRow->no_marri_sister=='3 married sisters'){echo "selected";}?>>3 married sisters</option>

                                        <option value="4 married sisters" <?php if($DatabaseCo->dbRow->no_marri_sister=='4 married sisters'){echo "selected";}?>>4 married sisters</option>

                                        <option value="4+ married sisters" <?php if($DatabaseCo->dbRow->no_marri_sister=='4+ married sisters'){echo "selected";}?>>4+ married sisters</option>

                                      </select>
                            	
                            </div>
							<?php } ?>	
                        </div>
                        </form>
                    </div>
                    
                    
<script type="text/javascript" src="./js/validetta.js"></script>
<script type="text/javascript">
function view55(status){	
		$(function(){
    	$('#reg_edit_5').validetta({
    		errorClose : false,
			onValid : function( event ) {
       		 event.preventDefault();	
	   		 view5(status);
    		}
    	});
    });
		$('#reg_edit_5').submit();    
    }
</script>
    <script>
		$('.valid').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault(alert('Spacial Character & Numbers Not Allowed.'));
       return false;	  
	}	
});
</script>

    