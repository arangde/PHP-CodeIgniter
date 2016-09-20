<?php global $g_kana;?>
<div class="modal" id="modal_select_contact_form">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<div class="modal-header">
				<div class="dark-bar">
			        <div class="row">
			        	<div class="col-md-12">
							<h4>利用者(被保険者)を選択する</h4>
							<a href="#" class="btn btn-success btn-close" id="btn_csearchbox_close">閉じる</a>
			           	</div>
			        </div>
			    </div>
			</div>
			<input type="hidden" name="user_id" id="user_id" value="" />
			<div class="modal-body">

			   <!-- <div id="page_container" class="container">-->
			        <div class="row">
			            <div class="col-md-12">
			                <div class="form-group">
			                    <div class="orange-row">利用者検索には、「キーワード検索」と「絞り込み」が使えます。「利用者の選択」、「詳細確認」、「削除」が可能です。</div>
			                </div>
			            </div>
			        </div>

			        <div class="search-area">
			            <form class="horizontal-form" name="frm_searchbox_contract" id="frm_searchbox_contract">
			            	<input type="hidden" name="hdn_searchbox_search_kana_id" id="hdn_searchbox_search_kana_id" value="" />
			                <input type="hidden" name="hdn_searchbox_cur_page" id="hdn_searchbox_cur_page" value="" />
			                <input type="hidden" name="hdn_searchbox_history_flag" id="hdn_searchbox_history_flag" value="0" />
			                <div class="row form-group">
			                    <div class="col-sm-9">
			                        <div class="input-group">
			                            <span class="input-group-addon" id="sizing-addon2">
			                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			                            </span>
			                            <input type="text" class="form-control" aria-describedby="sizing-addon2" name="txt_searchbox_search_keyword" id="txt_searchbox_search_keyword" value="">
			                        </div>
			                    </div>
			                    <div class="col-sm-3">
			                        <input type="button" class="btn btn-danger col-sm-12" name="btn_searchbox_contract_search" id="btn_searchbox_contract_search" value="検索する"/>
			                    </div>
			                </div>
			                <div class="row form-group">
			                    <div class="col-sm-3">
			                        <select class="form-control" name="sel_searchbox_contract_office" id="sel_searchbox_contract_office">
			                            <option>支援事業者で絞り込む</option>
			                        </select>
			                    </div>
			                    <div class="col-sm-3">
			                        <select class="form-control" name="sel_searchbox_contract_manager" id="sel_searchbox_contract_manager">
			                            <option>担当者で絞り込む</option>
			                        </select>
			                    </div>
			                    <div class="col-sm-3">
			                        <select class="form-control" name="sel_searchbox_insurance" id="sel_searchbox_insurance">
			                            <option>保険者で絞り込む</option>
			                        </select>
			                    </div>
			                    <div class="col-sm-3">
			                        <select class="form-control" name="sel_searchbox_certification_state" id="sel_searchbox_certification_state">
			                            <option>認定状況で絞り込む</option>
			                        </select>
			                    </div>
			                </div>
			                <div class="row form-group">
			                    <div class="col-sm-3">
			                        <select class="form-control" name="sel_searchbox_protect_degree" id="sel_searchbox_protect_degree">
			                            <option>介護度で絞り込む</option>
			                        </select>
			                    </div>
			                    <div class="col-sm-3">
			                        <select class="form-control" name="sel_searchbox_age" id="sel_searchbox_age">
			                            <option>年齢で絞り込む</option>
			                        </select>
			                    </div>
			                    <div class="col-sm-3">
			                        <select class="form-control" name="sel_searchbox_sex" id="sel_searchbox_sex">
			                            <option>性別で絞り込む</option>
			                        </select>
			                    </div>
			                    <div class="col-sm-3">
			                        <input type="button" class="btn btn-danger col-sm-12" name="btn_searchbox_search_clear" id="btn_searchbox_search_clear" value="絞り込みをクリア"/>
			                    </div>
			                </div>
			            <div  name="ajax_panel" id="ajax_panel">
           	 			</div>
			            
			        </form>
			    </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var g_kana = <?php echo json_encode($g_kana);?>;
</script>