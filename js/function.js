function getXMLHTTP()
{
	var xmlhttp=false;
	try
	{
		xmlhttp=new XMLHttpRequest();
	}
	catch(e)
	{
		try
		{
			xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e1)
			{
				xmlhttp=false;
			}
		}
	}
	return xmlhttp;
}
$('.addToblock-link').click(function () {
$('#shortdiv').hide();
});
 
$(function() {
$(".addToblock-link").click(function() {
$('#shortdiv').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'id='+ id ;
	
$.ajax({
   type: "POST",
   url: "addshortlist",
   data: string,
   cache: false,
   success: function(){
   commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#shortdiv').fadeOut();
  }
   
 });

return false;
	});
});
$('.addToshort-link').click(function () {
$('#shortdiv').hide();
});

$(function() {
$(".addToshort-link").click(function() {
$('#shortdiv').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'add_id='+ id ;
	
$.ajax({
   type: "POST",
   url: "addshortlist",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#shortdiv').fadeOut();
	
  }
   
 });

return false;
	});
});
$('.addToblock-data').click(function () {
$('#blockdiv').hide();
});
 
$(function() 

{
$(".addToblock-data").click(function() {
$('#blockdiv').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'block_id='+ id ;
	
$.ajax({
   type: "POST",
   url: "addshortlist",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#blockdiv').fadeOut();
  }
   
 });

return false;
	});
});
$('.addToshort-data').click(function () {
$('#blockdiv').hide();
});
 
$(function() {
$(".addToshort-data").click(function() {
$('#blockdiv').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'block_add_id='+ id ;
	
$.ajax({
   type: "POST",
   url: "addshortlist",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#blockdiv').fadeOut();
  }
   
 });

return false;
	});
});


function getMessageReply(frmid)
{
	
	$("#myModal1").html("Please wait...");
	$.get("./web-services/compose_message?frmid="+frmid,
	function(data){
		$("#myModal1").html(data);
	});
}

function checkcontactcount(toid){
	$("#myModal2").html("Please wait...");
			$.get("./web-services/verify_view_contact?toid="+toid,
			function(data){
				$("#myModal2").html(data);
			});
}

function getContactDetail(toid){
	$("#myModal2").html("Please wait...");
		$.get("./web-services/contact_detail?toid="+toid,
		function(data){
			$("#myModal2").html(data);
	});
}

function ExpressInterest(toid){
	$("#myModal1").html("Please wait...");
	$.get("./web-services/send_interest?frmid="+toid,
	function(data){
		$("#myModal1").html(data);
	});
}


function photoview(toid)
{

	

	$("#myModal5").html("Please wait...");

	$.get("view_photo_album?matri_id="+toid,

	function(data)
	{
		$("#myModal5").html(data);
		
	});

}

function send_photo_req(toemail)
{

	

	$("#myModal5").html("Please wait...");

	$.get("send_photo_request?email="+toemail,

	function(data){

		$("#myModal5").html(data);

	});

}


function send_pass_req(toid)
{

	
	$("#myModal6").modal('hide');
	$("#myModal5").html("Please wait...");

	$.get("send_pass_request?id="+toid,

	function(data){

		$("#myModal5").html(data);

	});

}

function view_protect_photo(toid)
{

	
	$('#myModal5').modal('hide');
	$("#myModal6").html("Please wait...");

	$.get("viewprotectphotoform?id="+toid,

	function(data){

		$("#myModal6").html(data);
		/*$("#myModal5").show();*/
	});

}

function Getphotos(toid)
{
	
	$("#myModal5").html("Please wait...");
	$.get("./web-services/get_photos?frmid="+toid,
	function(data){
		$("#myModal5").html(data);
	});
}
function Gethoro(toid)
{
	
	$("#myModal6").html("Please wait...");
	$.get("./web-services/get_horoscope?frmid="+toid,
	function(data){
		$("#myModal6").html(data);
	});
}
function approveaspaid(mid)
{
	
	$("#modal-14").html("Please wait...");
	$.get("web-services/approveaspaid?matri_id="+mid + '&status=Renew',
	function(data){

		
		$("#modal-14").html(data);
		
	});
}


function editplan(mid)
{
	
	$("#modal-14").html("Please wait...");
	$.get("web-services/edit_paid_plan?matri_id="+mid,
	function(data){

		
		$("#modal-14").html(data);
		
	});
}



function sub_form(){
	//alert('ok');
	$('#MatriForm').submit();
	//$("#myModal1").hide();
}
 	
function sendreminder(expid)
{
	$.ajax({
	   url:"exp-accept",
	   type:"POST",
	   data:"exp_id="+expid+'&exp_status=reminder',
	   cache: false,
	   success: function(response)
	   {
			$('#reminder'+expid+'').fadeOut('slow');
			$("#loaderID").css("opacity",1);
						$("#loaderID").css("z-index",9999);
				$('#loaderID').html('<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="position: fixed; z-index: 9999; opacity: 1; top: 40%; left: 40%;" ><div class="col-lg-16 col-md-16 col-sm-16 btn gt-btn-green"><font class="gt-margin-left-5">You have successfully sent reminder....  </font></div></div>');
				
				setTimeout(function() {
						$("#loaderID").css("opacity",0);
						$("#loaderID").css("z-index",-1);
					}, 3000);
			
	   }
	});
}



