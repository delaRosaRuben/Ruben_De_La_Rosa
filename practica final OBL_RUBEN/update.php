<?php
//zona horaria por defecto
date_default_timezone_set('America/Lima');

//conexion a bbdd
$link = mysqli_connect('localhost', 'root', '', 'coches');

if(isset($_POST['sw']) == 1){ //si se ha presionado el boton "Actualizar" 

	//cadena con la orden de actualizacion a la tabla "users" con los valores de los inputs enviados por POST
	/*$query2 = "UPDATE coches SET marca='".$_POST['marca']."', modelo='".$_POST['modelo']."', potencia='".$_POST['potencia']."', 
                color='".$_POST['color']."' , matricula='".$_POST['matricula2']."'WHERE matricula=".$_POST['matricula'];*/
    $query2 = "UPDATE coches SET marca='".$_POST['marca']."', modelo='".$_POST['modelo']."', potencia='".$_POST['potencia']."', 
                color='".$_POST['color']."' , matricula='".$_POST['matricula2']."' where matricula = '".$_POST['matricula']."'";
    echo $query2; 
    
                
	if(mysqli_query($link, $query2)){ //si la consulta se ejecuta con exito
		echo "La informacion se actualizo con exito"; //mensaje de exito
		header('Location: home.php'); //redireccion a index.php
	}else{ //si ocurrio un error
		echo "Ocurrio un error al intentar actualizar"; //mensaje de error
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
		<h3>Editar coche</h3>
		<form action="update.php" method="post">
        <label for="matricula">Introduce la matrícula del coche que desees borrar: </label><br/>
			<input type="text" name="matricula"><br/><br/>

			<label for="marca">Marca: </label><br/>
			<input type="text" name="marca" /><br /><br />

			<label for="modelo">Modelo: </label><br/>
			<input type="text" name="modelo" /><br /><br />

			<label for="potencia">Potencia: </label><br/>
			<input type="text" name="potencia" /><br /><br />

            <label for="color">Color: </label><br/>
            <input type="text" name="color" /><br /><br />

            <label for="matricula2">Matricula nueva: </label><br/>
            <input type="text" name="matricula2"/><br /><br />

			<input class="btn-success" type="submit" name="actualizar" value="Actualizar" /><br /><br />
			<a class="btn" href="home.php"><< Volver</a>
			<input type="hidden" name="sw" value="1" />
		</form>
	</div>
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
	<?php //cierro conexion a bbdd
		mysqli_close($link);
	?>

</body>
</html>