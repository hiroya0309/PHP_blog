<?php
//var_dump($_POST);

// 変数の初期化
$page_flag = 0;
$clean = array();
$error = array();

// サニタイズ
if( !empty($_POST) ) {
	foreach( $_POST as $key => $value ) {
		$clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
	}
}

if( !empty($_POST['confirm']) ) {
    $error = validation($clean);
    if(empty($error)){
        $page_flag = 1;
    }

} elseif( !empty($_POST['action']) ) {
	$page_flag = 2;
}

// バリデーション
function validation($data) {
	$error = array();

	if( empty($data['title']) ) {
		$error[] = "タイトルを入力してください。";
	}

    if( empty($data['form']) ) {
		$error[] = "カテゴリーを選んでください。";
    }

	if( empty($data['name']) ) {
		$error[] = "投稿者を入力してください。";
    }

    if( empty($data['body']) ) {
		$error[] = "本文を入力してください。";
    }

    return $error;
}
?>

<?php
session_start();
include_once 'dbconnect.php';
// ユーザーIDを取り出す
$query = "SELECT * FROM users WHERE id=".$_SESSION['user']."";
$result = $mysqli->query($query);
while($row = $result->fetch_assoc()) {
    $user_id = $row['id'];
}

// 「投稿する」を押下されたらDBに保存
if(isset($_POST['action'])) {

$title = $mysqli->real_escape_string($_POST['title']);
$form = $mysqli->real_escape_string($_POST['form']);
$name = $mysqli->real_escape_string($_POST['name']);
$body = $mysqli->real_escape_string($_POST['body']);


// POSTされた情報をDBに格納する
$sql = "INSERT INTO posts(user_id,title,form,name,body,create_at) VALUES('$user_id','$title','$form' ,'$name', '$body', now())";
if($mysqli->query($sql)) {  ?>
      <!--<div class="alert alert-success center-block" role="alert" style="width:60%;">投稿が完了しました。</div>-->
    　<?php }else { ?>
      <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
<?php
    }
    }
$mysqli->close();
?>

<!DOCTYPE html>
<html ="ja">
    <head>
        <meta "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> 記事投稿</title>
        <!--// Bootstrap読み込み（スタイリングのため） -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<style>
.box_regist{
	width: 100%;
	height: 50px;
}
</style>

<!-- ナビゲーションバー設定 -->
<?php include_once(dirname(__FILE__).' /./form/nav.html');?>

<?php if( $page_flag === 1 ): ?>

<div class="col-md-8 col-md-offset-2" style="margin-top:30px";>
<div class="box_regist"></div>
    <div class="panel panel-default">
	<div class="panel-heading">
		<h5 class="panel-title">投稿内容確認</h5>
    </div>
    <div class="panel-body">
        <form action="" method="post">
        <div class="form-group">
        <label>タイトル</label><br>
            <p><?php echo $_POST['title']; ?></p>
        </div>
        <hr>
        <div class="form-group">
        <label>カテゴリー</label><br>
            <p><?php if( $_POST['form'] === "1" ){ echo '開発'; }
            elseif( $_POST['form'] === "2" ){ echo '組織・チーム'; }
            elseif( $_POST['form'] === "3" ){ echo 'インフラ'; }
            elseif( $_POST['form'] === "4" ){ echo '最新情報'; }
            ?></p>
        </div>
        <hr>
        <div class="form-group">
        <label>投稿者</label><br>
            <p><?php echo $_POST['name']; ?></p>
        </div>
        <hr>
        <div class="form-group">
        <label>本文</label><br>
            <p><?php echo nl2br($_POST['body']); ?></p>
        </div>
        <hr>
        <input type="submit" name="btn_back" value="修正する">
        <input type="submit" class="btn btn-primary" name="action" value="投稿する">
        <input type="hidden" name="title" value="<?php echo $_POST['title'] ?>">
        <input type="hidden" name="form" value="<?php echo $_POST['form'] ?>">
        <input type="hidden" name="name" value="<?php echo $_POST['name'] ?>">
        <input type="hidden" name="body" value="<?php echo $_POST['body'] ?>">
        </form>
    </div>
    </div>
</div>

<?php elseif( $page_flag === 2 ): ?>
 <?php require_once('post_complete.php'); ?>

<?php else: ?>

<div class="col-md-8 col-md-offset-2" style="margin-top:30px";>
<div class="box_regist"></div>
    <div class="panel panel-default">
	<div class="panel-heading">
		<h5 class="panel-title">記事投稿</h5>
	</div>
	<div class="panel-body">
<!--バリデーションのエラー表示 -->
<?php if(!empty($error)): ?>
    <ul class="alert alert-danger" style="padding: 10px 30px";>
    <?php foreach($error as $value): ?>
            <li><?php echo $value; ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
            <form action="" method="post">
            <div class="form-group">
            <div class="row">
                <div class="col-sm-2">タイトル</div><br>
                <div class="col-sm-2 form-inline">
					<input type="text" class="form-control" name="title" value="<?php if( !empty($_POST['title']) ){ echo $_POST['title']; } ?>" placeholder="タイトルを入力してください" size="80">
                </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
                <div class="col-sm-2">カテゴリー</div><br>
                <div class="col-sm-2 form-inline">
                    <select class="form-control" name="form" >
						<option value="" disabled selected style='display:none;'>選択してください</option>
                        <option value="1" <?php if( !empty($_POST['form']) && $_POST['form'] === "1" ){ echo 'selected'; } ?>>開発</option>
                        <option value="2" <?php if( !empty($_POST['form']) && $_POST['form'] === "2" ){ echo 'selected'; } ?>>組織・チーム</option>
                        <option value="3" <?php if( !empty($_POST['form']) && $_POST['form'] === "3" ){ echo 'selected'; } ?>>インフラ</option>
                        <option value="4" <?php if( !empty($_POST['form']) && $_POST['form'] === "4" ){ echo 'selected'; } ?>>最新情報</option>
                    </select>
            </div>
            </div><br>
            <div class="form-group">
            <div class="row">
                <div class="col-sm-2">投稿者</div><br>
                <div class="col-sm-2 form-inline">
					<input type="text" class="form-control" name="name" value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>" placeholder="投稿者を入力してください" size="40">
                </div>
            </div>
            </div>
            <div class="form-group">
                本文<br>
                <textarea class="form-control" name="body" placeholder="本文を入力してください" rows="10"><?php if( !empty($_POST['body']) ){ echo $_POST['body']; } ?></textarea><br>
            </div>
            <input type="submit" class="btn btn-primary" name="confirm" value="入力内容を確認する">
        </div>
        </form>
    </div>
    </div>
</div>
<?php endif; ?>
    </body>
</html>
