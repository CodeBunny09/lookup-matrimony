<?php 
include_once '../../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$SQL_STATEMENT_EMAIL = $DatabaseCo->dbLink->query("SELECT * FROM email_setting WHERE email_config_id='1'");
$row=mysqli_fetch_object($SQL_STATEMENT_EMAIL);
$host=$row->host;
$email=$row->email;
$password=$row->email_password;
$port=$row->port;
$email_name=$row->email_name;
$enc_type=$row->enc_type;
// PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/vendor/autoload.php';
$mail = new PHPMailer(true);
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
$mail->isSMTP();
$mail->SMTPAuth   = true;
$mail->Host       = $host;
$mail->Username   = $email;                     
$mail->Password   = $password;  
$mail->Port       = $port;
$mail->setFrom($email,$email_name);
$mail->addReplyTo($email,$email_name);                                 
$mail->SMTPSecure = $enc_type;         
$mail->isHTML(true); 
	
	
if(isset($_POST['pfromage'])){
	$userid=trim($_POST['user_id']);	
	$_SESSION['reg_user_id']=$_SESSION['matri_id_reg'];
	$pfromage=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['pfromage']);
	$ptoage=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['ptoage']);
	$pfronheight=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['pfronheight']);
	$ptoheight=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['ptoheight']);
	$pmstatus=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pmstatus']));
	$p_physical=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['p_physical']);
	if(isset($_POST['p_diet'])){
		$p_diet=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['p_diet']));
	}else{
		$p_diet="";
	}
	if(isset($_POST['p_smoke'])){
		$p_smoke=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['p_smoke']));
	}else{
		$p_smoke="";
	}
	if(isset($_POST['p_drink'])){
		$p_drink = mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['p_drink']));
	}else{
		$p_drink = "";
	}

	$preligion=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['preligion']));
	$pcaste=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pcaste']));
	$part_manglik=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['p_dosh']);
	$part_star=mysqli_real_escape_string($DatabaseCo->dbLink,implode(", ",$_POST['p_star']));
	$pmothertongue=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pmothertongue']));
	$pcountry=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pcountry']));
	if(isset($_POST['pstate'])){
		$pstate=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pstate']));
	}else{
		$pstate = "";
	}
	if(isset($_POST['pcity'])){
		$pcity=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pcity']));
	}else{
		$pcity = "";
	}
	$peducation=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['peducation']));
	$poccupation=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['poccupation']));
	if(isset($_POST['pannualincome'])){
		$pannualincome=mysqli_real_escape_string($DatabaseCo->dbLink,implode(",",$_POST['pannualincome']));
	}else

	{

		$pannualincome = "";

	}

	$p_expt=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['p_expt']);

	$part_expect_date= date('H:i:s Y-m-d ');

	$DatabaseCo->dbLink->query("update register set part_frm_age='".$pfromage."',part_to_age='".$ptoage."',part_height='".$pfronheight."',part_height_to='".$ptoheight."',looking_for='".$pmstatus."',part_physical='".$p_physical."',part_diet='".$p_diet."',part_drink='".$p_drink."',part_smoke='".$p_smoke."',part_religion='".$preligion."',part_caste='".$pcaste."',part_manglik='".$part_manglik."',part_star='".$part_star."',part_expect='".$p_expt."',part_expect_approve='Pending',part_expect_date='".$part_expect_date."',part_country_living='".$pcountry."',part_state='".$pstate."',part_city='".$pcity."',part_edu='".$peducation."',part_occu='".$poccupation."',part_mtongue='".$pmothertongue."',part_income='".$pannualincome."' where matri_id='".$_SESSION['matri_id_reg'] ."'");	

	$result3 = $DatabaseCo->dbLink->query("SELECT * FROM register,site_config where matri_id ='".$_SESSION['matri_id_reg'] ."'");
	$rowcc = mysqli_fetch_array($result3);
	$name = $rowcc['firstname'];
	$matriid = $rowcc['matri_id'];
	$cpass = $rowcc['cpassword'];
	$website = $rowcc['web_name'];
	$cpass = $rowcc['cpassword'];
	$webfriendlyname = $rowcc['web_frienly_name'];
	$from = $rowcc['from_email'];
	$to = $rowcc['email'];
	$email=$rowcc['email'];
	$name1 = $rowcc['username'];
	$logo = $rowcc['web_logo_path'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$logo_path=$website."/".$logo;
	$contact = $rowcc['contact_no'];
	$result45 = $DatabaseCo->dbLink->query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Registration'");
	$rowcs5 = mysqli_fetch_array($result45);
	$subject = $rowcs5['EMAIL_SUBJECT'];
	$message = $rowcs5['EMAIL_CONTENT'];
	$email_template = htmlspecialchars_decode($message,ENT_QUOTES);
	$trans = array("your site name" =>$webfriendlyname,"name"=>$name1,"web logo"=>$logo,"matriid"=>$matriid,"email_id"=>$to,"cpass"=>$cpass,"fb1"=>$fb,"li1"=>$li,"tw1"=>$tw,"gp1"=>$gp,"site domain name"=>$website,"my_email"=>$email);
	$email_template = strtr($email_template, $trans);
	$mail->Subject = $subject;
	$mail->addAddress($email);
	$mail->addBCC('port@inlogixinfoway.com');
	$mail->Body= $email_template;
	$mail->send();
}
$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");

?>

<div class="container" id="top1">

    <div class="row gt-margin-top-10">

        <div class="col-xxl-12 col-xxl-offset-2">

            <div class="row">

                <div class="col-xxl-14">

                   <h3 class="gt-text-green">Tell us about your hobbies.</h3>

                   <article><p>Tell us about your hobbies.So your life partner know and support in your future life</p></article>

                </div>

                <div class="col-xxl-2">

                   <img src="img/register-pref-img.png" class="img-responsive">

                </div>

            </div>

         </div>

     </div>

     <div class="gtRegister col-xxl-12 col-xxl-offset-2">

        <div class="row gt-margin-bottom-20">

           <img src="img/reg-step-3.png" class="img-responsive">

		</div>

        <form method="post" action="register-photo-upload" name="reg_form_3" id="reg_form_3">

            <div class="gt-margin-bottom-40">

          		<h3 class="gt-text-green">Enter your hobbies and interests.</h3>

                <article><p>Fill some below details to let us know about your hobbies to our member.</p></article>

            </div>

            <div class="form-group gt-margin-top-30">

            	<div class="row">

          			   <h4 class="gt-text-green">Hobbies</h4>

                    </div>

               <div class="row">

                   <label class="col-xxl-3" for="cooking">

                       <div class="pull-left gt-margin-right-18" >

                         <input type="checkbox" id="cooking" value="Cooking" name="hobby[]" data-validetta="">

                        </div>

                        <div class="pull-left">

                             Cooking

                         </div>

                            </label>

                            <label class="col-xxl-4" for="Nature">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Nature" value="Nature" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Nature

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Traveling">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Traveling" value="Traveling" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Traveling

                                </div>

                            </label> 

                            <label class="col-xxl-4" for="Dancing">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Dancing" value="Dancing" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Dancing

                                </div>

                            </label>

                        </div>

                 	</div>

                    <div class="form-group">

                        <div class="row">

                            <label class="col-xxl-3" for="Painting">

                            	<div class="pull-left gt-margin-right-18">

                                	<input type="checkbox" id="Painting" value="Painting" name="hobby[]" >

                                  

                                </div>

                                <div class="pull-left">

                                	Painting

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Pets">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Pets" value="Pets" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Pets

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Photography">

                            	<div class="pull-left gt-margin-right-18">

                                	<input type="checkbox" id="Photography" value="Photography" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Photography

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Music">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Music" value="Music" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Music

                                </div>

                            </label>

                        </div>

                 	</div>

                    <div class="form-group">

                        <div class="row">

                            <label class="col-xxl-3" for="Puzzles">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Puzzles" value="Puzzles" name="hobby[]" >

                                    

                                </div>

                                <div class="pull-left">

                                	Puzzles

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Gardning">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Gardning" value="Gardning" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Gardning

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Art ">

                            	<div class="pull-left gt-margin-right-18">

                                	<input type="checkbox" id="Art" value="Art" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Art 

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Movies">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Movies" value="Movies" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Movies

                                </div>

                            </label>

                        </div>

                 	</div>

                    <div class="form-group">

                        <div class="row">

                            <label class="col-xxl-3" for="Internet">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Internet" value="Internet" name="hobby[]" >

                                   

                                </div>

                                <div class="pull-left">

                                	Internet

                                </div>

                            </label>

                                             

                        </div>

                 	</div>

                    <div class="form-group">

                    <div class="row  gt-margin-top-30 gt-margin-bottom-30">

          			   <h4 class="gt-text-green">Your favourite music</h4>

                    </div>

                        <div class="row">

                            <label class="col-xxl-3" for="Film-Songs">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Film-Songs" value="Film Songs" name="hobby[]" >

                                    

                                </div>

                                <div class="pull-left">

                                	Film Songs

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Classical">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Classical" value="Classical" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Classical Music

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Western">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Western" value="Western" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Western Music

                                </div>

                            </label>

                       </div>

                 	</div>

                    <div class="form-group">

                    <div class="row  gt-margin-top-30 gt-margin-bottom-30">

          			   <h4 class="gt-text-green">Sports / Fitness you like</h4>

                    </div>

                        <div class="row">

                            <label class="col-xxl-3" for="Cricket">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Cricket" value="Cricket" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Cricket

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Carrom">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Carrom" value="Carrom" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Carrom

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Chess">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Chess" value="Chess" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Chess

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Jogging">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Jogging" value="Jogging" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Jogging

                                </div>

                            </label>

                        </div>

                        <div class="row">

                            <label class="col-xxl-3" for="Bedminton">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Bedminton" value="Bedminton" name="hobby[]" >

                                  

                                </div>

                                <div class="pull-left">

                                	Bedminton

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Swimming">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Swimming" value="Swimming" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Swimming

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Tennis">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Tennis" value="Tennis" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Tennis

                                </div>

                            </label>

                            <label class="col-xxl-4" for="Football">

                            	<div class="pull-left gt-margin-right-18" >

                                	<input type="checkbox" id="Football" value="Football" name="hobby[]" >

                                </div>

                                <div class="pull-left">

                                	Football

                                </div>

                            </label>

                        </div>

                 	</div>

                    <div class="form-group">

                        <div class="row">

                            <div class="col-xxl-3 col-xs-16 col-lg-3">

                                 <label class="gt-margin-top-10 font-14 gt-text-light-Grey">

                                     <b>Others</b>

                                 </label>

                            </div>

                            <div class="col-xxl-13 col-xs-16 col-lg-13">

                                 <input class="gt-form-control" type="text" name="hobby[]" > 	

                            </div>

                        </div>

                   </div>

                     

                	<div class="form-group">

                    	<div class="row gt-margin-top-30 gt-margin-bottom-30">

          			     <h4 class="gt-text-green">Spoken Languages</h4>

                         <p>Fill some below details to let us know about spoken languages.</p>

                       </div>

                        

                 	</div>

                                   

                    <div class="form-group">

                        <div class="row">

                            <div class="">

                                 <label class="gt-margin-top-10 gt-margin-bottom-10 font-14 gt-text-light-Grey">

                                     <b>Language Spoken</b>

                                 </label>

                            </div>

                            <select name="spoken_language[]" data-placeholder="Choose Language Spoken" class="chosen-select gt-form-control" multiple>

                           

                            <?php

                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {

                                ?>

                                <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"><?php echo $DatabaseCo->dbRow->mtongue_name; ?></option>

                            <?php } ?>

                        </select>

                            

                        </div>

                   </div>

                   <div class="form-group text-center">

                        <div class="row">

                            <input type="submit" name="reg2sub" value="Continue Step 3" class="btn gt-btn-orange gt-btn-xxl" >

                            <!--<a class="btn gt-btn-green gt-btn-xxl" id="skip3"> Skip Step 3</a>-->

                        </div>

                   </div>

                </form>

            </div> 

        </div>

        <script>

	window.location.hash = "top1";

</script>