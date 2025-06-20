<?php
// Sprawdź, czy formularz został wysłany metodą POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz i zabezpiecz dane
    $username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';

    if (!empty($username)) {
        // Przykładowa akcja: zapis do pliku (można zmienić na bazę danych)
        $filename = 'users.txt';
        $entry = $username . " | " . date('Y-m-d H:i:s') . PHP_EOL;
        file_put_contents($filename, $entry, FILE_APPEND);

        // Wyświetl komunikat potwierdzający
        echo <<<HTML
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodano użytkownika</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #1f1f1f;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
        }
        a {
            color: #00bfff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dziękujemy, <span style="color: #00ffcc;">$username</span>!</h1>
        <p>Twoje zgłoszenie zostało przyjęte do WR1TE Studio.</p>
        <p><a href="index.html">← Powrót na stronę główną</a></p>
    </div>
</body>
</html>
HTML;
    } else {
        // Obsługa pustego pola
        echo "Błąd: nie podano nazwy użytkownika.";
    }
} else {
    // Blokuj bezpośredni dostęp GET
    header('HTTP/1.1 403 Forbidden');
    echo "Nieprawidłowe żądanie.";
}
?>
