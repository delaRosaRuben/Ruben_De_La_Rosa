<?php

  require 'conexion_bd.php';

  $message = '';
    
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO usuarios VALUES (0, '".$_POST['nombre']."', '".$_POST['apellidos']."',
           '".$_POST['password']."', '".$_POST['email']."')";
    $stmt = $link->prepare($sql);
    
 

    if ($stmt->execute()) {
      $message = 'Usuario creado con éxito, vaya a login para iniciar sesión';
    } else {
      $message = 'Ha habido un problema a la hora de crear tu usuario';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="Login_styles.css">
  </head>
  <body>

    <?php require 'header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="introduce tu correo"/>
      <input name="password" type="password" placeholder="introduce tu contraseña: "/>
      <input type="text" name="nombre" placeholder="introduce tu nombre: "/>
      <input type="text" name="apellidos"  placeholder="introduce tus apellidos "/>
      <input type="submit" value="crear">
    </form>
  </body>
</html>