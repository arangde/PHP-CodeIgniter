<?php echo $this->load->view('mcontract/csearchbox'); ?>

    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class=""><a href="<?php echo base_url('museslip/uscreate');?>">利用・提供票の入力</a></li>
                        <li role="presentation" class="active"><a href="javascript:;">利用・提供票の作成・編集・複写</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    
    <form class="horizontal-form" name="frm_useslip_edit" id="frm_useslip_edit" method="post">
        <input type="hidden" name="hdn_useslip_contract_id" id="hdn_useslip_contract_id" value="<?php echo $contract_id?>" />
        <input type="hidden" name="hdn_useslip_year" id="hdn_useslip_year" value="<?php echo $useslip_year;?>">
        <input type="hidden" name="hdn_useslip_edit_manage_flag" id="hdn_useslip_edit_manage_flag" value="<?php echo $useslip_edit_manage_flag;?>" />
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="orange-row">作成・編集・複写をしたい利用・提供票の年月を選択してください。</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <select class="input-lg" name="sel_useslip_month" id="sel_useslip_month">
                            <?php for($i=1; $i<13; $i++){?>
                            <option value="<?php echo $i;?>" <?php echo ($useslip_month == $i)?'selected':'';?>><?php echo $useslip_year;?>年<?php echo $i;?>月</option>
                            <?php }?>
                        </select>
                        <select class="input-lg" name="sel_useslip_current_weeks" id="sel_useslip_current_weeks">
                            <?php for($i=1; $i<$useslip_weeks+1; $i++){?>
                            <option value="<?php echo $i;?>" <?php echo ($useslip_current_weeks == $i)?'selected':'';?>><?php echo $i;?>週</option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>     
            <table class="table-green table-list">
                <tr>
                    <th width="1%" rowspan="2"></th>
                    <th class="text-center col-md-2" rowspan="2">サービス内容</th>
                    <th class="text-center col-md-2" rowspan="2">提供時間帯</th>
                    <th class="text-center" width="7%" rowspan="2">日割回数<br/>表示選択</th>
                    <th class="text-center" width="5%" rowspan="2">合計<br/>回数</th>
                    <th class="text-center" width="5%" rowspan="2">合計<br/>単位</th>
                    <th class="text-center col-md-1" rowspan="2"></th>
                    <th class="text-center col-md-4" colspan="7"><?php echo $useslip_current_weeks;?>週</th>
                </tr>
                <tr>
                    <th class="th-small"><?php echo ($useslip_days_current_week[0]!=0)?$useslip_days_current_week[0]:'';?>(日)</th>
                    <th class="th-small"><?php echo ($useslip_days_current_week[1]!=0)?$useslip_days_current_week[1]:'';?>(月)</th>
                    <th class="th-small"><?php echo ($useslip_days_current_week[2]!=0)?$useslip_days_current_week[2]:'';?>(火)</th>
                    <th class="th-small"><?php echo ($useslip_days_current_week[3]!=0)?$useslip_days_current_week[3]:'';?>(水)</th>
                    <th class="th-small"><?php echo ($useslip_days_current_week[4]!=0)?$useslip_days_current_week[4]:'';?>(木)</th>
                    <th class="th-small"><?php echo ($useslip_days_current_week[5]!=0)?$useslip_days_current_week[5]:'';?>(金)</th>
                    <th class="th-small"><?php echo ($useslip_days_current_week[6]!=0)?$useslip_days_current_week[6]:'';?>(土)</th>
                </tr>
                <?php if(count($useslip_list) > 0){ ?>
                    <?php foreach($useslip_list as $key=>$userslip){?>
                    <tr>
                        <td rowspan="2"><input type="checkbox" name="chk_uselip_data_item[]" class="chk_uselip_data_item " id="chk_uselip_data_item_<?php echo $userslip['useslip_id']?>" value="<?php echo $userslip['useslip_id']?>" <?php echo ($checked == $userslip['useslip_id'])?'checked':'';?> /></td>
                        <td rowspan="2" class="<?php echo ($checked == $userslip['useslip_id'])?'cor_active':'';?>"><?php echo $userslip['service_code_name']?></td>
                        <td rowspan="2"><?php echo $userslip['us_provide_from_time']."~".$userslip['us_provide_to_time'];?></td>
                        <td rowspan="2"><?php echo $userslip['us_provide_daily_times']?></td>
                        <td><?php echo $userslip['monthly_schedule_count']?></td>
                        <td><?php echo $userslip['monthly_schedule_total_unit']?></td>
                        <td>予定</td>
                        <td class="td-small"><?php echo isset($userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[0]]['ur_schedule_unit'])?$userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[0]]['ur_schedule_unit']:'';?></td>
                        <td class="td-small"><?php echo isset($userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[1]]['ur_schedule_unit'])?$userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[1]]['ur_schedule_unit']:'';?></td>
                        <td class="td-small"><?php echo isset($userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[2]]['ur_schedule_unit'])?$userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[2]]['ur_schedule_unit']:'';?></td>
                        <td class="td-small"><?php echo isset($userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[3]]['ur_schedule_unit'])?$userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[3]]['ur_schedule_unit']:'';?></td>
                        <td class="td-small"><?php echo isset($userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[4]]['ur_schedule_unit'])?$userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[4]]['ur_schedule_unit']:'';?></td>
                        <td class="td-small"><?php echo isset($userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[5]]['ur_schedule_unit'])?$userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[5]]['ur_schedule_unit']:'';?></td>
                        <td class="td-small"><?php echo isset($userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[6]]['ur_schedule_unit'])?$userslip['usr'][$useslip_current_weeks-1][$useslip_days_current_week[6]]['ur_schedule_unit']:'';?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>実績</td>
                        <td class="td-small"></td>
                        <td class="td-small"></td>
                        <td class="td-small"></td>
                        <td class="td-small"></td>
                        <td class="td-small"></td>
                        <td class="td-small"></td>
                        <td class="td-small"></td>
                    </tr>
                <?php }?>
            <?php } else {?>
                <tr>
                    <td colspan="14" class="text-center col-sm-12">検出された資料がありません。</td>
                </tr>
            <?php }?>
            </table>

            <div class="row">
                <div class="col-md-3">
                    <table class="col-md-12 action-table">
                        <tr class="bg-danger">
                            <td><input type="checkbox" name="chk_useslips_list_all" id="chk_useslips_list_all" /></td>
                            <td class="col-md-12">
                                <input type="button" class="btn form-control btn-danger btn-xs" name="btn_useslips_delete" id="btn_useslips_delete" value="選択項目を削除する" />
                            </td>
                        </tr>
                        <tr class="bg-success">
                            <td></td>
                            <td class="col-md-12">
                                <select class="input-xs btn form-control" name="sel_useslip_copy_month" id="sel_useslip_copy_month">
                                    <option value="<?php echo $next_month_year.':'.$next_month_month;?>"><?php echo $next_month_year;?>年<?php echo $next_month_month;?>月</option>
                                </select>
                                <input type="button" class="btn form-control btn-success btn-xs" name="btn_useslips_copy" id="btn_useslips_copy" value="年月へ選択項目を複写する" />
                            </td>
                        </tr>
                        <tr class="bg-info">
                            <td></td>
                            <td class="col-md-12">
                                <input type="button" class="btn form-control btn-info btn-xs" name="btn_useslips_update" id="btn_useslips_update" value="選択項目を編集する" />
                            </td>
                        </tr>
                        <tr class="bg-warning">
                            <td></td>
                            <td class="col-md-12">
                                <input type="button" class="btn form-control btn-warning btn-xs" name="btn_useslips_add" id="btn_useslips_add" value="項目を新規作成する" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-9">
                    <div class="orange-row">
                        ・新しくサービス内容を追加する場合は、「項目を新規作成する」ボタン<br/>
                        ・サービス内容に変更がある場合は、変更項目を選択した後、「選択項目を編集する」ボタン<br/>
                        ・サービス内容を削除する場合は、削除する項目を選択した後、「選択項目を削除する」ボタンを押す。<br/>
                        ・過去に行った同じサービス内容を別の月で提供する場合は、上表よりコピーしたい項目を選択し、左項目でコピー先を選択した後、「選択項目を複写する」ボタンを押す。
                    </div>
                </div>
            </div>
        <div id="edit_container" class="container">
            <table class="table-green">
                <tr>
                    <td width="1%"><input type="checkbox" name="chk_useslip_select_all_week" id="chk_useslip_select_all_week" /></td>
                    <th class="text-center col-sm-2">曜日</th>
                    <td>
                        <div class="row chk_useslip_week_item">
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_sun" <?php echo in_array(0, $useslip_info['chkweek'])?'checked':'';?> value="0" /> 日</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_mon" <?php echo in_array(1, $useslip_info['chkweek'])?'checked':'';?> value="1" /> 月</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_tue" <?php echo in_array(2, $useslip_info['chkweek'])?'checked':'';?> value="2" /> 火</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_wed" <?php echo in_array(3, $useslip_info['chkweek'])?'checked':'';?> value="3" /> 水</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_thu" <?php echo in_array(4, $useslip_info['chkweek'])?'checked':'';?> value="4" /> 木</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_fri" <?php echo in_array(5, $useslip_info['chkweek'])?'checked':'';?> value="5" /> 金</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_sat" <?php echo in_array(6, $useslip_info['chkweek'])?'checked':'';?> value="6" /> 土</label></div>
                        </div>
                        <div id="chk_useslip_error" name="chk_useslip_error" style="display:none;">このフィールドは必須です。</div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th class="text-center">サービス事業所</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <?php echo $office_name;?>
                                <input type="hidden" name="sel_useslip_office_id" id="sel_useslip_office_id" value="<?php echo $office_id;?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th class="text-center">時間帯</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control timepicker timepicker-no-seconds" name="txt_useslip_from_provide_time" id="txt_useslip_from_provide_time" value="<?php echo $useslip_info['us_provide_from_time'];?>" />
                                        <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center">~</div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker timepicker-no-seconds" name="txt_useslip_to_provide_time" id="txt_useslip_to_provide_time" value="<?php echo $useslip_info['us_provide_to_time'];?>" />
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th class="text-center">サービスコード</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="txt_useslip_service_code" id="txt_useslip_service_code" value="<?php echo $useslip_info['us_provide_service_code'];?>" readonly />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th class="text-center">単位数</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="txt_useslip_service_unit" id="txt_useslip_service_unit" value="<?php echo $useslip_info['us_provide_schedule_unit'];?>" readonly />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <th class="text-center">消費税額</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="txt_useslip_consumption_tax" id="txt_useslip_consumption_tax" value="<?php echo $useslip_info['us_provide_consumtion_tax'];?>" value="0" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="bg-danger"></td>
                    <td class="bg-danger"><a href="#" class="btn btn-danger btn-xs col-sm-12">選択項目をクリアする</a></td>
                    <td></td>
                </tr>
            </table>

            <div class="row">
                <div class="col-sm-3">
                    <div class="orange-row">
                        サービスコード、単位数は右記一覧から選択してください。<br />
                        保険者を設定し、サービス名やサービスコードを入力することで、絞り込むことができます。
                    </div>
                    <div class="arrow-down">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </div>
                    <div class="form-group">
                        <select class="form-control"><option>保険者を設定</option></select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"/>
                        <input type="button" class="btn btn-danger form-control" value="検索する" />
                    </div>
                </div>
                <div class="col-sm-9">
                    <table class="table-green table-scroll">
                        <tr>
                            <th width="1%">対象</th>
                            <th class="text-center">サービスコード</th>
                            <th class="text-center">サービス名称</th>
                            <th class="text-center">所要時間</th>
                            <th class="text-center">区分</th>
                            <th class="text-center">単位</th>
                        </tr>
                        <?php if(count($userslip_service_code_list) == 0){?>
                            <tr class="text-center">
                                <td colspan="6">検出された資料がありません。</td>
                            </tr>
                        <?php }else{?>
                            <?php foreach($userslip_service_code_list as $key=>$service_code){?>
                                <tr class="userslip_service_code_list">
                                    <td><input type="button" class="btn btn-default btn-xs btn_useslip_select" data-filter_sid="<?php echo $service_code['service_code'];?>" data-filter_unit="<?php echo $service_code['unit'];?>" value="選択" /></td>
                                    <td><?php echo $service_code['service_code'];?></td>
                                    <td><?php echo $service_code['service_code_name'];?></td>
                                    <td><?php echo $service_code['service_code_provide_time'];?></td>
                                    <td><?php echo $service_code['section'];?></td>
                                    <td><?php echo $service_code['unit'];?></td>
                                </tr>
                            <?php }?>
                        <?php }?>
                    </table>
                </div>
            </div>

            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                            曜日、サービスコードを選択した後、「保存する」ボタンを押して、内容を保存する。
                        </div>
                        <div class="col-md-4 text-right">
                            <input type="submit" class="btn btn-success" name="btn_useslip_edit_save" id="btn_useslip_edit_save" value="保存する" />
                        </div>
                    </div>
                </div>
            </div>
        </div></div>
    </form>
    <!-- /.container -->
     

<?php echo $this->load->view('layouts/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/additional-methods.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/localization/messages_ja.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/custom/bootstrap-timepicker/js/bootstrap-timepicker.min.js');?>"></script>
<script type="text/javascript" src="<?php //echo base_url('assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ja.js');?>"></script>
<script src="<?php echo base_url("assets/js/custom/manager/useslip_edit.js");?>"></script>
<script src="<?php echo base_url("assets/js/custom/manager/csearchbox.js");?>"></script>