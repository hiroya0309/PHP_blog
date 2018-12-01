<?php
$query = "SELECT * FROM posts GROUP BY form" ;
$result = $mysqli->query($query);
if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}
?>
  <div class="box-side">
    <h4>カテゴリー</h4><hr>
    <ul>
    <?php while($row = $result->fetch_assoc()) { ?>
      <p><a href="category.php?form=<?php echo $row['form']; ?>">
                                    <?php if( $row['form'] === "1" ){ echo '開発'; }
                                          elseif( $row['form'] === "2" ){ echo '組織・チーム'; }
                                          elseif( $row['form'] === "3" ){ echo 'インフラ'; }
                                          elseif( $row['form'] === "4" ){ echo '最新情報'; }?></a>
      </p>
    <?php } ?>
    </ul>
  </div>