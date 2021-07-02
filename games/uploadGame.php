<?php
	require_once('../clases/gameClass.php');
	require_once('../clases/user.php');
	require_once('../clases/actionDev.php');
	require_once('../clases/action.php');
	require_once('../clases/dev.php');
	session_start();
	if(isset($_POST['upload']) && isset($_SESSION['user'])){
		$game = new Game();
		$action = new actionDev();
		$dev = $action->getDev($_SESSION['user']->getidUser());
		$nombre = $_POST['gameName'];
		$genero = $_POST['genero'];
		$precio = $_POST['precio'];
		$idDev = $dev->getIdDev();
		$descripcion = $_POST['descripcion'];
		$icon = file_get_contents($_FILES['portadaTemp']['tmp_name']);
		$trailer = file_get_contents($_FILES['trailerTemp']['tmp_name']);
		$imagenes = file_get_contents($_FILES['gameplayTemp']['tmp_name']);

		$game->setidGame(Action::getcantidadGames()+1);
		$game->setGameName($nombre);
		$game->setgenero($genero);
		$game->setprecio($precio);
		$game->setidDev($idDev);
		$game->setdescripcion($descripcion);

		$game->setportada($icon);
		$game->settrailer($trailer);
		$game->setimagenes($imagenes);
		$action->uploadGame($game);
		header('Location:../index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subir Juego</title>
	<link rel="stylesheet" href="../style/style_upload.css">
</head>
<body>
	
	<div class="center" id="subirJuego">
		<h1>Alta del juego</h1>
		<form action="" method="post" enctype='multipart/form-data'>
			<div class="txt_field">
			<input type="text" name="gameName" required><br>
			<span></span>
			<label for="">Nombre del Juego</label>
			</div>

		<div class="txt_field">
			<input type="text" name="genero" required><br>
			<span></span>
			<label for="">genero</label>
		</div>
		<div class="txt_field">
			<input type="text" name="precio" required><br>
			<span></span>
			<label for="">Precio</label>
		</div>
		<!--  
		<div class="txt_field">
			<input type="text" name="idDev" required><br>
			<span></span>
			<label for="">idDev</label>
		</div>
		-->
		<div class="txt_field">
			<input type="text" name="descripcion" required><br>
			<span></span>
			<label for="">Descrpción</label>
			
		</div>
		<div class="txt_fiel">
			<br>
			<label for="">Logo</label>
			<span></span>
			<input type="file" accept="image/*" name="portadaTemp" required><br>
			
		</div>
		<div class="txt_fiel">
			<br>
			<label for="">Trailer</label>
			<span></span>
			<input type="file" accept="video/*" name="trailerTemp" required><br>
			
		</div>
		<div class="txt_fiel">
			<br>
			<label for="">Portada</label>
			<span></span>
			<input type="file" accept="image/*" name="gameplayTemp" required><br>
			
		</div>
			<br>
			<hr>
			<div class="sesion">
			<input type="submit" value="Subir Juego" name="upload">
			</div>
		</form>
	</div>
</body>
</html>
