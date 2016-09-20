<?php
    global $g_user_employment, $g_user_job_title, $g_user_office, $g_user_sex, $g_contract_service;
?>
    <?php echo $this->load->view('acontract/csearchbox'); ?>
    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class="active"><a href="javascript:;">利用者(被保険者)情報の入力</a></li>
                        <li role="presentation" class=""><a href="<?php echo base_url('acontract/clist');?>">利用者(被保険者)情報の一覧</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="page_container" class="container">
        <form class="horizontal-form" id="frm_c_edit"  method="post">
         <input type="hidden" name="hdn_input_flag" id="hdn_input_flag" value="<?php echo $input_flag;?>" />
         <input type="hidden" name="hdn_change_fields" id="hdn_change_fields" value="<?php echo $service_fields?>" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="orange-row">利用者(被保険者)情報を入力する。</div>
                            </div>
                            <div class="col-md-8 text-right">
                            <?php if($input_flag==0){?>
                                <input type="button" class="btn btn-success" id="btn_select_contract" name="btn_select_contract" data-contract_id="<?php echo $contract_data['contract_id'];?>" value="この利用者を選択" />
                                <input type="button" class="btn btn-success" id="btn_delete_contract" name="btn_delete_contract" value="名簿から削除" data-contract_id="<?php echo $contract_data['contract_id'];?>" />
                            <?php }?>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="button" class="btn btn-success" id="btn_clear_contract" name="btn_clear_contract" value="すべてクリア" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <span>利用者情報</span>
            <table class="table-green th-center">
                <tr>
                    <th class="col-md-2">利用者番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_contract_id" id="txt_contract_id" value="<?php echo $contract_data['contract_id'];?>" readonly />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>フリガナ</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_furigana" name="txt_c_furigana" value="<?php echo $contract_data['c_furigana'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>氏名</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_username" name="txt_c_username" value="<?php echo $contract_data['c_username'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>識別記号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_symbol" name="txt_c_symbol" value="<?php echo $contract_data['c_symbol'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <select class="input-sm " name="sel_c_sex" id="sel_c_sex">
                                    <?php foreach($g_user_sex as $key=>$s){?>
                                    <option value="<?php echo $key;?>" <?php echo ($key==$contract_data['c_sex'])?'selected':'';?>><?php echo $s;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>生年月日</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3 ">
                                <input type="text" class="form-control datepicker" id="txt_c_birthday" name="txt_c_birthday" value="<?php echo $contract_data['c_birthday'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>血液型</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_blood" name="txt_c_blood" value="<?php echo $contract_data['c_blood'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_postnumber" name="txt_c_postnumber" value="<?php echo $contract_data['c_postnumber'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td colspan="2">
                        <textarea class="form-control" id="txt_c_address" name="txt_c_address"> <?php echo $contract_data['c_address'];?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_phonenumber" name="txt_c_phonenumber" value="<?php echo $contract_data['c_phonenumber'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>携帯番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_mobilenumber" name="txt_c_mobilenumber" value="<?php echo $contract_data['c_mobilenumber'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>FAX</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_fax" name="txt_c_fax" value="<?php echo $contract_data['c_fax'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>E-Mail</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_email" name="txt_c_email" value="<?php echo $contract_data['c_email'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>担当ケアマネージャー</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="hidden" class="form-control" id="txt_c_masternumber" name="txt_c_masternumber" value="<?php echo $contract_data['c_masternumber'];?>" /><?php echo $contract_data['c_masternumber'];?>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>被保険者番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_c_insurednumber" name="txt_c_insurednumber" value="<?php echo $contract_data['c_insured'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>適用事業所</th>
                    <td colspan="2">
                        <select class="input-sm col-sm-4" name="sel_c_office_id" id="sel_c_office_id">
                            <?php foreach($offices as $key=>$o){?>
                            <option value="<?php echo  $o['office_id'];?>" <?php echo ($o['office_id']==$contract_data['office_id'])?'selected':'';?>><?php echo $o['office_name'];?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th rowspan="26">提供サービス</th>
                    <th class="col-md-5">提供サービス（地域包括支援センター事業所番号）</th>
                    <th class="col-md-5">サービス提供期間</th>
                </tr>
                <?php foreach($g_contract_service as $k => $services){?>
                    <?php foreach($services[1] as $j => $serv){?>
                        <?php if($j==0){?>
                            <tr>
                                <th colspan="2" class="text-left"><?php echo $services[0];?></th>
                            </tr>
                        <?php }?>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" data-filter="<?php echo $k.'_'.$j;?>" id="chk_c_service_<?php echo $k.'_'.$j;?>"   <?php echo !empty($contractServices[$k.'_'.$j])?'checked':'';?> /> <?php echo $serv;?></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <div class=" input-group date">
                                                    <input type="text" class="form-control col-sm-2 datepicker" id="txt_service_from_<?php echo $k.'_'.$j;?>" name="txt_service_from_<?php echo $k.'_'.$j;?>" value="<?php echo !empty($contractServices[$k.'_'.$j])?$contractServices[$k.'_'.$j]['from_date']:'';?>" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">~</div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control col-sm-2 datepicker" id="txt_service_to_<?php echo $k.'_'.$j;?>" name="txt_service_to_<?php echo $k.'_'.$j;?>" value="<?php echo !empty($contractServices[$k.'_'.$j])?$contractServices[$k.'_'.$j]['to_date']:'';?>" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php }?>
                <?php }?>
            </table>

            <span>支払者情報</span>
            <table class="table-green th-center">
                <tr>
                    <th class="col-sm-2">送付先</th>
                    <td class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label><input type="radio" name="rd_c_destination" id="rd_c_yourself_destination" <?php echo ($contract_data['desination_flag']==0)?'checked':'';?> value="0" /> 本人</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label><input type="radio" name="rd_c_destination" id="rd_c_other_destination" <?php echo ($contract_data['desination_flag']==1)?'checked':'';?> value="1" /> 支払者</label>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>フリガナ</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="txt_c_destination_furigana" name="txt_c_destination_furigana" value="<?php echo $contract_data['des_furigana'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>氏名</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="txt_c_destination_username" name="txt_c_destination_username" value="<?php echo $contract_data['des_name'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="txt_c_destination_postnumber" name="txt_c_destination_postnumber" value="<?php echo $contract_data['des_postnumber'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        <textarea class="form-control" id="txt_c_destination_address" name="txt_c_destination_address"> <?php echo $contract_data['des_address'];?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td>
                        <textarea class="form-control" id="txt_c_destination_note" name="txt_c_destination_note"> <?php echo $contract_data['des_note'];?></textarea>
                    </td>
                </tr>
            </table>

            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                            「保存する」ボタンを押して、内容を保存する。
                        </div>
                        <div class="col-md-4 text-right">
                            <input type="submit" class="btn btn-success" id="btn_c_save" name="btn_c_save" value="保存する" />
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
<script src="<?php echo base_url("assets/js/custom/contract_edit.js");?>"></script>
<script src="<?php echo base_url("assets/js/custom/csearchbox.js");?>"></script>