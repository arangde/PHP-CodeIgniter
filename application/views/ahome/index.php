

<div id="page_container" class="container">

    <div class="box">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">
                    職員用
                </h2>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="red-title"><a href="<?php echo base_url('acontract/cedit');?>">利用者情報</a></h4>
                                    <p>利用者(被保険者)の情報の<span class="text-red">登録・入力</span>を行います。</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="red-title"><a href="<?php echo base_url('acontract/clist');?>">利用者情報</a></h4>
                                    <p>登録した利用者情報の<span class="text-red">一覧表示・編集・削除</span>を行います。</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="blue2-title"><a href="<?php echo base_url('acertinfo/manage');?>">認定情報管理</a></h4>
                                    <p>認定情報の<span class="text-red">登録・訂正・更新・削除</span>を行います。</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="yellow-title"><a href="<?php echo base_url('auseslip/uscreate');?>">利用・提供票</a></h4>
                                    <p><span class="text-red">予定・実績の記入</span>を行います。</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="yellow-title"><a href="<?php echo base_url('auseslip/usedit');?>">利用・提供票</a></h4>
                                    <p>利用・提供票の<span class="text-red">作成・編集・削除・複写</span>を行います。</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="blue-title"><a href="<?php echo base_url('amonthlytotal/result');?>">月次情報</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="blue-title"><a href="<?php echo base_url('amonthlytotal/plancalc');?>">計画費加算</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="blue-title"><a href="<?php echo base_url('amonthlytotal/billinglist');?>">介護請求一覧</a></h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5 class="green-title">介護関連情報　お知らせ</h5>
                        <p class="text-orange">
                            New! 関連情報を表示します。<br />
                            New! 関連情報を表示します。<br />
                            New! 関連情報を表示します。<br />
                            New! 関連情報を表示します。<br />
                            New! 関連情報を表示します。<br />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($this->session->userdata['role'] == 2 || $this->session->userdata['role'] == 3){?>
    <div class="box">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-title">
                    管理者用
                </h2>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="dark-title"><a href="<?php echo base_url('acorporation/info');?>">法人情報管理</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="dark-title"><a href="<?php echo base_url('auser/uedit');?>">職員情報管理</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="dark-title"><a href="<?php echo base_url('aoffice/oedit');?>">事業所情報管理</a></h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="dark-title"><a href="<?php echo base_url('ainsurance/iedit');?>">介護保険者情報管理</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="dark-title"><a href="<?php echo base_url('aofficesystem/osedit');?>">事業所体制情報管理</a></h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5 class="green-title">システム関連　お知らせ</h5>
                        <p class="text-orange">
                            システム関連のお知らせ<br />
                            **修正しました。<br />
                            **情報を更新しました。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>
<!-- /.container -->
<?php echo $this->load->view('layouts/footer'); ?>
<script src="<?php echo base_url("assets/js/custom/home.js");?>"></script>
