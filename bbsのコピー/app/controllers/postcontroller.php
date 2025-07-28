<?php
session_start();

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/post.php';
require_once __DIR__ . '/../../functions.php';

// セッションに名前がなければ登録画面へ
if (empty($_SESSION['name'])) {
  header('Location: ' . dirname(get_base_url()) . '/user_register.php');
  exit;
}

$pdo = new PDO($config['dsn'], $config['user'], $config['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function validate_post(array $file): array
{
  $errors = [];
  if (empty($file['image']['name'])) {
    $errors[] = '写真を選択してください。';
  }
  return $errors;
}

$errors = [];

// いいね処理
if (isset($_GET['like_id'])) {
  $like_id = (int)$_GET['like_id'];
  add_like($pdo, $like_id);
  header('Location: ' . $_SERVER['PHP_SELF'] . '#post-' . $like_id); // アンカーで戻れるように
  exit;
}

// スター処理
if (isset($_GET['star_id'])) {
  $star_id = (int)$_GET['star_id'];
  add_star($pdo, $star_id);
  header('Location: ' . $_SERVER['PHP_SELF'] . '#post-' . $star_id);
  exit;
}

// 尊い処理
if (isset($_GET['precious_id'])) {
  $precious_id = (int)$_GET['precious_id'];
  add_precious($pdo, $precious_id);
  header('Location: ' . $_SERVER['PHP_SELF'] . '#post-' . $precious_id);
  exit;
}

// 投稿削除処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
  $delete_id = (int)$_POST['delete_id'];
  delete_post($pdo, $delete_id);
  // 投稿一覧の位置に戻るためアンカー付きでリダイレクト
  header('Location: ' . $_SERVER['PHP_SELF'] . '#posts');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['delete_id'])) {
  $comment = trim($_POST['comment'] ?? '');
  $errors = validate_post($_FILES);

  $image_path = null;

  if (!empty($_FILES['image']['name'])) {
    $upload_dir = __DIR__ . '/../../storage/images/';
    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0777, true);
    }

    $original_name = basename($_FILES['image']['name']);
    $ext = pathinfo($original_name, PATHINFO_EXTENSION);
    $uniq_name = uniqid('', true) . '.' . $ext;
    $target_path = $upload_dir . $uniq_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
      $image_path = $uniq_name;
    } else {
      $errors[] = '画像のアップロードに失敗しました。';
    }
  }

  if (empty($errors)) {
    insert_post($pdo, $_SESSION['name'], $comment, $image_path);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
  }
}

$posts = get_all_posts($pdo);
$oshi_name = $_SESSION['name'];

require __DIR__ . '/../views/layout.php';
