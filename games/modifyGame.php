<?php
	require_once('../clases/action.php');
	require_once('../clases/gameClass.php');
	$action= new Action();
	$game=new Game();
	//busca el juego utilizando el id, que es enviado por GET desde la vista viewDevGames.php
	$game=$action->obtenerJuego($_GET['idGame']);

	if(isset($_POST['edit'])){

		$idGame = $_POST['idGame'];
		$nombre = $_POST['gameName'];
		$genero = $_POST['genero'];
		$precio = $_POST['precio'];
		$idDev = $_POST['idDev'];
		$icon = file_get_contents($_FILES['icon']['tmp_name']);
		$trailer = file_get_contents($_FILES['trailer']['tmp_name']);
		$imagenes = file_get_contents($_FILES['imagenes']['tmp_name']);
		$Descripcion = $_POST['descripcion'];

		$game->setidGame($idGame);
		$game->setGameName($nombre);
		$game->setgenero($genero);
		$game->setprecio($precio);
		$game->setidDev($idDev);
		$game->setportada($icon);
		$game->settrailer($trailer);
		$game->setimagenes($imagenes);
		$game->setdescripcion($Descripcion);

		$action->modifyGame($game);
	}

	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Modificar Juego</title>
	<link rel="stylesheet" href="../style/style_upload.css">
</head>
<body>
	<div class="center" id="formRegistro">
		<h1><?php echo $game->getGameName(); ?> </h1>
		<form action="" method="post" enctype='multipart/form-data'>
			<!--INFORMACION OCULTA-->
			<p><input type="hidden" name="idGame" value="<?php echo $game->getidGame(); ?>"></p>
			<p><input type="hidden" name="idDev" value="<?php echo $game->getidDev(); ?>"></p>

			<div class="txt_field">
				<input type="text" name="gameName" value="<?php echo $game->getGameName(); ?>">
				<span></span>
				<label for="gameName">Nombre </label>
			</div>

			<div class="txt_field">
				<input type="text" name="genero" value="<?php echo $game->getgenero(); ?>">
				<span></span>
				<label for="genero">Genero </label>
			</div>

			<div class="txt_field">
				<input type="text" name="precio" value="<?php echo $game->getprecio(); ?>">
				<span></span>
				<label for="precio">Precio </label>
			</div>

			<div class="txt_field">
				<input type="text" name="descripcion" value="<?php echo $game->getdescripcion(); ?>">
				<span></span>
				<label for="descripcion">Descripcion </label>
			</div>

			<label for="">Portada del juego</label>
				<div class="image"><?php echo '<img width="200" src="data:image;base64,'.base64_encode($game->getportada() ).' "/>'; ?></div>
				<br>
					<div class="archivo">
						<input type="file" accept="image/*" name="icon" required>
					</div>
					<br>

			<label for="">Imagen del Juego 1</label>
				<div class="image">
					<video width="320" height="240" controls>
						<?php echo '<source src="data:image;base64,'.base64_encode($game->gettrailer() ).' " type="video/mp4">'; ?>
					</video>
				</div>
				<br>
					<div class="archivo">
						<input type="file" accept="image/*" name="trailer" required>
					</div>
					<br>

			<label for="">Imagen del Juego 2</label>
				<div class="image"><?php echo '<img width="200" src="data:image;base64,'.base64_encode($game->getimagenes() ).' "/>'; ?></div>
				<br>
					<div class="archivo">
						<input type="file" accept="image/*" name="imagenes" required>
					</div>
					<br>
			<div class="sesion">
				<input type="submit" value='Actualizar' name='edit'>
				<a href="viewDevGames.php" class="registro1">Regresar</a>
			</div>
		</form>
	</div>
</body>
</html>