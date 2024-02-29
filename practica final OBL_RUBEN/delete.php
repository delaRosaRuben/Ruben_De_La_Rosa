<?php 

//conexion a bbdd
$link = mysqli_connect('localhost', 'root', '', 'coches');

//si el formulario fue enviado
if(isset($_GET['sw']) == 1){

	//cadena con la consulta de eliminacion segun el id de usuario
	$query = "DELETE FROM coches WHERE matricula = '".$_GET["matricula"]."'";



	if(mysqli_query($link, $query)){ //si la consulta devuelve un resultado
		header("Location: home.php"); //redirecciono a home.php
	}else{ //si hubo un error
		echo "Ocurrio un error al intentar eliminar el registro"; //mensaje de error
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD basico con PHP y MySQL</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<div id="wrapper">
		<h3>Eliminar coche</h3>
		<p>Esta seguro que quiere eliminar este coche permanentemente de la base de datos?</p>
		<form action="delete.php" method="get">
			<input type="hidden" name="sw" value="1" />
			<label for="matricula">Introduce la matrícula del coche que desees borrar</label><br/>
			<input type="text" name="matricula"><br/><br/>
			<input class="btn-danger" type="submit" name="eliminar" value="Eliminar" />
		</form><br />
		<a class="btn" href="home.php"><< Volver</a>
	</div><br/>
	<h1>COCHES</h1>
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
				//sacamos los coches de la bdd y los guardamos en una variable
				$query = "SELECT * FROM coches";

				//Ejecuto la query para obtener los resultados de la cadena de consulta en la variable $query
				if($result = mysqli_query($link, $query)):  
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
	<?php
		//cierro conexion a bbdd
		mysqli_close($link);
	?>
</body>
</html>
