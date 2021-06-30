<?php
	require_once('clases/gameClass.php');
	require_once('clases/action.php');
	if(isset($_POST['upload'])){
		$game = new Game();
		$action = new Action();
		$nombre = $_POST['gameName'];
		$genero = $_POST['genero'];
		$precio = $_POST['precio'];
		$idDev = $_POST['idDev'];
		$descripcion = $_POST['descripcion'];
		$icon = file_get_contents($_FILES['portadaTemp']['tmp_name']);
		$trailer = file_get_contents($_FILES['trailerTemp']['tmp_name']);
		$imagenes = file_get_contents($_FILES['gameplayTemp']['tmp_name']);

		$game->setidGame($action->getcantidadGames()+1);
		$game->setGameName($nombre);
		$game->setgenero($genero);
		$game->setprecio($precio);
		$game->setidDev($idDev);
		$game->setdescripcion($descripcion);

		$game->setportada($icon);
		$game->settrailer($trailer);
		$game->setimagenes($imagenes);
		$action->uploadGame($game);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subir Juego</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<div id="subirJuego">
		<form action="" method="post" enctype='multipart/form-data'>
			<label for="">Nombre del Juego</label>
			<input type="text" name="gameName" required><br>

			<label for="">genero</label>
			<input type="text" name="genero" required><br>

			<label for="">Precio</label>
			<input type="text" name="precio" required><br>

			<label for="">idDev</label>
			<input type="text" name="idDev" required><br>

			<label for="">Descrpción</label>
			<input type="text" name="descripcion" required><br>

			<label for="">Subir Portada</label>
			<input type="file" accept="image/*" name="portadaTemp" required><br>

			<label for="">Trailer</label>
			<input type="file" accept="image/*" name="trailerTemp" required><br>

			<label for="">Gameplay</label>
			<input type="file" accept="image/*" name="gameplayTemp" required><br>
			<br>
			<hr>
			<input type="submit" value="Subir Juego" name="upload">
		</form>
	</div>
</body>
</html>