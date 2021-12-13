<div class="collapse in gt-filter-result" id="collapseExample">
  <form name="frm_filter" id="frm_filter" method="post" action="" >
    <?php if(!isset($_SESSION['user_id'])){?>
    <div class="gt-panel gt-panel-default">
      <div class="gt-panel-head">
        <div class="row">
          <div class="col-xs-12">
            <b>Gender
            </b>
          </div>
        </div>
      </div>
     
      <div class="gt-panel-body">
        <div class="row">
          <div class="col-xs-16">
            <label for="filter-1">
              <input type="radio" id="filter-1" name="gender" value="Male" class="gt-cursor" 
                     <?php if($gender=='Male'){ echo "checked";}?>> 
              <span class="gt-margin-left-10 gt-cursor">Male
              </span>
            </label>
          </div>
          <div class="col-xs-16">
            <label for="filter-2">
              <input type="radio" id="filter-2" name="gender" value="Female" class="gt-cursor" 
                     <?php if($gender=='Female'){ echo "checked";}?>> 
              <span class="gt-margin-left-10 gt-cursor">Female
              </span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
    
    <div class="gt-panel gt-panel-default">
      <div class="gt-panel-head">
        <div class="row">
          <div class="col-xs-12">
            <b>Religion
            </b>
          </div>
          <div class="col-xs-4">
            <div class="row">
              <a onClick="return clearreligion();" class="gt-cursor">
                <i class="fa fa-times-circle">
                </i> Clear
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="gt-panel-body max-height-200">
        <div class="row">
          <?php 
			$religion=explode(",",$religion123);
			$SQL_STATEMENT_preligion =  $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
			while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_preligion)){
				if(isset($_POST['religion']) && $_POST['religion']!='null'){
					$rel=$_POST['religion'];
					$_SESSION['religion']=$rel;  
				}
				elseif((isset($_POST['religion']) && $_POST['religion']=='null') || !isset($_SESSION['religion'])){
					$rel='';  
					$_SESSION['religion']=$rel;
				}else{
					$rel=$_SESSION['religion']; 
				}
				if(isset($_POST['caste']) && $_POST['caste']!='null'){
					$caste=$_POST['caste'];
					$_SESSION['caste']=$caste;  
				}elseif((isset($_POST['caste']) && $_POST['caste']=='null') || !isset($_SESSION['caste'])){
					$caste='';  
					$_SESSION['caste']=$caste;
				}else{
					$caste=$_SESSION['caste']; 
				}
				if(isset($_POST['occupation']) && $_POST['occupation']!='null'){
					$occ=$_POST['occupation'];
					$_SESSION['occupation']=$occ;  
				}elseif((isset($_POST['occupation']) && $_POST['occupation']=='null') ){
					$occ='';  
					$_SESSION['occupation']=$occ;
				}else{
					$occ=$occupation; 	
				}
				if(isset($_POST['gender']) && $_POST['gender']!=''){
					$gender=$_POST['gender'];
					$_SESSION['gender']=$gender;  
				}elseif(isset($_SESSION['gender123']) && $_SESSION['gender123']!=''){
					if($_SESSION['gender123']=='Male'){
						$gender='Female';
					}else{
						$gender='Male';
					}
				}else{
					$gender=$_SESSION['gender']; 
				}
				if(isset($_POST['t3']) && $_POST['t3']!='null'){
					$t3=$_POST['t3'];
					$_SESSION['fromage']=$t3;  
				}elseif((isset($_POST['t3']) && $_POST['t3']=='null') || !isset($_SESSION['fromage'])){
					$t3='';  
					$_SESSION['fromage']=$t3;
				}else{
					$t3=$_SESSION['fromage']; 
				}
				if(isset($_POST['t4']) && $_POST['t4']!='null')
{
$t4=$_POST['t4'];
$_SESSION['toage']=$t4;  
}
elseif((isset($_POST['t4']) && $_POST['t4']=='null') || !isset($_SESSION['toage']))
{
$t4='';  
$_SESSION['toage']=$t4;
}  
else
{
$t4=$_SESSION['toage']; 
}
if(isset($_POST['country']) && $_POST['country']!='null')
{
$con=$_POST['country'];
$_SESSION['country']=$con;  
}
elseif((isset($_POST['country']) && $_POST['country']=='null'))
{
$con='';  
$_SESSION['country']=$con;
}
else
{
$con=$country123; 
}
if(isset($_POST['state']) && $_POST['state']!='null')
{
$state=$_POST['state'];
$_SESSION['state']=$state;  
}   
elseif((isset($_POST['state']) && $_POST['state']=='null'))
{
$state='';  
$_SESSION['state']=$state;
} 
else
{
$state=$state123; 
}   
if(isset($_POST['city']) && $_POST['city']!='null')
{
$city=$_POST['city'];
$_SESSION['city']=$city;  
}
elseif((isset($_POST['city']) && $_POST['city']=='null'))
{
$city='';  
$_SESSION['city']=$city;
} 
else
{
$city=$city123; 
}   	
if(isset($_POST['m_status']) && $_POST['m_status']!='null')
{
$m_status=str_replace(",","','",$_POST['m_status']);
$_SESSION['m_status']=$m_status;
}
else if(isset($_POST['m_status']) && $_POST['m_status']=='null')
{
$m_status='';  
$_SESSION['m_status']=$m_status;
}
else
{
$m_status=$mstatus123;  
}
if(isset($_POST['physical_status']) && $_POST['physical_status']!='null')
{
$physical_status=str_replace(",","','",$_POST['physical_status']);
$_SESSION['physical_status']=$physical_status;
}
else if(isset($_POST['physical_status']) && $_POST['physical_status']=='null')
{
$physical_status='';  
$_SESSION['physical_status']=$physical_status;
}
else
{
$physical_status=$physical_status;  
}
if(isset($_POST['m_tongue']) && $_POST['m_tongue']!='null')
{
$m_tongue=$_POST['m_tongue'];
$_SESSION['m_tongue']=$m_tongue; 
}
elseif((isset($_POST['m_tongue']) && $_POST['m_tongue']=='null') || !isset($_SESSION['m_tongue']))
{
$m_tongue='';  
$_SESSION['m_tongue']=$m_tongue;
}
else
{
$m_tongue=$_SESSION['m_tongue']; 
}
if(isset($_POST['education']) && $_POST['education']!='null')
{
$education=$_POST['education'];
$_SESSION['education']=$education;
}
elseif((isset($_POST['education']) && $_POST['education']=='null'))
{
$education='';  
$_SESSION['education']=$education;
}
else
{
$education=$education123;	   
}
if(isset($_POST['fromheight']) && $_POST['fromheight']!='null')
{
$fromheight=$_POST['fromheight'];
$_SESSION['fromheight']=$fromheight;  
}
elseif((isset($_POST['fromheight']) && $_POST['fromheight']=='null'))
{
$fromheight='';  
$_SESSION['fromheight']=$fromheight;
}   
else
{
$fromheight=$fromheight; 
}
if(isset($_POST['toheight']) && $_POST['toheight']!='null')
{
$toheight=$_POST['toheight'];
$_SESSION['toheight']=$toheight;  
}
elseif((isset($_POST['toheight']) && $_POST['toheight']=='null'))
{
$toheight='';  
$_SESSION['toheight']=$toheight;
} 
else
{
$toheight=$toheight; 
}
if(isset($_POST['photo_search']) && $_POST['photo_search']!='null')
{
$photo=$_POST['photo_search'];
$_SESSION['photo_search']=$photo;
}
elseif((isset($_POST['photo_search']) && $_POST['photo_search']=='null'))
{
$photo='';  
$_SESSION['photo_search']=$photo;
}
else
{
$photo=$photo_search;   
} 
if(isset($_POST['profile_latest_register']) && $_POST['profile_latest_register']!='null')
{
$profile_latest_register=$_POST['profile_latest_register'];
$_SESSION['profile_latest_register']=$profile_latest_register;
}
elseif((isset($_POST['profile_latest_register']) && $_POST['profile_latest_register']=='null'))
{
$profile_latest_register='';  
$_SESSION['profile_latest_register']=$profile_latest_register;
}
else
{
$profile_latest_register=$profile_latest_register;   
} 
if(isset($_POST['keyword']) && $_POST['keyword']!='null')
{
$keyword=$_POST['keyword'];
$_SESSION['keyword']=$keyword;
}
elseif((isset($_POST['keyword']) && $_POST['keyword']=='null'))
{
$keyword='';  
$_SESSION['keyword']=$keyword;
}
else
{
$keyword=$keyword;	   
}  
if(isset($_POST['tot_children']) && $_POST['tot_children']!='null'){
$tot_children=$_POST['tot_children'];
$_SESSION['tot_children']=$tot_children;  
}
elseif((isset($_POST['tot_children']) && $_POST['tot_children']=='null'))
{
$tot_children='';  
$_SESSION['tot_children']=$tot_children;
}
else
{
$tot_children=$tot_children;    
}
if(isset($_POST['occupation']) && $_POST['occupation']!='null'){
$occupation=$_POST['occupation'];
$_SESSION['occupation']=$occupation;
}
elseif((isset($_POST['occupation']) && $_POST['occupation']=='null'))
{
$occupation='';  
$_SESSION['occupation']=$occupation;
}
else
{
$occupation=$occupation;   
}
if(isset($_POST['annual_income']) && $_POST['annual_income']!='null'){
$annual_income=$_POST['annual_income'];
$_SESSION['annual_income']=$annual_income;
}
elseif((isset($_POST['annual_income']) && $_POST['annual_income']=='null'))
{
$annual_income='';  
$_SESSION['annual_income']=$annual_income;
}
else
{
$annual_income=$annual_income;  
}
if(isset($_POST['diet']) && $_POST['diet']!='null'){
$diet=str_replace(",","','",$_POST['diet']);
$_SESSION['diet']=$diet;   
}
elseif((isset($_POST['diet']) && $_POST['diet']=='null'))
{
$diet='';  
$_SESSION['diet']=$diet;
}
else
{
$diet=$diet; 
}
if(isset($_POST['drink']) && $_POST['drink']!='null'){
$drink=str_replace(",","','",$_POST['drink']);
$_SESSION['drink']=$drink; 	
}
elseif((isset($_POST['drink']) && $_POST['drink']=='null'))
{
$drink='';  
$_SESSION['drink']=$drink;
}
else
{
$drink=$drink;	  
}
if(isset($_POST['smoking']) && $_POST['smoking']!='null'){
$smoking=str_replace(",","','",$_POST['smoking']);
$_SESSION['smoking']=$smoking; 
}
elseif((isset($_POST['smoking']) && $_POST['smoking']=='null'))
{
$smoking='';  
$_SESSION['smoking']=$smoking;
}
else
{
$smoking=$smoking;	  
}
if(isset($_POST['complexion']) && $_POST['complexion']!='null'){
$complexion=str_replace(",","','",$_POST['complexion']);
$_SESSION['complexion']=$complexion;   
}
elseif((isset($_POST['complexion']) && $_POST['complexion']=='null'))
{
$complexion='';  
$_SESSION['complexion']=$complexion;
}
else
{
$complexion=$complexion;   	 
}
if(isset($_POST['bodytype']) && $_POST['bodytype']!='null'){
$bodytype=str_replace(",","','",$_POST['bodytype']);
$_SESSION['bodytype']=$bodytype; 
}
elseif((isset($_POST['bodytype']) && $_POST['bodytype']=='null'))
{
$bodytype='';  
$_SESSION['bodytype']=$bodytype;
}
else
{
$bodytype=$bodytype;   
}
if(isset($_POST['star']) && $_POST['star']!='null'){
$star=str_replace(",","','",$_POST['star']);
$_SESSION['star']=$star;   
}
elseif((isset($_POST['star']) && $_POST['star']=='null'))
{
$star='';  
$_SESSION['star']=$star;
}
else
{
$star=$star;    
}
if(isset($_POST['manglik']) && $_POST['manglik']!='null'){
$manglik=$_POST['manglik'];
$_SESSION['manglik']=$manglik;     	
}
elseif((isset($_POST['manglik']) && $_POST['manglik']=='null'))
{
$manglik='';  
$_SESSION['manglik']=$manglik;
}
else
{
$manglik=isset($_SESSION['manglik'])?$_SESSION['manglik']:"";  
}
if(isset($_POST['id_search']) && $_POST['id_search']!='null'){
$id_search=$_POST['id_search'];
$_SESSION['id_search']=$id_search;
}
elseif((isset($_POST['id_search']) && $_POST['id_search']=='null'))
{
$id_search='';  
$_SESSION['id_search']=$id_search;
}
else
{
$id_search=$txt_id_search;   	    
}
if($t3!='' && $t4!='')
{
$a="AND ((
(
date_format( now( ) , '%Y' ) - date_format( birthdate, '%Y' )
) - ( date_format( now( ) , '00-%m-%d' ) < date_format( birthdate, '00-%m-%d' ) )
)
BETWEEN '$t3'
AND '$t4')";	
}		
else
{
$a='';	
}
if($gender!='')
{
$b="and gender='$gender'";	
}
else
{
$b='';	
}
if($rel!='')
{
$c= "and religion IN ($rel)";				
}
else
{
$c='';	
}
if($caste!='')
{
$d="and caste IN ($caste)";
}
else
{
$d='';	
}
if($m_tongue!='')
{
$e="and m_tongue IN ($m_tongue)";
}	
else
{
$e='';	
}
if($education!='')
{
$f="and edu_detail IN ($education)";
}
else
{
$f='';	
}
if($occ!='')
{
$g="and occupation IN ($occ)";
}
else
{
$g='';	
}
if($m_status!='Any' && $m_status!='')
{
$h= "and m_status IN ('$m_status')";				
}
else
{
$h='';	
}
if($con!='')
{
$i="and country_id IN ($con)";
}
else
{
$i='';	
}
if($state!='')
{
$j="and state_id IN ($state)";
}
else
{
$j='';	
}
if($city!='')

{
$k="and city IN ($city)";
}
else
{
$k='';	
}
if($fromheight!='' and $toheight!='')
{
$l="and height between '$fromheight' and '$toheight'";	
}
else
{
$l='';	
}
if($keyword!='')
{
$m="and ((email like '%$keyword%') OR (matri_id = '$keyword') OR (firstname like '%$keyword%') OR (lastname like '%$keyword%'))";
}
else
{
$m='';	
}
if($photo=='Yes')
{
$n=" and photo1!='' and photo1_approve='APPROVED' ";	
}
elseif($photo=='horoscope')
{
$n=" and horoscope!='' and hor_check='APPROVED' ";	
}
else
{
$n='';	
}
if($tot_children!='')
{
$q="and tot_children='$tot_children'";	
}
else
{
$q='';	
}
if($annual_income!='')
{
$s="and income='$annual_income'";
}
else
{
$s='';	
}
if($diet!='')
{
$t="and diet IN ('$diet')";
}
else
{
$t='';	
}
if($drink!='')
{
$u="and drink IN ('$drink')";
}
else
{
$u='';	
}
if($smoking!='')
{
$v="and smoke IN ('$smoking')";
}
else
{
$v='';	
}
if($complexion!='')
{
$x="and complexion IN ('$complexion')";
}
else
{
$x='';	
}
if($bodytype!='')
{
$y="and bodytype IN ('$bodytype')";
}
else
{
$y='';	
}
if($star!='')
{
$z="and star IN ('$star')";
}
else
{
$z='';	
}
if($manglik!='')
{
$a1="and manglik='$manglik'";
}
else
{
$a1='';	
}
if($id_search!='')
{
$r="and matri_id='$id_search'";	
}
else
{
$r='';	
}
if($profile_latest_register=='1')
{
$d123=1;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123." day");
$exp_date=date('Y-m-d h:i:s', $date);
$aa="and reg_date>'".$exp_date."'";		
}
elseif($profile_latest_register=='2')
{
$d123=3;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123." day");
$exp_date=date('Y-m-d h:i:s', $date);
$aa="and reg_date >'".$exp_date."'";	
}
elseif($profile_latest_register=='3')
{
$d123=7;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123." day");
$exp_date=date('Y-m-d h:i:s', $date);
$aa="and reg_date>'".$exp_date."'";	
}
elseif($profile_latest_register=='4')
{
$d123=30;
$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . - $d123." day");
$exp_date=date('Y-m-d h:i:s', $date);
$aa="and reg_date>'".$exp_date."'";		
}
else
{
$aa='';	
}
if($physical_status!='')
{
$ab="and physicalStatus IN ('$physical_status')";
}
else
{
$ab="";
}
$get_mem=mysqli_num_rows($DatabaseCo->dbLink->query("select matri_id from register_view where religion='".$DatabaseCo->dbRow->religion_id."' and status!='Suspended' and status!='Inactive' $a $b $c $d $e $f $g $h $i $j $k $l $m $n $q $s $t $u $v $x $y $z $aa $ab $a1 $r"));
?>
          <div class="gt-filter-border col-xs-16">
            <div class="row">
              <label for="filter-9<?php echo $DatabaseCo->dbRow->religion_id;?>" class="col-xs-16">
                <div class="row">
                  <span class="col-xs-3">
                    <input type="checkbox" id="filter-9<?php echo $DatabaseCo->dbRow->religion_id;?>" name="religion" value="<?php echo $DatabaseCo->dbRow->religion_id; ?>" class="gt-cursor pull-left gt-margin-right-10" 
                           <?php if(in_array($DatabaseCo->dbRow->religion_id,$religion)){ echo "checked";} ?>>
                  </span>
                  <span class="gt-cursor col-xs-10">
                    <?php echo $DatabaseCo->dbRow->religion_name; ?>
                  </span>
                  <span class="col-xs-3">
                  <span class="badge">
                    <?php echo $get_mem;?>                                        
                  </span>
                  </span>
                </div>
              </label>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
    <div class="gt-panel gt-panel-default" id="getcaste">
      <div class="gt-panel-head">
        <div class="row">
          <div class="col-xs-12">
            <b>Caste
            </b>
          </div>
          <div class="col-xs-4">
            <div class="row">
              <a onClick="return clearcaste();" class="gt-cursor">
                <i class="fa fa-times-circle">
                </i> Clear
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="gt-panel-body max-height-200" id="left-panel-5">
        <div class="row" id="users_caste">
          <div class="col-xs-16">
            <input class="search form-control" placeholder="Search" />
          </div>
          <div class="list">
            <?php
$caste=explode(',',$caste123);
foreach ($religion as $rel)
{
?>
            <div class="col-xs-16 ">
              <h5 class="text-center gt-margin-top-0px gt-margin-bottom-0px gt-font-weight-700">
                <?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?> 
              </h5>
            </div>
            <div class="clearfix">
            </div>
            <?php 
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE religion_id ='$rel' ORDER BY caste_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
$get_mem=mysqli_num_rows($DatabaseCo->dbLink->query("select matri_id from register_view where caste='".$DatabaseCo->dbRow->caste_id."' and status!='Suspended' and status!='Inactive'"));
?>
            <div class="col-xs-16 gt-filter-border">
              <div class="row">
                <label for="filter-14<?php echo $DatabaseCo->dbRow->caste_id;?>" class="col-xs-16">
                  <div class="row">	
                    <span class="col-xs-3">
                      <input type="checkbox" id="filter-14<?php echo $DatabaseCo->dbRow->caste_id;?>" name="caste_id" value="<?php echo $DatabaseCo->dbRow->caste_id ?>" class="gt-cursor" 
                             <?php if(in_array($DatabaseCo->dbRow->caste_id,$caste)){ echo "checked";} ?>>
                    </span>
                    <span class="gt-cursor name col-xs-10">
                      <?php echo $DatabaseCo->dbRow->caste_name ?>
                    </span>
                    <span class="badge col-xxl-3">
                      <?php echo $get_mem;?>                                        
                    </span>
                  </div>
                </label>
              </div>
            </div>
            <?php } }?>
          </div>
        </div>
      </div>
    </div>
    <div class="gt-panel gt-panel-default">
      <div class="gt-panel-head">
        <div class="row">
          <div class="col-xs-12">
            <b>Latest Register Profile
            </b>
          </div>
          <div class="col-xs-4">
            <div class="row">
              <a onClick="return clearprofilelatestreg();" class="gt-cursor">
                <i class="fa fa-times-circle">
                </i> Clear
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="gt-panel-body">
        <div class="row">
          <div class="col-xs-16 gt-padding-top-5">
            <label for="f-1">
              <input type="radio" name="profile_latest_register" id="f-1" value="1" 
                     <?php if($profile_latest_register=='1'){ echo "checked";} ?>> 
              <span class="gt-margin-left-10 gt-cursor">Today Register Profile
              </span>
            </label>
          </div>
          <div class="col-xs-16 gt-padding-top-5">
            <label for="f-2">
              <input type="radio" name="profile_latest_register" id="f-2"  value="2" 
                     <?php if($profile_latest_register=='2'){ echo "checked";} ?>> 
              <span class="gt-margin-left-10 gt-cursor">Last Three Days Register Profile
              </span>
            </label>
          </div>
          <div class="col-xs-16 gt-padding-top-5">
            <label for="f-3">
              <input type="radio" name="profile_latest_register" id="f-3"  value="3" 
                     <?php if($profile_latest_register=='3'){ echo "checked";} ?>> 
              <span class="gt-margin-left-10 gt-cursor">Last Week Register Profile
              </span>
            </label>
          </div>
          <div class="col-xs-16  gt-padding-top-5">
            <label for="f-4">
              <input type="radio" name="profile_latest_register" id="f-4"  value="4" 
                     <?php if($profile_latest_register=='4'){ echo "checked";} ?>> 
              <span class="gt-margin-left-10 gt-cursor">Last Month Register Profile
              </span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="gt-panel gt-panel-default">
      <div class="gt-panel-head">
        <div class="row">
          <div class="col-xs-12">
            <b>Profile Type
            </b>
          </div>
          <div class="col-xs-4">
            <div class="row">
              <a onClick="return clearphoto();" class="gt-cursor">
                <i class="fa fa-times-circle">
                </i> Clear
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="gt-panel-body">
        <div class="row">
          <div class="col-xs-16">
            <label for="f-1">
              <input type="radio" name="photo_search" id="f-1" value="Yes" 
                     <?php if($photo_search=='Yes'){ echo "checked";} ?>> 
              <span class="gt-margin-left-10 gt-cursor">With Photo
              </span>
            </label>
          </div>
          <div class="col-xs-16">
            <label for="f-3">
              <input type="radio" name="photo_search" id="f-3" value="horoscope" 
                     <?php if($photo_search=='horoscope'){ echo "checked";} ?>> 
              <span class="gt-margin-left-10 gt-cursor">Profile With Horoscope
              </span>
            </label>
          </div>
          <div class="col-xs-16">
            <label for="f-2">
              <input type="radio" name="photo_search" id="f-2"  value="" 
                     <?php if($photo_search==''){ echo "checked";} ?>> 
              <span class="gt-margin-left-10 gt-cursor">Does not matter
              </span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="gt-panel gt-panel-default">
      <div class="gt-panel-head">
        <div class="row">
          <div class="col-xs-12">
            <b>Marital Status
            </b>
          </div>
          <div class="col-xs-4">
            <div class="row">
              <a onClick="return clearmstatus();" class="gt-cursor">
                <i class="fa fa-times-circle">
                </i> Clear
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="gt-panel-body">
        <?php 
$mstatus=explode(",",$mstatus123);
?>  
        <div class="row">
          <div class="col-xs-16">
            <label for="filter-5">
              <input type="checkbox" id="filter-5" name="m_status" value="Never Married" 
                     <?php if(in_array("Never Married",$mstatus)){ echo "checked";} ?> class="gt-cursor"> 
              <span class="gt-margin-left-10 gt-cursor">Never Married
              </span>
            </label>
          </div>
          <?php if($my_gender=='Male'){ ?>
         <div class="col-xs-16">
            <label for="filter-6">
              <input type="checkbox" id="filter-6" name="m_status" value="Widow" 
                     <?php if(in_array("Widow",$mstatus)){ echo "checked";} ?> class="gt-cursor"> 
              <span class="gt-margin-left-10 gt-cursor">Widow
              </span>
            </label>
          </div>
          <?php } else{ ?>
           <div class="col-xs-16">
            <label for="filter-6">
              <input type="checkbox" id="filter-6" name="m_status" value="Widower" 
                     <?php if(in_array("Widower",$mstatus)){ echo "checked";} ?> class="gt-cursor"> 
              <span class="gt-margin-left-10 gt-cursor">Widower
              </span>
            </label>
          </div>
          <?php } ?>
          <div class="col-xs-16">
            <label for="filter-7">
              <input type="checkbox" id="filter-7" name="m_status" value="Divorced" 
                     <?php if(in_array("Divorced",$mstatus)){ echo "checked";} ?> class="gt-cursor"> 
              <span class="gt-margin-left-10 gt-cursor">Divorced
              </span>
            </label>
          </div>
          <div class="col-xs-16">
            <label for="filter-8">
              <input type="checkbox" id="filter-8" name="m_status" value="Awaiting Divorce" 
                     <?php if(in_array("Awaiting Divorce",$mstatus)){ echo "checked";} ?> class="gt-cursor"> 
              <span class="gt-margin-left-10 gt-cursor">Awaiting Divorce
              </span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="gt-panel gt-panel-default">
      <div class="gt-panel-head">
        <div class="row">
          <div class="col-xs-12">
            <b>Age
            </b>
          </div>
          <div class="col-xs-4">
            <div class="row">
              <a onClick="return clearage();" class="gt-cursor">
                <i class="fa fa-times-circle">
                </i> Clear
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="gt-panel-body">
        <div class="row">
          <div class="col-xs-6">
            <select class="form-control" name="from_age" id="from_age">
              <option value="null">From
              </option>
              <option value="18" 
                      <?php if($t3=='18'){ echo "selected";}?>>18 Years
              </option>
            <option value="19" 
                    <?php if($t3=='19'){ echo "selected";}?>>19 Years
            </option>
          <option value="20" 
                  <?php if($t3=='20'){ echo "selected";}?>>20 Years
          </option>
        <option value="21" 
                <?php if($t3=='21'){ echo "selected";}?>>21 Years
        </option>
      <option value="22" 
              <?php if($t3=='22'){ echo "selected";}?>>22 Years
      </option>
    <option value="23" 
            <?php if($t3=='23'){ echo "selected";}?>>23 Years
    </option>
  <option value="24" 
          <?php if($t3=='24'){ echo "selected";}?>>24 Years
  </option>
<option value="25" 
        <?php if($t3=='25'){ echo "selected";}?>>25 Years
</option>
<option value="26" 
        <?php if($t3=='26'){ echo "selected";}?>>26 Years
</option>
<option value="27" 
        <?php if($t3=='27'){ echo "selected";}?>>27 Years
</option>
<option value="28" 
        <?php if($t3=='28'){ echo "selected";}?>>28 Years
</option>
<option value="29" 
        <?php if($t3=='29'){ echo "selected";}?>>29 Years
</option>
<option value="30" 
        <?php if($t3=='30'){ echo "selected";}?>>30 Years
</option>
<option value="31" 
        <?php if($t3=='31'){ echo "selected";}?>>31 Years
</option>
<option value="32" 
        <?php if($t3=='32'){ echo "selected";}?>>32 Years
</option>
<option value="33" 
        <?php if($t3=='33'){ echo "selected";}?>>33 Years
</option>
<option value="34" 
        <?php if($t3=='34'){ echo "selected";}?>>34 Years
</option>
<option value="35" 
        <?php if($t3=='35'){ echo "selected";}?>>35 Years
</option>
<option value="36" 
        <?php if($t3=='36'){ echo "selected";}?>>36 Years
</option>
<option value="37" 
        <?php if($t3=='37'){ echo "selected";}?>>37 Years
</option>
<option value="38" 
        <?php if($t3=='38'){ echo "selected";}?>>38 Years
</option>
<option value="39" 
        <?php if($t3=='39'){ echo "selected";}?>>39 Years
</option>
<option value="40" 
        <?php if($t3=='40'){ echo "selected";}?>>40 Years
</option>
<option value="41" 
        <?php if($t3=='41'){ echo "selected";}?>>41 Years
</option>
<option value="42" 
        <?php if($t3=='42'){ echo "selected";}?>>42 Years
</option>
<option value="43" 
        <?php if($t3=='43'){ echo "selected";}?>>43 Years
</option>
<option value="44" 
        <?php if($t3=='44'){ echo "selected";}?>>44 Years
</option>
<option value="45" 
        <?php if($t3=='45'){ echo "selected";}?>>45 Years
</option>
<option value="46" 
        <?php if($t3=='46'){ echo "selected";}?>>46 Years
</option>
<option value="47" 
        <?php if($t3=='47'){ echo "selected";}?>>47 Years
</option>
<option value="48" 
        <?php if($t3=='48'){ echo "selected";}?>>48 Years
</option>
<option value="49" 
        <?php if($t3=='49'){ echo "selected";}?>>49 Years
</option>
<option value="50" 
        <?php if($t3=='50'){ echo "selected";}?>>50 Years
</option>
<option value="51" 
        <?php if($t3=='51'){ echo "selected";}?>>51 Years
</option>
<option value="52" 
        <?php if($t3=='52'){ echo "selected";}?>>52 Years
</option>
<option value="53" 
        <?php if($t3=='53'){ echo "selected";}?>>53 Years
</option>
<option value="54" 
        <?php if($t3=='54'){ echo "selected";}?>>54 Years
</option>
<option value="55" 
        <?php if($t3=='55'){ echo "selected";}?>>55 Years
</option>
<option value="56" 
        <?php if($t3=='56'){ echo "selected";}?>>56 Years
</option>
<option value="57" 
        <?php if($t3=='57'){ echo "selected";}?>>57 Years
</option>
<option value="58" 
        <?php if($t3=='58'){ echo "selected";}?>>58 Years
</option>
<option value="59" 
        <?php if($t3=='59'){ echo "selected";}?>>59 Years
</option>
</select>
</div>
<div class="col-xs-4 gt-margin-top-10 text-center">
  TO
</div>
<div class="col-xs-6">
  <select class="form-control" name="to_age" id="to_age">
    <option value="null" >To
    </option>     
    <option value="18" 
            <?php if($t4=='18'){ echo "selected";}?>>18 Years
    </option>
  <option value="19" 
          <?php if($t4=='19'){ echo "selected";}?>>19 Years
  </option>
<option value="20" 
        <?php if($t4=='20'){ echo "selected";}?>>20 Years
</option>
<option value="21" 
        <?php if($t4=='21'){ echo "selected";}?>>21 Years
</option>
<option value="22" 
        <?php if($t4=='22'){ echo "selected";}?>>22 Years
</option>
<option value="23" 
        <?php if($t4=='23'){ echo "selected";}?>>23 Years
</option>
<option value="24" 
        <?php if($t4=='24'){ echo "selected";}?>>24 Years
</option>
<option value="25" 
        <?php if($t4=='25'){ echo "selected";}?>>25 Years
</option>
<option value="26" 
        <?php if($t4=='26'){ echo "selected";}?>>26 Years
</option>
<option value="27" 
        <?php if($t4=='27'){ echo "selected";}?>>27 Years
</option>
<option value="28" 
        <?php if($t4=='28'){ echo "selected";}?>>28 Years
</option>
<option value="29" 
        <?php if($t4=='29'){ echo "selected";}?>>29 Years
</option>
<option value="30" 
        <?php if($t4=='30'){ echo "selected";}?>>30 Years
</option>
<option value="31" 
        <?php if($t4=='31'){ echo "selected";}?>>31 Years
</option>
<option value="32" 
        <?php if($t4=='32'){ echo "selected";}?>>32 Years
</option>
<option value="33" 
        <?php if($t4=='33'){ echo "selected";}?>>33 Years
</option>
<option value="34" 
        <?php if($t4=='34'){ echo "selected";}?>>34 Years
</option>
<option value="35" 
        <?php if($t4=='35'){ echo "selected";}?>>35 Years
</option>
<option value="36" 
        <?php if($t4=='36'){ echo "selected";}?>>36 Years
</option>
<option value="37" 
        <?php if($t4=='37'){ echo "selected";}?>>37 Years
</option>
<option value="38" 
        <?php if($t4=='38'){ echo "selected";}?>>38 Years
</option>
<option value="39" 
        <?php if($t4=='39'){ echo "selected";}?>>39 Years
</option>
<option value="40" 
        <?php if($t4=='40'){ echo "selected";}?>>40 Years
</option>
<option value="41" 
        <?php if($t4=='41'){ echo "selected";}?>>41 Years
</option>
<option value="42" 
        <?php if($t4=='42'){ echo "selected";}?>>42 Years
</option>
<option value="43" 
        <?php if($t4=='43'){ echo "selected";}?>>43 Years
</option>
<option value="44" 
        <?php if($t4=='44'){ echo "selected";}?>>44 Years
</option>
<option value="45" 
        <?php if($t4=='45'){ echo "selected";}?>>45 Years
</option>
<option value="46" 
        <?php if($t4=='46'){ echo "selected";}?>>46 Years
</option>
<option value="47" 
        <?php if($t4=='47'){ echo "selected";}?>>47 Years
</option>
<option value="48" 
        <?php if($t4=='48'){ echo "selected";}?>>48 Years
</option>
<option value="49" 
        <?php if($t4=='49'){ echo "selected";}?>>49 Years
</option>
<option value="50" 
        <?php if($t4=='50'){ echo "selected";}?>>50 Years
</option>
<option value="51" 
        <?php if($t4=='51'){ echo "selected";}?>>51 Years
</option>
<option value="52" 
        <?php if($t4=='52'){ echo "selected";}?>>52 Years
</option>
<option value="53" 
        <?php if($t4=='53'){ echo "selected";}?>>53 Years
</option>
<option value="54" 
        <?php if($t4=='54'){ echo "selected";}?>>54 Years
</option>
<option value="55" 
        <?php if($t4=='55'){ echo "selected";}?>>55 Years
</option>
<option value="56" 
        <?php if($t4=='56'){ echo "selected";}?>>56 Years
</option>
<option value="57" 
        <?php if($t4=='57'){ echo "selected";}?>>57 Years
</option>
<option value="58" 
        <?php if($t4=='58'){ echo "selected";}?>>58 Years
</option>
<option value="59" 
        <?php if($t4=='59'){ echo "selected";}?>>59 Years
</option>
<option value="60" 
        <?php if($t4=='60'){ echo "selected";}?>>60 Years
</option>
</select>
</div>
</div>
</div>
</div>
	<div class="gt-panel gt-panel-default">
  <div class="gt-panel-head">
    <div class="row">
      <div class="col-xs-12">
        <b>Height
        </b>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <a onClick="return clearheight();" class="gt-cursor">
            <i class="fa fa-times-circle">
            </i> Clear
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="gt-panel-body">
    <div class="row">
      <div class="col-xs-6">
        <select class="form-control" name="from_height" id="from_height">
          <option value="null">From
          </option>
          <option value="48" 
                  <?php if($fromheight=='48'){ echo "selected";}?>>Below 4ft
          </option>
        <option value="54" 
                <?php if($fromheight=='54'){ echo "selected";}?>>4ft 06in
        </option>
      <option value="55" 
              <?php if($fromheight=='55'){ echo "selected";}?>>4ft 07in
      </option>
    <option value="56" 
            <?php if($fromheight=='56'){ echo "selected";}?>>4ft 08in
    </option>
  <option value="57" 
          <?php if($fromheight=='57'){ echo "selected";}?>>4ft 09in
  </option>
<option value="58" 
        <?php if($fromheight=='58'){ echo "selected";}?>>4ft 10in
</option>
<option value="59" 
        <?php if($fromheight=='59'){ echo "selected";}?>>4ft 11in
</option>
<option value="60" 
        <?php if($fromheight=='60'){ echo "selected";}?>>5ft
</option>
<option value="61" 
        <?php if($fromheight=='61'){ echo "selected";}?>>5ft 01in
</option>
<option value="62" 
        <?php if($fromheight=='62'){ echo "selected";}?>>5ft 02in
</option>
<option value="63" 
        <?php if($fromheight=='63'){ echo "selected";}?>>5ft 03in
</option>
<option value="64" 
        <?php if($fromheight=='64'){ echo "selected";}?>>5ft 04in
</option>
<option value="65" 
        <?php if($fromheight=='65'){ echo "selected";}?>>5ft 05in
</option>
<option value="66" 
        <?php if($fromheight=='66'){ echo "selected";}?>>5ft 06in
</option>
<option value="67" 
        <?php if($fromheight=='67'){ echo "selected";}?>>5ft 07in
</option>
<option value="68" 
        <?php if($fromheight=='68'){ echo "selected";}?>>5ft 08in
</option>
<option value="69" 
        <?php if($fromheight=='69'){ echo "selected";}?>>5ft 09in
</option>
<option value="70" 
        <?php if($fromheight=='70'){ echo "selected";}?>>5ft 10in
</option>
<option value="71" 
        <?php if($fromheight=='71'){ echo "selected";}?>>5ft 11in
</option>
<option value="72" 
        <?php if($fromheight=='72'){ echo "selected";}?>>6ft
</option>
<option value="73" 
        <?php if($fromheight=='73'){ echo "selected";}?>>6ft 01in
</option>
<option value="74" 
        <?php if($fromheight=='74'){ echo "selected";}?>>6ft 02in
</option>
<option value="75" 
        <?php if($fromheight=='75'){ echo "selected";}?>>6ft 03in
</option>
<option value="76" 
        <?php if($fromheight=='76'){ echo "selected";}?>>6ft 04in
</option>
<option value="77" 
        <?php if($fromheight=='77'){ echo "selected";}?>>6ft 05in
</option>
<option value="78" 
        <?php if($fromheight=='78'){ echo "selected";}?>>6ft 06in
</option>
<option value="79" 
        <?php if($fromheight=='79'){ echo "selected";}?>>6ft 07in
</option>
<option value="80" 
        <?php if($fromheight=='80'){ echo "selected";}?>>6ft 08in
</option>
<option value="81" 
        <?php if($fromheight=='81'){ echo "selected";}?>>6ft 09in
</option>
<option value="82" 
        <?php if($fromheight=='82'){ echo "selected";}?>>6ft 10in
</option>
<option value="83" 
        <?php if($fromheight=='83'){ echo "selected";}?>>6ft 11in
</option>
<option value="84" 
        <?php if($fromheight=='84'){ echo "selected";}?>>7ft
</option>
<option value="85" 
        <?php if($fromheight=='85'){ echo "selected";}?>>Above 7ft
</option>
</select>
</div>
<div class="col-xs-4 gt-margin-top-10 text-center">
  TO
</div>
<div class="col-xs-6">
  <select class="form-control" name="to_hight" id="to_hight">
    <option value="null">To
    </option>
    <option value="48" 
            <?php if($toheight=='48'){ echo "selected";}?>>Below 4ft
    </option>
  <option value="54" 
          <?php if($toheight=='54'){ echo "selected";}?>>4ft 06in
  </option>
<option value="55" 
        <?php if($toheight=='55'){ echo "selected";}?>>4ft 07in
</option>
<option value="56" 
        <?php if($toheight=='56'){ echo "selected";}?>>4ft 08in
</option>
<option value="57" 
        <?php if($toheight=='57'){ echo "selected";}?>>4ft 09in
</option>
<option value="58" 
        <?php if($toheight=='58'){ echo "selected";}?>>4ft 10in
</option>
<option value="59" 
        <?php if($toheight=='59'){ echo "selected";}?>>4ft 11in
</option>
<option value="60" 
        <?php if($toheight=='60'){ echo "selected";}?>>5ft
</option>
<option value="61" 
        <?php if($toheight=='61'){ echo "selected";}?>>5ft 01in
</option>
<option value="62" 
        <?php if($toheight=='62'){ echo "selected";}?>>5ft 02in
</option>
<option value="63" 
        <?php if($toheight=='63'){ echo "selected";}?>>5ft 03in
</option>
<option value="64" 
        <?php if($toheight=='64'){ echo "selected";}?>>5ft 04in
</option>
<option value="65" 
        <?php if($toheight=='65'){ echo "selected";}?>>5ft 05in
</option>
<option value="66" 
        <?php if($toheight=='66'){ echo "selected";}?>>5ft 06in
</option>
<option value="67" 
        <?php if($toheight=='67'){ echo "selected";}?>>5ft 07in
</option>
<option value="68" 
        <?php if($toheight=='68'){ echo "selected";}?>>5ft 08in
</option>
<option value="69" 
        <?php if($toheight=='69'){ echo "selected";}?>>5ft 09in
</option>
<option value="70" 
        <?php if($toheight=='70'){ echo "selected";}?>>5ft 10in
</option>
<option value="71" 
        <?php if($toheight=='71'){ echo "selected";}?>>5ft 11in
</option>
<option value="72" 
        <?php if($toheight=='72'){ echo "selected";}?>>6ft
</option>
<option value="73" 
        <?php if($toheight=='73'){ echo "selected";}?>>6ft 01in
</option>
<option value="74" 
        <?php if($toheight=='74'){ echo "selected";}?>>6ft 02in
</option>
<option value="75" 
        <?php if($toheight=='75'){ echo "selected";}?>>6ft 03in
</option>
<option value="76" 
        <?php if($toheight=='76'){ echo "selected";}?>>6ft 04in
</option>
<option value="77" 
        <?php if($toheight=='77'){ echo "selected";}?>>6ft 05in
</option>
<option value="78" 
        <?php if($toheight=='78'){ echo "selected";}?>>6ft 06in
</option>
<option value="79" 
        <?php if($toheight=='79'){ echo "selected";}?>>6ft 07in
</option>
<option value="80" 
        <?php if($toheight=='80'){ echo "selected";}?>>6ft 08in
</option>
<option value="81" 
        <?php if($toheight=='81'){ echo "selected";}?>>6ft 09in
</option>
<option value="82" 
        <?php if($toheight=='82'){ echo "selected";}?>>6ft 10in
</option>
<option value="83" 
        <?php if($toheight=='83'){ echo "selected";}?>>6ft 11in
</option>
<option value="84" 
        <?php if($toheight=='84'){ echo "selected";}?>>7ft
</option>
<option value="85" 
        <?php if($toheight=='85'){ echo "selected";}?>>Above 7ft
</option>                                                                                    
</select>
</div>
</div>
</div>
</div>
	<div class="gt-panel gt-panel-default" id="getcaste">
  <div class="gt-panel-head">
    <div class="row">
      <div class="col-xs-12">
        <b>Education
        </b>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <a onClick="return cleareducation();" class="gt-cursor">
            <i class="fa fa-times-circle">
            </i> Clear
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="gt-panel-body max-height-200" id="left-panel-5">
    <div class="row" id="users_education">
      <div class="col-xs-16">
        <input class="search form-control" placeholder="Search" />
      </div>
      <div class="list">
        <?php
$education=explode(",",$education123);
$SQL_STATEMENT_edu =  $DatabaseCo->dbLink->query("SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_edu))
{
?>
        <div class="col-xs-16">
          <label for="filter-24<?php echo $DatabaseCo->dbRow->edu_id;?>">
            <input type="checkbox" id="filter-24<?php echo $DatabaseCo->dbRow->edu_id;?>" name="education" value="<?php echo $DatabaseCo->dbRow->edu_id;?>" class="gt-cursor" 
                   <?php if(in_array($DatabaseCo->dbRow->edu_id,$education)){ echo "checked";} ?>> 
            <span class="gt-margin-left-10 gt-cursor name">
              <?php echo $DatabaseCo->dbRow->edu_name; ?>
            </span>
          </label>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</div>
	<div class="gt-panel gt-panel-default" id="getcaste">
  <div class="gt-panel-head">
    <div class="row">
      <div class="col-xs-12">
        <b>Occupation
        </b>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <a onClick="return clearoccupation();" class="gt-cursor">
            <i class="fa fa-times-circle">
            </i> Clear
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="gt-panel-body max-height-200" id="left-panel-5">
    <div class="row" id="users_occupation">
      <div class="col-xs-16">
        <input class="search form-control" placeholder="Search" />
      </div>
      <div class="list">
        <?php
$occup=explode(",",$occupation);
$SQL_STATEMENT_ocp = $DatabaseCo->dbLink->query("SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_ocp)){
?>
        <div class="col-xs-16">
          <label for="filter-25<?php echo $DatabaseCo->dbRow->ocp_id;?>">
            <input type="checkbox" id="filter-25<?php echo $DatabaseCo->dbRow->ocp_id;?>" name="occupation" value="<?php echo $DatabaseCo->dbRow->ocp_id;?>" 
                   <?php if(in_array($DatabaseCo->dbRow->ocp_id,$occup)){ echo "checked";}?>> 
            <span class="gt-margin-left-10 gt-cursor name">
              <?php echo $DatabaseCo->dbRow->ocp_name; ?>
            </span>
          </label>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</div>
	<div class="gt-panel gt-panel-default">
  <div class="gt-panel-head">
    <div class="row">
      <div class="col-xs-12">
        <b>Country Living In
        </b>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <a onClick="return clearcountry();" class="gt-cursor">
            <i class="fa fa-times-circle">
            </i> Clear
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="gt-panel-body max-height-200">
    <?php  $country=explode(",",$country123);?>
    <div class="row" id="users">
      <div class="col-xs-16">
        <input class="search form-control" placeholder="Search" />
      </div>
      <div class="list">
        <div class="col-xs-16">
          <label for="filter-1595">
            <input type="checkbox" id="filter-1595" value="95" name="country" 
                   <?php if(in_array('95',$country)){ echo "checked";} ?> class="gt-cursor"> 
            <span class="gt-margin-left-10 gt-cursor name">India
            </span>
          </label>
        </div>
        <div class="col-xs-16">
          <label for="filter-1536">
            <input type="checkbox" id="filter-1536" value="36" name="country" 
                   <?php if(in_array('36',$country)){ echo "checked";} ?> class="gt-cursor"> 
            <span class="gt-margin-left-10 gt-cursor name">Canada
            </span>
          </label>
        </div>
        <div class="col-xs-16">
          <label for="filter-1512">
            <input type="checkbox" id="filter-1512" value="12" name="country" 
                   <?php if(in_array('12',$country)){ echo "checked";} ?> class="gt-cursor"> 
            <span class="gt-margin-left-10 gt-cursor name">Australia
            </span>
          </label>
        </div>
        <div class="col-xs-16">
          <label for="filter-15215">
            <input type="checkbox" id="filter-15215" value="215" name="country" 
                   <?php if(in_array('215',$country)){ echo "checked";} ?> class="gt-cursor"> 
            <span class="gt-margin-left-10 gt-cursor name">United States 
            </span>
          </label>
        </div>
        <div class="col-xs-16">
          <label for="filter-1570">
            <input type="checkbox" id="filter-1570" value="70" name="country" 
                   <?php if(in_array('70',$country)){ echo "checked";} ?> class="gt-cursor"> 
            <span class="gt-margin-left-10 gt-cursor name">United Kingdom
            </span>
          </label>
        </div>
        <?php
$SQL_STATEMENT_pcountry =  $DatabaseCo->dbLink->query("SELECT * FROM country WHERE status='APPROVED' and country_id!='95' and country_id!='215' and country_id!='70' and country_id!='12' and country_id!='36' order by country_name");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_pcountry))
{
?>
        <div class="col-xs-16">
          <label for="filter-15<?php echo $DatabaseCo->dbRow->country_id; ?>">
            <input type="checkbox" id="filter-15<?php echo $DatabaseCo->dbRow->country_id; ?>" value="<?php echo $DatabaseCo->dbRow->country_id; ?>" 
                   <?php if(in_array($DatabaseCo->dbRow->country_id,$country)){ echo "checked";} ?> name="country" class="gt-cursor"> 
            <span class="gt-margin-left-10 gt-cursor name">
              <?php echo $DatabaseCo->dbRow->country_name; ?>
            </span>
          </label>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</div>
	<div class="gt-panel gt-panel-default" id="getstate">
  <div class="gt-panel-head">
    <div class="row">
      <div class="col-xs-12">
        <b>State
        </b>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <a onClick="return clearstate();" class="gt-cursor">
            <i class="fa fa-times-circle">
            </i> Clear
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="gt-panel-body max-height-200" id="left-panel-7">
    <div class="row" id="users_state">
      <div class="col-xs-16">
        <input class="search form-control" placeholder="Search" />
      </div>
      <div class="list">
        <?php
$state=explode(",",$state123);
foreach ($country as $rel)
{
?>
        <div class="col-xs-16">
          <h5 class="text-center gt-margin-top-0px gt-margin-bottom-0px gt-font-weight-700">
            <?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select country_name from country where country_id='$rel'")); echo $a['country_name'];?> 
          </h5>   
        </div>
        <?php 
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id ='$rel' ORDER BY state_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
?>
        <div class="col-xs-16">
          <label for="filter-20<?php echo $DatabaseCo->dbRow->state_id; ?>">
            <input type="checkbox" id="filter-20<?php echo $DatabaseCo->dbRow->state_id; ?>" name="state_id" value="<?php echo $DatabaseCo->dbRow->state_id; ?>" class="gt-cursor" 
                   <?php if(in_array($DatabaseCo->dbRow->state_id,$state)){ echo "checked";} ?>> 
            <span class="gt-margin-left-10 gt-cursor name"> 
              <?php echo $DatabaseCo->dbRow->state_name; ?>
            </span>
          </label>
        </div>
        <?php } }?>
      </div>
    </div>
  </div>
</div>
	<div class="gt-panel gt-panel-default" id="getcity">
  <div class="gt-panel-head">
    <div class="row">
      <div class="col-xs-12">
        <b>City
        </b>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <a onClick="return clearcity();" class="gt-cursor">
            <i class="fa fa-times-circle">
            </i> Clear
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="gt-panel-body max-height-200" id="left-panel-8">
    <div class="row" id="users_city">
      <div class="col-xs-16">
        <input class="search form-control" placeholder="Search" />
      </div>
      <div class="list">
        <?php
$city=explode(",",$city123);
foreach ($state as $rel)
{
?>
        <div class="col-xs-16">
          <h5 class="text-center gt-margin-top-0px gt-margin-bottom-0px gt-font-weight-700">
            <?php $a=mysqli_fetch_array($DatabaseCo->dbLink->query("select state_name from state where state_id='$rel'")); echo $a['state_name'];?> 
          </h5>   
        </div>
        <?php 
$SQL_STATEMENT =  $DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE state_id ='$rel' ORDER BY city_name ASC");
while($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT))
{
?>
        <div class="col-xs-16">
          <label for="filter-21<?php echo $DatabaseCo->dbRow->city_id; ?>">
            <input type="checkbox" id="filter-21<?php echo $DatabaseCo->dbRow->city_id; ?>" name="city_id" value="<?php echo $DatabaseCo->dbRow->city_id ?>" 
                   <?php if(in_array($DatabaseCo->dbRow->city_id,$city)){ echo "checked";} ?> class="gt-cursor">
            <span class="gt-margin-left-10 gt-cursor name"> 
              <?php echo $DatabaseCo->dbRow->city_name; ?> 
            </span>
          </label>
        </div>
        <?php } }?>
      </div>
    </div>
  </div>
</div>
  </form>
</div>
