<?php
require_once('function.php');

// データを読み込むだけ
$fp = fopen('bookdata.csv', 'r');
// ファイルが開けたか確認
if ($fp === false) {
  echo 'ファイルのオープンに失敗しました';
  exit;
};

while ($row = fgetcsv($fp)) {
  echo '<ul>';
  echo '<li>' . "書籍名："  . str2html($row[0]) . '</li>';
  echo '<li>' . "著者名："  . str2html($row[4]) . '</li>';
  echo '</ul>';
}
