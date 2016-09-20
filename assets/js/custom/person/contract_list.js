
jQuery(document).ready(function() {
	var form = $('#frm_contract_list');
    $("#btn_search_clear").on("click", function(){
    	$("#txt_search_keyword").val("");
    	// $("#sel_user_search_employment").val(99);
    	// $("#sel_user_search_job").val(99);
    	// $("#sel_user_search_office").val(99);
    	$("#hdn_search_kana_id").val(0);
    	
    	$(".select-kana").removeClass("active");
    	$(".ul-kana li:first").addClass("active");

    	form.submit();
    });

    $(".select-kana").on("click", function(){
    	if(!$(this).hasClass("active")){
	    	$("#hdn_search_kana_id").val($(this).data("kana_value"));
	    	form.submit();
	    }
    });

    $(".pagination_normal_item").on("click", function(){
        if(!$(this).parent().hasClass("disabled")){
            $("#hdn_cur_page").val($(this).data("page_id"));
            form.submit();
        }
    	
    });
    $(".btn_delete_contract").on("click", function(){
        if(confirm('名簿から削除します。')){
            var contract_id = $(this).data("contract_id");
            $.ajax({
                type: "POST",
                url: base_url+'pcontract/cdelete',
                data: {'contract_id': contract_id},
                dataType: 'text',
                success: function(result){
                    if(result == '0'){
                        alert("資料基地エラーです。 削除に失敗しました。");
                        location.href = base_url+"pcontract/clist";
                    }else{
                        alert("削除が完了しました。");
                        location.href = base_url+"pcontract/clist";
                    }
                }
            });
        }else{
            return false;
        }
    });

    $("#user_history_view").on("click", function(){
        $("#hdn_history_flag").val(1);
        form.submit();
    });
    
    $("#user_search_view").on("click", function(){
        form.submit();
    });
	
});
