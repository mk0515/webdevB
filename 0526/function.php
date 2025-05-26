<?php
// 関数を定義
function str2html(string $string): string
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
};

// 関数を実行
// 関数名()で実行