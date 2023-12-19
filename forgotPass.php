<?php
$msgError = "";
if (!empty($_POST['username'])) {
  echo "Entra1";
  $name = $_POST['username'];
  require 'connection.php';
  $stmt = $pdo->prepare('SELECT * FROM users WHERE name=:name');
  $stmt->execute([':name' => $name]);

  if ($user = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo "Entra2";
    $stmt = null;
    $stmt = $pdo->prepare('UPDATE users SET number_validate=:number_validate WHERE name=:name');
    $numberValidate = rand(100000, 10000000);
    $stmt->execute([
      ':number_validate' => $numberValidate,
      ':name' => $name
    ]);
    echo "$numberValidate";
    require 'email.php';
    $email = $user->mail;
    $message = "<h1>Recordar Contraseña</h1><h2>Hola $name</h2><p><a href=\"http://localhost/DSW2023-access/reset-password.php?username=$name&number_validate=$numberValidate\">pincha aquí para restablecer tu contraseña</a>";
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