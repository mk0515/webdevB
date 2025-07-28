<?php
session_start();
session_destroy();

// セッションが完全に消えたら、登録画面へリダイレクト
header('Location: user_register.php');
exit;
