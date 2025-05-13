<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "yefrivera11@gmail.com"; // tu correo
    $subject = "Mensaje desde el formulario";
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message'] ?? '');

    $body = "Nombre: $name\nCorreo: $email\nMensaje:\n$message";
    $headers = "From: $name <$email>";

    if (mail($to, $subject, $body, $headers)) {
        echo "OK";
    } else {
        echo "No se pudo enviar el mensaje.";
    }
} else {
    http_response_code(405);
    echo "Método no permitido";
}
