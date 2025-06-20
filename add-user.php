<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    if ($username !== '') {
        echo "Otrzymano użytkownika: " . htmlspecialchars($username);
    }
}
?>
