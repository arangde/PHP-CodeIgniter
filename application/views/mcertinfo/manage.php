    <?php global $g_certification_status, $g_protect_degree;?>
    <?php echo $this->load->view('mcontract/csearchbox'); ?>
    <div class="dark-bar">
        <h4>認定情報の登録・更新・訂正・削除</h4>
    </div>
    <form class="horizontal-form" name="frm_certinfo_manage" id="frm_certinfo_manage" method="post">
        <input type="hidden" name="hdn_certinfo_manage_flag" id="hdn_certinfo_manage_flag" value="<?php echo $certinfo_manage_flag;?>" />
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="orange-row">利用者は、「検索」「絞り込み」を使うと探しやすいです。</div>
                </div>
            </div>
        </div>

            <?php if(!isset($this->session->userdata['contract_data'])){?>
                <span>利用者（被保険者）を選択してください。</span>
            <?php }else{?>
                <span><?php echo $this->session->userdata['contract_data']['c_username']?>さんの保険・認定情報一覧</span>
            <?php }?>
            
            <table class="table-green">
                <tr>
                    <th class="text-center">対象</th>
                    <th class="text-center">保険者</th>
                    <th class="text-center">被保険者番号</th>
                    <th class="text-center col-sm-3">保険有効期限</th>
                    <th class="text-center">要介護度</th>
                    <th class="text-center">認定年月日</th>
                    <th class="text-center col-sm-3">認定有効期限</th>
                </tr>
                <?php if(count($certinfolist) > 0){?>
                    <?php foreach($certinfolist as $cert){?>
                    <tr class="<?php echo ($checked == $cert['certinfo_id'])?'cor_active':'';?>">
                        <td class="text-center"><input type="checkbox" class="chk_certinfo_list " name="chk_certinfo_list[]"" value="<?php echo $cert['certinfo_id'];?>" <?php echo ($checked == $cert['certinfo_id'])?'checked':'';?> /></td>
                        <td><?php echo $cert['insurer_name'];?></td>
                        <td><?php echo $certinfo_contract_id;?></td>
                        <td><?php echo $cert['insurance_from_validate_date'].'~'.$cert['insurance_to_validate_date'];?></td>
                        <td><?php echo $cert['benefit_rate'];?></td>
                        <td><?php echo $cert['cert_certification_date'];?></td>
                        <td><?php echo $cert['cert_from_validate_date'].'~'.$cert['cert_to_validate_date'];?></td>
                    </tr>
                    <?php }?>
                <?php }else{?>
                    <tr>
                        <td class="text-center" colspan="7">検出された資料がありません。</td>
                    </tr>
                <?php }?>
            </table>

            <div class="row">
                <div class="col-md-3">
                    <table class="col-md-12 action-table">
                        <tr class="bg-danger">
                            <td><input type="checkbox" name="chk_certinfo_all" id="chk_certinfo_all" /></td>
                            <td class="col-md-12"><a href="#" class="btn form-control btn-danger btn-xs" name="btn_certinfo_delete" id="btn_certinfo_delete">選択項目を削除する</a></td>
                        </tr>
                        <tr class="bg-success">
                            <td></td>
                            <td class="col-md-12"><a href="#" class="btn form-control btn-success btn-xs" name="btn_certinfo_update" id="btn_certinfo_update">選択項目を更新する</a></td>
                        </tr>
                        <tr class="bg-info">
                            <td></td>
                            <td class="col-md-12"><a href="#" class="btn form-control btn-info btn-xs" name="
                            btn_certinfo_modify" id="btn_certinfo_modify">選択項目を訂正する</a></td>
                        </tr>
                        <tr class="bg-warning">
                            <td></td>
                            <td class="col-md-12"><a href="#" class="btn form-control btn-warning btn-xs" name="btn_certinfo_add" id="btn_certinfo_add">認定情報を新規作成</a></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-9">
                    <div class="orange-row">
                        ・新しく保険・認定情報を追加する場合は、「認定情報を新規作成」ボタンを押す。<br />
                        ～更新は有効期限の変更など変更履歴を残す場合に使用、訂正は履歴が残りません～<br />
                        　・保険・認定情報に訂正がある場合は、訂正項目を選択し、「選択項目を訂正する」ボタンを押す。<br />
                        　・保険・認定情報に更新がある場合は、更新項目を選択し、「選択項目を更新する」ボタンを押す。<br />
                        ・保険・認定情報を削除する場合は、削除項目を選択し、「選択項目を削除する」ボタンを押す。

                    </div>
                </div>
            </div>
        </div>

        <div id="edit_container" class="container bg-success">
            <span>保険情報</span>
            <table class="table-green">
                <tr>
                    <th class="text-center col-sm-2">被保険者番号</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3"><input type="text" class="form-control" readonly name="txt_certinfo_contract_id" id="txt_certinfo_contract_id" value="<?php echo $certinfo_contract_id;?>" /></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">保険者</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <select class="form-control" name="sel_certinfo_insurance_id" id="sel_certinfo_insurance_id" >
                                    <?php foreach($insurance_data as $insurance){?>
                                        <option value="<?php echo $insurance['insurer_id'];?>" <?php echo ($cert_info['insurer_id']==$insurance['insurer_id'])?'selected':'';?>><?php echo $insurance['insurer_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">給付率</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3"><input type="text" class="form-control" name="txt_certinfo_benefit_rate" id="txt_certinfo_benefit_rate"  value="<?php echo $cert_info['benefit_rate'];?>" /></div>
                            <div class="col-sm-3">%</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">有効期間</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="txt_certinfo_insurance_from_validate_date" id="txt_certinfo_insurance_from_validate_date" value="<?php echo $cert_info['insurance_from_validate_date'];?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center">~</div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="txt_certinfo_insurance_to_validate_date" id="txt_certinfo_insurance_to_validate_date" value="<?php echo $cert_info['insurance_to_validate_date'];?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <span>認定情報</span>
            <table class="table-green">
                <tr>
                    <th class="text-center col-sm-2" colspan="2">認定状況</th>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-3">
                                <select class="form-control" name="sel_certinfo_certification_state" id="sel_certinfo_certification_state" >
                                    <?php foreach($g_certification_status as $key=>$status){?>
                                        <option value="<?php echo $key;?>"  <?php echo ($cert_info['cert_certification_state']==$key)?'selected':'';?>><?php echo $status;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" colspan="2">介護度</th>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-3">
                                <select class="form-control" name="sel_certinfo_protect_degree" id="sel_certinfo_protect_degree">
                                    <?php foreach($g_protect_degree as $key=>$degree){?>
                                        <option value="<?php echo $key;?>" <?php echo ($cert_info['cert_protect_degree']==$key)?'selected':'';?>><?php echo $degree;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-6"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" colspan="2">認定年月日</th>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="txt_certinfo_certification_date" id="txt_certinfo_certification_date" value="<?php echo $cert_info['cert_certification_date'];?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" colspan="2">認定有効期間</th>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="txt_certinfo_from_validate_date" id="txt_certinfo_from_validate_date" value="<?php echo $cert_info['cert_from_validate_date'];?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center">~</div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="txt_certinfo_to_validate_date" id="txt_certinfo_to_validate_date" value="<?php echo $cert_info['cert_to_validate_date'];?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" colspan="2">居宅介護支援事務所</th>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-3">
                                <?php echo $office_name;?>
                                <input type="hidden" name="sel_certinfo_office_id" id="sel_certinfo_office_id" value="<?php echo $office_id;?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" colspan="2">届出日</th>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="txt_certinfo_notification_date" id="txt_certinfo_notification_date" value="<?php echo $cert_info['cert_notification_date'];?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" rowspan="8" width="3%">居宅サービス区分</th>
                    <th class="text-center">適用有効期間</th>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="text" class="form-control datepicker" name="txt_certinfo_service_apply_period" id="txt_certinfo_service_apply_period" value="<?php echo $cert_info['cert_service_apply_period'];?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">区分支給限度額</th>
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-3"><input type="text" class="form-control" name="txt_certinfo_classification_max_payment" id="txt_certinfo_classification_max_payment" value="<?php echo $cert_info['cert_classification_max_payment'];?>" /></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" rowspan="5">種類支給限度額</th>
                    <th class="text-center col-sm-2">訪問介護</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_visit_care" id="txt_cert_type_max_payment_visit_care" value="<?php echo $cert_info['cert_type_max_payment_visit_care'];?>" />
                    </td>
                    <th class="text-center col-sm-2">通所リハビリテーション</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_ambulatory" id="txt_cert_type_max_payment_ambulatory" value="<?php echo $cert_info['cert_type_max_payment_ambulatory'];?>" />
                    </td>
                    <th class="text-center col-sm-2">夜間訪問介護</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_nighttime" id="txt_cert_type_max_payment_nighttime" value="<?php echo $cert_info['cert_type_max_payment_nighttime'];?>" />
                    </td>
                </tr>
                <tr>
                    <th class="text-center">訪問入浴介護</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_bathing_care" id="txt_cert_type_max_payment_bathing_care" value="<?php echo $cert_info['cert_type_max_payment_bathing_care'];?>" />
                    </td>
                    <th class="text-center">短期入所生活介護</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_short_term_life" id="txt_cert_type_max_payment_short_term_life" value="<?php echo $cert_info['cert_type_max_payment_short_term_life'];?>" />
                    </td>
                    <th class="text-center">認知症通所介護</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_dementia" id="txt_cert_type_max_payment_dementia" value="<?php echo $cert_info['cert_type_max_payment_dementia'];?>" />
                    </td>
                </tr>
                <tr>
                    <th class="text-center">訪問看護</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_visit_nurse" id="
                        txt_cert_type_max_payment_visit_nurse" value="<?php echo $cert_info['cert_type_max_payment_visit_nurse'];?>" />
                    </td>
                    <th class="text-center" rowspan="2">短期入所療養介護（介護療養型医療施設等）</th>
                    <td rowspan="2">
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_medical" id="txt_cert_type_max_payment_medical" value="<?php echo $cert_info['cert_type_max_payment_medical'];?>" />
                    </td>
                    <th class="text-center">認知症共同生活（短期）</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_dementia_short" id="txt_cert_type_max_payment_dementia_short" value="<?php echo $cert_info['cert_type_max_payment_dementia_short'];?>" />
                    </td>
                </tr>
                <tr>
                    <th class="text-center">訪問リハビリテーション</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_rehab" id="txt_cert_type_max_payment_rehab" value="<?php echo $cert_info['cert_type_max_payment_rehab'];?>" />
                    </td>
                    <th class="text-center">地域密着型通所介護</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_community" id="txt_cert_type_max_payment_community" value="<?php echo $cert_info['cert_type_max_payment_community'];?>" />
                    </td>
                </tr>
                <tr>
                    <th class="text-center">通所介護</th>
                    <td>
                        <input type="text" class="form-control" name="txt_cert_type_max_payment_day_care" id="txt_cert_type_max_payment_day_care" value="<?php echo $cert_info['cert_type_max_payment_day_care'];?>" />
                    </td>
                    <th class="text-center">福祉用具貸与</th>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="txt_cert_type_max_payment_loan" id="txt_cert_type_max_payment_loan" value="<?php echo $cert_info['cert_type_max_payment_loan'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">留意事項</th>
                    <td colspan="6">
                        <textarea class="form-control" name="txt_cert_consideration" name="txt_cert_consideration" ><?php echo $cert_info['benefit_rate'];?></textarea>
                    </td>
                </tr>
            </table>

            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                            保険・認定情報を入力した後、「保存する」ボタンを押して、内容を保存する。
                        </div>
                        <div class="col-md-4 text-right">
                            <input type="submit" class="btn btn-success" name="btn_certinfo_manage_save" id="btn_certinfo_manage_save" value="保存する" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.container -->
    <?php echo $this->load->view('layouts/footer'); ?>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/additional-methods.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/localization/messages_ja.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
    <script src="<?php echo base_url("assets/js/custom/manager/certinfo_manage.js");?>"></script>
    <script src="<?php echo base_url("assets/js/custom/manager/csearchbox.js");?>"></script>