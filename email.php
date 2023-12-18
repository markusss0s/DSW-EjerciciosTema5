<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($to, $subject, $message)
{
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = 'root';
  $mail->SMTPAuth = true;
  $mail->Username = 'abramianmedina@gmail.com';
  $mail->Password = 'oskj rpki ywse ocfx';
  $mail->Port = 465;
  $mail->SMTPSecure = "ssl";
  $mail->setFrom('abramianmedina@gmail.com', 'Markus');
  
  $mail->addAddress($to);
  $mail->Subject = $subject;
  $mail->isHTML(true);
  $mail->Body = $message;

  if (!$mail->send()) {
    exit('No se ha podido enviar el mensaje');
  }
  $mail->smtpClose();
}
