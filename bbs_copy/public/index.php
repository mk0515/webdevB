<?php
session_start();
require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/models/post.php';
require_once __DIR__ . '/../app/controllers/postcontroller.php';

// 推し名が未登録なら register.php へ
if (!isset($_SESSION['oshi_name'])) {
  header('Location: register.php');
  exit;
}

require_once __DIR__ . '/../app/controllers/PostController.php';

use App\Controllers\PostController;

$controller = new PostController();
$controller->handleRequest();
