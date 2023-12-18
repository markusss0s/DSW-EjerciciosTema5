<?php
if (isset($_POST['username'])) {
  $msgError = "";
  $username = $_POST['username'];
  require 'connection.php';
  $stmt = $pdo->prepare('SELECT * FROM access WHERE name=:username');
  $stmt->execute([':username' => $username]);

  if ($user = $stmt->fetch(PDO::FETCH_OBJ)) {
    $stmt = null;
    $stmt = $pdo->prepare('UPDATE access SET numberValidate=:numberValidate WHERE name=:username');
    $numberValidate = rand(100000, 10000000);
    $stmt->execute([
      ':numberValidate' => $numberValidate,
      ':username' => $username
    ]);
    require 'email.php';
    $email = $user->mail;
    $message = "<h1>Recordar Contraseña</h1><h2>Hola $username</h2><p><a href=\"http://localhost/DSW2023-access/reset-password.php?username=$username&number_validate=$numberValidate\">pincha aquí para restablecer tu contraseña</a>";
    sendMail($email, 'Restablecer Contraseña', $message);
    header('location: login.php');
    exit();
  } else $msgError = "Debe poner un nombre de usuario válido";
} else {
  $msgError = "Debe poner un nombre de usuario";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="forgotPass.php" method="post">
    <input type="text" name="username" id="" placeholder="Username...">
    <input type="submit" value="Enviar">
  </form>
  <h4 style="color: red;"><?= $msgError ?></h4>
</body>

</html>