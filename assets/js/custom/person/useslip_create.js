jQuery(document).ready(function() {
	var useslipcreatefrm = $('#frm_useslip_create');
	var useslipcreatemodalfrm = $('#frm_useslip_input_modal');
	
	// show input useslip modal
	$(".us_input_result").on("click", function(){
		var ur_id = $(this).data("filter_ur_id");
		var us_year = $("#hdn_useslip_year").val();
		var us_month = $("#sel_useslip_month").val();

		//input modal hidden ur field
		$("#hdn_modal_us_id").val(ur_id);
		///
		params = "us_create_id="+ur_id+"&useslip_year="+us_year+"&useslip_month="+us_month;
		$.ajax({
			type: "POST",
			url: base_url+'puseslip/uscreate_get_monthly_data_by_usid',
			data: params,
			dataType: 'json',
			success: function(result){
				var schedule_html = "<td>予定</td>";
				var result_html = "<td>実績</td>";
				for (var i = 0; i < result.length; i++) {
					if(result[i]['data'].length == 0){
						schedule_html += "<td class='td-small'></td>";
						result_html += "<td class='td-small'></td>";
					}else{
						schedule_html += "<td class='td-small'>"+result[i]['data'][0]['ur_schedule_unit']+"</td>";
						result_html += "<td class='td-small'><input type='text' class='input-sm us_input' name='txt_ur_"+result[i]['data'][0]['ur_date']+"' id='txt_ur_"+result[i]['data'][0]['ur_date']+"' value='"+result[i]['data'][0]['ur_result_unit']+"' /></td>";
					}
					
				}
				$("#ur_schedule_panel").html(schedule_html);
				$("#ur_result_panel").html(result_html);
				$("#modal_useslip_input_result_form").modal("show");
			}
		});
	});
	//input useslip result
	$("#btn_useslip_create_modal_save").on("click", function(){
		//check inputed result 
		var flag = 0;
		$("#frm_useslip_input_modal input[type=text]").each(function(){
			if(isNaN(parseFloat($(this).val()))){
				flag = 1;
				$(this).css("border", "3px solid #f0ad4e");
			}
				
		});
		if(flag == 1)
			return false;
		//
		var params = useslipcreatemodalfrm.serialize();
		$.ajax({
			type: "POST",
			url: base_url+'puseslip/uscreate_accept',
			data: params,
			dataType: 'text',
			success: function(result){
				alert('登録が完了しました。');
				$("#modal_useslip_input_result_form").modal("hide");
				location.reload();
			}
		});
	});
	// close input useslip modal
	$("#btn_useslip_input_result_close").on("click", function(){
		$("#modal_useslip_input_result_form").modal("hide");
	});
	//select month
	$("#sel_useslip_month").on("change", function(){
    	useslipcreatefrm.action = base_url + "puseslip/uscreate";
    	useslipcreatefrm.submit();
    });

	function isFloat(x) {
		return n === +n && n !== (n|0);
	}
    
});