<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録フォーム</title>
  <style>
    body {
      margin: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <h1>登録フォーム</h1>
  <form action="./add.php" method="post">
    <label for="group">所属グループ：
      <input type="text" id="group" name="group" required>
    </label>
    <label for="name">名前：
      <input type="text" id="name" name="name" required>
    </label>
    <label for="age">年齢：
      <input type="text" id="age" name="age" required>
    </label>
    <button type="submit">登録</button>
  </form>
  <h2>登録内容</h2>
  <?php
  require_once __DIR__ . '/functions.php';
  try {
    $user = "phpuser";
    $password = "php0602_bb07";  //任意のパスワード
    $opt = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ];
    $dbh = new PDO('mysql:host=localhost;dbname=sample_db;charset=utf8', $user, $password, $opt);
    $sql = "SELECT * FROM members";
    $statment = $dbh->query($sql);
  ?>
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
        <th>所属グループ</th>
        <th>名前</th>
        <th>年齢</th>
      </tr>
      <?php
      while ($row = $statment->fetch()) {
        $group = str2html($row['affiliation']);
        $name = str2html($row['name']);
        $age = str2html($row['age']);
        echo "<tr>";
        echo "<td>" . $group . "</td>";
        echo "<td>" . $name . "</td>";
        echo "<td>" . $age . "</td>";
        echo "</tr>";
      }
      ?>
    </table>
  <?php
  } catch (PDOException $e) {
    echo "接続に失敗しました: " . $e->getMessage() . "<br>";
    exit;
  }
  ?>
</body>

</html>