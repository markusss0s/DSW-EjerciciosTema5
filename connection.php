<?php
$connection = 'mysql:dbname=users;host=localhost';
$userDB = 'root';
$pwDB = '';
try {
  $pdo = new PDO($connection, $userDB, $pwDB);
} catch (Exception $e) {
  exit('Error al conectar con la base de datos: ' . $e->getMessage());
}
