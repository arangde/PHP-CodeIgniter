<?php
    global $g_user_employment, $g_user_job_title, $g_user_office, $g_user_sex;
?>
    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class="active"><a href="javascript:;">保険者情報の入力</a></li>
                        <li role="presentation" class=""><a href="<?php echo base_url('ainsurance/ilist');?>">保険者情報の一覧</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="page_container" class="container">
        <form class="horizontal-form" id="frm_insurer_edit" method="post">
            <input type="hidden" name="hdn_input_flag" id="hdn_input_flag" value="<?php echo $input_flag;?>" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="orange-row">保険者情報を入力する。</div>
                            </div>
                            <div class="col-md-8 text-right">
                                <?php if($input_flag==0){ ?>
                                <input type="button" class="btn btn-success delete_insurer" data-insurer_id="<?php echo $insurer_data['insurer_id'];?>" user_data value="名簿から削除" id="btn_insurer_delete" name="btn_insurer_delete" />
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="button" class="btn btn-success" value="すべてクリア" id="btn_insurer_clear" name="btn_insurer_clear" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <span>保険者情報</span>
            <table class="table-green th-center">
                <tr>
                    <th class="col-md-2">保険者番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control "  name="txt_insurer_id" id="txt_insurer_id" value="<?php echo $insurer_data['insurer_id'];?>" readonly />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>保険者名</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control " name="txt_insurer_name" id="txt_insurer_name"  value="<?php echo $insurer_data['insurer_name'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>表示順</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_sort_id" id="txt_sort_id"  value="<?php echo $insurer_data['sort_id'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                
            </table>

            <div class="form-group">
                <div class="orange-row">
                    <div class="row">
                        <div class="col-md-8">
                        <?php if($input_flag == 0){?>
                            「編集する」ボタンを押して、内容を編集する。
                        <?php }else if($input_flag == 1){?>
                            「保存する」ボタンを押して、内容を保存する。
                        <?php }?>
                        </div>
                        <div class="col-md-4 text-right">
                            <input type="submit" class="btn btn-success" value="<?php echo ($input_flag == 1)?'保存する':'編集する';?>" id="btn_insurer_save"  />
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
<script src="<?php echo base_url("assets/js/custom/insurance_edit.js");?>"></script>