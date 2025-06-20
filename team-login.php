<?php
session_start();
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$captcha = $_POST['g-recaptcha-response'] ?? '';

// Weryfikuj reCAPTCHA (v2)
$secret = 'TWÓJ_SECRET_KLUCZ_RECAPTCHA';
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
$captchaSuccess = json_decode($response)->success;

// Przykładowe dane logowania
$users = [
  "Sandra" => "haslo1",
  "Szost" => "haslo2",
  "NateS" => "haslo3",
  "Amelia" => "haslo4",
  "Lesser" => "haslo5"
];

if ($captchaSuccess && isset($users[$login]) && $users[$login] === $password) {
  $_SESSION['admin'] = $login;
  header("Location: admin.html");
  exit;
} else {
  echo "Błędne dane logowania lub CAPTCHA.";
}
