<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($to, $subject, $message)
{
  $mail = new PHPMailer();
  require_once 'data.php';
  $mail->isSMTP();
  $mail->Host = $host;
  $mail->SMTPAuth = true;
  $mail->Username = $username;
  $mail->Password = $pass;
  $mail->Port = 465;
  $mail->SMTPSecure = "ssl";
  $mail->setFrom('abramianmedina@gmail.com', 'Markus');
  $mail->addAddress($to);
  $mail->Subject = $subject;
  $mail->isHTML(true);
  $mail->Body = $message;

  if (!$mail->send()) {
    exit('<p>No se ha podido enviar el mensaje</p>');
  }
  $mail->smtpClose();
}
