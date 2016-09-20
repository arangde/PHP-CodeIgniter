

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
                                    <h4 class="red-title"><a href="<?php echo base_url('mcontract/cedit');?>">利用者情報</a></h4>
                                    <p>利用者(被保険者)の情報の<span class="text-red">登録・入力</span>を行います。</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="red-title"><a href="<?php echo base_url('mcontract/clist');?>">利用者情報</a></h4>
                                    <p>登録した利用者情報の<span class="text-red">一覧表示・編集・削除</span>を行います。</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="blue2-title"><a href="<?php echo base_url('mcertinfo/manage');?>">認定情報管理</a></h4>
                                    <p>認定情報の<span class="text-red">登録・訂正・更新・削除</span>を行います。</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="yellow-title"><a href="<?php echo base_url('museslip/uscreate');?>">利用・提供票</a></h4>
                                    <p><span class="text-red">予定・実績の記入</span>を行います。</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="yellow-title"><a href="<?php echo base_url('museslip/usedit');?>">利用・提供票</a></h4>
                                    <p>利用・提供票の<span class="text-red">作成・編集・削除・複写</span>を行います。</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="blue-title"><a href="<?php echo base_url('mmonthlytotal/result');?>">月次情報</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="blue-title"><a href="<?php echo base_url('mmonthlytotal/plancalc');?>">計画費加算</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="blue-title"><a href="<?php echo base_url('mmonthlytotal/billinglist');?>">介護請求一覧</a></h4>
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
                                    <h4 class="dark-title"><a href="<?php echo base_url('muser/uedit');?>">職員情報管理</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="dark-title"><a href="<?php echo base_url('minsurance/iedit');?>">介護保険者情報管理</a></h4>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="item">
                                    <h4 class="dark-title"><a href="<?php echo base_url('mofficesystem/osedit');?>">事業所体制情報管理</a></h4>
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
<script src="<?php echo base_url("assets/js/custom/manager/home.js");?>"></script>
