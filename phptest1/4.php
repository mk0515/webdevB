<?php
$score = rand(0, 100);
echo "スコア: " . $score;
echo "<br>";
if ($score >= 80) {
  echo "優";
} elseif ($score >= 60) {
  echo "良";
} else {
  echo "可";
};
