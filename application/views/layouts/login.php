<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ログイン</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/main.css");?>" rel="stylesheet">

</head>

<body>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12"><a href="<?php echo base_url('/');?>"><h1 class="logo">居宅介護支援管理ソフト</h1></div>
            </div>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">居宅介護支援管理ソフト</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php echo $main_content; ?>

</body>

</html>
