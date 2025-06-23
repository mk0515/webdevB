<?php
// 関数を定義
function str2html(string $string): string
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
};

// 関数を実行
// 関数名()で実行

function db_open()
{
  $user = 'phpuser';
  $password = 'php0602_bb07'; // 任意のパスワード
  $opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
  ];
  $dbh = new PDO('mysql:host=localhost;dbname=sample_db;charset=utf8', $user, $password, $opt);
  return $dbh;
}
