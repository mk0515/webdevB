<?php
function str2html(string $string): string
{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
function get_base_url(): string
{
  $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
  $host = $_SERVER['HTTP_HOST'];
  $script_name = dirname($_SERVER['SCRIPT_NAME']);
  return rtrim($scheme . '://' . $host . $script_name, '/');
}
