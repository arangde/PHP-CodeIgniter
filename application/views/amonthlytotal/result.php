
    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class=""><a href="<?php echo base_url('amonthlytotal/conditionselect');?>">月次集計</a></li>
                        <li role="presentation" class="active"><a href="javascript:;">月次結果一覧</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="page_container" class="container">
        <form class="horizontal-form" id="frm_monthly_result" method="post">
            <input type="hidden" name="hdn_cur_year" id="hdn_cur_year" value="<?php echo $cur_year;?>">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <select class="input-lg" name="sel_cur_month" id="sel_cur_month">
                            <?php for($i=1; $i<13; $i++){?>
                            <option value="<?php echo $i;?>" <?php echo ($cur_month == $i)?'selected':'';?>><?php echo $cur_year;?>年<?php echo $i;?>月</option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <table class="table-green table-list">
                <tr>
                    <th width="1%" rowspan="2">選択</th>
                    <th class="text-center" rowspan="2">保険者名</th>
                    <th class="text-center" rowspan="2">被保険者番号</th>
                    <th class="text-center" rowspan="2">利用者名</th>
                    <th class="text-center" rowspan="2">提供年月</th>
                    <th class="text-center" width="5%" rowspan="2">請求年月</th>
                    <th class="text-center" width="5%" colspan="3">サ種</th>
                    <th class="text-center" width="5%" colspan="2">様式2</th>
                    <th class="text-center" width="5%" colspan="2">様式2-2</th>
                    <th class="text-center" width="5%" colspan="2">様式2-3</th>
                    <th class="text-center" width="5%" colspan="2">様式7</th>
                    <th class="text-center" width="5%" colspan="2">様式7-2</th>
                    <th class="text-center" width="5%" colspan="2">様式7-3</th>
                    <th class="text-center" width="5%" >様式11</th>
                    <th class="text-center" rowspan="2">備考</th>
                </tr>
                <tr>
                    <th class="th-small">居支援</th>
                    <th class="th-small">予支援</th>
                    <th class="th-small">総ケア</th>
                    <th class="th-small">返戻</th>
                    <th class="th-small">編集</th>
                    <th class="th-small">返戻</th>
                    <th class="th-small">編集</th>
                    <th class="th-small">返戻</th>
                    <th class="th-small">編集</th>
                    <th class="th-small">返戻</th>
                    <th class="th-small">編集</th>
                    <th class="th-small">返戻</th>
                    <th class="th-small">編集</th>
                    <th class="th-small">返戻</th>
                    <th class="th-small">編集</th>
                    <th class="th-small">返戻</th>
                </tr>
                
                <tr>
                    <td rowspan="2"><input type="checkbox" name=""></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td></td><td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td>
                    <td rowspan="2"></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2"><input type="checkbox" name=""></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                    <td></td><td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td>
                    <td rowspan="2"></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td>
                </tr>
            </table>

            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                        保存する。
                        </div>
                        <div class="col-md-4 text-right">
                            <input type="submit" class="btn btn-success" value="保存する。" id="btn_monthly_result_save"  />
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