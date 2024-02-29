<?php
//zona horaria por defecto
date_default_timezone_set('America/Lima');

//conexion a bbdd
$link = mysqli_connect('localhost', 'root', '', 'usuarios');

if(isset($_POST['sw']) == 1){ //si se ha presionado el boton "Actualizar" 

	//cadena con la orden de actualizacion a la tabla "users" con los valores de los inputs enviados por POST
	/*$query2 = "UPDATE coches SET marca='".$_POST['marca']."', modelo='".$_POST['modelo']."', potencia='".$_POST['potencia']."', 
                color='".$_POST['color']."' , matricula='".$_POST['matricula2']."'WHERE matricula=".$_POST['matricula'];*/
    $query2 = "UPDATE usuarios SET id='".$_POST['id']."', nombre='".$_POST['nombre']."', apellidos='".$_POST['apellidos']."', 
                contraseña='".$_POST['contraseña']."' , correo='".$_POST['correo']."' where id = '".$_POST['id']."'";
    echo $query2; 
    
                
	if(mysqli_query($link, $query2)){ //si la consulta se ejecuta con exito
		echo "La informacion se actualizo con exito"; //mensaje de exito
		header('Location: login.php'); //redireccion a index.php
	}else{ //si ocurrio un error
		echo "Ocurrio un error al intentar actualizar"; //mensaje de error
	}
}

//cierro conexion a bbdd
mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Usuarios</title>
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
		<h3>Editar usuarios</h3>
		<form action="updateUser.php" method="post">
        <label for="id">Introduce el ID del usuario que desees acturalizar: </label><br/>
			<input type="text" name="id"><br/><br/>

			<label for="nombre">Nombre: </label><br/>
			<input type="text" name="nombre"/><br /><br />

			<label for="apellidos">Apellidos: </label><br/>
			<input type="text" name="apellidos"/><br /><br />

			<label for="contraseña">Contraseña: </label><br/>
			<input type="text" name="contraseña"  /><br /><br />

            <label for="correo">Correo: </label><br/>
            <input type="text" name="correo"/><br /><br />

			<input class="btn-success" type="submit" name="actualizar" value="Actualizar" /><br /><br />
			<a class="btn" href="login.php"><< Volver</a>
			<input type="hidden" name="sw" value="1" />
		</form>
	</div>
</body>
</html>