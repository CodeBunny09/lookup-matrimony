<?php
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$city=mysqli_real_escape_string($configObj->dbLink,$_GET['city_id']);
$get= mysqli_fetch_object(mysqli_query($configObj->dbLink,"select * from city where city_id='".$city."'"));
$city_name=$get->city_name;
$country_code=$get->country_code;
$state_code=$get->state_code;
$status=$get->status;
?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/libs/select2.css"/>   
<script src="plugins/jQuery/jQuery-2.1.3.min.js">
</script>
<script type="text/javascript" src="js/util/select2.min.js">
</script>
<script type="text/javascript" src="js/util/location.js">
</script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
</script>
<script type="text/javascript">
  //setPageContext("add-new","state");
  function countryList(data)
  {
    $.each(data,function(index,val){
      // alert(val.country_id+" "+val.country_name);
      $('#country_code').append($('<option>', {
        value: val.country_code,
        text : val.country_name 
      }
                                 ));
    }
          );
  }
  function stateList(data){
    $('#state_code').empty();
    $('#state_code').append($('<option>', {
      value: "",
      text : "Select State" 
    }
                             ));
    $.each(data,function(index,val){
      $('#state_code').append($('<option>', {
        value: val.state_code,
        text : val.state_name 
      }
                               ));
    }
          );
    if(data.length==0)
      $("#validationSummary").html("<b>No States in this country.</b>");
    else
      $("#validationSummary").html("<b>States are loaded.</b>");
    $("#validationSummary").fadeOut(2000);
  }
</script>
<script type="text/javascript" language="javascript">
  $(document).ready(function() {
    getCountries();
    getStateList('<?php echo  $country_code;?>');
    $("#country_code").val('<?php echo  $country_code;?>').select2();
    $("#state_code").val('<?php echo  $state_code;?>').select2();
    $('#country_code').select2();
    $("#state_code").select2();
    $("#country_code").change(function(){
      var country_code = $(this).val();
      $("#validationSummary").html("<img src='../img/6.gif' alt='loading'/> <b>Please wait...</b>");
      $("#validationSummary").show();
      $('#state_code').empty();
      getStateList(country_code);
      $("#state_code").select2();
    }
                             );
    $("#save" ).button().click(function(){
      $("#validationSummary").attr("class","alert alert-warning");
      $("#validationSummary").html("<img src='../img/6.gif' alt='loading'/> <b>Please wait...</b>");
      $("#validationSummary").show();
      var dataString =  $("#city-form").serialize();
      $.ajax({
        type: "post",
        url: "web-services/add-details/add-city",
        dataType:"json",
        data: dataString,
        success: function(data){
          if(data.successStatus){
            $("#validationSummary").attr("class","alert alert-success");
            $("#validationSummary").html("<i class='fa fa-check-circle fa-fw fa-lg'></i>"+data.responseMessage+"");
            $("#validationSummary").show();
          }
          else{
            $("#validationSummary").attr("class","alert alert-danger");
            $("#validationSummary").html("<i class='fa fa-times-circle fa-fw fa-lg'></i>Please correct following errors.<ul class='error-hint cf'>"+data.responseMessage+"</ul>");
            $("#validationSummary").show();
          }
        }
      }
            )
      return false;
    }
                              );
  }
                   );
</script>
<div class="md-modal md-effect-13" id="modal-13">
  <div class="md-content" id="dialog">
    <div class="modal-header" >
      <h4 class="modal-title" id="dialog_title">Update City
      </h4>
    </div>
    <div class='error-msg' id='validationSummary'>
    </div>
    <form method="post" id="city-form" action="" method="post">
      <div class="modal-body">
        <div class="form-group form-group-select2">
          <label >
            <b> Country:
            </b>
          </label>
          <select name="country_code" id="country_code"  class="form-control">
            <option value="" >Select Country
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <b>State Name
            </b>
          </label>
          <select name="state_code" id="state_code"  class="form-control">
            <option value="" >Select State
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <b>City Name
            </b>
          </label>
          <input type="text" name="city_name" class="form-control" value="<?php echo $city_name;?>" id="city_name" placeholder="Enter city name">
        </div>
        <div class="form-group">
          <label>
            <b>Status
            </b>
          </label>
          <div class="radio">
            <input id="optionsRadios1" class="city_status" type="radio" 
                   <?php if($status=='APPROVED') { ?> checked 
            <?php } ?> value="APPROVED" name="city_status">
            <label for="optionsRadios1">
              <b>Active
              </b> 
            </label>
            <input id="optionsRadios2" class="city_status" type="radio" value="UNAPPROVED" name="city_status" 
                   <?php if($status=='UNAPPROVED') { ?> checked 
            <?php } ?>>
            <label for="optionsRadios2">
              <b>Inactive 
              </b>
            </label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="button" id="save" class="btn btn-primary" value="Save Changes" title="Save Changes"/>
        <input type="hidden" name="action" value="UPDATE" id="update_action"/>
        <input type="hidden" name="city_id" id="city_id" value="<?php echo $city;?>"/>
      </div>
    </form>
  </div>
</div>