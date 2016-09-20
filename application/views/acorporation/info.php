
    <div id="page_container" class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <h1 class="page-title">
                        法人登録管理画面
                    </h2>
                    <form id="frm_corporation_info" class="form-horizontal">
                        <table class="table-green col-sm-12">
                            <tr>
                                <th class="col-sm-3">法人ID</th>
                                <td><?php echo $corporation_data['corporation_id']?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">法人名</th>
                                <td><?php echo $corporation_data['company_name']?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">担当者名</th>
                                <td><?php echo $corporation_data['manager_name']?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">メールアドレス</th>
                                <td><?php echo $corporation_data['manager_email']?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">電話番号</th>
                                <td><?php echo $corporation_data['phone_number']?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">郵便番号</th>
                                <td><?php echo $corporation_data['post_number']?></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">住所</th>
                                <td><?php echo $corporation_data['address']?></td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="button" class="col-md-3 btn btn-warning pull-right" value="登録情報変更申請はこちら" id="btn_change_request" name="btn_change_request" />
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
    <script src="<?php echo base_url("assets/js/custom/corporation_info.js");?>"></script>
