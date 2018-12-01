<?php
ob_start();
session_start();
if(isset($_SESSION['user']) === TRUE) {
   // ログイン済みの場合、ホームページへリダイレクト
   header("Location: home.php"); 
}
// DBとの接続
include_once 'dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン</title>
    <!-- Bootstrap読み込み（スタイリングのため） -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">
    <div class="box"></div>
    
<?php
// ログインボタンがクリックされたときに下記を実行
if(isset($_POST['login'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $mysqli->real_escape_string($_POST['password']);
// クエリの実行
$query = "SELECT *FROM users WHERE email='$email'";
$result = $mysqli->query($query);
if(!$result) {
    print('クエリが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}
// パスワード(暗号化済み）とユーザーIDの取り出し
while($row = $result->fetch_assoc()) {
    $db_hashed_pwd = $row['password'];
    $id = $row['id'];
}
// データベースの切断
$result->close();

// ハッシュ化されたパスワードがマッチするかどうかを確認
if(password_verify($password, $db_hashed_pwd)) {
    $_SESSION['user'] = $id;
    header("Location: home.php");
    exit;
} else { ?>
    <div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>
<?php }
} ?>

<!-- ナビゲーションバー設定 -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a href="top.php" class="navbar-brand">BLOG</a>
    </div>
    <div id="navbar" class="navbar-right">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="user-create.php">新規登録</a></li>
        <li><a href="login.php">ログイン</a></li>
      </ul>
    </div>
  </div>
</nav>

    <div class="panel panel-default">
    <div class="panel-heading">ログイン</div>
    <div class="panel-body">
        <form method="post">
        <div class="form-group">
            <label>メールアドレス<input type="email" class="form-control" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>" placeholder="メールアドレスを入力して下さい。" size="80"></label><br>
        </div>
        <div class="form-group">
        <label>パスワード<input type="password" class="form-control" name="password" placeholder="パスワードを入力して下さい。" size="80"></label><br />
        </div>
        <button type="submit" class="btn btn-primary" name="login" style="margin-right: 20px;">ログインする</button>
        <a href="user-create.php">新規登録はこちら</a>
        </form>
    </div>
    </div>
</div>
</body>
</html>