<?php
    require_once('../clases/user.php');
    require_once('../clases/admin.php');
    require_once('../clases/gameClass.php');
    require_once('../clases/actionAdmin.php');
    require_once('../clases/actionGames.php');
    session_start();
    if(isset($_SESSION['user']) && $_SESSION['user']->getrole() == 'admin'){
        if(isset($_POST['action'])){
            $id = $_POST['idGame'];
            $idAdmin = $_SESSION['role']->getIdEncargado();
            actionAdmin::apGame($id,$idAdmin);
            header('Location:../index.php');
        }

        if(isset($_GET['idGame'])){
            $idGame = $_GET['idGame'];
        }
        $game = actionGame::obtenerJuego($idGame);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aprobar Juego</title>
    <link rel="stylesheet" href="../style/style_upload.css">
</head>
<body>
<div class="center" id="formRegistro">
		<h1><?php echo $game->getGameName(); ?> </h1>
		<form action="" method="post" enctype='multipart/form-data'>

            <div class="txt_field">
				<input type="text" name="idGame" value="<?php echo $game->getidGame(); ?>" readonly>
				<span></span>
				<label for="idGame">ID Juego</label>
			</div>

			<div class="txt_field">
				<input type="text" name="gameName" value="<?php echo $game->getGameName(); ?>" readonly>
				<span></span>
				<label for="gameName"></label>
			</div>

			<div class="txt_field">
				<input type="text" name="genero" value="<?php echo $game->getgenero(); ?>" readonly>
				<span></span>
				<label for="genero"></label>
			</div>

			<div class="txt_field">
				<input type="text" name="precio" value="<?php echo $game->getprecio(); ?>" readonly>
				<span></span>
				<label for="precio"></label>
			</div>

			<label for="">Logo</label>
				<div class="image"><?php echo '<img width="200" src="data:image;base64,'.base64_encode($game->getportada() ).' "/>'; ?></div>
				<br>

			<label for="">Trailer</label>
				<div class="image">
					<video width="320" height="240" controls>
						<?php echo '<source src="data:image;base64,'.base64_encode($game->gettrailer() ).' " type="video/mp4">'; ?>
					</video>
				</div>
				<br>

			<label for="">Portada</label>
				<div class="image"><?php echo '<img width="200" src="data:image;base64,'.base64_encode($game->getimagenes() ).' "/>'; ?></div>
				<br>

			<div class="sesion">
				<input type="submit" value='Aprobar' name='action'>
				<a href="../index.php" class="registro1">Regresar</a>
			</div>
		</form>
	</div>
</body>
</html>

<?php
    }
?>