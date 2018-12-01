<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>トップページ</title>
    <!-- Bootstrap読み込み（スタイリングのため） -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="extend"> 

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
    
<div class="col-xs-6 col-xs-offset-3">
    <h1 class="title">BLOG</h1>

    <form method="post">
        <div style="text-align:center;"><a class="btn btn-black" href="user-create.php" role="button">新規登録はこちら！</a></div>
    </form>
</div> 
</body>
</html>