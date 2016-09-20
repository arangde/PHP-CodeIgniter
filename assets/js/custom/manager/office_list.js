
jQuery(document).ready(function() {
	var form = $('#frm_office_list');
    $("#btn_search_clear").on("click", function(){
    	$("#txt_search_keyword").val("");

    	form.submit();
    });

    $(".pagination_normal_item").on("click", function(){
        if(!$(this).parent().hasClass("disabled")){
            $("#hdn_user_cur_page").val($(this).data("page_id"));
            form.submit();
        }
    	
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

	
});
