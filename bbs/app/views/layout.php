<?php require_once __DIR__ . '/../../functions.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>掲示板</title>
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <h1>掲示板</h1>

  <?php if (!empty($errors)): ?>
    <ul style="color:red;">
      <?php foreach ($errors as $error): ?>
        <li><?= str2html($error) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <?php include __DIR__ . '/index.php'; ?>
</body>

</html>