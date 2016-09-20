 <?php
    global $g_user_employment, $g_user_job_title, $g_user_office, $g_user_sex, $g_kana;
?>
    <?php echo $this->load->view('pcontract/csearchbox'); ?>

    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class=""><a href="<?php echo base_url('pcontract/cedit');?>">利用者(被保険者)情報の入力</a></li>
                        <li role="presentation" class="active"><a href="javascript:;">利用者(被保険者)情報の一覧</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="page_container" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="orange-row">利用者検索には、「キーワード検索」と「絞り込み」が使えます。「利用者の選択」、「詳細確認」、「削除」が可能です。</div>
                </div>
            </div>
        </div>

        <div class="search-area">
            <form class="horizontal-form" id="frm_contract_list" name="frm_contract_list" method="post">
                <input type="hidden" name="hdn_search_kana_id" id="hdn_search_kana_id" value="<?php echo $kana;?>" />
                <input type="hidden" name="hdn_cur_page" id="hdn_cur_page" value="<?php echo $cur_page;?>" />
                <input type="hidden" name="hdn_history_flag" id="hdn_history_flag" value="0" />
                <div class="row form-group">
                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </span>
                            <input type="text" class="form-control" aria-describedby="sizing-addon2" name="txt_search_keyword" id="txt_search_keyword" value="<?php echo $keyword;?>"   />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <input type="submit" class="btn btn-danger col-sm-12" name="btn_search" id="btn_search" value="検索する"/>
                    </div>
                </div>
                <div class="row form-group" name="sel_search_office" id="sel_search_office">
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option>支援事業者で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="sel_search_manager" id="sel_search_manager">
                            <option>担当者で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="sel_search_insurance" id="sel_search_insurance">
                            <option>保険者で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="sel_search_certstate" id="sel_search_certstate">
                            <option>認定状況で絞り込む</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-3">
                        <select class="form-control" name="sel_search_protect_degree" id="sel_search_protect_degree">
                            <option>介護度で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="sel_search_age" id="sel_search_age">
                            <option>年齢で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="sel_search_sex" id="sel_search_sex">
                            <option>性別で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="button" class="btn btn-danger col-sm-12" value="絞り込みをクリア"  name="btn_search_clear" id="btn_search_clear" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs alphabet-filter ul-kana">
                        <?php foreach($g_kana as $key=>$kana1){?>
                        <li role="presentation" class="select-kana <?php echo ($key==$kana)?"active":"";?> " data-kana_value="<?php echo $key;?>"><a href="#"><?php echo $kana1[0];?></a></li>
                        <?php }?>
                        
                        <li role="presentation" class="pull-right <?php echo ($history_flag==0)?'active':'';?>" id="user_search_view"><a href="#">検索</a></li>
                        <li role="presentation" class="pull-right <?php echo ($history_flag==1)?'active':'';?>" id="user_history_view"  ><a href="#">履歴</a></li>
                    </ul>
                </div>
            </div>
            <table class="table-green">
                <tr>
                    <td class="text-center col-sm-1">選択・詳細</td>
                    <td class="text-center col-sm-1">削除</td>
                    <td class="text-center col-sm-2">氏名</td>
                    <td class="text-center">年齢</td>
                    <td class="text-center">介護度</td>
                    <td class="text-center">認定状況</td>
                    <td class="text-center col-sm-2">保険者</td>
                    <td class="text-center col-sm-2">支援事業者</td>
                    <td class="text-center col-sm-2">担当者</td>
                </tr>
                <?php if($history_flag == 1){?>
                    <?php if(count($history_list) == 0){?>
                        <tr>
                            <td class="text-center col-sm-12" colspan="9">検出された資料がありません。</td>
                        </tr>
                    <?php }else{?>
                        <?php foreach($history_list as $key=>$contract){?>
                        <tr>
                            <td class="text-center"><a href="<?php echo base_url('pcontract/cedit?cid='.$contract['contract_id']);?>" class="btn btn-xs btn-default">詳細</a></td>
                            <td class="text-center"><a href="#"  class="btn btn-xs btn-default delete_contract disabled" data-contract_id="<?php echo $contract['contract_id'];?>">削除</a></td>
                            <td><?php echo $contract['c_username'];?></td>
                            <td><?php echo $contract['c_birthday'];?></td>
                            <td><?php echo '介護度';?></td>
                            <td><?php echo '認定状況';?></td>
                            <td><?php echo $contract['c_masternumber'];?></td>
                            <td><?php echo $contract['office_id'];?></td>
                            <td><?php echo $contract['c_masternumber'];?></td>
                        </tr>
                        <?php }
                    }?>
                <?php }else{?>
                    <?php if(count($contract_list) == 0){?>
                        <tr>
                            <td class="text-center col-sm-12" colspan="9">検出された資料がありません。</td>
                        </tr>
                    <?php }else{?>
                        <?php foreach($contract_list as $key=>$contract){?>
                        <tr>
                            <td class="text-center"><a href="<?php echo base_url('pcontract/cedit?cid='.$contract['contract_id']);?>" class="btn btn-xs btn-default">詳細</a></td>
                            <td class="text-center"><a href="#"  class="btn btn-xs btn-default delete_contract" data-contract_id="<?php echo $contract['contract_id'];?>">削除</a></td>
                            <td><?php echo $contract['c_username'];?></td>
                            <td><?php echo $contract['c_birthday'];?></td>
                            <td><?php echo '介護度';?></td>
                            <td><?php echo '認定状況';?></td>
                            <td><?php echo $contract['c_masternumber'];?></td>
                            <td><?php echo $contract['office_id'];?></td>
                            <td><?php echo $contract['c_masternumber'];?></td>
                        </tr>
                        <?php }
                    }?>
                <?php }?>
            </table>
            <?php if($page_count > 1 && $history_flag == 0){?>
            <div class="row">
                <div class="col-md-12">
                    <nav class="text-center">
                      <ul class="pagination">
                        <li>
                            <span aria-hidden="true">Page <?php echo $cur_page;?>/<?php echo $page_count;?></span>
                        </li>
                        <li class="<?php echo ($cur_page<2)?'disabled':'';?>">
                          <a href="#" aria-label="First" class="pagination_normal_item " data-page_id="1">
                            <span aria-hidden="true">最初</span>
                          </a>
                        </li>
                        <li class="<?php echo ($cur_page<2)?'disabled':'';?>">
                          <a href="#" aria-label="Previous"  class="pagination_normal_item " data-page_id="<?php echo ($cur_page == 1)?$cur_page:$cur_page-1;?>">
                            <span aria-hidden="true">前へ</span>
                          </a>
                        </li>
                        <?php 

                            if(($cur_page < 4)){
                                $page_start = 0;
                            }else{
                                if($page_count-$cur_page < 7){
                                    if($page_count < 10){
                                        $page_start = 0;
                                    }else{
                                     $page_start = $page_count - 10;
                                    }
                                }else{
                                    $page_start = $cur_page-4;
                                }
                            }

                            for($i = $page_start; ($i < $page_start+$page_count) and ($i < $page_start+10) and ($i<$page_count); $i++){?>
                                <li class="<?php echo ($i == $cur_page-1)?'active':'';?>">
                                    <a href="#" class="pagination_normal_item " data-page_id="<?php echo $i+1;?>"><?php echo $i+1;?></a>
                                </li>
                        <?php }?>
                        <li class="<?php echo ($page_count<=$cur_page)?'disabled':'';?>">
                          <a href="#" aria-label="Next" class="pagination_normal_item " data-page_id="<?php echo ($cur_page == $page_count)?$cur_page:$cur_page+1;?>">
                            <span aria-hidden="true">次へ</span>
                          </a>
                        </li>
                        <li class="<?php echo ($page_count<=$cur_page)?'disabled':'';?>">
                          <a href="#" aria-label="last" class="pagination_normal_item " data-page_id="<?php echo $page_count;?>">
                            <span aria-hidden="true">最終</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                </div>
            </div>
            <?php }?>
        </form>
    </div>
    <!-- /.container -->
<?php echo $this->load->view('layouts/pfooter'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/dist/additional-methods.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery-validation/localization/messages_ja.js');?>"></script>
<script src="<?php echo base_url("assets/js/custom/person/contract_list.js");?>"></script>
<script src="<?php echo base_url("assets/js/custom/person/csearchbox.js");?>"></script>
