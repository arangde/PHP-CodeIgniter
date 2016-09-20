    
    <div id="select_container">
        <?php echo $this->load->view('pcontract/csearchform'); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form id="contract_select_form" class="form-horizontal" id="frm_contract_select">
                        <input type="hidden" id="hdn_searchbox_global_contract_id" name="hdn_searchbox_global_contract_id" value="<?php echo isset($this->session->userdata['contract_data']['contract_id'])?$this->session->userdata['contract_data']['contract_id']:'';?>" />
                        <span>・選択中の利用者(被保険者)情報</span>
                        <table class="table-green th-center">
                            <tr>
                                <th>利用者名</th>
                                <td class="col-sm-2">
                                    <input type="text" id="txt_searchbox_global_contractname" name="txt_searchbox_global_contractname" class="form-control" value="<?php echo isset($this->session->userdata['contract_data']['c_username'])?$this->session->userdata['contract_data']['c_username']:'';?>" />
                                </td>
                                <th>性別・年齢</th>
                                <td class="col-sm-2">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="">
                                        </div>
                                    </div>
                                </td>
                                <th>介護度</th>
                                <td class="col-sm-1">
                                    <input type="text" class="form-control" id="">
                                </td>
                                <th>支給限度額</th>
                                <td class="col-sm-1">
                                    <input type="text" class="form-control" id="">
                                </td>
                                <th>変更後</th>
                                <td class="col-sm-1">
                                    <input type="text" class="form-control" id="">
                                </td>
                            </tr>
                            <tr>
                                <th>支援事業者</th>
                                <td class="col-sm-2">
                                    <input type="text" class="form-control" id="">
                                </td>
                                <th>被保険者番号</th>
                                <td><input type="text" class="form-control col-sm-2" id=""></td>
                                <th>認定状況</th>
                                <td class="col-sm-1">
                                    <input type="text" class="form-control" id="">
                                </td>
                                <th>適用期間</th>
                                <td class="col-sm-1">
                                    <input type="text" class="form-control" id="">
                                </td>
                                <th>変更日</th>
                                <td class="col-sm-1">
                                    <input type="text" class="form-control" id="">
                                </td>
                            </tr>
                            <tr>
                                <th>保険者</th>
                                <td class="col-sm-2">
                                    <input type="text" class="form-control" id="">
                                </td>
                                <th>担当者</th>
                                <td class="col-sm-2">
                                    <input type="text" class="form-control" id="">
                                </td>
                                <th>適用期間</th>
                                <td colspan="5">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control col-sm-2" id="">
                                        </div>
                                        <div class="col-sm-1">~</div>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control col-sm-2" id="">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="form-group">
                            <div class="orange-row">
                                <div class="row">
                                    <div class="col-md-8">
                                        利用者を選択していない場合で
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="javascript:void(0);" class="btn btn-success" id="btn_csearchbox_select">利用者を選択</a>
                                        <a href="javascript:void(0);" class="btn btn-success" id="btn_csearchbox_update">利用者情報の変更</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    