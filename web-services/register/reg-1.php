<?php
include_once '../../databaseConn.php';
$DatabaseCo = new DatabaseConn();

/*-- DYNAMIC FIELD DATA FETCH --*/
$SQL_STATEMENT_occupation = $DatabaseCo->dbLink->query("SELECT ocp_id,ocp_name FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
$SQL_STATEMENT_subcaste = $DatabaseCo->dbLink->query("SELECT sub_caste_id,sub_caste_name FROM sub_caste WHERE status='APPROVED' ORDER BY sub_caste_name ASC");
$SQL_STATEMENT_education = $DatabaseCo->dbLink->query("SELECT edu_id,edu_name FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
$SQL_STATEMENT_education1 = $DatabaseCo->dbLink->query("SELECT edu_id,edu_name FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC");
$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
$SQL_STATEMENT_country = $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");
/*-- DYNAMIC FIELD DATA FETCH END --*/
	

/*-- SESSION DATA OF FIRST FORM --*/
if (isset($_SESSION['reg_fnmae']) && $_SESSION['reg_fnmae'] != '') {
	
    $reg_caste = $_SESSION['reg_caste'];
    $reg_email = $_SESSION['reg_email'];
    $reg_country = $_SESSION['reg_country'];
    $reg_bday = $_SESSION['reg_bday'];
    $reg_fnmae = $_SESSION['reg_fnmae'];
    $reg_lnmae = $_SESSION['reg_lnmae'];
    $reg_gender = trim($_SESSION['reg_gender']);
    $reg_m_tongue = $_SESSION['reg_m_tongue'];
    $reg_mobilecode = $_SESSION['reg_code'];
    $reg_mobile = $_SESSION['reg_mobile'];
    $reg_profile_by = $_SESSION['reg_profile_by'];
    $reg_religion = $_SESSION['reg_religion'];
}
/*-- SESSION DATA OF FIRST FORM END --*/

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT sub_caste,will_to_marry,weight,body_type,complexion,physical_status,additional_degree,annual_income,diet,smoke,drink,dosh,star,rasi,birthtime,birthplace,family_profile,family_status,family_type,family_value,father_occupation,mother_occupation,no_of_brother,no_of_married_brother,no_of_sister,no_of_married_sister,profile_text FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>

<!-- CHOOSEN CSS -->
<link rel="stylesheet" href="css/prism.css">
<link rel="stylesheet" href="css/chosen.css">
<!-- CHOOSEN CSS END -->

<div class="container">
    <div class="row gt-margin-top-10">
        <div class="col-xxl-11">
            <div class="row">
                <div class="col-xxl-2">
                    <img src="img/register-img.png" class="img-responsive">
                </div>
                <div class="col-xxl-14">
                    <h3 class="gt-text-green">
                        Completing this page will take you closer to your perfect match.
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="gtRegister col-xxl-11">
        <div class="row gt-margin-bottom-20">
            <img src="img/reg-step-1.png" class="img-responsive">
        </div>
        <div class="row">
            <h3 class="gt-text-green gt-border-bottom-smoke-white gt-padding-bottom-10">
                <i class="fa fa-user gt-margin-right-10"></i>Personal Information
            </h3>
            <article>
                <p>
                    You have many matching profiles based on your details. Completing this page will take you closer to your perfect match.
                </p>
            </article>
            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b class="gt-text-Grey">Mandatory fields</b>
        </div>           	
        <form id="register_form" name="register_form" method="post" action="" class="">
            <input type="hidden" name="matri_id" value="">
            <h4 class="gtRegTitle gt-margin-top-30">
                <i class="fa fa-file-text gt-margin-right-10"></i> Account Information 
            </h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>First Name</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="text" class="gt-form-control" name="fname" id="fname" data-validetta="required" placeholder="Enter Your Firstname" value="<?php
                        if (isset($reg_fnmae)) {
                            echo ucfirst($reg_fnmae);
                        }
                        ?>" >   
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Last Name</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="text" class="gt-form-control" name="lname" id="lname" data-validetta="required"  placeholder="Enter Your Lastname" value="<?php
                        if (isset($reg_lnmae)) {
                            echo ucfirst($reg_lnmae);
                        }
                        ?>" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Email Id</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="hidden" name="email" value="<?php
                        if (isset($reg_email)) {
                            echo $reg_email;
                        }
                        ?>">
                        <input type="text" class="gt-form-control gtDisabled" name="email" id="email" data-validetta="required,email" value="<?php
                        if (isset($reg_email)) {
                            echo $reg_email;
                        }
                        ?>" placeholder="Enter Your Proper Email Id" disabled>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Password</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="password" class="gt-form-control" name="password" id="password" value="" placeholder="Enter Your Password" data-validetta="required,minLength[5]">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Confirm Password</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="password" class="gt-form-control " name="cpassword" id="cpassword" data-validetta="required,equalTo[password]" value="" placeholder="Enter Your Confirm Password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Mobile No.</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="text" class="gt-form-control gtDisabled" name="mobile" id="mobile" data-validetta="required" value="<?php echo $reg_mobilecode . '-' . $reg_mobile; ?>" disabled>
                    </div>
                </div>
            </div>
            <h4 class="gtRegTitle gt-margin-top-30">
            	<i class="fa fa-user gt-margin-right-10"></i>Some Personal Information
            </h4>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Gender</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <label for="male" class="gt-inline-block">
                            <span class="pull-left gt-margin-right-10">
                                <?php echo $reg_gender; ?>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Date Of Birth</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <label for="male" class="gt-inline-block">
                            <span class="pull-left gt-margin-right-10">
                                <?php echo date('d/ m /Y', strtotime($reg_bday)); ?>                                        
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Marital status</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                       <input type="radio" name="mstatus" value="Never Married" id="never-married" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required" onClick="check_ststus('never-married')">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="never-married">Never Married</label>
                        <?php if($reg_gender=="Male"){?>
                        <input type="radio" name="mstatus" value="Widower" id="widower" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required" onClick="check_ststus('widower')">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="widower">Widower</label>
                        <?php } ?>
                         <?php if($reg_gender=="Female"){?>
                        <input type="radio" name="mstatus" value="Widow" id="widow" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required" onClick="check_ststus('widow')">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="widower">Widow</label>
                        <?php } ?>
                        <div class="clearfix visible-xs visible-sm"></div>
                        
                        <input type="radio" name="mstatus" value="Divorced" id="divorced" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required" onClick="check_ststus('divorced')">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="divorced">Divorced</label>
                       
                        
                        <input type="radio" name="mstatus" value="Awaiting Divorce" id="awaiting-divorce" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required" onClick="check_ststus('awaiting-divorce')">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="awaiting-divorce">Awaiting Divorce</label>
                    </div>
                </div>
            </div>
            <div class="form-group" id="dis_child">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>No. of children</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="no_child" onchange="check_child(this.value)">
                            <option value="">Select</option>
                            <option value="0">None</option>
                            <option value="One">One</option>
                            <option value="Two">Two</option>
                            <option value="Three">Three</option>
                            <option value="Four and above">Four and above</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" id="dis_child_status">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                          <b>Children Living Status</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="child_status">
                            <option value="">Select</option>
                            <option value="Living with me">Living with me</option>
                            <option value="Not living with me">Not living with me</option>
                        </select>
                    </div>
                </div>
            </div>	
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Religion</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <input type="hidden" name="religion" value="<?php echo $reg_religion;?>">
                        <select class="gt-form-control gtDisabled " id="religion" name="religion" data-validetta="required" disabled>
                            <option value="">
                                Select Your Religion 
                            </option>
                            <?php
                            $SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion)) {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>" <?php
                                if (isset($reg_religion) && $reg_religion == $DatabaseCo->dbRow->religion_id) {
                                    echo "selected";
                                }
                                ?>><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Caste</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" id="caste" name="caste" data-validetta="required" >
                            <option value="">Select Your Related Caste </option>
                            <?php
                            $SQL_STATEMENT = $DatabaseCo->dbLink->query("SELECT * FROM caste WHERE  status='APPROVED' AND religion_id='" . $reg_religion . "' ORDER BY  caste_name ASC") or die(mysqli_error($DatabaseCo->dbLink));
                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT)) {
                                ?>		
                                <option value="<?php echo $DatabaseCo->dbRow->caste_id; ?>" <?php
                                if ($DatabaseCo->dbRow->caste_id == $reg_caste) {
                                    echo "selected";
                                }
                                ?>><?php echo $DatabaseCo->dbRow->caste_name ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php if($row_field->sub_caste == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Sub Caste</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select"  name="subcaste" id="subcaste">
                            <option value="">
                                Select Your Sub Caste
                            </option>
                            <?php
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_subcaste)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->dbRow->sub_caste_id; ?>"><?php echo $DatabaseCo->dbRow->sub_caste_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Mother Tongue</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" id="m_tongue" name="m_tongue" data-validetta="required" >
                            <option value="">Select Your Mother Tongue </option>
                            <?php
                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>" <?php
                                if ($reg_m_tongue == $DatabaseCo->dbRow->mtongue_id) {
                                    echo "selected";
                                }
                                ?>><?php echo $DatabaseCo->dbRow->mtongue_name; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->will_to_marry == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <label class="col-xxl-16 col-xs-16 text-center" for="willingToMarry">
                        <span class="gt-margin-right-10">
                            <input type="checkbox" id="willingToMarry" name="will_to_mary_caste" value="1">
                        </span>
                        <span class="gt-text-Grey font-14">
                            Willing to marry in other caste?
                        </span>
                    </label>
                </div>
            </div>
			<?php } ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Country living in</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" name="country" id="country" data-validetta="required" >
                            <option value="">
                                Select Country living in
                            </option>
                            <?php
                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_country)) {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>" <?php
                                if ($DatabaseCo->dbRow->country_id == $reg_country) {
                                    echo "selected";
                                }
                                ?>><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                                    <?php } ?>
                        </select>
                        <div id="status1"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Residing state</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" data-validetta="required" id="state" name="state">
                            <option value="">
                                Select Residing State
                            </option>
                        </select>
                        <div id="status2"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Residing city</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control chosen-select" data-validetta="required" id="city" name="city">
                            <option value="">
                                Select Residing City
                            </option>
                        </select>
                    </div>
                </div>
            </div>
           <h4 class="gt-margin-top-30 gt-text-Grey font-20 gt-margin-bottom-30"><i class="fa fa-male gt-margin-right-10"></i>Physical Attributes </h4>            		
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Height</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control"  name="height" data-validetta="required">
                            <option value="">Select Height In ft</option>
                            <option value="48">Below 4ft 6in - 137cm</option>
                            <option value="54">4ft 6in - 137cm</option>
                            <option value="55">4ft 7in - 139cm</option>
                            <option value="56">4ft 8in - 142cm</option>
                            <option value="57">4ft 9in - 144cm</option>
                            <option value="58">4ft 10in - 147cm</option>
                            <option value="59">4ft 11in - 149cm</option>
                            <option value="60">5ft - 152cm</option>
                            <option value="61">5ft 1in - 154cm</option>
                            <option value="62">5ft 2in - 157cm</option>
                            <option value="63">5ft 3in - 160cm</option>
                            <option value="64">5ft 4in - 162cm</option>
                            <option value="65">5ft 5in - 165cm</option>
                            <option value="66">5ft 6in - 167cm</option>
                            <option value="67">5ft 7in - 170cm</option>
                            <option value="68">5ft 8in - 172cm</option>
                            <option value="69">5ft 9in - 175cm</option>
                            <option value="70">5ft 10in - 177cm</option>
                            <option value="71">5ft 11in - 180cm</option>
                            <option value="72">6ft - 182cm</option>
                            <option value="73">6ft 1in - 185cm</option>
                            <option value="74">6ft 2in - 187cm</option>
                            <option value="75">6ft 3in - 190cm</option>
                            <option value="76">6ft 4in - 193cm</option>
                            <option value="77">6ft 5in - 195cm</option>
                            <option value="78">6ft 6in - 198cm</option>
                            <option value="79">6ft 7in - 200cm</option>
                            <option value="80">6ft 8in - 203cm</option>
                            <option value="81">6ft 9in - 205cm</option>
                            <option value="82">6ft 10in - 208cm</option>
                            <option value="83">6ft 11in - 210cm</option>
                            <option value="84">7ft - 213cm</option>
                            <option value="89">Above 7ft - 213cm</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->weight == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Weight</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="weight" <?php if($row_field->weight == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                            <option value="">
                                Select Weight In Kg
                            </option>
                            <option value="40">40 Kg</option>
                            <option value="41">41 Kg</option>
                            <option value="42">42 Kg</option>
                            <option value="43">43 Kg</option>
                            <option value="44">44 Kg</option>
                            <option value="45">45 Kg</option>
                            <option value="46">46 Kg</option>
                            <option value="47">47 Kg</option>
                            <option value="48">48 Kg</option>
                            <option value="49">49 Kg</option>
                            <option value="50">50 Kg</option>
                            <option value="51">51 Kg</option>
                            <option value="52">52 Kg</option>
                            <option value="53">53 Kg</option>
                            <option value="54">54 Kg</option>
                            <option value="55">55 Kg</option>
                            <option value="56">56 Kg</option>
                            <option value="57">57 Kg</option>
                            <option value="58">58 Kg</option>
                            <option value="59">59 Kg</option>
                            <option value="60">60 Kg</option>
                            <option value="61">61 Kg</option>
                            <option value="62">62 Kg</option>
                            <option value="63">63 Kg</option>
                            <option value="64">64 Kg</option>
                            <option value="65">65 Kg</option>
                            <option value="66">66 Kg</option>
                            <option value="67">67 Kg</option>
                            <option value="68">68 Kg</option>
                            <option value="69">69 Kg</option>
                            <option value="70">70 Kg</option>
                            <option value="71">71 Kg</option>
                            <option value="72">72 Kg</option>
                            <option value="73">73 Kg</option>
                            <option value="74">74 Kg</option>
                            <option value="75">75 Kg</option>
                            <option value="76">76 Kg</option>
                            <option value="77">77 Kg</option>
                            <option value="78">78 Kg</option>
                            <option value="79">79 Kg</option>
                            <option value="80">80 Kg</option>
                            <option value="81">81 Kg</option>
                            <option value="82">82 Kg</option>
                            <option value="83">83 Kg</option>
                            <option value="84">84 Kg</option>
                            <option value="85">85 Kg</option>
                            <option value="86">86 Kg</option>
                            <option value="87">87 Kg</option>
                            <option value="88">88 Kg</option>
                            <option value="89">89 Kg</option>
                            <option value="90">90 Kg</option>
                            <option value="91">91 Kg</option>
                            <option value="92">92 Kg</option>
                            <option value="93">93 Kg</option>
                            <option value="94">94 Kg</option>
                            <option value="95">95 Kg</option>
                            <option value="96">96 Kg</option>
                            <option value="97">97 Kg</option>
                            <option value="98">98 Kg</option>
                            <option value="99">99 Kg</option>
                            <option value="100">100 Kg</option>
                            <option value="101">101 Kg</option>
                            <option value="102">102 Kg</option>
                            <option value="103">103 Kg</option>
                            <option value="104">104 Kg</option>
                            <option value="105">105 Kg</option>
                            <option value="106">106 Kg</option>
                            <option value="107">107 Kg</option>
                            <option value="108">108 Kg</option>
                            <option value="109">109 Kg</option>
                            <option value="110">110 Kg</option>
                            <option value="111">111 Kg</option>
                            <option value="112">112 Kg</option>
                            <option value="113">113 Kg</option>
                            <option value="114">114 Kg</option>
                            <option value="115">115 Kg</option>
                            <option value="116">116 Kg</option>
                            <option value="117">117 Kg</option>
                            <option value="118">118 Kg</option>
                            <option value="119">119 Kg</option>
                            <option value="120">120 Kg</option>
                            <option value="121">121 Kg</option>
                            <option value="122">122 Kg</option>
                            <option value="123">123 Kg</option>
                            <option value="124">124 Kg</option>
                            <option value="125">125 Kg</option>
                            <option value="126">126 Kg</option>
                            <option value="127">127 Kg</option>
                            <option value="128">128 Kg</option>
                            <option value="129">129 Kg</option>
                            <option value="130">130 Kg</option>
                            <option value="131">131 Kg</option>
                            <option value="132">132 Kg</option>
                            <option value="133">133 Kg</option>
                            <option value="134">134 Kg</option>
                            <option value="135">135 Kg</option>
                            <option value="136">136 Kg</option>
                            <option value="137">137 Kg</option>
                            <option value="138">138 Kg</option>
                            <option value="139">139 Kg</option>
                            <option value="140">140 Kg</option>
                        </select>
					</div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->body_type == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Body type</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="bodytype" value="Slim" id="Slim" class="gt-margin-top-0 pull-left gt-padding-right-10" >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Slim">Slim</label>
                       
                        <input type="radio" name="bodytype" value="Average" id="Average" class="gt-margin-top-0 pull-left gt-padding-right-10">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Average">Average</label>
                            
                        <div class="clearfix visible-xs visible-sm"></div>
                       
                        <input type="radio" name="bodytype" value="Athletic" id="Athletic" class="gt-margin-top-0 pull-left gt-padding-right-10" >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Athletic">Athletic</label>
                           
                        <input type="radio" name="bodytype" value="Heavy" id="Heavy" class="gt-margin-top-0 pull-left gt-padding-right-10">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Heavy">Heavy</label>
                     </div>
				</div>
			</div>
			<?php } ?>
			<?php if($row_field->complexion == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Complexion</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="complexion" value="Very-Fair" id="Very-Fair" class="gt-margin-top-0 pull-left gt-padding-right-10" >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Very-Fair">Very Fair</label>
                           
                        <input type="radio" name="complexion" value="Fair" id="Fair" class="gt-margin-top-0 pull-left gt-padding-right-10" >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Fair">Fair</label>
                       
                        <div class="clearfix visible-xs"></div>
                        <input type="radio" name="complexion" value="Wheatish" id="Wheatish" class="gt-margin-top-0 pull-left gt-padding-right-10">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Wheatish">Wheatish</label>
                       
                        <input type="radio" name="complexion" value="Wheatish-brown" id="Wheatish-brown" class="gt-margin-top-0 pull-left gt-padding-right-10" >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Wheatish-brown">Wheatish brown</label>
                        <input type="radio" name="complexion" value="Dark" id="Dark"  class="gt-margin-top-0 pull-left gt-padding-right-10" >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Dark">Dark</label>
                            
                        
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Physical status</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                       <input type="radio" name="physicalStatus" value="Normal" id="Normal" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required" >
                       <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Normal">Normal</label>
                       
                       <input type="radio" name="physicalStatus" value="Physically-challenged" id="Physically-challenged" class="gt-margin-top-0 pull-left" data-validetta="required">
                       <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5" for="Physically-challenged">Physically challenged</label>
                    </div>
                </div>
            </div>
			
			
            <h4 class="gt-margin-top-30 gt-text-Grey font-20 gt-margin-bottom-30"><i class="fa fa-book gt-margin-right-10"></i>Education & Occupation</h4> 
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Highest Education</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" data-validetta="required" name="education">
                            <option value="">
                                Select Your Highest Education
                            </option>
                            <?php
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_education)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->additional_degree == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                           <b>Additional Degree</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="other_education">
                            <option value="">
                                Select Your Additional Degree 
                            </option>
                            <?php
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_education1)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                           <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Occupation</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control"  data-validetta="required" name="occupation" >
                            <option value="">
                                Select Your Occupation
                            </option>
                            <?php
                            	while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_occupation)) {
                            ?>
                            <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>"><?php echo $DatabaseCo->dbRow->ocp_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" >
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Employed in </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="employedin" value="Government" id="Government" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Government">Government</label>
                        
                        <input type="radio" name="employedin" value="Private" id="Private"  class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Private">Private</label>
                        
                        <div class="clearfix visible-xs"></div>
                        <input type="radio" name="employedin" value="Business" id="Business"  class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Business">Business</label>
                        
                        <input type="radio" name="employedin" value="Defence" id="Defence"  class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Defence">Defence</label>
                        
                        <input type="radio" name="employedin" value="Self-Employed" id="Self-Employed"  class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Self-Employed">Self Employed</label>
						
						<?php
	  						if ($_SESSION['reg_gender'] == 'Female') {
						?>
						<input type="radio" name="employedin" value="Not Working" id="Not-Working"  class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="required">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Not-Working">Not Working</label>
						<?php } ?>
                    </div>
                </div>
            </div>
			
			<?php if($row_field->annual_income == 'Yes'){ ?>
            <div class="form-group" >
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Annual Income</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="gt-form-control" name="income">
                            <option value="">Select Annual Income</option>
                            <option value="Rs 10,000 - 50,000">Rs 10,000 - 50,000</option>
                            <option value="Rs 50,000 - 1,00,000">Rs 50,000 - 1,00,000</option>
                            <option value="Rs 1,00,000 - 2,00,000">Rs 1,00,000 - 2,00,000</option>
                            <option value="Rs 2,00,000 - 4,00,000">Rs 2,00,000 - 4,00,000</option>
                            <option value="Rs 4,00,000 - 6,00,000">Rs 4,00,000 - 6,00,000</option>
                            <option value="Rs 6,00,000 - 8,00,000">Rs 6,00,000 - 8,00,000</option>
                            <option value="Rs 8,00,000 - 10,00,000">Rs 8,00,000 - 10,00,000</option>
                            <option value="Rs 10,00,000 - 12,00,000">Rs 10,00,000 - 12,00,000</option>
                            <option value="Rs 12,00,000 - 14,00,000">Rs 12,00,000 - 14,00,000</option>
                            <option value="Rs 14,00,000 - 16,00,000">Rs 14,00,000 - 16,00,000</option>
                            <option value="Rs 16,00,000 - 18,00,000">Rs 16,00,000 - 18,00,000</option>
                            <option value="Rs 18,00,000 - 20,00,000">Rs 18,00,000 - 20,00,000</option>
                            <option value="Rs 20,00,000 - 22,00,000">Rs 20,00,000 - 22,00,000</option>
                            <option value="Rs 22,00,000 - 24,00,000">Rs 22,00,000 - 24,00,000</option>
                            <option value="Rs 24,00,000 - 26,00,000">Rs 24,00,000 - 26,00,000</option>
                            <option value="Rs 26,00,000 - 28,00,000">Rs 26,00,000 - 28,00,000</option>
                            <option value="Rs 28,00,000 - 30,00,000">Rs 28,00,000 - 30,00,000</option>
                            <option value="Rs 30,00,000 - 32,00,000">Rs 30,00,000 - 32,00,000</option>
                            <option value="Rs 32,00,000 - 34,00,000">Rs 32,00,000 - 34,00,000</option>
                            <option value="Rs 34,00,000 - 36,00,000">Rs 34,00,000 - 36,00,000</option>
                            <option value="Rs 36,00,000 - 38,00,000">Rs 36,00,000 - 38,00,000</option>
                            <option value="Rs 38,00,000 - 40,00,000">Rs 38,00,000 - 40,00,000</option>
                            <option value="Rs 40,00,000 - 42,00,000">Rs 40,00,000 - 42,00,000</option>
                            <option value="Rs 42,00,000 - 44,00,000">Rs 42,00,000 - 44,00,000</option>
                            <option value="Rs 44,00,000 - 46,00,000">Rs 44,00,000 - 46,00,000</option>
                            <option value="Rs 46,00,000 - 48,00,000">Rs 46,00,000 - 48,00,000</option>
                            <option value="Rs 48,00,000 - 50,00,000">Rs 48,00,000 - 50,00,000</option>
                            <option value="Rs 50,00,000 - 52,00,000">Rs 50,00,000 - 52,00,000</option>
                            <option value="Rs 52,00,000 - 54,00,000">Rs 52,00,000 - 54,00,000</option>
                            <option value="Rs 54,00,000 - 56,00,000">Rs 54,00,000 - 56,00,000</option>
                            <option value="Rs 56,00,000 - 58,00,000">Rs 56,00,000 - 58,00,000</option>
                            <option value="Rs 58,00,000 - 60,00,000">Rs 58,00,000 - 60,00,000</option>
                            <option value="Rs 60,00,000 - 62,00,000">Rs 60,00,000 - 62,00,000</option>
                            <option value="Rs 62,00,000 - 64,00,000">Rs 62,00,000 - 64,00,000</option>
                            <option value="Rs 64,00,000 - 66,00,000">Rs 64,00,000 - 66,00,000</option>
                            <option value="Rs 66,00,000 - 68,00,000">Rs 66,00,000 - 68,00,000</option>
                            <option value="Rs 68,00,000 - 70,00,000">Rs 68,00,000 - 70,00,000</option>
                            <option value="Rs 70,00,000 - 72,00,000">Rs 70,00,000 - 72,00,000</option>
                            <option value="Rs 72,00,000 - 74,00,000">Rs 72,00,000 - 74,00,000</option>
                            <option value="Rs 74,00,000 - 76,00,000">Rs 74,00,000 - 76,00,000</option>
                            <option value="Rs 76,00,000 - 78,00,000">Rs 76,00,000 - 78,00,000</option>
                            <option value="Rs 78,00,000 - 80,00,000">Rs 78,00,000 - 80,00,000</option>
                            <option value="Rs 80,00,000 - 82,00,000">Rs 80,00,000 - 82,00,000</option>
                            <option value="Rs 82,00,000 - 84,00,000">Rs 82,00,000 - 84,00,000</option>
                            <option value="Rs 84,00,000 - 86,00,000">Rs 84,00,000 - 86,00,000</option>
                            <option value="Rs 86,00,000 - 88,00,000">Rs 86,00,000 - 88,00,000</option>
                            <option value="Rs 88,00,000 - 90,00,000">Rs 88,00,000 - 90,00,000</option>
                            <option value="Rs 90,00,000 - 92,00,000">Rs 90,00,000 - 92,00,000</option>
                            <option value="Rs 92,00,000 - 94,00,000">Rs 92,00,000 - 94,00,000</option>
                            <option value="Rs 94,00,000 - 96,00,000">Rs 94,00,000 - 96,00,000</option>
                            <option value="Rs 96,00,000 - 98,00,000">Rs 96,00,000 - 98,00,000</option>
                            <option value="Rs 98,00,000 - 1,00,00,000">Rs 98,00,000 - 1,00,00,000</option>
                            <option value="Above Rs 1,00,00,000">Above Rs 1,00,00,000</option>
                            <option value="Not Working">Not Working</option>
                           
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			
			<?php if($row_field->diet == 'Yes' || $row_field->smoke == 'Yes' || $row_field->drink == 'Yes'){ ?>
            <h4 class="gt-margin-top-30 gt-text-Grey font-20 gt-margin-bottom-30"><i class="fa fa-glass gt-margin-right-10"></i>Habits</h4> 
			<?php if($row_field->diet == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Diet</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                       <input type="radio" name="diet" value="Vegetarian" id="Vegetarian" class="gt-margin-top-0 pull-left gt-padding-right-10"  <?php if($row_field->diet == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                       <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Vegetarian">Vegetarian</label>
                       
                       <input type="radio" name="diet" value="Non-Vegetarian" id="Non-Vegetarian" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->diet == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                       <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Non-Vegetarian">Non-Vegetarian</label>
                       <div class="clearfix visible-xs visible-sm"></div>
                        <input type="radio" name="diet" value="Eggetarian" id="Eggetarian" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->diet == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Eggetarian">Eggetarian</label>
                     </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->smoke == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Smoking</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="smoking" value="No" id="SmokingNo"  class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->smoke == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="SmokingNo">No</label>
                           
                        <input type="radio" name="smoking" value="occasionally" id="occasionally"  class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->smoke == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="occasionally">Occasionally</label>
                        
                        <input type="radio" name="smoking" value="Yes" id="SmokingYes"  class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->smoke == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="SmokingYes">Yes</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->drink == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Drinking</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="drinking" value="No" id="DrinkingNo"  class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->drink == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="DrinkingNo">No</label>
                            
                        <input type="radio" name="drinking" value="Drinks Socially" id="Drinks-Socially"  class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->drink == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Drinks-Socially">Drinks Socially</label>
                        <input type="radio" name="drinking" value="Yes" id="DrinkingYes"  class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->drink == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="DrinkingYes">Yes</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php } ?>
			<?php if($row_field->dosh == 'Yes' || $row_field->star == 'Yes' || $row_field->rasi == 'Yes' || $row_field->birthtime == 'Yes' || $row_field->birthplace == 'Yes'){ ?>
            <h4 class="gt-margin-top-30 gt-text-Grey font-20 gt-margin-bottom-10"><i class="fa fa-moon-o gt-margin-right-10"></i>Horoscope Details</h4>
            <article class="gt-margin-bottom-25">
                <p>
                    We suggest our members to please insert your horoscope details even of you dont believe in it because our lots of members interested in this detail.
                </p>
            </article>
			<?php if($row_field->dosh == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Have Dosh?</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <div>
                            <label for="doshNo" class="gt-inline-block">
                                <span class="pull-left gt-margin-right-10">
                                    <input type="radio" name="dosh" value="No" id="doshNo" class="gt-margin-top-0" onClick="check_dosh('No')">
                                </span>
                                <span class="pull-left font-14 gt-font-weight-500">No</span>
                            </label>
                            <label for="doshYes" class="gt-inline-block gt-margin-left-18">
                                <span class="pull-left gt-margin-right-10 ">
                                    <input type="radio" name="dosh" value="Yes" id="doshYes" class="gt-margin-top-0" onClick="check_dosh('Yes')">
                                </span>
                                <span class="pull-left font-14 gt-font-weight-500">Yes</span>
                            </label>
                            <label for="doshDontNo" class="gt-inline-block gt-margin-left-18">
                                <span class="pull-left gt-margin-right-10 ">
                                    <input type="radio" name="dosh" value="" id="doshDontNo" class="gt-margin-top-0" onClick="check_dosh('0')">
                                </span>
                                <span class="pull-left font-14 gt-font-weight-500">Don't know</span>
                            </label>
                        </div>
                        <div class="row gt-margin-top-15" id="dosh_display">
                            <div>
                                <label for="Manglik" class="gt-inline-block col-xs-4">
                                    <span class="pull-left gt-margin-right-10">
                                        <input type="checkbox" value="Manglik" id="Manglik" class="gt-margin-top-0" name="manglik[]">
                                    </span>
                                    <span class="pull-left font-14 gt-font-weight-500">Manglik</span>
                                </label>
                                <label for="Sarpa-dosh" class="gt-inline-block col-xs-5">
                                    <span class="pull-left gt-margin-right-10">
                                        <input type="checkbox" value="Sarpa-dosh" id="Sarpa-dosh" class="gt-margin-top-0" name="manglik[]">
                                    </span>
                                    <span class="pull-left font-14 gt-font-weight-500">Sarpa dosh</span>
                                </label>
                                <label for="Kala-sarpa-dosh" class="gt-inline-block col-xs-5">
                                    <span class="pull-left gt-margin-right-10">
                                        <input type="checkbox" value="Kala-sarpa-dosh" id="Kala-sarpa-dosh" class="gt-margin-top-0" name="manglik[]">
                                    </span>
                                    <span class="pull-left font-14 gt-font-weight-500">Kala sarpa dosh</span>
                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <div>
                               <label for="Rahu-dosh" class="gt-inline-block col-xs-4">
                                    <span class="pull-left gt-margin-right-10">
                                        <input type="checkbox" value="Rahu-dosh" id="Rahu-dosh" class="gt-margin-top-0" name="manglik[]">
                                    </span>
                                    <span class="pull-left font-14 gt-font-weight-500">Rahu dosh</span>
                                </label>
                                <label for="Kethu-dosh" class="gt-inline-block col-xs-5">
                                    <span class="pull-left gt-margin-right-10">
                                        <input type="checkbox" value="Kethu-dosh" id="Kethu-dosh" class="gt-margin-top-0" name="manglik[]">
                                    </span>
                                    <span class="pull-left font-14 gt-font-weight-500">Kethu dosh</span>
                                </label>
                                <label for="Kalathra-dosh" class="gt-inline-block col-xs-5">
                                    <span class="pull-left gt-margin-right-10">
                                        <input type="checkbox" value="Kalathra-dosh" id="Kalathra-dosh" class="gt-margin-top-0" name="manglik[]">
                                    </span>
                                    <span class="pull-left font-14 gt-font-weight-500">Kalathra dosh</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->star == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Star</b>
                        </label>
                    </div>
                    <div class="col-xxl-7 col-xs-16 col-lg-7">
                        <select class="gt-form-control" id="star" name="star" >
                            <option value="">
                                Select Your Star 
                            </option>
                            <option value="Ashvini">Ashvini</option>
                            <option value="Bharani">Bharani</option>
                            <option value="Krittika">Krittika</option>
                            <option value="Rohini">Rohini</option>
                            <option value="Mrigashirsha">Mrigashirsha</option>
                            <option value="Ardra">Ardra</option>
                            <option value="Punarvasu">Punarvasu</option>
                            <option value="Pushya">Pushya</option>
                            <option value="Ashlesha">Ashlesha</option>
                            <option value="Magha">Magha</option>
                            <option value="Purva Phalguni">Purva Phalguni</option>
                            <option value="Uttara Phalguni">Uttara Phalguni</option>
                            <option value="Hasta">Hasta</option>
                            <option value="Chitra">Chitra</option>
                            <option value="Swati">Swati</option>
                            <option value="Vishakha">Vishakha</option>
                            <option value="Anuradha">Anuradha</option>
                            <option value="Jyeshtha">Jyeshtha</option>
                            <option value="Mula">Mula</option>
                            <option value="Purva Ashadha">Purva Ashadha</option>
                            <option value="Uttara Ashadha">Uttara Ashadha</option>
                            <option value="Shravana">Shravana</option>
                            <option value="Dhanishtha">Dhanishtha</option>
                            <option value="Shatabhisha">Shatabhisha</option>
                            <option value="Purva Bhadrapada">Purva Bhadrapada</option>
                            <option value="Uttara Bhadrapada">Uttara Bhadrapada</option>
                            <option value="Revati">Revati</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->rasi == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Raasi/moon sign</b>
                        </label>
                    </div>
                    <div class="col-xxl-7 col-xs-16 col-lg-7">
                        <select class="gt-form-control" name="raasi">
                            <option value="">
                                Select  Your Related Raasi/moon sign
                            </option>
                            <option value="Does not matter">Does not matter</option>
                            <option value="Mesh (Aries)">Mesh (Aries)</option>
                            <option value="Vrishabh (Taurus)">Vrishabh (Taurus)</option>
                            <option value="Mithun (Gemini)">Mithun (Gemini)</option>
                            <option value="Karka (Cancer)">Karka (Cancer)</option>
                            <option value="Simha (Leo)">Simha (Leo)</option>
                            <option value="Kanya (Virgo)">Kanya (Virgo)</option>
                            <option value="Tula (Libra)">Tula (Libra)</option>
                            <option value="Vrischika (Scorpio)">Vrischika (Scorpio)</option>
                            <option value="Dhanu (Sagittarious)">Dhanu (Sagittarious)</option>
                            <option value="Makar (Capricorn)">Makar (Capricorn)</option>
                            <option value="Kumbha (Aquarious)">Kumbha (Aquarious)</option>
                            <option value="Meen (Pisces)">Meen (Pisces)</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->birthtime == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Birth Time</b>
                        </label>
                    </div>
                    <div class="col-xxl-7 col-xs-16 col-lg-7">
                        <select name="birth_time" class="gt-form-control">
                            <?php
                            for ($i = 12; $i > 0; $i--) {
                                for ($j = 0; $j < 60; $j++) {
                                    if (strlen($j) == '1') {
                                        $k = '0' . $j;
                                    } else {
                                        $k = $j;
                                    }
                                    ?>
                                    <option value="<?php echo $i . ":" . $k . " am"; ?>"><?php echo $i . ":" . $k . " am"; ?></option>	
                                    <?php
                                }
                            }
                            ?>
                            <?php
                            for ($i = 12; $i > 0; $i--) {
                                for ($j = 0; $j < 60; $j++) {
                                    if (strlen($j) == '1') {
                                        $k = '0' . $j;
                                    } else {
                                        $k = $j;
                                    }
                                    ?>
                                    <option value="<?php echo $i . ":" . $k . " pm"; ?>"><?php echo $i . ":" . $k . " pm"; ?></option>	
                                    <?php
                                }
                            }
                            ?>
                        </select>	
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->birthplace == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Birth Place</b>
                        </label>
                    </div>
                    <div class="col-xxl-7 col-xs-16 col-lg-7">
                        <input type="text" name="birthplace" class="gt-form-control valid" placeholder="Enter Your Birth Place">
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php } ?>
			
			<?php if($row_field->family_status == 'Yes' || $row_field->family_type == 'Yes' || $row_field->family_value == 'Yes' || $row_field->father_occupation == 'Yes' || $row_field->mother_occupation == 'Yes' || $row_field->no_of_brother == 'Yes' || $row_field->no_of_married_brother == 'Yes' || $row_field->no_of_sister == 'Yes' || $row_field->no_of_married_sister == 'Yes'){ ?>
            <h4 class="gt-margin-top-30 gt-text-Grey font-20 gt-margin-bottom-30"><i class="fa fa-users gt-margin-right-10"></i>Family Profile</h4>
			<?php if($row_field->family_status == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Family status</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="family_status" value="Middle class" id="Middle-class" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Middle-class">Middle class</label>
                           
                        <input type="radio" name="family_status" value="Upper middle class" id="Upper-middle-class" class="gt-margin-top-0 pull-left gt-padding-right-10"  <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Upper-middle-class">Upper middle class</label>
                         
                        <input type="radio" name="family_status" value="Rich" id="Rich" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Rich">Rich</label>
                        
                        <input type="radio" name="family_status" value="Affluent" id="Affluent" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->family_status == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Affluent">Affluent</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->family_type == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Family type</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="family_type" value="Joint" id="Joint" class="gt-margin-top-0 pull-left gt-padding-right-10"  <?php if($row_field->family_type == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Joint">Joint</label>
                            
                        <input type="radio" name="family_type" value="Nuclear" id="Nuclear" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->family_type == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Nuclear">Nuclear</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->family_value == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Family value</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="family_values" value="Orthodox" id="Orthodox" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Orthodox">Orthodox</label>
                        
                        <input type="radio" name="family_values" value="Traditional" id="Traditional" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Traditional">Traditional</label>
                        <div class="clearfix visible-xs visible-sm"></div>
                        <input type="radio" name="family_values" value="Moderate" id="Moderate" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?> >
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Moderate">Moderate</label>
                        
                        <input type="radio" name="family_values" value="Liberal" id="Liberal" class="gt-margin-top-0 pull-left gt-padding-right-10" <?php if($row_field->family_value == 'Yes'){ ?> data-validetta="required" <?php } ?>>
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Liberal">Liberal</label>
                   </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->father_occupation == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Father Occupation</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
						<input type="text" name="father_occupation" value="" class="gt-form-control valid" placeholder="Enter Father Occupation">
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->mother_occupation == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Mother Occupation</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">

                        <input type="text" name="mother_occupation" value="" class="gt-form-control valid" placeholder="Enter Mother Occupation">
                    </div>
                </div>
            </div>
			<?php } ?> 
			<?php if($row_field->no_of_brother == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>No. of Brothers </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="no_of_brothers" class="gt-form-control" onchange="check_brother_sister('brother', this.value)" >
							<option value="No Brother">No Brother</option>
                            <option value="1 Brother">1 Brother</option>
                            <option value="2 Brothers">2 Brothers</option>
                            <option value="3 Brothers">3 Brothers</option>
                            <option value="4 Brothers">4 Brothers</option>
                            <option value="4 + Brothers">4 + Brothers</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->no_of_married_brother == 'Yes'){ ?>
            <div class="form-group" id="brothers_married_status">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Married Brothers </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="no_of_marri_brothers" class="gt-form-control" >
                            <option value="No married brother">No married brother</option>
                            <option value="1 married brother">1 married brother</option>
                            <option value="2 married brothers">2 married brothers</option>
                            <option value="3 married brothers">3 married brothers</option>
                            <option value="4 married brothers">4 married brothers</option>
                            <option value="4 + married brothers">4+ married brothers</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->no_of_sister == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>No. of Sisters </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="no_of_sisters" class="gt-form-control" onchange="check_brother_sister('sister', this.value)">
                            <option value="No Sister">No Sister</option>
                            <option value="1 Sister">1 Sister</option>
                            <option value="2 Sisters">2 Sisters</option>
                            <option value="3 Sisters">3 Sisters</option>
                            <option value="4 Sisters">4 Sisters</option>
                            <option value="4 + Sisters">4 + Sisters</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->no_of_married_sister == 'Yes'){ ?>
            <div class="form-group" id="sisters_married_status">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Married Sisters </b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="no_of_marri_sister" class="gt-form-control" >
							<option value="No married sister">No married sister</option>
                            <option value="1 married sister">1 married sister</option>
                            <option value="2 married sisters">2 married sisters</option>
                            <option value="3 married sisters">3 married sisters</option>
                            <option value="4 married sisters">4 married sisters</option>
                            <option value="4+ married sisters">4+ married sisters</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php } ?>
			
			<?php if($row_field->profile_text == 'Yes'){ ?>
            <h4 class="gt-margin-top-30 gt-text-Grey font-20 gt-margin-bottom-10"><i class="fa fa-pencil gt-margin-right-10"></i>Something About You </h4>
            <article class="gt-margin-bottom-30">
                <p>
                    Write some of about you.for example which kind of person you are ,about your <b>Personality</b>,<b>Hobbies</b>,<b>About your family</b> ect.
                </p>
            </article>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Something About You</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <textarea class="gt-form-control" rows="5" cols="5" name="profile_text" data-validetta="required,minLength[50]"></textarea>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group text-center">
                <input type="checkbox" name="chk_terms" checked> <span class="gt-margin-left-10">I read all <a href="cms?cms_id=6" target="_blank">Privacy Policy</a> and agreed with <a href="cms?cms_id=7" target="_blank">Terms & Condition</a>.</span> 
            </div>
            <div class="form-group text-center col-xxl-offset-3">
                <input type="submit" name="submit" id="submit" value="Continue" class="btn gt-btn-green gt-btn-xxl">
            </div>	
		</form>
    </div>
    <div class="col-xxl-5">
        <div class="gtRegisterBucket text-center gt-margin-top-30">
            <i class="fa fa-mobile index-color-1"></i>
            <h4 class="index-color-1">Mobile Verified Profiles</h4>
        </div>
        <div class="gtRegisterBucket text-center">
            <i class="fa fa-users index-color-2"></i>
            <h4 class="index-color-2">Many Happy Couples</h4>
        </div>
        <div class="gtRegisterBucket text-center">
            <i class="fa fa-check index-color-3"></i>
            <h4 class="index-color-3">Most Trusted Matrimony</h4>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(e) {

        $('#dis_child').hide();
        $('#dosh_display').hide();
        $('#dis_child_status').hide();
        $('#brothers_married_status').hide();
        $('#sisters_married_status').hide();
        $("#status1").html('<img src="img/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
        var id = '<?php echo $reg_country; ?>';
        var dataString = 'id=' + id;
        $.ajax({
            type: "post",
            url: "ajax_country_state",
            data: dataString,
            cache: false,
            success: function(html) {
                $("#state").html(html);
                $("#status1").html('');
				$("#state").trigger("chosen:updated");
            }
        });

    });
	function check_brother_sister(child, status) {
        if (child == 'brother' && status != "" && status != "No Brothers"){
            $('#brothers_married_status').show();
        }
        if (child == 'sister' && status != "" && status != "No Sisters"){
            $('#sisters_married_status').show();
        }
    }
    /*function check_brother_sister(child, status) {
        if (child == 'brother' && status != "No Brother" && status !=''){
            $('#brothers_married_status').show();
        }else{
			$('#brothers_married_status').hide();
		}
        if (child == 'sister' && status != "No Sister" && status !=''){
            $('#sisters_married_status').show();
        }else{
			$('#sisters_married_status').hide();
		}
    }*/
    function check_ststus(status) {
        if (status == 'never-married'){
            $('#dis_child').hide();
            $('#dis_child_status').hide();
        }
        if (status == 'widower'){
            $('#dis_child').show();
        }
        if (status == 'widow'){
            $('#dis_child').show();
        }
		if (status == 'divorced'){
            $('#dis_child').show();
        }
	
        if (status == 'awaiting-divorce'){
            $('#dis_child').show();
        }
    }
    function check_dosh(status){
        if (status == 'No'){
            $('#dosh_display').hide();
        }
        if (status == 'Yes'){
            $('#dosh_display').show();
        }
        if (status == '0'){
            $('#dosh_display').hide();
        }
     }

    function check_child(val){
        if (val != '0' && val != ''){
            $('#dis_child_status').show();
        } else {
            $('#dis_child_status').hide();
        }
    }
    $(document).ready(function() {
        $("#bodytype-alert").hide();
        $("#complexion-alert").hide();
        $("#physicalStatus-alert").hide();
        $("#employedin-alert").hide();
        $("#smoking-alert").hide();
        $("#diet-alert").hide();
        $("#drinking-alert").hide();
        $("#family_status-alert").hide();
        $("#family_type-alert").hide();
        $("#family_values-alert").hide();
        $("#submit").click(function() {
            if ($("input[name=bodytype]:checked").length == 0) {
                $("#bodytype-alert").show();
            } else {
                $("#bodytype-alert").hide();
            }
            if ($("input[name=complexion]:checked").length == 0) {
                $("#complexion-alert").show();
            } else {
                $("#complexion-alert").hide();
            }
            if ($("input[name=physicalStatus]:checked").length == 0) {
                $("#physicalStatus-alert").show();
            } else {
                $("#physicalStatus-alert").hide();
            }
            if ($("input[name=employedin]:checked").length == 0) {
                $("#employedin-alert").show();
            } else {
                $("#employedin-alert").hide();
            }
            if ($("input[name=diet]:checked").length == 0) {
                $("#diet-alert").show();
            } else {
                $("#diet-alert").hide();
            }
            if ($("input[name=smoking]:checked").length == 0) {
                $("#smoking-alert").show();
            } else {
                $("#smoking-alert").hide();
            }
            if ($("input[name=drinking]:checked").length == 0) {
                $("#drinking-alert").show();
            } else {
                $("#drinking-alert").hide();
            }
            if ($("input[name=family_status]:checked").length == 0) {
                $("#family_status-alert").show();
            } else {
                $("#family_status-alert").hide();
            }
            if ($("input[name=family_type]:checked").length == 0) {
                $("#family_type-alert").show();
            } else {
                $("#family_type-alert").hide();
            }
            if ($("input[name=family_values]:checked").length == 0) {
                $("#family_values-alert").show();
            } else {
                $("#family_values-alert").hide();
            }
        });
    });
</script>
<!--<script>
		$('.valid').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault(alert('Spacial Character & Numbers Not Allowed.'));
       return false;	  
	}	
});
</script> -->
 <!--- CHOSEN JS --->
        <script src="js/chosen.jquery.js" type="text/javascript"></script>
        <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript">
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {allow_single_deselect: true},
                '.chosen-select-no-single': {disable_search_threshold: 10},
                '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                '.chosen-select-width': {width: "100%"}
            }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        </script>
        <!--- CHOSEN JS END--->