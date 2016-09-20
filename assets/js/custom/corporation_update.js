
jQuery(document).ready(function() {

	var form = $('#frm_corporation_update');
    var error = $('.alert-error', form);
    var success = $('.alert-success', form);
    
    $.validator.setDefaults({
		submitHandler: function() {
			var params = form.serialize();
			$.ajax({
				type: "POST",
				url: base_url+'acorporation/subscription_accept',
				data: params,
				dataType: 'text',
				success: function(result){
					if(result == '1'){
						alert("登録が完了しました。");
						location.reload();
					}else if(result == '2'){
						alert("資料基地エラーです。 登録に失敗しました。");
						location.reload();
					}
				}
			});
			
		}
	});
	$('#btn_corporation_update_subscription').on('click', function(e) {
		form.removeData('validator');
    	if($("#hdn_change_fields").val().substring(0, 1) == ","){
    		var text = $("#hdn_change_fields").val().substring(1, $("#hdn_change_fields").val().length-1)
    		$("#hdn_change_fields").val(text);
    	}
		var validation = new Array();
		var fields = $("#hdn_change_fields").val().substring(0, $("#hdn_change_fields").val().length-1);
    	var fields_array = fields.split(',');
    	if(fields == ""){
    		alert('変更された項目がありません。');
    		return false;
    	}
    	validation.rules = {};
    	for (var index in fields_array) {
    		var sp_text = fields_array[index].split(":");
    		var f_txt = sp_text[0];
		  	validation.rules[f_txt] = {required:true};
		}
    	form.validate(validation);
        
    });
    $(".select_corporation").on("click", function(e) {
    	var field_name = $(this).data('filter');
    	var field_db_name = $(this).data('filter_db');
    	if(checkFields(field_name, field_db_name)){
    		removeField(field_name, field_db_name);
    		//$("#"+field_name).next().remove();
    	}else{
    		addField(field_name, field_db_name);
    	}
    	if($(this).next().hasClass('cor_active')){
    		$(this).next().removeClass('cor_active');
    		$(this).next().addClass('cor_inactive');
    	}else{
    		$(this).next().removeClass('cor_inactive');
    		$(this).next().addClass('cor_active');
    	}
    	//$(this).next().css({'border' : '3px solid #f0ad4e'});
    });
    
    
    function checkFields(field_name, field_db_name){
    	var fields = $("#hdn_change_fields").val().substring(0, $("#hdn_change_fields").val().length-1);
    	var fields_array = fields.split(',');
    	for (var index in fields_array) {
		  if(field_name + ":" + field_db_name == fields_array[index]){
		  	return true;
		  }
		}
		return false;
    }
    function removeField(field_name, field_db_name){
    	var fields = $("#hdn_change_fields").val().substring(0, $("#hdn_change_fields").val().length-1);
    	var fields_array = fields.split(',');
    	var i = fields_array.indexOf(field_name + ":" + field_db_name);
		if(i != -1) {
			fields_array.splice(i, 1);
		}
		$("#hdn_change_fields").val(fields_array.join() + ",");
    }
    function addField(field_name, field_db_name){
    	var origin = $("#hdn_change_fields").val();
    	$("#hdn_change_fields").val(origin + field_name + ":" + field_db_name + ",");
    }
});
