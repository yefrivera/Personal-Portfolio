<?php

// Cambia este correo al tuyo
$to = 'yefrivera11@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = htmlspecialchars(strip_tags(trim($_POST["name"] ?? '')));
  $email = filter_var($_POST["email"] ?? '', FILTER_SANITIZE_EMAIL);
  $subject = htmlspecialchars(strip_tags(trim($_POST["subject"] ?? '')));
  $message = htmlspecialchars(strip_tags(trim($_POST["message"] ?? '')));

  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo "Por favor completa todos los campos.";
    exit;
  }

  $email_content = "Nombre: $name\n";
  $email_content .= "Correo: $email\n";
  $email_content .= "Asunto: $subject\n\n";
  $email_content .= "Mensaje:\n$message\n";

  $headers = "From: $name <$email>";

  if (mail($to, $subject, $email_content, $headers)) {
    echo "OK";
  } else {
    http_response_code(500);
    echo "No se pudo enviar el mensaje. Intenta más tarde.";
  }

} else {
  http_response_code(405);
  echo "Método no permitido";
}
