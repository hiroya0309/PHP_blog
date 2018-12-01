<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>記事一覧</title>
    <!--// Bootstrap読み込み（スタイリングのため） -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<!-- ナビゲーションバー設定 -->
<?php include_once(dirname(__FILE__).' /./form/nav.html');?>

<?php
$form=$_GET["form"];
//ページング機能
$page = $_REQUEST['page'];
//指定がなければ$pageは１
if ($page == "") {
  $page = 1;
}
//$pageが１より小さい場合は１
$page = max($page, 1);
//最終ページを決める
$query = "SELECT COUNT(id)
          FROM posts
          WHERE form ='$form'";
$recodeSet = $mysqli->query($query);
$res = mysqli_fetch_assoc($recodeSet);
$ares = ($res['COUNT(id)']);
$maxPage = ceil($ares /5);
$page = min($page, $maxPage);
//オフセットの値を指定
$start = ($page -1) * 5;
//最新記事から5記事ごと表示
$query = "SELECT * , LEFT(body,250)as content FROM posts WHERE form ='$form' ORDER BY id DESC LIMIT {$start},5";

?>

<div class="col-md-4 col-sm-offset-1">
  <div class="box_home" style="height:50px;"></div>
  <h1>記事一覧</h1>
    <input type="submit" name="btn_back" value="記事投稿" onClick="location.href='regist.php'"><br>

<?php
if($result = $mysqli->query($query)) {
  while($row = $result->fetch_assoc()) {
?>
  <div class="box2">
  <section class="post-item">
      <p><?php if( $row['form'] === "1" ){ echo '開発'; }
      elseif( $row['form'] === "2" ){ echo '組織・チーム'; }
      elseif( $row['form'] === "3" ){ echo 'インフラ'; }
      elseif( $row['form'] === "4" ){ echo '最新情報'; }
      ?></p>
    <h3><a class="home-title" href="page.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h3>
      <p>投稿日：<?php echo date('Y-m-d',strtotime($row['create_at'])); ?><?php if ($row['create_at'] < $row['updated_at']){echo '(更新日：'.date('Y-m-d',strtotime($row['updated_at'])).')';} ?></p>
    <hr>
    <h4><?php echo $row['content']; ?></h4>
    <h4><a class="home-title" href="page.php?id=<?php echo $row['id']; ?>">もっと読む．．．</a></h4>
      <p>投稿者：<?php echo $row['name']; ?></p>
  </section>
  </div>
<?php }
  }else{ ?>
  <br>
  <h4><label>カテゴリーはありません。</label></h4>
<?php } ?>
<!-- ページング -->
<p>
  <?php if ($page > 1) : ?>
    <a href="category.php?page=<?php echo ($page - 1); ?>&form=<?php if(!empty($form)){ echo $form; } ?>">前のページ </a>
  <?php endif; ?>

  <?php if ($page < $maxPage) : ?>
    <a href="category.php?page=<?php echo ($page + 1); ?>&form=<?php if(!empty($form)){ echo $form; } ?>"> 次のページ</a>
  <?php endif; ?>
</p>
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
