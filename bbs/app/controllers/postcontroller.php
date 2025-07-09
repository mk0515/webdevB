<?php
session_start();

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/post.php';
require_once __DIR__ . '/../../functions.php';

// DB接続
$pdo = new PDO($config['dsn'], $config['user'], $config['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// バリデーション関数
function validate_post(string $name, string $comment): array
{
  $errors = [];
  if ($name === '') {
    $errors[] = '名前を入力してください。';
  }
  if ($comment === '') {
    $errors[] = 'コメントを入力してください。';
  }
  return $errors;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_SESSION['oshi_name'] ?? '';
  $comment = trim($_POST['comment'] ?? '');

  $errors = validate_post($name, $comment);

  if (empty($errors)) {
    insert_post($pdo, $name, $comment);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }
}

$posts = get_all_posts($pdo);
require __DIR__ . '/../views/layout.php';
