<?php
# connect1.php
require_once './functions.php';
try {
  $dbh = db_open();
  // var_dump($dbh);
  $sql = 'SELECT title , author FROM books';
  $statement = $dbh->query($sql);
  while ($row = $statement->fetch()) {
    echo "書籍名:" . str2html($row[0]) . '<br>';
    echo "著者名:" . str2html($row[1]) . '<br>';
  }
} catch (PDOException $e) {
  echo " 接続失敗;" . str2html($e->getMessage()) . '<br>';
  exit;
}
