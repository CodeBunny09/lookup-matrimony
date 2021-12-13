<?php
	include_once '../../databaseConn.php';
	include_once '../../lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	$matri_id=$_SESSION['user_id']?$_SESSION['user_id']:'';
	$SQLSTATEMENT=$DatabaseCo->dbLink->query("select profile_text from register where matri_id='$matri_id'");
	$DatabaseCo->dbRow = mysqli_fetch_object($SQLSTATEMENT);
?>

<div class="gt-panel-head">
                    	<span class="pull-left"><i class="fa fa-star"></i>About Me</span>
                        <a class="pull-right btn gt-btn-orange" onClick="return view22('edit');">
                        	<i class="fa fa-pencil"></i><font class="gt-margin-left-5">Submit</font>
                        </a>
                    </div>
                    <div class="gt-panel-body" >
                    	<div class="row">
                        
                        	<div class="col-xxl-16 col-xl-16 col-lg-16 col-md-16 col-sm-16 col-xs-16 gt-padding-bottom-10 gt-padding-top-10 gt-view-detail">
                                <label>
                                  About Me  :
                                </label>
                                <form  method="post" name="reg_p_text" id="reg_ptext" >
                                <textarea class="gt-form-control" rows="5" name="profile_text" data-validetta="required"><?php echo $DatabaseCo->dbRow->profile_text;?> </textarea>
                                </form>
                             </div>
                             
                        </div>
                    </div>
                    
 <script type="text/javascript" src="./js/validetta.js"></script>                
 <script type="text/javascript">
    function view22(status){	
		$(function(){
    	$('#reg_ptext').validetta({
    		errorClose : false,
			onValid : function( event ) {
       		 event.preventDefault();	
	   		 view2(status);
    		}
    	});
    });
		$('#reg_ptext').submit();
    }
</script>
                   