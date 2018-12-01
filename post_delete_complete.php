<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>投稿削除画面</title>
        <!--// Bootstrap読み込み（スタイリングのため） -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<!-- ナビゲーションバー設定 -->
<?php include_once(dirname(__FILE__).' /./form/nav.html');?>
<div class="col-md-4 col-sm-offset-1">
    <div class="box_home" style="height:50px;"></div>
        <div class="container">
            <div class="row">
            <div class="col-sm-12">
                    <hr>
                    <h1>削除完了<h1>
                    <hr>
                    <h4>記事が削除されました。</h4><br>
                    <a href="home.php" class="btn btn-success" role="button" style="margin-right: 20px;">記事一覧へ戻る</a>
                    <a href="regist.php" class="btn btn-primary" role="button">記事投稿</a>
            </div>
            </div>
        </div>
</div>
</html>
