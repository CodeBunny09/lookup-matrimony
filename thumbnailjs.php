<script>
    $(document).ready(function(){
        dis_thumbnail();
    });
    function dis_thumbnail(){
        var dataString = '';
        jQuery.ajax({
            url: "./web-services/display_thumbnail",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response)
            {
                $("#dis_thumbnail").html('');
                $("#dis_thumbnail").append(response);
            },
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