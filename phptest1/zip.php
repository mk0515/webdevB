<?php
$zip1 = $_POST['zip1'];
$zip2 = $_POST['zip2'];

$zipcode = $zip1 . '-' . $zip2;

if (preg_match('/^\d{3}-\d{4}$/', $zipcode)) {
  echo "正しい郵便番号です：{$zipcode}";
} else {
  echo "郵便番号の形式が正しくありません。例：123-4567 のように入力してください。";
}
