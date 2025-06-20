<?php
$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data["message"]) || !isset($data["category"])) {
  http_response_code(400);
  echo json_encode(["error" => "Nieprawidłowe dane"]);
  exit;
}

$msg = htmlspecialchars(trim($data["message"]));
$category = strtolower(trim($data["category"]));

// GENERUJ ID użytownika (np. IP lub sesja)
$userId = $_SERVER['REMOTE_ADDR'];
$chatFile = "chat-data/$userId.txt";

// Zapisz do czatu
file_put_contents($chatFile, "[USER - $userId] $msg\n", FILE_APPEND);

// OGÓLNE powiadomienie do całego zespołu
$subjectGeneral = "📥 Nowa wiadomość na WR1TE Chat";
$allEmails = [
  "nates1ore@gmail.com", "sandrafieske@gmail.com",
  "szymon.szostak4@gmail.com", "amelia.music@wp.pl",
  "lesser.kontakt@gmail.com"
];

$dziedziny = [
  "ogólne" => ["nates1ore@gmail.com", "sandrafieske@gmail.com", "szymon.szostak4@gmail.com", "amelia.music@wp.pl"],["lesser.kontakt@gmail.com"]
  "tekst" => ["nates1ore@gmail.com", "sandrafieske@gmail.com", "szymon.szostak4@gmail.com", "amelia.music@wp.pl"],
  "muzyka" => ["nates1ore@gmail.com", "sandrafieske@gmail.com", "szymon.szostak4@gmail.com", "amelia.music@wp.pl"],
  "dystrybucja" => ["szymon.szostak4@gmail.com"],
  "mix/master" => ["szymon.szostak4@gmail.com"],
  "grafika" => ["lesser.kontakt@gmail.com"],
  "video" => ["lesser.kontakt@gmail.com"]
];

$categoryTitle = ucfirst($category);
$subjectCat = "📬 WR1TE – Nowa wiadomość [Kategoria: $categoryTitle]";
$body = "Nowa wiadomość użytkownika $userId:\n\n$msg\n\nKategoria: $categoryTitle";

$toCategory = $dziedziny[$category] ?? $allEmails;

// Wyślij mail do członków kategorii
foreach ($toCategory as $email) {
  mail($email, $subjectCat, $body, "From: WR1TE Chat <kontakt@wr1te.pl>\r\nContent-Type: text/plain; charset=UTF-8");
}

// Wyślij ogólne powiadomienie do wszystkich (np. osobna treść)
foreach ($allEmails as $email) {
  mail($email, $subjectGeneral, "Nowa wiadomość od użytkownika ($userId): $msg", "From: WR1TE Chat <kontakt@wr1te.pl>");
}

echo json_encode(["status" => "OK"]);
