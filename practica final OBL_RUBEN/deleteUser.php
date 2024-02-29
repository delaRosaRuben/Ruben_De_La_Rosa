<!DOCTYPE html>
<html>
<head>
	<title>Borrar usuarios</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<h1 class="text-center">Usuarios</h1>
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
        <div id="wrapper">
		<h3>Eliminar usuario</h3>
		<form action="deleteUser.php" method="get">
			<input type="hidden" name="sw" value="1" />
			<label for="id">Introduce el ID del usuaio que desees borrar</label><br/>
			<input type="number" name="id"><br/><br/>
			<input class="btn-danger" type="submit" name="eliminar" value="Eliminar" />
		</form><br />
		<a class="btn" href="login.php"><< Volver</a>
	</div>

</body>
</html>
<?php 
// Conexión a la base de datos
$link = mysqli_connect('localhost', 'root', '', 'usuarios');

if(isset($_GET['sw']) && $_GET['sw'] == 1) {
    // Obtener correo y contraseña del formulario

    // Construir la consulta SQL con los valores adecuados
    $query2 = "DELETE FROM usuarios WHERE id = ".$_GET['id']."";

    if(mysqli_query($link, $query2)) {
        header("Location: login.php");
        exit(); // Es importante salir del script después de redireccionar
    } else {
        echo "Ocurrió un error al intentar eliminar el registro: " . mysqli_error($link);
    }
}

// Cerrar conexión a la base de datos
mysqli_close($link);
?>

