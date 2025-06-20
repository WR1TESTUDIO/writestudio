<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);

    // Walidacja
    if (!$username || strlen($username) < 2) {
        die("Nieprawidłowa nazwa użytkownika.");
    }

    $username = preg_replace("/[^a-zA-Z0-9_ąćęłńóśźżĄĆĘŁŃÓŚŹŻ]/u", "", $username);

    $filePath = "chat-data/" . $username . ".txt";

    // Sprawdź, czy plik już istnieje
    if (!file_exists($filePath)) {
        file_put_contents($filePath, ""); // Stwórz pusty plik czatu
    }

    // Przekieruj np. do panelu użytkownika lub potwierdzenie
    header("Location: team-login.html");
    exit;
}
?>
