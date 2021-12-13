<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
include_once './parts/insert-exp.php';


if (isset($_SESSION['gender123'])) {
if ($_SESSION['gender123'] == 'Male') {
$gender = 'Female';
} else {
$gender = 'Male';
}
} elseif (isset($_POST['gender'])) {
$_SESSION['gender'] = $_POST['gender'];
$gender = $_SESSION['gender'];
} else {
$gender = $_SESSION['gender'];
}
// For Saved Search
if (isset($_GET['ss_id'])) {
$trans = array("(" => "", ")" => "", "-" => "", " " => "");
$ssgetid = mysqli_real_escape_string($DatabaseCo->dbLink, $_GET['ss_id']);
$ssgetid = strtr($ssgetid, $trans);
$ssid = mysqli_fetch_object($DatabaseCo->dbLink->query("select * from save_search where ss_id='" . $ssgetid . "' and matri_id='" . $_SESSION['user_id'] . "'"));
if ($ssid->fromage != '') {
$_SESSION['fromage'] = $ssid->fromage;
} else {
unset($_SESSION['fromage']);
}
if ($ssid->toage != '') {
$_SESSION['toage'] = $ssid->toage;
} else {
unset($_SESSION['toage']);
}
if ($ssid->from_height != '') {
$_SESSION['fromheight'] = $ssid->from_height;
} else {
unset($_SESSION['fromheight']);
}
if ($ssid->to_height != '') {
$_SESSION['toheight'] = $ssid->to_height;
} else {
unset($_SESSION['toheight']);
}
if ($ssid->marital_status != '') {
$_SESSION['m_status'] = $ssid->marital_status;
} else {
unset($_SESSION['m_status']);
}
if ($ssid->religion != '') {
$_SESSION['religion'] = $ssid->religion;
} else {
unset($_SESSION['religion']);
}
if ($ssid->caste != '') {
$_SESSION['caste'] = $ssid->caste;
} else {
unset($_SESSION['caste']);
}
if ($ssid->mother_tongue) {
$_SESSION['m_tongue'] = $ssid->mother_tongue;
} else {
unset($_SESSION['m_tongue']);
}
if ($ssid->education != '') {
$_SESSION['education'] = $ssid->education;
} else {
unset($_SESSION['education']);
}
if ($ssid->occupation != '') {
$_SESSION['occupation'] = $ssid->occupation;
} else {
unset($_SESSION['occupation']);
}
if ($ssid->country != '') {
$_SESSION['country'] = $ssid->country;
} else {
unset($_SESSION['country']);
}
if ($ssid->state != '') {
$_SESSION['state'] = $ssid->state;
} else {
unset($_SESSION['state']);
}
if ($ssid->city != '') {
$_SESSION['city'] = $ssid->city;
} else {
unset($_SESSION['city']);
}
if ($ssid->manglik != '') {
$_SESSION['manglik'] = $ssid->manglik;
} else {
unset($_SESSION['manglik']);
}
if ($ssid->keyword != '') {
$_SESSION['keyword'] = $ssid->keyword;
} else {
unset($_SESSION['keyword']);
}
if ($ssid->id_search != '') {
$_SESSION['id_search'] = $ssid->id_search;
} else {
unset($_SESSION['id_search']);
}
if ($ssid->with_photo != '') {
$_SESSION['photo_search'] = $ssid->with_photo;
} else {
unset($_SESSION['photo_search']);
}
if ($ssid->tot_children != '') {
$_SESSION['tot_children'] = $ssid->tot_children;
} else {
unset($_SESSION['tot_children']);
}
if ($ssid->annual_income != '') {
$_SESSION['annual_income'] = $ssid->annual_income;
} else {
unset($_SESSION['annual_income']);
}
if ($ssid->diet != '') {
$_SESSION['diet'] = $ssid->diet;
} else {
unset($_SESSION['diet']);
}
if ($ssid->drink != '') {
$_SESSION['drink'] = $ssid->drink;
} else {
unset($_SESSION['drink']);
}
if ($ssid->smoking != '') {
$_SESSION['smoking'] = $ssid->smoking;
} else {
unset($_SESSION['smoking']);
}
if ($ssid->complexion != '') {
$_SESSION['complexion'] = $ssid->complexion;
} else {
unset($_SESSION['complexion']);
}
if ($ssid->bodytype != '') {
$_SESSION['bodytype'] = $ssid->bodytype;
} else {
unset($_SESSION['bodytype']);
}
if ($ssid->star != '') {
$_SESSION['star'] = $ssid->star;
} else {
unset($_SESSION['star']);
}
}
// End Here - Saved Search
if (isset($_POST['fromage']) && $_POST['fromage'] != '') {
$_SESSION['fromage'] = $_POST['fromage'];
$t3 = $_SESSION['fromage'];
} elseif (isset($_SESSION['fromage'])) {
$t3 = $_SESSION['fromage'];
} else {
$t3 = '';
}
if (isset($_POST['toage']) && $_POST['toage'] != '') {
$_SESSION['toage'] = $_POST['toage'];
$t4 = $_SESSION['toage'];
} elseif (isset($_SESSION['toage'])) {
$t4 = $_SESSION['toage'];
} else {
$t4 = '';
}
if (isset($_POST['religion']) && $_POST['religion'] != '') {
$_SESSION['religion'] = implode(',', $_POST['religion']);
$religion123 = $_SESSION['religion'];
} elseif (isset($_SESSION['religion'])) {
$religion123 = $_SESSION['religion'];
} else {
$religion123 = '';
}
if (isset($_SESSION['caste'])) {
$caste123 = $_SESSION['caste'];
} else {
$caste123 = '';
}
if (isset($_SESSION['m_tongue'])) {
	$m_tongue123 = $_SESSION['m_tongue'];
} else {
	$m_tongue123 = '';
}
if (isset($_POST['fromheight']) && $_POST['fromheight'] != '') {
$fromheight = $_POST['fromheight'];
$_SESSION['fromheight'] = $fromheight;
} elseif (isset($_SESSION['fromheight'])) {
$fromheight = $_SESSION['fromheight'];
} else {
$fromheight = '';
}
if (isset($_POST['toheight']) && $_POST['toheight'] != '') {
$toheight = $_POST['toheight'];
$_SESSION['toheight'] = $toheight;
} elseif (isset($_SESSION['toheight'])) {
$toheight = $_SESSION['toheight'];
} else {
$toheight = '';
}
if (isset($_POST['m_status']) && $_POST['m_status'] != '') {
$mstatus123 = implode(',', $_POST['m_status']);
$_SESSION['m_status'] = $mstatus123;
} elseif (isset($_SESSION['m_status'])) {
$mstatus123 = $_SESSION['m_status'];
} else {
$mstatus123 = '';
}
if (isset($_POST['physical_status']) && $_POST['physical_status'] != '') {
$physical_status = implode(',', $_POST['physical_status']);
$_SESSION['physical_status'] = $physical_status;
} elseif (isset($_SESSION['physical_status'])) {
$physical_status = $_SESSION['physical_status'];
} else {
$physical_status = '';
}
if (isset($_SESSION['education'])) {
$education123 = $_SESSION['education'];
} else {
$education123 = '';
}
if (isset($_SESSION['occupation'])) {
$occupation = $_SESSION['occupation'];
} else {
$occupation = '';
}
if (isset($_SESSION['country'])) {
$country123 = $_SESSION['country'];
} elseif (isset($_POST['country'])) {
$_SESSION['country'] = $_POST['country'];
$country123 = $_SESSION['country'];
} else {
$country123 = '';
}
if (isset($_SESSION['state'])) {
$state123 = $_SESSION['state'];
} else {
$state123 = '';
}
if (isset($_SESSION['city'])) {
$city123 = $_SESSION['city'];
} else {
$city123 = '';
}
if (isset($_SESSION['manglik'])) {
$manglik = $_SESSION['manglik'];
} else {
$manglik = '';
}
if (isset($_SESSION['keyword'])) {
$keyword = $_SESSION['keyword'];
} else {
$keyword = '';
}
if (isset($_SESSION['user_id'])) {
$mid = $_SESSION['user_id'];
} else {
$mid = '';
}
if (isset($_SESSION['photo_search'])) {
$photo_search = $_SESSION['photo_search'];
} else {
$photo_search = '';
}
if (isset($_SESSION['profile_latest_register'])) {
$profile_latest_register = $_SESSION['profile_latest_register'];
} else {
$profile_latest_register = '';
}
if (isset($_SESSION['tot_children'])) {
$tot_children = $_SESSION['tot_children'];
} else {
$tot_children = '';
}
if (isset($_SESSION['annual_income'])) {
$annual_income = $_SESSION['annual_income'];
} else {
$annual_income = '';
}
if (isset($_SESSION['diet'])) {
$diet = $_SESSION['diet'];
} else {
$diet = '';
}
if (isset($_SESSION['drink'])) {
$drink = $_SESSION['drink'];
} else {
$drink = '';
}
if (isset($_SESSION['smoking'])) {
$smoking = $_SESSION['smoking'];
} else {
$smoking = '';
}
if (isset($_SESSION['complexion'])) {
$complexion = $_SESSION['complexion'];
} else {
$complexion = '';
}
if (isset($_SESSION['bodytype'])) {
$bodytype = $_SESSION['bodytype'];
} else {
$bodytype = '';
}
if (isset($_SESSION['star'])) {
$star = $_SESSION['star'];
} else {
$star = '';
}
if (isset($_POST['id_search'])) {
$txt_id_search = $_POST['id_search'];
$_SESSION['id_search'] = $txt_id_search;
}
if (isset($_SESSION['id_search'])) {
$txt_id_search = $_SESSION['id_search'];
} else {
$txt_id_search = '';
}
?>
<?php
if ($_SESSION['gender123'] == 'Male') {
$my_gender = 'Male';
} else {
$my_gender = 'Female';
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
      <div class="container gt-margin-top-15">
        <div class="row">
          <aside class="col-xxl-4 col-xl-4 col-xs-16">
            <div class="gt-panel gt-panel-orange">
              <div class="gt-panel-head gt-margin-bottom-15 gt-border-radius-5">
                <div class="panel-title text-center">
                  <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="gt-refine">
                    <i class="fa fa-filter gt-margin-right-10">
                    </i>Refine Search 
                    <i class="fa fa-caret-down gt-margin-left-10">
                    </i>
                  </a>
                </div>
              </div>
              <?php include("refine-search.php"); ?>
            </div>
          </aside>
          <div class="col-xxl-12 col-xl-12 col-xs-16 gt-search-result" id="result">
            <h3 class="gt-margin-top-10">
              Your search results
            </h3>
            <div id="loaderID" style="position:fixed;  left:50%; top:50%; z-index:-1; opacity:0">
              <div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-orange">
                <font class="gt-margin-left-5">Loding ...&nbsp;&nbsp;
                </font>
              </div>
            </div>	
            <ul id="pagination"></ul>  
          </div>      
        </div>
      </div>
      <?php include "parts/footer-before-login.php"; ?>
    </div>
    <!------------------------------------------jQuery------------------------------------------------->
    <script src="js/jquery.min.js">
    </script>
    <!------------------------------------------jQuery End--------------------------------------------->
    <!------------------------------------------bootstrap and green js--------------------------------->
    <script src="js/bootstrap.js">
    </script>
    <script src="js/jquery.validate.js">
    </script>
    <script src="js/green.js">
    </script>
    <!-------------------------------------bootstrap and green js End--------------------------------->
    <script>
      $(document).ready(function() {
        $('#body').show();
        $('.preloader-wrapper').hide();
      }
                       );
    </script>
    <script>
      (function($) {
        var $window = $(window),
            $html = $('.gt-filter-result.in');
        function resize() {
          if ($window.width() > 767) {
            return $html.addClass('in');
          }
          $html.removeClass('in');
        }
        $window
          .resize(resize)
          .trigger('resize');
      }
      )(jQuery);
    </script>
  </body>
</html>                                                                                                                              
<?php include'thumbnailjs.php'; ?>                  
<script type="text/javascript">
  $(document).ready(function() {
    var dataString = 'photo_search=' + '<?php echo $photo_search; ?>' + '&profile_latest_register=' + <?php echo $profile_latest_register;
    ?> + '&manglik=' + '<?php echo $manglik; ?>' + '&tot_children=' + '<?php echo $tot_children; ?>' + '&annual_income=' + '<?php echo $annual_income; ?>' + '&id_search=' + '<?php echo $txt_id_search; ?>' + '&diet=' + '<?php echo $diet; ?>' + '&drink=' + '<?php echo $drink; ?>' + '&smoking=' + '<?php echo $smoking; ?>' + '&complexion=' + '<?php echo $complexion; ?>' + '&bodytype=' + '<?php echo $bodytype; ?>' + '&star=' + '<?php echo $star; ?>' + '&religion=' + '<?php echo $religion123; ?>' + '&caste=' + '<?php echo $caste123; ?>' + '&t3=' + '<?php echo $t3; ?>' + '&t4=' + '<?php echo $t4; ?>' + '&fromheight=' + '<?php echo $fromheight; ?>' + '&toheight=' + '<?php echo $toheight; ?>' + '&state=' + '<?php echo $state123; ?>' + '&city=' + '<?php echo $city123; ?>' + '&keyword=' + '<?php echo $keyword; ?>' + '&occupation=' + '<?php echo $occupation; ?>' + '&country=' + '<?php echo $country123; ?>' + '&gender=' + '<?php echo $gender; ?>' + '&m_status=' + '<?php echo $mstatus123; ?>' + '&physical_status=' + '<?php echo $physical_status; ?>' + '&m_tongue=' + '<?php echo $m_tongue123; ?>' + '&education=' + '<?php echo $education123; ?>' + '&orderby=' + '<?php echo $occupation; ?>' + '&actionfunction=showData' + '&page=1';
    $("#loaderID").css("opacity", 1);
    $("#loaderID").css("z-index", 9999);
    $.ajax({
      url: "dbmanupulate2",
      type: "POST",
      data: dataString,
      cache: false,
      success: function(response)
      {
        $("#loaderID").css("opacity", 0);
        $("#loaderID").css("z-index", -1);
        $('#pagination').html(response);
      }
    }
          );
    $('#pagination').on('click', '.page-numbers', function() {
      $("#loaderID").css("opacity", 1);
      $("#loaderID").css("z-index", 9999);
      $page = $(this).attr('href');
      $pageind = $page.indexOf('page=');
      $page = $page.substring(($pageind + 5));
      var dataString = '&actionfunction=showData' + '&page=' + $page;
      $.ajax({
        url: "dbmanupulate2",
        type: "POST",
        data: dataString,
        cache: false,
        success: function(response)
        {
          $("#loaderID").css("opacity", 0);
          $("#loaderID").css("z-index", -1);
          $('#pagination').html(response);
        }
      }
            );
      return false;
    }
                       );
  }
                   )
</script>
<script type="text/javascript">
  function clearage()
  {
    $('select[name="from_age"]').find(":selected").attr('selected', false);
    $('select[name="to_age"]').find(":selected").attr('selected', false);
    $("#frm_filter").trigger('change');
  }
  function clearheight()
  {
    $('select[name="from_height"]').find(":selected").attr('selected', false);
    $('select[name="to_hight"]').find(":selected").attr('selected', false);
    $("#frm_filter").trigger('change');
  }
  function clearmstatus()
  {
    $('input[name="m_status"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
  }
  function clearreligion()
  {
    $('input[name="religion"]:checked').attr('checked', false);
    $('input[name="caste_id"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
    $('#getcaste').hide();
  }
  function clearcaste()
  {
    $('input[name="caste_id"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
  }
  function clearcountry()
  {
    $('input[name="country"]:checked').attr('checked', false);
    $('input[name="state_id"]:checked').attr('checked', false);
    $('input[name="city_id"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
    $('#getstate').hide();
    $('#getcity').hide();
  }
  function clearstate()
  {
    $('input[name="state_id"]:checked').attr('checked', false);
    $('input[name="city_id"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
    $('#getcity').hide();
  }
  function clearcity()
  {
    $('input[name="city_id"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
  }
  function cleareducation()
  {
    $('input[name="education"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
  }
  function clearoccupation()
  {
    $('input[name="occupation"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
  }
  function clearincome()
  {
    $('select[name="annual_income"]').find(":selected").attr('selected', false);
    $("#frm_filter").trigger('change');
  }
  function clearphoto()
  {
    $('input[name="photo_search"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
  }
  function clearprofilelatestreg()
  {
    $('input[name="profile_latest_register"]:checked').attr('checked', false);
    $("#frm_filter").trigger('change');
  }
  <?php if ($religion123 == '') {
    ?>
      $('#getcaste').hide();
    <?php
  }
  else if ($caste123 != '') {
    ?>
      <?php
  }
  if ($country123 == '') {
    ?>
      $('#getstate').hide();
    <?php
  }
  if ($city123 == '') {
    ?>
      $('#getcity').hide();
    <?php
  }
  ?>
    $('input[name="religion"]').click(function() {
    var selectedReligion = new Array();
    var selectedsearch = new Array();
    $('input[name="religion"]:checked').each(function() {
      selectedReligion.push(this.value);
    }
                                            );
    if (selectedReligion == '')
    {
      $('#getcaste').hide();
    }
    else {
      jQuery.ajax({
        type: "POST", // HTTP method POST or GET
        url: "getcastesearch", //Where to make Ajax calls
        dataType: "text", // Data type, HTML, json etc.
        data: 'religion_id=' + selectedReligion,
        success: function(response)
        {
          $("#getcaste").show();
          $("#loaderID").css("opacity", 0);
          $("#left-panel-5").html('');
          $("#left-panel-5").append(response);
          var options = {
            valueNames: ['name', 'born']
          };
          var userList = new List('users_caste', options);
        }
        ,
      }
                 );
    }
  }
                                     );
  $('input[name="country"]').click(function() {
    var selectedCountry = new Array();
    $('input[name="country"]:checked').each(function() {
      selectedCountry.push(this.value);
    }
                                           );
    if (selectedCountry == '')
    {
      $('#getstate').hide();
      $('#getcity').hide();
    }
    else
    {
      jQuery.ajax({
        type: "POST", // HTTP method POST or GET
        url: "getstatesearch", //Where to make Ajax calls
        dataType: "text", // Data type, HTML, json etc.
        data: 'country_id=' + selectedCountry,
        success: function(response)
        {
          $('#getcity').hide();
          $("#getstate").show();
          $("#loaderID").css("opacity", 0);
          $("#left-panel-7").html('');
          $("#left-panel-7").append(response);
          var options = {
            valueNames: ['name', 'born']
          };
          var userList = new List('users_state', options);
        }
        ,
      }
                 );
    }
  }
                                  );
  $('#getstate').on('click', $('input[name="state_id"]:checked'), function() {
    var selectedState = new Array();
    $('input[name="state_id"]:checked').each(function() {
      selectedState.push(this.value);
    }
                                            );
    if (selectedState == '')
    {
      $('#getcity').hide();
    }
    else {
      jQuery.ajax({
        type: "POST", // HTTP method POST or GET
        url: "getcitysearch", //Where to make Ajax calls
        dataType: "text", // Data type, HTML, json etc.
        data: 'state_id=' + selectedState,
        success: function(response)
        {
          $("#getcity").show();
          $("#loaderID").css("opacity", 0);
          $("#left-panel-8").html('');
          $("#left-panel-8").append(response);
          var options = {
            valueNames: ['name', 'born']
          };
          var userList = new List('users_city', options);
        }
        ,
      }
                 );
    }
  }
                   );
  $("#frm_filter").on('change', function()
                      {
    $("#loaderID").css("opacity", 1);
    var selectedOrderBy = new Array();
    $('input[name="orderby"]:checked').each(function() {
      selectedOrderBy.push(this.value);
    }
                                           );
    if (selectedOrderBy == '')
    {
      var selectedOrderBy = 'null';
    }
    var selectedGender = new Array();
    $('input[name="gender"]:checked').each(function() {
      selectedGender.push(this.value);
    }
                                          );
    if (selectedGender == '')
    {
      var selectedGender = 'null';
    }
    var selectedPhoto = new Array();
    $('input[name="photo"]:checked').each(function() {
      selectedPhoto.push(this.value);
    }
                                         );
    if (selectedPhoto == '')
    {
      var selectedPhoto = 'null';
    }
    var selectedgender = new Array();
    $('input[name="gender"]:checked').each(function() {
      selectedgender.push(this.value);
    }
                                          );
    if (selectedgender == '')
    {
      var selectedgender = 'null';
    }
    var selectedMstatus = new Array();
    $('input[name="m_status"]:checked').each(function() {
      selectedMstatus.push(this.value);
    }
                                            );
    if (selectedMstatus == '')
    {
      var selectedMstatus = 'null';
    }
    var selectedCaste = new Array();
    $('input[name="caste_id"]:checked').each(function() {
      selectedCaste.push(this.value);
    }
                                            );
    if (selectedCaste == '')
    {
      var selectedCaste = 'null';
    }
    if ($('#annual_income').val() != '')
    {
      var annal_income = $("#annual_income").val();
    }
    else
    {
      var annal_income = '';
    }
    var selectedReligion = new Array();
    $('input[name="religion"]:checked').each(function() {
      selectedReligion.push(this.value);
    }
                                            );
    if (selectedReligion == '')
    {
      var selectedReligion = 'null';
    }
    var selectedOccupation = new Array();
    $('input[name="occupation"]:checked').each(function() {
      selectedOccupation.push(this.value);
    }
                                              );
    if (selectedOccupation == '')
    {
      var selectedOccupation = 'null';
    }
    var selectedEducation = new Array();
    $('input[name="education"]:checked').each(function() {
      selectedEducation.push(this.value);
    }
                                             );
    if (selectedEducation == '')
    {
      var selectedEducation = 'null';
    }
    /*var selectedOccupation = new Array();
         $('input[name="occupation"]:checked').each(function() {
         selectedOccupation.push(this.value);
         });
         if(selectedOccupation=='')
         {
         var selectedOccupation ='null';
         }*/
    var selectedCountry = new Array();
    $('input[name="country"]:checked').each(function() {
      selectedCountry.push(this.value);
    }
                                           );
    if (selectedCountry == '')
    {
      var selectedCountry = 'null';
    }
    var selectedState = new Array();
    $('input[name="state_id"]:checked').each(function() {
      selectedState.push(this.value);
    }
                                            );
    if (selectedState == '')
    {
      var selectedState = 'null';
    }
    var selectedCity = new Array();
    $('input[name="city_id"]:checked').each(function() {
      selectedCity.push(this.value);
    }
                                           );
    if (selectedCity == '')
    {
      var selectedCity = 'null';
    }
    var selectedMothertongue = new Array();
    $('input[name="mothertongue"]:checked').each(function() {
      selectedMothertongue.push(this.value);
    }
                                                );
    if (selectedMothertongue == '')
    {
      var selectedMothertongue = 'null';
    }
    if ($('#to_hight').val() != '')
    {
      var toheight = $('#to_hight').val();
    }
    else
    {
      var toheight = '';
    }
    if ($('#from_hight').val() != '')
    {
      var fromheight = $('#from_height').val();
    }
    else
    {
      var fromheight = '';
    }
    if ($('#to_age').val() != '')
    {
      var toage = $('#to_age').val();
    }
    else
    {
      var toage = '';
    }
    if ($('#from_age').val() != '')
    {
      var fromage = $('#from_age').val();
    }
    else
    {
      var fromage = '';
    }
    if ($('input[name="photo_search"]:checked').val() != '')
    {
      var photo_search = $('input[name="photo_search"]:checked').val();
    }
    else if ($('input[name="photo_search"]:checked').val() == '')
    {
      var photo_search = 'null';
    }
    else
    {
      var photo_search = '';
    }
    if ($('input[name="profile_latest_register"]:checked').val() != '')
    {
      var profile_latest_register = $('input[name="profile_latest_register"]:checked').val();
    }
    else if ($('input[name="profile_latest_register"]:checked').val() == '')
    {
      var profile_latest_register = 'null';
    }
    else
    {
      var profile_latest_register = '';
    }
    $("#loaderID").css("z-index", 9999);
    var dataString = 'religion=' + selectedReligion + '&caste=' + selectedCaste + '&fromheight=' + fromheight + '&toheight=' + toheight + '&occupation=' + selectedOccupation + '&t3=' + fromage + '&t4=' + toage + '&country=' + selectedCountry + '&state=' + selectedState + '&city=' + selectedCity + '&gender=<?php
    if (isset($_SESSION['user_id'])) {
      echo $_SESSION['gender'];
    }
    else {
      ?>' + selectedgender + '<?php }
    ?>&m_status=' + selectedMstatus + '&photo=' + selectedPhoto + '&m_tongue=' + selectedMothertongue + '&education=' + selectedEducation + '&photo_search=' + photo_search + '&profile_latest_register=' + profile_latest_register + '&orderby=' + selectedOrderBy + '&actionfunction=showData' + '&page=1';
    jQuery.ajax({
      type: "POST", // HTTP method POST or GET
      url: "dbmanupulate2", //Where to make Ajax calls
      dataType: "text", // Data type, HTML, json etc.
      data: dataString,
      success: function(response)
      {
        $("#pagination").empty();
        $("#loaderID").css("opacity", 0);
        $("#loaderID").css("z-index", -1);
        $("#pagination").append(response);
      }
      ,
    }
               );
  }
                     );
</script>
<script src="js/list.min.js">
</script>    
<!-- Start of List.js stuff -->
<script type="text/javascript" type="text/javascript">
  var options = {
    valueNames: ['name', 'born']
  };
  var userList = new List('users', options);
  var userList = new List('users_state', options);
  var userList = new List('users_city', options);
  var userList = new List('users_caste', options);
  var userList = new List('users_education', options);
  var userList = new List('users_occupation', options);
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
                });
            })(jQuery);
        </script> 
<!-- End of List.js stuff -->
