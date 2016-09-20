
jQuery(document).ready(function() {
	var form = $('#frm_insurance_list');
    $("#btn_user_search_clear").on("click", function(){
    	$("#txt_user_search_keyword").val("");

    	form.submit();
    });

    $(".pagination_normal_item").on("click", function(){
        if(!$(this).parent().hasClass("disabled")){
            $("#hdn_user_cur_page").val($(this).data("page_id"));
            form.submit();
        }
    	
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

	
});
