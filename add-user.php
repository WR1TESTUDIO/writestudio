<?php
// add-user.php

// Sprawdź czy metoda to POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobierz dane z formularza
    $username = $_POST['username'] ?? '';

    // Walidacja (prosta)
    if (empty($username)) {
        echo "Nazwa użytkownika nie może być pusta.";
        exit;
    }

    // Tutaj logika zapisu, np. do bazy danych lub pliku
    // Na potrzeby testu:
    echo "Użytkownik '$username' został dodany.";

} else {
    // Jeśli metoda nie jest POST — zwróć błąd 405
    header($_SERVER["SERVER_PROTOCOL"] . " 405 Method Not Allowed");
    echo "Metoda nie jest dozwolona.";
    exit;
}
?>
