<?php
    global $g_user_employment, $g_user_job_title, $g_user_office, $g_user_sex, $g_kana;
?>
    <div class="dark-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified dark-tabs">
                        <li role="presentation" class=""><a href="<?php echo base_url('moffice/oedit');?>">事業所情報の入力</a></li>
                        <li role="presentation" class="active"><a href="javascript:;">事業所情報の一覧</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="page_container" class="container">
        <form class="horizontal-form"  id="frm_office_list" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="orange-row">事業所検索には、「キーワード検索」と「絞り込み」が使えます。「詳細確認」、「削除」が可能です。</div>
                </div>
            </div>
        </div>

        <div class="search-area">
            <input type="hidden" name="hdn_user_cur_page" id="hdn_user_cur_page" value="<?php echo $cur_page;?>" />
            <input type="hidden" name="hdn_history_flag" id="hdn_history_flag" value="0" />

            <div class="row form-group">
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </span>
                        <input type="text" class="form-control" aria-describedby="sizing-addon2" name="txt_search_keyword" id="txt_search_keyword" value="<?php echo $keyword;?>" />
                    </div>
                </div>
                <div class="col-sm-3">
                    <input type="submit" class="btn btn-danger col-sm-12" value="検索する" name="btn_office_search" id="btn_office_search" />
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-3">
                    <select class="form-control col-sm-3" name="sel_office_search_name" id="sel_office_search_name">
                        <option value="99" selected="true">事業所名で絞り込む</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control col-sm-3" name="sel_office_search_office" id="sel_office_search_office">
                        <option value="99" selected="true">運用対象で絞り込む</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control col-sm-3" name="sel_office_search_area" id="sel_office_search_area">
                        <option value="99" selected="true">地域区分で絞り込む</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="button" class="btn btn-danger col-sm-12" value="絞り込みをクリア"  name="btn_search_clear" id="btn_search_clear"   />
                </div>
            </div>
            
        </div>

            <table class="table-green">
                <tr>
                    <td class="text-center col-sm-1">選択・詳細</td>
                    <td class="text-center col-sm-1">削除</td>
                    <td class="text-center col-sm-2">運用対象</td>
                    <td class="text-center col-sm-1">事業所番号</td>
                    <td class="text-center col-sm-2">事業所名</td>
                    <td class="text-center col-sm-2">地域区分(～H27/03)</td>
                    <td class="text-center col-sm-2">地域区分 (H27/04～)</td>
                    <td class="text-center col-sm-1">表示順</td>
                </tr>

                    <?php if(count($user_list) == 0){?>
                        <tr>
                            <td class="text-center col-sm-12" colspan="8">検出された資料がありません。</td>
                        </tr>
                    <?php }else{?>
                        <?php foreach($user_list as $key=>$user){?>
                        <tr>
                            <td class="text-center"><a href="<?php echo base_url('moffice/oedit?mem='.$user['office_id']);?>" class="btn btn-xs btn-default">詳細</a></td>
                            <td class="text-center"><a href="#"  class="btn btn-xs btn-default delete_office" data-office_id="<?php echo $user['office_id'];?>">削除</a></td>
                            <td><?php echo $user['office_class'];?></td>
                            <td><?php echo $user['office_id'];?></td>
                            <td><?php echo $user['office_name'];?></td>
                            <td><?php echo $user['office_area'];?></td>
                            <td><?php echo $user['office_area'];?></td>
                            <td><?php echo '';?></td>
                        </tr>
                        <?php }
                    }?>
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
<?php echo $this->load->view('layouts/footer'); ?>
<script src="<?php echo base_url("assets/js/custom/manager/office_list.js");?>"></script>