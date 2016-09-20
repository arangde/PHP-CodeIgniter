jQuery(document).ready(function() {
	$('.datepicker').datepicker({ dateFormat: 'yyyy-mm-dd' });
	var certinfoform = $('#frm_certinfo_manage');
    var error = $('.alert-error', certinfoform);
    var success = $('.alert-success', certinfoform);
	// event while click certinfo delete button
	$("#btn_certinfo_delete").on("click", function(){
		if(!checkcertlistchkbox()){
			alert('項目を選択してください。');
		}else{
			if(confirm('選択した項目を本当に削除しますか？')){
				$("#hdn_certinfo_manage_flag").val('3');
				var params = certinfoform.serialize();
				$.ajax({
					type: "POST",
					url: base_url+'pcertinfo/certdelete',
					data: params,
					dataType: 'text',
					success: function(result){
						$("#hdn_certinfo_manage_flag").val('3');
						if(result == '1'){
							alert("削除が完了しました。");			
							location.href=base_url+"pcertinfo/manage";
						}else{
							alert("削除に失敗しました。");
							location.href=base_url+"pcertinfo/manage";
						}
					}
				});
			}
		}
	});
	//////////
	// event while click certinfo update button
	$("#btn_certinfo_update").on("click", function(){
		if(!checkcertlistchkbox()){
			alert('項目を選択してください。');
		}else{
			$("#hdn_certinfo_manage_flag").val(2);
			certinfoform.action = base_url + "pcertinfo/manage";
			certinfoform.submit();
		}
	});
	///////////
	// event while click certinfo modify button
	$("#btn_certinfo_modify").on("click", function(){
		if(!checkcertlistchkbox()){
			alert('項目を選択してください。');
		}else{
			$("#hdn_certinfo_manage_flag").val(1);
			certinfoform.action = base_url + "pcertinfo/manage";
			certinfoform.submit();
		}
	});
	///////////
	// event while click certinfo add button
	$("#btn_certinfo_add").on("click", function(){
		$("#hdn_certinfo_manage_flag").val(0);
		if($("#txt_certinfo_contract_id").val() == 0){
    		alert("利用者（被保険者）を選択してください。");
    		return false;
    	}
    	$(".chk_certinfo_list").each(function(){
    		$(this).parent().parent().removeClass('cor_active');
    		$(this).removeAttr('checked');
    	});
    	certinfoform.action = base_url + "pcertinfo/manage";
		certinfoform.submit();
	});
	///////////

	$.validator.setDefaults({
		submitHandler: function() {
			$("#txt_certinfo_contract_id").val(0);
			var params = certinfoform.serialize();
			$.ajax({
				type: "POST",
				url: base_url+'pcertinfo/manage_accept',
				data: params,
				dataType: 'text',
				success: function(result){
					if(result == '0'){
						alert("登録が完了しました。");			
						location.reload();		
					}else if(result == '1'){
						alert("訂正が完了しました。");
						location.reload();
					}else if(result == '2'){
						alert("更新が完了しました。");
						location.reload();
					}
				}
			});
		}
	});

    $('#btn_certinfo_manage_save').on('click', function(e) {
    	if($("#txt_certinfo_contract_id").val() == 0){
    		alert("利用者（被保険者）を選択してください。");
    		return false;
    	}
    	certinfoform.validate({
			rules: {
				txt_certinfo_contract_id: {
					required: true
				},
				txt_certinfo_benefit_rate: {
					required: true
				},
				txt_certinfo_classification_max_payment: {
					required: true
				}
			}
		});
        
    });
    $(".chk_certinfo_list").on('click', function(){
    	if($(this).attr('checked')){
    		$(this).removeAttr('checked');
    		$(this).parent().parent().removeClass('cor_active');
    	}else{
    		$(this).attr('checked', 'checked');
    		$(this).parent().parent().addClass('cor_active');
    	}
    });
    $("#chk_certinfo_all").on('click', function(){
    	if($(this).attr('checked')){
    		$(this).removeAttr('checked');
    		$(".chk_certinfo_list").each(function(){
    			$(this).removeAttr('checked');
    			this.checked = "";
    			$(this).parent().parent().removeClass('cor_active');
    		});
    	}else{
    		$(this).attr('checked', 'checked');
    		$(".chk_certinfo_list").each(function(){
    			$(this).attr('checked', 'checked');
    			this.checked = "checked";
    			$(this).parent().parent().addClass('cor_active');
    		});
    	}
    });
    function checkcertlistchkbox(){
    	var flag = false;
    	$(".chk_certinfo_list").each(function(){
    		$(this).parent().parent().removeClass('cor_active');
    		if($(this).attr('checked')){
    			flag = true;
    		}
    	});
    	return flag;
    }
});