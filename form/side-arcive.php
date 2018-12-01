
<?php
$query = "SELECT DATE_FORMAT(create_at, '%Y-%m') as createtime,COUNT(*) as count 
          FROM posts GROUP BY DATE_FORMAT(create_at, '%Y-%m') 
          ORDER BY create_at DESC";
$result = $mysqli->query($query);
if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
}
?>
<div class="box-side">
    <h4>アーカイブ</h4><hr>
    <ul>
    <?php while($row = $result->fetch_assoc()) { ?>
      <p><a href="arcive.php?create_at=<?php echo date("Y-m",strtotime($row['createtime'])); ?>">
          <?php echo date("Y-m",strtotime($row['createtime'])); ?>(<?php echo $row['count']; ?>)</p></li>
    <?php } ?>
    </ul>
</div>

