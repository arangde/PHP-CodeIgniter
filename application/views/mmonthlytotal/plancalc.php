
    <div class="dark-bar">
        <h4>計画費加算</h4>
    </div>
    <div id="page_container" class="container">
        <form class="horizontal-form" id="frm_monthly_result" method="post">
            <input type="hidden" name="hdn_cur_year" id="hdn_cur_year" value="<?php echo $cur_year;?>">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <select class="input-lg" name="sel_cur_month" id="sel_cur_month" style="border-radius:0px;">
                            <?php for($i=1; $i<13; $i++){?>
                            <option value="<?php echo $i;?>" <?php echo ($cur_month == $i)?'selected':'';?>><?php echo $cur_year;?>年<?php echo $i;?>月</option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="input-group"> <span class="input-group-addon" id="basic-addon1">担当ケアマネージャー</span> 
                        <select class="input-lg" name="sel_cur_month" id="sel_cur_month" style="border-radius:0px;">
                            <option>none</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-sm-8">
                    <div class="form-group">
                        <table class="table-green table-list">
                            <tr>
                                <th>特定集中減算</th>
                                <td><input type="checkbox" name=""></td>
                                <th>常勤ケアマネージャー人数</th>
                                <td><input type="text" class="col-md-3" name="">人</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <table class="table-green table-list">
                <tr>
                    <th width="1%">項目</th>
                    <th class="text-center">No</th>
                    <th class="text-center">利用者名</th>
                    <th class="text-center">利用開始日<br />（契約日）</th>
                    <th class="text-center">介護度</th>
                    <th class="text-center" width="5%" colspan="2">基本単価</th>
                    <th class="text-center" width="5%" >初回加算</th>
                    <th class="text-center" width="5%" >退院<br/>退所加算</th>
                    <th class="text-center" width="5%" >入院時情報<br />連携加算</th>
                    <th class="text-center" width="5%" >小規模<br />連携<br />加算</th>
                    <th class="text-center" width="5%" >複合型<br />サービス<br />連携<br />加算</th>
                    <th class="text-center" width="5%" >緊急時等<br />カンファレンス<br />加算</th>
                    <th class="text-center" width="5%" >運営基準<br />加算</th>
                    <th class="text-center" width="5%" >中山間<br />地域<br />加算</th>
                </tr>                
                <tr>
                    <td><input type="checkbox" name=""></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name=""></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                </tr>
                <tr>
                    <td><input type="checkbox" name=""></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
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