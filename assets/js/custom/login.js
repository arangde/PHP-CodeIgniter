
jQuery(document).ready(function() {
	var form = $('#login_form');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);
    $.validator.setDefaults({
		submitHandler: function() {
			var params = form.serialize();
			
			$.ajax({
				type: "POST",
				url: base_url+'index/login_accept',
				data: params,
				dataType: 'text',
				success: function(result){
					if(result == '1'){
						location.href = base_url+"ahome/index";
					}else if(result == '2'){
						location.href = base_url+"mhome/index";
					}else if(result == '3'){
						location.href = base_url+"phome/index"; 
					}
					else if(result == '4'){
						alert("ID/パスワードが間違っています。");
						return false;
					}
				}
			});
			
		}
	});

    $('#btnlogin').on('click', function() {
    	
    	form.validate({
			rules: {
				user_id: {
					required: true,
					lowercasealphanumeric: true,
					minlength: 3,
					maxlength: 20
				},
				password: {
					required: true,
					lowercasealphanumeric: true,
					minlength: 3,
					maxlength: 20
				}
			},
			messages: {
				username: {
					lowercasealphanumeric: "小文字、数字のみを入力してください"
				},
				password: {
					lowercasealphanumeric: "小文字、数字のみを入力してください"
				}
			}
		});
        
    });
	
});
