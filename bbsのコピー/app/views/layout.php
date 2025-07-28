<?php require_once __DIR__ . '/../../functions.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>掲示板</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="<?= dirname(get_base_url()) ?>/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css"> -->
</head>

<body>
  <div class="inner">
    <h1>最高の一枚</h1>
    <?php if (!empty($errors)): ?>
      <ul style="color:red;">
        <?php foreach ($errors as $error): ?>
          <li><?= str2html($error) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <?php include __DIR__ . '/index.php'; ?>
  </div>
</body>

</html>