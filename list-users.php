<?php
$dir = __DIR__ . "/chat-data";
$files = array_diff(scandir($dir), ['.', '..']);
echo json_encode(array_values($files));
