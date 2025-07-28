<?php

namespace App\Models;

class Post
{
  public static function getAll($pdo)
  {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public static function insert($pdo, $name, $comment)
  {
    $stmt = $pdo->prepare("INSERT INTO posts (name, comment) VALUES (:name, :comment)");
    $stmt->execute([
      ':name' => $name,
      ':comment' => $comment
    ]);
  }
}
