<?php

ob_start();

include_once '../../databaseConn.php';

$DatabaseCo = new DatabaseConn();

include_once '../../lib/requestHandler.php';

include_once '../../class/Config.class.php';

$configObj = new Config();



$matri_id=isset($_REQUEST['matri_id'])?$_REQUEST['matri_id']:0;



if(isset($_REQUEST['save']))

{

	

	    $_SESSION['mid'] = $_POST['mid'];

		$_SESSION['name'] = $_POST['name'];

		$_SESSION['email'] = $_POST['email'];

		$_SESSION['address'] = $_POST['address'];

		$_SESSION['pay_mode'] = $_POST['pay_mode'];

		$_SESSION['activedt'] = $_POST['activedt'];

		$_SESSION['plan'] = $_POST['plan'];

		$_SESSION['video'] = $_POST['video'];

		$_SESSION['chat'] = $_POST['chat'];

		$_SESSION['bankdet'] = $_POST['bankdet'];

		$_SESSION['duration'] = $_POST['duration'];

		$_SESSION['no_of_contacts'] = $_POST['no_of_contacts'];

		$_SESSION['no_of_msg'] = $_POST['no_of_msg'];

		$_SESSION['no_of_profile'] = $_POST['no_of_profile'];

		$_SESSION['amount'] = $_POST['amount'];

		header("location:edit_paid_part.php?id=$matri_id");

	

}



if($matri_id!='')

{



$sql=$DatabaseCo->dbLink->query("select * from register_view where matri_id='$matri_id'");

$row=mysqli_fetch_array($sql);

	

$select=$DatabaseCo->dbLink->query("select * from payments where pmatri_id='$matri_id'");	

$plan_data=mysqli_fetch_array($select);	

?>

  

   

<div class="md-content md-effect-13" id="dialog" style="width:65% !important; margin-top:1%;">

<div class="modal-header">

<span id="new_button">

<button class="md-close close" id="old" data-dismiss="modal">&times;</button>

 </span>

<h4 class="modal-title" id="myModalLabel">Edit Plan</h4>

</div>

<div class='error-msg' id='validationSummary'></div>



<form method="post" id="edit_plan_list" action="edit_paid_part" >

<div class="modal-body">



<!--<div class="form-group">

<label ><b> Country:</b></label>

<select name="country_id" id="country_id"  class="form-control">

			 <option value="" >Select religion</option>

			    

			</select>

            </div>-->

<div class="row">

  <div class="col-xs-12 col-lg-2 col-sm-4">

    <div class="thumbnail">

   <?php

    if($row['photo1']!='')

	{

		?>

    <img src="../my_photos/<?php echo $row['photo1']; ?>">

    <?php

	}

	else

	{

	?>

    <img src="../img/ne-no-photo-img.png" alt="User Image" height="150" width="130" border="1" />

    <?php	

	}

	?>

    </div>

  </div>

  <div class="col-xs-12 col-lg-8 col-sm-8" >

	<div class="form-group col-xs-8">

<label for="exampleInputEmail1"><h3 class="text-primary"><?php echo $row['matri_id']; ?></h3></label>&nbsp;&nbsp;&nbsp;

<label for="exampleInputEmail1">



                                <?php if($row['fstatus']=='Featured'){?>

                               

                                    <i class="fa fa-star"></i>

                                   <span class="hidden-xs">Featured</span>

                                <?php }?>

                                <?php if($row['status']=='Paid'){?>

                                

                                   <i class="fa fa-money"></i>

                                   <span class="hidden-xs">Paid</span>

                                <?php }elseif($row['status']=='Active'){?>

                               

                                    <i class="fa fa-thumbs-up"></i>

                                    <span class="hidden-xs">Active</span>

                                <?php }elseif($row['status']=='Inactive'){?>

                                

                                    <i class="fa fa-thumbs-down text-danger"></i>

                                     <span class="hidden-xs">Inactive</span>

                                <?php }elseif($row['status']=='Suspended'){?>

                                

                                    <i class="fa fa-user-times text-danger"></i>

                                    <span class="hidden-xs">Suspended</span>

                                <?php }?>

                                

                            </label>



</div>



    <div class="form-group col-xs-8">

    <label for="exampleInputEmail1"><i class="fa fa-envelope text-danger"></i> : &nbsp; &nbsp; <b><?php echo $row['username']; ?></b></label>

    </div>

    <div class="form-group col-xs-8">

    <label for="exampleInputEmail1">City : <?php echo $row['city_name']; ?> &nbsp; &nbsp; State : <?php echo $row['state_name']; ?> &nbsp; &nbsp; Country : <?php echo $row['country_name']; ?> &nbsp; &nbsp;</label>

    </div>

  

  </div>  

</div>



<div class="row">

      <div class="col-xs-12 col-lg-6 col-sm-6" >

    <div class="row" style="margin-top:3%;">

    	<div class="form-group form-group-select2">

			<div class="col-xs-8">

            	<label for="exampleInputEmail1"><b>Current Plan : <?php echo $plan_data['p_plan']; ?></b></label>

        	</div>

            

    	</div>

    </div>	

    <div class="row" style="margin-top:3%;">

    	<div class="form-group form-group-select2">

			<div class="col-xs-8">

    

            <label for="exampleInputEmail1"><b>Plan Expiry Date : <?php echo $plan_data['exp_date'];?></b></label>

            </div>

            <!--<div class="col-xs-6">

	<?php $today1 = strtotime ('now');

                    $today=date("Y-m-d",$today1); ?>

                    <input name="activedt" type="text"  id="activedt" value="<?php echo $today; ?>" class="form-control" />

             </div>-->

    	</div>

    </div>	

    <div class="row" style="margin-top:3%;">

    	<div class="form-group form-group-select2">

			<div class="col-xs-4">

    			<label for="exampleInputEmail1"><b>Update Plan :</b></label>

				<?php

                $plan = $DatabaseCo->dbLink->query("SELECT * from membership_plan");

                ?>

                </div>

            	<div class="col-xs-6">

                <select name="plan"  onChange="getCurrencyCode('findpay?plan='+this.value+'&id=<?php echo $row['matri_id'];?>')" class="form-control" data-validetta="required">

                <option value="">select Plan</option>

                <?php

                while($data = mysqli_fetch_array($plan))

                {?> 

                <option value="<?php echo $data['plan_name'];?>"><?php echo $data['plan_name'];?></option>

                <?php

                } ?>

                </select>

    		</div>

    	</div>

    </div>	

   <!-- <div class="row" style="margin-top:3%;">

    	<div class="form-group form-group-select2">

			<div class="col-xs-4">

    			<label for="exampleInputEmail1"><b>Allow Video :</b></label>

    		</div>

            <div class="col-xs-6">

                <input name="video" type="radio" value="Yes"  checked="checked" />&nbsp;&nbsp;Yes&nbsp;&nbsp;

                 <input name="video" type="radio" value="No" />&nbsp;&nbsp;No

			</div>

    	</div>

    </div>	

    <div class="row" style="margin-top:3%;">

    	<div class="form-group form-group-select2">

			<div class="col-xs-4">

    			<label for="exampleInputEmail1"><b>Allow Chat :</b></label>

			</div>

            <div class="col-xs-6">   

            <input name="chat" type="radio" value="Yes"  checked="checked" />&nbsp;&nbsp;Yes&nbsp;&nbsp;

             <input name="chat" type="radio" value="No" />&nbsp;&nbsp;No

    		</div>

    	</div>

    </div>

    <div class="row" style="margin-top:3%;">

    	<div class="form-group form-group-select2">

			<div class="col-xs-4">

    			<label for="exampleInputEmail1"><b>Bank Detail :</b></label>

    		</div>

            <div class="col-xs-6">   

            	<textarea name="bankdet" cols="30" rows="4"  id="bankdet" class="form-control"></textarea>

            </div>

    	</div>

    </div>-->

    </div>	



    <div class="col-xs-12 col-lg-6 col-sm-6" id="plandiv">

   

    </div>



</div>

</div>



<div class="modal-footer">



 <input type="submit" name="save"  class="btn btn-primary" value="Proceed" />

 

 <input type="hidden" name="keyword_id" id="keyword_id" value=""/>

 <input type="hidden" name="action" value="" id="update_action"/>

 

 <input name="mid" type="hidden" id="mid" value="<?php echo $row['matri_id'];?>" />

  

  <input name="expdate" type="hidden" id="expdate" value="<?php echo $plan_data['exp_date'];?>" />

             

</div>

</div>



</form>

</div>

<div class="md-overlay"></div>



 <script type="text/javascript">

    $(function(){

    	$('#edit_plan_list').validetta({

    		errorClose : false,

            realTime : true

    	});

    });

    </script>

<script>

//  Developed by Roshan Bhattarai 

//  Visit http://roshanbh.com.np for this script and more.

//  This notice MUST stay intact for legal use



//fuction to return the xml http object

function getXMLHTTP() { 

		var xmlhttp=false;	

		try{

			xmlhttp=new XMLHttpRequest();

		}

		catch(e)	{		

			try{			

				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");

			}

			catch(e){

				try{

				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

				}

				catch(e1){

					xmlhttp=false;

				}

			}

		}

		 	

		return xmlhttp;

	}

	

	

	

function getCurrencyCode(strURL)

{		

	var req = getXMLHTTP();		

	if (req) 

	{

		//function to be called when state is changed

		req.onreadystatechange = function()

		{

			//when state is completed i.e 4

			if (req.readyState == 4) 

			{			

				// only if http status is "OK"

				if (req.status == 200)

				{						

					document.getElementById('plandiv').innerHTML=req.responseText;					

				} 

				

				else 

				{

					alert("There was a problem while using XMLHTTP:\n" + req.statusText);

				}

			}				

		 }			

		 req.open("GET", strURL, true);

		 req.send(null);

	}			

}

</script>

<?php } 

else

{

	echo "<h1>Invalid User ID.</h1>";

}?><?php ?>