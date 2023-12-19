<?php
if (isset($_POST['username'], $_POST['pass'])) {
  $name = $_POST['username'];
  $pass = $_POST['pass'];
  require 'connection.php';
  $stmt = $pdo->prepare('SELECT * FROM users WHERE name=:name AND password=:password AND validate');
  $stmt->execute([':name' => $name, ':password' => $pass]);
  if ($user = $stmt->fetch(PDO::FETCH_OBJ)) {
    session_start();
    $_SESSION['username'] = $user->name;
    $_SESSION['mail'] = $user->mail;
    header('Location: index.php');
    $stmt = null;
    $pdo = null;
  } else $msgError = 'Usuario o contraseña incorrecta';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <style>
    .error {
      color: red;

    }
  </style>
</head>

<body>

  <h1>Login</h1>
  <form action="login.php" method="post">
    <p>
      <label for="name">Name:</label>
      <input type="text" name="username" id="name">
    </p>
    <p>
      <label for="pass">Password:</label>
      <input type="password" name="pass" id="pass">
    </p>
    <?php if (!empty($msgError)) {
      echo "<p><label class = 'error'>$msgError</label></p>";
    } ?>
    <p>
      <input type="submit" value="Login">
    </p>

  </form>
  <a href="">Create Account</a>
  <a href="forgotPass.php">Forgot password</a>

</body>

</html>