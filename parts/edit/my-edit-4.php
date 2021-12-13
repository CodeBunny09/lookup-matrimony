<?php
	include_once '../../databaseConn.php';
	include_once '../../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
	$SQLSTATEMENT=$DatabaseCo->dbLink->query("select edu_detail,occupation,income,emp_in,gender from register where matri_id='$matri_id'");
	$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
	$edu_detail=$DatabaseCo->dbRow->edu_detail; 
	$occupation=$DatabaseCo->dbRow->occupation; 
	$emp_in=$DatabaseCo->dbRow->emp_in;
/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT additional_degree,annual_income FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
					<div class="gt-panel-head">
                    	<span class="pull-left"><i class="fa fa-university"></i>Education / Profession Information</span>
                        <a class="pull-right btn gt-btn-orange" onClick="return view44('edit');">
                        	<i class="fa fa-pencil"></i><font class="gt-margin-left-5">submit</font>
                        </a>
                    </div>
                    <div class="gt-panel-body" >
                    	<form  method="post" name="reg_edit_4" id="reg_edit_4">
                        	<div class="row">
                        	<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Highest Education  :
                                </label>
                                <select class="gt-form-control" name="edu_detail" data-validetta="required">
                                <?php
								$get_edu=explode(",",$DatabaseCo->dbRow->edu_detail);
								
                               $SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED'  ");
                               
                               while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_edu))
                               {
                               ?>
                               	<option value="<?php echo $DatabaseCo->Row->edu_id ?>"<?php if($get_edu[0]==$DatabaseCo->Row->edu_id){?>selected="selected" <?php }?>><?php echo $DatabaseCo->Row->edu_name; ?></option>
                               <?php } ?>
                               </select>
                            </div>
							<?php if($row_field->additional_degree == 'Yes'){ ?>
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Additional Degree  :
                                </label>
                                <select class="gt-form-control" name="edu_detail1" data-validetta="required">
                                <?php
                               $SQL_STATEMENT_edu1 =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED'  ");
                               
                               while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_edu1))
                               {
                               ?>
                               	<option value="<?php echo $DatabaseCo->Row->edu_id ?>"<?php if(isset($get_edu[1]) && $get_edu[1]!='' && $get_edu[1]==$DatabaseCo->Row->edu_id){?>selected="selected" <?php }?>><?php echo $DatabaseCo->Row->edu_name; ?></option>
                               <?php } ?>
                               </select>
                            </div>
                            <?php } ?>
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Employed in :
                                </label>
                               	<select class="gt-form-control" name="empin" data-validetta="required">
                                    <option value="">Choose Employement</option>
                                    <option value="Private" <?php if($emp_in=='Private'){echo "selected";}?>>Private</option>
                                    <option value="Government" <?php if($emp_in=='Government'){echo "selected";}?>>Government</option>
                                    <option value="Business" <?php if($emp_in=='Business'){echo "selected";}?>>Business</option>
                                    <option value="Defence" <?php if($emp_in=='Defence'){echo "selected";}?>>Defence</option>
                                    <option value="Self Employed" <?php if($emp_in=='Self Employed'){echo "selected";}?>>Self Employed</option>
									<?php
	  									if ($DatabaseCo->dbRow->gender == 'Female') {
									?>
									<option value="Not Working" <?php if($emp_in=='Not Working'){echo "selected";}?>>Not Working</option>
                                    <?php } ?>
									
                                 </select>
                            </div>
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Occupation  :
                                </label>
                                <select class="gt-form-control" name="occupation" data-validetta="required">
									<?php
                                   $SQL_STATEMENT_occu =  $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED'  ");
                                   
                                   while($DatabaseCo->Row = mysqli_fetch_object($SQL_STATEMENT_occu))
                                   {
                                   ?>
                                   <option value="<?php echo $DatabaseCo->Row->ocp_id ?>"<?php if($DatabaseCo->dbRow->occupation==$DatabaseCo->Row->ocp_id){?>selected="selected" <?php }?>><?php echo $DatabaseCo->Row->ocp_name; ?></option>
                                   <?php } ?>
                                </select>
                            </div>
								
							<?php if($row_field->annual_income == 'Yes'){ ?>
                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                            	<label>
                              	 	Annual Income  :
                                </label>
                                <select class="gt-form-control" name="income">
                                        	
                            <option value="Rs 10,000 - 50,000" <?php if($DatabaseCo->dbRow->income == "Rs 10,000 - 50,000"){echo "selected";}?>>Rs 10,000 - 50,000</option>
                            <option value="Rs 50,000 - 1,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 50,000 - 1,00,000"){echo "selected";}?>>Rs 50,000 - 1,00,000</option>
                            <option value="Rs 1,00,000 - 2,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 1,00,000 - 2,00,000"){echo "selected";}?>>Rs 1,00,000 - 2,00,000</option>
                            <option value="Rs 2,00,000 - 4,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 2,00,000 - 4,00,000"){echo "selected";}?>>Rs 2,00,000 - 4,00,000</option>
                            <option value="Rs 4,00,000 - 6,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 4,00,000 - 6,00,000"){echo "selected";}?>>Rs 4,00,000 - 6,00,000</option>
                            <option value="Rs 6,00,000 - 8,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 6,00,000 - 8,00,000"){echo "selected";}?>>Rs 6,00,000 - 8,00,000</option>
                            <option value="Rs 8,00,000 - 10,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 8,00,000 - 10,00,000"){echo "selected";}?>>Rs 8,00,000 - 10,00,000</option>
                            <option value="Rs 10,00,000 - 12,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 10,00,000 - 12,00,000"){echo "selected";}?>>Rs 10,00,000 - 12,00,000</option>
                            <option value="Rs 12,00,000 - 14,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 12,00,000 - 14,00,000"){echo "selected";}?>>Rs 12,00,000 - 14,00,000</option>
                            <option value="Rs 14,00,000 - 16,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 14,00,000 - 16,00,000"){echo "selected";}?>>Rs 14,00,000 - 16,00,000</option>
                            <option value="Rs 16,00,000 - 18,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 16,00,000 - 18,00,000"){echo "selected";}?>>Rs 16,00,000 - 18,00,000</option>
                            <option value="Rs 18,00,000 - 20,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 18,00,000 - 20,00,000"){echo "selected";}?>>Rs 18,00,000 - 20,00,000</option>
                            <option value="Rs 20,00,000 - 22,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 20,00,000 - 22,00,000"){echo "selected";}?>>Rs 20,00,000 - 22,00,000</option>
                            <option value="Rs 22,00,000 - 24,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 22,00,000 - 24,00,000"){echo "selected";}?>>Rs 22,00,000 - 24,00,000</option>
                            <option value="Rs 24,00,000 - 26,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 24,00,000 - 26,00,000"){echo "selected";}?>>Rs 24,00,000 - 26,00,000</option>
                            <option value="Rs 26,00,000 - 28,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 26,00,000 - 28,00,000"){echo "selected";}?>>Rs 26,00,000 - 28,00,000</option>
                            <option value="Rs 28,00,000 - 30,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 28,00,000 - 30,00,000"){echo "selected";}?>>Rs 28,00,000 - 30,00,000</option>
                            <option value="Rs 30,00,000 - 32,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 30,00,000 - 32,00,000"){echo "selected";}?>>Rs 30,00,000 - 32,00,000</option>
                            <option value="Rs 32,00,000 - 34,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 32,00,000 - 34,00,000"){echo "selected";}?>>Rs 32,00,000 - 34,00,000</option>
                            <option value="Rs 34,00,000 - 36,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 34,00,000 - 36,00,000"){echo "selected";}?>>Rs 34,00,000 - 36,00,000</option>
                            <option value="Rs 36,00,000 - 38,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 36,00,000 - 38,00,000"){echo "selected";}?>>Rs 36,00,000 - 38,00,000</option>
                            <option value="Rs 38,00,000 - 40,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 38,00,000 - 40,00,000"){echo "selected";}?>>Rs 38,00,000 - 40,00,000</option>
                            <option value="Rs 40,00,000 - 42,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 40,00,000 - 42,00,000"){echo "selected";}?>>Rs 40,00,000 - 42,00,000</option>
                            <option value="Rs 42,00,000 - 44,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 42,00,000 - 44,00,000"){echo "selected";}?>>Rs 42,00,000 - 44,00,000</option>
                            <option value="Rs 44,00,000 - 46,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 44,00,000 - 46,00,000"){echo "selected";}?>>Rs 44,00,000 - 46,00,000</option>
                            <option value="Rs 46,00,000 - 48,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 46,00,000 - 48,00,000"){echo "selected";}?>>Rs 46,00,000 - 48,00,000</option>
                            <option value="Rs 48,00,000 - 50,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 48,00,000 - 50,00,000"){echo "selected";}?>>Rs 48,00,000 - 50,00,000</option>
                            <option value="Rs 50,00,000 - 52,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 50,00,000 - 52,00,000"){echo "selected";}?>>Rs 50,00,000 - 52,00,000</option>
                            <option value="Rs 52,00,000 - 54,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 52,00,000 - 54,00,000"){echo "selected";}?>>Rs 52,00,000 - 54,00,000</option>
                            <option value="Rs 54,00,000 - 56,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 54,00,000 - 56,00,000"){echo "selected";}?>>Rs 54,00,000 - 56,00,000</option>
                            <option value="Rs 56,00,000 - 58,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 56,00,000 - 58,00,000"){echo "selected";}?>>Rs 56,00,000 - 58,00,000</option>
                            <option value="Rs 58,00,000 - 60,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 58,00,000 - 60,00,000"){echo "selected";}?>>Rs 58,00,000 - 60,00,000</option>
                            <option value="Rs 60,00,000 - 62,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 60,00,000 - 62,00,000"){echo "selected";}?>>Rs 60,00,000 - 62,00,000</option>
                            <option value="Rs 62,00,000 - 64,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 62,00,000 - 64,00,000"){echo "selected";}?>>Rs 62,00,000 - 64,00,000</option>
                            <option value="Rs 64,00,000 - 66,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 64,00,000 - 66,00,000"){echo "selected";}?>>Rs 64,00,000 - 66,00,000</option>
                            <option value="Rs 66,00,000 - 68,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 66,00,000 - 68,00,000"){echo "selected";}?>>Rs 66,00,000 - 68,00,000</option>
                            <option value="Rs 68,00,000 - 70,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 68,00,000 - 70,00,000"){echo "selected";}?>>Rs 68,00,000 - 70,00,000</option>
                            <option value="Rs 70,00,000 - 72,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 70,00,000 - 72,00,000"){echo "selected";}?>>Rs 70,00,000 - 72,00,000</option>
                            <option value="Rs 72,00,000 - 74,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 72,00,000 - 74,00,000"){echo "selected";}?>>Rs 72,00,000 - 74,00,000</option>
                            <option value="Rs 74,00,000 - 76,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 74,00,000 - 76,00,000"){echo "selected";}?>>Rs 74,00,000 - 76,00,000</option>
                            <option value="Rs 76,00,000 - 78,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 76,00,000 - 78,00,000"){echo "selected";}?>>Rs 76,00,000 - 78,00,000</option>
                            <option value="Rs 78,00,000 - 80,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 78,00,000 - 80,00,000"){echo "selected";}?>>Rs 78,00,000 - 80,00,000</option>
                            <option value="Rs 80,00,000 - 82,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 80,00,000 - 82,00,000"){echo "selected";}?>>Rs 80,00,000 - 82,00,000</option>
                            <option value="Rs 82,00,000 - 84,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 82,00,000 - 84,00,000"){echo "selected";}?>>Rs 82,00,000 - 84,00,000</option>
                            <option value="Rs 84,00,000 - 86,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 84,00,000 - 86,00,000"){echo "selected";}?>>Rs 84,00,000 - 86,00,000</option>
                            <option value="Rs 86,00,000 - 88,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 86,00,000 - 88,00,000"){echo "selected";}?>>Rs 86,00,000 - 88,00,000</option>
                            <option value="Rs 88,00,000 - 90,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 88,00,000 - 90,00,000"){echo "selected";}?>>Rs 88,00,000 - 90,00,000</option>
                            <option value="Rs 90,00,000 - 92,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 90,00,000 - 92,00,000"){echo "selected";}?>>Rs 90,00,000 - 92,00,000</option>
                            <option value="Rs 92,00,000 - 94,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 92,00,000 - 94,00,000"){echo "selected";}?>>Rs 92,00,000 - 94,00,000</option>
                            <option value="Rs 94,00,000 - 96,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 94,00,000 - 96,00,000"){echo "selected";}?>>Rs 94,00,000 - 96,00,000</option>
                            <option value="Rs 96,00,000 - 98,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 96,00,000 - 98,00,000"){echo "selected";}?>>Rs 96,00,000 - 98,00,000</option>
                            <option value="Rs 98,00,000 - 1,00,00,000" <?php if($DatabaseCo->dbRow->income == "Rs 98,00,000 - 1,00,00,000"){echo "selected";}?>>Rs 98,00,000 - 1,00,00,000</option>
                            <option value="Above Rs 1,00,00,000" <?php if($DatabaseCo->dbRow->income == "Above Rs 1,00,00,000"){echo "selected";}?>>Above Rs 1,00,00,000</option>
                            <option value="Not Working">Not Working</option>
                            
                                 </select>
                            </div>
							<?php } ?>
                         </div>
                       </form>
                    </div>
<script type="text/javascript" src="./js/validetta.js"></script>
<script type="text/javascript">
	function view44(status){	
		$(function(){
    	$('#reg_edit_4').validetta({
    		errorClose : false,
			onValid : function( event ) {
       		 event.preventDefault();	
	   		 view4(status);
    		}
    	});
    });
		$('#reg_edit_4').submit();   
    }
</script>
           