<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <p>①次のif-elseif-else構文を代替構文にしてください。</p>
  <?php $num = 2; ?>
  <?php if ($num === 1): ?>
    <? echo "一です"; ?>
  <?php elseif ($num === 2): ?>
    <? echo "二です"; ?>
  <?php endif; ?>
  <? echo "それ以外です"; ?>

  <p>②以下のコードを代替構文に書き換えてください。</p>
  <?php $isMember = true; ?>
  <?php if ($isMember) ?>
  <?php echo "会員様向けの情報です。"; ?>

  <p>③HTMLのul要素の中で、for文を使ってli要素を5個出力するコードを代替構文で書いてください。<br>
    例：
  </p>
  <ul>
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <li><?= $i ?></li>
    <?php endfor; ?>
  </ul>
  <p>④以下のfor文を代替構文に書き換えてください。</p>
  <?php for ($i = 1; $i <= 3; $i++): ?>
    <p>番号: <?= $i ?></p>
  <?php endfor; ?>
  <p>⑥以下のコードを代替構文に書き換えてください。</p>
  <?php
  $users = ['太郎', '花子', '次郎'];
  ?>
  <?php foreach ($users as $user): ?>
    <?= $user . "さん、ようこそ！" ?>
  <?php endforeach; ?>
</body>

</html>