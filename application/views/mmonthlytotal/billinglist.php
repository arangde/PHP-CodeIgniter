
    <div class="dark-bar">
        <h4>月別介護請求一覧画面</h4>
    </div>
    <div id="page_container" class="container">
        <form class="horizontal-form" id="frm_monthly_result" method="post">
            <div class="row">
                <div class="col-sm-8">
                    <div class="input-group"> <span class="input-group-addon" id="basic-addon1">媒体区分</span> 
                        <select class="input-lg" name="sel_cur_month" id="sel_cur_month" style="border-radius:0px;">
                            <option>伝送</option>
                        </select>
                    </div>
                </div>
            </div>
            <table class="table-green table-list margin-top-20">
                <tr>
                    <td widtd="1%" rowspan="2">選択</td>
                    <td class="text-center" rowspan="2">提供年月</td>
                    <td class="text-center" rowspan="2">請求年月</td>
                    <td class="text-center" rowspan="2">処理受付日付</td>
                    <td class="text-center" colspan="3">サ種</td>
                    <td class="text-center" widtd="5%" colspan="8">伝送ファイル</td>
                    <td class="text-center" widtd="5%" rowspan="2" >伝送</td>
                    <td class="text-center" widtd="5%" rowspan="2" >様式<br/>確認</td>
                    <td class="text-center" widtd="5%" rowspan="2" >コメント</td>
                </tr>                
                <tr>
                    <td class="text-center">居支援</td>
                    <td class="text-center">予支援</td>
                    <td class="text-center">総ケア</td>
                    <td class="text-center">請求<br />（介護)</td>
                    <td class="text-center">請求<br />（総合事業）</td>
                    <td class="text-center">給付管理</td>
                    <td class="text-center">委託請求<br />（介護)</td>
                    <td class="text-center">委託請求<br />（総合事業）<br />要支援者</td>
                    <td class="text-center">委託請求<br />（総合事業）<br />事業対象者</td>
                    <td class="text-center">委託給付<br />管理</td>
                    <td class="text-center">エラー内容<br />確認</td>
                </tr>
                <tr>
                    <td class="text-center"><input type="checkbox" name=""></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center"><input type="checkbox" name=""></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td><td></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>
    <!-- /.container -->

<?php echo $this->load->view('layouts/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/additional-methods.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/localization/messages_ja.js');?>"></script>
<script src="<?php echo base_url("assets/js/custom/monthly_conditionselect.js");?>"></script>