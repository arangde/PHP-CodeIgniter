
jQuery(document).ready(function() {
	var form = $('#frm_office_edit');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);

    $(".chzn-select").chosen(); 
    $(".chzn-select-deselect").chosen({allow_single_deselect:true});
    
    $.validator.setDefaults({
			submitHandler: function() {
				$("#sel_office_insurers_chzn li span").each(function(){
		        	if($(this).html() != ''){
		        		var prev = $('#hdn_insurers').val();
		        		var cur = prev + $(this).html() + ',';
		        		$('#hdn_insurers').val(cur);
		        	}
		        });
		        $("#sel_office_area_chzn li span").each(function(){
		        	if($(this).html() != ''){
		        		var prev = $('#hdn_areas').val();
		        		var cur = prev + $(this).html() + ',';
		        		$('#hdn_areas').val(cur);
		        	}
		        });
		        $("#sel_office_class_chzn li span").each(function(){
		        	if($(this).html() != ''){
		        		var prev = $('#hdn_office_classes').val();
		        		var cur = prev + $(this).html() + ',';
		        		$('#hdn_office_classes').val(cur);
		        	}
		        });
		        $("input[type='checkbox']").each(function(){
		        	if($(this).is(":checked")){
		        		var prev = $('#hdn_office_services').val();
		        		var cur = prev + $(this).data('chk_value') + ',';
		        		$('#hdn_office_services').val(cur);
		        	}
		        });
				var params = form.serialize();
				$.ajax({
					type: "POST",
					url: base_url+'moffice/oedit_accept',
					data: params,
					dataType: 'json',
					success: function(result){
						if(result.status == '1'){
							if(result.input_flag == '0'){
								alert("編集が完了しました。");
							}else{
								alert("登録が完了しました。");
							}
							
							location.href = base_url+"moffice/olist";
							
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

    $('#btn_office_save').on('click', function(e) {
   // 	event.preventDefault();

    	form.validate({
			rules: {
				txt_office_name: {
					required: true
				},
				txt_office_phonenumber: {
					required: true
				},
				txt_office_fax: {
					required: true
				},
				txt_office_postnumber: {
					required: true
				},
				txt_office_address: {
					required: true
				},
				txt_office_insurers: {
					required: true
				},
				txt_office_area: {
					required: true
				},
				txt_office_class: {
					required: true
				},
				txt_office_note: {
					required: true
				}
			},
			messages: {
			}
		});
        
    });
    $(".delete_office").on("click", function(){
        if(confirm('名簿から削除します。')){
            var office_id = $(this).data("office_id");
            $.ajax({
                type: "POST",
                url: base_url+'moffice/odelete',
                data: {'office_id': office_id},
                dataType: 'text',
                success: function(result){
                    if(result == '0'){
                        alert("資料基地エラーです。 削除に失敗しました。");
                        location.href = base_url+"moffice/olist";
                    }else{
                        alert("削除が完了しました。");
                        location.href = base_url+"moffice/olist";
                    }
                }
            });
        }else{
            return false;
        }
    });
	$("#btn_office_clear").on("click", function(){
		$("#txt_office_name").val("");
		$("#txt_office_phonenumber").val("");
		$("#txt_office_fax").val("");
		$("#txt_office_postnumber").val("");
		$("#txt_office_address").val("");
		$("#txt_office_note").val("");

		$("#sel_office_insurers_chzn li.search-choice").each(function(){
        	$(this).remove();
        });
        $("#sel_office_insurers_chzn .chzn-drop li.result-selected").each(function(){
        	$(this).addClass('active-result');
        	$(this).removeClass('result-selected');
        });

        $("#sel_office_area_chzn li.search-choice").each(function(){
        	$(this).remove();
        });
        $("#sel_office_area_chzn .chzn-drop li.result-selected").each(function(){
        	$(this).addClass('active-result');
        	$(this).removeClass('result-selected');
        });

        $("#sel_office_class_chzn li.search-choice").each(function(){
        	$(this).remove();
        });
        $("#sel_office_class_chzn .chzn-drop li.result-selected").each(function(){
        	$(this).addClass('active-result');
        	$(this).removeClass('result-selected');
        });

        $("input[type='checkbox']").each(function(){
        	$(this).attr('checked', false);
        });
	});
});
