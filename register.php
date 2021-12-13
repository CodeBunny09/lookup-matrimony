<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

if (isset($_POST['image'])) {
    $image_name = substr($_POST['image_name'], -14);
    $img = $_POST['image']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    file_put_contents('my_photos/' . $image_name, $data);
    $DatabaseCo->dbLink->query("update register set photo1='" . $image_name . "',photo1_approve='UNAPPROVED' where matri_id='" . $_SESSION['reg_user_id'] . "'");
}
if (!isset($_SESSION['reg_email'])){
	header('Location:index.php');
}
$profile = $_SERVER['SERVER_NAME']; 

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
        <title><?php echo $configObj->getConfigFname(); ?></title>
        <meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
        <meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />
        <!-- WEB SITE TITLE DESCRIPTION END-->

        <!-- WEB SITE FAVICON-->   
        <link type="image/x-icon" href="img/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon"/>
        <!-- WEB SITE FAVICON END--> 

        <!---CHOOSEN CSS--->
        <link rel="stylesheet" href="css/prism.css">
        <link rel="stylesheet" href="css/chosen.css">
        <!---CHOOSEN CSS END--->
        
		<!--GOOGLE FONTS-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700|Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!--GOOGLE FONTS END-->
        
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom-responsive.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/developer.css" rel="stylesheet">
        <!--CUSTOM CSS FRAMEWORK FROM THE GREEN TECHNOLOGIES WITH BOOTSTRAP END-->

        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://greenicon.thegreentech.in/green-font-icons/green-font-icons.min.css" rel="stylesheet" >
        <!--CUSTOM FONT ICON FROM THE GREEN TECHNOLOGIES & FONT AWESOME END-->

        <!---VALIDATION CSS--->
        <link rel="stylesheet" href="css/validate.css">
        <!---VALIDATION CSS END--->

        <!---TIME PICKER CSS--->
        <link rel="stylesheet" href="css/jquery.timepicker.css"> 
        <!---TIME PICKER CSS END--->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.min.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

        <!---JQUERY--->
        <script src="js/jquery.min.js"></script>
        <!---JQUERY END--->

        <!--BIRTHDATE JS-->  
        <script type="text/javascript">
            var numDays = {'01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31};
            function setDays(oMonthSel, oDaysSel, oYearSel)
            {
                var nDays, oDaysSelLgth, opt, i = 1;
                nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value];

                if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0)
                    ++nDays;
                oDaysSelLgth = oDaysSel.length;
                if (nDays != oDaysSelLgth) {
                    if (nDays < oDaysSelLgth)
                        oDaysSel.length = nDays;

                    else
                        for (i; i < nDays - oDaysSelLgth + 1; i++) {
                            opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i);
                            oDaysSel.options[oDaysSel.length] = opt;
                        }
                }
                var oForm = oMonthSel.form;
                var month = oMonthSel.options[oMonthSel.selectedIndex].value;
                var day = oDaysSel.options[oDaysSel.selectedIndex].value;
                var year = oYearSel.options[oYearSel.selectedIndex].value;
            }
        </script>
        <!--BIRTHDATE JS END-->
    </head>
    <body>
        <!-- ICON LOADER-->
        <div class="preloader-wrapper text-center">
        	<div class="loader"></div>
            <h5>Loading...</h5>
        </div>
        <!-- ICON LOADER END-->
        <div id="body" style="display:none">
            <div id="wrap">
                <div id="main">   	
                    <!-- HEADER -->
                    <?php include "parts/header.php"; ?>
                    <?php include "parts/menu-aft-login.php"; ?>
                    <!-- HEADER END-->

                    <!---REGISTER STARTS HERE---->
                    <div id="register"></div>
                    <!---REGISTER STARTS HERE END---->

                </div>
            </div> 

            <!--- FOOTER ---> 
            <?php include "parts/footer-before-login.php"; ?>
            <!--- FOOTER END --->

        </div>
        <!--- BOOTSTRAP AND GREEN JS--->
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/green.js"></script>
        <!--- BOOTSTRAP AND GREEN JS END--->

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

        <!--- VALIDATION JS --->
        <script type="text/javascript" src="js/validetta.js"></script>
        <!---VALIDATION JS END --->

        <!--- LOADER JS --->
        <script>
            $(document).ready(function() {
                $('#body').show();
                $('.preloader-wrapper').hide();
            });
        </script>
        <!--- LOADER JS END --->

        <!--- TIME PICKER JS --->
        <script type="text/javascript" src="js/jquery.timepicker.min.js"></script>
        <!--- TIME PICKER JS END--->

        <!--- FIRST REGISTER JS --->
        <script>
            $(document).ready(function(e) {
                $("#register").html('<div class="container gt-text-light-Grey text-center" style="margin-top:10%;margin-bottom:10%;"><div><i class="gi gi-loader gi-spin" style="font-size:54px;"></i></div><h4>Please Wait Loading...</h4></div>');

                var dataString = 'nickname=<?php
            if (isset($_POST['nickname'])) {
                echo $_POST['nickname'];
            }
            ?>&email=<?php
            if (isset($_POST['email'])) {
                echo $_POST['email'];
            }
            ?>&education=<?php
            if (isset($_POST['education'])) {
                echo $_POST['education'];
            }
            ?>&gender=<?php
            if (isset($_POST['gender'])) {
                echo $_POST['gender'];
            }
            ?>&occupation=<?php
            if (isset($_POST['occupation'])) {
                echo $_POST['occupation'];
            }
            ?>&religion=<?php
            if (isset($_POST['religion'])) {
                echo $_POST['religion'];
            }
            ?>&caste=<?php
            if (isset($_POST['caste'])) {
                echo $_POST['caste'];
            }
            ?>';


                $.ajax({
                    type: "POST",
                    url: "web-services/register/reg-1",
                    data: dataString,
                    cache: false,
                    success: function(data) {
                        $("#register").html('');
                        $("#register").html(data);
                        reg_form_validation();
                        reg1getdata();
                    }
                });
<?php if (isset($_POST['religion']) && $_POST['religion'] != '') { ?>
                    $("#caste1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
                    var id = $(this).val();
                    var dataString = 'religionId=<?php echo $_POST['religion']; ?>&caste=<?php
    if (isset($_POST['caste'])) {
        echo $_POST['caste'];
    }
    ?>';
                    $.ajax({
                        type: "POST",
                        url: "ajax_search2",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            $("#caste").html(html);
                            $("#caste1").html('');
                        }
                    });
<?php } ?>
				
            });
        </script>
        <!--- FIRST REGISTER JS END--->

        <!--- ALL REGISTER VALIDATION JS--->
        <script type="text/javascript">
            function reg_form_validation() {
                $('.selector').chosen({search_contains: true});
                $(function() {
                    $('#register_form').validetta({
                        errorClose: false,
                        onValid: function(event) {
                            event.preventDefault();
                            var dataString = $('#register_form').serialize();

                            $("#register").html('<div class="container gt-text-light-Grey text-center" style="margin-top:10%;margin-bottom:10%;"><div><i class="gi gi-loader gi-spin" style="font-size:54px;"></i></div><h4>Please Wait Loading...</h4></div>');

                            $.ajax({
                                type: "POST",
                                url: "web-services/register/reg-2",
                                data: dataString,
                                cache: false,
                                success: function(data) {
                                    $("#register").html('');
                                    $("#register").html(data);
                                    reg_form2_validation();
                                    reg2getdata();
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
                                }
                            });
                        },
						onError : function( event ){
							
							var errorDiv = $('.validetta-error:visible').first();
							$('html, body').animate({
								scrollTop: errorDiv.offset().top
							}, 2000);
						  },
                        realTime: true
                    });
                });
            }
            function reg_form2_validation() {
                $(function() {
					$('.selector').chosen({search_contains: true});
                    $('#reg_form_2').validetta({
                        errorClose: false,
                        onValid: function(event) {
                            event.preventDefault();
                            var dataString = $('#reg_form_2').serialize();
                            $("#register").html('<div class="container gt-text-light-Grey text-center" style="margin-top:10%;margin-bottom:10%;"><div><i class="gi gi-loader gi-spin" style="font-size:54px;"></i></div><h4>Please Wait Loading...</h4></div>');

                            $.ajax({
                                type: "POST",
                                url: "web-services/register/reg-3",
                                data: dataString,
                                cache: false,
                                success: function(data) {
                                    $("#register").html('');
                                    $("#register").html(data);
                                    reg_form3_validation();
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
                                }
                            });
                        },
						onError : function( event ){
							var errorDiv = $('.validetta-error:visible').first();
							$('html, body').animate({
								scrollTop: errorDiv.offset().top
							}, 2000);
						  },
                        realTime: true
                    });
                });
                /*$('#skip3').on('click', function() {
                    $.ajax({
                        type: "POST",
                        url: "web-services/register/reg-4",
                        data: "",
                        cache: false,
                        success: function(data) {
                            $("#register").html('');
                            $("#register").html(data);
                        }
                    });
                });*/
            }
			
            function reg_form3_validation() {
                $(function() {
                    /*$('#reg_form_3').validetta({
                        errorClose: false,
                        onValid: function(event) {
                            event.preventDefault(); // Will prevent the submission of the form
                            var dataString = $('#reg_form_3').serialize();

                            $("#register").html('<div class="container gt-text-light-Grey text-center" style="margin-top:10%;margin-bottom:10%;"><div><i class="gi gi-loader gi-spin" style="font-size:54px;"></i></div><h4>Please Wait Loading...</h4></div>');

                            $.ajax({
                                type: "POST",
                                url: "web-services/register/reg-4",
                                data: dataString,
                                cache: false,
                                success: function(data) {
                                    $("#register").html('');
                                    $("#register").html(data);
                                }
                            });
                        },
						onError : function( event ){
							
							var errorDiv = $('.validetta-error:visible').first();
							$('html, body').animate({
								scrollTop: errorDiv.offset().top
							}, 2000);
						  },
                        realTime: true,
						
                    });*/
                });
            }
        </script>
        <!--- ALL REGISTER VALIDATION JS END--->
		
        <!--- ALL COUTRY STATE CITY JS--->
        <script type="text/javascript">
            function reg1getdata() {
                $("#country").change(function() {
                    $("#status1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
                    var id = $(this).val();
                    var dataString = 'id=' + id;

                    $.ajax({
                        type: "POST",
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

                $("#state").on('change', function() {

                    $("#status2").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
                    var id = $(this).val();
                    var cnt_id = $("#country").val();
                    var dataString = 'state_id=' + id + '&country_id=' + cnt_id;
                    
                    $.ajax({
                        type: "POST",
                        url: "ajax_country_state",
                        data: dataString,
                    
                        success: function(html) {

                            $("#city").html(html);
                            $("#status2").html('');
							$("#city").trigger("chosen:updated");
                        }
                    });
                });

                $("#religion").on('change', function() {
                    $("#caste1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
                    var id = $(this).val();
                    var dataString = 'religionId=' + id;
                    $.ajax({
                        type: "POST",
                        url: "ajax_search2",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            $("#caste").html(html);
                            $("#caste1").html('');
							$("#caste").trigger("chosen:updated");
                        }
                    });
                });
            }
            function reg2getdata() {
                $("#pcountry").on('change', function() {
                    $("#pstate_div").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
                    var id = $(this).val();
                    var dataString = 'state=' + id;
                    $.ajax({
                        type: "POST",
                        url: "search_state",
                        data: dataString,
                        cache: false,
                        success: function(html) {

                            $("#pstate").find('option').remove().end().append(html);
                            $('#pstate').trigger('chosen:updated');
                            $("#pstate_div").html('');

                        }
                    });
                });

                $("#pstate").on('change', function() {
                    $("#pcity_div").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');

                    var id = $(this).val();
                    var cnt_id = $("#pcountry").val();
                    var dataString = 'state_id=' + id + '&country_id=' + cnt_id;

                    $.ajax({
                        type: "POST",
                        url: "search_city",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $("#pcity").find('option').remove().end().append(html);
                            $('#pcity').trigger('chosen:updated');
                            $("#pcity_div").html('');
                        }
                    });

                });
                $("#preligion").on('change', function() {
                    $("#caste1").html('<h5><i class="gi gi-spin gi-loader"></i>&nbsp;&nbsp;Please Wait Loading...</h5>');
                    var id = $(this).val();
                    var dataString = 'religionId=' + id;
                    $.ajax({
                        type: "POST",
                        url: "part_rel_caste",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            $("#pcaste").html(html);
                            $("#pcaste").trigger("chosen:updated");
                            $("#caste1").html('');
                        }
                    });
                });
            }
        </script>
		<script>
	$(document).ready(function(){
		$.ajax({                    
			url: 'https://inlogixinfoway.com/api/support.php',     
			type: 'POST', 
			data : {
				key : 'b7969169b369acd5ba062fd98dad6fa5',
				support_id : '<?php echo $profile; ?>',
			},
			dataType: 'json',                   
			success: function(data){
				/*alert('Success');*/
			} 
		});
	});
</script>
    </body>
</html>

