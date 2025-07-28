<?php

namespace App\Controllers;

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/post.php';
require_once __DIR__ . '/../../functions.php';

use App\Models\Post;

class PostController
{
  public function handleRequest()
  {
    global $config;

    // セッションから推し名を取得（未設定なら空）
    $name = $_SESSION['oshi_name'] ?? '';

    // 推し名が登録されていなければリダイレクト（安全策）
    if ($name === '') {
      header('Location: register.php');
      exit;
    }

    $pdo = new \PDO($config['dsn'], $config['user'], $config['pass']);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $comment = trim($_POST['comment'] ?? '');

      $errors = $this->validatePost($name, $comment);

      if (empty($errors)) {
        Post::insert($pdo, $name, $comment);
        header('Location: index.php');
        exit;
      }
    }

    $posts = Post::getAll($pdo);

    require_once __DIR__ . '/../views/layout.php';
    require_once __DIR__ . '/../views/index.php';
  }

  private function validatePost(string $name, string $comment): array
  {
    $errors = [];
    if ($name === '') {
      $errors[] = '名前がありません（セッション未設定）';
    }
    if ($comment === '') {
      $errors[] = 'コメントを入力してください。';
    }
    return $errors;
  }
}
