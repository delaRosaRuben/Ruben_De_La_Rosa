<?php
  session_start();

  require 'conexion_bd.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Practica final IAWEB RUBEN DE LA ROSA</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="Login_styles.css">
  </head>
  <body>
    <?php require 'header.php' ?>

      <h1>Inicia sesión (login)<br/> o <br/>Crea una cuenta (signUp)</h1>

      <a href="./login.php">Login</a> or
      <a href="./signup.php">SignUp</a>

  </body>
</html>