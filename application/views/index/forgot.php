    <div id="page_container" class="container">

        <form id="forgot_form" class="form-inline">

            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                        <h2 class="intro-text">職員用ID・パスワードを忘れた場合用</h2>
                        <p>管理者権限を持っている方に、設定パスワードをご確認ください。</p>
                        <p>ログインIDには、「管理者ID」と「職員ID」があります。<br />
                            「職員ID」を確認するには、「管理者用ID」でログインをし、「職員情報管理」より「職員ID」「職員パスワード」をご確認いただけます。
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="box">
                    <div class="col-lg-12">
                        <h2 class="intro-text">管理者用ID・パスワードを忘れた場合</h2>
                        <p>ID・パスワードの再設定メールをご登録メールアドレスに送信いたします。</p>
                        <p>
                            登録メールアドレス
                            <input type="text" id="txt_email" name="txt_email" class="form-control" />
                            <span class="text-red">&nbsp;&nbsp;&nbsp;&nbsp;入力したメールアドレスは登録されていません。</span>
                        </p>
                        
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" id="btn_update_admin" name="btn_update_admin" class="btn btn-primary" value="ID・パスワードの再設定メールを送る" />
                    </div>
                </div>
            </div>

        </form>

    </div>
    <!-- /.container -->

    <?php echo $this->load->view('layouts/footer'); ?>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/additional-methods.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/localization/messages_ja.js');?>"></script>
    <script src="<?php echo base_url("assets/js/custom/forget.js");?>"></script>