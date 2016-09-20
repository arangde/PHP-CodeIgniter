
    <div class="dark-bar">
        <h4>事業所体制管理情報の入力</h4>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="orange-row">事業所情報を入力する。</div>
                </div>
            </div>
        </div>
    </div>

    <div id="page_container" class="container">
        <form class="horizontal-form">
            <span>H28/04～</span>
            <table class="table-green">
                <tr>
                    <th class="text-center col-sm-2">特別地域加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />なし</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />あり</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">小規模事業所加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />非該当</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />該当</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">特定事業所加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />なし</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />加算I</label>
                            <label><input type="radio" name="rd_user_employment"  value="2" />加算II</label>
                            <label><input type="radio" name="rd_user_employment"  value="3" />加算III</label>
                        </div>
                    </td>
                </tr>
            </table>
            <span>H27/04～H28/03</span>
            <table class="table-green">
                <tr>
                    <th class="text-center col-sm-2">特別地域加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />なし</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />あり</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">小規模事業所加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />非該当</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />該当</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">特定事業所加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />なし</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />加算I</label>
                            <label><input type="radio" name="rd_user_employment"  value="2" />加算II</label>
                            <label><input type="radio" name="rd_user_employment"  value="3" />加算III</label>
                        </div>
                    </td>
                </tr>
            </table>
            <span>～H27/03</span>
            <table class="table-green">
                <tr>
                    <th class="text-center col-sm-2">特別地域加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />なし</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />あり</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">小規模事業所加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />非該当</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />該当</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center">特定事業所加算</th>
                    <td>
                        <div class="checkbox">
                            <label><input type="radio" name="rd_user_employment"  value="0" />なし</label>
                            <label><input type="radio" name="rd_user_employment"  value="1" />加算I</label>
                            <label><input type="radio" name="rd_user_employment"  value="2" />加算II</label>
                            <label><input type="radio" name="rd_user_employment"  value="3" />加算III</label>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                            保険・認定情報を入力した後、「保存する」ボタンを押して、内容を保存する。
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="#" class="btn btn-success">保存する</a>
                        </div>
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
    <script src="<?php echo base_url("assets/js/custom/manager/officesystem_edit.js");?>"></script>