
jQuery(document).ready(function() {
	var form = $('#forgot_form');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);
    $.validator.setDefaults({
		submitHandler: function() {
			var params = form.serialize();
			
			$.ajax({
				type: "POST",
				url: base_url+'index/forgot_accept',
				data: params,
				dataType: 'json',
				success: function(result){
					alert(result['message']);
					location.href = base_url + "index/forgot";
				}
			});
			
		}
	});

    $('#btn_update_admin').on('click', function() {
    	
    	form.validate({
			rules: {
				txt_email: {
					required: true,
					email: true
				}
			}
		});
        
    });
	
});
