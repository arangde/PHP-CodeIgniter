<?php
    global $g_day_of_week;
?>
<?php echo $this->load->view('acontract/csearchbox'); ?>
<?php echo $this->load->view('auseslip/usinput'); ?>
    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class="active"><a href="javascript:;">利用・提供票の入力</a></li>
                        <li role="presentation" class=""><a href="<?php echo base_url('auseslip/usedit');?>">利用・提供票の作成・編集・複写</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="orange-row">予定・実績を入力する。</div>
                </div>
            </div>
        </div>

        <form class="horizontal-form" id="frm_useslip_create" name="frm_useslip_create" method="post">
            <input type="hidden" name="hdn_useslip_contract_id" id="hdn_useslip_contract_id" value="<?php echo $contract_id?>" />
            <input type="hidden" name="hdn_useslip_year" id="hdn_useslip_year" value="<?php echo $useslip_year;?>">
            <input type="hidden" name="hdn_service_id" id="hdn_service_id" value="">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <select class="input-lg" name="sel_useslip_month" id="sel_useslip_month">
                            <?php for($i=1; $i<13; $i++){?>
                            <option value="<?php echo $i;?>" <?php echo ($useslip_month == $i)?'selected':'';?>><?php echo $useslip_year;?>年<?php echo $i;?>月</option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 text-right">
                    <input type="button" class="btn btn-success" value="実績へ計上" />
                </div>
                <div class="col-sm-2 text-right">
                    <a href="#" class="btn btn-success">
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;&nbsp;印刷
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6" style="padding-right:0">
                    <table class="table-green table-list ">
                    <tr>
                        <th class="text-center" rowspan="2">No</th>
                        <th class="text-center" rowspan="2">サービス内容</th>
                        <th class="text-center" rowspan="2">提供時間帯</th>
                        <th class="text-center" rowspan="2">日割回数<br/>表示選択</th>
                        <th class="text-center" rowspan="2">合計<br/>回数</th>
                        <th class="text-center" rowspan="2">合計<br/>単位</th>
                        <th class="text-center" rowspan="2"></th>
                    </tr>
                    <tr></tr>
                    <?php if(count($useslip_list) > 0){ ?>
                    <?php foreach($useslip_list as $key=>$userslip){?>
                        <tr>
                            <td rowspan="2"><?php echo $key + 1; ?></td>
                            <td rowspan="2" class="us_input_result" data-filter_ur_id="<?php echo $userslip['useslip_id'];?>"><?php echo $userslip['service_code_name'];?></td>
                            <td rowspan="2"><?php echo $userslip['us_provide_from_time'].'~'.$userslip['us_provide_to_time'];?></td>
                            <td rowspan="2"><?php echo $userslip['us_provide_daily_times']?></td>
                            <td><?php echo $userslip['monthly_schedule_count']?></td>
                            <td><?php echo $userslip['monthly_schedule_total_unit']?></td>
                            <td>予定</td>
                        </tr>
                        <tr>
                            <td><?php echo $userslip['monthly_result_count']?></td>
                            <td><?php echo $userslip['monthly_result_total_unit']?></td>
                            <td>実績</td>
                        </tr>
                    <?php }?>
                    <?php }else{?>
                        <tr>
                            <td colspan="7" class="text-center col-sm-12">検出された資料がありません。</td>
                        </tr>
                    <?php }?>
                </table>
            </div>
            <div class="col-sm-6" style="padding-left:0;"> 
                <div class="table-scrollable table-border">
                    <table class="table-green table-list ">
                        <tr>
                            <th class="text-center" colspan="<?php echo $last_day;?>"></th>
                        </tr>
                        <tr>
                            <?php for($i=0; $i<$last_day; $i++) { ?>
                                <th class="th-small"><?php echo $i + 1; ?>(<?php echo $g_day_of_week[jddayofweek (cal_to_jd(CAL_GREGORIAN, $useslip_month,$i+1, $useslip_year), 0)];?>)</th>
                            <?php } ?>
                        </tr>
                        <?php foreach($useslip_list as $key=>$userslip){?>
                        <tr>
                            
                            <?php for($j=1; $j<=$last_day; $j++) { ?>
                                <td class="td-small"><?php echo isset($userslip['usr'][$j]['ur_schedule_unit'])?$userslip['usr'][$j]['ur_schedule_unit']:'';?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <?php for($j=1; $j<=$last_day; $j++) { ?>
                                <td class="td-small"><?php echo isset($userslip['usr'][$j]['ur_result_unit'])?$userslip['usr'][$j]['ur_result_unit']:'';?></td>
                            <?php } ?>
                        </tr>
                        <?php }?>
                    </table>
                    </div>
                </div>
            </div>
            <div class="row table-scrollable table-border" style="display:none;">
            <div class="col-sm-12">
            <table class="table-green table-list ">
                <tr>
                    <th class="text-center" rowspan="2">No</th>
                    <th class="text-center" rowspan="2">サービス内容</th>
                    <th class="text-center" rowspan="2">提供時間帯</th>
                    <th class="text-center" rowspan="2">日割回数<br/>表示選択</th>
                    <th class="text-center" rowspan="2">合計<br/>回数</th>
                    <th class="text-center" rowspan="2">合計<br/>単位</th>
                    <th class="text-center" rowspan="2"></th>
                    <th class="text-center" colspan="<?php echo $last_day;?>"></th>
                </tr>
                <tr>
                    <?php for($i=0; $i<$last_day; $i++) { ?>
                        <th class="th-small"><?php echo $i + 1; ?></th>
                    <?php } ?>
                </tr>
                <?php if(count($useslip_list) > 0){ ?>
                    <?php foreach($useslip_list as $key=>$userslip){?>
                    <tr>
                        <td rowspan="2"><?php echo $key + 1; ?></td>
                        <td rowspan="2" class="us_input_result"><?php echo $userslip['service_code_name'];?></td>
                        <td rowspan="2"><?php echo $userslip['us_provide_from_time'].'~'.$userslip['us_provide_to_time'];?></td>
                        <td rowspan="2"><?php echo $userslip['us_provide_daily_times']?></td>
                        <td><?php echo $userslip['monthly_schedule_count']?></td>
                        <td><?php echo $userslip['monthly_schedule_total_unit']?></td>
                        <td>予定</td>
                        
                        <?php for($j=1; $j<=$last_day; $j++) { ?>
                            <td class="td-small"><?php echo isset($userslip['usr'][$j]['ur_schedule_unit'])?$userslip['usr'][$j]['ur_schedule_unit']:'';?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>実績</td>
                        <?php for($j=1; $j<=$last_day; $j++) { ?>
                            <td class="td-small"><?php echo isset($userslip['usr'][$j]['ur_result_unit'])?$userslip['usr'][$j]['ur_result_unit']:'';?></td>
                        <?php } ?>
                    </tr>
                    <?php }?>
                <?php }else{?>
                    <tr>
                        <td colspan="<?php echo $last_day+7;?>" class="text-center col-sm-12">検出された資料がありません。</td>
                    </tr>
                <?php }?>
            </table>
            </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-sm-4">
                    <table class="col-sm-12 table-green table-total">
                        <tr>
                            <th class="col-sm-9">合計</th>
                            <td>200</td>
                            <td>300</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8">
                    <table class="col-sm-12 table-green">
                        <tr>
                            <th class="text-center" rowspan="2">単位数</th>
                            <th class="text-center" colspan="2">種類支給限度</th>
                            <th class="text-center" colspan="2">区分支給限度</th>
                            <th class="text-center" colspan="2">利用者負担</th>
                            <th class="text-center" colspan="4">短期入所利用日数</th>
                        </tr>
                        <tr>
                            <th class="text-center">超過</th>
                            <th class="text-center">基準内</th>
                            <th class="text-center">超過</th>
                            <th class="text-center">基準内</th>
                            <th class="text-center">保険分</th>
                            <th class="text-center">全額</th>
                            <th class="text-center">前月まで</th>
                            <th class="text-center">当月の計画</th>
                            <th class="text-center">累積</th>
                            <th class="text-center">前月からの<br/>連続利用日数</th>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                            「保存する」ボタンを押して、内容を保存する。
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="#" class="btn btn-success">保存する</a>
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
<script src="<?php echo base_url("assets/js/custom/useslip_create.js");?>"></script>
<script src="<?php echo base_url("assets/js/custom/csearchbox.js");?>"></script>
