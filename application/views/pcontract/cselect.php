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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

</head>

<body>
    <div class="dark-bar">
        <div class="container">
            <h4>利用者(被保険者)を選択する</h4>
            <a href="#" class="btn btn-success btn-close">閉じる</a>
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
            <form class="horizontal-form">
                <div class="row form-group">
                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </span>
                            <input type="text" class="form-control" aria-describedby="sizing-addon2">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <input type="button" class="btn btn-danger col-sm-12" value="検索する"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option>支援事業者で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option>担当者で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option>保険者で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option>認定状況で絞り込む</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option>介護度で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option>年齢で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control">
                            <option>性別で絞り込む</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="button" class="btn btn-danger col-sm-12" value="絞り込みをクリア"/>
                    </div>
                </div>
            </form>
        </div>

        <form class="horizontal-form">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs alphabet-filter">
                        <li role="presentation" class="active"><a href="#">全</a></li>
                        <li role="presentation" class=""><a href="#">あ</a></li>
                        <li role="presentation" class=""><a href="#">か</a></li>
                        <li role="presentation" class=""><a href="#">さ</a></li>
                        <li role="presentation" class=""><a href="#">た</a></li>
                        <li role="presentation" class=""><a href="#">な</a></li>
                        <li role="presentation" class=""><a href="#">は</a></li>
                        <li role="presentation" class=""><a href="#">ま</a></li>
                        <li role="presentation" class=""><a href="#">や</a></li>
                        <li role="presentation" class=""><a href="#">ら</a></li>
                        <li role="presentation" class=""><a href="#">わ</a></li>
                        <li role="presentation" class=""><a href="#">他</a></li>
                        <li role="presentation" class="pull-right"><a href="#">検索</a></li>
                        <li role="presentation" class="pull-right"><a href="#">履歴</a></li>
                    </ul>
                </div>
            </div>
            <table class="table-green">
                <tr>
                    <td class="text-center">選択</td>
                    <td class="text-center">詳細</td>
                    <td class="text-center">削除</td>
                    <td class="text-center col-sm-2">氏名</td>
                    <td class="text-center">年齢</td>
                    <td class="text-center">介護度</td>
                    <td class="text-center">認定状況</td>
                    <td class="text-center col-sm-2">保険者</td>
                    <td class="text-center col-sm-2">支援事業者</td>
                    <td class="text-center col-sm-2">担当者</td>
                </tr>
                <tr>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">選択</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">詳細</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">削除</a></td>
                    <td>氏名</td>
                    <td>年齢</td>
                    <td>介護度</td>
                    <td>認定状況</td>
                    <td>保険者</td>
                    <td>支援事業者</td>
                    <td>担当者</td>
                </tr>
                <tr>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">選択</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">詳細</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">削除</a></td>
                    <td>氏名</td>
                    <td>年齢</td>
                    <td>介護度</td>
                    <td>認定状況</td>
                    <td>保険者</td>
                    <td>支援事業者</td>
                    <td>担当者</td>
                </tr>
                <tr>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">選択</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">詳細</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">削除</a></td>
                    <td>氏名</td>
                    <td>年齢</td>
                    <td>介護度</td>
                    <td>認定状況</td>
                    <td>保険者</td>
                    <td>支援事業者</td>
                    <td>担当者</td>
                </tr>
                <tr>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">選択</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">詳細</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">削除</a></td>
                    <td>氏名</td>
                    <td>年齢</td>
                    <td>介護度</td>
                    <td>認定状況</td>
                    <td>保険者</td>
                    <td>支援事業者</td>
                    <td>担当者</td>
                </tr>
                <tr>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">選択</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">詳細</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">削除</a></td>
                    <td>氏名</td>
                    <td>年齢</td>
                    <td>介護度</td>
                    <td>認定状況</td>
                    <td>保険者</td>
                    <td>支援事業者</td>
                    <td>担当者</td>
                </tr>
                <tr>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">選択</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">詳細</a></td>
                    <td class="text-center"><a href="#" class="btn btn-xs btn-default">削除</a></td>
                    <td>氏名</td>
                    <td>年齢</td>
                    <td>介護度</td>
                    <td>認定状況</td>
                    <td>保険者</td>
                    <td>支援事業者</td>
                    <td>担当者</td>
                </tr>
            </table>
        </form>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    
    </script>

</body>

</html>
