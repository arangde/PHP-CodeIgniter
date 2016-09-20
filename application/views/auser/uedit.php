<?php
    global $g_user_employment, $g_user_job_title, $g_user_office, $g_user_sex;
?>
    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class="active"><a href="javascript:;">職員情報の入力</a></li>
                        <li role="presentation" class=""><a href="<?php echo base_url('auser/ulist');?>">職員情報の一覧</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="page_container" class="container">
        <form class="horizontal-form" id="frm_user_edit" method="post">
            <input type="hidden" name="hdn_input_flag" id="hdn_input_flag" value="<?php echo $input_flag;?>" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="orange-row">職員情報を入力する。</div>
                            </div>
                            <div class="col-md-8 text-right">
                                <?php if($input_flag==0){?>
                                <input type="button" class="btn btn-success delete_user" data-user_id="<?php echo $user_data['user_id'];?>" user_data value="名簿から削除" id="btn_user_delete" name="btn_user_delete" />
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="button" class="btn btn-success" value="すべてクリア" id="btn_user_clear" name="btn_user_clear" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <span>職員情報</span>
            <table class="table-green th-center">
                <tr>
                    <th class="col-md-2">職員番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control "  name="txt_user_id" id="txt_user_id" value="<?php echo $user_data['user_id'];?>" readonly />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>フリガナ</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control " name="txt_user_furigana" id="txt_user_furigana"  value="<?php echo $user_data['furigana'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>氏名</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_user_name" id="txt_user_name"  value="<?php echo $user_data['username'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>識別記号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_user_symbol" id="txt_user_symbol"  value="<?php echo $user_data['symbol'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td colspan="2">
                        <select class="input-sm col-sm-2" name="sel_user_sex" id="sel_user_sex">
                            <?php foreach($g_user_sex as $key=>$s){?>
                            <option value="<?php echo $key;?>" <?php echo ($key==$user_data['sex'])?'selected':'';?>><?php echo $s;?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_user_phone_number" id="txt_user_phone_number"  value="<?php echo $user_data['phone_number'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_user_email" id="txt_user_email"  value="<?php echo $user_data['user_email'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>職種</th>
                    <td colspan="2">
                        <select class="input-sm col-sm-4" name="sel_user_job_title" id="sel_user_job_title">
                            <?php foreach($g_user_job_title as $key=>$jt){?>
                            <option value="<?php echo $key;?>" <?php echo ($key==$user_data['job_title'])?'selected':'';?>><?php echo $jt;?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>介護支援専門員番号</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_user_support_number" id="txt_user_support_number"  value="<?php echo $user_data['support_number'];?>" />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td colspan="2">
                        <textarea class="form-control" rows="3" name="txt_user_note" id="txt_user_note" ><?php echo $user_data['note'];?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <th>表示順</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_user_sort_id" id="txt_user_sort_id"   value="<?php echo $user_data['sort_id'];?>"  />
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                <th>ログインID</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <?php if($input_flag == 0){?>
                                    <input type="hidden" class="form-control" name="txt_user_login_id" id="txt_user_login_id"  value="<?php echo $user_data['login_id'];?>" />
                                    <?php echo $user_data['login_id'];?>
                                <?php }else{?>
                                <input type="text" class="form-control" name="txt_user_login_id" id="txt_user_login_id"  value="<?php echo $user_data['login_id'];?>" />
                                <?php }?>
                            </div>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <th>パスワード</th>
                    <td colspan="2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="txt_user_password" id="txt_user_password"  value="" />
                            </div>
                            <?php if($input_flag == 0){?>
                            <div class="col-md-3 checkbox">
                                <label>
                                <input type="checkbox" name="chk_password_change" id="chk_password_change" />
                                パスワードの変更
                                </label>
                            </div>
                            <?php }?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>ログイン権限</th>
                    <td colspan="2">
                        <div class="checkbox">
                                <?php if($input_flag == 0){?>
                                    <label><input type="radio" name="rd_user_role" <?php echo ($user_data['role']==1)?'checked':'';?> value="1" /> 一般権限</label>
                                <label><input type="radio" name="rd_user_role" <?php echo ($user_data['role']==2)?'checked':'';?>  value="2" /> 管理者権限</label>
                                <?php }else{?>
                                    <label><input type="radio" name="rd_user_role"  value="1" /> 一般権限</label>
                                <label><input type="radio" name="rd_user_role" checked value="2" /> 管理者権限</label>
                                <?php }?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>雇用</th>
                    <td colspan="2">
                        <div class="checkbox">
                        <?php foreach($g_user_employment as $key=>$ue){?>
                            <label><input type="radio" name="rd_user_employment"  value="<?php echo $key;?>" <?php echo ($key==$user_data['employment'])?'checked':'';?>/><?php echo $ue;?></label>
                        <?php }?>
                        </div>
                    </td>
                </tr>
                 <tr>
                    <th rowspan="5">適用事業所</th>
                    <td colspan="2">
                        <select class="input-sm col-sm-4" name="sel_user_office_id" id="sel_user_office_id">
                            <?php foreach($offices as $key=>$o){?>
                            <option value="<?php echo  $o['office_id'];?>" <?php echo ($o['office_id']==$user_data['office_id'])?'selected':'';?>><?php echo $o['office_name'];?></option>
                            <?php }?>
                        </select>
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
                            <input type="submit" class="btn btn-success" value="<?php echo ($input_flag == 1)?'保存する':'編集する';?>" id="btn_user_save"  />
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
<script src="<?php echo base_url("assets/js/custom/user_edit.js");?>"></script>