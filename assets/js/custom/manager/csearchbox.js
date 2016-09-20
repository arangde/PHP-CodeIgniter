
jQuery(document).ready(function() {
	var searchForm = $('#frm_searchbox_contract');
	// show search contract modal
	$("#btn_csearchbox_select").on("click", function(){
		$("#modal_select_contact_form").modal("show");
	});
	// close search contract modal
	$("#btn_csearchbox_close").on("click", function(){
		$("#modal_select_contact_form").modal("hide");
	});
	// set searchbox detail(set session)
	$("#btn_csearchbox_update").on("click", function(){
		var contract_id = $("#hdn_searchbox_global_contract_id").val();
		$.ajax({
            type: "POST",
            url: base_url+'mcontract/setglobalcontract',
            data: {'contract_id':contract_id},
            dataType: 'text',
            success: function(result){
            	window.location.reload();
            }
        });
	});
	//init Contract list in search contract modal
	initContractList();
	//click search button in search contract modal
	$("#btn_searchbox_contract_search").on("click", function(){
		initContractList();
	});
	// click clear button in search contract modal
	 $("#btn_searchbox_search_clear").on("click", function(){
    	$("#txt_searchbox_search_keyword").val("");
    	$("#hdn_searchbox_search_kana_id").val(0);
    	
    	$(".searchbox-select-kana").removeClass("active");
    	$(".ul-searchbox-kana li:first").addClass("active");

    	initContractList();
    });

	// click kana button in search contract modal
    $("#ajax_panel").on("click",".searchbox-select-kana", function(){

    	if(!$(this).hasClass("active")){
            $("#hdn_searchbox_cur_page").val(1);
	    	$("#hdn_searchbox_search_kana_id").val($(this).data("kana_value"));
	    	initContractList();
	    }
    });
    // click pagination button in search contract modal
    $("#ajax_panel").on("click", ".searchbox_pagination_normal_item", function(){
        if(!$(this).parent().hasClass("disabled")){
            $("#hdn_searchbox_cur_page").val($(this).data("page_id"));
            initContractList();
        }
    	
    });
    // click history button in search contract modal
    $("#ajax_panel").on("click", "#searchbox_history_view", function(){
        $("#hdn_searchbox_history_flag").val(1);
        initContractList();
    });
    // click search button beside history button in search contract modal
    $("#ajax_panel").on("click", "#searchbox_search_view", function(){
    	$("#hdn_searchbox_history_flag").val(0);
        initContractList();
    });
    // click select button in search contract list
    $("#ajax_panel").on("click", ".btn-searchbox-detail", function(){
    	var contract_id = $(this).data('filter');
    	
    	$.ajax({
            type: "POST",
            url: base_url+'mcontract/ajaxcontract',
            data: {'contract_id':contract_id},
            dataType: 'json',
            success: function(result){
            	setSearchboxGlobal(result);
                $("#modal_select_contact_form").modal("hide");
            }
        });
        
    });
    // set searchbox global text 
    function setSearchboxGlobal(contract_data){
    	$("#hdn_searchbox_global_contract_id").val(contract_data['contract_id']);
    	$("#txt_searchbox_global_contractname").val(contract_data['c_username']);
    }
    // get contract list function
	function initContractList(){
		var searchParams = searchForm.serialize();
		$.ajax({
            type: "POST",
            url: base_url+'mcontract/ajaxlist',
            data: searchParams,
            dataType: 'json',
            success: function(result){
                makeSearchList(result);
            }
        });
	}
	// make contract list html funciton
	function makeSearchList(ajaxReturn){
		$("#ajax_panel").html("");
		var inner_html = "";
			inner_html += "<div class='row'>";
            inner_html += "    <div class='col-md-12'>";
            inner_html += "        <ul class='nav nav-tabs alphabet-filter ul-searchbox-kana'>";
            var active_kana = "";
            for (var i = 0; i < g_kana.length; i++) {

            	if(i == ajaxReturn['kana']){
            		active_kana = "active";
            	}else{
            		active_kana = "";
            	}
            	inner_html += "<li role='presentation' class='searchbox-select-kana "+active_kana+"'  data-kana_value='"+i+"'><a href='#'>"+g_kana[i][0]+"</a></li>";
            	g_kana[i]
            }
            
            inner_html += "<li role='presentation' class='pull-right " +  ((ajaxReturn['history_flag']==0)?'active':'') + "' name='searchbox_search_view' id='searchbox_search_view'><a href='#'>検索</a></li>";
            inner_html += "<li role='presentation' class='pull-right " +  ((ajaxReturn['history_flag']==1)?'active':'') + "' name='searchbox_history_view' id='searchbox_history_view'><a href='#'>履歴</a></li>";

            inner_html += "			</ul>";
            inner_html += "		</div>";
            inner_html += "</div>";

            /* contract table list*/
            inner_html += "<table class='table-green'>";
            inner_html += "		<tr>";
            inner_html += "        <td class='text-center col-sm-1'>選択</td>";
            inner_html += "        <td class='text-center col-sm-1'>削除</td>";
            inner_html += "        <td class='text-center col-sm-2'>氏名</td>";
            inner_html += "        <td class='text-center'>年齢</td>";
            inner_html += "        <td class='text-center'>介護度</td>";
            inner_html += "        <td class='text-center'>認定状況</td>";
            inner_html += "        <td class='text-center col-sm-2'>保険者</td>";
            inner_html += "        <td class='text-center col-sm-2'>支援事業者</td>";
            inner_html += "        <td class='text-center col-sm-2'>担当者</td>";
            inner_html += "    </tr>";

            if(ajaxReturn['history_flag'] == 1){
            	if(ajaxReturn['history_list'].length == 0){
            		inner_html += "<tr>";
                    inner_html += "    <td class='text-center col-sm-12' colspan='9'>検出された資料がありません。</td>";
                    inner_html += "</tr>";
            	}else{
            		for (var i = 0; i < ajaxReturn['history_list'].length; i++) {
            			inner_html += "<tr>";
                        inner_html += "    <td class='text-center'><a href='#' data-filter='"+ajaxReturn['history_list'][i]['contract_id']+"' class='btn btn-xs btn-default btn-searchbox-detail'>選択</a></td>";
                        inner_html += "    <td class='text-center'><a href='#'  class='btn btn-xs btn-default delete_contract disabled' >削除</a></td>";
                        inner_html += "    <td>"+ ajaxReturn['history_list'][i]['c_username']+"</td>";
                        inner_html += "    <td>"+ ajaxReturn['history_list'][i]['c_birthday']+"</td>";
                        inner_html += "    <td>介護度</td>";
                        inner_html += "    <td>認定状況</td>";
                        inner_html += "    <td>"+ ajaxReturn['history_list'][i]['c_masternumber']+"</td>";
                        inner_html += "    <td>"+ ajaxReturn['history_list'][i]['office_id']+"</td>";
                        inner_html += "    <td>"+ ajaxReturn['history_list'][i]['c_masternumber']+"</td>";
                        inner_html += " </tr>";
            			
            		}
            	}
            }else{
            	if(ajaxReturn['contract_list'].length == 0){
            		inner_html += "<tr>";
                    inner_html += "    <td class='text-center col-sm-12' colspan='9'>検出された資料がありません。</td>";
                    inner_html += "</tr>";
            	}else{
            		for (var i = 0; i < ajaxReturn['contract_list'].length; i++) {
            			inner_html += "<tr>";
                        inner_html += "    <td class='text-center'><a href='#' data-filter='"+ajaxReturn['contract_list'][i]['contract_id']+"' class='btn btn-xs btn-default btn-searchbox-detail'>選択</a></td>";
                        inner_html += "    <td class='text-center'><a href='#'  class='btn btn-xs btn-default delete_contract disabled' >削除</a></td>";
                        inner_html += "    <td>"+ ajaxReturn['contract_list'][i]['c_username']+"</td>";
                        inner_html += "    <td>"+ ajaxReturn['contract_list'][i]['c_birthday']+"</td>";
                        inner_html += "    <td>介護度</td>";
                        inner_html += "    <td>認定状況</td>";
                        inner_html += "    <td>"+ ajaxReturn['contract_list'][i]['c_masternumber']+"</td>";
                        inner_html += "    <td>"+ ajaxReturn['contract_list'][i]['office_id']+"</td>";
                        inner_html += "    <td>"+ ajaxReturn['contract_list'][i]['c_masternumber']+"</td>";
                        inner_html += " </tr>";
            			
            		}
            	}
            }
            inner_html += "</table>";
            /* pagination*/
            if(ajaxReturn['page_count'] > 1 && ajaxReturn['history_flag'] == 0){
            	inner_html += "<div class='row'>";
	            inner_html += "    <div class='col-md-12'>";
	            inner_html += "        <nav class='text-center'>";
	            inner_html += "          <ul class='pagination'>";
	            inner_html += "            <li>";
	            inner_html += "                <span aria-hidden='true'>Page "+ajaxReturn['cur_page']+"/"+ajaxReturn['page_count']+"</span>";
	            inner_html += "            </li>";

	            var active_pagination_1 = (ajaxReturn['cur_page']<2)?'disabled':'';

	            inner_html += "            <li class='"+active_pagination_1+"'>";
	            inner_html += "              <a href='#' aria-label='First' class='searchbox_pagination_normal_item ' data-page_id='1'>";
	            inner_html += "                <span aria-hidden='true'>最初</span>";
	            inner_html += "             </a>";

	            var active_pagination_2 = (ajaxReturn['cur_page']<2)?'disabled':'';


	            var page_id_prev = (ajaxReturn['cur_page'] == 1)?ajaxReturn['cur_page']:(ajaxReturn['cur_page']-1);

	            inner_html += "            </li>";
	            inner_html += "            <li class='"+ active_pagination_2+"'>";
	            inner_html += "              <a href='#' aria-label='Previous'  class='searchbox_pagination_normal_item ' data-page_id='"+page_id_prev+"'>";
	            inner_html += "                <span aria-hidden='true'>前へ</span>";
	            inner_html += "              </a>";
	            inner_html += "            </li>";

	            var page_start;
                if((ajaxReturn['cur_page'] < 4)){
                    page_start = 0;
                }else{
                    if(ajaxReturn['page_count']-ajaxReturn['cur_page'] < 7){
                        if(ajaxReturn['page_count'] < 10){
                            page_start = 0;
                        }else{
                        	page_start = page_count - 10;
                        }
                    }else{
                        page_start = ajaxReturn['page_count']-4;
                    }
                }

                

	            for(i = page_start; (i < page_start+ajaxReturn['page_count']) && (i < page_start+10) && (i<ajaxReturn['page_count']); i++){

	            	var active_pagination_3 = (i == ajaxReturn['cur_page']-1)?'active':'';

				    inner_html += "<li class='" + active_pagination_3 + "'>";
				    inner_html += "    <a href='#' class='searchbox_pagination_normal_item '' data-page_id='"+(i+1)+"'>"+(i+1)+"</a>";
				    inner_html += "</li>";
				}

				var active_pagination_4 = (ajaxReturn['page_count']<=ajaxReturn['cur_page'])?'disabled':'';

	            inner_html += "            <li class='"+ active_pagination_4 +"'>";

	            var page_id_next = 1;
                if(ajaxReturn['cur_page'] == ajaxReturn['page_count']){
                    page_id_next = ajaxReturn['cur_page'];
                }else{
                    page_id_next = parseInt(ajaxReturn['cur_page'])+parseInt(1);
                }

	            inner_html += "              <a href='#' aria-label='Next' class='searchbox_pagination_normal_item '' data-page_id='"+ page_id_next +"'>";
	            inner_html += "                <span aria-hidden='true'>次へ</span>";
	            inner_html += "              </a>";
	            inner_html += "            </li>";

	            var active_pagination_5 = (ajaxReturn['page_count']<=ajaxReturn['cur_page'])?'disabled':'';

	            inner_html += "            <li class='"+ active_pagination_5 +"'>";
	            inner_html += "              <a href='#' aria-label='last' class='searchbox_pagination_normal_item ' data-page_id='"+ ajaxReturn['page_count']+"'>";
	            inner_html += "                <span aria-hidden='true'>最終</span>";
	            inner_html += "              </a>";
	            inner_html += "            </li>";
	            inner_html += "          </ul>";
	            inner_html += "        </nav>";
	            inner_html += "    </div>";
	            inner_html += "</div>";

            }
            $("#ajax_panel").html(inner_html);
	}
});
