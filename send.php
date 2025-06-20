<?php
$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data["message"])) {
  http_response_code(400);
  echo "Błąd danych wejściowych.";
  exit;
}

$msg = htmlspecialchars($data["message"]);
$subject = "Nowa wiadomość z chatu WR1TE";
$headers = "From: WR1TE Chat <chat@wr1testudio.pl>";

$dziedziny = [
  "tekst" => ["nates1ore@gmail.com", "sandrafieske@gmail.com", "szymon.szostak4@gmail.com", "amelia.music@wp.pl"],
  "muzyka" => ["nates1ore@gmail.com", "sandrafieske@gmail.com", "szymon.szostak4@gmail.com", "amelia.music@wp.pl"],
  "dystrybucja" => ["szymon.szostak4@gmail.com"],
  "mix/master" => ["szymon.szostak4@gmail.com"],
  "grafika" => ["lesser.kontakt@gmail.com"],
  "video" => ["lesser.kontakt@gmail.com"]
];

// domyślnie wszyscy
$emails = array_unique(array_merge(...array_values($dziedziny)));

foreach ($emails as $email) {
  mail($email, $subject, $msg, $headers);
}

// zapisz do pliku
file_put_contents("chat.txt", "Użytkownik: $msg\n", FILE_APPEND);

echo "OK";
?>
