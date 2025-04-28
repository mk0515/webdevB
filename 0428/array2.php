<?php
$name = [
  'sato' => '佐藤',
  'suzuki' => '鈴木',
  'takahashi' => '高橋'
];

echo $name['takahashi'];

echo "<br>";

foreach ($name as $value) {
  echo  $value . "<br>";
}

foreach ($name as $key => $value) {
  echo 'キーは' . $key . '、名前は' . $value . "<br>";
}
