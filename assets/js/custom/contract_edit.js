
jQuery(document).ready(function() {
	$('.datepicker').datepicker();
	var form = $('#frm_c_edit');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);
    
    $.validator.setDefaults({
			submitHandler: function() {
				if($("input[name=rd_c_destination]").val() == 0){
					$("#txt_c_destination_furigana").attr('readonly', 'readonly');
					$("#txt_c_destination_username").attr('readonly', 'readonly');
					$("#txt_c_destination_postnumber").attr('readonly', 'readonly');
					$("#txt_c_destination_address").attr('readonly', 'readonly');
					$("#txt_c_destination_note").attr('readonly', 'readonly');
					$("#txt_c_destination_furigana").val($("#txt_c_furigana").val());
					$("#txt_c_destination_username").val($("#txt_c_username").val());
					$("#txt_c_destination_postnumber").val($("#txt_c_postnumber").val());
					$("#txt_c_destination_address").val($("#txt_c_address").val());
					$("#txt_c_destination_note").val('');
				}
				var params = form.serialize();
				$.ajax({
					type: "POST",
					url: base_url+'acontract/cedit_accept',
					data: params,
					dataType: 'json',
					success: function(result){
						if(result.status == '1'){
							if(result.input_flag == '0'){
								alert("編集が完了しました。");
							}else{
								alert("登録が完了しました。");
							}
							
							location.href = base_url+"acontract/clist";
							
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

    $('#btn_c_save').on('click', function(e) {
    	form.validate({
			rules: {
				txt_contract_id: {
					required: true
				},
				txt_c_furigana: {
					required: true
				},
				txt_c_username: {
					required: true
				},
				txt_c_symbol: {
					required: true
				},
				txt_c_birthday: {
					required: true
				},
				txt_c_blood: {
					required: true
				},
				txt_c_postnumber: {
					required: true
				},
				txt_c_address: {
					required: true
				},
				txt_c_phonenumber: {
					required: true
				},
				txt_c_mobilenumber: {
					required: true
				},
				txt_c_fax: {
					required: true
				},
				txt_c_email: {
					required: true
				},
				txt_c_masternumber: {
					required: true
				},
				txt_c_insurednumber: {
					required: true
				}
			}
		});
        
    });
    // set searchbox detail(set session)
	$("#btn_select_contract").on("click", function(){
		var contract_id = $(this).data('contract_id');
		$.ajax({
            type: "POST",
            url: base_url+'acontract/setglobalcontract',
            data: {'contract_id':contract_id},
            dataType: 'text',
            success: function(result){
            	window.location.reload();
            }
        });
	});
    $("#btn_delete_contract").on("click", function(){
        if(confirm('名簿から削除します。')){
            var contract_id = $(this).data("contract_id");
            $.ajax({
                type: "POST",
                url: base_url+'acontract/cdelete',
                data: {'contract_id': contract_id},
                dataType: 'text',
                success: function(result){
                    if(result == '0'){
                        alert("資料基地エラーです。 削除に失敗しました。");
                        location.href = base_url+"acontract/clist";
                    }else{
                        alert("削除が完了しました。");
                        location.href = base_url+"acontract/clist";
                    }
                }
            });
        }else{
            return false;
        }
    });
	$("#btn_clear_contract").on("click", function(){
		$("#txt_c_furigana").val("");
		$("#txt_c_username").val("");
		$("#txt_c_symbol").val("");
		$("#sel_c_sex").val(0);
		$("#txt_c_birthday").val("");
		$("#txt_c_blood").val("");
		$("#txt_c_postnumber").val("");
		$("#txt_c_phonenumber").val("");
		$("#txt_c_address").val("");
		$("#txt_c_mobilenumber").val("");
		$("#txt_c_fax").val("");
		$("#txt_c_email").val("");
		$("#txt_c_masternumber").val('');
		$("#txt_c_insurednumber").val('');
		$("#sel_c_office_id").val(0);
		$("#txt_c_destination_note").val('');
		$("input[type=checkbox]").each(function(){
			this.checked = false;
		});
		$(".datepicker").each(function(){
			$(this).val("");
		});
		$("input[name=rd_c_destination]").each(function(){
			if($(this).val() == 0){
				$(this).attr('checked', 'checked');
			}else{
				$(this).removeAttr('checked');
			}
		});
		$("#txt_c_destination_furigana").val('');
		$("#txt_c_destination_username").val('');
		$("#txt_c_destination_postnumber").val('');
		$("#txt_c_destination_address").val('');
		$("#txt_c_destination_note").val('');

	});
	
	$("input[type=checkbox]").on("click", function(e) {
		if($("#hdn_change_fields").val().substring(0, 1) == ","){
    		var text = $("#hdn_change_fields").val().substring(1, $("#hdn_change_fields").val().length-1)
    		$("#hdn_change_fields").val(text);
    	}
    	var field_name = $(this).data('filter');

    	if(checkFields(field_name)){
    		removeField(field_name);
    	}else{
    		addField(field_name);
    	}
    });
	if($("input[name=rd_c_destination]:checked").val() == 0){
		$("#txt_c_destination_furigana").attr('readonly', 'readonly');
		$("#txt_c_destination_username").attr('readonly', 'readonly');
		$("#txt_c_destination_postnumber").attr('readonly', 'readonly');
		$("#txt_c_destination_address").attr('readonly', 'readonly');
		$("#txt_c_destination_note").attr('readonly', 'readonly');
		$("#txt_c_destination_furigana").val($("#txt_c_furigana").val());
		$("#txt_c_destination_username").val($("#txt_c_username").val());
		$("#txt_c_destination_postnumber").val($("#txt_c_postnumber").val());
		$("#txt_c_destination_address").val($("#txt_c_address").val());
		$("#txt_c_destination_note").val('');
	}else{
		$("#txt_c_destination_furigana").removeAttr('readonly');
		$("#txt_c_destination_username").removeAttr('readonly');
		$("#txt_c_destination_postnumber").removeAttr('readonly');
		$("#txt_c_destination_address").removeAttr('readonly');
		$("#txt_c_destination_note").removeAttr('readonly');
	}
	$("input[name=rd_c_destination]").on('click', function(){
		if($(this).val()==0){
			$("#txt_c_destination_furigana").attr('readonly', 'readonly');
			$("#txt_c_destination_username").attr('readonly', 'readonly');
			$("#txt_c_destination_postnumber").attr('readonly', 'readonly');
			$("#txt_c_destination_address").attr('readonly', 'readonly');
			$("#txt_c_destination_note").attr('readonly', 'readonly');
			$("#txt_c_destination_furigana").val($("#txt_c_furigana").val());
			$("#txt_c_destination_username").val($("#txt_c_username").val());
			$("#txt_c_destination_postnumber").val($("#txt_c_postnumber").val());
			$("#txt_c_destination_address").val($("#txt_c_address").val());
			$("#txt_c_destination_note").val('');
		}else{
			$("#txt_c_destination_furigana").removeAttr('readonly');
			$("#txt_c_destination_username").removeAttr('readonly');
			$("#txt_c_destination_postnumber").removeAttr('readonly');
			$("#txt_c_destination_address").removeAttr('readonly');
			$("#txt_c_destination_note").removeAttr('readonly');
		}
	});

	function checkFields(field_name){
    	var fields = $("#hdn_change_fields").val().substring(0, $("#hdn_change_fields").val().length-1);
    	var fields_array = fields.split(',');
    	for (var index in fields_array) {
		  if(field_name == fields_array[index]){
		  	return true;
		  }
		}
		return false;
    }
    function removeField(field_name){
    	var fields = $("#hdn_change_fields").val().substring(0, $("#hdn_change_fields").val().length-1);
    	var fields_array = fields.split(',');
    	var i = fields_array.indexOf(field_name);
		if(i != -1) {
			fields_array.splice(i, 1);
		}
		$("#hdn_change_fields").val(fields_array.join() + ",");
    }
    function addField(field_name){
    	var origin = $("#hdn_change_fields").val();
    	$("#hdn_change_fields").val(origin + field_name +  ",");
    }
});
