<?php require_once __DIR__ . '/../../functions.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>掲示板</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="<?= dirname(get_base_url()) ?>/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/the-new-css-reset/css/reset.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Dela+Gothic+One&family=DotGothic16&family=Kaisei+Decol&family=Kaisei+Opti&family=Lora:ital,wght@0,400..700;1,400..700&family=Moirai+One&family=Permanent+Marker&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&family=Zen+Kurenaido&family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body>
  <div class="inner">
    <h1 class="h1"><img src="./image/h1.svg" alt="推しのベストショット"></h1>
    <?php if (!empty($errors)): ?>
      <ul style="color:red;">
        <?php foreach ($errors as $error): ?>
          <li><?= str2html($error) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
  <?php include __DIR__ . '/index.php'; ?>
</body>

</html>