<?php
// add-user.php

header('Content-Type: application/json');

// Akceptujemy tylko metodę POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Nieprawidłowa metoda.']);
    exit;
}

// Sprawdź, czy pole 'username' istnieje
if (!isset($_POST['username']) || empty(trim($_POST['username']))) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Brakuje nazwy użytkownika.']);
    exit;
}

$username = htmlspecialchars(trim($_POST['username']));
$userId = uniqid();

// Ścieżka do pliku JSON
$filePath = 'users.json';

// Wczytaj obecnych użytkowników (jeśli plik istnieje)
$users = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];

// Dodaj nowego użytkownika
$users[] = [
    'id' => $userId,
    'name' => $username,
];

// Zapisz dane do pliku
file_put_contents($filePath, json_encode($users, JSON_PRETTY_PRINT));

// Przekieruj do lobby z ID użytkownika
header("Location: lobby.html?userId=$userId");
exit;
?>
