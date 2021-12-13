function getexpsentdata(){

  

			$.ajax({

				  url: 'parts/exp-result',

				  type: 'POST',

				  data: 'exp_status=sent_all_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut('slow');

					

					$('#exp-1').html(data);

					$('#exp-1').addClass('active');

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}

		

function getexpreceivedata(){

  

		$.ajax({

				  url: 'parts/exp-result',

				  type: 'POST',

				  data: 'exp_status=receive_all_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");

					$('#exp-1').html(data);

					$("#exp-1").addClass('active'); 

					$("#exp-1-a").addClass('active'); 

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}	

		

function getexpsentacceptdata(){

  

			$.ajax({

				  url: 'parts/exp-sent-accept',

				  type: 'POST',

				  data: 'exp_status=sent_accept_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");
					$("#exp-1").html('');
					$("#exp-3").html('');
					$("#exp-4").html('');
					$("#exp-5").html('');
					$("#exp-6").html('');
					$("#exp-7").html('');
					$('#exp-2').html(data);

					$("#exp-2").addClass('active'); 
					 
					//$("#exp-2-a").addClass('active'); 

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}

		

function getexpsentrejectdata(){

  

			$.ajax({

				  url: 'parts/exp-sent-reject',

				  type: 'POST',

				  data: 'exp_status=sent_reject_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");
					$("#exp-1").html('');
					$('#exp-2').html('');
					$("#exp-4").html('');
					$("#exp-5").html('');
					$("#exp-6").html('');
					$("#exp-7").html('');
					
					$('#exp-3').html(data);

					$("#exp-3").addClass('active'); 

					//$("#exp-3-a").addClass('active'); 

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}		



function getexpsentpendingdata(){

  

			$.ajax({

				  url: 'parts/exp-sent-pending',

				  type: 'POST',

				  data: 'exp_status=sent_pending_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");
					$("#exp-1").html('');
					$('#exp-2').html('');
					$("#exp-3").html('');
					$("#exp-5").html('');
					$("#exp-6").html('');
					$("#exp-7").html('');
					
					$('#exp-4').html(data);

					$("#exp-4").addClass('active'); 

					//$("#exp-4-a").addClass('active'); 

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}				

		

function getexpreceiveacceptgdata(){

  

			$.ajax({

				  url: 'parts/exp-receive-accept',

				  type: 'POST',

				  data: 'exp_status=receive_accept_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");

					$("#exp-1").html('');
					$('#exp-2').html('');
					$("#exp-3").html('');
					$('#exp-4').html('');
					$('#exp-5').html(data);
					$("#exp-6").html('');
					$("#exp-7").html('');
					
					

					$("#exp-5").addClass('active'); 

					//$("#exp-5-a").addClass('active'); 

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}

		

function getexpreceiverejectdata(){

  

			$.ajax({

				  url: 'parts/exp-receive-reject',

				  type: 'POST',

				  data: 'exp_status=receive_reject_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");

					$("#exp-1").html('');
					$('#exp-2').html('');
					$("#exp-3").html('');
					$('#exp-4').html('');
					$('#exp-5').html('');
					$("#exp-6").html(data);
					$("#exp-7").html('');

					$("#exp-6").addClass('active'); 

					$("#exp-6-a").addClass('active'); 

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}	

		

function getexpreceivependingdata(){

  

			$.ajax({

				  url: 'parts/exp-receive-pending',

				  type: 'POST',

				  data: 'exp_status=receive_pending_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");

					$("#exp-1").html('');
					$('#exp-2').html('');
					$("#exp-3").html('');
					$('#exp-4').html('');
					$('#exp-5').html('');
					$("#exp-6").html('');
					$("#exp-7").html(data);

					$("#exp-7").addClass('active'); 

					$("#exp-7-a").addClass('active'); 

					

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}										



function getexpdeletesentdata(){

  

			$.ajax({

				  url: 'parts/exp-interest-delete',

				  type: 'POST',

				  data: 'exp_status=sent_all_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");

					$('#exp-8').html(data);

					

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}



function getexpdeletereceivedata(){

  

			$.ajax({

				  url: 'parts/exp-interest-delete',

				  type: 'POST',

				  data: 'exp_status=receive_all_interest&actionfunction=showData' + '&page=1',

				  success: function(data) {

					$("#loader").fadeOut("slow");

					$('#exp-8').html(data);

					

				 },

				  error: function() {

					//called when there is an error

					//console.log(e.message);

				  }

				});

				

		}

		

	function acceptint(expid)

	{

		$.ajax({

	    url:"exp-accept",

        type:"POST",

        data:"exp_id="+expid+'&exp_status=accept',

        cache: false,

        success: function(response)

		{

			$('#accept'+expid+'').fadeOut('slow');

			$('#reject'+expid+'').fadeOut('slow');

		}

		

	   });

				

		

	}

	

	function rejectint(expid)

	{

		$.ajax({

	    url:"exp-accept",

        type:"POST",

        data:"exp_id="+expid+'&exp_status=reject',

        cache: false,

        success: function(response)

		{

			$('#accept'+expid+'').fadeOut('slow');

			$('#reject'+expid+'').fadeOut('slow');

		}

		

	   });

				

		

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

			

		}

		

	   });

				

		

	

	}

			