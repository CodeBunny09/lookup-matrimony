<div class="container gt-margin-top-10">
	<?php include('level-3.php');?>
</div>

<!--- FOOTER --->
<footer class="footer-before-login gt-margin-top-25">
   <div class="container">
	  <div class="row">
		 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">
			<h5 class="gt-text-green">
				Help And Support
            </h5>
 			<ul class="">
				<li><a href="contactUs.php">Contact Us</a></li>
				<li><a href="cms?cms_id=13">FAQ</a></li>
				<li><a href="cms?cms_id=16">Refund policy</a></li>
			</ul>
		 </div>
		 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">
			<h5 class="gt-text-green">
				Terms & Policy
			</h5>
			<ul class="">
				<li><a href="cms?cms_id=7">Terms & Condition</a></li>
			 	<li><a href="cms?cms_id=6">Privacy Policy</a></li>
				<li><a href="cms?cms_id=15">Report Misuse</a></li>
			</ul>
		</div>
		 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">
			<h5 class="gt-text-green">
				Need Help?
			</h5>
			<ul class="">
            	<?php if (!isset($_SESSION['user_id'])) { ?>
            	<li><a href="login">Login</a></li>
 				<li><a href="index">Register</a></li>
                <?php } ?>
 				<li><a href="membershipplans"><i class="fa fa-star gt-text-orange"></i> Upgrade Membership</a></li>
			</ul>
		</div>
		 <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-16 col-md-8">
			<h5 class="gt-text-green">
				Information
			</h5>
			<ul class="">
				<li><a href="success-story">Success Story</a></li>
				<li><a href="cms?cms_id=8">About us</a></li>
			</ul>
		</div>
      </div>
      <div class="row">
		  <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-16">
			<h5 class="gt-text-green">About Us</h5>
            <p><?php echo $configObj->getConfigFshortDescription(); ?></p>
		  </div>
		  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-16 text-center">
				<h5 class="gt-text-green">
                    	Join us on social
                </h5>
				<?php
					$get_soc_icon=mysqli_fetch_object($DatabaseCo->dbLink->query("select facebook,twitter,linkedin,google,google_analytics_code from site_config where id='1'"));	
				?>
                <ul class="gt-footer-social">
                   <li><a href="<?php echo $get_soc_icon->facebook;?>" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
				   <li><a href="<?php echo $get_soc_icon->google;?>" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                   <li><a href="<?php echo $get_soc_icon->twitter;?>" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
				   <li><a href="<?php echo $get_soc_icon->linkedin;?>" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
 				</ul>
		  </div>
	   </div>   
   </div>
</footer>
<div class="container-fluid gt-footer-bottom">
  	<div class="row">
  		<div class="container text-center">
        	All Rights Reserved By @ <a href="<?php echo $configObj->getConfigName();?>"><?php echo $configObj->getConfigFooter();?></a>
        </div>
    </div>
</div>
<!--- FOOTER END--->

<!--
<script>
 document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
</script>
<script language=JavaScript>
var message="Function Disabled!";
function clickIE4(){
if (event.button==2){
return false;
}
}
function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
return false;
}
}
}
if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}
document.oncontextmenu=new Function("return false")
</script>
-->

<!---- ONLINE CHAT WIDGET--->
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#count').load('parts/online').fadeIn("slow");
}, 15000); // refresh every 10 second
</script>
<script src="js/jquery.min.js"></script>
<small class="pull-right">
  <?php
  $mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
  $select="select * from payments where pmatri_id='$mid'";
  $exe=mysqli_query($DatabaseCo->dbLink,$select) or die(mysqli_error($DatabaseCo->dbLink));
  $fetch=mysqli_fetch_array($exe);
  $exp_date=$fetch['exp_date'];
  $today= date('Y-m-d');
	if(isset($_SESSION['user_id']) && $_SERVER['PHP_SELF']!='/memprofile.php')
	{
?>
<link rel="stylesheet" type="text/css" href="who-is-online/widget.css" />
<script type="text/javascript" src="who-is-online/widget.js"></script>
<div class="onlineWidget">
	<div class="channel">
    <img class="preloader" src="who-is-online/img/preloader.gif" alt="Loading.." width="22" height="22" />
    </div>
	<div class="count" id="count"></div>
    <div class="label">online member</div>
    
    <div class="arrow"></div>
</div>
<?php
}
?>
</small>
<!---- ONLINE CHAT WIDGET END--->


<a href="feedback.php"  style="position: absolute;left: 0;top: 30%;z-index: 1;">
 <img src="img/feedback.png" style="height:100px;width:30px;position:fixed;top:200;left:0">
</a>


<script>
$(function(){
    $('#thanksMessage').on('show.bs.modal', function(){
        var myModal = $(this);
        clearTimeout(myModal.data('hideInterval'));
        myModal.data('hideInterval', setTimeout(function(){
            myModal.modal('hide');
        }, 2000));
    });
});
</script>
<!--- FEEDBACK MODAL END --->

<!--- GOOGLE ANALYTICS CODE --->
<?php 
$google = mysqli_fetch_object($DatabaseCo->dbLink->query("select google_analytics_code from site_config where id='1'"));
?>
<script>
var id = '<?php echo $google->google_analytics_code; ?>';
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', id, 'auto');
  ga('send', 'pageview');


</script>
<!--- GOOGLE ANALYTICS CODE END --->


 