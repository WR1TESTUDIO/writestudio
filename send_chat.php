<?php
header('Content-Type: application/json');

// Akceptujemy tylko metodę POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Metoda niedozwolona
    echo json_encode(['error' => 'Metoda niedozwolona']);
    exit;
}

// Pobieramy surowe dane JSON
$rawData = file_get_contents('php://input');
$data = json_decode($rawData, true);

// Sprawdzamy, czy dane są poprawne
if (!is_array($data) || empty($data['message']) || empty($data['category'])) {
    http_response_code(400); // Błędne żądanie
    echo json_encode(['error' => 'Brak wymaganych danych']);
    exit;
}

// Sanitizacja wejścia
$message = htmlspecialchars(trim($data['message']));
$category = htmlspecialchars(trim($data['category']));

// Przygotowujemy wpis do zapisu
$entry = [
    'type' => 'chat',
    'message' => $message,
    'category' => $category,
    'date' => date('Y-m-d H:i:s')
];

$file = 'messages.json';

// Odczyt istniejących wiadomości (jeśli plik jest)
$messages = [];
if (file_exists($file)) {
    $json = file_get_contents($file);
    $messages = json_decode($json, true);
    if (!is_array($messages)) $messages = [];
}

// Dodajemy nową wiadomość
$messages[] = $entry;

// Zapisujemy do pliku JSON (zabezpieczone, pretty print, unicode)
if (file_put_contents($file, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false) {
    // Sukces
    echo json_encode(['success' => 'Wiadomość została zapisana']);
} else {
    http_response_code(500); // Błąd serwera
    echo json_encode(['error' => 'Błąd zapisu wiadomości']);
}
?>
