<?php
$users = [
  ['name' => 'Ken', 'age' => 20, 'score' => 85],
  ['name' => 'Yui', 'age' => 22, 'score' => 78],
  ['name' => 'Taro', 'age' => 19, 'score' => 55]
];
?>

<?php foreach ($users as $user): ?>
  <?php
  $name = $user['name'];
  $age = $user['age'];
  $score = $user['score'];

  if ($score >= 80) {
    $result = "優";
  } elseif ($score >= 60) {
    $result = "良";
  } else {
    $result = "可";
  };
  ?>
  <p>
    名前:<?php echo $name; ?> 年齢 <?php echo $age; ?> 歳 , スコア: <?php echo $score; ?> , 判定:<?php echo $result; ?>
  </p>
<?php endforeach; ?>