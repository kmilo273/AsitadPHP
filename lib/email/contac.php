<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'lib/vendor/autoload.php';
require 'lib/email/constante.php';
// IMPORTANTE
// Correo y Contraseña de la Cuenta
$email = 'sistemasitad@gmail.com';
$passEmail = '1694163B';
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $email;
    $mail->Password = $passEmail;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    // Mensaje pa enviar
    $mail->setFrom($email, 'Asitad');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Contactantanos';
    $mail->Body=$_POST['nombre'].$_POST['correo'].$_POST['telefono'] .$_POST['asunto'];
    if ($mail->send()) {
        $_SESSION['visita']= true;
        header('Location: ' . baseUrl );
    } else {
        echo 'Yuca';
    }
} catch (Exception $e) {
    echo 'Algo salio mal' . $e->getMessage();
}