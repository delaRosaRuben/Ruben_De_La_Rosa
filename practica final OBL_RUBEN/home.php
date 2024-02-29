<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    header("location: inicio.php");
}

// Conectar a la dase de datos y consultar contenido de coches
$conn = new mysqli("localhost","root","","coches");
$query = "SELECT * FROM coches";
?>

<!DOCTYPE html>
<html>
<head>
	<title>COCHES</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<h3>Lista de coches</h3>
		<a href="create.php" class='btn btn-primary'>Nuevo coche</a>
        <a href="update.php?" class='btn btn-success'>Editar</a> 
        <a href="delete.php?" class='btn btn-danger'>Eliminar</a>
		<table>
			<thead>
				<tr>
					<th>marca</th>
					<th>modelo</th>
					<th>potencia</th>
					<th>color</th>
					<th>matricula</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				//Ejecuto la query para obtener los resultados de la cadena de consulta en la variable $query
				if($result = mysqli_query($conn, $query)):  
			?>
				<?php 
					//la variable $user contiene el contenido de $result en un array asociativo
					while($coches = mysqli_fetch_assoc($result)): 
				?>
					<tr>
						<td width="5%" class="text-center"><?php echo $coches['marca']; ?></td>
						<td width="20%" class="text-center"><?php echo $coches['modelo']; ?></td>
						<td width="15%" class="text-center"><?php echo $coches['potencia']; ?></td>
						<td width="15%" class="text-center"><?php echo $coches['color']; ?></td>
						<td width="15%" class="text-center"><?php echo $coches['matricula']; ?></td>
                        
					</tr>
				<?php endwhile; ?>
				<?php mysqli_free_result($result); ?>
			<?php endif; ?>
			</tbody>		
		</table>
	</div>
	<div class='text-center'>
	<a href="logout.php" >Cerrar la sesión</a>
	</div>
</body>
</html>
<?php 
//cierro conexion a bbdd
mysqli_close($conn); 
?>
