<?php
// 入力値を受け取る
$group = $_POST['group'];
$name = $_POST['name'];
$age = $_POST['age'];

// データベースに接続する
try {
  $user = "phpuser";
  $password = "xxxxxxxxxx";  // 実際のパスワードに変更してね
  $opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // エラー表示
    PDO::ATTR_EMULATE_PREPARES => false,         // 実行速度対策
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false    // セキュリティ対策
  ];
  $dbh = new PDO('mysql:host=localhost;dbname=sample_db;charset=utf8', $user, $password, $opt);

  // SQL文を用意（プレースホルダで安全に）
  $sql = "INSERT INTO members (affiliation, name, age) VALUES (:group, :name, :age)";
  $stmt = $dbh->prepare($sql);

  // 値をバインドして実行
  $stmt->bindValue(':group', $group, PDO::PARAM_STR);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':age', $age, PDO::PARAM_INT);
  $stmt->execute();

  // 完了メッセージと元のページへ戻るリンク
  echo "<p>登録が完了しました！</p>";
  echo '<p><a href="index.php">戻る</a></p>';  // ファイル名が index.php などなら変更してね
} catch (PDOException $e) {
  echo "登録に失敗しました: " . $e->getMessage();
  exit;
}
