
    <div id="page_container" class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <h1 class="page-title">
                        新規登録画面
                    </h2>
                    <form id="signup_form" class="form-horizontal">
                        <table class="table-green col-sm-12">
                            <tr>
                                <th class="col-sm-3">法人名</th>
                                <td><input type="text" class="form-control" id="username" name="username" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">担当者名</th>
                                <td><input type="text" class="form-control" id="managername" name="managername" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">電話番号</th>
                                <td><input type="text" class="form-control" id="telnumber" name="telnumber" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">郵便番号</th>
                                <td><input type="text" class="form-control" id="postnumber" name="postnumber" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">住所</th>
                                <td><input type="text" class="form-control" id="livingaddress" name="livingaddress" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                        </table>

                        <table class="table-green col-sm-12">
                            <tr>
                                <th class="col-sm-3">メールアドレス</th>
                                <td><input type="text" class="form-control" id="emailaddress" name="emailaddress" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">管理者ID</th>
                                <td><input type="text" class="form-control" id="accountid" name="accountid" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">管理者パスワード</th>
                                <td><input type="password" class="form-control" id="accountpw" name="accountpw" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                            <tr>
                                <th class="col-sm-3">管理者パスワード(確認)</th>
                                <td><input type="password" class="form-control" id="accountpwconfirm" name="accountpwconfirm" <?php echo ($add_flag==0)?'readonly':'';?>></td>
                            </tr>
                        </table>
                         <?php if($add_flag==1){?>
                        <div class="form-group">
                            <div class="col-md-3">
                                <input type="submit" class="col-md-12 btn btn-warning" value="登録する" id="btnsignup" />
                            </div>
                        </div>
                        <?php }?>
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
    <script src="<?php echo base_url("assets/js/custom/signup.js");?>"></script>
