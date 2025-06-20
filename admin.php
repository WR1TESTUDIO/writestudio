<?php
$chat = file_exists("chat.txt") ? file_get_contents("chat.txt") : "Brak wiadomości.";
echo nl2br(htmlspecialchars($chat));
?>
