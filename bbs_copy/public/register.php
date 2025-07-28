<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $oshi_name = trim($_POST['oshi_name'] ?? '');

  if ($oshi_name !== '') {
    $_SESSION['oshi_name'] = $oshi_name;
    header('Location: index.php');
    exit;
  }
}

require_once __DIR__ . '/../app/views/register.php';
