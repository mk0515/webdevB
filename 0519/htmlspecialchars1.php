<?php
//htmlspecialchars1.php
echo "<s>test</s><br>";
echo htmlspecialchars("<s>test</s><br>", ENT_QUOTES, 'UTF-8');
