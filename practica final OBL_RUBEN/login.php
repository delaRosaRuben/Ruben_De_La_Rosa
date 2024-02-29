<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: inicio.php');
  }
  require 'conexion_bd.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $link->prepare('SELECT id, correo, contraseña FROM usuarios 
                              WHERE correo = "'.$_POST["email"].'"');
    $records->execute();
    $results = $records->get_result()->fetch_assoc();

    $message = '';

    if ($results && isset($results["contraseña"])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: home.php");
    } else {
      $message = 'Las credenciales no corresponden a ningún usuario';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="Login_styles.css">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <?php require 'header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Introduce tu email">
      <input name="password" type="password" placeholder="Introduce tu contraseña">
      <input type="submit" value="entrar">
    </form>
    <a href="updateUser.php?" class='btn btn-success'>Editar</a> 
    <a href="deleteUser.php?" class='btn btn-danger'>Eliminar</a>
    <br/>
    <h1>Usuarios para iniciar sesión</h1>
<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>nombre</th>
					<th>apellidos</th>
					<th>contraseña</th>
					<th>correo</th>
				</tr>
			</thead>
			<tbody>
			<?php 
                // Conexión a la base de datos
                $link = mysqli_connect('localhost', 'root', '', 'usuarios');

                // hacemos la consulta
                $query = "SELECT * FROM usuarios";

				// se ejecuta la consulta
				if($result = mysqli_query($link, $query)):  
			?>
				<?php 
					//la variable $usuarios contiene el contenido de $result en un array asociativo
					while($usuarios = mysqli_fetch_assoc($result)): 
				?>
					<tr>
						<td width="5%" class="text-center"><?php echo $usuarios['id']; ?></td>
						<td width="20%" class="text-center"><?php echo $usuarios['nombre']; ?></td>
						<td width="15%" class="text-center"><?php echo $usuarios['apellidos']; ?></td>
						<td width="15%" class="text-center"><?php echo $usuarios['contraseña']; ?></td>
						<td width="15%" class="text-center"><?php echo $usuarios['correo']; ?></td>
                        
					</tr>
				<?php endwhile; ?>
				<?php mysqli_free_result($result); ?>
			<?php endif; ?>
			</tbody>		
		</table>
  </body>
</html>