
jQuery(document).ready(function() {
	var form = $('#frm_insurer_edit');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);
    
    $.validator.setDefaults({
			submitHandler: function() {
				var params = form.serialize();
				$.ajax({
					type: "POST",
					url: base_url+'ainsurance/iedit_accept',
					data: params,
					dataType: 'json',
					success: function(result){
						if(result.status == '1'){
							if(result.input_flag == '0'){
								alert("編集が完了しました。");
							}else{
								alert("登録が完了しました。");
							}
							
							location.href = base_url+"ainsurance/ilist";
							
						}else if(result.status == '2'){
							if(result.input_flag == '0'){
								alert("資料基地エラーです。 編集に失敗しました。");
							}else{
								alert("資料基地エラーです。 登録に失敗しました。");
							}
							
							return false;
						}
					}
				});
				
			}
	});

    $('#btn_insurer_save').on('click', function(e) {
   // 	event.preventDefault();

    	form.validate({
			rules: {
				txt_insurer_name: {
					required: true
				},
				txt_sort_id: {
					required: true
				}
			},
			messages: {
			}
		});
        
    });
    $(".delete_insurer").on("click", function(){
        if(confirm('名簿から削除します。')){
            var insurer_id = $(this).data("insurer_id");
            $.ajax({
                type: "POST",
                url: base_url+'ainsurance/idelete',
                data: {'insurer_id': insurer_id},
                dataType: 'text',
                success: function(result){
                    if(result == '0'){
                        alert("資料基地エラーです。 削除に失敗しました。");
                        location.href = base_url+"ainsurance/ilist";
                    }else{
                        alert("削除が完了しました。");
                        location.href = base_url+"ainsurance/ilist";
                    }
                }
            });
        }else{
            return false;
        }
    });
	$("#btn_insurer_clear").on("click", function(){
		$("#txt_insurer_name").val("");
		$("#txt_sort_id").val("");

	});
});
