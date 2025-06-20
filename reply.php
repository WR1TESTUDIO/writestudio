<?php
$data = json_decode(file_get_contents("php://input"), true);
$user = $data['user'] ?? '';
$message = $data['message'] ?? '';
$admin = $data['admin'] ?? '';

if ($user && $message && $admin) {
  $filename = __DIR__ . "/chat-data/" . $user . ".txt";
  $line = "[$admin] $message\n";
  file_put_contents($filename, $line, FILE_APPEND);
}
?>
