<?php
session_start();
require_once __DIR__ . '/inc/functions.php';

if (!empty($_SESSION['login'])) {
  header('Location: index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $error = "ユーザー名、パスワードを入力してください。";
  } else {
    try {
      $dbh = db_open();
      $sql = 'SELECT password FROM users WHERE username = :username';
      $stmt = $dbh->prepare($sql);
      $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$result || !password_verify($_POST['password'], $result['password'])) {
        $error = "ログインに失敗しました。";
      } else {
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        header("Location: index.php");
        exit;
      }
    } catch (PDOException $e) {
      $error = "エラー: " . str2html($e->getMessage());
    }
  }
}

include __DIR__ . '/inc/header.php';
?>

<?php if (!empty($error)) : ?>
  <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<form method="POST" action="login.php">
  <p>
    <label for="username">ユーザー名:</label>
    <input type="text" name="username" required>
  </p>
  <p>
    <label for="password">パスワード:</label>
    <input type="password" name="password" required>
  </p>
  <input type="submit" value="送信する">
</form>

<?php include __DIR__ . '/inc/footer.php'; ?>