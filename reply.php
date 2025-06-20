<?php
$data = json_decode(file_get_contents('php://input'), true);

$userId = basename($data['userId']);
$message = trim($data['message']);
$admin = htmlspecialchars($data['admin']);

if ($userId && $message && $admin) {
    $file = "chat-data/$userId.txt";
    $line = "[WR1TE - $admin] $message\n";
    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    echo json_encode(["status" => "success"]);
} else {
    http_response_code(400);
    echo json_encode(["error" => "Nieprawidłowe dane"]);
}
?>
