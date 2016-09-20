<?php
    global $g_user_employment, $g_user_job_title, $g_user_office, $g_user_sex;
?>
    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class="active"><a href="javascript:;">事業所情報の入力</a></li>
                        <li role="presentation" class=""><a href="<?php echo base_url('aoffice/olist');?>">事業所情報の一覧</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="page_container" class="container">
        <form class="horizontal-form" id="frm_office_edit" method="post">
            <input type="hidden" name="hdn_input_flag" id="hdn_input_flag" value="<?php echo $input_flag;?>" />
            <input type="hidden" name="hdn_insurers" id="hdn_insurers" value="" />
            <input type="hidden" name="hdn_areas" id="hdn_areas" value="" />
            <input type="hidden" name="hdn_office_classes" id="hdn_office_classes" value="" />
            <input type="hidden" name="hdn_office_services" id="hdn_office_services" value="" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="orange-row">事業所情報を入力する。</div>
                            </div>
                            <div class="col-md-8 text-right">
                                <?php if($input_flag == 0){ ?>
                                <input type="button" class="btn btn-success delete_office" data-office_id="<?php echo $office_data['office_id'];?>" user_data value="名簿から削除" id="btn_office_delete" name="btn_office_delete" />
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="button" class="btn btn-success" value="すべてクリア" id="btn_office_clear" name="btn_office_clear" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <span>事業所情報</span>
            <table class="table-green th-center">
                <tr>
                    <th class="col-md-2">事業所番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control "  name="txt_office_id" id="txt_office_id" value="<?php echo $office_data['office_id'];?>" readonly />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>事業所名</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control " name="txt_office_name" id="txt_office_name"  value="<?php echo $office_data['office_name'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_office_phonenumber" id="txt_office_phonenumber"  value="<?php echo $office_data['office_phonenumber'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>FAX番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_office_fax" id="txt_office_fax"  value="<?php echo $office_data['office_fax'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_office_postnumber" id="txt_office_postnumber"  value="<?php echo $office_data['office_postnumber'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-9">
                                <textarea type="text" class="form-control" name="txt_office_address" id="txt_office_address"><?php echo trim($office_data['office_address']);?></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>保険者</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                 $insurer_array = explode(',', substr(trim($office_data['office_insurers']), 0, -1));
                                ?>
                                <select data-placeholder="保険者" class="chzn-select col-md-12" multiple  tabindex="6" id='sel_office_insurers' name="sel_office_insurers" >
                                    <option value=""></option>
                                    <?php foreach($insurers as $ins){?>
                                        <option value="<?php echo $ins['insurer_name'];?>" <?php echo in_array($ins['insurer_name'], $insurer_array)?'selected':'';?>><?php echo $ins['insurer_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>地域区分</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                 $area_array = explode(',', substr(trim($office_data['office_area']), 0, -1));
                                ?>
                                <select data-placeholder="地域区分" class="chzn-select col-md-12" multiple  tabindex="6" id='sel_office_area' name="sel_office_area" >
                                    <option value=""></option>
                                    <?php foreach($areas as $area){?>
                                        <option value="<?php echo $area['area_name'];?>" <?php echo in_array($area['area_name'], $area_array)?'selected':'';?>><?php echo $area['area_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>事業所区分</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                 $class_array = explode(',', substr(trim($office_data['office_class']), 0, -1));
                                ?>
                                <select data-placeholder="事業所区分" class="chzn-select col-md-12" multiple  tabindex="6" id='sel_office_class' name="sel_office_class" >
                                    <option value=""></option>
                                    <?php foreach($officeclass as $office){?>
                                        <option value="<?php echo $office['office_class_name'];?>" <?php echo in_array($office['office_class_name'], $class_array)?'selected':'';?>><?php echo $office['office_class_name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-9">
                                <textarea type="text" class="form-control" name="txt_office_note" id="txt_office_note"><?php echo $office_data['office_note'];?></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>提供サービス</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table th-center">
                                    <tr>
                                        <td>
                                            <?php
                                             $service_array = explode(',', substr(trim($office_data['office_service']), 0, -1));
                                            ?>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_1" data-chk_value="1" <?php echo in_array(1, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;訪問介護</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_2" data-chk_value="2" <?php echo in_array(2, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;通所リハビリテーション</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_3" data-chk_value="3" <?php echo in_array(3, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;夜間訪問介護</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_4" data-chk_value="4" <?php echo in_array(4, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;訪問入浴介護</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_5" data-chk_value="5" <?php echo in_array(5, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;短期入所生活介護</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_6" data-chk_value="6" <?php echo in_array(6, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;認知症通所介護</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_7" data-chk_value="7" <?php echo in_array(7, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;訪問看護</label>
                                            </div>
                                        </td>
                                        <td rowspan="2">
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_8" data-chk_value="8" <?php echo in_array(8, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;短期入所療養介護（介護療養型医療施設等）</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_9" data-chk_value="9" <?php echo in_array(9, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;認知症共同生活（短期）</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_10" data-chk_value="10" <?php echo in_array(10, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;訪問リハビリテーション</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_11" data-chk_value="11" <?php echo in_array(11, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;地域密着型通所介護</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_12" data-chk_value="12" <?php echo in_array(12, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;通所介護</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <label><input type="checkbox" id="chk_c_service_13" data-chk_value="13" <?php echo in_array(13, $service_array)?'checked':'';?> />&nbsp;&nbsp;&nbsp;福祉用具貸与</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                        <?php if($input_flag == 0){?>
                            「編集する」ボタンを押して、内容を編集する。
                        <?php }else if($input_flag == 1){?>
                            「保存する」ボタンを押して、内容を保存する。
                        <?php }?>
                        </div>
                        <div class="col-md-4 text-right">
                            <input type="submit" class="btn btn-success" value="<?php echo ($input_flag == 1)?'保存する':'編集する';?>" id="btn_office_save"  />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.container -->

<?php echo $this->load->view('layouts/footer'); ?>
<script type="text/javascript" src="<?php echo base_url("assets/plugins/chosen-bootstrap/chosen/chosen.jquery.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/plugins/select2/select2.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/additional-methods.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/localization/messages_ja.js');?>"></script>
<script src="<?php echo base_url("assets/js/custom/office_edit.js");?>"></script>