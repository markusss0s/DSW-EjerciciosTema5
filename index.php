<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
</head>

<body>
  <?php
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "<h1>Bienvenido '$username'</h1>";
    echo "<a href='destroySession.php'>Cerrar sesión</a>";
  } else {
  ?>
    <h1>INICIO</h1>
    <a href="login.php">Iniciar sesión</a>
    <a href="createAccount.php">Crear cuenta</a>
  <?php } ?>

</body>

</html>