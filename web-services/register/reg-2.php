<?php
include_once '../../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$reg_caste = "";
$reg_email = "";

if (isset($_SESSION['reg_fnmae']) && $_SESSION['reg_fnmae'] != '') {
    $reg_caste = $_POST['caste'];
    $reg_email = $_POST['email'];

    if (isset($_SESSION['reg_password'])) {
        $reg_password = $_SESSION['reg_password'];
    } else {

        $reg_password = md5($_POST['password']);
    }
    $reg_country = $_POST['country'];
    $reg_bday = $_SESSION['reg_bday'];
    $reg_fnmae = $_POST['fname'];
    $reg_lnmae = $_POST['lname'];
    $reg_gender = trim($_SESSION['reg_gender']);
    $reg_m_tongue = $_POST['m_tongue'];
    $reg_code = $_SESSION['reg_code'];
    $reg_mobile = $_SESSION['reg_mobile'];
    $reg_profile_by = $_SESSION['reg_profile_by'];
    $reg_religion = $_POST['religion'];
    $fb_id = $_SESSION['fb_id'];
    $mstatus = $_POST['mstatus'];
    $birth_time = $_POST['birth_time'];
    $birthplace = $_POST['birthplace'];
    $no_child = isset($_POST['no_child']) ? $_POST['no_child'] : '';
    $child_status = isset($_POST['child_status']) ? $_POST['child_status'] : '';
	if($_POST['will_to_mary_caste'] != ''){
		$will_to_mary_caste= $_POST['will_to_mary_caste'];
	}else{
		$will_to_mary_caste="0";
	}
    $state = $_POST['state'];
    $city = $_POST['city'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bodytype = $_POST['bodytype'];
    $complexion = $_POST['complexion'];
    $physicalStatus = $_POST['physicalStatus'];
    $education = $_POST['education'];
    $other_education = $_POST['other_education'];
    $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : "";
	$subcaste = isset($_POST['subcaste']) ? $_POST['subcaste'] : "";
    $employedin = isset($_POST['employedin']) ? $_POST['employedin'] : "";
    $income = $_POST['income'];
    $diet = $_POST['diet'];
    $smoking = $_POST['smoking'];
    $drinking = $_POST['drinking'];
    $dosh = $_POST['dosh'];
    if (isset($_POST['manglik'])) {
        $manglik = implode(",", $_POST['manglik']);
    } else {
        $manglik = '';
    }
    $star = $_POST['star'];
    $raasi = $_POST['raasi'];
    $family_status = $_POST['family_status'];
    $family_type = $_POST['family_type'];
    $family_values = $_POST['family_values'];
    $father_occupation = $_POST['father_occupation'];
    $mother_occupation = $_POST['mother_occupation'];
    $profile_text = $_POST['profile_text'];
	$profile_text_date= date('H:i:s Y-m-d ');
    $no_of_brothers = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['no_of_brothers']);
    $no_of_marri_brothers = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['no_of_marri_brothers']);
    $no_of_sisters = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['no_of_sisters']);
    $no_of_marri_sister = mysqli_real_escape_string($DatabaseCo->dbLink, $_POST['no_of_marri_sister']);
    $status = 'Inactive';
    $ip = $_SERVER['REMOTE_ADDR'];
    //$ref=$_SERVER['HTTP_REFERER'];
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $tm = mktime(date('h') + 5, date('i') + 30, date('s'));
    $reg_date = date('Y-m-d h:i:s', $tm);
    $order_status = "No";
    $photo_protect = "No";
    $s = "select prefix from register";
    $rr = mysqli_query($DatabaseCo->dbLink, $s);
    $dd = mysqli_fetch_array($rr);
    $prefix = $dd['prefix'];
    $adminrole_id = '1';
    $adminrole_view_status = 'Yes';
    $s1 = "select matri_id from register where email='" . $_SESSION['reg_email'] . "'";
    $rr1 = $DatabaseCo->dbLink->query($s1);
   if (mysqli_num_rows($rr1) == '0') {
        $fname = $reg_fnmae;
        $lname = $reg_lnmae;
        $SQL_STATEMENT = $DatabaseCo->dbLink->query("insert into register (prefix,email,fb_id,password,gender,username,firstname,lastname,birthdate,religion,caste,subcaste,country_id,mobile,mobile_code,m_tongue,m_status,birthtime,birthplace,tot_children,status_children,will_to_mary_caste,state_id,city,height,weight,bodytype,complexion,physicalStatus,edu_detail,occupation,emp_in,income,diet,smoke,drink,dosh,manglik,star,moonsign,family_status,family_type,family_value,father_occupation,mother_occupation,profile_text,profile_text_approve,profile_text_date,no_of_brothers,no_of_sisters,no_marri_sister,no_marri_brother,status,ip,agent,adminrole_id,adminrole_view_status,reg_date,profileby,photo_view_status,photo_protect) values ('" . $prefix . "','" . $reg_email . "','" . $fb_id . "','" . $reg_password . "','" . $reg_gender . "','" . $fname . " " . $lname . "','" . $fname . "','" . $lname . "','" . $reg_bday . "','" . $reg_religion . "','" . $reg_caste . "','" . $subcaste . "','" . $reg_country . "','" . $reg_mobile . "','" . $reg_code . "','" . $reg_m_tongue . "','" . $mstatus . "','" . $birth_time . "','" . $birthplace . "','" . $no_child . "','" . $child_status . "','" . $will_to_mary_caste . "','" . $state . "','" . $city . "','" . $height . "','" . $weight . "','" . $bodytype . "','" . $complexion . "','" . $physicalStatus . "','" . $education . ',' . $other_education . "','" . $occupation . "','" . $employedin . "','" . $income . "','" . $diet . "','" . $smoking . "','" . $drinking . "','" . $dosh . "','" . $manglik . "','" . $star . "','" . $raasi . "','" . $family_status . "','" . $family_type . "','" . $family_values . "','" . $father_occupation . "','" . $mother_occupation . "','" . $profile_text . "','Pending','" . $profile_text_date . "','" . $no_of_brothers . "','" . $no_of_sisters . "','" . $no_of_marri_sister . "','" . $no_of_marri_brothers . "','" . $status . "','" . $ip . "','" . $agent . "','" . $adminrole_id . "','" . $adminrole_view_status . "','" . $reg_date . "','" . $reg_profile_by . "','1','No')");

        $MAX_INDEX_ID = mysqli_insert_id($DatabaseCo->dbLink);
        $_SESSION['matri_id_reg'] = $matri_id = $prefix . $MAX_INDEX_ID;
        function RandomPassword() {
            $chars = "abcdefghijkmnopqrstuvwxyz023456789";
            srand((double) microtime() * 1000000);
            $i = 0;
            $pass = '';

            while ($i <= 7) {
                $num = rand() % 33;
                $tmp = substr($chars, $num, 1);
                $pass = $pass . $tmp;
                $i++;
            }
            return $pass;
        }
        $pswd = RandomPassword();
        $upd = mysqli_query($DatabaseCo->dbLink, "update register set matri_id='" . $matri_id . "',prefix='" . $prefix . "',cpassword='$pswd' where index_id='$MAX_INDEX_ID'");
	   
	   $SQL_DELETE_FIRST = $DatabaseCo->dbLink->query("DELETE FROM first_form WHERE mobile_no='".$reg_mobile."' AND email_id='".$reg_email."'");
    }
    unset($_SESSION['reg_caste']);
    unset($_SESSION['reg_email']);
    unset($_SESSION['reg_password']);
    unset($_SESSION['reg_country']);
    unset($_SESSION['reg_bday']);
    unset($_SESSION['reg_fnmae']);
    unset($_SESSION['reg_gender']);
    unset($_SESSION['reg_m_tongue']);
    unset($_SESSION['reg_mobile']);
    unset($_SESSION['reg_profile_by']);
    unset($_SESSION['reg_religion']);
}

if (isset($_POST['chk_terms'])) {
    $matri_id = $_POST['matri_id'];
    $fname = isset($_POST['fname']) ? ucfirst(strtolower($_POST['fname'])) : '';
}

$SQL_STATEMENT_Mtongu = $DatabaseCo->dbLink->query("SELECT mtongue_id,mtongue_name FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC");
$SQL_STATEMENT_country = $DatabaseCo->dbLink->query("SELECT country_id,country_name FROM country WHERE status='APPROVED'");

/*-- Field Enable / Disable -- */
$SQL_STATEMENT_FIELD = $DatabaseCo->dbLink->query("SELECT part_physical_status,part_diet,part_drink,part_smoke,part_dosh,part_star,part_state,part_city,part_annual_income,part_expect FROM field_settings WHERE id='1'");
$row_field=mysqli_fetch_object($SQL_STATEMENT_FIELD);
?>
<script type="text/javascript">
    function check_ststus(status)
    {
      if (status == 'any'){
            $('#never-married').attr('checked', false);
            $('#widower').attr('checked', false);
            $('#divorced').attr('checked', false);
            $('#awaiting-divorce').attr('checked', false);
       }
        if (status == 'never-married'){
            $('#any-married').attr('checked', false);
        }
       if (status == 'widower'){
            $('#any-married').attr('checked', false);
        }
        if (status == 'divorced') {
            $('#any-married').attr('checked', false);
        }
        if (status == 'awaiting-divorce'){
            $('#any-married').attr('checked', false);
        }
    }

    function check_ststus_eat(status){
       if (status == 'doesnt-matter'){
            $('#vegetarian').attr('checked', false);
            $('#non-vegetarian').attr('checked', false);
            $('#eggetarian').attr('checked', false);
        }
        if (status == 'vegetarian'){
            $('#doesnt-matter').attr('checked', false);
        }
        if (status == 'non-vegetarian') {
            $('#doesnt-matter').attr('checked', false);
        }
        if (status == 'eggetarian'){
            $('#doesnt-matter').attr('checked', false);
        }
    }
    function check_ststus_smoke(status){
        if (status == 'doesnt-matter-smoke'){
            $('#never-smoke').attr('checked', false);
            $('#occasionally').attr('checked', false);
            $('#yes').attr('checked', false);
        }
        if (status == 'no'){
            $('#doesnt-matter-smoke').attr('checked', false);
        }
        if (status == 'occasionally'){
            $('#doesnt-matter-smoke').attr('checked', false);
        }
        if (status == 'yes'){
            $('#doesnt-matter-smoke').attr('checked', false);
        }
    }
    function check_ststus_drink(status){
        if (status == 'doesnt-matter-drink'){
            $('#never-drink').attr('checked', false);
            $('#drink-socially').attr('checked', false);
            $('#drink-yes').attr('checked', false);
        }
        if (status == 'no') {
            $('#doesnt-matter-drink').attr('checked', false);
        }
        if (status == 'drink-socially'){
            $('#doesnt-matter-drink').attr('checked', false);
        }
        if (status == 'drink-yes'){
            $('#doesnt-matter-drink').attr('checked', false);
        }
    }
</script>
<div class="container" id="top">
    <div class="row gt-margin-top-10">
        <div class="col-xxl-12 col-xxl-offset-2">
            <div class="row">
                <div class="col-xxl-14">
                    <h3 class="gt-text-green">
                        Tell some details about your life partner.
                    </h3>
                    <article>
                        <p>
                            Tell us which kind of life partner you want to marry and we will find for you.Just fill below details and step closer to your life partner.
                        </p>
                    </article>
                </div>
                <div class="col-xxl-2">
                    <img src="img/register-pref-img.png" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
    <div class="gtRegister col-xxl-12 col-xxl-offset-2" >
        <div class="row gt-margin-bottom-20">
            <img src="img/reg-step-2.png" class="img-responsive">
        </div>
        <form method="post" action="" name="reg_form_2" id="reg_form_2">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['matri_id_reg']; ?>">
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green gt-padding-bottom-10"><i class="fa fa-file-text gt-margin-right-10" ></i>Basic Preference</h3>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Age</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <div class="row">
                            <div class="col-xs-7">
                                <select class="gt-form-control" name="pfromage" data-validetta="required">
                                    <option value="" >- Age -</option>
                                    <option value="18">18 Years</option>
                                    <option value="19">19 Years</option>
                                    <option value="20" selected="selected">20 Years</option>
                                    <option value="21">21 Years</option>
                                    <option value="22">22 Years</option>
                                    <option value="23">23 Years</option>
                                    <option value="24">24 Years</option>
                                    <option value="25">25 Years</option>
                                    <option value="26">26 Years</option>
                                    <option value="27">27 Years</option>
                                    <option value="28">28 Years</option>
                                    <option value="29">29 Years</option>
                                    <option value="30">30 Years</option>
                                    <option value="31">31 Years</option>
                                    <option value="32">32 Years</option>
                                    <option value="33">33 Years</option>
                                    <option value="34">34 Years</option>
                                    <option value="35">35 Years</option>
                                    <option value="36">36 Years</option>
                                    <option value="37">37 Years</option>
                                    <option value="38">38 Years</option>
                                    <option value="39">39 Years</option>
                                    <option value="40">40 Years</option>
                                    <option value="41">41 Years</option>
                                    <option value="42">42 Years</option>
                                    <option value="43">43 Years</option>
                                    <option value="44">44 Years</option>
                                    <option value="45">45 Years</option>
                                    <option value="46">46 Years</option>
                                    <option value="47">47 Years</option>
                                    <option value="48">48 Years</option>
                                    <option value="49">49 Years</option>
                                    <option value="50">50 Years</option>
                                    <option value="51">51 Years</option>
                                    <option value="52">52 Years</option>
                                    <option value="53">53 Years</option>
                                    <option value="54">54 Years</option>
                                    <option value="55">55 Years</option>
                                    <option value="56">56 Years</option>
                                    <option value="57">57 Years</option>
                                    <option value="58">58 Years</option>
                                    <option value="59">59 Years</option>
                                    <option value="60">60 Years</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <h5 class="text-center">
                                    To
                                </h5>
                            </div>
                            <div class="col-xs-7">
                                <select class="gt-form-control" name="ptoage" data-validetta="required">
                                    <option value="" >- Age -</option>
                                    <option value="18">18 Years</option>
                                    <option value="19">19 Years</option>
                                    <option value="20">20 Years</option>
                                    <option value="21">21 Years</option>
                                    <option value="22">22 Years</option>
                                    <option value="23">23 Years</option>
                                    <option value="24">24 Years</option>
                                    <option value="25">25 Years</option>
                                    <option value="26">26 Years</option>
                                    <option value="27">27 Years</option>
                                    <option value="28">28 Years</option>
                                    <option value="29">29 Years</option>
                                    <option value="30" selected="selected">30 Years</option>
                                    <option value="31">31 Years</option>
                                    <option value="32">32 Years</option>
                                    <option value="33">33 Years</option>
                                    <option value="34">34 Years</option>
                                    <option value="35">35 Years</option>
                                    <option value="36">36 Years</option>
                                    <option value="37">37 Years</option>
                                    <option value="38">38 Years</option>
                                    <option value="39">39 Years</option>
                                    <option value="40">40 Years</option>
                                    <option value="41">41 Years</option>
                                    <option value="42">42 Years</option>
                                    <option value="43">43 Years</option>
                                    <option value="44">44 Years</option>
                                    <option value="45">45 Years</option>
                                    <option value="46">46 Years</option>
                                    <option value="47">47 Years</option>
                                    <option value="48">48 Years</option>
                                    <option value="49">49 Years</option>
                                    <option value="50">50 Years</option>
                                    <option value="51">51 Years</option>
                                    <option value="52">52 Years</option>
                                    <option value="53">53 Years</option>
                                    <option value="54">54 Years</option>
                                    <option value="55">55 Years</option>
                                    <option value="56">56 Years</option>
                                    <option value="57">57 Years</option>
                                    <option value="58">58 Years</option>
                                    <option value="59">59 Years</option>
                                    <option value="60">60 Years</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Height</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <div class="row">
                            <div class="col-xs-7">
                                <select class="gt-form-control" name="pfronheight" data-validetta="required"> 
                                    <option value="">From height</option>
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
                            <div class="col-xs-2">
                                <h5 class="text-center">
                                    To
                                </h5>
                            </div>
                            <div class="col-xs-7">
                                <select class="gt-form-control" name="ptoheight" data-validetta="required">
                                    <option value="">To height</option>
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
                        <input type="checkbox" name="pmstatus[]" value="any" id="any-married" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="minChecked[1]" onclick="check_ststus('any');">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="any-married">Any</label>
                        
                        <input type="checkbox" name="pmstatus[]" value="Never Married" id="never-married" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="minChecked[1]" onclick="check_ststus('never-married');">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="never-married">Never Married</label>
                        
                        <input type="checkbox" name="pmstatus[]" value="Widower" id="widower" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="minChecked[1]" onclick="check_ststus('widower');">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="widower">Widower</label>
                        <div class="clearfix visible-xs"></div>
                        
                        <input type="checkbox" name="pmstatus[]" value="Divorced" id="divorced" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="minChecked[1]" onclick="check_ststus('divorced');">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="divorced">Divorced</label>
                        
                        <input type="checkbox" name="pmstatus[]" value="Awaiting Divorce" id="awaiting-divorce" class="gt-margin-top-0 pull-left gt-padding-right-10" data-validetta="minChecked[1]" onclick="check_ststus('awaiting-divorce');">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="awaiting-divorce">Awaiting Divorce</label>
                    </div>
                </div>
            </div>
			<?php if($row_field->part_physical_status == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Physical status</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <input type="radio" name="p_physical" value="Normal" id="Normal" class="gt-margin-top-0 pull-left gt-padding-right-10">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Normal">Normal</label>
                        
                        <input type="radio" name="p_physical" value="Physically-challenged" id="Physically-challenged" class="gt-margin-top-0 pull-left gt-padding-right-10">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="Physically-challenged">Physically-challenged</label>
                        
                        <input type="radio" name="p_physical" value="Does Not Matter" id="doesntMatter" class="gt-margin-top-0 pull-left gt-padding-right-10">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="doesntMatter">Doesn't Matter</label>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->part_diet == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Eating Habits</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                       <input type="checkbox" name="p_diet[]" value="Vegetarian" id="vegetarian"  class="gt-margin-top-0 pull-left gt-padding-right-10" onclick="check_ststus_eat('vegetarian');">
                       <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="vegetarian">Vegetarian</label>
                            
                       <input type="checkbox" name="p_diet[]" value="Non-Vegetarian" id="non-vegetarian"  class="gt-margin-top-0 pull-left gt-padding-right-10" onclick="check_ststus_eat('non-vegetarian');">
                       <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="non-vegetarian">Non-Vegetarian</label>
                           
                       <input type="checkbox" name="p_diet[]" value="Eggetarian" id="eggetarian" class="gt-margin-top-0 pull-left gt-padding-right-10" onclick="check_ststus_eat('eggetarian');">
                       <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="eggetarian">Eggetarian</label>
                           
                       <input type="checkbox" name="p_diet[]" value="Does Not Matter" id="doesnt-matter" class="gt-margin-top-0 pull-left gt-padding-right-10" onclick="check_ststus_eat('doesnt-matter');">
                       <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="doesnt-matter">Doesn't Matter</label>
                     </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->part_drink == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Smoking Habits</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                      	<input type="checkbox" name="p_smoke[]" value="Does Not Matter" id="doesnt-matter-smoke"  class="gt-margin-top-0 pull-left gt-padding-right-10" onclick="check_ststus_smoke('doesnt-matter-smoke');">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="doesnt-matter-smoke">Doesn't Matter</label>
                            
                        <input type="checkbox" name="p_smoke[]" value="No" id="never-smoke"  class="gt-margin-top-0 pull-left gt-padding-right-10" onclick="check_ststus_smoke('never-smoke');">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="never-smoke">Never Smokes</label>
                        <div class="clearfix"></div>
                        <input type="checkbox" name="p_smoke[]" value="Smokes Occasionally" id="occasionally"  class="gt-margin-top-0 pull-left gt-padding-right-10" onclick="check_ststus_smoke('occasionally');">
                        <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="occasionally">Smokes Occasionally</label>
                         <input type="checkbox" name="p_smoke[]" value="Smokes Regularly" id="yes"  class="gt-margin-top-0 pull-left gt-padding-right-10" onclick="check_ststus_smoke('yes');">
                         <label class="pull-left font-14 gt-font-weight-500 gt-padding-left-5 gt-padding-right-10" for="yes">Smokes Regularly</label>
                           

                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->part_smoke == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Drinking Habits</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11 gt-margin-top-10">
                        <label for="DrinkingDoesnt" class="gt-inline-block gt-margin-left-5">
                            <span class="pull-left gt-margin-right-10 ">
                                <input type="checkbox" name="p_drink[]" value="Does Not Matter" id="doesnt-matter-drink" class="gt-margin-top-0" onclick="check_ststus_drink('doesnt-matter-drink');">
                            </span>
                            <span class="pull-left font-14 gt-font-weight-500">Doesn't Matter</span>
                        </label>
                        <label for="DrinkingNo" class="gt-inline-block">
                            <span class="pull-left gt-margin-right-10">
                                <input type="checkbox" name="p_drink[]" value="No" id="never-drink" class="gt-margin-top-0" onclick="check_ststus_drink('never-drink');">
                            </span>
                            <span class="pull-left font-14 gt-font-weight-500">Never Drinks</span>
                        </label>

                        <label for="Drinks-Socially" class="gt-inline-block gt-margin-left-5">
                            <span class="pull-left gt-margin-right-10 ">
                                <input type="checkbox" name="p_drink[]" value="Drinks Socially" id="drink-socially" class="gt-margin-top-0" onclick="check_ststus_drink('drink-socially');">
                            </span>
                            <span class="pull-left font-14 gt-font-weight-500">Drinks Socially</span>
                        </label>
                        <label for="DrinkingYes" class="gt-inline-block gt-margin-left-5">
                            <span class="pull-left gt-margin-right-10 ">
                                <input type="checkbox" name="p_drink[]" value="Drinks Regularly" id="drink-yes" class="gt-margin-top-0" onclick="check_ststus_drink('drink-yes');">
                            </span>
                            <span class="pull-left font-14 gt-font-weight-500">Drinks Regularly</span>
                        </label>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green gt-padding-bottom-10"><i class="fa fa-book gt-margin-right-10"></i>Religion Preference</h3>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Religion</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" name="preligion[]" id="preligion" data-placeholder="Choose Parteners Religion" multiple tabindex="4" data-validetta="required">

                            <option value="any">Any Religion</option>
                            <?php
                            $SQL_STATEMENT_religion = $DatabaseCo->dbLink->query("SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC");
                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_religion)) {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
                                <?php
                            }
                            ?>
                        </select><div id="caste1"></div>
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
                        <select class="chosen-select gt-form-control" name="pcaste[]" id="pcaste"  data-validetta="required" multiple>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->part_dosh == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-margin-top-10 gt-text-light-Grey">
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
			<?php if($row_field->part_star == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-margin-top-10 gt-text-light-Grey">
                            <b>Star</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" data-placeholder="Choose Parteners Star" id="p_star" name="p_star[]" multiple>
                            <option value="Any Star">Any Star</option>
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
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Mother Tongue</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="pmothertongue[]" data-placeholder="Choose Parteners Mothertongue" data-validetta="required" class="chosen-select gt-form-control" multiple>
                            <option value="Any Mother Tongue">Any Mother Tongue</option>
                            <?php
                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_Mtongu)) {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"><?php echo $DatabaseCo->dbRow->mtongue_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green gt-padding-bottom-10"><i class="fa fa-globe gt-margin-right-10"></i>Location Preference</h3>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Country living in</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="pcountry[]" data-placeholder="Choose partners country living in" class="chosen-select gt-form-control" multiple tabindex="4" data-validetta="required" id="pcountry" >
                           
                            <?php
                           	 while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_country)) {
                             ?>
                                <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                            <?php } ?>
                        </select>
                        <div id="pstate_div"></div>
                    </div>
                </div>
            </div>
			<?php if($row_field->part_state == 'Yes'){ ?>
            <div class="form-group" >
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Residing state</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" multiple name="pstate[]" id="pstate" data-placeholder="Choose partners state" >
                            <option value="">
                                Select Residing State
                            </option>
                        </select>
                        <div id="pcity_div" ></div>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->part_city == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b>Residing city</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" multiple name="pcity[]" id="pcity" data-placeholder="Choose partners city">
                            <option value="">
                                Select Residing City
                            </option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green gt-padding-bottom-10"><i class="fa fa-university gt-margin-right-10"></i>Professional Preference</h3>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Education</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="peducation[]" data-placeholder="Choose partners education" class="chosen-select gt-form-control flat" multiple tabindex="4" data-validetta="required">
                         	<option value="Any Education">Any Education</option>
                            <?php
                            $SQL_STATEMENT = "SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC";
                            $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                            while ($DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult)) {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div> 
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Occupation</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select name="poccupation[]" data-placeholder="Choose partners occupation" class="chosen-select gt-form-control flat" multiple tabindex="4" data-validetta="required">
                           <option value="Any Occupation">Any Occupation</option>
                            <?php
                            $SQL_STATEMENT_occupation = $DatabaseCo->dbLink->query("SELECT ocp_id,ocp_name FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC");
                            while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_occupation)) {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>"><?php echo $DatabaseCo->dbRow->ocp_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
			<?php if($row_field->part_annual_income == 'Yes'){ ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Annual Income</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <select class="chosen-select gt-form-control" data-placeholder="Choose partners Annual Income"  name="pannualincome[]" multiple data-validetta="required">
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
                            <option value="Does not matter">Does not matter</option>
                        </select>
                    </div>
                </div>
            </div>
			<?php } ?>
			<?php if($row_field->part_expect == 'Yes'){ ?>
            <div class="gt-margin-bottom-30 gt-margin-top-30">
                <h3 class="gt-text-green gt-padding-bottom-10"><i class="fa fa-user gt-margin-right-10"></i>Partners Exceptation</h3>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xxl-5 col-xs-16 col-lg-5">
                        <label class="gt-text-light-Grey">
                            <b class="text-danger gt-margin-right-5 gtRegMandatory">*</b><b>Partner Expectation</b>
                        </label>
                    </div>
                    <div class="col-xxl-11 col-xs-16 col-lg-11">
                        <textarea class="gt-form-control" rows="5" cols="5" name="p_expt" <?php if($row_field->part_expect == 'Yes'){ ?> data-validetta="required,minLength[50]" <?php } ?>></textarea>
                    </div>
                </div>
            </div>
			<?php } ?>
            <div class="form-group text-center">
                <div class="row">
                    <input type="submit" name="reg2sub" value="Continue" class="btn gt-btn-orange gt-btn-xxl" >
                </div>
            </div>
        </form>
    </div>
</div>
<script>
	window.location.hash = "top"; 
</script>

<script>
    function check_dosh(status)
    {
        if (status == 'No')
        {
            $('#dosh_display').hide();
        }
        if (status == 'Yes')
        {
            $('#dosh_display').show();
        }
        if (status == '0')
        {
            $('#dosh_display').hide();
        }
    }
	
</script>
