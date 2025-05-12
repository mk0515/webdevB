<?php
//関数は定義しただけでは実行されないため、実行を定義する必要有
//価格をパラメーターに入力したら、税込価格を表示(echo)する関数
function tax($price)
{
  echo $price * 1.1;
}
//関数の実行
//関数名に()をつけて、中にパラメーターの値を入れる
tax(100);

//戻り値、返り値がある関数
function tax2(int $price)
{
  return $price * 1.1;
}

echo "<br>";

tax2(100);
$sample_price = tax2("文字");

echo '消費税込み値段：' . $sample_price . '円';
