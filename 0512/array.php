<?php
$data = [
  [
    "rank" => 1,
    "name" => "山本",
    "team" => "ドジャース",
    "era" => 1.80
  ],
  [
    "rank" => 2,
    "name" => "ルサルド",
    "team" => "フィリーズ",
    "era" => 2.11
  ],
  [
    "rank" => 3,
    "name" => "ペラルタ",
    "team" => "ブリュワーズ",
    "era" => 2.18
  ],
  [
    "rank" => 4,
    "name" => "キング",
    "team" => "パドレス",
    "era" => 2.22
  ],
  [
    "rank" => 5,
    "name" => "キャニング",
    "team" => "メッツ",
    "era" => 2.357
  ]
];

//$date内の要素の数だけループ
//asの後の$playerは、$dateの要素を一つずつ取り出すための取り出すためのもの
//配列が来たらforeachで回す
foreach ($data as $player) {
  echo $player["name"] . "<br>";
}

foreach ($data as $player) {
  if ($player["era"] <= 2.2) {
    echo $player["name"] . "（ERA: " . $player["era"] . "）<br>";
  }
}

$characters = [
  [
    "name" => "ハローキティ",
    "birthday" => "11月1日",
    "favorite" => "アップルパイ"
  ],
  [
    "name" => "マイメロディ",
    "birthday" => "1月18日",
    "favorite" => "アーモンドパウンドケーキ"
  ],
  [
    "name" => "シナモロール",
    "birthday" => "3月6日",
    "favorite" => "シナモンロール"
  ],
  [
    "name" => "ポムポムプリン",
    "birthday" => "4月16日",
    "favorite" => "プリン"
  ],
  [
    "name" => "クロミ",
    "birthday" => "10月31日",
    "favorite" => "ピンクのどくキノコ"
  ]
];

foreach ($characters as $character) {
  echo $character["name"] . "<br>";
}

foreach ($characters as $character) {
  echo $character["birthday"] . "<br>";
}

foreach ($characters as $character) {
  echo $character["favorite"] . "<br>";
}
