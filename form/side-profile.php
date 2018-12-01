<?php
// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE id=".$_SESSION['user']."";
$result = $mysqli->query($query);

if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}
//ユーザー情報の取り出し
while($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $email = $row['email'];
}
?>

<div class="box-side">
  <h4>プロフィール</h4><hr>
          <p><label><?php echo htmlspecialchars($username,ENT_QUOTES,'UTF-8'); ?></label>でログインしています。</p>
          <p>メールアドレス：<?php echo $email; ?></p>
          <input type="submit" name="btn_back" value="ログアウト" onClick="location.href='logout.php?logout'">
</div>
