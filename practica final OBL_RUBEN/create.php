<?php
//establezco la zona horaria por defecto
date_default_timezone_set('America/Lima');

//si el formulario ha sido enviado procedo a ingresar contenido en la bbdd
if(isset($_POST['sw']) == 1){

	//conexion a bbdd
	$link = mysqli_connect('localhost', 'root', '', 'coches');

	//Consulta de insercion. Se reciben los valores de los inputs del formulario enviados por POST
	$query = "INSERT INTO coches (marca, modelo, potencia, color, matricula) VALUES ( '".$_POST['marca']."', '".$_POST['modelo']."', '".$_POST['potencia']."', '".$_POST['color']."', '".$_POST['matricula']."' )";
	if(mysqli_query($link, $query)){ 
        // si la consulta se ejecuto con exito muestro mensaje y redirecciono a home.php
		echo "La informacion se guardo con exito";
		header('Location: home.php');
	}else{ //si hubo error muestro mensaje de error
		echo "Ocurrio un error al intentar guardar";
	}

	//cierro conexion a bbdd
	mysqli_close($link);
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
		<h3>Nuevo Coche</h3>
		<form action="create.php" method="post">
			<label for="name">Marca: </label><br />
			<input type="text" name="marca" /><br /><br />
			<label for="email">Modelo: </label><br />
			<input type="text" name="modelo" /><br /><br />
			<label for="phone">Potencia: </label><br />
			<input type="text" name="potencia" /><br /><br />
            <label for="phone">Color: </label><br />
			<input type="text" name="color" /><br /><br />
            <label for="phone">Matricula: </label><br />
			<input type="text" name="matricula" /><br /><br />
			<input class="btn-primary" type="submit" name="guardar" value="Guardar" /><br /><br />
			<a class="btn" href="home.php"><< Volver</a>
			<input type="hidden" name="sw" value="1" />
		</form>

		
	</div>
</body>
</html>