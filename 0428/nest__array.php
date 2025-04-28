<?php
$people[] = [
  'name' => '佐藤',
  'blood' => 'A'
];
$people[] = [
  'name' => '田中',
  'blood' => 'B'
];
$people[] = [
  'name' => '加藤',
  'blood' => 'O'
];

var_dump($people);

echo "<br>";

echo $people[0]['blood'] . "<br>";
echo $people[2]['name'] . "<br>";
foreach ($people as $people_key => $person) {
  echo '順番は' . $people_key . "<br>";
  foreach ($person as $person => $value) {
    echo 'キーは' . $person . '、値は' . $value . "<br>";
  }
}

#二次元配列を作ってください
$characters = [
  [
    'name' => 'ハローキティ',
    'age' => 40,
    'blood' => 'A'
  ],
  [
    'name' => 'マイメロディ',
    'age' => 20,
    'blood' => 'B'
  ],
  [
    'name' => 'シナモロール',
    'age' => 15,
    'blood' => 'O'
  ],
];

foreach ($characters as $character) {
  foreach ($character as $value) {
    echo '値は' . $value . "<br>";
  }
};
