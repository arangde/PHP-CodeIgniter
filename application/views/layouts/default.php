<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>居宅介護支援管理ソフト</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url('assets/plugins/chosen-bootstrap/chosen/chosen.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/custom/bootstrap-timepicker/css/bootstrap-timepicker.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/plugins.css');?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/main.css');?>" rel="stylesheet">

</head>

<body>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-7"><h1 class="logo">居宅介護支援管理ソフト</h1></div>
                <div class="col-md-3 text-right">
                    ログイン情報
                    <span class="time"><?php echo date("Y/m/j H:i:s",$this->session->userdata['last_activity']);?></span><br />
                    <span class="username"><?php echo $this->session->userdata['user_name']?></span>
                </div>
                <div class="col-md-2 text-right">
                    <a href="<?php echo base_url('index/logout');?>" class="btn btn-warning">ログアウト</a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="<?php echo base_url('ahome/index');?>">居宅介護支援管理ソフト</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="<?php echo ($active_menu == 'home')?'current':'';?>">
                        <a href="<?php echo base_url('ahome/index');?>">ホーム</a>
                    </li>
                    <li class="dropdown <?php echo ($active_menu == 'contract')?'current':'';?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            利用者情報 <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('acontract/cedit');?>">登録する/入力する</a></li>
                            <li><a href="<?php echo base_url('acontract/clist');?>">一覧/編集する/削除する</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo ($active_menu == 'certinfo')?'current':'';?>">
                        <a href="<?php echo base_url('acertinfo/manage');?>">認定情報</a>
                    </li>
                    <li class="dropdown <?php echo ($active_menu == 'useslip')?'current':'';?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            利用・提供票 <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('auseslip/uscreate');?>">予定・実績を記入する</a></li>
                            <li><a href="<?php echo base_url('auseslip/usedit');?>">作成する/編集する/削除する/複写する</a></li>
                        </ul>
                    </li>
                    <li class="dropdown <?php echo ($active_menu == 'monthlytotal')?'current':'';?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            月次情報 <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('amonthlytotal/conditionselect');?>">月次集計</a></li>
                            <li><a href="<?php echo base_url('amonthlytotal/result');?>">月次集計一覧</a></li>
                            <li><a href="<?php echo base_url('amonthlytotal/plancalc');?>">計画費加算</a></li>
                            <li><a href="<?php echo base_url('amonthlytotal/billinglist');?>">月別介護請求一覧</a></li>
                        </ul>
                    </li>
                    <li class="dropdown <?php echo ($active_menu == 'admin')?'current':'';?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            管理者 <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if($this->session->userdata['role'] == 3){?>
                            <li><a href="<?php echo base_url('acorporation/info');?>">法人情報管理</a></li>
                            <?php }?>
                            <li><a href="<?php echo base_url('auser/uedit');?>">職員情報管理入力</a></li>
                            <li><a href="<?php echo base_url('auser/ulist');?>">職員情報管理一覧・編集</a></li>
                            <li><a href="<?php echo base_url('aoffice/oedit');?>">事業所情報管理入力</a></li>
                            <li><a href="<?php echo base_url('aoffice/olist');?>">事業所情報管理一覧・編集</a></li>
                            
                            <li><a href="<?php echo base_url('ainsurance/iedit');?>">保険者情報管理入力</a></li>
                            <li><a href="<?php echo base_url('ainsurance/ilist');?>">保険者情報管理一覧・管理</a></li>
                            <li><a href="<?php echo base_url('aofficesystem/osedit');?>">事業所体制管理</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php echo $main_content; ?>

</body>

</html>
