<div id="page_container" class="container">
    <div class="box">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">登録情報変更申請</h2>
                <form class="horizontal-form" id="frm_corporation_update" >
                    <input type="hidden" name="hdn_change_fields" id="hdn_change_fields" value="" />
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table-green col-sm-12">
                                <tr>
                                    <th class="col-sm-4"></th>
                                    <th class="text-center">現在の登録内容</th>
                                </tr>
                                <tr>
                                    <th class="select_corporation" data-filter="txt_corporation_name" data-filter_db="company_name">法人名</th>
                                    <td><?php echo $corporation_data['company_name']?></td>
                                </tr>
                                <tr>
                                    <th  class="select_corporation" data-filter="txt_corporation_manager_name" data-filter_db="manager_name">担当者名</th>
                                    <td><?php echo $corporation_data['manager_name']?></td>
                                </tr>
                                <tr>
                                    <th class="select_corporation" data-filter="txt_corporation_phonenumber" data-filter_db="phone_number">電話番号</th>
                                    <td><?php echo $corporation_data['phone_number']?></td>
                                </tr>
                                <tr>
                                    <th class="select_corporation" data-filter="txt_corporation_postnumber" data-filter_db="post_number">郵便番号</th>
                                    <td><?php echo $corporation_data['post_number']?></td>
                                </tr>
                                <tr>
                                    <th class="select_corporation" data-filter="txt_corporation_address" data-filter_db="address">住所</th>
                                    <td><?php echo $corporation_data['address']?></td>
                                </tr>
                            </table>
                            <table class="table-green col-sm-12">
                                <tr>
                                    <th class="col-sm-4 select_corporation" data-filter="txt_corporation_email" data-filter_db="manager_email">メールアドレス</th>
                                    <td><?php echo $corporation_data['manager_email']?></td>
                                </tr>
                                <tr>
                                    <th class="select_corporation" data-filter="txt_corporation_manager_id" data-filter_db="manager_id">管理者ＩＤ</th>
                                    <td><?php echo $corporation_data['manager_id']?></td>
                                </tr>
                                <tr>
                                    <th class="select_corporation" data-filter="txt_corporation_manager_password" data-filter_db="manager_password">管理者パスワード</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>管理者パスワード(確認)</th>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-1 arrow-right">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                        </div>
                        <div class="col-sm-5">
                            <table class="table-green col-sm-12">
                                <tr>
                                    <th class="text-center">変更後の登録内容</th>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_name" id="txt_corporation_name" placeholder="法人名" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_manager_name" id="txt_corporation_manager_name" placeholder="担当者名" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_phonenumber" id="txt_corporation_phonenumber" placeholder="電話番号" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_postnumber" id="txt_corporation_postnumber" placeholder="郵便番号" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_address" id="txt_corporation_address" placeholder="住所" /></td>
                                </tr>
                            </table>
                            <table class="table-green col-sm-12">
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_email" id="txt_corporation_email" placeholder="メールアドレス" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_manager_id" id="txt_corporation_manager_id" placeholder="管理者ＩＤ" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_manager_password" id="txt_corporation_manager_password" placeholder="管理者パスワード" /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="txt_corporation_manager_password_confirm" id="txt_corporation_manager_password_confirm" placeholder="管理者パスワード(確認)" /></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="submit" class="btn btn-warning" id="btn_corporation_update_subscription" name="btn_corporation_update_subscription" value="申請する" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container -->
<?php echo $this->load->view('layouts/footer'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/additional-methods.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/localization/messages_ja.js');?>"></script>
<script src="<?php echo base_url("assets/js/custom/corporation_update.js");?>"></script>
