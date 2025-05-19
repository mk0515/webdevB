<?php
function str2html(string $string): string
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
};

// 入力された検索キーワードを取り出す
$word = $_GET['song'];

// 空だったらエラーを表示して終わる
if ($word === '') {
  echo '検索ワードを入力してください。';
  exit;
}

// CSVファイルを開く
$file = fopen('songs.csv', 'r');

// 見つからなかったとき用に空の結果を用意しておく
$found = [];

// 1行ずつCSVを読み込む
while ($row = fgetcsv($file)) {
  // 大文字・小文字を区別しないように小文字に変換して比較
  $word_lower = mb_strtolower($word);

  // 曲名と一致していたら結果に追加
  if ($word_lower === $row[0]) {
    $found[] = $row;
  }

  // アーティスト名と一致していたら結果に追加
  if ($word_lower === $row[1]) {
    $found[] = $row;
  }
}

// ファイルを閉じる
fclose($file);

// 見つかった結果を表示する
if (count($found) === 0) {
  echo '該当する曲が見つかりませんでした。';
} else {
  foreach ($found as $song) {
    echo '<hr>';
    echo '曲名: ' . str2html($song[0]) . '<br>';
    echo 'アーティスト: ' . str2html($song[1]) . '<br>';
    echo 'ジャンル: ' . str2html($song[2]) . '<br>';
    echo 'リリース年: ' . str2html($song[3]) . '<br>';
    echo '備考: ' . str2html($song[4]) . '<br>';
  }
}
