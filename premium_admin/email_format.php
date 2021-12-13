<?php 
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$result3 = $DatabaseCo->dbLink->query("SELECT * FROM site_config");
	$rowcc = mysqli_fetch_array($result3);
	$website = $rowcc['web_name'];
	$webfriendlyname = $rowcc['web_frienly_name'];
	$logo = $rowcc['web_logo_path'];
	$fb = $rowcc['facebook'];
	$li= $rowcc['twitter'];
	$tw = $rowcc['linkedin'];
	$gp = $rowcc['google'];
	$contact = $rowcc['contact_no'];	
?>

<link href='https://fonts.googleapis.com/css?family=Courgette|Roboto:300,400,500' rel='stylesheet'>
 <body  style='margin: 0 auto;background: rgba(233,233,233,1.00);'>
	<div id='templateBody' style='border: 3px solid #e2e2e2;
    width: 70%;
    margin: 40px auto 40px auto;
    border-radius: 5px;background-color:white;'>
		<div id='gtheader' style='background: #fff;padding: 15px;'>
			<div id='gtLogo' style=''>
				<img src='<?php echo $website; ?>/img/<?php echo $logo; ?>' style='max-height: 70px;'>
			</div>	
		</div>
		<div id='gtstrip' style='background: #ea2626;padding: 10px;text-align:center;'>
				<h5 style='font-size: 32px;font-weight: 200; font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Email From Admin</h5>
		</div>
		<div id='gtBody' style='margin-top: 30px;margin-bottom: 5px;display: table;width: 100%;'>
		 	<div id='gtSub' style="padding-left: 15px;
    padding-right: 15px;">
		 		<h4 style='font-size: 18px;
    font-weight: 400;margin-bottom: 10px;
    margin-top: 0px;font-family: Roboto, sans-serif;'><?php echo $subject;?></h4>
		 	</div>
		 	<div id='gtMessage' style='padding-left: 15px;
    padding-right: 15px;font-size:13px;'>
		 		<article>
		 			<p style="font-family: Roboto, sans-serif;"><?php echo $message;?></p>
		 		</article>
			</div>
			<div id='gtThank' style='padding: 15px;'>
				<p style='font-family: Roboto, sans-serif;
    font-weight: 500;
    font-size: 14px;
    color: #565656;
    margin-top: 30px;
    margin-bottom: 5px;'>Thank You</p>
				<h5 style='font-family: Roboto, sans-serif;
    font-size: 18px;
    color: #ea2626;
    margin-top: 5px;
    font-weight: 500;'>Team <?php echo $webfriendlyname; ?></h5>
			</div>
		</div>
		<div id='gtFooter' style='padding: 15px;text-align: center;background: #efefef;'>
			<h5 style='font-family: Roboto, sans-serif;margin-top: 10px;
    margin-bottom: 5px;
    font-size: 18px;
    font-weight: 300;'>Join us on</h5>
    <div>
    	<a href='<?php echo $fb; ?>' style='margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='<?php echo $website; ?>/img/if_square-facebook_317727.png' style='width:38px;'></a>
    	<a href='<?php echo $tw; ?>' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='<?php echo $website; ?>/img/if_square-twitter_317723.png' style='width:38px;'></a>
    	<a href='<?php echo $li; ?>' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='<?php echo $website; ?>/img/if_square-linkedin_317725.png' style='width:38px;'></a>
    	<a href='<?php echo $gp; ?>' style='font-size: 44px;
    color: #707171;
    margin-left: 2px;
    margin-right: 2px;' target='_blank'><img src='<?php echo $website; ?>/img/if_square-google-plus_317726.png' style='width:38px;'></a>
    	</div>
		</div>
	 </div>
</body>      
       
     