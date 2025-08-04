<?php
session_start();
require_once __DIR__ . '/functions.php';

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
  <title>名前を登録</title>
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Dela+Gothic+One&family=DotGothic16&family=Kaisei+Decol&family=Kaisei+Opti&family=Lora:ital,wght@0,400..700;1,400..700&family=Moirai+One&family=Permanent+Marker&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&family=Zen+Kurenaido&family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="login">
  <h1 class="h1-2 inner"><img src="public/image/h1-2.svg" alt="名前を登録してね"></h1>
  <div class="login_bg">
    <div class="inner">
      <form method="post" class="login_name">
        <input type="text" name="name" required>
        <button type="submit">登録</button>
      </form>
    </div>
  </div>
</body>

</html>