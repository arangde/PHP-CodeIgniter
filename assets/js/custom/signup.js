
jQuery(document).ready(function() {
	var form = $('#signup_form');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);
    $.validator.setDefaults({
		submitHandler: function() {
			var params = form.serialize();
			
			$.ajax({
				type: "POST",
				url: base_url+'index/signup_accept',
				data: params,
				dataType: 'text',
				success: function(result){
					if(result == '1'){
						alert("このIDはすでに使われています。別のIDを入力してください。");
						return false;
					}else if(result == '2'){
						alert("メールが送信できませんでした。");
						return false;
					}else if(result == '3'){
						alert("登録が完了しました。登録メールアドレスにメールを送信いたしました");
						location.href = base_url+"index/login";
					}else if(result == '4'){
						alert("資料基地誤りです。再度入力してください。");//???
						return false;
					}else if(result == '5'){
						alert("アプリ管理者が既に登録されておりますので登録できません。");//???
						return false;
					}
				}
			});
			
		}
	});

    $('#btnsignup').on('click', function() {
    	
    	form.validate({
			rules: {
				username: {
					required: true,
					minlength: 1,
					maxlength: 30
				},
				managername: {
					required: true,
					minlength: 1,
					maxlength: 10
				},
				telnumber: {
					required: true,
					number: true,
				},
				postnumber: {
					required: true,
					number: true
				},
				livingaddress: {
					required: true,
					minlength: 1,
					maxlength: 30
				},
				emailaddress: {
					required: true,
					email: true
				},
				accountid: {
					required: true,
					lowercasealphanumeric: true,
					minlength: 3,
					maxlength: 20
				},
				accountpw: {
					required: true,
					lowercasealphanumeric: true,
					minlength: 3,
					maxlength: 20
				},
				accountpwconfirm: {
					required: true,
					lowercasealphanumeric: true,
					minlength: 3,
					maxlength: 20,
					equalTo: "#accountpw"
				}
			},
			messages: {
				accountid: {
					lowercasealphanumeric: "小文字、数字のみを入力してください"
				},
				accountpw: {
					lowercasealphanumeric: "小文字、数字のみを入力してください"
				},
				accountpwconfirm: {
					lowercasealphanumeric: "小文字、数字のみを入力してください"
				}
			}
		});
        
    });
	
});
