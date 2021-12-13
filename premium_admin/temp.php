<?php 
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$subject='';
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
    width: 60%;
    margin: 40px auto 40px auto;
    border-radius: 5px;background-color:white;'>
		<div id='gtheader' style='background: #fff;padding: 15px;'>
			<div id='gtLogo' style=''>
				<img src='<?php echo $website; ?>/img/<?php echo $logo; ?>' style='max-height: 70px;'>
			</div>	
		</div>
		<div id='gtstrip' style='background: #ea2626;padding: 10px;text-align:center;'>
				<h5 style='font-size: 40px;font-weight: 200; font-family: Roboto, sans-serif;margin-top: 0px;margin-bottom: 0px;color: #fff;padding: 10px 15px 10px 15px;'>Matching Profiles</h5>
		</div>
		<div id='gtBody' style='margin-top: 30px;margin-bottom: 5px;display: table;width: 100%;'>
		 <?php
			 $result45 = $select=$DatabaseCo->dbLink->query('select * from register_view where index_id in '.$index_id_val);
             $i=0;
             while($pror= mysqli_fetch_array($result45)){
         ?>
			<div id='gtProfile' style='margin-bottom: 20px;'>
				<div id='gtProfilePic' style='display: table-cell;padding: 15px;'>
					<img src='<?php echo $website; ?>/my_photos/<?php echo $pror['photo1']; ?>' style='display: block;height: 150px;'>
				</div>
				<div id='gtProfileDetails' style='display: table-cell;vertical-align: top;padding: 15px;'>
					<h4 style='font-family: Roboto, sans-serif;font-size: 22px;
    font-weight: 400;
    margin-top: 0px;
    margin-bottom: 5px;'><?php echo $pror['username'];?></h4>
					<h5 style='font-family: Roboto, sans-serif;
    margin-top: 10px;
    font-weight: 400;
    font-size: 14px;
    margin-bottom: 15px;
    color: #383838;'>
                                                     <?php echo floor((time() - strtotime($pror['birthdate']))/31556926);?>years,
                                                     <?php  $ao=$pror['height'];$ft= (int) ($ao/12);
                                                            $inch = $ao % 12; echo $ft.'ft'. ' '.$inch.'in';?>,
                                                      <?php echo $pror['religion_name'];?>,
                                                      <?php echo $pror['caste_name'];?>,</br>
                                                      <?php echo $pror['ocp_name'];?>,
                                                      <?php echo $pror['city_name'];?> 
                     								  <?php  echo $pror['country_name']; ?></h5>
					
				<a href='<?php echo $website; ?>/member-profile?view_id=<?php  echo $pror['matri_id']; ?>' style='font-family: Roboto, sans-serif;
    padding: 10px 20px 10px 20px;
    font-size: 14px;
    background: rgb(234, 38, 38);
    display: inline-block;
    color: white;
    text-decoration: none;
    border-radius: 3px;
    margin-top: 10px;
    margin-bottom: 10px;'>View Profile</a>
			</div>
				
			</div>
			<?php
               $i++;
               if($i%2==0){
                  echo '</tr><tr>';
               }
             }
             ?>
			
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
       
     