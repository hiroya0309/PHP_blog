<?php
$last_date = date('t', strtotime('2018-08-01'));

$year  = date('Y');
$month = date('m');
$thisYear=$year;
if(isset($_POST["year"])) $year=$_POST["year"];
if(isset($_POST["month"])) $month=$_POST["month"];
$dt = new DateTime('first day of this month');
$optionYear="";
for ($i=($thisYear-10); $i<=($thisYear+10); $i++) {
  $selected=($i==$year)?" selected":"";
  $optionYear .= "<option value=\"{$i}\"{$selected}>{$i}</option>\n";
}
$optionMonth="";
for($i=1;$i<=12; $i++) {
  $selected=($i==$month)?" selected":"";
  $optionMonth .= "<option value=\"{$i}\"{$selected}>{$i}</option>\n";
}
$weekday = array('日','月','火','水','木','金','土');
$year = $dt->format('Y');
$month = $dt->format('m');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>勤怠表</title>
        <!-- Bootstrap読み込み（スタイリングのため） -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="list.css">
        <!-- モーダル実装 -->
        <script>
            function on() {
                document.getElementById("overlay").style.display = "block";
            }

            function off() {
                document.getElementById("overlay").style.display = "none";
            }
        </script>
    </head>

    <nav class="navbar navbar-default">
            <div class="container">
              <div class="navbar-header">
                <a href="#.php" class="navbar-brand">システム名</a>
              </div>
              <div id="navbar" class="navbar-right">
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="admin_login.html">ログイン</a></li>
                </ul>
              </div>
            </div>
    </nav>
    <body>
      <div class="col-md-4 col-sm-offset-1">
          <h2>〇〇 〇〇さん勤怠表</h2>
          <hr>
            <form class="form-inline" method="post">
              <select class="form-control" name="year"><?php echo $optionYear; ?></select>年
              <select class="form-control" name="month"><?php echo $optionMonth; ?></select>月
              <input type="submit" class="btn btn-success" name="btn" value="表示" style="margin-right:100px;">
              <input type="submit" class="btn btn-primary" name="btn" value="CSV出力">
            </form>
         
          <hr>
          <table id="attendance2">
                    <thead>
                        <th>稼働月</th>
                        <th>稼働時間</th>
                        <th>残業時間</th>
                        <th>勤務日数</th>
                    </thead>
                    <tbody>
                        <td>8月</td>
                        <td>180時間</td>
                        <td>45時間</td>
                        <td>20日</td>
                    </tbody>
            </table>
            <br>
        </div>

        <div class="col-sm-offset-1 col-sm-10">
            <table id="attendance">
                <thead>
                <tr>
                    <th>日付</th>
                    <th class="time" style="width: 25em;">出退勤時間</th>
                    <th>実働時間</th>
                    <th>時間外</th>
                    <th class="remarks" style="width: 22em;">備考</th>
                    <th></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td></td>
                    <th>合 計</th>
                    <td>160:00</td>
                    <td>45:00</td>
                    <td></td>
                    <td></td>
                </tr>
                </tfoot>
                <?php for($i=1; $i<=$last_date; $i++) { ?>
                <tbody>
                    <td><?= $i ?>日(日)</td>
                    <td><a href="list_edit.html">0:00</a> - <a href="list_edit.html">12:00</a>&nbsp;&nbsp;<a href="list_edit.html">14:00</a> - <a href="list_edit.html">24:00</a></td>
                    <td>9:00</td>
                    <td>1:00</td>
                    <td>備考</td>
                    <td><a href="list_edit.html" class="btn btn-warning btn-sm" role="button">新規追加</a></td>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </body>
</html>


