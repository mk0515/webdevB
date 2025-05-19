<?php
//htmlspecialchars2.php
// HTMLエンティティされた文章を表示する
echo htmlspecialchars($_POST['a'], ENT_QUOTES, 'UTF-8');
