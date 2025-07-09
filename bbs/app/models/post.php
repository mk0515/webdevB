<?php

function get_all_posts($pdo)
{
  $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insert_post($pdo, $name, $comment)
{
  $stmt = $pdo->prepare("INSERT INTO posts (name, comment) VALUES (:name, :comment)");
  $stmt->execute([
    ':name' => $name,
    ':comment' => $comment
  ]);
}
