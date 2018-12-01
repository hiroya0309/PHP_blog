<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> 個別記事</title>
    <!--// Bootstrap読み込み（スタイリングのため） -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<style>
body {
  background-color:#f5f5f5;
}
</style>

<!-- ナビゲーションバー設定 -->
<?php include_once(dirname(__FILE__).' /./form/nav.html');?>

<!-- メインメニュー -->
<div class="col-md-4 col-sm-offset-1">
  <div class="main-mnue">
<?php
session_start();
include_once 'dbconnect.php';
$query = "SELECT * FROM posts WHERE id=".$_GET['id'].""; //SESSIONを使った方がいいのか？
$result = $mysqli->query($query);
if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}
?>
<?php while($row = $result->fetch_assoc()) { ?>
  <section class="post-item">
    <p><?php if( $row['form'] === "1" ){ echo '開発'; }
    elseif( $row['form'] === "2" ){ echo '組織・チーム'; }
    elseif( $row['form'] === "3" ){ echo 'インフラ'; }
    elseif( $row['form'] === "4" ){ echo '最新情報'; }
    ?></p>
    <h1><?php echo $row['title']; ?></h1>
    <p>投稿日：<?php echo date('Y-m-d',strtotime($row['create_at'])); ?><?php if ($row['create_at'] < $row['updated_at']){echo '(更新日：'.date('Y-m-d',strtotime($row['updated_at'])).')';} ?></p>
    <div style="display:inline-flex">
      <form action="post_edit.php" method="get">
          <input type="submit" class="btn btn-default btn-sm" name="edit" value="編集"  style="margin-right:10px;">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- SESSIONを使った方がいいのか？ -->
      </form>
      <form action="post_delete.php" method="get">
          <input type="submit" class="btn btn-default btn-sm" name="delete" value="削除">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- SESSIONを使った方がいいのか？ -->
      </form>
    </div>
    <hr>
    <h4><?php echo nl2br($row['body']); ?></h4>
  </section>
<?php } ?>
  <input type="submit" name="btn_back" value="記事一覧" onClick="location.href='home.php'"><br>
  </div>
</div>

<!-- サイドメニュー -->
<div class="home-sidemenu">
<?php include_once(dirname(__FILE__).' /./form/side-profile.php');?>

  <h5>記事検索</h5>
    <form name ="key" action ="home-kennsaku.php" method ="post">
      <p>
        <input type ="text" name ="kennsaku">
        <input type ="submit" name ="bottan" value ="検索">
      </p>
    </form>
  <hr>

<!-- 最新記事 -->
<?php include_once(dirname(__FILE__).' /./form/side-newpage.php');?>

<!-- カテゴリー -->
<?php include_once(dirname(__FILE__).' /./form/side-category.php');?>

<!-- アーカイブ -->
<?php include_once(dirname(__FILE__).' /./form/side-arcive.php');?>
</div>
<?php
//データベースの切断
$result->close();
?>
</body>
</html>
