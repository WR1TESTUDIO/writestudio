<?php
// Odbierz dane JSON z żądania
$data = json_decode(file_get_contents("php://input"), true);

// Sprawdź czy dane są poprawne
if (!isset($data['user']) || !isset($data['message'])) {
    http_response_code(400);
    echo "Błąd: brak danych.";
    exit;
}

$userFile = basename($data['user']); // zabezpieczenie przed ../
$message = trim($data['message']);
$line = "WR1TE: $message\n";

// Ścieżka do pliku użytkownika
$filePath = __DIR__ . "/chat-data/$userFile";

// Dopisz wiadomość do pliku
file_put_contents($filePath, $line, FILE_APPEND | LOCK_EX);

echo "Wysłano.";
