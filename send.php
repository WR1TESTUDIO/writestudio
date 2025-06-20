<?php
$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data["message"]) || !isset($data["category"])) {
  http_response_code(400);
  echo "Błąd danych wejściowych.";
  exit;
}

$msg = htmlspecialchars($data["message"]);
$category = strtolower(trim($data["category"]));
$subject = "Nowa wiadomość z chatu WR1TE - Kategoria: " . ucfirst($category);
$headers = "From: WR1TE Chat <kontakt.wr1te@gmail.com>\r\n" .
           "Content-Type: text/plain; charset=UTF-8\r\n";

$dziedziny = [
  "tekst" => ["nates1ore@gmail.com", "sandrafieske@gmail.com", "szymon.szostak4@gmail.com", "amelia.music@wp.pl"],
  "muzyka" => ["nates1ore@gmail.com", "sandrafieske@gmail.com", "szymon.szostak4@gmail.com", "amelia.music@wp.pl"],
  "dystrybucja" => ["szymon.szostak4@gmail.com"],
  "mix/master" => ["szymon.szostak4@gmail.com"],
  "grafika" => ["lesser.kontakt@gmail.com"],
  "video" => ["lesser.kontakt@gmail.com"]
];

// Sprawdź czy kategoria istnieje i wybierz odpowiednie maile
if (array_key_exists($category, $dziedziny)) {
  $emails = $dziedziny[$category];
} else {
  // Jeśli kategoria nieznana, wyślij do wszystkich jako awaryjne rozwiązanie
  $emails = array_unique(array_merge(...array_values($dziedziny)));
}

// Wyślij maila do każdego odbiorcy z danej kategorii
foreach ($emails as $email) {
  mail($email, $subject, $msg, $headers);
}

// Zapisz wiadomość do pliku (opcjonalnie)
file_put_contents("chat.txt", "Kategoria: $category\nWiadomość: $msg\n\n", FILE_APPEND);

echo "OK";
?>
