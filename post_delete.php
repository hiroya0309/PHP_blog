<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> 投稿削除</title>
    <!--// Bootstrap読み込み（スタイリングのため） -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
session_start();
include_once 'dbconnect.php';
// posts情報を取り出す
$query = "SELECT * FROM posts WHERE id=".$_GET['id'].""; //SESSIONを使った方がいいのか？
$result = $mysqli->query($query);
if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}

while($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $title = $row['title'];
    $form = $row['form'];
    $name = $row['name'];
    $body = $row['body'];
}
// 「削除する」を押下されたら
if(isset($_POST['delete'])) {
$sql = "DELETE FROM posts WHERE id = $id";
if($mysqli->query($sql)) {  ?>
<?php header('Location: post_delete_complete.php');
      exit(); ?>
<?php }else { ?>
    <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
<?php
    }
}
$mysqli->close();
?>

<!-- ナビゲーションバー設定 -->
<?php include_once(dirname(__FILE__).' /./form/nav.html');?>

<div class="col-md-8 col-md-offset-2" style="margin-top:30px";>
    <div class="box_regist"></div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">内容確認</h5>
            </div>
            <div class="panel-body">
                <form action="" method="post">
                <div class="form-group">
                    <label>タイトル</label><br>
                        <p><?php echo $title; ?></p>
                </div>
                <hr>
                <div class="form-group">
                    <label>カテゴリー</label><br>
                        <p><?php if( $form === "1" ){ echo '開発'; }
                        elseif( $form === "2" ){ echo '組織・チーム'; }
                        elseif( $form === "3" ){ echo 'インフラ'; }
                        elseif( $form === "4" ){ echo '最新情報'; }
                        ?></p>
                </div>
                <hr>
                <div class="form-group">
                    <label>投稿者</label><br>
                        <p><?php echo $name; ?></p>
                </div>
                <hr>
                <div class="form-group">
                    <label>本文</label><br>
                        <p><?php echo nl2br($body); ?></p>
                </div>
                <hr>
                <button type="button" class="btn btn-default" onclick="history.back()" style="margin-right:10px;">戻る</button>
                <input type="submit" class="btn btn-warning" name="delete" value="削除する">
                </form>
            </div>
            </div>
</div>
</body>
</html>
