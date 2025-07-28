<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  if ($name !== '') {
    $_SESSION['name'] = $name;
    header('Location: public/index.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>推し名登録</title>
</head>

<body>
  <h1>あなたの推し名を教えてね</h1>
  <form method="post">
    <label>推し名：</label>
    <input type="text" name="name" required>
    <button type="submit">決定！</button>
  </form>
</body>

</html>