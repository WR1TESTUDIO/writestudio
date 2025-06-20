<?php
$users = [];
foreach (glob("chat-data/*.txt") as $file) {
  $users[] = basename($file, ".txt");
}
header('Content-Type: application/json');
echo json_encode($users);
?>


// add-user.php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  if ($username !== '') {
    $filepath = __DIR__ . "/chat-data/" . $username . ".txt";
    if (!file_exists($filepath)) {
      file_put_contents($filepath, "Witamy, $username!\n");
    }
  }
  header("Location: index.html");
}
?>
