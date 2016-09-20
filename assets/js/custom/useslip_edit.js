jQuery(document).ready(function() {
	if (jQuery().timepicker) {
        $('.timepicker-no-seconds').timepicker({
            autoclose: true,
            minuteStep: 5
        });
        // handle input group button click
        $('.timepicker').parent('.input-group').on('click', '.input-group-addon', function(e){
            e.preventDefault();

            $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
        });
    }
	var useslipfrm = $('#frm_useslip_edit');
    var error = $('.alert-error', useslipfrm);
    var success = $('.alert-success', useslipfrm);

    // event while click useslips delete button
	$("#btn_useslips_delete").on("click", function(){
		if(!checkuseslipslistchkbox()){
			alert('項目を選択してください。');
		}else{
			if(confirm('選択した項目を本当に削除しますか？')){
				$("#hdn_useslip_edit_manage_flag").val('3');
				var params = useslipfrm.serialize();
				$.ajax({
					type: "POST",
					url: base_url+'auseslip/usdelete',
					data: params,
					dataType: 'text',
					success: function(result){
						if(result == '1'){
							alert("削除が完了しました。");
                            $("#hdn_useslip_edit_manage_flag").val('0');			
							location.reload();		
						}else{
							alert("削除に失敗しました。");
                            $("#hdn_useslip_edit_manage_flag").val('0');
							location.reload();
						}
					}
				});
			}
		}
	});
	//////////
	// event while click useslips copy button
	$("#btn_useslips_copy").on("click", function(){
		if(!checkuseslipslistchkbox()){
			alert('項目を選択してください。');
		}else{
            if(confirm("コピーすると、その月のデータが失われます。それでもコピーしますか？")){
                $("#hdn_useslip_edit_manage_flag").val('2');
                var params = useslipfrm.serialize();
                $.ajax({
                    type: "POST",
                    url: base_url+'auseslip/uscopy',
                    data: params,
                    dataType: 'text',
                    success: function(result){
                        if(result == '1'){
                            alert("コピーが完了しました。");
                            $("#hdn_useslip_edit_manage_flag").val('0');         
                            location.reload();      
                        }else{
                            alert("コピーが失敗しました。");
                            $("#hdn_useslip_edit_manage_flag").val('0');
                            location.reload();
                        }
                    }
                });
            }
		}
	});
	///////////
	// event while click useslips update button
	$("#btn_useslips_update").on("click", function(){
		if(!checkuseslipslistchkbox()){
			alert('項目を選択してください。');
		}else{
			$("#hdn_useslip_edit_manage_flag").val('1');
			useslipfrm.action = base_url + "auseslips/usedit";
			useslipfrm.submit();
		}
	});
	///////////
	// event while click useslips add button
	$("#btn_useslips_add").on("click", function(){
		$("#hdn_useslip_edit_manage_flag").val('0');
		if($("#hdn_useslip_contract_id").val() == 0){
    		alert("利用者（被保険者）を選択してください。");
    		return false;
    	}
    	$(".chk_uselip_data_item").each(function(){
    		$(this).parent().next().removeClass('cor_active');
    		$(this).removeAttr('checked');
    	});
    	$("#chk_useslips_list_all").removeAttr("checked");
    	useslipfrm.action = base_url + "auseslips/usedit";
		useslipfrm.submit();
	});
	///////////

    // validation useslip data and adding
    $.validator.setDefaults({
		submitHandler: function() {
			var params = useslipfrm.serialize();
			$.ajax({
				type: "POST",
				url: base_url+'auseslip/usedit_accept',
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

    $('#btn_useslip_edit_save').on('click', function(e) {
    	if($("#hdn_useslip_contract_id").val() == 0){
    		alert("利用者（被保険者）を選択してください。");
    		return false;
    	}
    	
    	displaycheckboxerror();
    	useslipfrm.validate({
			rules: {
				txt_useslip_service_code: {
					required: true
				},
				txt_useslip_service_unit: {
					required: true
				},
				txt_useslip_consumption_tax: {
					required: true
				},
				hdn_useslip_select_week: {
					required: true
				}
			}
		});
        
    });


    //////////////////////////////////////////////////////////////////////

    //set sevice code and unit while user select btn_useslip_select button
    $(".btn_useslip_select").on("click", function(){
    	var sid = $(this).data("filter_sid");
    	var unit = $(this).data("filter_unit");
    	$("#txt_useslip_service_code").val(sid);
    	$("#txt_useslip_service_unit").val(unit);
    	$(".userslip_service_code_list").each(function(){
    		$(this).removeClass("cor_active");
    	});
    	$(this).parent().parent().addClass("cor_active");
    });
    // set all day of week while click chk_useslip_select_all_week checkbox
    $("#chk_useslip_select_all_week").on("click", function(){
    	if(this.checked){
    		$(".chk_useslip_week_item input").each(function(){
	    		this.checked = true;
	    	});
    	}else{
    		$(".chk_useslip_week_item input").each(function(){
	    		this.checked = false;
	    	});
    	}
    	displaycheckboxerror();
    });
    $(".chk_useslip_week_item :input").on("click", function(){
    	if($("#chk_useslip_select_all_week").is(':checked')){
    		$("#chk_useslip_select_all_week").attr('checked', false);
    	}
    	displaycheckboxerror();
    });

    // return false while user don't check the week checkbox
    function checkweeks(){
    	var checked = false;
    	$(".chk_useslip_week_item input").each(function(){
    		if(this.checked == true){
    			checked = true;
    			return checked;
    		}
    	});
    	return checked;
    }
    function displaycheckboxerror(){
    	if(!checkweeks()){
			$("#chk_useslip_error").css("display", "block");
		}else{
			$("#chk_useslip_error").css("display", "none");
		}
    }
    function checkuseslipslistchkbox(){
    	var flag = false;
    	$(".chk_uselip_data_item").each(function(){
    		$(this).parent().next().removeClass('cor_active');
    		if($(this).attr('checked')){
    			flag = true;
    		}
    	});
    	return flag;
    }

    //////////////////////////////////////
    /// useslip view form
    //////////////////////////////////////
    $("#sel_useslip_month").on("change", function(){
    	$("#sel_useslip_current_weeks").val(1);
    	useslipfrm.action = base_url + "auseslip/usedit";
    	useslipfrm.submit();
    });
    $("#sel_useslip_current_weeks").on("change", function(){
    	useslipfrm.action = base_url + "auseslip/usedit";
    	useslipfrm.submit();
    });
    
    // click chk_uselip_data_item
    $(".chk_uselip_data_item").on("click", function(){
    	if($(this).attr('checked')){
    		$(this).removeAttr('checked');
    		$(this).parent().next().removeClass('cor_active');
    	}else{
    		$(this).attr('checked', 'checked');
    		$(this).parent().next().addClass('cor_active');
    	}
    });
    // click all chk button
    $("#chk_useslips_list_all").on('click', function(){
    	if($(this).attr('checked')){
    		$(this).removeAttr('checked');
    		$(".chk_uselip_data_item").each(function(){
    			$(this).removeAttr('checked');
    			this.checked = "";
    			$(this).parent().next().removeClass('cor_active');
    		});
    	}else{
    		$(this).attr('checked', 'checked');
    		$(".chk_uselip_data_item").each(function(){
    			$(this).attr('checked', 'checked');
    			this.checked = "checked";
    			$(this).parent().next().addClass('cor_active');
    		});
    	}
    });
});