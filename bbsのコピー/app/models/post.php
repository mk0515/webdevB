<?php

function get_all_posts($pdo)
{
  $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insert_post($pdo, $name, $comment, $image_path = null)
{
  $stmt = $pdo->prepare("INSERT INTO posts (name, comment, image_path) VALUES (:name, :comment, :image_path)");
  $stmt->execute([
    ':name' => $name,
    ':comment' => $comment,
    ':image_path' => $image_path
  ]);
}

function delete_post(PDO $pdo, int $id): void
{
  // 画像パスを取得
  $stmt = $pdo->prepare("SELECT image_path FROM posts WHERE id = :id");
  $stmt->execute([':id' => $id]);
  $post = $stmt->fetch(PDO::FETCH_ASSOC);

  // 画像ファイルを削除
  if (!empty($post['image_path'])) {
    $image_file = __DIR__ . '/../../storage/images/' . $post['image_path'];
    if (file_exists($image_file)) {
      unlink($image_file);
    }
  }

  // 投稿を削除
  $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
  $stmt->execute([':id' => $id]);
}

// いいね
function add_like(PDO $pdo, int $id): void
{
  $stmt = $pdo->prepare("UPDATE posts SET likes = likes + 1 WHERE id = :id");
  $stmt->execute([':id' => $id]);
}

// スター
function add_star(PDO $pdo, int $id): void
{
  $stmt = $pdo->prepare("UPDATE posts SET star = star + 1 WHERE id = :id");
  $stmt->execute([':id' => $id]);
}

// 尊い
function add_precious(PDO $pdo, int $id): void
{
  $stmt = $pdo->prepare("UPDATE posts SET precious = precious + 1 WHERE id = :id");
  $stmt->execute([':id' => $id]);
}
