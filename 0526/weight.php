<?php
require_once 'function.php';

$height = (float) $_POST['height'];
$weight = (float)$_POST['weight'];
$goal_weight = $height * $height * 22;
$difference = abs($goal_weight - $weight);

if ((($height <= 0) || (3 <= $height))) {
  echo "正しい身長を入力してください";
  exit;
}
if ((($weight < 0) || (200 < $weight))) {
  echo "正しい体重を入力してください";
  exit;
};

echo "体重" . str2html($weight) . "kg<br>";
echo "理想" . str2html($goal_weight) . "kg<br>";
echo "後" . str2html($difference) . "kgで適正体重です";
