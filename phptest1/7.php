<?php
$users = [
  ['name' => 'Ken', 'age' => 20, 'score' => 85],
  ['name' => 'Yui', 'age' => 22, 'score' => 78],
  ['name' => 'Taro', 'age' => 19, 'score' => 55]
];

foreach ($users as $user) {
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

  echo "名前:" . $name . "年齢" . $age . "歳," . "スコア:" . $score . "," . "判定:" . $result . "<br>";
};
