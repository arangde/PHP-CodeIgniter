

    <div id="page_container" class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <form id="login_form" class="form-horizontal">
                        <div class="form-group">
                            <label for="user_id" class="col-sm-3 control-label">ID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="user_id" name="user_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">パスワード</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <input type="submit" class="col-sm-12 btn btn-primary" value="ログイン" id="btnlogin" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <a href="<?php echo base_url('/index/forgot');?>">ID・パスワードを忘れた方はこちら</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if($add_flag == 1){?>
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <div class="form-group">
                        <div class="col-sm-4 pull-right">
                            <a href="<?php echo base_url("index/signup");?>" class="col-sm-12 btn btn-warning">新規利用登録はこちら</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
    <!-- /.container -->
    <?php echo $this->load->view('layouts/loginfooter'); ?>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/additional-methods.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/localization/messages_ja.js');?>"></script>
    <script src="<?php echo base_url("assets/js/custom/login.js");?>"></script>



