
    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class="active"><a href="javascript:;">月次集計</a></li>
                        <li role="presentation" class=""><a href="<?php echo base_url('mmonthlytotal/result');?>">月次結果一覧</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="page_container" class="container">
        <form class="horizontal-form" id="frm_monthly_conditionselect" method="post">
            <input type="hidden" name="hdn_cur_year" id="hdn_cur_year" value="<?php echo $cur_year;?>">
            <div class="row">
                <div class="col-md-12">
                    <table class="table-green th-center">
                        <tr>
                            <th class="col-md-2">提供年月</th>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="input-lg" name="sel_cur_support_month" id="sel_cur_support_month">
                                            <?php for($i=1; $i<13; $i++){?>
                                            <option value="<?php echo $i;?>" <?php echo ($cur_support_month == $i)?'selected':'';?>><?php echo $cur_year;?>年<?php echo $i;?>月</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th >請求年月</th>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="input-lg" name="sel_cur_bill_month" id="sel_cur_bill_month">
                                            <?php for($i=1; $i<13; $i++){?>
                                            <option value="<?php echo $i;?>" <?php echo ($cur_bill_month == $i)?'selected':'';?>><?php echo $cur_year;?>年<?php echo $i;?>月</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <table class="table-green">
                <tr>
                    <th class="text-center col-sm-2">集計対象</th>
                    <td>
                        <div class="row chk_useslip_week_item">
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_sun"  value="0" /> 項目</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_mon"  value="1" /> 項目</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_tue"  value="2" /> 項目</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_wed"  value="3" /> 項目</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_thu"  value="4" /> 項目</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_fri"  value="5" /> 項目</label></div>
                            <div class="col-sm-1"><label><input type="checkbox" name="chk_useslip_select_week[]" id="chk_useslip_select_sat"  value="6" /> 項目</label></div>
                        </div>
                        <div id="chk_useslip_error" name="chk_useslip_error" style="display:none;">このフィールドは必須です。</div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">対象サービス</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-6"><label><input type="checkbox"  name="chk_useslip_select_week[]" id="chk_useslip_select_sun"  value="0" /> 居宅介護支援</label></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">コメント</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-12">
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center" rowspan="2">対象利用者</th>
                    <td>
                        <div class="row">
                            <div class="col-sm-3">
                                <label><i class="fa fa-plus"></i>対象者を選択する</label>
                            </div>
                            <div class="col-sm-3">
                                <label>○○人選択中</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="table-green ">
                            <tr>
                                <th class="text-center col-sm-1">1</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">2</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">3</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">4</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">5</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center col-sm-1">6</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">7</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">8</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">9</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">10</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center col-sm-1">11</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">12</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">13</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">14</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                                <th class="text-center col-sm-1">15</th>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-1">
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                        「集計する」ボタンを押すと、月次集計が作成されます。集計一覧で確認できます。
                        </div>
                        <div class="col-md-4 text-right">
                            <input type="submit" class="btn btn-success" value="集計する" id="btn_monthly_condition_select_save"  />
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
<script src="<?php echo base_url("assets/js/custom/monthly_conditionselect.js");?>"></script>