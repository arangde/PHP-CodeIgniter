
jQuery(document).ready(function() {
	var form = $('#frm_user_edit');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);
    
    $.validator.setDefaults({
			submitHandler: function() {
				var params = form.serialize();
				$.ajax({
					type: "POST",
					url: base_url+'auser/uedit_accept',
					data: params,
					dataType: 'json',
					success: function(result){
						if(result.status == '1'){
							if(result.input_flag == '0'){
								alert("編集が完了しました。");
							}else{
								alert("登録が完了しました。");
							}
							location.href = base_url+"auser/ulist?id="+result.input_id;
							
						}else if(result.status == '2'){
							if(result.input_flag == '0'){
								alert("資料基地エラーです。 編集に失敗しました。");
							}else{
								alert("資料基地エラーです。 登録に失敗しました。");
							}
							return false;
						}else if(result.status == '3'){
							alert("そのログインIDは、利用することができません。");
							return false;
						}else if(result.status == '4'){
							alert("そのログインIDが重複します。他のIDを利用してください。")
							return false;
						}
					}
				});
				
			}
	});
	if($("#hdn_input_flag").val()==0){
		if($("#chk_password_change:checked").val()=='on'){
			$("#txt_user_password").removeAttr("disabled");
		}else{
			$("#txt_user_password").val("");
    		$("#txt_user_password").attr("disabled", "disabled");
		}
	}
    $("#chk_password_change").on("change", function(){
    	if($("#chk_password_change:checked").val()=='on'){
    		$("#txt_user_password").removeAttr("disabled");
    	}else{
    		$("#txt_user_password").val("");
    		$("#txt_user_password").attr("disabled", "disabled");
    	}
    });
    $('#btn_user_save').on('click', function(e) {
   // 	event.preventDefault();

   		if($("#chk_password_change:checked").val()=='on'){
   			if($("#txt_user_password").val()==""){
   				alert("パスワードを設定してください。");
   				return false;
   			}
   		}
   		if($("#hdn_input_flag").val()==1){
   			form.validate({
				rules: {
					txt_user_furigana: {
						required: true
					},
					txt_user_name: {
						required: true
					},
					txt_user_symbol: {
						required: true
					},
					txt_user_phone_number: {
						required: true
					},
					txt_user_email: {
						required: true
					},
					txt_user_support_number: {
						required: true
					},
					txt_user_sort_id: {
						required: true
					},
					txt_user_login_id: {
						required: true,
						lowercasealphanumeric: true,
						minlength: 3,
						maxlength: 20
					},
					txt_user_password: {
						required: true,
						lowercasealphanumeric: true,
						minlength: 3,
						maxlength: 20
					},
					sel_user_office_id: {
						required: true
					}
				},
				messages: {
					txt_user_login_id: {
						lowercasealphanumeric: "小文字、数字のみを入力してください"
					},
					txt_user_password: {
						lowercasealphanumeric: "小文字、数字のみを入力してください"
					}
				}
			});
   		}else{
   			form.validate({
				rules: {
					txt_user_furigana: {
						required: true
					},
					txt_user_name: {
						required: true
					},
					txt_user_symbol: {
						required: true
					},
					txt_user_phone_number: {
						required: true
					},
					txt_user_email: {
						required: true
					},
					txt_user_support_number: {
						required: true
					},
					txt_user_sort_id: {
						required: true
					}
				},
				messages: {
				}
			});
   		} 
    });
    $(".delete_user").on("click", function(){
        if(confirm('名簿から削除します。')){
            var user_id = $(this).data("user_id");
            $.ajax({
                type: "POST",
                url: base_url+'auser/udelete',
                data: {'user_id': user_id},
                dataType: 'text',
                success: function(result){
                    if(result == '0'){
                        alert("資料基地エラーです。 削除に失敗しました。");
                        location.href = base_url+"auser/ulist";
                    }else{
                        alert("削除が完了しました。");
                        location.href = base_url+"auser/ulist";
                    }
                }
            });
        }else{
            return false;
        }
    });
	$("#btn_user_clear").on("click", function(){
		$("#txt_user_furigana").val("");
		$("#txt_user_name").val("");
		$("#txt_user_symbol").val("");
		$("#sel_user_sex").val(0);
		$("#txt_user_phone_number").val("");
		$("#txt_user_note").val("");
		$("#txt_user_email").val("");
		$("#sel_user_job_title").val(0);
		$("#txt_user_support_number").val("");
		$("#txt_user_sort_id").val("");
		$("#txt_user_login_id").val("");
		$("#txt_user_password").val("");
		$("input[name=rd_user_employment]").each(function(){
			this.checked = false;
		});
		$("#sel_user_office_id").val(0);

	});
});
