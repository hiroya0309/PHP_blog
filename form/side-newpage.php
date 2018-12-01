<?php
$query = "SELECT * FROM posts ORDER BY id DESC LIMIT 10";
$result = $mysqli->query($query);
if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}
?>
  <div class="box-side">
    <h4>最新記事</h4><hr>
      <ul>
  <?php while($row = $result->fetch_assoc()) { ?>
        <li><a href="page.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></li>
  <?php } ?>
      </ul>
  </div>
